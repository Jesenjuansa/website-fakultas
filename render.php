<?php
/**
 * Pemroses Blade sederhana - HANYA untuk pratinjau statis (bukan Laravel).
 *
 * Mengubah file .blade.php menjadi HTML agar halaman uji bisa dibuka langsung
 * (file://) tanpa server PHP. Sintaks view tetap Blade standar, jadi file yang
 * sama dapat dipakai di Laravel tanpa diubah.
 *
 * Diterjemahkan: {{ }} {!! !!} @php @if @elseif @else @foreach @for @while
 * @include @extends @section @yield.
 *
 * Aturan penulisan bila berkas ini disunting lagi:
 *  - PHP memperlakukan kurung kurawal ganda di dalam string sebagai penanda
 *    dinamis. Karena itu kurung kurawal di dalam pola regex ditulis \x7B.
 *  - Jangan menaruh penutup kode (tanda tanya lebih besar) di dalam string PHP:
 *    PHP menganggapnya akhir kode. Nilai yang memerlukannya dirakit dari
 *    potongan teks, mis. $bukaPhp di bawah.
 *  - Semua direktif diterjemahkan lebih dulu, ekspresi {{ }} paling akhir.
 */

# Penyimpan isi @section (array global milik berkas ini).
$__GLOB = [];

# Potongan pembuka kode PHP. Dirakit supaya berkas ini tidak memuat penutup kode di dalam teks.
# dalam string, yang akan memotong parse.
$bukaPhp = '<' . '?php ';
$A = chr(39);            # tanda kutip tunggal
$garisMiring = chr(92);  # garis miring

function e($v): string
{
    return htmlspecialchars((string) $v, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/** Format tanggal Indonesia tanpa pustaka Carbon. */
function blade_fmt_date(string $iso): string
{
    $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli',
              'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    $d = DateTime::createFromFormat('Y-m-d', substr($iso, 0, 10));

    return $d ? $d->format('j') . ' ' . $bulan[(int) $d->format('n') - 1] . ' ' . $d->format('Y') : $iso;
}

/** Argumen data @include: kosong -> [], selain itu diteruskan apa adanya. */
function blade_arg(?string $arg): string
{
    $arg = trim((string) $arg);

    return $arg === '' ? '[]' : $arg;
}

/**
 * Isi ekspresi {{ }} dan {!! !!} menjadi PHP.
 *
 * Blok PHP yang sudah ada dilewati utuh supaya tanda kutip di dalamnya tidak
 * ikut diproses. Teks dipotong per blok PHP memakai preg_match_all + offset.
 */
function blade_echoes(string $src): string
{
    preg_match_all('#<\?php.*?\?>|<\?=.*?\?>#s', $src, $m, PREG_OFFSET_CAPTURE);
    $out = '';
    $pos = 0;

    foreach ($m[0] as $blok) {
        [$teks, $mulai] = $blok;
        $out .= blade_echo_text(substr($src, $pos, $mulai - $pos)) . $teks;
        $pos = $mulai + strlen($teks);
    }
    $out .= blade_echo_text(substr($src, $pos));

    return $out;
}

/**
 * Ubah {{ }} / {!! !!} pada satu potongan teks (tanpa blok PHP).
 * Ekspresi diurai dengan menghitung kurung kurawal, bukan regex, supaya tidak
 * perlu menulis tanda kurawal ganda di dalam string PHP.
 */
function blade_echo_text(string $teks): string
{
    $mentah = '';
    $hasil = '';
    $panjang = strlen($teks);
    $i = 0;

    while ($i < $panjang) {
        if ($teks[$i] !== '{') {
            $hasil .= $teks[$i];
            $i++;
            continue;
        }

        // {!! ... !!} atau {{ ... }}
        $tiga = substr($teks, $i, 3) === '{' . '!!';
        $dua = substr($teks, $i, 2) === '{' . '{';
        if (! $tiga && ! $dua) {
            $hasil .= $teks[$i];
            $i++;
            continue;
        }

        $tutup = $tiga ? '!' . '!}' : '}' . '}';
        $mulaiIsi = $i + ($tiga ? 3 : 2);
        $akhir = strpos($teks, $tutup, $mulaiIsi);
        if ($akhir === false) {
            // Tanpa penutup: keluarkan apa adanya.
            $hasil .= substr($teks, $i);
            break;
        }

        $code = trim(substr($teks, $mulaiIsi, $akhir - $mulaiIsi));
        // Carbon::parse(...)->translatedFormat(...) -> blade_fmt_date(...).
        $code = preg_replace(
            '~Illuminate\\\\Support\\\\Carbon::parse\((.+?)\)->translatedFormat\([^)]*\)~',
            'blade_fmt_date($1)',
            $code
        );

        $buka = '<' . '?= ';
        $tutupPhp = ' ' . '?>';
        $hasil .= $tiga ? $buka . $code . $tutupPhp : $buka . 'e(' . $code . ')' . $tutupPhp;
        $i = $akhir + strlen($tutup);
    }

    return $hasil;
}

/** Blade -> PHP. */
function blade_compile(string $tpl): string
{
    global $bukaPhp, $A;

    # 1. Komentar Blade dibuang paling awal.
    $tpl = preg_replace('#\x7B\x7B--.*?--\}\}#s', '', $tpl);

    # 2. @include('view') / @include('view', [...]) / @include('view', $var)
    #    Dicari dengan penghitung kurung (bukan regex) karena argumen sering
    #    berisi array berlipat, string berkoma, dan array yang ditulis
    #    multi-baris.
    $tpl = blade_includes($tpl);

    # 3. @section('judul', nilai) bentuk singkat. Nilai boleh string MAUPUN
    #    variabel ($prodi['nama']); karena itu dijadikan token yang baru diubah
    #    setelah semua direktif selesai diterjemahkan. Kalau langsung ditulis
    //    sebagai PHP di sini, penutup kode hasil konversi direktif lain bisa memotongnya.
    $tpl = preg_replace(
        '#@section\(\s*(' . $A . '[^' . $A . ']*' . $A . ')\s*,\s*(.+?)\s*\)[ \t]*\n#',
        '@@BAGIAN@@$1@@$2@@' . "\n",
        $tpl
    );

    # 4. Blok @php ... @endphp menjadi PHP.
    $tpl = preg_replace('#@php(.*?)@endphp#s', $bukaPhp . '$1 ?>', $tpl);

    # 5. @extends tidak menghasilkan keluaran (induk diketahui blade_render).
    $tpl = preg_replace('#@extends\(\s*' . $A . '[^' . $A . ']*' . $A . '\s*\)#', '', $tpl);

    # 6. @section('isi') ... @endsection -> tag penanda, diubah di langkah 9.
    $tpl = preg_replace(
        '#@section\(\s*(' . $A . '[^' . $A . ']*' . $A . ')\s*\)#',
        '@@BUKA@@$1@@',
        $tpl
    );
    $tpl = str_replace('@endsection', '@@TUTUP@@', $tpl);

    # 7. @yield('x') dan @yield('x', 'default')
    $tpl = preg_replace_callback(
        '#@yield\(\s*(' . $A . '[^' . $A . ']*' . $A . ')\s*(?:,\s*(' . $A . '[^' . $A . ']*' . $A . ')\s*)?\)#',
        fn (array $m): string => $bukaPhp . 'echo $GLOBALS["__GLOB"]["__B_" . ' . $m[1] . '] ?? ' . ($m[2] ?? '""') . '; ' . '?>',
        $tpl
    );

    # 8. Direktif berblok (@if, @foreach, ...) -> PHP.
    $tpl = blade_directives($tpl);

    # 9. Tag section menjadi PHP (dirakit dari potongan agar penutup code aman).
    $tpl = preg_replace_callback(
        '#@@BUKA@@(' . $A . '[^' . $A . ']*' . $A . ')@@#',
        fn (array $m): string => $bukaPhp . 'echo "@@SEC:" . ' . $m[1] . ' . "@@" ' . '?>',
        $tpl
    );
    $tpl = str_replace('@@TUTUP@@', $bukaPhp . 'echo "@@ENDSEC@@" ' . '?>', $tpl);

    // @section('judul', nilai) -> simpan isi, tanpa mengeluarkan apa pun.
    $tpl = preg_replace_callback(
        '#@@BAGIAN@@(' . $A . '[^' . $A . ']*' . $A . ')@@(.*?)@@#s',
        fn (array $m): string => $bukaPhp . '$GLOBALS["__GLOB"]["__B_" . ' . $m[1] . '] = ' . trim($m[2]) . '; ' . '?>',
        $tpl
    );

    # 10. Terakhir: ekspresi {{ }}.
    return blade_echoes($tpl);
}

/**
 * Ganti @include('view') / @include('view', data) menjadi pemanggilan render.
 *
 * Argumen dibaca dengan menghitung kurung, mengabaikan kurung di dalam tanda
 * kutip, sehingga array berlipat dan array multi-baris tetap utuh.
 */
function blade_includes(string $tpl): string
{
    $hasil = '';
    $panjang = strlen($tpl);
    $i = 0;
    $A = chr(39);
    $bukaPhp = '<' . '?php ';

    while ($i < $panjang) {
        if (substr($tpl, $i, 9) !== '@include(') {
            $hasil .= $tpl[$i];
            $i++;
            continue;
        }

        $mulai = $i + 9;
        $kedalaman = 1;
        $j = $mulai;
        $kutip = null;

        while ($j < $panjang && $kedalaman > 0) {
            $c = $tpl[$j];
            if ($kutip !== null) {
                if ($c === chr(92)) {
                    $j += 2;
                    continue;
                }
                if ($c === $kutip) {
                    $kutip = null;
                }
            } elseif ($c === $A || $c === '"') {
                $kutip = $c;
            } elseif ($c === '(' || $c === '[') {
                $kedalaman++;
            } elseif ($c === ')' || $c === ']') {
                $kedalaman--;
            }
            $j++;
        }

        $argumen = trim(substr($tpl, $mulai, $j - $mulai - 1));

        // Pisahkan nama view dan data pada koma tingkat atas.
        $koma = null;
        $dalam = 0;
        $kutip = null;
        for ($k = 0; $k < strlen($argumen); $k++) {
            $c = $argumen[$k];
            if ($kutip !== null) {
                if ($c === chr(92)) { $k++; continue; }
                if ($c === $kutip) { $kutip = null; }
            } elseif ($c === $A || $c === '"') {
                $kutip = $c;
            } elseif ($c === '[' || $c === '(' || $c === '{') {
                $dalam++;
            } elseif ($c === ']' || $c === ')' || $c === '}') {
                $dalam--;
            } elseif ($c === ',' && $dalam === 0) {
                $koma = $k;
                break;
            }
        }

        $view = $koma === null ? $argumen : trim(substr($argumen, 0, $koma));
        $data = $koma === null ? '[]' : trim(substr($argumen, $koma + 1));

        $hasil .= $bukaPhp . 'echo blade_render(' . $view . ', ' . blade_arg($data) . '); ' . '?>';
        $i = $j;
    }

    return $hasil;
}

/**
 * Ganti direktif berblok Blade menjadi PHP.
 *
 *   @if / @elseif / @foreach / @for / @while  -> pembuka blok PHP
 *   @else                                     -> else
 *   @endif / @endforeach / @endfor / @endwhile -> penutup
 *
 * Ekspresi di dalam kurung dicari dengan menghitung kedalaman kurung dan
 * mengabaikan kurung yang berada di dalam tanda kutip. Satu direktif boleh
 * ditulis satu baris maupun diakhiri baris baru.
 */
function blade_directives(string $tpl): string
{
    global $bukaPhp, $garisMiring;
    $garisLurus = chr(39);

    $tutupPhp = ' ' . '?>';
    $hasil = '';
    $panjang = strlen($tpl);
    $i = 0;

    while ($i < $panjang) {
        if ($tpl[$i] !== '@') {
            $hasil .= $tpl[$i];
            $i++;
            continue;
        }

        # Nama terpanjang lebih dulu supaya 'elseif' tidak terbaca 'if'.
        // '@@' dipakai sebagai tag penanda section, bukan direktif:
        // jangan diproses di sini.
        if (substr($tpl, $i, 2) === '@@') {
            $hasil .= '@@';
            $i += 2;
            continue;
        }


        // Nama direktif harus kata utuh: '@foreach' harus diikuti '(' dengan
        // hanya spasi di antaranya, bukan huruf lain.
        // '@include' tidak termasuk: sudah diterjemahkan di langkah sebelumnya,
        // dan '@inc' adalah awalan sah dari '@include'.
        // Nama direktif harus kata utuh. Tanpa batas kata, '@if' di dalam
        // kalimat seperti "...@endif" di teks bisa termakan, dan '@elseif'
        // harus diperiksa lebih dulu daripada '@else'.
        // 'A' = penanda awal baris (multiline). Nama direktif TIDAK boleh diawali
        // 'A', jadi '@php' tidak akan pernah cocok di sini.
        if (preg_match('~@(elseif|if|foreach|for|while)(?![\w-])\s*\(~A', $tpl, $m, 0, $i)) {
            $nama = $m[1];
            $mulai = $i + strlen($m[0]);
            $kedalaman = 1;
            $j = $mulai;
            $kutip = null;

            // Kurung penutup terakhir adalah yang membuat kedalaman kembali 0.
            // (Daftar nama direktif berisi 'foreach'/'while' sendiri, jadi
            // penghitungan harus menghitung empat jenis kurung sekaligus.)
            while ($j < $panjang && $kedalaman > 0) {
                $c = $tpl[$j];
                if ($kutip !== null) {
                    if ($c === $garisMiring) {
                        $j += 2;
                        continue;
                    }
                    if ($c === $kutip) {
                        $kutip = null;
                    }
                } elseif ($c === $garisLurus || $c === '"') {
                    $kutip = $c;
                } elseif ($c === '(' || $c === '[' || $c === '{') {
                    $kedalaman++;
                } elseif ($c === ')' || $c === ']' || $c === '}') {
                    $kedalaman--;
                }
                $j++;
            }

            $ekspresi = trim(substr($tpl, $mulai, $j - $mulai - 1));

            # Spasi dan satu baris baru setelah kurung penutup dibuang bila
            # direktif berdiri sendiri di barisnya.
            $sisa = $j;
            while ($sisa < $panjang && ($tpl[$sisa] === ' ' || $tpl[$sisa] === "\t")) {
                $sisa++;
            }
            if ($sisa < $panjang && $tpl[$sisa] === "\n") {
                $sisa++;
            }

            $hasil .= $bukaPhp . $nama . ' (' . $ekspresi . '):' . $tutupPhp;
            $i = $sisa;
            continue;
        }

        // 'else' harus kata utuh: '@elseif' sudah ditangani di atas, dan
        // '@endforeach' tidak boleh terpotong menjadi '@end'.
        // '@endif' harus diperiksa SEBELUM '@endfor'/'@endforeach': '@endf'
        // adalah awalan bersama, dan tanpa urutan ini '@endif' terbaca '@end'.
        // Penanda: php alih-alih regex. Pola dengan alternasi + lookahead +
        // offset berperilaku tidak dapat diandalkan di mesin ini (lihat catatan
        // di atas berkas), jadi pencocokan dilakukan eksplisit.
        $direktifTutup = null;
        foreach (['endforeach', 'endwhile', 'endif', 'endfor', 'endum', 'else'] as $calon) {
            $panjangCalon = strlen($calon);
            if (substr($tpl, $i + 1, $panjangCalon) === $calon) {
                $sesudah = $tpl[$i + 1 + $panjangCalon] ?? '';
                if ($sesudah === '' || ! preg_match('~[\w-]~', $sesudah)) {
                    $direktifTutup = $calon;
                    break;
                }
            }
        }

        if ($direktifTutup !== null) {
            $peta = [
                'else' => 'else:',
                'endif' => 'endif;',
                'endforeach' => 'endforeach;',
                'endfor' => 'endfor;',
                'endwhile' => 'endwhile;',
                'endum' => 'endforeach;',
            ];
            $hasil .= $bukaPhp . $peta[$direktifTutup] . $tutupPhp;
            $i += 1 + strlen($direktifTutup);
            continue;
        }

        // Bukan direktif: keluarkan satu karakter '@' apa adanya (mis. 'info@
        // contoh.ac.id'). '{{--' juga mulai dengan '@@'? Tidak: tag penanda
        // internal ditangani di atas.
        $hasil .= '@';
        $i++;
    }

    return $hasil;
}

function blade_render(string $view, array $data = []): string
{
    $A = chr(39);

    $view = trim($view, "'\" ");
    $file = __DIR__ . '/resources/views/' . str_replace('.', '/', $view) . '.blade.php';
    if (! is_file($file)) {
        return '<!-- view tidak ditemukan: ' . $view . ' -->';
    }
    $raw = file_get_contents($file);

    $parent = '';
    if (preg_match('#@extends\(\s*' . $A . '([^' . $A . ']*)' . $A . '\s*\)#', $raw, $m)) {
        $parent = $m[1];
    }

    # Setiap view dijalankan di scope tertutup: variabel milik satu view
    # ($judul, $menu, $kategori, ...) tidak menimpa view lain, sama seperti
    # isolasi view di Laravel.
    $kode = blade_compile($raw);
    $jalankan = static function (string $kode, array $data): string {
        ob_start();
        (static function () use ($kode, $data): void {
            extract($data, EXTR_OVERWRITE);
            # Ditulis ke berkas sementara lalu di-include: nomor baris error bisa
            # dilacak, tanpa masalah escaping seperti pada eval().
            $tmp = tempnam(sys_get_temp_dir(), 'blade') . '.php';
            file_put_contents($tmp, $kode);
            include $tmp;
            @unlink($tmp);
        })();

        return ob_get_clean();
    };

    $isiView = $jalankan($kode, $data);
    blade_sections($isiView);

    if ($parent === '') {
        # View tanpa induk: HTML-nya dikeluarkan tanpa tag penanda section.
        return str_replace('@@ENDSEC@@', '', preg_replace('#@@SEC:.*?@@#s', '', $isiView));
    }

    # Hanya view halaman memakai @section/@extends; layout tidak punya induk,
    # sehingga tidak ada rekursi.
    $keluaran = blade_render($parent, $data);

    # Tag section dari include yang ikut terender juga disimpan ke $__GLOB.
    blade_sections($keluaran);

    # Tag dibuang dua langkah: pola sampai penanda akhir berhenti terlalu cepat
    # bila di dalam isi ada teks '@@'.
    return str_replace('@@ENDSEC@@', '', preg_replace('#@@SEC:.*?@@#s', '', $keluaran));
}

/** Isi @section dipindahkan dari tag ke $__GLOB (tag tidak dihapus di sini). */
function blade_sections(string $html): string
{
    preg_match_all('#@@SEC:(.*?)@@(.*?)@@ENDSEC@@#s', $html, $tmp);
    foreach ($tmp[1] as $i => $nama) {
        $GLOBALS['__GLOB']['__B_' . $nama] = $tmp[2][$i];
    }

    return $html;
}
