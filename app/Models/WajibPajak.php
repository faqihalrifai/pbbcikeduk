<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WajibPajak extends Model
{
    protected $fillable = ['nop', 'nama', 'alamat'];

    public function tunggakans()
    {
        return $this->hasMany(Tunggakan::class);
    }
}
