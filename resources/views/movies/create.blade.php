<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Film - UncutFlix Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen text-white bg-zinc-950">

    <!-- Top Navbar Admin -->
    <nav class="flex items-center justify-between px-8 py-4 mb-8 border-b bg-zinc-900 border-zinc-800">
        <div class="flex items-center space-x-3">
            <span class="text-xl font-black tracking-wider text-red-600">UF Admin</span>
            <span class="px-2.5 py-0.5 text-xs font-semibold bg-red-600/20 text-red-500 rounded-full border border-red-600/30">Tambah Konten Cepat</span>
        </div>
        <div>
            <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 text-xs font-bold text-white transition border rounded-lg shadow bg-zinc-800 hover:bg-zinc-700 border-zinc-700">
                ← Kembali ke Dashboard
            </a>
        </div>
    </nav>

    <div class="max-w-2xl px-4 pb-12 mx-auto">
        <div class="p-8 border shadow-2xl bg-zinc-900 rounded-2xl border-zinc-800">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-white">Tambah Film / Series (Google Drive)</h2>
                <p class="mt-1 text-xs text-zinc-400">Tempel link Google Drive kamu di sini agar prosesnya instan dan bebas blokir!</p>
            </div>
            
            <form action="{{ route('movies.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                
                <div>
                    <label class="block mb-2 text-xs font-bold uppercase text-zinc-300">Judul Film / Series</label>
                    <input type="text" name="title" required class="w-full px-4 py-3 text-sm text-white border rounded-lg bg-zinc-800 border-zinc-700 focus:ring-2 focus:ring-red-600 focus:outline-none">
                </div>

                <div>
                    <label class="block mb-2 text-xs font-bold uppercase text-zinc-300">Sinopsis / Deskripsi</label>
                    <textarea name="description" rows="3" required class="w-full px-4 py-3 text-sm text-white border rounded-lg bg-zinc-800 border-zinc-700 focus:ring-2 focus:ring-red-600 focus:outline-none"></textarea>
                </div>
                
                <div>
                    <label class="block mb-2 text-xs font-bold uppercase text-zinc-300">Genre</label>
                    <input type="text" name="genre" required placeholder="Contoh: Action, Romance, Sci-Fi" class="w-full px-4 py-3 text-sm text-white border rounded-lg bg-zinc-800 border-zinc-700 focus:ring-2 focus:ring-red-600 focus:outline-none">
                </div>

                <div>
                    <label class="block mb-2 text-xs font-bold uppercase text-zinc-300">Upload Poster Film (Gambar)</label>
                    <input type="file" name="poster" accept="image/*" required class="w-full text-sm cursor-pointer text-zinc-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-red-900/50 file:text-red-400 hover:file:bg-red-900/80">
                </div>

                <!-- KOTAK LINK GOOGLE DRIVE -->
                <div>
                    <label class="block mb-2 text-xs font-bold uppercase text-zinc-300">Link Google Drive Video</label>
                    <input type="text" name="video_link" required placeholder="Contoh: https://drive.google.com/file/d/.../preview" class="w-full px-4 py-3 text-sm text-white border rounded-lg bg-zinc-800 border-zinc-700 focus:ring-2 focus:ring-red-600 focus:outline-none">
                    <p class="text-[11px] text-amber-400 mt-1">💡 Pastikan akses link Google Drive diset "Siapa saja yang memiliki link" (*Anyone with the link*).</p>
                </div>

                <button type="submit" class="w-full px-4 py-3 text-sm font-bold text-white transition bg-red-600 rounded-lg shadow-lg hover:bg-red-700">
                    Simpan Film Instan 🚀
                </button>
            </form>
        </div>
    </div>

</body>
</html>