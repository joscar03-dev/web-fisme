<?php

namespace App\Filament\Resources\AsistenciaResource\Pages;

use App\Filament\Resources\AsistenciaResource;
use App\Models\Asistencia;
use App\Models\Resgistro;
use Filament\Actions\Action as ActionsAction;
use Filament\Resources\Pages\Page;
use Illuminate\Http\Request;
use Filament\Notifications\Notification;
use Filament\Pages\Actions\Action;
class EscanearAsistenciaPage extends Page
{
    protected static string $resource = AsistenciaResource::class;

    protected static string $view = 'filament.resources.asistencia-resource.pages.escanear-asistencia-page';

    public function registerAsistencia(Request $request)
    {
        $numeroDocumento = $request->input('numero_documento');

        // Buscar el registro correspondiente al número de documento
        $registro = Resgistro::where('numero_documento', $numeroDocumento)->first();

        if (!$registro) {
            return response()->json([
                'success' => false,
                'message' => 'No se encontró un registro con ese número de documento.'
            ], 404);
        }

        // Verificar si ya existe una asistencia para hoy
        $asistenciaExistente = Asistencia::where('registro_id', $registro->id)
            ->whereDate('fecha', now()->toDateString())
            ->first();

        if ($asistenciaExistente) {
            return response()->json([
                'success' => false,
                'message' => 'Ya se ha registrado la asistencia para este evento hoy.'
            ]);      
        }
        else {

        // Crear nueva asistencia
        $asistencia = Asistencia::create([
            'numero_documento' => $numeroDocumento,
            
            'fecha' => now(),
            'hora' => now()->format('H:i:s'),
            'nombres_completos' => $registro->nombres . ' ' . $registro->apellidos,
            'registro_id' => $registro->id,

        ]);

        return response()->json([
            'success' => true,
            'message' => 'Asistencia registrada exitosamente.'
        ]);
        }

    }
}
