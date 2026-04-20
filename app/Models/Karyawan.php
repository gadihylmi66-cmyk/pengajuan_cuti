<?php

namespace App\Models;

use App\Models\Jabatan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'id_jabatan',
        'foto_profil',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'alamat',
        'no_telp',
    ];

    public function user()
    {
        return $this->belongsTo(User::class , 'id_user');
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan');
    }

    public function cutis()
    {
        return $this->hasMany(Cuti::class, 'id_karyawans');
    }
}
