<?php
/**
 * Data contoh program studi (placeholder, bukan data resmi).
 * Dipakai halaman daftar prodi dan tiga halaman prodi sebagai data.
 */
return [
    'informatika' => [
        'nama' => 'S1 Informatika',
        'gelar' => 'Sarjana Komputer (S.Kom.)',
        'jenjang' => 'S1',
        'akr' => 'B',
        'desk' => 'Fokus rekayasa perangkat lunak, kecerdasan artifisial, dan jaringan.',
        'ringkas' => 'Pendidikan sarjana bidang komputasi dengan penekanan rekayasa perangkat lunak, kecerdasan artifisial, dan jaringan.',
        'bidang' => 'Pemrograman, data, jaringan',
        'lulusan' => 'Engineer, analis sistem, data scientist',
        'kurikulum' => [
            ['INF101', 'Dasar Pemrograman', '4', '—'],
            ['INF102', 'Matematika Diskret', '3', '—'],
            ['INF103', 'Pengantar Sistem Komputer', '3', '—'],
            ['INF104', 'Struktur Data', '3', 'INF101'],
        ],
    ],
    'sistem-informasi' => [
        'nama' => 'S1 Sistem Informasi',
        'gelar' => 'Sarjana Komputer (S.Kom.)',
        'jenjang' => 'S1',
        'akr' => 'B',
        'desk' => 'Fokus tata kelola data, proses bisnis, dan sistem informasi organisasi.',
        'ringkas' => 'Pendidikan sarjana bidang sistem informasi dengan penekanan tata kelola data, analisis proses bisnis, dan perancangan sistem organisasi.',
        'bidang' => 'Basis data, proses bisnis, analitik',
        'lulusan' => 'Analis bisnis, perancang sistem, administrator data',
        'kurikulum' => [
            ['SIF101', 'Pengantar Sistem Informasi', '3', '—'],
            ['SIF102', 'Basis Data', '4', '—'],
            ['SIF103', 'Analisis Proses Bisnis', '3', '—'],
            ['SIF104', 'Pemrograman Web', '3', 'SIF101'],
        ],
    ],
    'teknologi-informasi' => [
        'nama' => 'D3 Teknologi Informasi',
        'gelar' => 'Ahli Madya Komputer (A.Md.Kom.)',
        'jenjang' => 'D3',
        'akr' => 'Baik',
        'desk' => 'Terapan: administrasi jaringan, dukungan teknis, dan pengembangan web.',
        'ringkas' => 'Pendidikan vokasi bidang teknologi informasi dengan penekanan praktikum: administrasi jaringan, dukungan teknis, dan pengembangan web.',
        'bidang' => 'Administrasi jaringan, dukungan teknis, web',
        'lulusan' => 'Teknisi jaringan, staf dukungan TI, pengembang web',
        'kurikulum' => [
            ['TIF101', 'Konsep Teknologi Informasi', '2', '—'],
            ['TIF102', 'Administrasi Jaringan', '4', '—'],
            ['TIF103', 'Pemrograman Web Dasar', '3', '—'],
            ['TIF104', 'Perawatan Perangkat Keras', '3', 'TIF101'],
        ],
    ],
];
