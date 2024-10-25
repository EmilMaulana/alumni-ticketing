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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relasi ke User
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Relasi ke Produk
            $table->string('order_id')->unique(); // Order ID dari Midtrans
            $table->decimal('amount', 15, 2); // Jumlah total pembayaran
            $table->string('status')->default('pending'); // Status transaksi (pending, success, failed)
            $table->string('payment_type')->nullable(); // Tipe pembayaran (misalnya: credit_card)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
