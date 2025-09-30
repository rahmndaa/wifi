<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KeuanganExport implements FromCollection, WithHeadings
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

        $pemasukan = $queryPemasukan->get()->map(function($item){
            return [
                'tanggal' => $item->tanggal,
                'keterangan' => $item->keterangan,
                'jumlah' => $item->jumlah,
                'jenis' => 'Pemasukan',
            ];
        });

        $pengeluaran = $queryPengeluaran->get()->map(function($item){
            return [
                'tanggal' => $item->tanggal,
                'keterangan' => $item->keterangan,
                'jumlah' => $item->jumlah,
                'jenis' => 'Pengeluaran',
            ];
        });

        return $pemasukan->merge($pengeluaran);
    }

    public function headings(): array
    {
        return ['Tanggal', 'Keterangan', 'Jumlah', 'Jenis'];
    }
}
