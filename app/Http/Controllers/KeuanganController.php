<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\DB;

class KeuanganController extends Controller
{
    public function index(Request $request)
    {
        $queryPemasukan = Pemasukan::query();
        $queryPengeluaran = Pengeluaran::query();

        if ($request->filled('dari') && $request->filled('sampai')) {
            $queryPemasukan->whereBetween('tanggal', [$request->dari, $request->sampai]);
            $queryPengeluaran->whereBetween('tanggal', [$request->dari, $request->sampai]);
        } elseif ($request->filled('dari')) {
            $queryPemasukan->where('tanggal', '>=', $request->dari);
            $queryPengeluaran->where('tanggal', '>=', $request->dari);
        } elseif ($request->filled('sampai')) {
            $queryPemasukan->where('tanggal', '<=', $request->sampai);
            $queryPengeluaran->where('tanggal', '<=', $request->sampai);
        }

        $pemasukan = $queryPemasukan->orderBy('tanggal', 'desc')->get();
        $pengeluaran = $queryPengeluaran->orderBy('tanggal', 'desc')->get();

        // 1. Total Pemasukan (dari data transaksi pemasukan)
        $totalPemasukan = $pemasukan->sum('jumlah');

        // 2. Total Pengeluaran (dari data transaksi pengeluaran)
        $totalPengeluaran = $pengeluaran->sum('jumlah');

        // 3. Balance (Total Pemasukan - Total Pengeluaran)
        $balance = $totalPemasukan - $totalPengeluaran;

        // 4. Total Uang / Potensi Pendapatan dari Paket Seluruh Pelanggan Aktif
        $totalUangPelanggan = Pelanggan::join('paket_wifi', 'pelanggan.id_paket', '=', 'paket_wifi.id_paket')
            ->sum('paket_wifi.harga'); 

        // 5. Rekapitulasi Per Bulan
        $pemasukanPerBulan = Pemasukan::select(
                DB::raw("DATE_FORMAT(tanggal, '%Y-%m') as bulan"),
                DB::raw("SUM(jumlah) as total")
            )
            ->groupBy('bulan')
            ->pluck('total', 'bulan');

        $pengeluaranPerBulan = Pengeluaran::select(
                DB::raw("DATE_FORMAT(tanggal, '%Y-%m') as bulan"),
                DB::raw("SUM(jumlah) as total")
            )
            ->groupBy('bulan')
            ->pluck('total', 'bulan');

        $semuaBulan = collect($pemasukanPerBulan->keys())
            ->merge($pengeluaranPerBulan->keys())
            ->unique()
            ->sortDesc();

        $rekapBulanan = [];
        foreach ($semuaBulan as $bln) {
            $pemBulanIni = $pemasukanPerBulan[$bln] ?? 0;
            $pengBulanIni = $pengeluaranPerBulan[$bln] ?? 0;
            
            $rekapBulanan[] = [
                'bulan' => $bln,
                'pemasukan' => $pemBulanIni,
                'pengeluaran' => $pengBulanIni,
                'balance' => $pemBulanIni - $pengBulanIni,
            ];
        }

        return view('page.keuangan.index', compact(
            'pemasukan', 'pengeluaran', 'totalPemasukan', 'totalPengeluaran', 'balance', 'totalUangPelanggan', 'rekapBulanan'
        ));
    }

    public function storePemasukan(Request $request) {
        $request->validate([
            'tanggal' => 'required|date',
            'keterangan' => 'required|string',
            'jumlah' => ['required', 'numeric', 'min:0', function ($attribute, $value, $fail) {
                if (preg_match('/^-0+(\.0+)?$/', $value)) { $fail('Nilai tidak boleh negatif!'); }
            }],
        ]);
        Pemasukan::create($request->all());
        return redirect()->route('admin.keuangan.index')->with('success', 'Pemasukan berhasil ditambahkan');
    }

    public function createPemasukan() { return view('page.keuangan.create_pemasukan'); }
    public function editPemasukan($id) { $pemasukan = Pemasukan::findOrFail($id); return view('page.keuangan.edit_pemasukan', compact('pemasukan')); }
    public function updatePemasukan(Request $request, $id) {
        $request->validate([
            'tanggal' => 'required|date',
            'keterangan' => 'required|string',
            'jumlah' => ['required', 'numeric', 'min:0', function ($attribute, $value, $fail) {
                if (preg_match('/^-0+(\.0+)?$/', $value)) { $fail('Nilai tidak boleh negatif!'); }
            }],
        ]);
        Pemasukan::findOrFail($id)->update($request->all());
        return redirect()->route('admin.keuangan.index')->with('success', 'Pemasukan berhasil diupdate');
    }

    public function storePengeluaran(Request $request) {
        $request->validate([
            'tanggal' => 'required|date',
            'keterangan' => 'required|string',
            'jumlah' => ['required', 'numeric', 'min:0', function ($attribute, $value, $fail) {
                if (preg_match('/^-0+(\.0+)?$/', $value)) { $fail('Nilai tidak boleh negatif!'); }
            }],
        ]);
        Pengeluaran::create($request->all());
        return redirect()->route('admin.keuangan.index')->with('success', 'Pengeluaran berhasil ditambahkan');
    }

    public function createPengeluaran() { return view('page.keuangan.create_pengeluaran'); }
    public function editPengeluaran($id) { $pengeluaran = Pengeluaran::findOrFail($id); return view('page.keuangan.edit_pengeluaran', compact('pengeluaran')); }
    public function updatePengeluaran(Request $request, $id) {
        $request->validate([
            'tanggal' => 'required|date',
            'keterangan' => 'required|string',
            'jumlah' => ['required', 'numeric', 'min:0', function ($attribute, $value, $fail) {
                if (preg_match('/^-0+(\.0+)?$/', $value)) { $fail('Nilai tidak boleh negatif!'); }
            }],
        ]);
        Pengeluaran::findOrFail($id)->update($request->all());
        return redirect()->route('admin.keuangan.index')->with('success', 'Pengeluaran berhasil diupdate');
    }

    public function destroyPemasukan($id) {
        Pemasukan::findOrFail($id)->delete();
        return redirect()->route('admin.keuangan.index')->with('success', 'Pemasukan berhasil dihapus');
    }

    public function destroyPengeluaran($id) {
        Pengeluaran::where('id_pengeluaran', $id)->delete();
        return redirect()->route('admin.keuangan.index')->with('success', 'Pengeluaran berhasil dihapus');
    }
}