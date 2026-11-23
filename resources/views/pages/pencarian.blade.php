@extends('layouts.base')

@section('title', 'Hasil pencarian')
@include('partials.breadcrumb', ['items' => [['label' => 'Pencarian']]])

@section('content')
@php
    // Di Laravel: hasil dari mesin pencari (dosen, dokumen, pengumuman,
    // berita, halaman, prodi). Di sini dicontohkan hasil dengan dua jenis.
    $kata = 'biaya kuliah';
    $hasil = [
        ['Penerimaan · Biaya Kuliah', 'penerimaan.html#biaya', 'Tabel UKT per jalur masuk beserta keterangan biaya di luar UKT.', 'Halaman'],
        ['SK Biaya Kuliah 2026', 'unduhan.html', 'PDF · 1,1 MB · diunggah 2026-07-20', 'Dokumen'],
        ['Pendaftaran Beasiswa Prestasi Tahap II dibuka', 'pengumuman.html', 'Pengumuman 5 November 2026', 'Pengumuman'],
    ];
@endphp

@include('partials.page-header', [
    'judul' => 'Hasil pencarian',
    'ringkas' => 'Hasil dikelompokkan per jenis, supaya Anda tidak perlu membedakan sendiri mana dokumen dan mana berita.',
])

<section class="container-page pb-10">
    <div class="max-w-2xl">
        @include('components.search-box', ['id' => 'q-cari', 'value' => $kata, 'chips' => []])
    </div>

    <p class="mt-5 text-body-soft" role="status">
        Ditemukan <strong>3 hasil</strong> untuk “{{ $kata }}”.
    </p>

    @foreach ([['Halaman', 'bg-primary-soft text-primary'], ['Dokumen', 'bg-danger-soft text-danger'], ['Pengumuman', 'bg-accent-soft text-accent'], ['Berita', 'bg-surface text-body'], ['Dosen', 'bg-surface text-body']] as [$jenis, $warna])
        @php $item = array_values(array_filter($hasil, fn ($h) => $h[3] === $jenis)); @endphp
        @if (count($item))
            <section class="mt-8">
                <h2 class="flex items-baseline gap-2 text-xl font-semibold">
                    {{ $jenis }}
                    <span class="text-sm font-normal text-body-soft">({{ count($item) }})</span>
                </h2>
                <ul class="mt-2 divide-y divide-line border-y border-line">
                    @foreach ($item as $h)
                        <li class="py-3">
                            <a href="{{ $h[1] }}" class="font-semibold text-primary underline">{{ $h[0] }}</a>
                            <p class="mt-1 text-sm text-body-soft">{{ $h[2] }}</p>
                        </li>
                    @endforeach
                </ul>
            </section>
        @endif
    @endforeach

    {{-- Hasil kosong BUKAN jalan buntu: beri tautan yang paling sering dicari
           dan cara menghubungi manusia. --}}
    <section class="card mt-10 p-5">
        <h2 class="text-lg font-semibold">Yang paling sering dicari</h2>
        <ul class="mt-3 flex flex-wrap gap-2">
            @foreach (['Biaya kuliah', 'Syarat pendaftaran', 'Jadwal kuliah', 'Direktori dosen', 'Akreditasi'] as $c)
                <li><a href="pencarian.html?q={{ urlencode($c) }}" class="chip">{{ $c }}</a></li>
            @endforeach
        </ul>
        <p class="mt-4 text-sm text-body-soft">Belum ketemu? <a class="link" href="profil.html#kontak">Hubungi kami</a>. Kami membalas pada jam layanan.</p>
    </section>
</section>
@endsection
