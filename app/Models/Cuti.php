<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cuti extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_karyawans',
        'jenis_cuti_id',
        'alasan_cuti',
        'tanggal_masuk',
        'tanggal_keluar',
        'jumlah_hari',
        'lampiran',
        'status',
        'catatan_admin',
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawans');
    }

    public function jenisCuti()
    {
        return $this->belongsTo(JenisCuti::class);
    }
}
