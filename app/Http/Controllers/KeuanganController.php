<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use Illuminate\Support\Facades\DB;

class KeuanganController extends Controller
{
    public function index()
    {
        $pemasukan = DB::table('pemasukan')->orderBy('tanggal', 'desc')->get();
        $pengeluaran = DB::table('pengeluaran')->orderBy('tanggal', 'desc')->get();

        $totalPemasukan = $pemasukan->sum('jumlah');
        $totalPengeluaran = $pengeluaran->sum('jumlah');

        return view('page.keuangan.index', compact('pemasukan', 'pengeluaran', 'totalPemasukan', 'totalPengeluaran'));
    }


    public function storePemasukan(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'keterangan' => 'required|string',
            'jumlah' => 'required|numeric',
        ]);

        Pemasukan::create($request->all());

        return redirect()->route('admin.keuangan')->with('success', 'Pemasukan berhasil ditambahkan');
    }

    public function storePengeluaran(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'keterangan' => 'required|string',
            'jumlah' => 'required|numeric',
        ]);

        Pengeluaran::create($request->all());

        return redirect()->route('admin.keuangan')->with('success', 'Pengeluaran berhasil ditambahkan');
    }

    public function destroyPemasukan($id)
    {
        Pemasukan::findOrFail($id)->delete();
        return redirect()->route('admin.keuangan')->with('success', 'Pemasukan berhasil dihapus');
    }

    public function destroyPengeluaran($id)
    {
        Pengeluaran::findOrFail($id)->delete();
        return redirect()->route('admin.keuangan')->with('success', 'Pengeluaran berhasil dihapus');
    }
}
