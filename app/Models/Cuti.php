<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cuti extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_karyawans',
        'alasan_cuti',
        'tanggal_masuk',
        'tanggal_keluar',
    ];
}
