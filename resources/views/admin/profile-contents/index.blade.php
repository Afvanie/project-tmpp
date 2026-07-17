@extends('layouts.admin')

@section('title', 'Konten Profil')

@section('content')

@php
    $sectionSettings = [
        'overview' => [
            'name' => 'Gambaran Umum Program Studi',
            'description' => 'Ubah pengenalan singkat Program Studi D-IV TMPP.',
        ],
        'history' => [
            'name' => 'Sejarah Program Studi',
            'description' => 'Ubah narasi sejarah dan perjalanan program studi.',
        ],
        'visi-misi' => [
            'name' => 'Visi dan Misi',
            'description' => 'Kelola arah dan komitmen Program Studi D-IV TMPP.',
        ],
        'tujuan-prodi' => [
            'name' => 'Tujuan Program Studi',
            'description' => 'Kelola tujuan penyelenggaraan program studi.',
        ],
        'ppm' => [
            'name' => 'Profil Profesional Mandiri',
            'description' => 'Kelola profil profesional yang diharapkan dari lulusan.',
        ],
        'cpl' => [
            'name' => 'Capaian Pembelajaran Lulusan',
            'description' => 'Kelola kemampuan yang harus dimiliki oleh lulusan.',
        ],
    ];
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
                Konten Profil
            </h1>

            <p
                class="mt-2 max-w-2xl
                       text-sm leading-7
                       text-slate-500"
            >
                Pilih bagian Profil yang ingin diperbarui.
                Setiap bagian memiliki formulir yang disesuaikan
                dengan isi yang dikelola.
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
            <span>Lihat Halaman Profil</span>

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


    {{-- ========================================================= --}}
    {{-- DAFTAR BAGIAN PROFIL --}}
    {{-- ========================================================= --}}

    <section
        class="overflow-hidden rounded-2xl
               border border-slate-200
               bg-white"
        aria-labelledby="profileSectionTitle"
    >
        <div
            class="border-b border-slate-200
                   px-5 py-5 sm:px-6"
        >
            <h2
                id="profileSectionTitle"
                class="text-lg font-extrabold
                       text-slate-900"
            >
                Bagian Profil
            </h2>

            <p
                class="mt-1 text-sm text-slate-500"
            >
                Tekan tombol Kelola pada bagian yang ingin diubah.
            </p>
        </div>


        <div class="divide-y divide-slate-200">
            @forelse ($sections as $section)
                @php
                    $setting = $sectionSettings[
                        $section->slug
                    ] ?? [
                        'name' => $section->title,
                        'description' =>
                            'Kelola isi bagian Profil ini.',
                    ];

                    $itemCount = (int) (
                        $section->items_count ?? 0
                    );
                @endphp

                <article
                    class="grid gap-4 px-5 py-5
                           transition hover:bg-slate-50/70
                           sm:px-6
                           lg:grid-cols-[52px_1fr_auto]
                           lg:items-center"
                >
                    <span
                        class="flex h-11 w-11
                               items-center justify-center
                               rounded-xl bg-blue-50
                               text-sm font-extrabold
                               text-[#075F9B]"
                    >
                        {{ str_pad(
                            (string) $loop->iteration,
                            2,
                            '0',
                            STR_PAD_LEFT
                        ) }}
                    </span>


                    <div class="min-w-0">
                        <div
                            class="flex flex-wrap
                                   items-center gap-2"
                        >
                            <h3
                                class="font-extrabold
                                       text-slate-900"
                            >
                                {{ $setting['name'] }}
                            </h3>

                            <span
                                @class([
                                    'inline-flex rounded-full',
                                    'px-2.5 py-1 text-[10px]',
                                    'font-bold',
                                    'bg-emerald-50 text-emerald-700' =>
                                        $section->is_active,
                                    'bg-slate-100 text-slate-500' =>
                                        !$section->is_active,
                                ])
                            >
                                {{ $section->is_active
                                    ? 'Ditampilkan'
                                    : 'Disembunyikan' }}
                            </span>
                        </div>

                        <p
                            class="mt-1 text-sm
                                   leading-6 text-slate-500"
                        >
                            {{ $setting['description'] }}
                        </p>

                        <p
                            class="mt-2 text-xs
                                   font-semibold text-slate-400"
                        >
                            {{ $itemCount }} isi tersimpan
                        </p>
                    </div>


                    <a
                        href="{{ route(
                            'admin.profile-contents.edit',
                            $section
                        ) }}"
                        class="inline-flex w-full
                               items-center justify-center
                               gap-2 rounded-xl
                               bg-[#075F9B]
                               px-4 py-2.5
                               text-sm font-bold text-white
                               transition hover:bg-[#064B7B]
                               sm:w-auto"
                    >
                        <span>Kelola</span>

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
                    </a>
                </article>
            @empty
                <div class="px-6 py-12 text-center">
                    <p
                        class="text-sm font-bold
                               text-slate-700"
                    >
                        Bagian Profil belum tersedia
                    </p>

                    <p
                        class="mt-2 text-sm
                               text-slate-500"
                    >
                        Data bagian Profil akan tampil di sini.
                    </p>
                </div>
            @endforelse
        </div>
    </section>

</div>

@endsection