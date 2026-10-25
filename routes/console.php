<?php

use App\Models\Product;
use Illuminate\Support\Facades\Schedule;

Schedule::call(function () {
    $products = Product::all();

    foreach ($products as $product) {
        $isBooked = $product->bookings()
            ->where('status', 'confirmed')
            ->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->exists();

        // Update semua status produk setiap malam
        if ($product->is_booked !== $isBooked) {
            $product->update(['is_booked' => $isBooked]);
        }
    }
})->dailyAt('00:01'); // Dijalankan setiap hari jam 00:01 pagi
