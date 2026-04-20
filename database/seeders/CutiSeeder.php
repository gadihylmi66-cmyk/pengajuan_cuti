<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cuti;
use App\Models\JenisCuti;
use App\Models\Karyawan;

class CutiSeeder extends Seeder
{
    public function run(): void
    {
        $karyawans = Karyawan::all();
        $jenisCutis = JenisCuti::pluck('id', 'nama');

        $cutis = [
            [
                'alasan_cuti'   => 'Keperluan keluarga - pernikahan saudara',
                'tanggal_masuk' => '2026-04-01',
                'tanggal_keluar'=> '2026-04-03',
                'status'        => 'disetujui',
                'catatan_admin' => 'Disetujui. Selamat untuk keluarga.',
            ],
            [
                'alasan_cuti'   => 'Sakit dan perlu istirahat total',
                'tanggal_masuk' => '2026-04-07',
                'tanggal_keluar'=> '2026-04-08',
                'status'        => 'disetujui',
                'catatan_admin' => 'Disetujui. Semoga cepat sembuh.',
            ],
            [
                'alasan_cuti'   => 'Urusan administrasi kependudukan',
                'tanggal_masuk' => '2026-04-15',
                'tanggal_keluar'=> '2026-04-15',
                'status'        => 'menunggu',
                'catatan_admin' => null,
            ],
            [
                'alasan_cuti'   => 'Liburan tahunan bersama keluarga',
                'tanggal_masuk' => '2026-04-20',
                'tanggal_keluar'=> '2026-04-25',
                'status'        => 'ditolak',
                'catatan_admin' => 'Ditolak karena bertepatan dengan deadline proyek.',
            ],
            [
                'alasan_cuti'   => 'Mengurus keperluan pendidikan anak',
                'tanggal_masuk' => '2026-05-05',
                'tanggal_keluar'=> '2026-05-06',
                'status'        => 'menunggu',
                'catatan_admin' => null,
            ],
        ];

        foreach ($karyawans as $index => $karyawan) {
            Cuti::create([
                'id_karyawans'  => $karyawan->id,
                'jenis_cuti_id' => $jenisCutis[$index % 2 === 0 ? 'Cuti Tahunan' : 'Cuti Sakit'] ?? null,
                'alasan_cuti'   => $cutis[$index]['alasan_cuti'],
                'tanggal_masuk' => $cutis[$index]['tanggal_masuk'],
                'tanggal_keluar'=> $cutis[$index]['tanggal_keluar'],
                'jumlah_hari'   => \Carbon\Carbon::parse($cutis[$index]['tanggal_masuk'])->diffInDays(\Carbon\Carbon::parse($cutis[$index]['tanggal_keluar'])) + 1,
                'status'        => $cutis[$index]['status'],
                'catatan_admin' => $cutis[$index]['catatan_admin'],
            ]);
        }
    }
}
