<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Models\Galeri;
use App\Models\PesanKontak;
use App\Models\ProdukLayanan;

class DashboardController extends Controller
{
    public function index()
    {
        $statistik = [
            'produk' => ProdukLayanan::count(),
            'artikel' => Artikel::count(),
            'galeri' => Galeri::count(),
            'pesan_baru' => PesanKontak::where('is_dibaca', false)->count(),
        ];

        $pesanTerbaru = PesanKontak::latest()->take(5)->get();
        $artikelTerbaru = Artikel::latest()->take(5)->get();

        return view('admin.dashboard', compact('statistik', 'pesanTerbaru', 'artikelTerbaru'));
    }
}
