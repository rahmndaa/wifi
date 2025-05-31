<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\PaketWifi;

class PelangganController extends Controller
{
    public function index(Request $request)
    {
        if (!session('admin')) {
            return redirect()->route('admin.login')->withErrors('Silahkan login dahulu.');
        }
    
        $pelanggan = Pelanggan::with('paketwifi')->get(); 
        $paket = PaketWifi::all();
    
        return view('page.pelanggan.index', compact('pelanggan', 'paket'));
    }
    
    public function show($id)
    {
        if (!session('admin')) {
            return redirect()->route('admin.login')->withErrors('Silahkan login dahulu.');
        }
        $pelanggan = Pelanggan::with('paketWifi')->findOrFail($id);
        return view('page.pelanggan.show', compact('pelanggan'));
    }

    
    public function create()
    {
        if (!session('admin')) {
            return redirect()->route('admin.login')->withErrors('Silahkan login dahulu.');
        }
        $paket = PaketWifi::all();
        return view('page.pelanggan.create', compact('paket'));
    }

    public function store(Request $request)
    {
        if (!session('admin')) {
            return redirect()->route('admin.login')->withErrors('Silahkan login dahulu.');
        }
        $request->merge(['password' => bcrypt($request->password)]);
        Pelanggan::create($request->all());
        return redirect()->route('admin.pelanggan')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        if (!session('admin')) {
            return redirect()->route('admin.login')->withErrors('Silahkan login dahulu.');
        }
        $pelanggan = Pelanggan::findOrFail($id);
        $paket = PaketWifi::all();
        return view('page.pelanggan.edit', compact('pelanggan', 'paket'));
    }

    public function update(Request $request, $id)
    {
        if (!session('admin')) {
            return redirect()->route('admin.login')->withErrors('Silahkan login dahulu.');
        }
        $pelanggan = Pelanggan::findOrFail($id);
        if ($request->filled('password')) {
            $request->merge(['password' => bcrypt($request->password)]);
        } else {
            $request->request->remove('password');
        }
        $pelanggan->update($request->all());
        return redirect()->route('admin.pelanggan')->with('success', 'Data berhasil di ubah!');
    }

    public function destroy($id)
    {
        if (!session('admin')) {
            return redirect()->route('admin.login')->withErrors('Silahkan login dahulu.');
        }
        Pelanggan::destroy($id);
        return redirect()->route('admin.pelanggan')->with('success', 'Data berhasil dihapus!');
    }
}