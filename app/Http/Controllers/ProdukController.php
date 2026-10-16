<?php

namespace App\Http\Controllers;

use App\Models\ProdukLayanan;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $kategoriDipilih = $request->query('kategori');

        $produk = ProdukLayanan::aktif()
            ->when($kategoriDipilih, fn ($q, $kat) => $q->where('kategori', $kat))
            ->orderBy('urutan')->orderBy('id')
            ->get();

        $kategori = ProdukLayanan::aktif()->whereNotNull('kategori')
            ->distinct()->pluck('kategori');

        return view('produk.index', compact('produk', 'kategori', 'kategoriDipilih'));
    }

    public function show(string $slug)
    {
        $produk = ProdukLayanan::aktif()->where('slug', $slug)->firstOrFail();

        $produkLain = ProdukLayanan::aktif()->where('id', '!=', $produk->id)
            ->orderBy('urutan')->take(3)->get();

        return view('produk.show', compact('produk', 'produkLain'));
    }
}
