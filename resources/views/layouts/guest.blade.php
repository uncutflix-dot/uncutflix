<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Masuk - UncutFlix</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="relative min-h-screen font-sans antialiased text-white bg-black selection:bg-red-600 selection:text-white">

    <!-- 1. BACKGROUND IKLAN / PROMO SPONSOR -->
    <!-- Gambar di bawah ini nantinya bisa diganti dinamis dari database admin -->
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1518709268805-4e9042af9f23?q=80&w=1925&auto=format&fit=crop" class="object-cover w-full h-full opacity-50 filter brightness-75" alt="Background Iklan">
        
        <!-- Lapisan Gelap (Overlay) agar iklan tidak mencolok dan tidak mengganggu mata saat mengetik -->
        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/70 to-black/80 backdrop-blur-[2px]"></div>
    </div>

    <!-- Label Kecil Penanda Area Iklan / Sponsor di Background (Opsional) -->
    <div class="absolute z-10 hidden bottom-4 left-4 md:block">
        <span class="bg-black/60 border border-gray-800 text-gray-400 text-[10px] px-3 py-1 rounded-full uppercase tracking-wider">
            Sponsored Background
        </span>
    </div>

    <!-- 2. HEADER LOGO UF KIRI ATAS -->
    <div class="absolute top-0 left-0 z-20 w-full px-6 py-6 md:px-12 md:py-8">
        <a href="/" class="text-4xl font-black tracking-widest text-red-600 transition md:text-5xl drop-shadow-xl hover:text-red-500">UF</a>
    </div>

    <!-- 3. KOTAK FORM LOGIN DI TENGAH -->
    <div class="relative z-10 flex flex-col items-center justify-center min-h-screen px-4 py-8 sm:px-0">
        <div class="w-full px-10 py-14 bg-black/85 sm:max-w-[450px] sm:rounded-md shadow-2xl border border-gray-800/80">
            {{ $slot }}
        </div>
    </div>
    
</body>
</html>