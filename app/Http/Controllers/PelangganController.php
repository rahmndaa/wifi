<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\PaketWifi;

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

        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'username'       => 'required|string|max:255|min:5|unique:pelanggan,username',
            'password'       => 'required|string|min:8',
            'no_whatsapp'    => 'required|digits_between:10,15|regex:/^[0-9]+$/',
            'alamat'         => 'required|string',
            'tanggal_gabung' => 'required|date',
            'status_pelanggan' => 'required|in:aktif,arsip',
            'id_paket'       => 'required|exists:paket_wifi,id_paket',
        ], [
            'nama_pelanggan.required' => 'Nama pelanggan wajib diisi!',
            'no_whatsapp.required'    => 'Nomor WhatsApp wajib diisi!',
            'no_whatsapp.regex'       => 'Nomor WhatsApp hanya boleh berisi angka!',
            'no_whatsapp.digits_between' => 'Nomor WhatsApp harus terdiri dari 10 hingga 15 angka!',
            'alamat.required'         => 'Alamat wajib diisi!',
            'id_paket.required'       => 'Paket WiFi wajib dipilih!',
            'id_paket.exists'         => 'Paket WiFi tidak valid!',
            'username.required'       => 'Username wajib diisi!',
            'password.required'       => 'Password wajib diisi!',
            'tanggal_gabung.required' => 'Tanggal gabung wajib diisi!',
            'status_pelanggan.required' => 'Status pelanggan wajib diisi!',
        ]);

        $data = $request->all();
        $data['password'] = bcrypt($request->password);

        Pelanggan::create($data);

        return redirect()->route('admin.pelanggan')->with('success', 'Data berhasil ditambahkan!');
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

        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'username'       => 'required|string|max:255|unique:pelanggan,username,' . $id . ',id_pelanggan',
            'password'       => 'nullable|string|min:6',
            'no_whatsapp'    => 'required|digits_between:10,15|regex:/^[0-9]+$/',
            'alamat'         => 'required|string',
            'tanggal_gabung' => 'required|date',
            'status_pelanggan' => 'required|in:aktif,arsip',
            'id_paket'       => 'required|exists:paket_wifi,id_paket',
        ]);

        $pelanggan = Pelanggan::findOrFail($id);

        $data = $request->all();
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        } else {
            unset($data['password']);
        }

        $pelanggan->update($data);

        return redirect()->route('admin.pelanggan')->with('success', 'Data berhasil di ubah!');
    }

    public function destroy($id)
    {
        if (!session('admin')) {
            return redirect()->route('admin.login')->withErrors('Silahkan login dahulu.');
        }

        Pelanggan::destroy($id);
        return redirect()->route('admin.pelanggan')->with('success', 'Data berhasil dihapus!');
    }
}
