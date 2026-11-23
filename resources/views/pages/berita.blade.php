@extends('layouts.base')

@section('title', 'Berita')
@include('partials.breadcrumb', ['items' => [['label' => 'Berita']]])

@section('content')
@php
    $berita = [
        ['kategori' => 'Kegiatan', 'judul' => 'Kuliah umum: pemanfaatan kecerdasan artifisial di sektor publik dan implikasinya bagi layanan pemerintahan daerah', 'tanggal' => '2026-11-20', 'gambar' => 'berita-1', 'url' => 'berita-detail.html'],
        ['kategori' => 'Prestasi', 'judul' => 'Tim mahasiswa meraih juara pertama lomba aplikasi tingkat nasional tahun 2026', 'tanggal' => '2026-11-14', 'gambar' => 'berita-2', 'url' => 'berita-detail.html'],
        ['kategori' => 'Kerja Sama', 'judul' => 'Penandatanganan kerja sama magang dengan lima perusahaan teknologi', 'tanggal' => '2026-11-06', 'gambar' => null, 'url' => 'berita-detail.html'],
        ['kategori' => 'Akademik', 'judul' => 'Pengenalan kurikulum baru untuk mahasiswa angkatan 2026', 'tanggal' => '2026-10-30', 'gambar' => 'berita-3', 'url' => 'berita-detail.html'],
        ['kategori' => 'Kegiatan', 'judul' => 'Workshop keamanan siber bekerja sama dengan industri', 'tanggal' => '2026-10-22', 'gambar' => 'berita-4', 'url' => 'berita-detail.html'],
        ['kategori' => 'Prestasi', 'judul' => 'Dosen meraih hibah penelitian tingkat nasional', 'tanggal' => '2026-10-18', 'gambar' => 'berita-5', 'url' => 'berita-detail.html'],
    ];
@endphp

@include('partials.page-header', [
    'judul' => 'Berita',
    'ringkas' => 'Kegiatan, prestasi, dan kerja sama fakultas. Setiap berita bertanggal dan berkategori.',
])

<section class="container-page pb-10">
    {{-- Berita utama: TANPA slider otomatis. Satu berita unggulan yang statis
           lebih terbaca daripada tiga berita yang berganti sendiri. --}}
    <article class="card overflow-hidden md:grid md:grid-cols-2">
        <img src="img/berita-1.webp" alt="" width="800" height="450" fetchpriority="high" decoding="async"
             class="aspect-[16/9] h-full w-full object-cover">
        <div class="p-5 md:p-6">
            <p class="text-2xs font-bold uppercase tracking-wider text-accent">Berita utama · Kegiatan</p>
            <h2 class="mt-2 text-2xl font-semibold leading-snug">
                <a href="berita-detail.html" class="hover:text-primary">Kuliah umum: pemanfaatan kecerdasan artifisial di sektor publik</a>
            </h2>
            <p class="mt-2 text-measure text-body-soft">Ringkasan dua kalimat: siapa, apa, kapan. Informasi ini yang dibaca orang di HP sebelum memutuskan membuka artikel.</p>
            <p class="mt-3 text-2xs text-body-soft"><time datetime="2026-11-20">20 November 2026</time></p>
            <a href="berita-detail.html" class="btn btn-secondary mt-4">Baca berita kuliah umum</a>
        </div>
    </article>

    <div class="mt-8 grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ($berita as $b)
            @include('components.card-berita', ['berita' => $b])
        @endforeach
    </div>

    @include('components.pagination', ['halaman' => 1, 'total' => 5])
</section>
@endsection
