@php
    /*
    |--------------------------------------------------------------------------
    | CAPAIAN PEMBELAJARAN LULUSAN
    |--------------------------------------------------------------------------
    |
    | Hanya menampilkan item CPL yang:
    |
    | - Aktif
    | - Memiliki isi
    | - Memiliki item_group "cpl"
    |
    */

    $items = isset($section) && $section
        ? collect($section->items ?? [])
            ->filter(function ($item) {
                return (bool) $item->is_active
                    && $item->item_group === 'cpl'
                    && trim((string) $item->content) !== '';
            })
            ->sortBy('sort_order')
            ->values()
        : collect();

    $hasContent = isset($section)
        && $section
        && $items->isNotEmpty();

    $sectionDescription = isset($section)
        ? trim((string) ($section->description ?? ''))
        : '';

    $isOddItemCount = $items->count() % 2 !== 0;
@endphp


@if ($hasContent)

    <section
        id="graduate-learning-outcomes"
        class="relative overflow-hidden bg-slate-50 py-20 md:py-24"
    >
        {{-- ===================================================== --}}
        {{-- BACKGROUND DECORATION --}}
        {{-- ===================================================== --}}

        <div
            class="pointer-events-none absolute inset-0"
            aria-hidden="true"
        >
            {{-- Blur Biru --}}
            <div
                class="absolute -left-40 top-16
                       h-[520px] w-[520px]
                       rounded-full bg-blue-200/30
                       blur-[150px]"
            ></div>

            {{-- Blur Kuning --}}
            <div
                class="absolute -right-40 bottom-10
                       h-[520px] w-[520px]
                       rounded-full bg-yellow-200/30
                       blur-[150px]"
            ></div>

            {{-- Grid Halus --}}
            <div
                class="absolute inset-0 opacity-[0.035]"
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
                class="absolute right-8 top-14
                       select-none text-[90px]
                       font-black leading-none
                       text-blue-900/[0.025]
                       md:text-[170px]"
            >
                CPL
            </div>

            {{-- Logo Polinema --}}
            <img
                src="{{ asset('assets/images/logo.png') }}"
                alt=""
                class="absolute -bottom-20 -left-20
                       w-[360px] select-none
                       grayscale opacity-[0.035]
                       md:w-[500px]"
            >

            {{-- Lingkaran Dekoratif --}}
            <div
                class="absolute bottom-20 right-16
                       h-64 w-64 rounded-full
                       border-[26px]
                       border-yellow-500/[0.05]"
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
                        ?: 'Kompetensi Sarjana Terapan TMPP' }}
                </span>

                <h2
                    class="mt-4 text-3xl font-bold
                           leading-tight text-slate-800
                           sm:text-4xl md:text-5xl"
                >
                    {{ $section->title
                        ?: 'Capaian Pembelajaran Lulusan' }}
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

                <div
                    class="mx-auto mt-7 inline-flex
                           items-center gap-3 rounded-2xl
                           border border-blue-100
                           bg-white px-5 py-3
                           text-sm font-semibold
                           text-slate-700 shadow-sm"
                >
                    <span
                        class="flex h-8 w-8 items-center
                               justify-center rounded-xl
                               bg-blue-700 font-bold
                               text-white"
                    >
                        {{ $items->count() }}
                    </span>

                    Capaian Pembelajaran Lulusan
                </div>
            </div>


            {{-- ================================================= --}}
            {{-- DAFTAR CPL --}}
            {{-- ================================================= --}}

            <div class="grid gap-6 lg:grid-cols-2">

                @foreach ($items as $item)

                    @php
                        $isLastOddItem = $isOddItemCount
                            && $loop->last;
                    @endphp

                    <article
                        class="group relative overflow-hidden
                               rounded-3xl border
                               border-slate-100 bg-white
                               p-6 shadow-lg
                               transition-all duration-500
                               hover:-translate-y-1
                               hover:border-blue-100
                               hover:shadow-2xl
                               sm:p-7
                               {{ $isLastOddItem
                                    ? 'lg:col-span-2 lg:mx-auto lg:w-full lg:max-w-3xl'
                                    : '' }}"
                        data-aos="fade-up"
                        data-aos-delay="{{ min($loop->index * 70, 350) }}"
                    >
                        {{-- Ornamen Kartu --}}
                        <div
                            class="absolute right-0 top-0
                                   h-28 w-28 rounded-bl-full
                                   bg-blue-50
                                   transition duration-500
                                   group-hover:bg-yellow-100"
                            aria-hidden="true"
                        ></div>

                        <div
                            class="absolute -bottom-14 -left-14
                                   h-36 w-36 rounded-full
                                   bg-blue-100/40 blur-2xl"
                            aria-hidden="true"
                        ></div>


                        <div
                            class="relative flex
                                   items-start gap-4 sm:gap-5"
                        >
                            {{-- Nomor --}}
                            <div
                                class="flex h-12 w-12 shrink-0
                                       items-center justify-center
                                       rounded-2xl bg-blue-700
                                       text-lg font-black text-white
                                       shadow-md transition
                                       duration-300
                                       group-hover:bg-yellow-400
                                       group-hover:text-slate-900
                                       sm:h-14 sm:w-14"
                            >
                                {{ $loop->iteration }}
                            </div>


                            {{-- Konten --}}
                            <div class="min-w-0 flex-1">

                                @if (trim((string) $item->title) !== '')
                                    <h3
                                        class="text-lg font-bold
                                               leading-7 text-slate-800
                                               sm:text-xl"
                                    >
                                        {{ $item->title }}
                                    </h3>
                                @endif

                                <p
                                    class="{{ trim((string) $item->title) !== ''
                                        ? 'mt-3'
                                        : '' }}
                                           text-justify leading-8
                                           text-slate-600"
                                >
                                    {!! nl2br(e($item->content)) !!}
                                </p>

                                <div
                                    class="mt-6 h-1 w-14
                                           rounded-full bg-yellow-400
                                           transition-all duration-300
                                           group-hover:w-24"
                                ></div>
                            </div>
                        </div>
                    </article>

                @endforeach

            </div>


            {{-- ================================================= --}}
            {{-- INFORMASI PENDUKUNG --}}
            {{-- ================================================= --}}

            <div
                class="mt-12 grid gap-5
                       md:grid-cols-3"
                data-aos="fade-up"
            >
                <div
                    class="rounded-2xl border
                           border-blue-100 bg-blue-50
                           p-5 text-center"
                >
                    <p
                        class="text-xs font-bold uppercase
                               tracking-wider text-blue-700"
                    >
                        Jenjang
                    </p>

                    <p
                        class="mt-2 font-semibold
                               text-slate-800"
                    >
                        Sarjana Terapan
                    </p>
                </div>

                <div
                    class="rounded-2xl border
                           border-yellow-100 bg-yellow-50
                           p-5 text-center"
                >
                    <p
                        class="text-xs font-bold uppercase
                               tracking-wider text-yellow-700"
                    >
                        Kerangka Kualifikasi
                    </p>

                    <p
                        class="mt-2 font-semibold
                               text-slate-800"
                    >
                        KKNI Level 6
                    </p>
                </div>

                <div
                    class="rounded-2xl border
                           border-slate-200 bg-white
                           p-5 text-center"
                >
                    <p
                        class="text-xs font-bold uppercase
                               tracking-wider text-slate-500"
                    >
                        Pendekatan
                    </p>

                    <p
                        class="mt-2 font-semibold
                               text-slate-800"
                    >
                        Outcome-Based Education
                    </p>
                </div>
            </div>

        </div>
    </section>

@endif