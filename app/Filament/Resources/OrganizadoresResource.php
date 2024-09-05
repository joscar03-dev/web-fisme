<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrganizadoresResource\Pages;
use App\Filament\Resources\OrganizadoresResource\RelationManagers;
use App\Models\Organizadores;
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

class OrganizadoresResource extends Resource
{
    protected static ?string $model = Organizadores::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-library';

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

                                TextInput::make('correo_electronico')
                                    ->email()
                                    ->required(),
                                TextInput::make('telefono')
                                    ->tel()
                                    ->required(),
                            ]
                        )->columns(3),
                    ]
                )->columnSpan(3),


                Section::make('Descripcion del Ponente')->schema(
                    [
                        Textarea::make('biografia_breve')
                            ->required(),
                        FileUpload::make('imagen')
                            ->image()
                            ->disk('public')
                            ->directory('imagen_organizador')
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
                ImageColumn::make('imagen')->label('Foto'),
                TextColumn::make('correo_electronico')->sortable()->searchable(),
                TextColumn::make('telefono')->sortable()->searchable(),
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
            'index' => Pages\ListOrganizadores::route('/'),
            'create' => Pages\CreateOrganizadores::route('/create'),
            'edit' => Pages\EditOrganizadores::route('/{record}/edit'),
        ];
    }
}
