<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Filament\Resources\BookingResource\RelationManagers;
use App\Models\AdditionalServe;
use App\Models\Booking;
use App\Models\Menu;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Icetalker\FilamentTableRepeater\Forms\Components\TableRepeater;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Section::make()
                ->schema([

                    DatePicker::make('date')
                    ->default(now())
                    ->required(),

                    TextInput::make('number')
                    ->numeric()
                    ->readOnly()
                    ->default(Booking::max('id')+101),



                    // TextInput::make('transactionNo')
                    // ->default(Leaverequest::max('id')+1),

                    Section::make()
                    ->schema([

                        DatePicker::make('from')
                        ->required(),

                        DatePicker::make('to')
                        ->required(),

                    ])->columns(2),

                    Section::make()
                    ->schema([

                        Select::make('event_id')
                        ->relationship('event','name')
                        ->required(),

                        Select::make('venue_id')
                        ->relationship('venue','name')
                        ->required(),

                        // Select::make('menu_id')
                        // ->relationship('menu','name')
                        // ->required(),

                        TextInput::make('people')
                        ->required()
                        ->live()
                        ->numeric(),

                    ])->columns(3),

                    Section::make()
                    ->schema([


                    TextInput::make('bookby')
                    ->label('Booked By')
                    ->placeholder('Enter Your Name')
                    ->required()
                    ->maxLength(255),

                    TextInput::make('contact')
                    ->placeholder('Enter Contact Number')
                    ->required()
                    ->numeric(),

                    TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),

                    ])->columns(3),


                    TableRepeater::make('menuentry')
                    ->relationship()
                    ->schema([

                        Select::make('menu_id')
                        ->relationship('menu','name')
                        ->live(),
                        // ->afterStateUpdated(function ($state, callable $set)
                        // {
                        // $selectvalue = Menu::find($state);
                        // $set('rate', $selectvalue->rate);
                        // }),


                        //  TextInput::make('discount')
                        //  ->afterStateUpdated(function (Get $get,$state, Set $set){
                        //     if($get('menu_id')>0)
                        //     {
                        //     $val = Menu::find($get('menu_id'));
                        //     return $val->rate*$get('../../people') => $set('amountdummy', $get('rate') - $state) ;
                        // }
                        // else
                        //     {
                        //         return 0;
                        //     }
                        // })
                        // ->live(onBlur:true),


                        Placeholder::make('ratedummy')
                        ->label('Rate')
                      //  ->live()
                        ->content( function (Get $get){
                            if($get('menu_id')>0)
                            {
                                $val = Menu::find($get('menu_id'));
                            return $val->rate;
                            }
                            else
                            {
                                return 0;
                            }


                        }),


                        Placeholder::make('amountdummy')
                        ->label('Amount')
                    //    ->live()
                        ->content(function ($get){
                            if($get('menu_id')>0)
                            {
                            $val = Menu::find($get('menu_id'));
                            return $val->rate*$get('../../people') ;
                        }
                        else
                            {
                                return 0;
                            }

                        }),

                    ]),

                          TableRepeater::make('addonentry')
                          ->label('Additional Serve')
                            ->relationship()
                            ->schema([

                                Select::make('additional_serve_id')
                                ->relationship('additional_serve','name')
                               ->live(),


                                Placeholder::make('ratedummy')

                                    ->content( function (Get $get){
                                        if($get('additional_serve_id')>0)
                                        {
                                            $val = AdditionalServe::find($get('additional_serve_id'));
                                        return $val->rate;
                                        }
                                        else
                                        {
                                            return 0;
                                        }

                          }),


                                Placeholder::make('amount')

                                ->content(function ($get){
                                    if($get('additional_serve_id')>0)
                                    {
                                        $val = AdditionalServe::find($get('additional_serve_id'));
                                        $rate = $val->rate;
                                        $unit = $val->unit;
                                        $pepl = $get('../../people');

                                            if($unit==1)
                                                 { return $rate;}
                                            else
                                                {return $rate*$pepl/$unit; }
                                            }
                                            else
                                            {
                                                return 0;
                                            }

                          }),


                            ]),








                ])->columns(3),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('from')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('to')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('event_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('venue_id')
                    ->numeric()
                    ->sortable(),
                // Tables\Columns\TextColumn::make('menu_id')
                //     ->numeric()
                //     ->sortable(),
                Tables\Columns\TextColumn::make('people')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('bookby')
                    ->searchable(),
                Tables\Columns\TextColumn::make('contact')
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
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
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}
