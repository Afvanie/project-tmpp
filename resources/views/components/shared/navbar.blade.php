<nav
    id="navbar"
    class="fixed left-0 top-0 z-[9000] w-full
           text-white transition-all duration-300"
>
    <div class="mx-auto max-w-7xl px-5 sm:px-6">
        <div class="flex h-20 items-center justify-between">

            {{-- ===================================================== --}}
            {{-- LOGO DAN IDENTITAS --}}
            {{-- ===================================================== --}}

            <a
                href="{{ route('home') }}"
                class="flex min-w-0 items-center gap-3"
                aria-label="Beranda D-IV TMPP Polinema"
            >
                <div
                    class="h-12 w-12 shrink-0 rounded-2xl
                           bg-white/90 p-1.5 shadow-lg"
                >
                    <img
                        src="{{ asset('assets/images/logo.png') }}"
                        alt="Logo Politeknik Negeri Malang"
                        class="h-full w-full object-contain"
                    >
                </div>

                <div class="min-w-0 leading-tight">
                    <h1
                        class="text-[13px] font-extrabold
                               uppercase leading-[1.15]
                               tracking-tight sm:text-sm
                               lg:text-lg xl:text-xl"
                    >
                        D-IV TMPP
                    </h1>

                    {{-- Mobile --}}
                    <p
                        class="mt-0.5 text-[10px]
                               font-semibold opacity-90
                               sm:text-[11px] lg:hidden"
                    >
                        POLINEMA
                    </p>

                    {{-- Desktop --}}
                    <p
                        class="mt-0.5 hidden max-w-[260px]
                               truncate text-xs font-semibold
                               opacity-90 lg:block xl:text-sm"
                    >
                        Teknik Mesin Produksi dan Perawatan
                    </p>
                </div>
            </a>


            {{-- ===================================================== --}}
            {{-- DESKTOP MENU --}}
            {{-- ===================================================== --}}

            <div
                class="hidden items-center gap-5
                       text-sm font-semibold lg:flex xl:gap-7 xl:text-base"
            >
                <a
                    href="{{ route('home') }}"
                    class="transition
                           {{ request()->routeIs('home')
                                ? 'text-yellow-400'
                                : 'hover:text-yellow-400' }}"
                >
                    Beranda
                </a>

                <a
                    href="{{ route('profile') }}"
                    class="transition
                           {{ request()->routeIs('profile')
                                || request()->is('profile*')
                                ? 'text-yellow-400'
                                : 'hover:text-yellow-400' }}"
                >
                    Profil TMPP
                </a>

                <a
                    href="{{ route('lecturers') }}"
                    class="whitespace-nowrap transition
                           {{ request()->routeIs('lecturers')
                                ? 'text-yellow-400'
                                : 'hover:text-yellow-400' }}"
                >
                    Dosen &amp; Staf
                </a>


                {{-- ================================================= --}}
                {{-- DROPDOWN AKADEMIK --}}
                {{-- ================================================= --}}

                <div class="group relative">
                    <button
                        type="button"
                        class="flex items-center gap-1 transition
                               {{ request()->routeIs('academic.*')
                                    || request()->is('academic*')
                                    ? 'text-yellow-400'
                                    : 'hover:text-yellow-400' }}"
                        aria-haspopup="true"
                    >
                        Akademik

                        <i
                            class="fa-solid fa-chevron-down
                                   text-xs transition-transform
                                   duration-300 group-hover:rotate-180"
                            aria-hidden="true"
                        ></i>
                    </button>

                    <div
                        class="invisible absolute left-0 top-full
                               pt-4 opacity-0 transition-all
                               duration-300
                               group-hover:visible
                               group-hover:opacity-100"
                    >
                        <div
                            class="w-64 overflow-hidden rounded-xl
                                   border border-slate-100 bg-white
                                   text-slate-800 shadow-xl"
                        >
                            <a
                                href="{{ route('academic.page', 'pedoman-akademik') }}"
                                class="block px-5 py-3
                                       hover:bg-blue-50
                                       hover:text-blue-700"
                            >
                                Pedoman Akademik
                            </a>

                            <a
                                href="{{ route('academic.page', 'kalender-akademik') }}"
                                class="block px-5 py-3
                                       hover:bg-blue-50
                                       hover:text-blue-700"
                            >
                                Kalender Akademik
                            </a>

                            <a
                                href="{{ route('academic.page', 'kurikulum') }}"
                                class="block px-5 py-3
                                       hover:bg-blue-50
                                       hover:text-blue-700"
                            >
                                Kurikulum
                            </a>

                            <a
                                href="{{ route('academic.page', 'jadwal-kuliah') }}"
                                class="block px-5 py-3
                                       hover:bg-blue-50
                                       hover:text-blue-700"
                            >
                                Jadwal Kuliah
                            </a>

                            <a
                                href="{{ route('academic.page', 'laporan-ketercapaian') }}"
                                class="block px-5 py-3
                                       hover:bg-blue-50
                                       hover:text-blue-700"
                            >
                                Laporan Ketercapaian
                            </a>

                            <a
                                href="{{ route('academic.page', 'panduan-laporan-tugas-akhir') }}"
                                class="block px-5 py-3
                                       hover:bg-blue-50
                                       hover:text-blue-700"
                            >
                                Panduan Tugas Akhir
                            </a>

                            <a
                                href="{{ route('academic.page', 'panduan-laporan-pkl') }}"
                                class="block px-5 py-3
                                       hover:bg-blue-50
                                       hover:text-blue-700"
                            >
                                Panduan Magang Industri
                            </a>
                        </div>
                    </div>
                </div>


                {{-- ================================================= --}}
                {{-- FASILITAS --}}
                {{-- ================================================= --}}

                <a
                    href="{{ url('/facilities') }}"
                    class="transition
                           {{ request()->is('facilities*')
                                || request()->is('fasilitas*')
                                ? 'text-yellow-400'
                                : 'hover:text-yellow-400' }}"
                >
                    Fasilitas
                </a>


                {{-- ================================================= --}}
                {{-- KONTAK --}}
                {{-- ================================================= --}}

                <a
                    href="{{ url('/contact') }}"
                    class="transition
                           {{ request()->is('contact*')
                                || request()->is('kontak*')
                                ? 'text-yellow-400'
                                : 'hover:text-yellow-400' }}"
                >
                    Kontak
                </a>
            </div>


            {{-- ===================================================== --}}
            {{-- MOBILE HAMBURGER --}}
            {{-- ===================================================== --}}

            <button
                id="mobileButton"
                type="button"
                aria-label="Buka menu navigasi"
                aria-controls="mobileMenu"
                aria-expanded="false"
                class="flex h-12 w-12 items-center
                       justify-center rounded-2xl
                       border border-white/30
                       bg-white/90 text-slate-900
                       shadow-lg transition
                       hover:bg-yellow-400 lg:hidden"
            >
                <i
                    class="fa-solid fa-bars
                           pointer-events-none text-xl"
                    aria-hidden="true"
                ></i>
            </button>

        </div>
    </div>
</nav>


{{-- ============================================================= --}}
{{-- MOBILE OVERLAY --}}
{{-- ============================================================= --}}

<div
    id="mobileOverlay"
    onclick="
        document.getElementById('mobileMenu').classList.add('translate-x-full');
        document.getElementById('mobileMenu').classList.remove('translate-x-0');
        document.getElementById('mobileOverlay').classList.add(
            'opacity-0',
            'invisible',
            'pointer-events-none'
        );
        document.getElementById('mobileOverlay').classList.remove('opacity-100');
        document.body.classList.remove('overflow-hidden');
    "
    class="pointer-events-none invisible fixed inset-0
           z-[9998] bg-slate-950/70 opacity-0
           backdrop-blur-sm transition-all
           duration-500 lg:hidden"
></div>


{{-- ============================================================= --}}
{{-- MOBILE DRAWER --}}
{{-- ============================================================= --}}

<aside
    id="mobileMenu"
    class="fixed right-0 top-0 z-[9999]
           h-screen w-[86%] max-w-sm
           translate-x-full overflow-y-auto
           bg-white shadow-2xl
           transition-transform duration-500
           ease-in-out lg:hidden"
    aria-label="Menu navigasi mobile"
>
    {{-- ========================================================= --}}
    {{-- MOBILE HEADER --}}
    {{-- ========================================================= --}}

    <div
        class="relative overflow-hidden
               bg-gradient-to-br
               from-[#003B73] via-[#005BAC]
               to-[#003B73]
               px-6 pb-8 pt-7"
    >
        <div
            class="pointer-events-none absolute inset-0
                   bg-[linear-gradient(to_right,rgba(255,255,255,.18)_1px,transparent_1px),linear-gradient(to_bottom,rgba(255,255,255,.18)_1px,transparent_1px)]
                   bg-[size:42px_42px] opacity-20"
            aria-hidden="true"
        ></div>

        <button
            id="closeMenu"
            type="button"
            aria-label="Tutup menu navigasi"
            onclick="
                document.getElementById('mobileMenu').classList.add('translate-x-full');
                document.getElementById('mobileMenu').classList.remove('translate-x-0');
                document.getElementById('mobileOverlay').classList.add(
                    'opacity-0',
                    'invisible',
                    'pointer-events-none'
                );
                document.getElementById('mobileOverlay').classList.remove('opacity-100');
                document.body.classList.remove('overflow-hidden');
            "
            class="pointer-events-auto absolute
                   right-5 top-5 z-[10050]
                   flex h-11 w-11 items-center
                   justify-center rounded-2xl
                   border border-white/20
                   bg-white/15 text-white
                   transition hover:bg-yellow-400
                   hover:text-slate-900"
        >
            <i
                class="fa-solid fa-xmark
                       pointer-events-none text-xl"
                aria-hidden="true"
            ></i>
        </button>

        <div class="relative flex items-center gap-4 pr-12">
            <div
                class="h-16 w-16 shrink-0
                       rounded-2xl bg-white
                       p-2 shadow-lg"
            >
                <img
                    src="{{ asset('assets/images/logo.png') }}"
                    alt="Logo Politeknik Negeri Malang"
                    class="h-full w-full object-contain"
                >
            </div>

            <div class="min-w-0">
                <h3
                    class="font-extrabold leading-tight
                           text-white"
                >
                    D-IV TMPP
                </h3>

                <p
                    class="mt-1 text-sm font-semibold
                           leading-5 text-yellow-300"
                >
                    Teknik Mesin Produksi<br>
                    dan Perawatan
                </p>
            </div>
        </div>

        <div
            class="relative mt-7 inline-flex
                   items-center gap-2 rounded-full
                   border border-yellow-300/30
                   bg-yellow-400/20 px-4 py-2
                   text-xs font-bold tracking-wider
                   text-yellow-200"
        >
            <span
                class="h-2 w-2 rounded-full
                       bg-yellow-300"
            ></span>

            WEBSITE PROGRAM STUDI
        </div>
    </div>


    {{-- ========================================================= --}}
    {{-- MOBILE CONTENT --}}
    {{-- ========================================================= --}}

    <div class="px-5 py-6">

        {{-- MAIN MENU --}}
        <div class="space-y-2">

            <a
                href="{{ route('home') }}"
                class="mobile-nav-link flex items-center
                       gap-4 rounded-2xl px-4 py-4
                       font-semibold text-slate-700
                       transition hover:bg-blue-50
                       hover:text-blue-700"
            >
                <span
                    class="flex h-10 w-10 shrink-0
                           items-center justify-center
                           rounded-xl bg-blue-100
                           text-blue-700"
                >
                    <i
                        class="fa-solid fa-house"
                        aria-hidden="true"
                    ></i>
                </span>

                Beranda
            </a>

            <a
                href="{{ route('profile') }}"
                class="mobile-nav-link flex items-center
                       gap-4 rounded-2xl px-4 py-4
                       font-semibold text-slate-700
                       transition hover:bg-blue-50
                       hover:text-blue-700"
            >
                <span
                    class="flex h-10 w-10 shrink-0
                           items-center justify-center
                           rounded-xl bg-blue-100
                           text-blue-700"
                >
                    <i
                        class="fa-solid fa-building-columns"
                        aria-hidden="true"
                    ></i>
                </span>

                Profil TMPP
            </a>

            <a
                href="{{ route('lecturers') }}"
                class="mobile-nav-link flex items-center
                       gap-4 rounded-2xl px-4 py-4
                       font-semibold text-slate-700
                       transition hover:bg-blue-50
                       hover:text-blue-700"
            >
                <span
                    class="flex h-10 w-10 shrink-0
                           items-center justify-center
                           rounded-xl bg-blue-100
                           text-blue-700"
                >
                    <i
                        class="fa-solid fa-users"
                        aria-hidden="true"
                    ></i>
                </span>

                Dosen &amp; Staf
            </a>

            <a
                href="{{ url('/facilities') }}"
                class="mobile-nav-link flex items-center
                       gap-4 rounded-2xl px-4 py-4
                       font-semibold text-slate-700
                       transition hover:bg-blue-50
                       hover:text-blue-700"
            >
                <span
                    class="flex h-10 w-10 shrink-0
                           items-center justify-center
                           rounded-xl bg-blue-100
                           text-blue-700"
                >
                    <i
                        class="fa-solid fa-screwdriver-wrench"
                        aria-hidden="true"
                    ></i>
                </span>

                Fasilitas
            </a>
        </div>


        {{-- ===================================================== --}}
        {{-- AKADEMIK MOBILE --}}
        {{-- ===================================================== --}}

        <div class="mt-8">
            <p
                class="mb-4 text-xs font-bold
                       uppercase tracking-[4px]
                       text-yellow-600"
            >
                Akademik
            </p>

            <div
                class="space-y-1 rounded-3xl
                       border border-slate-100
                       bg-slate-50 p-3"
            >
                <a
                    href="{{ route('academic.page', 'pedoman-akademik') }}"
                    class="mobile-nav-link block w-full
                           rounded-2xl px-4 py-3
                           text-[15px] font-semibold
                           leading-6 text-slate-700
                           transition hover:bg-white
                           hover:text-blue-700
                           hover:shadow"
                >
                    Pedoman Akademik
                </a>

                <a
                    href="{{ route('academic.page', 'kalender-akademik') }}"
                    class="mobile-nav-link block w-full
                           rounded-2xl px-4 py-3
                           text-[15px] font-semibold
                           leading-6 text-slate-700
                           transition hover:bg-white
                           hover:text-blue-700
                           hover:shadow"
                >
                    Kalender Akademik
                </a>

                <a
                    href="{{ route('academic.page', 'kurikulum') }}"
                    class="mobile-nav-link block w-full
                           rounded-2xl px-4 py-3
                           text-[15px] font-semibold
                           leading-6 text-slate-700
                           transition hover:bg-white
                           hover:text-blue-700
                           hover:shadow"
                >
                    Kurikulum
                </a>

                <a
                    href="{{ route('academic.page', 'jadwal-kuliah') }}"
                    class="mobile-nav-link block w-full
                           rounded-2xl px-4 py-3
                           text-[15px] font-semibold
                           leading-6 text-slate-700
                           transition hover:bg-white
                           hover:text-blue-700
                           hover:shadow"
                >
                    Jadwal Kuliah
                </a>

                <a
                    href="{{ route('academic.page', 'laporan-ketercapaian') }}"
                    class="mobile-nav-link block w-full
                           rounded-2xl px-4 py-3
                           text-[15px] font-semibold
                           leading-6 text-slate-700
                           transition hover:bg-white
                           hover:text-blue-700
                           hover:shadow"
                >
                    Laporan Ketercapaian
                </a>

                <a
                    href="{{ route('academic.page', 'panduan-laporan-tugas-akhir') }}"
                    class="mobile-nav-link block w-full
                           rounded-2xl px-4 py-3
                           text-[15px] font-semibold
                           leading-6 text-slate-700
                           transition hover:bg-white
                           hover:text-blue-700
                           hover:shadow"
                >
                    Panduan Tugas Akhir
                </a>

                <a
                    href="{{ route('academic.page', 'panduan-laporan-pkl') }}"
                    class="mobile-nav-link block w-full
                           rounded-2xl px-4 py-3
                           text-[15px] font-semibold
                           leading-6 text-slate-700
                           transition hover:bg-white
                           hover:text-blue-700
                           hover:shadow"
                >
                    Panduan Magang Industri
                </a>
            </div>
        </div>


        {{-- ===================================================== --}}
        {{-- KONTAK MOBILE --}}
        {{-- ===================================================== --}}

        <div class="mt-8">
            <a
                href="{{ url('/contact') }}"
                class="mobile-nav-link flex w-full
                       items-center justify-center gap-3
                       rounded-2xl bg-gradient-to-r
                       from-blue-700 to-blue-600
                       px-5 py-4 font-bold text-white
                       shadow-lg transition
                       hover:shadow-xl"
            >
                <i
                    class="fa-solid fa-envelope"
                    aria-hidden="true"
                ></i>

                Kontak Kami
            </a>
        </div>


        {{-- ===================================================== --}}
        {{-- IDENTITAS PROGRAM STUDI --}}
        {{-- ===================================================== --}}

        <div
            class="mt-8 rounded-3xl
                   bg-gradient-to-br
                   from-slate-900 to-slate-800
                   p-5 text-white"
        >
            <p class="font-bold leading-6">
                Program Studi D-IV Teknik Mesin
                Produksi dan Perawatan
            </p>

            <p
                class="mt-2 text-sm leading-6
                       text-slate-300"
            >
                Jurusan Teknik Mesin<br>
                Politeknik Negeri Malang
            </p>
        </div>
    </div>
</aside>