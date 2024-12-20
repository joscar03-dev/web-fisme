<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ResgistroResource\Pages;
use App\Filament\Resources\ResgistroResource\Pages\TicketQrPage;
use App\Filament\Resources\ResgistroResource\RelationManagers;
use App\Models\Resgistro;
use Filament\Actions\ExportAction;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Validation\Rule;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class ResgistroResource extends Resource
{
    protected static ?string $model = Resgistro::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    public static function getNavigationBadgeColor(): string|array|null
    {
        return static::getModel()::count() > 10 ? 'success' : 'danger';
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema(
                    [
                        //segmento
                        Section::make('Informacion de  Asistente')->schema(
                            [
                                Select::make('tipo_documento')
                                    ->label('Tipo Documento')
                                    ->options([
                                        'DNI' => 'DNI',
                                        'CE' => 'CE',
                                        'Pasaporte' => 'Pasaporte',
                                    ])
                                    ->required(),
                                Forms\Components\TextInput::make('numero_documento')
                                    ->required()
                                    ->rule(function ($get) {
                                        return Rule::unique('registros', 'numero_documento')
                                            ->ignore($get('id')); // Ignorar el registro actual
                                    })
                                    ->validationAttribute('número de documento')
                                    ->maxLength(15)
                                    ->reactive()
                                    ->validationMessages([
                                        'unique' => 'El número de documento ya ha sido registrado.',
                                    ]),
                                TextInput::make('nombres')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('apellidos')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('numero_celular')
                                    ->required()
                                    ->maxLength(9),
                                TextInput::make('email')
                                    ->label('Correo Electronico')
                                    ->email()
                                    ->required()
                                    ->maxLength(255),
                                Select::make('tipo')
                                    ->label('Tipo Venta ')
                                    ->options([
                                        'normal' => 'Venta Normal',
                                        'preventa' => 'Preventa',

                                    ]),
                                Select::make('modalidad')
                                    ->label('Modalidad')
                                    ->options([
                                        'Online' => 'Online',
                                        'Presencial' => 'Presencial',

                                    ]),

                            ]
                        )->columns(2),
                        Section::make('Descripcion del Evento')->schema(
                            [
                                Select::make('evento_id')
                                    ->label('Evento')
                                    ->relationship('evento', 'nombre_evento')
                                    ->searchable()
                                    ->required(),

                                Select::make('tipo_asistente')
                                    ->label('Tipo de Asistente')
                                    ->options([
                                        'ESTUDIANTE FISME' => 'ESTUDIANTE FISME',
                                        'DOCENTE FISME' => 'DOCENTE FISME',
                                        'EGRESADO FISME' => 'EGRESADO FISME',
                                        'DOCENTE UNTRM' => 'DOCENTE UNTRM',
                                        'PÚBLICO GENERAL - ESTUDIANTE' => 'PUBLICO GENERAL - ESTUDIANTE',
                                        'PÚBLICO GENERAL - PROFESIONAL' => 'PUBLICO GENERAL - PROFESIONAL',
                                    ])
                                    ->required(),
                                TextInput::make('institucion_procedencia')
                                    ->placeholder('Institucion Procedencia')

                                    ->maxLength(255),
                                FileUpload::make('img_boucher')
                                    ->image()
                                    ->disk('public')
                                    ->directory('registro')
                                    ->openable()
                                    ->downloadable()
                                    ->visibility('private'),
                                Forms\Components\Toggle::make('verificado')
                                    ->label('Inscripción Verficada')
                                    ->default(false)
                                    ->required(),
                                Forms\Components\Toggle::make('estado')
                                    ->label('Estado')
                                    ->default(true)
                                    ->required(),
                            ]
                        )->columnSpan(2),
                        Section::make('Informacion de Pago')->schema([
                            TextInput::make('entidad_financiera')
                                ->label('Entidad Financiera'),

                            DatePicker::make('fecha_pago')
                                ->label('Fecha de Pago'),

                            TextInput::make('n_comprobante')
                                ->label('Número de Comprobante'),
                            TextInput::make('monto')
                                ->numeric()
                                ->label('Monto'),
                        ])->columns(4)
                    ]
                )->columnSpan(2),
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('nombres')
                    ->searchable(),
                Tables\Columns\TextColumn::make('apellidos')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('numero_documento')
                    ->searchable(),
                Tables\Columns\TextColumn::make('institucion_procedencia'),
                Tables\Columns\TextColumn::make('tipo_asistente'),
                Tables\Columns\TextColumn::make('entidad_financiera'),
                Tables\Columns\IconColumn::make('verificado')
                    ->boolean(),
                Tables\Columns\IconColumn::make('estado')
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Action::make('viewTicket')
                    ->label('Ticket')
                    ->icon('heroicon-o-finger-print') // Puedes cambiar el icono
                    ->url(fn(Resgistro $record) => route('filament.admin.resources.resgistros.ticket-qr', $record)) // Genera la URL
                    ->color('primary'), // Opcional: Cambiar el color del botón
                Tables\Actions\ActionGroup::make(
                    [ // botones que se necesitan para editar  y elimnar
                        Tables\Actions\EditAction::make(),
                        Tables\Actions\ViewAction::make(),
                        Tables\Actions\DeleteAction::make(),
                    ]
                )

            ])
            ->bulkActions([
                BulkActionGroup::make([
                    // Acción de eliminar en bloque
                    DeleteBulkAction::make(),

                    // Acción de exportación en bloque
                    ExportBulkAction::make()
                        ->exports([
                            ExcelExport::make()
                                ->fromModel(Resgistro::class)  // Aquí trabajamos con el modelo
                                ->modifyQueryUsing(fn($query) => $query->orderBy('apellidos', 'asc'))  // Aplica el orden
                                ->except([  // Excluye las columnas no deseadas
                                    'created_at',
                                    'updated_at',
                                    'id',
                                    'img_boucher',
                                    'estado',
                                    'verificado',
                                    'fecha_pago',
                                    'n_comprobante',
                                    'monto',
                                    'usuario_verificacion',
                                    'slug',
                                ])
                                ->withFilename(fn($resource) => 'registro-' . date('Y-m-d'))
                        ])
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageResgistros::route('/'),
            'ticket-qr' => TicketQrPage::route('/ticket-qr/{record}'), // Ruta para la página del ticket QR
        ];
    }
}
