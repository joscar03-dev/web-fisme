<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PrecioConcursoResource\Pages;
use App\Filament\Resources\PrecioConcursoResource\RelationManagers;
use App\Models\PrecioConcurso;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PrecioConcursoResource extends Resource
{
    protected static ?string $model = PrecioConcurso::class;
    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationGroup = 'Concurso';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('concurso_id')
                    ->label('Elige concurso')
                    ->relationship('concurso', 'nombre',) // Relación
                    ->required(),

                Select::make('tipo_participante')
                    ->label('Tipo de Asistente')
                    ->options([
                        'Estudiante' => 'Estudiante'
                    ])
                    ->required(),
                TextInput::make('precio')
                    ->numeric()
                    ->required(),
                Forms\Components\Toggle::make('gratis')
                    ->label('Este tipo es gratis')
                    ->default(false)
                    ->required(),
                Forms\Components\Toggle::make('estado')
                    ->label('Estado')
                    ->default(true)
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('concurso.nombre')
                    ->sortable()
                    ->limit(30)
                    ->searchable(),
                TextColumn::make('tipo_participante')
                    ->sortable(),
                TextColumn::make('precio')
                    ->sortable(),


                Tables\Columns\IconColumn::make('gratis')
                    ->boolean(),
                Tables\Columns\IconColumn::make('estado')
                    ->boolean(),
            ])
            ->filters([
                //
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePrecioConcursos::route('/'),
        ];
    }
}
