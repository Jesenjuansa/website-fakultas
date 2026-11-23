{{-- ============================================================
     KOTAK PENCARIAN (beranda + halaman pencarian)
     - form GET biasa: jalan tanpa JavaScript
     - chip pertanyaan populer: mengubah "menjelajah" jadi "memilih"
       (mayoritas pengunjung datang dengan pertanyaan jadi)
     ============================================================ --}}
@php
    $value = $value ?? '';
    $chips = $chips ?? ['Biaya kuliah', 'Syarat pendaftaran', 'Jadwal kuliah', 'Direktori dosen'];
    $id = $id ?? 'q';
@endphp
<div>
    <form action="pencarian.html" method="get" role="search">
        <label for="{{ $id }}" class="sr-only">Kata kunci pencarian</label>
        <div class="flex flex-col gap-2 sm:flex-row">
            <input id="{{ $id }}" name="q" type="search" value="{{ $value }}" placeholder="cth. biaya kuliah, nama dosen, formulir cuti"
                   class="input flex-1">
            <button type="submit" class="btn btn-primary">
                <svg aria-hidden="true" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
                Cari
            </button>
        </div>
    </form>
    <div class="mt-3 flex flex-wrap items-center gap-2">
        <span class="text-sm text-body-soft">Paling dicari:</span>
        @foreach ($chips as $c)
            <a href="pencarian.html?q={{ urlencode($c) }}" class="chip">{{ $c }}</a>
        @endforeach
    </div>
</div>
