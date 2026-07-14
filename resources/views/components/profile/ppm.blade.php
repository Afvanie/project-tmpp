@php
    /*
    |--------------------------------------------------------------------------
    | PROFIL PROFESIONAL MANDIRI
    |--------------------------------------------------------------------------
    |
    | Hanya item aktif dan memiliki isi yang ditampilkan.
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
        id="professional-profile"
        class="relative overflow-hidden bg-white py-20 md:py-24"
    >
        {{-- ===================================================== --}}
        {{-- BACKGROUND DECORATION --}}
        {{-- ===================================================== --}}

        <div
            class="pointer-events-none absolute inset-0"
            aria-hidden="true"
        >
            <div
                class="absolute -left-40 top-20
                       h-[500px] w-[500px]
                       rounded-full bg-blue-200/25
                       blur-[150px]"
            ></div>

            <div
                class="absolute -right-40 bottom-10
                       h-[500px] w-[500px]
                       rounded-full bg-yellow-200/25
                       blur-[150px]"
            ></div>

            <div
                class="absolute inset-0 opacity-[0.03]"
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

            <div
                class="absolute right-8 top-16
                       select-none text-[90px]
                       font-black leading-none
                       text-blue-900/[0.025]
                       md:text-[160px]"
            >
                PPM
            </div>

            <img
                src="{{ asset('assets/images/logo.png') }}"
                alt=""
                class="absolute -left-24 bottom-0
                       w-[340px] select-none
                       grayscale opacity-[0.035]
                       md:w-[480px]"
            >
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
                        ?: 'Karakter Profesional Lulusan' }}
                </span>

                <h2
                    class="mt-4 text-3xl font-bold
                           leading-tight text-slate-800
                           sm:text-4xl md:text-5xl"
                >
                    {{ $section->title
                        ?: 'Profil Profesional Mandiri' }}
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
            {{-- DAFTAR PPM --}}
            {{-- ================================================= --}}

            <div
                class="grid gap-6
                       {{ $items->count() === 1
                            ? 'mx-auto max-w-2xl grid-cols-1'
                            : ($items->count() === 2
                                ? 'mx-auto max-w-5xl md:grid-cols-2'
                                : 'md:grid-cols-2 lg:grid-cols-3') }}"
            >
                @foreach ($items as $item)

                    <article
                        class="group relative overflow-hidden
                               rounded-3xl border
                               border-slate-100 bg-white
                               p-7 shadow-lg
                               transition-all duration-500
                               hover:-translate-y-2
                               hover:shadow-2xl"
                        data-aos="fade-up"
                        data-aos-delay="{{ min($loop->index * 100, 300) }}"
                    >
                        {{-- Ornamen --}}
                        <div
                            class="absolute right-0 top-0
                                   h-28 w-28 rounded-bl-full
                                   bg-blue-50
                                   transition duration-500
                                   group-hover:bg-yellow-100"
                            aria-hidden="true"
                        ></div>

                        <div
                            class="absolute -bottom-12 -left-12
                                   h-32 w-32 rounded-full
                                   bg-blue-100/40 blur-2xl"
                            aria-hidden="true"
                        ></div>


                        <div class="relative">

                            {{-- Nomor --}}
                            <div
                                class="flex h-14 w-14
                                       items-center justify-center
                                       rounded-2xl bg-blue-50
                                       text-xl font-black
                                       text-blue-700
                                       transition duration-300
                                       group-hover:bg-blue-700
                                       group-hover:text-white
                                       group-hover:shadow-lg"
                            >
                                {{ $loop->iteration }}
                            </div>


                            {{-- Judul --}}
                            @if (trim((string) $item->title) !== '')
                                <h3
                                    class="mt-6 text-xl font-bold
                                           leading-7 text-slate-800"
                                >
                                    {{ $item->title }}
                                </h3>
                            @endif


                            {{-- Konten --}}
                            <p
                                class="{{ trim((string) $item->title) !== ''
                                    ? 'mt-4'
                                    : 'mt-6' }}
                                       text-justify leading-8
                                       text-slate-600"
                            >
                                {!! nl2br(e($item->content)) !!}
                            </p>


                            {{-- Garis Aksen --}}
                            <div
                                class="mt-7 h-1 w-16
                                       rounded-full bg-yellow-400
                                       transition-all duration-300
                                       group-hover:w-28"
                            ></div>
                        </div>
                    </article>

                @endforeach
            </div>

        </div>
    </section>

@endif