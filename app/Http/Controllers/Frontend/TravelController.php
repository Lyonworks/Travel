<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\TravelSchedule;
use App\Models\TravelBooking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TravelController extends Controller
{
    public function index()
    {
        $cities = City::orderBy('name', 'asc')->get();

        return view('frontend.travel.index', compact('cities'));
    }

    public function search(Request $request)
    {
        $request->validate([
            'origin_city' => 'required|exists:cities,id',
            'destination_city' => 'required|exists:cities,id',
            'departure_date' => 'required|date',
            'passengers' => 'required|integer|min:1',
        ]);

        $schedules = TravelSchedule::with(['route.originCity', 'route.destinationCity'])
            ->whereHas('route', function($query) use ($request) {
                $query->where('origin_city_id', $request->origin_city)
                      ->where('destination_city_id', $request->destination_city);
            })
            ->whereDate('departure_time', $request->departure_date)
            ->where('available_seat', '>=', $request->passengers)
            ->where('status', 'active')
            ->get();

        return view('frontend.travel.results', compact('schedules', 'request'));
    }

    /**
     * Memproses pembuatan booking travel baru
     */
    public function storeBooking(Request $request, TravelSchedule $schedule)
    {
        $request->validate([
            'seat_number' => 'required|string', 
        ]);

        if ($schedule->available_seat < 1) {
            return back()->with('error', 'Mohon maaf, kursi sudah penuh.');
        }

        $booking = TravelBooking::create([
            'user_id' => Auth::id(),
            'schedule_id' => $schedule->id,
            'booking_code' => 'TRV-' . strtoupper(Str::random(6)),
            'seat_number' => $request->seat_number,
            'total_price' => $schedule->price, // Jika sistem bulk, kalikan dengan jumlah penumpang
            'status' => 'pending',
            'payment_status' => 'unpaid',
        ]);

        $schedule->decrement('available_seat');

        return redirect()->route('payment.checkout', ['type' => 'travel', 'id' => $booking->id]);
    }
}
