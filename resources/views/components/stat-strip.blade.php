{{-- Baris fakta kepercayaan (akreditasi, prodi, dosen, tahun berdiri).
     Ditaruh di beranda setelah hero: orang tua dan calon mahasiswa
     mencari fakta ini dalam 5 detik pertama. --}}
@php
    $facts = $facts ?? [
        ['label' => 'Akreditasi', 'value' => 'B (contoh)', 'note' => 'LAM INFOKOM · SK No. 0000/SK/LAM/CONTOH/2025'],
        ['label' => 'Program studi', 'value' => '3', 'note' => 'D3 dan S1'],
        ['label' => 'Dosen', 'value' => '42', 'note' => '11 bergelar doktor'],
        ['label' => 'Tahun berdiri', 'value' => '2001', 'note' => ''],
    ];
@endphp
<div class="border-y border-line bg-surface">
    <div class="container-page">
        {{-- Di HP jadi 2 kolom, bukan 4: teks nilai tidak terpotong. --}}
        <dl class="grid grid-cols-2 gap-x-4 gap-y-4 py-5 md:grid-cols-4">
            @foreach ($facts as $f)
                <div>
                    <dt class="text-2xs font-bold uppercase tracking-wider text-body-soft">{{ $f['label'] }}</dt>
                    <dd class="tabular text-xl font-bold text-primary md:text-2xl">{{ $f['value'] }}</dd>
                    @if (! empty($f['note']))
                        {{-- Nomor SK tidak boleh pecah di tengah: kalau pecah,
                             "2025" bisa jatuh sendirian ke baris berikutnya. --}}
                        <dd class="text-2xs text-body-soft [overflow-wrap:break-word] hyphens-none">{{ $f['note'] }}</dd>
                    @endif
                </div>
            @endforeach
        </dl>
    </div>
</div>
