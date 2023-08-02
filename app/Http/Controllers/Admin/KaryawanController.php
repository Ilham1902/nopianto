<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KaryawanController extends Controller
{
    public function index()
    {
        $dataKaryawan = User::whereHas('roles', function ($query) {
            $query->where('name', 'karyawan');
        })->get();

        $title = "Data Karyawan";

        // return response()->json($dataKaryawan, 200);

        return view('Admin.data_karyawan', compact('dataKaryawan', 'title'));
    }

    public function create()
    {
        $title = "Data Karyawan";

        return view('Admin.tambah_karyawan', compact('title'));
    }

    public function store(Request $request)
    {
        print_r($_FILES['barcode']);
        print_r($_POST);
        exit;
    }
}
