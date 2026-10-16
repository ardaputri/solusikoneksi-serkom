@extends('layouts.app')

@section('title', 'Artikel & Informasi Terkini')

@section('content')
    <section class="bg-primary text-white py-5">
        <div class="container py-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50 text-decoration-none">Beranda</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">Artikel</li>
                </ol>
            </nav>
            <h1 class="fw-bold mb-0">Artikel &amp; Informasi Terkini</h1>
            <p class="mb-0 opacity-75">Berita, tips, dan informasi terbaru seputar teknologi informasi.</p>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            {{-- Filter kategori --}}
            <div class="d-flex flex-wrap gap-2 mb-4">
                <a href="{{ route('artikel.index') }}"
                   class="btn btn-sm rounded-pill {{ $kategoriDipilih ? 'btn-outline-primary' : 'btn-primary' }}">Semua</a>
                @foreach ($kategori as $kat)
                    <a href="{{ route('artikel.index', ['kategori' => $kat]) }}"
                       class="btn btn-sm rounded-pill {{ $kategoriDipilih === $kat ? 'btn-primary' : 'btn-outline-primary' }}">{{ $kat }}</a>
                @endforeach
            </div>

            <div class="row g-4">
                @forelse ($artikel as $item)
                    <div class="col-md-6 col-lg-4">
                        <div class="card card-artikel h-100 shadow-sm rounded-4 overflow-hidden">
                            <div class="overflow-hidden">
                                <img src="{{ asset($item->gambar ?: 'images/placeholder-artikel.svg') }}" class="card-img-top" alt="{{ $item->judul }}" style="height: 190px; object-fit: cover;">
                            </div>
                            <div class="card-body p-4 d-flex flex-column">
                                <div class="d-flex align-items-center gap-2 small text-secondary mb-2 flex-wrap">
                                    <span class="badge text-bg-primary">{{ $item->kategori ?: 'Informasi' }}</span>
                                    <span><i class="bi bi-calendar3 me-1"></i>{{ optional($item->published_at)->translatedFormat('d M Y') }}</span>
                                    <span><i class="bi bi-eye me-1"></i>{{ $item->views }}</span>
                                </div>
                                <h6 class="fw-bold">{{ $item->judul }}</h6>
                                <p class="text-secondary small flex-grow-1">{{ \Illuminate\Support\Str::limit($item->ringkasan, 110) }}</p>
                                <a href="{{ route('artikel.show', $item->slug) }}" class="small fw-semibold text-decoration-none mt-auto">
                                    Baca selengkapnya <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info mb-0">
                            <i class="bi bi-info-circle me-1"></i>Belum ada artikel yang diterbitkan.
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="mt-4 d-flex justify-content-center">
                {{ $artikel->links() }}
            </div>
        </div>
    </section>
@endsection
