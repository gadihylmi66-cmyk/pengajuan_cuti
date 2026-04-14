<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jabatan;

class JabatanSeeder extends Seeder
{
    public function run(): void
    {
        $jabatans = [
            'Manager',
            'Staff IT',
            'Staff HRD',
            'Staff Keuangan',
            'Staff Marketing',
        ];

        foreach ($jabatans as $jabatan) {
            Jabatan::create(['jabatan' => $jabatan]);
        }
    }
}
