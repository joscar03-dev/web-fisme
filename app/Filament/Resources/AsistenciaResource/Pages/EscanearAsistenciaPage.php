<?php

namespace App\Filament\Resources\AsistenciaResource\Pages;

use App\Filament\Resources\AsistenciaResource;
use App\Models\Asistencia;
use App\Models\Resgistro;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\Request;

class EscanearAsistenciaPage extends Page
{
    protected static string $resource = AsistenciaResource::class;

    protected static string $view = 'filament.resources.asistencia-resource.pages.escanear-asistencia-page';
    public function registerAsistencia(Request $request)
{
    $numeroDocumento = $request->input('numero_documento');

    // Validar si el número de documento existe
    $registro = Resgistro::where('numero_documento', $numeroDocumento)->first();

    if (!$registro) {
        return back()->withErrors(['El documento no existe en el registro.']);
    }

    // Verificar si ya existe una asistencia para la fecha de hoy
    $asistenciaExistente = Asistencia::where('registro_id', $registro->id)
        ->whereDate('fecha', now()->toDateString())
        ->first();

    if ($asistenciaExistente) {
        return back()->withErrors(['La asistencia ya ha sido registrada para este documento hoy.']);
    }

    // Crear el registro de asistencia
    Asistencia::create([
        'numero_documento' => $registro->numero_documento,
        'fecha' => now(),
        'hora' => now()->format('H:i:s'),
        'nombres_completos' => $registro->nombres . ' ' . $registro->apellidos,
        'registro_id' => $registro->id,
        'estado' => 'Presente',
    ]);

    // Notificar el éxito del registro
    return back()->with('success', 'Asistencia registrada exitosamente.');
}
}
