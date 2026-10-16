@extends('layouts.admin')

@section('title', isset($artikel) ? 'Edit Artikel' : 'Tambah Artikel')

@section('content')
    <div class="mb-4">
        <h3 class="fw-bold mb-1">{{ isset($artikel) ? 'Edit Artikel' : 'Tambah Artikel' }}</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb small mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.artikel.index') }}">Artikel</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ isset($artikel) ? 'Edit' : 'Tambah' }}</li>
            </ol>
        </nav>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <form action="{{ isset($artikel) ? route('admin.artikel.update', $artikel) : route('admin.artikel.store') }}"
                  method="POST" enctype="multipart/form-data">
                @csrf
                @if (isset($artikel)) @method('PUT') @endif

                <div class="row g-3">
                    <div class="col-12">
                        <label for="judul" class="form-label">Judul Artikel <span class="text-danger">*</span></label>
                        <input type="text" name="judul" id="judul" class="form-control @error('judul') is-invalid @enderror"
                               value="{{ old('judul', $artikel->judul ?? '') }}" required>
                        @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-lg-4">
                        <label for="kategori" class="form-label">Kategori</label>
                        <input type="text" name="kategori" id="kategori" class="form-control @error('kategori') is-invalid @enderror"
                               value="{{ old('kategori', $artikel->kategori ?? '') }}" placeholder="Contoh: Tips">
                        @error('kategori') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-lg-4">
                        <label for="penulis" class="form-label">Penulis</label>
                        <input type="text" name="penulis" id="penulis" class="form-control @error('penulis') is-invalid @enderror"
                               value="{{ old('penulis', $artikel->penulis ?? auth()->user()->name) }}">
                        @error('penulis') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-lg-4">
                        <label for="published_at" class="form-label">Tanggal Terbit</label>
                        <input type="date" name="published_at" id="published_at"
                               class="form-control @error('published_at') is-invalid @enderror"
                               value="{{ old('published_at', optional($artikel->published_at ?? now())->format('Y-m-d')) }}">
                        @error('published_at') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12">
                        <label for="ringkasan" class="form-label">Ringkasan</label>
                        <textarea name="ringkasan" id="ringkasan" rows="2"
                                  class="form-control @error('ringkasan') is-invalid @enderror">{{ old('ringkasan', $artikel->ringkasan ?? '') }}</textarea>
                        @error('ringkasan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12">
                        <label for="isi" class="form-label">Isi Artikel <span class="text-danger">*</span></label>
                        <textarea name="isi" id="isi" rows="10"
                                  class="form-control @error('isi') is-invalid @enderror">{{ old('isi', $artikel->isi ?? '') }}</textarea>
                        @error('isi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-lg-6">
                        <label for="gambar" class="form-label">Gambar Sampul</label>
                        <input type="file" name="gambar" id="gambar" accept="image/*"
                               class="form-control @error('gambar') is-invalid @enderror">
                        <div class="form-text">Format: JPG, PNG, WEBP. Maks 2 MB.</div>
                        @error('gambar') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-lg-6 d-flex align-items-end">
                        <div class="form-check form-switch mt-3">
                            <input type="hidden" name="is_published" value="0">
                            <input class="form-check-input" type="checkbox" name="is_published" id="is_published" value="1"
                                   @checked(old('is_published', $artikel->is_published ?? true))>
                            <label class="form-check-label" for="is_published">Terbitkan di website</label>
                        </div>
                    </div>

                    @if (isset($artikel))
                        <div class="col-12">
                            <label class="form-label">Gambar Saat Ini</label>
                            <div>
                                <img src="{{ asset($artikel->gambar ?: 'images/placeholder-artikel.svg') }}" alt="{{ $artikel->judul }}"
                                     class="rounded border" style="width:180px;height:110px;object-fit:cover;">
                            </div>
                        </div>
                    @endif

                    <div class="col-12 d-flex gap-2 pt-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-check-lg me-1"></i>{{ isset($artikel) ? 'Simpan Perubahan' : 'Simpan Artikel' }}
                        </button>
                        <a href="{{ route('admin.artikel.index') }}" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
