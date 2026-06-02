<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TourBooking extends Model
{
    protected $guarded = ['id'];
    protected $casts = [
        'booking_date' => 'date',
    ];

    public function user() { return $this->belongsTo(User::class); }
    public function tourPackage() { return $this->belongsTo(TourPackage::class); }

    // Relasi Polymorphic ke Payment
    public function payment() {
        return $this->morphOne(Payment::class, 'booking');
    }
}
