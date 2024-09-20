<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PrecioResource\Pages;
use App\Filament\Resources\PrecioResource\RelationManagers;
use App\Models\Precio;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PrecioResource extends Resource
{
    protected static ?string $model = Precio::class;

    protected static ?string $navigationIcon = 'heroicon-s-currency-dollar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Select::make('tipo_asistente')
                    ->required()
                    ->options([
                        'ESTUDIANTE FISME' => 'ESTUDIANTE FISME',
                        'DOCENTE FISME' => 'DOCENTE FISME',
                        'EGRESADO FISME' => 'EGRESADO FISME',
                        'DOCENTE UNTRM' => 'DOCENTE UNTRM',
                        'PÚBLICO GENERAL - ESTUDIANTE' => 'PÚBLICO GENERAL - ESTUDIANTE',
                        'PÚBLICO GENERAL - PROFESIONAL' => 'PÚBLICO GENERAL - PROFESIONAL',

                    ]),
                TextInput::make('precio')
                    ->numeric()
                    ->required()
                    ->label('Precio'),
                Forms\Components\Select::make('beneficios')
                    ->label('Beneficios')
                    ->multiple() // Permite seleccionar múltiples organizadores
                    ->relationship('beneficios', 'nombre') // Relación
                    ->createOptionForm([ // Crear organizadores en el momento
                        Group::make()->schema(
                            [
                                //segmento 
                                Section::make('Informacion del Beneficios')->schema(
                                    [
                                        TextInput::make('nombre')
                                            ->required()
                                            ->maxLength('255')
                                            ->label('Nombre'), 
                                        Forms\Components\Toggle::make('estado')
                                            ->label('Estado')
                                            ->default(true)
                                            ->required(),

                                    ]
                                )->columns(2),
                            ]
                        )->columnSpan(2),
                    ])
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
                //
                TextColumn::make('tipo_asistente')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('precio')
                    ->sortable()
                    ->searchable(),
                // Ajusta el ancho en píxeles
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
            'index' => Pages\ManagePrecios::route('/'),
        ];
    }
}
