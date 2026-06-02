<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TourPackage extends Model
{
    protected $guarded = ['id'];

    public function itineraries() {
        return $this->hasMany(Itinerary::class)->orderBy('day', 'asc');
    }

    public function bookings() {
        return $this->hasMany(TourBooking::class);
    }
}
