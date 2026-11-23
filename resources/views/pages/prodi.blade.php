@extends('layouts.base')

{{-- Satu view untuk tiga prodi: isi halaman ditentukan dari build.php.
     Kalau $prodi kosong (dibuka langsung), dipakai prodi pertama sebagai contoh. --}}
@php
    $prodi = $prodi ?? [
        'nama' => 'S1 Informatika',
        'gelar' => 'Sarjana Komputer (S.Kom.)',
        'jenjang' => 'S1',
        'akr' => 'B',
        'ringkas' => 'Pendidikan sarjana bidang komputasi dengan penekanan rekayasa perangkat lunak, kecerdasan artifisial, dan jaringan.',
        'bidang' => 'Rekayasa perangkat lunak, data, jaringan',
        'lulusan' => 'Engineer, analis sistem, data scientist',
        'kurikulum' => [
            ['INF101', 'Dasar Pemrograman', '4', '—'],
            ['INF102', 'Matematika Diskret', '3', '—'],
            ['INF103', 'Pengantar Sistem Komputer', '3', '—'],
            ['INF104', 'Struktur Data', '3', 'INF101'],
        ],
    ];
@endphp

@section('title', $prodi['nama'])
@include('partials.breadcrumb', ['items' => [['label' => 'Program Studi', 'url' => 'program-studi.html'], ['label' => $prodi['nama']]]])

@section('content')
@php
    $dosenProdi = [
        ['nama' => 'Contoh Nama Satu', 'gelar' => 'S.Kom., M.Kom.', 'prodi' => 'S1 Informatika', 'bidang' => 'Rekayasa perangkat lunak', 'foto' => 'dosen-1'],
        ['nama' => 'Contoh Nama Dua', 'gelar' => 'S.T., M.T.', 'prodi' => 'S1 Informatika', 'bidang' => 'Jaringan komputer', 'foto' => 'dosen-2'],
        ['nama' => 'Contoh Nama Tiga', 'gelar' => 'S.Kom., M.Cs.', 'prodi' => 'S1 Informatika', 'bidang' => 'Kecerdasan artifisial', 'foto' => null],
    ];
    // Kurikulum contoh, sengaja hanya SATU semester agar tidak menjadi tabel
    // 8 kolom. Tabel lebar ditolak desain ini (lihat Tahap 3). Datanya dari
    // $prodi (didefinisikan di bagian atas halaman).
    $kurikulum = $prodi['kurikulum'];
@endphp

@include('partials.page-header', [
    'judul' => $prodi['nama'],
    'eyebrow' => $prodi['gelar'] . ' · Jenjang ' . $prodi['jenjang'],
    'ringkas' => $prodi['ringkas'],
])

{{-- 1. Ringkasan 4 poin: menjawab 80% pertanyaan calon mahasiswa sebelum
       mereka menggulir ke kurikulum. --}}
<section class="container-page pb-8">
    <dl class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        @foreach ([
            ['Akreditasi', $prodi['akr'], 'LAM INFOKOM, berlaku sampai 2028'],
            ['Yang dipelajari', $prodi['bidang'], 'Lihat kurikulum di bawah'],
            ['Profil lulusan', $prodi['lulusan'], ''],
            ['Biaya & cara masuk', 'Lihat halaman penerimaan', ''],
        ] as [$label, $nilai, $catatan])
            <div class="card p-4">
                <dt class="text-2xs font-bold uppercase tracking-wider text-body-soft">{{ $label }}</dt>
                <dd class="mt-1 text-base font-semibold text-body">{{ $nilai }}</dd>
                @if ($catatan)<dd class="mt-1 text-2xs text-body-soft">{{ $catatan }}</dd>@endif
            </div>
        @endforeach
    </dl>
    <div class="mt-4 flex flex-wrap gap-3">
        <a href="penerimaan.html#biaya" class="btn btn-primary">Lihat biaya &amp; cara masuk</a>
        <a href="#kurikulum" class="btn btn-secondary">Lihat kurikulum</a>
    </div>
</section>

<section class="container-page pb-10">
    <div class="grid gap-10 lg:grid-cols-[minmax(0,1fr)_18rem]">
        <div class="min-w-0">
            {{-- 2. Dosen prodi: bukti ada orang nyata. Maks 6 kartu + tautan. --}}
            <section aria-labelledby="dosen-prodi">
                <div class="flex flex-wrap items-end justify-between gap-3">
                    <h2 id="dosen-prodi" class="text-2xl font-bold">Dosen program studi</h2>
                    <a href="dosen.html" class="link text-sm">Semua dosen</a>
                </div>
                <div class="mt-4 grid gap-3 md:grid-cols-2">
                    @foreach ($dosenProdi as $dosen)
                        @include('components.card-dosen')
                    @endforeach
                </div>
            </section>

            {{-- 3. Kurikulum: tabel 4 kolom, otomatis jadi kartu di HP. --}}
            <section id="kurikulum" class="mt-10 scroll-mt-24">
                <h2 class="text-2xl font-bold">Kurikulum semester 1 — {{ $prodi['nama'] }}</h2>
                <p class="mt-1 text-measure text-body-soft">Contoh satu semester. Tabel empat kolom ditampilkan sebagai daftar saat dibuka dari HP — tidak ada tabel yang harus digeser ke samping.</p>
                <div class="card mt-4 overflow-hidden">
                    <table class="data-table">
                        <caption class="sr-only">Kurikulum semester 1 program studi Informatika</caption>
                        <thead>
                            <tr>
                                <th scope="col">Kode</th>
                                <th scope="col">Mata kuliah</th>
                                <th scope="col">SKS</th>
                                <th scope="col">Prasyarat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kurikulum as $baris)
                                <tr>
                                    <td data-label="Kode" class="tabular">{{ $baris[0] }}</td>
                                    <td data-label="Mata kuliah">{{ $baris[1] }}</td>
                                    <td data-label="SKS" class="tabular">{{ $baris[2] }}</td>
                                    <td data-label="Prasyarat">{{ $baris[3] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>

            {{-- 4. Fasilitas --}}
            <section class="mt-10">
                <h2 class="text-2xl font-bold">Laboratorium pendukung</h2>
                <ul class="mt-3 grid gap-3 sm:grid-cols-2 text-base">
                    @foreach (['Lab Rekayasa Perangkat Lunak', 'Lab Jaringan & Keamanan', 'Lab Data & Kecerdasan Artifisial', 'Ruang kerja kelompok'] as $lab)
                        <li class="rounded-md bg-surface p-4">{{ $lab }}</li>
                    @endforeach
                </ul>
            </section>
        </div>

        {{-- Kolom samping: kontak prodi, selalu terlihat di desktop. --}}
        <aside class="lg:sticky lg:top-24 lg:self-start" aria-label="Kontak program studi">
            <div class="card p-5">
                <h2 class="text-lg font-bold">Kontak prodi</h2>
                <p class="mt-2 text-sm text-body-soft">Ketua Program Studi Informatika</p>
                <p class="text-base font-semibold">Contoh Nama Empat, S.Kom., M.Kom.</p>
                <p class="mt-2 text-sm"><a class="link" href="mailto:informatika@contoh.ac.id">informatika@contoh.ac.id</a></p>
                <p class="mt-1 text-sm"><a class="link" href="tel:+620000000001">(0000) 000-001</a></p>
                <p class="mt-3 text-2xs text-body-soft">Jam layanan Senin–Jumat, 08.00–15.30 WIB.</p>
            </div>
        </aside>
    </div>
</section>
@endsection
