<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index()
    {
        $galeri = Galeri::latest('tanggal_kegiatan')->latest('id')->paginate(12);

        return view('admin.galeri.index', compact('galeri'));
    }

    public function create()
    {
        return view('admin.galeri.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:500',
            'kategori' => 'nullable|string|max:100',
            'tanggal_kegiatan' => 'nullable|date',
            'gambar' => 'required|image|mimes:png,jpg,jpeg,webp|max:4096',
        ]);

        $validated['gambar'] = $this->simpanGambar($request->file('gambar'), 'galeri');

        Galeri::create($validated);

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Foto galeri berhasil ditambahkan.');
    }

    public function edit(Galeri $galeri)
    {
        return view('admin.galeri.form', compact('galeri'));
    }

    public function update(Request $request, Galeri $galeri)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:500',
            'kategori' => 'nullable|string|max:100',
            'tanggal_kegiatan' => 'nullable|date',
            'gambar' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:4096',
        ]);

        if ($request->hasFile('gambar')) {
            $this->hapusGambar($galeri->gambar);
            $validated['gambar'] = $this->simpanGambar($request->file('gambar'), 'galeri');
        } else {
            unset($validated['gambar']);
        }

        $galeri->update($validated);

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Foto galeri berhasil diperbarui.');
    }

    public function destroy(Galeri $galeri)
    {
        $this->hapusGambar($galeri->gambar);
        $galeri->delete();

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Foto galeri berhasil dihapus.');
    }
}
