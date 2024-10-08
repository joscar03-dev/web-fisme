<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ConcursoResource\Pages;
use App\Filament\Resources\ConcursoResource\RelationManagers;
use App\Models\Concurso;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Set;
use Illuminate\Support\Str;
use Filament\Forms\Components\TextInput;
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
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn(string $operation, $state, Set $set)
                    => $operation === 'create' ? $set('slug', Str::slug($state)) : null)
                    ->maxLength(255),
                TextInput::make('slug')
                    ->required()
                    ->disabled()
                    ->maxLength('255')
                    ->dehydrated()
                    ->unique(Concurso::class, 'slug', ignoreRecord: true),
                Select::make('tipo_concurso')
                    ->required()
                    ->options([
                        'Investigacion' => 'Investigacion',
                    ]),
                Forms\Components\DatePicker::make('fecha_inicio')
                    ->required(),

                Forms\Components\DatePicker::make('fecha_fin')
                    ->required(),
                RichEditor::make('descripcion')
                    ->label('Descripción')
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'underline',
                        'strike',
                        'bulletList',
                        'orderedList',
                        'link',
                        'codeBlock',
                        'blockquote',
                        'h2',
                        'h3',
                        'undo',
                        'redo',
                    ])
                    ->required()
                    ->placeholder('Escribe aquí una descripción...')
                    ->columnSpan('full'),

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
