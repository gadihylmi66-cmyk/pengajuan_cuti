<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,    // 1. Admin user
            JabatanSeeder::class, // 2. 5 jabatan
            KaryawanSeeder::class,// 3. 5 user + 5 karyawan
            CutiSeeder::class,    // 4. 5 pengajuan cuti
            HasilSeeder::class,   // 5. 5 hasil
        ]);
    }
}
