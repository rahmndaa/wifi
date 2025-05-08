<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use Illuminate\Http\Request;

class PelangganTagihanController extends Controller
{
    public function index()
    {
        if (!session('pelanggan')) {
            return redirect()->route('pelanggan.login')->withErrors('Silahkan login dahulu.');
        }

        $idPelanggan = session('pelanggan')['id_pelanggan'];

        // Menggunakan Eloquent untuk mengambil data tagihan
        $tagihan = Tagihan::with('paketwifi')
            ->where('id_pelanggan', $idPelanggan)
            ->orderByDesc('id_tagihan')
            ->get();

        return view('pelanggan.dashboard', compact('tagihan'));
    }
}
