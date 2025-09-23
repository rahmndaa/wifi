<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PembayaranExport implements FromCollection, WithHeadings
{
    protected $tahun;
    protected $bulan;
    protected $status;

    public function __construct($tahun = null, $bulan = null, $status = null)
    {
        $this->tahun = $tahun;
        $this->bulan = $bulan;
        $this->status = $status;
    }

    public function collection()
    {
        $query = DB::table('pembayaran')
            ->join('tagihan', 'tagihan.id_tagihan', '=', 'pembayaran.id_tagihan')
            ->join('pelanggan', 'pelanggan.id_pelanggan', '=', 'tagihan.id_pelanggan')
            ->select(
                'pelanggan.nama_pelanggan',
                'tagihan.periode_bulan',
                'tagihan.periode_tahun',
                'tagihan.total_tagihan',
                'tagihan.status',
                'pembayaran.metode_pembayaran',
                'pembayaran.tanggal_bayar'
            )
            ->orderByDesc('pembayaran.tanggal_bayar');

        // Filter tahun jika ada
        if ($this->tahun) {
            $query->where('tagihan.periode_tahun', $this->tahun);
        }

        // Filter bulan jika ada
        if ($this->bulan) {
            $query->where('tagihan.periode_bulan', $this->bulan);
        }

        // Filter status jika ada
        if ($this->status) {
            $query->where('tagihan.status', $this->status);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'Nama Pelanggan',
            'Bulan',
            'Tahun',
            'Total Tagihan',
            'Status',
            'Metode Pembayaran',
            'Tanggal Bayar',
        ];
    }
}

