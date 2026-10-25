<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Product Tabs')
                    ->tabs([
                        Tab::make('Product Details')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                TextEntry::make('name')
                                    ->label('Product Name')
                                    ->weight('bold'),
                                TextEntry::make('sku')
                                    ->label('SKU')
                                    ->badge()
                                    ->color('info'),
                                TextEntry::make('brand')
                                    ->label('Brand'),
                                TextEntry::make('model')
                                    ->label('Model'),
                                TextEntry::make('description')
                                    ->label('Description')
                                    ->markdown(),
                            ])->columns(2),
                        Tab::make('Pricing & Stock')
                            ->icon('heroicon-o-banknotes')
                            ->schema([
                                TextEntry::make('price')
                                    ->label('Product Price')
                                    ->icon('heroicon-o-currency-dollar')
                                    ->color('success'),

                                TextEntry::make('stock')
                                    ->label('Inventory Stock')
                                    ->badge()
                                    ->icon('heroicon-o-cube'),
                                TextEntry::make('type')
                                    ->label('Tipe Mobil'),
                                TextEntry::make('capacity')
                                    ->label('Kapasitas Penumpang'),
                                TextEntry::make('transmission')
                                    ->label('Transmisi'),
                                TextEntry::make('fuel_type')
                                    ->label('Bahan Bakar'),
                                TextEntry::make('location')
                                    ->label('Lokasi'),
                                TextEntry::make('tahun')
                                    ->label('Tahun Produksi'),
                                TextEntry::make('warna')
                                    ->label('Warna'),
                                TextEntry::make('plat_nomor')
                                    ->label('Plat Nomor'),
                                TextEntry::make('kapasitas_mesin')
                                    ->label('Kapasitas Mesin')
                                    ->suffix(' CC'),
                                TextEntry::make('fitur')
                                    ->label('Fitur')
                                    ->listWithLineBreaks()
                                    ->badge(),
                                TextEntry::make('kondisi')
                                    ->label('Kondisi')
                                    ->markdown()
                                    ->columnSpanFull(),
                            ])->columns(2),

                        Tab::make('Media & Status')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                ImageEntry::make('image')
                                    ->label('Product Image')
                                    ->disk('public')
                                    ->columnSpanFull(),
                                ImageEntry::make('images')
                                    ->label('Galeri Gambar')
                                    ->disk('public')
                                    ->stacked()
                                    ->limit(5)
                                    ->columnSpanFull(),
                                IconEntry::make('is_active')
                                    ->label('Is Active')
                                    ->boolean(),
                                IconEntry::make('is_booked')
                                    ->label('Is Booked')
                                    ->boolean(),
                                IconEntry::make('is_featured')
                                    ->label('Featured Product')
                                    ->boolean(),
                            ])->columns(2),
                    ])
                    ->columnSpanFull()
                    ->vertical(),
            ]);
    }
}
