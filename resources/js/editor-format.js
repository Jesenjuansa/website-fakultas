/*
 * Satu-satunya JavaScript situs: alat format di panel editor (halaman contoh
 * untuk staf). Situlah tombol "pura-pura bekerja" paling berbahaya, karena
 * staf mengira teksnya sudah diformat.
 *
 * Prinsip yang dijaga:
 * 1. Semua halaman tetap terbaca dan semua tautan tetap bisa dipakai TANPA
 *    berkas ini (tidak ada menu atau isi yang bergantung pada JS).
 * 2. Toolbar hanya muncul kalau JS berjalan; kalau gagal dimuat, tombol yang
 *    tidak berfungsi tidak ikut tampil (tidak ada tombol mati).
 * 3. Tidak ada kerangka (framework): 2 KB sudah cukup.
 */
(function () {
    'use strict';

    var toolbar = document.querySelector('[role="toolbar"][data-target]');
    if (!toolbar) return;

    var textarea = document.getElementById(toolbar.dataset.target);
    if (!textarea) {
        // Teks isi tidak ada: jangan biarkan tombol tanpa hasil.
        toolbar.remove();
        return;
    }

    var pembungkus = {
        'Tebal': ['**', '**', 'teks tebal'],
        'Miring': ['*', '*', 'teks miring'],
        'Subjudul': ['## ', '', 'Subjudul bagian'],
        'Tautan': ['[', '](alamat-tujuan)', 'teks tautan'],
    };

    function sisipkan(awal, akhir, contoh) {
        var s = textarea.selectionStart, e = textarea.selectionEnd;
        var pilih = textarea.value.slice(s, e) || contoh;
        // setRangeText menjaga riwayat undo peramban tetap berfungsi.
        textarea.setRangeText(awal + pilih + akhir, s, e, 'end');
        textarea.focus();
        // Kembalikan seleksi ke teks yang baru disisipkan agar bisa langsung ditimpa.
        textarea.setSelectionRange(s + awal.length, s + awal.length + pilih.length);
        textarea.dispatchEvent(new Event('input', { bubbles: true }));
    }

    toolbar.addEventListener('click', function (ev) {
        var btn = ev.target.closest('button');
        if (!btn) return;
        var label = btn.textContent.trim();

        if (pembungkus[label]) {
            sisipkan.apply(null, pembungkus[label]);
            return;
        }
        if (label === 'Daftar' || label === 'Daftar nomor') {
            var tanda = label === 'Daftar' ? '- ' : '1. ';
            var s = textarea.selectionStart;
            var sebelum = textarea.value.slice(0, s);
            var diAwalBaris = sebelum.endsWith('\n') || sebelum.length === 0;
            sisipkan(diAwalBaris ? tanda : '\n' + tanda, '', 'butir daftar');
            return;
        }
        if (label === 'Tempel tanpa format') {
            // Bersihkan tempelan Word: enter ganda, spasi berlebih, tanda pisah.
            textarea.value = textarea.value
                .replace(/\r\n?/g, '\n')
                .replace(/[ \t]{2,}/g, ' ')
                .replace(/\n{3,}/g, '\n\n')
                .trim();
            textarea.dispatchEvent(new Event('input', { bubbles: true }));
            return;
        }
        // Tombol yang tidak dikenali disembunyikan, bukan dibiarkan mati.
        btn.hidden = true;
    });
})();
