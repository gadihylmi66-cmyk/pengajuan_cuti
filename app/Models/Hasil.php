<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hasil extends Model
{
    protected $fillable = ['id_karyawans', 'id_jabatan', 'status'];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawans');
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan');
    }
}
