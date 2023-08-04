<?php

namespace App\Http\Controllers\Karyawan;

use App\Models\Absensi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AbsensiKaryawanController extends Controller
{
    public function index()
    {
        $tanggal = date("Y-m-d");
        $data = Absensi::where('tanggal', '<', $tanggal)
            ->orwhere('tanggal', '=', $tanggal)
            ->where('nidn', auth()->user()->nidn)->first();
        $title = "Absensi";

        return view('Karyawan.absensi', compact('data', 'title', 'tanggal'));
    }
}
