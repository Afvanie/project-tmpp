@php
    /*
    |--------------------------------------------------------------------------
    | VISI DAN MISI PROGRAM STUDI
    |--------------------------------------------------------------------------
    */

    $items = isset($section) && $section
        ? collect($section->items ?? [])
            ->filter(function ($item) {
                return (bool) $item->is_active;
            })
            ->sortBy('sort_order')
            ->values()
        : collect();


    /*
    |--------------------------------------------------------------------------
    | VISI
    |--------------------------------------------------------------------------
    |
    | Mendukung item_group:
    | - visi
    | - vision
    |
    */

    $vision = $items
        ->whereIn(
            'item_group',
            [
                'visi',
                'vision',
            ]
        )
        ->filter(function ($item) {
            return trim(
                (string) $item->content
            ) !== '';
        })
        ->first();


    /*
    |--------------------------------------------------------------------------
    | MISI
    |--------------------------------------------------------------------------
    |
    | Mendukung item_group:
    | - misi
    | - mission
    |
    */

    $missions = $items
        ->whereIn(
            'item_group',
            [
                'misi',
                'mission',
            ]
        )
        ->filter(function ($item) {
            return trim(
                (string) $item->content
            ) !== '';
        })
        ->values();


    /*
    |--------------------------------------------------------------------------
    | STATUS KONTEN
    |--------------------------------------------------------------------------
    */

    $hasVision = (bool) $vision;
    $hasMissions = $missions->isNotEmpty();

    $hasContent = isset($section)
        && $section
        && (
            $hasVision
            || $hasMissions
        );

    $sectionTitle = isset($section)
        ? trim(
            (string) (
                $section->title
                ?? ''
            )
        )
        : '';

    $sectionSubtitle = isset($section)
        ? trim(
            (string) (
                $section->subtitle
                ?? ''
            )
        )
        : '';

    $sectionDescription = isset($section)
        ? trim(
            (string) (
                $section->description
                ?? ''
            )
        )
        : '';
@endphp


@if ($hasContent)
    <section
        id="vision-mission"
        class="relative overflow-hidden
               bg-[#F6F8FB] py-16
               md:py-20 lg:py-24"
    >
        {{-- ===================================================== --}}
        {{-- DEKORASI RINGAN --}}
        {{-- ===================================================== --}}

        <div
            class="pointer-events-none absolute inset-0"
            aria-hidden="true"
        >
            <div
                class="absolute -left-40 top-0
                       h-96 w-96 rounded-full
                       bg-blue-100/55
                       blur-[130px]"
            ></div>

            <div
                class="absolute -right-40 bottom-0
                       h-96 w-96 rounded-full
                       bg-yellow-100/45
                       blur-[130px]"
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
                class="max-w-4xl"
                data-aos="fade-up"
            >
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
                        {{ $sectionSubtitle !== ''
                            ? $sectionSubtitle
                            : 'Arah Pengembangan Program Studi' }}
                    </p>
                </div>


                <h2
                    class="mt-5 text-3xl
                           font-semibold leading-tight
                           tracking-[-0.025em]
                           text-slate-900
                           sm:text-4xl lg:text-5xl"
                    style="
                        font-family:
                            'Space Grotesk',
                            'Plus Jakarta Sans',
                            sans-serif;
                    "
                >
                    {{ $sectionTitle !== ''
                        ? $sectionTitle
                        : 'Visi dan Misi' }}
                </h2>


                @if ($sectionDescription !== '')
                    <p
                        class="mt-5 max-w-3xl
                               text-base leading-8
                               text-slate-600
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
                        class="h-1 w-14 rounded-full
                               bg-[#075F9B]"
                    ></span>

                    <span
                        class="h-1 w-7 rounded-full
                               bg-[#D7B33E]"
                    ></span>
                </div>
            </header>


            {{-- ================================================= --}}
            {{-- CONTENT --}}
            {{-- ================================================= --}}

            <div
                class="
                    mt-12 grid items-start gap-10
                    lg:mt-14 lg:gap-14

                    {{ $hasVision && $hasMissions
                        ? 'lg:grid-cols-12'
                        : 'mx-auto max-w-4xl grid-cols-1' }}
                "
            >
                {{-- ============================================= --}}
                {{-- VISI --}}
                {{-- ============================================= --}}

                @if ($hasVision)
                    <article
                        class="{{ $hasMissions
                            ? 'lg:col-span-5'
                            : '' }}
                               relative overflow-hidden
                               rounded-[1.75rem]
                               bg-gradient-to-br
                               from-[#052844]
                               via-[#073E69]
                               to-[#075F9B]
                               p-7 text-white
                               shadow-[0_24px_60px_rgba(7,55,99,0.22)]
                               sm:p-9"
                        data-aos="fade-right"
                    >
                        <div
                            class="absolute -right-20 -top-20
                                   h-56 w-56 rounded-full
                                   border border-white/10"
                            aria-hidden="true"
                        ></div>

                        <div
                            class="absolute -bottom-24 -left-24
                                   h-64 w-64 rounded-full
                                   bg-[#D7B33E]/10
                                   blur-3xl"
                            aria-hidden="true"
                        ></div>


                        <div class="relative">
                            <div
                                class="flex items-center
                                       justify-between gap-4"
                            >
                                <p
                                    class="text-[11px] font-bold
                                           uppercase
                                           tracking-[0.22em]
                                           text-[#F4D66E]"
                                >
                                    Visi Program Studi
                                </p>

                                <span
                                    class="flex h-10 w-10
                                           shrink-0 items-center
                                           justify-center
                                           rounded-xl
                                           border border-white/15
                                           bg-white/10
                                           text-[#F4D66E]"
                                >
                                    <i
                                        class="fa-solid fa-eye"
                                        aria-hidden="true"
                                    ></i>
                                </span>
                            </div>


                            @if (
                                trim(
                                    (string) (
                                        $vision->title
                                        ?? ''
                                    )
                                ) !== ''
                            )
                                <h3
                                    class="mt-7 text-xl
                                           font-bold leading-8
                                           text-white
                                           sm:text-2xl"
                                >
                                    {{ $vision->title }}
                                </h3>
                            @endif


                            <blockquote
                                class="mt-7 border-l-2
                                       border-[#F4D66E]
                                       pl-5 text-justify
                                       text-lg font-medium
                                       leading-9
                                       text-white/90
                                       sm:text-xl
                                       sm:leading-10"
                            >
                                {{ $vision->content }}
                            </blockquote>


                            <div
                                class="mt-9 h-px
                                       bg-white/15"
                                aria-hidden="true"
                            ></div>

                            <p
                                class="mt-5 text-sm
                                       leading-7
                                       text-blue-100/70"
                            >
                                Visi menjadi arah utama pengembangan
                                pendidikan, penelitian, dan kontribusi
                                Program Studi D-IV TMPP.
                            </p>
                        </div>
                    </article>
                @endif


                {{-- ============================================= --}}
                {{-- MISI --}}
                {{-- ============================================= --}}

                @if ($hasMissions)
                    <div
                        class="{{ $hasVision
                            ? 'lg:col-span-7'
                            : '' }}"
                        data-aos="fade-left"
                    >
                        <div
                            class="mb-7 flex items-end
                                   justify-between gap-5"
                        >
                            <div>
                                <p
                                    class="text-[11px] font-bold
                                           uppercase
                                           tracking-[0.22em]
                                           text-[#075F9B]"
                                >
                                    Misi Program Studi
                                </p>

                                <h3
                                    class="mt-2 text-2xl
                                           font-semibold
                                           tracking-tight
                                           text-slate-900
                                           sm:text-3xl"
                                >
                                    Komitmen Penyelenggaraan Pendidikan
                                </h3>
                            </div>

                            <span
                                class="hidden text-sm
                                       font-bold
                                       text-slate-400
                                       sm:block"
                            >
                                {{ $missions->count() }}
                                Misi
                            </span>
                        </div>


                        <div
                            class="overflow-hidden
                                   rounded-[1.75rem]
                                   border border-slate-200
                                   bg-white shadow-sm"
                        >
                            @foreach ($missions as $mission)
                                @php
                                    $missionTitle = trim(
                                        (string) (
                                            $mission->title
                                            ?? ''
                                        )
                                    );

                                    $missionContent = trim(
                                        (string) (
                                            $mission->content
                                            ?? ''
                                        )
                                    );
                                @endphp

                                <article
                                    class="group relative
                                           grid grid-cols-[46px_1fr]
                                           gap-4 px-5 py-6
                                           transition
                                           hover:bg-blue-50/50
                                           sm:grid-cols-[54px_1fr]
                                           sm:gap-5 sm:px-7
                                           {{ !$loop->last
                                                ? 'border-b border-slate-200'
                                                : '' }}"
                                    data-aos="fade-up"
                                    data-aos-delay="{{ min(
                                        $loop->index * 80,
                                        320
                                    ) }}"
                                >
                                    <div
                                        class="flex h-11 w-11
                                               items-center
                                               justify-center
                                               rounded-xl
                                               bg-blue-50
                                               text-sm font-extrabold
                                               text-[#075F9B]
                                               transition
                                               group-hover:bg-[#075F9B]
                                               group-hover:text-white
                                               sm:h-12 sm:w-12"
                                    >
                                        {{ str_pad(
                                            (string) $loop->iteration,
                                            2,
                                            '0',
                                            STR_PAD_LEFT
                                        ) }}
                                    </div>


                                    <div class="min-w-0">
                                        @if ($missionTitle !== '')
                                            <h4
                                                class="font-bold
                                                       leading-7
                                                       text-slate-900
                                                       sm:text-lg"
                                            >
                                                {{ $missionTitle }}
                                            </h4>
                                        @endif

                                        <p
                                            class="{{ $missionTitle !== ''
                                                ? 'mt-2'
                                                : '' }}
                                                   text-justify
                                                   text-sm leading-7
                                                   text-slate-600
                                                   sm:text-base
                                                   sm:leading-8"
                                        >
                                            {!! nl2br(
                                                e($missionContent)
                                            ) !!}
                                        </p>
                                    </div>


                                    <div
                                        class="absolute bottom-0
                                               left-0 h-0.5 w-0
                                               bg-[#D7B33E]
                                               transition-all
                                               duration-500
                                               group-hover:w-full"
                                        aria-hidden="true"
                                    ></div>
                                </article>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endif