{{-- ============================================================
     HEADER
     Aturan: menu utama SELALU terlihat di desktop (>=1024px), tidak
     disembunyikan di balik ikon hamburger — pengguna awam lebih sedikit
     mencoba kalau menu tidak tampak.
     Di HP, menu dibuka lewat <details> bawaan HTML, jadi tetap berfungsi
     walau JavaScript gagal dimuat.
     ============================================================ --}}
@php
    // Struktur menu berasal dari Tahap 1. Kalau daftar ini bertambah,
    // yang pertama harus dicek: apakah masih muat satu baris di 1024px.
    $menu = [
        ['label' => 'Profil',        'url' => 'profil.html',        'sub' => [
            ['Tentang Fakultas', 'profil.html'],
            ['Pimpinan', 'profil.html#pimpinan'],
            ['Akreditasi', 'profil.html#akreditasi'],
            ['Kontak & Lokasi', 'profil.html#kontak'],
        ]],
        ['label' => 'Program Studi', 'url' => 'program-studi.html', 'sub' => [
            ['Daftar Program Studi', 'program-studi.html'],
            ['Informatika (S1)', 'prodi-informatika.html'],
            ['Sistem Informasi (S1)', 'prodi-sistem-informasi.html'],
            ['Teknologi Informasi (D3)', 'prodi-teknologi-informasi.html'],
        ]],
        ['label' => 'Penerimaan',    'url' => 'penerimaan.html',    'sub' => [
            ['Alur Pendaftaran', 'penerimaan.html#alur'],
            ['Biaya Kuliah', 'penerimaan.html#biaya'],
            ['Syarat & Jadwal', 'penerimaan.html#syarat'],
            ['Beasiswa', 'penerimaan.html#beasiswa'],
            ['Tanya-Jawab', 'penerimaan.html#faq'],
        ]],
        ['label' => 'Akademik',      'url' => 'akademik.html',      'sub' => [
            ['Jadwal Kuliah', 'akademik.html#jadwal'],
            ['Kalender Akademik', 'akademik.html#kalender'],
            ['Pengumuman', 'pengumuman.html'],
            ['Unduhan', 'unduhan.html'],
        ]],
        ['label' => 'Dosen',         'url' => 'dosen.html',         'sub' => null],
        ['label' => 'Berita',        'url' => 'berita.html',        'sub' => null],
    ];
@endphp

<div class="bg-primary-strong text-white">
    <div class="container-page">
        <div class="flex flex-wrap items-center justify-between gap-x-4 gap-y-1 py-1.5 text-2xs">
            {{-- Identitas universitas: pengunjung harus tahu fakultas ini
                 milik kampus mana. Ini kepercayaan, bukan hiasan. --}}
            <p class="font-semibold tracking-wide">Universitas Contoh Raya (Contoh)</p>
            {{-- Di HP info kontak disembunyikan: tiga item sejajar memadat
                 di 360px dan semuanya juga tersedia di footer serta halaman
                 kontak. Nama universitas tetap tampil (kepercayaan). --}}
            <ul class="hidden items-center gap-x-4 sm:flex">
                <li><a class="underline" href="tel:+620000000000">Telp. (0000) 000-000</a></li>
                <li><a class="underline" href="mailto:info@contoh.ac.id">info@contoh.ac.id</a></li>
                <li><a class="underline" href="#konten-utama">Bahasa Indonesia</a></li>
            </ul>
        </div>
    </div>
</div>

<header class="sticky top-0 z-40 border-b border-line bg-page">
    <div class="container-page">
        <div class="flex items-center gap-4 py-3">

            {{-- Logo: teks alternatif wajib memuat nama fakultas, bukan "logo". --}}
            <a href="index.html" class="flex items-center gap-3 no-underline">
                <span aria-hidden="true" class="grid h-11 w-11 shrink-0 place-items-center rounded-sm bg-primary text-on-primary font-bold text-lg">FK</span>
                {{-- Nama universitas sudah ada di top bar; diulang di sini
                     membuat kepala halaman terasa penuh di layar 360px. --}}
                <span class="leading-tight">
                    <span class="block text-base font-semibold text-body">Fakultas Ilmu Komputer</span>
                </span>
                <span class="sr-only">Halaman beranda</span>
            </a>

            {{-- Menu HP: <details> = buka-tutup bawaan browser, tanpa JS.
                 Tombolnya bertuliskan "Menu", bukan ikon saja: pengguna
                 awam sering tidak mengenali ikon garis tiga. --}}
            <details class="lg:hidden ml-auto" data-menu>
                <summary class="btn btn-secondary min-h-11 cursor-pointer list-none">
                    <svg aria-hidden="true" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M4 7h16M4 12h16M4 17h16"/></svg>
                    Menu
                </summary>
                {{-- Tinggi maksimum + bisa digulir: tanpa ini panel setinggi
                     layar akan mendorong tautan bawah keluar dari jangkauan di
                     HP kecil (submenu tampil terbuka). --}}
                <nav aria-label="Menu utama (ponsel)" class="absolute inset-x-0 top-full max-h-[calc(100vh-5rem)] overflow-y-auto overscroll-contain border-b border-line bg-page shadow-panel">
                    <div class="container-page py-3">
                        <ul class="divide-y divide-line">
                            @foreach ($menu as $item)
                                <li class="py-1">
                                    <a href="{{ $item['url'] }}" class="flex min-h-[44px] items-center justify-between gap-2 rounded-sm px-1 text-base font-semibold text-body">
                                        {{ $item['label'] }}

                                    </a>
                                    @if ($item['sub'])
                                        {{-- Submenu di HP ditampilkan terbuka: tingkat satu saja,
                                             tidak ada level ketiga. --}}
                                        <ul class="mb-2 ml-1 border-l-2 border-line pl-3">
                                            @foreach ($item['sub'] as [$label, $url])
                                                <li><a href="{{ $url }}" class="flex min-h-[44px] items-center text-sm text-body-soft underline">{{ $label }}</a></li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                        <a href="pencarian.html" class="btn btn-primary mt-3 w-full"><span aria-hidden="true">Cari</span><span class="sr-only">Cari di situs</span></a>
                    </div>
                </nav>
            </details>

            {{-- Pencarian desktop: terbuka, tidak disembunyikan di ikon.
                 Pencarian adalah pintu masuk utama orang yang sudah tahu
                 yang dicarinya — jangan dipaksa membuka menu dulu. --}}
            <form action="pencarian.html" method="get" role="search" class="ml-auto hidden lg:block">
                <label for="q-desk" class="sr-only">Cari di situs</label>
                <div class="flex items-center gap-2">
                    <input id="q-desk" name="q" type="search" inputmode="search"
                           placeholder="Cari dosen, biaya, dokumen…"
                           class="input w-56 py-2 text-sm xl:w-64">
                    <button class="btn btn-primary btn-sm" type="submit">
                        <svg aria-hidden="true" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
                        Cari
                    </button>
                </div>
            </form>
        </div>

        {{-- Menu L1 desktop: terlihat penuh. Ukuran huruf 15px (text-sm+)
             dipilih supaya enam item + pencarian muat satu baris di 1024px. --}}
        <nav aria-label="Menu utama" class="hidden lg:block">
            <ul class="flex items-stretch gap-1">
                @foreach ($menu as $item)
                    <li class="group relative">
                        <a href="{{ $item['url'] }}"
                           class="flex h-12 items-center gap-1 rounded-sm px-3 text-[0.9375rem] font-semibold text-body hover:bg-surface hover:text-primary">
                            {{ $item['label'] }}
                            @if ($item['sub'])
                                <svg aria-hidden="true" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="text-body-soft"><path d="m6 9 6 6 6-6"/></svg>
                            @endif
                        </a>
                        @if ($item['sub'])
                            {{-- Submenu muncul saat hover DAN saat fokus keyboard
                                 (:focus-within) — tanpa itu, pengguna keyboard
                                 tidak bisa membuka submenu sama sekali. --}}
                            <div class="invisible absolute left-0 top-full z-50 w-64 opacity-0 transition-opacity group-hover:visible group-hover:opacity-100 group-focus-within:visible group-focus-within:opacity-100">
                                <ul class="mt-1 rounded-md border border-line bg-page p-2 shadow-panel">
                                    @foreach ($item['sub'] as [$label, $url])
                                        <li><a href="{{ $url }}" class="flex min-h-[40px] items-center rounded-sm px-3 text-sm text-body hover:bg-surface hover:text-primary">{{ $label }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </li>
                @endforeach
            </ul>
        </nav>
    </div>
</header>
