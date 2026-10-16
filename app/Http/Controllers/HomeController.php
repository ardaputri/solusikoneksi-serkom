<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Galeri;
use App\Models\ProfilPerusahaan;
use App\Models\ProdukLayanan;

class HomeController extends Controller
{
    public function index()
    {
        $profil = ProfilPerusahaan::first();
        $produk = ProdukLayanan::aktif()->orderBy('urutan')->orderBy('id')->take(6)->get();
        $artikel = Artikel::terbit()->latest('published_at')->take(3)->get();
        $galeri = Galeri::latest('tanggal_kegiatan')->latest('id')->take(6)->get();

        return view('home', compact('profil', 'produk', 'artikel', 'galeri'));
    }
}
