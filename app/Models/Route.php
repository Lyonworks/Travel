<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    // Mengizinkan mass-assignment untuk semua kolom kecuali 'id'
    protected $guarded = ['id'];

    /**
     * Relasi ke kota asal (origin)
     */
    public function originCity()
    {
        return $this->belongsTo(City::class, 'origin_city_id');
    }

    /**
     * Relasi ke kota tujuan (destination)
     */
    public function destinationCity()
    {
        return $this->belongsTo(City::class, 'destination_city_id');
    }

    /**
     * Relasi One-to-Many ke jadwal travel
     * Satu rute bisa memiliki banyak jadwal keberangkatan
     */
    public function schedules()
    {
        return $this->hasMany(TravelSchedule::class);
    }
}
