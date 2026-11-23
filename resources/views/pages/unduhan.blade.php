@extends('layouts.base')

@section('title', 'Unduhan')
@include('partials.breadcrumb', ['items' => [['label' => 'Akademik', 'url' => 'akademik.html'], ['label' => 'Unduhan']]])

@section('content')
@php
    $dokumen = [
        ['Kalender Akademik 2026/2027', 'PDF', '480 KB', '2026-09-02', 'Akademik'],
        ['Formulir Pengajuan Cuti Akademik', 'PDF', '210 KB', '2026-08-30', 'Layanan'],
        ['Panduan Penulisan Skripsi', 'PDF', '2,4 MB', '2026-08-15', 'Akademik'],
        ['SK Biaya Kuliah 2026', 'PDF', '1,1 MB', '2026-07-20', 'Keuangan'],
        ['Format Surat Keterangan Aktif', 'DOCX', '45 KB', '2026-07-10', 'Layanan'],
    ];
@endphp

@include('partials.page-header', [
    'judul' => 'Unduhan',
    'ringkas' => 'Formulir dan dokumen resmi. Nama dokumen, jenis, dan ukuran berkas selalu ditampilkan agar Anda tahu apa yang akan diunduh.',
])

<section class="container-page pb-10">
    <div class="flex flex-wrap items-center gap-2">
        <span class="text-sm text-body-soft">Kategori:</span>
        @foreach (['Semua', 'Akademik', 'Layanan', 'Keuangan'] as $i => $k)
            <a href="unduhan.html?kategori={{ strtolower($k) }}" class="chip" @if ($i === 0) aria-current="true" @endif>{{ $k }}</a>
        @endforeach
    </div>

    {{-- Desktop: tabel (3 kolom). HP: kartu. Nama file asli TIDAK ditampilkan;
           judul dari staf yang tampil, nama file di bawahnya sebagai detail. --}}
    <div class="card mt-4 overflow-hidden">
        <table class="data-table">
            <caption class="sr-only">Daftar dokumen yang dapat diunduh</caption>
            <thead>
                <tr>
                    <th scope="col">Dokumen</th>
                    <th scope="col">Berkas</th>
                    <th scope="col">Diunggah</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dokumen as [$nama, $jenis, $ukuran, $tgl, $kat])
                    <tr>
                        <td data-label="Dokumen">
                            <a href="#" class="font-semibold text-primary underline">{{ $nama }}</a>
                            <span class="block text-2xs text-body-soft">{{ $kat }}</span>
                        </td>
                        <td data-label="Berkas" class="tabular">{{ $jenis }} · {{ $ukuran }}</td>
                        <td data-label="Diunggah" class="tabular">{{ $tgl }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <p class="mt-3 text-sm text-body-soft">Dokumen yang tidak perlu lagi diunduh dipindahkan ke arsip, tidak dihapus, agar tautan lama tetap dapat dibuka.</p>
</section>
@endsection
