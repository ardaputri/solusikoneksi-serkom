@extends('layouts.admin')

@section('title', isset($produk) ? 'Edit Produk' : 'Tambah Produk')

@section('content')
    <div class="mb-4">
        <h3 class="fw-bold mb-1">{{ isset($produk) ? 'Edit Produk / Layanan' : 'Tambah Produk / Layanan' }}</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb small mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.produk.index') }}">Produk / Layanan</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ isset($produk) ? 'Edit' : 'Tambah' }}</li>
            </ol>
        </nav>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <form action="{{ isset($produk) ? route('admin.produk.update', $produk) : route('admin.produk.store') }}"
                  method="POST" enctype="multipart/form-data">
                @csrf
                @if (isset($produk)) @method('PUT') @endif

                <div class="row g-3">
                    <div class="col-lg-8">
                        <label for="nama" class="form-label">Nama Produk / Layanan <span class="text-danger">*</span></label>
                        <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror"
                               value="{{ old('nama', $produk->nama ?? '') }}" required>
                        @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-lg-4">
                        <label for="kategori" class="form-label">Kategori</label>
                        <input type="text" name="kategori" id="kategori" class="form-control @error('kategori') is-invalid @enderror"
                               value="{{ old('kategori', $produk->kategori ?? '') }}" placeholder="Contoh: Konektivitas">
                        @error('kategori') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-lg-6">
                        <label for="ikon" class="form-label">Ikon (Bootstrap Icons)</label>
                        <input type="text" name="ikon" id="ikon" class="form-control @error('ikon') is-invalid @enderror"
                               value="{{ old('ikon', $produk->ikon ?? '') }}" placeholder="Contoh: bi bi-globe2">
                        <div class="form-text">Gunakan class ikon seperti <code>bi bi-globe2</code>, <code>bi bi-shield-lock</code>.</div>
                        @error('ikon') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-lg-6">
                        <label for="harga" class="form-label">Harga / Info Harga</label>
                        <input type="text" name="harga" id="harga" class="form-control @error('harga') is-invalid @enderror"
                               value="{{ old('harga', $produk->harga ?? '') }}" placeholder="Contoh: Mulai Rp 350.000/bulan">
                        @error('harga') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" rows="4"
                                  class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $produk->deskripsi ?? '') }}</textarea>
                        @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-lg-4">
                        <label for="urutan" class="form-label">Urutan Tampil</label>
                        <input type="number" name="urutan" id="urutan" min="0" class="form-control @error('urutan') is-invalid @enderror"
                               value="{{ old('urutan', $produk->urutan ?? 0) }}">
                        @error('urutan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-lg-4">
                        <label for="gambar" class="form-label">Gambar</label>
                        <input type="file" name="gambar" id="gambar" accept="image/*"
                               class="form-control @error('gambar') is-invalid @enderror">
                        <div class="form-text">Format: JPG, PNG, WEBP. Maks 2 MB.</div>
                        @error('gambar') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-lg-4 d-flex align-items-end">
                        <div class="form-check form-switch mt-3">
                            <input type="hidden" name="is_aktif" value="0">
                            <input class="form-check-input" type="checkbox" name="is_aktif" id="is_aktif" value="1"
                                   @checked(old('is_aktif', $produk->is_aktif ?? true))>
                            <label class="form-check-label" for="is_aktif">Tampilkan di website (Aktif)</label>
                        </div>
                    </div>

                    @if (isset($produk))
                        <div class="col-12">
                            <label class="form-label">Gambar Saat Ini</label>
                            <div>
                                <img src="{{ asset($produk->gambar ?: 'images/placeholder-produk.svg') }}" alt="{{ $produk->nama }}"
                                     class="rounded border" style="width:160px;height:110px;object-fit:cover;">
                            </div>
                        </div>
                    @endif

                    <div class="col-12 d-flex gap-2 pt-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-check-lg me-1"></i>{{ isset($produk) ? 'Simpan Perubahan' : 'Simpan Produk' }}
                        </button>
                        <a href="{{ route('admin.produk.index') }}" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
