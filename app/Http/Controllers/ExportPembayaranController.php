<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\PembayaranExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportPembayaranController extends Controller
{
    public function exportExcel()
    {
        if (!session('admin')) {
            return redirect()->route('admin.login')->withErrors('Silahkan login dahulu.');
        }

        return Excel::download(new PembayaranExport, 'data_pembayaran.xlsx');
    }
}
