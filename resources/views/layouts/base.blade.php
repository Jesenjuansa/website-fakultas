<!DOCTYPE html>
{{-- ============================================================
     TATA LETAK INDUK (layout)
     Semua halaman memakai berkas ini supaya header, footer, dan
     perilaku aksesibilitas tidak pernah berbeda antar halaman.
     ============================================================ --}}
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- Deskripsi singkat: yang muncul di hasil pencarian Google. --}}
    {{-- Deskripsi untuk hasil pencarian Google; halaman bisa menimpanya. --}}
    <meta name="description" content="@yield('description')">
    <title>@yield('title', 'Beranda') · Fakultas Ilmu Komputer (Contoh)</title>
    {{-- Satu berkas CSS hasil kompilasi, tanpa CDN: tidak bergantung
         pada jaringan pihak ketiga (pengunjung 3G). --}}
    <link rel="stylesheet" href="build/app.css">
</head>
<body class="min-h-screen flex flex-col">

{{-- Lompat ke konten: tautan pertama saat Tab ditekan. Tanpa ini
     pengguna keyboard harus melewati seluruh menu di setiap halaman. --}}
<a href="#konten-utama" class="skip-link">Lewati ke konten utama</a>

@include('partials.header')

<main id="konten-utama" tabindex="-1" class="flex-1">
    @yield('content')
</main>

@include('partials.footer')

</body>
</html>
