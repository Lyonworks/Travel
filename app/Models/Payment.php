<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $guarded = ['id'];
    protected $casts = [
        'payment_date' => 'datetime',
    ];

    // Mengambil model yang berelasi (TravelBooking, CarBooking, atau TourBooking)
    public function booking()
    {
        return $this->morphTo();
    }
}
