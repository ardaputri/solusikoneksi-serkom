@extends('layouts.admin')

@section('title', 'Pesan Masuk')

@section('content')
    <div class="mb-4">
        <h3 class="fw-bold mb-1">Pesan Masuk</h3>
        <p class="text-secondary mb-0">Pesan yang dikirim pengunjung melalui halaman Kontak Kami.</p>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width:40px">#</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Subjek</th>
                        <th>Pesan</th>
                        <th style="width:120px">Waktu</th>
                        <th style="width:140px" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pesan as $item)
                        <tr class="{{ $item->is_dibaca ? '' : 'table-primary' }}">
                            <td>{{ $loop->iteration }}</td>
                            <td class="fw-semibold">
                                @unless ($item->is_dibaca)
                                    <span class="badge text-bg-primary rounded-pill me-1">Baru</span>
                                @endunless
                                {{ $item->nama }}
                            </td>
                            <td class="small">{{ $item->email }}</td>
                            <td class="small">{{ $item->subjek ?: '—' }}</td>
                            <td class="small text-secondary">{{ \Illuminate\Support\Str::limit($item->pesan, 60) }}</td>
                            <td class="small">{{ $item->created_at->diffForHumans() }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.pesan.show', $item) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-envelope-open me-1"></i>Baca
                                </a>
                                <form action="{{ route('admin.pesan.destroy', $item) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Yakin hapus pesan dari {{ $item->nama }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-secondary py-4">Belum ada pesan masuk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $pesan->links() }}
    </div>
@endsection
