@extends('layouts.base')

@section('title', 'Pengumuman')
@include('partials.breadcrumb', ['items' => [['label' => 'Akademik', 'url' => 'akademik.html'], ['label' => 'Pengumuman']]])

@section('content')
@php
    $daftar = [
        ['Jadwal Ujian Tengah Semester Ganjil 2026/2027', '2026-11-18', 'Akademik', 'Aktif'],
        ['Perpanjangan batas pengisian Kartu Rencana Studi', '2026-11-12', 'Akademik', 'Aktif'],
        ['Pendaftaran Beasiswa Prestasi Tahap II dibuka', '2026-11-05', 'Kemahasiswaan', 'Aktif'],
        ['Pemeliharaan laboratorium komputer akhir pekan', '2026-10-28', 'Umum', 'Selesai'],
        ['Pembukaan pendaftaran asistensi praktikum', '2026-10-21', 'Akademik', 'Selesai'],
    ];
@endphp

@include('partials.page-header', [
    'judul' => 'Pengumuman',
    'ringkas' => 'Seluruh pengumuman resmi fakultas, terbaru di atas. Setiap pengumuman selalu bertanggal.',
])

<section class="container-page pb-10">
    {{-- Filter berupa form GET biasa: tetap berfungsi tanpa JavaScript. --}}
    <form action="pengumuman.html" method="get" class="card p-4">
        <div class="grid gap-3 sm:grid-cols-[minmax(0,1fr)_12rem_auto]">
            <div>
                <label for="cari-pengumuman" class="label">Cari pengumuman</label>
                <input id="cari-pengumuman" name="q" type="search" class="input" placeholder="cth. KRS, beasiswa">
            </div>
            <div>
                <label for="kategori" class="label">Kategori</label>
                <select id="kategori" name="kategori" class="input">
                    <option>Semua</option>
                    <option>Akademik</option>
                    <option>Kemahasiswaan</option>
                    <option>Umum</option>
                </select>
            </div>
            <div class="sm:self-end">
                <button type="submit" class="btn btn-primary w-full sm:w-auto">Terapkan</button>
            </div>
        </div>
    </form>

    <p class="mt-4 text-sm text-body-soft" role="status">Menampilkan 1–5 dari 5 pengumuman.</p>

    <ul class="mt-2 divide-y divide-line border-y border-line">
        @foreach ($daftar as [$judul, $tgl, $kat, $status])
            <li>
                <a href="pengumuman.html" class="notice block hover:bg-surface">
                    <span class="text-2xs font-bold uppercase tracking-wider text-accent">{{ $kat }}</span>
                    <span class="mt-1 block text-lg font-semibold text-body">{{ $judul }}</span>
                    <span class="mt-1 flex flex-wrap items-center gap-x-3 text-2xs text-body-soft">
                        <time datetime="{{ $tgl }}">{{ $tgl }}</time>
                        {{-- Status tidak hanya warna: ikon + kata. --}}
                        @if ($status === 'Aktif')
                            <span class="inline-flex items-center gap-1 font-semibold text-success"><svg aria-hidden="true" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="m5 13 4 4L19 7"/></svg> {{ $status }}</span>
                        @else
                            <span class="inline-flex items-center gap-1 font-semibold text-body-soft"><svg aria-hidden="true" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M6 6l12 12M18 6 6 18"/></svg> {{ $status }}</span>
                        @endif
                    </span>
                </a>
            </li>
        @endforeach
    </ul>

    @include('components.pagination', ['halaman' => 1, 'total' => 3])
</section>
@endsection
