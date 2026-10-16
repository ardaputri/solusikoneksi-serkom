@extends('layouts.app')

@section('title', 'Kontak Kami')

@section('content')
    <section class="bg-primary text-white py-5">
        <div class="container py-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50 text-decoration-none">Beranda</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">Kontak Kami</li>
                </ol>
            </nav>
            <h1 class="fw-bold mb-0">Kontak Kami</h1>
            <p class="mb-0 opacity-75">Kirim pertanyaan atau permintaan kerja sama, tim kami akan segera merespons.</p>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                {{-- Informasi kontak --}}
                <div class="col-lg-5">
                    <div class="card border-0 shadow-sm rounded-4 h-100">
                        <div class="card-body p-4">
                            <h4 class="fw-bold mb-3">Informasi Kontak</h4>
                            <ul class="list-unstyled d-grid gap-3">
                                <li class="d-flex gap-3">
                                    <span class="icon-besar rounded-4 bg-primary bg-opacity-10 text-primary d-inline-flex align-items-center justify-content-center flex-shrink-0">
                                        <i class="bi bi-geo-alt"></i>
                                    </span>
                                    <div>
                                        <div class="fw-semibold">Alamat</div>
                                        <div class="text-secondary small">{{ $profil->alamat ?? '—' }}</div>
                                    </div>
                                </li>
                                <li class="d-flex gap-3">
                                    <span class="icon-besar rounded-4 bg-primary bg-opacity-10 text-primary d-inline-flex align-items-center justify-content-center flex-shrink-0">
                                        <i class="bi bi-telephone"></i>
                                    </span>
                                    <div>
                                        <div class="fw-semibold">Telepon</div>
                                        <div class="text-secondary small">{{ $profil->telepon ?? '—' }}</div>
                                    </div>
                                </li>
                                <li class="d-flex gap-3">
                                    <span class="icon-besar rounded-4 bg-primary bg-opacity-10 text-primary d-inline-flex align-items-center justify-content-center flex-shrink-0">
                                        <i class="bi bi-envelope"></i>
                                    </span>
                                    <div>
                                        <div class="fw-semibold">Email</div>
                                        <div class="text-secondary small">{{ $profil->email ?? '—' }}</div>
                                    </div>
                                </li>
                                <li class="d-flex gap-3">
                                    <span class="icon-besar rounded-4 bg-primary bg-opacity-10 text-primary d-inline-flex align-items-center justify-content-center flex-shrink-0">
                                        <i class="bi bi-clock"></i>
                                    </span>
                                    <div>
                                        <div class="fw-semibold">Jam Operasional</div>
                                        <div class="text-secondary small">{{ $profil->jam_operasional ?? '—' }}</div>
                                    </div>
                                </li>
                            </ul>

                            <div class="d-flex gap-2 mt-4">
                                @if ($profil?->facebook) <a href="{{ $profil->facebook }}" class="btn btn-outline-primary btn-sm rounded-pill" target="_blank" rel="noopener"><i class="bi bi-facebook me-1"></i>Facebook</a> @endif
                                @if ($profil?->instagram) <a href="{{ $profil->instagram }}" class="btn btn-outline-primary btn-sm rounded-pill" target="_blank" rel="noopener"><i class="bi bi-instagram me-1"></i>Instagram</a> @endif
                                @if ($profil?->youtube) <a href="{{ $profil->youtube }}" class="btn btn-outline-primary btn-sm rounded-pill" target="_blank" rel="noopener"><i class="bi bi-youtube me-1"></i>YouTube</a> @endif
                                @if ($profil?->linkedin) <a href="{{ $profil->linkedin }}" class="btn btn-outline-primary btn-sm rounded-pill" target="_blank" rel="noopener"><i class="bi bi-linkedin me-1"></i>LinkedIn</a> @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Formulir pesan --}}
                <div class="col-lg-7">
                    <div class="card border-0 shadow-sm rounded-4 h-100">
                        <div class="card-body p-4">
                            <h4 class="fw-bold mb-1">Kirim Pesan</h4>
                            <p class="text-secondary small mb-4">Isi formulir berikut dan kami akan menghubungi Anda kembali.</p>

                            <form action="{{ route('kontak.store') }}" method="POST" novalidate>
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror"
                                               value="{{ old('nama') }}" placeholder="Masukkan nama Anda" required>
                                        @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                                               value="{{ old('email') }}" placeholder="nama@email.com" required>
                                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="telepon" class="form-label">No. Telepon</label>
                                        <input type="text" name="telepon" id="telepon" class="form-control @error('telepon') is-invalid @enderror"
                                               value="{{ old('telepon') }}" placeholder="08xxxxxxxxxx">
                                        @error('telepon') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="subjek" class="form-label">Subjek</label>
                                        <input type="text" name="subjek" id="subjek" class="form-control @error('subjek') is-invalid @enderror"
                                               value="{{ old('subjek') }}" placeholder="Subjek pesan">
                                        @error('subjek') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="pesan" class="form-label">Pesan <span class="text-danger">*</span></label>
                                        <textarea name="pesan" id="pesan" rows="5" class="form-control @error('pesan') is-invalid @enderror"
                                                  placeholder="Tuliskan pesan Anda..." required>{{ old('pesan') }}</textarea>
                                        @error('pesan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary px-4">
                                            <i class="bi bi-send me-1"></i>Kirim Pesan
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Peta lokasi --}}
            @if ($profil?->maps_embed_url)
                <div class="mt-4">
                    <h4 class="fw-bold mb-3">Lokasi Kami</h4>
                    <div class="ratio ratio-21x9 rounded-4 overflow-hidden shadow">
                        <iframe src="{{ $profil->maps_embed_url }}" style="border:0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Lokasi kantor"></iframe>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
