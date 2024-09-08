<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AsistenciaResource\Pages;
use App\Filament\Resources\AsistenciaResource\RelationManagers;
use App\Models\Asistencia;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AsistenciaResource extends Resource
{
    protected static ?string $model = Asistencia::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
                    ->form([  // Formulario para el modal
                        Forms\Components\TextInput::make('numero_documento')
                            ->label('Número de Documento')
                            ->required(),
                        Forms\Components\TextInput::make('nombres_completos')
                            ->label('Nombres Completos')
                            ->required(),
                    ])
                    ->action(function (array $data) {
                        // Lógica para registrar la asistencia
                        Asistencia::create([
                            'numero_documento' => $data['numero_documento'],
                            'fecha' => now(),
                            'hora' => now()->format('H:i:s'),
                            'nombres_completos' => $data['nombres_completos'],
                            'estado' => 'Presente',
                        ]);
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
