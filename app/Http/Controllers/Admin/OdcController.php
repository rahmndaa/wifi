<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Odc;
use Illuminate\Http\Request;

class OdcController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $odcs = Odc::all();
        return view('page.odc.index', compact('odcs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('page.odc.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_odc' => 'required|string|max:255',
            'lokasi' => 'required|string',
        ]);

        Odc::create($request->all());

        return redirect()->route('admin.odc.index')->with('success', 'Data ODC berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Menggunakan where('id_odc', $id) untuk menyesuaikan primary key
        // Menggunakan with('odps') sesuai dengan relasi di Model Odc.php
        $odc = Odc::with('odps')->where('id_odc', $id)->firstOrFail();
        
        return view('page.odc.show', compact('odc'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Menggunakan where('id_odc', $id)
        $odc = Odc::where('id_odc', $id)->firstOrFail();
        return view('page.odc.edit', compact('odc'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_odc' => 'required|string|max:255',
            'lokasi' => 'required|string',
        ]);

        $odc = Odc::where('id_odc', $id)->firstOrFail();
        $odc->update($request->all());

        return redirect()->route('admin.odc.index')->with('success', 'Data ODC berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Menggunakan where('id_odc', $id)
        $odc = Odc::where('id_odc', $id)->firstOrFail();
        $odc->delete();

        return redirect()->route('admin.odc.index')->with('success', 'Data ODC berhasil dihapus.');
    }
}