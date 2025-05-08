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
        $totalPacket = PaketWifi::count();
        $totalTrx = Pembayaran::count();
        $totalUser = Pelanggan::count();

        return view('admin.dashboard', compact('totalPacket', 'totalTrx', 'totalUser'));
    }

}
