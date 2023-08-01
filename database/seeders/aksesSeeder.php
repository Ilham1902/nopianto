<?php

namespace Database\Seeders;

use App\Models\akses;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class aksesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        akses::create([
            "id_akses"  => "e5f2d6bb145211ee9b82548d5a0463ec",
            "api_key"   => "e5f2f48f145211ee9b82548d5a0463ec"
        ]);
    }
}
