<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class KeuanganExport implements FromCollection, WithHeadings, WithStyles
{
    protected $dari;
    protected $sampai;

    public function __construct($dari = null, $sampai = null)
    {
        $this->dari = $dari;
        $this->sampai = $sampai;
    }

    public function collection()
    {
        $queryPemasukan = Pemasukan::query();
        $queryPengeluaran = Pengeluaran::query();

        if ($this->dari && $this->sampai) {
            $queryPemasukan->whereBetween('tanggal', [$this->dari, $this->sampai]);
            $queryPengeluaran->whereBetween('tanggal', [$this->dari, $this->sampai]);
        }

        $pemasukan = $queryPemasukan->get()->map(function ($item) {
            return [
                'tanggal' => $item->tanggal,
                'keterangan' => $item->keterangan,
                'jumlah' => $item->jumlah,
                'jenis' => 'Pemasukan',
            ];
        });

        $pengeluaran = $queryPengeluaran->get()->map(function ($item) {
            return [
                'tanggal' => $item->tanggal,
                'keterangan' => $item->keterangan,
                'jumlah' => $item->jumlah,
                'jenis' => 'Pengeluaran',
            ];
        });

        $data = $pemasukan->merge($pengeluaran)->sortBy('tanggal')->values();

        // Hitung balance
        $balance = 0;
        $dataWithBalance = $data->map(function ($item) use (&$balance) {
            if ($item['jenis'] === 'Pemasukan') {
                $balance += $item['jumlah'];
            } else {
                $balance -= $item['jumlah'];
            }
            $item['balance'] = $balance;
            return $item;
        });

        $total = $balance;
        $status = $total >= 0 ? 'UNTUNG' : 'RUGI';

        // Tambah baris TOTAL
        $dataWithBalance->push([
            'tanggal' => 'TOTAL',
            'keterangan' => '',
            'jumlah' => '',
            'jenis' => '',
            'balance' => $total,
        ]);

        // Tambah baris UNTUNG/RUGI (pakai tanda minus kalau rugi)
        $dataWithBalance->push([
            'tanggal' => $status,
            'keterangan' => '',
            'jumlah' => '',
            'jenis' => '',
            'balance' => $status === 'RUGI' ? -abs($total) : abs($total),
        ]);

        return $dataWithBalance;
    }

    public function headings(): array
    {
        return ['Tanggal', 'Keterangan', 'Jumlah', 'Jenis', 'Balance'];
    }

    public function styles(Worksheet $sheet)
    {
        $highestRow = $sheet->getHighestRow();

        // Header
        $sheet->getStyle('A1:E1')->getFont()->setBold(true);
        $sheet->getStyle('A1:E1')->getAlignment()->setHorizontal('center');

        // Format angka ribuan
        $sheet->getStyle("C2:C{$highestRow}")
            ->getNumberFormat()->setFormatCode('#,##0');
        $sheet->getStyle("E2:E{$highestRow}")
            ->getNumberFormat()->setFormatCode('#,##0;[Red]-#,##0'); // merah utk negatif

        // Rata kanan angka
        $sheet->getStyle("C2:C{$highestRow}")
            ->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
        $sheet->getStyle("E2:E{$highestRow}")
            ->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

        // Baris total
        $totalRow = $highestRow - 1;
        $sheet->mergeCells("A{$totalRow}:D{$totalRow}");
        $sheet->getStyle("A{$totalRow}:E{$totalRow}")
            ->getFill()->setFillType(Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FFFFE699'); // kuning muda
        $sheet->getStyle("A{$totalRow}:E{$totalRow}")->getFont()->setBold(true);
        $sheet->getStyle("A{$totalRow}")
            ->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

        // Baris UNTUNG/RUGI
        $profitRow = $highestRow;
        $status = $sheet->getCell("A{$profitRow}")->getValue();

        if ($status === 'RUGI') {
            $fillColor = 'FFFFC7CE'; // merah muda
            $fontColor = 'FFFF0000'; // teks merah
        } else {
            $fillColor = 'FFC6EFCE'; // hijau muda
            $fontColor = 'FF000000'; // teks hitam
        }

        $sheet->mergeCells("A{$profitRow}:D{$profitRow}");
        $sheet->getStyle("A{$profitRow}:E{$profitRow}")
            ->getFill()->setFillType(Fill::FILL_SOLID)
            ->getStartColor()->setARGB($fillColor);
        $sheet->getStyle("A{$profitRow}:E{$profitRow}")
            ->getFont()->setBold(true)
            ->getColor()->setARGB($fontColor);
        $sheet->getStyle("A{$profitRow}")
            ->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
        $sheet->getStyle("E{$profitRow}")
            ->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

        // Border
        $sheet->getStyle("A1:E{$highestRow}")
            ->getBorders()->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        return [];
    }
}
