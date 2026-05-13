<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $fillable = ['tunggakan_id', 'kolektor_id', 'jumlah_bayar', 'tanggal_bayar', 'bukti_bayar', 'metode_pembayaran'];

    protected $casts = [
        'tanggal_bayar' => 'date',
    ];

    public function tunggakan()
    {
        return $this->belongsTo(Tunggakan::class);
    }

    public function kolektor()
    {
        return $this->belongsTo(Kolektor::class);
    }
}
