@php
    /*
    |--------------------------------------------------------------------------
    | TUJUAN PROGRAM STUDI
    |--------------------------------------------------------------------------
    |
    | Section tetap menggunakan data dinamis dari admin.
    |
    | Item yang didukung:
    | - tujuan
    | - goal
    | - goals
    |
    | Section otomatis tidak ditampilkan apabila belum memiliki
    | minimal satu item aktif dengan isi.
    |
    */

    $items = isset($section) && $section
        ? collect($section->items ?? [])
            ->filter(function ($item) {
                $itemGroup = strtolower(
                    trim(
                        (string) (
                            $item->item_group
                            ?? ''
                        )
                    )
                );

                return (bool) (
                    $item->is_active
                    ?? false
                )
                    && in_array(
                        $itemGroup,
                        [
                            'tujuan',
                            'goal',
                            'goals',
                        ],
                        true
                    )
                    && trim(
                        (string) (
                            $item->content
                            ?? ''
                        )
                    ) !== '';
            })
            ->sortBy('sort_order')
            ->values()
        : collect();


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
    | INFORMASI SECTION
    |--------------------------------------------------------------------------
    */

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
        id="program-goals"
        class="relative overflow-hidden
               bg-[#F6F8FB] py-16
               md:py-20 lg:py-24"
    >
        {{-- ===================================================== --}}
        {{-- DEKORASI LATAR RINGAN --}}
        {{-- ===================================================== --}}

        <div
            class="pointer-events-none absolute inset-0"
            aria-hidden="true"
        >
            <div
                class="absolute -left-40 top-0
                       h-96 w-96 rounded-full
                       bg-blue-100/50
                       blur-[130px]"
            ></div>

            <div
                class="absolute -right-40 bottom-0
                       h-96 w-96 rounded-full
                       bg-yellow-100/40
                       blur-[130px]"
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
                {{-- INFORMASI SECTION --}}
                {{-- ================================================= --}}

                <div
                    class="lg:col-span-4"
                    data-aos="fade-right"
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
                                : 'Sasaran Penyelenggaraan Pendidikan' }}
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
                            : 'Tujuan Program Studi' }}
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


                    {{-- Jumlah tujuan --}}
                    <div
                        class="mt-9 border-t
                               border-slate-200 pt-6"
                    >
                        <div
                            class="flex items-end gap-3"
                        >
                            <span
                                class="text-4xl font-bold
                                       tracking-tight
                                       text-[#075F9B]"
                            >
                                {{ str_pad(
                                    (string) $items->count(),
                                    2,
                                    '0',
                                    STR_PAD_LEFT
                                ) }}
                            </span>

                            <span
                                class="pb-1 text-xs
                                       font-bold uppercase
                                       tracking-[0.16em]
                                       text-slate-400"
                            >
                                Tujuan Program Studi
                            </span>
                        </div>

                        <p
                            class="mt-3 max-w-sm
                                   text-sm leading-7
                                   text-slate-500"
                        >
                            Seluruh informasi pada bagian ini
                            dikelola melalui halaman admin dan
                            ditampilkan sesuai urutan yang ditentukan.
                        </p>
                    </div>
                </div>


                {{-- ================================================= --}}
                {{-- DAFTAR TUJUAN --}}
                {{-- ================================================= --}}

                <div
                    class="lg:col-span-8"
                    data-aos="fade-left"
                >
                    <div
                        class="overflow-hidden
                               rounded-[1.75rem]
                               border border-slate-200
                               bg-white
                               shadow-[0_18px_50px_rgba(15,23,42,0.07)]"
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
                            @endphp


                            <article
                                class="group relative
                                       grid grid-cols-[48px_1fr]
                                       gap-4 px-5 py-7
                                       transition duration-300
                                       hover:bg-blue-50/45
                                       sm:grid-cols-[64px_1fr]
                                       sm:gap-6
                                       sm:px-8 sm:py-8
                                       {{ !$loop->last
                                            ? 'border-b border-slate-200'
                                            : '' }}"
                                data-aos="fade-up"
                                data-aos-delay="{{ min(
                                    $loop->index * 80,
                                    320
                                ) }}"
                            >
                                {{-- Nomor --}}
                                <div
                                    class="relative flex
                                           justify-center"
                                >
                                    <span
                                        class="flex h-12 w-12
                                               items-center
                                               justify-center
                                               rounded-2xl
                                               border
                                               border-blue-100
                                               bg-blue-50
                                               text-sm font-extrabold
                                               text-[#075F9B]
                                               transition
                                               duration-300
                                               group-hover:border-[#075F9B]
                                               group-hover:bg-[#075F9B]
                                               group-hover:text-white
                                               sm:h-14 sm:w-14"
                                    >
                                        {{ str_pad(
                                            (string) $loop->iteration,
                                            2,
                                            '0',
                                            STR_PAD_LEFT
                                        ) }}
                                    </span>
                                </div>


                                {{-- Konten --}}
                                <div class="min-w-0">
                                    <div
                                        class="flex flex-wrap
                                               items-center gap-3"
                                    >
                                        <span
                                            class="text-[10px]
                                                   font-bold uppercase
                                                   tracking-[0.18em]
                                                   text-[#075F9B]"
                                        >
                                            Sasaran
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