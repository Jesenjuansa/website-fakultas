---
name: ui-system-website-fakultas
version: "1.0.0"
document_type: component-registry
source_of_truth: DESIGN.md
status: UI SYSTEM VERIFIED
---

# UI_SYSTEM.md: daftar komponen, varian, dan bukti

> Dokumen ini mengikuti `02_UI_UX_SYSTEM.md` §6.2 dan §6.3. Setiap komponen yang dipakai lebih dari satu halaman wajib terdaftar di sini. **Halaman tidak boleh** membuat warna, radius, padding, atau perilaku hover sendiri.

## Cara membaca status

| Status | Arti |
|---|---|
| `APPROVED` | Boleh dipakai halaman, sudah ada contoh di workbench |
| `IMPLEMENTED` | Sudah ada di kode, belum diuji perilakunya di semua state |
| `UI SYSTEM VERIFIED` | Sudah dirender dan diuji (desktop, HP, keyboard); lihat kolom bukti |
| `DEPRECATED` | Jangan dipakai lagi pada halaman baru |

## 1. Daftar komponen

### 1.1 Aksi

| Komponen | Anatomi | Varian | State yang wajib | Status |
|---|---|---|---|---|
| Tombol | label + ikon opsional | `.btn-primary`, `.btn-secondary`, `.btn-on-dark`, `.btn-ghost-dark`, `.btn-sm` | hover, active, focus-visible, disabled | VERIFIED |
| Tautan dalam teks | teks bergaris bawah | `.link` | hover, focus-visible | VERIFIED |
| Chip filter | teks + penanda terpilih | `.chip`, `.chip[aria-current=true]` | hover, aktif | VERIFIED |

Aturan tombol (DESIGN.md §6): tinggi minimum 44px, radius 8px, satu gaya utama per layar.

### 1.2 Input

| Komponen | Anatomi | Varian | State | Status |
|---|---|---|---|---|
| Kolom isian | label terlihat + kontrol + teks bantu | `.input`, `.label`, `.hint` | fokus (cincin 4px), galat, nonaktif | VERIFIED |
| Kotak pencarian | input + tombol | di header (ringkas), di halaman (lebar) | fokus, kosong | VERIFIED |
| Toolbar editor | deretan tombol format | tampil hanya bila JavaScript aktif | tekan, tersembunyi | VERIFIED |

### 1.3 Navigasi

| Komponen | Perilaku | Status |
|---|---|---|
| Menu utama level 1 | tampil penuh di desktop (bukan hamburger), dropdown memakai `aria-expanded` | VERIFIED |
| Tombol Menu (HP) | buka/tutup, tutup dengan Escape, fokus kembali ke tombol | VERIFIED |
| Remah roti | item terakhir bukan tautan | VERIFIED |
| Penanda halaman | halaman aktif memakai `aria-current="page"` | VERIFIED |

### 1.4 Permukaan

| Komponen | Radius | Bayangan | Status |
|---|---|---|---|
| Kartu | 14px | `--shadow-card` | VERIFIED |
| Kartu bertautan | 14px | naik 2px saat hover | VERIFIED |
| Kartu berita | gambar 16:9 + kategori + judul maksimal 2 baris | tanpa | VERIFIED |
| Kartu dosen | foto 1:1 atau inisial + nama + bidang | tanpa | VERIFIED |

### 1.5 Struktur

| Komponen | Berkas | Status |
|---|---|---|
| Kepala halaman | `resources/views/partials/page-header.blade.php` | VERIFIED |
| Strip statistik | `resources/views/components/stat-strip.blade.php` | VERIFIED |
| Tabel data | `.data-table` + pola daftar saat sempit | VERIFIED |
| Penanda halaman | `resources/views/components/pagination` | VERIFIED |

### 1.6 Umpan balik dan status

| Komponen | Aturan | Status |
|---|---|---|
| Lencana status | selalu ikon + kata, bukan warna saja | VERIFIED |
| Pesan peringatan | `.notice` dengan garis aksen kiri | VERIFIED |
| Keadaan kosong | teks penjelas + tindakan berikutnya | VERIFIED |
| Galat formulir | pesan di bawah kolom + `aria-describedby` | VERIFIED |

## 2. Token yang dipakai komponen

```css
--color-primary: #338763;        /* merek */
--color-primary-strong: #276b4f; /* hover, top bar, tautan, tombol sekunder */
--color-on-primary: #06231a;     /* teks di atas blok hijau */
--radius-sm: 8px;                /* kontrol */
--radius-md: 14px;               /* permukaan */
```

Tidak ada halaman yang boleh menimpa token ini dengan nilai sendiri.

## 3. Workbench

`style-guide.html` adalah workbench proyek (bukan Storybook, karena proyek statis tanpa server). Isinya:
- semua varian tombol: normal, nonaktif, ukuran kecil;
- kolom isian dengan teks bantu dan pesan galat;
- lencana status sukses, peringatan, galat (ikon + kata);
- tabel empat kolom dan versi daftar saat sempit;
- kartu berita dengan judul pendek dan judul sangat panjang.

## 4. Bukti verifikasi (Gate komponen)

| Uji | Cara | Hasil |
|---|---|---|
| Render HP dan desktop | 16 halaman pada 360px dan 1280px | tidak ada geser mendatar |
| Fokus terlihat | Tab berturut-turut dari awal halaman | garis 3px `#0b63a8`, offset 2px |
| Tombol tanpa tujuan | pemeriksaan `a[href]` kosong atau `#` | tidak ada |
| Kontras teks | pemindaian otomatis seluruh elemen teks | tidak ada teks di bawah AA |
| Gambar tanpa alt | pemeriksaan seluruh `img` | tidak ada |
| Judul tidak melompat | urutan h1 sampai h4 per halaman | tidak ada lompatan |

## 5. Aturan konsumsi di halaman

1. Halaman memakai kelas komponen yang sudah ada. Tidak ada `style="..."` untuk warna atau jarak.
2. Bila perlu varian baru, tambahkan di `app.css` **dan** catat di dokumen ini. Jangan menambal satu halaman.
3. Setiap komponen baru wajib punya contoh di `style-guide.html` sebelum dipakai di halaman produk.
