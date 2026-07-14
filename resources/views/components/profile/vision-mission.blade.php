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
        : collect();

    /*
    |--------------------------------------------------------------------------
    | VISI
    |--------------------------------------------------------------------------
    |
    | Mendukung item_group:
    |
    | - visi
    | - vision
    |
    */

    $visi = $items
        ->whereIn('item_group', ['visi', 'vision'])
        ->filter(function ($item) {
            return trim((string) $item->content) !== '';
        })
        ->sortBy('sort_order')
        ->first();

    /*
    |--------------------------------------------------------------------------
    | MISI
    |--------------------------------------------------------------------------
    |
    | Mendukung item_group:
    |
    | - misi
    | - mission
    |
    */

    $misi = $items
        ->whereIn('item_group', ['misi', 'mission'])
        ->filter(function ($item) {
            return trim((string) $item->content) !== '';
        })
        ->sortBy('sort_order')
        ->values();

    /*
    |--------------------------------------------------------------------------
    | STATUS KONTEN
    |--------------------------------------------------------------------------
    */

    $hasVisi = (bool) $visi;
    $hasMisi = $misi->isNotEmpty();
    $hasContent = isset($section)
        && $section
        && ($hasVisi || $hasMisi);

    $sectionDescription = isset($section)
        ? trim((string) ($section->description ?? ''))
        : '';
@endphp


@if ($hasContent)

    <section
        id="vision-mission"
        class="relative overflow-hidden bg-slate-50 py-20 md:py-24"
    >
        {{-- ===================================================== --}}
        {{-- ORNAMEN BACKGROUND --}}
        {{-- ===================================================== --}}

        <div
            class="pointer-events-none absolute inset-0"
            aria-hidden="true"
        >
            {{-- Blur Biru --}}
            <div
                class="absolute -left-40 top-20
                       h-[520px] w-[520px]
                       rounded-full bg-blue-300/25
                       blur-[150px]"
            ></div>

            {{-- Blur Kuning --}}
            <div
                class="absolute -right-40 bottom-20
                       h-[520px] w-[520px]
                       rounded-full bg-yellow-300/25
                       blur-[150px]"
            ></div>

            {{-- Grid Halus --}}
            <div
                class="absolute inset-0 opacity-[0.04]"
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

            {{-- Watermark --}}
            <div
                class="absolute right-10 top-20
                       select-none text-[100px]
                       font-black leading-none
                       text-blue-900/[0.035]
                       md:text-[180px]"
            >
                POLINEMA
            </div>

            {{-- Logo Besar --}}
            <img
                src="{{ asset('assets/images/logo.png') }}"
                alt=""
                class="absolute -right-24 top-1/2
                       w-[360px] -translate-y-1/2
                       select-none grayscale
                       opacity-[0.045]
                       md:w-[520px]"
            >

            {{-- Logo Kecil --}}
            <img
                src="{{ asset('assets/images/logo.png') }}"
                alt=""
                class="absolute bottom-14 left-10
                       w-28 select-none grayscale
                       opacity-[0.06]
                       md:w-36"
            >

            {{-- Lingkaran Abstrak --}}
            <div
                class="absolute bottom-16 left-10
                       h-72 w-72 rounded-full
                       border-[30px]
                       border-blue-700/[0.04]"
            ></div>
        </div>


        <div
            class="relative z-10 mx-auto
                   max-w-7xl px-6"
        >
            {{-- ================================================= --}}
            {{-- HEADING --}}
            {{-- ================================================= --}}

            <div
                class="mx-auto mb-14 max-w-4xl
                       text-center md:mb-16"
                data-aos="fade-up"
            >
                <span
                    class="text-sm font-semibold uppercase
                           tracking-[5px] text-blue-700"
                >
                    {{ $section->subtitle
                        ?: 'Arah Pengembangan Program Studi' }}
                </span>

                <h2
                    class="mt-4 text-3xl font-bold
                           leading-tight text-slate-800
                           sm:text-4xl md:text-5xl"
                >
                    {{ $section->title ?: 'Visi dan Misi' }}
                </h2>

                <div
                    class="mx-auto mt-6 h-1 w-24
                           rounded-full bg-yellow-400"
                ></div>

                @if ($sectionDescription !== '')
                    <p
                        class="mx-auto mt-6 max-w-3xl
                               leading-8 text-slate-600"
                    >
                        {{ $sectionDescription }}
                    </p>
                @endif
            </div>


            {{-- ================================================= --}}
            {{-- CONTENT --}}
            {{-- ================================================= --}}

            <div
                class="
                    grid items-start gap-8 lg:gap-10

                    {{ $hasVisi && $hasMisi
                        ? 'lg:grid-cols-2'
                        : 'mx-auto max-w-4xl grid-cols-1' }}
                "
            >
                {{-- ================================================= --}}
                {{-- VISI --}}
                {{-- ================================================= --}}

                @if ($hasVisi)
                    <article
                        class="relative overflow-hidden
                               rounded-[2rem]
                               bg-gradient-to-br
                               from-blue-800 via-blue-700
                               to-blue-900
                               p-7 text-white shadow-2xl
                               sm:p-8 md:p-10"
                        data-aos="fade-right"
                    >
                        {{-- Ornamen Kartu --}}
                        <div
                            class="absolute -right-20 -top-20
                                   h-64 w-64 rounded-full
                                   bg-white/10 blur-2xl"
                            aria-hidden="true"
                        ></div>

                        <div
                            class="absolute -bottom-24 -left-24
                                   h-72 w-72 rounded-full
                                   bg-yellow-400/20 blur-3xl"
                            aria-hidden="true"
                        ></div>

                        <div class="relative">
                            <span
                                class="mb-6 inline-flex items-center
                                       rounded-full border
                                       border-white/20 bg-white/15
                                       px-4 py-1.5 text-sm
                                       font-semibold text-yellow-300"
                            >
                                Visi Program Studi
                            </span>

                            @if (trim((string) $visi->title) !== '')
                                <h3
                                    class="mb-6 text-2xl
                                           font-bold md:text-3xl"
                                >
                                    {{ $visi->title }}
                                </h3>
                            @endif

                            <blockquote
                                class="border-l-4 border-yellow-400
                                       pl-5 text-justify
                                       text-base leading-8
                                       text-blue-50
                                       sm:text-lg sm:leading-9"
                            >
                                {{ $visi->content }}
                            </blockquote>

                            <div
                                class="mt-8 flex flex-wrap gap-3"
                            >
                                <span
                                    class="rounded-xl border
                                           border-white/15
                                           bg-white/10 px-4 py-2
                                           text-sm font-semibold"
                                >
                                    Autonomous Maintenance
                                </span>

                                <span
                                    class="rounded-xl border
                                           border-white/15
                                           bg-white/10 px-4 py-2
                                           text-sm font-semibold"
                                >
                                    Persaingan Global 2030
                                </span>
                            </div>
                        </div>
                    </article>
                @endif


                {{-- ================================================= --}}
                {{-- MISI --}}
                {{-- ================================================= --}}

                @if ($hasMisi)
                    <article
                        class="relative overflow-hidden
                               rounded-[2rem] border
                               border-slate-100 bg-white/90
                               p-7 shadow-2xl
                               backdrop-blur
                               sm:p-8 md:p-10"
                        data-aos="fade-left"
                    >
                        {{-- Ornamen Kartu --}}
                        <div
                            class="absolute right-0 top-0
                                   h-32 w-32 rounded-bl-full
                                   bg-yellow-300/20"
                            aria-hidden="true"
                        ></div>

                        <div
                            class="absolute bottom-0 left-0
                                   h-32 w-32 rounded-tr-full
                                   bg-blue-300/10"
                            aria-hidden="true"
                        ></div>

                        <div class="relative">
                            <span
                                class="mb-6 inline-flex items-center
                                       rounded-full bg-yellow-100
                                       px-4 py-1.5 text-sm
                                       font-semibold text-yellow-700"
                            >
                                Misi Program Studi
                            </span>

                            <h3
                                class="mb-8 text-2xl font-bold
                                       leading-tight text-slate-800
                                       md:text-3xl"
                            >
                                Komitmen dalam Penyelenggaraan Pendidikan
                            </h3>

                            <div class="space-y-7">
                                @foreach ($misi as $item)
                                    <div
                                        class="group flex items-start gap-4"
                                    >
                                        <div
                                            class="flex h-11 w-11
                                                   shrink-0 items-center
                                                   justify-center rounded-2xl
                                                   bg-blue-700 font-bold
                                                   text-white shadow-md
                                                   transition duration-300
                                                   group-hover:bg-yellow-400
                                                   group-hover:text-slate-900"
                                        >
                                            {{ $loop->iteration }}
                                        </div>

                                        <div class="min-w-0">
                                            @if (trim((string) $item->title) !== '')
                                                <h4
                                                    class="mb-2 font-bold
                                                           text-slate-800"
                                                >
                                                    {{ $item->title }}
                                                </h4>
                                            @endif

                                            <p
                                                class="text-justify
                                                       leading-8
                                                       text-slate-600"
                                            >
                                                {{ $item->content }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </article>
                @endif
            </div>

        </div>
    </section>

@endif