<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name'          => 'admin',
            'email'         => 'admin123@gmail.com',
            'password'      => Hash::make('admin'),
            'status'        => '1',
        ]);

        $admin->assignRole('admin');

        $karyawan1 = User::create([
            'nidn'          => '238',
            'name'          => 'ilham',
            'email'         => 'ilham123@gmail.com',
            'password'      => Hash::make('ilham'),
            'status'        => '1',
        ]);

        $karyawan1->assignRole('karyawan');

        $karyawan2 = User::create([
            'nidn'          => '101000',
            'name'          => 'Untung',
            'email'         => 'untung123@gmail.com',
            'password'      => Hash::make('untung'),
            'status'        => '1',
        ]);

        $karyawan2->assignRole('karyawan');
    }
}
