<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    $timestamps = false;

    $primaryKey = 'booking_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'created_at_local',
        'driver_id',
        'passenger_id',
        'state',
        'country_id',
        'fare'
    ];

    protected $dates = [
        'created_at_local'
    ];

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
