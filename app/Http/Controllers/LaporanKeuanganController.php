<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanKeuangan;

class LaporanKeuanganController extends Controller
{
    public function index()
    {
        $laporans = LaporanKeuangan::latest()->paginate(10);
        return view('page.laporan_keuangan.index', compact('laporans'));

    }

    public function edit($id)
    {
        $laporan = LaporanKeuangan::findOrFail($id);
        return view('page.laporan_keuangan.edit', compact('laporan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'deskripsi' => 'required|string',
            'pemasukan' => 'required|numeric',
            'pengeluaran' => 'required|numeric',
        ]);

        $laporan = LaporanKeuangan::findOrFail($id);
        $laporan->update($request->all());

        return redirect()->route('admin.laporan_keuangan.index')
                         ->with('success', 'Laporan berhasil diperbarui.');
    }
}
