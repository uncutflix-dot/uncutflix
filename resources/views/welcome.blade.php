<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UncutFlix - Streaming Privat</title>
    
    <!-- Kode Keamanan Anti-Search Engine (Web Tidak Akan Masuk Google) -->
    <meta name="robots" content="noindex, nofollow, noarchive">
    <meta name="googlebot" content="noindex, nofollow, nosnippet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#141414] text-white overflow-x-hidden font-sans">

    <!-- 1. Navbar -->
    <nav class="absolute top-0 z-50 flex items-center justify-between w-full px-8 py-4 bg-gradient-to-b from-black/90 to-transparent">
        <div class="flex items-center space-x-8">
            <div class="text-2xl font-black tracking-wider text-red-600">UncutFlix</div>
            <div class="hidden space-x-6 text-sm font-medium text-gray-300 md:flex">
                <a href="#" class="font-semibold text-white transition hover:text-red-500">Untukmu</a>
                <a href="#" class="transition hover:text-red-500">Hiburan</a>
                <a href="#" class="transition hover:text-red-500">Film</a>
                <a href="#" class="transition hover:text-red-500">Series</a>
            </div>
        </div>

        <div class="flex items-center space-x-4">
            <div class="hidden lg:flex items-center bg-black/40 border border-gray-700 rounded-full px-4 py-1.5">
                <input type="text" placeholder="Cari film atau drama..." class="w-48 text-sm text-white bg-transparent focus:outline-none">
                <span class="text-xs text-gray-400">🔍</span>
            </div>
            <!-- Tombol Admin Login (Hanya untuk kamu) -->
            <a href="{{ route('admin.login') }}" class="px-5 py-1.5 text-sm font-bold transition bg-red-600 rounded-full hover:bg-red-700">Masuk Admin</a>
        </div>
    </nav>

    <!-- 2. Hero Carousel / Banner -->
    <div class="relative w-full h-[75vh] bg-black overflow-hidden">
        <img src="https://images.unsplash.com/photo-1536440136628-849c177e76a1?q=80&w=1925&auto=format&fit=crop" class="object-cover w-full h-full opacity-60" alt="Banner">
        <div class="absolute inset-0 bg-gradient-to-t from-[#141414] via-black/40 to-black/60"></div>

        <button class="absolute z-20 p-3 text-xl text-white -translate-y-1/2 rounded-full left-4 top-1/2 bg-black/50 hover:bg-black">❮</button>
        <button class="absolute z-20 p-3 text-xl text-white -translate-y-1/2 rounded-full right-4 top-1/2 bg-black/50 hover:bg-black">❯</button>

        <div class="absolute z-10 max-w-xl bottom-12 left-10 md:left-16">
            <span class="px-2.5 py-1 text-xs font-bold bg-red-600 rounded">HOT</span>
            <h1 class="mt-3 mb-2 text-3xl font-extrabold md:text-5xl">Koleksi Eksklusif</h1>
            <p class="mb-4 text-xs text-gray-300 md:text-sm line-clamp-2">Nikmati tayangan eksklusif langsung dari perangkatmu. Khusus untuk penonton VIP.</p>
            <div class="flex space-x-3">
                <button class="px-6 py-2.5 text-sm font-bold bg-red-600 rounded hover:bg-red-700 transition">▶ Nonton</button>
            </div>
        </div>
    </div>

    <!-- 3. SLOT IKLAN -->
    <div class="px-8 my-6">
        <div class="flex flex-col items-center justify-between w-full p-4 border border-gray-800 shadow-lg bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 rounded-xl md:flex-row">
            <div class="flex items-center mb-2 space-x-4 md:mb-0">
                <span class="bg-yellow-500 text-black text-xs font-bold px-2.5 py-1 rounded uppercase tracking-wider">Sponsor / Iklan</span>
                <p class="text-xs text-gray-400 md:text-sm">Area ini nanti akan diisi script otomatis dari penyedia iklan.</p>
            </div>
        </div>
    </div>

    <!-- 4. Section Kategori Film (Dinamis dari Database) -->
    <div class="px-8 py-4">
        <h2 class="pl-3 mb-4 text-xl font-bold border-l-4 border-red-600">Terbaru di UncutFlix</h2>
        
        <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-5">
            @forelse($movies as $movie)
                <!-- Card Film Dinamis -->
                <div class="overflow-hidden bg-gray-800 rounded-lg cursor-pointer group">
                    <div class="h-48 overflow-hidden bg-gray-700">
                        <img src="{{ asset('storage/' . $movie->poster) }}" class="object-cover w-full h-full transition duration-300 group-hover:scale-105" alt="{{ $movie->title }}">
                    </div>
                    <div class="p-3">
                        <h3 class="text-sm font-semibold truncate">{{ $movie->title }}</h3>
                        <p class="mt-1 text-xs text-gray-400 truncate">{{ $movie->genre }}</p>
                    </div>
                </div>
            @empty
                <p class="py-4 text-gray-400 col-span-full">Belum ada tayangan yang di-upload. Silakan tambah konten melalui halaman admin.</p>
            @endforelse
        </div>
    </div>

    <!-- Footer -->
    <footer class="px-8 py-6 mt-10 text-xs text-center text-gray-500 border-t border-gray-800">
        &copy; 2026 UncutFlix. All rights reserved. Privat dan Eksklusif.
    </footer>

</body>
</html>