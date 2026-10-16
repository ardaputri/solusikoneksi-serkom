@extends('layouts.app')

@section('title', 'Profil Perusahaan')

@section('content')
    {{-- Header halaman --}}
    <section class="bg-primary text-white py-5">
        <div class="container py-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50 text-decoration-none">Beranda</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">Profil Perusahaan</li>
                </ol>
            </nav>
            <h1 class="fw-bold mb-0">Profil Perusahaan</h1>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            @php $profil = $profil ?? null; @endphp
            @if ($profil)
                {{-- Tentang perusahaan --}}
                <div class="row g-5">
                    <div class="col-lg-8">
                        <h2 class="section-title fw-bold">Tentang Kami</h2>
                        <p class="lead mt-3">{{ $profil->tagline }}</p>
                        <p class="text-secondary" style="white-space: pre-line">{{ $profil->deskripsi }}</p>

                        <div class="row g-4 mt-2">
                            <div class="col-md-6">
                                <div class="card h-100 border-0 shadow-sm rounded-4">
                                    <div class="card-body p-4">
                                        <div class="d-flex align-items-center gap-2 mb-2">
                                            <span class="icon-besar rounded-4 bg-primary bg-opacity-10 text-primary d-inline-flex align-items-center justify-content-center">
                                                <i class="bi bi-eye"></i>
                                            </span>
                                            <h4 class="fw-bold mb-0">Visi</h4>
                                        </div>
                                        <p class="text-secondary mb-0" style="white-space: pre-line">{{ $profil->visi ?? '—' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card h-100 border-0 shadow-sm rounded-4">
                                    <div class="card-body p-4">
                                        <div class="d-flex align-items-center gap-2 mb-2">
                                            <span class="icon-besar rounded-4 bg-primary bg-opacity-10 text-primary d-inline-flex align-items-center justify-content-center">
                                                <i class="bi bi-bullseye"></i>
                                            </span>
                                            <h4 class="fw-bold mb-0">Misi</h4>
                                        </div>
                                        <p class="text-secondary mb-0" style="white-space: pre-line">{{ $profil->misi ?? '—' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Informasi singkat --}}
                    <div class="col-lg-4">
                        <div class="card border-0 shadow-sm rounded-4">
                            <div class="card-body p-4">
                                <h5 class="fw-bold mb-3">Informasi Perusahaan</h5>
                                <ul class="list-unstyled d-grid gap-3 mb-0">
                                    <li>
                                        <div class="small text-secondary">Nama Perusahaan</div>
                                        <div class="fw-semibold">{{ $profil->nama_perusahaan }}</div>
                                    </li>
                                    <li>
                                        <div class="small text-secondary">Berdiri Sejak</div>
                                        <div class="fw-semibold">{{ $profil->berdiri_sejak ?? '—' }}</div>
                                    </li>
                                    <li>
                                        <div class="small text-secondary">Alamat</div>
                                        <div class="fw-semibold">{{ $profil->alamat ?? '—' }}</div>
                                    </li>
                                    <li>
                                        <div class="small text-secondary">Telepon</div>
                                        <div class="fw-semibold">{{ $profil->telepon ?? '—' }}</div>
                                    </li>
                                    <li>
                                        <div class="small text-secondary">Email</div>
                                        <div class="fw-semibold">{{ $profil->email ?? '—' }}</div>
                                    </li>
                                    <li>
                                        <div class="small text-secondary">Jam Operasional</div>
                                        <div class="fw-semibold">{{ $profil->jam_operasional ?? '—' }}</div>
                                    </li>
                                </ul>
                                <a href="{{ route('kontak.show') }}" class="btn btn-primary w-100 mt-4">
                                    <i class="bi bi-envelope me-1"></i>Hubungi Kami
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Peta lokasi --}}
                @if ($profil->maps_embed_url)
                    <div class="mt-5">
                        <h4 class="fw-bold mb-3">Lokasi Kantor</h4>
                        <div class="ratio ratio-16x9 rounded-4 overflow-hidden shadow">
                            <iframe src="{{ $profil->maps_embed_url }}" style="border:0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Lokasi kantor"></iframe>
                        </div>
                    </div>
                @endif
            @else
                <div class="alert alert-warning">Data profil perusahaan belum tersedia.</div>
            @endif
        </div>
    </section>
@endsection
