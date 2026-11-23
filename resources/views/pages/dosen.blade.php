@extends('layouts.base')

@section('title', 'Direktori Dosen')
@include('partials.breadcrumb', ['items' => [['label' => 'Dosen']]])

@section('content')
@php
    $dosen = [
        ['nama' => 'Contoh Nama Satu', 'gelar' => 'S.Kom., M.Kom.', 'prodi' => 'S1 Informatika', 'bidang' => 'Rekayasa perangkat lunak', 'foto' => 'dosen-1'],
        ['nama' => 'Contoh Nama Dua', 'gelar' => 'S.T., M.T.', 'prodi' => 'S1 Informatika', 'bidang' => 'Jaringan komputer', 'foto' => 'dosen-2'],
        ['nama' => 'Contoh Nama Tiga', 'gelar' => 'S.Kom., M.Cs.', 'prodi' => 'S1 Informatika', 'bidang' => 'Kecerdasan artifisial', 'foto' => null],
        ['nama' => 'Contoh Nama Empat', 'gelar' => 'S.Kom., M.M.', 'prodi' => 'S1 Sistem Informasi', 'bidang' => 'Tata kelola teknologi informasi', 'foto' => 'dosen-3'],
        ['nama' => 'Contoh Nama Lima', 'gelar' => 'S.Kom., M.T.', 'prodi' => 'S1 Sistem Informasi', 'bidang' => 'Analitik data', 'foto' => 'dosen-4'],
        ['nama' => 'Contoh Nama Enam', 'gelar' => 'A.Md.Kom., M.Kom.', 'prodi' => 'D3 Teknologi Informasi', 'bidang' => 'Administrasi sistem', 'foto' => 'dosen-5'],
    ];
@endphp

@include('partials.page-header', [
    'judul' => 'Direktori dosen',
    'ringkas' => 'Cari dosen berdasarkan nama, NIDN, atau bidang keahlian. Data terbuka tanpa perlu masuk (login).',
])

<section class="container-page pb-10">
    {{-- Jumlah hasil diberi judul h2 sungguhan: sebelumnya halaman melompat
           dari h1 ke h3 (pembaca layar kehilangan struktur daftar). --}}
    <h2 class="sr-only">Daftar dosen</h2>
    {{-- Kotak pencarian DOSEN saja, bukan pencarian situs: pencarian global
           yang mencampur berita akan mengubur nama dosen. Form GET biasa. --}}
    <form action="dosen.html" method="get" class="card p-4">
        <div class="grid gap-3 md:grid-cols-[minmax(0,1fr)_14rem_14rem_auto]">
            <div>
                <label for="q-dosen" class="label">Nama atau NIDN</label>
                <input id="q-dosen" name="q" type="search" class="input" placeholder="cth. Contoh Nama Satu / 0000000000">
            </div>
            <div>
                <label for="prodi-dosen" class="label">Program studi</label>
                <select id="prodi-dosen" name="prodi" class="input">
                    <option>Semua</option><option>S1 Informatika</option><option>S1 Sistem Informasi</option><option>D3 Teknologi Informasi</option>
                </select>
            </div>
            <div>
                <label for="bidang-dosen" class="label">Bidang</label>
                <select id="bidang-dosen" name="bidang" class="input">
                    <option>Semua</option><option>Rekayasa perangkat lunak</option><option>Jaringan</option><option>Data</option>
                </select>
            </div>
            <div class="md:self-end">
                <button type="submit" class="btn btn-primary w-full md:w-auto">Cari dosen</button>
            </div>
        </div>
    </form>

    <p class="mt-4 text-sm text-body-soft" role="status">Menampilkan 6 dari 42 dosen.</p>

    <div class="mt-2 grid gap-3 md:grid-cols-2 xl:grid-cols-3">
        @foreach ($dosen as $d)
            {{-- Komponen kartu dosen: foto/inisial, nama, prodi, bidang, email. --}}
            @include('components.card-dosen', ['dosen' => $d])
        @endforeach
    </div>

    @include('components.pagination', ['halaman' => 1, 'total' => 7])
</section>
@endsection
