@php
    /*
    |--------------------------------------------------------------------------
    | IDENTITAS LAYOUT
    |--------------------------------------------------------------------------
    */

    $logoRelativePath = 'assets/images/logo.png';

    $logoAvailable = file_exists(
        public_path($logoRelativePath)
    );
@endphp

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <title>
        @yield('title', 'Admin Panel') - D-IV TMPP Polinema
    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
    ])

    <link
        rel="preconnect"
        href="https://fonts.bunny.net"
    >

    <link
        href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800,900"
        rel="stylesheet"
    >

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .admin-menu-link {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 13px 16px;
            border-radius: 18px;
            font-size: 14px;
            font-weight: 700;
            transition:
                background-color 0.25s ease,
                color 0.25s ease,
                transform 0.25s ease,
                box-shadow 0.25s ease;
        }

        .admin-menu-icon {
            display: flex;
            width: 38px;
            height: 38px;
            flex-shrink: 0;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            transition:
                background-color 0.25s ease,
                color 0.25s ease;
        }

        .admin-menu-default {
            color: rgb(203 213 225);
        }

        .admin-menu-default .admin-menu-icon {
            background: rgba(255, 255, 255, 0.07);
            color: rgb(203 213 225);
        }

        .admin-menu-default:hover {
            background: rgba(255, 255, 255, 0.09);
            color: white;
            transform: translateX(4px);
        }

        .admin-menu-default:hover .admin-menu-icon {
            background: rgba(250, 204, 21, 0.18);
            color: rgb(250 204 21);
        }

        .admin-menu-active {
            background: linear-gradient(
                135deg,
                #2563eb,
                #1d4ed8
            );
            color: white;
            box-shadow: 0 18px 35px rgba(37, 99, 235, 0.38);
        }

        .admin-menu-active .admin-menu-icon {
            background: rgba(255, 255, 255, 0.18);
            color: white;
        }

        .admin-menu-link:focus-visible,
        button:focus-visible,
        a:focus-visible {
            outline: 3px solid rgba(250, 204, 21, 0.75);
            outline-offset: 3px;
        }
    </style>

    @stack('styles')
</head>

<body class="bg-slate-100 text-slate-800 antialiased">

    <div class="relative min-h-screen overflow-hidden">

        {{-- ===================================================== --}}
        {{-- BACKGROUND --}}
        {{-- ===================================================== --}}

        <div
            class="pointer-events-none fixed inset-0"
            aria-hidden="true"
        >
            <div
                class="absolute -top-40 left-1/3
                       h-[560px] w-[560px]
                       rounded-full bg-blue-200/35
                       blur-[160px]"
            ></div>

            <div
                class="absolute -bottom-40 right-0
                       h-[560px] w-[560px]
                       rounded-full bg-yellow-200/35
                       blur-[160px]"
            ></div>

            <div
                class="absolute inset-0 opacity-[0.035]"
                style="
                    background-image:
                        linear-gradient(
                            #0f172a 1px,
                            transparent 1px
                        ),
                        linear-gradient(
                            to right,
                            #0f172a 1px,
                            transparent 1px
                        );
                    background-size: 70px 70px;
                "
            ></div>
        </div>


        {{-- ===================================================== --}}
        {{-- MOBILE OVERLAY --}}
        {{-- ===================================================== --}}

        <div
            id="adminOverlay"
            class="fixed inset-0 z-40 hidden
                   bg-slate-950/60 backdrop-blur-sm
                   lg:hidden"
            aria-hidden="true"
        ></div>


        {{-- ===================================================== --}}
        {{-- SIDEBAR --}}
        {{-- ===================================================== --}}

        <aside
            id="adminSidebar"
            class="fixed inset-y-0 left-0 z-50
                   w-72 -translate-x-full
                   bg-[#06172E] text-white
                   shadow-2xl transition-transform
                   duration-300 ease-in-out
                   lg:translate-x-0"
            aria-label="Navigasi admin"
        >
            {{-- Ornamen Sidebar --}}
            <div
                class="pointer-events-none absolute
                       inset-0 overflow-hidden"
                aria-hidden="true"
            >
                <div
                    class="absolute -right-28 -top-28
                           h-72 w-72 rounded-full
                           bg-blue-500/20 blur-3xl"
                ></div>

                <div
                    class="absolute -bottom-28 -left-28
                           h-72 w-72 rounded-full
                           bg-yellow-400/15 blur-3xl"
                ></div>
            </div>


            <div class="relative flex h-full flex-col">

                {{-- ================================================= --}}
                {{-- BRAND --}}
                {{-- ================================================= --}}

                <div
                    class="border-b border-white/10
                           px-6 py-6"
                >
                    <div
                        class="flex items-center
                               justify-between gap-4"
                    >
                        <div
                            class="flex min-w-0
                                   items-center gap-4"
                        >
                            <div
                                class="flex h-14 w-14 shrink-0
                                       items-center justify-center
                                       rounded-2xl bg-white
                                       shadow-xl"
                            >
                                @if ($logoAvailable)
                                    <img
                                        src="{{ asset($logoRelativePath) }}"
                                        alt="Logo Politeknik Negeri Malang"
                                        class="h-10 w-10 object-contain"
                                    >
                                @else
                                    <span
                                        class="font-black
                                               text-blue-800"
                                    >
                                        TM
                                    </span>
                                @endif
                            </div>

                            <div class="min-w-0">
                                <h1
                                    class="text-lg font-black
                                           leading-tight"
                                >
                                    Admin Panel
                                </h1>

                                <p
                                    class="mt-1 text-xs
                                           leading-5 text-blue-100/70"
                                >
                                    D-IV Teknik Mesin Produksi
                                    dan Perawatan
                                </p>
                            </div>
                        </div>


                        <button
                            type="button"
                            id="closeAdminSidebar"
                            class="flex h-10 w-10 shrink-0
                                   items-center justify-center
                                   rounded-xl bg-white/10
                                   transition hover:bg-white/20
                                   lg:hidden"
                            aria-label="Tutup menu admin"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"
                                />
                            </svg>
                        </button>
                    </div>


                    <div
                        class="mt-6 rounded-3xl
                               border border-white/10
                               bg-white/[0.08] p-4"
                    >
                        <p class="text-xs text-slate-300">
                            Website Program Studi
                        </p>

                        <p
                            class="mt-1 text-sm font-bold
                                   leading-relaxed text-white"
                        >
                            Politeknik Negeri Malang
                        </p>
                    </div>
                </div>


                {{-- ================================================= --}}
                {{-- NAVIGATION --}}
                {{-- ================================================= --}}

                <nav
                    class="flex-1 space-y-2
                           overflow-y-auto px-4 py-6"
                >
                    {{-- Dashboard --}}
                    <a
                        href="{{ route('admin.dashboard') }}"
                        @class([
                            'admin-menu-link',
                            'admin-menu-active' =>
                                request()->routeIs('admin.dashboard'),
                            'admin-menu-default' =>
                                !request()->routeIs('admin.dashboard'),
                        ])
                    >
                        <span class="admin-menu-icon">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M3 12l9-9 9 9M4 10v10h6v-6h4v6h6V10"
                                />
                            </svg>
                        </span>

                        Dashboard
                    </a>


                    {{-- Konten Profil --}}
                    <a
                        href="{{ route(
                            'admin.profile-contents.index'
                        ) }}"
                        @class([
                            'admin-menu-link',
                            'admin-menu-active' =>
                                request()->routeIs(
                                    'admin.profile-contents.*'
                                ),
                            'admin-menu-default' =>
                                !request()->routeIs(
                                    'admin.profile-contents.*'
                                ),
                        ])
                    >
                        <span class="admin-menu-icon">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 12h6m-6 4h6M5 4h14a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V6a2 2 0 012-2z"
                                />
                            </svg>
                        </span>

                        Konten Profil
                    </a>


                    {{-- Konten Beranda --}}
                    <a
                        href="{{ route(
                            'admin.home-content.index'
                        ) }}"
                        @class([
                            'admin-menu-link',
                            'admin-menu-active' =>
                                request()->routeIs(
                                    'admin.home-content.*'
                                ),
                            'admin-menu-default' =>
                                !request()->routeIs(
                                    'admin.home-content.*'
                                ),
                        ])
                    >
                        <span class="admin-menu-icon">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M3 11.5L12 4l9 7.5V20a1 1 0 01-1 1h-5v-6H9v6H4a1 1 0 01-1-1v-8.5z"
                                />
                            </svg>
                        </span>

                        Konten Beranda
                    </a>


                    {{-- Akreditasi --}}
                    <a
                        href="{{ route(
                            'admin.accreditations.index'
                        ) }}"
                        @class([
                            'admin-menu-link',
                            'admin-menu-active' =>
                                request()->routeIs(
                                    'admin.accreditations.*'
                                ),
                            'admin-menu-default' =>
                                !request()->routeIs(
                                    'admin.accreditations.*'
                                ),
                        ])
                    >
                        <span class="admin-menu-icon">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 12l2 2 4-4M12 3l7 4v5c0 5-3 9-7 9s-7-4-7-9V7l7-4z"
                                />
                            </svg>
                        </span>

                        Akreditasi
                    </a>


                    {{-- Dosen dan Staf --}}
                    <a
                        href="{{ route(
                            'admin.lecturer-staff.index'
                        ) }}"
                        @class([
                            'admin-menu-link',
                            'admin-menu-active' =>
                                request()->routeIs(
                                    'admin.lecturer-staff.*'
                                ),
                            'admin-menu-default' =>
                                !request()->routeIs(
                                    'admin.lecturer-staff.*'
                                ),
                        ])
                    >
                        <span class="admin-menu-icon">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M17 20h5v-2a4 4 0 00-5-3.87M9 20H4v-2a4 4 0 015-3.87M12 12a4 4 0 100-8 4 4 0 000 8z"
                                />
                            </svg>
                        </span>

                        Dosen dan Staf
                    </a>


                    {{-- Akademik --}}
                    <a
                        href="{{ route(
                            'admin.academic-documents.index'
                        ) }}"
                        @class([
                            'admin-menu-link',
                            'admin-menu-active' =>
                                request()->routeIs(
                                    'admin.academic-documents.*'
                                ),
                            'admin-menu-default' =>
                                !request()->routeIs(
                                    'admin.academic-documents.*'
                                ),
                        ])
                    >
                        <span class="admin-menu-icon">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 6.253v13M12 6.253C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253"
                                />
                            </svg>
                        </span>

                        Akademik
                    </a>


                    {{-- Dokumentasi Fasilitas --}}
                    <a
                        href="{{ route(
                            'admin.facilities.index'
                        ) }}"
                        @class([
                            'admin-menu-link',
                            'admin-menu-active' =>
                                request()->routeIs(
                                    'admin.facilities.*'
                                ),
                            'admin-menu-default' =>
                                !request()->routeIs(
                                    'admin.facilities.*'
                                ),
                        ])
                    >
                        <span class="admin-menu-icon">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M4 20h16a2 2 0 002-2V6a2 2 0 00-2-2H4a2 2 0 00-2 2v12a2 2 0 002 2z"
                                />
                            </svg>
                        </span>

                        Dokumentasi Fasilitas
                    </a>


                    {{-- Pengelola Admin --}}
                    <a
                        href="{{ route(
                            'admin.admin-users.index'
                        ) }}"
                        @class([
                            'admin-menu-link',
                            'admin-menu-active' =>
                                request()->routeIs(
                                    'admin.admin-users.*'
                                ),
                            'admin-menu-default' =>
                                !request()->routeIs(
                                    'admin.admin-users.*'
                                ),
                        ])
                    >
                        <span class="admin-menu-icon">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 11c1.657 0 3-1.343 3-3S13.657 5 12 5 9 6.343 9 8s1.343 3 3 3zM5.5 21a6.5 6.5 0 0113 0M19 8h2m-1-1v2"
                                />
                            </svg>
                        </span>

                        Pengelola Admin
                    </a>


                    {{-- Website Publik --}}
                    <div
                        class="mt-5 border-t
                               border-white/10 pt-5"
                    >
                        <a
                            href="{{ route('home') }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="admin-menu-link
                                   admin-menu-default"
                        >
                            <span class="admin-menu-icon">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    aria-hidden="true"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M14 3h7v7M10 14L21 3M5 5h5M5 10h5M5 15h14M5 20h14"
                                    />
                                </svg>
                            </span>

                            Lihat Website
                        </a>
                    </div>
                </nav>


                {{-- ================================================= --}}
                {{-- SIDEBAR FOOTER --}}
                {{-- ================================================= --}}

                <div
                    class="border-t border-white/10
                           px-4 py-5"
                >
                    <div
                        class="mb-4 rounded-3xl
                               border border-white/10
                               bg-white/[0.08] p-4"
                    >
                        <div class="flex items-center gap-3">

                            <div
                                class="flex h-11 w-11
                                       items-center justify-center
                                       rounded-2xl bg-yellow-400
                                       font-black text-slate-900
                                       shadow-lg"
                            >
                                A
                            </div>

                            <div>
                                <p
                                    class="text-sm font-bold
                                           text-white"
                                >
                                    Administrator
                                </p>

                                <p
                                    class="mt-1 text-xs
                                           text-slate-400"
                                >
                                    Pengelola Website
                                </p>
                            </div>
                        </div>
                    </div>


                    @if (Route::has('admin.logout'))
                        <form
                            action="{{ route('admin.logout') }}"
                            method="POST"
                        >
                            @csrf

                            <button
                                type="submit"
                                class="flex w-full items-center
                                       justify-center gap-3
                                       rounded-2xl bg-red-500/10
                                       px-4 py-3 font-bold
                                       text-red-300 transition
                                       hover:bg-red-500
                                       hover:text-white"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    aria-hidden="true"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1"
                                    />
                                </svg>

                                Keluar
                            </button>
                        </form>
                    @endif
                </div>

            </div>
        </aside>


        {{-- ===================================================== --}}
        {{-- MAIN CONTENT --}}
        {{-- ===================================================== --}}

        <div class="relative min-h-screen lg:pl-72">

            {{-- ================================================= --}}
            {{-- TOPBAR --}}
            {{-- ================================================= --}}

            <header
                class="sticky top-0 z-30
                       border-b border-white/70
                       bg-white/80 shadow-sm
                       backdrop-blur-2xl"
            >
                <div
                    class="flex h-20 items-center
                           justify-between gap-4
                           px-5 md:px-8"
                >
                    <div
                        class="flex min-w-0
                               items-center gap-4"
                    >
                        <button
                            type="button"
                            id="openAdminSidebar"
                            class="flex h-11 w-11 shrink-0
                                   items-center justify-center
                                   rounded-2xl bg-slate-100
                                   transition hover:bg-slate-200
                                   lg:hidden"
                            aria-label="Buka menu admin"
                            aria-controls="adminSidebar"
                            aria-expanded="false"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"
                                />
                            </svg>
                        </button>


                        <div class="min-w-0">
                            <p
                                class="hidden text-xs font-bold
                                       uppercase tracking-[3px]
                                       text-blue-700 md:block"
                            >
                                Admin Website
                            </p>

                            <h2
                                class="truncate text-lg
                                       font-black text-slate-800
                                       md:text-2xl"
                            >
                                @yield('title', 'Admin Panel')
                            </h2>
                        </div>
                    </div>


                    <div
                        class="flex shrink-0
                               items-center gap-3"
                    >
                        <a
                            href="{{ route('home') }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="hidden items-center
                                   justify-center rounded-2xl
                                   bg-blue-700 px-5 py-3
                                   font-bold text-white
                                   shadow-lg
                                   shadow-blue-700/20
                                   transition hover:bg-blue-800
                                   md:inline-flex"
                        >
                            Lihat Website
                        </a>

                        <div
                            class="hidden items-center gap-3
                                   rounded-2xl border
                                   border-slate-200 bg-white
                                   px-4 py-3 shadow-sm
                                   sm:flex"
                        >
                            <div
                                class="flex h-9 w-9
                                       items-center justify-center
                                       rounded-xl bg-yellow-400
                                       font-black text-slate-900"
                            >
                                A
                            </div>

                            <div>
                                <p
                                    class="text-sm font-bold
                                           text-slate-800"
                                >
                                    Admin
                                </p>

                                <p
                                    class="max-w-52 truncate
                                           text-xs text-slate-500"
                                >
                                    D-IV Teknik Mesin Produksi
                                    dan Perawatan
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </header>


            {{-- ================================================= --}}
            {{-- PAGE CONTENT --}}
            {{-- ================================================= --}}

            <main class="p-5 md:p-8">
                <div class="mx-auto max-w-7xl">
                    @yield('content')
                </div>
            </main>

        </div>
    </div>


    {{-- ========================================================= --}}
    {{-- SIDEBAR SCRIPT --}}
    {{-- ========================================================= --}}

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const desktopBreakpoint = 1024;

            const sidebar = document.getElementById(
                'adminSidebar'
            );

            const overlay = document.getElementById(
                'adminOverlay'
            );

            const openButton = document.getElementById(
                'openAdminSidebar'
            );

            const closeButton = document.getElementById(
                'closeAdminSidebar'
            );

            const navigationLinks = sidebar
                ? sidebar.querySelectorAll('nav a')
                : [];

            let mobileSidebarOpen = false;


            function isDesktop() {
                return window.innerWidth >= desktopBreakpoint;
            }


            function updateAriaState(isOpen) {
                if (openButton) {
                    openButton.setAttribute(
                        'aria-expanded',
                        isOpen ? 'true' : 'false'
                    );
                }

                if (overlay) {
                    overlay.setAttribute(
                        'aria-hidden',
                        isOpen ? 'false' : 'true'
                    );
                }
            }


            function openSidebar() {
                if (!sidebar || isDesktop()) {
                    return;
                }

                mobileSidebarOpen = true;

                sidebar.classList.remove(
                    '-translate-x-full'
                );

                if (overlay) {
                    overlay.classList.remove('hidden');
                }

                document.body.classList.add(
                    'overflow-hidden'
                );

                updateAriaState(true);

                if (closeButton) {
                    closeButton.focus();
                }
            }


            function closeSidebar(restoreFocus = false) {
                if (!sidebar || isDesktop()) {
                    return;
                }

                mobileSidebarOpen = false;

                sidebar.classList.add(
                    '-translate-x-full'
                );

                if (overlay) {
                    overlay.classList.add('hidden');
                }

                document.body.classList.remove(
                    'overflow-hidden'
                );

                updateAriaState(false);

                if (restoreFocus && openButton) {
                    openButton.focus();
                }
            }


            function synchronizeSidebar() {
                if (!sidebar) {
                    return;
                }

                if (isDesktop()) {
                    mobileSidebarOpen = false;

                    sidebar.classList.remove(
                        '-translate-x-full'
                    );

                    if (overlay) {
                        overlay.classList.add('hidden');
                    }

                    document.body.classList.remove(
                        'overflow-hidden'
                    );

                    updateAriaState(false);

                    return;
                }

                if (mobileSidebarOpen) {
                    sidebar.classList.remove(
                        '-translate-x-full'
                    );

                    if (overlay) {
                        overlay.classList.remove('hidden');
                    }

                    document.body.classList.add(
                        'overflow-hidden'
                    );

                    updateAriaState(true);
                } else {
                    sidebar.classList.add(
                        '-translate-x-full'
                    );

                    if (overlay) {
                        overlay.classList.add('hidden');
                    }

                    document.body.classList.remove(
                        'overflow-hidden'
                    );

                    updateAriaState(false);
                }
            }


            if (openButton) {
                openButton.addEventListener(
                    'click',
                    openSidebar
                );
            }


            if (closeButton) {
                closeButton.addEventListener(
                    'click',
                    function () {
                        closeSidebar(true);
                    }
                );
            }


            if (overlay) {
                overlay.addEventListener(
                    'click',
                    function () {
                        closeSidebar(true);
                    }
                );
            }


            navigationLinks.forEach(function (link) {
                link.addEventListener('click', function () {
                    if (!isDesktop()) {
                        closeSidebar(false);
                    }
                });
            });


            document.addEventListener(
                'keydown',
                function (event) {
                    if (
                        event.key === 'Escape'
                        && mobileSidebarOpen
                    ) {
                        closeSidebar(true);
                    }
                }
            );


            window.addEventListener(
                'resize',
                synchronizeSidebar
            );


            synchronizeSidebar();
        });
    </script>

    @stack('scripts')
</body>

</html>