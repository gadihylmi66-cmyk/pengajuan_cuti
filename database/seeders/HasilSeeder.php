<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hasil;
use App\Models\Karyawan;

class HasilSeeder extends Seeder
{
    public function run(): void
    {
        $karyawans = Karyawan::all();

        $statuses = ['diterima', 'diterima', 'menunggu', 'ditolak', 'menunggu'];

        foreach ($karyawans as $index => $karyawan) {
            Hasil::create([
                'id_karyawans' => $karyawan->id,
                'id_jabatan'   => $karyawan->id_jabatan,
                'status'       => $statuses[$index],
            ]);
        }
    }
}
