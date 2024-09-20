<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventoResource\Pages;
use App\Filament\Resources\EventoResource\RelationManagers;
use App\Models\Evento;
use App\Models\Organizadores;
use App\Models\Patrocinadores;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\MultiSelect;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Illuminate\Support\Str;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Set;
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

    protected static ?string $navigationIcon = 'heroicon-o-calendar-date-range';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //segmento 
                Section::make('Informacion de  Evento')->schema(
                    [
                        TextInput::make('nombre_evento')
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
                            ->unique(Evento::class, 'slug', ignoreRecord: true),
                        TextInput::make('tipo_evento')
                            ->placeholder('Charla /Congreso/Conferencia')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('area_evento')
                            ->required()
                            ->placeholder('Sistemas /Mecanica/Bio Sistemas o General')
                            ->maxLength(255),
                        // Relación con Organizadores (Muchos a muchos)
                        Forms\Components\Select::make('organizadores')
                            ->label('Organizadores')
                            ->multiple() // Permite seleccionar múltiples organizadores
                            ->relationship('organizadores', 'nombre') // Relación
                            ->createOptionForm([ // Crear organizadores en el momento
                                Group::make()->schema(
                                    [
                                        //segmento 
                                        Section::make('Informacion del Organizador')->schema(
                                            [
                                                TextInput::make('nombre')
                                                    ->required()

                                                    ->maxLength(255),

                                                TextInput::make('correo_electronico')
                                                    ->email()
                                                    ->required(),
                                                TextInput::make('telefono')
                                                    ->tel()
                                                    ->required(),
                                            ]
                                        )->columns(2),
                                    ]
                                )->columnSpan(2),


                                Section::make('Descripcion del Organizador')->schema(
                                    [
                                        Textarea::make('biografia_breve')
                                            ->required(),
                                        FileUpload::make('imagen')
                                            ->image()
                                            ->disk('public')
                                            ->directory('imagen_organizador')
                                            ->visibility('private'),
                                    ]
                                )->columnSpan(2),

                            ])
                            ->required(),

                        // Relación con Patrocinadores (Muchos a muchos)
                        Forms\Components\Select::make('patrocinadores')
                            ->label('Patrocinadores')
                            ->multiple() // Permite seleccionar múltiples patrocinadores
                            ->relationship('patrocinadores', 'nombre') // Relación
                            ->createOptionForm([ // Crear patrocinadores en el momento
                                Group::make()->schema(
                                    [
                                        //segmento 
                                        Section::make('Informacion del Patrocinador')->schema(
                                            [
                                                TextInput::make('nombre')
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
                                                    ->unique(Patrocinadores::class, 'slug', ignoreRecord: true),

                                                TextInput::make('correo_electronico')
                                                    ->email()
                                                    ->required(),
                                            ]
                                        )->columnSpan(2),
                                        Section::make('Descripcion del patrocinador')->schema(
                                            [

                                                Textarea::make('biografia_breve')
                                                    ->required(),
                                                FileUpload::make('imagen')
                                                    ->image()
                                                    ->disk('public')
                                                    ->directory('imagen_patrocinador')
                                                    ->visibility('private'),
                                            ]
                                        ),

                                    ]
                                ),
                            ])
                            ->required(),

                    ]
                )->columns(2),
                Section::make('Descripcion del Evento')->schema(
                    [
                        Forms\Components\Select::make('tematicas')
                            ->label('Tematica')
                            ->multiple() // Permite seleccionar múltiples organizadores
                            ->relationship('tematicas', 'nombre') // Relación
                            ->createOptionForm([ // Crear organizadores en el momento
                                Group::make()->schema(
                                    [
                                        //segmento 
                                        Section::make('Informacion del Temática')->schema(
                                            [
                                                TextInput::make('nombre')
                                                    ->required()
                                                    ->maxLength('255')
                                                    ->label('Nombre'),
                                                Textarea::make('descripcion')
                                                    ->required()
                                                    ->maxLength('255')
                                                    ->label('Descripcion'),
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
                        Forms\Components\Select::make('partners')
                            ->label('Partners')
                            ->multiple() // Permite seleccionar múltiples organizadores
                            ->relationship('partners', 'nombre') // Relación
                            ->createOptionForm([ // Crear organizadores en el momento
                                Group::make()->schema(
                                    [
                                        //segmento 
                                        Section::make('Informacion del Partners')->schema(
                                            [
                                                TextInput::make('nombre')
                                                    ->required()
                                                    ->maxLength('255')
                                                    ->label('Ingrese el nombre')->columnSpanFull(),
                                                FileUpload::make('img')
                                                    ->image()
                                                    ->disk('public')
                                                    ->directory('imagen_partners')
                                                    ->visibility('private')->columnSpanFull(),
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

                        Textarea::make('descripcion_breve')
                            ->required(),
                        FileUpload::make('imagen_banner')
                            ->image()
                            ->disk('public')
                            ->visibility('private')
                            ->directory('eventos'), // Tamaño máximo en kilobytes, en este caso 2MB.

                        FileUpload::make('imagen_catalogo')
                            ->image()
                            ->disk('public')
                            ->visibility('private')
                            ->directory('eventos'),
                        // Tamaño máximo en kilobytes, en este caso 2MB.
                        /* FileUpload::make('video_banner')
                    ->disk('public')
                    ->directory('eventos')
                    ->video(), */
                        TextInput::make('enlace_inscripcion')
                            ->label('Enlace para el en vivo')
                            ->url()
                            ->required(),
                    ]
                )->columnSpan(2),

                Group::make()->schema(
                    [
                        //segmento 
                        Section::make('Otra Informacion')->schema(
                            [
                                Forms\Components\Select::make('precios')
                                    ->label('Precio')
                                    ->multiple() // Permite seleccionar múltiples organizadores
                                    ->relationship('precios', 'tipo_asistente') // Relación
                                    ->createOptionForm([ // Crear organizadores en el momento
                                        Group::make()->schema(
                                            [
                                                //segmento 
                                                Section::make('Informacion del Precio')->schema(
                                                    [
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

                                DatePicker::make('fecha_inicio')
                                    ->required(),
                                DatePicker::make('fecha_fin')
                                    ->required(),
                                TimePicker::make('hora_inicio')
                                    ->required(),
                                TimePicker::make('hora_salida')
                                    ->required(),

                                Forms\Components\Select::make('lugares')
                                    ->label('Lugar')
                                    ->multiple()
                                    ->relationship('lugares', 'nombrelugar')
                                    ->createOptionForm([
                                        Group::make()->schema(
                                            [
                                                Section::make('Informacion del Lugar')->schema(
                                                    [
                                                        TextInput::make('nombrelugar')
                                                            ->required()
                                                            ->maxLength(255),
                                                        TextInput::make('lema-ciudad')
                                                            ->required()
                                                            ->maxLength('255'),
                                                        TextInput::make('direccion')
                                                            ->email()
                                                            ->required(),
                                                        TextInput::make('url_mapa')
                                                            ->url()
                                                            ->required(),
                                                        FileUpload::make('img')
                                                            ->image()
                                                            ->disk('public')
                                                            ->directory('imagen_lugarevento')
                                                            ->visibility('private'),
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


            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make(
                    [ // botones que se necesitan para editar  y elimnar 
                        Tables\Actions\EditAction::make(),
                        Tables\Actions\ViewAction::make(),
                        Tables\Actions\DeleteAction::make(),
                    ]
                )
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
