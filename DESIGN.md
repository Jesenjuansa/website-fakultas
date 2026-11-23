---
name: design-system-website-fakultas
version: "1.0.0"
document_type: project-design-truth
status: APPROVED
direction_source: "Acuan warna dari pemilik produk (#338763) + acuan kerapian SIH FH USK"
dial: ENERGY 2 / RHYTHM 2 / MOTION 1
language_default: id-ID
---

# DESIGN.md — Website Profil Fakultas Ilmu Komputer (Contoh)

> **Fungsi dokumen.** Ini sumber kebenaran arah visual proyek, sesuai struktur `02_UI_UX_SYSTEM.md` §6.2. Warna, sudut, jarak, dan perilaku di sini diimplementasikan sebagai token di `resources/css/app.css` dan **tidak boleh** ditulis ulang per halaman. Halaman mengonsumsi komponen bersama; halaman tidak membuat aturan visual sendiri.

## Design Read

> Reading this as: situs informasi publik fakultas untuk tiga audiens (calon mahasiswa, mahasiswa aktif, dosen/staf/orang tua/alumni), dengan bahasa visual institusional yang tenang dan rapi, dial **ENERGY 2 / RHYTHM 2 / MOTION 1**.

Alasan dial:
- **ENERGY 2** — situs negeri resmi: percaya diri tetapi tidak agresif. Tidak ada glow, gradasi pelangi, atau kartu melayang.
- **RHYTHM 2** — sebagian besar halaman mengikuti pola yang sama (judul halaman + isi), tetapi beranda dan halaman prodi keluar dari pola itu karena isinya memang berbeda.
- **MOTION 1** — hanya umpan balik hover/fokus. Tidak ada animasi masuk, tidak ada carousel otomatis, tidak ada parallax.

## 1. Keputusan inti dan alasannya (satu baris per keputusan)

| Keputusan | Alasan (satu baris) |
|---|---|
| Hijau institusi `#338763` | Acuan langsung dari pemilik produk; satu warna merek membangun identitas yang tidak bisa ditukar dengan situs lain. |
| Teks di atas hijau = `#06231A` (bukan putih) | Putih di atas `#338763` hanya 4,39:1, gagal AA untuk teks 16px; teks gelap 9,9:1. |
| Aksen tunggal tembaga `#8F4B12` | Satu aksen untuk hal yang benar-benar perlu dibedakan (kategori berita utama, tautan dalam paragraf), bukan hiasan. |
| Dua radius: 8px (kontrol) dan 14px (permukaan) | Radius sebagai hierarki. Pil hanya untuk chip/filter, bukan semua elemen. |
| Bayangan dua lapis tipis | Elevasi sebagai penanda, bukan dekorasi: kartu terangkat, halaman tidak melayang. |
| Font sistem (`system-ui`) | Pengunjung memakai HP murah dan jaringan lambat; font sistem 0 KB unduhan dan sudah familiar. |
| Judul bobot 600, badan 400, tinggi baris 1,7 | Membaca di luar ruangan lebih mudah bila huruf tidak rapat dan tidak terlalu tebal. |
| Hero memakai ilustrasi siluet kampus | Foto kampus asli tidak tersedia (tidak boleh mengarang aset); ilustrasi vektor datar memberi konteks kampus tanpa klaim palsu. |
| Tanpa carousel | Konten penting yang berganti sendiri akan terlewat oleh pengunjung HP. |

## 2. Token warna (kontras terukur, bukan perkiraan)

| Peran | Token | Hex | Kontras |
|---|---|---|---|
| Primary (merek) | `--color-primary` | `#338763` | 9,9:1 vs teks gelap; 4,39:1 vs putih (karena itu teks di atasnya harus gelap) |
| Primary kuat (hover, top bar, tautan) | `--color-primary-strong` | `#276B4F` | 6,10:1 vs putih |
| Primary lembut (band, chip aktif) | `--color-primary-soft` | `#E9F4EE` | primary di atasnya 4,60:1 |
| Teks di atas primary | `--color-on-primary` | `#06231A` | 9,9:1 di atas primary |
| Aksen | `--color-accent` | `#8F4B12` | 6,60:1 vs putih |
| Teks utama | `--color-body` | `#1A1A1A` | 17,4:1 |
| Teks sekunder | `--color-body-soft` | `#4A4A4A` | 8,86:1 |
| Latar halaman | `--color-page` | `#FFFFFF` | — |
| Permukaan bergantian | `--color-surface` | `#F7F8F7` | — |
| Garis rambut | `--color-line` | `#E6EAE6` | dekoratif |
| Batas kontrol | `--color-line-strong` | `#7F8C83` | 3,51:1 (ambang elemen UI 3:1) |
| Sukses | `--color-success` | `#1B7F3B` | 5,07:1 |
| Peringatan | `--color-warning` | `#9A5B00` | 5,43:1 |
| Galat | `--color-danger` | `#B3261E` | 6,54:1 |
| Fokus keyboard | `--color-focus` | `#0B63A8` | 6,24:1; sengaja biru agar tidak tertukar dengan merek |

**Batas palet (R-29):** 2 warna inti (hijau, putih/netral) + 1 aksen (tembaga). Status bukan bagian palet merek.

## 3. Tipografi

Keluarga: `system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif`. Tanpa unduhan font.
Alasan: pengunjung 3G di HP dan staf yang butuh halaman cepat; huruf sistem sudah terasa "dokumen resmi" tanpa menambah berat unduhan.

| Peran | Mobile | Desktop | Token |
|---|---|---|---|
| Judul utama halaman | 30px / 1,2 | 44px / 1,1 | `text-hero`, `text-hero-d` |
| Judul hero beranda | 30px | 52px | `text-hero`, `text-hero-d` |
| H2 bagian | 22px | 24px | `text-2xl` |
| H3 kartu | 18px | 18px | `text-lg` |
| Badan isi | 16px / 1,7 | 17px / 1,7 | `text-base` |
| Teks bantu, label | 14px / 1,55 | 14px | `text-sm` |
| Metadata (tanggal, kode MK) | 13px | 13px | `text-2xs` |

Aturan: badan isi **tidak pernah** di bawah 16px di HP. Bobot: 400 untuk badan, 600 untuk judul, 700 hanya untuk angka statistik. Huruf kapital berjarak lebar hanya untuk label pendek (maks 3 kata) dan dengan `letter-spacing: 0.06em`, bukan 0,12em.

## 4. Spasi dan tata letak

Skala kelipatan 4px: 4, 8, 12, 16, 24, 32, 48, 64. Tidak ada nilai di luar skala.
- Jarak antar bagian halaman: 48px (HP), 64px (desktop).
- Jarak di dalam kartu: 16px, atau 24px untuk kartu besar.
- Lebar kolom teks isi: maksimal 65–70 karakter (`text-measure`), karena baris lebih panjang membuat mata kehilangan baris.
- Wadah: `container-page` (padding 16px di HP, 24px tablet, 32px desktop), lebar maksimum konten 1152px.
- Titik ubah: 640px (HP besar), 768px (tablet), 1024px (desktop), 1280px (desktop lebar).

## 5. Bentuk dan elevasi

| Elemen | Radius | Bayangan |
|---|---|---|
| Tombol, input, select | 8px | tanpa (kecuali tombol primary di atas foto) |
| Chip, filter | penuh (pil) | tanpa |
| Kartu, panel | 14px | `--shadow-card` |
| Panel mengambang (dropdown, dialog) | 14px | `--shadow-panel` |

Bayangan hanya untuk menandai elevasi, maksimal dua lapis dan opasitas ≤ 0,1. Tidak ada glow.

## 6. Komponen dan kontraknya

| Komponen | Anatomi | Varian | Status perilaku wajib |
|---|---|---|---|
| Tombol | Ikon opsional + label | primary (teks gelap di hijau), secondary (garis), ghost di atas gambar, kecil | hover, active, focus-visible, disabled, loading |
| Kolom isian | Label + kontrol + teks bantu + pesan galat | teks, cari, pilih, berkas | fokus (cincin), galat, terisi, nonaktif |
| Kartu berita | Gambar 16:9 + kategori + judul + tanggal | dengan gambar, tanpa gambar | hover (garis + bayangan), seluruh kartu adalah tautan |
| Kartu dosen | Foto 1:1 atau inisial + nama + gelar + prodi/bidang | dengan foto, inisial | — |
| Tabel data | Kepala + baris + sel | tabel biasa, "daftar saat sempit" | di bawah 768px berubah jadi daftar label–nilai |
| Navigasi | Menu level 1 + dropdown level 2 | desktop (tampil penuh), HP (tombol Menu yang terbuka/tertutup) | aria-expanded, tutup dengan Escape, fokus terlihat |
| Penanda halaman | Tautan halaman + halaman aktif | — | halaman aktif memakai `aria-current="page"` |
| Remah roti | Tautan berjenjang | — | item terakhir tidak berupa tautan |
| Kotak pencarian | Input + tombol | di header (ringkas), di halaman (lebar) | mengirim kata kunci ke halaman pencarian |

Semua kontrol: tinggi minimum 44px, `cursor: pointer`, label terlihat (bukan hanya placeholder), nama aksesibel.

## 7. Aturan tata letak per titik ubah

- **360px** — satu kolom. Tabel berubah jadi daftar. Tombol aksi utama selebar layar. Tidak boleh ada geser mendatar sama sekali.
- **768px** — dua kolom untuk kartu. Tabel tetap berbentuk tabel bila kolomnya ≤ 4; lebih dari itu tetap daftar.
- **1280px** — tiga kolom kartu, menu tampil penuh tanpa hamburger, pencarian ada di header.

## 8. Gerak (MOTION 1)

- Transisi hanya untuk perubahan state: 150–200 ms, `ease`.
- Umpan balik tekan: naik 1px atau perubahan warna, tidak ada skala.
- `prefers-reduced-motion: reduce` mematikan semua transisi (sudah diterapkan di CSS dasar).
- Tidak ada animasi masuk, tidak ada paralaks, tidak ada carousel.

## 9. Yang dilarang di proyek ini

1. Warna di luar token (kecuali di dalam file aset ilustrasi).
2. Teks abu tipis di atas putih; teks putih kecil di atas hijau terang.
3. Carousel otomatis untuk konten penting.
4. Tombol tanpa tujuan atau tanpa respons.
5. Radius pil pada semua elemen.
6. Ikon dari set yang sama untuk segala hal tanpa relevansi isi.
7. Angka/klaim yang tidak bersumber (statistik palsu, testimoni karangan).
8. Em dash di teks antarmuka.

## 10. Status bukti

| Hal | Status | Bukti |
|---|---|---|
| Token terdefinisi sekali di `resources/css/app.css` | IMPLEMENTED | satu blok `@theme` |
| Kontras AA | VERIFIED | pemindaian otomatis 16 halaman × 2 lebar: 0 temuan untuk teks biasa |
| Responsif 360/768/1280 | VERIFIED | `scrollWidth − clientWidth = 0` di semua halaman |
| Fokus keyboard | VERIFIED | Tab pertama = "Lewati ke konten utama", garis fokus 3px terlihat |
| Komponen berbagi dipakai semua halaman | IMPLEMENTED | `components/` + `partials/` di semua 16 halaman |
