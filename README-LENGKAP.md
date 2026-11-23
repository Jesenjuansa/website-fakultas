# Catatan Teknis — Website Fakultas (Pratinjau)

Demo: https://jesenjuansa.github.io/website-fakultas/  
Halaman: 16 (satu view prodi dipakai tiga kali dengan data berbeda).

## Cara melihat

Buka langsung `public/index.html` (tanpa server, tanpa internet), atau versi online di GitHub Pages.

## Cara mengubah

1. Sunting view di `resources/views/` (sintaks **Blade standar**, bisa dipakai di Laravel apa adanya).
2. Bangun CSS: `npx vite build` (Tailwind v4 → `public/build/app.css`).
3. Render halaman: `php build.php` (menghasilkan HTML statis di `public/`).

## Peta berkas

```
resources/css/app.css                      Design system (token warna, teks, jarak, komponen)
resources/views/layouts/base.blade.php     Layout induk (skip link, header, footer)
resources/views/partials/                  header, footer, breadcrumb, page-header
resources/views/components/                card-berita, card-dosen, pagination, search-box, stat-strip
resources/views/pages/                     satu berkas per halaman
data-prodi.php                             data contoh tiga program studi
render.php                                 Pemroses Blade sederhana (khusus pratinjau statis)
build.php                                  Merender semua halaman ke public/
```

## Prinsip desain yang diterapkan

- **Navigasi 6 menu level 1**, pencarian di tiga titik (header desktop, panel menu HP, blok di beranda),
  dan hasil pencarian dikelompokkan per jenis (dosen, dokumen, pengumuman, berita, halaman).
- **Urutan blok = urutan pertanyaan pengunjung**, bukan urutan kepentingan institusi.
- **Tanpa slider otomatis**; menu desktop tidak disembunyikan di balik ikon hamburger.
- **Tabel lebar ditolak**: di bawah 768 px setiap baris menjadi kartu berlabel
  (label dari atribut `data-label`), bukan tabel yang digeser ke samping.
- **Status tidak hanya warna**: selalu ikon + kata ("✓ Aktif", "✕ Selesai").
- **Batas konten ditegakkan di panel admin**: judul maks 80 karakter, ringkasan 200,
  gambar maks 5 MB dipotong 16:9, kategori maks 3, tabel di isi berita maks 4 kolom.

## Token

| Peran | Nilai | Kontras vs putih |
|---|---|---|
| Primary | `#0F4C5C` | 9,51:1 |
| Primary hover | `#0B3C49` | 11,95:1 |
| Aksen | `#A0522D` | 5,62:1 |
| Teks | `#1A1A1A` | 17,40:1 |
| Teks sekunder | `#4A4A4A` | 8,86:1 |
| Sukses | `#1B7F3B` | 5,07:1 |
| Peringatan | `#9A5B00` | 5,43:1 |
| Galat | `#B3261E` | 6,54:1 |
| Fokus keyboard | `#0B63A8` | 6,24:1 |
| Garis/batas UI | `#8C9598` | 3,06:1 (ambang elemen UI 3:1) |

Tipografi: badan 16 px (lantai aman), H1 28→36 px, hero 30→44 px. Jarak kelipatan 4 px
(4/8/12/16/24/32/48/64). Sentuh minimal 44×44 px.

## Yang sudah diuji

- Lebar **360 px, 768 px, 1280 px** pada 14 halaman: tanpa pergeseran horizontal, tanpa elemen meluber.
- **Kontras**: seluruh teks dipindai otomatis pada 360 px dan 1280 px — tidak ada di bawah WCAG AA.
- **Tanpa JavaScript**: halaman tetap terbaca; menu HP memakai `<details>` dan panelnya bisa digulir.
- **Ukuran**: beranda 40 KB HTML + 33 KB CSS (6,9 KB gzip) + 3 gambar WebP (~4 KB).

## Catatan

- `render.php` hanya untuk pratinjau statis. Di Laravel, hapus berkas itu dan pindahkan view ke
  `resources/views/` proyek; panggil dengan `view('pages.index')`. `@include('components.…')`
  dapat diganti menjadi `<x-…>` bila memakai Blade component.
- Gambar di `public/img/` adalah gradien sintetis sebagai pengganti foto.
