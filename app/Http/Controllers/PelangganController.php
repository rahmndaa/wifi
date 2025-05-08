<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\PaketWifi;
use Midtrans\Snap;
use Midtrans\Config;

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
        return redirect()->route('admin.pelanggan');
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
        return redirect()->route('admin.pelanggan');
    }

    public function destroy($id)
    {
        if (!session('admin')) {
            return redirect()->route('admin.login')->withErrors('Silahkan login dahulu.');
        }
        Pelanggan::destroy($id);
        return redirect()->route('admin.pelanggan');
    }
    public function bayarTagihan($id)
{
    $tagihan = Tagihan::with('pelanggan')->findOrFail($id);

    // Konfigurasi Midtrans
    Config::$serverKey = config('midtrans.server_key');
    Config::$isProduction = config('midtrans.is_production');
    Config::$isSanitized = true;
    Config::$is3ds = true;

    $params = [
        'transaction_details' => [
            'order_id' => 'TAGIHAN-' . $tagihan->id_tagihan . '-' . time(),
            'gross_amount' => $tagihan->total_tagihan,
        ],
        'customer_details' => [
            'first_name' => $tagihan->pelanggan->nama_pelanggan,
            'email' => $tagihan->pelanggan->email,
        ],
    ];

    $snapToken = Snap::getSnapToken($params);

    return view('pelanggan.bayar', compact('tagihan', 'snapToken'));
}
}
