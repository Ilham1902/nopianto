<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Admin
    public function akunAdmin()
    {
        $akun   = User::where('id', auth()->user()->id)->first();

        $title  = "Info Akun";

        return view('Admin.info_akun', compact('akun', 'title'));
    }

    public function editAkunAdmin()
    {
        $akun   = User::where('id', auth()->user()->id)->first();

        $title  = "Edit Akun";

        return view('Admin.edit_akun', compact('akun', 'title'));
    }

    public function UpdateAkun(Request $request)
    {
        $id         = auth()->user()->id;
        $nama       = $request->nama;
        $password   = $request->password;

        if ($password) {
            $new_password   = Hash::make($password);
            $updatePassowrd = User::where('id', $id)->update([
                "password"  => $new_password
            ]);
        }

        $UpdateAkun = User::where('id', $id)->update([
            'name'  =>  $nama
        ]);

        return redirect()->route('akunAdmin')->with('success_simpan', 'success_simpan');
    }

    // Karyawan
    public function akunKaryawan()
    {
        $akun   = User::where('id', auth()->user()->id)->first();

        $title  = "Info Akun";

        return view('Karyawan.info_akun', compact('akun', 'title'));
    }

    public function editAkunKaryawan()
    {
        $akun   = User::where('id', auth()->user()->id)->first();

        $title  = "Edit Akun";

        return view('Karyawan.edit_akun', compact('akun', 'title'));
    }

    public function UpdateAkunKaryawan(Request $request)
    {
        $id         = auth()->user()->id;
        $nama       = $request->nama;
        $password   = $request->password;

        if ($password) {
            $new_password   = Hash::make($password);
            $updatePassowrd = User::where('id', $id)->update([
                "password"  => $new_password
            ]);
        }

        $UpdateAkun = User::where('id', $id)->update([
            'name'  =>  $nama
        ]);

        return redirect()->route('akunKaryawan')->with('success_simpan', 'success_simpan');
    }
}
