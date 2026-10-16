@extends('layouts.admin')

@section('title', isset($galeri) ? 'Edit Foto Galeri' : 'Tambah Foto Galeri')

@section('content')
    <div class="mb-4">
        <h3 class="fw-bold mb-1">{{ isset($galeri) ? 'Edit Foto Galeri' : 'Tambah Foto Galeri' }}</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb small mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.galeri.index') }}">Galeri Kegiatan</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ isset($galeri) ? 'Edit' : 'Tambah' }}</li>
            </ol>
        </nav>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <form action="{{ isset($galeri) ? route('admin.galeri.update', $galeri) : route('admin.galeri.store') }}"
                  method="POST" enctype="multipart/form-data">
                @csrf
                @if (isset($galeri)) @method('PUT') @endif

                <div class="row g-3">
                    <div class="col-lg-8">
                        <label for="judul" class="form-label">Judul Foto <span class="text-danger">*</span></label>
                        <input type="text" name="judul" id="judul" class="form-control @error('judul') is-invalid @enderror"
                               value="{{ old('judul', $galeri->judul ?? '') }}" required>
                        @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-lg-4">
                        <label for="kategori" class="form-label">Kategori</label>
                        <input type="text" name="kategori" id="kategori" class="form-control @error('kategori') is-invalid @enderror"
                               value="{{ old('kategori', $galeri->kategori ?? '') }}" placeholder="Contoh: Pelatihan">
                        @error('kategori') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-lg-6">
                        <label for="tanggal_kegiatan" class="form-label">Tanggal Kegiatan</label>
                        <input type="date" name="tanggal_kegiatan" id="tanggal_kegiatan"
                               class="form-control @error('tanggal_kegiatan') is-invalid @enderror"
                               value="{{ old('tanggal_kegiatan', isset($galeri) ? $galeri->tanggal_kegiatan?->format('Y-m-d') : null) }}">
                        @error('tanggal_kegiatan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-lg-6">
                        <label for="gambar" class="form-label">
                            Gambar {{ isset($galeri) ? '' : '(wajib)' }} @if(!isset($galeri)) <span class="text-danger">*</span> @endif
                        </label>
                        <input type="file" name="gambar" id="gambar" accept="image/*"
                               class="form-control @error('gambar') is-invalid @enderror">
                        <div class="form-text">Format: JPG, PNG, WEBP. Maks 4 MB.</div>
                        @error('gambar') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" rows="3"
                                  class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $galeri->deskripsi ?? '') }}</textarea>
                        @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    @if (isset($galeri))
                        <div class="col-12">
                            <label class="form-label">Gambar Saat Ini</label>
                            <div>
                                <img src="{{ asset($galeri->gambar) }}" alt="{{ $galeri->judul }}"
                                     class="rounded border" style="width:200px;height:140px;object-fit:cover;">
                            </div>
                        </div>
                    @endif

                    <div class="col-12 d-flex gap-2 pt-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-check-lg me-1"></i>{{ isset($galeri) ? 'Simpan Perubahan' : 'Simpan Foto' }}
                        </button>
                        <a href="{{ route('admin.galeri.index') }}" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
