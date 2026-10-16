# Company Profile — PT Solusi Koneksi Anda

Website company profile dinamis dibangun dengan **Laravel 12** dan **Bootstrap 5**, sesuai tugas praktik demonstrasi skema sertifikasi *Pengembang Web Pratama (Junior Web Developer)* — FORM IA 02.

Database MySQL: `pt_solusi_koneksi` (XAMPP / phpMyAdmin).

## Halaman Website

| Halaman | URL | Sifat |
|---|---|---|
| Beranda | `/` | Campuran (profil, produk, artikel, galeri terbaru) |
| Profil Perusahaan | `/profil` | **Statis** — hanya dapat diperbarui dari admin |
| Produk / Layanan | `/produk` | **Dinamis** — CRUD melalui admin |
| Artikel / Informasi | `/artikel` | **Dinamis** — CRUD melalui admin |
| Galeri Kegiatan | `/galeri` | **Dinamis** — CRUD melalui admin |
| Kontak Kami | `/kontak` | Formulir pesan (tersimpan ke database) |
| Login Admin | `/login` | Autentikasi |
| Dashboard Admin | `/admin` | Kelola semua konten + pesan masuk |

Seluruh halaman saling terhubung melalui navigasi menu.

## Cara Menjalankan

Pastikan **XAMPP** (Apache + MySQL) sudah berjalan, lalu:

```bash
# 1. Salin/ubah file env
cp .env.example .env        # jika belum ada .env

# 2. Pastikan konfigurasi database di .env sesuai:
#    DB_CONNECTION=mysql
#    DB_HOST=127.0.0.1
#    DB_PORT=3306
#    DB_DATABASE=pt_solusi_koneksi
#    DB_USERNAME=root
#    DB_PASSWORD=

# 3. Buat tabel + data contoh
php artisan migrate:fresh --seed

# 4. Jalankan server
php artisan serve
```

Website dapat diakses melalui:

- **http://127.0.0.1:8000** (hasil `php artisan serve`), atau
- **http://localhost/company-profile-pt-ska/public/** (langsung via Apache XAMPP, karena proyek berada di `htdocs`).

## Login Admin

| | |
|---|---|
| URL | `/login` |
| Email | `admin@solusikoneksi.co.id` |
| Password | `password` |

> Ganti password melalui database tabel `users` (hash dihasilkan oleh bcrypt) setelah presentasi bila diperlukan.

## Fitur Admin

- **Dashboard** — statistik konten, pesan & artikel terbaru.
- **Produk / Layanan** — tambah, ubah, hapus; upload gambar, ikon Bootstrap Icons, harga, urutan tampil, status aktif.
- **Artikel** — tambah, ubah, hapus; gambar sampul, kategori, penulis, status terbit/draft, tanggal terbit.
- **Galeri Kegiatan** — tambah, ubah, hapus; upload foto, kategori, tanggal kegiatan.
- **Profil Perusahaan** — hanya **edit/perbarui** (sesuai ketentuan: statis, tidak bisa ditambah).
- **Pesan Masuk** — pesan dari halaman Kontak Kami, penanda sudah dibaca, balas via email, hapus.

Upload gambar disimpan di `public/uploads/{produk|artikel|galeri|profil}`.

## Struktur Database (`pt_solusi_koneksi`)

- `profil_perusahaan` — satu baris berisi identitas, visi/misi, kontak, media sosial.
- `produk_layanan` — daftar produk/layanan.
- `artikel` — artikel & informasi terkini.
- `galeri` — foto kegiatan perusahaan.
- `pesan_kontak` — pesan dari formulir kontak.
- `users` — akun admin.
- Tabel bawaan Laravel: `sessions`, `cache`, `jobs`, `migrations`.

## Aset

Bootstrap 5.3.3 dan Bootstrap Icons 1.11.3 diunduh lokal ke `public/vendor/` sehingga website tetap tampil tanpa koneksi internet. Gambar placeholder & logo SVG tersedia di `public/images/`.
