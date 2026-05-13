<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BalikNamaPbb extends Model
{
    use HasFactory;

    protected $fillable = [
        'nop',
        'nama_pemilik_lama',
        'alamat_objek',
        'nama_pemilik_baru',
        'nik',
        'no_hp',
        'alamat_baru',
        'ktp',
        'kk',
        'bukti_kepemilikan',
        'sppt_lama',
        'status'
    ];
}
