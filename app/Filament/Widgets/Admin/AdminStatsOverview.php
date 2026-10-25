<?php

namespace App\Filament\Widgets\Admin;

use App\Models\Booking;
use App\Models\Product;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AdminStatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        // Hitung total booking bulan ini vs bulan lalu
        $bookingBulanIni = Booking::whereMonth('created_at', now()->month)->count();
        $bookingBulanLalu = Booking::whereMonth('created_at', now()->subMonth()->month)->count();
        $trendBooking = $bookingBulanLalu > 0
            ? round((($bookingBulanIni - $bookingBulanLalu) / $bookingBulanLalu) * 100)
            : 0;

        // Hitung pendapatan bulan ini (dari booking confirmed/completed)
        $pendapatanBulanIni = Booking::whereIn('status', ['confirmed', 'completed'])
            ->whereMonth('created_at', now()->month)
            ->sum('total_price');

        // Stok mobil aktif vs total
        $totalMobil = Product::count();
        $mobilAktif = Product::where('is_active', true)->count();
        $mobilHabis = Product::where('stock', 0)->count();

        // Total customer (role = user)
        $totalCustomer = User::where('role', 'user')->count();
        $customerBaruBulan = User::where('role', 'user')
            ->whereMonth('created_at', now()->month)
            ->count();

        // Booking pending (butuh tindakan)
        $bookingPending = Booking::where('status', 'pending')->count();

        return [
            Stat::make('Pendapatan Bulan Ini', 'Rp '.number_format($pendapatanBulanIni, 0, ',', '.'))
                ->description('Dari booking confirmed & selesai')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),

            Stat::make('Total Mobil', "{$mobilAktif} aktif / {$totalMobil} total")
                ->description("{$mobilHabis} mobil stok habis")
                ->descriptionIcon('heroicon-m-truck')
                ->color($mobilHabis > 0 ? 'warning' : 'info'),

            Stat::make('Total Customer', $totalCustomer)
                ->description("+{$customerBaruBulan} baru bulan ini")
                ->descriptionIcon('heroicon-m-users')
                ->color('info'),

            Stat::make('Booking Menunggu Konfirmasi', $bookingPending)
                ->description($bookingPending > 0 ? 'Perlu ditindaklanjuti!' : 'Semua sudah diproses')
                ->descriptionIcon($bookingPending > 0
                    ? 'heroicon-m-exclamation-circle'
                    : 'heroicon-m-check-circle')
                ->color($bookingPending > 0 ? 'warning' : 'success'),

            Stat::make('Total Booking Selesai', Booking::where('status', 'completed')->count())
                ->description('Sepanjang semua waktu')
                ->descriptionIcon('heroicon-m-check-badge')
                ->color('success'),
        ];
    }
}
