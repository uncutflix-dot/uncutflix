<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    // Menampilkan halaman form tambah film
    public function create()
    {
        return view('movies.create');
    }

    // Menyimpan film baru dengan Link Google Drive
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'genre' => 'required|string',
            'poster' => 'required|image|mimes:jpeg,png,jpg',
            'video_link' => 'required|string', // Menerima link Google Drive
        ]);

        // Simpan poster
        $posterPath = $request->file('poster')->store('posters', 'public');

        Movie::create([
            'title' => $request->title,
            'description' => $request->description,
            'genre' => $request->genre,
            'poster' => $posterPath,
            'video' => $request->video_link, // Simpan link video
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Film berhasil ditambahkan via Link Google Drive!');
    }

    // Menampilkan halaman form edit film
    public function edit($id)
    {
        $movie = Movie::findOrFail($id);
        return view('movies.edit', compact('movie'));
    }

    // Memperbarui film
    public function update(Request $request, $id)
    {
        $movie = Movie::findOrFail($id);

        if ($request->hasFile('poster')) {
            if ($movie->poster && Storage::exists('public/' . $movie->poster)) {
                Storage::delete('public/' . $movie->poster);
            }
            $movie->poster = $request->file('poster')->store('posters', 'public');
        }

        $movie->title = $request->title;
        $movie->genre = $request->genre;
        $movie->description = $request->description;
        $movie->video = $request->video_link; // Update link video
        $movie->save();

        return redirect()->route('admin.dashboard')->with('success', 'Data film berhasil diperbarui!');
    }

    // Menghapus film dari database dan storage
    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        
        if ($movie->poster && Storage::exists('public/' . $movie->poster)) {
            Storage::delete('public/' . $movie->poster);
        }

        $movie->delete();

        return redirect()->back()->with('success', 'Film berhasil dihapus dari sistem!');
    }
}