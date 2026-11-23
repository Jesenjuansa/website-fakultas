@extends('layouts.base')

@section('title', 'Profil Fakultas')
@include('partials.breadcrumb', ['items' => [['label' => 'Profil']]])

@section('content')
{{-- ============================================================
     PROFIL
     Pertanyaan 5 detik: "institusi ini kredibel atau tidak?"
     Blok 1 = ringkasan angka; sejarah panjang dan sambutan dekan
     sengaja "dikubur" di bawah.
     ============================================================ --}}

@include('partials.page-header', [
    'judul' => 'Profil Fakultas Ilmu Komputer',
    'ringkas' => 'Fakultas negeri penyelenggara pendidikan bidang komputer di Universitas Contoh Raya (contoh), berdiri sejak 2001.',
])

{{-- 1. Angka kredibilitas. Ditaruh paling atas: inilah yang dicari orang tua
       dan calon mahasiswa sebelum membaca apa pun. --}}
@include('components.stat-strip')

<div class="container-page py-8 md:py-10">
    <div class="grid gap-10 lg:grid-cols-[minmax(0,1fr)_20rem]">
        <div class="min-w-0">

            {{-- 2. Tentang fakultas --}}
            <section aria-labelledby="tentang">
                <h2 id="tentang" class="text-2xl font-semibold">Tentang fakultas</h2>
                {{-- Dibungkus .text-measure: baris maks 70 karakter agar
                     tidak melebar di desktop 1280px. --}}
                <div class="prose-article mt-4 text-measure">
                    <p>Fakultas Ilmu Komputer (contoh) menyelenggarakan pendidikan bidang teknologi informasi dengan tiga program studi. Seluruh isi halaman ini adalah teks contoh untuk pratinjau desain, bukan data resmi.</p>
                    <p>Kegiatan fakultas mencakup pengajaran, penelitian, dan pengabdian kepada masyarakat. Laboratorium komputer, ruang baca, dan layanan akademik tersedia bagi seluruh mahasiswa aktif.</p>
                </div>
                <details class="mt-3">
                    <summary class="cursor-pointer text-base font-semibold text-primary underline">Baca selengkapnya</summary>
                    <div class="prose-article mt-3 text-measure">
                        <p>Paragraf tambahan berisi sejarah singkat dan cakupan kegiatan. Bagian ini dilipat karena hanya dibaca oleh sebagian kecil pengunjung; melipat mencegah blok penting di bawahnya terdorong jauh ke bawah di layar HP.</p>
                        <p>Elemen <em>details</em> dipakai karena bisa dibuka-tutup tanpa JavaScript.</p>
                    </div>
                </details>
            </section>

            {{-- 3. Visi & misi --}}
            <section aria-labelledby="visi" class="mt-10">
                <h2 id="visi" class="text-2xl font-semibold">Visi &amp; misi</h2>
                <p class="mt-3 text-measure rounded-md border-l-4 border-primary bg-primary-soft p-4 text-base font-semibold text-primary-strong">
                    “Menjadi fakultas rujukan bidang komputasi di tingkat nasional pada tahun 2035 (teks contoh).”
                </p>
                <h3 class="mt-5 text-lg font-semibold">Misi</h3>
                <ol class="mt-2 list-decimal space-y-2 pl-6 text-measure">
                    <li>Menyelenggarakan pendidikan komputasi yang relevan dengan kebutuhan industri.</li>
                    <li>Mengembangkan penelitian yang memberi manfaat bagi masyarakat.</li>
                    <li>Melaksanakan pengabdian berbasis teknologi informasi.</li>
                    <li>Membangun kerja sama dengan pemerintah dan dunia usaha.</li>
                </ol>
            </section>

            {{-- 4. Pimpinan: halaman #pimpinan dituju dari submenu --}}
            <section id="pimpinan" class="mt-10 scroll-mt-24">
                <h2 class="text-2xl font-semibold">Pimpinan fakultas</h2>
                <ul class="mt-4 grid gap-4 sm:grid-cols-2">
                    @foreach ([['Dekan', 'Dr. Contoh Nama Satu, S.Kom., M.Kom.'], ['Wakil Dekan I (Akademik)', 'Dr. Contoh Nama Dua, S.T., M.T.'], ['Wakil Dekan II (Umum & Keuangan)', 'Contoh Nama Tiga, S.Kom., M.M.'], ['Ketua Program Studi Informatika', 'Contoh Nama Empat, S.Kom., M.Kom.']] as [$jab, $nama])
                        <li class="card p-4">
                            <p class="text-2xs font-bold uppercase tracking-wider text-body-soft">{{ $jab }}</p>
                            <p class="mt-1 text-base font-semibold">{{ $nama }}</p>
                        </li>
                    @endforeach
                </ul>
            </section>

            {{-- 5. Akreditasi --}}
            <section id="akreditasi" class="mt-10 scroll-mt-24">
                <h2 class="text-2xl font-semibold">Akreditasi</h2>
                <div class="card mt-4 overflow-hidden">
                    {{-- Desktop: tabel. HP: daftar kartu (otomatis lewat .data-table). --}}
                    <table class="data-table">
                        <caption class="sr-only">Status akreditasi fakultas dan program studi</caption>
                        <thead>
                            <tr>
                                <th scope="col">Unit</th>
                                <th scope="col">Peringkat</th>
                                <th scope="col">Lembaga</th>
                                <th scope="col">Berlaku sampai</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td data-label="Unit">Fakultas Ilmu Komputer</td>
                                <td data-label="Peringkat"><span class="inline-flex items-center gap-1.5 font-semibold text-success"><svg aria-hidden="true" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m5 13 4 4L19 7"/></svg>B</span></td>
                                <td data-label="Lembaga">LAM INFOKOM</td>
                                <td data-label="Berlaku sampai" class="tabular">2029-08-31</td>
                            </tr>
                            <tr>
                                <td data-label="Unit">S1 Informatika</td>
                                <td data-label="Peringkat"><span class="inline-flex items-center gap-1.5 font-semibold text-success"><svg aria-hidden="true" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m5 13 4 4L19 7"/></svg>B</span></td>
                                <td data-label="Lembaga">LAM INFOKOM</td>
                                <td data-label="Berlaku sampai" class="tabular">2028-12-31</td>
                            </tr>
                            <tr>
                                <td data-label="Unit">S1 Sistem Informasi</td>
                                <td data-label="Peringkat"><span class="inline-flex items-center gap-1.5 font-semibold text-success"><svg aria-hidden="true" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m5 13 4 4L19 7"/></svg>B</span></td>
                                <td data-label="Lembaga">LAM INFOKOM</td>
                                <td data-label="Berlaku sampai" class="tabular">2028-12-31</td>
                            </tr>
                            <tr>
                                <td data-label="Unit">D3 Teknologi Informasi</td>
                                <td data-label="Peringkat"><span class="inline-flex items-center gap-1.5 font-semibold text-success"><svg aria-hidden="true" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m5 13 4 4L19 7"/></svg>Baik</span></td>
                                <td data-label="Lembaga">LAM INFOKOM</td>
                                <td data-label="Berlaku sampai" class="tabular">2027-12-31</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <p class="mt-2 text-sm text-body-soft">Status selalu ditulis dalam kata, tidak hanya warna: pembaca dengan buta warna tetap dapat membedakannya.</p>
            </section>

            {{-- 6. Fasilitas --}}
            <section class="mt-10">
                <h2 class="text-2xl font-semibold">Fasilitas</h2>
                <ul class="mt-4 grid gap-3 sm:grid-cols-2">
                    @foreach (['5 laboratorium komputer', 'Ruang baca dan akses jurnal', 'Studio kerja kelompok 24 jam', 'Layanan akademik satu pintu'] as $f)
                        <li class="flex items-start gap-2 rounded-md bg-surface p-4 text-base"><span aria-hidden="true" class="mt-0.5 font-bold text-primary">•</span>{{ $f }}</li>
                    @endforeach
                </ul>
            </section>

            {{-- 7. Kontak --}}
            <section id="kontak" class="mt-10 scroll-mt-24">
                <h2 class="text-2xl font-semibold">Kontak &amp; lokasi</h2>
                <div class="card mt-4 p-5">
                    <dl class="space-y-3 text-base">
                        <div class="flex gap-3"><dt class="w-28 shrink-0 font-semibold">Alamat</dt><dd>Jl. Contoh Raya No. 1, Kota Contoh, Provinsi Contoh 00000</dd></div>
                        <div class="flex gap-3"><dt class="w-28 shrink-0 font-semibold">Telepon</dt><dd><a class="link" href="tel:+620000000000">(0000) 000-000</a></dd></div>
                        <div class="flex gap-3"><dt class="w-28 shrink-0 font-semibold">Email</dt><dd><a class="link" href="mailto:info@contoh.ac.id">info@contoh.ac.id</a></dd></div>
                        <div class="flex gap-3"><dt class="w-28 shrink-0 font-semibold">Jam layanan</dt><dd>Senin–Jumat, 08.00–15.30 WIB</dd></div>
                    </dl>
                    {{-- Peta sebagai tautan, bukan iframe: iframe peta ratusan KB
                         dan tidak terbaca pembaca layar tanpa judul yang benar. --}}
                    <a class="btn btn-secondary mt-4" href="https://www.openstreetmap.org/" target="_blank" rel="noopener">Buka lokasi di peta <span class="sr-only">(tab baru)</span></a>
                </div>
            </section>
        </div>

        {{-- Kolom samping: daftar isi halaman. Bukan hiasan — halaman profil
             panjang dan tanpa ini orang tersesat. Di HP daftar ini turun ke
             bawah dengan bentuk baris. --}}
        <aside class="lg:sticky lg:top-24 lg:self-start" aria-label="Isi halaman">
            <nav class="card p-4">
                <p class="text-sm font-bold uppercase tracking-wider text-body-soft">Isi halaman</p>
                <ul class="mt-2 divide-y divide-line text-base">
                    <li><a class="flex min-h-[44px] items-center underline" href="#tentang">Tentang fakultas</a></li>
                    <li><a class="flex min-h-[44px] items-center underline" href="#visi">Visi &amp; misi</a></li>
                    <li><a class="flex min-h-[44px] items-center underline" href="#pimpinan">Pimpinan</a></li>
                    <li><a class="flex min-h-[44px] items-center underline" href="#akreditasi">Akreditasi</a></li>
                    <li><a class="flex min-h-[44px] items-center underline" href="#kontak">Kontak</a></li>
                </ul>
            </nav>
        </aside>
    </div>
</div>
@endsection
