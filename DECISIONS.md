---
name: decisions-website-fakultas
document_type: decision-log
---

# DECISIONS.md: keputusan desain dan alasannya

Satu keputusan per baris, sesuai `02_UI_UX_SYSTEM.md` §6.2 dan keystone rule R-31: keputusan yang alasannya tidak bisa ditulis dalam satu baris belum sah.

| # | Keputusan | Alasan | Tanggal |
|---|---|---|---|
| 1 | Hijau merek `#338763` | Acuan langsung dari pemilik produk; satu warna merek membangun identitas yang tidak bisa ditukar dengan situs lain | 2026-11-23 |
| 2 | Teks di atas blok hijau memakai `#06231A`, bukan putih | Putih di atas `#338763` hanya 4,39:1, gagal AA untuk teks 16px; teks gelap 9,9:1 | 2026-11-23 |
| 3 | Tautan, tombol sekunder, dan tombol di atas hero memakai `#276B4F` | Hijau merek di atas putih hanya 3,79:1 sehingga tidak lolos AA | 2026-11-23 |
| 4 | Radius 8px untuk kontrol, 14px untuk permukaan, pil hanya untuk chip | Radius dipakai sebagai penanda hierarki; pil pada semua elemen membuat halaman terasa mainan | 2026-11-23 |
| 5 | Font sistem tanpa unduhan font | Pengunjung memakai HP murah dan jaringan lambat; font sistem 0 KB dan sudah familiar | 2026-11-23 |
| 6 | Tidak ada carousel otomatis | Konten penting yang berganti sendiri terlewat oleh pengunjung HP | 2026-11-23 |
| 7 | Tiga tombol di hero (calon mahasiswa, mahasiswa aktif, dosen dan staf) | Dua dari tiga pengunjung bukan calon mahasiswa; satu tombol "Daftar" menyembunyikan jalur yang lebih sering dipakai | 2026-11-23 |
| 8 | Satu tombol hero berlatar putih penuh, dua lainnya bergaris | Hierarki tindakan jelas tanpa mengubah target sentuh 44px | 2026-11-24 |
| 9 | Hero memakai ilustrasi siluet kampus, bukan foto | Foto kampus asli belum tersedia dan aset karangan dilarang; ilustrasi datar memberi konteks tanpa klaim palsu | 2026-11-24 |
| 10 | Susunan lapisan hero: warna merek (`z-index -10`), `picture`, tirai (`-5`), lalu teks | Warna latar seksi akan menutupi foto ber-`z-index` negatif; seksi karena itu transparan | 2026-11-24 |
| 11 | Toolbar editor hanya tampil bila JavaScript aktif | Lebih baik tombol tidak ada daripada tombol yang diklik namun tidak melakukan apa pun | 2026-11-24 |
| 12 | Tombol "Simpan draf" menyatakan batasannya di layar | Panel ini statis tanpa server; berpura-pura menyimpan akan menyesatkan staf | 2026-11-24 |
| 13 | Tabel lebih dari empat kolom berubah menjadi daftar di bawah 768px | Tabel banyak kolom di HP tidak terbaca tanpa geser mendatar | 2026-11-23 |
| 14 | Sel kosong tabel ditulis "Belum ditentukan", bukan tanda pisah | Tanda pisah terbaca sebagai data yang hilang atau rusak | 2026-11-24 |
| 15 | Tidak ada tanda pisah panjang (em dash) di teks antarmuka | Aturan R-02 dan pemilik produk minta teks yang terasa wajar | 2026-11-24 |
