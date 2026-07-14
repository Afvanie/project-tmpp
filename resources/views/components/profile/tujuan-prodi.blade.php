@php
    /*
    |--------------------------------------------------------------------------
    | TUJUAN PROGRAM STUDI
    |--------------------------------------------------------------------------
    |
    | Section hanya ditampilkan apabila terdapat minimal satu tujuan
    | aktif dan memiliki isi.
    |
    */

    $items = isset($section) && $section
        ? collect($section->items ?? [])
            ->filter(function ($item) {
                return (bool) $item->is_active
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
@endphp


@if ($hasContent)

    <section
        id="program-goals"
        class="relative overflow-hidden bg-white py-20 md:py-24"
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
                       rounded-full bg-blue-300/20
                       blur-[150px]"
            ></div>

            {{-- Blur Kuning --}}
            <div
                class="absolute -right-40 bottom-20
                       h-[520px] w-[520px]
                       rounded-full bg-yellow-300/20
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

            {{-- Logo Polinema Watermark --}}
            <img
                src="{{ asset('assets/images/logo.png') }}"
                alt=""
                class="absolute -left-28 top-1/2
                       w-[360px] -translate-y-1/2
                       select-none grayscale opacity-[0.04]
                       md:w-[520px]"
            >

            {{-- Watermark Text --}}
            <div
                class="absolute bottom-10 right-8
                       select-none text-right
                       text-[64px] font-black leading-none
                       text-blue-900/[0.035]
                       md:text-[120px]"
            >
                D-IV<br>TMPP
            </div>

            {{-- Abstract Circle --}}
            <div
                class="absolute right-20 top-20
                       h-44 w-44 rounded-full
                       border-[18px]
                       border-yellow-500/[0.08]"
            ></div>

            <div
                class="absolute bottom-24 left-1/3
                       h-64 w-64 rounded-full
                       border-[24px]
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
                        ?: 'Sasaran Penyelenggaraan Pendidikan' }}
                </span>

                <h2
                    class="mt-4 text-3xl font-bold
                           leading-tight text-slate-800
                           sm:text-4xl md:text-5xl"
                >
                    {{ $section->title
                        ?: 'Tujuan Program Studi' }}
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
            {{-- DAFTAR TUJUAN --}}
            {{-- ================================================= --}}

            <div
                class="grid gap-6 md:grid-cols-2"
            >
                @foreach ($items as $item)

                    <article
                        class="group relative overflow-hidden
                               rounded-3xl border
                               border-slate-100 bg-white/90
                               p-6 shadow-lg backdrop-blur
                               transition-all duration-500
                               hover:-translate-y-2
                               hover:shadow-2xl
                               sm:p-7"
                        data-aos="fade-up"
                        data-aos-delay="{{ min($loop->index * 100, 400) }}"
                    >
                        {{-- Ornamen Kartu --}}
                        <div
                            class="absolute right-0 top-0
                                   h-24 w-24 rounded-bl-full
                                   bg-blue-100/60
                                   transition duration-300
                                   group-hover:bg-yellow-100"
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
                                       text-lg font-bold text-white
                                       shadow-md transition
                                       duration-300
                                       group-hover:bg-yellow-400
                                       group-hover:text-slate-900"
                            >
                                {{ $loop->iteration }}
                            </div>

                            {{-- Konten --}}
                            <div class="min-w-0">

                                @if (trim((string) $item->title) !== '')
                                    <h3
                                        class="mb-3 text-lg
                                               font-bold text-slate-800"
                                    >
                                        {{ $item->title }}
                                    </h3>
                                @endif

                                <p
                                    class="text-justify
                                           leading-8 text-slate-600"
                                >
                                    {!! nl2br(e($item->content)) !!}
                                </p>
                            </div>
                        </div>
                    </article>

                @endforeach
            </div>
        </div>
    </section>

@endif