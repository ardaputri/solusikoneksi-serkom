<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function index(Request $request)
    {
        $kategoriDipilih = $request->query('kategori');

        $artikel = Artikel::terbit()
            ->when($kategoriDipilih, fn ($q, $kat) => $q->where('kategori', $kat))
            ->latest('published_at')
            ->paginate(6)
            ->withQueryString();

        $kategori = Artikel::terbit()->whereNotNull('kategori')
            ->distinct()->pluck('kategori');

        return view('artikel.index', compact('artikel', 'kategori', 'kategoriDipilih'));
    }

    public function show(string $slug)
    {
        $artikel = Artikel::terbit()->where('slug', $slug)->firstOrFail();
        $artikel->increment('views');

        $artikelLain = Artikel::terbit()->where('id', '!=', $artikel->id)
            ->latest('published_at')->take(3)->get();

        return view('artikel.show', compact('artikel', 'artikelLain'));
    }
}
