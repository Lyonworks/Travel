<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = ['google_id','name','email','avatar','password','role_id'];

    protected $hidden = ['password','remember_token'];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function travelBookings()
    {
        return $this->hasMany(TravelBooking::class);
    }

    public function carBookings()
    {
        return $this->hasMany(CarBooking::class);
    }

    public function tourBookings()
    {
        return $this->hasMany(TourBooking::class);
    }
}
