<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TourPackage;
use App\Models\TourBooking;

class TourController extends Controller
{
    public function index()
    {
        $packages = TourPackage::latest()->paginate(9);
        return view('frontend.tour.index', compact('packages'));
    }

    public function show(string $slug)
    {
        $package = TourPackage::with('itineraries')->where('slug', $slug)->firstOrFail();
        return view('frontend.tour.show', compact('package'));
    }

    public function storeBooking(Request $request, TourPackage $package)
    {
        $request->validate([
            'participants' => 'required|integer|min:1',
            'booking_date' => 'required|date|after_or_equal:today',
        ]);

        $total_price = $package->price * $request->participants;

        $booking = TourBooking::create([
            'user_id' => Auth::id(),
            'tour_package_id' => $package->id,
            'participants' => $request->participants,
            'booking_date' => $request->booking_date,
            'total_price' => $total_price,
            'status' => 'pending',
        ]);

        return redirect()->route('payment.checkout', ['type' => 'tour', 'id' => $booking->id]);
    }
}
