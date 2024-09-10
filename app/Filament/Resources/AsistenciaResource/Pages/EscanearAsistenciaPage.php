<?php

namespace App\Filament\Resources\AsistenciaResource\Pages;

use App\Filament\Resources\AsistenciaResource;
use App\Models\Asistencia;
use App\Models\Resgistro;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
class EscanearAsistenciaPage extends Page
{
    protected static string $resource = AsistenciaResource::class;

    protected static string $view = 'filament.resources.asistencia-resource.pages.escanear-asistencia-page';
    public function registerAsistencia(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'numero_documento' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Número de documento inválido.'], 422);
        }

        $numeroDocumento = $request->input('numero_documento');

        // Validar si el número de documento existe
        $registro = Resgistro::where('numero_documento', $numeroDocumento)->first();

        if (!$registro) {
            return response()->json(['message' => 'El documento no existe en el registro.'], 404);
        }

        // Verificar si ya existe una asistencia para la fecha de hoy
        $asistenciaExistente = Asistencia::where('registro_id', $registro->id)
            ->whereDate('fecha', now()->toDateString())
            ->first();

        if ($asistenciaExistente) {
            return response()->json(['message' => 'La asistencia ya ha sido registrada para este documento hoy.'], 409);
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
        return response()->json(['message' => 'Asistencia registrada exitosamente.'], 200);
    }
}
