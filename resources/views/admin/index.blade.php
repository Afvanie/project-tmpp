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
    )->take(5);

    $recentPhotos = collect(
        $latestPhotos ?? []
    )->take(5);


    /*
    |--------------------------------------------------------------------------
    | RINGKASAN DATA
    |--------------------------------------------------------------------------
    */

    $summaryCards = [
        [
            'label' => 'Konten Profil',
            'value' => $dashboardStats['profile_sections'],
            'description' => 'Bagian profil yang tersedia',
            'route' => route(
                'admin.profile-contents.index'
            ),
            'icon' => 'profile',
        ],
        [
            'label' => 'Dosen',
            'value' => $dashboardStats['lecturers'],
            'description' => 'Data dosen tersimpan',
            'route' => route(
                'admin.lecturer-staff.index',
                ['type' => 'dosen']
            ),
            'icon' => 'lecturer',
        ],
        [
            'label' => 'Staf',
            'value' => $dashboardStats['staff'],
            'description' => 'Data staf tersimpan',
            'route' => route(
                'admin.lecturer-staff.index',
                ['type' => 'staff']
            ),
            'icon' => 'staff',
        ],
        [
            'label' => 'Dokumen Akademik',
            'value' => $dashboardStats['academic_documents'],
            'description' => 'Dokumen yang sudah ditambahkan',
            'route' => route(
                'admin.academic-documents.index'
            ),
            'icon' => 'document',
        ],
        [
            'label' => 'Foto Fasilitas',
            'value' => $dashboardStats['facility_photos'],
            'description' => 'Foto yang sudah diunggah',
            'route' => route(
                'admin.facilities.index'
            ),
            'icon' => 'image',
        ],
        [
            'label' => 'Pengelola Admin',
            'value' => $dashboardStats['admins'],
            'description' => 'Akun yang dapat masuk',
            'route' => route(
                'admin.admin-users.index'
            ),
            'icon' => 'admin',
        ],
    ];


    /*
    |--------------------------------------------------------------------------
    | AKSES CEPAT
    |--------------------------------------------------------------------------
    */

    $quickActions = [
        [
            'title' => 'Atur Beranda',
            'description' => 'Ubah isi utama yang tampil di halaman beranda.',
            'route' => route(
                'admin.home-content.index'
            ),
            'button' => 'Buka Beranda',
        ],
        [
            'title' => 'Atur Profil',
            'description' => 'Kelola gambaran umum, visi, misi, PPM, dan CPL.',
            'route' => route(
                'admin.profile-contents.index'
            ),
            'button' => 'Buka Profil',
        ],
        [
            'title' => 'Atur Dosen dan Staf',
            'description' => 'Tambah, ubah, atau hapus data dosen dan staf.',
            'route' => route(
                'admin.lecturer-staff.index'
            ),
            'button' => 'Buka Data',
        ],
        [
            'title' => 'Atur Akademik',
            'description' => 'Kelola pedoman, kalender, kurikulum, dan jadwal.',
            'route' => route(
                'admin.academic-documents.index'
            ),
            'button' => 'Buka Akademik',
        ],
        [
            'title' => 'Atur Fasilitas',
            'description' => 'Unggah dan kelola dokumentasi fasilitas.',
            'route' => route(
                'admin.facilities.index'
            ),
            'button' => 'Buka Fasilitas',
        ],
        [
            'title' => 'Atur Akreditasi',
            'description' => 'Kelola informasi dan dokumen akreditasi.',
            'route' => route(
                'admin.accreditations.index'
            ),
            'button' => 'Buka Akreditasi',
        ],
    ];
@endphp


<div class="space-y-6">

    {{-- ========================================================= --}}
    {{-- SAPAAN --}}
    {{-- ========================================================= --}}

    <section
        class="overflow-hidden rounded-2xl
               border border-slate-200 bg-white"
    >
        <div
            class="grid items-center gap-5
                   px-5 py-6 sm:px-6
                   lg:grid-cols-[1fr_auto]
                   lg:px-7"
        >
            <div>
                <p
                    class="text-xs font-bold uppercase
                           tracking-[0.14em]
                           text-[#075F9B]"
                >
                    Panel Pengelola Website
                </p>

                <h2
                    class="mt-2 text-2xl font-extrabold
                           tracking-tight text-slate-900
                           sm:text-3xl"
                >
                    Selamat Datang
                </h2>

                <p
                    class="mt-2 max-w-3xl text-sm
                           leading-7 text-slate-500"
                >
                    Pilih bagian yang ingin diperbarui. Semua perubahan
                    yang disimpan akan digunakan untuk mengatur website
                    Program Studi D-IV TMPP.
                </p>
            </div>


            <a
                href="{{ route('home') }}"
                target="_blank"
                rel="noopener noreferrer"
                class="inline-flex w-full items-center
                       justify-center gap-2 rounded-xl
                       bg-[#075F9B] px-5 py-3
                       text-sm font-bold text-white
                       transition hover:bg-[#064B7B]
                       sm:w-auto"
            >
                <span>Lihat Website</span>

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
                        d="M14 3h7v7M10 14L21 3M5 5h5M5 10h5M5 15h14M5 20h14"
                    />
                </svg>
            </a>
        </div>
    </section>


    {{-- ========================================================= --}}
    {{-- RINGKASAN DATA --}}
    {{-- ========================================================= --}}

    <section aria-labelledby="summaryTitle">
        <div
            class="mb-4 flex items-end
                   justify-between gap-4"
        >
            <div>
                <h2
                    id="summaryTitle"
                    class="text-lg font-extrabold
                           text-slate-900"
                >
                    Ringkasan Website
                </h2>

                <p
                    class="mt-1 text-sm text-slate-500"
                >
                    Jumlah data yang saat ini tersimpan.
                </p>
            </div>
        </div>


        <div
            class="grid gap-3
                   sm:grid-cols-2
                   xl:grid-cols-3
                   2xl:grid-cols-6"
        >
            @foreach ($summaryCards as $card)
                <a
                    href="{{ $card['route'] }}"
                    class="group rounded-2xl
                           border border-slate-200
                           bg-white p-4
                           transition
                           hover:border-blue-200
                           hover:shadow-md"
                >
                    <div
                        class="flex items-start
                               justify-between gap-4"
                    >
                        <div class="min-w-0">
                            <p
                                class="text-xs font-bold
                                       text-slate-500"
                            >
                                {{ $card['label'] }}
                            </p>

                            <p
                                class="mt-2 text-3xl
                                       font-extrabold
                                       tracking-tight
                                       text-slate-900"
                            >
                                {{ $card['value'] }}
                            </p>
                        </div>


                        <span
                            class="flex h-10 w-10
                                   shrink-0 items-center
                                   justify-center rounded-xl
                                   bg-blue-50 text-[#075F9B]
                                   transition
                                   group-hover:bg-[#075F9B]
                                   group-hover:text-white"
                        >
                            @switch($card['icon'])
                                @case('profile')
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
                                    @break

                                @case('lecturer')
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
                                            d="M12 14l9-5-9-5-9 5 9 5zM6 12v5c3 2 9 2 12 0v-5"
                                        />
                                    </svg>
                                    @break

                                @case('staff')
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
                                    @break

                                @case('document')
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
                                    @break

                                @case('image')
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
                                    @break

                                @default
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
                            @endswitch
                        </span>
                    </div>

                    <p
                        class="mt-3 text-xs
                               leading-5 text-slate-400"
                    >
                        {{ $card['description'] }}
                    </p>
                </a>
            @endforeach
        </div>
    </section>


    {{-- ========================================================= --}}
    {{-- AKSES CEPAT --}}
    {{-- ========================================================= --}}

    <section
        class="rounded-2xl border
               border-slate-200 bg-white"
        aria-labelledby="quickActionTitle"
    >
        <div
            class="border-b border-slate-200
                   px-5 py-5 sm:px-6"
        >
            <h2
                id="quickActionTitle"
                class="text-lg font-extrabold
                       text-slate-900"
            >
                Apa yang Ingin Dikelola?
            </h2>

            <p
                class="mt-1 text-sm text-slate-500"
            >
                Pilih menu sesuai bagian website yang ingin diperbarui.
            </p>
        </div>


        <div
            class="grid gap-px overflow-hidden
                   bg-slate-200
                   sm:grid-cols-2
                   xl:grid-cols-3"
        >
            @foreach ($quickActions as $action)
                <a
                    href="{{ $action['route'] }}"
                    class="group bg-white p-5
                           transition hover:bg-blue-50/60
                           sm:p-6"
                >
                    <div
                        class="flex items-start
                               justify-between gap-5"
                    >
                        <div>
                            <h3
                                class="text-sm font-extrabold
                                       text-slate-900"
                            >
                                {{ $action['title'] }}
                            </h3>

                            <p
                                class="mt-2 text-sm
                                       leading-6 text-slate-500"
                            >
                                {{ $action['description'] }}
                            </p>
                        </div>

                        <span
                            class="flex h-9 w-9
                                   shrink-0 items-center
                                   justify-center rounded-xl
                                   border border-slate-200
                                   bg-white text-slate-400
                                   transition
                                   group-hover:border-[#075F9B]
                                   group-hover:bg-[#075F9B]
                                   group-hover:text-white"
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
                                    d="M9 5l7 7-7 7"
                                />
                            </svg>
                        </span>
                    </div>

                    <p
                        class="mt-4 text-xs font-bold
                               text-[#075F9B]"
                    >
                        {{ $action['button'] }}
                    </p>
                </a>
            @endforeach
        </div>
    </section>


    {{-- ========================================================= --}}
    {{-- DATA TERBARU --}}
    {{-- ========================================================= --}}

    <div
        class="grid gap-6
               xl:grid-cols-2"
    >
        {{-- DOKUMEN TERBARU --}}
        <section
            class="overflow-hidden rounded-2xl
                   border border-slate-200
                   bg-white"
        >
            <div
                class="flex items-center
                       justify-between gap-4
                       border-b border-slate-200
                       px-5 py-5 sm:px-6"
            >
                <div>
                    <h2
                        class="text-lg font-extrabold
                               text-slate-900"
                    >
                        Dokumen Terbaru
                    </h2>

                    <p
                        class="mt-1 text-sm
                               text-slate-500"
                    >
                        Dokumen akademik yang terakhir ditambahkan.
                    </p>
                </div>

                <a
                    href="{{ route(
                        'admin.academic-documents.index'
                    ) }}"
                    class="shrink-0 text-xs
                           font-bold text-[#075F9B]
                           hover:underline"
                >
                    Lihat Semua
                </a>
            </div>


            <div class="divide-y divide-slate-100">
                @forelse ($recentDocuments as $document)
                    @php
                        $documentTitle = trim(
                            (string) (
                                $document->title
                                ?? ''
                            )
                        );

                        $documentCategory =
                            $document->category_label
                            ?? $document->category
                            ?? 'Dokumen Akademik';

                        $academicYear = trim(
                            (string) (
                                $document->academic_year
                                ?? ''
                            )
                        );

                        $documentIsActive = (bool) (
                            $document->is_active
                            ?? false
                        );
                    @endphp

                    <article
                        class="flex items-start gap-4
                               px-5 py-4
                               transition
                               hover:bg-slate-50
                               sm:px-6"
                    >
                        <span
                            class="flex h-10 w-10
                                   shrink-0 items-center
                                   justify-center rounded-xl
                                   bg-blue-50 text-[#075F9B]"
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
                                    d="M9 12h6m-6 4h6M5 4h14a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V6a2 2 0 012-2z"
                                />
                            </svg>
                        </span>


                        <div class="min-w-0 flex-1">
                            <h3
                                class="truncate text-sm
                                       font-bold text-slate-800"
                            >
                                {{ $documentTitle !== ''
                                    ? $documentTitle
                                    : 'Dokumen Akademik' }}
                            </h3>

                            <p
                                class="mt-1 truncate
                                       text-xs text-slate-500"
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
                                'px-2.5 py-1 text-[10px]',
                                'font-bold sm:inline-flex',
                                'bg-emerald-50 text-emerald-700' =>
                                    $documentIsActive,
                                'bg-slate-100 text-slate-500' =>
                                    !$documentIsActive,
                            ])
                        >
                            {{ $documentIsActive
                                ? 'Ditampilkan'
                                : 'Disembunyikan' }}
                        </span>
                    </article>
                @empty
                    <div
                        class="px-6 py-10
                               text-center"
                    >
                        <p
                            class="text-sm font-bold
                                   text-slate-700"
                        >
                            Belum ada dokumen
                        </p>

                        <p
                            class="mt-2 text-sm
                                   leading-6 text-slate-500"
                        >
                            Dokumen yang ditambahkan akan tampil di sini.
                        </p>
                    </div>
                @endforelse
            </div>
        </section>


        {{-- FOTO TERBARU --}}
        <section
            class="overflow-hidden rounded-2xl
                   border border-slate-200
                   bg-white"
        >
            <div
                class="flex items-center
                       justify-between gap-4
                       border-b border-slate-200
                       px-5 py-5 sm:px-6"
            >
                <div>
                    <h2
                        class="text-lg font-extrabold
                               text-slate-900"
                    >
                        Foto Terbaru
                    </h2>

                    <p
                        class="mt-1 text-sm
                               text-slate-500"
                    >
                        Dokumentasi fasilitas yang terakhir diunggah.
                    </p>
                </div>

                <a
                    href="{{ route(
                        'admin.facilities.index'
                    ) }}"
                    class="shrink-0 text-xs
                           font-bold text-[#075F9B]
                           hover:underline"
                >
                    Lihat Semua
                </a>
            </div>


            <div class="divide-y divide-slate-100">
                @forelse ($recentPhotos as $photo)
                    @php
                        $photoPath = trim(
                            (string) (
                                $photo->photo
                                ?? ''
                            )
                        );

                        $photoExists = $photoPath !== ''
                            && \Illuminate\Support\Facades\Storage::disk(
                                'public'
                            )->exists($photoPath);

                        $photoUrl = $photoExists
                            ? asset(
                                'storage/' . ltrim(
                                    $photoPath,
                                    '/'
                                )
                            )
                            : null;

                        $photoTitle = trim(
                            (string) (
                                $photo->title
                                ?? ''
                            )
                        );

                        $facilityTitle = trim(
                            (string) optional(
                                $photo->facility
                            )->title
                        );

                        $photoIsActive = (bool) (
                            $photo->is_active
                            ?? false
                        );
                    @endphp

                    <article
                        class="flex items-center gap-4
                               px-5 py-4
                               transition
                               hover:bg-slate-50
                               sm:px-6"
                    >
                        <div
                            class="h-12 w-16 shrink-0
                                   overflow-hidden rounded-xl
                                   bg-slate-100"
                        >
                            @if ($photoUrl)
                                <img
                                    src="{{ $photoUrl }}"
                                    alt="{{ $photoTitle !== ''
                                        ? $photoTitle
                                        : 'Foto dokumentasi fasilitas' }}"
                                    class="h-full w-full
                                           object-cover"
                                    loading="lazy"
                                >
                            @else
                                <div
                                    class="flex h-full w-full
                                           items-center justify-center
                                           text-slate-400"
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
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16M4 20h16a2 2 0 002-2V6a2 2 0 00-2-2H4a2 2 0 00-2 2v12a2 2 0 002 2z"
                                        />
                                    </svg>
                                </div>
                            @endif
                        </div>


                        <div class="min-w-0 flex-1">
                            <h3
                                class="truncate text-sm
                                       font-bold text-slate-800"
                            >
                                {{ $photoTitle !== ''
                                    ? $photoTitle
                                    : 'Foto Dokumentasi' }}
                            </h3>

                            <p
                                class="mt-1 truncate
                                       text-xs text-slate-500"
                            >
                                {{ $facilityTitle !== ''
                                    ? $facilityTitle
                                    : 'Dokumentasi Fasilitas' }}
                            </p>
                        </div>


                        <span
                            @class([
                                'hidden shrink-0 rounded-full',
                                'px-2.5 py-1 text-[10px]',
                                'font-bold sm:inline-flex',
                                'bg-emerald-50 text-emerald-700' =>
                                    $photoIsActive,
                                'bg-slate-100 text-slate-500' =>
                                    !$photoIsActive,
                            ])
                        >
                            {{ $photoIsActive
                                ? 'Ditampilkan'
                                : 'Disembunyikan' }}
                        </span>
                    </article>
                @empty
                    <div
                        class="px-6 py-10
                               text-center"
                    >
                        <p
                            class="text-sm font-bold
                                   text-slate-700"
                        >
                            Belum ada foto
                        </p>

                        <p
                            class="mt-2 text-sm
                                   leading-6 text-slate-500"
                        >
                            Foto yang diunggah akan tampil di sini.
                        </p>
                    </div>
                @endforelse
            </div>
        </section>
    </div>

</div>

@endsection
