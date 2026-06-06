<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Route as TravelRoute; // Alias agar tidak bentrok dengan facade Route bawaan Laravel
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function index()
    {
        // Memanggil data rute beserta relasi kotanya agar tidak terjadi N+1 Query problem
        $routes = TravelRoute::with(['originCity', 'destinationCity'])->latest()->get();
        return view('admin.routes.index', compact('routes'));
    }

    public function create()
    {
        // Mengirimkan list semua kota untuk ditaruh di dalam <select> dropdown
        $cities = City::orderBy('name', 'asc')->get();
        return view('admin.routes.create', compact('cities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'origin_city_id'      => 'required|exists:cities,id',
            'destination_city_id' => 'required|exists:cities,id|different:origin_city_id',
        ], [
            'destination_city_id.different' => 'Kota tujuan tidak boleh sama persis dengan kota asal!'
        ]);

        TravelRoute::create($request->all());

        return redirect()->route('admin.routes.index')->with('success', 'Rute baru berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $route = TravelRoute::findOrFail($id);
        $cities = City::orderBy('name', 'asc')->get();

        return view('admin.routes.create', compact('route', 'cities'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'origin_city_id'      => 'required|exists:cities,id',
            'destination_city_id' => 'required|exists:cities,id|different:origin_city_id',
        ], [
            'destination_city_id.different' => 'Kota tujuan tidak boleh sama persis dengan kota asal!'
        ]);

        $route = TravelRoute::findOrFail($id);
        $route->update($request->all());

        return redirect()->route('admin.routes.index')->with('success', 'Data rute berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $route = TravelRoute::findOrFail($id);
        $route->delete();

        return redirect()->route('admin.routes.index')->with('success', 'Rute perjalanan berhasil dihapus!');
    }
}
