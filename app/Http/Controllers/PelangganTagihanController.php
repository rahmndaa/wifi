<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PelangganTagihanController extends Controller
{
    public function index()
    {
        if (!session('pelanggan')) {
            return redirect()->route('pelanggan.login')->withErrors('Silahkan login dahulu.');
        }

        $idPelanggan = session('pelanggan')['id_pelanggan'];

        $tagihan = DB::table('tagihan')
            ->where('id_pelanggan', $idPelanggan)
            ->orderByDesc('periode_tahun')
            ->orderByDesc('periode_bulan')
            ->get();

        return view('pelanggan.dashboard', compact('tagihan'));
    }
}
