@extends('layouts.admin')

@section('title', 'Kelola Galeri Kegiatan')

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <div>
            <h3 class="fw-bold mb-1">Galeri Kegiatan</h3>
            <p class="text-secondary mb-0">Kelola foto kegiatan perusahaan yang tampil di website.</p>
        </div>
        <a href="{{ route('admin.galeri.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i>Tambah Foto
        </a>
    </div>

    <div class="row g-3">
        @forelse ($galeri as $foto)
            <div class="col-6 col-md-4 col-xl-3">
                <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">
                    <img src="{{ asset($foto->gambar) }}" alt="{{ $foto->judul }}" class="card-img-top" style="height: 160px; object-fit: cover;">
                    <div class="card-body p-3">
                        <div class="fw-semibold small">{{ \Illuminate\Support\Str::limit($foto->judul, 40) }}</div>
                        <div class="small text-secondary">
                            {{ $foto->kategori ?: 'Kegiatan' }} &middot; {{ $foto->tanggal_kegiatan?->format('d/m/Y') ?? '—' }}
                        </div>
                        <div class="d-flex gap-1 mt-2">
                            <a href="{{ route('admin.galeri.edit', $foto) }}" class="btn btn-sm btn-outline-primary flex-grow-1">
                                <i class="bi bi-pencil me-1"></i>Edit
                            </a>
                            <form action="{{ route('admin.galeri.destroy', $foto) }}" method="POST"
                                  onsubmit="return confirm('Yakin hapus foto \"{{ $foto->judul }}\"?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info mb-0">
                    <i class="bi bi-info-circle me-1"></i>Belum ada foto galeri. Klik "Tambah Foto" untuk menambahkan.
                </div>
            </div>
        @endforelse
    </div>

    <div class="mt-3">
        {{ $galeri->links() }}
    </div>
@endsection
