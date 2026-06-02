<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Car;
use App\Models\Driver;
use App\Models\CarBooking;
use Carbon\Carbon;

class RentalController extends Controller
{
    public function index()
    {
        $cars = Car::where('status', 'Tersedia')->get();
        return view('frontend.rental.index', compact('cars'));
    }

    public function show(Car $car)
    {
        $drivers = Driver::where('status', 'Tersedia')->get();
        return view('frontend.rental.show', compact('car', 'drivers'));
    }

    public function storeBooking(Request $request, Car $car)
    {
        $request->validate([
            'pickup_location' => 'required|string',
            'pickup_date' => 'required|date|after_or_equal:today',
            'return_date' => 'required|date|after:pickup_date',
            'driver_id' => 'nullable|exists:drivers,id'
        ]);

        $pickup = Carbon::parse($request->pickup_date);
        $return = Carbon::parse($request->return_date);
        $days = $pickup->diffInDays($return);

        // Asumsi hitungan harga x hari
        $total_price = $car->price_per_day * ($days == 0 ? 1 : $days);

        $booking = CarBooking::create([
            'user_id' => Auth::id(),
            'car_id' => $car->id,
            'driver_id' => $request->driver_id,
            'pickup_location' => $request->pickup_location,
            'pickup_date' => $request->pickup_date,
            'return_date' => $request->return_date,
            'total_price' => $total_price,
            'status' => 'pending',
        ]);

        return redirect()->route('payment.checkout', ['type' => 'car', 'id' => $booking->id]);
    }
}
