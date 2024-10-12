<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TipoDocumentoResource\Pages;
use App\Filament\Resources\TipoDocumentoResource\RelationManagers;
use App\Models\TipoDocumento;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TipoDocumentoResource extends Resource
{
    protected static ?string $model = TipoDocumento::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-arrow-up';
    protected static ?string $navigationGroup = 'Concurso';
    protected static ?int $navigationSort = 3;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nombre')
                    ->required()
                    ->maxLength(255),
                Select::make('tipo_documento')
                    ->required()
                    ->options([
                        'PPTX' => 'PPTX',
                        'PDF' => 'PDF',
                        'DOC' => 'DOC',

                    ]),
                Forms\Components\Toggle::make('estado')
                    ->label('Estado')
                    ->default(true)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('nombre')
                ->sortable()
                ->searchable(),
                TextColumn::make('tipo_documento')
                ->sortable()
                ->searchable(),
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
            'index' => Pages\ManageTipoDocumentos::route('/'),
        ];
    }
}
