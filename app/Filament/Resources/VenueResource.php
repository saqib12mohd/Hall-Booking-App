<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VenueResource\Pages;
use App\Filament\Resources\VenueResource\RelationManagers;
use App\Models\Amenity;
use App\Models\Venue;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\Relationship;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use illuminate\Support\Str;

use function Livewire\wrap;

class VenueResource extends Resource
{
    protected static ?string $model = Venue::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    protected static ?string $navigationLabel = 'Venue';

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
                        ->placeholder('Enter Hall Name')
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

                    ])->columns(2),

                    Section::make()
                    ->schema([

                        Select::make('taluk_id')
                        ->Relationship('taluk','name')
                        ->required(),

                        Select::make('district_id')
                        ->relationship('district','name')
                            ->required(),



                        Select::make('test')
                        ->options(Amenity::all()->pluck('name','id'))
                        ->multiple()
                        ->preload(),

                        TextInput::make('pincode')
                        ->placeholder('Enter Pin Code')
                            ->maxLength(255)
                            ->numeric(),

                        TextInput::make('address')
                        ->placeholder('Enter Address')
                            ->maxLength(255),

                        TextInput::make('landmark')
                        ->placeholder('Enter Land Mark')
                            ->maxLength(255),

                        TextInput::make('gmap')
                        ->label('Google Map Location')
                        ->placeholder('Enter Google Map Location')
                            ->maxLength(255),

                    ])->columns(3),




                        // TextInput::make('city')
                        //     ->maxLength(255),



                        // TextInput::make('avaiable')
                        //     ->maxLength(255),

                        Section::make()
                        ->schema([

                            TextInput::make('rate')
                        ->placeholder('Enter Rate')
                            ->maxLength(255),

                            TextInput::make('avaiablearea')
                            ->label('Avaiable Area')
                            ->placeholder('Enter Avaiable Area')
                            ->maxLength(255),

                            Toggle::make('active')
                            ->label('Is Active?')
                            ->onIcon('heroicon-m-check-circle')
                            ->offIcon('heroicon-m-x-circle')
                            ->onColor('success')
                            ->offColor('danger')
                            ->inline(false),

                        ])->columns(3),





                ])->columns(3),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                ->wrap()
                    ->searchable(),
                // Tables\Columns\TextColumn::make('slug')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('city')
                    // ->searchable(),
                Tables\Columns\TextColumn::make('taluk.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('district.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('amenity.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('pincode')
                    ->searchable(),
                Tables\Columns\TextColumn::make('address')
                ->wrap()
                    ->searchable(),
                Tables\Columns\TextColumn::make('landmark')
                ->wrap()
                    ->searchable(),
                Tables\Columns\TextColumn::make('gmap')
                ->wrap()
                    ->searchable(),
                // Tables\Columns\TextColumn::make('avaiable')
                //     ->searchable(),
                Tables\Columns\IconColumn::make('active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('rate')
                    ->searchable(),
                Tables\Columns\TextColumn::make('avaiablearea')
                ->wrap()
                    ->searchable(),
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
            'index' => Pages\ListVenues::route('/'),
            'create' => Pages\CreateVenue::route('/create'),
            'edit' => Pages\EditVenue::route('/{record}/edit'),
        ];
    }
}
