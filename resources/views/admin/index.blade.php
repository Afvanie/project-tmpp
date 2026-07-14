@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

@php
    /*
    |--------------------------------------------------------------------------
    | DATA DASHBOARD
    |--------------------------------------------------------------------------
    */

    $dashboardStats = [
        'profile_sections' => (int) (
            $stats['profile_sections'] ?? 0
        ),

        'lecturers' => (int) (
            $stats['lecturers'] ?? 0
        ),

        'staff' => (int) (
            $stats['staff'] ?? 0
        ),

        'academic_documents' => (int) (
            $stats['academic_documents'] ?? 0
        ),

        'facility_photos' => (int) (
            $stats['facility_photos'] ?? 0
        ),

        'admins' => (int) (
            $stats['admins'] ?? 0
        ),
    ];

    $recentDocuments = collect(
        $latestDocuments ?? []
    );

    $recentPhotos = collect(
        $latestPhotos ?? []
    );

    /*
    |--------------------------------------------------------------------------
    | LOGO
    |--------------------------------------------------------------------------
    */

    $logoRelativePath = 'assets/images/logo.png';

    $logoAvailable = file_exists(
        public_path($logoRelativePath)
    );

    /*
    |--------------------------------------------------------------------------
    | KARTU STATISTIK
    |--------------------------------------------------------------------------
    */

    $statCards = [
        [
            'title' => 'Total Dosen',
            'value' => $dashboardStats['lecturers'],
            'route' => route(
                'admin.lecturer-staff.index',
                ['type' => 'dosen']
            ),
            'link' => 'Kelola Dosen',
            'theme' => 'blue',
            'icon' => 'lecturer',
        ],

        [
            'title' => 'Total Staf',
            'value' => $dashboardStats['staff'],
            'route' => route(
                'admin.lecturer-staff.index',
                ['type' => 'staff']
            ),
            'link' => 'Kelola Staf',
            'theme' => 'yellow',
            'icon' => 'staff',
        ],

        [
            'title' => 'Dokumen Akademik',
            'value' => $dashboardStats['academic_documents'],
            'route' => route(
                'admin.academic-documents.index'
            ),
            'link' => 'Kelola Akademik',
            'theme' => 'blue',
            'icon' => 'document',
        ],

        [
            'title' => 'Foto Fasilitas',
            'value' => $dashboardStats['facility_photos'],
            'route' => route(
                'admin.facilities.index'
            ),
            'link' => 'Kelola Foto',
            'theme' => 'yellow',
            'icon' => 'image',
        ],

        [
            'title' => 'Akun Admin',
            'value' => $dashboardStats['admins'],
            'route' => route(
                'admin.admin-users.index'
            ),
            'link' => 'Kelola Admin',
            'theme' => 'blue',
            'icon' => 'admin',
        ],
    ];
@endphp


<div class="space-y-8">

    {{-- ========================================================= --}}
    {{-- WELCOME HERO --}}
    {{-- ========================================================= --}}

    <section
        class="relative overflow-hidden
               rounded-[2rem] bg-[#06172E]
               text-white shadow-2xl
               md:rounded-[2.5rem]"
    >
        {{-- Background Decoration --}}
        <div
            class="pointer-events-none absolute inset-0"
            aria-hidden="true"
        >
            <div
                class="absolute -right-32 -top-32
                       h-[420px] w-[420px]
                       rounded-full bg-blue-500/30
                       blur-3xl"
            ></div>

            <div
                class="absolute -bottom-32 -left-32
                       h-[420px] w-[420px]
                       rounded-full bg-yellow-400/20
                       blur-3xl"
            ></div>

            <div
                class="absolute inset-0 opacity-[0.08]"
                style="
                    background-image:
                        linear-gradient(
                            #ffffff 1px,
                            transparent 1px
                        ),
                        linear-gradient(
                            to right,
                            #ffffff 1px,
                            transparent 1px
                        );
                    background-size: 70px 70px;
                "
            ></div>
        </div>


        <div
            class="relative z-10 grid
                   items-center gap-8
                   p-6 sm:p-7 md:p-10
                   lg:grid-cols-12"
        >
            {{-- Text --}}
            <div class="lg:col-span-8">

                <span
                    class="inline-flex rounded-full
                           border border-yellow-400/40
                           bg-yellow-400/20
                           px-5 py-2 text-sm
                           font-bold text-yellow-300"
                >
                    ADMIN WEBSITE
                </span>

                <h1
                    class="mt-6 text-3xl font-black
                           leading-tight md:text-5xl"
                >
                    Dashboard Pengelolaan Website
                </h1>

                <p
                    class="mt-5 max-w-3xl
                           leading-8 text-white/80"
                >
                    Kelola konten website Program Studi D-IV Teknik
                    Mesin Produksi dan Perawatan Politeknik Negeri
                    Malang, mulai dari profil, dosen dan staf,
                    dokumen akademik, dokumentasi fasilitas, hingga
                    akun pengelola admin.
                </p>

                <div class="mt-8 flex flex-wrap gap-3">

                    <a
                        href="{{ route('home') }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="inline-flex items-center
                               justify-center rounded-2xl
                               bg-yellow-400 px-6 py-3
                               font-bold text-slate-900
                               transition hover:bg-yellow-300"
                    >
                        Lihat Website
                    </a>

                    <a
                        href="{{ route(
                            'admin.profile-contents.index'
                        ) }}"
                        class="inline-flex items-center
                               justify-center rounded-2xl
                               border border-white/15
                               bg-white/10 px-6 py-3
                               font-bold text-white
                               transition hover:bg-white/20"
                    >
                        Kelola Konten
                    </a>
                </div>
            </div>


            {{-- Program Summary --}}
            <div class="lg:col-span-4">

                <div
                    class="rounded-[2rem] border
                           border-white/15 bg-white/10
                           p-6 backdrop-blur"
                >
                    <div class="flex items-center gap-4">

                        <div
                            class="flex h-16 w-16 shrink-0
                                   items-center justify-center
                                   rounded-3xl bg-white
                                   shadow-xl"
                        >
                            @if ($logoAvailable)
                                <img
                                    src="{{ asset(
                                        $logoRelativePath
                                    ) }}"
                                    alt="Logo Politeknik Negeri Malang"
                                    class="h-12 w-12 object-contain"
                                >
                            @else
                                <span
                                    class="font-black text-blue-800"
                                >
                                    TM
                                </span>
                            @endif
                        </div>

                        <div>
                            <p class="text-sm text-white/60">
                                Program Studi
                            </p>

                            <h2 class="text-xl font-black">
                                D-IV TMPP
                            </h2>
                        </div>
                    </div>

                    <div class="mt-6 h-px bg-white/15"></div>

                    <div class="mt-6 grid grid-cols-2 gap-4">

                        <div>
                            <p
                                class="text-3xl font-black
                                       text-yellow-300"
                            >
                                {{ $dashboardStats[
                                    'profile_sections'
                                ] }}
                            </p>

                            <p
                                class="mt-1 text-xs
                                       text-white/60"
                            >
                                Konten Profil
                            </p>
                        </div>

                        <div>
                            <p
                                class="text-3xl font-black
                                       text-yellow-300"
                            >
                                {{ $dashboardStats['admins'] }}
                            </p>

                            <p
                                class="mt-1 text-xs
                                       text-white/60"
                            >
                                Akun Admin
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- ========================================================= --}}
    {{-- STATISTIC CARDS --}}
    {{-- ========================================================= --}}

    <section
        class="grid gap-6
               sm:grid-cols-2
               xl:grid-cols-5"
        aria-label="Statistik website"
    >
        @foreach ($statCards as $card)

            @php
                $isBlue = $card['theme'] === 'blue';
            @endphp

            <article
                class="group rounded-[2rem]
                       border border-slate-100
                       bg-white/95 p-6 shadow-xl
                       backdrop-blur transition-all
                       duration-300 hover:-translate-y-1
                       hover:shadow-2xl"
            >
                <div
                    class="flex items-start
                           justify-between gap-4"
                >
                    <div>
                        <p
                            class="text-sm font-bold
                                   text-slate-500"
                        >
                            {{ $card['title'] }}
                        </p>

                        <h2
                            class="mt-3 text-4xl font-black
                                   text-slate-800"
                        >
                            {{ $card['value'] }}
                        </h2>
                    </div>

                    <div
                        @class([
                            'flex h-14 w-14 shrink-0',
                            'items-center justify-center',
                            'rounded-2xl shadow-lg',
                            'bg-blue-700 text-white' => $isBlue,
                            'bg-yellow-400 text-slate-900' => !$isBlue,
                        ])
                    >
                        @if ($card['icon'] === 'lecturer')

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-7 w-7"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 14l9-5-9-5-9 5 9 5z"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 14l6.16-3.422A12.083 12.083 0 0112 21.5a12.083 12.083 0 01-6.16-10.922L12 14z"
                                />
                            </svg>

                        @elseif ($card['icon'] === 'staff')

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-7 w-7"
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

                        @elseif ($card['icon'] === 'document')

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-7 w-7"
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

                        @elseif ($card['icon'] === 'image')

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-7 w-7"
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

                        @else

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-7 w-7"
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

                        @endif
                    </div>
                </div>

                <a
                    href="{{ $card['route'] }}"
                    class="mt-6 inline-flex
                           text-sm font-bold
                           text-blue-700
                           transition hover:underline"
                >
                    {{ $card['link'] }} →
                </a>
            </article>

        @endforeach
    </section>


    {{-- ========================================================= --}}
    {{-- AKSES CEPAT DAN DOKUMEN TERBARU --}}
    {{-- ========================================================= --}}

    <div class="grid gap-8 xl:grid-cols-12">

        {{-- ===================================================== --}}
        {{-- AKSES CEPAT --}}
        {{-- ===================================================== --}}

        <section class="xl:col-span-5">

            <div
                class="overflow-hidden rounded-[2rem]
                       border border-slate-100
                       bg-white/95 shadow-xl
                       backdrop-blur"
            >
                <div
                    class="h-2 bg-gradient-to-r
                           from-blue-700 via-yellow-400
                           to-blue-700"
                ></div>

                <div class="p-6 sm:p-7 md:p-8">

                    <h2
                        class="text-2xl font-black
                               text-slate-800"
                    >
                        Akses Cepat
                    </h2>

                    <p class="mt-2 text-slate-500">
                        Pilih bagian website yang akan dikelola.
                    </p>

                    <div
                        class="mt-7 grid gap-4
                               sm:grid-cols-2"
                    >
                        {{-- Profil --}}
                        <a
                            href="{{ route(
                                'admin.profile-contents.index'
                            ) }}"
                            class="group rounded-3xl
                                   border border-slate-100
                                   bg-slate-50 p-5
                                   transition hover:bg-blue-700
                                   hover:text-white"
                        >
                            <div
                                class="flex h-12 w-12
                                       items-center justify-center
                                       rounded-2xl bg-blue-700
                                       text-white
                                       group-hover:bg-white/20"
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
                                        d="M9 12h6m-6 4h6M5 4h14a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V6a2 2 0 012-2z"
                                    />
                                </svg>
                            </div>

                            <h3 class="mt-4 font-bold">
                                Konten Profil
                            </h3>

                            <p
                                class="mt-2 text-sm
                                       leading-6 text-slate-500
                                       group-hover:text-white/75"
                            >
                                Visi, misi, tujuan, PPM, dan CPL.
                            </p>
                        </a>


                        {{-- Dosen dan Staf --}}
                        <a
                            href="{{ route(
                                'admin.lecturer-staff.index'
                            ) }}"
                            class="group rounded-3xl
                                   border border-slate-100
                                   bg-slate-50 p-5
                                   transition hover:bg-blue-700
                                   hover:text-white"
                        >
                            <div
                                class="flex h-12 w-12
                                       items-center justify-center
                                       rounded-2xl bg-yellow-400
                                       text-slate-900
                                       group-hover:bg-white/20
                                       group-hover:text-white"
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
                                        d="M17 20h5v-2a4 4 0 00-5-3.87M9 20H4v-2a4 4 0 015-3.87M12 12a4 4 0 100-8 4 4 0 000 8z"
                                    />
                                </svg>
                            </div>

                            <h3 class="mt-4 font-bold">
                                Dosen dan Staf
                            </h3>

                            <p
                                class="mt-2 text-sm
                                       leading-6 text-slate-500
                                       group-hover:text-white/75"
                            >
                                Data tenaga pendidik dan tenaga
                                kependidikan.
                            </p>
                        </a>


                        {{-- Akademik --}}
                        <a
                            href="{{ route(
                                'admin.academic-documents.index'
                            ) }}"
                            class="group rounded-3xl
                                   border border-slate-100
                                   bg-slate-50 p-5
                                   transition hover:bg-blue-700
                                   hover:text-white"
                        >
                            <div
                                class="flex h-12 w-12
                                       items-center justify-center
                                       rounded-2xl bg-blue-700
                                       text-white
                                       group-hover:bg-white/20"
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
                                        d="M12 6.253v13M12 6.253C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13"
                                    />
                                </svg>
                            </div>

                            <h3 class="mt-4 font-bold">
                                Akademik
                            </h3>

                            <p
                                class="mt-2 text-sm
                                       leading-6 text-slate-500
                                       group-hover:text-white/75"
                            >
                                Pedoman, kalender, kurikulum,
                                jadwal, dan dokumen lainnya.
                            </p>
                        </a>


                        {{-- Fasilitas --}}
                        <a
                            href="{{ route(
                                'admin.facilities.index'
                            ) }}"
                            class="group rounded-3xl
                                   border border-slate-100
                                   bg-slate-50 p-5
                                   transition hover:bg-blue-700
                                   hover:text-white"
                        >
                            <div
                                class="flex h-12 w-12
                                       items-center justify-center
                                       rounded-2xl bg-yellow-400
                                       text-slate-900
                                       group-hover:bg-white/20
                                       group-hover:text-white"
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
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16M4 20h16a2 2 0 002-2V6a2 2 0 00-2-2H4a2 2 0 00-2 2v12a2 2 0 002 2z"
                                    />
                                </svg>
                            </div>

                            <h3 class="mt-4 font-bold">
                                Dokumentasi Fasilitas
                            </h3>

                            <p
                                class="mt-2 text-sm
                                       leading-6 text-slate-500
                                       group-hover:text-white/75"
                            >
                                Foto fasilitas dan aktivitas
                                mahasiswa.
                            </p>
                        </a>
                    </div>
                </div>
            </div>
        </section>


        {{-- ===================================================== --}}
        {{-- DOKUMEN TERBARU --}}
        {{-- ===================================================== --}}

        <section class="xl:col-span-7">

            <div
                class="overflow-hidden rounded-[2rem]
                       border border-slate-100
                       bg-white/95 shadow-xl
                       backdrop-blur"
            >
                <div
                    class="border-b border-slate-100
                           p-6 sm:p-7 md:p-8"
                >
                    <div
                        class="flex flex-col gap-4
                               sm:flex-row sm:items-center
                               sm:justify-between"
                    >
                        <div>
                            <h2
                                class="text-2xl font-black
                                       text-slate-800"
                            >
                                Dokumen Akademik Terbaru
                            </h2>

                            <p class="mt-2 text-slate-500">
                                Dokumen yang terakhir ditambahkan
                                melalui halaman admin.
                            </p>
                        </div>

                        <a
                            href="{{ route(
                                'admin.academic-documents.index'
                            ) }}"
                            class="shrink-0 text-sm
                                   font-bold text-blue-700
                                   transition hover:underline"
                        >
                            Lihat Semua
                        </a>
                    </div>
                </div>


                <div class="divide-y divide-slate-100">

                    @forelse ($recentDocuments as $document)

                        @php
                            $documentTitle = trim(
                                (string) $document->title
                            );

                            $documentCategory =
                                $document->category_label
                                ?? $document->category
                                ?? '-';

                            $academicYear = trim(
                                (string) $document->academic_year
                            );
                        @endphp

                        <article
                            class="flex items-start gap-4
                                   p-6 transition
                                   hover:bg-slate-50/70"
                        >
                            <div
                                class="flex h-12 w-12 shrink-0
                                       items-center justify-center
                                       rounded-2xl bg-blue-700
                                       text-white shadow-lg"
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
                                        d="M9 12h6m-6 4h6M5 4h14a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V6a2 2 0 012-2z"
                                    />
                                </svg>
                            </div>

                            <div class="min-w-0 flex-1">

                                <h3
                                    class="truncate font-bold
                                           text-slate-800"
                                >
                                    {{ $documentTitle !== ''
                                        ? $documentTitle
                                        : 'Dokumen Akademik' }}
                                </h3>

                                <p
                                    class="mt-1 text-sm
                                           text-slate-500"
                                >
                                    {{ $documentCategory }}

                                    @if ($academicYear !== '')
                                        <span aria-hidden="true">
                                            •
                                        </span>

                                        {{ $academicYear }}
                                    @endif
                                </p>
                            </div>

                            <span
                                @class([
                                    'hidden shrink-0 rounded-full',
                                    'px-3 py-1 text-xs font-bold',
                                    'sm:inline-flex',
                                    'bg-green-50 text-green-700' =>
                                        $document->is_active,
                                    'bg-red-50 text-red-700' =>
                                        !$document->is_active,
                                ])
                            >
                                {{ $document->is_active
                                    ? 'Aktif'
                                    : 'Nonaktif' }}
                            </span>
                        </article>

                    @empty

                        <div class="p-10 text-center">

                            <h3
                                class="text-xl font-bold
                                       text-slate-800"
                            >
                                Belum Ada Dokumen
                            </h3>

                            <p class="mt-2 text-slate-500">
                                Dokumen akademik yang ditambahkan
                                akan tampil di bagian ini.
                            </p>
                        </div>

                    @endforelse
                </div>
            </div>
        </section>
    </div>


    {{-- ========================================================= --}}
    {{-- FOTO DOKUMENTASI TERBARU --}}
    {{-- ========================================================= --}}

    <section
        class="overflow-hidden rounded-[2rem]
               border border-slate-100
               bg-white/95 shadow-xl backdrop-blur"
    >
        <div
            class="border-b border-slate-100
                   p-6 sm:p-7 md:p-8"
        >
            <div
                class="flex flex-col gap-4
                       sm:flex-row sm:items-center
                       sm:justify-between"
            >
                <div>
                    <h2
                        class="text-2xl font-black
                               text-slate-800"
                    >
                        Foto Dokumentasi Terbaru
                    </h2>

                    <p class="mt-2 text-slate-500">
                        Foto fasilitas dan aktivitas mahasiswa
                        yang terakhir diunggah.
                    </p>
                </div>

                <a
                    href="{{ route('admin.facilities.index') }}"
                    class="shrink-0 text-sm
                           font-bold text-blue-700
                           transition hover:underline"
                >
                    Kelola Foto
                </a>
            </div>
        </div>


        <div class="p-6 md:p-8">

            @if ($recentPhotos->isNotEmpty())

                <div
                    class="grid gap-5
                           sm:grid-cols-2
                           lg:grid-cols-5"
                >
                    @foreach ($recentPhotos as $photo)

                        @php
                            $photoPath = trim(
                                (string) $photo->photo
                            );

                            $photoExists = $photoPath !== ''
                                && \Illuminate\Support\Facades\Storage::disk(
                                    'public'
                                )->exists($photoPath);

                            $photoUrl = $photoExists
                                ? asset(
                                    'storage/' . $photoPath
                                )
                                : null;

                            $photoTitle = trim(
                                (string) $photo->title
                            );

                            $facilityTitle = trim(
                                (string) optional(
                                    $photo->facility
                                )->title
                            );
                        @endphp

                        <article
                            class="group overflow-hidden
                                   rounded-3xl border
                                   border-slate-100
                                   bg-slate-50 transition-all
                                   duration-300
                                   hover:-translate-y-1
                                   hover:shadow-xl"
                        >
                            <div
                                class="h-40 overflow-hidden
                                       bg-slate-100"
                            >
                                @if ($photoUrl)

                                    <img
                                        src="{{ $photoUrl }}"
                                        alt="Dokumentasi {{ $photoTitle !== ''
                                            ? $photoTitle
                                            : $facilityTitle }}"
                                        class="h-full w-full
                                               object-cover
                                               transition duration-700
                                               group-hover:scale-110"
                                        loading="lazy"
                                    >

                                @else

                                    <div
                                        class="flex h-full w-full
                                               flex-col items-center
                                               justify-center px-4
                                               text-center"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-9 w-9
                                                   text-red-500"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            aria-hidden="true"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M12 9v2m0 4h.01M5.07 19h13.86a2 2 0 001.73-3L13.73 4a2 2 0 00-3.46 0L3.34 16a2 2 0 001.73 3z"
                                            />
                                        </svg>

                                        <p
                                            class="mt-2 text-xs
                                                   font-bold text-red-600"
                                        >
                                            File tidak ditemukan
                                        </p>
                                    </div>

                                @endif
                            </div>


                            <div class="p-4">

                                <h3
                                    class="truncate font-bold
                                           text-slate-800"
                                >
                                    {{ $photoTitle !== ''
                                        ? $photoTitle
                                        : 'Foto Dokumentasi' }}
                                </h3>

                                <p
                                    class="mt-1 truncate
                                           text-sm text-slate-500"
                                >
                                    {{ $facilityTitle !== ''
                                        ? $facilityTitle
                                        : 'Dokumentasi Fasilitas' }}
                                </p>

                                <span
                                    @class([
                                        'mt-3 inline-flex',
                                        'rounded-full px-3 py-1',
                                        'text-xs font-bold',
                                        'bg-green-50 text-green-700' =>
                                            $photo->is_active,
                                        'bg-red-50 text-red-700' =>
                                            !$photo->is_active,
                                    ])
                                >
                                    {{ $photo->is_active
                                        ? 'Aktif'
                                        : 'Nonaktif' }}
                                </span>
                            </div>
                        </article>

                    @endforeach
                </div>

            @else

                <div
                    class="rounded-3xl border
                           border-slate-100 bg-slate-50
                           p-10 text-center"
                >
                    <h3
                        class="text-xl font-bold
                               text-slate-800"
                    >
                        Belum Ada Foto Dokumentasi
                    </h3>

                    <p class="mt-2 text-slate-500">
                        Foto yang diunggah melalui menu dokumentasi
                        fasilitas akan tampil di bagian ini.
                    </p>
                </div>

            @endif
        </div>
    </section>

</div>

@endsection