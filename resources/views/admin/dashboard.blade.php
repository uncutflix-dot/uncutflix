<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - UncutFlix</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen text-white bg-zinc-950">

    <!-- Top Navbar Admin -->
    <nav class="flex items-center justify-between px-8 py-4 border-b bg-zinc-900 border-zinc-800">
        <div class="flex items-center space-x-3">
            <span class="text-xl font-black tracking-wider text-red-600">UF Admin</span>
            <span class="px-2.5 py-0.5 text-xs font-semibold bg-red-600/20 text-red-500 rounded-full border border-red-600/30">Pusat Kendali</span>
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{ route('welcome') }}" class="text-xs transition text-zinc-400 hover:text-white">← Kembali ke Beranda</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-xs font-semibold text-red-400 transition hover:text-red-300">Keluar</button>
            </form>
        </div>
    </nav>

    <div class="px-6 py-8 mx-auto max-w-7xl">

        <!-- Notifikasi Sukses -->
        @if(session('success'))
            <div class="p-4 mb-6 text-sm text-green-200 border border-green-500 bg-green-900/50 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        <!-- MENU NAVIGASI TAB -->
        <div class="flex items-center pb-4 mb-8 space-x-3 border-b border-zinc-800">
            <button onclick="switchTab('movies')" id="tab-movies" class="px-5 py-2.5 rounded-xl text-xs font-bold transition bg-red-600 text-white shadow-lg">
                🎬 Kelola Film & Series
            </button>
            <button onclick="switchTab('banners')" id="tab-banners" class="px-5 py-2.5 rounded-xl text-xs font-bold transition bg-zinc-900 text-zinc-400 hover:text-white border border-zinc-800">
                🖼️ Kelola Banner Utama
            </button>
            <button onclick="switchTab('ads')" id="tab-ads" class="px-5 py-2.5 rounded-xl text-xs font-bold transition bg-zinc-900 text-zinc-400 hover:text-white border border-zinc-800">
                📢 Kelola Iklan & Sponsor
            </button>
        </div>

        <!-- KONTEN TAB 1: KELOLA FILM -->
        <div id="content-movies" class="tab-content">
            <div class="p-6 border shadow-xl bg-zinc-900 rounded-2xl border-zinc-800">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-xl font-bold text-white">Daftar Film & Series</h2>
                        <p class="mt-1 text-xs text-zinc-400">Semua video yang tayang di halaman utama dapat dikelola di sini.</p>
                    </div>
                    <a href="{{ route('movies.create') }}" class="bg-red-600 hover:bg-red-700 text-white text-xs font-bold px-4 py-2.5 rounded-lg transition shadow-lg flex items-center space-x-2">
                        <span>+ Upload Film Baru</span>
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="text-xs tracking-wider uppercase border-b border-zinc-800 text-zinc-400">
                                <th class="px-4 py-3">Poster</th>
                                <th class="px-4 py-3">Judul Film</th>
                                <th class="px-4 py-3">Genre</th>
                                <th class="px-4 py-3">Aksi Kontrol</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-zinc-800/60">
                            @forelse($movies as $movie)
                                <tr class="transition hover:bg-zinc-800/40">
                                    <td class="px-4 py-3">
                                        <img src="{{ asset('storage/' . $movie->poster) }}" class="object-cover w-12 h-16 border rounded-md border-zinc-700" alt="Poster">
                                    </td>
                                    <td class="px-4 py-3 font-semibold text-white">{{ $movie->title }}</td>
                                    <td class="px-4 py-3 capitalize text-zinc-400">{{ $movie->genre }}</td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('movies.edit', $movie->id) }}" class="text-xs text-blue-400 hover:text-blue-300 font-semibold bg-blue-950/40 border border-blue-900 px-3 py-1.5 rounded-md transition">Edit</a>
                                            
                                            <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus film ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-xs text-red-400 hover:text-red-300 font-semibold bg-red-950/40 border border-red-900 px-3 py-1.5 rounded-md transition">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-8 text-sm text-center text-zinc-500">
                                        Belum ada film yang di-upload. Silakan klik tombol "+ Upload Film Baru".
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- KONTEN TAB 2: KELOLA BANNER -->
        <div id="content-banners" class="hidden tab-content">
            <div class="max-w-2xl p-6 border shadow-xl bg-zinc-900 rounded-2xl border-zinc-800">
                <h3 class="mb-2 text-lg font-bold text-white">Tambah Banner Film / Series</h3>
                <p class="mb-6 text-xs text-zinc-400">Banner sorotan utama di bagian atas beranda platform.</p>
                
                <form action="{{ route('admin.banner.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block mb-2 text-xs font-bold uppercase text-zinc-300">Judul Film / Series</label>
                        <input type="text" name="title" required class="w-full bg-zinc-800 border border-zinc-700 rounded-lg px-4 py-2.5 text-sm text-white focus:ring-2 focus:ring-red-600 focus:outline-none">
                    </div>
                    <div>
                        <label class="block mb-2 text-xs font-bold uppercase text-zinc-300">URL Gambar Poster</label>
                        <input type="text" name="image" required placeholder="https://..." class="w-full bg-zinc-800 border border-zinc-700 rounded-lg px-4 py-2.5 text-sm text-white focus:ring-2 focus:ring-red-600 focus:outline-none">
                    </div>
                    <div>
                        <label class="block mb-2 text-xs font-bold uppercase text-zinc-300">Sinopsis Singkat</label>
                        <textarea name="description" rows="3" required class="w-full bg-zinc-800 border border-zinc-700 rounded-lg px-4 py-2.5 text-sm text-white focus:ring-2 focus:ring-red-600 focus:outline-none"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2.5 rounded-lg transition shadow-lg text-sm">Simpan Banner</button>
                </form>
            </div>
        </div>

        <!-- KONTEN TAB 3: KELOLA IKLAN -->
        <div id="content-ads" class="hidden tab-content">
            <div class="max-w-2xl p-6 border shadow-xl bg-zinc-900 rounded-2xl border-zinc-800">
                <h3 class="mb-2 text-lg font-bold text-white">Tambah Iklan / Sponsor Baru</h3>
                <p class="mb-6 text-xs text-zinc-400">Slot iklan komersial yang akan tampil di area member.</p>
                
                <form action="{{ route('admin.ad.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block mb-2 text-xs font-bold uppercase text-zinc-300">Nama Sponsor / Iklan</label>
                        <input type="text" name="name" required placeholder="Contoh: Banner Samping / AdSense" class="w-full bg-zinc-800 border border-zinc-700 rounded-lg px-4 py-2.5 text-sm text-white focus:ring-2 focus:ring-red-600 focus:outline-none">
                    </div>
                    <div>
                        <label class="block mb-2 text-xs font-bold uppercase text-zinc-300">Posisi Tampilan</label>
                        <select name="position" class="w-full bg-zinc-800 border border-zinc-700 rounded-lg px-4 py-2.5 text-sm text-white focus:ring-2 focus:ring-red-600 focus:outline-none">
                            <option value="sidebar">Sidebar Samping</option>
                            <option value="homepage">Bawah Banner Utama (Homepage)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-xs font-bold uppercase text-zinc-300">Script Iklan / URL Banner</label>
                        <textarea name="ad_code" rows="4" required placeholder="Masukkan URL gambar atau kode HTML iklan..." class="w-full bg-zinc-800 border border-zinc-700 rounded-lg px-4 py-2.5 text-sm text-white focus:ring-2 focus:ring-red-600 focus:outline-none"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-amber-500 hover:bg-amber-600 text-zinc-950 font-bold py-2.5 rounded-lg transition shadow-lg text-sm">Simpan Slot Iklan</button>
                </form>
            </div>
        </div>

    </div>

    <!-- Script JavaScript Sederhana Untuk Navigasi Tab -->
    <script>
        function switchTab(tabName) {
            // Sembunyikan semua konten tab
            document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
            
            // Reset semua tombol navigasi ke warna non-aktif
            document.getElementById('tab-movies').className = "px-5 py-2.5 rounded-xl text-xs font-bold transition bg-zinc-900 text-zinc-400 hover:text-white border border-zinc-800";
            document.getElementById('tab-banners').className = "px-5 py-2.5 rounded-xl text-xs font-bold transition bg-zinc-900 text-zinc-400 hover:text-white border border-zinc-800";
            document.getElementById('tab-ads').className = "px-5 py-2.5 rounded-xl text-xs font-bold transition bg-zinc-900 text-zinc-400 hover:text-white border border-zinc-800";
            
            // Tampilkan tab yang dipilih dan aktifkan tombolnya
            if (tabName === 'movies') {
                document.getElementById('content-movies').classList.remove('hidden');
                document.getElementById('tab-movies').className = "px-5 py-2.5 rounded-xl text-xs font-bold transition bg-red-600 text-white shadow-lg";
            } else if (tabName === 'banners') {
                document.getElementById('content-banners').classList.remove('hidden');
                document.getElementById('tab-banners').className = "px-5 py-2.5 rounded-xl text-xs font-bold transition bg-red-600 text-white shadow-lg";
            } else if (tabName === 'ads') {
                document.getElementById('content-ads').classList.remove('hidden');
                document.getElementById('tab-ads').className = "px-5 py-2.5 rounded-xl text-xs font-bold transition bg-amber-500 text-zinc-950 shadow-lg";
            }
        }
    </script>

</body>
</html>