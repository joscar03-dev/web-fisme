<?php

namespace App\Filament\Resources\ConcursoResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DocumentosConcursosRelationManager extends RelationManager
{
    protected static string $relationship = 'documentosConcursos';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('tipo_documento_id')
                    ->label('Tipo Documento')
                    ->relationship('tipoDocumento', 'nombre')
                    ->createOptionForm([
                        TextInput::make('nombre')
                            ->required()
                            ->maxLength(255),
                        Select::make('tipo_documento')
                            ->required()
                            ->options([
                                'PPTX' => 'PPTX',
                                'PDF' => 'PDF',
                                'DOC' => 'DOC',

                            ]),
                        Forms\Components\Toggle::make('estado')
                            ->label('Estado')
                            ->default(true)
                            ->required(),
                    ])
                    ->required(),
                Forms\Components\FileUpload::make('url')
                    ->label('Documento')
                    ->acceptedFileTypes([
                        'application/pdf', // PDF
                        'application/msword', // DOC
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document', // DOCX
                        'application/vnd.ms-excel', // XLS
                        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', // XLSX
                    ])
                    ->required()
                    ->directory('documentos_concursos') // Opcional: para definir la carpeta de almacenamiento
                    ->maxSize(10240) // Tamaño máximo de archivo en KB (10MB)
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('url')
            ->columns([
                Tables\Columns\TextColumn::make('tipoDocumento.nombre'),
                Tables\Columns\TextColumn::make('url'),
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
