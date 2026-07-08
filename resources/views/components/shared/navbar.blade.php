<nav
    id="navbar"
    class="fixed top-0 left-0 w-full z-[9000] transition-all duration-300 text-white">

    <div class="max-w-7xl mx-auto px-6">

        <div class="flex items-center justify-between h-20">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3 min-w-0">

                <div class="shrink-0 w-12 h-12 rounded-2xl bg-white/90 p-1.5 shadow-lg">
                    <img
                        src="{{ asset('assets/images/logo.png') }}"
                        alt="Logo Polinema"
                        class="w-full h-full object-contain">
                </div>

                <div class="leading-tight min-w-0">

                    {{-- Mobile Text --}}
                    <h1 class="md:hidden font-extrabold text-[13px] uppercase tracking-tight leading-[1.15]">
                        Teknik Otomotif Elektronik
                        
                        
                    </h1>

                    {{-- Desktop Text --}}
                    <h1 class="hidden md:block font-extrabold text-lg md:text-xl uppercase tracking-tight">
                        Program Studi Teknik Otomotif Elektronik
                    </h1>

                    <p class="text-[11px] md:text-sm font-semibold opacity-90 mt-0.5">
                        POLINEMA
                    </p>

                </div>

            </a>

            {{-- Desktop Menu --}}
            <div class="hidden md:flex items-center gap-8 font-semibold">

                <a href="{{ route('home') }}"
                   class="hover:text-yellow-400 transition">
                    Beranda
                </a>

                <a href="{{ route('profile') }}"
                   class="hover:text-yellow-400 transition">
                    Profil TOE
                </a>

                <a href="{{ route('lecturers') }}"
                   class="hover:text-yellow-400 transition">
                    Dosen & Staff
                </a>

                {{-- Akademik Dropdown --}}
                <div class="relative group">

                    <button type="button" class="flex items-center gap-1 hover:text-yellow-400 transition">
                        Akademik
                        <i class="fa-solid fa-chevron-down text-xs"></i>
                    </button>

                    <div class="absolute left-0 top-full pt-4 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300">

                        <div class="w-56 rounded-xl bg-white text-slate-800 shadow-xl border border-slate-100 overflow-hidden">

                            <a href="{{ route('academic.page', 'pedoman-akademik') }}"
                               class="block px-5 py-3 hover:bg-blue-50 hover:text-blue-700">
                                Pedoman Akademik
                            </a>

                            <a href="{{ route('academic.page', 'kalender-akademik') }}"
                               class="block px-5 py-3 hover:bg-blue-50 hover:text-blue-700">
                                Kalender Akademik
                            </a>

                            <a href="{{ route('academic.page', 'kurikulum') }}"
                               class="block px-5 py-3 hover:bg-blue-50 hover:text-blue-700">
                                Kurikulum
                            </a>

                            <a href="{{ route('academic.page', 'jadwal-kuliah') }}"
                               class="block px-5 py-3 hover:bg-blue-50 hover:text-blue-700">
                                Jadwal Kuliah
                            </a>

                            <a href="{{ route('academic.page', 'laporan-ketercapaian') }}"
                               class="block px-5 py-3 hover:bg-blue-50 hover:text-blue-700">
                                Laporan Ketercapaian
                            </a>

                        </div>

                    </div>

                </div>

                {{-- Fasilitas Dropdown --}}
                <div class="relative group">

                    <button type="button" class="flex items-center gap-1 hover:text-yellow-400 transition">
                        Fasilitas
                        <i class="fa-solid fa-chevron-down text-xs"></i>
                    </button>

                    <div class="absolute left-0 top-full pt-4 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300">

                        <div class="w-56 rounded-xl bg-white text-slate-800 shadow-xl border border-slate-100 overflow-hidden">

                            <a href="{{ url('/facilities') }}"
                               class="block px-5 py-3 hover:bg-blue-50 hover:text-blue-700">
                                Laboratorium
                            </a>

                            <a href="{{ url('/facilities') }}"
                               class="block px-5 py-3 hover:bg-blue-50 hover:text-blue-700">
                                Bengkel / Workshop
                            </a>

                            <a href="{{ url('/facilities') }}"
                               class="block px-5 py-3 hover:bg-blue-50 hover:text-blue-700">
                                Peralatan Praktikum
                            </a>

                        </div>

                    </div>

                </div>

                <a href="{{ url('/contact') }}"
                   class="hover:text-yellow-400 transition">
                    Kontak
                </a>

            </div>

            {{-- Mobile Hamburger --}}
            <button
                id="mobileButton"
                type="button"
                aria-label="Buka menu"
                class="md:hidden w-12 h-12 rounded-2xl bg-white/90 text-slate-900 border border-white/30 shadow-lg flex items-center justify-center hover:bg-yellow-400 transition">

                <i class="fa-solid fa-bars text-xl pointer-events-none"></i>

            </button>

        </div>

    </div>

</nav>

{{-- Mobile Overlay --}}
<div
    id="mobileOverlay"
    onclick="
        document.getElementById('mobileMenu').classList.add('translate-x-full');
        document.getElementById('mobileMenu').classList.remove('translate-x-0');
        document.getElementById('mobileOverlay').classList.add('opacity-0', 'invisible', 'pointer-events-none');
        document.getElementById('mobileOverlay').classList.remove('opacity-100');
        document.body.classList.remove('overflow-hidden');
    "
    class="fixed inset-0 z-[9998] bg-slate-950/70 backdrop-blur-sm opacity-0 invisible pointer-events-none transition-all duration-500 md:hidden">
</div>

{{-- Mobile Drawer --}}
<aside
    id="mobileMenu"
    class="fixed top-0 right-0 z-[9999] w-[86%] max-w-sm h-screen bg-white shadow-2xl translate-x-full transition-transform duration-500 ease-in-out md:hidden overflow-y-auto">

    {{-- Header --}}
    <div class="relative overflow-hidden bg-gradient-to-br from-[#003B73] via-[#005BAC] to-[#003B73] px-6 pt-7 pb-8">

        <div class="absolute inset-0 pointer-events-none opacity-20 bg-[linear-gradient(to_right,rgba(255,255,255,.18)_1px,transparent_1px),linear-gradient(to_bottom,rgba(255,255,255,.18)_1px,transparent_1px)] bg-[size:42px_42px]"></div>

        <button
            id="closeMenu"
            type="button"
            aria-label="Tutup menu"
            onclick="
                document.getElementById('mobileMenu').classList.add('translate-x-full');
                document.getElementById('mobileMenu').classList.remove('translate-x-0');
                document.getElementById('mobileOverlay').classList.add('opacity-0', 'invisible', 'pointer-events-none');
                document.getElementById('mobileOverlay').classList.remove('opacity-100');
                document.body.classList.remove('overflow-hidden');
            "
            class="absolute top-5 right-5 z-[10050] pointer-events-auto w-11 h-11 rounded-2xl bg-white/15 border border-white/20 text-white flex items-center justify-center hover:bg-yellow-400 hover:text-slate-900 transition">

            <i class="fa-solid fa-xmark text-xl pointer-events-none"></i>

        </button>

        <div class="relative flex items-center gap-4 pr-12">

            <div class="w-16 h-16 rounded-2xl bg-white p-2 shadow-lg">
                <img
                    src="{{ asset('assets/images/logo.png') }}"
                    alt="Logo Polinema"
                    class="w-full h-full object-contain">
            </div>

            <div>

                <h3 class="text-white font-extrabold leading-tight">
                    Teknik Otomotif Elektronik
                </h3>

                <p class="text-yellow-300 text-sm font-semibold mt-1">
                    Polinema
                </p>

            </div>

        </div>

        <div class="relative mt-7 inline-flex items-center gap-2 rounded-full bg-yellow-400/20 border border-yellow-300/30 px-4 py-2 text-yellow-200 text-xs font-bold tracking-wider">
            <span class="w-2 h-2 rounded-full bg-yellow-300"></span>
            WEBSITE PROGRAM STUDI
        </div>

    </div>

    {{-- Content --}}
    <div class="px-5 py-6">


        <div class="space-y-2">

            <a href="{{ route('home') }}"
               class="mobile-nav-link flex items-center gap-4 px-4 py-4 rounded-2xl text-slate-700 font-semibold hover:bg-blue-50 hover:text-blue-700 transition">

                <span class="w-10 h-10 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center">
                    <i class="fa-solid fa-house"></i>
                </span>

                Beranda
            </a>

            <a href="{{ route('profile') }}"
               class="mobile-nav-link flex items-center gap-4 px-4 py-4 rounded-2xl text-slate-700 font-semibold hover:bg-blue-50 hover:text-blue-700 transition">

                <span class="w-10 h-10 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center">
                    <i class="fa-solid fa-building-columns"></i>
                </span>

                Profil TOE
            </a>

            <a href="{{ route('lecturers') }}"
               class="mobile-nav-link flex items-center gap-4 px-4 py-4 rounded-2xl text-slate-700 font-semibold hover:bg-blue-50 hover:text-blue-700 transition">

                <span class="w-10 h-10 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center">
                    <i class="fa-solid fa-users"></i>
                </span>

                Dosen & Staff
            </a>

        </div>

        {{-- Akademik --}}
        <div class="mt-8">

            <p class="text-xs font-bold tracking-[4px] text-yellow-600 uppercase mb-4">
                Akademik
            </p>

            <div class="rounded-3xl bg-slate-50 border border-slate-100 p-3 space-y-1">

                <a href="{{ route('academic.page', 'pedoman-akademik') }}"
                   class="mobile-nav-link block px-4 py-3 rounded-2xl text-slate-700 font-semibold hover:bg-white hover:text-blue-700 hover:shadow transition">
                    Pedoman Akademik
                </a>

                <a href="{{ route('academic.page', 'kalender-akademik') }}"
                   class="mobile-nav-link block px-4 py-3 rounded-2xl text-slate-700 font-semibold hover:bg-white hover:text-blue-700 hover:shadow transition">
                    Kalender Akademik
                </a>

                <a href="{{ route('academic.page', 'kurikulum') }}"
                   class="mobile-nav-link block px-4 py-3 rounded-2xl text-slate-700 font-semibold hover:bg-white hover:text-blue-700 hover:shadow transition">
                    Kurikulum
                </a>

                <a href="{{ route('academic.page', 'jadwal-kuliah') }}"
                   class="mobile-nav-link block px-4 py-3 rounded-2xl text-slate-700 font-semibold hover:bg-white hover:text-blue-700 hover:shadow transition">
                    Jadwal Kuliah
                </a>

                <a href="{{ route('academic.page', 'laporan-ketercapaian') }}"
                   class="mobile-nav-link block px-4 py-3 rounded-2xl text-slate-700 font-semibold hover:bg-white hover:text-blue-700 hover:shadow transition">
                    Laporan Ketercapaian
                </a>

            </div>

        </div>

        {{-- Fasilitas --}}
        <div class="mt-8">

            <p class="text-xs font-bold tracking-[4px] text-blue-700 uppercase mb-4">
                Fasilitas
            </p>

            <div class="rounded-3xl bg-slate-50 border border-slate-100 p-3 space-y-1">

                <a href="{{ url('/facilities') }}"
                   class="mobile-nav-link block px-4 py-3 rounded-2xl text-slate-700 font-semibold hover:bg-white hover:text-blue-700 hover:shadow transition">
                    Laboratorium
                </a>

                <a href="{{ url('/facilities') }}"
                   class="mobile-nav-link block px-4 py-3 rounded-2xl text-slate-700 font-semibold hover:bg-white hover:text-blue-700 hover:shadow transition">
                    Bengkel / Workshop
                </a>

                <a href="{{ url('/facilities') }}"
                   class="mobile-nav-link block px-4 py-3 rounded-2xl text-slate-700 font-semibold hover:bg-white hover:text-blue-700 hover:shadow transition">
                    Peralatan Praktikum
                </a>

            </div>

        </div>

        {{-- Contact --}}
        <div class="mt-8">

            <a href="{{ url('/contact') }}"
               class="mobile-nav-link flex items-center justify-center gap-3 w-full px-5 py-4 rounded-2xl bg-gradient-to-r from-blue-700 to-blue-600 text-white font-bold shadow-lg hover:shadow-xl transition">

                <i class="fa-solid fa-envelope"></i>
                Kontak Kami

            </a>

        </div>

        <div class="mt-8 rounded-3xl bg-gradient-to-br from-slate-900 to-slate-800 p-5 text-white">

            <p class="font-bold">
                Program Studi TOE
            </p>

            <p class="text-sm text-slate-300 mt-2 leading-6">
                Jurusan Teknik Mesin<br>
                Politeknik Negeri Malang
            </p>

        </div>

    </div>

</aside>