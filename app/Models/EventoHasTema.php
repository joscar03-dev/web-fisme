<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventoHasTema extends Model
{
    use HasFactory;
    protected $fillable = [
       'evento_id',
       'tema_id',
    ];
}
