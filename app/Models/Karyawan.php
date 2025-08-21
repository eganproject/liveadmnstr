<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $fillable = [
        'name',
        'email',
        'jabatan_id',
        'toko_id',
    ];

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }

    public function toko()
    {
        return $this->belongsTo(Toko::class);
    }
}
