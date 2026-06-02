<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TravelSchedule;
use App\Models\Route;
use Illuminate\Http\Request;

class TravelController extends Controller
{
    public function index()
    {
        $schedules = TravelSchedule::with(['route.originCity', 'route.destinationCity'])->latest()->get();
        return view('admin.travel.index', compact('schedules'));
    }

    public function create()
    {
        $routes = Route::with(['originCity', 'destinationCity'])->get();
        return view('admin.travel.create', compact('routes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'route_id' => 'required|exists:routes,id',
            'departure_time' => 'required|date',
            'arrival_time' => 'required|date|after:departure_time',
            'price' => 'required|numeric',
            'capacity' => 'required|integer|min:1',
            'status' => 'required|in:active,full,cancelled',
        ]);

        $validated['available_seat'] = $validated['capacity']; // Default kursi tersedia sama dengan kapasitas

        TravelSchedule::create($validated);
        return redirect()->route('admin.travel.index')->with('success', 'Jadwal travel ditambahkan.');
    }

    public function edit(TravelSchedule $travel)
    {
        $routes = Route::with(['originCity', 'destinationCity'])->get();
        return view('admin.travel.edit', compact('travel', 'routes'));
    }

    public function update(Request $request, TravelSchedule $travel)
    {
        $validated = $request->validate([
            'route_id' => 'required|exists:routes,id',
            'departure_time' => 'required|date',
            'arrival_time' => 'required|date|after:departure_time',
            'price' => 'required|numeric',
            'capacity' => 'required|integer|min:1',
            'available_seat' => 'required|integer|min:0|lte:capacity',
            'status' => 'required|in:active,full,cancelled',
        ]);

        $travel->update($validated);
        return redirect()->route('admin.travel.index')->with('success', 'Jadwal travel diperbarui.');
    }

    public function destroy(TravelSchedule $travel)
    {
        $travel->delete();
        return redirect()->route('admin.travel.index')->with('success', 'Jadwal travel dihapus.');
    }
}
