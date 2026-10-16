@extends('layouts.app')

@section('title', 'Galeri Kegiatan')

@section('content')
    <section class="bg-primary text-white py-5">
        <div class="container py-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50 text-decoration-none">Beranda</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">Galeri Kegiatan</li>
                </ol>
            </nav>
            <h1 class="fw-bold mb-0">Galeri Kegiatan</h1>
            <p class="mb-0 opacity-75">Dokumentasi aktivitas perusahaan bersama klien dan mitra.</p>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            {{-- Filter kategori --}}
            <div class="d-flex flex-wrap gap-2 mb-4">
                <a href="{{ route('galeri.index') }}"
                   class="btn btn-sm rounded-pill {{ $kategoriDipilih ? 'btn-outline-primary' : 'btn-primary' }}">Semua</a>
                @foreach ($kategori as $kat)
                    <a href="{{ route('galeri.index', ['kategori' => $kat]) }}"
                       class="btn btn-sm rounded-pill {{ $kategoriDipilih === $kat ? 'btn-primary' : 'btn-outline-primary' }}">{{ $kat }}</a>
                @endforeach
            </div>

            <div class="row g-3">
                @forelse ($galeri as $foto)
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="galeri-item shadow-sm">
                            <img src="{{ asset($foto->gambar ?: 'images/placeholder-galeri.svg') }}" alt="{{ $foto->judul }}">
                            <div class="overlay">
                                <div>
                                    <div class="fw-bold small">{{ $foto->judul }}</div>
                                    <div class="small opacity-75">
                                        {{ $foto->kategori ?: 'Kegiatan' }} &middot; {{ optional($foto->tanggal_kegiatan)->translatedFormat('d M Y') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info mb-0">
                            <i class="bi bi-info-circle me-1"></i>Belum ada foto galeri tersedia.
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="mt-4 d-flex justify-content-center">
                {{ $galeri->links() }}
            </div>
        </div>
    </section>
@endsection
