@php
    /*
    |--------------------------------------------------------------------------
    | PROFIL SINGKAT PROGRAM STUDI
    |--------------------------------------------------------------------------
    */

    $overviewSection = \App\Models\ProfileSection::query()
        ->with([
            'items' => function ($query) {
                $query
                    ->where('is_active', true)
                    ->orderBy('sort_order');
            },
        ])
        ->where('slug', 'overview')
        ->where('is_active', true)
        ->first();

    /*
    |--------------------------------------------------------------------------
    | KELOMPOK KONTEN
    |--------------------------------------------------------------------------
    */

    $labelItem = $overviewSection
        ? $overviewSection->items->firstWhere('item_group', 'label')
        : null;

    $paragraphs = $overviewSection
        ? $overviewSection->items
            ->where('item_group', 'paragraph')
            ->filter(function ($item) {
                return trim((string) $item->content) !== '';
            })
            ->sortBy('sort_order')
            ->values()
        : collect();

    /*
    |--------------------------------------------------------------------------
    | KARTU INFORMASI
    |--------------------------------------------------------------------------
    |
    | Format isi kartu:
    |
    | Nilai utama|Deskripsi tambahan
    |
    | Kartu dengan nilai utama kosong tidak akan ditampilkan.
    | Contoh isi kosong:
    |
    | |
    |
    | Setelah pengelola mengisi nilainya melalui admin,
    | kartu akan muncul secara otomatis.
    |
    */

    $infoCards = $overviewSection
        ? $overviewSection->items
            ->where('item_group', 'info_card')
            ->filter(function ($card) {
                $parts = explode(
                    '|',
                    (string) $card->content,
                    2
                );

                $mainValue = trim($parts[0] ?? '');

                return $mainValue !== '';
            })
            ->sortBy('sort_order')
            ->values()
        : collect();

    /*
    |--------------------------------------------------------------------------
    | IKON KARTU INFORMASI
    |--------------------------------------------------------------------------
    */

    $icons = [
        1 => 'M12 3L2 8l10 5 8.16-4.08V16H22V8L12 3zm-6 8.18V16l6 3 6-3v-4.82L12 14l-6-2.82z',
        2 => 'M12 2l2.39 4.84L20 7.64l-4 3.9.94 5.51L12 14.48 7.06 17.05 8 11.54l-4-3.9 5.61-.8L12 2z',
        3 => 'M12 12a4 4 0 100-8 4 4 0 000 8zm0 2c-4.42 0-8 2.24-8 5v1h16v-1c0-2.76-3.58-5-8-5z',
        4 => 'M12 2a10 10 0 100 20 10 10 0 000-20zm1 11h4v-2h-3V6h-2v7h1z',
    ];

    /*
    |--------------------------------------------------------------------------
    | GAMBAR PROFIL
    |--------------------------------------------------------------------------
    */

    $overviewImagePath = 'assets/images/about.png';

    $overviewImageUrl = file_exists(
        public_path($overviewImagePath)
    )
        ? asset($overviewImagePath)
        : asset('assets/images/profile-banner.jpg');
@endphp


<section
    id="profile-overview"
    class="relative overflow-hidden bg-white py-20 md:py-24"
>
    {{-- ========================================================= --}}
    {{-- BACKGROUND DECORATION --}}
    {{-- ========================================================= --}}

    <div
        class="pointer-events-none absolute inset-0"
        aria-hidden="true"
    >
        <div
            class="absolute -left-32 top-20
                   h-80 w-80 rounded-full
                   bg-blue-100/50 blur-3xl"
        ></div>

        <div
            class="absolute -right-32 bottom-0
                   h-80 w-80 rounded-full
                   bg-yellow-100/50 blur-3xl"
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
                {{ $overviewSection?->subtitle ?? 'TENTANG KAMI' }}
            </span>

            <h2
                class="mt-4 text-3xl font-bold
                       leading-tight text-slate-800
                       sm:text-4xl md:text-5xl"
            >
                {{ $overviewSection?->title
                    ?? 'Mengenal Program Studi D-IV Teknik Mesin Produksi dan Perawatan' }}
            </h2>

            <div
                class="mx-auto mt-6 h-1 w-24
                       rounded-full bg-yellow-400"
            ></div>
        </div>


        <div
            class="grid items-start gap-12
                   lg:grid-cols-2 lg:gap-14"
        >
            {{-- ================================================= --}}
            {{-- GAMBAR DAN KARTU INFORMASI --}}
            {{-- ================================================= --}}

            <div data-aos="fade-right">

                <div
                    class="relative overflow-hidden
                           rounded-3xl bg-slate-100
                           shadow-2xl"
                >
                    <img
                        src="{{ $overviewImageUrl }}"
                        alt="Profil Program Studi D-IV Teknik Mesin Produksi dan Perawatan"
                        class="h-[320px] w-full
                               object-cover transition
                               duration-700 hover:scale-105
                               sm:h-[420px]"
                        loading="lazy"
                    >

                    <div
                        class="pointer-events-none absolute inset-0
                               bg-gradient-to-t
                               from-slate-950/25
                               via-transparent
                               to-transparent"
                        aria-hidden="true"
                    ></div>
                </div>


                {{-- KARTU INFORMASI --}}
                @if ($infoCards->isNotEmpty())
                    <div
                        class="mt-7 grid gap-5
                               sm:grid-cols-2"
                    >
                        @foreach ($infoCards as $card)

                            @php
                                $parts = explode(
                                    '|',
                                    (string) $card->content,
                                    2
                                );

                                $mainValue = trim(
                                    $parts[0] ?? ''
                                );

                                $smallText = trim(
                                    $parts[1] ?? ''
                                );

                                $isEven = $loop->iteration % 2 === 0;

                                $iconPath = $icons[
                                    $loop->iteration
                                ] ?? $icons[1];
                            @endphp

                            <article
                                class="group rounded-3xl
                                       border border-slate-100
                                       bg-white p-6 shadow-xl
                                       transition duration-300
                                       hover:-translate-y-1
                                       hover:shadow-2xl"
                                data-aos="fade-up"
                                data-aos-delay="{{ min($loop->index * 100, 300) }}"
                            >
                                <div
                                    class="flex h-14 w-14
                                           items-center justify-center
                                           rounded-full
                                           transition duration-300
                                           group-hover:scale-110
                                           {{ $isEven
                                                ? 'bg-yellow-50 text-yellow-500'
                                                : 'bg-blue-50 text-blue-700' }}"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-6 w-6"
                                        viewBox="0 0 24 24"
                                        fill="currentColor"
                                        aria-hidden="true"
                                    >
                                        <path d="{{ $iconPath }}" />
                                    </svg>
                                </div>

                                <h3
                                    class="mt-5 break-words
                                           text-2xl font-black
                                           sm:text-3xl
                                           {{ $isEven
                                                ? 'text-yellow-500'
                                                : 'text-blue-700' }}"
                                >
                                    {{ $mainValue }}
                                </h3>

                                <p
                                    class="mt-2 text-sm font-bold
                                           text-slate-800"
                                >
                                    {{ $card->title }}
                                </p>

                                @if ($smallText !== '')
                                    <p
                                        class="mt-3 text-sm
                                               leading-6 text-slate-500"
                                    >
                                        {{ $smallText }}
                                    </p>
                                @endif
                            </article>

                        @endforeach
                    </div>
                @endif
            </div>


            {{-- ================================================= --}}
            {{-- DESKRIPSI PROFIL --}}
            {{-- ================================================= --}}

            <div data-aos="fade-left">

                <span
                    class="text-sm font-semibold uppercase
                           tracking-[5px] text-blue-700"
                >
                    {{ $labelItem?->content ?? 'PROFIL SINGKAT' }}
                </span>

                <h3
                    class="mt-4 text-3xl font-bold
                           leading-tight text-slate-800
                           sm:text-4xl"
                >
                    {{ $overviewSection?->description
                        ?? 'Pendidikan vokasi Sarjana Terapan yang berorientasi pada bidang produksi, manufaktur, perawatan mesin, dan kebutuhan industri.' }}
                </h3>

                <div
                    class="mb-8 mt-6 h-1 w-24
                           rounded-full bg-yellow-400"
                ></div>


                @if ($paragraphs->isNotEmpty())
                    <div
                        class="space-y-6 text-justify
                               leading-8 text-slate-600"
                    >
                        @foreach ($paragraphs as $paragraph)
                            <p>
                                {!! nl2br(e($paragraph->content)) !!}
                            </p>
                        @endforeach
                    </div>
                @else
                    <div
                        class="rounded-2xl border
                               border-dashed border-slate-300
                               bg-slate-50 px-6 py-8"
                    >
                        <h4
                            class="font-bold text-slate-800"
                        >
                            Profil Singkat Belum Tersedia
                        </h4>

                        <p
                            class="mt-2 leading-7
                                   text-slate-500"
                        >
                            Materi profil singkat akan ditampilkan
                            setelah dilengkapi oleh pengelola
                            program studi melalui halaman admin.
                        </p>
                    </div>
                @endif


                {{-- INFORMASI PENDUKUNG --}}
                <div
                    class="mt-9 grid gap-4
                           sm:grid-cols-2"
                >
                    <div
                        class="rounded-2xl border
                               border-blue-100 bg-blue-50
                               px-5 py-4"
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
                            Diploma Empat / Sarjana Terapan
                        </p>
                    </div>

                    <div
                        class="rounded-2xl border
                               border-yellow-100 bg-yellow-50
                               px-5 py-4"
                    >
                        <p
                            class="text-xs font-bold uppercase
                                   tracking-wider text-yellow-700"
                        >
                            Pendekatan Kurikulum
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
        </div>

    </div>
</section>