{{-- Kepala halaman: judul + satu kalimat penjelas.
     Kalimat penjelas bukan hiasan: ia menjawab "apakah saya di halaman yang
     benar?" sebelum orang menggulir. --}}
@php
    $judul = $judul ?? '';
    $ringkas = $ringkas ?? null;
    $eyebrow = $eyebrow ?? null;
@endphp
<div class="bg-page">
    <div class="container-page pb-6 pt-8 md:pb-8 md:pt-10">
        @if ($eyebrow)
            <p class="eyebrow mb-2">{{ $eyebrow }}</p>
        @endif
        <h1 class="text-3xl font-bold text-body md:text-3xl-d">{{ $judul }}</h1>
        @if ($ringkas)
            <p class="mt-3 text-measure text-lg text-body-soft">{{ $ringkas }}</p>
        @endif
    </div>
</div>
