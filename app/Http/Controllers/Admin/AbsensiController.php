<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index()
    {
        $dataAbsensi = Absensi::all();

        return view('Admin.absensi', compact('dataAbsensi'));
    }

    public function simpanAbsensi(Request $request)
    {
        $jam = date("H:i:s");
        $tgl = date("d-m-Y");

        $nidn = $request->nidn;
        // // $kehadiran = $request->kehadiran;

        $update = Absensi::where('nidn', $nidn)->update([
            'tanggal'   => $tgl,
            'jam'       => $jam
        ]);

        return response()->json($_POST);
    }
}
