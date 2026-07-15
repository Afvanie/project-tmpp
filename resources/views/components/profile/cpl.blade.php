@php
    /*
    |--------------------------------------------------------------------------
    | CAPAIAN PEMBELAJARAN LULUSAN
    |--------------------------------------------------------------------------
    */

    $items = isset($section) && $section
        ? collect($section->items ?? [])
            ->filter(function ($item) {
                return (bool) ($item->is_active ?? false)
                    && strtolower(
                        trim(
                            (string) ($item->item_group ?? '')
                        )
                    ) === 'cpl'
                    && trim(
                        (string) ($item->content ?? '')
                    ) !== '';
            })
            ->sortBy('sort_order')
            ->values()
        : collect();


    /*
    |--------------------------------------------------------------------------
    | INFORMASI SECTION
    |--------------------------------------------------------------------------
    */

    $sectionTitle = isset($section)
        ? trim(
            (string) ($section->title ?? '')
        )
        : '';

    $sectionSubtitle = isset($section)
        ? trim(
            (string) ($section->subtitle ?? '')
        )
        : '';

    $sectionDescription = isset($section)
        ? trim(
            (string) ($section->description ?? '')
        )
        : '';


    /*
    |--------------------------------------------------------------------------
    | STATUS KONTEN
    |--------------------------------------------------------------------------
    */

    $hasContent = isset($section)
        && $section
        && $items->isNotEmpty();


    /*
    |--------------------------------------------------------------------------
    | IKON
    |--------------------------------------------------------------------------
    */

    $icons = [
        'fa-lightbulb',
        'fa-gears',
        'fa-user-gear',
        'fa-industry',
        'fa-chart-line',
        'fa-screwdriver-wrench',
        'fa-people-group',
        'fa-magnifying-glass-chart',
        'fa-shield-halved',
    ];
@endphp


@if ($hasContent)
    <section
        id="graduate-learning-outcomes"
        class="relative overflow-hidden
               bg-[#031D36] py-16
               md:py-20 lg:py-24"
    >
        {{-- ===================================================== --}}
        {{-- BACKGROUND --}}
        {{-- ===================================================== --}}

        <div
            class="pointer-events-none absolute inset-0"
            aria-hidden="true"
        >
            {{-- Cahaya biru --}}
            <div
                class="absolute -left-48 top-0
                       h-[520px] w-[520px]
                       rounded-full
                       bg-blue-500/10
                       blur-[150px]"
            ></div>

            {{-- Cahaya emas --}}
            <div
                class="absolute -right-48 bottom-0
                       h-[520px] w-[520px]
                       rounded-full
                       bg-yellow-400/10
                       blur-[150px]"
            ></div>

            {{-- Pola grid halus --}}
            <div
                class="absolute inset-0 opacity-[0.035]"
                style="
                    background-image:
                        linear-gradient(
                            rgba(255, 255, 255, 0.9) 1px,
                            transparent 1px
                        ),
                        linear-gradient(
                            90deg,
                            rgba(255, 255, 255, 0.9) 1px,
                            transparent 1px
                        );

                    background-size: 60px 60px;
                "
            ></div>

            {{-- Garis cahaya bagian atas --}}
            <div
                class="absolute inset-x-0 top-0
                       h-px
                       bg-gradient-to-r
                       from-transparent
                       via-white/15
                       to-transparent"
            ></div>
        </div>


        <div
            class="relative mx-auto
                   max-w-7xl px-6"
        >
            {{-- ================================================= --}}
            {{-- HEADING --}}
            {{-- ================================================= --}}

            <header
                class="grid items-end gap-8
                       lg:grid-cols-12"
                data-aos="fade-up"
            >
                <div class="lg:col-span-9">
                    <div
                        class="flex items-center gap-3"
                    >
                        <span
                            class="h-px w-9
                                   bg-[#E2BD45]"
                            aria-hidden="true"
                        ></span>

                        <p
                            class="text-[11px] font-bold
                                   uppercase
                                   tracking-[0.22em]
                                   text-[#F2D56F]"
                        >
                            {{ $sectionSubtitle !== ''
                                ? $sectionSubtitle
                                : 'Kompetensi Lulusan' }}
                        </p>
                    </div>


                    <h2
                        class="mt-5 max-w-4xl
                               text-3xl font-semibold
                               leading-tight
                               tracking-[-0.025em]
                               text-white
                               sm:text-4xl
                               lg:text-5xl"
                        style="
                            font-family:
                                'Space Grotesk',
                                'Plus Jakarta Sans',
                                sans-serif;
                        "
                    >
                        {{ $sectionTitle !== ''
                            ? $sectionTitle
                            : 'Capaian Pembelajaran Lulusan' }}
                    </h2>


                    @if ($sectionDescription !== '')
                        <p
                            class="mt-5 max-w-3xl
                                   text-base leading-8
                                   text-blue-100/70
                                   sm:text-lg"
                        >
                            {{ $sectionDescription }}
                        </p>
                    @endif


                    <div
                        class="mt-6 flex items-center gap-3"
                        aria-hidden="true"
                    >
                        <span
                            class="h-1 w-14
                                   rounded-full
                                   bg-[#168BC5]"
                        ></span>

                        <span
                            class="h-1 w-7
                                   rounded-full
                                   bg-[#E2BD45]"
                        ></span>
                    </div>
                </div>


                {{-- Jumlah CPL --}}
                <div
                    class="lg:col-span-3
                           lg:flex
                           lg:justify-end"
                >
                    <div
                        class="inline-flex items-center
                               gap-4 rounded-2xl
                               border border-white/10
                               bg-white/[0.06]
                               px-5 py-4
                               backdrop-blur-sm"
                    >
                        <span
                            class="text-4xl font-bold
                                   tracking-[-0.04em]
                                   text-[#F2D56F]"
                        >
                            {{ str_pad(
                                (string) $items->count(),
                                2,
                                '0',
                                STR_PAD_LEFT
                            ) }}
                        </span>

                        <div
                            class="border-l
                                   border-white/15 pl-4"
                        >
                            <p
                                class="text-[10px] font-bold
                                       uppercase
                                       tracking-[0.17em]
                                       text-white/40"
                            >
                                Total
                            </p>

                            <p
                                class="mt-1 text-sm
                                       font-semibold
                                       text-white/90"
                            >
                                Capaian
                            </p>
                        </div>
                    </div>
                </div>
            </header>


            {{-- ================================================= --}}
            {{-- GRID CPL --}}
            {{-- ================================================= --}}

            <div
                class="mt-12 grid gap-5
                       md:grid-cols-2
                       xl:grid-cols-3"
            >
                @foreach ($items as $item)
                    @php
                        $itemTitle = trim(
                            (string) ($item->title ?? '')
                        );

                        $itemContent = trim(
                            (string) ($item->content ?? '')
                        );

                        $number = str_pad(
                            (string) $loop->iteration,
                            2,
                            '0',
                            STR_PAD_LEFT
                        );

                        $icon = $icons[
                            $loop->index % count($icons)
                        ];

                        $isGold = $loop->iteration % 3 === 2;
                        $isLightBlue = $loop->iteration % 3 === 0;
                    @endphp


                    <article
                        class="group relative flex
                               h-full flex-col
                               overflow-hidden
                               rounded-[1.5rem]
                               border border-white/10
                               bg-white/[0.055]
                               p-6
                               backdrop-blur-sm
                               transition duration-300
                               hover:-translate-y-1
                               hover:border-white/20
                               hover:bg-white/[0.085]
                               hover:shadow-[0_22px_50px_rgba(0,0,0,0.22)]
                               sm:p-7"
                        data-aos="fade-up"
                        data-aos-delay="{{ min(
                            $loop->index * 60,
                            300
                        ) }}"
                    >
                        {{-- Garis atas --}}
                        <div
                            class="absolute inset-x-0
                                   top-0 h-0.5
                                   {{ $isGold
                                        ? 'bg-[#E2BD45]'
                                        : ($isLightBlue
                                            ? 'bg-[#45B4E8]'
                                            : 'bg-[#168BC5]') }}"
                            aria-hidden="true"
                        ></div>


                        {{-- Header kartu --}}
                        <div
                            class="flex items-start
                                   justify-between gap-5"
                        >
                            {{-- Nomor --}}
                            <span
                                class="flex h-12 w-12
                                       items-center
                                       justify-center
                                       rounded-2xl
                                       text-sm font-extrabold
                                       transition duration-300
                                       group-hover:scale-105
                                       {{ $isGold
                                            ? 'bg-[#E2BD45] text-[#031D36]'
                                            : ($isLightBlue
                                                ? 'bg-[#45B4E8]/15 text-[#71D0FA]'
                                                : 'bg-[#168BC5]/20 text-[#71C8F3]') }}"
                            >
                                {{ $number }}
                            </span>


                            {{-- Ikon --}}
                            <span
                                class="flex h-10 w-10
                                       items-center
                                       justify-center
                                       rounded-xl
                                       border border-white/10
                                       bg-white/[0.05]
                                       text-sm
                                       transition duration-300
                                       group-hover:border-white/20
                                       group-hover:bg-white/10
                                       {{ $isGold
                                            ? 'text-[#F2D56F]'
                                            : 'text-[#71C8F3]' }}"
                            >
                                <i
                                    class="fa-solid {{ $icon }}"
                                    aria-hidden="true"
                                ></i>
                            </span>
                        </div>


                        {{-- Label --}}
                        <div
                            class="mt-6 flex
                                   items-center gap-3"
                        >
                            <p
                                class="text-[10px] font-bold
                                       uppercase
                                       tracking-[0.19em]
                                       {{ $isGold
                                            ? 'text-[#F2D56F]'
                                            : 'text-[#71C8F3]' }}"
                            >
                                CPL {{ $number }}
                            </p>

                            <span
                                class="h-px flex-1
                                       bg-white/10"
                                aria-hidden="true"
                            ></span>
                        </div>


                        {{-- Judul item --}}
                        @if ($itemTitle !== '')
                            <h3
                                class="mt-4 text-lg
                                       font-bold leading-7
                                       text-white"
                            >
                                {{ $itemTitle }}
                            </h3>
                        @endif


                        {{-- Isi --}}
                        <p
                            class="{{ $itemTitle !== ''
                                ? 'mt-3'
                                : 'mt-4' }}
                                   flex-1 text-left
                                   text-sm leading-7
                                   text-blue-100/65
                                   sm:text-[15px]
                                   sm:leading-8"
                        >
                            {!! nl2br(
                                e($itemContent)
                            ) !!}
                        </p>


                        {{-- Footer --}}
                        <div
                            class="mt-6 flex items-center
                                   justify-between
                                   border-t
                                   border-white/10 pt-4"
                        >
                            <span
                                class="text-[10px] font-bold
                                       uppercase
                                       tracking-[0.15em]
                                       text-white/30"
                            >
                                D-IV TMPP
                            </span>

                            <span
                                class="h-2 w-2
                                       rounded-full
                                       transition duration-300
                                       group-hover:scale-125
                                       {{ $isGold
                                            ? 'bg-[#E2BD45]'
                                            : 'bg-[#168BC5]' }}"
                                aria-hidden="true"
                            ></span>
                        </div>


                        {{-- Cahaya hover --}}
                        <div
                            class="pointer-events-none
                                   absolute -bottom-20
                                   -right-20 h-44 w-44
                                   rounded-full opacity-0
                                   blur-3xl
                                   transition duration-500
                                   group-hover:opacity-100
                                   {{ $isGold
                                        ? 'bg-yellow-400/10'
                                        : 'bg-blue-400/10' }}"
                            aria-hidden="true"
                        ></div>
                    </article>
                @endforeach
            </div>


            {{-- ================================================= --}}
            {{-- INFORMASI BAWAH --}}
            {{-- ================================================= --}}

            <div
                class="mt-10 flex items-start gap-4
                       rounded-2xl
                       border border-white/10
                       bg-white/[0.045]
                       px-5 py-4
                       backdrop-blur-sm"
                data-aos="fade-up"
            >
  
            </div>
        </div>
    </section>
@endif