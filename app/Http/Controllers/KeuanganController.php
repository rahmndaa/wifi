<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
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

    $totalPemasukan = $pemasukan->sum('jumlah');
    $totalPengeluaran = $pengeluaran->sum('jumlah');

    return view('page.keuangan.index', compact(
        'pemasukan', 'pengeluaran', 'totalPemasukan', 'totalPengeluaran'
    ));
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
