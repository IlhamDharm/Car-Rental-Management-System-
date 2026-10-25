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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete();

            $table->string('customer_name');
            $table->string('customer_contact');
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('total_price', 12, 2);
            $table->string('payment_method');
            $table->string('status')->default('pending'); // Status Pembayaran

            $table->string('pickup_location')->nullable();
            $table->string('pickup_method')->nullable();
            $table->string('return_method')->nullable();
            $table->string('source_info')->nullable();

            // --------------------------------------------------------
            // PENAMBAHAN KOLOM BARU DI SINI
            // --------------------------------------------------------
            $table->boolean('agree_terms')->default(true); // Persetujuan kontrak
            $table->string('video_sebelum')->nullable();   // Dokumentasi sebelum rental
            $table->string('video_sesudah')->nullable();   // Dokumentasi sesudah rental
            $table->enum('rental_status', [                // Status Operasional
                'Menunggu Konfirmasi',
                'Telah Dikonfirmasi',
                'Pengembalian Dalam Proses',
                'Pengembalian Berhasil',
                'Dibatalkan',
            ])->default('Menunggu Konfirmasi');
            // --------------------------------------------------------

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
