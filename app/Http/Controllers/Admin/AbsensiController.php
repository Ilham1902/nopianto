<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\dataAbsensi;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index()
    {
        $tanggal = date("Y-m-d");
        $dataAbsensi = Absensi::where('tanggal', '<', $tanggal)->get();
        $title = "Absensi";

        return view('Admin.absensi', compact('dataAbsensi', 'title'));
    }

    public function simpanAbsensi(Request $request)
    {
        $jam = date("H:i:s");
        $tgl = date("Y-m-d");

        $nidn = $request->nidn;
        $kehadiran = $request->kehadiran;

        if ($kehadiran == "Hadir") {
            if ($jam > "08:00:00") {
                $status = "Telat";
            } else {
                $status = "Tepat Waktu";
            }
        } else {
            $status = $kehadiran;
        }

        $update = Absensi::where('nidn', $nidn)->update([
            'tanggal'   => $tgl,
            'jam'       => $jam
        ]);

        $history = dataAbsensi::create([
            'nidn'  => $nidn,
            'tanggal'   => $tgl,
            'jam'       => $jam,
            'kehadiran' => $kehadiran,
            'status'    => $status
        ]);

        return response()->json(["message" => "success"]);
    }

    public function GetAll()
    {
        $dataAbsensi = dataAbsensi::select('data_absensi.nidn', 'users.name', 'data_absensi.tanggal', 'data_absensi.jam', 'data_absensi.kehadiran', 'data_absensi.status')
            ->join('users', 'users.nidn', '=', 'data_absensi.nidn')
            ->get();

        $dataKaryawan = Absensi::where('status', '1')->get();
        $dataBulan = [
            '01' => "Januari",
            '02' => "Februari",
            '03' => "Maret",
            '04' => "April",
            '05' => "Mei",
            '06' => "Juni",
            '07' => "Juli",
            '08' => "Agustus",
            '09' => "September",
            '10' => "Oktober",
            '11' => "November",
            '12' => "Desember"
        ];

        $tahunSekarang = date("Y");
        $sebelumTahunSekarang = $tahunSekarang - 1;
        $sesudahTahunSekarang = $tahunSekarang + 1;

        $dataTahun = [$sebelumTahunSekarang, $tahunSekarang, $sesudahTahunSekarang];

        $title = "Data Absensi";
        return view('Admin.data_absensi', compact('dataAbsensi', 'title', 'dataKaryawan', 'dataBulan', 'dataTahun', 'tahunSekarang'));
    }
}
