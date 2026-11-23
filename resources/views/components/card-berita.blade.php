{{-- ============================================================
     KARTU BERITA
     Aturan yang DITEGAKKAN komponen ini (Tahap 5) — staf tidak bisa
     merusaknya lewat isi:
     - rasio gambar 16:9 dikunci -> gambar apa pun tidak merusak tata letak
     - judul maksimal 2 baris -> semua kartu sama tinggi
     - tanggal SELALU tampil (informasi tanpa tanggal = informasi kadaluwarsa)
     - tanpa gambar -> blok latar + nama kategori, bukan ikon "gambar rusak"
     ============================================================ --}}
@php
    $b = $berita ?? [];
    $kategori = $b['kategori'] ?? ($kategori ?? 'Berita');
    $judul = $b['judul'] ?? ($judul ?? '');
    $tanggal = $b['tanggal'] ?? ($tanggal ?? '');
    $gambar = $b['gambar'] ?? ($gambar ?? null);
    $url = $b['url'] ?? ($url ?? '#');
@endphp
<article class="card-link h-full flex flex-col">
    <a href="{{ $url }}" tabindex="-1" aria-hidden="true">
        {{-- Gambar di dalam tautan ganda disembunyikan dari keyboard/pembaca layar;
             satu-satunya jalur fokus adalah judul di bawah. --}}
        @if ($gambar)
            {{-- width/height wajib: mencegah halaman "melompat" saat gambar
                 tiba (penyebab nomor 1 salah klik di HP lambat). --}}
            <img src="img/{{ $gambar }}.webp" alt="" width="800" height="450"
                 loading="lazy" decoding="async"
                 class="aspect-[16/9] w-full rounded-t-md object-cover">
        @else
            <div class="aspect-[16/9] w-full rounded-t-md bg-surface grid place-items-center text-sm font-semibold text-body-soft">{{ $kategori }}</div>
        @endif
    </a>
    <div class="flex flex-1 flex-col p-4">
        <p class="text-2xs font-bold uppercase tracking-wider text-accent">{{ $kategori }}</p>
        <h3 class="mt-1 text-lg font-semibold leading-snug">
            {{-- Judul adalah satu-satunya tautan ke artikel: jangan buat dua
                 tautan yang sama (pengguna keyboard akan melewatinya dua kali). --}}
            <a href="{{ $url }}" class="clamp-2 text-body hover:text-primary">{{ $judul }}</a>
        </h3>
        <p class="mt-auto pt-3 text-2xs text-body-soft">
            <time datetime="{{ $tanggal }}">{{ \Illuminate\Support\Carbon::parse($tanggal)->translatedFormat('j F Y') }}</time>
        </p>
    </div>
</article>
