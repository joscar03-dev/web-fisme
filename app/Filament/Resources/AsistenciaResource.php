<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AsistenciaResource\Pages;
use App\Filament\Resources\AsistenciaResource\RelationManagers;
use App\Models\Asistencia;
use App\Models\DiasAsistencias;
use App\Models\Resgistro;
use Filament\Forms;
use Filament\Forms\Form;
use Illuminate\Support\Str;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class AsistenciaResource extends Resource
{
    protected static ?string $model = Asistencia::class;


    protected static ?string $navigationIcon = 'heroicon-o-finger-print';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('nombres_completos')
                    ->sortable()
                    ->limit(30)
                    ->searchable(),
                Tables\Columns\TextColumn::make('numero_documento')
                    ->sortable()
                    ->limit(30)
                    ->searchable(),
                Tables\Columns\TextColumn::make('fecha')
                    ->sortable()
                    ->searchable(),


            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->headerActions([
                // Botón "Crear"
                Tables\Actions\CreateAction::make(),

                // Botón personalizado para escanear asistencias con QR
                Action::make('escanearAsistencia')
                    ->label('Escanear Asistencia')
                    ->icon('heroicon-o-camera')
                    ->url(route('filament.admin.resources.asistencias.escanear'))  // Redirige a la página de escaneo  // Redirige a la página de escaneo
                    ->color('primary'),

                // Botón personalizado para registrar asistencia manualmente
                Action::make('registrarAsistencia')
                ->label('Registrar Asistencia')
                ->icon('heroicon-o-check-circle')
                ->form([
                    // Formulario para ingresar el DNI
                    Forms\Components\TextInput::make('numero_documento')
                        ->label('Número de Documento')
                        ->required(),
                ])
                ->action(function (array $data) {
                    // Buscar el registro por número de documento
                    $registro = Resgistro::where('numero_documento', $data['numero_documento'])->first();

                    if (!$registro) {
                        // Manejar el caso en que no se encuentra el registro
                        Notification::make()
                            ->title('Registro no encontrado')
                            ->danger()
                            ->send();
                        return;
                    }

                    // Registrar la asistencia
                    $asistencia = Asistencia::create([
                        'numero_documento' => $registro->numero_documento,
                        'slug' => Str::slug($registro->nombres . '-' . now()->timestamp),
                        'fecha' => now()->toDateString(),
                        'hora' => now()->toTimeString(),

                        'nombres_completos' => $registro->nombres . ' ' . $registro->apellidos,
                        'registro_id' => $registro->id,
                        'estado' => true, // Puedes ajustar este estado según necesidad
                    ]);

                    // Notificación de éxito
                    Notification::make()
                        ->title('Asistencia registrada exitosamente')
                        ->success()
                        ->send();
                })
                ->modalHeading('Registrar Asistencia')
                ->modalButton('Registrar')
                ->requiresConfirmation()
                ->color('success'),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
                ExportBulkAction::make()
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAsistencias::route('/'),
            'create' => Pages\CreateAsistencia::route('/create'),
            'edit' => Pages\EditAsistencia::route('/{record}/edit'),
            'escanear' => Pages\EscanearAsistenciaPage::route('/escanear'),  // Página de escaneo de QR
        ];
    }
}
