<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class PembayaranController extends Controller
{
public function index(Request $request)
{
    if (!session('admin')) {
        return redirect()->route('admin.login')->withErrors('Silahkan login dahulu.');
    }

    $query = DB::table('pembayaran')
        ->join('tagihan', 'tagihan.id_tagihan', '=', 'pembayaran.id_tagihan')
        ->join('pelanggan', 'pelanggan.id_pelanggan', '=', 'tagihan.id_pelanggan')
        ->select(
            'pembayaran.*',
            'tagihan.periode_bulan',
            'tagihan.periode_tahun',
            'tagihan.total_tagihan',
            'tagihan.status',
            'pelanggan.nama_pelanggan'
        );

    if ($request->filled('tahun')) {
        $query->where('tagihan.periode_tahun', $request->tahun);
    }

    if ($request->filled('bulan')) {
        $query->where('tagihan.periode_bulan', $request->bulan);
    }

    if ($request->filled('status')) {
        $query->where('tagihan.status', $request->status);
    }

    $pembayaran = $query->orderByDesc('pembayaran.tanggal_bayar')->get();

    return view('page.pembayaran.index', compact('pembayaran'));
}


    public function formPembayaran($id_tagihan)
    {
        if (!session('admin')) {
            return redirect()->route('admin.login')->withErrors('Silahkan login dahulu.');
        }
        $tagihan = DB::table('tagihan')
            ->join('pelanggan', 'tagihan.id_pelanggan', '=', 'pelanggan.id_pelanggan')
            ->leftJoin('paket_wifi', 'pelanggan.id_paket', '=', 'paket_wifi.id_paket')
            ->where('tagihan.id_tagihan', $id_tagihan)
            ->select('tagihan.*', 'pelanggan.nama_pelanggan', 'paket_wifi.nama_paket')
            ->first();

        if (!$tagihan) {
            abort(404);
        }

        return view('page.pembayaran.form_pembayaran', compact('tagihan'));
    }

    public function uploadPembayaran(Request $request, $id_tagihan)
    {
        if (!session('admin')) {
            return redirect()->route('admin.login')->withErrors('Silahkan login dahulu.');
        }
        $request->validate([
            'metode_pembayaran' => 'required|in:transfer,tunai',
        ]);

        // Simpan pembayaran ke tabel pembayaran
        $pembayaran = DB::table('pembayaran')->where('id_tagihan', $id_tagihan)->first();

        if ($pembayaran) {
            DB::table('pembayaran')->where('id_tagihan', $id_tagihan)->update([
                'metode_pembayaran' => $request->metode_pembayaran,
                'tanggal_bayar' => Carbon::now(),
            ]);
        } else {
            DB::table('pembayaran')->insert([
                'id_tagihan' => $id_tagihan,
                'metode_pembayaran' => $request->metode_pembayaran,
                'bukti_transfer' => null,
                'tanggal_bayar' => Carbon::now(),
            ]);
        }

        // Ubah status tagihan menjadi "lunas"
        DB::table('tagihan')->where('id_tagihan', $id_tagihan)->update([
            'status' => 'lunas'
        ]);

         // --- Tambahkan otomatis pencatatan pemasukan ---
        $tagihan = DB::table('tagihan')->where('id_tagihan', $id_tagihan)->first();

        DB::table('pemasukan')->insert([
            'tanggal' => Carbon::now(),
            'keterangan' => 'Pembayaran Tagihan #' . $id_tagihan . ' oleh ' . $tagihan->id_pelanggan,
            'jumlah' => $tagihan->total_tagihan,
        ]);
         // --- Selesai ---

        return redirect()->route('admin.tagihan')->with('success', 'Pembayaran berhasil diproses.');
    }
}
