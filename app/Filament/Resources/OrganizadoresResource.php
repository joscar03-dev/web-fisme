<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrganizadoresResource\Pages;
use App\Filament\Resources\OrganizadoresResource\RelationManagers;
use App\Models\Organizadores;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
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

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nombre')
                    ->required()
                    ->maxLength(255),
                FileUpload::make('imagen')
                    ->image()
                    ->disk('public')
                    ->directory('imagen_organizador')
                    ->visibility('private'),
                TextInput::make('correo_electronico')
                    ->email()
                    ->required(),
                TextInput::make('telefono')
                    ->tel()
                    ->required(),
                Textarea::make('biografia_breve')
                    ->required(),
            ]);
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
            'index' => Pages\ListOrganizadores::route('/'),
            'create' => Pages\CreateOrganizadores::route('/create'),
            'edit' => Pages\EditOrganizadores::route('/{record}/edit'),
        ];
    }
}
