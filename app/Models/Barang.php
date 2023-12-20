<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';

    protected $fillable = [
        'nama_barang',
        'no_seri',
        'tgl_masuk',
        'jumlah_masuk',
        'riwayat_kerusakan_masuk',
        'tgl_keluar',
        'jumlah_keluar',
        'riwayat_kerusakan_keluar',
    ];
}
