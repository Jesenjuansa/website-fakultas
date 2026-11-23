@extends('layouts.base')

@section('title', 'Kuliah umum kecerdasan artifisial')
@include('partials.breadcrumb', ['items' => [['label' => 'Berita', 'url' => 'berita.html'], ['label' => 'Kuliah umum']]])

@section('content')
@php
    // Isi artikel: contoh teks hasil salin dari Word (paragraf, daftar,
    // subjudul). Gaya diterapkan dari stylesheet, bukan dari inline style.
    $terkait = [
        ['kategori' => 'Prestasi', 'judul' => 'Tim mahasiswa meraih juara pertama lomba aplikasi tingkat nasional', 'tanggal' => '2026-11-14', 'gambar' => 'berita-2', 'url' => 'berita-detail.html'],
        ['kategori' => 'Kegiatan', 'judul' => 'Workshop keamanan siber bekerja sama dengan industri', 'tanggal' => '2026-10-22', 'gambar' => 'berita-4', 'url' => 'berita-detail.html'],
        ['kategori' => 'Kerja Sama', 'judul' => 'Penandatanganan kerja sama magang dengan lima perusahaan teknologi', 'tanggal' => '2026-11-06', 'gambar' => null, 'url' => 'berita-detail.html'],
    ];
@endphp

<article class="container-page pb-10 pt-8">
    <div class="mx-auto max-w-3xl">
        <p class="text-2xs font-bold uppercase tracking-wider text-accent">Kegiatan</p>
        <h1 class="mt-2 text-3xl font-semibold leading-tight">Kuliah umum: pemanfaatan kecerdasan artifisial di sektor publik</h1>
        <p class="mt-3 text-sm text-body-soft">
            <time datetime="2026-11-20">20 November 2026</time> · Penulis: Admin Fakultas (contoh)
        </p>

        <img src="img/berita-1.webp" alt="" width="800" height="450" loading="lazy" decoding="async"
             class="mt-5 aspect-[16/9] w-full rounded-md object-cover">

        {{-- Lebar baris dibatasi 70 karakter agar mata tidak kehilangan baris
             saat kembali ke kiri. --}}
        <div class="prose-article mt-6 text-measure">
            <p>Paragraf pembuka berisi ringkasan acara: siapa pembicaranya, di mana, dan berapa peserta. Teks ini adalah contoh, bukan laporan sungguhan.</p>
            <h2>Isi pembahasan</h2>
            <p>Kuliah umum membahas tiga hal utama. Gaya paragraf dan subjudul diatur oleh halaman, bukan oleh staf yang menempel dari Word.</p>
            <ul>
                <li>Peluang penerapan kecerdasan artifisial di layanan publik.</li>
                <li>Risiko dan tata kelola data.</li>
                <li>Kebutuhan kemampuan teknis di instansi pemerintah.</li>
            </ul>
            <h2>Penutup</h2>
            <p>Acara ditutup dengan sesi tanya jawab. Informasi kegiatan berikutnya diumumkan melalui halaman <a href="berita.html">berita</a>.</p>
        </div>

        <p class="mt-8 text-sm text-body-soft">
            <a href="berita.html" class="link">← Kembali ke semua berita</a>
        </p>
    </div>

    {{-- Berita terkait: bermanfaat untuk menahan pengunjung, tapi tetap di bawah. --}}
    <section class="mx-auto mt-10 max-w-3xl">
        <h2 class="text-2xl font-semibold">Berita terkait</h2>
        <div class="mt-4 grid gap-3 sm:grid-cols-3">
            @foreach ($terkait as $b)
                @include('components.card-berita', ['berita' => $b])
            @endforeach
        </div>
    </section>
</article>
@endsection
