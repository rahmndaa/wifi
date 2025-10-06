<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use Illuminate\Support\Facades\DB;

class KeuanganController extends Controller
{
    public function index(Request $request)
    {
        $queryPemasukan = Pemasukan::query();
        $queryPengeluaran = Pengeluaran::query();

        if ($request->filled('dari') && $request->filled('sampai')) {
            $queryPemasukan->whereBetween('tanggal', [$request->dari, $request->sampai]);
            $queryPengeluaran->whereBetween('tanggal', [$request->dari, $request->sampai]);
        } elseif ($request->filled('dari')) {
            $queryPemasukan->where('tanggal', '>=', $request->dari);
            $queryPengeluaran->where('tanggal', '>=', $request->dari);
        } elseif ($request->filled('sampai')) {
            $queryPemasukan->where('tanggal', '<=', $request->sampai);
            $queryPengeluaran->where('tanggal', '<=', $request->sampai);
        }

        $pemasukan = $queryPemasukan->orderBy('tanggal', 'desc')->get();
        $pengeluaran = $queryPengeluaran->orderBy('tanggal', 'desc')->get();

        $totalPemasukan = $pemasukan->sum('jumlah');
        $totalPengeluaran = $pengeluaran->sum('jumlah');

        return view('page.keuangan.index', compact(
            'pemasukan', 'pengeluaran', 'totalPemasukan', 'totalPengeluaran'
        ));
    }


    public function storePemasukan(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'keterangan' => 'required|string',
            'jumlah' => ['required', 'numeric', 'min:0',
             function ($attribute, $value, $fail) {
            if (preg_match('/^-0+(\.0+)?$/', $value)) {
                $fail('Nilai tidak boleh negatif!');
            }
        },
    ],
        ], [
            'tanggal.required' => 'Tanggal wajib diisi!',
            'keterangan.required' => 'Deskripsi wajib diisi!',
            'jumlah.min' => 'Nilai tidak boleh negatif!',
            'jumlah.required' => 'Jumlah wajib diisi!',
            'jumlah.numeric' => 'Jumlah harus berupa angka!',
        ]);

        Pemasukan::create($request->all());

        return redirect()->route('admin.keuangan.index')->with('success', 'Pemasukan berhasil ditambahkan');
    }

    public function createPemasukan()
    {
        return view('page.keuangan.create_pemasukan');
    }

    public function editPemasukan($id)
    {
        $pemasukan = Pemasukan::findOrFail($id);
        return view('page.keuangan.edit_pemasukan', compact('pemasukan'));
    }

    public function updatePemasukan(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'keterangan' => 'required|string',
            'jumlah' => ['required', 'numeric', 'min:0',
             function ($attribute, $value, $fail) {
            if (preg_match('/^-0+(\.0+)?$/', $value)) {
                $fail('Nilai tidak boleh negatif!');
            }
        },
    ],
        ], [
            'tanggal.required' => 'Tanggal wajib diisi!',
            'keterangan.required' => 'Deskripsi wajib diisi!',
            'jumlah.min' => 'Nilai tidak boleh negatif!',
            'jumlah.required' => 'Jumlah wajib diisi!',
            'jumlah.numeric' => 'Jumlah harus berupa angka!',
        ]);

        $pemasukan = Pemasukan::findOrFail($id);
        $pemasukan->update($request->all());

        return redirect()->route('admin.keuangan.index')
            ->with('success', 'Pemasukan berhasil diupdate');
    }


    public function storePengeluaran(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'keterangan' => 'required|string',
            'jumlah' => ['required', 'numeric', 'min:0',
            function ($attribute, $value, $fail) {
            if (preg_match('/^-0+(\.0+)?$/', $value)) {
                $fail('Nilai tidak boleh negatif!');
            }
        },
    ],
        ], [
            'tanggal.required' => 'Tanggal wajib diisi!',
            'keterangan.required' => 'Deskripsi wajib diisi!',
             'jumlah.min' => 'Nilai tidak boleh negatif!',
             'jumlah.required' => 'Jumlah wajib diisi!',
             'jumlah.numeric' => 'Jumlah harus berupa angka!',
        ]);

        Pengeluaran::create($request->all());

        return redirect()->route('admin.keuangan.index')->with('success', 'Pengeluaran berhasil ditambahkan');
    }

    public function createPengeluaran()
    {
        return view('page.keuangan.create_pengeluaran');
    }

    public function editPengeluaran($id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);
        return view('page.keuangan.edit_pengeluaran', compact('pengeluaran'));
    }

    public function updatePengeluaran(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'keterangan' => 'required|string',
            'jumlah' => ['required', 'numeric', 'min:0',
             function ($attribute, $value, $fail) {
            if (preg_match('/^-0+(\.0+)?$/', $value)) {
                $fail('Nilai tidak boleh negatif!');
            }
        },
    ],
        ], [
            'tanggal.required' => 'Tanggal wajib diisi!',
            'keterangan.required' => 'Deskripsi wajib diisi!',
            'jumlah.required' => 'Jumlah wajib diisi!',
            'jumlah.numeric' => 'Jumlah harus berupa angka!',
            'jumlah.min' => 'Nilai tidak boleh negatif!',
        ]);

        $pengeluaran = Pengeluaran::findOrFail($id);
        $pengeluaran->update($request->all());

        return redirect()->route('admin.keuangan.index')
            ->with('success', 'Pengeluaran berhasil diupdate');
    }

    public function destroyPemasukan($id)
    {
        Pemasukan::findOrFail($id)->delete();
        return redirect()->route('admin.keuangan.index')
                         ->with('success', 'Pemasukan berhasil dihapus');
    }

    public function destroyPengeluaran($id)
    {
        Pengeluaran::where('id_pengeluaran', $id)->delete();
        return redirect()->route('admin.keuangan.index')->with('success', 'Pengeluaran berhasil dihapus');
    }
}
