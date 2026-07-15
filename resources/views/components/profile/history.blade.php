@php
    /*
    |--------------------------------------------------------------------------
    | SEJARAH PROGRAM STUDI
    |--------------------------------------------------------------------------
    */

    $historySection = \App\Models\ProfileSection::query()
        ->with([
            'items' => function ($query) {
                $query
                    ->where('is_active', true)
                    ->orderBy('sort_order')
                    ->orderBy('id');
            },
        ])
        ->where('slug', 'history')
        ->where('is_active', true)
        ->first();


    /*
    |--------------------------------------------------------------------------
    | KELOMPOK KONTEN
    |--------------------------------------------------------------------------
    */

    $paragraphs = $historySection
        ? $historySection->items
            ->where('item_group', 'paragraph')
            ->filter(function ($item) {
                return trim(
                    (string) $item->content
                ) !== '';
            })
            ->sortBy('sort_order')
            ->values()
        : collect();

    $timelines = $historySection
        ? $historySection->items
            ->where('item_group', 'timeline')
            ->filter(function ($item) {
                return trim(
                    (string) $item->title
                ) !== ''
                    || trim(
                        (string) $item->content
                    ) !== '';
            })
            ->sortBy('sort_order')
            ->values()
        : collect();


    /*
    |--------------------------------------------------------------------------
    | STATUS SECTION
    |--------------------------------------------------------------------------
    */

    $historyDescription = trim(
        (string) (
            $historySection?->description
            ?? ''
        )
    );

    $hasParagraphs = $paragraphs->isNotEmpty();
    $hasTimelines = $timelines->isNotEmpty();

    $hasHistoryContent = $historySection
        && (
            $historyDescription !== ''
            || $hasParagraphs
            || $hasTimelines
        );
@endphp


@if ($hasHistoryContent)
    <section
        id="profile-history"
        class="relative overflow-hidden
               bg-white py-16
               md:py-20 lg:py-24"
    >
        {{-- ===================================================== --}}
        {{-- DEKORASI LATAR --}}
        {{-- ===================================================== --}}

        <div
            class="pointer-events-none absolute inset-0"
            aria-hidden="true"
        >
            <div
                class="absolute -left-40 top-8
                       h-96 w-96 rounded-full
                       bg-blue-100/45
                       blur-[130px]"
            ></div>

            <div
                class="absolute -right-40 bottom-0
                       h-96 w-96 rounded-full
                       bg-yellow-100/35
                       blur-[130px]"
            ></div>

            <div
                class="absolute right-8 top-12
                       hidden select-none
                       text-[110px] font-black
                       leading-none
                       text-slate-900/[0.025]
                       lg:block"
            >
                SEJARAH
            </div>
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
                        {{ trim(
                            (string) (
                                $historySection->subtitle
                                ?? ''
                            )
                        ) !== ''
                            ? $historySection->subtitle
                            : 'Perjalanan Program Studi' }}
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
                    {{ trim(
                        (string) (
                            $historySection->title
                            ?? ''
                        )
                    ) !== ''
                        ? $historySection->title
                        : 'Sejarah Program Studi' }}
                </h2>


                @if ($historyDescription !== '')
                    <p
                        class="mt-5 max-w-3xl
                               text-base leading-8
                               text-slate-600
                               sm:text-lg"
                    >
                        {{ $historyDescription }}
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
            </header>


            {{-- ================================================= --}}
            {{-- KONTEN --}}
            {{-- ================================================= --}}

            <div
                class="
                    mt-12 grid items-start gap-12
                    lg:mt-14 lg:gap-16

                    {{ $hasParagraphs && $hasTimelines
                        ? 'lg:grid-cols-12'
                        : 'mx-auto max-w-4xl grid-cols-1' }}
                "
            >
                {{-- ================================================= --}}
                {{-- NARASI SEJARAH --}}
                {{-- ================================================= --}}

                @if ($hasParagraphs)
                    <div
                        class="{{ $hasTimelines
                            ? 'lg:col-span-6'
                            : '' }}"
                        data-aos="fade-right"
                    >
                        <div
                            class="border-l-2
                                   border-[#D7B33E]
                                   pl-6 sm:pl-8"
                        >
                            <p
                                class="text-[10px] font-bold
                                       uppercase
                                       tracking-[0.2em]
                                       text-[#075F9B]"
                            >
                                Narasi Program Studi
                            </p>

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
                        </div>


                        <div
                            class="mt-8 flex items-start
                                   gap-4 rounded-2xl
                                   border border-blue-100
                                   bg-blue-50/60 p-5"
                        >
                            <span
                                class="flex h-10 w-10
                                       shrink-0 items-center
                                       justify-center
                                       rounded-xl
                                       bg-[#073763]
                                       text-[#F4D66E]"
                            >
                                <i
                                    class="fa-solid
                                           fa-building-columns"
                                    aria-hidden="true"
                                ></i>
                            </span>

                            <div>
                                <p
                                    class="text-sm font-bold
                                           text-slate-800"
                                >
                                    Program Studi D-IV TMPP
                                </p>

                                <p
                                    class="mt-1 text-sm
                                           leading-7
                                           text-slate-600"
                                >
                                    Jurusan Teknik Mesin,
                                    Politeknik Negeri Malang.
                                </p>
                            </div>
                        </div>
                    </div>
                @endif


                {{-- ================================================= --}}
                {{-- TIMELINE --}}
                {{-- ================================================= --}}

                @if ($hasTimelines)
                    <div
                        class="{{ $hasParagraphs
                            ? 'lg:col-span-6'
                            : '' }}"
                        data-aos="fade-left"
                    >
                        <div
                            class="mb-7 flex
                                   items-center
                                   justify-between gap-4"
                        >
                            <div>
                                <p
                                    class="text-[10px]
                                           font-bold uppercase
                                           tracking-[0.2em]
                                           text-[#075F9B]"
                                >
                                    Linimasa
                                </p>

                                <h3
                                    class="mt-2 text-xl
                                           font-bold
                                           text-slate-900
                                           sm:text-2xl"
                                >
                                    Perjalanan Program Studi
                                </h3>
                            </div>

                            <span
                                class="flex h-11 w-11
                                       shrink-0 items-center
                                       justify-center
                                       rounded-xl
                                       bg-yellow-50
                                       text-yellow-700"
                            >
                                <i
                                    class="fa-solid
                                           fa-timeline"
                                    aria-hidden="true"
                                ></i>
                            </span>
                        </div>


                        <div class="relative">
                            <div
                                class="absolute bottom-4
                                       left-[19px] top-4
                                       w-px bg-slate-200"
                                aria-hidden="true"
                            ></div>


                            <div class="space-y-7">
                                @foreach ($timelines as $timeline)
                                    @php
                                        $timelineTitle = trim(
                                            (string) (
                                                $timeline->title
                                                ?? ''
                                            )
                                        );

                                        $timelineContent = trim(
                                            (string) (
                                                $timeline->content
                                                ?? ''
                                            )
                                        );
                                    @endphp

                                    <article
                                        class="group relative
                                               grid grid-cols-[40px_1fr]
                                               gap-5"
                                        data-aos="fade-up"
                                        data-aos-delay="{{ min(
                                            $loop->index * 80,
                                            320
                                        ) }}"
                                    >
                                        {{-- Titik Timeline --}}
                                        <div
                                            class="relative z-10
                                                   flex h-10 w-10
                                                   items-center
                                                   justify-center
                                                   rounded-full
                                                   border-4
                                                   border-white
                                                   bg-[#075F9B]
                                                   text-xs font-bold
                                                   text-white
                                                   shadow-md
                                                   transition
                                                   duration-300
                                                   group-hover:bg-[#D7B33E]
                                                   group-hover:text-slate-900"
                                        >
                                            {{ $loop->iteration }}
                                        </div>


                                        {{-- Isi --}}
                                        <div
                                            class="border-b
                                                   border-slate-200
                                                   pb-7"
                                        >
                                            @if ($timelineTitle !== '')
                                                <h4
                                                    class="text-lg
                                                           font-bold
                                                           leading-7
                                                           text-slate-900"
                                                >
                                                    {{ $timelineTitle }}
                                                </h4>
                                            @endif

                                            @if ($timelineContent !== '')
                                                <p
                                                    class="{{ $timelineTitle !== ''
                                                        ? 'mt-2'
                                                        : '' }}
                                                           text-justify
                                                           text-sm
                                                           leading-7
                                                           text-slate-600
                                                           sm:text-base
                                                           sm:leading-8"
                                                >
                                                    {!! nl2br(
                                                        e($timelineContent)
                                                    ) !!}
                                                </p>
                                            @endif
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endif