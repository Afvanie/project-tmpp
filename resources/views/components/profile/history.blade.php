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
                    ->orderBy('sort_order');
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
                return trim((string) $item->content) !== '';
            })
            ->sortBy('sort_order')
            ->values()
        : collect();

    $timelines = $historySection
        ? $historySection->items
            ->where('item_group', 'timeline')
            ->filter(function ($item) {
                return trim((string) $item->title) !== ''
                    || trim((string) $item->content) !== '';
            })
            ->sortBy('sort_order')
            ->values()
        : collect();

    $historyDescription = trim(
        (string) ($historySection?->description ?? '')
    );

    /*
    |--------------------------------------------------------------------------
    | STATUS KONTEN
    |--------------------------------------------------------------------------
    |
    | Section hanya tampil jika pengelola sudah mengisi minimal:
    |
    | - Deskripsi section
    | - Paragraf sejarah
    | - Timeline perjalanan program studi
    |
    */

    $hasHistoryContent = $historySection
        && (
            $historyDescription !== ''
            || $paragraphs->isNotEmpty()
            || $timelines->isNotEmpty()
        );

    $hasParagraphs = $paragraphs->isNotEmpty();
    $hasTimelines = $timelines->isNotEmpty();
@endphp


@if ($hasHistoryContent)

    <section
        id="profile-history"
        class="relative overflow-hidden bg-slate-50 py-20 md:py-24"
    >
        {{-- ========================================================= --}}
        {{-- BACKGROUND DECORATION --}}
        {{-- ========================================================= --}}

        <div
            class="pointer-events-none absolute inset-0"
            aria-hidden="true"
        >
            <div
                class="absolute -left-40 top-10
                       h-[450px] w-[450px]
                       rounded-full bg-blue-200/30
                       blur-[140px]"
            ></div>

            <div
                class="absolute -right-40 bottom-10
                       h-[450px] w-[450px]
                       rounded-full bg-yellow-200/30
                       blur-[140px]"
            ></div>

            <div
                class="absolute inset-0 opacity-[0.025]
                       bg-[linear-gradient(to_right,#0f172a_1px,transparent_1px),linear-gradient(to_bottom,#0f172a_1px,transparent_1px)]
                       bg-[size:70px_70px]"
            ></div>
        </div>


        <div class="relative mx-auto max-w-7xl px-6">

            {{-- ===================================================== --}}
            {{-- HEADING --}}
            {{-- ===================================================== --}}

            <div
                class="mx-auto mb-14 max-w-4xl text-center md:mb-16"
                data-aos="fade-up"
            >
                <span
                    class="text-sm font-semibold uppercase
                           tracking-[5px] text-blue-700"
                >
                    {{ $historySection->subtitle
                        ?: 'Perjalanan Program Studi' }}
                </span>

                <h2
                    class="mt-4 text-3xl font-bold
                           leading-tight text-slate-800
                           sm:text-4xl md:text-5xl"
                >
                    {{ $historySection->title
                        ?: 'Sejarah Program Studi' }}
                </h2>

                <div
                    class="mx-auto mt-6 h-1 w-24
                           rounded-full bg-yellow-400"
                ></div>

                @if ($historyDescription !== '')
                    <p
                        class="mx-auto mt-6 max-w-3xl
                               leading-8 text-slate-600"
                    >
                        {{ $historyDescription }}
                    </p>
                @endif
            </div>


            {{-- ===================================================== --}}
            {{-- CONTENT --}}
            {{-- ===================================================== --}}

            <div
                class="
                    grid items-start gap-12 lg:gap-14

                    {{ $hasParagraphs && $hasTimelines
                        ? 'lg:grid-cols-2'
                        : 'mx-auto max-w-4xl grid-cols-1' }}
                "
            >
                {{-- ================================================= --}}
                {{-- PARAGRAF SEJARAH --}}
                {{-- ================================================= --}}

                @if ($hasParagraphs)
                    <div
                        class="space-y-7 text-justify
                               leading-9 text-slate-600"
                        data-aos="fade-right"
                    >
                        @foreach ($paragraphs as $paragraph)
                            <p>
                                {!! nl2br(e($paragraph->content)) !!}
                            </p>
                        @endforeach
                    </div>
                @endif


                {{-- ================================================= --}}
                {{-- TIMELINE --}}
                {{-- ================================================= --}}

                @if ($hasTimelines)
                    <div
                        class="relative"
                        data-aos="fade-left"
                    >
                        <div
                            class="absolute bottom-0 left-6 top-0
                                   w-1 rounded-full bg-blue-100"
                            aria-hidden="true"
                        ></div>

                        <div class="space-y-8">

                            @foreach ($timelines as $timeline)
                                <article class="relative pl-20">

                                    {{-- Number --}}
                                    <div
                                        class="absolute left-0 top-1
                                               flex h-12 w-12
                                               items-center justify-center
                                               rounded-full font-bold
                                               text-white shadow-lg
                                               {{ $loop->iteration % 2 === 0
                                                    ? 'bg-yellow-400 text-slate-900'
                                                    : 'bg-blue-700' }}"
                                    >
                                        {{ $loop->iteration }}
                                    </div>

                                    {{-- Card --}}
                                    <div
                                        class="rounded-2xl border
                                               border-slate-100 bg-white
                                               p-6 shadow-lg
                                               transition duration-300
                                               hover:-translate-y-1
                                               hover:shadow-xl"
                                    >
                                        @if (trim((string) $timeline->title) !== '')
                                            <h3
                                                class="text-xl font-bold
                                                       text-slate-800"
                                            >
                                                {{ $timeline->title }}
                                            </h3>
                                        @endif

                                        @if (trim((string) $timeline->content) !== '')
                                            <p
                                                class="{{ trim((string) $timeline->title) !== ''
                                                    ? 'mt-3'
                                                    : '' }}
                                                       leading-7 text-slate-600"
                                            >
                                                {!! nl2br(e($timeline->content)) !!}
                                            </p>
                                        @endif
                                    </div>

                                </article>
                            @endforeach

                        </div>
                    </div>
                @endif
            </div>

        </div>
    </section>

@endif