<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pbb extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_urut',
        'blok',
        'urut',
        'nop_gabung',
        'nop',
        'nama_wp',
        'nama_wp_lainnya',
        'ketetapan_pbb',
        'nama_kolektor',
        'luas',
        'alamat_wajib_pajak',
        'hutang_pbb',
        'tgl_bayar',
        'jumlah_bayar',
        'status',
        'column1'
    ];
}
