<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Odp;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class OdpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $odps = Odp::with('odc')->get();
        return view('page.odp.index', compact('odps'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $id_odc = $request->query('id_odc');
        $odcs = \App\Models\Odc::all();
        return view('page.odp.create', compact('odcs', 'id_odc'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_odc' => 'required',
            'nama_odp' => 'required|string|max:255',
            'lokasi' => 'required|string',
            'kapasitas' => 'required|integer',
        ]);

        Odp::create($request->all());

        return redirect()->route('admin.odc.show', $request->id_odc)->with('success', 'Data ODP berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $odp = Odp::with(['odc', 'pelanggan'])->where('id_odp', $id)->firstOrFail();
        return view('page.odp.show', compact('odp'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $odp = Odp::where('id_odp', $id)->firstOrFail();
        $odcs = \App\Models\Odc::all();
        return view('page.odp.edit', compact('odp', 'odcs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'id_odc' => 'required',
            'nama_odp' => 'required|string|max:255',
            'lokasi' => 'required|string',
            'kapasitas' => 'required|integer',
        ]);

        $odp = Odp::where('id_odp', $id)->firstOrFail();
        $odp->update($request->all());

        return redirect()->route('admin.odc.show', $odp->id_odc)->with('success', 'Data ODP berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $odp = Odp::where('id_odp', $id)->firstOrFail();
        $id_odc = $odp->id_odc;
        $odp->delete();

        return redirect()->route('admin.odc.show', $id_odc)->with('success', 'Data ODP berhasil dihapus.');
    }

    /**
     * Menyimpan Pelanggan secara manual ke ODP tertentu.
     */
    public function storePelanggan(Request $request, $id_odp)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'paket' => 'required|string|max:255',
        ]);

        Pelanggan::create([
            'id_odp' => $id_odp,
            'nama_pelanggan' => $request->nama_pelanggan,
            'paket' => $request->paket,
            'username' => null,
            'password' => null,
            'alamat' => null,
            'no_whatsapp' => null,
            'tanggal_gabung' => null,
        ]);

        return redirect()->route('admin.odp.show', $id_odp)->with('success', 'Pelanggan berhasil ditambahkan ke ODP ini.');
    }

    /**
     * Mengeluarkan/Menghapus Relasi Pelanggan dari ODP.
     */
    public function hapusPelanggan($id_pelanggan)
    {
        $pelanggan = Pelanggan::findOrFail($id_pelanggan);
        $id_odp = $pelanggan->id_odp;
        
        $pelanggan->update(['id_odp' => null]);

        return redirect()->route('admin.odp.show', $id_odp)->with('success', 'Pelanggan berhasil dikeluarkan dari ODP.');
    }
}