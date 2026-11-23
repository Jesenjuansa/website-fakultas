import { defineConfig } from 'vite';
import tailwindcss from '@tailwindcss/vite';
import { resolve } from 'node:path';

/*
 * Build tanpa Laravel Vite plugin: keluaran langsung ke public/build/ dengan
 * nama berkas tetap (tanpa hash). Alasannya, halaman uji adalah HTML statis
 * yang harus bisa dibuka dari file:// saat offline — manifest Laravel justru
 * membuat langkah itu gagal. Nama tetap juga memudahkan staf IT mencari berkas.
 */
export default defineConfig({
    plugins: [tailwindcss()],
    build: {
        outDir: 'public/build',
        emptyOutDir: true,
        // Satu-satunya JS: alat format editor. Halaman lain tetap terbaca
        // sepenuhnya tanpa JS (lihat Tahap 4).
        rollupOptions: {
            input: {
                app: resolve(import.meta.dirname, 'resources/css/app.css'),
                editor: resolve(import.meta.dirname, 'resources/js/editor-format.js'),
            },
            output: {
                // Nama tetap tanpa hash: HTML statis yang dibuka dari file://
                // tidak bisa menebak nama berkas ber-hash.
                entryFileNames: '[name].js',
                assetFileNames: (info) =>
                    info.names?.[0]?.endsWith('.css') ? 'app.css' : '[name][extname]',
            },
        },
        cssMinify: true,
    },
});
