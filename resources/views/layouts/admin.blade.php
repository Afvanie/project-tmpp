@php
    /*
    |--------------------------------------------------------------------------
    | IDENTITAS LAYOUT ADMIN
    |--------------------------------------------------------------------------
    */

    $logoRelativePath = 'assets/images/logo.png';

    $logoAvailable = file_exists(
        public_path($logoRelativePath)
    );

    $adminName = trim(
        (string) (
            session('admin_name')
            ?? 'Administrator'
        )
    );

    $adminInitial = strtoupper(
        mb_substr(
            $adminName !== ''
                ? $adminName
                : 'Administrator',
            0,
            1
        )
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
    <link
        rel="icon"
        type="image/png"
        href="{{ asset($logoRelativePath) }}?v=1"
    >

    <link
        rel="shortcut icon"
        type="image/png"
        href="{{ asset($logoRelativePath) }}?v=1"
    >

    <link
        rel="apple-touch-icon"
        href="{{ asset($logoRelativePath) }}?v=1"
    >
    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <meta
        name="theme-color"
        content="#071A2F"
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
        href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800"
        rel="stylesheet"
    >

    <style>
        :root {
            --admin-navy: #071a2f;
            --admin-blue: #075f9b;
            --admin-blue-dark: #064b7b;
            --admin-gold: #d7b33e;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .admin-scrollbar {
            scrollbar-width: thin;
            scrollbar-color: rgba(255, 255, 255, 0.18) transparent;
        }

        .admin-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .admin-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .admin-scrollbar::-webkit-scrollbar-thumb {
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.18);
        }

        .admin-menu-link {
            position: relative;
            display: flex;
            min-height: 44px;
            align-items: center;
            gap: 12px;
            border-radius: 12px;
            padding: 9px 12px;
            color: rgb(203 213 225);
            font-size: 13px;
            font-weight: 700;
            line-height: 1.35;
            transition:
                background-color 180ms ease,
                color 180ms ease,
                transform 180ms ease;
        }

        .admin-menu-link:hover {
            background: rgba(255, 255, 255, 0.08);
            color: white;
        }

        .admin-menu-link-active {
            background: rgba(255, 255, 255, 0.12);
            color: white;
        }

        .admin-menu-link-active::before {
            position: absolute;
            top: 9px;
            bottom: 9px;
            left: 0;
            width: 3px;
            border-radius: 999px;
            background: var(--admin-gold);
            content: '';
        }

        .admin-menu-icon {
            display: flex;
            width: 34px;
            height: 34px;
            flex-shrink: 0;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.07);
            color: rgb(203 213 225);
            transition:
                background-color 180ms ease,
                color 180ms ease;
        }

        .admin-menu-link:hover .admin-menu-icon,
        .admin-menu-link-active .admin-menu-icon {
            background: rgba(215, 179, 62, 0.16);
            color: #f4d66b;
        }

        .admin-focus:focus-visible,
        .admin-menu-link:focus-visible,
        button:focus-visible,
        a:focus-visible,
        input:focus-visible,
        select:focus-visible,
        textarea:focus-visible {
            outline: 3px solid rgba(215, 179, 62, 0.55);
            outline-offset: 2px;
        }
    </style>

    @stack('styles')
</head>

<body
    class="min-h-screen bg-slate-100
           text-slate-800 antialiased"
>
    <div class="min-h-screen">

        {{-- ===================================================== --}}
        {{-- OVERLAY MOBILE --}}
        {{-- ===================================================== --}}

        <div
            id="adminOverlay"
            class="fixed inset-0 z-40 hidden
                   bg-slate-950/60
                   backdrop-blur-sm lg:hidden"
            aria-hidden="true"
        ></div>


        {{-- ===================================================== --}}
        {{-- SIDEBAR --}}
        {{-- ===================================================== --}}

        <aside
            id="adminSidebar"
            class="fixed inset-y-0 left-0 z-50
                   w-64 -translate-x-full
                   overflow-hidden bg-[#071A2F]
                   text-white shadow-2xl
                   transition-transform duration-300
                   ease-out lg:translate-x-0"
            aria-label="Navigasi admin"
        >
            <div class="flex h-full flex-col">

                {{-- BRAND --}}
                <div
                    class="border-b border-white/10
                           px-5 py-5"
                >
                    <div
                        class="flex items-center
                               justify-between gap-3"
                    >
                        <a
                            href="{{ route('admin.dashboard') }}"
                            class="flex min-w-0
                                   items-center gap-3"
                            aria-label="Dashboard Admin TMPP"
                        >
                            <span
                                class="flex h-11 w-11 shrink-0
                                       items-center justify-center
                                       rounded-xl bg-white
                                       shadow-lg"
                            >
                                @if ($logoAvailable)
                                    <img
                                        src="{{ asset($logoRelativePath) }}"
                                        alt="Logo Politeknik Negeri Malang"
                                        class="h-8 w-8 object-contain"
                                    >
                                @else
                                    <span
                                        class="text-sm font-extrabold
                                               text-[#075F9B]"
                                    >
                                        TM
                                    </span>
                                @endif
                            </span>

                            <span class="min-w-0">
                                <span
                                    class="block truncate
                                           text-sm font-extrabold"
                                >
                                    Admin TMPP
                                </span>

                                <span
                                    class="mt-0.5 block truncate
                                           text-[10px] font-semibold
                                           uppercase tracking-[0.12em]
                                           text-slate-400"
                                >
                                    Politeknik Negeri Malang
                                </span>
                            </span>
                        </a>


                        <button
                            type="button"
                            id="closeAdminSidebar"
                            class="admin-focus flex h-9 w-9
                                   shrink-0 items-center
                                   justify-center rounded-lg
                                   bg-white/10 text-slate-200
                                   transition hover:bg-white/15
                                   lg:hidden"
                            aria-label="Tutup menu admin"
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
                                    d="M6 18L18 6M6 6l12 12"
                                />
                            </svg>
                        </button>
                    </div>
                </div>


                {{-- NAVIGATION --}}
                <nav
                    class="admin-scrollbar flex-1
                           overflow-y-auto px-3 py-4"
                >
                    <div class="space-y-1">
                        <p
                            class="px-3 pb-2 text-[9px]
                                   font-extrabold uppercase
                                   tracking-[0.18em]
                                   text-slate-500"
                        >
                            Utama
                        </p>

                        <a
                            href="{{ route('admin.dashboard') }}"
                            @class([
                                'admin-menu-link',
                                'admin-menu-link-active' =>
                                    request()->routeIs(
                                        'admin.dashboard'
                                    ),
                            ])
                        >
                            <span class="admin-menu-icon">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-4.5 w-4.5"
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

                            <span>Dashboard</span>
                        </a>
                    </div>


                    <div
                        class="mt-5 border-t
                               border-white/10 pt-4"
                    >
                        <p
                            class="px-3 pb-2 text-[9px]
                                   font-extrabold uppercase
                                   tracking-[0.18em]
                                   text-slate-500"
                        >
                            Konten Website
                        </p>

                        <div class="space-y-1">
                            <a
                                href="{{ route(
                                    'admin.home-content.index'
                                ) }}"
                                @class([
                                    'admin-menu-link',
                                    'admin-menu-link-active' =>
                                        request()->routeIs(
                                            'admin.home-content.*'
                                        ),
                                ])
                            >
                                <span class="admin-menu-icon">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-4.5 w-4.5"
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

                                <span>Konten Beranda</span>
                            </a>

                            <a
                                href="{{ route(
                                    'admin.news.index'
                                ) }}"
                                @class([
                                    'admin-menu-link',
                                    'admin-menu-link-active' =>
                                        request()->routeIs(
                                            'admin.news.*'
                                        ),
                                ])
                            >
                                <span class="admin-menu-icon">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-4.5 w-4.5"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        aria-hidden="true"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M4 6h16M4 10h16M4 14h10M4 18h10"
                                        />
                                    </svg>
                                </span>

                                <span>Berita</span>
                            </a>
                            <a
                                href="{{ route(
                                    'admin.profile-contents.index'
                                ) }}"
                                @class([
                                    'admin-menu-link',
                                    'admin-menu-link-active' =>
                                        request()->routeIs(
                                            'admin.profile-contents.*'
                                        ),
                                ])
                            >
                                <span class="admin-menu-icon">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-4.5 w-4.5"
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

                                <span>Konten Profil</span>
                            </a>


                            <a
                                href="{{ route(
                                    'admin.accreditations.index'
                                ) }}"
                                @class([
                                    'admin-menu-link',
                                    'admin-menu-link-active' =>
                                        request()->routeIs(
                                            'admin.accreditations.*'
                                        ),
                                ])
                            >
                                <span class="admin-menu-icon">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-4.5 w-4.5"
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

                                <span>Akreditasi</span>
                            </a>


                            <a
                                href="{{ route(
                                    'admin.lecturer-staff.index'
                                ) }}"
                                @class([
                                    'admin-menu-link',
                                    'admin-menu-link-active' =>
                                        request()->routeIs(
                                            'admin.lecturer-staff.*'
                                        ),
                                ])
                            >
                                <span class="admin-menu-icon">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-4.5 w-4.5"
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

                                <span>Dosen dan Staf</span>
                            </a>


                            <a
                                href="{{ route(
                                    'admin.academic-documents.index'
                                ) }}"
                                @class([
                                    'admin-menu-link',
                                    'admin-menu-link-active' =>
                                        request()->routeIs(
                                            'admin.academic-documents.*'
                                        ),
                                ])
                            >
                                <span class="admin-menu-icon">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-4.5 w-4.5"
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

                                <span>Dokumen Akademik</span>
                            </a>


                            <a
                                href="{{ route(
                                    'admin.facilities.index'
                                ) }}"
                                @class([
                                    'admin-menu-link',
                                    'admin-menu-link-active' =>
                                        request()->routeIs(
                                            'admin.facilities.*'
                                        ),
                                ])
                            >
                                <span class="admin-menu-icon">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-4.5 w-4.5"
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

                                <span>Dokumentasi Fasilitas</span>
                            </a>
                        </div>
                    </div>


                    <div
                        class="mt-5 border-t
                               border-white/10 pt-4"
                    >
                        <p
                            class="px-3 pb-2 text-[9px]
                                   font-extrabold uppercase
                                   tracking-[0.18em]
                                   text-slate-500"
                        >
                            Pengelolaan
                        </p>

                        <div class="space-y-1">
                            <a
                                href="{{ route(
                                    'admin.admin-users.index'
                                ) }}"
                                @class([
                                    'admin-menu-link',
                                    'admin-menu-link-active' =>
                                        request()->routeIs(
                                            'admin.admin-users.*'
                                        ),
                                ])
                            >
                                <span class="admin-menu-icon">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-4.5 w-4.5"
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

                                <span>Pengelola Admin</span>
                            </a>


                            <a
                                href="{{ route('home') }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="admin-menu-link"
                            >
                                <span class="admin-menu-icon">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-4.5 w-4.5"
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

                                <span>Lihat Website</span>
                            </a>
                        </div>
                    </div>
                </nav>


                {{-- FOOTER SIDEBAR --}}
                <div
                    class="border-t border-white/10
                           px-3 py-4"
                >
                    <div
                        class="mb-3 flex items-center
                               gap-3 rounded-xl
                               bg-white/[0.06] p-3"
                    >
                        <span
                            class="flex h-9 w-9 shrink-0
                                   items-center justify-center
                                   rounded-lg bg-[#D7B33E]
                                   text-sm font-extrabold
                                   text-[#071A2F]"
                        >
                            {{ $adminInitial }}
                        </span>

                        <div class="min-w-0">
                            <p
                                class="truncate text-xs
                                       font-bold text-white"
                            >
                                {{ $adminName }}
                            </p>

                            <p
                                class="mt-0.5 truncate
                                       text-[10px]
                                       text-slate-500"
                            >
                                Pengelola Website
                            </p>
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
                                class="admin-focus flex w-full
                                       items-center justify-center
                                       gap-2 rounded-xl
                                       border border-red-400/15
                                       bg-red-500/10
                                       px-4 py-2.5
                                       text-xs font-bold
                                       text-red-300 transition
                                       hover:bg-red-500
                                       hover:text-white"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4"
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
        {{-- AREA UTAMA --}}
        {{-- ===================================================== --}}

        <div class="min-h-screen lg:pl-64">

            {{-- TOPBAR --}}
            <header
                class="sticky top-0 z-30
                       border-b border-slate-200/80
                       bg-white/90 backdrop-blur-xl"
            >
                <div
                    class="flex h-[68px] items-center
                           justify-between gap-4
                           px-4 sm:px-6 lg:px-8"
                >
                    <div
                        class="flex min-w-0
                               items-center gap-3"
                    >
                        <button
                            type="button"
                            id="openAdminSidebar"
                            class="admin-focus flex h-10 w-10
                                   shrink-0 items-center
                                   justify-center rounded-xl
                                   border border-slate-200
                                   bg-white text-slate-700
                                   shadow-sm transition
                                   hover:bg-slate-50 lg:hidden"
                            aria-label="Buka menu admin"
                            aria-controls="adminSidebar"
                            aria-expanded="false"
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
                                    d="M4 6h16M4 12h16M4 18h16"
                                />
                            </svg>
                        </button>


                        <div class="min-w-0">
                            <p
                                class="hidden text-[9px]
                                       font-extrabold uppercase
                                       tracking-[0.16em]
                                       text-[#075F9B] sm:block"
                            >
                                Admin Website D-IV TMPP
                            </p>

                            <h1
                                class="truncate text-base
                                       font-extrabold
                                       text-slate-900
                                       sm:text-lg"
                            >
                                @yield('title', 'Admin Panel')
                            </h1>
                        </div>
                    </div>


                    <div
                        class="flex shrink-0
                               items-center gap-2"
                    >
                        <a
                            href="{{ route('home') }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="admin-focus hidden
                                   items-center gap-2
                                   rounded-xl
                                   border border-slate-200
                                   bg-white px-4 py-2.5
                                   text-xs font-bold
                                   text-slate-700
                                   shadow-sm transition
                                   hover:border-blue-200
                                   hover:text-[#075F9B]
                                   sm:inline-flex"
                        >
                            <span>Lihat Website</span>

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-3.5 w-3.5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M14 3h7v7M10 14L21 3"
                                />
                            </svg>
                        </a>


                        <div
                            class="flex h-10 w-10
                                   items-center justify-center
                                   rounded-xl bg-[#075F9B]
                                   text-sm font-extrabold
                                   text-white shadow-sm"
                            title="{{ $adminName }}"
                            aria-label="Administrator"
                        >
                            {{ $adminInitial }}
                        </div>
                    </div>
                </div>
            </header>


            {{-- CONTENT --}}
            <main
                class="px-4 py-5
                       sm:px-6 sm:py-6
                       lg:px-8 lg:py-8"
            >
                <div class="mx-auto max-w-[1500px]">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>


    {{-- ========================================================= --}}
    {{-- SCRIPT SIDEBAR --}}
    {{-- ========================================================= --}}

    <script>
        document.addEventListener(
            'DOMContentLoaded',
            function () {
                const desktopBreakpoint = 1024;

                const sidebar =
                    document.getElementById(
                        'adminSidebar'
                    );

                const overlay =
                    document.getElementById(
                        'adminOverlay'
                    );

                const openButton =
                    document.getElementById(
                        'openAdminSidebar'
                    );

                const closeButton =
                    document.getElementById(
                        'closeAdminSidebar'
                    );

                const navigationLinks = sidebar
                    ? sidebar.querySelectorAll('nav a')
                    : [];

                let mobileSidebarOpen = false;


                function isDesktop() {
                    return window.innerWidth
                        >= desktopBreakpoint;
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
                        overlay.classList.remove(
                            'hidden'
                        );
                    }

                    document.body.classList.add(
                        'overflow-hidden'
                    );

                    updateAriaState(true);
                }


                function closeSidebar(
                    restoreFocus = false
                ) {
                    if (!sidebar || isDesktop()) {
                        return;
                    }

                    mobileSidebarOpen = false;

                    sidebar.classList.add(
                        '-translate-x-full'
                    );

                    if (overlay) {
                        overlay.classList.add(
                            'hidden'
                        );
                    }

                    document.body.classList.remove(
                        'overflow-hidden'
                    );

                    updateAriaState(false);

                    if (
                        restoreFocus
                        && openButton
                    ) {
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
                            overlay.classList.add(
                                'hidden'
                            );
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
                            overlay.classList.remove(
                                'hidden'
                            );
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
                            overlay.classList.add(
                                'hidden'
                            );
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


                navigationLinks.forEach(
                    function (link) {
                        link.addEventListener(
                            'click',
                            function () {
                                if (!isDesktop()) {
                                    closeSidebar(false);
                                }
                            }
                        );
                    }
                );


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
            }
        );
    </script>

    @stack('scripts')
</body>

</html>
