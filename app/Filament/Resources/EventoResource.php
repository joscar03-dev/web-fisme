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
                        Textarea::make('descripcion_breve')
                            ->required(),
                        FileUpload::make('imagen_banner')
                            ->image()
                            ->disk('public')
                            ->visibility('private')
                            ->directory('eventos')
                           , // Tamaño máximo en kilobytes, en este caso 2MB.

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
                            ->url()
                            ->required(),
                    ]
                )->columnSpan(2),

                Group::make()->schema(
                    [
                        //segmento 
                        Section::make('Otra Informacion')->schema(
                            [
                                TextInput::make('precio_inscripcion')
                                    ->numeric()
                                    ->required(),

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
