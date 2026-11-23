{{-- ============================================================
     KARTU DOSEN
     Data: satu variabel $dosen (array) supaya daftar dosen cukup ditulis
     sebagai daftar di halaman, bukan 7 parameter berulang.
     - Foto 3:4 (atau 1:1); bila tidak ada -> INISIAL NAMA, bukan siluet
       abu-abu / ikon "gambar rusak".
     - Nama + gelar maks 2 baris; bagian utuh ada di halaman detail.
     - Email berupa tautan tel:/mailto: agar satu ketukan di HP.
     ============================================================ --}}
@php
    $dosen = $dosen ?? [];
    $nama = $dosen['nama'] ?? '';
    $gelar = $dosen['gelar'] ?? '';
    $prodi = $dosen['prodi'] ?? '';
    $bidang = $dosen['bidang'] ?? '';
    $email = $dosen['email'] ?? null;
    $foto = $dosen['foto'] ?? null;
    $url = $dosen['url'] ?? 'dosen.html';
    // Inisial dari maksimal dua kata pertama.
    $kata = preg_split('/\s+/', trim($nama));
    $inisial = mb_strtoupper(mb_substr($kata[0] ?? '', 0, 1) . mb_substr($kata[1] ?? '', 0, 1));
@endphp
<article class="card flex gap-4 p-4">
    @if ($foto)
        <img src="img/{{ $foto }}.webp" alt="Foto {{ $nama }}" width="450" height="600" loading="lazy" decoding="async"
             class="h-24 w-[72px] shrink-0 rounded-sm object-cover object-top">
    @else
        <span aria-hidden="true" class="grid h-24 w-[72px] shrink-0 place-items-center rounded-sm bg-primary-soft text-xl font-bold text-primary">{{ $inisial }}</span>
    @endif
    <div class="min-w-0">
        <h3 class="text-base font-semibold leading-snug">
            <a href="{{ $url }}" class="clamp-2 text-body hover:text-primary">{{ $nama }}</a>
            <span class="block text-sm font-normal text-body-soft">{{ $gelar }}</span>
        </h3>
        <p class="mt-1 text-sm">{{ $prodi }}</p>
        <p class="mt-1 text-sm text-body-soft"><span class="font-semibold text-body">Bidang:</span> {{ $bidang }}</p>
        @if ($email)
            <a href="mailto:{{ $email }}" class="mt-2 inline-flex min-h-[36px] items-center text-sm font-semibold underline">Email</a>
        @endif
    </div>
</article>
