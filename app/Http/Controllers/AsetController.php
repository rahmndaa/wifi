<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aset;
use App\Models\Pelanggan;

class AsetController extends Controller
{
public function index(Request $request)
{
    if (!session('admin')) {
        return redirect()->route('admin.login')->withErrors('Silahkan login dahulu.');
    }

    $query = Aset::with('pelanggan'); 

    if ($request->has('status_aset') && $request->status_aset != '') {
        $query->where('status_aset', $request->status_aset);
    }

    $aset = $query->get();
    $pelanggan = Pelanggan::all();

    return view('page.aset.index', compact('aset', 'pelanggan'));
}


    public function show($id)
    {
        if (!session('admin')) {
            return redirect()->route('admin.login')->withErrors('Silahkan login dahulu.');
        }

        $aset = Aset::with('pelanggan')->findOrFail($id);
        return view('page.aset.show', compact('aset'));
    }

    public function create()
    {
        if (!session('admin')) {
            return redirect()->route('admin.login')->withErrors('Silahkan login dahulu.');
        }

        $pelanggan = Pelanggan::all();
        return view('page.aset.create', compact('pelanggan'));
    }

    public function store(Request $request)
    {
        if (!session('admin')) {
            return redirect()->route('admin.login')->withErrors('Silahkan login dahulu.');
        }

        Aset::create($request->all());
        return redirect()->route('admin.aset')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        if (!session('admin')) {
            return redirect()->route('admin.login')->withErrors('Silahkan login dahulu.');
        }

        $aset = Aset::findOrFail($id);
        $pelanggan = Pelanggan::all();
        return view('page.aset.edit', compact('aset', 'pelanggan'));
    }

    public function update(Request $request, $id)
    {
        if (!session('admin')) {
            return redirect()->route('admin.login')->withErrors('Silahkan login dahulu.');
        }

        $aset = Aset::findOrFail($id);
        $aset->update($request->all());
        return redirect()->route('admin.aset')->with('success', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        if (!session('admin')) {
            return redirect()->route('admin.login')->withErrors('Silahkan login dahulu.');
        }

        Aset::destroy($id);
        return redirect()->route('admin.aset')->with('success', 'Data berhasil dihapus!');
    }

   

}
