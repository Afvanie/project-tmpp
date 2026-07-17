@extends('layouts.admin')

@section('title', 'Konten Beranda')

@section('content')

@php
    /*
    |--------------------------------------------------------------------------
    | MEDIA YANG SEDANG DIGUNAKAN
    |--------------------------------------------------------------------------
    */

    $heroVideoPath = trim(
        (string) ($content->hero_video ?? '')
    );

    $dynamicHeroVideoExists = $heroVideoPath !== ''
        && \Illuminate\Support\Facades\Storage::disk('public')
            ->exists($heroVideoPath);

    $fallbackHeroPath = 'assets/videos/hero.mp4';

    $fallbackHeroExists = file_exists(
        public_path($fallbackHeroPath)
    );

    $heroVideoUrl = match (true) {
        $dynamicHeroVideoExists =>
            asset('storage/' . ltrim($heroVideoPath, '/')),

        $fallbackHeroExists =>
            asset($fallbackHeroPath),

        default => null,
    };

    $heroVideoSource = $dynamicHeroVideoExists
        ? 'Video unggahan admin'
        : 'Video bawaan website';

    $imagePath = trim(
        (string) ($content->image ?? '')
    );

    $dynamicImageExists = $imagePath !== ''
        && \Illuminate\Support\Facades\Storage::disk('public')
            ->exists($imagePath);

    $descriptionImageUrl = $dynamicImageExists
        ? asset('storage/' . ltrim($imagePath, '/'))
        : asset('assets/images/about.png');


    /*
    |--------------------------------------------------------------------------
    | STATISTIK YANG DITAMPILKAN
    |--------------------------------------------------------------------------
    |
    | Jumlah Mahasiswa dan Jumlah Dosen sudah tidak digunakan di halaman
    | publik, sehingga tidak perlu ditampilkan kepada pengelola.
    |
    */

    $hiddenStatisticLabels = [
        'jumlah mahasiswa',
        'jumlah dosen',
    ];

    $visibleStatistics = collect($statistics ?? [])
        ->reject(function ($statistic) use (
            $hiddenStatisticLabels
        ) {
            $label = mb_strtolower(
                trim((string) ($statistic->label ?? ''))
            );

            return in_array(
                $label,
                $hiddenStatisticLabels,
                true
            );
        })
        ->values();
@endphp


<div class="mx-auto max-w-6xl space-y-6">

    {{-- ========================================================= --}}
    {{-- JUDUL HALAMAN --}}
    {{-- ========================================================= --}}

    <header
        class="flex flex-col gap-4
               sm:flex-row sm:items-end
               sm:justify-between"
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
                    Pengaturan Halaman
                </p>
            </div>

            <h1
                class="mt-3 text-2xl font-extrabold
                       tracking-tight text-slate-900
                       sm:text-3xl"
            >
                Konten Beranda
            </h1>

            <p
                class="mt-2 max-w-2xl
                       text-sm leading-7
                       text-slate-500"
            >
                Atur video utama, informasi singkat, dan deskripsi
                yang tampil pada halaman depan website.
            </p>
        </div>


        <a
            href="{{ route('home') }}"
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
            <span>Lihat Beranda</span>

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
    </header>


    {{-- ========================================================= --}}
    {{-- PESAN --}}
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
    {{-- FORM UTAMA --}}
    {{-- ========================================================= --}}

    <form
        action="{{ route('admin.home-content.update') }}"
        method="POST"
        enctype="multipart/form-data"
        class="overflow-hidden rounded-2xl
               border border-slate-200
               bg-white"
    >
        @csrf
        @method('PUT')


        {{-- ===================================================== --}}
        {{-- 01. VIDEO UTAMA --}}
        {{-- ===================================================== --}}

        <section
            class="grid gap-7
                   border-b border-slate-200
                   px-5 py-7 sm:px-6
                   lg:grid-cols-12
                   lg:px-8 lg:py-8"
            aria-labelledby="heroVideoTitle"
        >
            <div class="lg:col-span-4">
                <div class="flex items-center gap-3">
                    <span
                        class="flex h-8 w-8
                               items-center justify-center
                               rounded-lg bg-[#075F9B]
                               text-xs font-extrabold
                               text-white"
                    >
                        01
                    </span>

                    <p
                        class="text-xs font-bold
                               uppercase tracking-[0.12em]
                               text-slate-400"
                    >
                        Tampilan Utama
                    </p>
                </div>

                <h2
                    id="heroVideoTitle"
                    class="mt-4 text-lg font-extrabold
                           text-slate-900"
                >
                    Video Banner
                </h2>

                <p
                    class="mt-2 text-sm leading-7
                           text-slate-500"
                >
                    Video ini menjadi latar pada bagian paling atas
                    halaman beranda.
                </p>

                <div
                    class="mt-4 inline-flex
                           items-center gap-2
                           rounded-full bg-blue-50
                           px-3 py-1.5
                           text-xs font-bold
                           text-[#075F9B]"
                >
                    <span
                        class="h-2 w-2 rounded-full
                               bg-[#075F9B]"
                    ></span>

                    {{ $heroVideoSource }}
                </div>
            </div>


            <div class="space-y-5 lg:col-span-8">
                <div
                    class="overflow-hidden rounded-xl
                           border border-slate-200
                           bg-slate-950"
                >
                    @if ($heroVideoUrl !== null)
                        <video
                            id="heroVideoPreview"
                            class="aspect-video w-full
                                   object-cover"
                            controls
                            muted
                            playsinline
                            preload="metadata"
                        >
                            <source src="{{ $heroVideoUrl }}">

                            Browser tidak mendukung video.
                        </video>
                    @else
                        <div
                            class="flex aspect-video
                                   items-center justify-center
                                   px-6 text-center"
                        >
                            <div>
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="mx-auto h-9 w-9
                                           text-white/50"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    aria-hidden="true"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 6h8a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2z"
                                    />
                                </svg>

                                <p
                                    class="mt-3 text-sm
                                           font-bold text-white"
                                >
                                    Video belum tersedia
                                </p>
                            </div>
                        </div>
                    @endif
                </div>


                <div>
                    <label
                        for="hero_video"
                        class="block text-sm
                               font-bold text-slate-800"
                    >
                        Pilih video baru
                    </label>

                    <p
                        class="mt-1 text-xs leading-6
                               text-slate-500"
                    >
                        Kosongkan bagian ini apabila video tidak perlu
                        diganti. Gunakan MP4 atau WebM maksimal 50 MB.
                    </p>

                    <input
                        id="hero_video"
                        type="file"
                        name="hero_video"
                        accept="video/mp4,video/webm"
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
                               file:text-sm file:font-bold
                               file:text-white
                               hover:file:bg-[#064B7B]"
                    >
                </div>


                <div
                    id="selectedVideoInformation"
                    class="hidden rounded-xl
                           border border-blue-200
                           bg-blue-50 px-4 py-3
                           text-sm text-blue-800"
                ></div>


                @if ($dynamicHeroVideoExists)
                    <label
                        class="flex cursor-pointer
                               items-start gap-3
                               border-t border-slate-200
                               pt-4"
                    >
                        <input
                            type="checkbox"
                            name="remove_hero_video"
                            value="1"
                            class="mt-1 h-4 w-4
                                   rounded border-slate-300
                                   text-red-600
                                   focus:ring-red-200"
                        >

                        <span>
                            <span
                                class="block text-sm
                                       font-bold text-red-700"
                            >
                                Hapus video unggahan
                            </span>

                            <span
                                class="mt-1 block
                                       text-xs leading-6
                                       text-slate-500"
                            >
                                Website akan kembali memakai video
                                bawaan setelah perubahan disimpan.
                            </span>
                        </span>
                    </label>
                @endif
            </div>
        </section>


        {{-- ===================================================== --}}
        {{-- 02. STATISTIK --}}
        {{-- ===================================================== --}}

        <section
            class="grid gap-7
                   border-b border-slate-200
                   px-5 py-7 sm:px-6
                   lg:grid-cols-12
                   lg:px-8 lg:py-8"
            aria-labelledby="statisticsTitle"
        >
            <div class="lg:col-span-4">
                <div class="flex items-center gap-3">
                    <span
                        class="flex h-8 w-8
                               items-center justify-center
                               rounded-lg bg-[#075F9B]
                               text-xs font-extrabold
                               text-white"
                    >
                        02
                    </span>

                    <p
                        class="text-xs font-bold
                               uppercase tracking-[0.12em]
                               text-slate-400"
                    >
                        Informasi Singkat
                    </p>
                </div>

                <h2
                    id="statisticsTitle"
                    class="mt-4 text-lg font-extrabold
                           text-slate-900"
                >
                    Statistik Beranda
                </h2>

                <p
                    class="mt-2 text-sm leading-7
                           text-slate-500"
                >
                    Ubah nama dan nilai statistik yang tampil pada
                    halaman beranda.
                </p>
            </div>


            <div class="lg:col-span-8">
                @if ($visibleStatistics->isNotEmpty())
                    <div
                        class="divide-y divide-slate-200
                               border-y border-slate-200"
                    >
                        @foreach ($visibleStatistics as $statistic)
                            <div
                                class="grid gap-4 py-5
                                       sm:grid-cols-[1fr_180px]
                                       sm:items-end"
                            >
                                <input
                                    type="hidden"
                                    name="statistics[{{ $statistic->id }}][sort_order]"
                                    value="{{ old(
                                        'statistics.'
                                        . $statistic->id
                                        . '.sort_order',
                                        $statistic->sort_order
                                    ) }}"
                                >

                                <div>
                                    <label
                                        for="statistic_label_{{ $statistic->id }}"
                                        class="block text-sm
                                               font-bold
                                               text-slate-800"
                                    >
                                        Nama statistik
                                    </label>

                                    <input
                                        id="statistic_label_{{ $statistic->id }}"
                                        type="text"
                                        name="statistics[{{ $statistic->id }}][label]"
                                        value="{{ old(
                                            'statistics.'
                                            . $statistic->id
                                            . '.label',
                                            $statistic->label
                                        ) }}"
                                        required
                                        class="mt-2 w-full
                                               rounded-xl border
                                               border-slate-200
                                               px-4 py-3
                                               text-sm text-slate-800
                                               outline-none transition
                                               focus:border-[#075F9B]
                                               focus:ring-4
                                               focus:ring-blue-100"
                                    >
                                </div>


                                <div>
                                    <label
                                        for="statistic_value_{{ $statistic->id }}"
                                        class="block text-sm
                                               font-bold
                                               text-slate-800"
                                    >
                                        Nilai
                                    </label>

                                    <input
                                        id="statistic_value_{{ $statistic->id }}"
                                        type="text"
                                        name="statistics[{{ $statistic->id }}][value]"
                                        value="{{ old(
                                            'statistics.'
                                            . $statistic->id
                                            . '.value',
                                            $statistic->value
                                        ) }}"
                                        required
                                        class="mt-2 w-full
                                               rounded-xl border
                                               border-slate-200
                                               px-4 py-3
                                               text-sm font-bold
                                               text-slate-800
                                               outline-none transition
                                               focus:border-[#075F9B]
                                               focus:ring-4
                                               focus:ring-blue-100"
                                    >
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <p
                        class="mt-3 text-xs leading-6
                               text-slate-500"
                    >
                        Contoh nilai: <strong>8 Semester</strong>,
                        <strong>152 SKS</strong>, atau
                        <strong>KKNI Level 6</strong>.
                    </p>
                @else
                    <div
                        class="border-y border-slate-200
                               py-8 text-center"
                    >
                        <p
                            class="text-sm font-bold
                                   text-slate-700"
                        >
                            Statistik belum tersedia
                        </p>

                        <p
                            class="mt-2 text-sm
                                   text-slate-500"
                        >
                            Data statistik akan muncul di bagian ini.
                        </p>
                    </div>
                @endif
            </div>
        </section>


        {{-- ===================================================== --}}
        {{-- 03. DESKRIPSI PROGRAM STUDI --}}
        {{-- ===================================================== --}}

        <section
            class="grid gap-7
                   px-5 py-7 sm:px-6
                   lg:grid-cols-12
                   lg:px-8 lg:py-8"
            aria-labelledby="descriptionTitle"
        >
            <div class="lg:col-span-4">
                <div class="flex items-center gap-3">
                    <span
                        class="flex h-8 w-8
                               items-center justify-center
                               rounded-lg bg-[#075F9B]
                               text-xs font-extrabold
                               text-white"
                    >
                        03
                    </span>

                    <p
                        class="text-xs font-bold
                               uppercase tracking-[0.12em]
                               text-slate-400"
                    >
                        Pengenalan Program Studi
                    </p>
                </div>

                <h2
                    id="descriptionTitle"
                    class="mt-4 text-lg font-extrabold
                           text-slate-900"
                >
                    Deskripsi Beranda
                </h2>

                <p
                    class="mt-2 text-sm leading-7
                           text-slate-500"
                >
                    Tulis seluruh deskripsi dalam satu kolom.
                    Pisahkan paragraf dengan menekan Enter.
                </p>
            </div>


            <div class="space-y-6 lg:col-span-8">
                <div>
                    <label
                        for="badge"
                        class="block text-sm
                               font-bold text-slate-800"
                    >
                        Teks kecil di atas judul
                    </label>

                    <p
                        class="mt-1 text-xs leading-6
                               text-slate-500"
                    >
                        Contoh: Program Studi
                    </p>

                    <input
                        id="badge"
                        type="text"
                        name="badge"
                        value="{{ old(
                            'badge',
                            $content->badge
                        ) }}"
                        placeholder="Program Studi"
                        class="mt-2 w-full
                               rounded-xl border
                               border-slate-200
                               px-4 py-3
                               text-sm text-slate-800
                               outline-none transition
                               focus:border-[#075F9B]
                               focus:ring-4
                               focus:ring-blue-100"
                    >
                </div>


                <div>
                    <label
                        for="title"
                        class="block text-sm
                               font-bold text-slate-800"
                    >
                        Judul bagian
                    </label>

                    <p
                        class="mt-1 text-xs leading-6
                               text-slate-500"
                    >
                        Judul utama yang tampil sebelum deskripsi.
                    </p>

                    <input
                        id="title"
                        type="text"
                        name="title"
                        value="{{ old(
                            'title',
                            $content->title
                        ) }}"
                        placeholder="Deskripsi Program Studi"
                        required
                        class="mt-2 w-full
                               rounded-xl border
                               border-slate-200
                               px-4 py-3
                               text-sm font-bold
                               text-slate-800
                               outline-none transition
                               focus:border-[#075F9B]
                               focus:ring-4
                               focus:ring-blue-100"
                    >
                </div>


                <div>
                    <label
                        for="description"
                        class="block text-sm
                               font-bold text-slate-800"
                    >
                        Isi deskripsi
                    </label>

                    <p
                        class="mt-1 text-xs leading-6
                               text-slate-500"
                    >
                        Semua paragraf diedit di sini. Tekan Enter dua
                        kali untuk memberi jarak antarparagraf.
                    </p>

                    <textarea
                        id="description"
                        name="description"
                        rows="14"
                        required
                        placeholder="Tulis deskripsi Program Studi D-IV TMPP..."
                        class="mt-2 w-full
                               rounded-xl border
                               border-slate-200
                               px-4 py-3
                               text-sm leading-8
                               text-slate-800
                               outline-none transition
                               focus:border-[#075F9B]
                               focus:ring-4
                               focus:ring-blue-100"
                    >{{ old(
                        'description',
                        $content->description
                    ) }}</textarea>
                </div>


                <div
                    class="grid gap-5
                           border-t border-slate-200
                           pt-6 lg:grid-cols-2
                           lg:items-start"
                >
                    <div>
                        <label
                            for="image"
                            class="block text-sm
                                   font-bold text-slate-800"
                        >
                            Gambar pendamping
                        </label>

                        <p
                            class="mt-1 text-xs leading-6
                                   text-slate-500"
                        >
                            Kosongkan apabila gambar tidak perlu diganti.
                            Gunakan JPG, PNG, atau WebP maksimal 4 MB.
                        </p>

                        <input
                            id="image"
                            type="file"
                            name="image"
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
                                   file:text-sm file:font-bold
                                   file:text-white
                                   hover:file:bg-[#064B7B]"
                        >

                        <p
                            id="selectedImageInformation"
                            class="mt-3 hidden text-xs
                                   font-semibold text-[#075F9B]"
                        ></p>
                    </div>


                    <div
                        class="overflow-hidden rounded-xl
                               border border-slate-200"
                    >
                        <img
                            id="descriptionImagePreview"
                            src="{{ $descriptionImageUrl }}"
                            alt="Gambar pendamping yang digunakan saat ini"
                            class="aspect-[4/3] w-full
                                   object-cover"
                        >
                    </div>
                </div>
            </div>
        </section>


        {{-- ===================================================== --}}
        {{-- TOMBOL SIMPAN --}}
        {{-- ===================================================== --}}

        <footer
            class="flex flex-col gap-4
                   border-t border-slate-200
                   bg-slate-50 px-5 py-5
                   sm:flex-row sm:items-center
                   sm:justify-between
                   sm:px-6 lg:px-8"
        >
            <p
                class="text-sm leading-6
                       text-slate-500"
            >
                Periksa kembali isi sebelum menyimpan perubahan.
            </p>

            <button
                id="saveHomeContentButton"
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
                    Simpan Perubahan
                </span>
            </button>
        </footer>
    </form>
</div>


@once
    <script>
        document.addEventListener(
            'DOMContentLoaded',
            function () {
                const form = document.querySelector(
                    'form[action="{{ route(
                        'admin.home-content.update'
                    ) }}"]'
                );

                const videoInput =
                    document.getElementById(
                        'hero_video'
                    );

                const videoPreview =
                    document.getElementById(
                        'heroVideoPreview'
                    );

                const videoInformation =
                    document.getElementById(
                        'selectedVideoInformation'
                    );

                const imageInput =
                    document.getElementById(
                        'image'
                    );

                const imagePreview =
                    document.getElementById(
                        'descriptionImagePreview'
                    );

                const imageInformation =
                    document.getElementById(
                        'selectedImageInformation'
                    );

                const saveButton =
                    document.getElementById(
                        'saveHomeContentButton'
                    );

                const saveLabel =
                    saveButton?.querySelector(
                        '[data-save-label]'
                    );

                let videoObjectUrl = null;
                let imageObjectUrl = null;


                videoInput?.addEventListener(
                    'change',
                    function () {
                        const file =
                            videoInput.files?.[0];

                        if (!file) {
                            return;
                        }

                        if (videoObjectUrl) {
                            URL.revokeObjectURL(
                                videoObjectUrl
                            );
                        }

                        videoObjectUrl =
                            URL.createObjectURL(file);

                        if (videoPreview) {
                            videoPreview.src =
                                videoObjectUrl;

                            videoPreview.load();
                        }

                        if (videoInformation) {
                            const fileSizeMb =
                                (
                                    file.size
                                    / 1024
                                    / 1024
                                ).toFixed(2);

                            videoInformation
                                .classList
                                .remove('hidden');

                            videoInformation.textContent =
                                'Video baru dipilih: '
                                + file.name
                                + ' ('
                                + fileSizeMb
                                + ' MB).';
                        }
                    }
                );


                imageInput?.addEventListener(
                    'change',
                    function () {
                        const file =
                            imageInput.files?.[0];

                        if (!file) {
                            return;
                        }

                        if (imageObjectUrl) {
                            URL.revokeObjectURL(
                                imageObjectUrl
                            );
                        }

                        imageObjectUrl =
                            URL.createObjectURL(file);

                        if (imagePreview) {
                            imagePreview.src =
                                imageObjectUrl;
                        }

                        if (imageInformation) {
                            imageInformation
                                .classList
                                .remove('hidden');

                            imageInformation.textContent =
                                'Gambar baru dipilih: '
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
                        if (videoObjectUrl) {
                            URL.revokeObjectURL(
                                videoObjectUrl
                            );
                        }

                        if (imageObjectUrl) {
                            URL.revokeObjectURL(
                                imageObjectUrl
                            );
                        }
                    }
                );
            }
        );
    </script>
@endonce

@endsection
