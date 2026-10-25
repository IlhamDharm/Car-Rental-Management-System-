<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Buat tabel products dengan seluruh kolom detail mobil[cite: 1]
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            // Info Dasar[cite: 1]
            $table->string('name');
            $table->string('sku')->unique();
            $table->string('type');
            $table->string('brand');
            $table->string('model');

            // Spesifikasi Utama[cite: 1]
            $table->integer('capacity'); // Kapasitas (penumpang)
            $table->string('transmission'); // Manual/Otomatis
            $table->string('fuel_type'); // Bensin/Diesel/Listrik

            // Detail Kendaraan (Gabungan dari Cars)[cite: 1]
            $table->integer('tahun')->nullable();
            $table->string('warna')->nullable();
            $table->string('plat_nomor')->nullable();
            $table->integer('kapasitas_mesin')->nullable();
            $table->json('fitur')->nullable();
            $table->text('kondisi')->nullable();

            // Harga & Stok[cite: 1]
            $table->string('location');
            $table->text('description');
            $table->integer('price');
            $table->integer('stock');

            // Media[cite: 1]
            $table->string('image')->nullable();
            $table->json('images')->nullable();

            // Status[cite: 1]
            $table->boolean('is_booked')->default(true);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
        });

        // 2. Hapus tabel cars jika sebelumnya pernah dibuat agar database bersih
        Schema::dropIfExists('cars');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
