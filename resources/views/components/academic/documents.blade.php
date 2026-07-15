@php
    /*
    |--------------------------------------------------------------------------
    | INFORMASI HALAMAN
    |--------------------------------------------------------------------------
    */

    $pageTitle = trim(
        (string) ($page['title'] ?? 'Dokumen Akademik')
    );

    $pageSubtitle = trim(
        (string) ($page['subtitle'] ?? '')
    );

    $academicDocuments = collect(
        $documents ?? []
    );

    $academicPages = collect(
        $pages ?? []
    );


    /*
    |--------------------------------------------------------------------------
    | IKON BERDASARKAN HALAMAN
    |--------------------------------------------------------------------------
    */

    $pageIcons = [
        'pedoman-akademik' => 'fa-book-open',
        'kalender-akademik' => 'fa-calendar-days',
        'kurikulum' => 'fa-layer-group',
        'jadwal-kuliah' => 'fa-clock',
        'laporan-ketercapaian' => 'fa-chart-line',
        'panduan-laporan-tugas-akhir' => 'fa-graduation-cap',
        'panduan-laporan-pkl' => 'fa-industry',
    ];

    $currentIcon = $pageIcons[$slug ?? '']
        ?? 'fa-file-lines';


    /*
    |--------------------------------------------------------------------------
    | LABEL FILE
    |--------------------------------------------------------------------------
    */

    $fileLabels = [
        'pdf' => 'Dokumen PDF',
        'jpg' => 'Gambar JPG',
        'jpeg' => 'Gambar JPEG',
        'png' => 'Gambar PNG',
        'webp' => 'Gambar WEBP',
        'doc' => 'Dokumen Word',
        'docx' => 'Dokumen Word',
        'xls' => 'Dokumen Excel',
        'xlsx' => 'Dokumen Excel',
        'ppt' => 'Dokumen PowerPoint',
        'pptx' => 'Dokumen PowerPoint',
        'zip' => 'Arsip ZIP',
    ];
@endphp


<section
    id="academic-documents"
    class="relative overflow-hidden
           bg-[#F6F8FB] py-16
           md:py-20 lg:py-24"
>
    {{-- ========================================================= --}}
    {{-- BACKGROUND DECORATION --}}
    {{-- ========================================================= --}}

    <div
        class="pointer-events-none absolute inset-0"
        aria-hidden="true"
    >
        <div
            class="absolute -left-48 top-0
                   h-[430px] w-[430px]
                   rounded-full
                   bg-blue-100/45
                   blur-[145px]"
        ></div>

        <div
            class="absolute -right-48 bottom-0
                   h-[430px] w-[430px]
                   rounded-full
                   bg-yellow-100/35
                   blur-[145px]"
        ></div>
    </div>


    <div
        class="relative mx-auto
               max-w-7xl px-6"
    >
        {{-- ===================================================== --}}
        {{-- HEADING --}}
        {{-- ===================================================== --}}

        <header
            class="grid items-end gap-8
                   lg:grid-cols-12"
            data-aos="fade-up"
        >
            <div class="lg:col-span-8">
                <div
                    class="flex items-center gap-3"
                >
                    <span
                        class="h-px w-9
                               bg-[#D7B33E]"
                        aria-hidden="true"
                    ></span>

                    <p
                        class="text-[11px] font-bold
                               uppercase
                               tracking-[0.22em]
                               text-[#075F9B]"
                    >
                        Pusat Dokumen Akademik
                    </p>
                </div>


                <h2
                    class="mt-5 max-w-4xl
                           text-3xl font-semibold
                           leading-tight
                           tracking-[-0.025em]
                           text-slate-900
                           sm:text-4xl
                           lg:text-5xl"
                    style="
                        font-family:
                            'Space Grotesk',
                            'Plus Jakarta Sans',
                            sans-serif;
                    "
                >
                    Akses {{ $pageTitle }}
                </h2>


                @if ($pageSubtitle !== '')
                    <p
                        class="mt-5 max-w-3xl
                               text-base leading-8
                               text-slate-600
                               sm:text-lg"
                    >
                        {{ $pageSubtitle }}
                    </p>
                @endif


                <div
                    class="mt-6 flex items-center gap-3"
                    aria-hidden="true"
                >
                    <span
                        class="h-1 w-14
                               rounded-full
                               bg-[#075F9B]"
                    ></span>

                    <span
                        class="h-1 w-7
                               rounded-full
                               bg-[#D7B33E]"
                    ></span>
                </div>
            </div>


            {{-- Jumlah dokumen --}}
            <div
                class="lg:col-span-4
                       lg:flex
                       lg:justify-end"
            >
                <div
                    class="flex items-center gap-5
                           border-l-2
                           border-[#D7B33E]
                           pl-5"
                >
                    <span
                        class="text-5xl font-bold
                               tracking-[-0.04em]
                               text-[#075F9B]"
                    >
                        {{ str_pad(
                            (string) $academicDocuments->count(),
                            2,
                            '0',
                            STR_PAD_LEFT
                        ) }}
                    </span>

                    <div>
                        <p
                            class="text-xs font-bold
                                   uppercase
                                   tracking-[0.16em]
                                   text-slate-400"
                        >
                            Dokumen Aktif
                        </p>

                        <p
                            class="mt-1 text-sm
                                   leading-6
                                   text-slate-600"
                        >
                            {{ $pageTitle }}
                        </p>
                    </div>
                </div>
            </div>
        </header>


        {{-- ===================================================== --}}
        {{-- NAVIGASI AKADEMIK --}}
        {{-- ===================================================== --}}

        @if ($academicPages->isNotEmpty())
            <nav
                aria-label="Navigasi halaman akademik"
                class="mt-12 rounded-2xl
                    border border-slate-200
                    bg-white p-2.5
                    shadow-sm"
                data-aos="fade-up"
                data-aos-delay="80"
            >
                {{-- Mobile: dapat digeser --}}
                {{-- Desktop: otomatis membungkus --}}
                <div
                    class="overflow-x-auto pb-1
                        [scrollbar-width:none]
                        [&::-webkit-scrollbar]:hidden
                        lg:overflow-visible
                        lg:pb-0"
                >
                    <div
                        class="flex w-max min-w-full
                            items-center gap-2
                            lg:w-full
                            lg:flex-wrap
                            lg:justify-center"
                    >
                        @foreach ($academicPages as $pageSlug => $item)
                            @php
                                $menuTitle = trim(
                                    (string) (
                                        $item['title']
                                        ?? ''
                                    )
                                );

                                $menuIcon = $pageIcons[$pageSlug]
                                    ?? 'fa-file-lines';

                                $isActive =
                                    ($slug ?? '') === $pageSlug;
                            @endphp

                            @if ($menuTitle !== '')
                                <a
                                    href="{{ route(
                                        'academic.page',
                                        $pageSlug
                                    ) }}"
                                    class="inline-flex shrink-0
                                        items-center
                                        justify-center gap-2.5
                                        whitespace-nowrap
                                        rounded-xl
                                        px-4 py-3
                                        text-sm font-bold
                                        transition duration-300

                                        {{ $isActive
                                                ? 'bg-[#073763] text-white shadow-md'
                                                : 'bg-transparent text-slate-600 hover:bg-blue-50 hover:text-[#075F9B]' }}"
                                    @if ($isActive)
                                        aria-current="page"
                                    @endif
                                >
                                    <i
                                        class="fa-solid {{ $menuIcon }}
                                            text-xs

                                            {{ $isActive
                                                    ? 'text-[#F2D56F]'
                                                    : 'text-slate-400' }}"
                                        aria-hidden="true"
                                    ></i>

                                    {{ $menuTitle }}
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
            </nav>
        @endif


        {{-- ===================================================== --}}
        {{-- DAFTAR DOKUMEN --}}
        {{-- ===================================================== --}}

        @if ($academicDocuments->isNotEmpty())
            <div
                class="mt-10 space-y-7
                       lg:mt-12 lg:space-y-9"
            >
                @foreach ($academicDocuments as $document)
                    @php
                        /*
                        |--------------------------------------------------------------------------
                        | DATA UTAMA
                        |--------------------------------------------------------------------------
                        */

                        $documentTitle = trim(
                            (string) (
                                $document->title
                                ?? ''
                            )
                        );

                        $documentDescription = trim(
                            (string) (
                                $document->description
                                ?? ''
                            )
                        );

                        $academicYear = trim(
                            (string) (
                                $document->academic_year
                                ?? ''
                            )
                        );

                        $filePath = trim(
                            (string) (
                                $document->file_path
                                ?? ''
                            )
                        );

                        $externalLink = trim(
                            (string) (
                                $document->external_link
                                ?? ''
                            )
                        );


                        /*
                        |--------------------------------------------------------------------------
                        | VALIDASI FILE
                        |--------------------------------------------------------------------------
                        */

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

                        $extension = $fileExists
                            ? strtolower(
                                pathinfo(
                                    $filePath,
                                    PATHINFO_EXTENSION
                                )
                            )
                            : '';

                        $isPdf = $extension === 'pdf';

                        $isImage = in_array(
                            $extension,
                            [
                                'jpg',
                                'jpeg',
                                'png',
                                'webp',
                            ],
                            true
                        );

                        $fileLabel = $fileLabels[$extension]
                            ?? (
                                $extension !== ''
                                    ? strtoupper($extension)
                                    : 'Dokumen'
                            );


                        /*
                        |--------------------------------------------------------------------------
                        | VALIDASI TAUTAN EKSTERNAL
                        |--------------------------------------------------------------------------
                        */

                        $externalScheme = $externalLink !== ''
                            ? strtolower(
                                (string) parse_url(
                                    $externalLink,
                                    PHP_URL_SCHEME
                                )
                            )
                            : '';

                        $hasExternalLink =
                            $externalLink !== ''
                            && in_array(
                                $externalScheme,
                                [
                                    'http',
                                    'https',
                                ],
                                true
                            );

                        $hasAccess =
                            $fileUrl
                            || $hasExternalLink;
                    @endphp


                    <article
                        class="group relative
                               overflow-hidden
                               rounded-[1.75rem]
                               border border-slate-200
                               bg-white
                               shadow-[0_16px_45px_rgba(15,23,42,0.065)]
                               transition duration-300
                               hover:border-blue-200
                               hover:shadow-[0_24px_60px_rgba(15,23,42,0.11)]"
                        data-aos="fade-up"
                        data-aos-delay="{{ min(
                            $loop->index * 80,
                            320
                        ) }}"
                    >
                        {{-- Aksen atas --}}
                        <div
                            class="absolute inset-x-0
                                   top-0 h-1
                                   bg-gradient-to-r
                                   from-[#073763]
                                   via-[#D7B33E]
                                   to-[#075F9B]"
                            aria-hidden="true"
                        ></div>


                        <div
                            class="grid items-stretch
                                   lg:grid-cols-12"
                        >
                            {{-- ================================= --}}
                            {{-- PREVIEW --}}
                            {{-- ================================= --}}

                            <div
                                class="border-b
                                       border-slate-200
                                       bg-slate-50
                                       p-5 sm:p-6
                                       lg:col-span-5
                                       lg:border-b-0
                                       lg:border-r"
                            >
                                <div
                                    class="relative flex
                                           min-h-[280px]
                                           overflow-hidden
                                           rounded-[1.25rem]
                                           border border-slate-200
                                           bg-white
                                           shadow-sm
                                           sm:min-h-[340px]
                                           lg:h-full
                                           lg:min-h-[440px]"
                                >
                                    @if ($fileUrl && $isPdf)
                                        {{-- Preview PDF desktop --}}
                                        <iframe
                                            src="{{ $fileUrl }}#toolbar=0&navpanes=0&scrollbar=1"
                                            title="Pratinjau {{ $documentTitle !== ''
                                                ? $documentTitle
                                                : $pageTitle }}"
                                            class="hidden h-full
                                                   min-h-[440px]
                                                   w-full
                                                   bg-white
                                                   md:block"
                                            loading="lazy"
                                        ></iframe>


                                        {{-- PDF mobile --}}
                                        <div
                                            class="flex w-full
                                                   flex-col
                                                   items-center
                                                   justify-center
                                                   p-8 text-center
                                                   md:hidden"
                                        >
                                            <span
                                                class="flex h-20 w-20
                                                       items-center
                                                       justify-center
                                                       rounded-3xl
                                                       bg-red-50
                                                       text-xl font-black
                                                       text-red-600"
                                            >
                                                PDF
                                            </span>

                                            <h4
                                                class="mt-5 text-xl
                                                       font-bold
                                                       text-slate-900"
                                            >
                                                Dokumen PDF
                                            </h4>

                                            <p
                                                class="mt-2 max-w-xs
                                                       text-sm leading-7
                                                       text-slate-500"
                                            >
                                                Buka dokumen untuk
                                                melihat isi lengkap.
                                            </p>
                                        </div>
                                    @elseif ($fileUrl && $isImage)
                                        <a
                                            href="{{ $fileUrl }}"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="flex w-full
                                                   items-center
                                                   justify-center
                                                   overflow-hidden p-4"
                                        >
                                            <img
                                                src="{{ $fileUrl }}"
                                                alt="{{ $documentTitle !== ''
                                                    ? $documentTitle
                                                    : $pageTitle }}"
                                                class="max-h-[520px]
                                                       w-full object-contain
                                                       transition duration-500
                                                       group-hover:scale-[1.02]"
                                                loading="lazy"
                                            >
                                        </a>
                                    @elseif ($fileUrl)
                                        <div
                                            class="flex w-full
                                                   flex-col
                                                   items-center
                                                   justify-center
                                                   p-8 text-center"
                                        >
                                            <span
                                                class="flex h-20 w-20
                                                       items-center
                                                       justify-center
                                                       rounded-3xl
                                                       bg-blue-50
                                                       text-sm font-black
                                                       uppercase
                                                       text-[#075F9B]"
                                            >
                                                {{ $extension !== ''
                                                    ? $extension
                                                    : 'FILE' }}
                                            </span>

                                            <h4
                                                class="mt-5 text-xl
                                                       font-bold
                                                       text-slate-900"
                                            >
                                                File Siap Diakses
                                            </h4>

                                            <p
                                                class="mt-2 max-w-xs
                                                       text-sm leading-7
                                                       text-slate-500"
                                            >
                                                Format file ini dibuka
                                                melalui aplikasi yang
                                                mendukung pada perangkat.
                                            </p>
                                        </div>
                                    @elseif ($hasExternalLink)
                                        <div
                                            class="flex w-full
                                                   flex-col
                                                   items-center
                                                   justify-center
                                                   p-8 text-center"
                                        >
                                            <span
                                                class="flex h-20 w-20
                                                       items-center
                                                       justify-center
                                                       rounded-3xl
                                                       bg-yellow-50
                                                       text-2xl
                                                       text-yellow-700"
                                            >
                                                <i
                                                    class="fa-solid
                                                           fa-arrow-up-right-from-square"
                                                    aria-hidden="true"
                                                ></i>
                                            </span>

                                            <h4
                                                class="mt-5 text-xl
                                                       font-bold
                                                       text-slate-900"
                                            >
                                                Tautan Eksternal
                                            </h4>

                                            <p
                                                class="mt-2 max-w-xs
                                                       text-sm leading-7
                                                       text-slate-500"
                                            >
                                                Dokumen tersedia melalui
                                                situs atau penyimpanan
                                                eksternal.
                                            </p>
                                        </div>
                                    @else
                                        <div
                                            class="flex w-full
                                                   flex-col
                                                   items-center
                                                   justify-center
                                                   p-8 text-center"
                                        >
                                            <span
                                                class="flex h-20 w-20
                                                       items-center
                                                       justify-center
                                                       rounded-3xl
                                                       bg-slate-100
                                                       text-2xl
                                                       text-slate-400"
                                            >
                                                <i
                                                    class="fa-regular
                                                           fa-file-lines"
                                                    aria-hidden="true"
                                                ></i>
                                            </span>

                                            <h4
                                                class="mt-5 text-xl
                                                       font-bold
                                                       text-slate-900"
                                            >
                                                Dokumen Belum Tersedia
                                            </h4>

                                            <p
                                                class="mt-2 max-w-xs
                                                       text-sm leading-7
                                                       text-slate-500"
                                            >
                                                File atau tautan belum
                                                ditambahkan melalui admin.
                                            </p>
                                        </div>
                                    @endif


                                    {{-- Label preview --}}
                                    <span
                                        class="absolute left-4 top-4
                                               inline-flex items-center
                                               gap-2 rounded-full
                                               border border-white/70
                                               bg-white/90
                                               px-3 py-2
                                               text-[10px] font-bold
                                               uppercase
                                               tracking-[0.13em]
                                               text-slate-700
                                               shadow-sm
                                               backdrop-blur-sm"
                                    >
                                        <span
                                            class="h-2 w-2
                                                   rounded-full
                                                   {{ $fileUrl
                                                        ? 'bg-emerald-500'
                                                        : ($hasExternalLink
                                                            ? 'bg-[#D7B33E]'
                                                            : 'bg-slate-300') }}"
                                            aria-hidden="true"
                                        ></span>

                                        {{ $fileUrl
                                            ? $fileLabel
                                            : ($hasExternalLink
                                                ? 'Tautan Eksternal'
                                                : 'Belum Tersedia') }}
                                    </span>
                                </div>
                            </div>


                            {{-- ================================= --}}
                            {{-- INFORMASI DOKUMEN --}}
                            {{-- ================================= --}}

                            <div
                                class="flex flex-col
                                       justify-center
                                       p-6 sm:p-8
                                       lg:col-span-7
                                       lg:p-10"
                            >
                                <div
                                    class="flex flex-wrap
                                           items-center gap-3"
                                >
                                    <span
                                        class="inline-flex items-center
                                               gap-2 rounded-full
                                               bg-blue-50
                                               px-4 py-2
                                               text-xs font-bold
                                               text-[#075F9B]"
                                    >
                                        <i
                                            class="fa-solid {{ $currentIcon }}"
                                            aria-hidden="true"
                                        ></i>

                                        {{ $pageTitle }}
                                    </span>


                                    @if ($academicYear !== '')
                                        <span
                                            class="inline-flex items-center
                                                   gap-2 rounded-full
                                                   bg-yellow-50
                                                   px-4 py-2
                                                   text-xs font-bold
                                                   text-yellow-700"
                                        >
                                            <i
                                                class="fa-regular
                                                       fa-calendar"
                                                aria-hidden="true"
                                            ></i>

                                            {{ $academicYear }}
                                        </span>
                                    @endif
                                </div>


                                <h3
                                    class="mt-6 text-2xl
                                           font-semibold
                                           leading-tight
                                           tracking-[-0.02em]
                                           text-slate-900
                                           sm:text-3xl
                                           lg:text-4xl"
                                    style="
                                        font-family:
                                            'Space Grotesk',
                                            'Plus Jakarta Sans',
                                            sans-serif;
                                    "
                                >
                                    {{ $documentTitle !== ''
                                        ? $documentTitle
                                        : $pageTitle }}
                                </h3>


                                @if ($documentDescription !== '')
                                    <p
                                        class="mt-5 text-justify
                                               text-sm leading-7
                                               text-slate-600
                                               sm:text-base
                                               sm:leading-8"
                                    >
                                        {!! nl2br(
                                            e($documentDescription)
                                        ) !!}
                                    </p>
                                @else
                                    <p
                                        class="mt-5 text-sm
                                               leading-7
                                               text-slate-500
                                               sm:text-base
                                               sm:leading-8"
                                    >
                                        Dokumen akademik ini disediakan
                                        sebagai sumber informasi bagi
                                        mahasiswa, dosen, dan pihak terkait.
                                    </p>
                                @endif


                                {{-- Metadata --}}
                                <div
                                    class="mt-7 grid gap-4
                                           border-t
                                           border-slate-200
                                           pt-6 sm:grid-cols-2"
                                >
                                    <div
                                        class="flex items-start gap-3"
                                    >
                                        <span
                                            class="flex h-9 w-9
                                                   shrink-0 items-center
                                                   justify-center
                                                   rounded-xl
                                                   bg-blue-50
                                                   text-xs
                                                   text-[#075F9B]"
                                        >
                                            <i
                                                class="fa-solid
                                                       fa-file-circle-check"
                                                aria-hidden="true"
                                            ></i>
                                        </span>

                                        <div>
                                            <p
                                                class="text-[10px]
                                                       font-bold uppercase
                                                       tracking-[0.15em]
                                                       text-slate-400"
                                            >
                                                Format Akses
                                            </p>

                                            <p
                                                class="mt-1 text-sm
                                                       font-bold
                                                       text-slate-800"
                                            >
                                                {{ $fileUrl
                                                    ? $fileLabel
                                                    : ($hasExternalLink
                                                        ? 'Tautan Eksternal'
                                                        : 'Belum Tersedia') }}
                                            </p>
                                        </div>
                                    </div>


                                    <div
                                        class="flex items-start gap-3"
                                    >
                                        <span
                                            class="flex h-9 w-9
                                                   shrink-0 items-center
                                                   justify-center
                                                   rounded-xl
                                                   bg-yellow-50
                                                   text-xs
                                                   text-yellow-700"
                                        >
                                            <i
                                                class="fa-solid
                                                       fa-building-columns"
                                                aria-hidden="true"
                                            ></i>
                                        </span>

                                        <div>
                                            <p
                                                class="text-[10px]
                                                       font-bold uppercase
                                                       tracking-[0.15em]
                                                       text-slate-400"
                                            >
                                                Program Studi
                                            </p>

                                            <p
                                                class="mt-1 text-sm
                                                       font-bold
                                                       leading-6
                                                       text-slate-800"
                                            >
                                                D-IV TMPP
                                            </p>
                                        </div>
                                    </div>
                                </div>


                                {{-- Tombol akses --}}
                                <div
                                    class="mt-8 flex
                                           flex-col gap-3
                                           sm:flex-row
                                           sm:flex-wrap"
                                >
                                    @if ($fileUrl)
                                        <a
                                            href="{{ $fileUrl }}"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="inline-flex
                                                   min-h-12 items-center
                                                   justify-center gap-3
                                                   rounded-xl
                                                   bg-[#073763]
                                                   px-6 py-3
                                                   text-sm font-bold
                                                   text-white
                                                   transition duration-300
                                                   hover:-translate-y-0.5
                                                   hover:bg-[#075F9B]
                                                   hover:shadow-lg"
                                        >
                                            <i
                                                class="fa-solid
                                                       fa-file-arrow-down"
                                                aria-hidden="true"
                                            ></i>

                                            Buka Dokumen
                                        </a>
                                    @endif


                                    @if ($hasExternalLink)
                                        <a
                                            href="{{ $externalLink }}"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="inline-flex
                                                   min-h-12 items-center
                                                   justify-center gap-3
                                                   rounded-xl
                                                   bg-[#D7B33E]
                                                   px-6 py-3
                                                   text-sm font-bold
                                                   text-[#031D36]
                                                   transition duration-300
                                                   hover:-translate-y-0.5
                                                   hover:bg-[#E6C653]
                                                   hover:shadow-lg"
                                        >
                                            <i
                                                class="fa-solid
                                                       fa-arrow-up-right-from-square"
                                                aria-hidden="true"
                                            ></i>

                                            Buka Tautan
                                        </a>
                                    @endif


                                    @if (!$hasAccess)
                                        <span
                                            class="inline-flex
                                                   min-h-12 items-center
                                                   justify-center gap-3
                                                   rounded-xl
                                                   bg-slate-100
                                                   px-6 py-3
                                                   text-sm font-bold
                                                   text-slate-500"
                                        >
                                            <i
                                                class="fa-regular
                                                       fa-clock"
                                                aria-hidden="true"
                                            ></i>

                                            Belum Tersedia
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            {{-- ================================================= --}}
            {{-- EMPTY STATE --}}
            {{-- ================================================= --}}

            <div
                class="mt-10 rounded-[1.75rem]
                       border border-dashed
                       border-slate-300
                       bg-white px-6 py-14
                       text-center"
                data-aos="fade-up"
            >
                <span
                    class="mx-auto flex h-16 w-16
                           items-center justify-center
                           rounded-2xl bg-blue-50
                           text-xl text-[#075F9B]"
                >
                    <i
                        class="fa-regular fa-folder-open"
                        aria-hidden="true"
                    ></i>
                </span>

                <h3
                    class="mt-5 text-2xl
                           font-bold text-slate-900"
                >
                    Dokumen Belum Tersedia
                </h3>

                <p
                    class="mx-auto mt-3 max-w-xl
                           text-sm leading-7
                           text-slate-500"
                >
                    Data {{ strtolower($pageTitle) }}
                    belum ditambahkan oleh pengelola
                    melalui halaman admin.
                </p>
            </div>
        @endif
    </div>
</section>