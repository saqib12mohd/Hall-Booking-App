<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdditionalServeResource\Pages;
use App\Filament\Resources\AdditionalServeResource\RelationManagers;
use App\Models\AdditionalServe;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use illuminate\Support\Str;

class AdditionalServeResource extends Resource
{
    protected static ?string $model = AdditionalServe::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';


    protected static ?string $navigationLabel = 'Additional Service';

    protected static ?string $navigationGroup = 'Infromation Entry';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                ->schema([

                    Section::make()
                    ->schema([


                        TextInput::make('name')
                        ->placeholder('Enter Additional Servers Name')
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur:true)
                        ->afterStateUpdated(function($set,  $state)
                        {
                            $set('slug',Str::slug($state));
                        }),

                        TextInput::make('slug')
                        ->readOnly()
                        ->maxLength(255),

                        TextInput::make('rate')
                        ->numeric()
                        ->required(),

                        TextInput::make('unit')
                        ->numeric()
                        ->required(),

                    ])->columns(3),

                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('rate')
                    ->numeric()
                    ->sortable(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAdditionalServes::route('/'),
            'create' => Pages\CreateAdditionalServe::route('/create'),
            'edit' => Pages\EditAdditionalServe::route('/{record}/edit'),
        ];
    }
}
