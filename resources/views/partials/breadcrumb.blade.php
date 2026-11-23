{{-- Jejak lokasi. Selalu ada di setiap halaman kecuali beranda: pengganti
     "tombol kembali" yang konsisten dan murah. --}}
@php
    // $items = [['label' => 'Akademik', 'url' => 'akademik.html'], ['label' => 'Pengumuman']]
    $items = $items ?? [];
@endphp
@if (count($items))
    <nav aria-label="Jejak lokasi" class="border-b border-line bg-surface">
        <div class="container-page">
            <ol class="flex flex-wrap items-center gap-x-2 gap-y-1 py-3 text-sm">
                <li><a href="index.html" class="link-muted">Beranda</a></li>
                @foreach ($items as $i => $item)
                    <li aria-hidden="true" class="text-body-soft">›</li>
                    <li>
                        @if (! empty($item['url']))
                            <a href="{{ $item['url'] }}" class="link-muted">{{ $item['label'] }}</a>
                        @else
                            <span aria-current="page" class="font-semibold text-body">{{ $item['label'] }}</span>
                        @endif
                    </li>
                @endforeach
            </ol>
        </div>
    </nav>
@endif
