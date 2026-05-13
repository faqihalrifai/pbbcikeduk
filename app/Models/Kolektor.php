<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kolektor extends Model
{
    protected $fillable = ['nama', 'wilayah', 'no_hp'];

    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class);
    }
}
