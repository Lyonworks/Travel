<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller {
    public function registerForm() { return view('auth'); }
    public function loginForm() { return view('auth'); }

    public function register(Request $request) {
        $request->validate(['name'=>'required','email'=>'required|email|unique:users','password'=>'required|min:6',]);
        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);
        Auth::login($user);
        return redirect('/');
    }

    public function login(Request $request) {
        if(Auth::attempt($request->only('email','password'))){
            return redirect('/');
        }
        return back()->withErrors(['email'=>'Invalid credentials']);
    }

    public function logout() {
        Auth::logout();
        return redirect('/');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Cek apakah user sudah pernah daftar pakai email ini
            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                // Buat user baru jika belum ada
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(), // Ambil foto profil akun Google
                    'role_id' => 3, // Pastikan role default adalah User Biasa
                    'password' => Hash::make(Str::random(24)) // Beri password acak
                ]);
            } else {
                // Update google_id & avatar jika user login manual sebelumnya
                $user->update([
                    'google_id' => $googleUser->getId(),
                    'avatar' => $user->avatar ?? $googleUser->getAvatar(),
                ]);
            }

            Auth::login($user);
            return redirect()->route('user.dashboard')->with('success', 'Berhasil login dengan Google!');

        } catch (\Exception $e) {
            return redirect('/login')->withErrors(['email' => 'Gagal login menggunakan Google. Silakan coba lagi.']);
        }
    }
}
