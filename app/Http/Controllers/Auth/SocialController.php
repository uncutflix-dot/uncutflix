<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class SocialController extends Controller
{
    // Mengarahkan user ke halaman login provider (Google/LINE/Facebook)
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    // Menerima respon balasan setelah user sukses login di provider
    public function callback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();

            // Cek apakah email user sudah ada di database
            $user = User::where('email', $socialUser->getEmail())->first();

            if (!$user) {
                // Jika belum ada, buatkan akun otomatis secara instan
                $user = User::create([
                    'name' => $socialUser->getName() ?? 'User ' . ucfirst($provider),
                    'email' => $socialUser->getEmail(),
                    'password' => bcrypt(Str::random(16)), // Sandi acak yang aman
                    'is_admin' => false, // Otomatis jadi penonton biasa
                ]);
            }

            // Login-kan user ke dalam sistem
            Auth::login($user);

            // Cek hak akses: Jika admin, lempar ke panel admin. Jika user, ke beranda.
            if ($user->is_admin) {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('welcome');

        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Gagal login dengan ' . ucfirst($provider) . '. Silakan coba lagi.');
        }
    }
}