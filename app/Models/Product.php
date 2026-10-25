<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Tambahkan kolom brand, model, capacity, transmission, dan fuel_type
    protected $fillable = [
        'name',
        'sku',
        'type',
        'brand',
        'model',
        'capacity',
        'transmission',
        'fuel_type',
        'location',
        'description',
        'price',
        'stock',
        'image',
        'images',
        'tahun',
        'warna',
        'plat_nomor',
        'kapasitas_mesin',
        'fitur',
        'kondisi',
        'is_booked',
        'is_active',
        'is_featured',
    ];

    protected $casts = [
        'is_booked' => 'boolean',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'price' => 'integer',
        'stock' => 'integer',
        'images' => 'array',
        'fitur' => 'array',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
