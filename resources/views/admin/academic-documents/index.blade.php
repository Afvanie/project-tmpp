@extends('layouts.admin')

@section('title', 'Dokumen Akademik')

@section('content')

@php
    $documentCollection =
        $documents instanceof \Illuminate\Pagination\AbstractPaginator
            ? $documents->getCollection()
            : collect($documents);

    $totalDocuments = $documentCollection->count();

    $shownDocuments = $documentCollection
        ->where('is_active', true)
        ->count();

    $hiddenDocuments = $totalDocuments - $shownDocuments;

    $getDocumentMeta = static function ($document): array {
        $filePath = trim(
            (string) $document->file_path
        );

        $fileExists =
            $filePath !== ''
            && \Illuminate\Support\Facades\Storage::disk(
                'public'
            )->exists($filePath);

        $externalLink = trim(
            (string) $document->external_link
        );

        $scheme = $externalLink !== ''
            ? strtolower(
                (string) parse_url(
                    $externalLink,
                    PHP_URL_SCHEME
                )
            )
            : '';

        $safeExternalLink =
            $externalLink !== ''
            && filter_var(
                $externalLink,
                FILTER_VALIDATE_URL
            )
            && in_array(
                $scheme,
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
            implode(
                ' ',
                [
                    (string) $document->title,
                    $categoryLabel,
                    (string) $document->academic_year,
                    (string) $document->description,
                ]
            )
        );

        return [
            'file_path' => $filePath,
            'file_exists' => $fileExists,
            'file_url' => $fileExists
                ? asset(
                    'storage/'
                    . ltrim($filePath, '/')
                )
                : null,
            'external_link' => $externalLink,
            'safe_external_link' => $safeExternalLink,
            'category_label' => $categoryLabel,
            'search_text' => $searchText,
        ];
    };
@endphp


<div class="mx-auto max-w-7xl space-y-6">

    {{-- HEADER --}}
    <header
        class="flex flex-col gap-4
               lg:flex-row lg:items-end
               lg:justify-between"
    >
        <div>
            <div class="flex items-center gap-3">
                <span
                    class="h-px w-8 bg-[#D7B33E]"
                    aria-hidden="true"
                ></span>

                <p
                    class="text-[11px] font-bold
                           uppercase tracking-[0.16em]
                           text-[#075F9B]"
                >
                    Pengelolaan Akademik
                </p>
            </div>

            <h1
                class="mt-3 text-2xl font-extrabold
                       tracking-tight text-slate-900
                       sm:text-3xl"
            >
                Dokumen Akademik
            </h1>

            <p
                class="mt-2 max-w-3xl
                       text-sm leading-7
                       text-slate-500"
            >
                Kelola pedoman, kalender, kurikulum,
                jadwal, laporan, serta panduan akademik
                Program Studi D-IV TMPP.
            </p>
        </div>

        <a
            href="{{ route(
                'admin.academic-documents.create'
            ) }}"
            class="inline-flex w-full items-center
                   justify-center gap-2 rounded-xl
                   bg-[#075F9B] px-5 py-3
                   text-sm font-bold text-white
                   transition hover:bg-[#064B7B]
                   sm:w-auto"
        >
            <span aria-hidden="true">+</span>
            Tambah Dokumen
        </a>
    </header>


    {{-- ALERT --}}
    @if (session('success'))
        <div
            class="rounded-xl border
                   border-emerald-200
                   bg-emerald-50 px-4 py-3
                   text-sm font-semibold
                   text-emerald-800"
            role="status"
        >
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div
            class="rounded-xl border
                   border-red-200 bg-red-50
                   px-4 py-3 text-sm
                   font-semibold text-red-700"
            role="alert"
        >
            {{ session('error') }}
        </div>
    @endif


    {{-- RINGKASAN --}}
    <section
        class="flex flex-col gap-4
               rounded-2xl border
               border-slate-200 bg-white
               px-5 py-4
               sm:flex-row sm:items-center
               sm:justify-between sm:px-6"
    >
        <div>
            <h2
                class="text-sm font-extrabold
                       text-slate-900"
            >
                Ringkasan Dokumen
            </h2>

            <p
                class="mt-1 text-xs
                       leading-5 text-slate-500"
            >
                Hanya dokumen yang ditampilkan yang dapat
                dilihat oleh pengunjung website.
            </p>
        </div>

        <div
            class="grid grid-cols-3
                   divide-x divide-slate-200
                   text-center"
        >
            <div class="px-4">
                <p
                    class="text-xl font-extrabold
                           text-slate-900"
                >
                    {{ $totalDocuments }}
                </p>

                <p class="mt-1 text-[10px] text-slate-500">
                    Total
                </p>
            </div>

            <div class="px-4">
                <p
                    class="text-xl font-extrabold
                           text-emerald-600"
                >
                    {{ $shownDocuments }}
                </p>

                <p class="mt-1 text-[10px] text-slate-500">
                    Ditampilkan
                </p>
            </div>

            <div class="px-4">
                <p
                    class="text-xl font-extrabold
                           text-slate-500"
                >
                    {{ $hiddenDocuments }}
                </p>

                <p class="mt-1 text-[10px] text-slate-500">
                    Disembunyikan
                </p>
            </div>
        </div>
    </section>


    {{-- DAFTAR --}}
    <section
        class="overflow-hidden rounded-2xl
               border border-slate-200
               bg-white"
        aria-labelledby="documentListTitle"
    >
        <div
            class="flex flex-col gap-4
                   border-b border-slate-200
                   px-5 py-5 sm:px-6
                   lg:flex-row lg:items-end
                   lg:justify-between"
        >
            <div>
                <h2
                    id="documentListTitle"
                    class="text-lg font-extrabold
                           text-slate-900"
                >
                    Daftar Dokumen
                </h2>

                <p
                    class="mt-1 text-sm
                           text-slate-500"
                >
                    Cari berdasarkan judul, kategori,
                    atau tahun akademik.
                </p>
            </div>

            <div class="w-full lg:w-96">
                <label
                    for="academicDocumentSearch"
                    class="sr-only"
                >
                    Cari dokumen akademik
                </label>

                <input
                    id="academicDocumentSearch"
                    type="search"
                    autocomplete="off"
                    placeholder="Cari dokumen..."
                    class="w-full rounded-xl
                           border border-slate-200
                           bg-slate-50
                           px-4 py-2.5 text-sm
                           text-slate-700 outline-none
                           transition
                           focus:border-[#075F9B]
                           focus:bg-white"
                >
            </div>
        </div>


        {{-- DESKTOP --}}
        <div class="hidden overflow-x-auto lg:block">
            <table class="w-full">
                <thead
                    class="border-b border-slate-200
                           bg-slate-50"
                >
                    <tr>
                        <th
                            class="px-6 py-4 text-left
                                   text-[11px] font-bold
                                   uppercase tracking-[0.12em]
                                   text-slate-500"
                        >
                            Dokumen
                        </th>

                        <th
                            class="px-6 py-4 text-left
                                   text-[11px] font-bold
                                   uppercase tracking-[0.12em]
                                   text-slate-500"
                        >
                            Kategori
                        </th>

                        <th
                            class="px-6 py-4 text-left
                                   text-[11px] font-bold
                                   uppercase tracking-[0.12em]
                                   text-slate-500"
                        >
                            Tahun
                        </th>

                        <th
                            class="px-6 py-4 text-left
                                   text-[11px] font-bold
                                   uppercase tracking-[0.12em]
                                   text-slate-500"
                        >
                            Status
                        </th>

                        <th
                            class="px-6 py-4 text-left
                                   text-[11px] font-bold
                                   uppercase tracking-[0.12em]
                                   text-slate-500"
                        >
                            Akses
                        </th>

                        <th
                            class="px-6 py-4 text-right
                                   text-[11px] font-bold
                                   uppercase tracking-[0.12em]
                                   text-slate-500"
                        >
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-200">
                    @forelse ($documentCollection as $document)
                        @php
                            $meta = $getDocumentMeta(
                                $document
                            );
                        @endphp

                        <tr
                            class="hover:bg-slate-50/70"
                            data-document-card
                            data-document-id="{{ $document->id }}"
                            data-search="{{ $meta['search_text'] }}"
                        >
                            <td class="px-6 py-4">
                                <div class="max-w-md">
                                    <p
                                        class="font-bold
                                               leading-6
                                               text-slate-800"
                                    >
                                        {{ $document->title }}
                                    </p>

                                    @if (
                                        trim(
                                            (string) $document->description
                                        ) !== ''
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
                                    @endif
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex rounded-full
                                           bg-blue-50
                                           px-2.5 py-1
                                           text-xs font-bold
                                           text-[#075F9B]"
                                >
                                    {{ $meta['category_label'] }}
                                </span>
                            </td>

                            <td
                                class="px-6 py-4
                                       text-sm text-slate-600"
                            >
                                {{ trim(
                                    (string) $document->academic_year
                                ) !== ''
                                    ? $document->academic_year
                                    : '-' }}
                            </td>

                            <td class="px-6 py-4">
                                <span
                                    @class([
                                        'inline-flex rounded-full',
                                        'px-2.5 py-1 text-xs',
                                        'font-bold',
                                        'bg-emerald-50 text-emerald-700' =>
                                            $document->is_active,
                                        'bg-slate-100 text-slate-500' =>
                                            !$document->is_active,
                                    ])
                                >
                                    {{ $document->is_active
                                        ? 'Ditampilkan'
                                        : 'Disembunyikan' }}
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                <div
                                    class="flex flex-col
                                           items-start gap-1.5"
                                >
                                    @if ($meta['file_url'])
                                        <a
                                            href="{{ $meta['file_url'] }}"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="text-sm font-bold
                                                   text-[#075F9B]
                                                   hover:underline"
                                        >
                                            Buka File
                                        </a>
                                    @elseif ($meta['file_path'] !== '')
                                        <span
                                            class="text-xs font-semibold
                                                   text-red-600"
                                        >
                                            File tidak ditemukan
                                        </span>
                                    @endif

                                    @if ($meta['safe_external_link'])
                                        <a
                                            href="{{ $meta['external_link'] }}"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="text-sm font-bold
                                                   text-amber-700
                                                   hover:underline"
                                        >
                                            Buka Tautan
                                        </a>
                                    @endif

                                    @if (
                                        !$meta['file_url']
                                        && $meta['file_path'] === ''
                                        && !$meta['safe_external_link']
                                    )
                                        <span
                                            class="text-sm
                                                   text-slate-400"
                                        >
                                            Belum tersedia
                                        </span>
                                    @endif
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <div
                                    class="flex justify-end gap-2"
                                >
                                    <a
                                        href="{{ route(
                                            'admin.academic-documents.edit',
                                            $document
                                        ) }}"
                                        class="inline-flex items-center
                                               justify-center rounded-lg
                                               bg-blue-50 px-3 py-2
                                               text-xs font-bold
                                               text-[#075F9B]
                                               hover:bg-blue-100"
                                    >
                                        Ubah
                                    </a>

                                    <form
                                        action="{{ route(
                                            'admin.academic-documents.destroy',
                                            $document
                                        ) }}"
                                        method="POST"
                                        onsubmit="return confirm(
                                            'Hapus dokumen ini? File yang tersimpan juga akan dihapus.'
                                        )"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="inline-flex
                                                   items-center
                                                   justify-center
                                                   rounded-lg
                                                   bg-red-50
                                                   px-3 py-2
                                                   text-xs font-bold
                                                   text-red-600
                                                   hover:bg-red-100"
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
                                class="px-6 py-14
                                       text-center"
                            >
                                <p
                                    class="text-sm font-bold
                                           text-slate-700"
                                >
                                    Belum ada dokumen akademik
                                </p>

                                <p
                                    class="mt-2 text-sm
                                           text-slate-500"
                                >
                                    Tambahkan dokumen akademik
                                    terlebih dahulu.
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>


        {{-- MOBILE --}}
        <div
            class="divide-y divide-slate-200
                   lg:hidden"
        >
            @forelse ($documentCollection as $document)
                @php
                    $meta = $getDocumentMeta(
                        $document
                    );
                @endphp

                <article
                    class="px-5 py-5 sm:px-6"
                    data-document-card
                    data-document-id="{{ $document->id }}"
                    data-search="{{ $meta['search_text'] }}"
                >
                    <div
                        class="flex items-start
                               justify-between gap-3"
                    >
                        <div class="min-w-0">
                            <h3
                                class="font-bold
                                       leading-6
                                       text-slate-800"
                            >
                                {{ $document->title }}
                            </h3>

                            <div
                                class="mt-2 flex
                                       flex-wrap gap-2"
                            >
                                <span
                                    class="inline-flex rounded-full
                                           bg-blue-50
                                           px-2.5 py-1
                                           text-[10px] font-bold
                                           text-[#075F9B]"
                                >
                                    {{ $meta['category_label'] }}
                                </span>

                                <span
                                    @class([
                                        'inline-flex rounded-full',
                                        'px-2.5 py-1',
                                        'text-[10px] font-bold',
                                        'bg-emerald-50 text-emerald-700' =>
                                            $document->is_active,
                                        'bg-slate-100 text-slate-500' =>
                                            !$document->is_active,
                                    ])
                                >
                                    {{ $document->is_active
                                        ? 'Ditampilkan'
                                        : 'Disembunyikan' }}
                                </span>

                                @if (
                                    trim(
                                        (string) $document->academic_year
                                    ) !== ''
                                )
                                    <span
                                        class="inline-flex rounded-full
                                               border border-slate-200
                                               px-2.5 py-1
                                               text-[10px] font-bold
                                               text-slate-600"
                                    >
                                        {{ $document->academic_year }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>


                    @if (
                        trim(
                            (string) $document->description
                        ) !== ''
                    )
                        <p
                            class="mt-3 text-sm
                                   leading-6 text-slate-500"
                        >
                            {{ \Illuminate\Support\Str::limit(
                                $document->description,
                                130
                            ) }}
                        </p>
                    @endif


                    <div
                        class="mt-4 flex
                               flex-wrap gap-3"
                    >
                        @if ($meta['file_url'])
                            <a
                                href="{{ $meta['file_url'] }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="text-sm font-bold
                                       text-[#075F9B]
                                       hover:underline"
                            >
                                Buka File
                            </a>
                        @elseif ($meta['file_path'] !== '')
                            <span
                                class="text-xs font-semibold
                                       text-red-600"
                            >
                                File tidak ditemukan
                            </span>
                        @endif

                        @if ($meta['safe_external_link'])
                            <a
                                href="{{ $meta['external_link'] }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="text-sm font-bold
                                       text-amber-700
                                       hover:underline"
                            >
                                Buka Tautan
                            </a>
                        @endif
                    </div>


                    <div
                        class="mt-4 grid
                               grid-cols-2 gap-2"
                    >
                        <a
                            href="{{ route(
                                'admin.academic-documents.edit',
                                $document
                            ) }}"
                            class="inline-flex items-center
                                   justify-center rounded-xl
                                   bg-[#075F9B]
                                   px-4 py-2.5
                                   text-sm font-bold text-white
                                   hover:bg-[#064B7B]"
                        >
                            Ubah
                        </a>

                        <form
                            action="{{ route(
                                'admin.academic-documents.destroy',
                                $document
                            ) }}"
                            method="POST"
                            onsubmit="return confirm(
                                'Hapus dokumen ini? File yang tersimpan juga akan dihapus.'
                            )"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="inline-flex w-full
                                       items-center justify-center
                                       rounded-xl bg-red-50
                                       px-4 py-2.5
                                       text-sm font-bold
                                       text-red-600
                                       hover:bg-red-100"
                            >
                                Hapus
                            </button>
                        </form>
                    </div>
                </article>
            @empty
                <div class="px-6 py-12 text-center">
                    <p
                        class="text-sm font-bold
                               text-slate-700"
                    >
                        Belum ada dokumen akademik
                    </p>

                    <p
                        class="mt-2 text-sm
                               text-slate-500"
                    >
                        Tambahkan dokumen terlebih dahulu.
                    </p>
                </div>
            @endforelse
        </div>


        <div
            id="academicDocumentEmptySearch"
            class="hidden px-6 py-12 text-center"
        >
            <p
                class="text-sm font-bold
                       text-slate-700"
            >
                Dokumen tidak ditemukan
            </p>

            <p
                class="mt-2 text-sm
                       text-slate-500"
            >
                Coba gunakan kata pencarian lain.
            </p>
        </div>
    </section>


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
    document.addEventListener(
        'DOMContentLoaded',
        function () {
            const searchInput =
                document.getElementById(
                    'academicDocumentSearch'
                );

            const documentCards =
                Array.from(
                    document.querySelectorAll(
                        '[data-document-card]'
                    )
                );

            const emptySearch =
                document.getElementById(
                    'academicDocumentEmptySearch'
                );

            if (!searchInput) {
                return;
            }

            function filterDocuments() {
                const keyword =
                    searchInput.value
                        .toLocaleLowerCase('id-ID')
                        .trim();

                const matchingIds = new Set();

                documentCards.forEach(
                    function (card) {
                        const searchText =
                            (
                                card.dataset.search
                                || ''
                            ).toLocaleLowerCase(
                                'id-ID'
                            );

                        const isMatch =
                            keyword === ''
                            || searchText.includes(
                                keyword
                            );

                        card.classList.toggle(
                            'hidden',
                            !isMatch
                        );

                        if (isMatch) {
                            matchingIds.add(
                                card.dataset.documentId
                            );
                        }
                    }
                );

                emptySearch?.classList.toggle(
                    'hidden',
                    documentCards.length === 0
                    || matchingIds.size > 0
                );
            }

            searchInput.addEventListener(
                'input',
                filterDocuments
            );
        }
    );
</script>

@endsection
