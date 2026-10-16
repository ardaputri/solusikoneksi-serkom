<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index(Request $request)
    {
        $kategoriDipilih = $request->query('kategori');

        $galeri = Galeri::when($kategoriDipilih, fn ($q, $kat) => $q->where('kategori', $kat))
            ->latest('tanggal_kegiatan')->latest('id')
            ->paginate(12)
            ->withQueryString();

        $kategori = Galeri::whereNotNull('kategori')->distinct()->pluck('kategori');

        return view('galeri.index', compact('galeri', 'kategori', 'kategoriDipilih'));
    }
}
