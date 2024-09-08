<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;
    protected $table = 'asistencias';

    // Define los campos que pueden ser asignados en masa
    protected $fillable = [
        'numero_documento',
        'fecha',
        'hora',
        'nombres_completos',
        'registro_id',
        'estado',
    ];

    // Convierte los campos de tipo timestamp automáticamente
   
    /**
     * Relación con el modelo Registro
     */
    public function registro()
    {
        return $this->belongsTo(Resgistro::class);
    }
}
