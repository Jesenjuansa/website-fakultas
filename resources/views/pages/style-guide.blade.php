@extends('layouts.base')

@section('title', 'Panduan Desain (gaya)')
@include('partials.breadcrumb', ['items' => [['label' => 'Panduan Desain']]])

@section('content')
@include('partials.page-header', [
    'judul' => 'Panduan desain (living style guide)',
    'ringkas' => 'Halaman ini menampilkan token dan komponen yang dipakai situs. Kalau tampilannya berbeda dari halaman lain, berarti ada komponen yang tidak memakai token.',
])

<section class="container-page space-y-12 pb-12">
    {{-- Tipografi --}}
    <div>
        <h2 class="text-2xl font-bold">Tipografi</h2>
        <p class="mt-1 text-body-soft">Ukuran HP → desktop. Teks badan tidak pernah di bawah 16px.</p>
        <div class="mt-4 space-y-3 border-t border-line pt-4">
            <p class="text-hero font-bold leading-tight">Hero 30px → 44px</p>
            <p class="text-3xl font-bold">H1 28px → 36px</p>
            <p class="text-2xl font-bold">H2 24px → 28px</p>
            <p class="text-xl font-bold">H3 20px → 22px</p>
            <p class="text-lg">Lead 18px</p>
            <p class="text-base">Badan teks 16px, tinggi baris 1,6. Ini ukuran dasar seluruh isi situs.</p>
            <p class="text-sm text-body-soft">Teks bantu 14px (bukan untuk isi utama).</p>
            <p class="text-2xs text-body-soft">Label/meta 12px. Tanggal dan kategori.</p>
            <p class="eyebrow">Eyebrow 12px kapital</p>
        </div>
    </div>

    {{-- Warna + kontras --}}
    <div>
        <h2 class="text-2xl font-bold">Warna &amp; kontras</h2>
        <p class="mt-1 text-body-soft">Angka di kanan adalah rasio kontras terhadap putih. Teks normal wajib ≥ 4,5:1; batas elemen UI ≥ 3:1.</p>
        <ul class="mt-4 grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ([
                ['Primary', '#0f4c5c', '9,51:1', 'bg-primary text-white'],
                ['Primary hover', '#0b3c49', '11,95:1', 'bg-primary-strong text-white'],
                ['Aksen', '#8f4a25', '6,62:1', 'bg-accent text-white'],
                ['Teks utama', '#1a1a1a', '17,40:1', 'bg-body text-white'],
                ['Teks sekunder', '#4a4a4a', '8,86:1', 'bg-body-soft text-white'],
                ['Sukses', '#166e35', '6,33:1', 'bg-success text-white'],
                ['Peringatan', '#9a5b00', '5,43:1', 'bg-warning text-white'],
                ['Galat', '#b3261e', '6,54:1', 'bg-danger text-white'],
                ['Fokus', '#0b63a8', '6,24:1', 'bg-focus text-white'],
            ] as [$nama, $hex, $rasio, $kelas])
                <li class="overflow-hidden rounded-md border border-line">
                    <div class="{{ $kelas }} flex h-16 items-end justify-between p-2 text-sm font-semibold">
                        <span>{{ $nama }}</span><span class="tabular">{{ $hex }}</span>
                    </div>
                    <p class="bg-page px-2 py-1.5 text-2xs text-body-soft">Kontras vs putih: <strong class="text-body">{{ $rasio }}</strong></p>
                </li>
            @endforeach
        </ul>
        <div class="mt-4 space-y-2">
            @foreach ([['sukses', 'Pendaftaran dibuka', 'text-success', 'bg-success-soft'], ['peringatan', 'Dokumen belum lengkap', 'text-warning', 'bg-warning-soft'], ['galat', 'Berkas melebihi 5 MB', 'text-danger', 'bg-danger-soft']] as [$jenis, $teks, $warnaTeks, $warnaLatar])
                <p class="flex items-center gap-2 rounded-sm px-3 py-2 text-sm font-semibold {{ $warnaLatar }} {{ $warnaTeks }}">
                    <svg aria-hidden="true" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 8v5M12 17h.01"/><path d="M10.3 3.9 2.6 17a2 2 0 0 0 1.7 3h15.4a2 2 0 0 0 1.7-3L13.7 3.9a2 2 0 0 0-3.4 0Z"/></svg>
                    {{ $teks }} — status selalu ikon + kata, tidak hanya warna.
                </p>
            @endforeach
        </div>
    </div>

    {{-- Tombol --}}
    <div>
        <h2 class="text-2xl font-bold">Tombol</h2>
        <p class="mt-1 text-body-soft">Tinggi minimum 44px. Satu tombol primary per layar.</p>
        <div class="mt-4 flex flex-wrap items-center gap-3">
            <button class="btn btn-primary">Primary</button>
            <button class="btn btn-secondary">Secondary</button>
            <button class="btn btn-primary btn-sm">Primary kecil</button>
            <button class="btn btn-primary" disabled>Nonaktif</button>
            <a href="#" class="link">Gaya tautan</a>
        </div>
        <div class="mt-3 flex flex-wrap gap-2">
            <span class="chip">Chip</span>
            <span class="chip">Biaya kuliah</span>
        </div>
    </div>

    {{-- Form --}}
    <div>
        <h2 class="text-2xl font-bold">Form</h2>
        <div class="card mt-4 max-w-xl p-5">
            <div>
                <label for="sg-nama" class="label">Nama lengkap</label>
                <p class="hint" id="sg-nama-hint">Sesuai ijazah. Label selalu di atas dan terlihat.</p>
                <input id="sg-nama" type="text" class="input" aria-describedby="sg-nama-hint">
            </div>
            <div class="mt-4">
                <label for="sg-email" class="label">Email</label>
                <input id="sg-email" type="email" class="input" value="salah@" aria-invalid="true" aria-describedby="sg-email-err">
                <p id="sg-email-err" class="error-text">
                    <svg aria-hidden="true" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="mt-0.5 shrink-0"><path d="M6 6l12 12M18 6 6 18"/></svg>
                    Format email belum benar. Contoh: nama@contoh.ac.id
                </p>
            </div>
            <button class="btn btn-primary mt-5">Kirim</button>
        </div>
    </div>

    {{-- Tabel: perilaku responsif --}}
    <div>
        <h2 class="text-2xl font-bold">Tabel responsif</h2>
        <p class="mt-1 text-body-soft">Kecilkan jendela ke ≤768px: tabel berubah menjadi daftar kartu berlabel. Tidak ada geser ke samping.</p>
        <div class="card mt-4 overflow-hidden">
            <table class="data-table">
                <caption class="sr-only">Contoh tabel empat kolom</caption>
                <thead><tr><th scope="col">Nama</th><th scope="col">Prodi</th><th scope="col">NIDN</th><th scope="col">Bidang</th></tr></thead>
                <tbody>
                    <tr><td data-label="Nama">Contoh Nama Satu</td><td data-label="Prodi">Informatika</td><td data-label="NIDN" class="tabular">0000000001</td><td data-label="Bidang">Rekayasa perangkat lunak</td></tr>
                    <tr><td data-label="Nama">Contoh Nama Dua</td><td data-label="Prodi">Sistem Informasi</td><td data-label="NIDN" class="tabular">0000000002</td><td data-label="Bidang">Analitik data</td></tr>
                </tbody>
            </table>
        </div>
        <p class="mt-2 text-sm text-body-soft">Tabel 5 kolom ketiga contoh: lihat halaman <a class="link" href="akademik.html#jadwal">jadwal kuliah</a>.</p>
    </div>

    {{-- Jarak --}}
    <div>
        <h2 class="text-2xl font-bold">Skala jarak</h2>
        <ul class="mt-3 flex flex-wrap items-end gap-6">
            @foreach ([4 => 'space-1', 8 => 'space-2', 12 => 'space-3', 16 => 'space-4', 24 => 'space-5', 32 => 'space-6', 48 => 'space-8', 64 => 'space-10'] as $px => $nama)
                <li class="text-center">
                    <span class="block bg-primary" style="width: {{ $px }}px; height: 24px"></span>
                    <span class="mt-1 block text-2xs text-body-soft">{{ $nama }}<br>{{ $px }}px</span>
                </li>
            @endforeach
        </ul>
    </div>
</section>
@endsection
