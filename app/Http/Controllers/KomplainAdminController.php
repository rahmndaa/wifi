<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Komplain;

class KomplainAdminController extends Controller
{
    public function index(Request $request)
    {
        if (!session('admin')) {
            return redirect()->route('admin.login')->withErrors('Silahkan login dahulu.');
        }
        $status = $request->status;
    
        $query = Komplain::with('pelanggan')->orderBy('tanggal_komplain', 'desc');
    
        if ($status) {
            $query->where('status', $status);
        }
    
        $komplain = $query->paginate(10);
    
        return view('page.komplain.index', compact('komplain'));
    }

    public function show($id)
    {
        if (!session('admin')) {
            return redirect()->route('admin.login')->withErrors('Silahkan login dahulu.');
        }
        $komplain = Komplain::with('pelanggan')->findOrFail($id);
        return view('page.komplain.show', compact('komplain'));
    }

    public function updateStatus(Request $request, $id)
    {
        if (!session('admin')) {
            return redirect()->route('admin.login')->withErrors('Silahkan login dahulu.');
        }
        $request->validate([
            'status' => 'required|in:menunggu,proses,selesai',
        ]);
    
        $komplain = Komplain::findOrFail($id);
        $komplain->status = $request->status;
        if ($request->status == 'selesai') {
            $komplain->tanggal_komplain_selesai = now()->format('Y-m-d');
        }
        $komplain->save();
    
        return redirect()->route('admin.komplain.index')->with('success', 'Status komplain berhasil diperbarui.');
    }
    
    public function formBalas($id)
    {
        if (!session('admin')) {
            return redirect()->route('admin.login')->withErrors('Silahkan login dahulu.');
        }

        $komplain = Komplain::findOrFail($id);
        return view('page.komplain.balas', compact('komplain'));
    }

    public function kirimBalasan(Request $request, $id)
    {
        if (!session('admin')) {
            return redirect()->route('admin.login')->withErrors('Silahkan login dahulu.');
        }
        
        $request->validate([
            'balasan_admin' => 'required|string',
        ]);

        $komplain = Komplain::findOrFail($id);
        $komplain->balasan_admin = $request->balasan_admin;
        $komplain->status = 'selesai';
        $komplain->tanggal_komplain_selesai = now();
        $komplain->save();

        return redirect()->route('admin.komplain.index')->with('success', 'Balasan berhasil dikirim');
    }

}
