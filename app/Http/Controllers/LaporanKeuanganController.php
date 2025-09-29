<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;

class LaporanKeuanganController extends Controller
{
    public function index()
    {
        $pemasukan = Pemasukan::all();
        $pengeluaran = Pengeluaran::all();
        return view('page.laporan_keuangan.index', compact('pemasukan', 'pengeluaran'));
    }

    public function storePemasukan(Request $request)
    {
        Pemasukan::create($request->all());
        return redirect()->route('admin.laporan_keuangan.index')
                         ->with('success', 'Pemasukan berhasil ditambahkan.');
    }

    public function storePengeluaran(Request $request)
    {
        Pengeluaran::create($request->all());
        return redirect()->route('admin.laporan_keuangan.index')
                         ->with('success', 'Pengeluaran berhasil ditambahkan.');
    }

    public function edit($type, $id)
    {
        if ($type == 'pemasukan') {
            $data = Pemasukan::findOrFail($id);
        } else {
            $data = Pengeluaran::findOrFail($id);
        }

        return view('page.laporan_keuangan.edit', compact('data', 'type'));
    }

    public function update(Request $request, $type, $id)
    {
        if ($type == 'pemasukan') {
            $data = Pemasukan::findOrFail($id);
        } else {
            $data = Pengeluaran::findOrFail($id);
        }

        $data->update($request->all());
        return redirect()->route('admin.laporan_keuangan.index')
                         ->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($type, $id)
    {
        if ($type == 'pemasukan') {
            Pemasukan::destroy($id);
        } else {
            Pengeluaran::destroy($id);
        }

        return redirect()->route('admin.laporan_keuangan.index')
                         ->with('success', 'Data berhasil dihapus.');
    }
}
