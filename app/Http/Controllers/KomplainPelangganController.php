<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Komplain;
use Illuminate\Support\Facades\Storage;

class KomplainPelangganController extends Controller
{
    public function index()
    {
        if (!session('pelanggan')) {
            return redirect()->route('pelanggan.login')->withErrors('Silahkan login dahulu.');
        }

        $id_pelanggan = session('pelanggan')->id_pelanggan;
        $komplains = Komplain::where('id_pelanggan', $id_pelanggan)
            ->latest('tanggal_komplain')
            ->get();

        return view('pelanggan.komplain.index', compact('komplains'));
    }

    public function create()
    {
        if (!session('pelanggan')) {
            return redirect()->route('pelanggan.login')->withErrors('Silahkan login dahulu.');
        }

        return view('pelanggan.komplain.create');
    }

    public function store(Request $request)
    {
        if (!session('pelanggan')) {
            return redirect()->route('pelanggan.login')->withErrors('Silahkan login dahulu.');
        }

        $request->validate([
            'deskripsi' => 'required|string',
            'bukti_komplain' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $bukti = null;
        if ($request->hasFile('bukti_komplain')) {
            $bukti = $request->file('bukti_komplain')->store('bukti_komplain', 'public');
        }

        Komplain::create([
            'id_pelanggan' => session('pelanggan')->id_pelanggan,
            'deskripsi' => $request->deskripsi,
            'tanggal_komplain' => now(), // simpan timestamp lengkap
            'status' => 'menunggu',
            'bukti_komplain' => $bukti,
        ]);

        return redirect()->route('pelanggan.komplain.index')->with('success', 'Komplain berhasil dikirim.');
    }
}
