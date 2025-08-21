<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendapatanHarian extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'karyawan_id',
        'jumlah_like',
        'jumlah_komentar',
        'jumlah_ditonton',
        'jumlah_penjualan',
        'toko_id',
        'sesi',
        'jam_mulai',
        'jam_selesai',
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
    public function toko()
    {
        return $this->belongsTo(Toko::class);
    }
}
