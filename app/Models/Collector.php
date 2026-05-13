<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collector extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'wilayah', 'no_hp'];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
