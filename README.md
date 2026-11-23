# Website Fakultas — Front-End (Pratinjau)

Pratinjau front-end sebuah website fakultas: struktur navigasi, prioritas informasi per halaman,
design system, dan komponen Blade yang bisa dipakai ulang.

**Demo:** https://jesenjuansa.github.io/website-fakultas/

> Semua data **placeholder** ("Contoh"), bukan data fakultas mana pun.

## Halaman (16)

Beranda · Profil · Daftar Prodi · **3 halaman prodi** (Informatika, Sistem Informasi,
Teknologi Informasi) · Penerimaan · Akademik · Pengumuman · Unduhan · Dosen · Berita ·
Detail Berita · Pencarian · Panel Konten · Panduan Desain.

## Struktur

| | |
|---|---|
| `public/` | Hasil statis 16 halaman (yang disajikan GitHub Pages) |
| `resources/css/app.css` | Design system: token warna/teks/jarak + komponen (Tailwind CSS v4) |
| `resources/views/` | View Blade: `layouts/`, `partials/`, `components/`, `pages/` |
| `data-prodi.php` | Data contoh tiga program studi (satu view → tiga halaman) |
| `render.php`, `build.php` | Pemroses Blade sederhana untuk pratinjau statis (bukan Laravel) |
| `README-LENGKAP.md` | Catatan teknis: token, prinsip desain, hasil uji |

## Build ulang

```bash
npm install
npx vite build   # CSS -> public/build/app.css
php build.php    # view Blade -> public/*.html
```

## Hasil uji

- 16 halaman × lebar 360 / 768 / 1280 px: tanpa pergeseran horizontal.
- Tabel 4–5 kolom berubah menjadi daftar kartu berlabel di bawah 768 px.
- Kontras semua teks memenuhi WCAG AA (dipindai otomatis).
- Tetap terbaca tanpa JavaScript; menu HP memakai `<details>` bawaan browser.
- Area sentuh tombol & tautan menu ≥ 44 px.
- Beranda: 40 KB HTML + 33 KB CSS (6,9 KB gzip).
