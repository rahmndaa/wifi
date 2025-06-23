<?php

namespace App\Http\Controllers;
use App\Models\Paket;
use App\Models\PaketWifi;
use App\Models\Pembayaran;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use App\Models\Tagihan;
use App\Models\Komplain;
use App\Models\Aset;

class AdminDashboardController extends Controller
{
public function dashboard()
{
    if (!session('admin')) {
        return redirect()->route('admin.login')->withErrors('Silahkan login dahulu.');
    }

    $totalPaket = PaketWifi::count();
    $totalPelanggan = Pelanggan::count();
    $totalTagihanMenunggu = Tagihan::where('status', 'pending')->count();
    $totalKeluhanMenunggu = Komplain::where('status', 'menunggu')->count();

    $totalAset = Aset::count();
    $asetDigunakan = Aset::where('status_aset', 'digunakan')->count();
    $asetTersedia = Aset::where('status_aset', 'tersedia')->count();
    $asetRusak = Aset::where('status_aset', 'rusak')->count();

    return view('admin.dashboard', compact(
        'totalPaket',
        'totalTagihanMenunggu',
        'totalKeluhanMenunggu',
        'totalPelanggan',
        'totalAset',
        'asetDigunakan',
        'asetTersedia',
        'asetRusak'
    ));
}

}
