<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TourPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class TourController extends Controller
{
    public function index()
    {
        $packages = TourPackage::latest()->get();
        return view('admin.tours.index', compact('packages'));
    }

    public function create()
    {
        return view('admin.tours.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'duration' => 'required|integer',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('tours', 'public');
        }

        TourPackage::create($validated);
        return redirect()->route('admin.tours.index')->with('success', 'Paket wisata dibuat.');
    }

    public function edit(TourPackage $tour) // Parameter $tour mengikuti penamaan route resource
    {
        return view('admin.tours.edit', compact('tour'));
    }

    public function update(Request $request, TourPackage $tour)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'duration' => 'required|integer',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('thumbnail')) {
            if ($tour->thumbnail) Storage::disk('public')->delete($tour->thumbnail);
            $validated['thumbnail'] = $request->file('thumbnail')->store('tours', 'public');
        }

        $tour->update($validated);
        return redirect()->route('admin.tours.index')->with('success', 'Paket wisata diperbarui.');
    }

    public function destroy(TourPackage $tour)
    {
        if ($tour->thumbnail) Storage::disk('public')->delete($tour->thumbnail);
        $tour->delete();
        return redirect()->route('admin.tours.index')->with('success', 'Paket wisata dihapus.');
    }
}
