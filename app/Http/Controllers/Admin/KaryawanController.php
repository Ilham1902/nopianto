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
        $title = "Edit Karyawan";
        $dataKaryawan = User::where('id', $id)->first();

        // print_r($dataKaryawan['name']);

        return view('Admin.edit_karyawan', compact('title', 'dataKaryawan'));
    }

    public function ubah_status(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        $update = User::where('id', $id)
            ->update([
                "status"   => $status
            ]);

        if ($update) {
            return redirect()->back()->with('success', 'Data berhasil diperbarui.');
        } else {
            return redirect()->back()->with('failed', 'Data gagal diperbarui.');
        }
    }

    public function edit_barcode(Request $request)
    {
        $id             = $request->id;

        $file           = $request->file('barcode');
        $extension      = $file->getClientOriginalExtension();
        $file_name_new  = 'barcode_' . date('Ymd_His') . '.' . $extension;
        $path           = 'barcode';

        // upload file
        $file->move($path, $file_name_new);

        $update = User::where('id', $id)
            ->update([
                "barcode"   => $file_name_new
            ]);

        if ($update) {
            return redirect()->back()->with('success', 'Data berhasil diperbarui.');
        } else {
            return redirect()->back()->with('failed', 'Data gagal diperbarui.');
        }
    }

    public function UpdateKaryawan(Request $request)
    {
        $id         = $request->id;
        $nama       = $request->nama;
        $nidn       = $request->nidn;
        $email      = $request->email;
        $password   = $request->password;

        if ($password) {
            $new_password   = Hash::make($password);
            $updatePassowrd = User::where('id', $id)->update([
                "password"  => $new_password
            ]);
        }

        $updateUser = User::where('id', $id)->update([
            "nidn"      => $nidn,
            "name"      => $nama,
            "email"     => $email
        ]);

        return redirect()->route('data_karyawan')->with('success_simpan', 'success_simpan');
    }

    public function create()
    {
        $title = "Tambah Karyawan";

        return view('Admin.tambah_karyawan', compact('title'));
    }

    public function store(Request $request)
    {
        $file           = $request->file('barcode');
        $extension      = $file->getClientOriginalExtension();
        $file_name_new  = 'barcode_' . date('Ymd_His') . '.' . $extension;
        $path           = 'barcode';

        // upload file
        $file->move($path, $file_name_new);

        $nama       = $request->nama;
        $nidn       = $request->nidn;
        $email      = $request->email;
        $password   = Hash::make($request->password);

        $created = User::create([
            "nidn"      => $nidn,
            "name"      => $nama,
            "email"     => $email,
            "password"  => $password,
            "status"    => '1',
            "barcode"   => $file_name_new
        ]);

        $created->assignRole('karyawan');

        if ($created) {
            Session::flash('sukses', 'Karyawan berhasil ditambahkan');
            return redirect()->route('data_karyawan');
        }
    }
}
