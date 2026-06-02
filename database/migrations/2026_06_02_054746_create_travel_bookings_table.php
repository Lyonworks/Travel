<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('travel_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('schedule_id')->constrained('travel_schedules')->cascadeOnDelete();
            $table->string('booking_code')->unique();
            $table->string('seat_number'); // Bisa berupa array/json jika > 1 penumpang
            $table->decimal('total_price', 12, 2);
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
            $table->enum('payment_status', ['unpaid', 'paid', 'failed'])->default('unpaid');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('travel_bookings');
    }
};
