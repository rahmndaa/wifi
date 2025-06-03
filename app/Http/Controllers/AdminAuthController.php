<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
    
        $admin = Admin::where('username', $request->username)->first();
    
        if ($admin && Hash::check($request->password, $admin->password)) {
            session(['admin' => $admin]);
            return redirect()->route('admin.dashboard');  
        }
    
        return back()->with('error', 'Username atau password salah.');

    }
    

    public function dashboard()
    {
        $admin = session('admin');
        if (!$admin) {
            return redirect()->route('admin.login')->withErrors('Silahkan login dahulu.');
        }

        return view('admin.dashboard');
    }

    public function logout(Request $request)
    {
        if ($request->isMethod('post')) {
            session()->forget('admin');
            return redirect()->route('admin.login')->with('success', 'Anda telah berhasil logout.');
        }

        abort(405, 'Method Not Allowed');
    }
}
