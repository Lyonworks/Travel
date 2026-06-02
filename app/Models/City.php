<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $guarded = ['id'];

    public function routesAsOrigin()
    {
        return $this->hasMany(Route::class, 'origin_city_id');
    }

    public function routesAsDestination()
    {
        return $this->hasMany(Route::class, 'destination_city_id');
    }
}
