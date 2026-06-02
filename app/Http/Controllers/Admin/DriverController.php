<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::latest()->get();
        return view('admin.drivers.index', compact('drivers'));
    }

    public function create()
    {
        return view('admin.drivers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'status' => 'required|in:Tersedia,Bertugas,Off',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('drivers', 'public');
        }

        Driver::create($validated);
        return redirect()->route('admin.drivers.index')->with('success', 'Driver ditambahkan.');
    }

    public function edit(Driver $driver)
    {
        return view('admin.drivers.edit', compact('driver'));
    }

    public function update(Request $request, Driver $driver)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'status' => 'required|in:Tersedia,Bertugas,Off',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            if ($driver->photo) Storage::disk('public')->delete($driver->photo);
            $validated['photo'] = $request->file('photo')->store('drivers', 'public');
        }

        $driver->update($validated);
        return redirect()->route('admin.drivers.index')->with('success', 'Driver diperbarui.');
    }

    public function destroy(Driver $driver)
    {
        if ($driver->photo) Storage::disk('public')->delete($driver->photo);
        $driver->delete();
        return redirect()->route('admin.drivers.index')->with('success', 'Driver dihapus.');
    }
}
