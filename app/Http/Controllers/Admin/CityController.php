<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        // Menampilkan daftar kota, diurutkan berdasarkan nama (A-Z)
        $cities = City::orderBy('name', 'asc')->get();
        return view('admin.cities.index', compact('cities'));
    }

    public function create()
    {
        return view('admin.cities.create');
    }

    public function store(Request $request)
    {
        // Validasi inputan
        $request->validate([
            'name'     => 'required|string|max:255',
            'province' => 'required|string|max:255',
        ]);

        City::create($request->all());

        return redirect()->route('admin.cities.index')->with('success', 'Data kota berhasil ditambahkan!');
    }

    public function edit(City $city)
    {
        // Me-return ke view create.blade.php yang sama dengan membawa data $city
        return view('admin.cities.create', compact('city'));
    }

    public function update(Request $request, City $city)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'province' => 'required|string|max:255',
        ]);

        $city->update($request->all());

        return redirect()->route('admin.cities.index')->with('success', 'Data kota berhasil diperbarui!');
    }

    public function destroy(City $city)
    {
        $city->delete();
        return redirect()->route('admin.cities.index')->with('success', 'Data kota berhasil dihapus!');
    }
}
