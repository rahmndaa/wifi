<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PembayaranPelangganController extends Controller
{
    public function formPembayaran($id_tagihan)
    {
        $tagihan = DB::table('tagihan')->where('id_tagihan', $id_tagihan)->first();

        if (!$tagihan || $tagihan->status === 'lunas') {
            return redirect()->route('pelanggan.dashboard')->with('error', 'Tagihan tidak ditemukan atau sudah lunas.');
        }

        return view('pelanggan.form_pembayaran', compact('tagihan'));
    }

    public function prosesPembayaran(Request $request, $id)
{
    $tagihan = DB::table('tagihan')->where('id_tagihan', $id)->first();

    if (!$tagihan) {
        return redirect()->route('pelanggan.dashboard')->with('error', 'Tagihan tidak ditemukan.');
    }

    $request->validate([
        'metode_pembayaran' => 'required|in:transfer,tunai',
        'bukti_transfer' => 'required|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // Cek apakah sudah ada pembayaran sebelumnya untuk tagihan ini
    $pembayaranLama = DB::table('pembayaran')->where('id_tagihan', $id)->first();

    // Simpan bukti transfer baru
    $buktiPath = $request->file('bukti_transfer')->store('bukti_transfer', 'public');

    if ($pembayaranLama) {
        // Hapus bukti lama jika ada
        if ($pembayaranLama->bukti_transfer && Storage::disk('public')->exists($pembayaranLama->bukti_transfer)) {
            Storage::disk('public')->delete($pembayaranLama->bukti_transfer);
        }

        // Update data pembayaran
        DB::table('pembayaran')->where('id_tagihan', $id)->update([
            'metode_pembayaran' => $request->metode_pembayaran,
            'bukti_transfer' => $buktiPath,
            'tanggal_bayar' => now(),
        ]);
    } else {
        // Insert data baru
        DB::table('pembayaran')->insert([
            'id_tagihan' => $id,
            'metode_pembayaran' => $request->metode_pembayaran,
            'bukti_transfer' => $buktiPath,
            'tanggal_bayar' => now(),
        ]);
    }

    DB::table('tagihan')->where('id_tagihan', $id)->update([
        'status' => 'pending',
    ]);

    return redirect()->route('pelanggan.dashboard')->with('success', 'Pembayaran berhasil dikirim dan menunggu konfirmasi.');
}

}
