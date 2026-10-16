<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProdukLayanan;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = ProdukLayanan::orderBy('urutan')->orderBy('id', 'desc')->paginate(10);

        return view('admin.produk.index', compact('produk'));
    }

    public function create()
    {
        return view('admin.produk.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:100',
            'ikon' => 'nullable|string|max:100',
            'harga' => 'nullable|string|max:100',
            'deskripsi' => 'nullable|string',
            'urutan' => 'nullable|integer|min:0',
            'is_aktif' => 'nullable|boolean',
            'gambar' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
        ]);

        $validated['is_aktif'] = $request->boolean('is_aktif');
        $validated['gambar'] = $this->simpanGambar($request->file('gambar'), 'produk');

        ProdukLayanan::create($validated);

        return redirect()->route('admin.produk.index')
            ->with('success', 'Produk/layanan berhasil ditambahkan.');
    }

    public function edit(ProdukLayanan $produk)
    {
        return view('admin.produk.form', compact('produk'));
    }

    public function update(Request $request, ProdukLayanan $produk)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:100',
            'ikon' => 'nullable|string|max:100',
            'harga' => 'nullable|string|max:100',
            'deskripsi' => 'nullable|string',
            'urutan' => 'nullable|integer|min:0',
            'is_aktif' => 'nullable|boolean',
            'gambar' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
        ]);

        $validated['is_aktif'] = $request->boolean('is_aktif');

        if ($request->hasFile('gambar')) {
            $this->hapusGambar($produk->gambar);
            $validated['gambar'] = $this->simpanGambar($request->file('gambar'), 'produk');
        } else {
            unset($validated['gambar']);
        }

        $produk->update($validated);

        return redirect()->route('admin.produk.index')
            ->with('success', 'Produk/layanan berhasil diperbarui.');
    }

    public function destroy(ProdukLayanan $produk)
    {
        $this->hapusGambar($produk->gambar);
        $produk->delete();

        return redirect()->route('admin.produk.index')
            ->with('success', 'Produk/layanan berhasil dihapus.');
    }
}
