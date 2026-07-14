@extends('layouts.admin')

@section('title', 'Akreditasi')

@section('content')

@php
    /*
    |--------------------------------------------------------------------------
    | DATA AKREDITASI
    |--------------------------------------------------------------------------
    */

    $accreditationItems = collect(
        $accreditations ?? []
    );

    $totalAccreditations = $accreditationItems->count();

    $activeAccreditations = $accreditationItems
        ->filter(
            static fn ($item): bool =>
                (bool) $item->is_active
        )
        ->count();

    $nationalAccreditations = $accreditationItems
        ->where(
            'type',
            \App\Models\Accreditation::TYPE_NATIONAL
        )
        ->count();

    $internationalAccreditations = $accreditationItems
        ->where(
            'type',
            \App\Models\Accreditation::TYPE_INTERNATIONAL
        )
        ->count();


    /*
    |--------------------------------------------------------------------------
    | FORMAT TANGGAL INDONESIA
    |--------------------------------------------------------------------------
    */

    $indonesianMonths = [
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

    $formatIndonesianDate = static function (
        mixed $date
    ) use ($indonesianMonths): ?string {
        if ($date === null) {
            return null;
        }

        $monthNumber = (int) $date->format('m');

        return (int) $date->format('d')
            . ' '
            . ($indonesianMonths[$monthNumber] ?? '')
            . ' '
            . $date->format('Y');
    };

    $formatValidityPeriod = static function (
        mixed $validFrom,
        mixed $validUntil
    ) use ($formatIndonesianDate): string {
        $from = $formatIndonesianDate($validFrom);
        $until = $formatIndonesianDate($validUntil);

        if ($from !== null && $until !== null) {
            return $from . ' – ' . $until;
        }

        if ($from !== null) {
            return 'Berlaku mulai ' . $from;
        }

        if ($until !== null) {
            return 'Berlaku sampai ' . $until;
        }

        return 'Belum diisi';
    };
@endphp


<div class="space-y-8">

    {{-- ========================================================= --}}
    {{-- HEADER --}}
    {{-- ========================================================= --}}

    <section
        class="relative overflow-hidden
               rounded-[2rem]
               bg-gradient-to-br
               from-blue-700 via-blue-800
               to-slate-950 p-7
               shadow-xl sm:p-8"
    >
        <div
            class="pointer-events-none absolute
                   -right-24 -top-24
                   h-72 w-72 rounded-full
                   bg-yellow-300/20 blur-3xl"
            aria-hidden="true"
        ></div>

        <div
            class="pointer-events-none absolute
                   -bottom-24 -left-24
                   h-72 w-72 rounded-full
                   bg-white/10 blur-3xl"
            aria-hidden="true"
        ></div>

        <div
            class="relative z-10 flex
                   flex-col gap-6
                   lg:flex-row lg:items-center
                   lg:justify-between"
        >
            <div>
                <span
                    class="inline-flex rounded-full
                           border border-white/20
                           bg-white/10 px-4 py-2
                           text-xs font-bold uppercase
                           tracking-widest text-white/90"
                >
                    Admin Panel
                </span>

                <h1
                    class="mt-5 text-3xl font-black
                           text-white md:text-4xl"
                >
                    Akreditasi Program Studi
                </h1>

                <p
                    class="mt-3 max-w-3xl
                           leading-7 text-white/75"
                >
                    Kelola informasi akreditasi nasional maupun
                    internasional beserta lembaga, peringkat, masa
                    berlaku, nomor sertifikat, dan dokumen pendukung.
                </p>
            </div>

            <a
                href="{{ route(
                    'admin.accreditations.create'
                ) }}"
                class="inline-flex items-center
                       justify-center rounded-2xl
                       bg-yellow-400 px-6 py-4
                       font-black text-slate-900
                       shadow-lg shadow-yellow-400/20
                       transition hover:bg-yellow-300"
            >
                Tambah Akreditasi
            </a>
        </div>
    </section>


    {{-- ========================================================= --}}
    {{-- ALERT --}}
    {{-- ========================================================= --}}

    @if (session('success'))
        <div
            class="rounded-2xl border
                   border-emerald-200
                   bg-emerald-50 px-6 py-4
                   font-semibold text-emerald-700"
            role="alert"
        >
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div
            class="rounded-2xl border
                   border-red-200 bg-red-50
                   px-6 py-4 font-semibold
                   text-red-700"
            role="alert"
        >
            {{ session('error') }}
        </div>
    @endif


    {{-- ========================================================= --}}
    {{-- RINGKASAN --}}
    {{-- ========================================================= --}}

    <section class="grid gap-5 sm:grid-cols-2 xl:grid-cols-4">

        <div
            class="rounded-3xl border
                   border-slate-100 bg-white
                   p-6 shadow-lg"
        >
            <p
                class="text-xs font-bold uppercase
                       tracking-wider text-slate-500"
            >
                Total Data
            </p>

            <p
                class="mt-3 text-4xl font-black
                       text-blue-700"
            >
                {{ $totalAccreditations }}
            </p>
        </div>


        <div
            class="rounded-3xl border
                   border-slate-100 bg-white
                   p-6 shadow-lg"
        >
            <p
                class="text-xs font-bold uppercase
                       tracking-wider text-slate-500"
            >
                Dipublikasikan
            </p>

            <p
                class="mt-3 text-4xl font-black
                       text-emerald-600"
            >
                {{ $activeAccreditations }}
            </p>
        </div>


        <div
            class="rounded-3xl border
                   border-slate-100 bg-white
                   p-6 shadow-lg"
        >
            <p
                class="text-xs font-bold uppercase
                       tracking-wider text-slate-500"
            >
                Nasional
            </p>

            <p
                class="mt-3 text-4xl font-black
                       text-blue-700"
            >
                {{ $nationalAccreditations }}
            </p>
        </div>


        <div
            class="rounded-3xl border
                   border-slate-100 bg-white
                   p-6 shadow-lg"
        >
            <p
                class="text-xs font-bold uppercase
                       tracking-wider text-slate-500"
            >
                Internasional
            </p>

            <p
                class="mt-3 text-4xl font-black
                       text-yellow-600"
            >
                {{ $internationalAccreditations }}
            </p>
        </div>

    </section>


    {{-- ========================================================= --}}
    {{-- DAFTAR AKREDITASI --}}
    {{-- ========================================================= --}}

    @if ($accreditationItems->isNotEmpty())

        <section class="grid gap-6 xl:grid-cols-2">

            @foreach ($accreditationItems as $accreditation)

                @php
                    $filePath = trim(
                        (string) $accreditation->file_path
                    );

                    $fileExists = $filePath !== ''
                        && \Illuminate\Support\Facades\Storage::disk(
                            'public'
                        )->exists($filePath);

                    $fileUrl = $fileExists
                        ? asset('storage/' . $filePath)
                        : null;

                    $extension = $filePath !== ''
                        ? strtolower(
                            pathinfo(
                                $filePath,
                                PATHINFO_EXTENSION
                            )
                        )
                        : null;

                    $isImage = $fileExists
                        && in_array(
                            $extension,
                            [
                                'jpg',
                                'jpeg',
                                'png',
                                'webp',
                            ],
                            true
                        );

                    $isPdf = $fileExists
                        && $extension === 'pdf';

                    $isInternational =
                        $accreditation->type ===
                        \App\Models\Accreditation::TYPE_INTERNATIONAL;

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

                    $description = trim(
                        (string) $accreditation->description
                    );

                    $validityPeriod =
                        $formatValidityPeriod(
                            $accreditation->valid_from,
                            $accreditation->valid_until
                        );
                @endphp


                <article
                    class="overflow-hidden rounded-[2rem]
                           border border-slate-100
                           bg-white shadow-sm
                           transition hover:shadow-xl"
                >
                    <div
                        @class([
                            'h-2 bg-gradient-to-r',
                            'from-yellow-400 via-blue-600 to-yellow-400' =>
                                $isInternational,
                            'from-blue-700 via-yellow-400 to-blue-700' =>
                                !$isInternational,
                        ])
                    ></div>


                    <div class="p-5 md:p-6">

                        <div class="grid gap-6 md:grid-cols-12">

                            {{-- ================================= --}}
                            {{-- PREVIEW FILE --}}
                            {{-- ================================= --}}

                            <div class="md:col-span-4">

                                <div
                                    class="overflow-hidden
                                           rounded-2xl border
                                           border-slate-100
                                           bg-slate-50"
                                >
                                    @if ($isImage)
                                        <a
                                            href="{{ $fileUrl }}"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="block"
                                        >
                                            <img
                                                src="{{ $fileUrl }}"
                                                alt="Dokumen {{ $title }}"
                                                class="h-56 w-full
                                                       bg-white p-3
                                                       object-contain
                                                       md:h-48"
                                                loading="lazy"
                                            >
                                        </a>

                                    @elseif ($isPdf)
                                        <div
                                            class="flex h-56
                                                   flex-col items-center
                                                   justify-center
                                                   bg-white p-5
                                                   text-center md:h-48"
                                        >
                                            <div
                                                class="flex h-16 w-16
                                                       items-center
                                                       justify-center
                                                       rounded-2xl
                                                       bg-red-100
                                                       font-black
                                                       text-red-600"
                                            >
                                                PDF
                                            </div>

                                            <p
                                                class="mt-4 text-sm
                                                       font-bold
                                                       text-slate-800"
                                            >
                                                Dokumen PDF
                                            </p>

                                            <a
                                                href="{{ $fileUrl }}"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="mt-2 text-xs
                                                       font-bold
                                                       text-blue-700
                                                       hover:underline"
                                            >
                                                Buka Dokumen
                                            </a>
                                        </div>

                                    @elseif ($filePath !== '' && !$fileExists)
                                        <div
                                            class="flex h-56
                                                   flex-col items-center
                                                   justify-center
                                                   bg-white p-5
                                                   text-center md:h-48"
                                        >
                                            <div
                                                class="flex h-16 w-16
                                                       items-center
                                                       justify-center
                                                       rounded-2xl
                                                       bg-red-100
                                                       font-black
                                                       text-red-700"
                                            >
                                                !
                                            </div>

                                            <p
                                                class="mt-4 text-sm
                                                       font-bold
                                                       text-red-700"
                                            >
                                                File Tidak Ditemukan
                                            </p>

                                            <p
                                                class="mt-2 break-all
                                                       text-xs
                                                       text-slate-500"
                                            >
                                                {{ $filePath }}
                                            </p>
                                        </div>

                                    @else
                                        <div
                                            class="flex h-56
                                                   flex-col items-center
                                                   justify-center
                                                   bg-white p-5
                                                   text-center md:h-48"
                                        >
                                            <div
                                                class="flex h-16 w-16
                                                       items-center
                                                       justify-center
                                                       rounded-2xl
                                                       bg-slate-100
                                                       font-black
                                                       text-slate-400"
                                            >
                                                A
                                            </div>

                                            <p
                                                class="mt-4 text-sm
                                                       font-bold
                                                       text-slate-700"
                                            >
                                                Belum Ada Dokumen
                                            </p>
                                        </div>
                                    @endif
                                </div>
                            </div>


                            {{-- ================================= --}}
                            {{-- DETAIL --}}
                            {{-- ================================= --}}

                            <div class="md:col-span-8">

                                <div
                                    class="flex flex-wrap
                                           items-center gap-2"
                                >
                                    <span
                                        @class([
                                            'inline-flex rounded-full',
                                            'px-3 py-1.5 text-xs',
                                            'font-black',
                                            'bg-yellow-100 text-yellow-700' =>
                                                $isInternational,
                                            'bg-blue-100 text-blue-700' =>
                                                !$isInternational,
                                        ])
                                    >
                                        {{ $accreditation->type_label }}
                                    </span>


                                    @if ($accreditation->is_active)
                                        <span
                                            class="inline-flex
                                                   rounded-full
                                                   bg-emerald-100
                                                   px-3 py-1.5
                                                   text-xs font-black
                                                   text-emerald-700"
                                        >
                                            Dipublikasikan
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex
                                                   rounded-full
                                                   bg-slate-100
                                                   px-3 py-1.5
                                                   text-xs font-black
                                                   text-slate-500"
                                        >
                                            Nonaktif
                                        </span>
                                    @endif


                                    @if ($rank !== '')
                                        <span
                                            class="inline-flex
                                                   rounded-full
                                                   bg-slate-100
                                                   px-3 py-1.5
                                                   text-xs font-black
                                                   text-slate-700"
                                        >
                                            {{ $rank }}
                                        </span>
                                    @endif
                                </div>


                                <h2
                                    class="mt-4 text-2xl
                                           font-black leading-snug
                                           text-slate-800"
                                >
                                    {{ $title !== ''
                                        ? $title
                                        : 'Akreditasi Program Studi' }}
                                </h2>


                                @if ($institution !== '')
                                    <p
                                        class="mt-2 text-sm
                                               font-bold text-blue-700"
                                    >
                                        {{ $institution }}
                                    </p>
                                @endif


                                @if ($description !== '')
                                    <p
                                        class="mt-4 text-sm
                                               leading-7
                                               text-slate-500"
                                    >
                                        {{ \Illuminate\Support\Str::limit(
                                            $description,
                                            170
                                        ) }}
                                    </p>
                                @endif


                                {{-- ============================= --}}
                                {{-- INFORMASI --}}
                                {{-- ============================= --}}

                                <div
                                    class="mt-5 grid gap-3
                                           sm:grid-cols-2"
                                >
                                    <div
                                        class="rounded-2xl border
                                               border-slate-100
                                               bg-slate-50 p-4"
                                    >
                                        <p class="text-xs text-slate-500">
                                            Nomor Sertifikat / SK
                                        </p>

                                        <p
                                            class="mt-1 break-words
                                                   text-sm font-bold
                                                   text-slate-800"
                                        >
                                            {{ $certificateNumber !== ''
                                                ? $certificateNumber
                                                : 'Belum diisi' }}
                                        </p>
                                    </div>


                                    <div
                                        class="rounded-2xl border
                                               border-slate-100
                                               bg-slate-50 p-4"
                                    >
                                        <p class="text-xs text-slate-500">
                                            Urutan Tampil
                                        </p>

                                        <p
                                            class="mt-1 text-sm
                                                   font-bold
                                                   text-slate-800"
                                        >
                                            {{ (int) $accreditation
                                                ->sort_order }}
                                        </p>
                                    </div>


                                    <div
                                        class="rounded-2xl border
                                               border-slate-100
                                               bg-slate-50 p-4
                                               sm:col-span-2"
                                    >
                                        <p class="text-xs text-slate-500">
                                            Masa Berlaku
                                        </p>

                                        <p
                                            class="mt-1 text-sm
                                                   font-bold
                                                   text-slate-800"
                                        >
                                            {{ $validityPeriod }}
                                        </p>
                                    </div>
                                </div>


                                {{-- ============================= --}}
                                {{-- AKSI --}}
                                {{-- ============================= --}}

                                <div
                                    class="mt-6 flex flex-col
                                           gap-3 sm:flex-row
                                           sm:items-center
                                           sm:justify-between"
                                >
                                    <div class="flex flex-wrap gap-2">

                                        @if ($fileUrl !== null)
                                            <a
                                                href="{{ $fileUrl }}"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="inline-flex
                                                       items-center
                                                       justify-center
                                                       rounded-xl
                                                       bg-slate-100
                                                       px-4 py-2
                                                       text-xs font-black
                                                       text-slate-700
                                                       transition
                                                       hover:bg-slate-200"
                                            >
                                                Lihat Dokumen
                                            </a>
                                        @endif

                                        <a
                                            href="{{ route(
                                                'admin.accreditations.edit',
                                                $accreditation
                                            ) }}"
                                            class="inline-flex
                                                   items-center
                                                   justify-center
                                                   rounded-xl
                                                   bg-yellow-100
                                                   px-4 py-2
                                                   text-xs font-black
                                                   text-yellow-700
                                                   transition
                                                   hover:bg-yellow-200"
                                        >
                                            Edit
                                        </a>
                                    </div>


                                    <form
                                        action="{{ route(
                                            'admin.accreditations.destroy',
                                            $accreditation
                                        ) }}"
                                        method="POST"
                                        onsubmit="return confirm(
                                            'Yakin ingin menghapus data akreditasi ini? Dokumen yang tersimpan juga akan dihapus.'
                                        )"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="inline-flex w-full
                                                   items-center
                                                   justify-center
                                                   rounded-xl
                                                   bg-red-100
                                                   px-4 py-2
                                                   text-xs font-black
                                                   text-red-700
                                                   transition
                                                   hover:bg-red-600
                                                   hover:text-white
                                                   sm:w-auto"
                                        >
                                            Hapus
                                        </button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </article>

            @endforeach
        </section>

    @else

        {{-- ===================================================== --}}
        {{-- EMPTY STATE --}}
        {{-- ===================================================== --}}

        <section
            class="rounded-[2rem] border
                   border-slate-100 bg-white
                   p-8 text-center shadow-sm
                   sm:p-10"
        >
            <div
                class="mx-auto flex h-20 w-20
                       items-center justify-center
                       rounded-3xl bg-blue-50
                       text-3xl font-black
                       text-blue-700"
            >
                A
            </div>

            <h2
                class="mt-6 text-2xl font-black
                       text-slate-800"
            >
                Belum Ada Data Akreditasi
            </h2>

            <p
                class="mx-auto mt-3 max-w-xl
                       leading-7 text-slate-500"
            >
                Tambahkan informasi akreditasi setelah tersedia
                data dan dokumen resmi yang dapat dipertanggungjawabkan.
            </p>

            <a
                href="{{ route(
                    'admin.accreditations.create'
                ) }}"
                class="mt-6 inline-flex
                       items-center justify-center
                       rounded-2xl bg-blue-700
                       px-6 py-4 font-black
                       text-white transition
                       hover:bg-blue-800"
            >
                Tambah Akreditasi
            </a>
        </section>

    @endif
</div>

@endsection