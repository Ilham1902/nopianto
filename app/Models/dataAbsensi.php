<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dataAbsensi extends Model
{
    use HasFactory;

    protected $table = 'data_absensi';
    protected $guarded = ['id'];
}
