<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventoResource\Pages;
use App\Filament\Resources\EventoResource\RelationManagers;
use App\Models\Evento;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EventoResource extends Resource
{
    protected static ?string $model = Evento::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            
                        //segmento 
                        Section::make('Informacion de  Evento')->schema(
                            [
                                TextInput::make('nombre_evento')
                                    ->required()
                                    ->maxLength(255),
                                Select::make('tema_id')
                                    ->relationship('tema', 'nombre_tema')
                                    ->required(),
                                TextInput::make('tipo_evento')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('area_evento')
                                    ->required()
                                    ->maxLength(255),
                                Select::make('organizador_id')
                                    ->relationship('organizador', 'nombre')
                                    ->required(),
                                TextInput::make('precio_inscripcion')
                                    ->numeric()
                                    ->required(),
                            ]
                        )->columns(2),
                        Section::make('Descripcion del Evento')->schema(
                            [
                                Textarea::make('descripcion_breve')
                                    ->required(),
                                FileUpload::make('imagen_banner')
                                    ->image()
                                    ->disk('public')
                                    ->visibility('private')
                                    ->directory('eventos'),

                                FileUpload::make('imagen_catalogo')
                                    ->image()
                                    ->disk('public')
                                    ->visibility('private')
                                    ->directory('eventos'),
                                /* FileUpload::make('video_banner')
                    ->disk('public')
                    ->directory('eventos')
                    ->video(), */
                                TextInput::make('enlace_inscripcion')
                                    ->url()
                                    ->required(),
                            ]
                        )->columnSpan(2),
                   
                Group::make()->schema(
                    [
                        //segmento 
                        Section::make('Otra Informacion')->schema(
                            [

                                DatePicker::make('fecha_inicio')
                                    ->required(),
                                DatePicker::make('fecha_fin')
                                    ->required(),
                                TimePicker::make('hora_inicio')
                                    ->required(),
                                TimePicker::make('hora_salida')
                                    ->required(),
                                TextInput::make('lugar')
                                    ->required()
                                    ->maxLength(255),

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
                TextColumn::make('nombre_evento')->sortable()->searchable(),
                TextColumn::make('fecha_inicio')->sortable(),
                TextColumn::make('fecha_fin')->sortable(),
                ImageColumn::make('imagen_banner'),
                TextColumn::make('tipo_evento')->sortable()->searchable(),
                TextColumn::make('organizador.nombre')->label('Organizador'),
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
            'index' => Pages\ListEventos::route('/'),
            'create' => Pages\CreateEvento::route('/create'),
            'edit' => Pages\EditEvento::route('/{record}/edit'),
        ];
    }
}
