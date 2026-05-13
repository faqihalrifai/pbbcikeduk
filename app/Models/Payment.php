<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['pbb_id', 'collector_id', 'jumlah_bayar', 'tanggal_bayar'];

    protected $casts = [
        'tanggal_bayar' => 'date',
    ];

    public function pbb()
    {
        return $this->belongsTo(Pbb::class);
    }

    public function collector()
    {
        return $this->belongsTo(Collector::class);
    }
}
