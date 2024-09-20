<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatrocinadoresResource\Pages;
use App\Filament\Resources\PatrocinadoresResource\RelationManagers;
use App\Models\Patrocinadores;
use Filament\Forms;
use Illuminate\Support\Str;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Set;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PatrocinadoresResource extends Resource
{
    protected static ?string $model = Patrocinadores::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Group::make()->schema(
                    [
                        //segmento 
                        Section::make('Informacion de  Ponente')->schema(
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
                        )->columns(2),
                        Section::make('Descripcion del Patrocinador')->schema(
                            [

                                Textarea::make('biografia_breve')
                                    ->required(),
                                FileUpload::make('imagen')
                                    ->image()
                                    ->disk('public')
                                    ->directory('imagen_patrocinador')
                                    ->visibility('private'),
                            ]
                        )->columnSpan(2),
                    ]
                )->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('nombre')->sortable()->searchable(),
            ImageColumn::make('imagen')->label('Foto'),
            TextColumn::make('correo_electronico')->sortable()->searchable(),
            TextColumn::make('biografia_breve')
            ->sortable()->searchable()
            ->limit(30),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePatrocinadores::route('/'),
        ];
    }
}
