<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::latest()->get();
        return view('admin.cars.index', compact('cars'));
    }

    public function create()
    {
        return view('admin.cars.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'year' => 'required|integer',
            'plate_number' => 'required|string|unique:cars',
            'price_per_day' => 'required|numeric',
            'status' => 'required|in:Tersedia,Dipakai,Maintenance',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('cars', 'public');
        }

        Car::create($validated);
        return redirect()->route('admin.cars.index')->with('success', 'Data mobil berhasil ditambahkan.');
    }

    public function edit(Car $car)
    {
        return view('admin.cars.edit', compact('car'));
    }

    public function update(Request $request, Car $car)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'year' => 'required|integer',
            'plate_number' => 'required|string|unique:cars,plate_number,' . $car->id,
            'price_per_day' => 'required|numeric',
            'status' => 'required|in:Tersedia,Dipakai,Maintenance',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($car->image) Storage::disk('public')->delete($car->image);
            $validated['image'] = $request->file('image')->store('cars', 'public');
        }

        $car->update($validated);
        return redirect()->route('admin.cars.index')->with('success', 'Data mobil berhasil diperbarui.');
    }

    public function destroy(Car $car)
    {
        if ($car->image) Storage::disk('public')->delete($car->image);
        $car->delete();
        return redirect()->route('admin.cars.index')->with('success', 'Data mobil dihapus.');
    }
}
