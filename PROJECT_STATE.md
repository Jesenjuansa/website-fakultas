---
name: project-state-website-fakultas
document_type: project-state
---

# PROJECT_STATE.md

## Kondisi saat ini

Situs profil fakultas 16 halaman, statis (HTML hasil render), terpublikasi di GitHub Pages.
Alamat: https://jesenjuansa.github.io/website-fakultas/

Status sistem komponen: **UI SYSTEM VERIFIED** (lihat `UI_SYSTEM.md` §4).

## Yang sudah terverifikasi (bukan klaim, ada buktinya)

| Hal | Hasil |
|---|---|
| Warna merek | `--color-primary: #338763` terpasang di produksi (dibaca dari computed style halaman live) |
| Kontras teks | seluruh halaman dipindai otomatis; tidak ada teks di bawah WCAG AA |
| Geser mendatar | nol pada 360px, 768px, 1280px untuk 16 halaman |
| Target sentuh | tombol 44px (diukur dari `getBoundingClientRect`) |
| Fokus keyboard | Tab pertama "Lewati ke konten utama", garis fokus 3px terlihat |
| Tombol tanpa tujuan | tidak ada `a[href]` kosong atau `#` |
| Gambar tanpa alt | tidak ada |
| Judul melompat | tidak ada (h1 ke h2 ke h3) |
| Alat format editor | diuji: Tebal, Tempel tanpa format, dan pesan draf benar-benar bekerja |

## Yang belum (jujur, bukan PR)

1. **Batas hero di HP.** Pada 360px, teks di hero duduk di atas area ilustrasi yang terang. Kontras masih di atas ambang teks besar, tetapi di bawah 4,5:1 untuk teks kecil. Perbaikan yang disarankan: turunkan tirai lebih jauh di HP atau pindahkan catatan akreditasi keluar dari hero.
2. **Tombol Menu di HP** setinggi 40px, di bawah anjuran 44px.
3. **Formulir pencarian** mengirim kata kunci ke halaman statis, hasil pencarian belum tersaring.
4. **Panel editor** adalah contoh statis: tidak ada server, tidak ada unggah berkas sungguhan.

## Langkah berikutnya (urutan prioritas)

1. Perbaiki tiga hal di atas.
2. Ganti teks contoh ("Contoh", "B (contoh)", nomor SK) dengan data fakultas yang sebenarnya setelah disediakan.
3. Bila foto kampus resmi tersedia, ganti ilustrasi siluet dan uji ulang kontras teks hero.
