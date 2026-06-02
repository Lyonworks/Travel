<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $guarded = ['id'];

    public function bookings()
    {
        return $this->hasMany(CarBooking::class);
    }
}
