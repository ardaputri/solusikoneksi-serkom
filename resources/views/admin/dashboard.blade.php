@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <div>
            <h3 class="fw-bold mb-1">Dashboard</h3>
            <p class="text-secondary mb-0">Selamat datang, {{ auth()->user()->name }}. Kelola konten website Anda di sini.</p>
        </div>
        <span class="text-secondary small"><i class="bi bi-calendar3 me-1"></i>{{ now()->translatedFormat('d F Y') }}</span>
    </div>

    {{-- Kartu statistik --}}
    <div class="row g-3 mb-4">
        <div class="col-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <span class="rounded-4 bg-primary bg-opacity-10 text-primary d-inline-flex align-items-center justify-content-center" style="width:52px;height:52px;">
                        <i class="bi bi-box-seam fs-4"></i>
                    </span>
                    <div>
                        <div class="fs-4 fw-bold">{{ $statistik['produk'] }}</div>
                        <div class="small text-secondary">Produk / Layanan</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <span class="rounded-4 bg-success bg-opacity-10 text-success d-inline-flex align-items-center justify-content-center" style="width:52px;height:52px;">
                        <i class="bi bi-newspaper fs-4"></i>
                    </span>
                    <div>
                        <div class="fs-4 fw-bold">{{ $statistik['artikel'] }}</div>
                        <div class="small text-secondary">Artikel</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <span class="rounded-4 bg-warning bg-opacity-10 text-warning d-inline-flex align-items-center justify-content-center" style="width:52px;height:52px;">
                        <i class="bi bi-images fs-4"></i>
                    </span>
                    <div>
                        <div class="fs-4 fw-bold">{{ $statistik['galeri'] }}</div>
                        <div class="small text-secondary">Foto Galeri</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <span class="rounded-4 bg-danger bg-opacity-10 text-danger d-inline-flex align-items-center justify-content-center" style="width:52px;height:52px;">
                        <i class="bi bi-envelope-paper fs-4"></i>
                    </span>
                    <div>
                        <div class="fs-4 fw-bold">{{ $statistik['pesan_baru'] }}</div>
                        <div class="small text-secondary">Pesan Belum Dibaca</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        {{-- Pesan terbaru --}}
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white d-flex justify-content-between align-items-center py-3 border-0">
                    <h6 class="fw-bold mb-0"><i class="bi bi-envelope-paper me-1"></i>Pesan Terbaru</h6>
                    <a href="{{ route('admin.pesan.index') }}" class="btn btn-sm btn-outline-primary">Lihat semua</a>
                </div>
                <div class="list-group list-group-flush">
                    @forelse ($pesanTerbaru as $pesan)
                        <a href="{{ route('admin.pesan.show', $pesan) }}" class="list-group-item list-group-item-action py-3">
                            <div class="d-flex justify-content-between">
                                <span class="fw-semibold {{ $pesan->is_dibaca ? '' : 'text-primary' }}">{{ $pesan->nama }}</span>
                                <small class="text-secondary">{{ $pesan->created_at->diffForHumans() }}</small>
                            </div>
                            <div class="small text-secondary">{{ \Illuminate\Support\Str::limit($pesan->pesan, 90) }}</div>
                        </a>
                    @empty
                        <div class="list-group-item py-4 text-center text-secondary">Belum ada pesan masuk.</div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Artikel terbaru --}}
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white d-flex justify-content-between align-items-center py-3 border-0">
                    <h6 class="fw-bold mb-0"><i class="bi bi-newspaper me-1"></i>Artikel Terbaru</h6>
                    <a href="{{ route('admin.artikel.index') }}" class="btn btn-sm btn-outline-primary">Kelola</a>
                </div>
                <div class="list-group list-group-flush">
                    @forelse ($artikelTerbaru as $item)
                        <a href="{{ route('admin.artikel.edit', $item) }}" class="list-group-item list-group-item-action py-3">
                            <div class="fw-semibold small">{{ \Illuminate\Support\Str::limit($item->judul, 60) }}</div>
                            <div class="small text-secondary">
                                {{ $item->published_at?->format('d/m/Y') ?? 'Draft' }}
                                &middot; {{ $item->views }} x dibaca
                                @if (! $item->is_published) <span class="badge text-bg-secondary">Draft</span> @endif
                            </div>
                        </a>
                    @empty
                        <div class="list-group-item py-4 text-center text-secondary">Belum ada artikel.</div>
                    @endforelse
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4 mt-3 bg-primary text-white">
                <div class="card-body">
                    <h6 class="fw-bold"><i class="bi bi-lightbulb me-1"></i>Tips</h6>
                    <p class="small mb-2 opacity-75">Profil perusahaan bersifat statis — tidak bisa ditambah, namun dapat diperbaharui melalui menu <strong>Profil Perusahaan</strong>.</p>
                    <a href="{{ route('admin.profil.edit') }}" class="btn btn-light btn-sm">Perbarui Profil</a>
                </div>
            </div>
        </div>
    </div>
@endsection
