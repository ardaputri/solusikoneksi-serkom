@extends('layouts.admin')

@section('title', 'Detail Pesan')

@section('content')
    <div class="mb-4">
        <h3 class="fw-bold mb-1">Detail Pesan</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb small mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.pesan.index') }}">Pesan Masuk</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail</li>
            </ol>
        </nav>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between flex-wrap gap-2 mb-4">
                <div>
                    <h4 class="fw-bold mb-1">{{ $pesan->nama }}</h4>
                    <div class="text-secondary small">
                        <i class="bi bi-envelope me-1"></i>{{ $pesan->email }}
                        @if ($pesan->telepon)
                            &middot; <i class="bi bi-telephone me-1"></i>{{ $pesan->telepon }}
                        @endif
                    </div>
                </div>
                <div class="text-end">
                    @if ($pesan->subjek)
                        <div class="fw-semibold">{{ $pesan->subjek }}</div>
                    @endif
                    <div class="small text-secondary">{{ $pesan->created_at->translatedFormat('d F Y, H:i') }}</div>
                </div>
            </div>

            <hr>

            <div class="text-secondary" style="white-space: pre-line">{{ $pesan->pesan }}</div>

            <hr>
            <div class="d-flex gap-2">
                <a href="mailto:{{ $pesan->email }}?subject=Balasan%20untuk%20pesan%20Anda" class="btn btn-primary">
                    <i class="bi bi-reply me-1"></i>Balas via Email
                </a>
                <form action="{{ route('admin.pesan.destroy', $pesan) }}" method="POST"
                      onsubmit="return confirm('Yakin hapus pesan ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger">
                        <i class="bi bi-trash me-1"></i>Hapus
                    </button>
                </form>
                <a href="{{ route('admin.pesan.index') }}" class="btn btn-outline-secondary">Kembali</a>
            </div>
        </div>
    </div>
@endsection
