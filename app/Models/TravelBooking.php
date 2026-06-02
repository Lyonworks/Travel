<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TravelBooking extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function schedule()
    {
        return $this->belongsTo(TravelSchedule::class, 'schedule_id');
    }

    public function payment()
    {
        return $this->morphOne(Payment::class, 'booking');
    }
}
