@php
    /*
    |--------------------------------------------------------------------------
    | GAMBARAN UMUM PROGRAM STUDI
    |--------------------------------------------------------------------------
    */

    $overviewSection = \App\Models\ProfileSection::query()
        ->with([
            'items' => function ($query) {
                $query
                    ->where('is_active', true)
                    ->orderBy('sort_order')
                    ->orderBy('id');
            },
        ])
        ->where('slug', 'overview')
        ->where('is_active', true)
        ->first();


    /*
    |--------------------------------------------------------------------------
    | KELOMPOK KONTEN
    |--------------------------------------------------------------------------
    */

    $labelItem = $overviewSection
        ? $overviewSection->items
            ->firstWhere('item_group', 'label')
        : null;

    $paragraphs = $overviewSection
        ? $overviewSection->items
            ->where('item_group', 'paragraph')
            ->filter(function ($item) {
                return trim(
                    (string) $item->content
                ) !== '';
            })
            ->sortBy('sort_order')
            ->values()
        : collect();

    /*
    |--------------------------------------------------------------------------
    | KARTU INFORMASI DINAMIS
    |--------------------------------------------------------------------------
    |
    | Format isi:
    |
    | Nilai utama|Deskripsi tambahan
    |
    */

    $infoCards = $overviewSection
        ? $overviewSection->items
            ->where('item_group', 'info_card')
            ->filter(function ($item) {
                $parts = explode(
                    '|',
                    (string) $item->content,
                    2
                );

                return trim(
                    $parts[0] ?? ''
                ) !== '';
            })
            ->sortBy('sort_order')
            ->values()
        : collect();


    /*
    |--------------------------------------------------------------------------
    | IKON KARTU
    |--------------------------------------------------------------------------
    */

    $cardIcons = [
        'fa-graduation-cap',
        'fa-award',
        'fa-user-graduate',
        'fa-clock',
        'fa-layer-group',
        'fa-gears',
    ];


    /*
    |--------------------------------------------------------------------------
    | GAMBAR DINAMIS
    |--------------------------------------------------------------------------
    */

    $overviewImageItem = $overviewSection
        ? $overviewSection->items
            ->firstWhere('item_group', 'image')
        : null;

    $overviewImagePath = trim(
        (string) (
            $overviewImageItem?->content
            ?? ''
        )
    );

    $dynamicOverviewImageExists =
        $overviewImagePath !== ''
        && \Illuminate\Support\Facades\Storage::disk(
            'public'
        )->exists($overviewImagePath);

    $overviewImageUrl =
        $dynamicOverviewImageExists
            ? asset(
                'storage/'
                . ltrim(
                    $overviewImagePath,
                    '/'
                )
            )
            : (
                file_exists(
                    public_path(
                        'assets/images/about.png'
                    )
                )
                    ? asset(
                        'assets/images/about.png'
                    )
                    : asset(
                        'assets/images/profile-banner.jpg'
                    )
            );
@endphp


<section
    id="profile-overview"
    class="relative overflow-hidden
           bg-[#F6F8FB] py-16
           md:py-20 lg:py-24"
>
    {{-- ========================================================= --}}
    {{-- DEKORASI RINGAN --}}
    {{-- ========================================================= --}}

    <div
        class="pointer-events-none absolute inset-0"
        aria-hidden="true"
    >
        <div
            class="absolute -left-40 top-0
                   h-80 w-80 rounded-full
                   bg-blue-100/50
                   blur-[120px]"
        ></div>

        <div
            class="absolute -right-40 bottom-0
                   h-80 w-80 rounded-full
                   bg-yellow-100/40
                   blur-[120px]"
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
            class="mb-11 max-w-4xl
                   md:mb-14"
            data-aos="fade-up"
        >
            <div
                class="flex items-center gap-3"
            >
                <span
                    class="h-px w-9 bg-[#D7B33E]"
                    aria-hidden="true"
                ></span>

                <p
                    class="text-[11px] font-bold
                           uppercase
                           tracking-[0.22em]
                           text-[#075F9B]"
                >
                    {{ trim(
                        (string) (
                            $overviewSection?->subtitle
                            ?? ''
                        )
                    ) !== ''
                        ? $overviewSection->subtitle
                        : 'Gambaran Umum' }}
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
                {{ trim(
                    (string) (
                        $overviewSection?->title
                        ?? ''
                    )
                ) !== ''
                    ? $overviewSection->title
                    : 'Mengenal Program Studi D-IV Teknik Mesin Produksi dan Perawatan' }}
            </h2>


            @if (
                trim(
                    (string) (
                        $overviewSection?->description
                        ?? ''
                    )
                ) !== ''
            )
                <p
                    class="mt-5 max-w-3xl
                           text-base leading-8
                           text-slate-600
                           sm:text-lg"
                >
                    {{ $overviewSection->description }}
                </p>
            @endif


            <div
                class="mt-6 flex items-center gap-3"
                aria-hidden="true"
            >
                <span
                    class="h-1 w-14 rounded-full
                           bg-[#075F9B]"
                ></span>

                <span
                    class="h-1 w-7 rounded-full
                           bg-[#D7B33E]"
                ></span>
            </div>
        </header>


        {{-- ===================================================== --}}
        {{-- DUA KOLOM --}}
        {{-- ===================================================== --}}

        <div
            class="grid items-start gap-10
                   lg:grid-cols-12
                   lg:gap-14"
        >
            {{-- ================================================= --}}
            {{-- KOLOM KIRI: FOTO + KARTU DINAMIS --}}
            {{-- ================================================= --}}

            <div
                class="lg:col-span-5"
                data-aos="fade-right"
            >
                {{-- Foto --}}
                <div class="relative">
                    <div
                        class="absolute -left-3 -top-3
                               h-20 w-20 rounded-2xl
                               border
                               border-[#D7B33E]/50"
                        aria-hidden="true"
                    ></div>

                    <div
                        class="relative overflow-hidden
                               rounded-[1.75rem]
                               bg-white p-2.5
                               shadow-[0_24px_60px_rgba(15,23,42,0.13)]"
                    >
                        <div
                            class="relative overflow-hidden
                                   rounded-[1.3rem]"
                        >
                            <img
                                src="{{ $overviewImageUrl }}"
                                alt="Gambaran umum Program Studi D-IV Teknik Mesin Produksi dan Perawatan"
                                class="h-[330px] w-full
                                       object-cover
                                       transition duration-700
                                       hover:scale-105
                                       sm:h-[390px]
                                       lg:h-[410px]"
                                loading="lazy"
                            >

                            <div
                                class="absolute inset-0
                                       bg-gradient-to-t
                                       from-[#031D36]/65
                                       via-transparent
                                       to-transparent"
                                aria-hidden="true"
                            ></div>

                            <div
                                class="absolute inset-x-0
                                       bottom-0 p-6"
                            >
                                <p
                                    class="text-[10px]
                                           font-bold uppercase
                                           tracking-[0.2em]
                                           text-[#F4D66E]"
                                >
                                    D-IV TMPP
                                </p>

                                <p
                                    class="mt-2 text-lg
                                           font-semibold
                                           leading-7 text-white"
                                >
                                    Politeknik Negeri Malang
                                </p>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- ============================================= --}}
                {{-- KARTU INFORMASI DINAMIS --}}
                {{-- ============================================= --}}

                @if ($infoCards->isNotEmpty())
                    <div
                        class="mt-5 grid
                               grid-cols-2 gap-3
                               sm:gap-4"
                    >
                        @foreach ($infoCards as $card)
                            @php
                                $parts = explode(
                                    '|',
                                    (string) $card->content,
                                    2
                                );

                                $mainValue = trim(
                                    $parts[0] ?? ''
                                );

                                $smallText = trim(
                                    $parts[1] ?? ''
                                );

                                $icon = $cardIcons[
                                    $loop->index
                                    % count($cardIcons)
                                ];

                                $isLastOddCard =
                                    $infoCards->count() % 2 !== 0
                                    && $loop->last;
                            @endphp

                            <article
                                class="group relative
                                       overflow-hidden
                                       rounded-2xl
                                       border border-slate-200
                                       bg-white p-4
                                       shadow-sm
                                       transition duration-300
                                       hover:-translate-y-1
                                       hover:border-blue-200
                                       hover:shadow-md
                                       sm:p-5
                                       {{ $isLastOddCard
                                            ? 'col-span-2'
                                            : '' }}"
                                data-aos="fade-up"
                                data-aos-delay="{{ min(
                                    $loop->index * 80,
                                    240
                                ) }}"
                            >
                                <div
                                    class="flex items-start
                                           justify-between gap-3"
                                >
                                    <span
                                        class="flex h-9 w-9
                                               shrink-0
                                               items-center
                                               justify-center
                                               rounded-xl
                                               bg-blue-50
                                               text-sm
                                               text-[#075F9B]
                                               transition
                                               group-hover:bg-[#075F9B]
                                               group-hover:text-white"
                                    >
                                        <i
                                            class="fa-solid {{ $icon }}"
                                            aria-hidden="true"
                                        ></i>
                                    </span>

                                    <span
                                        class="text-[10px]
                                               font-bold
                                               text-slate-300"
                                        aria-hidden="true"
                                    >
                                        {{ str_pad(
                                            (string) $loop->iteration,
                                            2,
                                            '0',
                                            STR_PAD_LEFT
                                        ) }}
                                    </span>
                                </div>


                                <p
                                    class="mt-4 break-words
                                           text-xl font-extrabold
                                           tracking-tight
                                           text-[#075F9B]
                                           sm:text-2xl"
                                >
                                    {{ $mainValue }}
                                </p>


                                @if (
                                    trim(
                                        (string) $card->title
                                    ) !== ''
                                )
                                    <h3
                                        class="mt-1.5 text-xs
                                               font-bold
                                               leading-5
                                               text-slate-800
                                               sm:text-sm"
                                    >
                                        {{ $card->title }}
                                    </h3>
                                @endif


                                @if ($smallText !== '')
                                    <p
                                        class="mt-2 text-[11px]
                                               leading-5
                                               text-slate-500
                                               sm:text-xs"
                                    >
                                        {{ $smallText }}
                                    </p>
                                @endif


                                <div
                                    class="absolute inset-x-0
                                           bottom-0 h-0.5
                                           origin-left
                                           scale-x-0
                                           bg-[#D7B33E]
                                           transition-transform
                                           duration-300
                                           group-hover:scale-x-100"
                                    aria-hidden="true"
                                ></div>
                            </article>
                        @endforeach
                    </div>
                @endif
            </div>


            {{-- ================================================= --}}
            {{-- KOLOM KANAN: DESKRIPSI --}}
            {{-- ================================================= --}}

            <div
                class="lg:col-span-7"
                data-aos="fade-left"
            >
                @if (
                    trim(
                        (string) (
                            $labelItem?->content
                            ?? ''
                        )
                    ) !== ''
                )
                    <div
                        class="flex items-center gap-3"
                    >
                        <span
                            class="h-px w-8
                                   bg-[#D7B33E]"
                            aria-hidden="true"
                        ></span>

                        <p
                            class="text-[11px]
                                   font-bold uppercase
                                   tracking-[0.18em]
                                   text-[#075F9B]"
                        >
                            {{ $labelItem->content }}
                        </p>
                    </div>
                @endif


                @if ($paragraphs->isNotEmpty())
                    <div
                        class="mt-5 space-y-5
                               text-justify
                               text-[15px]
                               leading-8
                               text-slate-600
                               sm:text-base
                               sm:leading-9"
                    >
                        @foreach ($paragraphs as $paragraph)
                            <p>
                                {!! nl2br(
                                    e($paragraph->content)
                                ) !!}
                            </p>
                        @endforeach
                    </div>
                @else
                    <div
                        class="rounded-2xl
                               border border-dashed
                               border-slate-300
                               bg-white/70
                               px-6 py-7"
                    >
                        <h3
                            class="font-bold text-slate-800"
                        >
                            Profil Singkat Belum Tersedia
                        </h3>

                        <p
                            class="mt-2 text-sm
                                   leading-7 text-slate-500"
                        >
                            Informasi gambaran umum akan
                            ditampilkan setelah dilengkapi
                            melalui halaman admin.
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
