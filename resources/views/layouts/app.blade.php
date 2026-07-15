<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="theme-color"
        content="#071A2F"
    >

    <meta
        name="description"
        content="Website Program Studi D-IV Teknik Mesin Produksi dan Perawatan, Jurusan Teknik Mesin, Politeknik Negeri Malang."
    >

    <title>
        @yield(
            'title',
            'D-IV Teknik Mesin Produksi dan Perawatan'
        )
    </title>

    {{-- ========================================================= --}}
    {{-- FONT --}}
    {{-- ========================================================= --}}

    <link
        rel="preconnect"
        href="https://fonts.googleapis.com"
    >

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@500;600;700&display=swap"
        rel="stylesheet"
    >

    {{-- ========================================================= --}}
    {{-- ASSET --}}
    {{-- ========================================================= --}}

    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
    ])

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    >

    @stack('styles')
</head>

<body
    class="min-h-screen overflow-x-hidden
           bg-[#F4F7FA] text-slate-900
           antialiased"
    style="
        font-family:
            'Plus Jakarta Sans',
            sans-serif;
    "
>
    {{-- Aksesibilitas --}}
    <a
        href="#main-content"
        class="fixed left-4 top-4 z-[100]
               -translate-y-24 rounded-lg
               bg-[#D4AF37] px-5 py-3
               font-bold text-slate-950
               shadow-xl transition
               focus:translate-y-0"
    >
        Lewati ke konten
    </a>


    {{-- ========================================================= --}}
    {{-- NAVBAR --}}
    {{-- ========================================================= --}}

    @include('components.shared.navbar')


    {{-- ========================================================= --}}
    {{-- CONTENT --}}
    {{-- ========================================================= --}}

    <main id="main-content">
        @yield('content')
    </main>


    {{-- ========================================================= --}}
    {{-- FOOTER --}}
    {{-- ========================================================= --}}

    @include('components.shared.footer')


    @stack('scripts')
</body>
</html>