<?php

namespace Database\Seeders;

use App\Models\Artikel;
use App\Models\Galeri;
use App\Models\ProfilPerusahaan;
use App\Models\ProdukLayanan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ---------- Akun admin ----------
        User::updateOrCreate(
            ['email' => 'admin@solusikoneksi.co.id'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password'),
            ]
        );

        // ---------- Profil perusahaan (statis, satu baris) ----------
        ProfilPerusahaan::updateOrCreate(
            ['nama_perusahaan' => 'PT Solusi Koneksi Anda'],
            [
                'tagline' => 'Menghubungkan Solusi Digital untuk Bisnis Anda',
                'deskripsi' => 'PT Solusi Koneksi Anda adalah perusahaan penyedia layanan teknologi informasi yang berkomitmen membantu bisnis bertumbuh melalui solusi digital terintegrasi. Berdiri sejak 2015, kami telah dipercaya oleh ratusan klien dari berbagai industri, mulai dari UMKM hingga korporasi, untuk menghadirkan konektivitas, keamanan, dan efisiensi bagi operasional bisnis mereka.',
                'visi' => 'Menjadi mitra teknologi informasi terpercaya dan terdepan di Indonesia yang mendorong transformasi digital setiap lini bisnis.',
                'misi' => "1. Menyediakan solusi teknologi informasi yang inovatif, aman, dan sesuai kebutuhan bisnis klien.\n2. Memberikan layanan pelanggan yang responsif dan profesional.\n3. Mengembangkan sumber daya manusia yang kompeten di bidang teknologi informasi.\n4. Membangun kemitraan jangka panjang yang saling menguntungkan.",
                'alamat' => 'Jl. Raya Pajajaran No. 88F, Kota Bogor, Jawa Barat 16153',
                'telepon' => '(0251) 123-4567',
                'email' => 'info@solusikoneksi.co.id',
                'website' => 'https://www.solusikoneksi.co.id',
                'berdiri_sejak' => '2015',
                'jam_operasional' => 'Senin - Jumat: 08.00 - 17.00 WIB',
                'maps_embed_url' => 'https://www.google.com/maps?q=Jl.+Raya+Pajajaran+No.+88F,+Bogor&output=embed',
                'facebook' => 'https://facebook.com/solusikoneksi',
                'instagram' => 'https://instagram.com/solusikoneksi',
                'youtube' => 'https://youtube.com/@solusikoneksi',
                'linkedin' => 'https://linkedin.com/company/solusikoneksi',
            ]
        );

        // ---------- Produk / Layanan (dinamis) ----------
        $produk = [
            [
                'nama' => 'Internet Dedicated',
                'kategori' => 'Konektivitas',
                'ikon' => 'bi bi-globe2',
                'harga' => 'Mulai Rp 2.500.000/bulan',
                'deskripsi' => 'Layanan internet dedicated dengan bandwidth symmetrical hingga 1 Gbps, dukungan uptime 99.9%, dan monitor 24/7 untuk menjamin kelancaran operasional bisnis Anda.',
            ],
            [
                'nama' => 'Managed Services',
                'kategori' => 'Infrastruktur',
                'ikon' => 'bi bi-server',
                'harga' => 'Hubungi kami',
                'deskripsi' => 'Pengelolaan infrastruktur TI Anda oleh tim ahli kami, meliputi server, jaringan, dan pusat data, sehingga bisnis Anda dapat fokus pada pengembangan usaha.',
            ],
            [
                'nama' => 'Keamanan Siber (Cyber Security)',
                'kategori' => 'Keamanan',
                'ikon' => 'bi bi-shield-lock',
                'harga' => 'Mulai Rp 5.000.000/bulan',
                'deskripsi' => 'Perlindungan menyeluruh terhadap ancaman siber melalui firewall, VPN, intrusion detection, serta audit keamanan berkala oleh tim bersertifikat.',
            ],
            [
                'nama' => 'Cloud Hosting & Server',
                'kategori' => 'Cloud',
                'ikon' => 'bi bi-cloud-arrow-up',
                'harga' => 'Mulai Rp 350.000/bulan',
                'deskripsi' => 'Layanan cloud hosting dan private cloud server dengan performa tinggi, backup otomatis, dan skalabilitas sesuai pertumbuhan bisnis Anda.',
            ],
            [
                'nama' => 'Pengembangan Web & Aplikasi',
                'kategori' => 'Pengembangan',
                'ikon' => 'bi bi-window-stack',
                'harga' => 'Sesuai kebutuhan proyek',
                'deskripsi' => 'Jasa pembuatan website company profile, e-commerce, hingga aplikasi bisnis custom yang responsif, cepat, dan mudah digunakan.',
            ],
            [
                'nama' => 'Konsultasi & Integrasi TI',
                'kategori' => 'Konsultasi',
                'ikon' => 'bi bi-diagram-3',
                'harga' => 'Sesuai lingkup pekerjaan',
                'deskripsi' => 'Layanan konsultasi perancangan arsitektur jaringan, migrasi sistem, dan integrasi teknologi baru agar bisnis Anda semakin efisien.',
            ],
        ];

        foreach ($produk as $index => $item) {
            ProdukLayanan::updateOrCreate(
                ['nama' => $item['nama']],
                $item + ['urutan' => $index + 1, 'is_aktif' => true]
            );
        }

        // ---------- Artikel (dinamis) ----------
        $artikel = [
            [
                'judul' => 'Tips Memilih Penyedia Layanan Internet Dedicated untuk Bisnis',
                'kategori' => 'Tips',
                'penulis' => 'Tim Solusi Koneksi',
                'ringkasan' => 'Koneksi internet yang stabil adalah tulang punggung bisnis modern. Simak tips memilih layanan internet dedicated yang tepat untuk perusahaan Anda.',
                'isi' => "Koneksi internet yang stabil menjadi kebutuhan vital bagi setiap bisnis di era digital ini. Gangguan koneksi bahkan hanya beberapa menit dapat menyebabkan kerugian yang tidak sedikit.\n\nBerikut beberapa hal yang perlu diperhatikan saat memilih penyedia layanan internet dedicated:\n\n1. Uptime yang dijamin (SLA) — Pilih penyedia yang menjamin uptime minimal 99.9% dan berani memberikan kompensasi bila layanan tidak sesuai janji.\n\n2. Bandwidth symmetrical — Koneksi upload yang sebesar download penting untuk aktivitas cloud, video conference, dan backup data.\n\n3. Dukungan teknis 24/7 — Pastikan penyedia memiliki tim NOC yang siap menangani gangguan kapan saja.\n\n4. Skalabilitas — Bisnis pasti bertumbuh, pilih penyedia yang memudahkan penambahan bandwidth tanpa harus berganti total infrastruktur.\n\nPT Solusi Koneksi Anda menyediakan layanan internet dedicated dengan SLA 99.9% dan dukungan teknis 24/7 untuk memastikan bisnis Anda tetap terhubung.",
            ],
            [
                'judul' => 'Keamanan Siber: Ancaman yang Sering Diabaikan UMKM',
                'kategori' => 'Keamanan',
                'penulis' => 'Divisi Cyber Security',
                'ringkasan' => 'Serangan siber tidak hanya menargetkan korporasi besar. UMKM kini menjadi sasaran empuk pelaku kejahatan siber. Kenali ancamannya dan cara pencegahannya.',
                'isi' => "Banyak UMKM menganggap keamanan siber hanya urusan perusahaan besar. Padahal, data menunjukkan lebih dari 40% serangan siber kini menargetkan usaha kecil dan menengah.\n\nAncaman yang paling sering terjadi:\n\n1. Phishing — Email atau pesan palsu yang menguras data login karyawan.\n2. Ransomware — Program jahat yang mengenkripsi data dan meminta tebusan.\n3. Serangan brute force — Percobaan menebak password secara masif.\n\nLangkah pencegahan yang dapat dilakukan:\n\n- Menggunakan password unik dan autentikasi dua faktor.\n- Melakukan backup data secara berkala dan terpisah dari jaringan utama.\n- Memperbarui perangkat lunak dan firmware secara rutin.\n- Menggunakan layanan managed security untuk monitor ancaman 24/7.\n\nTim keamanan siber PT Solusi Koneksi Anda siap membantu melakukan audit dan penguatan pertahanan digital bisnis Anda.",
            ],
            [
                'judul' => 'Solusi Koneksi Hadirkan Layanan Cloud Server Terbaru',
                'kategori' => 'Informasi',
                'penulis' => 'Humas Solusi Koneksi',
                'ringkasan' => 'PT Solusi Koneksi Anda resmi meluncurkan layanan cloud server generasi terbaru dengan performa lebih kencang dan harga terjangkau.',
                'isi' => "PT Solusi Koneksi Anda secara resmi meluncurkan layanan cloud server generasi terbaru pada bulan ini. Layanan ini hadir dengan NVMe SSD, prosesor terbaru, dan jaminan performa hingga dua kali lipat dibandingkan generasi sebelumnya.\n\nLayanan baru ini sudah tersedia untuk seluruh pelanggan, baik yang baru maupun yang sudah berlangganan, dengan skema migrasi gratis tanpa downtime.\n\nKlien dapat memilih paket mulai dari Rp 350.000 per bulan dengan RAM 2 GB, 2 vCPU, dan storage NVMe 50 GB. Tersedia pula paket bisnis dengan dedicated resources untuk kebutuhan aplikasi berskala besar.\n\nInformasi lengkap dan pemesanan dapat menghubungi tim marketing kami melalui halaman kontak di website ini.",
            ],
            [
                'judul' => 'Digitalisasi UMKM: Langkah Awal Transformasi Digital',
                'kategori' => 'Tips',
                'penulis' => 'Tim Solusi Koneksi',
                'ringkasan' => 'Transformasi digital bukan lagi pilihan, melainkan keharusan. Simak langkah awal yang praktis bagi UMKM untuk mulai go digital.',
                'isi' => "Transformasi digital tidak harus dimulai dengan biaya besar. Berikut langkah-langkah praktis yang bisa dilakukan UMKM:\n\n1. Digitalisasi administrasi — Gunakan aplikasi pembukuan digital untuk mencatat keuangan secara rapi dan otomatis.\n\n2. Kehadiran online — Buat website company profile sederhana dan daftarkan bisnis Anda di Google Maps serta media sosial.\n\n3. Koneksi yang andal — Pastikan jaringan internet di tempat usaha stabil agar pelayanan kepada pelanggan tidak terganggu.\n\n4. Keamanan data — Lindungi data pelanggan dengan password kuat, backup rutin, dan antivirus yang selalu diperbarui.\n\nPT Solusi Koneksi Anda menyediakan paket solusi lengkap untuk UMKM, mulai dari pembuatan website, internet, hingga keamanan siber dengan harga terjangkau.",
            ],
            [
                'judul' => 'Wawancara dengan Klien: Meningkatkan Efisiensi Operasional Hingga 40%',
                'kategori' => 'Informasi',
                'penulis' => 'Humas Solusi Koneksi',
                'ringkasan' => 'Cerita sukses salah satu klien kami dalam meningkatkan efisiensi operasional bisnis melalui penerapan solusi jaringan dan cloud terintegrasi.',
                'isi' => "Salah satu klien kami, perusahaan distribusi barang di Bogor, berhasil meningkatkan efisiensi operasional hingga 40% setelah beralih ke solusi terintegrasi dari PT Solusi Koneksi Anda.\n\nSebelumnya, perusahaan ini mengalami seringnya gangguan koneksi yang menghambat proses pengiriman dan pencatatan stok secara real-time. Setelah berlangganan internet dedicated dan cloud server kami, seluruh sistem gudang dan distribusi terhubung dalam satu jaringan yang stabil.\n\n\"Kami bisa memantau stok dan rute pengiriman secara real-time. Waktu proses administrasi turun drastis,\" ujar Manajer Operasional klien tersebut.\n\nKisah ini membuktikan bahwa teknologi yang tepat memberikan dampak nyata bagi bisnis.",
            ],
            [
                'judul' => 'Jaga Produktivitas Tim Kerja dengan Jaringan Andal',
                'kategori' => 'Tips',
                'penulis' => 'Divisi Network',
                'ringkasan' => 'Produktivitas tim sangat bergantung pada kualitas jaringan. Berikut cara memastikan jaringan kantor selalu prima.',
                'isi' => "Jaringan yang lambat dan tidak stabil dapat mengurangi produktivitas tim hingga 30%. Berikut beberapa cara menjaga kualitas jaringan di kantor:\n\n1. Pisahkan jaringan tamu dan karyawan — Agar bandwidth untuk pekerjaan tidak terbagi oleh penggunaan pribadi.\n\n2. Gunakan router dan switch berkualitas — Perangkat jaringan yang handal mencegah bottleneck saat jam sibuk.\n\n3. Lakukan monitoring berkala — Deteksi gangguan sebelum berdampak pada pekerjaan tim.\n\n4. Sediakan jalur cadangan — Koneksi backup otomatis memastikan aktivitas tetap berjalan saat jalur utama bermasalah.\n\nLayanan Managed Services dari PT Solusi Koneksi Anda mencakup monitoring jaringan 24/7 oleh tim bersertifikat, sehingga tim Anda dapat bekerja tanpa khawatir soal koneksi.",
            ],
        ];

        foreach ($artikel as $index => $item) {
            Artikel::updateOrCreate(
                ['judul' => $item['judul']],
                $item + [
                    'is_published' => true,
                    'published_at' => now()->subDays(count($artikel) - $index)->startOfDay(),
                    'views' => rand(15, 200),
                ]
            );
        }

        // ---------- Galeri kegiatan (dinamis) ----------
        $galeri = [
            ['judul' => 'Pelatihan Digitalisasi UMKM Kota Bogor', 'kategori' => 'Pelatihan', 'deskripsi' => 'Pelatihan digitalisasi UMKM bekerja sama dengan Dinas Koperasi dan UKM Kota Bogor.'],
            ['judul' => 'Rapat Koordinasi Tim Teknis', 'kategori' => 'Internal', 'deskripsi' => 'Rapat koordinasi rutin tim teknis membahas strategi peningkatan kualitas layanan.'],
            ['judul' => 'Serah Terima Proyek Instalasi Jaringan', 'kategori' => 'Proyek', 'deskripsi' => 'Penyelesaian proyek instalasi jaringan dedicated untuk klien korporasi di Jakarta.'],
            ['judul' => 'Workshop Keamanan Siber untuk Pelanggan', 'kategori' => 'Workshop', 'deskripsi' => 'Workshop keamanan siber bersama pelanggan korporasi dan UMKM binaan.'],
            ['judul' => 'Bakti Sosial Peringatan HUT RI', 'kategori' => 'Sosial', 'deskripsi' => 'Kegiatan bakti sosial karyawan PT Solusi Koneksi Anda dalam rangka HUT Kemerdekaan RI.'],
            ['judul' => 'Onboarding Karyawan Baru Angkatan 2026', 'kategori' => 'Internal', 'deskripsi' => 'Program orientasi karyawan baru untuk memperkenalkan budaya dan visi perusahaan.'],
            ['judul' => 'Expo Teknologi Bogor 2026', 'kategori' => 'Pameran', 'deskripsi' => 'Partisipasi PT Solusi Koneksi Anda pada pameran teknologi tingkat kota.'],
            ['judul' => 'Tim Support Siaga 24 Jam', 'kategori' => 'Internal', 'deskripsi' => 'Dokumentasi tim Network Operation Center yang siaga 24/7 menjaga koneksi pelanggan.'],
        ];

        foreach ($galeri as $index => $item) {
            Galeri::updateOrCreate(
                ['judul' => $item['judul']],
                $item + [
                    'gambar' => 'images/placeholder-galeri.svg',
                    'tanggal_kegiatan' => now()->subDays($index * 7)->toDateString(),
                ]
            );
        }
    }
}
