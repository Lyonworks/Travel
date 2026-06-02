<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TravelSchedule extends Model
{
    protected $guarded = ['id'];

    // Melakukan casting otomatis agar kolom waktu dibaca sebagai instance Carbon/Datetime
    protected $casts = [
        'departure_time' => 'datetime',
        'arrival_time' => 'datetime',
    ];

    /**
     * Relasi kembali ke rute perjalanan (Belongs-To)
     */
    public function route()
    {
        return $this->belongsTo(Route::class);
    }

    /**
     * Relasi One-to-Many ke booking travel
     * Satu jadwal bisa dipesan oleh banyak penumpang
     */
    public function bookings()
    {
        return $this->hasMany(TravelBooking::class, 'schedule_id');
    }
}
