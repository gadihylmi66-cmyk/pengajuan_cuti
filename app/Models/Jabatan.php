<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $fillable = ['jabatan'];

    public function karyawans()
    {
        return $this->hasMany(Karyawan::class, 'id_jabatan');
    }
}
