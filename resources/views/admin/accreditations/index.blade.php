@extends('layouts.admin')

@section('title', 'Akreditasi')

@section('content')

@php
    $items = collect($accreditations ?? []);

    $totalItems = $items->count();

    $shownItems = $items
        ->filter(
            fn ($item) => (bool) $item->is_active
        )
        ->count();

    $hiddenItems = $totalItems - $shownItems;

    $months = [
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember',
    ];

    $formatDate = static function (
        mixed $date
    ) use ($months): ?string {
        if ($date === null) {
            return null;
        }

        $month = (int) $date->format('m');

        return (int) $date->format('d')
            . ' '
            . ($months[$month] ?? '')
            . ' '
            . $date->format('Y');
    };

    $formatValidity = static function (
        mixed $validFrom,
        mixed $validUntil
    ) use ($formatDate): string {
        $from = $formatDate($validFrom);
        $until = $formatDate($validUntil);

        if ($from && $until) {
            return $from . ' sampai ' . $until;
        }

        if ($from) {
            return 'Mulai ' . $from;
        }

        if ($until) {
            return 'Sampai ' . $until;
        }

        return 'Belum diisi';
    };
@endphp


<div class="mx-auto max-w-7xl space-y-6">

    {{-- ========================================================= --}}
    {{-- HEADER --}}
    {{-- ========================================================= --}}

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
                    Pengaturan Profil
                </p>
            </div>

            <h1
                class="mt-3 text-2xl font-extrabold
                       tracking-tight text-slate-900
                       sm:text-3xl"
            >
                Akreditasi
            </h1>

            <p
                class="mt-2 max-w-3xl
                       text-sm leading-7
                       text-slate-500"
            >
                Kelola informasi dan dokumen akreditasi
                Program Studi D-IV TMPP.
            </p>
        </div>


        <div
            class="flex flex-col gap-3
                   sm:flex-row"
        >
            <a
                href="{{ route('profile') }}"
                target="_blank"
                rel="noopener noreferrer"
                class="inline-flex items-center
                       justify-center rounded-xl
                       border border-slate-200
                       bg-white px-4 py-2.5
                       text-sm font-bold
                       text-slate-700
                       transition
                       hover:border-blue-200
                       hover:text-[#075F9B]"
            >
                Lihat Halaman Profil
            </a>

            <a
                href="{{ route(
                    'admin.accreditations.create'
                ) }}"
                class="inline-flex items-center
                       justify-center gap-2
                       rounded-xl bg-[#075F9B]
                       px-4 py-2.5
                       text-sm font-bold text-white
                       transition hover:bg-[#064B7B]"
            >
                <span aria-hidden="true">+</span>
                Tambah Akreditasi
            </a>
        </div>
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


    {{-- ========================================================= --}}
    {{-- RINGKASAN RINGAN --}}
    {{-- ========================================================= --}}

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
                Ringkasan Data
            </h2>

            <p
                class="mt-1 text-xs
                       leading-5 text-slate-500"
            >
                Data yang belum memiliki sumber resmi dapat
                dilengkapi kemudian.
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
                    {{ $totalItems }}
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
                    {{ $shownItems }}
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
                    {{ $hiddenItems }}
                </p>

                <p class="mt-1 text-[10px] text-slate-500">
                    Disembunyikan
                </p>
            </div>
        </div>
    </section>


    {{-- ========================================================= --}}
    {{-- DAFTAR DATA --}}
    {{-- ========================================================= --}}

    <section
        class="overflow-hidden rounded-2xl
               border border-slate-200
               bg-white"
        aria-labelledby="accreditationListTitle"
    >
        <div
            class="border-b border-slate-200
                   px-5 py-5 sm:px-6"
        >
            <h2
                id="accreditationListTitle"
                class="text-lg font-extrabold
                       text-slate-900"
            >
                Daftar Akreditasi
            </h2>

            <p
                class="mt-1 text-sm text-slate-500"
            >
                Tekan Ubah untuk memperbarui satu data akreditasi.
            </p>
        </div>


        <div class="divide-y divide-slate-200">
            @forelse ($items as $accreditation)
                @php
                    $title = trim(
                        (string) $accreditation->title
                    );

                    $institution = trim(
                        (string) $accreditation->institution
                    );

                    $rank = trim(
                        (string) $accreditation->rank
                    );

                    $certificateNumber = trim(
                        (string) $accreditation
                            ->certificate_number
                    );

                    $filePath = trim(
                        (string) $accreditation->file_path
                    );

                    $fileExists = $filePath !== ''
                        && \Illuminate\Support\Facades\Storage::disk(
                            'public'
                        )->exists($filePath);

                    $fileUrl = $fileExists
                        ? asset(
                            'storage/'
                            . ltrim($filePath, '/')
                        )
                        : null;

                    $validity = $formatValidity(
                        $accreditation->valid_from,
                        $accreditation->valid_until
                    );
                @endphp

                <article
                    class="grid gap-5 px-5 py-5
                           transition hover:bg-slate-50/60
                           sm:px-6
                           xl:grid-cols-[1fr_220px_220px_auto]
                           xl:items-center"
                >
                    <div class="min-w-0">
                        <div
                            class="flex flex-wrap
                                   items-center gap-2"
                        >
                            <span
                                class="inline-flex rounded-full
                                       bg-blue-50 px-2.5 py-1
                                       text-[10px] font-bold
                                       text-[#075F9B]"
                            >
                                {{ $accreditation->type_label }}
                            </span>

                            <span
                                @class([
                                    'inline-flex rounded-full',
                                    'px-2.5 py-1 text-[10px]',
                                    'font-bold',
                                    'bg-emerald-50 text-emerald-700' =>
                                        $accreditation->is_active,
                                    'bg-slate-100 text-slate-500' =>
                                        !$accreditation->is_active,
                                ])
                            >
                                {{ $accreditation->is_active
                                    ? 'Ditampilkan'
                                    : 'Disembunyikan' }}
                            </span>
                        </div>

                        <h3
                            class="mt-3 text-base
                                   font-extrabold
                                   text-slate-900"
                        >
                            {{ $title !== ''
                                ? $title
                                : 'Akreditasi Program Studi' }}
                        </h3>

                        <p
                            class="mt-1 text-sm
                                   leading-6 text-slate-500"
                        >
                            {{ $institution !== ''
                                ? $institution
                                : 'Lembaga belum diisi' }}

                            @if ($rank !== '')
                                <span aria-hidden="true">•</span>
                                Peringkat {{ $rank }}
                            @endif
                        </p>
                    </div>


                    <div>
                        <p
                            class="text-[10px] font-bold
                                   uppercase tracking-[0.12em]
                                   text-slate-400"
                        >
                            Masa Berlaku
                        </p>

                        <p
                            class="mt-1 text-sm
                                   font-semibold
                                   leading-6 text-slate-700"
                        >
                            {{ $validity }}
                        </p>
                    </div>


                    <div>
                        <p
                            class="text-[10px] font-bold
                                   uppercase tracking-[0.12em]
                                   text-slate-400"
                        >
                            Dokumen
                        </p>

                        @if ($fileUrl)
                            <a
                                href="{{ $fileUrl }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="mt-1 inline-flex
                                       text-sm font-bold
                                       text-[#075F9B]
                                       hover:underline"
                            >
                                Buka Dokumen
                            </a>
                        @else
                            <p
                                class="mt-1 text-sm
                                       text-slate-500"
                            >
                                Belum diunggah
                            </p>
                        @endif

                        @if ($certificateNumber !== '')
                            <p
                                class="mt-1 truncate
                                       text-xs text-slate-400"
                            >
                                {{ $certificateNumber }}
                            </p>
                        @endif
                    </div>


                    <div
                        class="flex flex-col gap-2
                               sm:flex-row xl:justify-end"
                    >
                        <a
                            href="{{ route(
                                'admin.accreditations.edit',
                                $accreditation
                            ) }}"
                            class="inline-flex items-center
                                   justify-center rounded-xl
                                   bg-[#075F9B]
                                   px-4 py-2.5
                                   text-sm font-bold
                                   text-white transition
                                   hover:bg-[#064B7B]"
                        >
                            Ubah
                        </a>

                        <form
                            action="{{ route(
                                'admin.accreditations.destroy',
                                $accreditation
                            ) }}"
                            method="POST"
                            onsubmit="return confirm(
                                'Hapus data akreditasi ini?'
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
                                       transition hover:bg-red-100"
                            >
                                Hapus
                            </button>
                        </form>
                    </div>
                </article>
            @empty
                <div class="px-6 py-14 text-center">
                    <div
                        class="mx-auto flex h-12 w-12
                               items-center justify-center
                               rounded-xl bg-blue-50
                               text-[#075F9B]"
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

                    <h3
                        class="mt-4 text-base
                               font-extrabold
                               text-slate-800"
                    >
                        Data akreditasi belum tersedia
                    </h3>

                    <p
                        class="mx-auto mt-2 max-w-md
                               text-sm leading-6
                               text-slate-500"
                    >
                        Tambahkan data setelah informasi resmi
                        tersedia.
                    </p>

                    <a
                        href="{{ route(
                            'admin.accreditations.create'
                        ) }}"
                        class="mt-5 inline-flex
                               items-center justify-center
                               rounded-xl bg-[#075F9B]
                               px-5 py-2.5
                               text-sm font-bold
                               text-white hover:bg-[#064B7B]"
                    >
                        Tambah Akreditasi
                    </a>
                </div>
            @endforelse
        </div>
    </section>

</div>

@endsection
