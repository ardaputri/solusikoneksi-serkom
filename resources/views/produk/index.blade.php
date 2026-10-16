@extends('layouts.app')

@section('title', 'Produk / Layanan')

@section('content')
    <section class="bg-primary text-white py-5">
        <div class="container py-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50 text-decoration-none">Beranda</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">Produk / Layanan</li>
                </ol>
            </nav>
            <h1 class="fw-bold mb-0">Produk &amp; Layanan</h1>
            <p class="mb-0 opacity-75">Solusi teknologi informasi untuk segala skala bisnis.</p>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            {{-- Filter kategori --}}
            <div class="d-flex flex-wrap gap-2 mb-4">
                <a href="{{ route('produk.index') }}"
                   class="btn btn-sm rounded-pill {{ $kategoriDipilih ? 'btn-outline-primary' : 'btn-primary' }}">Semua</a>
                @foreach ($kategori as $kat)
                    <a href="{{ route('produk.index', ['kategori' => $kat]) }}"
                       class="btn btn-sm rounded-pill {{ $kategoriDipilih === $kat ? 'btn-primary' : 'btn-outline-primary' }}">{{ $kat }}</a>
                @endforeach
            </div>

            <div class="row g-4">
                @forelse ($produk as $item)
                    <div class="col-md-6 col-lg-4">
                        <div class="card card-produk h-100 shadow-sm rounded-4">
                            <img src="{{ asset($item->gambar ?: 'images/placeholder-produk.svg') }}" class="card-img-top" alt="{{ $item->nama }}" style="height: 180px; object-fit: cover;">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <span class="icon-besar rounded-4 bg-primary bg-opacity-10 text-primary d-inline-flex align-items-center justify-content-center">
                                        <i class="{{ $item->ikon ?: 'bi bi-box-seam' }}"></i>
                                    </span>
                                    @if ($item->kategori)
                                        <span class="badge text-bg-light border">{{ $item->kategori }}</span>
                                    @endif
                                </div>
                                <h5 class="fw-bold">{{ $item->nama }}</h5>
                                <p class="text-secondary small">{{ \Illuminate\Support\Str::limit($item->deskripsi, 120) }}</p>
                                @if ($item->harga)
                                    <div class="fw-semibold text-primary small"><i class="bi bi-tag me-1"></i>{{ $item->harga }}</div>
                                @endif
                            </div>
                            <div class="card-footer bg-white border-0 px-4 pb-4">
                                <a href="{{ route('produk.show', $item->slug) }}" class="btn btn-sm btn-outline-primary rounded-pill">
                                    Selengkapnya <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info mb-0">
                            <i class="bi bi-info-circle me-1"></i>Belum ada produk/layanan yang tersedia.
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
