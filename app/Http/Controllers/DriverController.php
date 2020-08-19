<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Driver;

class DriverController extends Controller
{
    protected $data = [];

    public function index()
    {
        $this->data['data'] = false;

        return view('drivers', $this->data);
    }

    public function show()
    {
        $data = DB::table('drivers')
            ->where(function($query) {
                $query->where('drivers.email', 'LIKE', '%fvtaxi%')
                      ->orWhere('drivers.email', 'LIKE', '%fvdrive%');
            })
            ->leftJoin(DB::raw("(SELECT b.driver_id, COUNT(*) AS number_of_completed_rides FROM bookings b WHERE b.state = 'COMPLETED' GROUP BY b.driver_id) completed_bookings"), 'drivers.driver_id', '=', 'completed_bookings.driver_id')
            ->leftJoin(DB::raw("(SELECT b.driver_id, COUNT(*) AS number_of_cancelled_rides FROM bookings b WHERE b.state LIKE 'CANCELLED%' GROUP BY b.driver_id) cancelled_bookings"), 'drivers.driver_id', '=', 'cancelled_bookings.driver_id')
            ->leftJoin(DB::raw("(SELECT c.driver_id, COUNT(*) AS number_of_unique_passengers FROM (SELECT b.driver_id, b.passenger_id FROM bookings b WHERE b.state = 'COMPLETED' GROUP BY b.driver_id, b.passenger_id) c GROUP BY c.driver_id) unique_passengers"), 'drivers.driver_id', '=', 'unique_passengers.driver_id')
            ->leftJoin(DB::raw("(SELECT b.driver_id, SUM(b.fare) AS total_fare FROM bookings b WHERE b.state = 'COMPLETED' GROUP BY b.driver_id) completed_fare"), 'drivers.driver_id', '=', 'completed_fare.driver_id')
            ->selectRaw('drivers.driver_id AS driver_id, COALESCE(number_of_completed_rides, 0) AS number_of_completed_rides, COALESCE(number_of_cancelled_rides, 0) AS number_of_cancelled_rides, COALESCE(number_of_unique_passengers, 0) AS number_of_unique_passengers, COALESCE(total_fare, 0) AS total_fare, COALESCE(total_fare * 0.2, 0) AS total_commission')
            ->where('number_of_completed_rides', '>', 10)
            ->where('number_of_unique_passengers', '<', 5)
            ->orderBy('number_of_completed_rides', 'DESC')
            ->get();

        $this->data['data'] = $data;

        return view('drivers', $this->data);
    }
}
