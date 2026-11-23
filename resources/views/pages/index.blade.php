@extends('layouts.base')

@section('title', 'Beranda')

@section('content')
@php
    // Data contoh (placeholder). Di Laravel, ini diganti hasil query model Berita.
    // Judul sengaja dibuat panjang untuk menguji perilaku "clamp 2 baris".
    $beritaBeranda = [
        ['kategori' => 'Kegiatan', 'judul' => 'Kuliah umum: pemanfaatan kecerdasan artifisial di sektor publik dan implikasinya bagi layanan pemerintahan daerah', 'tanggal' => '2026-11-20', 'gambar' => 'berita-1', 'url' => 'berita-detail.html'],
        ['kategori' => 'Prestasi', 'judul' => 'Tim mahasiswa meraih juara pertama lomba aplikasi tingkat nasional tahun 2026', 'tanggal' => '2026-11-14', 'gambar' => 'berita-2', 'url' => 'berita-detail.html'],
        ['kategori' => 'Kerja Sama', 'judul' => 'Penandatanganan kerja sama magang dengan lima perusahaan teknologi', 'tanggal' => '2026-11-06', 'gambar' => null, 'url' => 'berita-detail.html'],
    ];
@endphp
{{-- ============================================================
     BERANDA — urutan blok mengikuti urutan pertanyaan pengunjung
     (Tahap 2), bukan urutan kepentingan institusi:
     hero -> fakta -> pencarian -> pintasan -> pengumuman -> prodi ->
     berita -> kontak.
     ============================================================ --}}

{{-- 1. HERO. Tanpa slider/carousel: konten penting yang bergerak otomatis
     tidak terbaca di HP dan tidak bisa dihentikan pembaca layar. --}}
{{-- Gradasi halus dari hijau PANTONE 349 ke versi lebih gelap: blok rata
     terasa berat di layar lebar. Gambar latar tetap ada di bawahnya. --}}
<section class="relative isolate overflow-hidden text-white bg-[linear-gradient(155deg,#357f60_0%,#2c7657_38%,rgb(27_81_60/0.72)_100%)]">
    {{-- Gambar latar dipasang sebagai <img> (bukan CSS) supaya bisa diberi
         alt & width/height. Overlay gelap 90%/78% memastikan kontras teks
         putih tetap >=4.5:1 apa pun terangnya foto di bawahnya. --}}
    <picture>
        <source srcset="img/hero-gedung.webp" type="image/webp">
        <img src="img/hero-gedung-fallback.jpg" alt=""
             width="1600" height="686"
             {{-- Gambar ini di atas lipatan: JANGAN lazy-load, kalau tidak
                  hero (yang menentukan kesan pertama) justru datang terakhir. --}}
             loading="eager" fetchpriority="high" decoding="async"
             class="absolute inset-0 -z-10 h-full w-full object-cover">
    </picture>
    {{-- Tirai hijau: 62% di HP, 48% di desktop. Foto gedung tetap terlihat
         (hero tidak terasa kosong), sementara teks putih tetap di area gelap
         dan lolos kontras. --}}
    <div aria-hidden="true" class="absolute inset-0 -z-10 bg-[linear-gradient(155deg,rgb(15_42_32/0.72)_0%,rgb(15_42_32/0.62)_100%)] md:bg-[linear-gradient(155deg,rgb(15_42_32/0.58)_0%,rgb(15_42_32/0.46)_100%)]"></div>

    <div class="container-page py-11 md:py-16 lg:py-20">
        <div class="max-w-3xl">
            <h1 class="mt-2 text-hero font-semibold leading-tight md:text-hero-d">
                Fakultas Ilmu Komputer
            </h1>
            <p class="mt-3 text-lg text-white">
                Informasi resmi program studi, penerimaan mahasiswa baru, akademik, dan dosen.
            </p>

            {{-- Tiga tombol niat, bukan satu tombol "Daftar": 2 dari 3
                 pengunjung BUKAN calon mahasiswa. --}}
            {{-- Tiga pintu niat, satu gaya tombol. Sengaja TIDAK memakai
                 tombol "ghost" (garis tipis) di atas latar teal: di layar HP
                 garis itu nyaris tak terlihat sehingga tombol terbaca sebagai
                 teks biasa. Semua memakai latar putih/krem supaya jelas bisa
                 ditekan; yang pertama lebih padat karena paling sering dipakai. --}}
            <div class="mt-6 flex flex-col gap-2.5 sm:flex-row sm:flex-wrap sm:gap-3">
                <a href="penerimaan.html" class="btn btn-on-dark w-full sm:w-auto">Calon Mahasiswa</a>
                <a href="akademik.html" class="btn btn-ghost-dark w-full sm:w-auto">Mahasiswa Aktif</a>
                <a href="profil.html" class="btn btn-ghost-dark w-full sm:w-auto">Dosen &amp; Staf</a>
            </div>

            <p class="mt-4 text-sm text-white/90">
                Terakreditasi <strong class="text-white">B</strong> oleh LAM INFOKOM · Periode pendaftaran 1 Juni – 12 Desember 2026
            </p>
        </div>
    </div>
</section>

{{-- 2. FAKTA KEPERCAYAAN --}}
@include('components.stat-strip')

{{-- 3. PENCARIAN: jendela pertama HP pun sudah bisa langsung mencari. --}}
<section class="border-b border-line bg-page">
    <div class="container-page py-6 md:py-8">
        <h2 class="text-lg font-semibold text-body">Cari yang Anda butuhkan</h2>
        <div class="mt-3">
            @include('components.search-box')
        </div>
    </div>
</section>

{{-- 4. PINTASAN PER PENGGUNA. Tautan teks, bukan kartu bergambar: hemat data
     dan tetap terbaca bila gambar gagal dimuat. --}}
<section class="container-page py-8 md:py-10">
    <div class="grid gap-4 md:grid-cols-2">
        <div class="card p-5">
            <h2 class="text-xl font-semibold">Calon mahasiswa</h2>
            <p class="mt-1 text-sm text-body-soft">Anda SMA/SMK dan ingin mendaftar.</p>
            <ul class="mt-3 divide-y divide-line">
                @foreach ([['Alur & syarat pendaftaran', 'penerimaan.html#alur'], ['Biaya kuliah', 'penerimaan.html#biaya'], ['Beasiswa', 'penerimaan.html#beasiswa'], ['Pilihan program studi', 'program-studi.html']] as [$l, $u])
                    <li><a href="{{ $u }}" class="flex min-h-[44px] items-center justify-between gap-3 font-semibold text-primary underline hover:text-primary-strong">{{ $l }} <span aria-hidden="true">›</span></a></li>
                @endforeach
            </ul>
        </div>
        <div class="card p-5">
            <h2 class="text-xl font-semibold">Mahasiswa aktif</h2>
            <p class="mt-1 text-sm text-body-soft">Anda sudah terdaftar dan butuh layanan akademik.</p>
            <ul class="mt-3 divide-y divide-line">
                @foreach ([['Jadwal kuliah', 'akademik.html#jadwal'], ['Kalender akademik', 'akademik.html#kalender'], ['Pengumuman', 'pengumuman.html'], ['Unduhan formulir & dokumen', 'unduhan.html']] as [$l, $u])
                    <li><a href="{{ $u }}" class="flex min-h-[44px] items-center justify-between gap-3 font-semibold text-primary underline hover:text-primary-strong">{{ $l }} <span aria-hidden="true">›</span></a></li>
                @endforeach
            </ul>
        </div>
    </div>
</section>

{{-- 5. PENGUMUMAN TERBARU (3). Informasi paling berumur pendek, jadi
     diletakkan sebelum berita. Tanggal wajib tampil. --}}
<section class="bg-surface border-y border-line">
    <div class="container-page py-8 md:py-10">
        <div class="flex flex-wrap items-end justify-between gap-3">
            <h2 class="text-2xl font-semibold">Pengumuman terbaru</h2>
            <a href="pengumuman.html" class="link">Semua pengumuman</a>
        </div>
        <ul class="mt-4 divide-y divide-line border-y border-line">
            @php
                $pengumuman = [
                    ['Jadwal Ujian Tengah Semester Ganjil 2026/2027', '2026-11-18', 'Akademik'],
                    ['Perpanjangan batas pengisian Kartu Rencana Studi', '2026-11-12', 'Akademik'],
                    ['Pendaftaran Beasiswa Prestasi Tahap II dibuka', '2026-11-05', 'Kemahasiswaan'],
                ];
            @endphp
            @foreach ($pengumuman as [$judul, $tgl, $kat])
                <li>
                    <a href="pengumuman.html" class="notice hover:bg-page">
                        <span class="text-2xs font-bold uppercase tracking-wider text-accent">{{ $kat }}</span>
                        <h3 class="mt-1 text-lg font-semibold text-body">{{ $judul }}</h3>
                        <time datetime="{{ $tgl }}" class="mt-1 block text-2xs text-body-soft">{{ \Illuminate\Support\Carbon::parse($tgl)->translatedFormat('j F Y') }}</time>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</section>

{{-- 6. PROGRAM STUDI. Akreditasi tampil DI KARTU, bukan di dalam halaman
     prodi: itu pembeda pertama yang dicari calon mahasiswa. --}}
<section class="container-page py-8 md:py-10">
    <div class="flex flex-wrap items-end justify-between gap-3">
        <h2 class="text-2xl font-semibold">Program studi</h2>
        <a href="program-studi.html" class="link">Semua program studi</a>
    </div>
    @php
        $prodi = [
            ['S1 Informatika', 'Sarjana Komputer (S.Kom.)', 'B', 'prodi-informatika.html'],
            ['S1 Sistem Informasi', 'Sarjana Komputer (S.Kom.)', 'B', 'prodi-sistem-informasi.html'],
            ['D3 Teknologi Informasi', 'Ahli Madya Komputer (A.Md.Kom.)', 'Baik', 'prodi-teknologi-informasi.html'],
        ];
    @endphp
    <div class="mt-4 grid gap-4 md:grid-cols-3">
        @foreach ($prodi as [$nama, $gelar, $akr, $url])
            <a href="{{ $url }}" class="card-link p-5">
                <h3 class="text-lg font-semibold text-body">{{ $nama }}</h3>
                <p class="text-sm text-body-soft">{{ $gelar }}</p>
                <p class="mt-3 flex items-center gap-2 text-sm font-semibold text-success">
                    <svg aria-hidden="true" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m5 13 4 4L19 7"/></svg>
                    Terakreditasi {{ $akr }}
                </p>
                <span class="mt-3 inline-block text-sm font-semibold text-primary underline">Lihat profil prodi</span>
            </a>
        @endforeach
    </div>
</section>

{{-- 7. BERITA (3). --}}
<section class="bg-surface border-y border-line">
    <div class="container-page py-8 md:py-10">
        <div class="flex flex-wrap items-end justify-between gap-3">
            <h2 class="text-2xl font-semibold">Berita terbaru</h2>
            <a href="berita.html" class="link">Semua berita</a>
        </div>
        <div class="mt-4 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($beritaBeranda as $berita)
                @include('components.card-berita')
            @endforeach
        </div>
    </div>
</section>

{{-- 8. KONTAK. Jalan keluar bagi yang tidak menemukan jawaban.
     Peta berupa TAUTAN, bukan iframe peta: iframe peta bisa ratusan KB. --}}
<section class="container-page py-8 md:py-10">
    <div class="grid gap-6 md:grid-cols-2">
        <div>
            <h2 class="text-2xl font-semibold">Hubungi kami</h2>
            <p class="mt-2 text-measure text-body-soft">Jika informasi di situs ini belum menjawab kebutuhan Anda, hubungi kami pada jam layanan berikut.</p>
            <dl class="mt-4 space-y-2 text-base">
                <div class="flex gap-2"><dt class="w-24 shrink-0 font-semibold">Alamat</dt><dd>Jl. Contoh Raya No. 1, Kota Contoh</dd></div>
                <div class="flex gap-2"><dt class="w-24 shrink-0 font-semibold">Telepon</dt><dd><a href="tel:+620000000000" class="link">(0000) 000-000</a></dd></div>
                <div class="flex gap-2"><dt class="w-24 shrink-0 font-semibold">Email</dt><dd><a href="mailto:info@contoh.ac.id" class="link">info@contoh.ac.id</a></dd></div>
                <div class="flex gap-2"><dt class="w-24 shrink-0 font-semibold">Jam layanan</dt><dd>Senin–Jumat, 08.00–15.30 WIB</dd></div>
            </dl>
            <a href="profil.html#kontak" class="btn btn-secondary mt-4">Semua kontak</a>
        </div>
        <div class="card p-5">
            <h3 class="text-lg font-semibold">Informasi penerimaan</h3>
            <p class="mt-1 text-sm text-body-soft">Pertanyaan calon mahasiswa paling sering dijawab di sini.</p>
            <ul class="mt-3 divide-y divide-line">
                <li><a href="penerimaan.html#biaya" class="flex min-h-[44px] items-center justify-between font-semibold text-primary underline">Biaya kuliah per jalur <span aria-hidden="true">›</span></a></li>
                <li><a href="penerimaan.html#syarat" class="flex min-h-[44px] items-center justify-between font-semibold text-primary underline">Syarat dokumen <span aria-hidden="true">›</span></a></li>
                <li><a href="penerimaan.html#faq" class="flex min-h-[44px] items-center justify-between font-semibold text-primary underline">Tanya-jawab <span aria-hidden="true">›</span></a></li>
            </ul>
        </div>
    </div>
</section>
@endsection
