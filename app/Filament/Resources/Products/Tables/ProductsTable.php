<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('sku')
                    ->label('SKU')
                    ->badge()
                    ->color('info')
                    ->searchable()
                    ->sortable(),

                // Kolom tambahan dari form
                TextColumn::make('brand')
                    ->searchable()
                    ->sortable(),

                // Kolom tambahan dari form
                TextColumn::make('model')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('description')
                    ->limit(50)
                    ->searchable()
                    ->sortable(),

                TextColumn::make('price')
                    ->label('Harga')
                    ->formatStateUsing(fn (string $state): string => 'Rp '.number_format($state, 0, ',', '.'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('stock')
                    ->label('Stok')
                    ->icon('heroicon-o-cube')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('type')
                    ->label('Tipe'),

                // Kolom tambahan dari form
                TextColumn::make('capacity')
                    ->label('Kapasitas (Seat)')
                    ->sortable(),

                // Kolom tambahan dari form
                TextColumn::make('transmission')
                    ->label('Transmisi')
                    ->searchable(),

                // Kolom tambahan dari form
                TextColumn::make('fuel_type')
                    ->label('Bahan Bakar')
                    ->searchable(),

                TextColumn::make('location')
                    ->label('Lokasi'),

                ImageColumn::make('image')
                    ->label('Gambar Utama')
                    ->disk('public'),

                ImageColumn::make('images')
                    ->label('Galeri')
                    ->disk('public')
                    ->stacked()
                    ->limit(3),

                TextColumn::make('is_active')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        '1', 'true' => 'success',
                        '0', 'false' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => $state ? 'Aktif' : 'Non-Aktif')
                    ->sortable(),

                // Kolom tambahan dari form
                TextColumn::make('is_booked')
                    ->label('Booked')
                    ->badge()
                    ->color(fn (string $state): string => $state ? 'warning' : 'success')
                    ->formatStateUsing(fn (string $state): string => $state ? 'Disewa' : 'Tersedia')
                    ->sortable(),

                TextColumn::make('is_featured')
                    ->label('Unggulan')
                    ->badge()
                    ->color(fn (string $state): string => $state ? 'warning' : 'gray')
                    ->formatStateUsing(fn (string $state): string => $state ? 'Ya' : 'Tidak')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
