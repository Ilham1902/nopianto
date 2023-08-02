<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

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

    public function edit($id)
    {
        $title = "Data Karyawan";
        $dataKaryawan = User::where('id', $id)->first();

        // print_r($dataKaryawan['name']);

        return view('Admin.edit_karyawan', compact('title', 'dataKaryawan'));
    }

    public function create()
    {
        $title = "Data Karyawan";

        return view('Admin.tambah_karyawan', compact('title'));
    }

    public function store(Request $request)
    {
        $file       = $request->file('barcode');
        $file_name  = $file->getClientOriginalName();
        $path       = 'barcode';

        // upload file
        $file->move($path, $file->getClientOriginalName());

        $nama       = $request->nama;
        $nidn       = $request->nidn;
        $email      = $request->email;
        $password   = Hash::make($request->password);

        $created = User::create([
            "nidn"  => $nidn,
            "name"  => $nama,
            "email"  => $email,
            "password"  => $password,
            "status"    => '1',
            "barcode"   => $file_name
        ]);

        $created->assignRole('karyawan');

        if ($created) {
            Session::flash('sukses', 'Karyawan berhasil ditambahkan');
            return redirect()->route('data_karyawan');
        }
    }
}
