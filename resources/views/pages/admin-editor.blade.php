@extends('layouts.base')

@section('title', 'Panel Konten (contoh)')
@include('partials.breadcrumb', ['items' => [['label' => 'Panel Konten']]])

@section('content')
@include('partials.page-header', [
    'judul' => 'Panel konten — tambah berita',
    'ringkas' => 'Contoh tampilan untuk staf non-teknis. Batas konten di Tahap 5 diterapkan di sini: kolom menolak isi berlebih, gambar dipotong otomatis, dan alasan setiap batas ditulis jelas.',
])

<section class="container-page pb-10">
    <div class="grid gap-8 lg:grid-cols-[minmax(0,1fr)_22rem]">
        <form action="#" method="post" class="card p-5 md:p-6">
            {{-- Judul: batas 80 karakter. Hitungan tampil agar staf tahu sisa
                 ruang; tombol simpan menolak bila lewat. --}}
            <div>
                <label for="judul" class="label">Judul berita <span class="text-danger">(wajib)</span></label>
                <p class="hint" id="judul-hint">Maksimal 80 karakter. Tulis intinya: apa dan kapan.</p>
                <input id="judul" name="judul" type="text" maxlength="80" class="input"
                       aria-describedby="judul-hint judul-hitung" placeholder="cth. Kuliah umum kecerdasan artifisial, 20 November">
                <p id="judul-hitung" class="mt-1 text-sm text-body-soft" aria-live="polite">0 / 80 karakter</p>
            </div>

            {{-- Ringkasan: baris yang dibaca orang di kartu. --}}
            <div class="mt-6">
                <label for="ringkasan" class="label">Ringkasan <span class="text-danger">(wajib)</span></label>
                <p class="hint">1–2 kalimat: siapa, apa, kapan. Maksimal 200 karakter.</p>
                <textarea id="ringkasan" name="ringkasan" rows="3" maxlength="200" class="input" aria-describedby="ringkasan-hint"></textarea>
            </div>

            {{-- Kategori: maks 3. Lebih dari 3 membuat kartu berantakan. --}}
            <fieldset class="mt-6">
                <legend class="label">Kategori (pilih 1–3)</legend>
                <div class="flex flex-wrap gap-x-5 gap-y-2">
                    @foreach (['Kegiatan', 'Prestasi', 'Kerja Sama', 'Akademik', 'Kemahasiswaan'] as $k)
                        <label class="flex min-h-[44px] items-center gap-2 text-base">
                            <input type="checkbox" name="kategori[]" value="{{ $k }}" class="h-5 w-5">
                            {{ $k }}
                        </label>
                    @endforeach
                </div>
            </fieldset>

            {{-- Gambar: rasio dikunci, ukuran dibatasi. Tanpa ini, staf akan
                 mengunggah foto kamera 12 MB yang merusak tata letak. --}}
            <div class="mt-6">
                <label for="gambar" class="label">Gambar utama</label>
                <p class="hint" id="gambar-hint">JPG/PNG/WebP, maksimal 5 MB, disarankan lanskap. Sistem memotong otomatis ke 16:9 dari bagian tengah — jangan unggah gambar berisi tulisan kecil.</p>
                <input id="gambar" name="gambar" type="file" accept="image/jpeg,image/png,image/webp" class="input py-2" aria-describedby="gambar-hint">
                <label class="mt-2 flex min-h-[44px] items-center gap-2 text-base">
                    <input type="checkbox" name="tanpa_gambar" class="h-5 w-5"> Terbitkan tanpa gambar
                </label>
            </div>

            {{-- Teks alternatif: wajib untuk pembaca layar; diisi otomatis dari
                 judul bila kosong, dengan peringatan. --}}
            <div class="mt-6">
                <label for="alt" class="label">Teks alternatif gambar</label>
                <p class="hint" id="alt-hint">Deskripsi singkat untuk pembaca layar, maks 125 karakter. Bila dikosongkan, sistem memakai judul berita.</p>
                <input id="alt" name="alt" type="text" maxlength="125" class="input" aria-describedby="alt-hint">
            </div>

            {{-- Isi: toolbar minimal, hanya yang aman untuk tata letak. --}}
            <div class="mt-6">
                <label for="isi" class="label">Isi berita</label>
                <p class="hint">Gunakan tombol “Subjudul” untuk bagian baru. Tempel dari Word dengan tombol “Tempel tanpa format” agar warna dan ukuran huruf tidak terbawa.</p>
                <div class="flex flex-wrap gap-1 rounded-t-sm border border-b-0 border-line-strong bg-surface p-1.5" role="toolbar" aria-label="Format teks">
                    @foreach (['Tebal', 'Miring', 'Daftar', 'Daftar nomor', 'Tautan', 'Subjudul'] as $t)
                        <button type="button" class="btn btn-secondary btn-sm">{{ $t }}</button>
                    @endforeach
                    <button type="button" class="btn btn-secondary btn-sm">Tempel tanpa format</button>
                </div>
                <textarea id="isi" name="isi" rows="8" class="input rounded-t-none"></textarea>
            </div>

            {{-- Pemeriksaan sebelum terbit: daftar masalah yang bisa diklik,
                 bukan pesan "ada yang salah". --}}
            <div class="mt-6 rounded-md border border-warning bg-warning-soft p-4" role="status">
                <p class="flex items-center gap-2 font-bold text-warning">
                    <svg aria-hidden="true" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 8v5M12 17h.01"/><path d="M10.3 3.9 2.6 17a2 2 0 0 0 1.7 3h15.4a2 2 0 0 0 1.7-3L13.7 3.9a2 2 0 0 0-3.4 0Z"/></svg>
                    2 hal perlu dilengkapi sebelum terbit
                </p>
                <ul class="mt-2 list-disc pl-6 text-sm text-body">
                    <li><a class="link" href="#ringkasan">Ringkasan masih kosong</a></li>
                    <li><a class="link" href="#kategori">Belum ada kategori</a></li>
                </ul>
            </div>

            <div class="mt-6 flex flex-wrap gap-3">
                <button type="submit" class="btn btn-primary">Terbitkan</button>
                <button type="button" class="btn btn-secondary">Simpan draf</button>
            </div>
        </form>

        <aside class="space-y-4" aria-label="Pratinjau dan aturan">
            {{-- Pratinjau kartu: staf melihat hasil akhirnya sebelum terbit,
                 sehingga judul panjang langsung terlihat terpotong. --}}
            <div class="card p-4">
                <h2 class="text-sm font-bold uppercase tracking-wider text-body-soft">Pratinjau kartu di beranda</h2>
                <div class="mt-3">
                    @include('components.card-berita', ['berita' => [
                        'kategori' => 'Kegiatan',
                        'judul' => 'Judul contoh yang cukup panjang untuk menunjukkan pemotongan dua baris di kartu beranda',
                        'tanggal' => '2026-11-20',
                        'gambar' => 'berita-1',
                        'url' => '#',
                    ]])
                </div>
            </div>
            <div class="card p-4">
                <h2 class="text-sm font-bold uppercase tracking-wider text-body-soft">Aturan singkat</h2>
                <ul class="mt-2 space-y-1.5 text-sm text-body">
                    <li>Judul: maks 80 karakter, tanpa huruf kapital semua.</li>
                    <li>Ringkasan: maks 200 karakter.</li>
                    <li>Gambar: maks 5 MB, dipotong 16:9.</li>
                    <li>Kategori: maks 3.</li>
                    <li>Tabel di isi berita: maks 4 kolom.</li>
                </ul>
            </div>
        </aside>
    </div>
</section>
@endsection
