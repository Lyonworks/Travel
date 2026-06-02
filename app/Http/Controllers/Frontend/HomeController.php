<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\TourPackage;
use App\Models\Car;

class HomeController extends Controller
{
    public function index()
    {
        // Menampilkan data untuk hero banner, layanan, dsb.
        $popularTours = TourPackage::limit(6)->get();
        $availableCars = Car::where('status', 'Tersedia')->limit(4)->get();

        return view('frontend.home', compact('popularTours', 'availableCars'));
    }
}
