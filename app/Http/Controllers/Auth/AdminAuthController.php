<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AdminAuthController extends Controller
{
    // Menampilkan halaman khusus login admin (bersih dari iklan)
    public function create()
    {
        // Jika sudah login dan dia admin, langsung lempar ke dashboard admin
        if (Auth::check() && auth()->user()->is_admin == 1) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    // Memproses data login admin
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        // Cek email dan password ke database
        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        $request->session()->regenerate();

        // 🚨 KUNCI KEAMANAN UTAMA: Pastikan yang login benar-benar admin (is_admin == 1)
        if (auth()->user()->is_admin != 1) {
            // Jika ternyata member biasa yang coba-coba masuk, usir dan logout-kan!
            Auth::logout();
            
            return back()->withErrors([
                'email' => 'Akses ditolak! Akun member biasa tidak diizinkan masuk melalui portal Administrator.',
            ]);
        }

        // Jika lolos dan benar admin, arahkan ke dashboard admin
        return redirect()->intended(route('admin.dashboard'));
    }
}