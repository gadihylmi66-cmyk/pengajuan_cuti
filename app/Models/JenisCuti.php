<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisCuti extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'deskripsi',
        'maksimal_hari_per_tahun',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function cutis()
    {
        return $this->hasMany(Cuti::class);
    }
}
