<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PelangganAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('pelanggan.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
    
        $pelanggan = Pelanggan::where('username', $request->username)->first();
    
        if ($pelanggan && Hash::check($request->password, $pelanggan->password)) {
            session(['pelanggan' => $pelanggan]);
            return redirect()->route('pelanggan.dashboard');  
        }
    
        return back()->withErrors(['username' => 'Username atau password salah.']);
    }
    
    

    public function dashboard()
    {

        $pelanggan = session('pelanggan');
    
        if (!$pelanggan) {
            return redirect()->route('pelanggan.login')->withErrors('Silahkan login dahulu.');
        }
    
        // $tagihan = \DB::table('tagihan')
        //     ->where('id_pelanggan', $pelanggan->id_pelanggan) 
        //     ->get();
    
        return view('pelanggan.dashboard', compact('pelanggan'));
    }

    public function logout(Request $request)
    {
        if ($request->isMethod('post')) {
         
            session()->forget('pelanggan');
            return redirect()->route('pelanggan.login');
        }

        abort(405, 'Method Not Allowed');
    }
}
