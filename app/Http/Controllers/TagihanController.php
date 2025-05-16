<?php

namespace App\Http\Controllers;

use App\Models\PaketWifi;
use App\Models\Tagihan;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TagihanController extends Controller
{
    public function index(Request $request)
    {
        if (!session('admin')) {
            return redirect()->route('admin.login')->withErrors('Silahkan login dahulu.');
        }

        $query = Tagihan::with('pelanggan');

        if ($request->filled('tahun')) {
            $query->where('periode_tahun', $request->tahun);
        }

        if ($request->filled('bulan')) {
            $query->where('periode_bulan', $request->bulan);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $tagihan = $query->orderByDesc('id_tagihan')->get();

        return view('page.tagihan.index', compact('tagihan'));
    }


    public function create()
    {
        if (!session('admin')) {
            return redirect()->route('admin.login')->withErrors('Silahkan login dahulu.');
        }
        $pelanggan = Pelanggan::all();
        $paket = PaketWifi::all();
        return view('page.tagihan.create', compact('pelanggan', 'paket'));

    }

    public function store(Request $request)
    {
        if (!session('admin')) {
            return redirect()->route('admin.login')->withErrors('Silahkan login dahulu.');
        }
        $request->validate([
            'id_pelanggan' => 'required',
            'periode_tahun' => 'required',
            'periode_bulan' => 'required',
            'status' => 'required',
        ]);

        Tagihan::create($request->all());

        return redirect()->route('admin.tagihan')->with('success', 'Tagihan berhasil ditambahkan.');
    }

    public function show($id)
    {
        if (!session('admin')) {
            return redirect()->route('admin.login')->withErrors('Silahkan login dahulu.');
        }
        $tagihan = Tagihan::with(['pelanggan', 'pembayaran'])->findOrFail($id);
        return view('page.tagihan.show', compact('tagihan'));
    }

    public function edit($id)
    {
        if (!session('admin')) {
            return redirect()->route('admin.login')->withErrors('Silahkan login dahulu.');
        }
        $tagihan = Tagihan::findOrFail($id);
        $pelanggan = Pelanggan::all();
        return view('page.tagihan.edit', compact('tagihan', 'pelanggan'));
    }

    public function update(Request $request, $id)
    {
        if (!session('admin')) {
            return redirect()->route('admin.login')->withErrors('Silahkan login dahulu.');
        }
        $tagihan = Tagihan::findOrFail($id);

        $request->validate([
            'id_pelanggan' => 'required',
            'periode_tahun' => 'required',
            'periode_bulan' => 'required',
            'status' => 'required',
        ]);

        $tagihan->update($request->all());

        return redirect()->route('admin.tagihan')->with('success', 'Tagihan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        if (!session('admin')) {
            return redirect()->route('admin.login')->withErrors('Silahkan login dahulu.');
        }
        Tagihan::destroy($id);
        return redirect()->route('admin.tagihan')->with('success', 'Tagihan berhasil dihapus.');
    }

    public function generate()
    {
        if (!session('admin')) {
            return redirect()->route('admin.login')->withErrors('Silahkan login dahulu.');
        }
        $periode_tahun = date('Y');
        $periode_bulan = date('n');

        $pelanggan = DB::table('pelanggan')
            ->join('paket_wifi', 'pelanggan.id_paket', '=', 'paket_wifi.id_paket')
            ->select('pelanggan.id_pelanggan', 'paket_wifi.harga')
            ->get();


        foreach ($pelanggan as $p) {
            $cek = DB::table('tagihan')
                ->where('id_pelanggan', $p->id_pelanggan)
                ->where('periode_tahun', $periode_tahun)
                ->where('periode_bulan', $periode_bulan)
                ->first();

            if (!$cek) {
                DB::table('tagihan')->insert([
                    'id_pelanggan' => $p->id_pelanggan,
                    'periode_tahun' => $periode_tahun,
                    'periode_bulan' => $periode_bulan,
                    'status' => 'belum lunas',
                ]);
            }
        }

        return redirect()->route('admin.tagihan')->with('success', 'Tagihan bulan ini berhasil diganrate!');
    }

    public function pembayaran(Request $request)
    {
        if (!session('admin')) {
            return redirect()->route('admin.login')->withErrors('Silahkan login dahulu.');
        }

        // Ambil tagihan dan status pembayaran
        $tagihan = DB::table('tagihan')
            ->leftJoin('pembayaran', 'tagihan.id_tagihan', '=', 'pembayaran.id_tagihan')
            ->leftJoin('pelanggan', 'tagihan.id_pelanggan', '=', 'pelanggan.id_pelanggan')
            ->select('tagihan.*', 'pembayaran.metode_pembayaran', 'pembayaran.status as pembayaran_status', 'pembayaran.bukti_transfer', 'pembayaran.tanggal_bayar', 'pelanggan.nama')
            ->orderByDesc('tagihan.id_tagihan')
            ->get();

        return view('admin.tagihan.pembayaran', compact('tagihan'));
    }
}
