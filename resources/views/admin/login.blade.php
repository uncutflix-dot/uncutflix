<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal - UncutFlix</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen text-white bg-gray-950">

    <div class="w-full max-w-md p-8 bg-gray-900 border border-gray-800 shadow-2xl rounded-2xl">
        
        <!-- Header Portal Admin -->
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-black tracking-wider text-red-600">Uncut<span class="text-white">Flix</span></h1>
            <p class="mt-2 text-xs font-semibold tracking-widest text-gray-400 uppercase">Administrator Control Panel</p>
        </div>

        <!-- Pesan Error jika gagal login / bukan admin -->
        @if ($errors->any())
            <div class="p-3 mb-4 text-xs text-red-200 border border-red-500 rounded-lg bg-red-900/50">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- Form Login Admin -->
        <form method="POST" action="{{ route('admin.login') }}">
            @csrf

            <div class="mb-4">
                <label class="block mb-2 text-xs font-bold text-gray-300 uppercase">Email Administrator</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="w-full px-4 py-3 text-sm text-white bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-600">
            </div>

            <div class="mb-6">
                <label class="block mb-2 text-xs font-bold text-gray-300 uppercase">Password</label>
                <input type="password" name="password" required
                    class="w-full px-4 py-3 text-sm text-white bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-600">
            </div>

            <button type="submit" 
                class="w-full px-4 py-3 text-sm font-bold tracking-wide text-white transition duration-300 bg-red-600 rounded-lg shadow-lg hover:bg-red-700">
                Masuk ke Panel Admin
            </button>
        </form>

        <div class="mt-6 text-center">
            <a href="{{ route('welcome') }}" class="text-xs text-gray-500 transition hover:text-gray-300">← Kembali ke Beranda UncutFlix</a>
        </div>

    </div>

</body>
</html>