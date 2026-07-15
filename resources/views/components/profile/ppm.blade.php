@php
    /*
    |--------------------------------------------------------------------------
    | PROFIL PROFESIONAL MANDIRI
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
                    ) === 'ppm'
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
        'fa-user-tie',
        'fa-industry',
        'fa-gears',
        'fa-screwdriver-wrench',
        'fa-chart-line',
        'fa-people-group',
    ];
@endphp


@if ($hasContent)
    <section
        id="professional-profile"
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
                class="absolute -left-48 bottom-0
                       h-[420px] w-[420px]
                       rounded-full
                       bg-blue-100/40
                       blur-[140px]"
            ></div>

            <div
                class="absolute -right-48 top-0
                       h-[420px] w-[420px]
                       rounded-full
                       bg-yellow-100/35
                       blur-[140px]"
            ></div>
        </div>


        <div
            class="relative mx-auto
                   max-w-7xl px-6"
        >
            <div
                class="grid items-start gap-12
                       lg:grid-cols-12
                       lg:gap-16"
            >
                {{-- ================================================= --}}
                {{-- INFORMASI UTAMA --}}
                {{-- ================================================= --}}

                <div
                    class="lg:col-span-4"
                    data-aos="fade-right"
                >
                    <div
                        class="lg:sticky lg:top-28"
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
                                    : 'Karakter Profesional Lulusan' }}
                            </p>
                        </div>


                        <h2
                            class="mt-5 text-3xl
                                   font-semibold leading-tight
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
                            {{ $sectionTitle !== ''
                                ? $sectionTitle
                                : 'Profil Profesional Mandiri' }}
                        </h2>


                        @if ($sectionDescription !== '')
                            <p
                                class="mt-6 text-base
                                       leading-8
                                       text-slate-600"
                            >
                                {{ $sectionDescription }}
                            </p>
                        @endif


                        <div
                            class="mt-7 flex items-center gap-3"
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


                        {{-- Jumlah PPM --}}
                        <div
                            class="mt-9 flex items-center
                                   gap-5 border-t
                                   border-slate-200 pt-7"
                        >
                            <span
                                class="text-5xl font-bold
                                       tracking-[-0.04em]
                                       text-[#075F9B]"
                            >
                                {{ str_pad(
                                    (string) $items->count(),
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
                                    Profil Profesional
                                </p>

                                <p
                                    class="mt-1 text-sm
                                           text-slate-500"
                                >
                                    Dikelola melalui admin
                                </p>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- ================================================= --}}
                {{-- DAFTAR PPM --}}
                {{-- ================================================= --}}

                <div
                    class="lg:col-span-8"
                    data-aos="fade-left"
                >
                    <div
                        class="overflow-hidden
                               rounded-[1.75rem]
                               border border-slate-200
                               bg-[#F8FAFC]"
                    >
                        @foreach ($items as $item)
                            @php
                                $itemTitle = trim(
                                    (string) (
                                        $item->title
                                        ?? ''
                                    )
                                );

                                $itemContent = trim(
                                    (string) (
                                        $item->content
                                        ?? ''
                                    )
                                );

                                $icon = $icons[
                                    $loop->index
                                    % count($icons)
                                ];
                            @endphp


                            <article
                                class="group relative
                                       px-5 py-7
                                       transition duration-300
                                       hover:bg-white
                                       sm:px-8 sm:py-8
                                       {{ !$loop->last
                                            ? 'border-b border-slate-200'
                                            : '' }}"
                                data-aos="fade-up"
                                data-aos-delay="{{ min(
                                    $loop->index * 90,
                                    270
                                ) }}"
                            >
                                <div
                                    class="grid
                                           grid-cols-[48px_1fr]
                                           gap-4
                                           sm:grid-cols-[60px_1fr]
                                           sm:gap-6"
                                >
                                    {{-- Ikon --}}
                                    <div>
                                        <span
                                            class="flex h-12 w-12
                                                   items-center
                                                   justify-center
                                                   rounded-2xl
                                                   border
                                                   border-blue-100
                                                   bg-white
                                                   text-[#075F9B]
                                                   shadow-sm
                                                   transition
                                                   duration-300
                                                   group-hover:border-[#075F9B]
                                                   group-hover:bg-[#075F9B]
                                                   group-hover:text-white
                                                   sm:h-14 sm:w-14"
                                        >
                                            <i
                                                class="fa-solid {{ $icon }}"
                                                aria-hidden="true"
                                            ></i>
                                        </span>
                                    </div>


                                    {{-- Isi --}}
                                    <div class="min-w-0">
                                        <div
                                            class="flex flex-wrap
                                                   items-center gap-3"
                                        >
                                            <span
                                                class="text-[10px]
                                                       font-bold uppercase
                                                       tracking-[0.2em]
                                                       text-[#075F9B]"
                                            >
                                                PPM
                                                {{ str_pad(
                                                    (string) $loop->iteration,
                                                    2,
                                                    '0',
                                                    STR_PAD_LEFT
                                                ) }}
                                            </span>

                                            <span
                                                class="h-px w-8
                                                       bg-[#D7B33E]"
                                                aria-hidden="true"
                                            ></span>
                                        </div>


                                        @if ($itemTitle !== '')
                                            <h3
                                                class="mt-3 text-lg
                                                       font-bold
                                                       leading-7
                                                       text-slate-900
                                                       sm:text-xl"
                                            >
                                                {{ $itemTitle }}
                                            </h3>
                                        @endif


                                        <p
                                            class="{{ $itemTitle !== ''
                                                ? 'mt-3'
                                                : 'mt-2' }}
                                                   text-justify
                                                   text-sm leading-7
                                                   text-slate-600
                                                   sm:text-base
                                                   sm:leading-8"
                                        >
                                            {!! nl2br(
                                                e($itemContent)
                                            ) !!}
                                        </p>
                                    </div>
                                </div>


                                {{-- Nomor dekoratif --}}
                                <span
                                    class="pointer-events-none
                                           absolute right-5 top-5
                                           text-4xl font-black
                                           leading-none
                                           text-slate-900/[0.035]
                                           sm:right-8 sm:top-7
                                           sm:text-5xl"
                                    aria-hidden="true"
                                >
                                    {{ str_pad(
                                        (string) $loop->iteration,
                                        2,
                                        '0',
                                        STR_PAD_LEFT
                                    ) }}
                                </span>


                                {{-- Garis hover --}}
                                <div
                                    class="absolute bottom-0
                                           left-0 h-0.5
                                           w-0 bg-[#D7B33E]
                                           transition-all
                                           duration-500
                                           group-hover:w-full"
                                    aria-hidden="true"
                                ></div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif