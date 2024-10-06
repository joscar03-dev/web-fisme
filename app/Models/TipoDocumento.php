<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    use HasFactory;

    // Define los campos que pueden ser asignados en masa
    protected $fillable = [
        'tipo_documento',
        'nombre',
        'url',
        'estado',

    ];
    public function documentosConcursos()
    {
        return $this->hasMany(DocumentosConcurso::class, 'tipo_documento_id');
    }
}
