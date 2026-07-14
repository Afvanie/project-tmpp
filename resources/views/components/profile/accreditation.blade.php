@php
    /*
    |--------------------------------------------------------------------------
    | DATA AKREDITASI
    |--------------------------------------------------------------------------
    |
    | Data dikirim oleh ProfileController. Komponen ini tidak melakukan
    | query database secara langsung.
    |
    */

    $accreditationItems = collect(
        $accreditations ?? []
    );


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


    /*
    |--------------------------------------------------------------------------
    | FORMAT MASA BERLAKU
    |--------------------------------------------------------------------------
    */

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
    | INFORMASI FILE
    |--------------------------------------------------------------------------
    */

    $getFileData = static function (
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


    /*
    |--------------------------------------------------------------------------
    | LOGO DEKORASI
    |--------------------------------------------------------------------------
    */

    $logoRelativePath = 'assets/images/logo.png';

    $logoAvailable = file_exists(
        public_path($logoRelativePath)
    );
@endphp


@if ($accreditationItems->isNotEmpty())

    <section
        id="profile-accreditation"
        class="relative overflow-hidden
               bg-white py-20 md:py-24"
    >
        {{-- ===================================================== --}}
        {{-- BACKGROUND --}}
        {{-- ===================================================== --}}

        <div
            class="pointer-events-none absolute inset-0"
            aria-hidden="true"
        >
            <div
                class="absolute -right-40 -top-40
                       h-[420px] w-[420px]
                       rounded-full bg-blue-200/20
                       blur-[120px]"
            ></div>

            <div
                class="absolute -bottom-40 -left-40
                       h-[420px] w-[420px]
                       rounded-full bg-yellow-200/20
                       blur-[120px]"
            ></div>

            <div
                class="absolute inset-0 opacity-[0.025]"
                style="
                    background-image:
                        linear-gradient(
                            #0f172a 1px,
                            transparent 1px
                        ),
                        linear-gradient(
                            to right,
                            #0f172a 1px,
                            transparent 1px
                        );
                    background-size: 70px 70px;
                "
            ></div>

            <div
                class="absolute right-8 top-12
                       select-none text-[70px]
                       font-black leading-none
                       text-blue-900/[0.025]
                       md:text-[130px]"
            >
                MUTU
            </div>

            @if ($logoAvailable)
                <img
                    src="{{ asset($logoRelativePath) }}"
                    alt=""
                    class="absolute -bottom-20 -left-20
                           w-[340px] select-none
                           grayscale opacity-[0.035]
                           md:w-[480px]"
                >
            @endif
        </div>


        <div
            class="relative z-10 mx-auto
                   max-w-7xl px-6"
        >
            {{-- ================================================= --}}
            {{-- HEADING --}}
            {{-- ================================================= --}}

            <div
                class="mx-auto mb-14 max-w-3xl
                       text-center md:mb-16"
                data-aos="fade-up"
            >
                <span
                    class="text-sm font-semibold uppercase
                           tracking-[5px] text-blue-700"
                >
                    Akreditasi
                </span>

                <h2
                    class="mt-4 text-3xl font-bold
                           leading-tight text-slate-800
                           sm:text-4xl md:text-5xl"
                >
                    Pengakuan Mutu Program Studi
                </h2>

                <div
                    class="mx-auto mb-8 mt-6
                           h-1 w-24 rounded-full
                           bg-yellow-400"
                ></div>

                <p class="leading-8 text-slate-600">
                    Informasi akreditasi yang telah dipublikasikan
                    oleh pengelola website Program Studi D-IV
                    Teknik Mesin Produksi dan Perawatan.
                </p>
            </div>


            {{-- ================================================= --}}
            {{-- KARTU AKREDITASI --}}
            {{-- ================================================= --}}

            <div
                @class([
                    'grid gap-8',
                    'mx-auto max-w-3xl grid-cols-1' =>
                        $accreditationItems->count() === 1,
                    'lg:grid-cols-2' =>
                        $accreditationItems->count() > 1,
                ])
            >
                @foreach ($accreditationItems as $accreditation)

                    @php
                        $fileData = $getFileData(
                            $accreditation
                        );

                        $title = trim(
                            (string) $accreditation->title
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

                        $description = trim(
                            (string) (
                                $accreditation->description
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

                        $isInternational =
                            $accreditation->type ===
                            \App\Models\Accreditation::TYPE_INTERNATIONAL;

                        $validityPeriod =
                            $formatValidityPeriod(
                                $accreditation->valid_from,
                                $accreditation->valid_until
                            );

                        $hasSummaryInformation =
                            $rank !== ''
                            || $institution !== ''
                            || $certificateNumber !== ''
                            || $validityPeriod !== null;
                    @endphp


                    <article
                        class="group overflow-hidden
                               rounded-[2rem] border
                               border-slate-100 bg-white
                               shadow-xl transition
                               duration-300
                               hover:-translate-y-1
                               hover:shadow-2xl"
                        data-aos="fade-up"
                        data-aos-delay="{{ min(
                            $loop->index * 100,
                            300
                        ) }}"
                    >
                        {{-- ===================================== --}}
                        {{-- PREVIEW DOKUMEN --}}
                        {{-- ===================================== --}}

                        <div
                            class="relative bg-gradient-to-br
                                   from-blue-50 via-white
                                   to-yellow-50 p-4"
                        >
                            <div
                                @class([
                                    'absolute left-0 top-0',
                                    'h-1 w-full bg-gradient-to-r',
                                    'from-yellow-400 via-blue-600 to-yellow-400' =>
                                        $isInternational,
                                    'from-blue-700 via-yellow-400 to-blue-700' =>
                                        !$isInternational,
                                ])
                            ></div>

                            <div
                                class="overflow-hidden rounded-2xl
                                       border border-slate-100
                                       bg-white shadow-md"
                            >
                                @if ($fileData['is_image'])

                                    <a
                                        href="{{ $fileData['url'] }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        aria-label="Buka dokumen {{ $title }}"
                                        class="block"
                                    >
                                        <img
                                            src="{{ $fileData['url'] }}"
                                            alt="Dokumen {{ $title }}"
                                            class="h-56 w-full
                                                   bg-white object-contain
                                                   p-3 transition
                                                   duration-500
                                                   group-hover:scale-[1.02]
                                                   md:h-64"
                                            loading="lazy"
                                        >
                                    </a>

                                @elseif ($fileData['is_pdf'])

                                    <a
                                        href="{{ $fileData['url'] }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="flex h-56 flex-col
                                               items-center justify-center
                                               bg-white p-6 text-center
                                               transition
                                               hover:bg-slate-50
                                               md:h-64"
                                    >
                                        <div
                                            class="flex h-16 w-16
                                                   items-center justify-center
                                                   rounded-2xl bg-red-100
                                                   text-xl font-bold
                                                   text-red-600"
                                        >
                                            PDF
                                        </div>

                                        <p
                                            class="mt-4 text-lg font-bold
                                                   text-slate-800"
                                        >
                                            Dokumen Akreditasi
                                        </p>

                                        <p
                                            class="mt-2 text-sm
                                                   leading-6 text-slate-500"
                                        >
                                            Klik untuk membuka dokumen.
                                        </p>
                                    </a>

                                @else

                                    <div
                                        class="flex h-56 flex-col
                                               items-center justify-center
                                               bg-white p-6 text-center
                                               md:h-64"
                                    >
                                        <div
                                            class="flex h-16 w-16
                                                   items-center justify-center
                                                   rounded-2xl bg-slate-100
                                                   text-2xl font-black
                                                   text-slate-500"
                                        >
                                            A
                                        </div>

                                        <p
                                            class="mt-4 text-lg font-bold
                                                   text-slate-800"
                                        >
                                            Dokumen Belum Tersedia
                                        </p>

                                        <p
                                            class="mt-2 max-w-sm
                                                   text-sm leading-6
                                                   text-slate-500"
                                        >
                                            Informasi akreditasi tetap
                                            ditampilkan tanpa dokumen.
                                        </p>
                                    </div>

                                @endif
                            </div>
                        </div>


                        {{-- ===================================== --}}
                        {{-- INFORMASI --}}
                        {{-- ===================================== --}}

                        <div class="p-6 md:p-7">

                            <div class="mb-4 flex flex-wrap gap-2">

                                <span
                                    @class([
                                        'inline-flex items-center',
                                        'rounded-full px-4 py-2',
                                        'text-xs font-bold',
                                        'bg-yellow-100 text-yellow-700' =>
                                            $isInternational,
                                        'bg-blue-100 text-blue-700' =>
                                            !$isInternational,
                                    ])
                                >
                                    {{ $accreditation->type_label }}
                                </span>

                                @if ($rank !== '')
                                    <span
                                        class="inline-flex items-center
                                               rounded-full bg-slate-100
                                               px-4 py-2 text-xs
                                               font-bold text-slate-700"
                                    >
                                        {{ $rank }}
                                    </span>
                                @endif
                            </div>


                            <h3
                                class="text-2xl font-bold
                                       leading-snug text-slate-800"
                            >
                                {{ $title !== ''
                                    ? $title
                                    : 'Akreditasi Program Studi' }}
                            </h3>


                            @if ($institution !== '')
                                <p
                                    class="mt-2 text-sm font-semibold
                                           text-blue-700"
                                >
                                    {{ $institution }}
                                </p>
                            @endif


                            @if ($description !== '')
                                <p
                                    class="mt-4 text-justify
                                           leading-7 text-slate-600"
                                >
                                    {{ $description }}
                                </p>
                            @endif


                            {{-- ================================= --}}
                            {{-- INFORMASI TAMBAHAN --}}
                            {{-- ================================= --}}

                            @if ($hasSummaryInformation)

                                <div
                                    class="mt-6 grid gap-4
                                           sm:grid-cols-2"
                                >
                                    @if ($rank !== '')
                                        <div
                                            class="rounded-2xl border
                                                   border-slate-100
                                                   bg-slate-50 p-4"
                                        >
                                            <p class="text-xs text-slate-500">
                                                Peringkat atau Status
                                            </p>

                                            <p
                                                class="mt-1 text-base
                                                       font-bold
                                                       text-blue-700
                                                       md:text-lg"
                                            >
                                                {{ $rank }}
                                            </p>
                                        </div>
                                    @endif


                                    @if ($institution !== '')
                                        <div
                                            class="rounded-2xl border
                                                   border-slate-100
                                                   bg-slate-50 p-4"
                                        >
                                            <p class="text-xs text-slate-500">
                                                Lembaga
                                            </p>

                                            <p
                                                class="mt-1 break-words
                                                       text-base font-bold
                                                       text-yellow-600
                                                       md:text-lg"
                                            >
                                                {{ $institution }}
                                            </p>
                                        </div>
                                    @endif


                                    @if ($validityPeriod !== null)
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
                                                class="mt-1 text-base
                                                       font-bold leading-7
                                                       text-slate-800
                                                       md:text-lg"
                                            >
                                                {{ $validityPeriod }}
                                            </p>
                                        </div>
                                    @endif


                                    @if ($certificateNumber !== '')
                                        <div
                                            class="rounded-2xl border
                                                   border-slate-100
                                                   bg-slate-50 p-4
                                                   sm:col-span-2"
                                        >
                                            <p class="text-xs text-slate-500">
                                                Nomor Sertifikat atau SK
                                            </p>

                                            <p
                                                class="mt-1 break-words
                                                       text-sm font-bold
                                                       leading-7
                                                       text-slate-800
                                                       md:text-base"
                                            >
                                                {{ $certificateNumber }}
                                            </p>
                                        </div>
                                    @endif
                                </div>

                            @endif


                            {{-- ================================= --}}
                            {{-- TOMBOL DOKUMEN --}}
                            {{-- ================================= --}}

                            @if ($fileData['url'] !== null)

                                <div
                                    class="mt-6 flex flex-col gap-3
                                           sm:flex-row"
                                >
                                    <a
                                        href="{{ $fileData['url'] }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="inline-flex items-center
                                               justify-center rounded-2xl
                                               bg-blue-700 px-5 py-3
                                               text-sm font-bold
                                               text-white transition
                                               hover:bg-blue-800"
                                    >
                                        Lihat Dokumen
                                    </a>

                                    <a
                                        href="{{ $fileData['url'] }}"
                                        download
                                        class="inline-flex items-center
                                               justify-center rounded-2xl
                                               bg-slate-100 px-5 py-3
                                               text-sm font-bold
                                               text-slate-700 transition
                                               hover:bg-slate-200"
                                    >
                                        Unduh Dokumen
                                    </a>
                                </div>

                            @endif
                        </div>
                    </article>

                @endforeach
            </div>
        </div>
    </section>

@endif