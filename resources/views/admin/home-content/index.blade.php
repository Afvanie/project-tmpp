@extends('layouts.admin')

@section('title', 'Konten Beranda')

@section('content')

@php
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
            asset('storage/' . $heroVideoPath),

        $fallbackHeroExists =>
            asset($fallbackHeroPath),

        default => null,
    };

    $heroVideoSource = $dynamicHeroVideoExists
        ? 'Video dari admin'
        : 'Video bawaan website';

    $imagePath = trim(
        (string) ($content->image ?? '')
    );

    $dynamicImageExists = $imagePath !== ''
        && \Illuminate\Support\Facades\Storage::disk('public')
            ->exists($imagePath);

    $descriptionImageUrl = $dynamicImageExists
        ? asset('storage/' . $imagePath)
        : asset('assets/images/about.png');
@endphp


<div class="space-y-8">

    {{-- ========================================================= --}}
    {{-- HEADER --}}
    {{-- ========================================================= --}}

    <div
        class="relative overflow-hidden rounded-3xl
               bg-gradient-to-r
               from-[#071B3A]
               via-[#0B3B75]
               to-[#071B3A]
               p-6 text-white shadow-xl
               md:p-8"
    >
        <div
            class="absolute -right-24 -top-24
                   h-72 w-72 rounded-full
                   bg-yellow-300/20 blur-3xl"
        ></div>

        <div
            class="absolute -bottom-24 -left-24
                   h-72 w-72 rounded-full
                   bg-blue-300/20 blur-3xl"
        ></div>

        <div
            class="relative flex flex-col
                   gap-6 md:flex-row
                   md:items-center
                   md:justify-between"
        >
            <div>
                <span
                    class="inline-flex rounded-full
                           bg-yellow-400 px-4 py-1
                           text-sm font-bold
                           text-slate-900"
                >
                    Beranda Website
                </span>

                <h1
                    class="mt-5 text-3xl
                           font-extrabold md:text-4xl"
                >
                    Konten Beranda
                </h1>

                <p
                    class="mt-3 max-w-2xl
                           leading-7 text-blue-100"
                >
                    Kelola video banner, statistik, deskripsi,
                    tombol, dan gambar yang tampil pada halaman
                    utama website D-IV TMPP Polinema.
                </p>
            </div>

            <a
                href="{{ route('home') }}"
                target="_blank"
                rel="noopener noreferrer"
                class="inline-flex items-center
                       justify-center gap-2
                       rounded-2xl bg-white
                       px-5 py-3 font-bold
                       text-blue-800 shadow-lg
                       transition
                       hover:bg-yellow-300
                       hover:text-slate-900"
            >
                Lihat Website
                <span aria-hidden="true">→</span>
            </a>
        </div>
    </div>


    {{-- ========================================================= --}}
    {{-- ALERT --}}
    {{-- ========================================================= --}}

    @if (session('success'))
        <div
            class="rounded-2xl border
                   border-green-100
                   bg-green-50 px-5 py-4
                   font-semibold text-green-700
                   shadow-sm"
        >
            {{ session('success') }}
        </div>
    @endif


    @if ($errors->any())
        <div
            class="rounded-2xl border
                   border-red-100
                   bg-red-50 px-5 py-4
                   text-red-700 shadow-sm"
        >
            <h3 class="mb-2 font-bold">
                Ada data yang perlu diperbaiki:
            </h3>

            <ul
                class="list-inside list-disc
                       space-y-1 text-sm"
            >
                @foreach ($errors->all() as $error)
                    <li>
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif


    <form
        action="{{ route('admin.home-content.update') }}"
        method="POST"
        enctype="multipart/form-data"
        class="space-y-8"
    >
        @csrf
        @method('PUT')


        {{-- ===================================================== --}}
        {{-- VIDEO HERO --}}
        {{-- ===================================================== --}}

        <section
            class="overflow-hidden rounded-3xl
                   border border-slate-100
                   bg-white shadow-sm"
        >
            <div
                class="flex flex-col gap-3
                       border-b border-slate-100
                       px-6 py-5
                       md:flex-row
                       md:items-center
                       md:justify-between"
            >
                <div>
                    <h2
                        class="text-xl font-extrabold
                               text-slate-800"
                    >
                        Video Banner Beranda
                    </h2>

                    <p
                        class="mt-1 text-sm
                               leading-6 text-slate-500"
                    >
                        Video ini tampil sebagai latar belakang
                        pada bagian hero halaman beranda.
                    </p>
                </div>

                <span
                    class="inline-flex w-fit
                           items-center gap-2
                           rounded-full bg-blue-50
                           px-4 py-2 text-xs
                           font-bold text-blue-700"
                >
                    <span
                        class="h-2 w-2 rounded-full
                               bg-blue-600"
                    ></span>

                    {{ $heroVideoSource }}
                </span>
            </div>


            <div
                class="grid gap-8 p-6
                       xl:grid-cols-12"
            >
                {{-- Upload --}}
                <div
                    class="space-y-5
                           xl:col-span-5"
                >
                    <div
                        class="rounded-3xl border
                               border-slate-200
                               bg-slate-50 p-5"
                    >
                        <label
                            for="hero_video"
                            class="block text-sm
                                   font-bold text-slate-700"
                        >
                            Unggah Video Baru
                        </label>

                        <input
                            id="hero_video"
                            type="file"
                            name="hero_video"
                            accept="video/mp4,video/webm"
                            class="mt-3 w-full
                                   rounded-2xl border
                                   border-slate-200
                                   bg-white px-4 py-3
                                   text-sm text-slate-600
                                   file:mr-4
                                   file:rounded-xl
                                   file:border-0
                                   file:bg-blue-700
                                   file:px-4 file:py-2
                                   file:font-bold
                                   file:text-white
                                   hover:file:bg-blue-800"
                        >

                        <p
                            class="mt-3 text-xs
                                   leading-6 text-slate-500"
                        >
                            Format: MP4 atau WebM. Ukuran maksimal
                            50 MB. Gunakan video horizontal agar
                            tampilan banner tetap optimal.
                        </p>
                    </div>


                    @if ($dynamicHeroVideoExists)
                        <label
                            class="flex cursor-pointer
                                   items-start gap-3
                                   rounded-2xl border
                                   border-red-100
                                   bg-red-50 p-4"
                        >
                            <input
                                type="checkbox"
                                name="remove_hero_video"
                                value="1"
                                class="mt-1 h-4 w-4
                                       rounded border-red-300
                                       text-red-600
                                       focus:ring-red-200"
                            >

                            <span>
                                <span
                                    class="block text-sm
                                           font-bold text-red-700"
                                >
                                    Hapus video dari admin
                                </span>

                                <span
                                    class="mt-1 block text-xs
                                           leading-5
                                           text-red-600/80"
                                >
                                    Setelah dihapus, banner akan
                                    kembali menggunakan video bawaan
                                    website.
                                </span>
                            </span>
                        </label>
                    @endif


                    <div
                        class="rounded-2xl border
                               border-blue-100
                               bg-blue-50 p-4"
                    >
                        <h3
                            class="text-sm font-bold
                                   text-blue-800"
                        >
                            Cara kerja video banner
                        </h3>

                        <p
                            class="mt-2 text-xs
                                   leading-6 text-blue-700"
                        >
                            Video yang diunggah melalui admin akan
                            menjadi video utama. Saat tidak tersedia,
                            website memakai
                            <strong>assets/videos/hero.mp4</strong>
                            sebagai cadangan.
                        </p>
                    </div>
                </div>


                {{-- Preview --}}
                <div class="xl:col-span-7">
                    <div
                        class="overflow-hidden
                               rounded-3xl border
                               border-slate-200
                               bg-slate-950 shadow-lg"
                    >
                        <div
                            class="flex items-center
                                   justify-between
                                   border-b
                                   border-white/10
                                   bg-slate-900
                                   px-5 py-4"
                        >
                            <div>
                                <h3
                                    class="font-extrabold
                                           text-white"
                                >
                                    Preview Video Banner
                                </h3>

                                <p
                                    class="mt-1 text-xs
                                           text-slate-400"
                                >
                                    Tampilan video aktif saat ini.
                                </p>
                            </div>

                            <span
                                class="rounded-full
                                       bg-white/10
                                       px-3 py-1
                                       text-[10px]
                                       font-bold uppercase
                                       tracking-wider
                                       text-white/80"
                            >
                                Hero
                            </span>
                        </div>

                        @if ($heroVideoUrl !== null)
                            <video
                                id="heroVideoPreview"
                                class="aspect-video
                                       w-full object-cover"
                                controls
                                muted
                                playsinline
                                preload="metadata"
                            >
                                <source
                                    src="{{ $heroVideoUrl }}"
                                >

                                Browser tidak mendukung video.
                            </video>
                        @else
                            <div
                                class="flex aspect-video
                                       items-center
                                       justify-center
                                       px-8 text-center"
                            >
                                <div>
                                    <div
                                        class="mx-auto flex
                                               h-16 w-16
                                               items-center
                                               justify-center
                                               rounded-2xl
                                               bg-white/10
                                               text-2xl
                                               text-white"
                                    >
                                        <i
                                            class="fa-solid
                                                   fa-video"
                                        ></i>
                                    </div>

                                    <p
                                        class="mt-4 font-bold
                                               text-white"
                                    >
                                        Video belum tersedia
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div
                        id="selectedVideoInformation"
                        class="mt-4 hidden
                               rounded-2xl border
                               border-green-100
                               bg-green-50 p-4
                               text-sm text-green-700"
                    ></div>
                </div>
            </div>
        </section>


        {{-- ===================================================== --}}
        {{-- STATISTIK --}}
        {{-- ===================================================== --}}

        <section
            class="overflow-hidden rounded-3xl
                   border border-slate-100
                   bg-white shadow-sm"
        >
            <div
                class="flex flex-col gap-3
                       border-b border-slate-100
                       px-6 py-5
                       md:flex-row
                       md:items-center
                       md:justify-between"
            >
                <div>
                    <h2
                        class="text-xl font-extrabold
                               text-slate-800"
                    >
                        Statistik Program Studi
                    </h2>

                    <p
                        class="mt-1 text-sm
                               text-slate-500"
                    >
                        Kelola angka statistik singkat yang tampil
                        di halaman beranda.
                    </p>
                </div>

                <span
                    class="inline-flex w-fit
                           rounded-full bg-blue-50
                           px-4 py-2 text-sm
                           font-bold text-blue-700"
                >
                    {{ $statistics->count() }} Data
                </span>
            </div>


            <div class="p-6">
                <div
                    class="overflow-x-auto
                           rounded-2xl border
                           border-slate-100"
                >
                    <table class="w-full text-sm">
                        <thead
                            class="bg-slate-50
                                   text-slate-600"
                        >
                            <tr>
                                <th
                                    class="w-32 px-4 py-3
                                           text-left font-bold"
                                >
                                    Urutan
                                </th>

                                <th
                                    class="px-4 py-3
                                           text-left font-bold"
                                >
                                    Label
                                </th>

                                <th
                                    class="w-56 px-4 py-3
                                           text-left font-bold"
                                >
                                    Angka / Nilai
                                </th>
                            </tr>
                        </thead>

                        <tbody
                            class="divide-y
                                   divide-slate-100
                                   bg-white"
                        >
                            @foreach ($statistics as $statistic)
                                <tr
                                    class="transition
                                           hover:bg-slate-50"
                                >
                                    <td class="px-4 py-3">
                                        <input
                                            type="number"
                                            name="statistics[{{ $statistic->id }}][sort_order]"
                                            value="{{ old(
                                                'statistics.'
                                                . $statistic->id
                                                . '.sort_order',
                                                $statistic->sort_order
                                            ) }}"
                                            min="0"
                                            class="w-full
                                                   rounded-xl border
                                                   border-slate-200
                                                   px-3 py-2
                                                   font-semibold
                                                   text-slate-800
                                                   outline-none
                                                   transition
                                                   focus:border-blue-500
                                                   focus:ring-4
                                                   focus:ring-blue-100"
                                        >
                                    </td>

                                    <td class="px-4 py-3">
                                        <input
                                            type="text"
                                            name="statistics[{{ $statistic->id }}][label]"
                                            value="{{ old(
                                                'statistics.'
                                                . $statistic->id
                                                . '.label',
                                                $statistic->label
                                            ) }}"
                                            class="w-full
                                                   rounded-xl border
                                                   border-slate-200
                                                   px-3 py-2
                                                   text-slate-800
                                                   outline-none
                                                   transition
                                                   focus:border-blue-500
                                                   focus:ring-4
                                                   focus:ring-blue-100"
                                        >
                                    </td>

                                    <td class="px-4 py-3">
                                        <input
                                            type="text"
                                            name="statistics[{{ $statistic->id }}][value]"
                                            value="{{ old(
                                                'statistics.'
                                                . $statistic->id
                                                . '.value',
                                                $statistic->value
                                            ) }}"
                                            class="w-full
                                                   rounded-xl border
                                                   border-slate-200
                                                   px-3 py-2
                                                   font-bold
                                                   text-slate-800
                                                   outline-none
                                                   transition
                                                   focus:border-blue-500
                                                   focus:ring-4
                                                   focus:ring-blue-100"
                                        >
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>


        {{-- ===================================================== --}}
        {{-- DESKRIPSI PROGRAM STUDI --}}
        {{-- ===================================================== --}}

        <section
            class="overflow-hidden rounded-3xl
                   border border-slate-100
                   bg-white shadow-sm"
        >
            <div
                class="border-b border-slate-100
                       px-6 py-5"
            >
                <h2
                    class="text-xl font-extrabold
                           text-slate-800"
                >
                    Deskripsi Program Studi
                </h2>

                <p
                    class="mt-1 text-sm
                           text-slate-500"
                >
                    Konten ini tampil pada section deskripsi
                    program studi di halaman beranda.
                </p>
            </div>


            <div class="p-6">
                <div
                    class="grid gap-8
                           xl:grid-cols-12"
                >
                    {{-- Form kiri --}}
                    <div
                        class="space-y-5
                               xl:col-span-7"
                    >
                        <div>
                            <label
                                for="badge"
                                class="mb-2 block
                                       text-sm font-bold
                                       text-slate-700"
                            >
                                Badge Kecil
                            </label>

                            <input
                                id="badge"
                                type="text"
                                name="badge"
                                value="{{ old(
                                    'badge',
                                    $content->badge
                                ) }}"
                                placeholder="Contoh: Program Studi"
                                class="w-full rounded-2xl
                                       border border-slate-200
                                       px-4 py-3
                                       text-slate-800
                                       outline-none transition
                                       focus:border-blue-500
                                       focus:ring-4
                                       focus:ring-blue-100"
                            >
                        </div>

                        <div>
                            <label
                                for="title"
                                class="mb-2 block
                                       text-sm font-bold
                                       text-slate-700"
                            >
                                Judul Section
                            </label>

                            <input
                                id="title"
                                type="text"
                                name="title"
                                value="{{ old(
                                    'title',
                                    $content->title
                                ) }}"
                                placeholder="Contoh: Deskripsi Program Studi"
                                required
                                class="w-full rounded-2xl
                                       border border-slate-200
                                       px-4 py-3
                                       font-bold text-slate-800
                                       outline-none transition
                                       focus:border-blue-500
                                       focus:ring-4
                                       focus:ring-blue-100"
                            >
                        </div>

                        <div>
                            <label
                                for="description"
                                class="mb-2 block
                                       text-sm font-bold
                                       text-slate-700"
                            >
                                Deskripsi
                            </label>

                            <textarea
                                id="description"
                                name="description"
                                rows="12"
                                required
                                placeholder="Tulis deskripsi program studi..."
                                class="w-full rounded-2xl
                                       border border-slate-200
                                       px-4 py-3
                                       leading-8
                                       text-slate-800
                                       outline-none transition
                                       focus:border-blue-500
                                       focus:ring-4
                                       focus:ring-blue-100"
                            >{{ old(
                                'description',
                                $content->description
                            ) }}</textarea>
                        </div>

                        <div
                            class="grid gap-5
                                   md:grid-cols-2"
                        >
                            <div>
                                <label
                                    for="button_text"
                                    class="mb-2 block
                                           text-sm font-bold
                                           text-slate-700"
                                >
                                    Teks Tombol
                                </label>

                                <input
                                    id="button_text"
                                    type="text"
                                    name="button_text"
                                    value="{{ old(
                                        'button_text',
                                        $content->button_text
                                    ) }}"
                                    placeholder="Contoh: Selengkapnya"
                                    class="w-full rounded-2xl
                                           border
                                           border-slate-200
                                           px-4 py-3
                                           text-slate-800
                                           outline-none
                                           transition
                                           focus:border-blue-500
                                           focus:ring-4
                                           focus:ring-blue-100"
                                >
                            </div>

                            <div>
                                <label
                                    for="button_url"
                                    class="mb-2 block
                                           text-sm font-bold
                                           text-slate-700"
                                >
                                    URL Tombol
                                </label>

                                <input
                                    id="button_url"
                                    type="text"
                                    name="button_url"
                                    value="{{ old(
                                        'button_url',
                                        $content->button_url
                                    ) }}"
                                    placeholder="/profile"
                                    class="w-full rounded-2xl
                                           border
                                           border-slate-200
                                           px-4 py-3
                                           text-slate-800
                                           outline-none
                                           transition
                                           focus:border-blue-500
                                           focus:ring-4
                                           focus:ring-blue-100"
                                >
                            </div>
                        </div>
                    </div>


                    {{-- Gambar kanan --}}
                    <div class="xl:col-span-5">
                        <div
                            class="space-y-5
                                   xl:sticky xl:top-28"
                        >
                            <div
                                class="rounded-3xl
                                       border
                                       border-slate-100
                                       bg-slate-50 p-5"
                            >
                                <label
                                    for="image"
                                    class="mb-3 block
                                           text-sm font-bold
                                           text-slate-700"
                                >
                                    Gambar Deskripsi
                                </label>

                                <input
                                    id="image"
                                    type="file"
                                    name="image"
                                    accept="image/jpeg,image/png,image/webp"
                                    class="w-full rounded-2xl
                                           border
                                           border-slate-200
                                           bg-white px-4 py-3
                                           text-sm
                                           text-slate-600
                                           file:mr-4
                                           file:rounded-xl
                                           file:border-0
                                           file:bg-blue-700
                                           file:px-4 file:py-2
                                           file:font-bold
                                           file:text-white
                                           hover:file:bg-blue-800"
                                >

                                <p
                                    class="mt-3 text-xs
                                           leading-6
                                           text-slate-500"
                                >
                                    Format JPG, PNG, atau WEBP.
                                    Ukuran maksimal 4 MB.
                                </p>
                            </div>

                            <div
                                class="overflow-hidden
                                       rounded-3xl
                                       border
                                       border-slate-100
                                       bg-white shadow-sm"
                            >
                                <div
                                    class="flex items-center
                                           justify-between
                                           border-b
                                           border-slate-100
                                           px-5 py-4"
                                >
                                    <h3
                                        class="font-extrabold
                                               text-slate-800"
                                    >
                                        Preview Gambar
                                    </h3>

                                    <span
                                        class="text-xs
                                               font-bold uppercase
                                               text-slate-400"
                                    >
                                        Beranda
                                    </span>
                                </div>

                                <div class="p-5">
                                    <img
                                        src="{{ $descriptionImageUrl }}"
                                        alt="Preview gambar deskripsi"
                                        class="h-72 w-full
                                               rounded-2xl
                                               object-cover shadow"
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        {{-- ===================================================== --}}
        {{-- STICKY SUBMIT --}}
        {{-- ===================================================== --}}

        <div class="sticky bottom-5 z-20">
            <div
                class="flex flex-col gap-4
                       rounded-3xl border
                       border-slate-200
                       bg-white/90 px-5 py-4
                       shadow-2xl
                       backdrop-blur-xl
                       md:flex-row
                       md:items-center
                       md:justify-between"
            >
                <div>
                    <h3
                        class="font-extrabold
                               text-slate-800"
                    >
                        Simpan perubahan konten beranda?
                    </h3>

                    <p
                        class="mt-1 text-sm
                               text-slate-500"
                    >
                        Perubahan akan langsung tampil pada
                        halaman utama website.
                    </p>
                </div>

                <div
                    class="flex flex-col gap-3
                           sm:flex-row"
                >
                    <a
                        href="{{ route('home') }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="inline-flex
                               items-center
                               justify-center
                               rounded-2xl
                               bg-slate-100
                               px-6 py-3
                               font-bold
                               text-slate-700
                               transition
                               hover:bg-slate-200"
                    >
                        Preview
                    </a>

                    <button
                        type="submit"
                        class="inline-flex
                               items-center
                               justify-center
                               rounded-2xl
                               bg-blue-700
                               px-7 py-3
                               font-bold text-white
                               shadow-lg
                               shadow-blue-700/20
                               transition
                               hover:bg-blue-800"
                    >
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>


@once
    <script>
        document.addEventListener(
            'DOMContentLoaded',
            function () {
                const videoInput =
                    document.getElementById(
                        'hero_video'
                    );

                const videoPreview =
                    document.getElementById(
                        'heroVideoPreview'
                    );

                const selectedInformation =
                    document.getElementById(
                        'selectedVideoInformation'
                    );

                let objectUrl = null;

                videoInput?.addEventListener(
                    'change',
                    function () {
                        const file =
                            videoInput.files?.[0];

                        if (!file) {
                            return;
                        }

                        if (objectUrl) {
                            URL.revokeObjectURL(
                                objectUrl
                            );
                        }

                        objectUrl =
                            URL.createObjectURL(file);

                        if (videoPreview) {
                            videoPreview.src =
                                objectUrl;

                            videoPreview.load();
                        }

                        if (selectedInformation) {
                            const fileSizeMb =
                                (
                                    file.size
                                    / 1024
                                    / 1024
                                ).toFixed(2);

                            selectedInformation
                                .classList
                                .remove('hidden');

                            selectedInformation
                                .textContent =
                                'Video dipilih: '
                                + file.name
                                + ' ('
                                + fileSizeMb
                                + ' MB). '
                                + 'Klik Simpan Perubahan '
                                + 'untuk mengaktifkannya.';
                        }
                    }
                );

                window.addEventListener(
                    'beforeunload',
                    function () {
                        if (objectUrl) {
                            URL.revokeObjectURL(
                                objectUrl
                            );
                        }
                    }
                );
            }
        );
    </script>
@endonce

@endsection