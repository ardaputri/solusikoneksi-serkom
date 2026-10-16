<!DOCTYPE html>
<html lang="id">
@php($profil = $profil ?? \App\Models\ProfilPerusahaan::first())
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ ($profil->tagline ?? null) ?: 'Company Profile PT Solusi Koneksi Anda' }}">
    <title>@yield('title', 'Beranda') — {{ config('app.name') }}</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo.svg') }}">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
    @stack('head')
</head>
<body class="d-flex flex-column min-vh-100">

    {{-- ===== NAVBAR ===== --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top shadow">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="{{ route('home') }}">
                <img src="{{ asset('images/logo-putih.svg') }}" alt="Logo {{ config('app.name') }}">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"
                    aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('profil.*') ? 'active' : '' }}" href="{{ route('profil.show') }}">Profil Perusahaan</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('produk.*') ? 'active' : '' }}" href="{{ route('produk.index') }}">Produk / Layanan</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('artikel.*') ? 'active' : '' }}" href="{{ route('artikel.index') }}">Artikel</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('galeri.*') ? 'active' : '' }}" href="{{ route('galeri.index') }}">Galeri Kegiatan</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('kontak.*') ? 'active' : '' }}" href="{{ route('kontak.show') }}">Kontak Kami</a></li>
                    @auth
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 me-1"></i>Admin</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    {{-- ===== PESAN NOTIFIKASI ===== --}}
    @if (session('success'))
        <div class="container mt-3">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-1"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
            </div>
        </div>
    @endif

    {{-- ===== KONTEN ===== --}}
    <main class="flex-grow-1">
        @yield('content')
    </main>

    {{-- ===== FOOTER ===== --}}
    <footer class="bg-dark text-white pt-5 pb-3 mt-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <h5 class="fw-bold mb-3">{{ $profil->nama_perusahaan ?? config('app.name') }}</h5>
                    <p class="text-white-50">{{ \Illuminate\Support\Str::limit($profil->deskripsi ?? 'Menghubungkan solusi digital untuk bisnis Anda.', 140) }}</p>
                    <div class="d-flex gap-3 fs-5">
                        @if ($profil?->facebook) <a href="{{ $profil->facebook }}" class="footer-link" target="_blank" rel="noopener"><i class="bi bi-facebook"></i></a> @endif
                        @if ($profil?->instagram) <a href="{{ $profil->instagram }}" class="footer-link" target="_blank" rel="noopener"><i class="bi bi-instagram"></i></a> @endif
                        @if ($profil?->youtube) <a href="{{ $profil->youtube }}" class="footer-link" target="_blank" rel="noopener"><i class="bi bi-youtube"></i></a> @endif
                        @if ($profil?->linkedin) <a href="{{ $profil->linkedin }}" class="footer-link" target="_blank" rel="noopener"><i class="bi bi-linkedin"></i></a> @endif
                    </div>
                </div>
                <div class="col-6 col-lg-2">
                    <h6 class="fw-bold mb-3">Navigasi</h6>
                    <ul class="list-unstyled d-grid gap-2">
                        <li><a href="{{ route('home') }}" class="footer-link">Beranda</a></li>
                        <li><a href="{{ route('profil.show') }}" class="footer-link">Profil Perusahaan</a></li>
                        <li><a href="{{ route('produk.index') }}" class="footer-link">Produk / Layanan</a></li>
                        <li><a href="{{ route('artikel.index') }}" class="footer-link">Artikel</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-2">
                    <h6 class="fw-bold mb-3">Lainnya</h6>
                    <ul class="list-unstyled d-grid gap-2">
                        <li><a href="{{ route('galeri.index') }}" class="footer-link">Galeri Kegiatan</a></li>
                        <li><a href="{{ route('kontak.show') }}" class="footer-link">Kontak Kami</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h6 class="fw-bold mb-3"><i class="bi bi-geo-alt me-1"></i>Hubungi Kami</h6>
                    <ul class="list-unstyled text-white-50 d-grid gap-2">
                        <li><i class="bi bi-geo-alt-fill me-2"></i>{{ $profil->alamat ?? '—' }}</li>
                        <li><i class="bi bi-telephone-fill me-2"></i>{{ $profil->telepon ?? '—' }}</li>
                        <li><i class="bi bi-envelope-fill me-2"></i>{{ $profil->email ?? '—' }}</li>
                        <li><i class="bi bi-clock me-2"></i>{{ $profil->jam_operasional ?? '—' }}</li>
                    </ul>
                </div>
            </div>
            <hr class="border-secondary">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start text-white-50">
                    &copy; {{ date('Y') }} {{ $profil->nama_perusahaan ?? config('app.name') }}. Hak cipta dilindungi.
                </div>
                <div class="col-md-6 text-center text-md-end text-white-50">
                    Dibuat dengan Laravel &amp; Bootstrap
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    @stack('scripts')
</body>
</html>
