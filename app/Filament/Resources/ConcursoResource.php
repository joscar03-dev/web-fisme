<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ConcursoResource\Pages;
use App\Filament\Resources\ConcursoResource\RelationManagers;
use App\Models\Concurso;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ConcursoResource extends Resource
{
    protected static ?string $model = Concurso::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true), // Para garantizar que el slug sea único

                Forms\Components\TextInput::make('tipo_concurso')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Textarea::make('descripcion')
                    ->required(),

                Forms\Components\DatePicker::make('fecha_inicio')
                    ->required(),

                Forms\Components\DatePicker::make('fecha_fin')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('slug')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('tipo_concurso')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('fecha_inicio')
                    ->date(),

                Tables\Columns\TextColumn::make('fecha_fin')
                    ->date(),
            ])
            ->filters([
                // Puedes agregar filtros si deseas
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListConcursos::route('/'),
            'create' => Pages\CreateConcurso::route('/create'),
            'edit' => Pages\EditConcurso::route('/{record}/edit'),
        ];
    }
}
