<?php

namespace Database\Seeders;

use App\Models\JenisCuti;
use Illuminate\Database\Seeder;

class JenisCutiSeeder extends Seeder
{
    public function run(): void
    {
        $jenisCutis = [
            ['nama' => 'Cuti Tahunan', 'deskripsi' => 'Cuti reguler tahunan untuk karyawan aktif.', 'maksimal_hari_per_tahun' => 12, 'is_active' => true],
            ['nama' => 'Cuti Sakit', 'deskripsi' => 'Digunakan saat karyawan sakit dengan lampiran pendukung bila perlu.', 'maksimal_hari_per_tahun' => 14, 'is_active' => true],
            ['nama' => 'Cuti Khusus', 'deskripsi' => 'Untuk keperluan keluarga atau agenda penting lainnya.', 'maksimal_hari_per_tahun' => 5, 'is_active' => true],
        ];

        foreach ($jenisCutis as $jenisCuti) {
            JenisCuti::updateOrCreate(['nama' => $jenisCuti['nama']], $jenisCuti);
        }
    }
}
