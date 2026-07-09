<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - D-III Teknik Mesin</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800,900" rel="stylesheet" />

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
            transition: all 0.25s ease;
        }

        .admin-menu-icon {
            width: 38px;
            height: 38px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: all 0.25s ease;
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
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: white;
            box-shadow: 0 18px 35px rgba(37, 99, 235, 0.38);
        }

        .admin-menu-active .admin-menu-icon {
            background: rgba(255, 255, 255, 0.18);
            color: white;
        }
    </style>
</head>

<body class="bg-slate-100 text-slate-800">

    <div class="min-h-screen relative overflow-hidden">

        {{-- Background Ornament --}}
        <div class="fixed inset-0 pointer-events-none">
            <div class="absolute -top-40 left-1/3 w-[560px] h-[560px] rounded-full bg-blue-200/35 blur-[160px]"></div>
            <div class="absolute -bottom-40 right-0 w-[560px] h-[560px] rounded-full bg-yellow-200/35 blur-[160px]"></div>

            <div class="absolute inset-0 opacity-[0.035]"
                style="background-image: linear-gradient(#0f172a 1px, transparent 1px),
                linear-gradient(to right,#0f172a 1px,transparent 1px);
                background-size:70px 70px;">
            </div>
        </div>

        {{-- Mobile Overlay --}}
        <div
            id="adminOverlay"
            class="fixed inset-0 bg-slate-950/60 backdrop-blur-sm z-40 hidden lg:hidden">
        </div>

        {{-- Sidebar --}}
        <aside
            id="adminSidebar"
            class="fixed inset-y-0 left-0 z-50 w-72 bg-[#06172E] text-white transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out shadow-2xl">

            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <div class="absolute -top-28 -right-28 w-72 h-72 rounded-full bg-blue-500/20 blur-3xl"></div>
                <div class="absolute -bottom-28 -left-28 w-72 h-72 rounded-full bg-yellow-400/15 blur-3xl"></div>
            </div>

            <div class="relative h-full flex flex-col">

                {{-- Brand --}}
                <div class="px-6 py-6 border-b border-white/10">

                    <div class="flex items-center justify-between gap-4">

                        <div class="flex items-center gap-4">

                            <div class="w-14 h-14 rounded-2xl bg-white flex items-center justify-center shadow-xl">
                                <img
                                    src="{{ asset('assets/images/logo.png') }}"
                                    alt="Logo Polinema"
                                    class="w-10 h-10 object-contain">
                            </div>

                            <div>
                                <h1 class="text-lg font-black leading-tight">
                                    Admin Panel
                                </h1>

                                <p class="text-xs text-blue-100/70 mt-1">
                                    D-III Teknik Mesin
                                </p>
                            </div>

                        </div>

                        <button
                            type="button"
                            id="closeAdminSidebar"
                            class="lg:hidden w-10 h-10 rounded-xl bg-white/10 hover:bg-white/20 flex items-center justify-center transition">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-6 h-6"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">

                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>

                        </button>

                    </div>

                    <div class="mt-6 rounded-3xl bg-white/8 border border-white/10 p-4">
                        <p class="text-xs text-slate-300">
                            Website Program Studi
                        </p>

                        <p class="mt-1 text-sm font-bold text-white leading-relaxed">
                            Politeknik Negeri Malang
                        </p>
                    </div>

                </div>

                {{-- Navigation --}}
                <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">

                    <a href="{{ route('admin.dashboard') }}"
                        class="admin-menu-link {{ request()->routeIs('admin.dashboard') ? 'admin-menu-active' : 'admin-menu-default' }}">
                        <span class="admin-menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l9-9 9 9M4 10v10h6v-6h4v6h6V10" />
                            </svg>
                        </span>
                        Dashboard
                    </a>

                    <a href="{{ route('admin.profile-contents.index') }}"
                        class="admin-menu-link {{ request()->routeIs('admin.profile-contents.*') ? 'admin-menu-active' : 'admin-menu-default' }}">
                        <span class="admin-menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6M5 4h14a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V6a2 2 0 012-2z" />
                            </svg>
                        </span>
                        Konten Profil
                    </a>

                    <a href="{{ route('admin.lecturer-staff.index') }}"
                        class="admin-menu-link {{ request()->routeIs('admin.lecturer-staff.*') ? 'admin-menu-active' : 'admin-menu-default' }}">
                        <span class="admin-menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-5-3.87M9 20H4v-2a4 4 0 015-3.87M12 12a4 4 0 100-8 4 4 0 000 8z" />
                            </svg>
                        </span>
                        Dosen & Staff
                    </a>

                    <a href="{{ route('admin.academic-documents.index') }}"
                        class="admin-menu-link {{ request()->routeIs('admin.academic-documents.*') ? 'admin-menu-active' : 'admin-menu-default' }}">
                        <span class="admin-menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13M12 6.253C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253" />
                            </svg>
                        </span>
                        Akademik
                    </a>

                    <a href="{{ route('admin.facilities.index') }}"
                        class="admin-menu-link {{ request()->routeIs('admin.facilities.*') ? 'admin-menu-active' : 'admin-menu-default' }}">
                        <span class="admin-menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M4 20h16a2 2 0 002-2V6a2 2 0 00-2-2H4a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </span>
                        Dokumentasi Fasilitas
                    </a>

                    <a href="{{ route('admin.admin-users.index') }}"
                        class="admin-menu-link {{ request()->routeIs('admin.admin-users.*') ? 'admin-menu-active' : 'admin-menu-default' }}">

                        <span class="admin-menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">

                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 11c1.657 0 3-1.343 3-3S13.657 5 12 5 9 6.343 9 8s1.343 3 3 3z" />

                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M5.5 21a6.5 6.5 0 0113 0M19 8h2m-1-1v2" />
                            </svg>
                        </span>

                        Pengelola Admin
                    </a>

                    <div class="pt-5 mt-5 border-t border-white/10">

                        <a href="{{ url('/') }}"
                            target="_blank"
                            class="admin-menu-link admin-menu-default">
                            <span class="admin-menu-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 3h7v7M10 14L21 3M5 5h5M5 10h5M5 15h14M5 20h14" />
                                </svg>
                            </span>
                            Lihat Website
                        </a>

                    </div>

                </nav>

                {{-- Footer Sidebar --}}
                <div class="px-4 py-5 border-t border-white/10">

                    <div class="rounded-3xl bg-white/8 border border-white/10 p-4 mb-4">

                        <div class="flex items-center gap-3">

                            <div class="w-11 h-11 rounded-2xl bg-yellow-400 text-slate-900 flex items-center justify-center font-black shadow-lg">
                                A
                            </div>

                            <div>
                                <p class="text-sm font-bold text-white">
                                    Administrator
                                </p>

                                <p class="text-xs text-slate-400 mt-1">
                                    Pengelola Website
                                </p>
                            </div>

                        </div>

                    </div>

                    @if (Route::has('admin.logout'))
                        <form action="{{ route('admin.logout') }}" method="POST">
                            @csrf

                            <button
                                type="submit"
                                class="w-full flex items-center justify-center gap-3 px-4 py-3 rounded-2xl bg-red-500/10 text-red-300 hover:bg-red-500 hover:text-white transition font-bold">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1" />
                                </svg>

                                Logout
                            </button>
                        </form>
                    @endif

                </div>

            </div>

        </aside>

        {{-- Main Content --}}
        <div class="relative lg:pl-72 min-h-screen">

            {{-- Topbar --}}
            <header class="sticky top-0 z-30 bg-white/80 backdrop-blur-2xl border-b border-white/70 shadow-sm">

                <div class="h-20 px-5 md:px-8 flex items-center justify-between gap-4">

                    <div class="flex items-center gap-4 min-w-0">

                        <button
                            type="button"
                            id="openAdminSidebar"
                            class="lg:hidden w-11 h-11 rounded-2xl bg-slate-100 hover:bg-slate-200 flex items-center justify-center transition shrink-0">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-6 h-6"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">

                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                            </svg>

                        </button>

                        <div class="min-w-0">
                            <p class="hidden md:block text-xs font-bold text-blue-700 uppercase tracking-[3px]">
                                Admin Website
                            </p>

                            <h2 class="text-lg md:text-2xl font-black text-slate-800 truncate">
                                @yield('title', 'Admin Panel')
                            </h2>
                        </div>

                    </div>

                    <div class="flex items-center gap-3 shrink-0">

                        <a href="{{ url('/') }}"
                            target="_blank"
                            class="hidden md:inline-flex items-center justify-center px-5 py-3 rounded-2xl bg-blue-700 text-white font-bold hover:bg-blue-800 transition shadow-lg shadow-blue-700/20">
                            Lihat Website
                        </a>

                        <div class="hidden sm:flex items-center gap-3 rounded-2xl bg-white border border-slate-200 px-4 py-3 shadow-sm">

                            <div class="w-9 h-9 rounded-xl bg-yellow-400 text-slate-900 flex items-center justify-center font-black">
                                A
                            </div>

                            <div>
                                <p class="text-sm font-bold text-slate-800">
                                    Admin
                                </p>

                                <p class="text-xs text-slate-500">
                                    D-III Teknik Mesin
                                </p>
                            </div>

                        </div>

                    </div>

                </div>

            </header>

            {{-- Page --}}
            <main class="p-5 md:p-8">

                <div class="max-w-7xl mx-auto">

                    @yield('content')

                </div>

            </main>

        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebar = document.getElementById('adminSidebar');
            const overlay = document.getElementById('adminOverlay');
            const openButton = document.getElementById('openAdminSidebar');
            const closeButton = document.getElementById('closeAdminSidebar');

            function openSidebar() {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            }

            function closeSidebar() {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }

            if (openButton) {
                openButton.addEventListener('click', openSidebar);
            }

            if (closeButton) {
                closeButton.addEventListener('click', closeSidebar);
            }

            if (overlay) {
                overlay.addEventListener('click', closeSidebar);
            }

            window.addEventListener('resize', function () {
                if (window.innerWidth >= 1024) {
                    sidebar.classList.remove('-translate-x-full');
                    overlay.classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                }
            });
        });
    </script>

</body>

</html>