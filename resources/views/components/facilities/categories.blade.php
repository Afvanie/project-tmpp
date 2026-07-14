@php
    /*
    |--------------------------------------------------------------------------
    | DATA KATEGORI FASILITAS
    |--------------------------------------------------------------------------
    */

    $facilityItems = $facilities ?? collect();

    /*
    |--------------------------------------------------------------------------
    | TAMPILAN VISUAL PER KATEGORI
    |--------------------------------------------------------------------------
    |
    | Pengaturan berikut hanya menentukan ikon dan warna kartu.
    | Informasi judul dan deskripsi tetap berasal dari database.
    |
    */

    $categoryStyles = [
        \App\Models\Facility::CATEGORY_LABORATORY => [
            'icon' => 'fa-flask',
            'label' => 'Laboratorium',
            'theme' => 'yellow',
        ],

        \App\Models\Facility::CATEGORY_WORKSHOP => [
            'icon' => 'fa-screwdriver-wrench',
            'label' => 'Workshop',
            'theme' => 'blue',
        ],

        \App\Models\Facility::CATEGORY_CLASSROOM => [
            'icon' => 'fa-book-open',
            'label' => 'Ruang Kelas',
            'theme' => 'blue',
        ],

        \App\Models\Facility::CATEGORY_GALLERY => [
            'icon' => 'fa-images',
            'label' => 'Galeri',
            'theme' => 'yellow',
        ],
    ];
@endphp


<section
    id="kategori-fasilitas"
    class="relative overflow-hidden bg-white
           py-20 md:py-24"
>
    {{-- ========================================================= --}}
    {{-- BACKGROUND DECORATION --}}
    {{-- ========================================================= --}}

    <div
        class="pointer-events-none absolute inset-0"
        aria-hidden="true"
    >
        <div
            class="absolute -left-40 top-20
                   h-[500px] w-[500px]
                   rounded-full bg-blue-200/20
                   blur-[140px]"
        ></div>

        <div
            class="absolute -right-40 bottom-20
                   h-[500px] w-[500px]
                   rounded-full bg-yellow-200/20
                   blur-[140px]"
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

        <img
            src="{{ asset('assets/images/logo.png') }}"
            alt=""
            class="absolute -bottom-24 -left-20
                   hidden w-[420px] select-none
                   grayscale opacity-[0.025]
                   lg:block"
        >
    </div>


    <div
        class="relative z-10 mx-auto
               max-w-7xl px-6"
    >
        {{-- ===================================================== --}}
        {{-- HEADING --}}
        {{-- ===================================================== --}}

        <div
            class="mx-auto mb-14 max-w-3xl text-center
                   md:mb-16"
            data-aos="fade-up"
        >
            <span
                class="text-sm font-semibold uppercase
                       tracking-[5px] text-blue-700"
            >
                Fasilitas Program Studi
            </span>

            <h2
                class="mt-4 text-3xl font-bold
                       leading-tight text-slate-800
                       sm:text-4xl md:text-5xl"
            >
                Kategori Fasilitas
            </h2>

            <div
                class="mx-auto mt-6 h-1 w-24
                       rounded-full bg-yellow-400"
            ></div>

            <p
                class="mt-7 leading-8 text-slate-600"
            >
                Daftar kategori dan dokumentasi fasilitas Program
                Studi D-IV Teknik Mesin Produksi dan Perawatan
                Politeknik Negeri Malang.
            </p>
        </div>


        {{-- ===================================================== --}}
        {{-- DAFTAR KATEGORI --}}
        {{-- ===================================================== --}}

        @if ($facilityItems->isNotEmpty())

            <div
                class="grid gap-7
                       md:grid-cols-2
                       xl:grid-cols-4"
            >
                @foreach ($facilityItems as $facility)

                    @php
                        $style = $categoryStyles[
                            $facility->category
                        ] ?? [
                            'icon' => 'fa-building',
                            'label' => $facility->category_label,
                            'theme' => 'blue',
                        ];

                        $isBlue = $style['theme'] === 'blue';

                        $title = trim(
                            (string) $facility->title
                        );

                        $description = trim(
                            (string) $facility->description
                        );

                        $photoCount = $facility->relationLoaded('photos')
                            ? $facility->photos->count()
                            : 0;
                    @endphp

                    <article
                        class="group relative overflow-hidden
                               rounded-3xl border
                               border-slate-100 bg-white
                               p-7 shadow-lg
                               transition-all duration-500
                               hover:-translate-y-2
                               hover:shadow-2xl"
                        data-aos="fade-up"
                        data-aos-delay="{{ min(
                            ($loop->index % 4) * 100,
                            300
                        ) }}"
                    >
                        {{-- Dekorasi --}}
                        <div
                            @class([
                                'absolute -right-12 -top-12',
                                'h-36 w-36 rounded-full',
                                'transition duration-500',
                                'bg-blue-100 group-hover:bg-yellow-100' =>
                                    $isBlue,
                                'bg-yellow-100 group-hover:bg-blue-100' =>
                                    !$isBlue,
                            ])
                        ></div>


                        <div class="relative">

                            {{-- Ikon --}}
                            <div
                                @class([
                                    'mb-6 flex h-16 w-16',
                                    'items-center justify-center',
                                    'rounded-2xl shadow-lg',
                                    'transition duration-500',
                                    'bg-blue-700 text-white',
                                    'group-hover:bg-yellow-400',
                                    'group-hover:text-slate-900' =>
                                        $isBlue,
                                    'bg-yellow-400 text-slate-900',
                                    'group-hover:bg-blue-700',
                                    'group-hover:text-white' =>
                                        !$isBlue,
                                ])
                            >
                                <i
                                    class="fa-solid {{ $style['icon'] }}
                                           text-3xl"
                                    aria-hidden="true"
                                ></i>
                            </div>


                            {{-- Label --}}
                            <span
                                @class([
                                    'inline-flex rounded-full',
                                    'px-3 py-1 text-xs',
                                    'font-semibold',
                                    'bg-blue-50 text-blue-700' =>
                                        $isBlue,
                                    'bg-yellow-50 text-yellow-700' =>
                                        !$isBlue,
                                ])
                            >
                                {{ $style['label'] }}
                            </span>


                            {{-- Judul --}}
                            <h3
                                class="mt-4 text-2xl font-bold
                                       leading-snug text-slate-800"
                            >
                                {{ $title !== ''
                                    ? $title
                                    : $facility->category_label }}
                            </h3>


                            {{-- Deskripsi dari Admin --}}
                            @if ($description !== '')
                                <p
                                    class="mt-4 leading-8
                                           text-slate-600"
                                >
                                    {{ $description }}
                                </p>
                            @endif


                            {{-- Jumlah Dokumentasi --}}
                            <div
                                class="mt-6 flex items-center
                                       justify-between gap-4
                                       border-t border-slate-100
                                       pt-5"
                            >
                                <span
                                    class="text-sm font-semibold
                                           text-slate-500"
                                >
                                    Dokumentasi
                                </span>

                                <span
                                    @class([
                                        'inline-flex min-w-9',
                                        'items-center justify-center',
                                        'rounded-full px-3 py-1',
                                        'text-sm font-bold',
                                        'bg-blue-50 text-blue-700' =>
                                            $isBlue,
                                        'bg-yellow-50 text-yellow-700' =>
                                            !$isBlue,
                                    ])
                                >
                                    {{ $photoCount }}
                                </span>
                            </div>

                        </div>
                    </article>

                @endforeach
            </div>

        @else

            {{-- ================================================= --}}
            {{-- EMPTY STATE --}}
            {{-- ================================================= --}}

            <div
                class="mx-auto max-w-3xl
                       rounded-3xl border
                       border-slate-100 bg-slate-50
                       p-8 text-center sm:p-10"
                data-aos="fade-up"
            >
                <div
                    class="mx-auto flex h-16 w-16
                           items-center justify-center
                           rounded-2xl bg-blue-100
                           text-blue-700"
                >
                    <i
                        class="fa-solid fa-building
                               text-2xl"
                        aria-hidden="true"
                    ></i>
                </div>

                <h3
                    class="mt-5 text-2xl font-bold
                           text-slate-800"
                >
                    Informasi Fasilitas Belum Tersedia
                </h3>

                <p
                    class="mx-auto mt-3 max-w-xl
                           leading-7 text-slate-500"
                >
                    Kategori dan dokumentasi fasilitas belum
                    dipublikasikan oleh pengelola program studi.
                </p>
            </div>

        @endif
    </div>
</section>