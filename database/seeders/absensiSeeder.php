<?php

namespace Database\Seeders;

use App\Models\Absensi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class absensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Absensi::create([
            'id_absensi'    => 'test',
            'nidn'          => '238',
            'nama'          => 'Ilham',
            'tanggal'       => date("Y-m-d"),
            'jam'           => date("H:i:s"),
            'status'        => '1',
            'telat'        => '0'
        ]);

        Absensi::create([
            'id_absensi'    => 'test2',
            'nidn'          => '101000',
            'nama'          => 'Untung',
            'tanggal'       => date("Y-m-d"),
            'jam'           => date("H:i:s"),
            'status'        => '1',
            'telat'        => '0'
        ]);
    }
}
