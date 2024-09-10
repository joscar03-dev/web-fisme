<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiasAsistencias extends Model
{
    use HasFactory;
    protected $fillable = [
        'fecha',
        'evento_id',

    ];
}
