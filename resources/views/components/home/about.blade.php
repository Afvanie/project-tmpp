@php
    /*
    |--------------------------------------------------------------------------
    | DESKRIPSI PROGRAM STUDI
    |--------------------------------------------------------------------------
    */

    $programDescription = $homeContent ?? null;

    $descriptionImagePath = trim(
        (string) ($programDescription?->image ?? '')
    );

    $descriptionImageExists = $descriptionImagePath !== ''
        && \Illuminate\Support\Facades\Storage::disk('public')
            ->exists($descriptionImagePath);

    $fallbackImagePath = 'assets/images/about.png';

    $fallbackImageExists = file_exists(
        public_path($fallbackImagePath)
    );

    $descriptionImageUrl = match (true) {
        $descriptionImageExists =>
            asset('storage/' . $descriptionImagePath),

        $fallbackImageExists =>
            asset($fallbackImagePath),

        default => null,
    };


    /*
    |--------------------------------------------------------------------------
    | TOMBOL DESKRIPSI
    |--------------------------------------------------------------------------
    */

    $descriptionButtonText = trim(
        (string) ($programDescription?->button_text ?? '')
    );

    $descriptionButtonUrl = trim(
        (string) ($programDescription?->button_url ?? '')
    );

    $descriptionButtonIsExternal = preg_match(
        '/^https?:\/\//i',
        $descriptionButtonUrl
    ) === 1;

    $descriptionButtonHref = $descriptionButtonUrl !== ''
        ? (
            $descriptionButtonIsExternal
                ? $descriptionButtonUrl
                : url($descriptionButtonUrl)
        )
        : null;


    /*
    |--------------------------------------------------------------------------
    | DATA AKREDITASI
    |--------------------------------------------------------------------------
    */

    $accreditationItems = collect(
        $accreditations ?? []
    );

    $nationalAccreditations = $accreditationItems
        ->where(
            'type',
            \App\Models\Accreditation::TYPE_NATIONAL
        )
        ->values();

    $internationalAccreditations = $accreditationItems
        ->where(
            'type',
            \App\Models\Accreditation::TYPE_INTERNATIONAL
        )
        ->values();

    $accreditationGroups = collect([
        \App\Models\Accreditation::TYPE_NATIONAL => [
            'label' => 'Akreditasi Nasional',
            'short_label' => 'Nasional',
            'description' =>
                'Pengakuan mutu program studi oleh lembaga akreditasi nasional.',
            'items' => $nationalAccreditations,
            'icon' => 'fa-building-columns',
        ],

        \App\Models\Accreditation::TYPE_INTERNATIONAL => [
            'label' => 'Akreditasi Internasional',
            'short_label' => 'Internasional',
            'description' =>
                'Pengakuan mutu program studi pada tingkat internasional.',
            'items' => $internationalAccreditations,
            'icon' => 'fa-earth-asia',
        ],
    ])->filter(
        static fn (array $group): bool =>
            $group['items']->isNotEmpty()
    );

    $defaultAccreditationType = $accreditationGroups
        ->keys()
        ->first();


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
    ) use ($formatIndonesianDate): ?string {
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

        return null;
    };


    /*
    |--------------------------------------------------------------------------
    | FILE AKREDITASI
    |--------------------------------------------------------------------------
    */

    $getAccreditationFile = static function (
        mixed $accreditation
    ): array {
        $filePath = trim(
            (string) ($accreditation?->file_path ?? '')
        );

        if ($filePath === '') {
            return [
                'path' => null,
                'url' => null,
                'exists' => false,
                'is_image' => false,
                'is_pdf' => false,
            ];
        }

        $fileExists = \Illuminate\Support\Facades\Storage::disk(
            'public'
        )->exists($filePath);

        $extension = strtolower(
            pathinfo(
                $filePath,
                PATHINFO_EXTENSION
            )
        );

        return [
            'path' => $filePath,

            'url' => $fileExists
                ? asset('storage/' . $filePath)
                : null,

            'exists' => $fileExists,

            'is_image' => $fileExists
                && in_array(
                    $extension,
                    [
                        'jpg',
                        'jpeg',
                        'png',
                        'webp',
                    ],
                    true
                ),

            'is_pdf' => $fileExists
                && $extension === 'pdf',
        ];
    };
@endphp


@once
    <style>
        .accreditation-tab-button {
            color: #475569;
            background: #ffffff;
            border-color: #e2e8f0;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.05);
        }

        .accreditation-tab-button:hover {
            color: #075f9b;
            border-color: rgba(7, 95, 155, 0.25);
            background: #eff6ff;
        }

        .accreditation-tab-button.is-active {
            color: #ffffff;
            border-color: transparent;
            background:
                linear-gradient(
                    135deg,
                    #073763 0%,
                    #075f9b 100%
                );
            box-shadow:
                0 14px 30px
                rgba(7, 95, 155, 0.22);
        }

        .accreditation-tab-button.is-active
        .accreditation-tab-icon {
            color: #073763;
            background: #f4d66e;
        }
    </style>
@endonce


{{-- ============================================================= --}}
{{-- DESKRIPSI PROGRAM STUDI --}}
{{-- ============================================================= --}}

<section
    id="program-description"
    class="relative overflow-hidden
           bg-[#F5F8FB] py-20
           md:py-28"
>
    {{-- ========================================================= --}}
    {{-- LATAR DEKORATIF --}}
    {{-- ========================================================= --}}

    <div
        class="pointer-events-none absolute inset-0"
        aria-hidden="true"
    >
        <div
            class="absolute -left-40 top-0
                   h-[500px] w-[500px]
                   rounded-full bg-blue-200/30
                   blur-[140px]"
        ></div>

        <div
            class="absolute -right-40 bottom-0
                   h-[500px] w-[500px]
                   rounded-full bg-yellow-200/25
                   blur-[140px]"
        ></div>

        <div
            class="absolute inset-y-0 right-0
                   hidden w-[35%]
                   bg-gradient-to-l
                   from-blue-50/80
                   to-transparent
                   lg:block"
        ></div>

        <div
            class="absolute right-6 top-20
                   hidden select-none
                   text-[150px] font-black
                   leading-none text-slate-900/[0.025]
                   xl:block"
        >
            TMPP
        </div>
    </div>


    <div
        class="relative mx-auto
               max-w-7xl px-6"
    >
        <div
            class="grid items-center
                   gap-14 lg:grid-cols-12
                   lg:gap-16"
        >
            {{-- ================================================= --}}
            {{-- GAMBAR PROGRAM STUDI --}}
            {{-- ================================================= --}}

            <div
                class="relative lg:col-span-6"
                data-aos="fade-right"
            >
                <div
                    class="absolute -left-5 -top-5
                           hidden h-28 w-28
                           rounded-3xl border-2
                           border-[#D7B33E]/40
                           lg:block"
                    aria-hidden="true"
                ></div>

                <div
                    class="absolute -bottom-6 -right-6
                           hidden h-36 w-36
                           rounded-full bg-blue-200/50
                           blur-3xl lg:block"
                    aria-hidden="true"
                ></div>

                <div
                    class="relative overflow-hidden
                           rounded-[2rem]
                           bg-white p-3
                           shadow-[0_30px_80px_rgba(15,23,42,0.16)]"
                >
                    @if ($descriptionImageUrl !== null)
                        <div
                            class="relative overflow-hidden
                                   rounded-[1.5rem]"
                        >
                            <img
                                src="{{ $descriptionImageUrl }}"
                                alt="Program Studi D-IV Teknik Mesin Produksi dan Perawatan"
                                class="h-[340px] w-full
                                       object-cover transition
                                       duration-700
                                       hover:scale-105
                                       sm:h-[430px]
                                       lg:h-[520px]"
                                loading="lazy"
                            >

                            <div
                                class="absolute inset-0
                                       bg-gradient-to-t
                                       from-[#052844]/65
                                       via-transparent
                                       to-transparent"
                            ></div>

                            <div
                                class="absolute bottom-0
                                       left-0 right-0
                                       p-6 sm:p-8"
                            >
                                <p
                                    class="text-xs font-bold
                                           uppercase
                                           tracking-[0.2em]
                                           text-[#F4D66E]"
                                >
                                    Teknik Mesin Polinema
                                </p>

                                <h3
                                    class="mt-2 max-w-md
                                           text-xl font-bold
                                           leading-tight
                                           text-white
                                           sm:text-2xl"
                                >
                                    Pendidikan vokasi yang
                                    dekat dengan kebutuhan
                                    dunia industri
                                </h3>
                            </div>
                        </div>
                    @else
                        <div
                            class="flex h-[340px]
                                   items-center justify-center
                                   rounded-[1.5rem]
                                   bg-gradient-to-br
                                   from-[#073763]
                                   to-[#075F9B]
                                   px-8 text-center
                                   sm:h-[430px]
                                   lg:h-[520px]"
                        >
                            <div>
                                <div
                                    class="mx-auto flex
                                           h-24 w-24
                                           items-center
                                           justify-center
                                           rounded-3xl
                                           bg-white
                                           text-2xl
                                           font-black
                                           text-[#073763]
                                           shadow-xl"
                                >
                                    TM
                                </div>

                                <p
                                    class="mt-6 text-xl
                                           font-bold
                                           leading-8 text-white"
                                >
                                    D-IV Teknik Mesin Produksi
                                    dan Perawatan
                                </p>
                            </div>
                        </div>
                    @endif
                </div>


            
            </div>


            {{-- ================================================= --}}
            {{-- INFORMASI PROGRAM STUDI --}}
            {{-- ================================================= --}}

            <div
                class="lg:col-span-6"
                data-aos="fade-left"
            >
                <div
                    class="flex items-center gap-3"
                >
                    <span
                        class="h-px w-10
                               bg-[#D7B33E]"
                        aria-hidden="true"
                    ></span>

                    <p
                        class="text-xs font-bold
                               uppercase
                               tracking-[0.22em]
                               text-[#075F9B]"
                    >
                        {{ trim(
                            (string) (
                                $programDescription?->badge
                                ?? ''
                            )
                        ) !== ''
                            ? $programDescription->badge
                            : 'Tentang Program Studi' }}
                    </p>
                </div>


                <h2
                    class="mt-5 text-3xl
                           font-extrabold
                           leading-tight
                           tracking-tight
                           text-slate-900
                           sm:text-4xl
                           lg:text-5xl"
                >
                    {{ trim(
                        (string) (
                            $programDescription?->title
                            ?? ''
                        )
                    ) !== ''
                        ? $programDescription->title
                        : 'D-IV Teknik Mesin Produksi dan Perawatan' }}
                </h2>


                <div
                    class="mt-6 flex items-center
                           gap-3"
                    aria-hidden="true"
                >
                    <span
                        class="h-1 w-16
                               rounded-full
                               bg-[#075F9B]"
                    ></span>

                    <span
                        class="h-1 w-8
                               rounded-full
                               bg-[#D7B33E]"
                    ></span>
                </div>


                <p
                    class="mt-7 text-justify
                           text-base leading-8
                           text-slate-600
                           sm:text-lg
                           sm:leading-9"
                >
                    {{ trim(
                        (string) (
                            $programDescription?->description
                            ?? ''
                        )
                    ) !== ''
                        ? $programDescription->description
                        : 'Deskripsi Program Studi D-IV Teknik Mesin Produksi dan Perawatan belum tersedia.' }}
                </p>


                {{-- Fokus Program --}}
                <div
                    class="mt-8 grid gap-4
                           sm:grid-cols-3"
                >
                    <article
                        class="group rounded-2xl
                               border border-slate-200
                               bg-white p-5
                               shadow-sm transition
                               duration-300
                               hover:-translate-y-1
                               hover:border-blue-200
                               hover:shadow-lg"
                    >
                        <span
                            class="flex h-11 w-11
                                   items-center
                                   justify-center
                                   rounded-xl
                                   bg-blue-50
                                   text-[#075F9B]
                                   transition
                                   group-hover:bg-[#075F9B]
                                   group-hover:text-white"
                        >
                            <i
                                class="fa-solid
                                       fa-industry"
                                aria-hidden="true"
                            ></i>
                        </span>

                        <h3
                            class="mt-4 text-sm
                                   font-bold
                                   text-slate-800"
                        >
                            Produksi
                        </h3>

                        <p
                            class="mt-2 text-xs
                                   leading-5
                                   text-slate-500"
                        >
                            Teknologi produksi dan manufaktur.
                        </p>
                    </article>


                    <article
                        class="group rounded-2xl
                               border border-slate-200
                               bg-white p-5
                               shadow-sm transition
                               duration-300
                               hover:-translate-y-1
                               hover:border-blue-200
                               hover:shadow-lg"
                    >
                        <span
                            class="flex h-11 w-11
                                   items-center
                                   justify-center
                                   rounded-xl
                                   bg-blue-50
                                   text-[#075F9B]
                                   transition
                                   group-hover:bg-[#075F9B]
                                   group-hover:text-white"
                        >
                            <i
                                class="fa-solid
                                       fa-gears"
                                aria-hidden="true"
                            ></i>
                        </span>

                        <h3
                            class="mt-4 text-sm
                                   font-bold
                                   text-slate-800"
                        >
                            Perawatan
                        </h3>

                        <p
                            class="mt-2 text-xs
                                   leading-5
                                   text-slate-500"
                        >
                            Sistem dan manajemen perawatan mesin.
                        </p>
                    </article>


                    <article
                        class="group rounded-2xl
                               border border-slate-200
                               bg-white p-5
                               shadow-sm transition
                               duration-300
                               hover:-translate-y-1
                               hover:border-yellow-200
                               hover:shadow-lg"
                    >
                        <span
                            class="flex h-11 w-11
                                   items-center
                                   justify-center
                                   rounded-xl
                                   bg-yellow-50
                                   text-yellow-700
                                   transition
                                   group-hover:bg-[#D7B33E]
                                   group-hover:text-slate-900"
                        >
                            <i
                                class="fa-solid
                                       fa-microchip"
                                aria-hidden="true"
                            ></i>
                        </span>

                        <h3
                            class="mt-4 text-sm
                                   font-bold
                                   text-slate-800"
                        >
                            Autonomous
                        </h3>

                        <p
                            class="mt-2 text-xs
                                   leading-5
                                   text-slate-500"
                        >
                            Pengembangan autonomous maintenance.
                        </p>
                    </article>
                </div>


                @if (
                    $descriptionButtonText !== ''
                    && $descriptionButtonHref !== null
                )
                    <a
                        href="{{ $descriptionButtonHref }}"
                        @if ($descriptionButtonIsExternal)
                            target="_blank"
                            rel="noopener noreferrer"
                        @endif
                        class="group mt-9
                               inline-flex w-full
                               items-center
                               justify-center gap-3
                               rounded-xl
                               bg-gradient-to-r
                               from-[#073763]
                               to-[#075F9B]
                               px-7 py-4
                               font-bold text-white
                               shadow-lg
                               shadow-blue-900/15
                               transition duration-300
                               hover:-translate-y-1
                               hover:shadow-xl
                               sm:w-auto"
                    >
                        {{ $descriptionButtonText }}

                        <span
                            class="transition-transform
                                   group-hover:translate-x-1"
                            aria-hidden="true"
                        >
                            →
                        </span>
                    </a>
                @endif
            </div>
        </div>


        {{-- ===================================================== --}}
        {{-- AKREDITASI --}}
        {{-- ===================================================== --}}

        @if ($accreditationGroups->isNotEmpty())
            <div
                class="mt-28 md:mt-36"
                data-accreditation-tabs
            >
                {{-- Heading --}}
                <div
                    class="grid gap-8
                           lg:grid-cols-12
                           lg:items-end"
                    data-aos="fade-up"
                >
                    <div class="lg:col-span-8">
                        <div
                            class="flex items-center gap-3"
                        >
                            <span
                                class="h-px w-10
                                       bg-[#D7B33E]"
                            ></span>

                            <p
                                class="text-xs font-bold
                                       uppercase
                                       tracking-[0.22em]
                                       text-[#075F9B]"
                            >
                                Penjaminan Mutu
                            </p>
                        </div>

                        <h2
                            class="mt-5 text-3xl
                                   font-extrabold
                                   leading-tight
                                   tracking-tight
                                   text-slate-900
                                   sm:text-4xl
                                   lg:text-5xl"
                        >
                            Akreditasi Program Studi
                        </h2>

                        <p
                            class="mt-5 max-w-3xl
                                   text-base leading-8
                                   text-slate-600"
                        >
                            Informasi pengakuan mutu Program Studi
                            D-IV Teknik Mesin Produksi dan Perawatan
                            berdasarkan data yang dipublikasikan
                            oleh pengelola website.
                        </p>
                    </div>

                    <div
                        class="hidden justify-end
                               lg:col-span-4
                               lg:flex"
                    >
                        <div
                            class="flex h-24 w-24
                                   items-center
                                   justify-center
                                   rounded-full
                                   border border-blue-100
                                   bg-white text-3xl
                                   text-[#075F9B]
                                   shadow-lg"
                        >
                            <i
                                class="fa-solid
                                       fa-award"
                                aria-hidden="true"
                            ></i>
                        </div>
                    </div>
                </div>


                {{-- Tombol Tab --}}
                @if ($accreditationGroups->count() > 1)
                    <div
                        class="mt-10 flex
                               flex-col gap-3
                               sm:flex-row"
                        role="tablist"
                        aria-label="Jenis akreditasi"
                        data-aos="fade-up"
                    >
                        @foreach (
                            $accreditationGroups
                            as $groupKey => $group
                        )
                            @php
                                $isDefaultGroup =
                                    $groupKey ===
                                    $defaultAccreditationType;
                            @endphp

                            <button
                                type="button"
                                id="accreditation-tab-{{ $groupKey }}"
                                role="tab"
                                aria-controls="accreditation-panel-{{ $groupKey }}"
                                aria-selected="{{ $isDefaultGroup
                                    ? 'true'
                                    : 'false' }}"
                                tabindex="{{ $isDefaultGroup
                                    ? '0'
                                    : '-1' }}"
                                data-accreditation-tab="{{ $groupKey }}"
                                class="accreditation-tab-button
                                       {{ $isDefaultGroup
                                            ? 'is-active'
                                            : '' }}
                                       flex w-full
                                       items-center gap-3
                                       rounded-2xl border
                                       px-5 py-4
                                       text-left
                                       font-bold
                                       transition duration-300
                                       sm:w-auto"
                            >
                                <span
                                    class="accreditation-tab-icon
                                           flex h-10 w-10
                                           shrink-0
                                           items-center
                                           justify-center
                                           rounded-xl
                                           bg-blue-50
                                           text-[#075F9B]
                                           transition"
                                >
                                    <i
                                        class="fa-solid
                                               {{ $group['icon'] }}"
                                        aria-hidden="true"
                                    ></i>
                                </span>

                                <span>
                                    <span class="block text-sm">
                                        {{ $group['label'] }}
                                    </span>

                                    <span
                                        class="mt-0.5 block
                                               text-[10px]
                                               font-medium opacity-70"
                                    >
                                        Lihat informasi
                                    </span>
                                </span>
                            </button>
                        @endforeach
                    </div>
                @endif


                {{-- Panel Akreditasi --}}
                <div class="mt-10">
                    @foreach (
                        $accreditationGroups
                        as $groupKey => $group
                    )
                        <div
                            id="accreditation-panel-{{ $groupKey }}"
                            role="tabpanel"
                            aria-labelledby="accreditation-tab-{{ $groupKey }}"
                            data-accreditation-panel="{{ $groupKey }}"
                            @if (
                                $groupKey !==
                                $defaultAccreditationType
                            )
                                hidden
                            @endif
                        >
                            <div class="space-y-8">
                                @foreach (
                                    $group['items']
                                    as $accreditation
                                )
                                    @php
                                        $file = $getAccreditationFile(
                                            $accreditation
                                        );

                                        $title = trim(
                                            (string) (
                                                $accreditation->title
                                                ?? ''
                                            )
                                        );

                                        $institution = trim(
                                            (string) (
                                                $accreditation->institution
                                                ?? ''
                                            )
                                        );

                                        $rank = trim(
                                            (string) (
                                                $accreditation->rank
                                                ?? ''
                                            )
                                        );

                                        $certificateNumber = trim(
                                            (string) (
                                                $accreditation
                                                    ->certificate_number
                                                ?? ''
                                            )
                                        );

                                        $description = trim(
                                            (string) (
                                                $accreditation->description
                                                ?? ''
                                            )
                                        );

                                        $validityPeriod =
                                            $formatValidityPeriod(
                                                $accreditation->valid_from,
                                                $accreditation->valid_until
                                            );
                                    @endphp


                                    <article
                                        class="group relative
                                               overflow-hidden
                                               rounded-[2rem]
                                               border
                                               border-slate-200
                                               bg-white
                                               shadow-[0_24px_70px_rgba(15,23,42,0.10)]"
                                        data-aos="fade-up"
                                    >
                                        <div
                                            class="absolute
                                                   inset-y-0 left-0
                                                   w-1.5
                                                   bg-gradient-to-b
                                                   from-[#073763]
                                                   via-[#075F9B]
                                                   to-[#D7B33E]"
                                            aria-hidden="true"
                                        ></div>

                                        <div
                                            class="grid gap-8
                                                   p-6 sm:p-8
                                                   lg:grid-cols-12
                                                   lg:gap-10
                                                   lg:p-10"
                                        >
                                            {{-- Preview --}}
                                            <div
                                                class="lg:col-span-5"
                                            >
                                                <div
                                                    class="relative
                                                           h-full
                                                           min-h-[300px]
                                                           overflow-hidden
                                                           rounded-2xl
                                                           border
                                                           border-slate-100
                                                           bg-gradient-to-br
                                                           from-slate-50
                                                           to-blue-50"
                                                >
                                                    @if ($file['is_image'])
                                                        <a
                                                            href="{{ $file['url'] }}"
                                                            target="_blank"
                                                            rel="noopener noreferrer"
                                                            class="block h-full"
                                                        >
                                                            <img
                                                                src="{{ $file['url'] }}"
                                                                alt="Dokumen {{ $title }}"
                                                                class="h-[320px]
                                                                       w-full
                                                                       object-contain
                                                                       p-5
                                                                       transition
                                                                       duration-700
                                                                       group-hover:scale-[1.02]
                                                                       lg:h-full
                                                                       lg:min-h-[390px]"
                                                                loading="lazy"
                                                            >
                                                        </a>

                                                    @elseif ($file['is_pdf'])
                                                        <a
                                                            href="{{ $file['url'] }}"
                                                            target="_blank"
                                                            rel="noopener noreferrer"
                                                            class="flex h-[320px]
                                                                   flex-col
                                                                   items-center
                                                                   justify-center
                                                                   p-8 text-center
                                                                   transition
                                                                   hover:bg-white/60
                                                                   lg:h-full
                                                                   lg:min-h-[390px]"
                                                        >
                                                            <span
                                                                class="flex h-24
                                                                       w-24
                                                                       items-center
                                                                       justify-center
                                                                       rounded-3xl
                                                                       bg-red-50
                                                                       text-2xl
                                                                       font-black
                                                                       text-red-600
                                                                       shadow-sm"
                                                            >
                                                                PDF
                                                            </span>

                                                            <p
                                                                class="mt-5
                                                                       text-lg
                                                                       font-bold
                                                                       text-slate-800"
                                                            >
                                                                Dokumen
                                                                Akreditasi
                                                            </p>

                                                            <p
                                                                class="mt-2
                                                                       text-sm
                                                                       text-slate-500"
                                                            >
                                                                Klik untuk
                                                                membuka dokumen.
                                                            </p>
                                                        </a>

                                                    @else
                                                        <div
                                                            class="flex h-[320px]
                                                                   flex-col
                                                                   items-center
                                                                   justify-center
                                                                   p-8 text-center
                                                                   lg:h-full
                                                                   lg:min-h-[390px]"
                                                        >
                                                            <span
                                                                class="flex h-24
                                                                       w-24
                                                                       items-center
                                                                       justify-center
                                                                       rounded-3xl
                                                                       bg-blue-50
                                                                       text-3xl
                                                                       font-black
                                                                       text-[#075F9B]"
                                                            >
                                                                A
                                                            </span>

                                                            <p
                                                                class="mt-5
                                                                       font-bold
                                                                       text-slate-800"
                                                            >
                                                                Dokumen belum
                                                                tersedia
                                                            </p>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>


                                            {{-- Informasi --}}
                                            <div
                                                class="flex flex-col
                                                       justify-center
                                                       lg:col-span-7"
                                            >
                                                <div
                                                    class="flex
                                                           flex-wrap
                                                           items-center
                                                           gap-3"
                                                >
                                                    <span
                                                        class="inline-flex
                                                               items-center
                                                               gap-2
                                                               rounded-full
                                                               bg-blue-50
                                                               px-4 py-2
                                                               text-xs
                                                               font-bold
                                                               text-[#075F9B]"
                                                    >
                                                        <i
                                                            class="fa-solid
                                                                   {{ $group['icon'] }}"
                                                            aria-hidden="true"
                                                        ></i>

                                                        {{ $accreditation
                                                            ->type_label }}
                                                    </span>

                                                    @if ($rank !== '')
                                                        <span
                                                            class="inline-flex
                                                                   rounded-full
                                                                   bg-yellow-50
                                                                   px-4 py-2
                                                                   text-xs
                                                                   font-bold
                                                                   text-yellow-700"
                                                        >
                                                            {{ $rank }}
                                                        </span>
                                                    @endif
                                                </div>


                                                <h3
                                                    class="mt-5
                                                           text-2xl
                                                           font-extrabold
                                                           leading-tight
                                                           text-slate-900
                                                           sm:text-3xl
                                                           lg:text-4xl"
                                                >
                                                    {{ $title }}
                                                </h3>


                                                @if ($institution !== '')
                                                    <p
                                                        class="mt-3
                                                               font-bold
                                                               text-[#075F9B]"
                                                    >
                                                        {{ $institution }}
                                                    </p>
                                                @endif


                                                @if ($description !== '')
                                                    <p
                                                        class="mt-6
                                                               text-justify
                                                               leading-8
                                                               text-slate-600"
                                                    >
                                                        {{ $description }}
                                                    </p>
                                                @endif


                                                @if (
                                                    $certificateNumber !== ''
                                                    || $validityPeriod !== null
                                                )
                                                    <div
                                                        class="mt-7
                                                               grid gap-4
                                                               sm:grid-cols-2"
                                                    >
                                                        @if (
                                                            $certificateNumber
                                                            !== ''
                                                        )
                                                            <div
                                                                class="rounded-2xl
                                                                       border
                                                                       border-slate-200
                                                                       bg-slate-50
                                                                       p-5"
                                                            >
                                                                <p
                                                                    class="text-xs
                                                                           font-bold
                                                                           uppercase
                                                                           tracking-wider
                                                                           text-slate-400"
                                                                >
                                                                    Nomor
                                                                    Sertifikat
                                                                    / SK
                                                                </p>

                                                                <p
                                                                    class="mt-2
                                                                           break-words
                                                                           text-sm
                                                                           font-bold
                                                                           leading-6
                                                                           text-slate-800"
                                                                >
                                                                    {{ $certificateNumber }}
                                                                </p>
                                                            </div>
                                                        @endif


                                                        @if (
                                                            $validityPeriod
                                                            !== null
                                                        )
                                                            <div
                                                                class="rounded-2xl
                                                                       border
                                                                       border-yellow-100
                                                                       bg-yellow-50
                                                                       p-5"
                                                            >
                                                                <p
                                                                    class="text-xs
                                                                           font-bold
                                                                           uppercase
                                                                           tracking-wider
                                                                           text-yellow-700/60"
                                                                >
                                                                    Masa Berlaku
                                                                </p>

                                                                <p
                                                                    class="mt-2
                                                                           text-sm
                                                                           font-bold
                                                                           leading-6
                                                                           text-slate-800"
                                                                >
                                                                    {{ $validityPeriod }}
                                                                </p>
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endif


                                                @if ($file['url'] !== null)
                                                    <div class="mt-8">
                                                        <a
                                                            href="{{ $file['url'] }}"
                                                            target="_blank"
                                                            rel="noopener noreferrer"
                                                            class="group/button
                                                                   inline-flex
                                                                   w-full
                                                                   items-center
                                                                   justify-center
                                                                   gap-3
                                                                   rounded-xl
                                                                   bg-[#073763]
                                                                   px-6 py-3.5
                                                                   font-bold
                                                                   text-white
                                                                   transition
                                                                   duration-300
                                                                   hover:-translate-y-1
                                                                   hover:bg-[#075F9B]
                                                                   hover:shadow-xl
                                                                   sm:w-auto"
                                                        >
                                                            Lihat Dokumen

                                                            <i
                                                                class="fa-solid
                                                                       fa-arrow-up-right-from-square
                                                                       text-xs
                                                                       transition-transform
                                                                       group-hover/button:translate-x-0.5
                                                                       group-hover/button:-translate-y-0.5"
                                                                aria-hidden="true"
                                                            ></i>
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>


@once
    <script>
        document.addEventListener(
            'DOMContentLoaded',
            function () {
                const wrapper =
                    document.querySelector(
                        '[data-accreditation-tabs]'
                    );

                if (!wrapper) {
                    return;
                }

                const buttons = Array.from(
                    wrapper.querySelectorAll(
                        '[data-accreditation-tab]'
                    )
                );

                const panels = Array.from(
                    wrapper.querySelectorAll(
                        '[data-accreditation-panel]'
                    )
                );


                function activateTab(selectedButton) {
                    const target =
                        selectedButton.getAttribute(
                            'data-accreditation-tab'
                        );

                    buttons.forEach(function (button) {
                        const isSelected =
                            button === selectedButton;

                        button.classList.toggle(
                            'is-active',
                            isSelected
                        );

                        button.setAttribute(
                            'aria-selected',
                            isSelected
                                ? 'true'
                                : 'false'
                        );

                        button.setAttribute(
                            'tabindex',
                            isSelected
                                ? '0'
                                : '-1'
                        );
                    });


                    panels.forEach(function (panel) {
                        const isTarget =
                            panel.getAttribute(
                                'data-accreditation-panel'
                            ) === target;

                        panel.hidden = !isTarget;
                    });
                }


                buttons.forEach(
                    function (button, index) {
                        button.addEventListener(
                            'click',
                            function () {
                                activateTab(button);
                            }
                        );

                        button.addEventListener(
                            'keydown',
                            function (event) {
                                if (
                                    event.key
                                        !== 'ArrowLeft'
                                    && event.key
                                        !== 'ArrowRight'
                                ) {
                                    return;
                                }

                                event.preventDefault();

                                const direction =
                                    event.key
                                        === 'ArrowRight'
                                        ? 1
                                        : -1;

                                const nextIndex =
                                    (
                                        index
                                        + direction
                                        + buttons.length
                                    ) % buttons.length;

                                buttons[
                                    nextIndex
                                ].focus();

                                activateTab(
                                    buttons[nextIndex]
                                );
                            }
                        );
                    }
                );
            }
        );
    </script>
@endonce