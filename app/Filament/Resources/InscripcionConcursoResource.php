<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InscripcionConcursoResource\Pages;
use App\Filament\Resources\InscripcionConcursoResource\RelationManagers;
use App\Filament\Resources\InscripcionConcursoResource\RelationManagers\DocumentosInscripcionRelationManager;
use App\Models\InscripcionConcurso;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Validation\Rule;

class InscripcionConcursoResource extends Resource
{
    protected static ?string $model = InscripcionConcurso::class;
    protected static ?string $navigationGroup = 'Concurso';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationIcon = 'heroicon-o-inbox-stack';

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
                        return Rule::unique('inscripcion_concursos', 'numero_documento')
                            ->ignore($get('id')); // Ignorar el registro actual
                    })
                    ->maxLength(15),
                Forms\Components\TextInput::make('nombres')
                    ->maxLength(255),
                Forms\Components\TextInput::make('apellidos')
                    ->maxLength(255),
                Forms\Components\TextInput::make('numero_celular')
                    ->maxLength(20),
                Select::make('tipo_participante')
                    ->label('Tipo Participante')
                    ->options([
                        'ESTUDIANTE' => 'ESTUDIANTE',
                        'PROFESIONAL' => 'PROFESIONAL',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('institucion_procedencia')
                    ->maxLength(20),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->maxLength(255),
                FileUpload::make('img_boucher')
                    ->image()
                    ->disk('public')
                    ->directory('bouchers_concursos')
                    ->openable()
                    ->downloadable()
                    ->visibility('private'),
                Select::make('concurso_id')
                    ->label('Concurso')
                    ->relationship('concurso', 'nombre')
                    ->required(),
                Forms\Components\DateTimePicker::make('fecha_registro')
                    ->default(now())
                    ->disabled()
                    ->label('Fecha de Registro'),
                Forms\Components\Toggle::make('verificado')
                    ->label('Verificado')
                    ->reactive()// Escucha cambios en tiempo real
                    ->afterStateUpdated(function (callable $set, $state) {
                        if ($state) {
                            $set('usuario_verificacion', auth()->user()->id); // Asignar usuario al activarlo
                            $set('fecha_verificacion', now()); // Asignar fecha actual
                        } else {
                            $set('usuario_verificacion', null); // Limpiar usuario si se desactiva
                            $set('fecha_verificacion', null); // Limpiar fecha si se desactiva
                        }
                    }),
                Forms\Components\DateTimePicker::make('fecha_verificacion')
                    ->label('Fecha Verificación')
                    ->default(null)
                    ->disabled(),
                Forms\Components\Toggle::make('estado'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tipo_documento')
                    ->searchable(),
                Tables\Columns\TextColumn::make('numero_documento')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nombres')
                    ->searchable(),
                Tables\Columns\TextColumn::make('apellidos')
                    ->searchable(),
                Tables\Columns\TextColumn::make('numero_celular')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tipo_participante')
                    ->searchable(),
                Tables\Columns\TextColumn::make('institucion_procedencia')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('img_boucher')
                    ->searchable(),
                Tables\Columns\TextColumn::make('concurso.nombre')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('fecha_registro')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\IconColumn::make('verificado')
                    ->boolean(),
                Tables\Columns\TextColumn::make('usuarioVerificacion.name')
                    ->label('Usuario Verificación')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('fecha_verificacion')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\IconColumn::make('estado')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            DocumentosInscripcionRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInscripcionConcursos::route('/'),
            'create' => Pages\CreateInscripcionConcurso::route('/create'),
            'edit' => Pages\EditInscripcionConcurso::route('/{record}/edit'),
        ];
    }
}
