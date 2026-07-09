<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Teknik Mesin')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-slate-100">

    <div class="min-h-screen flex">

        {{-- Sidebar --}}
        <aside class="w-64 min-h-screen bg-slate-900 text-white hidden md:flex md:flex-col">

            {{-- Brand --}}
            <div class="p-6 border-b border-white/10">

                <h1 class="text-xl font-bold">
                    Admin Teknik Mesin
                </h1>

                <p class="text-sm text-slate-400 mt-1">
                    Panel Administrator
                </p>

            </div>

            {{-- Menu --}}
            <nav class="p-4 space-y-2 flex-1">

                <a href="{{ route('admin.dashboard') }}"
                class="block px-4 py-3 rounded-xl transition
                {{ request()->routeIs('admin.dashboard') ? 'bg-blue-700 text-white' : 'hover:bg-white/10 text-slate-300' }}">
                    Dashboard
                </a>

                <a href="{{ route('admin.profile-contents.index') }}"
                class="block px-4 py-3 rounded-xl transition
                {{ request()->routeIs('admin.profile-contents.*') ? 'bg-blue-700 text-white' : 'hover:bg-white/10 text-slate-300' }}">
                    Konten Profil
                </a>

                <a href="{{ route('admin.lecturer-staff.index') }}"
                class="block px-4 py-3 rounded-xl transition
                {{ request()->routeIs('admin.lecturer-staff.*') ? 'bg-blue-700 text-white' : 'hover:bg-white/10 text-slate-300' }}">
                    Dosen & Staff
                </a>

                <a href="{{ route('admin.academic-documents.index') }}"
                class="block px-4 py-3 rounded-xl transition
                {{ request()->routeIs('admin.academic-documents.*') ? 'bg-blue-700 text-white' : 'hover:bg-white/10 text-slate-300' }}">
                    Akademik
                </a>

                <a href="{{ route('admin.facilities.index') }}"
                class="block px-4 py-3 rounded-xl transition
                {{ request()->routeIs('admin.facilities.*') ? 'bg-blue-700 text-white' : 'hover:bg-white/10 text-slate-300' }}">
                    Dokumentasi Fasilitas
                </a>


                <a href="/"
                class="block px-4 py-3 rounded-xl hover:bg-white/10 text-slate-300 transition">
                    Lihat Website
                </a>

                

            </nav>

            {{-- Logout Bottom Left --}}
            <div class="p-4 border-t border-white/10">

                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf

                    <button type="submit"
                            class="w-full flex items-center gap-3 px-4 py-3 rounded-xl bg-white/5 text-yellow-300 hover:bg-yellow-400 hover:text-slate-900 font-semibold transition">

                        <span class="w-9 h-9 rounded-lg bg-yellow-400/10 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">

                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H9m4 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1" />

                            </svg>
                        </span>

                        <span>
                            Logout
                        </span>

                    </button>

                </form>

            </div>

        </aside>

        {{-- Main Content --}}
        <main class="flex-1">

            <header class="bg-white border-b border-slate-200 px-6 py-4">

                <h2 class="font-semibold text-slate-700">
                    @yield('title', 'Admin Panel')
                </h2>

            </header>

            <div>
                @yield('content')
            </div>

        </main>

    </div>

</body>
</html>