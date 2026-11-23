@extends('layouts.base')

@section('title', 'Program Studi')
@include('partials.breadcrumb', ['items' => [['label' => 'Program Studi']]])

@section('content')
{{-- Data prodi dikirim dari build.php sebagai $daftarProdi (di Laravel:
     controller mengirim hasil query model ProgramStudi). --}}

@include('partials.page-header', [
    'judul' => 'Program studi',
    'ringkas' => 'Tiga program studi bidang komputer. Akreditasi tiap prodi ditampilkan langsung di kartu, karena itulah yang pertama dicari calon mahasiswa.',
])

<section class="container-page pb-10">
    {{-- Pencarian/filter hanya ditampilkan bila prodi > 6; untuk 3 prodi filter
         hanya menambah langkah tanpa membantu. --}}
    <div class="grid gap-4 md:grid-cols-3">
        @foreach ($daftarProdi as $p)
            <article class="card flex flex-col p-5">
                <p class="eyebrow">{{ $p['jenjang'] }}</p>
                <h2 class="mt-1 text-xl font-bold text-body">
                    <a href="{{ $p['url'] }}" class="hover:text-primary">{{ $p['nama'] }}</a>
                </h2>
                <p class="text-sm text-body-soft">{{ $p['gelar'] }}</p>
                <p class="mt-3 text-base">{{ $p['desk'] }}</p>
                <p class="mt-4 flex items-center gap-2 text-sm font-semibold text-success">
                    <svg aria-hidden="true" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m5 13 4 4L19 7"/></svg>
                    Terakreditasi {{ $p['akr'] }}
                </p>
                <a href="{{ $p['url'] }}" class="btn btn-secondary mt-5 self-start">Lihat profil prodi<span class="sr-only"> {{ $p['nama'] }}</span></a>
            </article>
        @endforeach
    </div>

    <div class="card mt-8 border-l-4 border-l-accent p-5">
        <h2 class="text-lg font-bold">Bingung memilih?</h2>
        <p class="mt-1 text-measure text-body-soft">Hubungi tim penerimaan mahasiswa pada hari kerja, 08.00–15.30 WIB. Kami tidak menentukan pilihan untuk Anda, tetapi dapat menjelaskan perbedaan kurikulum.</p>
        <a href="profil.html#kontak" class="btn btn-primary mt-3">Hubungi penerimaan</a>
    </div>
</section>
@endsection
