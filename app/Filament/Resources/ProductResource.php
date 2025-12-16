<?php

namespace App\Filament\Resources;

use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Support\Str;
use App\Filament\Resources\ProductResource\Pages;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Group::make()->schema([

                    Section::make('Part Information')
                        ->schema([
                            TextInput::make('name')
                                ->required()
                                ->live(onBlur: true)
                                ->afterStateUpdated(function (string $operation, $state, Set $set) {
                                    if ($operation === 'create') {
                                        $set('slug', Str::slug($state));
                                    }
                                }),

                            TextInput::make('slug')
                                ->disabled()
                                ->dehydrated()
                                ->required()
                                ->unique(Product::class, 'slug', ignoreRecord: true),

                            TextInput::make('description')
                                ->columnSpanFull(),
                        ])->columns(2),

                    Section::make('Image')
                        ->schema([
                            FileUpload::make('image')
                                ->directory('products')
                                ->image(),
                        ]),

                ])->columnSpan(2),

                Group::make()->schema([

                    Section::make('Inventory Details')
                        ->schema([
                            TextInput::make('quantity')
                                ->numeric()
                                ->default(0)
                                ->required(),

                            TextInput::make('minimum_quantity')
                                ->numeric()
                                ->default(1),

                            TextInput::make('part_number'),
                        ]),

                    Section::make('Pricing')
                        ->schema([
                            TextInput::make('selling_price') // ✅ FIX
                                ->label('Price')
                                ->numeric()
                                ->prefix('₱')
                                ->required(),
                        ]),

                    Section::make('Fitment Details')
                        ->schema([
                            TextInput::make('motorcycle_brand'),
                            TextInput::make('fit_to_model'),
                        ]),

                    Section::make('Associations')
                        ->schema([
                            Select::make('category_id')
                                ->relationship('category', 'name')
                                ->required()
                                ->searchable()
                                ->preload(),

                            Select::make('brand_id')
                                ->relationship('brand', 'name')
                                ->required()
                                ->searchable()
                                ->preload(),

                            Select::make('supplier_id')
                                ->relationship('supplier', 'name')
                                ->nullable()
                                ->searchable()
                                ->preload(),
                        ]),

                    Section::make('Status')
                        ->schema([
                            Forms\Components\Toggle::make('is_active')
                                ->default(true),
                        ]),
                ])->columnSpan(1),

            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable(),

                TextColumn::make('category.name')->label('Category'),

                TextColumn::make('brand.name')->label('Brand'),

                TextColumn::make('quantity')->sortable(),

                TextColumn::make('minimum_quantity')->sortable(),

                TextColumn::make('selling_price') // ✅ FIX
                    ->label('Price')
                    ->money('PHP')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_active')->boolean(),

                TextColumn::make('created_at')->dateTime(),
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit'   => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
