<?php

namespace App\Filament\Widgets\Admin;

use App\Models\Booking;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestOrdersTable extends BaseWidget
{
    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 'full';

    protected static ?string $heading = '📋 Booking Terbaru';

    public function table(Table $table): Table
    {
        return $table
            ->query(Booking::query()->latest()->limit(8))
            ->columns([
                Tables\Columns\TextColumn::make('customer_name')
                    ->label('Pelanggan')
                    ->searchable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('customer_contact')
                    ->label('Kontak / WA'),

                Tables\Columns\TextColumn::make('start_date')
                    ->label('Tanggal Mulai')
                    ->date('d M Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('duration')
                    ->label('Durasi')
                    ->suffix(' hari'),

                Tables\Columns\TextColumn::make('total_price')
                    ->label('Total')
                    ->money('IDR')
                    ->sortable(),

                Tables\Columns\TextColumn::make('payment_method')
                    ->label('Pembayaran')
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'transfer' => '🏦 Transfer',
                        'e_wallet' => '📱 E-Wallet',
                        'cash' => '💵 Tunai',
                        default => $state ?? '-',
                    }),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn ($state): string => match ($state) {
                        'pending' => 'warning',
                        'confirmed' => 'info',
                        'completed' => 'success',
                        'cancelled' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'pending' => '⏳ Menunggu',
                        'confirmed' => '✅ Dikonfirmasi',
                        'completed' => '🎉 Selesai',
                        'cancelled' => '❌ Dibatalkan',
                        default => $state ?? '-',
                    }),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Waktu Booking')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->actions([
            ]);
    }
}
