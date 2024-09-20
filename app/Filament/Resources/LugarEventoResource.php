<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LugarEventoResource\Pages;
use App\Filament\Resources\LugarEventoResource\RelationManagers;
use App\Models\LugarEvento;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LugarEventoResource extends Resource
{
    protected static ?string $model = LugarEvento::class;

    protected static ?string $navigationIcon = 'heroicon-o-globe-americas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema(
                    [
                        //segmento 
                        Section::make('Informacion del lugar del evento')->schema(
                            [
                                TextInput::make('nombrelugar')
                                    ->required()

                                    ->maxLength(255),
                                TextInput::make('lema-ciudad')
                                    ->required()
                                    ->maxLength('255'),
                                TextInput::make('direccion')
                                    ->maxLength(255)
                                    ->required(),
                                TextInput::make('url_mapa')
                                    ->url()
                                    ->required(),
                            ]
                        )->columns(3),
                    ]
                )->columnSpan(3),


                Section::make('Descripcion del Lugar del Evento')->schema(
                    [

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
                )->columnSpan(3),


            ])->columns(3);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nombrelugar')
                    ->sortable()
                    ->searchable()
                    ->limit(50),
                TextColumn::make('direccion')
                    ->sortable()
                    ->searchable()
                    ->limit(20),

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
            'index' => Pages\ManageLugarEventos::route('/'),
        ];
    }
}
