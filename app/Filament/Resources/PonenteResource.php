<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PonenteResource\Pages;
use App\Filament\Resources\PonenteResource\RelationManagers;
use App\Models\Ponente;
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

class PonenteResource extends Resource
{
    protected static ?string $model = Ponente::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema(
                    [
                        //segmento 
                        Section::make('Informacion de  Ponente')->schema(
                            [
                                TextInput::make('nombre')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('apellidos')
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
              
                Group::make()->schema(
                    [
                        //segmento 
                        Section::make('Otra Informacion')->schema(
                            [
                                TextInput::make('especialidad')
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('institucion')
                                    ->required()
                                    ->maxLength(255),

                            ]
                        )->columnSpanFull(),


                    ]
                )->columnSpan(1),
                Section::make('Descripcion del Ponente')->schema(
                    [
                        Textarea::make('biografia_breve')
                            ->required(),
                        FileUpload::make('imagen')
                            ->image()
                            ->disk('public')
                            ->directory('imagen_ponente')
                            ->visibility('private'),
                    ]
                    )->columnSpan(3),


            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nombre')->sortable()->searchable(),
                TextColumn::make('apellidos')->sortable()->searchable(),
                TextColumn::make('especialidad')->sortable()->searchable(),
                ImageColumn::make('imagen')->label('Foto'),
                TextColumn::make('institucion')->sortable()->searchable(),
                TextColumn::make('correo_electronico')->sortable()->searchable(),
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
            'index' => Pages\ListPonentes::route('/'),
            'create' => Pages\CreatePonente::route('/create'),
            'edit' => Pages\EditPonente::route('/{record}/edit'),
        ];
    }
}
