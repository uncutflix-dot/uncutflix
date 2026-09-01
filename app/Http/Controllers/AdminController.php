<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Advertisement;

class AdminController extends Controller
{
    // Menampilkan halaman Dashboard Admin
    public function index()
    {
        $banners = Banner::all();
        $ads = Advertisement::all();
        
        return view('admin.dashboard', compact('banners', 'ads'));
    }

    // Menyimpan Banner Baru
    public function storeBanner(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required',
        ]);

        Banner::create($request->all());

        return redirect()->back()->with('success', 'Banner berhasil ditambahkan!');
    }

    // Menyimpan Iklan Baru
    public function storeAd(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'position' => 'required',
            'ad_code' => 'required',
        ]);

        Advertisement::create($request->all());

        return redirect()->back()->with('success', 'Slot iklan berhasil ditambahkan!');
    }
}