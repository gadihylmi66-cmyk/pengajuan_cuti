<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Hash;

class KaryawanSeeder extends Seeder
{
    public function run(): void
    {
        $karyawans = [
            [
                'name'          => 'Budi Santoso',
                'email'         => 'budi@example.com',
                'jenis_kelamin' => 'Laki-laki',
                'tempat_lahir'  => 'Jakarta',
                'tanggal_lahir' => '1990-05-15',
                'agama'         => 'Islam',
                'alamat'        => 'Jl. Sudirman No. 10, Jakarta',
                'no_telp'       => '081234567890',
                'id_jabatan'    => 1,
            ],
            [
                'name'          => 'Siti Rahayu',
                'email'         => 'siti@example.com',
                'jenis_kelamin' => 'Perempuan',
                'tempat_lahir'  => 'Bandung',
                'tanggal_lahir' => '1993-08-22',
                'agama'         => 'Islam',
                'alamat'        => 'Jl. Merdeka No. 5, Bandung',
                'no_telp'       => '082345678901',
                'id_jabatan'    => 2,
            ],
            [
                'name'          => 'Agus Wijaya',
                'email'         => 'agus@example.com',
                'jenis_kelamin' => 'Laki-laki',
                'tempat_lahir'  => 'Surabaya',
                'tanggal_lahir' => '1988-12-10',
                'agama'         => 'Kristen',
                'alamat'        => 'Jl. Pahlawan No. 3, Surabaya',
                'no_telp'       => '083456789012',
                'id_jabatan'    => 3,
            ],
            [
                'name'          => 'Dewi Lestari',
                'email'         => 'dewi@example.com',
                'jenis_kelamin' => 'Perempuan',
                'tempat_lahir'  => 'Yogyakarta',
                'tanggal_lahir' => '1995-03-18',
                'agama'         => 'Islam',
                'alamat'        => 'Jl. Malioboro No. 7, Yogyakarta',
                'no_telp'       => '084567890123',
                'id_jabatan'    => 4,
            ],
            [
                'name'          => 'Rizky Pratama',
                'email'         => 'rizky@example.com',
                'jenis_kelamin' => 'Laki-laki',
                'tempat_lahir'  => 'Medan',
                'tanggal_lahir' => '1992-07-30',
                'agama'         => 'Islam',
                'alamat'        => 'Jl. Gatot Subroto No. 12, Medan',
                'no_telp'       => '085678901234',
                'id_jabatan'    => 5,
            ],
        ];

        foreach ($karyawans as $data) {
            $user = User::create([
                'name'     => $data['name'],
                'email'    => $data['email'],
                'password' => Hash::make('password'),
                'role'     => 'user',
            ]);

            Karyawan::create([
                'id_user'       => $user->id,
                'id_jabatan'    => $data['id_jabatan'],
                'jenis_kelamin' => $data['jenis_kelamin'],
                'tempat_lahir'  => $data['tempat_lahir'],
                'tanggal_lahir' => $data['tanggal_lahir'],
                'agama'         => $data['agama'],
                'alamat'        => $data['alamat'],
                'no_telp'       => $data['no_telp'],
            ]);
        }
    }
}
