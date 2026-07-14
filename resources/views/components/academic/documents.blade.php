@php
    /*
    |--------------------------------------------------------------------------
    | INFORMASI HALAMAN
    |--------------------------------------------------------------------------
    */

    $pageTitle = trim((string) ($page['title'] ?? 'Dokumen Akademik'));
    $pageSubtitle = trim((string) ($page['subtitle'] ?? ''));

    /*
    |--------------------------------------------------------------------------
    | DAFTAR DOKUMEN
    |--------------------------------------------------------------------------
    */

    $academicDocuments = collect($documents ?? []);
    $academicPages = collect($pages ?? []);
@endphp


<section
    id="academic-documents"
    class="relative overflow-hidden
           bg-gradient-to-br
           from-slate-50 via-white to-blue-50
           py-20 md:py-24"
>
    {{-- ========================================================= --}}
    {{-- BACKGROUND DECORATION --}}
    {{-- ========================================================= --}}

    <div
        class="pointer-events-none absolute inset-0"
        aria-hidden="true"
    >
        <div
            class="absolute -left-40 -top-40
                   h-[520px] w-[520px]
                   rounded-full bg-blue-200/30
                   blur-[140px]"
        ></div>

        <div
            class="absolute -right-40 bottom-0
                   h-[520px] w-[520px]
                   rounded-full bg-yellow-200/30
                   blur-[140px]"
        ></div>

        <div
            class="absolute inset-0 opacity-[0.03]"
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
            class="absolute bottom-8 right-8
                   select-none text-[70px]
                   font-black leading-none
                   text-blue-900/[0.025]
                   md:text-[130px]"
        >
            AKADEMIK
        </div>
    </div>


    <div
        class="relative z-10 mx-auto
               max-w-7xl px-6"
    >
        {{-- ===================================================== --}}
        {{-- HEADING --}}
        {{-- ===================================================== --}}

        <div
            class="mx-auto mb-12 max-w-3xl text-center"
            data-aos="fade-up"
        >
            <span
                class="text-sm font-semibold uppercase
                       tracking-[5px] text-blue-700"
            >
                Dokumen Akademik
            </span>

            <h2
                class="mt-4 text-3xl font-bold
                       leading-tight text-slate-800
                       sm:text-4xl md:text-5xl"
            >
                {{ $pageTitle }}
            </h2>

            <div
                class="mx-auto mt-6 h-1 w-24
                       rounded-full bg-yellow-400"
            ></div>

            @if ($pageSubtitle !== '')
                <p
                    class="mt-7 leading-8
                           text-slate-600"
                >
                    {{ $pageSubtitle }}
                </p>
            @endif
        </div>


        {{-- ===================================================== --}}
        {{-- NAVIGASI AKADEMIK --}}
        {{-- ===================================================== --}}

        @if ($academicPages->isNotEmpty())
            <nav
                aria-label="Navigasi dokumen akademik"
                class="mb-12 rounded-3xl
                       border border-slate-100
                       bg-white p-4 shadow-lg
                       sm:p-5"
                data-aos="fade-up"
            >
                <div
                    class="flex flex-wrap
                           justify-center gap-3"
                >
                    @foreach ($academicPages as $pageSlug => $item)

                        @php
                            $menuTitle = trim(
                                (string) ($item['title'] ?? '')
                            );
                        @endphp

                        @if ($menuTitle !== '')
                            <a
                                href="{{ route(
                                    'academic.page',
                                    $pageSlug
                                ) }}"
                                @class([
                                    'inline-flex items-center justify-center',
                                    'rounded-xl px-4 py-3',
                                    'text-center text-sm font-semibold',
                                    'transition duration-300',
                                    'sm:px-5',
                                    'bg-blue-700 text-white shadow-md' =>
                                        $slug === $pageSlug,
                                    'bg-slate-100 text-slate-700 hover:bg-blue-50 hover:text-blue-700' =>
                                        $slug !== $pageSlug,
                                ])
                                @if ($slug === $pageSlug)
                                    aria-current="page"
                                @endif
                            >
                                {{ $menuTitle }}
                            </a>
                        @endif

                    @endforeach
                </div>
            </nav>
        @endif


        {{-- ===================================================== --}}
        {{-- DAFTAR DOKUMEN --}}
        {{-- ===================================================== --}}

        @if ($academicDocuments->isNotEmpty())

            <div class="space-y-8 md:space-y-10">

                @foreach ($academicDocuments as $document)

                    @php
                        /*
                        |--------------------------------------------------------------------------
                        | DATA DOKUMEN
                        |--------------------------------------------------------------------------
                        */

                        $documentTitle = trim(
                            (string) $document->title
                        );

                        $description = trim(
                            (string) $document->description
                        );

                        $academicYear = trim(
                            (string) $document->academic_year
                        );

                        $categoryLabel = trim(
                            (string) ($document->category_label ?? '')
                        );

                        /*
                        |--------------------------------------------------------------------------
                        | FILE DOKUMEN
                        |--------------------------------------------------------------------------
                        */

                        $filePath = trim(
                            (string) $document->file_path
                        );

                        $fileExists = $filePath !== ''
                            && \Illuminate\Support\Facades\Storage::disk(
                                'public'
                            )->exists($filePath);

                        $fileUrl = $fileExists
                            ? asset('storage/' . $filePath)
                            : null;

                        $extension = $fileExists
                            ? strtolower(
                                pathinfo(
                                    $filePath,
                                    PATHINFO_EXTENSION
                                )
                            )
                            : null;

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

                        /*
                        |--------------------------------------------------------------------------
                        | TAUTAN EKSTERNAL
                        |--------------------------------------------------------------------------
                        */

                        $externalLink = trim(
                            (string) $document->external_link
                        );

                        $hasSafeExternalLink =
                            $externalLink !== ''
                            && (
                                str_starts_with(
                                    strtolower($externalLink),
                                    'https://'
                                )
                                || str_starts_with(
                                    strtolower($externalLink),
                                    'http://'
                                )
                            );
                    @endphp


                    <article
                        class="overflow-hidden rounded-3xl
                               border border-slate-100
                               bg-white shadow-xl
                               transition duration-300
                               hover:shadow-2xl"
                        data-aos="fade-up"
                        data-aos-delay="{{ min(
                            $loop->index * 70,
                            350
                        ) }}"
                    >
                        {{-- ========================================= --}}
                        {{-- HEADER DOKUMEN --}}
                        {{-- ========================================= --}}

                        <div
                            class="border-b border-slate-100
                                   p-6 sm:p-7 md:p-8"
                        >
                            <div
                                class="flex flex-col gap-6
                                       lg:flex-row
                                       lg:items-start
                                       lg:justify-between"
                            >
                                <div class="min-w-0 flex-1">

                                    @if ($categoryLabel !== '')
                                        <span
                                            class="inline-flex items-center
                                                   rounded-full
                                                   bg-yellow-100
                                                   px-4 py-2
                                                   text-sm font-semibold
                                                   text-yellow-700"
                                        >
                                            {{ $categoryLabel }}
                                        </span>
                                    @endif


                                    <h3
                                        class="{{ $categoryLabel !== ''
                                            ? 'mt-5'
                                            : '' }}
                                               break-words text-2xl
                                               font-bold leading-snug
                                               text-slate-800
                                               md:text-3xl"
                                    >
                                        {{ $documentTitle !== ''
                                            ? $documentTitle
                                            : $pageTitle }}
                                    </h3>


                                    @if ($academicYear !== '')
                                        <p
                                            class="mt-3 text-sm
                                                   font-semibold
                                                   text-blue-700"
                                        >
                                            Tahun Akademik
                                            {{ $academicYear }}
                                        </p>
                                    @endif


                                    @if ($description !== '')
                                        <p
                                            class="mt-5 text-justify
                                                   leading-8
                                                   text-slate-600"
                                        >
                                            {!! nl2br(e($description)) !!}
                                        </p>
                                    @endif
                                </div>


                                {{-- Tombol --}}
                                @if ($fileUrl || $hasSafeExternalLink)
                                    <div
                                        class="flex shrink-0
                                               flex-col gap-3
                                               sm:flex-row
                                               lg:justify-end"
                                    >
                                        @if ($fileUrl)
                                            <a
                                                href="{{ $fileUrl }}"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="inline-flex
                                                       items-center
                                                       justify-center
                                                       rounded-xl
                                                       bg-blue-700
                                                       px-5 py-3
                                                       text-sm font-semibold
                                                       text-white
                                                       transition
                                                       hover:bg-blue-800"
                                            >
                                                Buka File
                                            </a>
                                        @endif


                                        @if ($hasSafeExternalLink)
                                            <a
                                                href="{{ $externalLink }}"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="inline-flex
                                                       items-center
                                                       justify-center
                                                       rounded-xl
                                                       bg-yellow-400
                                                       px-5 py-3
                                                       text-sm font-semibold
                                                       text-slate-900
                                                       transition
                                                       hover:bg-yellow-500"
                                            >
                                                Buka Tautan
                                            </a>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>


                        {{-- ========================================= --}}
                        {{-- PREVIEW DOKUMEN --}}
                        {{-- ========================================= --}}

                        <div
                            class="bg-slate-100
                                   p-4 md:p-6"
                        >
                            @if ($fileUrl && $isPdf)

                                {{-- Preview PDF Desktop --}}
                                <div
                                    class="hidden overflow-hidden
                                           rounded-2xl border
                                           border-slate-200
                                           bg-white shadow-lg
                                           md:block"
                                >
                                    <iframe
                                        src="{{ $fileUrl }}#toolbar=1&navpanes=0&scrollbar=1"
                                        class="h-[720px] w-full"
                                        title="Pratinjau {{ $documentTitle }}"
                                        loading="lazy"
                                    ></iframe>
                                </div>


                                {{-- Tampilan PDF Mobile --}}
                                <div
                                    class="rounded-2xl border
                                           border-slate-200
                                           bg-white p-8
                                           text-center shadow-sm
                                           md:hidden"
                                >
                                    <div
                                        class="mx-auto flex h-16 w-16
                                               items-center justify-center
                                               rounded-2xl bg-red-100
                                               text-lg font-bold
                                               text-red-600"
                                    >
                                        PDF
                                    </div>

                                    <h4
                                        class="mt-5 text-xl font-bold
                                               text-slate-800"
                                    >
                                        Dokumen PDF
                                    </h4>

                                    <p
                                        class="mt-3 leading-7
                                               text-slate-500"
                                    >
                                        Buka dokumen untuk melihat
                                        isi lengkap melalui pembaca
                                        PDF perangkat Anda.
                                    </p>

                                    <a
                                        href="{{ $fileUrl }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="mt-6 inline-flex
                                               items-center justify-center
                                               rounded-xl bg-blue-700
                                               px-5 py-3
                                               text-sm font-semibold
                                               text-white transition
                                               hover:bg-blue-800"
                                    >
                                        Buka Dokumen
                                    </a>
                                </div>


                            @elseif ($fileUrl && $isImage)

                                <div
                                    class="overflow-hidden rounded-2xl
                                           border border-slate-200
                                           bg-white shadow-lg"
                                >
                                    <a
                                        href="{{ $fileUrl }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                    >
                                        <img
                                            src="{{ $fileUrl }}"
                                            alt="{{ $documentTitle }}"
                                            class="h-auto w-full
                                                   object-contain"
                                            loading="lazy"
                                        >
                                    </a>
                                </div>


                            @elseif ($fileUrl)

                                <div
                                    class="rounded-2xl border
                                           border-slate-200
                                           bg-white p-8
                                           text-center md:p-10"
                                >
                                    <div
                                        class="mx-auto flex h-16 w-16
                                               items-center justify-center
                                               rounded-2xl bg-blue-100
                                               text-sm font-bold uppercase
                                               text-blue-700"
                                    >
                                        {{ $extension ?: 'FILE' }}
                                    </div>

                                    <h4
                                        class="mt-5 text-xl font-bold
                                               text-slate-800
                                               md:text-2xl"
                                    >
                                        File Siap Dibuka
                                    </h4>

                                    <p
                                        class="mt-3 leading-7
                                               text-slate-500"
                                    >
                                        Format file ini tidak dapat
                                        ditampilkan langsung pada
                                        halaman website.
                                    </p>

                                    <a
                                        href="{{ $fileUrl }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="mt-6 inline-flex
                                               items-center justify-center
                                               rounded-xl bg-blue-700
                                               px-5 py-3
                                               text-sm font-semibold
                                               text-white transition
                                               hover:bg-blue-800"
                                    >
                                        Buka File
                                    </a>
                                </div>


                            @elseif ($hasSafeExternalLink)

                                <div
                                    class="rounded-2xl border
                                           border-slate-200
                                           bg-white p-8
                                           text-center md:p-10"
                                >
                                    <div
                                        class="mx-auto flex h-16 w-16
                                               items-center justify-center
                                               rounded-2xl bg-yellow-100
                                               text-yellow-700"
                                    >
                                        <i
                                            class="fa-solid fa-arrow-up-right-from-square text-xl"
                                            aria-hidden="true"
                                        ></i>
                                    </div>

                                    <h4
                                        class="mt-5 text-xl font-bold
                                               text-slate-800
                                               md:text-2xl"
                                    >
                                        Dokumen Tersedia melalui
                                        Tautan Eksternal
                                    </h4>

                                    <p
                                        class="mt-3 leading-7
                                               text-slate-500"
                                    >
                                        Gunakan tombol Buka Tautan
                                        untuk melihat dokumen pada
                                        halaman sumber.
                                    </p>
                                </div>


                            @else

                                <div
                                    class="rounded-2xl border
                                           border-slate-200
                                           bg-white p-8
                                           text-center md:p-10"
                                >
                                    <div
                                        class="mx-auto flex h-16 w-16
                                               items-center justify-center
                                               rounded-2xl bg-slate-100
                                               text-slate-500"
                                    >
                                        <i
                                            class="fa-regular fa-file-lines text-xl"
                                            aria-hidden="true"
                                        ></i>
                                    </div>

                                    <h4
                                        class="mt-5 text-xl font-bold
                                               text-slate-800
                                               md:text-2xl"
                                    >
                                        Dokumen Belum Tersedia
                                    </h4>

                                    <p
                                        class="mt-3 leading-7
                                               text-slate-500"
                                    >
                                        File atau tautan dokumen
                                        belum ditambahkan melalui
                                        halaman admin.
                                    </p>
                                </div>

                            @endif
                        </div>
                    </article>

                @endforeach

            </div>

        @else

            {{-- ================================================= --}}
            {{-- EMPTY STATE --}}
            {{-- ================================================= --}}

            <div
                class="rounded-3xl border
                       border-slate-100 bg-white
                       p-8 text-center shadow-lg
                       sm:p-10 md:p-12"
                data-aos="fade-up"
            >
                <div
                    class="mx-auto flex h-16 w-16
                           items-center justify-center
                           rounded-2xl bg-blue-50
                           text-blue-700"
                >
                    <i
                        class="fa-regular fa-folder-open text-xl"
                        aria-hidden="true"
                    ></i>
                </div>

                <h3
                    class="mt-5 text-2xl font-bold
                           text-slate-800"
                >
                    Dokumen Belum Tersedia
                </h3>

                <p
                    class="mx-auto mt-3 max-w-xl
                           leading-7 text-slate-500"
                >
                    Data {{ strtolower($pageTitle) }} belum
                    ditambahkan oleh pengelola melalui halaman
                    admin.
                </p>
            </div>

        @endif
    </div>
</section>