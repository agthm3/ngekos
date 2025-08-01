<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BoardingHouseResource\Pages;
use App\Filament\Resources\BoardingHouseResource\RelationManagers;
use App\Models\BoardingHouse;
use Dom\Text;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\EditAction;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;

class BoardingHouseResource extends Resource
{
    protected static ?string $model = BoardingHouse::class;

    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationGroup = 'Boarding House Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
             Tabs::make('Tabs')
                ->tabs([
                    Tabs\Tab::make('Informasi Utama')
                        ->schema([
                            FileUpload::make('thumbnail')
                                ->image()
                                ->directory('boarding_house')
                                ->required(),
                            Forms\Components\TextInput::make('name')
                                ->required()
                                ->maxLength(255)
                                ->debounce(1000)
                                ->reactive()
                                ->afterStateUpdated(function ($state, callable $set) {
                                    $set('slug', str($state)->slug());
                                }),
                            Forms\Components\TextInput::make('slug')
                                ->required(),
                            Forms\Components\Select::make('city_id')
                                ->relationship('city', 'name')
                                ->required(),
                            Forms\Components\Select::make('category_id')
                                ->relationship('category', 'name')
                                ->required(),
                            Forms\Components\RichEditor::make('description')
                                ->required(),
                            Forms\Components\TextInput::make('price')
                                ->numeric()
                                ->placeholder('Rp')
                                ->required(),
                            Forms\Components\TextArea::make('address')
                                ->required(),
                        ]),
                    Tabs\Tab::make('Bonus Ngekos')
                        ->schema([
                            Forms\Components\Repeater::make('bonuses')
                            ->relationship('bonuses')
                            ->schema([
                                FileUpload::make('image')
                                ->image()
                                ->directory('bonuses')
                                ->required(),
                                TextInput::make('name')
                                ->required(),
                                TextInput::make('description')
                                ->required(),
                            ])
                        ]),
                    Tabs\Tab::make('Kamar')
                        ->schema([
                        Forms\Components\Repeater::make('rooms')
                        ->relationship('rooms')
                           ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->required(),
                                Forms\Components\TextInput::make('room_type')
                                    ->required(),
                                Forms\Components\TextInput::make('square_feet')
                                    ->numeric()
                                    ->required(),
                                Forms\Components\TextInput::make('capacity')
                                    ->numeric()
                                    ->required(),
                                Forms\Components\TextInput::make('price_per_month')
                                    ->numeric()
                                    ->placeholder('Rp')
                                    ->required(),
                                Forms\Components\Toggle::make('is_available')
                                    ->default(true),
                                Forms\Components\Repeater::make('images')
                                    ->relationship('images')
                                    ->schema([
                                        FileUpload::make('image')
                                            ->image()
                                            ->directory('rooms')
                                            ->required(),
                                    ]),
                            ]),
                        ]),
                ])->columnSpan(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail')
                    ->label('Thumbnail')
                    ->circular()
                    ->size(50),
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('slug')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('city.name')
                    ->label('Kota')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('category.name')
                    ->label('Kategori')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('price')
                    ->money('idr', true)
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make()
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
            'index' => Pages\ListBoardingHouses::route('/'),
            'create' => Pages\CreateBoardingHouse::route('/create'),
            'edit' => Pages\EditBoardingHouse::route('/{record}/edit'),
        ];
    }
}
