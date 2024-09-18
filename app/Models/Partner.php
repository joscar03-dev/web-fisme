<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'img',
        'estado',
    ];
    public function eventos()
    {
        return $this->belongsToMany(Evento::class, 'evento_partners', 'evento_id', 'partner_id');
    }
}
