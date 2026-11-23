<?php
/**
 * build.php — merender semua view Blade menjadi HTML statis di public/.
 *
 * Dipakai untuk pratinjau: hasilnya bisa dibuka langsung (file://) tanpa
 * PHP/Laravel, tanpa server, tanpa internet. Tombol "Pratinjau" cukup membuka
 * public/index.html.
 *
 * Jalankan:  php build.php
 */

require __DIR__ . '/render.php';

$prodi = require __DIR__ . '/data-prodi.php';

// Halaman prodi: satu view, tiga data -> tiga berkas HTML.
$pages = [
    'index'        => 'index.html',
    'profil'       => 'profil.html',
    'prodi-list'   => 'program-studi.html',
    'prodi:informatika'          => 'prodi-informatika.html',
    'prodi:sistem-informasi'     => 'prodi-sistem-informasi.html',
    'prodi:teknologi-informasi'  => 'prodi-teknologi-informasi.html',
    'penerimaan'   => 'penerimaan.html',
    'akademik'     => 'akademik.html',
    'pengumuman'   => 'pengumuman.html',
    'unduhan'      => 'unduhan.html',
    'dosen'        => 'dosen.html',
    'berita'       => 'berita.html',
    'berita-detail'=> 'berita-detail.html',
    'pencarian'    => 'pencarian.html',
    'admin-editor' => 'admin-editor.html',
    'style-guide'  => 'style-guide.html',
];

$out = __DIR__ . '/public';
$ok = 0;
foreach ($pages as $view => $file) {
    // Format 'prodi:<kunci>' = halaman prodi dengan data prodi tertentu.
    if ($view === 'prodi-list') {
        $daftarProdi = [];
        foreach ($prodi as $slug => $p) {
            $daftarProdi[] = [
                'nama' => $p['nama'],
                'gelar' => $p['gelar'],
                'jenjang' => $p['jenjang'],
                'akr' => $p['akr'],
                'url' => 'prodi-' . $slug . '.html',
                'desk' => $p['desk'],
            ];
        }
        $html = blade_render('pages.prodi-list', ['daftarProdi' => $daftarProdi]);
    } elseif (str_starts_with($view, 'prodi:')) {
        $kunci = substr($view, 6);
        $html = blade_render('pages.prodi', ['prodi' => $prodi[$kunci]]);
    } else {
        $html = blade_render('pages.' . $view);
    }
    file_put_contents($out . '/' . $file, $html);
    printf("%-16s -> public/%-22s %6.1f KB\n", $view, $file, strlen($html) / 1024);
    $ok++;
}
echo "\n$ok halaman dirender.\n";
