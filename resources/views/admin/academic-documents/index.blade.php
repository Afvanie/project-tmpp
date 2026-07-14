@extends('layouts.admin')

@section('title', 'Dokumen Akademik')

@section('content')

@php
    /*
    |--------------------------------------------------------------------------
    | KOLEKSI DOKUMEN
    |--------------------------------------------------------------------------
    */

    $documentCollection = $documents instanceof \Illuminate\Pagination\AbstractPaginator
        ? $documents->getCollection()
        : collect($documents);

    $totalDocuments = $documentCollection->count();

    $activeDocuments = $documentCollection
        ->where('is_active', true)
        ->count();

    $inactiveDocuments = $documentCollection
        ->where('is_active', false)
        ->count();

    /*
    |--------------------------------------------------------------------------
    | INFORMASI FILE DAN TAUTAN
    |--------------------------------------------------------------------------
    */

    $getDocumentMeta = function ($document): array {
        $filePath = trim((string) $document->file_path);

        $fileExists = $filePath !== ''
            && \Illuminate\Support\Facades\Storage::disk('public')
                ->exists($filePath);

        $fileUrl = $fileExists
            ? asset('storage/' . $filePath)
            : null;

        $externalLink = trim(
            (string) $document->external_link
        );

        $externalScheme = $externalLink !== ''
            ? strtolower(
                (string) parse_url(
                    $externalLink,
                    PHP_URL_SCHEME
                )
            )
            : '';

        $hasSafeExternalLink = $externalLink !== ''
            && filter_var(
                $externalLink,
                FILTER_VALIDATE_URL
            )
            && in_array(
                $externalScheme,
                ['http', 'https'],
                true
            );

        $categoryLabel = trim(
            (string) (
                $document->category_label
                ?? $document->category
            )
        );

        $searchText = \Illuminate\Support\Str::lower(
            implode(' ', [
                (string) $document->title,
                $categoryLabel,
                (string) $document->academic_year,
                (string) $document->description,
            ])
        );

        return [
            'file_path' => $filePath,
            'file_exists' => $fileExists,
            'file_url' => $fileUrl,
            'external_link' => $externalLink,
            'has_safe_external_link' => $hasSafeExternalLink,
            'category_label' => $categoryLabel,
            'search_text' => $searchText,
        ];
    };
@endphp


<div class="space-y-8">

    {{-- ========================================================= --}}
    {{-- HEADER --}}
    {{-- ========================================================= --}}

    <div
        class="flex flex-col gap-5
               lg:flex-row lg:items-center
               lg:justify-between"
    >
        <div>
            <h1
                class="text-3xl font-black
                       text-slate-800 md:text-4xl"
            >
                Dokumen Akademik
            </h1>

            <p
                class="mt-3 max-w-4xl
                       leading-7 text-slate-500"
            >
                Kelola Pedoman Akademik, Kalender Akademik,
                Kurikulum, Jadwal Kuliah, Laporan Ketercapaian,
                Panduan Tugas Akhir, dan Panduan Magang Industri
                Program Studi D-IV Teknik Mesin Produksi dan
                Perawatan.
            </p>
        </div>

        <a
            href="{{ route('admin.academic-documents.create') }}"
            class="inline-flex items-center
                   justify-center gap-3 rounded-2xl
                   bg-blue-700 px-6 py-4
                   font-bold text-white shadow-lg
                   shadow-blue-700/20 transition
                   hover:bg-blue-800"
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
                    d="M12 4v16m8-8H4"
                />
            </svg>

            Tambah Dokumen
        </a>
    </div>


    {{-- ========================================================= --}}
    {{-- ALERT --}}
    {{-- ========================================================= --}}

    @if (session('success'))
        <div
            class="rounded-2xl border
                   border-green-200 bg-green-50
                   px-6 py-4 font-semibold
                   text-green-700"
            role="alert"
        >
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div
            class="rounded-2xl border
                   border-red-200 bg-red-50
                   px-6 py-4 text-red-700"
            role="alert"
        >
            <p class="font-bold">
                Terdapat data yang perlu diperbaiki.
            </p>

            <ul class="mt-3 list-disc space-y-1 pl-5 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {{-- ========================================================= --}}
    {{-- STATISTIK --}}
    {{-- ========================================================= --}}

    <div class="grid gap-6 md:grid-cols-3">

        {{-- Total --}}
        <div
            class="rounded-[2rem] border
                   border-slate-100 bg-white/95
                   p-6 shadow-xl backdrop-blur"
        >
            <div
                class="flex items-center
                       justify-between gap-4"
            >
                <div>
                    <p
                        class="text-sm font-bold
                               text-slate-500"
                    >
                        Total Dokumen
                    </p>

                    <h2
                        class="mt-3 text-4xl font-black
                               text-slate-800"
                    >
                        {{ $totalDocuments }}
                    </h2>
                </div>

                <div
                    class="flex h-14 w-14
                           items-center justify-center
                           rounded-2xl bg-blue-700
                           text-white shadow-lg"
                >
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
                </div>
            </div>
        </div>


        {{-- Aktif --}}
        <div
            class="rounded-[2rem] border
                   border-slate-100 bg-white/95
                   p-6 shadow-xl backdrop-blur"
        >
            <div
                class="flex items-center
                       justify-between gap-4"
            >
                <div>
                    <p
                        class="text-sm font-bold
                               text-slate-500"
                    >
                        Dokumen Aktif
                    </p>

                    <h2
                        class="mt-3 text-4xl font-black
                               text-slate-800"
                    >
                        {{ $activeDocuments }}
                    </h2>
                </div>

                <div
                    class="flex h-14 w-14
                           items-center justify-center
                           rounded-2xl bg-green-600
                           text-white shadow-lg"
                >
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
                            d="M5 13l4 4L19 7"
                        />
                    </svg>
                </div>
            </div>
        </div>


        {{-- Nonaktif --}}
        <div
            class="rounded-[2rem] border
                   border-slate-100 bg-white/95
                   p-6 shadow-xl backdrop-blur"
        >
            <div
                class="flex items-center
                       justify-between gap-4"
            >
                <div>
                    <p
                        class="text-sm font-bold
                               text-slate-500"
                    >
                        Dokumen Nonaktif
                    </p>

                    <h2
                        class="mt-3 text-4xl font-black
                               text-slate-800"
                    >
                        {{ $inactiveDocuments }}
                    </h2>
                </div>

                <div
                    class="flex h-14 w-14
                           items-center justify-center
                           rounded-2xl bg-yellow-400
                           text-slate-900 shadow-lg"
                >
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
                            d="M12 8v4m0 4h.01M21 12A9 9 0 113 12a9 9 0 0118 0z"
                        />
                    </svg>
                </div>
            </div>
        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- MAIN CARD --}}
    {{-- ========================================================= --}}

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


        {{-- ===================================================== --}}
        {{-- TOOLBAR --}}
        {{-- ===================================================== --}}

        <div
            class="border-b border-slate-100
                   p-6 md:p-8"
        >
            <div
                class="flex flex-col gap-5
                       lg:flex-row lg:items-center
                       lg:justify-between"
            >
                <div>
                    <h2
                        class="text-2xl font-black
                               text-slate-800"
                    >
                        Daftar Dokumen Akademik
                    </h2>

                    <p class="mt-2 text-slate-500">
                        Dokumen aktif akan tampil pada halaman
                        akademik website publik.
                    </p>
                </div>

                <div class="relative w-full lg:w-96">
                    <label
                        for="academicDocumentSearch"
                        class="sr-only"
                    >
                        Cari dokumen akademik
                    </label>

                    <input
                        type="search"
                        id="academicDocumentSearch"
                        placeholder="Cari judul, kategori, atau tahun..."
                        autocomplete="off"
                        class="w-full rounded-2xl
                               border border-slate-200
                               bg-slate-50 px-5 py-4
                               pl-12 transition
                               focus:bg-white
                               focus:outline-none
                               focus:ring-2
                               focus:ring-blue-500"
                    >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="absolute left-4 top-1/2
                               h-5 w-5 -translate-y-1/2
                               text-slate-400"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        aria-hidden="true"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z"
                        />
                    </svg>
                </div>
            </div>
        </div>


        {{-- ===================================================== --}}
        {{-- DESKTOP TABLE --}}
        {{-- ===================================================== --}}

        <div class="hidden overflow-x-auto xl:block">

            <table class="w-full">

                <thead
                    class="border-b border-slate-100
                           bg-slate-50"
                >
                    <tr>
                        <th
                            class="px-6 py-4 text-left
                                   text-xs font-bold uppercase
                                   tracking-wider text-slate-500"
                        >
                            Dokumen
                        </th>

                        <th
                            class="px-6 py-4 text-left
                                   text-xs font-bold uppercase
                                   tracking-wider text-slate-500"
                        >
                            Kategori
                        </th>

                        <th
                            class="px-6 py-4 text-left
                                   text-xs font-bold uppercase
                                   tracking-wider text-slate-500"
                        >
                            Tahun
                        </th>

                        <th
                            class="px-6 py-4 text-left
                                   text-xs font-bold uppercase
                                   tracking-wider text-slate-500"
                        >
                            Status
                        </th>

                        <th
                            class="px-6 py-4 text-left
                                   text-xs font-bold uppercase
                                   tracking-wider text-slate-500"
                        >
                            File / Tautan
                        </th>

                        <th
                            class="px-6 py-4 text-right
                                   text-xs font-bold uppercase
                                   tracking-wider text-slate-500"
                        >
                            Aksi
                        </th>
                    </tr>
                </thead>


                <tbody class="divide-y divide-slate-100">

                    @forelse ($documentCollection as $document)

                        @php
                            $meta = $getDocumentMeta($document);
                        @endphp

                        <tr
                            class="transition
                                   hover:bg-slate-50/70"
                            data-document-card
                            data-document-id="{{ $document->id }}"
                            data-search="{{ $meta['search_text'] }}"
                        >
                            {{-- Dokumen --}}
                            <td class="px-6 py-5">

                                <div class="flex items-start gap-4">

                                    <div
                                        class="flex h-14 w-14
                                               shrink-0 items-center
                                               justify-center
                                               rounded-2xl bg-blue-700
                                               text-white shadow-lg"
                                    >
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
                                    </div>

                                    <div class="min-w-0">
                                        <h3
                                            class="break-words font-bold
                                                   text-slate-800"
                                        >
                                            {{ $document->title }}
                                        </h3>

                                        @if (
                                            trim((string) $document->description) !== ''
                                        )
                                            <p
                                                class="mt-1 text-sm
                                                       leading-6
                                                       text-slate-500"
                                            >
                                                {{ \Illuminate\Support\Str::limit(
                                                    $document->description,
                                                    90
                                                ) }}
                                            </p>
                                        @else
                                            <p
                                                class="mt-1 text-sm
                                                       text-slate-400"
                                            >
                                                Tidak ada deskripsi.
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </td>


                            {{-- Kategori --}}
                            <td class="px-6 py-5">
                                <span
                                    class="inline-flex rounded-full
                                           bg-blue-50 px-3 py-1
                                           text-xs font-bold
                                           text-blue-700"
                                >
                                    {{ $meta['category_label'] }}
                                </span>
                            </td>


                            {{-- Tahun --}}
                            <td class="px-6 py-5 text-slate-600">
                                {{ trim((string) $document->academic_year) !== ''
                                    ? $document->academic_year
                                    : '-' }}
                            </td>


                            {{-- Status --}}
                            <td class="px-6 py-5">
                                @if ($document->is_active)
                                    <span
                                        class="inline-flex rounded-full
                                               bg-green-50 px-3 py-1
                                               text-xs font-bold
                                               text-green-700"
                                    >
                                        Aktif
                                    </span>
                                @else
                                    <span
                                        class="inline-flex rounded-full
                                               bg-slate-100 px-3 py-1
                                               text-xs font-bold
                                               text-slate-500"
                                    >
                                        Nonaktif
                                    </span>
                                @endif
                            </td>


                            {{-- File dan Link --}}
                            <td class="px-6 py-5">
                                <div class="flex flex-col gap-2">

                                    @if ($meta['file_url'])
                                        <a
                                            href="{{ $meta['file_url'] }}"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="inline-flex text-sm
                                                   font-bold text-blue-700
                                                   hover:underline"
                                        >
                                            Lihat File
                                        </a>
                                    @elseif ($meta['file_path'] !== '')
                                        <span
                                            class="inline-flex text-sm
                                                   font-semibold
                                                   text-red-600"
                                        >
                                            File tidak ditemukan
                                        </span>
                                    @endif


                                    @if ($meta['has_safe_external_link'])
                                        <a
                                            href="{{ $meta['external_link'] }}"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="inline-flex text-sm
                                                   font-bold text-yellow-600
                                                   hover:underline"
                                        >
                                            Buka Tautan
                                        </a>
                                    @endif


                                    @if (
                                        !$meta['file_url']
                                        && $meta['file_path'] === ''
                                        && !$meta['has_safe_external_link']
                                    )
                                        <span class="text-sm text-slate-400">
                                            -
                                        </span>
                                    @endif
                                </div>
                            </td>


                            {{-- Aksi --}}
                            <td class="px-6 py-5">
                                <div
                                    class="flex justify-end gap-3"
                                >
                                    <a
                                        href="{{ route(
                                            'admin.academic-documents.edit',
                                            $document
                                        ) }}"
                                        class="rounded-xl bg-blue-50
                                               px-4 py-2 text-sm
                                               font-bold text-blue-700
                                               transition
                                               hover:bg-blue-700
                                               hover:text-white"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route(
                                            'admin.academic-documents.destroy',
                                            $document
                                        ) }}"
                                        method="POST"
                                        onsubmit="return confirm(
                                            'Yakin ingin menghapus dokumen ini? File yang tersimpan juga akan dihapus.'
                                        )"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="rounded-xl bg-red-50
                                                   px-4 py-2 text-sm
                                                   font-bold text-red-700
                                                   transition
                                                   hover:bg-red-600
                                                   hover:text-white"
                                        >
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td
                                colspan="6"
                                class="px-6 py-14 text-center"
                            >
                                <h3
                                    class="text-xl font-bold
                                           text-slate-800"
                                >
                                    Belum Ada Dokumen Akademik
                                </h3>

                                <p class="mt-2 text-slate-500">
                                    Tambahkan dokumen akademik
                                    terlebih dahulu.
                                </p>
                            </td>
                        </tr>

                    @endforelse

                </tbody>
            </table>
        </div>


        {{-- ===================================================== --}}
        {{-- MOBILE DAN TABLET --}}
        {{-- ===================================================== --}}

        <div class="space-y-4 p-5 md:p-6 xl:hidden">

            @forelse ($documentCollection as $document)

                @php
                    $meta = $getDocumentMeta($document);
                @endphp

                <article
                    class="rounded-3xl border
                           border-slate-100 bg-slate-50
                           p-5"
                    data-document-card
                    data-document-id="{{ $document->id }}"
                    data-search="{{ $meta['search_text'] }}"
                >
                    <div class="flex items-start gap-4">

                        <div
                            class="flex h-14 w-14
                                   shrink-0 items-center
                                   justify-center rounded-2xl
                                   bg-blue-700 text-white
                                   shadow-lg"
                        >
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
                        </div>

                        <div class="min-w-0 flex-1">

                            <h3
                                class="break-words font-bold
                                       text-slate-800"
                            >
                                {{ $document->title }}
                            </h3>

                            <div
                                class="mt-3 flex flex-wrap gap-2"
                            >
                                <span
                                    class="inline-flex rounded-full
                                           bg-blue-50 px-3 py-1
                                           text-xs font-bold
                                           text-blue-700"
                                >
                                    {{ $meta['category_label'] }}
                                </span>

                                @if (
                                    trim((string) $document->academic_year) !== ''
                                )
                                    <span
                                        class="inline-flex rounded-full
                                               border border-slate-100
                                               bg-white px-3 py-1
                                               text-xs font-bold
                                               text-slate-600"
                                    >
                                        {{ $document->academic_year }}
                                    </span>
                                @endif

                                @if ($document->is_active)
                                    <span
                                        class="inline-flex rounded-full
                                               bg-green-50 px-3 py-1
                                               text-xs font-bold
                                               text-green-700"
                                    >
                                        Aktif
                                    </span>
                                @else
                                    <span
                                        class="inline-flex rounded-full
                                               bg-slate-100 px-3 py-1
                                               text-xs font-bold
                                               text-slate-500"
                                    >
                                        Nonaktif
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>


                    @if (
                        trim((string) $document->description) !== ''
                    )
                        <p
                            class="mt-4 text-sm leading-6
                                   text-slate-500"
                        >
                            {{ \Illuminate\Support\Str::limit(
                                $document->description,
                                150
                            ) }}
                        </p>
                    @endif


                    {{-- File dan Tautan --}}
                    <div class="mt-5 flex flex-wrap gap-3">

                        @if ($meta['file_url'])
                            <a
                                href="{{ $meta['file_url'] }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="inline-flex items-center
                                       justify-center rounded-xl
                                       border border-slate-200
                                       bg-white px-4 py-2
                                       text-sm font-bold
                                       text-blue-700 transition
                                       hover:bg-blue-50"
                            >
                                Lihat File
                            </a>
                        @elseif ($meta['file_path'] !== '')
                            <span
                                class="inline-flex items-center
                                       rounded-xl border
                                       border-red-200 bg-red-50
                                       px-4 py-2 text-sm
                                       font-bold text-red-700"
                            >
                                File Tidak Ditemukan
                            </span>
                        @endif


                        @if ($meta['has_safe_external_link'])
                            <a
                                href="{{ $meta['external_link'] }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="inline-flex items-center
                                       justify-center rounded-xl
                                       border border-slate-200
                                       bg-white px-4 py-2
                                       text-sm font-bold
                                       text-yellow-600 transition
                                       hover:bg-yellow-50"
                            >
                                Buka Tautan
                            </a>
                        @endif
                    </div>


                    {{-- Aksi --}}
                    <div class="mt-5 grid grid-cols-2 gap-3">

                        <a
                            href="{{ route(
                                'admin.academic-documents.edit',
                                $document
                            ) }}"
                            class="rounded-xl bg-blue-700
                                   px-4 py-3 text-center
                                   text-sm font-bold text-white
                                   transition hover:bg-blue-800"
                        >
                            Edit
                        </a>

                        <form
                            action="{{ route(
                                'admin.academic-documents.destroy',
                                $document
                            ) }}"
                            method="POST"
                            onsubmit="return confirm(
                                'Yakin ingin menghapus dokumen ini? File yang tersimpan juga akan dihapus.'
                            )"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="w-full rounded-xl
                                       bg-red-600 px-4 py-3
                                       text-sm font-bold text-white
                                       transition hover:bg-red-700"
                            >
                                Hapus
                            </button>
                        </form>
                    </div>
                </article>

            @empty

                <div
                    class="rounded-3xl border
                           border-slate-100 bg-slate-50
                           p-10 text-center"
                >
                    <h3
                        class="text-xl font-bold
                               text-slate-800"
                    >
                        Belum Ada Dokumen Akademik
                    </h3>

                    <p class="mt-2 text-slate-500">
                        Tambahkan dokumen akademik terlebih dahulu.
                    </p>

                    <a
                        href="{{ route(
                            'admin.academic-documents.create'
                        ) }}"
                        class="mt-6 inline-flex items-center
                               justify-center rounded-xl
                               bg-blue-700 px-5 py-3
                               text-sm font-bold text-white
                               transition hover:bg-blue-800"
                    >
                        Tambah Dokumen
                    </a>
                </div>

            @endforelse
        </div>


        {{-- ===================================================== --}}
        {{-- EMPTY SEARCH --}}
        {{-- ===================================================== --}}

        <div
            id="academicDocumentEmptySearch"
            class="hidden border-t
                   border-slate-100 p-10 text-center"
        >
            <h3
                class="text-xl font-bold
                       text-slate-800"
            >
                Dokumen Tidak Ditemukan
            </h3>

            <p class="mt-2 text-slate-500">
                Coba gunakan kata kunci pencarian lain.
            </p>
        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- PAGINATION --}}
    {{-- ========================================================= --}}

    @if (
        $documents instanceof \Illuminate\Pagination\AbstractPaginator
        && $documents->hasPages()
    )
        <div>
            {{ $documents->links() }}
        </div>
    @endif

</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById(
            'academicDocumentSearch'
        );

        const documentCards = Array.from(
            document.querySelectorAll(
                '[data-document-card]'
            )
        );

        const emptySearch = document.getElementById(
            'academicDocumentEmptySearch'
        );

        if (!searchInput) {
            return;
        }

        function filterDocuments() {
            const keyword = searchInput.value
                .toLocaleLowerCase('id-ID')
                .trim();

            const matchingDocumentIds = new Set();

            documentCards.forEach(function (card) {
                const searchText = (
                    card.dataset.search || ''
                ).toLocaleLowerCase('id-ID');

                const isMatch =
                    keyword === ''
                    || searchText.includes(keyword);

                card.classList.toggle(
                    'hidden',
                    !isMatch
                );

                if (isMatch) {
                    matchingDocumentIds.add(
                        card.dataset.documentId
                    );
                }
            });

            const showEmptySearch =
                documentCards.length > 0
                && matchingDocumentIds.size === 0;

            if (emptySearch) {
                emptySearch.classList.toggle(
                    'hidden',
                    !showEmptySearch
                );
            }
        }

        searchInput.addEventListener(
            'input',
            filterDocuments
        );
    });
</script>

@endsection