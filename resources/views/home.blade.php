@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    {{-- ===== HERO ===== --}}
    <section class="hero py-5">
        <div class="container py-5">
            <div class="row align-items-center g-5">
                <div class="col-lg-7">
                    <div class="hero-brand">PT Solusi Koneksi Anda</div>
                    <span class="badge text-bg-light mb-3 px-3 py-2">
                        <i class="bi bi-stars me-1"></i>Solusi Teknologi Informasi Terpercaya
                    </span>
                    <h1 class="display-5 mb-3">{{ $profil->tagline ?? 'Menghubungkan Solusi Digital untuk Bisnis Anda' }}</h1>
                    <p class="lead mb-4">{{ \Illuminate\Support\Str::limit($profil->deskripsi ?? '', 220) }}</p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="{{ route('produk.index') }}" class="btn btn-light btn-lg px-4 fw-semibold">
                            <i class="bi bi-grid me-2"></i>Lihat Layanan Kami
                        </a>
                        <a href="{{ route('kontak.show') }}" class="btn btn-outline-light btn-lg px-4">
                            <i class="bi bi-envelope me-2"></i>Hubungi Kami
                        </a>
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block text-center">
                    <div class="bg-white rounded-4 shadow p-4">
                        <div class="row text-primary">
                            <div class="col-4"><i class="bi bi-globe2 fs-1"></i><div class="small text-dark mt-1">Konektivitas</div></div>
                            <div class="col-4"><i class="bi bi-shield-lock fs-1"></i><div class="small text-dark mt-1">Keamanan</div></div>
                            <div class="col-4"><i class="bi bi-cloud-arrow-up fs-1"></i><div class="small text-dark mt-1">Cloud</div></div>
                        </div>
                        <hr>
                        <div class="row g-3">
                            <div class="col-6">
                                <div class="display-6 fw-bold text-primary">{{ \App\Models\ProdukLayanan::aktif()->count() }}+</div>
                                <div class="small text-secondary">Layanan</div>
                            </div>
                            <div class="col-6">
                                <div class="display-6 fw-bold text-primary">{{ $profil->berdiri_sejak ?? '2015' }}</div>
                                <div class="small text-secondary">Berdidir sejak</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== TENTANG SINGKAT ===== --}}
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-lg-6">
                    <h2 class="section-title fw-bold">Tentang {{ $profil->nama_perusahaan ?? config('app.name') }}</h2>
                    <p class="text-secondary mt-3">{{ $profil->deskripsi ?? 'Profil perusahaan belum tersedia.' }}</p>
                    <a href="{{ route('profil.show') }}" class="btn btn-outline-primary mt-2">
                        Selengkapnya <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
                <div class="col-lg-6">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body">
                                    <i class="bi bi-eye text-primary fs-2"></i>
                                    <h6 class="fw-bold mt-2">Visi</h6>
                                    <p class="small text-secondary mb-0">{{ \Illuminate\Support\Str::limit($profil->visi ?? '—', 100) }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body">
                                    <i class="bi bi-bullseye text-primary fs-2"></i>
                                    <h6 class="fw-bold mt-2">Misi</h6>
                                    <p class="small text-secondary mb-0">{{ \Illuminate\Support\Str::limit($profil->misi ?? '—', 100) }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card border-0 shadow-sm bg-primary text-white">
                                <div class="card-body d-flex align-items-center gap-3">
                                    <i class="bi bi-headset fs-1"></i>
                                    <div>
                                        <div class="fw-bold">Butuh konsultasi?</div>
                                        <div class="small opacity-75">Tim kami siap membantu kebutuhan teknologi informasi bisnis Anda.</div>
                                    </div>
                                    <a href="{{ route('kontak.show') }}" class="btn btn-light ms-auto d-none d-md-block">Kontak</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== PRODUK / LAYANAN ===== --}}
    <section class="py-5 bg-light">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end flex-wrap gap-2 mb-4">
                <div>
                    <h2 class="section-title fw-bold mb-1">Produk &amp; Layanan</h2>
                    <p class="text-secondary mb-0">Solusi lengkap untuk mendukung operasional bisnis Anda.</p>
                </div>
                <a href="{{ route('produk.index') }}" class="btn btn-primary">Lihat Semua <i class="bi bi-arrow-right ms-1"></i></a>
            </div>
            <div class="row g-4">
                @forelse ($produk as $item)
                    <div class="col-md-6 col-lg-4">
                        <div class="card card-produk h-100 shadow-sm rounded-4">
                            <div class="card-body p-4">
                                <div class="icon-besar rounded-4 bg-primary bg-opacity-10 text-primary d-inline-flex align-items-center justify-content-center mb-3">
                                    <i class="{{ $item->ikon ?: 'bi bi-box-seam' }}"></i>
                                </div>
                                <h5 class="fw-bold">{{ $item->nama }}</h5>
                                <p class="text-secondary small mb-2">{{ \Illuminate\Support\Str::limit($item->deskripsi, 110) }}</p>
                                @if ($item->harga)
                                    <span class="badge text-bg-light border">{{ $item->harga }}</span>
                                @endif
                            </div>
                            <div class="card-footer bg-white border-0 px-4 pb-4">
                                <a href="{{ route('produk.show', $item->slug) }}" class="btn btn-sm btn-outline-primary rounded-pill">
                                    Detail <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-secondary">Belum ada produk/layanan tersedia.</p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- ===== ARTIKEL TERBARU ===== --}}
    <section class="py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end flex-wrap gap-2 mb-4">
                <div>
                    <h2 class="section-title fw-bold mb-1">Artikel &amp; Informasi Terkini</h2>
                    <p class="text-secondary mb-0">Berita, tips, dan informasi terbaru dari kami.</p>
                </div>
                <a href="{{ route('artikel.index') }}" class="btn btn-primary">Semua Artikel <i class="bi bi-arrow-right ms-1"></i></a>
            </div>
            <div class="row g-4">
                @forelse ($artikel as $item)
                    <div class="col-md-6 col-lg-4">
                        <div class="card card-artikel h-100 shadow-sm rounded-4 overflow-hidden">
                            <div class="overflow-hidden">
                                <img src="{{ asset($item->gambar ?: 'images/placeholder-artikel.svg') }}" class="card-img-top" alt="{{ $item->judul }}" style="height: 190px; object-fit: cover;">
                            </div>
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center gap-2 small text-secondary mb-2">
                                    <span class="badge text-bg-primary">{{ $item->kategori ?: 'Informasi' }}</span>
                                    <span><i class="bi bi-calendar3 me-1"></i>{{ optional($item->published_at)->translatedFormat('d M Y') }}</span>
                                </div>
                                <h6 class="fw-bold">{{ $item->judul }}</h6>
                                <p class="text-secondary small mb-2">{{ \Illuminate\Support\Str::limit($item->ringkasan, 100) }}</p>
                                <a href="{{ route('artikel.show', $item->slug) }}" class="small fw-semibold text-decoration-none">
                                    Baca selengkapnya <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-secondary">Belum ada artikel diterbitkan.</p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- ===== GALERI ===== --}}
    <section class="py-5 bg-light">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end flex-wrap gap-2 mb-4">
                <div>
                    <h2 class="section-title fw-bold mb-1">Galeri Kegiatan</h2>
                    <p class="text-secondary mb-0">Dokumentasi aktivitas perusahaan bersama klien dan mitra.</p>
                </div>
                <a href="{{ route('galeri.index') }}" class="btn btn-primary">Buka Galeri <i class="bi bi-arrow-right ms-1"></i></a>
            </div>
            <div class="row g-3">
                @forelse ($galeri as $foto)
                    <div class="col-6 col-md-4">
                        <div class="galeri-item shadow-sm">
                            <img src="{{ asset($foto->gambar ?: 'images/placeholder-galeri.svg') }}" alt="{{ $foto->judul }}">
                            <div class="overlay">
                                <div>
                                    <div class="fw-bold small">{{ $foto->judul }}</div>
                                    <div class="small opacity-75">{{ optional($foto->tanggal_kegiatan)->translatedFormat('d M Y') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-secondary">Belum ada foto galeri.</p>
                @endforelse
            </div>
        </div>
    </section>
@endsection
