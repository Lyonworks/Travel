<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller {
    public function loginForm() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $credentials = $request->only('email','password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Hanya role_id 1 (superadmin) & 2 (admin) yang boleh masuk
            if (in_array((int) $user->role_id, [1, 2])) {
                return redirect()->route('admin.dashboard');
            }

            // Kalau role_id = 3 (user), tampilkan 404
            Auth::logout();
            return response()->view('errors.404', [], 404);
        }

        return back()->withErrors(['email'=>'Invalid admin credentials']);
    }

    public function index()
{
    $activities = [
        'total_users' => \App\Models\User::count(),
        'total_cars' => \App\Models\Car::count(),
        'total_tours' => \App\Models\TourPackage::count(),
        'total_cities' => \App\Models\City::count(),
        'total_routes' => \App\Models\Route::count(),
    ];

    return view('admin.dashboard', compact('activities'));
}
}
