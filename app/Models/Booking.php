<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'user_id',
        'customer_name',
        'customer_contact',
        'start_date',
        'end_date',
        'total_price',
        'payment_method',
        'status', // Status finansial (pending, confirmed)
        'pickup_location',
        'pickup_method',
        'return_method',
        'source_info',
        // Kolom Baru:
        'agree_terms',
        'video_sebelum',
        'video_sesudah',
        'rental_status', // Status operasional rental
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'total_price' => 'decimal:2',
        'agree_terms' => 'boolean',
    ];

    // Menambahkan virtual atribut "duration" (Durasi Hari)
    protected $appends = ['duration'];

    public function getDurationAttribute()
    {
        $start = Carbon::parse($this->start_date);
        $end = Carbon::parse($this->end_date);
        $days = $start->diffInDays($end);

        return $days > 0 ? $days : 1;
    }

    // ====================================================
    // FUNGSI OTOMATISASI STATUS MOBIL (is_booked)
    // ====================================================
    protected static function booted()
    {
        static::saved(function ($booking) {
            self::updateProductStatus($booking->product);
        });

        static::deleted(function ($booking) {
            self::updateProductStatus($booking->product);
        });
    }

    private static function updateProductStatus($product)
    {
        if ($product) {
            $isCurrentlyBooked = $product->bookings()
                ->whereIn('rental_status', ['Telah Dikonfirmasi', 'Pengembalian Dalam Proses'])
                ->whereDate('start_date', '<=', now())
                ->whereDate('end_date', '>=', now())
                ->exists();

            $product->update([
                'is_booked' => $isCurrentlyBooked,
            ]);
        }
    }

    // ====================================================
    // RELASI
    // ====================================================
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
