@extends('layouts.admin')

@php
    /*
    |--------------------------------------------------------------------------
    | IDENTITAS BAGIAN
    |--------------------------------------------------------------------------
    */

    $sectionConfig = [
        'overview' => [
            'title' => 'Gambaran Umum Program Studi',
            'description' =>
                'Ubah seluruh isi Gambaran Umum, lalu simpan sekaligus.',
            'item_title' => 'Informasi Singkat',
            'item_singular' => 'Informasi',
            'group' => 'info_card',
            'show_title' => true,
            'mode' => 'info_card',
        ],

        'history' => [
            'title' => 'Sejarah Program Studi',
            'description' =>
                'Ubah narasi dan linimasa Sejarah, lalu simpan sekaligus.',
            'item_title' => 'Linimasa Sejarah',
            'item_singular' => 'Peristiwa',
            'group' => 'timeline',
            'show_title' => true,
            'mode' => 'standard',
        ],

        'visi-misi' => [
            'title' => 'Visi dan Misi',
            'description' =>
                'Ubah Visi dan seluruh poin Misi, lalu simpan sekaligus.',
            'item_title' => 'Daftar Misi',
            'item_singular' => 'Misi',
            'group' => 'misi',
            'show_title' => true,
            'mode' => 'standard',
        ],

        'tujuan-prodi' => [
            'title' => 'Tujuan Program Studi',
            'description' =>
                'Ubah, tambah, atau hapus seluruh poin Tujuan dalam satu halaman.',
            'item_title' => 'Daftar Tujuan Program Studi',
            'item_singular' => 'Tujuan',
            'group' => 'tujuan',
            'show_title' => true,
            'mode' => 'standard',
        ],

        'ppm' => [
            'title' => 'Profil Profesional Mandiri',
            'description' =>
                'Ubah, tambah, atau hapus seluruh poin PPM dalam satu halaman.',
            'item_title' => 'Daftar Profil Profesional Mandiri',
            'item_singular' => 'PPM',
            'group' => 'ppm',
            'show_title' => true,
            'mode' => 'standard',
        ],

        'cpl' => [
            'title' => 'Capaian Pembelajaran Lulusan',
            'description' =>
                'Ubah, tambah, atau hapus seluruh poin CPL dalam satu halaman.',
            'item_title' => 'Daftar Capaian Pembelajaran Lulusan',
            'item_singular' => 'CPL',
            'group' => 'cpl',
            'show_title' => true,
            'mode' => 'standard',
        ],
    ];

    $config = $sectionConfig[
        $profileSection->slug
    ] ?? [
        'title' => $profileSection->title,
        'description' =>
            'Ubah seluruh isi bagian ini, lalu simpan sekaligus.',
        'item_title' => 'Daftar Isi',
        'item_singular' => 'Isi',
        'group' => 'content',
        'show_title' => true,
        'mode' => 'standard',
    ];

    $items = collect($profileSection->items ?? [])
        ->sortBy('sort_order')
        ->values();


    /*
    |--------------------------------------------------------------------------
    | DATA KHUSUS GAMBARAN UMUM DAN SEJARAH
    |--------------------------------------------------------------------------
    */

    $paragraphItems = $items
        ->where('item_group', 'paragraph')
        ->values();

    $mainContent = old(
        'main_content',
        $paragraphItems
            ->pluck('content')
            ->filter(
                fn ($content) =>
                    trim((string) $content) !== ''
            )
            ->implode("\n\n")
    );

    $overviewLabelItem = $items
        ->firstWhere('item_group', 'label');

    $overviewLabel = old(
        'overview_label',
        $overviewLabelItem?->content ?? ''
    );

    $overviewImageItem = $items
        ->firstWhere('item_group', 'image');

    $overviewImagePath = trim(
        (string) (
            $overviewImageItem?->content
            ?? ''
        )
    );

    $overviewImageExists =
        $overviewImagePath !== ''
        && \Illuminate\Support\Facades\Storage::disk(
            'public'
        )->exists($overviewImagePath);

    $overviewImageUrl = $overviewImageExists
        ? asset(
            'storage/'
            . ltrim(
                $overviewImagePath,
                '/'
            )
        )
        : asset('assets/images/about.png');


    /*
    |--------------------------------------------------------------------------
    | VISI
    |--------------------------------------------------------------------------
    */

    $visionItem = $items
        ->filter(function ($item) {
            return in_array(
                strtolower(
                    trim((string) $item->item_group)
                ),
                ['visi', 'vision'],
                true
            );
        })
        ->first();

    $visionContent = old(
        'vision_content',
        $visionItem?->content ?? ''
    );


    /*
    |--------------------------------------------------------------------------
    | DAFTAR ITEM SESUAI BAGIAN
    |--------------------------------------------------------------------------
    */

    $managedItems = match ($profileSection->slug) {
        'overview' => $items
            ->where('item_group', 'info_card')
            ->values(),

        'history' => $items
            ->where('item_group', 'timeline')
            ->values(),

        'visi-misi' => $items
            ->filter(function ($item) {
                return in_array(
                    strtolower(
                        trim((string) $item->item_group)
                    ),
                    ['misi', 'mission'],
                    true
                );
            })
            ->values(),

        'tujuan-prodi' => $items
            ->filter(function ($item) {
                return in_array(
                    strtolower(
                        trim((string) $item->item_group)
                    ),
                    ['tujuan', 'goal', 'goals'],
                    true
                );
            })
            ->values(),

        'ppm' => $items
            ->where('item_group', 'ppm')
            ->values(),

        'cpl' => $items
            ->where('item_group', 'cpl')
            ->values(),

        default => $items,
    };

    $nextOrder = max(
        1,
        (int) $managedItems->max('sort_order') + 1
    );
@endphp

@section('title', $config['title'])

@section('content')

<div class="mx-auto max-w-7xl space-y-5">

    {{-- ========================================================= --}}
    {{-- HEADER --}}
    {{-- ========================================================= --}}

    <header
        class="flex flex-col gap-4
               lg:flex-row lg:items-end
               lg:justify-between"
    >
        <div>
            <a
                href="{{ route(
                    'admin.profile-contents.index'
                ) }}"
                class="inline-flex items-center
                       gap-2 text-sm font-bold
                       text-[#075F9B]
                       hover:underline"
            >
                <span aria-hidden="true">←</span>
                <span>Kembali ke Konten Profil</span>
            </a>

            <div class="mt-5 flex items-center gap-3">
                <span
                    class="h-px w-8 bg-[#D7B33E]"
                    aria-hidden="true"
                ></span>

                <p
                    class="text-[11px] font-bold
                           uppercase tracking-[0.16em]
                           text-[#075F9B]"
                >
                    Pengaturan Profil
                </p>
            </div>

            <h1
                class="mt-3 text-2xl font-extrabold
                       tracking-tight text-slate-900
                       sm:text-3xl"
            >
                {{ $config['title'] }}
            </h1>

            <p
                class="mt-2 max-w-3xl
                       text-sm leading-7
                       text-slate-500"
            >
                {{ $config['description'] }}
            </p>
        </div>

        <a
            href="{{ route('profile') }}"
            target="_blank"
            rel="noopener noreferrer"
            class="inline-flex w-full items-center
                   justify-center gap-2 rounded-xl
                   border border-slate-200
                   bg-white px-4 py-2.5
                   text-sm font-bold text-slate-700
                   transition hover:border-blue-200
                   hover:text-[#075F9B]
                   sm:w-auto"
        >
            Lihat Halaman Profil

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
                    d="M14 3h7v7M10 14L21 3"
                />
            </svg>
        </a>
    </header>


    {{-- ========================================================= --}}
    {{-- ALERT --}}
    {{-- ========================================================= --}}

    @if (session('success'))
        <div
            class="flex items-start gap-3
                   rounded-xl border
                   border-emerald-200
                   bg-emerald-50 px-4 py-3
                   text-sm text-emerald-800"
            role="status"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="mt-0.5 h-5 w-5 shrink-0"
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

            <p class="font-semibold">
                {{ session('success') }}
            </p>
        </div>
    @endif

    @if ($errors->any())
        <div
            class="rounded-xl border
                   border-red-200 bg-red-50
                   px-4 py-4 text-red-800"
            role="alert"
        >
            <p class="text-sm font-bold">
                Beberapa bagian belum dapat disimpan:
            </p>

            <ul
                class="mt-2 list-inside list-disc
                       space-y-1 text-sm"
            >
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {{-- ========================================================= --}}
    {{-- SATU FORM UNTUK SEMUA PERUBAHAN --}}
    {{-- ========================================================= --}}

    <form
        id="profileBatchForm"
        action="{{ route(
            'admin.profile-contents.update',
            $profileSection
        ) }}"
        method="POST"
        enctype="multipart/form-data"
        class="space-y-5"
    >
        @csrf
        @method('PUT')

        <input
            type="hidden"
            name="is_active"
            value="0"
        >


        {{-- ===================================================== --}}
        {{-- PENGATURAN JUDUL BAGIAN --}}
        {{-- ===================================================== --}}

        <section
            class="overflow-hidden rounded-2xl
                   border border-slate-200
                   bg-white"
        >
            <details class="group">
                <summary
                    class="flex cursor-pointer
                           list-none items-center
                           justify-between gap-4
                           px-5 py-4 sm:px-6"
                >
                    <div>
                        <h2
                            class="text-base font-extrabold
                                   text-slate-900"
                        >
                            Judul dan Pengantar Bagian
                        </h2>

                        <p
                            class="mt-1 text-xs
                                   leading-5 text-slate-500"
                        >
                            Buka hanya saat judul atau pengantar
                            perlu diubah.
                        </p>
                    </div>

                    <span
                        class="flex h-9 w-9 shrink-0
                               items-center justify-center
                               rounded-xl bg-slate-100
                               text-slate-500 transition
                               group-open:rotate-180"
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
                                d="M19 9l-7 7-7-7"
                            />
                        </svg>
                    </span>
                </summary>

                <div
                    class="grid gap-5
                           border-t border-slate-200
                           px-5 py-6 sm:px-6
                           lg:grid-cols-2"
                >
                    <div>
                        <label
                            for="title"
                            class="block text-sm
                                   font-bold text-slate-800"
                        >
                            Judul bagian
                        </label>

                        <input
                            id="title"
                            type="text"
                            name="title"
                            value="{{ old(
                                'title',
                                $profileSection->title
                            ) }}"
                            required
                            class="mt-2 w-full
                                   rounded-xl border
                                   border-slate-200
                                   px-4 py-3 text-sm
                                   font-bold text-slate-800
                                   outline-none transition
                                   focus:border-[#075F9B]
                                   focus:ring-4
                                   focus:ring-blue-100"
                        >
                    </div>

                    <div>
                        <label
                            for="subtitle"
                            class="block text-sm
                                   font-bold text-slate-800"
                        >
                            Teks kecil di atas judul
                        </label>

                        <input
                            id="subtitle"
                            type="text"
                            name="subtitle"
                            value="{{ old(
                                'subtitle',
                                $profileSection->subtitle
                            ) }}"
                            class="mt-2 w-full
                                   rounded-xl border
                                   border-slate-200
                                   px-4 py-3 text-sm
                                   text-slate-800
                                   outline-none transition
                                   focus:border-[#075F9B]
                                   focus:ring-4
                                   focus:ring-blue-100"
                        >
                    </div>

                    <div class="lg:col-span-2">
                        <label
                            for="description"
                            class="block text-sm
                                   font-bold text-slate-800"
                        >
                            Penjelasan singkat
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            rows="4"
                            class="mt-2 w-full
                                   rounded-xl border
                                   border-slate-200
                                   px-4 py-3 text-sm
                                   leading-7 text-slate-800
                                   outline-none transition
                                   focus:border-[#075F9B]
                                   focus:ring-4
                                   focus:ring-blue-100"
                        >{{ old(
                            'description',
                            $profileSection->description
                        ) }}</textarea>
                    </div>

                    @if ($profileSection->slug === 'overview')
                        <div class="lg:col-span-2">
                            <label
                                for="overview_label"
                                class="block text-sm
                                       font-bold text-slate-800"
                            >
                                Teks kecil di atas isi profil
                            </label>

                            <input
                                id="overview_label"
                                type="text"
                                name="overview_label"
                                value="{{ $overviewLabel }}"
                                placeholder="Profil Singkat"
                                class="mt-2 w-full
                                       rounded-xl border
                                       border-slate-200
                                       px-4 py-3 text-sm
                                       text-slate-800
                                       outline-none transition
                                       focus:border-[#075F9B]
                                       focus:ring-4
                                       focus:ring-blue-100"
                            >
                        </div>
                    @endif

                    <label
                        class="flex cursor-pointer
                               items-start gap-3
                               border-t border-slate-200
                               pt-5 lg:col-span-2"
                    >
                        <input
                            type="checkbox"
                            name="is_active"
                            value="1"
                            class="mt-1 h-4 w-4
                                   rounded border-slate-300
                                   text-[#075F9B]"
                            {{ old(
                                'is_active',
                                $profileSection->is_active
                            ) ? 'checked' : '' }}
                        >

                        <span>
                            <span
                                class="block text-sm
                                       font-bold text-slate-800"
                            >
                                Tampilkan bagian ini di website
                            </span>

                            <span
                                class="mt-1 block text-xs
                                       leading-6 text-slate-500"
                            >
                                Hilangkan centang untuk
                                menyembunyikan bagian ini.
                            </span>
                        </span>
                    </label>
                </div>
            </details>
        </section>


        {{-- ===================================================== --}}
        {{-- NARASI UTAMA --}}
        {{-- ===================================================== --}}

        @if (
            in_array(
                $profileSection->slug,
                ['overview', 'history'],
                true
            )
        )
            <section
                class="overflow-hidden rounded-2xl
                       border border-slate-200
                       bg-white"
            >
                <div
                    class="border-b border-slate-200
                           px-5 py-5 sm:px-6"
                >
                    <h2
                        class="text-lg font-extrabold
                               text-slate-900"
                    >
                        {{ $profileSection->slug === 'overview'
                            ? 'Isi Gambaran Umum'
                            : 'Isi Sejarah Program Studi' }}
                    </h2>

                    <p
                        class="mt-1 text-sm
                               leading-6 text-slate-500"
                    >
                        Tulis seluruh paragraf dalam satu kolom.
                        Tekan Enter dua kali untuk memberi jarak.
                    </p>
                </div>

                <div class="px-5 py-6 sm:px-6">
                    <textarea
                        name="main_content"
                        rows="15"
                        class="w-full rounded-xl
                               border border-slate-200
                               px-4 py-3 text-sm
                               leading-8 text-slate-800
                               outline-none transition
                               focus:border-[#075F9B]
                               focus:ring-4
                               focus:ring-blue-100"
                    >{{ $mainContent }}</textarea>
                </div>
            </section>
        @endif


        {{-- ===================================================== --}}
        {{-- FOTO GAMBARAN UMUM --}}
        {{-- ===================================================== --}}

        @if ($profileSection->slug === 'overview')
            <section
                class="overflow-hidden rounded-2xl
                       border border-slate-200
                       bg-white"
            >
                <div
                    class="border-b border-slate-200
                           px-5 py-5 sm:px-6"
                >
                    <h2
                        class="text-lg font-extrabold
                               text-slate-900"
                    >
                        Foto Gambaran Umum
                    </h2>

                    <p
                        class="mt-1 text-sm
                               leading-6 text-slate-500"
                    >
                        Foto ini tampil di sisi kiri bagian
                        Gambaran Umum Program Studi.
                    </p>
                </div>

                <div
                    class="grid gap-6 px-5 py-6
                           sm:px-6
                           lg:grid-cols-[320px_1fr]
                           lg:items-start"
                >
                    <div
                        class="overflow-hidden rounded-xl
                               border border-slate-200
                               bg-slate-100"
                    >
                        <img
                            id="overviewImagePreview"
                            src="{{ $overviewImageUrl }}"
                            alt="Foto Gambaran Umum Program Studi"
                            class="aspect-[4/3] w-full
                                   object-cover"
                        >
                    </div>

                    <div class="space-y-5">
                        <div>
                            <label
                                for="overview_image"
                                class="block text-sm
                                       font-bold text-slate-800"
                            >
                                Pilih foto baru
                            </label>

                            <p
                                class="mt-1 text-xs
                                       leading-6 text-slate-500"
                            >
                                Kosongkan apabila foto tidak perlu
                                diganti. Gunakan JPG, PNG, atau WebP
                                maksimal 4 MB.
                            </p>

                            <input
                                id="overview_image"
                                type="file"
                                name="overview_image"
                                accept="image/jpeg,image/png,image/webp"
                                class="mt-3 block w-full
                                       rounded-xl border
                                       border-slate-200
                                       bg-white px-3 py-2.5
                                       text-sm text-slate-600
                                       file:mr-3
                                       file:rounded-lg
                                       file:border-0
                                       file:bg-[#075F9B]
                                       file:px-4 file:py-2
                                       file:text-sm
                                       file:font-bold
                                       file:text-white
                                       hover:file:bg-[#064B7B]"
                            >

                            <p
                                id="selectedOverviewImage"
                                class="mt-3 hidden
                                       text-xs font-semibold
                                       text-[#075F9B]"
                            ></p>
                        </div>

                        @if ($overviewImageExists)
                            <label
                                class="flex cursor-pointer
                                       items-start gap-3
                                       border-t border-slate-200
                                       pt-4"
                            >
                                <input
                                    type="checkbox"
                                    name="remove_overview_image"
                                    value="1"
                                    class="mt-1 h-4 w-4
                                           rounded border-slate-300
                                           text-red-600"
                                >

                                <span>
                                    <span
                                        class="block text-sm
                                               font-bold text-red-700"
                                    >
                                        Hapus foto unggahan
                                    </span>

                                    <span
                                        class="mt-1 block
                                               text-xs leading-6
                                               text-slate-500"
                                    >
                                        Website akan kembali memakai
                                        foto bawaan setelah semua
                                        perubahan disimpan.
                                    </span>
                                </span>
                            </label>
                        @endif

                        <p
                            class="rounded-xl bg-blue-50
                                   px-4 py-3 text-xs
                                   leading-6 text-blue-800"
                        >
                            Foto baru ikut disimpan saat tombol
                            <strong>Simpan Semua Perubahan</strong>
                            ditekan.
                        </p>
                    </div>
                </div>
            </section>
        @endif


        {{-- ===================================================== --}}
        {{-- VISI --}}
        {{-- ===================================================== --}}

        @if ($profileSection->slug === 'visi-misi')
            <section
                class="overflow-hidden rounded-2xl
                       border border-slate-200
                       bg-white"
            >
                <div
                    class="border-b border-slate-200
                           px-5 py-5 sm:px-6"
                >
                    <h2
                        class="text-lg font-extrabold
                               text-slate-900"
                    >
                        Visi Program Studi
                    </h2>

                    <p
                        class="mt-1 text-sm text-slate-500"
                    >
                        Visi disimpan bersama seluruh perubahan Misi.
                    </p>
                </div>

                <div class="px-5 py-6 sm:px-6">
                    <textarea
                        name="vision_content"
                        rows="7"
                        class="w-full rounded-xl
                               border border-slate-200
                               px-4 py-3 text-sm
                               leading-8 text-slate-800
                               outline-none transition
                               focus:border-[#075F9B]
                               focus:ring-4
                               focus:ring-blue-100"
                    >{{ $visionContent }}</textarea>
                </div>
            </section>
        @endif


        {{-- ===================================================== --}}
        {{-- DAFTAR ITEM BATCH --}}
        {{-- ===================================================== --}}

        <section
            class="overflow-hidden rounded-2xl
                   border border-slate-200
                   bg-white"
        >
            <div
                class="flex flex-col gap-4
                       border-b border-slate-200
                       px-5 py-5 sm:px-6
                       lg:flex-row lg:items-center
                       lg:justify-between"
            >
                <div>
                    <h2
                        class="text-lg font-extrabold
                               text-slate-900"
                    >
                        {{ $config['item_title'] }}
                    </h2>

                    <p
                        class="mt-1 text-sm
                               leading-6 text-slate-500"
                    >
                        Edit beberapa poin sekaligus,
                        kemudian klik Simpan Semua Perubahan.
                    </p>
                </div>

                <div
                    class="flex flex-col gap-3
                           sm:flex-row"
                >
                    <div class="relative">
                        <input
                            id="profileItemSearch"
                            type="search"
                            placeholder="Cari isi..."
                            class="w-full rounded-xl
                                   border border-slate-200
                                   bg-slate-50
                                   py-2.5 pl-10 pr-4
                                   text-sm text-slate-700
                                   outline-none transition
                                   focus:border-[#075F9B]
                                   focus:bg-white
                                   sm:w-64"
                        >

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="absolute left-3
                                   top-1/2 h-4 w-4
                                   -translate-y-1/2
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

                    <button
                        id="addProfileItem"
                        type="button"
                        class="inline-flex items-center
                               justify-center gap-2
                               rounded-xl
                               bg-blue-50 px-4 py-2.5
                               text-sm font-bold
                               text-[#075F9B]
                               transition hover:bg-blue-100"
                    >
                        <span aria-hidden="true">+</span>
                        Tambah {{ $config['item_singular'] }}
                    </button>
                </div>
            </div>


            <div
                id="profileItemsContainer"
                class="space-y-3 bg-slate-50/70
                       p-4 sm:p-5"
            >
                @forelse ($managedItems as $item)
                    @php
                        $itemKey = 'existing_' . $item->id;

                        $infoParts = explode(
                            '|',
                            (string) $item->content,
                            2
                        );

                        $infoValue = trim(
                            $infoParts[0] ?? ''
                        );

                        $infoNote = trim(
                            $infoParts[1] ?? ''
                        );
                    @endphp

                    <article
                        class="profile-item-row
                               rounded-xl border
                               border-slate-200
                               bg-white p-4
                               transition"
                        data-profile-item-row
                        data-search-text="{{ strtolower(
                            trim(
                                ($item->title ?? '')
                                . ' '
                                . ($item->content ?? '')
                            )
                        ) }}"
                    >
                        <input
                            type="hidden"
                            name="items[{{ $itemKey }}][id]"
                            value="{{ $item->id }}"
                        >

                        <input
                            type="hidden"
                            name="items[{{ $itemKey }}][item_group]"
                            value="{{ $config['group'] }}"
                        >

                        <input
                            type="hidden"
                            name="items[{{ $itemKey }}][delete]"
                            value="0"
                            data-delete-input
                        >

                        <input
                            type="hidden"
                            name="items[{{ $itemKey }}][is_active]"
                            value="0"
                        >

                        @if ($config['mode'] === 'info_card')
                            <div
                                class="grid gap-4
                                       lg:grid-cols-[1fr_160px_1fr_90px_100px_110px]"
                            >
                                <div>
                                    <label
                                        class="block text-[11px]
                                               font-bold text-slate-500"
                                    >
                                        Nama Informasi
                                    </label>

                                    <input
                                        type="text"
                                        name="items[{{ $itemKey }}][title]"
                                        value="{{ old(
                                            "items.$itemKey.title",
                                            $item->title
                                        ) }}"
                                        placeholder="Jenjang Pendidikan"
                                        class="mt-1.5 w-full
                                               rounded-lg border
                                               border-slate-200
                                               px-3 py-2.5 text-sm
                                               text-slate-800
                                               outline-none
                                               focus:border-[#075F9B]"
                                    >
                                </div>

                                <div>
                                    <label
                                        class="block text-[11px]
                                               font-bold text-slate-500"
                                    >
                                        Nilai
                                    </label>

                                    <input
                                        type="text"
                                        name="items[{{ $itemKey }}][value]"
                                        value="{{ old(
                                            "items.$itemKey.value",
                                            $infoValue
                                        ) }}"
                                        class="mt-1.5 w-full
                                               rounded-lg border
                                               border-slate-200
                                               px-3 py-2.5 text-sm
                                               font-bold text-slate-800
                                               outline-none
                                               focus:border-[#075F9B]"
                                    >
                                </div>

                                <div>
                                    <label
                                        class="block text-[11px]
                                               font-bold text-slate-500"
                                    >
                                        Keterangan
                                    </label>

                                    <input
                                        type="text"
                                        name="items[{{ $itemKey }}][note]"
                                        value="{{ old(
                                            "items.$itemKey.note",
                                            $infoNote
                                        ) }}"
                                        class="mt-1.5 w-full
                                               rounded-lg border
                                               border-slate-200
                                               px-3 py-2.5 text-sm
                                               text-slate-800
                                               outline-none
                                               focus:border-[#075F9B]"
                                    >
                                </div>
                        @else
                            <div
                                class="grid gap-4
                                       lg:grid-cols-[180px_1fr_76px_90px_110px]"
                            >
                                <div>
                                    <label
                                        class="block text-[11px]
                                               font-bold text-slate-500"
                                    >
                                        Judul / Nomor
                                    </label>

                                    <input
                                        type="text"
                                        name="items[{{ $itemKey }}][title]"
                                        value="{{ old(
                                            "items.$itemKey.title",
                                            $item->title
                                        ) }}"
                                        placeholder="{{ $config['item_singular'] }} {{ $loop->iteration }}"
                                        class="mt-1.5 w-full
                                               rounded-lg border
                                               border-slate-200
                                               px-3 py-2.5 text-sm
                                               text-slate-800
                                               outline-none
                                               focus:border-[#075F9B]"
                                    >
                                </div>

                                <div>
                                    <label
                                        class="block text-[11px]
                                               font-bold text-slate-500"
                                    >
                                        Isi Konten
                                    </label>

                                    <textarea
                                        name="items[{{ $itemKey }}][content]"
                                        rows="3"
                                        class="mt-1.5 w-full
                                               rounded-lg border
                                               border-slate-200
                                               px-3 py-2.5 text-sm
                                               leading-6 text-slate-800
                                               outline-none
                                               focus:border-[#075F9B]"
                                    >{{ old(
                                        "items.$itemKey.content",
                                        $item->content
                                    ) }}</textarea>
                                </div>
                        @endif

                                <div>
                                    <label
                                        class="block text-[11px]
                                               font-bold text-slate-500"
                                    >
                                        Urutan
                                    </label>

                                    <input
                                        type="number"
                                        min="0"
                                        name="items[{{ $itemKey }}][sort_order]"
                                        value="{{ old(
                                            "items.$itemKey.sort_order",
                                            $item->sort_order
                                        ) }}"
                                        class="mt-1.5 w-full
                                               rounded-lg border
                                               border-slate-200
                                               px-3 py-2.5
                                               text-center text-sm
                                               text-slate-800
                                               outline-none
                                               focus:border-[#075F9B]"
                                    >
                                </div>

                                <div>
                                    <label
                                        class="block text-[11px]
                                               font-bold text-slate-500"
                                    >
                                        Status
                                    </label>

                                    <label
                                        class="mt-1.5 flex h-[42px]
                                               cursor-pointer
                                               items-center gap-2
                                               rounded-lg border
                                               border-slate-200
                                               px-3 text-sm
                                               font-semibold
                                               text-slate-700"
                                    >
                                        <input
                                            type="checkbox"
                                            name="items[{{ $itemKey }}][is_active]"
                                            value="1"
                                            class="h-4 w-4 rounded
                                                   border-slate-300
                                                   text-[#075F9B]"
                                            {{ old(
                                                "items.$itemKey.is_active",
                                                $item->is_active
                                            ) ? 'checked' : '' }}
                                        >

                                        Tampil
                                    </label>
                                </div>

                                <div>
                                    <label
                                        class="block text-[11px]
                                               font-bold text-slate-500"
                                    >
                                        Aksi
                                    </label>

                                    <button
                                        type="button"
                                        class="mt-1.5 flex h-[42px]
                                               w-full items-center
                                               justify-center
                                               rounded-lg bg-red-50
                                               px-3 text-sm
                                               font-bold text-red-600
                                               transition
                                               hover:bg-red-100"
                                        data-delete-button
                                    >
                                        Hapus
                                    </button>
                                </div>
                            </div>

                        <p
                            class="mt-3 hidden text-xs
                                   font-bold text-red-600"
                            data-delete-message
                        >
                            Item ini akan dihapus saat semua
                            perubahan disimpan.
                        </p>
                    </article>
                @empty
                    <div
                        id="emptyProfileItems"
                        class="rounded-xl border
                               border-dashed border-slate-300
                               bg-white px-6 py-10
                               text-center"
                    >
                        <p
                            class="text-sm font-bold
                                   text-slate-700"
                        >
                            Belum ada {{ strtolower(
                                $config['item_singular']
                            ) }}
                        </p>

                        <p
                            class="mt-2 text-sm
                                   text-slate-500"
                        >
                            Tekan tombol Tambah
                            {{ $config['item_singular'] }}
                            untuk membuat data baru.
                        </p>
                    </div>
                @endforelse
            </div>


            <div
                id="profileSearchEmpty"
                class="hidden border-t
                       border-slate-200
                       px-6 py-8 text-center"
            >
                <p
                    class="text-sm font-bold
                           text-slate-700"
                >
                    Isi tidak ditemukan
                </p>
            </div>
        </section>


        {{-- ===================================================== --}}
        {{-- SIMPAN SEMUA --}}
        {{-- ===================================================== --}}

        <section
            class="flex flex-col gap-4
                   rounded-2xl border
                   border-slate-200 bg-white
                   px-5 py-5 shadow-sm
                   sm:flex-row sm:items-center
                   sm:justify-between sm:px-6"
        >
            <div>
                <h2
                    class="text-sm font-extrabold
                           text-slate-900"
                >
                    Simpan semua perubahan?
                </h2>

                <p
                    class="mt-1 text-xs
                           leading-5 text-slate-500"
                >
                    Semua perubahan pada halaman ini akan
                    disimpan sekaligus.
                </p>
            </div>

            <button
                id="saveAllProfileContent"
                type="submit"
                class="inline-flex w-full
                       items-center justify-center
                       gap-2 rounded-xl
                       bg-[#075F9B] px-6 py-3
                       text-sm font-bold text-white
                       transition hover:bg-[#064B7B]
                       disabled:cursor-not-allowed
                       disabled:opacity-70
                       sm:w-auto"
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
                        d="M5 13l4 4L19 7"
                    />
                </svg>

                <span data-save-label>
                    Simpan Semua Perubahan
                </span>
            </button>
        </section>
    </form>
</div>


{{-- ============================================================= --}}
{{-- TEMPLATE ITEM BARU --}}
{{-- ============================================================= --}}

<template id="profileItemTemplate">
    <article
        class="profile-item-row
               rounded-xl border
               border-blue-200
               bg-white p-4 transition"
        data-profile-item-row
        data-new-row
        data-search-text=""
    >
        <input
            type="hidden"
            name="items[__KEY__][item_group]"
            value="{{ $config['group'] }}"
        >

        <input
            type="hidden"
            name="items[__KEY__][delete]"
            value="0"
            data-delete-input
        >

        <input
            type="hidden"
            name="items[__KEY__][is_active]"
            value="0"
        >

        @if ($config['mode'] === 'info_card')
            <div
                class="grid gap-4
                       lg:grid-cols-[1fr_160px_1fr_90px_100px_110px]"
            >
                <div>
                    <label
                        class="block text-[11px]
                               font-bold text-slate-500"
                    >
                        Nama Informasi
                    </label>

                    <input
                        type="text"
                        name="items[__KEY__][title]"
                        placeholder="Jenjang Pendidikan"
                        class="mt-1.5 w-full
                               rounded-lg border
                               border-slate-200
                               px-3 py-2.5 text-sm
                               text-slate-800 outline-none
                               focus:border-[#075F9B]"
                    >
                </div>

                <div>
                    <label
                        class="block text-[11px]
                               font-bold text-slate-500"
                    >
                        Nilai
                    </label>

                    <input
                        type="text"
                        name="items[__KEY__][value]"
                        placeholder="D-IV"
                        class="mt-1.5 w-full
                               rounded-lg border
                               border-slate-200
                               px-3 py-2.5 text-sm
                               font-bold text-slate-800
                               outline-none
                               focus:border-[#075F9B]"
                    >
                </div>

                <div>
                    <label
                        class="block text-[11px]
                               font-bold text-slate-500"
                    >
                        Keterangan
                    </label>

                    <input
                        type="text"
                        name="items[__KEY__][note]"
                        placeholder="Sarjana Terapan"
                        class="mt-1.5 w-full
                               rounded-lg border
                               border-slate-200
                               px-3 py-2.5 text-sm
                               text-slate-800 outline-none
                               focus:border-[#075F9B]"
                    >
                </div>
        @else
            <div
                class="grid gap-4
                       lg:grid-cols-[180px_1fr_76px_90px_110px]"
            >
                <div>
                    <label
                        class="block text-[11px]
                               font-bold text-slate-500"
                    >
                        Judul / Nomor
                    </label>

                    <input
                        type="text"
                        name="items[__KEY__][title]"
                        placeholder="{{ $config['item_singular'] }} baru"
                        class="mt-1.5 w-full
                               rounded-lg border
                               border-slate-200
                               px-3 py-2.5 text-sm
                               text-slate-800 outline-none
                               focus:border-[#075F9B]"
                    >
                </div>

                <div>
                    <label
                        class="block text-[11px]
                               font-bold text-slate-500"
                    >
                        Isi Konten
                    </label>

                    <textarea
                        name="items[__KEY__][content]"
                        rows="3"
                        placeholder="Tulis isi {{ strtolower(
                            $config['item_singular']
                        ) }}..."
                        class="mt-1.5 w-full
                               rounded-lg border
                               border-slate-200
                               px-3 py-2.5 text-sm
                               leading-6 text-slate-800
                               outline-none
                               focus:border-[#075F9B]"
                    ></textarea>
                </div>
        @endif

                <div>
                    <label
                        class="block text-[11px]
                               font-bold text-slate-500"
                    >
                        Urutan
                    </label>

                    <input
                        type="number"
                        min="0"
                        name="items[__KEY__][sort_order]"
                        value="__ORDER__"
                        class="mt-1.5 w-full
                               rounded-lg border
                               border-slate-200
                               px-3 py-2.5
                               text-center text-sm
                               text-slate-800 outline-none
                               focus:border-[#075F9B]"
                    >
                </div>

                <div>
                    <label
                        class="block text-[11px]
                               font-bold text-slate-500"
                    >
                        Status
                    </label>

                    <label
                        class="mt-1.5 flex h-[42px]
                               cursor-pointer items-center
                               gap-2 rounded-lg border
                               border-slate-200 px-3
                               text-sm font-semibold
                               text-slate-700"
                    >
                        <input
                            type="checkbox"
                            name="items[__KEY__][is_active]"
                            value="1"
                            checked
                            class="h-4 w-4 rounded
                                   border-slate-300
                                   text-[#075F9B]"
                        >

                        Tampil
                    </label>
                </div>

                <div>
                    <label
                        class="block text-[11px]
                               font-bold text-slate-500"
                    >
                        Aksi
                    </label>

                    <button
                        type="button"
                        class="mt-1.5 flex h-[42px]
                               w-full items-center
                               justify-center rounded-lg
                               bg-red-50 px-3
                               text-sm font-bold
                               text-red-600 transition
                               hover:bg-red-100"
                        data-delete-button
                    >
                        Hapus
                    </button>
                </div>
            </div>

        <p
            class="mt-3 hidden text-xs
                   font-bold text-red-600"
            data-delete-message
        >
            Item ini tidak akan disimpan.
        </p>
    </article>
</template>


@once
    <script>
        document.addEventListener(
            'DOMContentLoaded',
            function () {
                const form =
                    document.getElementById(
                        'profileBatchForm'
                    );

                const container =
                    document.getElementById(
                        'profileItemsContainer'
                    );

                const template =
                    document.getElementById(
                        'profileItemTemplate'
                    );

                const addButton =
                    document.getElementById(
                        'addProfileItem'
                    );

                const searchInput =
                    document.getElementById(
                        'profileItemSearch'
                    );

                const searchEmpty =
                    document.getElementById(
                        'profileSearchEmpty'
                    );

                const saveButton =
                    document.getElementById(
                        'saveAllProfileContent'
                    );

                const saveLabel =
                    saveButton?.querySelector(
                        '[data-save-label]'
                    );

                const overviewImageInput =
                    document.getElementById(
                        'overview_image'
                    );

                const overviewImagePreview =
                    document.getElementById(
                        'overviewImagePreview'
                    );

                const selectedOverviewImage =
                    document.getElementById(
                        'selectedOverviewImage'
                    );

                let overviewImageObjectUrl = null;
                let newIndex = 0;
                let nextOrder = {{ $nextOrder }};


                function bindDeleteButton(row) {
                    const button =
                        row.querySelector(
                            '[data-delete-button]'
                        );

                    const deleteInput =
                        row.querySelector(
                            '[data-delete-input]'
                        );

                    const message =
                        row.querySelector(
                            '[data-delete-message]'
                        );

                    if (
                        !button
                        || !deleteInput
                    ) {
                        return;
                    }

                    button.addEventListener(
                        'click',
                        function () {
                            if (
                                row.hasAttribute(
                                    'data-new-row'
                                )
                            ) {
                                row.remove();
                                updateEmptyState();

                                return;
                            }

                            const willDelete =
                                deleteInput.value !== '1';

                            deleteInput.value =
                                willDelete ? '1' : '0';

                            row.classList.toggle(
                                'border-red-300',
                                willDelete
                            );

                            row.classList.toggle(
                                'bg-red-50/60',
                                willDelete
                            );

                            row.classList.toggle(
                                'opacity-70',
                                willDelete
                            );

                            message?.classList.toggle(
                                'hidden',
                                !willDelete
                            );

                            button.textContent =
                                willDelete
                                    ? 'Batalkan'
                                    : 'Hapus';
                        }
                    );
                }


                function updateEmptyState() {
                    const rows =
                        container?.querySelectorAll(
                            '[data-profile-item-row]'
                        ) ?? [];

                    const emptyState =
                        document.getElementById(
                            'emptyProfileItems'
                        );

                    if (
                        emptyState
                        && rows.length > 0
                    ) {
                        emptyState.remove();
                    }
                }


                container
                    ?.querySelectorAll(
                        '[data-profile-item-row]'
                    )
                    .forEach(bindDeleteButton);


                addButton?.addEventListener(
                    'click',
                    function () {
                        if (
                            !container
                            || !template
                        ) {
                            return;
                        }

                        const key =
                            'new_' + Date.now()
                            + '_' + newIndex++;

                        const html =
                            template.innerHTML
                                .replaceAll(
                                    '__KEY__',
                                    key
                                )
                                .replaceAll(
                                    '__ORDER__',
                                    String(nextOrder++)
                                );

                        const holder =
                            document.createElement(
                                'div'
                            );

                        holder.innerHTML =
                            html.trim();

                        const row =
                            holder.firstElementChild;

                        if (!row) {
                            return;
                        }

                        container.appendChild(row);
                        bindDeleteButton(row);
                        updateEmptyState();

                        row.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center',
                        });

                        row.querySelector(
                            'input[type="text"], textarea'
                        )?.focus();
                    }
                );


                searchInput?.addEventListener(
                    'input',
                    function () {
                        const keyword =
                            searchInput.value
                                .toLowerCase()
                                .trim();

                        let visibleCount = 0;

                        container
                            ?.querySelectorAll(
                                '[data-profile-item-row]'
                            )
                            .forEach(function (row) {
                                const liveText =
                                    Array.from(
                                        row.querySelectorAll(
                                            'input[type="text"], textarea'
                                        )
                                    )
                                    .map(function (field) {
                                        return field.value;
                                    })
                                    .join(' ')
                                    .toLowerCase();

                                const isMatch =
                                    keyword === ''
                                    || liveText.includes(
                                        keyword
                                    );

                                row.classList.toggle(
                                    'hidden',
                                    !isMatch
                                );

                                if (isMatch) {
                                    visibleCount++;
                                }
                            });

                        searchEmpty?.classList.toggle(
                            'hidden',
                            visibleCount > 0
                        );
                    }
                );


                overviewImageInput?.addEventListener(
                    'change',
                    function () {
                        const file =
                            overviewImageInput.files?.[0];

                        if (!file) {
                            return;
                        }

                        if (overviewImageObjectUrl) {
                            URL.revokeObjectURL(
                                overviewImageObjectUrl
                            );
                        }

                        overviewImageObjectUrl =
                            URL.createObjectURL(file);

                        if (overviewImagePreview) {
                            overviewImagePreview.src =
                                overviewImageObjectUrl;
                        }

                        if (selectedOverviewImage) {
                            selectedOverviewImage
                                .classList
                                .remove('hidden');

                            selectedOverviewImage.textContent =
                                'Foto baru dipilih: '
                                + file.name;
                        }
                    }
                );


                form?.addEventListener(
                    'submit',
                    function () {
                        if (!saveButton) {
                            return;
                        }

                        saveButton.disabled = true;

                        if (saveLabel) {
                            saveLabel.textContent =
                                'Menyimpan...';
                        }
                    }
                );


                window.addEventListener(
                    'beforeunload',
                    function () {
                        if (overviewImageObjectUrl) {
                            URL.revokeObjectURL(
                                overviewImageObjectUrl
                            );
                        }
                    }
                );
            }
        );
    </script>
@endonce

@endsection
