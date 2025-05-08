<?php

namespace App\Http\Controllers;
use App\Models\Paket;
use App\Models\PaketWifi;
use App\Models\Pembayaran;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function dashboard()
    {
        if (!session('admin')) {
            return redirect()->route('admin.login')->withErrors('Silahkan login dahulu.');
        }
        $totalPacket = PaketWifi::count();
        $totalTrx = Pembayaran::count();
        $totalUser = Pelanggan::count();

        return view('admin.dashboard', compact('totalPacket', 'totalTrx', 'totalUser'));
    }

}
