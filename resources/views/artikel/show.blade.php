@extends('layouts.app')

@section('title', $artikel->judul)

@section('content')
    <section class="bg-primary text-white py-5">
        <div class="container py-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50 text-decoration-none">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('artikel.index') }}" class="text-white-50 text-decoration-none">Artikel</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">{{ \Illuminate\Support\Str::limit($artikel->judul, 40) }}</li>
                </ol>
            </nav>
            <h1 class="fw-bold mb-0" style="font-size: clamp(1.5rem, 3vw, 2.25rem)">{{ $artikel->judul }}</h1>
            <div class="d-flex flex-wrap align-items-center gap-3 mt-2 small opacity-75">
                <span><i class="bi bi-person-circle me-1"></i>{{ $artikel->penulis ?? 'Redaksi' }}</span>
                <span><i class="bi bi-calendar3 me-1"></i>{{ optional($artikel->published_at)->translatedFormat('d F Y') }}</span>
                <span><i class="bi bi-eye me-1"></i>{{ $artikel->views }} x dibaca</span>
                @if ($artikel->kategori) <span class="badge text-bg-light text-primary">{{ $artikel->kategori }}</span> @endif
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-8">
                    <img src="{{ asset($artikel->gambar ?: 'images/placeholder-artikel.svg') }}" class="rounded-4 w-100 shadow-sm mb-4" alt="{{ $artikel->judul }}" style="max-height: 420px; object-fit: cover;">
                    <div class="artikel-isi fs-6 text-secondary" style="white-space: pre-line">{{ $artikel->isi }}</div>

                    <hr class="my-5">
                    <a href="{{ route('artikel.index') }}" class="btn btn-outline-primary">
                        <i class="bi bi-arrow-left me-1"></i>Kembali ke Daftar Artikel
                    </a>
                </div>

                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3">Artikel Lainnya</h5>
                            <div class="d-grid gap-3">
                                @forelse ($artikelLain as $lain)
                                    <a href="{{ route('artikel.show', $lain->slug) }}" class="d-flex gap-3 text-decoration-none text-dark">
                                        <img src="{{ asset($lain->gambar ?: 'images/placeholder-artikel.svg') }}" alt="{{ $lain->judul }}" class="rounded-3" style="width: 72px; height: 56px; object-fit: cover;">
                                        <div>
                                            <div class="small fw-semibold">{{ \Illuminate\Support\Str::limit($lain->judul, 55) }}</div>
                                            <div class="small text-secondary">{{ optional($lain->published_at)->translatedFormat('d M Y') }}</div>
                                        </div>
                                    </a>
                                @empty
                                    <span class="text-secondary small">Belum ada artikel lain.</span>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
