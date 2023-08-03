<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class DataAdminController extends Controller
{
    public function index()
    {
        $dataAdmin = User::whereHas('roles', function ($query) {
            $query->where('name', 'admin');
        })->get();

        $title = "Data Admin";

        // return response()->json($dataAdmin, 200);

        return view('Admin.data_admin', compact('dataAdmin', 'title'));
    }

    public function edit($id)
    {
        $title = "Data Admin";
        $dataAdmin = User::where('id', $id)->first();

        // print_r($dataAdmin['name']);

        return view('Admin.edit_admin', compact('title', 'dataAdmin'));
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

    public function UpdateAdmin(Request $request)
    {
        $id         = $request->id;
        $nama       = $request->nama;
        $email      = $request->email;
        $password   = $request->password;

        if ($password) {
            $new_password   = Hash::make($password);
            $updatePassowrd = User::where('id', $id)->update([
                "password"  => $new_password
            ]);
        }

        $updateUser = User::where('id', $id)->update([
            "name"      => $nama,
            "email"     => $email
        ]);

        return redirect()->route('data_admin')->with('success_simpan', 'success_simpan');
    }

    public function create()
    {
        $title = "Tambah Admin";

        return view('Admin.tambah_admin', compact('title'));
    }

    public function store(Request $request)
    {
        $nama       = $request->nama;
        $email      = $request->email;
        $password   = Hash::make($request->password);

        $created = User::create([
            "name"      => $nama,
            "email"     => $email,
            "password"  => $password,
            "status"    => '1'
        ]);

        $created->assignRole('admin');

        if ($created) {
            return redirect()->route('data_admin')->with('success', 'User berhasil ditambah');
        }
    }
}
