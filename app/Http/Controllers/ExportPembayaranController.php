<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\PembayaranExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportPembayaranController extends Controller
{
    public function exportExcel(Request $request)
    {
        if (!session('admin')) {
            return redirect()->route('admin.login')->withErrors('Silahkan login dahulu.');
        }

        // ambil input dari form
        $tahun  = $request->input('tahun');
        $bulan  = $request->input('bulan');
        $status = $request->input('status');

        return Excel::download(new PembayaranExport($tahun, $bulan, $status), 'data_pembayaran.xlsx');
    }
}
