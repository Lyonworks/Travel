<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TravelBooking;
use App\Models\CarBooking;
use App\Models\TourBooking;
use App\Models\Payment;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'total_pendapatan' => Payment::where('status', 'Dibayar')->sum('amount'),
            'travel_bookings' => TravelBooking::count(),
            'car_bookings' => CarBooking::count(),
            'tour_bookings' => TourBooking::count(),
        ];

        return view('admin.dashboard', compact('data'));
    }
}
