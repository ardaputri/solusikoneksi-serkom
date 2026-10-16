@extends('layouts.admin')

@section('title', 'Kelola Artikel')

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <div>
            <h3 class="fw-bold mb-1">Artikel</h3>
            <p class="text-secondary mb-0">Kelola artikel dan informasi terkini yang tampil di website.</p>
        </div>
        <a href="{{ route('admin.artikel.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i>Tambah Artikel
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width:70px">Gambar</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Penulis</th>
                        <th style="width:130px">Terbit</th>
                        <th style="width:90px">Dibaca</th>
                        <th style="width:100px">Status</th>
                        <th style="width:160px" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($artikel as $item)
                        <tr>
                            <td>
                                <img src="{{ asset($item->gambar ?: 'images/placeholder-artikel.svg') }}" alt="{{ $item->judul }}"
                                     class="rounded" style="width:56px;height:40px;object-fit:cover;">
                            </td>
                            <td class="fw-semibold">{{ \Illuminate\Support\Str::limit($item->judul, 60) }}</td>
                            <td><span class="badge text-bg-light border">{{ $item->kategori ?: '—' }}</span></td>
                            <td class="small">{{ $item->penulis ?: '—' }}</td>
                            <td class="small">{{ $item->published_at?->format('d/m/Y') ?? '—' }}</td>
                            <td class="small">{{ $item->views }}</td>
                            <td>
                                @if ($item->is_published)
                                    <span class="badge text-bg-success">Terbit</span>
                                @else
                                    <span class="badge text-bg-secondary">Draft</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($item->is_published)
                                    <a href="{{ route('artikel.show', $item->slug) }}" class="btn btn-sm btn-outline-secondary" target="_blank" title="Lihat">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                @endif
                                <a href="{{ route('admin.artikel.edit', $item) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.artikel.destroy', $item) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Yakin hapus artikel \"{{ $item->judul }}\"?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-secondary py-4">Belum ada artikel. Klik "Tambah Artikel" untuk menambahkan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $artikel->links() }}
    </div>
@endsection
