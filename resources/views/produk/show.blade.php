@extends('layouts.app')

@section('title', $produk->nama)

@section('content')
    <section class="bg-primary text-white py-5">
        <div class="container py-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50 text-decoration-none">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('produk.index') }}" class="text-white-50 text-decoration-none">Produk / Layanan</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">{{ $produk->nama }}</li>
                </ol>
            </nav>
            <h1 class="fw-bold mb-0">{{ $produk->nama }}</h1>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-8">
                    <img src="{{ asset($produk->gambar ?: 'images/placeholder-produk.svg') }}" class="rounded-4 w-100 shadow-sm" alt="{{ $produk->nama }}" style="max-height: 420px; object-fit: cover;">
                    <h3 class="fw-bold mt-4">{{ $produk->nama }}</h3>
                    <div class="mb-3 d-flex flex-wrap gap-2">
                        @if ($produk->kategori) <span class="badge text-bg-primary">{{ $produk->kategori }}</span> @endif
                        @if ($produk->harga) <span class="badge text-bg-light border"><i class="bi bi-tag me-1"></i>{{ $produk->harga }}</span> @endif
                    </div>
                    <p class="text-secondary" style="white-space: pre-line">{{ $produk->deskripsi ?? 'Deskripsi belum tersedia.' }}</p>
                    <a href="{{ route('kontak.show') }}" class="btn btn-primary mt-2">
                        <i class="bi bi-chat-dots me-1"></i>Tanya Layanan Ini
                    </a>
                </div>

                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3">Layanan Lainnya</h5>
                            <div class="d-grid gap-3">
                                @forelse ($produkLain as $lain)
                                    <a href="{{ route('produk.show', $lain->slug) }}" class="d-flex align-items-center gap-3 text-decoration-none text-dark">
                                        <span class="rounded-3 bg-primary bg-opacity-10 text-primary d-inline-flex align-items-center justify-content-center" style="width:48px;height:48px;">
                                            <i class="{{ $lain->ikon ?: 'bi bi-box-seam' }} fs-5"></i>
                                        </span>
                                        <span class="fw-semibold small">{{ $lain->nama }}</span>
                                    </a>
                                @empty
                                    <span class="text-secondary small">Tidak ada layanan lain.</span>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
