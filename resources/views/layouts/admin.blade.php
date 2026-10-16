<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — {{ config('app.name') }}</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo.svg') }}">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
<div class="d-flex flex-column flex-lg-row">
    {{-- ===== SIDEBAR ===== --}}
    <aside class="sidebar p-3 flex-shrink-0">
        <a href="{{ route('home') }}" class="d-flex align-items-center gap-2 text-white fw-bold fs-5 mb-3 px-2 py-2 text-decoration-none">
            <img src="{{ asset('images/logo.svg') }}" alt="Logo" style="filter: brightness(0) invert(1); height: 32px;">
        </a>
        <hr class="border-secondary">
        <nav class="d-grid gap-1">
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <div class="text-uppercase small text-white-50 px-3 mt-3 mb-1">Konten Dinamis</div>
            <a href="{{ route('admin.produk.index') }}" class="{{ request()->routeIs('admin.produk.*') ? 'active' : '' }}">
                <i class="bi bi-box-seam"></i> Produk / Layanan
            </a>
            <a href="{{ route('admin.artikel.index') }}" class="{{ request()->routeIs('admin.artikel.*') ? 'active' : '' }}">
                <i class="bi bi-newspaper"></i> Artikel
            </a>
            <a href="{{ route('admin.galeri.index') }}" class="{{ request()->routeIs('admin.galeri.*') ? 'active' : '' }}">
                <i class="bi bi-images"></i> Galeri Kegiatan
            </a>
            <div class="text-uppercase small text-white-50 px-3 mt-3 mb-1">Lainnya</div>
            <a href="{{ route('admin.profil.edit') }}" class="{{ request()->routeIs('admin.profil.*') ? 'active' : '' }}">
                <i class="bi bi-building"></i> Profil Perusahaan
            </a>
            <a href="{{ route('admin.pesan.index') }}" class="{{ request()->routeIs('admin.pesan.*') ? 'active' : '' }}">
                <i class="bi bi-envelope-paper"></i> Pesan Masuk
                @if (\App\Models\PesanKontak::where('is_dibaca', false)->count() > 0)
                    <span class="badge text-bg-danger ms-auto">{{ \App\Models\PesanKontak::where('is_dibaca', false)->count() }}</span>
                @endif
            </a>
        </nav>
        <hr class="border-secondary">
        <a href="{{ route('home') }}" class="d-block small text-white-50 px-3 mb-2 text-decoration-none">
            <i class="bi bi-globe me-1"></i>Lihat Website
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline-light btn-sm w-100">
                <i class="bi bi-box-arrow-right me-1"></i>Keluar ({{ auth()->user()->name }})
            </button>
        </form>
    </aside>

    {{-- ===== KONTEN ===== --}}
    <main class="flex-grow-1 p-3 p-md-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-1"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <div class="fw-semibold mb-1"><i class="bi bi-exclamation-triangle me-1"></i>Terjadi kesalahan:</div>
                <ul class="mb-0 small">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>
</div>

<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
