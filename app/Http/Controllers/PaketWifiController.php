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
        PaketWifi::create($request->all());
        return redirect()->route('admin.paket_wifi')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        if (!session('admin')) {
            return redirect()->route('admin.login')->withErrors('Silahkan login dahulu.');
        }
        $paket = PaketWifi::findOrFail($id);
        return view('page.paket_wifi.edit', compact('paket'));
    }

    public function update(Request $request, $id)
    {
        if (!session('admin')) {
            return redirect()->route('admin.login')->withErrors('Silahkan login dahulu.');
        }
        $paket = PaketWifi::findOrFail($id);
        $paket->update($request->all());
        return redirect()->route('admin.paket_wifi')->with('success', 'Data berhasil ubah!');
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
