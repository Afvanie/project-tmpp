@php
    /*
    |--------------------------------------------------------------------------
    | DESKRIPSI PROGRAM STUDI
    |--------------------------------------------------------------------------
    |
    | Data telah disiapkan oleh HomeController. View tidak melakukan query
    | database agar tanggung jawab pengambilan data tetap berada di controller.
    |
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
    | TOMBOL DESKRIPSI PROGRAM STUDI
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
    | AKREDITASI
    |--------------------------------------------------------------------------
    |
    | Hanya menggunakan data aktif dan terurut yang dikirim HomeController.
    | Seluruh data pada setiap jenis tetap ditampilkan, bukan hanya data pertama.
    |
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
            'items' => $nationalAccreditations,
            'badge_class' => 'bg-blue-100 text-blue-700',
            'accent_class' =>
                'from-blue-700 via-yellow-400 to-blue-700',
        ],

        \App\Models\Accreditation::TYPE_INTERNATIONAL => [
            'label' => 'Akreditasi Internasional',
            'items' => $internationalAccreditations,
            'badge_class' => 'bg-yellow-100 text-yellow-700',
            'accent_class' =>
                'from-yellow-400 via-blue-600 to-yellow-400',
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
    | FORMAT TANGGAL
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
    | INFORMASI FILE AKREDITASI
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


<section
    id="program-description"
    class="relative overflow-hidden
           bg-slate-50 py-20 md:py-24"
>
    {{-- ========================================================= --}}
    {{-- BACKGROUND --}}
    {{-- ========================================================= --}}

    <div
        class="pointer-events-none absolute
               inset-0 overflow-hidden"
        aria-hidden="true"
    >
        <div
            class="absolute -left-24 -top-24
                   h-96 w-96 rounded-full
                   bg-blue-100/60 blur-3xl"
        ></div>

        <div
            class="absolute bottom-0 right-0
                   h-[500px] w-[500px]
                   rounded-full bg-yellow-100/40
                   blur-3xl"
        ></div>
    </div>


    <div class="relative mx-auto max-w-7xl px-6">

        {{-- ===================================================== --}}
        {{-- DESKRIPSI PROGRAM STUDI --}}
        {{-- ===================================================== --}}

        <div
            class="grid items-center gap-12
                   md:grid-cols-2 md:gap-14"
        >
            {{-- Informasi --}}
            <div
                data-aos="fade-up"
                data-aos-duration="1000"
            >
                @if (
                    trim(
                        (string) ($programDescription?->badge ?? '')
                    ) !== ''
                )
                    <span
                        class="inline-flex items-center
                               rounded-full bg-blue-100
                               px-4 py-1.5 text-sm
                               font-semibold text-blue-700"
                    >
                        {{ $programDescription->badge }}
                    </span>
                @endif


                <h2
                    class="mt-5 text-3xl font-bold
                           leading-tight text-slate-800
                           sm:text-4xl"
                >
                    {{ trim(
                        (string) ($programDescription?->title ?? '')
                    ) !== ''
                        ? $programDescription->title
                        : 'Deskripsi Program Studi' }}
                </h2>


                <div
                    class="mb-8 mt-5 h-1 w-24
                           rounded-full bg-yellow-400"
                    data-aos="fade-right"
                    data-aos-delay="200"
                ></div>


                <p
                    class="text-justify text-base
                           leading-8 text-slate-600"
                    data-aos="fade-up"
                    data-aos-delay="300"
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
                        data-aos="fade-up"
                        data-aos-delay="500"
                        class="mt-8 inline-flex
                               items-center gap-2
                               rounded-xl bg-blue-700
                               px-6 py-3 font-semibold
                               text-white transition
                               duration-300
                               hover:-translate-y-1
                               hover:bg-blue-800
                               hover:shadow-xl"
                    >
                        {{ $descriptionButtonText }}

                        <span aria-hidden="true">→</span>
                    </a>
                @endif
            </div>


            {{-- Gambar --}}
            <div
                data-aos="fade-left"
                data-aos-duration="1200"
            >
                <div
                    class="overflow-hidden rounded-3xl
                           border border-slate-100
                           bg-white shadow-2xl"
                >
                    @if ($descriptionImageUrl !== null)
                        <img
                            src="{{ $descriptionImageUrl }}"
                            alt="Program Studi D-IV Teknik Mesin Produksi dan Perawatan"
                            class="h-[300px] w-full
                                   object-cover transition
                                   duration-700 hover:scale-105
                                   sm:h-[360px]"
                            loading="lazy"
                        >
                    @else
                        <div
                            class="flex h-[300px] w-full
                                   items-center justify-center
                                   bg-gradient-to-br
                                   from-blue-50 to-slate-100
                                   px-8 text-center
                                   sm:h-[360px]"
                        >
                            <div>
                                <div
                                    class="mx-auto flex h-20 w-20
                                           items-center justify-center
                                           rounded-3xl bg-blue-700
                                           text-2xl font-black
                                           text-white shadow-xl"
                                >
                                    TM
                                </div>

                                <p
                                    class="mt-5 font-bold
                                           text-slate-700"
                                >
                                    D-IV Teknik Mesin Produksi dan
                                    Perawatan
                                </p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>


        {{-- ===================================================== --}}
        {{-- AKREDITASI --}}
        {{-- ===================================================== --}}

        @if ($accreditationGroups->isNotEmpty())
            <div
                class="mt-28 md:mt-32"
                data-accreditation-tabs
            >
                {{-- Heading --}}
                <div
                    class="mx-auto mb-12 max-w-3xl
                           text-center"
                    data-aos="fade-up"
                >
                    <span
                        class="inline-flex items-center
                               rounded-full border
                               border-yellow-200 bg-white
                               px-5 py-2 text-sm font-bold
                               text-yellow-700 shadow-sm"
                    >
                        Akreditasi Program Studi
                    </span>

                    <h2
                        class="mt-5 text-3xl font-black
                               leading-tight text-slate-800
                               sm:text-4xl md:text-5xl"
                    >
                        Pengakuan Mutu Program Studi
                    </h2>

                    <div
                        class="mx-auto mb-6 mt-5
                               h-1.5 w-24 rounded-full
                               bg-gradient-to-r
                               from-blue-700
                               to-yellow-400"
                    ></div>

                    <p class="leading-8 text-slate-600">
                        Informasi berikut ditampilkan berdasarkan
                        data akreditasi yang telah dipublikasikan
                        oleh pengelola website.
                    </p>
                </div>


                {{-- Tombol Tab --}}
                @if ($accreditationGroups->count() > 1)
                    <div
                        class="mb-10 flex flex-col
                               items-center justify-center
                               gap-4 sm:flex-row"
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
                                @class([
                                    'accreditation-tab-btn',
                                    'w-full rounded-2xl border',
                                    'px-7 py-4 font-bold',
                                    'transition duration-300',
                                    'sm:w-auto',
                                    'border-transparent bg-blue-700',
                                    'text-white shadow-xl',
                                    'shadow-blue-700/25' =>
                                        $isDefaultGroup,
                                    'border-slate-200 bg-white',
                                    'text-slate-700 shadow-sm',
                                    'hover:border-blue-200',
                                    'hover:bg-blue-50',
                                    'hover:text-blue-700' =>
                                        !$isDefaultGroup,
                                ])
                            >
                                {{ $group['label'] }}
                            </button>
                        @endforeach
                    </div>
                @endif


                {{-- Panel Akreditasi --}}
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

                                    $hasAdditionalInformation =
                                        $certificateNumber !== ''
                                        || $validityPeriod !== null;
                                @endphp


                                <article
                                    class="relative overflow-hidden
                                           rounded-[2rem]
                                           border border-slate-100
                                           bg-white shadow-2xl"
                                    data-aos="fade-up"
                                >
                                    <div
                                        class="h-2 bg-gradient-to-r
                                               {{ $group[
                                                   'accent_class'
                                               ] }}"
                                    ></div>


                                    <div
                                        class="relative grid
                                               items-stretch gap-10
                                               p-6 md:p-8
                                               lg:grid-cols-5
                                               lg:p-10"
                                    >
                                        {{-- Preview Dokumen --}}
                                        <div class="lg:col-span-2">

                                            <div
                                                class="h-full rounded-[2rem]
                                                       border
                                                       border-slate-100
                                                       bg-gradient-to-br
                                                       from-slate-50
                                                       via-white
                                                       to-blue-50
                                                       p-4 shadow-inner"
                                            >
                                                <div
                                                    class="h-full
                                                           min-h-[300px]
                                                           overflow-hidden
                                                           rounded-[1.5rem]
                                                           border
                                                           border-slate-100
                                                           bg-white shadow-lg"
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
                                                                class="h-[300px]
                                                                       w-full
                                                                       object-contain
                                                                       p-4 transition
                                                                       duration-700
                                                                       hover:scale-[1.03]
                                                                       lg:h-full
                                                                       lg:min-h-[320px]"
                                                                loading="lazy"
                                                            >
                                                        </a>

                                                    @elseif ($file['is_pdf'])
                                                        <a
                                                            href="{{ $file['url'] }}"
                                                            target="_blank"
                                                            rel="noopener noreferrer"
                                                            class="flex h-[300px]
                                                                   flex-col
                                                                   items-center
                                                                   justify-center
                                                                   p-8 text-center
                                                                   transition
                                                                   hover:bg-slate-50
                                                                   lg:h-full
                                                                   lg:min-h-[320px]"
                                                        >
                                                            <div
                                                                class="flex h-20
                                                                       w-20
                                                                       items-center
                                                                       justify-center
                                                                       rounded-3xl
                                                                       bg-red-100
                                                                       text-2xl
                                                                       font-black
                                                                       text-red-600"
                                                            >
                                                                PDF
                                                            </div>

                                                            <h3
                                                                class="mt-5
                                                                       text-xl
                                                                       font-bold
                                                                       text-slate-800"
                                                            >
                                                                Dokumen
                                                                Akreditasi
                                                            </h3>

                                                            <p
                                                                class="mt-3
                                                                       text-sm
                                                                       text-slate-500"
                                                            >
                                                                Buka dokumen
                                                                dalam tab baru.
                                                            </p>
                                                        </a>

                                                    @else
                                                        <div
                                                            class="flex
                                                                   h-[300px]
                                                                   flex-col
                                                                   items-center
                                                                   justify-center
                                                                   p-8 text-center
                                                                   lg:h-full
                                                                   lg:min-h-[320px]"
                                                        >
                                                            <div
                                                                class="flex h-20
                                                                       w-20
                                                                       items-center
                                                                       justify-center
                                                                       rounded-3xl
                                                                       bg-blue-100
                                                                       text-3xl
                                                                       font-black
                                                                       text-blue-700"
                                                            >
                                                                A
                                                            </div>

                                                            <h3
                                                                class="mt-5
                                                                       text-xl
                                                                       font-bold
                                                                       text-slate-800"
                                                            >
                                                                Dokumen Belum
                                                                Tersedia
                                                            </h3>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>


                                        {{-- Informasi --}}
                                        <div
                                            class="flex flex-col
                                                   justify-center
                                                   lg:col-span-3"
                                        >
                                            <div
                                                class="flex flex-wrap
                                                       items-center gap-2"
                                            >
                                                <span
                                                    class="inline-flex
                                                           rounded-full
                                                           px-4 py-2
                                                           text-sm font-bold
                                                           {{ $group[
                                                               'badge_class'
                                                           ] }}"
                                                >
                                                    {{ $accreditation
                                                        ->type_label }}
                                                </span>

                                                @if ($rank !== '')
                                                    <span
                                                        class="inline-flex
                                                               rounded-full
                                                               bg-slate-100
                                                               px-4 py-2
                                                               text-sm
                                                               font-bold
                                                               text-slate-700"
                                                    >
                                                        {{ $rank }}
                                                    </span>
                                                @endif
                                            </div>


                                            <h3
                                                class="mt-5 text-3xl
                                                       font-black
                                                       leading-tight
                                                       text-slate-800
                                                       md:text-4xl"
                                            >
                                                {{ $title }}
                                            </h3>


                                            @if ($institution !== '')
                                                <p
                                                    class="mt-3
                                                           font-bold
                                                           text-blue-700"
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


                                            @if ($hasAdditionalInformation)
                                                <div
                                                    class="mt-7 grid
                                                           gap-4
                                                           sm:grid-cols-2"
                                                >
                                                    @if (
                                                        $certificateNumber
                                                        !== ''
                                                    )
                                                        <div
                                                            class="rounded-2xl
                                                                   border
                                                                   border-blue-100
                                                                   bg-blue-50
                                                                   p-5"
                                                        >
                                                            <p
                                                                class="text-sm
                                                                       text-slate-500"
                                                            >
                                                                Nomor
                                                                Sertifikat /
                                                                SK
                                                            </p>

                                                            <p
                                                                class="mt-2
                                                                       break-words
                                                                       font-bold
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
                                                                class="text-sm
                                                                       text-slate-500"
                                                            >
                                                                Masa Berlaku
                                                            </p>

                                                            <p
                                                                class="mt-2
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
                                                        class="inline-flex
                                                               w-full
                                                               items-center
                                                               justify-center
                                                               gap-2
                                                               rounded-xl
                                                               bg-blue-700
                                                               px-6 py-3
                                                               font-bold
                                                               text-white
                                                               transition
                                                               duration-300
                                                               hover:-translate-y-1
                                                               hover:bg-blue-800
                                                               hover:shadow-xl
                                                               sm:w-auto"
                                                    >
                                                        Lihat Dokumen

                                                        <span
                                                            aria-hidden="true"
                                                        >
                                                            ↗
                                                        </span>
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
        @endif
    </div>
</section>


@once
    <script>
        document.addEventListener(
            'DOMContentLoaded',
            function () {
                const wrapper = document.querySelector(
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
                    const target = selectedButton.getAttribute(
                        'data-accreditation-tab'
                    );

                    buttons.forEach(function (button) {
                        const isSelected =
                            button === selectedButton;

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

                        button.classList.toggle(
                            'border-transparent',
                            isSelected
                        );

                        button.classList.toggle(
                            'bg-blue-700',
                            isSelected
                        );

                        button.classList.toggle(
                            'text-white',
                            isSelected
                        );

                        button.classList.toggle(
                            'shadow-xl',
                            isSelected
                        );

                        button.classList.toggle(
                            'shadow-blue-700/25',
                            isSelected
                        );

                        button.classList.toggle(
                            'border-slate-200',
                            !isSelected
                        );

                        button.classList.toggle(
                            'bg-white',
                            !isSelected
                        );

                        button.classList.toggle(
                            'text-slate-700',
                            !isSelected
                        );

                        button.classList.toggle(
                            'shadow-sm',
                            !isSelected
                        );
                    });


                    panels.forEach(function (panel) {
                        panel.hidden =
                            panel.getAttribute(
                                'data-accreditation-panel'
                            ) !== target;
                    });
                }


                buttons.forEach(function (button, index) {
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
                                event.key !== 'ArrowLeft'
                                && event.key !== 'ArrowRight'
                            ) {
                                return;
                            }

                            event.preventDefault();

                            const direction =
                                event.key === 'ArrowRight'
                                    ? 1
                                    : -1;

                            const nextIndex =
                                (
                                    index
                                    + direction
                                    + buttons.length
                                ) % buttons.length;

                            buttons[nextIndex].focus();

                            activateTab(
                                buttons[nextIndex]
                            );
                        }
                    );
                });
            }
        );
    </script>
@endonce