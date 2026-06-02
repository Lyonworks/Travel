<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('car_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('car_id')->constrained()->cascadeOnDelete();
            // driver_id dibuat nullable karena ada opsi "Lepas Kunci"
            $table->foreignId('driver_id')->nullable()->constrained()->nullOnDelete();
            $table->string('pickup_location');
            $table->dateTime('pickup_date');
            $table->dateTime('return_date');
            $table->decimal('total_price', 12, 2);
            $table->enum('status', ['pending', 'confirmed', 'completed', 'cancelled'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('car_bookings');
    }
};
