<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function index()
    {
        $artikel = Artikel::latest()->paginate(10);

        return view('admin.artikel.index', compact('artikel'));
    }

    public function create()
    {
        return view('admin.artikel.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:100',
            'penulis' => 'nullable|string|max:100',
            'ringkasan' => 'nullable|string|max:500',
            'isi' => 'required|string',
            'is_published' => 'nullable|boolean',
            'published_at' => 'nullable|date',
            'gambar' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
        ]);

        $validated['is_published'] = $request->boolean('is_published');
        $validated['published_at'] = $validated['published_at'] ?? now();
        $validated['gambar'] = $this->simpanGambar($request->file('gambar'), 'artikel');

        Artikel::create($validated);

        return redirect()->route('admin.artikel.index')
            ->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function edit(Artikel $artikel)
    {
        return view('admin.artikel.form', compact('artikel'));
    }

    public function update(Request $request, Artikel $artikel)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:100',
            'penulis' => 'nullable|string|max:100',
            'ringkasan' => 'nullable|string|max:500',
            'isi' => 'required|string',
            'is_published' => 'nullable|boolean',
            'published_at' => 'nullable|date',
            'gambar' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
        ]);

        $validated['is_published'] = $request->boolean('is_published');

        if ($request->hasFile('gambar')) {
            $this->hapusGambar($artikel->gambar);
            $validated['gambar'] = $this->simpanGambar($request->file('gambar'), 'artikel');
        } else {
            unset($validated['gambar']);
        }

        $artikel->update($validated);

        return redirect()->route('admin.artikel.index')
            ->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Artikel $artikel)
    {
        $this->hapusGambar($artikel->gambar);
        $artikel->delete();

        return redirect()->route('admin.artikel.index')
            ->with('success', 'Artikel berhasil dihapus.');
    }
}
