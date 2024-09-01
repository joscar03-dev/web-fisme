<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TemasResource\Pages;
use App\Filament\Resources\TemasResource\RelationManagers;
use App\Models\Temas;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Date;

class TemasResource extends Resource
{
    protected static ?string $model = Temas::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema(
                    [
                        //segmento 
                        Section::make('Informacion de  Tema')->schema(
                            [
                                TextInput::make('nombre_tema')
                                    ->required()
                                    ->maxLength(255),
                                Select::make('ponente_id')
                                    ->label('Ponente')
                                    ->relationship('ponente', 'nombre')
                                    ->required(),

                            ]
                        )->columns(2),
                        Section::make('Descripcion del Tema')->schema(
                            [
                                Textarea::make('descripcion_tema')
                                    ->required(),
                            ]
                        )->columnSpan(2),
                    ]
                )->columnSpan(2),

                Group::make()->schema(
                    [
                        //segmento 
                        Section::make('Otra Informacion')->schema(
                            [
                                DatePicker::make('fecha')
                                    ->required(),
                                TimePicker::make('hora_inicio')
                                    ->required(),
                                TimePicker::make('hora_fin')
                                    ->required(),

                            ]
                        )->columnSpanFull(),


                    ]
                )->columnSpan(1),
                


            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nombre_tema')->sortable()->searchable(),
                TextColumn::make('fecha')->sortable(),
                TextColumn::make('hora_inicio'),
                TextColumn::make('hora_fin'),
                TextColumn::make('ponente.nombre')->label('Ponente'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListTemas::route('/'),
            'create' => Pages\CreateTemas::route('/create'),
            'edit' => Pages\EditTemas::route('/{record}/edit'),
        ];
    }
}
