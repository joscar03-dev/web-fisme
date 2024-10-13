<?php

namespace App\Filament\Resources\InscripcionConcursoResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DocumentosInscripcionRelationManager extends RelationManager
{
    protected static string $relationship = 'documentosInscripcion';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('ruta')
                    ->label('Subir Documento')
                    ->directory('documentos_inscripciones')  // Carpeta donde se guardarán los archivos
                    ->disk('public')  // Asegúrate de que esté configurado en el sistema de archivos
                    ->required()
                    ->openable()
                    ->downloadable()
                    ->visibility('private'),

                Forms\Components\Select::make('tipo_documento_id')
                    ->relationship('tipoDocumento', 'nombre')
                    ->label('Tipo de Documento')
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('ruta')
            ->columns([
                Tables\Columns\TextColumn::make('ruta')->label('Ruta del Documento'),
                Tables\Columns\TextColumn::make('tipoDocumento.nombre')->label('Tipo de Documento'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
