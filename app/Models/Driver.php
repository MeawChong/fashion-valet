<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    public $timestamps = false;

    protected $primaryKey = 'driver_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'phone_number',
        'email'
    ];

    public function completed_bookings()
    {
        return $this->hasMany(Booking::class, 'driver_id', 'driver_id')->where('state', 'COMPLETED');
    }

    public function cancelled_bookings()
    {
        return $this->hasMany(Booking::class, 'driver_id', 'driver_id')->where('state', 'LIKE', 'CANCELLED%');
    }

    public function total_fare()
    {
        return $this->completed_bookings()->selectRaw('SUM(fare) AS total_fare, driver_id')->groupBy('driver_id');
    }
}
