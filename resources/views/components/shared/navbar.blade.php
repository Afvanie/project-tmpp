@php
    $isHomeActive = request()->routeIs('home');

    $isProfileActive = request()->routeIs('profile')
        || request()->is('profile*');

    $isLecturersActive = request()->routeIs('lecturers')
        || request()->is('lecturers*')
        || request()->is('dosen-staf*')
        || request()->is('dosen-staff*');

    $isAcademicActive = request()->routeIs('academic')
        || request()->routeIs('academic.*')
        || request()->is('academic*');

    $isFacilitiesActive = request()->is('facilities*')
        || request()->is('fasilitas*');

    $isContactActive = request()->is('contact*')
        || request()->is('kontak*');

    $mainMenus = [
        [
            'label' => 'Beranda',
            'url' => route('home'),
            'icon' => 'fa-house',
            'active' => $isHomeActive,
        ],
        [
            'label' => 'Profil TMPP',
            'desktop_label' => 'Profil',
            'url' => route('profile'),
            'icon' => 'fa-building-columns',
            'active' => $isProfileActive,
        ],
        [
            'label' => 'Dosen & Staf',
            'url' => route('lecturers'),
            'icon' => 'fa-users',
            'active' => $isLecturersActive,
        ],
        [
            'label' => 'Fasilitas',
            'url' => url('/facilities'),
            'icon' => 'fa-screwdriver-wrench',
            'active' => $isFacilitiesActive,
        ],
    ];

    $academicMenus = [
        [
            'label' => 'Pedoman Akademik',
            'slug' => 'pedoman-akademik',
            'icon' => 'fa-book-open',
        ],
        [
            'label' => 'Kalender Akademik',
            'slug' => 'kalender-akademik',
            'icon' => 'fa-calendar-days',
        ],
        [
            'label' => 'Kurikulum',
            'slug' => 'kurikulum',
            'icon' => 'fa-layer-group',
        ],
        [
            'label' => 'Jadwal Kuliah',
            'slug' => 'jadwal-kuliah',
            'icon' => 'fa-clock',
        ],
        [
            'label' => 'Laporan Ketercapaian',
            'slug' => 'laporan-ketercapaian',
            'icon' => 'fa-chart-line',
        ],
        [
            'label' => 'Panduan Tugas Akhir',
            'slug' => 'panduan-laporan-tugas-akhir',
            'icon' => 'fa-file-pen',
        ],
        [
            'label' => 'Panduan Magang Industri',
            'slug' => 'panduan-laporan-pkl',
            'icon' => 'fa-industry',
        ],
    ];

    $logoPath = 'assets/images/logo.png';

    $logoExists = file_exists(
        public_path($logoPath)
    );
@endphp


@once
    <style>
        #siteHeader {
            transition:
                background-color 300ms ease,
                box-shadow 300ms ease,
                backdrop-filter 300ms ease;
        }

        #siteHeader .site-header-surface {
            transition:
                background 300ms ease,
                border-color 300ms ease,
                box-shadow 300ms ease,
                backdrop-filter 300ms ease;
        }

        /*
        |--------------------------------------------------------------------------
        | NAVBAR BERADA DI ATAS BANNER
        |--------------------------------------------------------------------------
        */

        #siteHeader.site-header-transparent .site-header-surface {
            background:
                linear-gradient(
                    180deg,
                    rgba(2, 20, 38, 0.58) 0%,
                    rgba(2, 20, 38, 0.20) 65%,
                    rgba(2, 20, 38, 0) 100%
                );

            border-color: transparent;
            box-shadow: none;
            backdrop-filter: none;
            -webkit-backdrop-filter: none;
        }

        #siteHeader.site-header-transparent .site-topbar {
            max-height: 32px;
            opacity: 1;
        }

        #siteHeader.site-header-transparent .site-header-main {
            height: 76px;
        }

        /*
        |--------------------------------------------------------------------------
        | NAVBAR SETELAH BANNER DILEWATI
        |--------------------------------------------------------------------------
        */

        #siteHeader.site-header-solid .site-header-surface {
            background:
                linear-gradient(
                    90deg,
                    rgba(7, 55, 99, 0.98) 0%,
                    rgba(7, 95, 155, 0.98) 52%,
                    rgba(11, 103, 165, 0.98) 100%
                );

            border-color: rgba(255, 255, 255, 0.14);

            box-shadow:
                0 12px 34px
                rgba(2, 20, 40, 0.20);

            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
        }

        #siteHeader.site-header-solid .site-topbar {
            max-height: 0;
            opacity: 0;
            border-color: transparent;
        }

        #siteHeader.site-header-solid .site-header-main {
            height: 66px;
        }

        /*
        |--------------------------------------------------------------------------
        | MENU DESKTOP
        |--------------------------------------------------------------------------
        */

        #siteHeader .desktop-nav-link {
            color: rgba(255, 255, 255, 0.90);
        }

        #siteHeader .desktop-nav-link:hover {
            color: #ffffff;
            background: rgba(255, 255, 255, 0.12);
        }

        #siteHeader .desktop-nav-link.is-active {
            color: #f7dc7a;
            background: rgba(255, 255, 255, 0.14);
        }
    </style>
@endonce


<header
    id="siteHeader"
    class="site-header-transparent
           fixed inset-x-0 top-0
           z-[9000] w-full"
>
    <div
        class="site-header-surface
               border-b border-transparent"
    >
        {{-- ===================================================== --}}
        {{-- TOP BAR --}}
        {{-- ===================================================== --}}

        <div
            class="site-topbar hidden
                   overflow-hidden border-b
                   border-white/10 opacity-100
                   transition-all duration-300
                   sm:block"
        >
            <div
                class="mx-auto flex h-8
                       max-w-7xl items-center
                       justify-between px-6"
            >
                <p
                    class="text-[10px] font-semibold
                           uppercase tracking-[0.18em]
                           text-white/90"
                >
                    Politeknik Negeri Malang
                </p>

                <p
                    class="text-[10px] font-medium
                           text-white/80"
                >
                    Jurusan Teknik Mesin

                    <span
                        class="mx-2 text-[#F4D66E]"
                        aria-hidden="true"
                    >
                        •
                    </span>

                    Program Sarjana Terapan
                </p>
            </div>
        </div>


        {{-- ===================================================== --}}
        {{-- NAVBAR UTAMA --}}
        {{-- ===================================================== --}}

        <nav aria-label="Navigasi utama">
            <div
                class="mx-auto max-w-7xl
                       px-5 sm:px-6"
            >
                <div
                    class="site-header-main
                           flex items-center
                           justify-between
                           transition-all duration-300"
                >
                    {{-- ========================================= --}}
                    {{-- LOGO DAN IDENTITAS --}}
                    {{-- ========================================= --}}

                    <a
                        href="{{ route('home') }}"
                        class="group flex min-w-0
                               items-center gap-3"
                        aria-label="Beranda Program Studi D-IV TMPP"
                    >
                        <div
                            class="flex h-12 w-12
                                   shrink-0 items-center
                                   justify-center rounded-xl
                                   bg-white p-1.5
                                   shadow-lg transition
                                   duration-300
                                   group-hover:-translate-y-0.5"
                        >
                            @if ($logoExists)
                                <img
                                    src="{{ asset($logoPath) }}"
                                    alt="Logo Politeknik Negeri Malang"
                                    class="h-full w-full object-contain"
                                >
                            @else
                                <span
                                    class="font-extrabold
                                           text-[#073763]"
                                >
                                    TM
                                </span>
                            @endif
                        </div>

                        <div class="min-w-0 leading-tight">
                            <div
                                class="flex items-center gap-2"
                            >
                                <h1
                                    class="truncate text-base
                                           font-extrabold
                                           tracking-tight
                                           text-white
                                           drop-shadow-sm
                                           sm:text-lg"
                                >
                                    D-IV TMPP
                                </h1>

                                <span
                                    class="hidden h-1.5 w-1.5
                                           rounded-full
                                           bg-[#F4D66E]
                                           sm:block"
                                    aria-hidden="true"
                                ></span>
                            </div>

                            <p
                                class="mt-1 max-w-[190px]
                                       truncate text-[10px]
                                       font-medium
                                       text-white/85
                                       drop-shadow-sm
                                       sm:max-w-[280px]
                                       sm:text-[11px]"
                            >
                                Teknik Mesin Produksi dan Perawatan
                            </p>
                        </div>
                    </a>


                    {{-- ========================================= --}}
                    {{-- MENU DESKTOP --}}
                    {{-- ========================================= --}}

                    <div
                        class="hidden items-center gap-1
                               lg:flex"
                    >
                        <a
                            href="{{ route('home') }}"
                            class="desktop-nav-link
                                   {{ $isHomeActive
                                        ? 'is-active'
                                        : '' }}
                                   rounded-lg px-3.5 py-2.5
                                   text-sm font-semibold
                                   transition duration-300"
                        >
                            Beranda
                        </a>

                        <a
                            href="{{ route('profile') }}"
                            class="desktop-nav-link
                                   {{ $isProfileActive
                                        ? 'is-active'
                                        : '' }}
                                   rounded-lg px-3.5 py-2.5
                                   text-sm font-semibold
                                   transition duration-300"
                        >
                            Profil
                        </a>

                        <a
                            href="{{ route('lecturers') }}"
                            class="desktop-nav-link
                                   {{ $isLecturersActive
                                        ? 'is-active'
                                        : '' }}
                                   whitespace-nowrap
                                   rounded-lg px-3.5 py-2.5
                                   text-sm font-semibold
                                   transition duration-300"
                        >
                            Dosen &amp; Staf
                        </a>


                        {{-- ===================================== --}}
                        {{-- AKADEMIK DESKTOP --}}
                        {{-- ===================================== --}}

                        <div class="group relative">
                            <button
                                type="button"
                                class="desktop-nav-link
                                       {{ $isAcademicActive
                                            ? 'is-active'
                                            : '' }}
                                       flex items-center gap-2
                                       rounded-lg px-3.5 py-2.5
                                       text-sm font-semibold
                                       transition duration-300"
                                aria-haspopup="true"
                            >
                                Akademik

                                <i
                                    class="fa-solid
                                           fa-chevron-down
                                           text-[10px]
                                           transition-transform
                                           duration-300
                                           group-hover:rotate-180
                                           group-focus-within:rotate-180"
                                    aria-hidden="true"
                                ></i>
                            </button>

                            <div
                                class="invisible absolute
                                       right-0 top-full
                                       w-[330px]
                                       translate-y-2 pt-3
                                       opacity-0 transition-all
                                       duration-300
                                       group-hover:visible
                                       group-hover:translate-y-0
                                       group-hover:opacity-100
                                       group-focus-within:visible
                                       group-focus-within:translate-y-0
                                       group-focus-within:opacity-100"
                            >
                                <div
                                    class="overflow-hidden
                                           rounded-2xl border
                                           border-slate-200
                                           bg-white p-2
                                           shadow-2xl"
                                >
                                    <div
                                        class="mb-2 rounded-xl
                                               bg-gradient-to-r
                                               from-[#073763]
                                               to-[#0B67A5]
                                               px-5 py-4"
                                    >
                                        <p
                                            class="text-xs font-bold
                                                   uppercase
                                                   tracking-[0.18em]
                                                   text-[#F4D66E]"
                                        >
                                            Akademik TMPP
                                        </p>

                                        <p
                                            class="mt-1 text-xs
                                                   leading-5
                                                   text-white/80"
                                        >
                                            Informasi dan dokumen
                                            akademik program studi.
                                        </p>
                                    </div>

                                    <div class="grid gap-1">
                                        @foreach (
                                            $academicMenus as $menu
                                        )
                                            <a
                                                href="{{ route(
                                                    'academic.page',
                                                    $menu['slug']
                                                ) }}"
                                                class="flex items-center
                                                       gap-3 rounded-xl
                                                       px-3 py-2.5
                                                       text-sm font-semibold
                                                       text-slate-700
                                                       transition
                                                       hover:bg-blue-50
                                                       hover:text-[#075F9B]"
                                            >
                                                <span
                                                    class="flex h-9 w-9
                                                           shrink-0
                                                           items-center
                                                           justify-center
                                                           rounded-lg
                                                           bg-blue-50
                                                           text-[#075F9B]"
                                                >
                                                    <i
                                                        class="fa-solid
                                                               {{ $menu[
                                                                   'icon'
                                                               ] }}"
                                                        aria-hidden="true"
                                                    ></i>
                                                </span>

                                                {{ $menu['label'] }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>


                        <a
                            href="{{ url('/facilities') }}"
                            class="desktop-nav-link
                                   {{ $isFacilitiesActive
                                        ? 'is-active'
                                        : '' }}
                                   rounded-lg px-3.5 py-2.5
                                   text-sm font-semibold
                                   transition duration-300"
                        >
                            Fasilitas
                        </a>


                        <a
                            href="{{ url('/contact') }}"
                            class="ml-2 inline-flex
                                   items-center gap-2
                                   rounded-lg bg-[#D7B33E]
                                   px-5 py-2.5
                                   text-sm font-bold
                                   text-slate-900
                                   shadow-md transition
                                   duration-300
                                   hover:-translate-y-0.5
                                   hover:bg-[#F0D570]
                                   {{ $isContactActive
                                        ? 'ring-2 ring-white/40'
                                        : '' }}"
                        >
                            <i
                                class="fa-regular fa-envelope"
                                aria-hidden="true"
                            ></i>

                            Kontak
                        </a>
                    </div>


                    {{-- ========================================= --}}
                    {{-- TOMBOL MOBILE --}}
                    {{-- ========================================= --}}

                    <button
                        id="mobileButton"
                        type="button"
                        aria-label="Buka menu navigasi"
                        aria-controls="mobileMenu"
                        aria-expanded="false"
                        class="flex h-11 w-11
                               items-center justify-center
                               rounded-xl border
                               border-white/30
                               bg-white/10 text-white
                               backdrop-blur-sm
                               transition duration-300
                               hover:bg-[#D7B33E]
                               hover:text-slate-900
                               lg:hidden"
                    >
                        <i
                            class="fa-solid fa-bars
                                   pointer-events-none
                                   text-lg"
                            aria-hidden="true"
                        ></i>
                    </button>
                </div>
            </div>
        </nav>
    </div>
</header>


{{-- ============================================================= --}}
{{-- OVERLAY MOBILE --}}
{{-- ============================================================= --}}

<div
    id="mobileOverlay"
    class="pointer-events-none invisible
           fixed inset-0 z-[9998]
           bg-slate-950/60 opacity-0
           backdrop-blur-sm
           transition-all duration-300
           lg:hidden"
></div>


{{-- ============================================================= --}}
{{-- DRAWER MOBILE --}}
{{-- ============================================================= --}}

<aside
    id="mobileMenu"
    class="fixed right-0 top-0 z-[9999]
           h-screen w-[88%] max-w-sm
           translate-x-full overflow-y-auto
           bg-white shadow-2xl
           transition-transform duration-500
           ease-out lg:hidden"
    aria-label="Menu navigasi mobile"
>
    <div
        class="relative overflow-hidden
               bg-gradient-to-br
               from-[#073763]
               via-[#075F9B]
               to-[#0B67A5]
               px-6 pb-8 pt-7"
    >
        <div
            class="pointer-events-none
                   absolute -right-16 -top-16
                   h-44 w-44 rounded-full
                   bg-[#D4AF37]/25 blur-2xl"
            aria-hidden="true"
        ></div>

        <button
            id="closeMenu"
            type="button"
            aria-label="Tutup menu navigasi"
            class="absolute right-5 top-5
                   z-20 flex h-10 w-10
                   items-center justify-center
                   rounded-xl border
                   border-white/20
                   bg-white/10 text-white
                   transition hover:bg-white
                   hover:text-[#073763]"
        >
            <i
                class="fa-solid fa-xmark
                       pointer-events-none text-lg"
                aria-hidden="true"
            ></i>
        </button>

        <div
            class="relative z-10
                   flex items-center gap-4 pr-12"
        >
            <div
                class="flex h-14 w-14
                       shrink-0 items-center
                       justify-center rounded-xl
                       bg-white p-1.5 shadow-lg"
            >
                @if ($logoExists)
                    <img
                        src="{{ asset($logoPath) }}"
                        alt="Logo Politeknik Negeri Malang"
                        class="h-full w-full object-contain"
                    >
                @endif
            </div>

            <div class="min-w-0">
                <p
                    class="text-[9px] font-bold
                           uppercase tracking-[0.18em]
                           text-[#F4D66E]"
                >
                    Program Sarjana Terapan
                </p>

                <h2
                    class="mt-1 text-lg
                           font-extrabold text-white"
                >
                    D-IV TMPP
                </h2>

                <p
                    class="mt-1 text-[11px]
                           leading-5 text-white/80"
                >
                    Teknik Mesin Produksi dan Perawatan
                </p>
            </div>
        </div>
    </div>


    <div class="px-5 py-6">
        <p
            class="mb-3 text-[10px]
                   font-bold uppercase
                   tracking-[0.25em]
                   text-slate-400"
        >
            Menu Utama
        </p>

        <div class="space-y-2">
            @foreach ($mainMenus as $menu)
                <a
                    href="{{ $menu['url'] }}"
                    @class([
                        'mobile-nav-link flex',
                        'items-center gap-3',
                        'rounded-xl px-4 py-3.5',
                        'font-semibold transition',
                        'bg-blue-50 text-[#075F9B]' =>
                            $menu['active'],
                        'text-slate-700 hover:bg-blue-50 hover:text-[#075F9B]' =>
                            !$menu['active'],
                    ])
                >
                    <span
                        class="flex h-9 w-9
                               shrink-0 items-center
                               justify-center rounded-lg
                               bg-[#073763]
                               text-[#F4D66E]"
                    >
                        <i
                            class="fa-solid
                                   {{ $menu['icon'] }}"
                            aria-hidden="true"
                        ></i>
                    </span>

                    {{ $menu['label'] }}
                </a>
            @endforeach
        </div>


        {{-- ===================================================== --}}
        {{-- AKADEMIK MOBILE --}}
        {{-- ===================================================== --}}

        <div class="mt-7">
            <button
                id="mobileAcademicButton"
                type="button"
                aria-controls="mobileAcademicMenu"
                aria-expanded="{{ $isAcademicActive
                    ? 'true'
                    : 'false' }}"
                class="flex w-full items-center
                       justify-between rounded-xl
                       border border-slate-200
                       bg-slate-50 px-4 py-3.5
                       font-bold text-slate-700"
            >
                <span class="flex items-center gap-3">
                    <span
                        class="flex h-9 w-9
                               items-center justify-center
                               rounded-lg bg-blue-100
                               text-[#075F9B]"
                    >
                        <i
                            class="fa-solid
                                   fa-graduation-cap"
                            aria-hidden="true"
                        ></i>
                    </span>

                    Akademik
                </span>

                <i
                    id="mobileAcademicIcon"
                    class="fa-solid fa-chevron-down
                           text-xs transition-transform
                           duration-300
                           {{ $isAcademicActive
                                ? 'rotate-180'
                                : '' }}"
                    aria-hidden="true"
                ></i>
            </button>

            <div
                id="mobileAcademicMenu"
                class="{{ $isAcademicActive
                    ? 'block'
                    : 'hidden' }}
                    mt-2 rounded-xl border
                    border-slate-200 bg-white p-2"
            >
                @foreach ($academicMenus as $menu)
                    <a
                        href="{{ route(
                            'academic.page',
                            $menu['slug']
                        ) }}"
                        class="mobile-nav-link flex
                               items-center gap-3
                               rounded-lg px-3 py-3
                               text-sm font-semibold
                               text-slate-700 transition
                               hover:bg-blue-50
                               hover:text-[#075F9B]"
                    >
                        <span
                            class="flex h-8 w-8
                                   shrink-0 items-center
                                   justify-center rounded-lg
                                   bg-blue-50
                                   text-[#075F9B]"
                        >
                            <i
                                class="fa-solid
                                       {{ $menu['icon'] }}"
                                aria-hidden="true"
                            ></i>
                        </span>

                        {{ $menu['label'] }}
                    </a>
                @endforeach
            </div>
        </div>


        <a
            href="{{ url('/contact') }}"
            class="mobile-nav-link mt-7
                   flex w-full items-center
                   justify-center gap-3
                   rounded-xl bg-[#D7B33E]
                   px-5 py-4 font-bold
                   text-slate-900 shadow-md
                   transition hover:bg-[#F0D570]"
        >
            <i
                class="fa-regular fa-envelope"
                aria-hidden="true"
            ></i>

            Hubungi Program Studi
        </a>
    </div>
</aside>


{{-- ============================================================= --}}
{{-- SCRIPT NAVBAR --}}
{{-- ============================================================= --}}

@once
    <script>
        document.addEventListener(
            'DOMContentLoaded',
            function () {
                const siteHeader =
                    document.getElementById(
                        'siteHeader'
                    );

                /*
                 * Gunakan elemen dengan atribut data-navbar-banner
                 * ketika tersedia. Jika tidak, gunakan section pertama
                 * di dalam main sebagai banner halaman.
                 */
                const pageBanner =
                    document.querySelector(
                        '[data-navbar-banner]'
                    )
                    || document.querySelector(
                        'main > section:first-of-type'
                    );

                const mobileButton =
                    document.getElementById(
                        'mobileButton'
                    );

                const closeButton =
                    document.getElementById(
                        'closeMenu'
                    );

                const mobileMenu =
                    document.getElementById(
                        'mobileMenu'
                    );

                const overlay =
                    document.getElementById(
                        'mobileOverlay'
                    );

                const academicButton =
                    document.getElementById(
                        'mobileAcademicButton'
                    );

                const academicMenu =
                    document.getElementById(
                        'mobileAcademicMenu'
                    );

                const academicIcon =
                    document.getElementById(
                        'mobileAcademicIcon'
                    );

                const mobileLinks =
                    document.querySelectorAll(
                        '.mobile-nav-link'
                    );


                function updateHeader() {
                    if (!siteHeader) {
                        return;
                    }

                    /*
                     * Navbar tetap transparan selama masih berada
                     * di dalam area banner.
                     */
                    const headerHeight =
                        siteHeader.offsetHeight;

                    const bannerBottom =
                        pageBanner
                            ? pageBanner
                                .getBoundingClientRect()
                                .bottom
                            : 0;

                    const isOverBanner =
                        Boolean(pageBanner)
                        && bannerBottom
                            > headerHeight + 8;

                    siteHeader.classList.toggle(
                        'site-header-transparent',
                        isOverBanner
                    );

                    siteHeader.classList.toggle(
                        'site-header-solid',
                        !isOverBanner
                    );
                }


                function openMobileMenu() {
                    mobileMenu?.classList.remove(
                        'translate-x-full'
                    );

                    mobileMenu?.classList.add(
                        'translate-x-0'
                    );

                    overlay?.classList.remove(
                        'opacity-0',
                        'invisible',
                        'pointer-events-none'
                    );

                    overlay?.classList.add(
                        'opacity-100'
                    );

                    document.body.classList.add(
                        'overflow-hidden'
                    );

                    mobileButton?.setAttribute(
                        'aria-expanded',
                        'true'
                    );
                }


                function closeMobileMenu() {
                    mobileMenu?.classList.add(
                        'translate-x-full'
                    );

                    mobileMenu?.classList.remove(
                        'translate-x-0'
                    );

                    overlay?.classList.add(
                        'opacity-0',
                        'invisible',
                        'pointer-events-none'
                    );

                    overlay?.classList.remove(
                        'opacity-100'
                    );

                    document.body.classList.remove(
                        'overflow-hidden'
                    );

                    mobileButton?.setAttribute(
                        'aria-expanded',
                        'false'
                    );
                }


                updateHeader();

                window.addEventListener(
                    'scroll',
                    updateHeader,
                    {
                        passive: true,
                    }
                );

                window.addEventListener(
                    'resize',
                    updateHeader
                );

                mobileButton?.addEventListener(
                    'click',
                    openMobileMenu
                );

                closeButton?.addEventListener(
                    'click',
                    closeMobileMenu
                );

                overlay?.addEventListener(
                    'click',
                    closeMobileMenu
                );

                mobileLinks.forEach(function (link) {
                    link.addEventListener(
                        'click',
                        closeMobileMenu
                    );
                });


                academicButton?.addEventListener(
                    'click',
                    function () {
                        if (
                            !academicMenu
                            || !academicIcon
                        ) {
                            return;
                        }

                        const isOpen =
                            !academicMenu.classList
                                .contains('hidden');

                        academicMenu.classList.toggle(
                            'hidden',
                            isOpen
                        );

                        academicMenu.classList.toggle(
                            'block',
                            !isOpen
                        );

                        academicIcon.classList.toggle(
                            'rotate-180',
                            !isOpen
                        );

                        academicButton.setAttribute(
                            'aria-expanded',
                            isOpen
                                ? 'false'
                                : 'true'
                        );
                    }
                );


                document.addEventListener(
                    'keydown',
                    function (event) {
                        if (event.key === 'Escape') {
                            closeMobileMenu();
                        }
                    }
                );
            }
        );
    </script>
@endonce