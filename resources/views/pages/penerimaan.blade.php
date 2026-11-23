@extends('layouts.base')

@section('title', 'Penerimaan Mahasiswa')
@include('partials.breadcrumb', ['items' => [['label' => 'Penerimaan']]])

@section('content')
@include('partials.page-header', [
    'judul' => 'Penerimaan mahasiswa baru',
    'ringkas' => 'Alur pendaftaran, biaya, syarat, dan jadwal untuk tahun akademik 2026/2027.',
])

<section class="container-page pb-10">
    {{-- 1. STATUS. Kalau pengunjung hanya melihat satu hal, ini yang harus
           terlihat: buka atau tutup. Ditulis dalam kata + ikon, bukan warna saja,
           dan selalu disertai tanggal. --}}
    <div class="rounded-md border-2 border-success bg-success-soft p-5">
        <p class="flex items-start gap-2 text-lg font-bold text-success">
            <svg aria-hidden="true" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="mt-0.5 shrink-0"><path d="m5 13 4 4L19 7"/></svg>
            <span>Pendaftaran dibuka</span>
        </p>
        <p class="mt-2 text-base text-body">
            Gelombang II: <strong>1 Oktober – 12 Desember 2026</strong>. Setelah tanggal itu, halaman ini akan diperbarui menjadi “Pendaftaran ditutup”. Anda tidak perlu menghubungi kami untuk memastikannya.
        </p>
    </div>

    {{-- 2. BIAYA. Tabel 3 kolom, jadi tetap tabel yang nyaman di HP. --}}
    <section id="biaya" class="mt-10 scroll-mt-24">
        <h2 class="text-2xl font-semibold">Biaya kuliah</h2>
        <p class="mt-1 text-measure text-body-soft">Angka di bawah adalah contoh. Biaya resmi ditetapkan oleh universitas dan diumumkan dalam SK yang diunduh dari halaman ini.</p>
        <div class="card mt-4 overflow-hidden">
            <table class="data-table">
                <caption class="sr-only">Biaya kuliah per jalur masuk, contoh</caption>
                <thead>
                    <tr>
                        <th scope="col">Jalur masuk</th>
                        <th scope="col">Uang kuliah tunggal (per semester)</th>
                        <th scope="col">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td data-label="Jalur">Jalur prestasi</td>
                        <td data-label="UKT" class="tabular">Rp 2.500.000 (contoh)</td>
                        <td data-label="Keterangan">Dapat diajukan penurunan bila memenuhi syarat</td>
                    </tr>
                    <tr>
                        <td data-label="Jalur">Jalur mandiri</td>
                        <td data-label="UKT" class="tabular">Rp 4.000.000 (contoh)</td>
                        <td data-label="Keterangan">Tidak dapat digabung dengan beasiswa</td>
                    </tr>
                    <tr>
                        <td data-label="Jalur">Beasiswa penuh</td>
                        <td data-label="UKT" class="tabular">Rp 0 (contoh)</td>
                        <td data-label="Keterangan">Kuota terbatas, seleksi administrasi</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <p class="mt-2 text-sm text-body-soft">Biaya di luar UKT: biaya praktikum dan wisuda. Rinciannya ada di dokumen SK di halaman <a class="link" href="unduhan.html">unduhan</a>.</p>
    </section>

    {{-- 3. ALUR: langkah bernomor, bukan paragraf panjang. Orang mengikuti
           langkah, bukan membaca narasi. --}}
    <section id="alur" class="mt-10 scroll-mt-24">
        <h2 class="text-2xl font-semibold">Alur pendaftaran</h2>
        <ol class="mt-4 space-y-3">
            @foreach ([
                ['Isi formulir daring', 'Buka portal pendaftaran, buat akun dengan email aktif, lalu lengkapi data diri.'],
                ['Unggah dokumen', 'Ijazah/SKL, rapor semester 1–5, dan pasfoto. Format PDF atau JPG, maksimal 2 MB per berkas.'],
                ['Bayar biaya pendaftaran', 'Kode pembayaran dikirim ke email setelah formulir lengkap.'],
                ['Ikuti seleksi', 'Seleksi administratif dan tes daring. Jadwalnya tertulis di bagian jadwal di bawah.'],
                ['Cek hasil pengumuman', 'Hasil diumumkan di portal yang sama; email hanya berisi pengingat, bukan keputusan.'],
            ] as $i => [$judul, $teks])
                <li class="flex gap-4 rounded-md border border-line p-4">
                    <span class="grid h-9 w-9 shrink-0 place-items-center rounded-full bg-primary text-base font-bold text-on-primary" aria-hidden="true">{{ $i + 1 }}</span>
                    <div>
                        <h3 class="text-base font-semibold">{{ $judul }}</h3>
                        <p class="mt-1 text-base text-body-soft">{{ $teks }}</p>
                    </div>
                </li>
            @endforeach
        </ol>
    </section>

    {{-- 4. SYARAT: daftar + unduhan dengan ukuran file agar pengunjung
           jaringan lambat tahu sebelum mengklik. --}}
    <section id="syarat" class="mt-10 scroll-mt-24">
        <h2 class="text-2xl font-semibold">Syarat dokumen</h2>
        <ul class="mt-3 list-disc space-y-2 pl-6 text-measure">
            <li>Lulusan SMA/SMK/MA tahun 2024, 2025, atau 2026 (contoh).</li>
            <li>Ijazah atau Surat Keterangan Lulus yang dilegalisasi.</li>
            <li>Rapor semester 1–5 (jalur prestasi).</li>
            <li>Pasfoto berwarna latar merah, ukuran 3×4.</li>
        </ul>
        <div class="mt-4 grid gap-3 sm:grid-cols-2">
            @foreach ([['Panduan Pendaftaran 2026', 'PDF', '1,2 MB', '2026-09-01'], ['Formulir Pakta Integritas', 'PDF', '240 KB', '2026-09-01']] as [$nama, $jenis, $ukuran, $tgl])
                <a href="#" class="card-link flex items-start gap-3 p-4">
                    <span aria-hidden="true" class="grid h-10 w-10 shrink-0 place-items-center rounded-sm bg-danger-soft text-2xs font-bold text-danger">{{ $jenis }}</span>
                    <span>
                        <span class="block font-semibold text-body">{{ $nama }}</span>
                        {{-- Ukuran file terlihat: pengguna jaringan lambat berhak tahu. --}}
                        <span class="block text-2xs text-body-soft">{{ $jenis }} · {{ $ukuran }} · diunggah {{ $tgl }}</span>
                    </span>
                </a>
            @endforeach
        </div>
    </section>

    {{-- 5. JADWAL --}}
    <section id="jadwal-masuk" class="mt-10 scroll-mt-24">
        <h2 class="text-2xl font-semibold">Jadwal penting</h2>
        <div class="card mt-4 overflow-hidden">
            <table class="data-table">
                <caption class="sr-only">Tanggal penting penerimaan 2026</caption>
                <thead><tr><th scope="col">Tahap</th><th scope="col">Tanggal</th></tr></thead>
                <tbody>
                    @foreach ([['Pendaftaran gelombang II dibuka', '2026-10-01'], ['Batas unggah dokumen', '2026-12-12'], ['Tes daring', '2026-12-19'], ['Pengumuman hasil', '2026-12-24'], ['Daftar ulang', '2027-01-05']] as [$tahap, $tgl])
                        <tr>
                            <td data-label="Tahap">{{ $tahap }}</td>
                            <td data-label="Tanggal" class="tabular">{{ $tgl }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

    {{-- 6. BEASISWA --}}
    <section id="beasiswa" class="mt-10 scroll-mt-24">
        <h2 class="text-2xl font-semibold">Beasiswa</h2>
        <div class="mt-3 grid gap-4 md:grid-cols-2">
            @foreach ([['Beasiswa Prestasi Akademik', 'Potongan UKT 50–100% untuk peringkat kelas teratas (contoh).'], ['Beasiswa Kurang Mampu', 'Bebas UKT dengan verifikasi dokumen ekonomi (contoh).']] as [$n, $d])
                <div class="card p-5">
                    <h3 class="text-lg font-semibold">{{ $n }}</h3>
                    <p class="mt-1 text-base text-body-soft">{{ $d }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- 7. FAQ: elemen <details> = buka-tutup tanpa JavaScript. --}}
    <section id="faq" class="mt-10 scroll-mt-24">
        <h2 class="text-2xl font-semibold">Tanya-jawab</h2>
        <div class="mt-4 divide-y divide-line border-y border-line">
            @foreach ([
                ['Apakah boleh mendaftar dua program studi?', 'Boleh, dengan dua akun berbeda. Satu akun hanya untuk satu prodi.'],
                ['Bagaimana bila rapor belum lengkap?', 'Unggah rapor yang tersedia dan kirim surat pernyataan; kelengkapan diperiksa saat seleksi administrasi.'],
                ['Apakah biaya pendaftaran dikembalikan bila gagal?', 'Tidak. Biaya pendaftaran tidak dikembalikan dalam kondisi apa pun.'],
            ] as [$tanya, $jawab])
                <details class="group py-4">
                    <summary class="flex cursor-pointer items-start justify-between gap-3 text-base font-semibold">
                        {{ $tanya }}
                        <span aria-hidden="true" class="text-body-soft group-open:rotate-180">⌄</span>
                    </summary>
                    <p class="mt-2 text-measure text-body-soft">{{ $jawab }}</p>
                </details>
            @endforeach
        </div>
        <p class="mt-4 text-body-soft">Pertanyaan lain? <a class="link" href="profil.html#kontak">Hubungi panitia penerimaan</a> pada jam layanan.</p>
    </section>
</section>
@endsection
