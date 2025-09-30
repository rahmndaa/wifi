<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\KeuanganExport;

class KeuanganExportController extends Controller
{
    public function export(Request $request)
    {
        $dari = $request->dari;
        $sampai = $request->sampai;

        $filename = 'laporan-keuangan.xlsx';
        return Excel::download(new KeuanganExport($dari, $sampai), $filename);
    }
}
