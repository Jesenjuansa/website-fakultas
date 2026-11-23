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
        // CSS saja; JS halaman ini sengaja nyaris tidak ada (lihat Tahap 4:
        // situs harus terbaca saat JS gagal dimuat).
        rollupOptions: {
            input: {
                app: resolve(import.meta.dirname, 'resources/css/app.css'),
            },
            output: {
                assetFileNames: (info) =>
                    info.names?.[0]?.endsWith('.css') ? 'app.css' : '[name][extname]',
            },
        },
        cssMinify: true,
    },
});
