{{-- ============================================================
     PAGINATION
     Tautan asli (<a href="?page=2">), bukan tombol JS:
     - tetap jalan tanpa JavaScript
     - bisa dibuka di tab baru / dibagikan
     Ukuran target 44px agar bisa ditekan di HP.
     ============================================================ --}}
@php
    $halaman = $halaman ?? 1;
    $total = $total ?? 1;
    $url = fn ($n) => $n === 1 ? '?' : '?page=' . $n;
@endphp
<nav aria-label="Navigasi halaman" class="mt-8">
    <ul class="flex flex-wrap items-center justify-center gap-2">
        <li>
            @if ($halaman > 1)
                <a href="{{ $url($halaman - 1) }}" class="page-link" rel="prev">‹ <span class="sr-only">Sebelumnya</span></a>
            @else
                <span class="page-link pointer-events-none opacity-50" aria-hidden="true">‹</span>
            @endif
        </li>
        @for ($n = 1; $n <= $total; $n++)
            <li>
                @if ($n === $halaman)
                    <a href="{{ $url($n) }}" class="page-link" aria-current="page">
                        <span class="sr-only">Halaman </span>{{ $n }}
                    </a>
                @else
                    <a href="{{ $url($n) }}" class="page-link"><span class="sr-only">Halaman </span>{{ $n }}</a>
                @endif
            </li>
        @endfor
        <li>
            @if ($halaman < $total)
                <a href="{{ $url($halaman + 1) }}" class="page-link" rel="next"><span class="sr-only">Berikutnya</span> ›</a>
            @else
                <span class="page-link pointer-events-none opacity-50" aria-hidden="true">›</span>
            @endif
        </li>
    </ul>
    <p class="mt-3 text-center text-sm text-body-soft">Halaman {{ $halaman }} dari {{ $total }}</p>
</nav>
