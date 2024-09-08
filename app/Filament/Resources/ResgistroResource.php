<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ResgistroResource\Pages;
use App\Filament\Resources\ResgistroResource\Pages\TicketQrPage;
use App\Filament\Resources\ResgistroResource\RelationManagers;
use App\Models\Resgistro;
use Filament\Forms;
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

class ResgistroResource extends Resource
{
    protected static ?string $model = Resgistro::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

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
                                TextInput::make('numero_documento')
                                    ->required()
                                    ->maxLength(20),
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
                                        'Estudiante' => 'Estudiante',
                                        'Profesional' => 'Profesional',
                                        'Publico General' => 'Público General',
                                    ])
                                    ->required(),
                                TextInput::make('institucion_procedencia')
                                    ->placeholder('Institucion Procedencia')
                                    ->required()
                                    ->maxLength(255),
                                FileUpload::make('img_boucher')
                                    ->image()
                                    ->disk('public')
                                    ->directory('registro')
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
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('numero_documento')
                    ->searchable(),
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
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
