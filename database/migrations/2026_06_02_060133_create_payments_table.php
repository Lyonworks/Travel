<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            // morphs('booking') akan otomatis membuat kolom: booking_type (string) & booking_id (bigint)
            $table->morphs('booking');
            $table->decimal('amount', 12, 2);
            $table->string('payment_method'); // Contoh: 'Transfer Bank', 'E-Wallet'
            $table->string('transaction_id')->nullable();
            $table->enum('status', ['Menunggu', 'Dibayar', 'Gagal', 'Refund'])->default('Menunggu');
            $table->dateTime('payment_date')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('payments');
    }
};
