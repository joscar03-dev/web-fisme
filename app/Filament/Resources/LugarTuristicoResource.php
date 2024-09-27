<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LugarTuristicoResource\Pages;
use App\Filament\Resources\LugarTuristicoResource\RelationManagers;
use App\Models\LugarTuristico;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LugarTuristicoResource extends Resource
{
    protected static ?string $model = LugarTuristico::class;

    protected static ?string $navigationIcon = 'heroicon-o-map';
    protected static ?string $navigationGroup = 'Ubicación';
    protected static ?int $navigationSort = 2;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema(
                    [

                        Section::make('Informacion del lugar del evento')->schema(
                            [
                                Forms\Components\Select::make('lugar_evento_id')
                                    ->label('Lugar del evento')
                                    ->relationship('lugareventos', 'nombrelugar',)
                                    ->required(),

                                TextInput::make('nombre_lugar')
                                    ->required()

                                    ->maxLength(255),
                                Textarea::make('descripcion-corta')
                                    ->required()

                                    ->maxLength('255'),


                                TextInput::make('direccion')
                                    ->maxLength('255')
                                    ->required(),
                                TextInput::make('url_mapa')
                                    ->url()
                                    ->required(),
                            ]
                        )->columns(3),
                    ]
                )->columnSpan(3),


                Section::make('Descripcion del los luagares turisticos')->schema(
                    [

                        FileUpload::make('img')
                            ->image()
                            ->disk('public')
                            ->directory('imagen_lugarturisticos')
                            ->visibility('private'),
                        Forms\Components\Toggle::make('estado')
                            ->label('Estado')
                            ->default(true)
                            ->required(),
                    ]
                )->columnSpan(3),


            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nombre_lugar')
                    ->sortable()
                    ->searchable()
                    ->limit(50),
                TextColumn::make('direccion')
                    ->sortable()
                    ->searchable(),

                ImageColumn::make('img')->label('Foto'),
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
            'index' => Pages\ManageLugarTuristicos::route('/'),
        ];
    }
}
