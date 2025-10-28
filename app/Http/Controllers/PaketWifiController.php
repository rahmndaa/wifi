<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaketWifi;
use Illuminate\Support\Facades\DB;

class PaketWifiController extends Controller
{
    public function index(Request $request)
    {
        if (!session('admin')) {
            return redirect()->route('admin.login')->withErrors('Silahkan login dahulu.');
        }
        
        $paket = DB::table('paket_wifi')->get();
    
        return view('page.paket_wifi.index', compact('paket'));
    }
    
    
    public function show($id)
    {
        if (!session('admin')) {
            return redirect()->route('admin.login')->withErrors('Silahkan login dahulu.');
        }
        $paket = PaketWifi::findOrFail($id);
        return view('page.paket_wifi.show', compact('paket'));
    }
      
    public function create()
    {
        if (!session('admin')) {
            return redirect()->route('admin.login')->withErrors('Silahkan login dahulu.');
        }
        return view('page.paket_wifi.create');
    }

public function store(Request $request)
{
    if (!session('admin')) {
        return redirect()->route('admin.login')->withErrors('Silahkan login dahulu.');
    }

    $request->validate([
        'nama_paket' => 'required|string|max:255',
        'kecepatan' => 'required|string|max:100',
        'harga' => 'required|numeric|min:1', // harga minimal 1
        'deskripsi' => 'nullable|string',
    ], [
        'harga.min' => 'Harga tidak boleh 0 atau negatif.',
    ]);

    PaketWifi::create($request->all());
    return redirect()->route('admin.paket_wifi')->with('success', 'Data berhasil ditambahkan!');
}

public function update(Request $request, $id)
{
    if (!session('admin')) {
        return redirect()->route('admin.login')->withErrors('Silahkan login dahulu.');
    }

    $request->validate([
        'nama_paket' => 'required|string|max:255',
        'kecepatan' => 'required|string|max:100',
        'harga' => 'required|numeric|min:1', // harga minimal 1
        'deskripsi' => 'nullable|string',
    ], [
        'harga.min' => 'Harga tidak boleh 0 atau negatif.',
    ]);

    $paket = PaketWifi::findOrFail($id);
    $paket->update($request->all());
    return redirect()->route('admin.paket_wifi')->with('success', 'Data berhasil diubah!');
}


    public function edit($id)
    {
        if (!session('admin')) {
            return redirect()->route('admin.login')->withErrors('Silahkan login dahulu.');
        }
        $paket = PaketWifi::findOrFail($id);
        return view('page.paket_wifi.edit', compact('paket'));
    }

    public function destroy($id)
    {
        if (!session('admin')) {
            return redirect()->route('admin.login')->withErrors('Silahkan login dahulu.');
        }
        PaketWifi::destroy($id);
        return redirect()->route('admin.paket_wifi')->with('success', 'Data berhasil dihapus!');
    }
}
