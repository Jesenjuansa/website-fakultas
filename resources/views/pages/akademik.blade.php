@extends('layouts.base')

@section('title', 'Akademik')
@include('partials.breadcrumb', ['items' => [['label' => 'Akademik']]])

@section('content')
@include('partials.page-header', [
    'judul' => 'Akademik',
    'ringkas' => 'Pengumuman terbaru, jadwal kuliah, kalender akademik, dan dokumen yang dibutuhkan mahasiswa aktif.',
])

@php
    $pengumuman = [
        ['Jadwal Ujian Tengah Semester Ganjil 2026/2027', '2026-11-18', 'Akademik'],
        ['Perpanjangan batas pengisian Kartu Rencana Studi', '2026-11-12', 'Akademik'],
        ['Pendaftaran Beasiswa Prestasi Tahap II dibuka', '2026-11-05', 'Kemahasiswaan'],
    ];
    // Jadwal kuliah contoh: 5 kolom -> di HP berubah jadi kartu (bukan tabel
    // yang digeser). Ini kasus yang paling sering rusak di situs kampus.
    $jadwal = [
        ['Senin', '08.00–09.40', 'Dasar Pemrograman', 'Lab 1', 'A'],
        ['Senin', '10.00–11.40', 'Matematika Diskret', 'Ruang A.201', 'A'],
        ['Selasa', '13.00–14.40', 'Struktur Data', 'Ruang B.105', 'B'],
        ['Kamis', '08.00–09.40', 'Basis Data', 'Lab 2', 'A'],
    ];
@endphp

<section class="container-page pb-10">
    {{-- 1. PENGUMUMAN: alasan utama mahasiswa membuka situs di tengah semester.
           Ditaruh paling atas, tidak di bawah sambutan. --}}
    <section aria-labelledby="pengumuman-akademik">
        <div class="flex flex-wrap items-end justify-between gap-3">
            <h2 id="pengumuman-akademik" class="text-2xl font-bold">Pengumuman terbaru</h2>
            <a href="pengumuman.html" class="link text-sm">Semua pengumuman</a>
        </div>
        <ul class="mt-3 divide-y divide-line border-y border-line">
            @foreach ($pengumuman as [$judul, $tgl, $kat])
                <li>
                    <a href="pengumuman.html" class="notice block hover:bg-surface">
                        <span class="text-2xs font-bold uppercase tracking-wider text-accent">{{ $kat }}</span>
                        <span class="mt-1 block text-lg font-semibold text-body">{{ $judul }}</span>
                        <time datetime="{{ $tgl }}" class="mt-1 block text-2xs text-body-soft">{{ \Illuminate\Support\Carbon::parse($tgl)->translatedFormat('j F Y') }}</time>
                    </a>
                </li>
            @endforeach
        </ul>
    </section>

    {{-- 2. TAUTAN CEPAT: 4 tujuan yang paling sering dipakai. --}}
    <nav aria-label="Tautan cepat akademik" class="mt-8">
        <ul class="grid gap-3 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ([['Jadwal kuliah', '#jadwal'], ['Kalender akademik', '#kalender'], ['Pengumuman', 'pengumuman.html'], ['Unduhan dokumen', 'unduhan.html']] as [$l, $u])
                <li><a href="{{ $u }}" class="card-link flex min-h-[56px] items-center justify-between px-4 font-semibold text-primary underline">{{ $l }} <span aria-hidden="true">›</span></a></li>
            @endforeach
        </ul>
    </nav>

    {{-- 3. JADWAL KULIAH --}}
    <section id="jadwal" class="mt-10 scroll-mt-24">
        <h2 class="text-2xl font-bold">Jadwal kuliah (contoh)</h2>
        <p class="mt-1 text-measure text-body-soft">Semester Ganjil 2026/2027, kelas A dan B Informatika. Pada layar sempit, tiap baris ditampilkan sebagai kartu: label di kiri, isi di kanan.</p>
        <div class="card mt-4 overflow-hidden">
            <table class="data-table">
                <caption class="sr-only">Jadwal kuliah contoh semester ganjil</caption>
                <thead>
                    <tr>
                        <th scope="col">Hari</th>
                        <th scope="col">Jam</th>
                        <th scope="col">Mata kuliah</th>
                        <th scope="col">Ruang</th>
                        <th scope="col">Kelas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jadwal as $j)
                        <tr>
                            {{-- data-label dipakai sebagai judul kolom saat tabel
                                 berubah menjadi kartu di HP. --}}
                            <td data-label="Hari" class="font-semibold">{{ $j[0] }}</td>
                            <td data-label="Jam" class="tabular">{{ $j[1] }}</td>
                            <td data-label="Mata kuliah">{{ $j[2] }}</td>
                            <td data-label="Ruang">{{ $j[3] }}</td>
                            <td data-label="Kelas">{{ $j[4] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

    {{-- 4. KALENDER AKADEMIK: hanya tanggal terdekat. Arsip lengkap di unduhan. --}}
    <section id="kalender" class="mt-10 scroll-mt-24">
        <h2 class="text-2xl font-bold">Kalender akademik terdekat</h2>
        <ol class="mt-3 space-y-2">
            @foreach ([['18 Nov 2026', 'Ujian Tengah Semester dimulai'], ['12 Des 2026', 'Batas akhir pengisian KRS'], ['24 Des 2026', 'Pengumuman hasil studi'], ['6 Jan 2027', 'Kuliah semester genap dimulai']] as [$tgl, $agenda])
                <li class="flex flex-wrap items-baseline gap-x-3 rounded-md border border-line px-4 py-3">
                    <time class="tabular w-32 shrink-0 text-sm font-bold text-primary">{{ $tgl }}</time>
                    <span class="text-base">{{ $agenda }}</span>
                </li>
            @endforeach
        </ol>
        <a href="unduhan.html" class="link mt-3 inline-block">Unduh kalender akademik lengkap</a>
    </section>
</section>
@endsection
