@extends('layouts.admin')

@section('title', 'Kelola Produk / Layanan')

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <div>
            <h3 class="fw-bold mb-1">Produk / Layanan</h3>
            <p class="text-secondary mb-0">Kelola daftar produk dan layanan yang tampil di website.</p>
        </div>
        <a href="{{ route('admin.produk.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i>Tambah Produk
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width:70px">Gambar</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th style="width:90px">Urutan</th>
                        <th style="width:100px">Status</th>
                        <th style="width:160px" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($produk as $item)
                        <tr>
                            <td>
                                <img src="{{ asset($item->gambar ?: 'images/placeholder-produk.svg') }}" alt="{{ $item->nama }}"
                                     class="rounded" style="width:56px;height:40px;object-fit:cover;">
                            </td>
                            <td class="fw-semibold">{{ $item->nama }}</td>
                            <td><span class="badge text-bg-light border">{{ $item->kategori ?: '—' }}</span></td>
                            <td class="small">{{ $item->harga ?: '—' }}</td>
                            <td>{{ $item->urutan }}</td>
                            <td>
                                @if ($item->is_aktif)
                                    <span class="badge text-bg-success">Aktif</span>
                                @else
                                    <span class="badge text-bg-secondary">Nonaktif</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('produk.show', $item->slug) }}" class="btn btn-sm btn-outline-secondary" target="_blank" title="Lihat">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.produk.edit', $item) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.produk.destroy', $item) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Yakin hapus produk \"{{ $item->nama }}\"?');">
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
                            <td colspan="7" class="text-center text-secondary py-4">Belum ada produk/layanan. Klik "Tambah Produk" untuk menambahkan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $produk->links() }}
    </div>
@endsection
