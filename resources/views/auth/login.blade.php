<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-4 text-2xl font-bold text-center text-white">Masuk ke UncutFlix</div>

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <label class="block mb-1 text-sm text-gray-300">Email</label>
            <input type="email" name="email" :value="old('email')" required autofocus autocomplete="username" 
                class="w-full bg-gray-800 border border-gray-700 rounded px-4 py-2.5 text-white focus:outline-none focus:border-red-600">
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-500" />
        </div>

        <!-- Password dengan Fitur Intip Sandi -->
        <div x-data="{ showPassword: false }" class="relative">
            <label class="block mb-1 text-sm text-gray-300">Sandi</label>
            <div class="relative">
                <input :type="showPassword ? 'text' : 'password'" name="password" required autocomplete="current-password" 
                    class="w-full bg-gray-800 border border-gray-700 rounded px-4 py-2.5 pr-10 text-white focus:outline-none focus:border-red-600">
                
                <!-- Tombol Intip Sandi (Mata) -->
                <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-white">
                    <svg x-show="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    <svg x-show="showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.07 10.07 0 014.218-5.618M15.17 15.17l-3.586-3.586m-2.828-2.828L5.17 5.17m13.656 13.656l-3.586-3.586m0 0L9.88 9.88m3.586 3.586L18.83 18.83"/></svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-500" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between text-sm">
            <label class="flex items-center text-gray-300">
                <input type="checkbox" name="remember" class="text-red-600 bg-gray-800 border-gray-700 rounded focus:ring-red-500">
                <span class="ml-2">Ingat Saya</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-gray-400 underline hover:text-white" href="{{ route('password.request') }}">
                    Lupa sandi?
                </a>
            @endif
        </div>

        <div class="flex items-center justify-between mt-4">
            <a class="text-sm text-gray-400 underline hover:text-white" href="{{ route('register') }}">
                Belum punya akun?
            </a>

            <button type="submit" class="py-2.5 px-6 font-bold transition bg-red-600 rounded text-white hover:bg-red-700">
                Masuk
            </button>
        </div>
    </form>

    <!-- Tombol Sosial Media (Google, Facebook, LINE) Kembali Aktif -->
    <div class="mt-6 space-y-3">
        <div class="relative flex items-center py-2">
            <div class="flex-grow border-t border-gray-700"></div>
            <span class="flex-shrink mx-4 text-xs text-gray-400">Atau masuk dengan cepat</span>
            <div class="flex-grow border-t border-gray-700"></div>
        </div>

        <a href="{{ route('social.redirect', 'google') }}" class="w-full flex items-center justify-center py-2.5 px-4 border border-gray-700 rounded bg-gray-800 text-white hover:bg-gray-700 transition font-medium text-sm">
            <span class="mr-2">🌐</span> Masuk dengan Google
        </a>

        <a href="{{ route('social.redirect', 'facebook') }}" class="w-full flex items-center justify-center py-2.5 px-4 border border-gray-700 rounded bg-blue-600 text-white hover:bg-blue-700 transition font-medium text-sm">
            <span class="mr-2">📘</span> Masuk dengan Facebook
        </a>

        <a href="{{ route('social.redirect', 'line') }}" class="w-full flex items-center justify-center py-2.5 px-4 border border-gray-700 rounded bg-green-600 text-white hover:bg-green-700 transition font-medium text-sm">
            <span class="mr-2">💬</span> Masuk dengan LINE
        </a>
    </div>
</x-guest-layout>