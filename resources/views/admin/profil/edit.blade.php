@extends('layouts.admin')

@section('title', 'Edit Profil Perusahaan')

@section('content')
    <div class="mb-4">
        <h3 class="fw-bold mb-1">Profil Perusahaan</h3>
        <p class="text-secondary mb-0">
            Profil perusahaan bersifat <strong>statis</strong>: tidak dapat ditambahkan, namun dapat diperbaharui di sini.
        </p>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <form action="{{ route('admin.profil.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-lg-8">
                        <label for="nama_perusahaan" class="form-label">Nama Perusahaan <span class="text-danger">*</span></label>
                        <input type="text" name="nama_perusahaan" id="nama_perusahaan"
                               class="form-control @error('nama_perusahaan') is-invalid @enderror"
                               value="{{ old('nama_perusahaan', $profil->nama_perusahaan ?? '') }}" required>
                        @error('nama_perusahaan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-lg-4">
                        <label for="berdiri_sejak" class="form-label">Berdiri Sejak</label>
                        <input type="text" name="berdiri_sejak" id="berdiri_sejak" maxlength="4"
                               class="form-control @error('berdiri_sejak') is-invalid @enderror"
                               value="{{ old('berdiri_sejak', $profil->berdiri_sejak ?? '') }}" placeholder="Contoh: 2015">
                        @error('berdiri_sejak') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12">
                        <label for="tagline" class="form-label">Tagline</label>
                        <input type="text" name="tagline" id="tagline"
                               class="form-control @error('tagline') is-invalid @enderror"
                               value="{{ old('tagline', $profil->tagline ?? '') }}">
                        @error('tagline') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12">
                        <label for="deskripsi" class="form-label">Deskripsi Perusahaan</label>
                        <textarea name="deskripsi" id="deskripsi" rows="5"
                                  class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $profil->deskripsi ?? '') }}</textarea>
                        @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="visi" class="form-label">Visi</label>
                        <textarea name="visi" id="visi" rows="4"
                                  class="form-control @error('visi') is-invalid @enderror">{{ old('visi', $profil->visi ?? '') }}</textarea>
                        @error('visi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="misi" class="form-label">Misi</label>
                        <textarea name="misi" id="misi" rows="4"
                                  class="form-control @error('misi') is-invalid @enderror">{{ old('misi', $profil->misi ?? '') }}</textarea>
                        @error('misi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12"><hr class="my-2"><h6 class="fw-bold">Informasi Kontak</h6></div>

                    <div class="col-lg-6">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" name="alamat" id="alamat"
                               class="form-control @error('alamat') is-invalid @enderror"
                               value="{{ old('alamat', $profil->alamat ?? '') }}">
                        @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-lg-3">
                        <label for="telepon" class="form-label">Telepon</label>
                        <input type="text" name="telepon" id="telepon"
                               class="form-control @error('telepon') is-invalid @enderror"
                               value="{{ old('telepon', $profil->telepon ?? '') }}">
                        @error('telepon') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-lg-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email', $profil->email ?? '') }}">
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-lg-6">
                        <label for="website" class="form-label">Website</label>
                        <input type="text" name="website" id="website"
                               class="form-control @error('website') is-invalid @enderror"
                               value="{{ old('website', $profil->website ?? '') }}">
                        @error('website') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-lg-6">
                        <label for="jam_operasional" class="form-label">Jam Operasional</label>
                        <input type="text" name="jam_operasional" id="jam_operasional"
                               class="form-control @error('jam_operasional') is-invalid @enderror"
                               value="{{ old('jam_operasional', $profil->jam_operasional ?? '') }}" placeholder="Contoh: Senin - Jumat: 08.00 - 17.00 WIB">
                        @error('jam_operasional') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12">
                        <label for="maps_embed_url" class="form-label">Google Maps Embed URL</label>
                        <input type="text" name="maps_embed_url" id="maps_embed_url"
                               class="form-control @error('maps_embed_url') is-invalid @enderror"
                               value="{{ old('maps_embed_url', $profil->maps_embed_url ?? '') }}" placeholder="https://www.google.com/maps?q=...&output=embed">
                        @error('maps_embed_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12"><hr class="my-2"><h6 class="fw-bold">Media Sosial</h6></div>

                    <div class="col-lg-3 col-md-6">
                        <label for="facebook" class="form-label">Facebook</label>
                        <input type="text" name="facebook" id="facebook" class="form-control @error('facebook') is-invalid @enderror"
                               value="{{ old('facebook', $profil->facebook ?? '') }}" placeholder="https://facebook.com/...">
                        @error('facebook') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <label for="instagram" class="form-label">Instagram</label>
                        <input type="text" name="instagram" id="instagram" class="form-control @error('instagram') is-invalid @enderror"
                               value="{{ old('instagram', $profil->instagram ?? '') }}" placeholder="https://instagram.com/...">
                        @error('instagram') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <label for="youtube" class="form-label">YouTube</label>
                        <input type="text" name="youtube" id="youtube" class="form-control @error('youtube') is-invalid @enderror"
                               value="{{ old('youtube', $profil->youtube ?? '') }}" placeholder="https://youtube.com/@...">
                        @error('youtube') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <label for="linkedin" class="form-label">LinkedIn</label>
                        <input type="text" name="linkedin" id="linkedin" class="form-control @error('linkedin') is-invalid @enderror"
                               value="{{ old('linkedin', $profil->linkedin ?? '') }}" placeholder="https://linkedin.com/company/...">
                        @error('linkedin') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12"><hr class="my-2"><h6 class="fw-bold">Logo &amp; Foto</h6></div>

                    <div class="col-md-6">
                        <label for="logo" class="form-label">Logo Perusahaan</label>
                        <input type="file" name="logo" id="logo" accept="image/*"
                               class="form-control @error('logo') is-invalid @enderror">
                        <div class="form-text">Format: JPG, PNG, SVG, WEBP. Maks 2 MB.</div>
                        @error('logo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        @if ($profil?->logo)
                            <img src="{{ asset($profil->logo) }}" alt="Logo" class="mt-2 rounded border" style="height:48px;">
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label for="foto" class="form-label">Foto / Gambar Profil</label>
                        <input type="file" name="foto" id="foto" accept="image/*"
                               class="form-control @error('foto') is-invalid @enderror">
                        <div class="form-text">Format: JPG, PNG, WEBP. Maks 2 MB.</div>
                        @error('foto') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        @if ($profil?->foto)
                            <img src="{{ asset($profil->foto) }}" alt="Foto profil" class="mt-2 rounded border" style="height:80px;">
                        @endif
                    </div>

                    <div class="col-12 d-flex gap-2 pt-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-check-lg me-1"></i>Simpan Perubahan
                        </button>
                        <a href="{{ route('home') }}" target="_blank" class="btn btn-outline-secondary">
                            <i class="bi bi-eye me-1"></i>Lihat di Website
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
