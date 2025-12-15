<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Number;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-receipt-refund';
    protected static ?int $navigationSort = 6;

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Group::make()
                ->schema([

                    Section::make('Order Information')
                        ->schema([

                            TextInput::make('customer_name')
                                ->label('Customer Name')
                                ->placeholder('Walk-in / Optional')
                                ->maxLength(255)
                                ->nullable(),

                            Select::make('status')
                                ->label('Order Status')
                                ->options([
                                    'new' => 'New',
                                    'completed' => 'Completed',
                                    'cancelled' => 'Cancelled',
                                ])
                                ->default('new')
                                ->required(),

                            Textarea::make('notes')
                                ->placeholder('Notes (optional)')
                                ->columnSpanFull(),

                        ])->columns(2),

                    Section::make('Order Items')
                        ->schema([

                            Repeater::make('items')
                                ->relationship()
                                ->schema([

                                    Select::make('product_id')
                                        ->label('Product')
                                        ->required()
                                        ->relationship('product', 'name')
                                        ->searchable()
                                        ->preload()
                                        ->reactive()
                                        ->afterStateUpdated(function ($state, Set $set) {
                                            $product = Product::find($state);
                                            $set('unit_price', $product?->selling_price ?? 0);
                                            $set('total_price', $product?->selling_price ?? 0);
                                        })
                                        ->columnSpan(6),

                                    TextInput::make('quantity')
                                        ->numeric()
                                        ->minValue(1)
                                        ->default(1)
                                        ->reactive()
                                        ->afterStateUpdated(function ($state, Set $set, Get $get) {
                                            $set('total_price', $state * $get('unit_price'));
                                        })
                                        ->columnSpan(3),

                                    TextInput::make('unit_price')
                                        ->label('Unit Price')
                                        ->numeric()
                                        ->disabled()
                                        ->dehydrated()
                                        ->columnSpan(3),

                                    TextInput::make('total_price')
                                        ->numeric()
                                        ->disabled()
                                        ->dehydrated()
                                        ->label('Total')
                                        ->columnSpan(3),

                                ])
                                ->columns(12),

                            Placeholder::make('grand_total_placeholder')
                                ->label('Grand Total')
                                ->content(function (Get $get, Set $set) {
                                    $total = 0;

                                    foreach ($get('items') ?? [] as $item) {
                                        $total += ($item['total_price'] ?? 0);
                                    }

                                    $set('grand_total', $total);
                                    return Number::currency($total, 'PHP');
                                }),

                            Hidden::make('grand_total')
                                ->default(0),

                        ]),

                ])->columnSpanFull()

        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('customer_name')
                    ->label('Customer')
                    ->placeholder('Walk-in')
                    ->searchable(),

                TextColumn::make('grand_total')
                    ->label('Total')
                    ->money('PHP')
                    ->sortable(),

                TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'primary' => 'new',
                        'success' => 'completed',
                        'danger' => 'cancelled',
                    ])
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Date')
                    ->dateTime('M d, Y — h:i A')
                    ->sortable(),

            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'view' => Pages\ViewOrder::route('/{record}'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
