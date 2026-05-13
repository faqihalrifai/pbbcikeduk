<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $fillable = ['nama', 'no_hp', 'judul', 'isi', 'status'];
}
