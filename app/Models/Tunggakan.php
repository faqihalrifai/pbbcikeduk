<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tunggakan extends Model
{
    protected $fillable = ['wajib_pajak_id', 'tahun', 'jumlah_tagihan', 'status'];

    public function wajibPajak()
    {
        return $this->belongsTo(WajibPajak::class);
    }

    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class);
    }
}
