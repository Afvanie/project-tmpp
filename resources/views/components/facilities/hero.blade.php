@php
    /*
    |--------------------------------------------------------------------------
    | HERO FASILITAS
    |--------------------------------------------------------------------------
    */

    $bannerCandidates = [
        'assets/images/fasilitas-banner.jpg',
        'assets/images/facilities-banner.jpg',
        'assets/images/profile-banner.jpg',
    ];

    $bannerPath = collect($bannerCandidates)
        ->first(function ($path) {
            return file_exists(
                public_path($path)
            );
        });

    /*
    |--------------------------------------------------------------------------
    | RINGKASAN DATA
    |--------------------------------------------------------------------------
    |
    | Hanya dipakai untuk membantu konteks halaman.
    | Tidak menampilkan statistik besar pada hero.
    |
    */

    $facilityCollection = collect(
        $facilities ?? []
    );

    $availableCategories = $facilityCollection
        ->pluck('category')
        ->filter()
        ->unique()
        ->count();
@endphp


<section
    id="facilities-hero"
    data-navbar-banner
    class="relative flex min-h-[500px]
           items-center overflow-hidden
           bg-[#031D36]
           sm:min-h-[540px]
           lg:min-h-[580px]"
>
    {{-- ========================================================= --}}
    {{-- BACKGROUND --}}
    {{-- ========================================================= --}}

    <div class="absolute inset-0">
        @if ($bannerPath)
            <img
                src="{{ asset($bannerPath) }}"
                alt="Fasilitas Program Studi D-IV Teknik Mesin Produksi dan Perawatan"
                class="h-full w-full
                       object-cover object-center"
            >
        @else
            <div
                class="h-full w-full
                       bg-gradient-to-br
                       from-[#031D36]
                       via-[#073763]
                       to-[#075F9B]"
            ></div>
        @endif


        {{-- Overlay utama --}}
        <div
            class="absolute inset-0"
            style="
                background:
                    linear-gradient(
                        90deg,
                        rgba(2, 22, 41, 0.93) 0%,
                        rgba(3, 37, 67, 0.80) 48%,
                        rgba(3, 37, 67, 0.36) 78%,
                        rgba(3, 37, 67, 0.17) 100%
                    );
            "
        ></div>


        {{-- Overlay bawah --}}
        <div
            class="absolute inset-0
                   bg-gradient-to-t
                   from-[#02182C]/75
                   via-transparent
                   to-[#02182C]/15"
        ></div>
    </div>


    {{-- Cahaya lembut --}}
    <div
        class="pointer-events-none absolute
               -left-40 top-1/2
               h-[420px] w-[420px]
               -translate-y-1/2
               rounded-full
               bg-blue-500/15
               blur-[140px]"
        aria-hidden="true"
    ></div>


    {{-- ========================================================= --}}
    {{-- CONTENT --}}
    {{-- ========================================================= --}}

    <div
        class="relative z-10 mx-auto
               w-full max-w-7xl
               px-6 pb-16 pt-32
               sm:px-8 sm:pt-36
               lg:px-10"
    >
        <div class="max-w-3xl">

            {{-- Breadcrumb --}}
            <nav
                aria-label="Breadcrumb"
                data-aos="fade-right"
            >
                <ol
                    class="flex flex-wrap items-center
                           gap-2 text-xs font-medium
                           text-white/60
                           sm:text-sm"
                >
                    <li>
                        <a
                            href="{{ route('home') }}"
                            class="transition hover:text-white"
                        >
                            Beranda
                        </a>
                    </li>

                    <li
                        class="text-white/30"
                        aria-hidden="true"
                    >
                        /
                    </li>

                    <li
                        class="text-white/90"
                        aria-current="page"
                    >
                        Fasilitas
                    </li>
                </ol>
            </nav>


            {{-- Label --}}
            <div
                class="mt-8 flex items-center gap-3"
                data-aos="fade-up"
                data-aos-delay="80"
            >
                <span
                    class="h-px w-8 bg-[#E2BD45]"
                    aria-hidden="true"
                ></span>

                <p
                    class="text-[11px] font-bold
                           uppercase tracking-[0.24em]
                           text-[#F2D56F]
                           sm:text-xs"
                >
                    Sarana Pembelajaran Vokasi
                </p>
            </div>


            {{-- Judul --}}
            <h1
                class="mt-5 max-w-3xl
                       text-4xl font-semibold
                       leading-[1.12]
                       tracking-[-0.03em]
                       text-white
                       drop-shadow-md
                       sm:text-5xl
                       lg:text-6xl"
                style="
                    font-family:
                        'Space Grotesk',
                        'Plus Jakarta Sans',
                        sans-serif;
                "
                data-aos="fade-up"
                data-aos-delay="140"
            >
                Fasilitas Program Studi

                <span
                    class="mt-2 block
                           font-bold text-[#F1CE57]"
                >
                    D-IV Teknik Mesin Produksi dan Perawatan
                </span>
            </h1>


            {{-- Deskripsi --}}
            <p
                class="mt-6 max-w-2xl
                       text-sm leading-7
                       text-white/75
                       sm:text-base
                       sm:leading-8"
                data-aos="fade-up"
                data-aos-delay="210"
            >
                Lingkungan pembelajaran yang mendukung kegiatan
                praktik, pengujian, produksi, perawatan mesin,
                pembelajaran teori, serta pengembangan kompetensi
                mahasiswa.
            </p>


            {{-- Identitas fasilitas --}}
            <div
                class="mt-8 flex flex-wrap
                       items-center gap-x-4 gap-y-2
                       text-xs font-semibold
                       text-white/70
                       sm:text-sm"
                data-aos="fade-up"
                data-aos-delay="270"
            >
                <span>
                    Laboratorium
                </span>

                <span
                    class="h-1 w-1 rounded-full
                           bg-[#E2BD45]"
                    aria-hidden="true"
                ></span>

                <span>
                    Workshop
                </span>

                <span
                    class="h-1 w-1 rounded-full
                           bg-[#E2BD45]"
                    aria-hidden="true"
                ></span>

                <span>
                    Ruang Kelas
                </span>

                <span
                    class="h-1 w-1 rounded-full
                           bg-[#E2BD45]"
                    aria-hidden="true"
                ></span>

                <span>
                    Galeri Aktivitas
                </span>
            </div>


            @if ($availableCategories > 0)
                <a
                    href="#kategori-fasilitas"
                    class="mt-9 inline-flex
                           items-center gap-3
                           text-xs font-bold
                           uppercase
                           tracking-[0.15em]
                           text-white/75
                           transition
                           hover:text-[#F2D56F]"
                    data-aos="fade-up"
                    data-aos-delay="320"
                >
                    <span
                        class="flex h-9 w-9
                               items-center justify-center
                               rounded-full
                               border border-white/20
                               bg-white/10
                               backdrop-blur-sm"
                    >
                        <i
                            class="fa-solid fa-arrow-down"
                            aria-hidden="true"
                        ></i>
                    </span>

                    Lihat Fasilitas
                </a>
            @endif
        </div>
    </div>


    {{-- ========================================================= --}}
    {{-- AKSEN BAWAH --}}
    {{-- ========================================================= --}}

    <div
        class="absolute inset-x-0 bottom-0
               z-10 h-1
               bg-gradient-to-r
               from-[#073763]
               via-[#E2BD45]
               to-[#0B67A5]"
        aria-hidden="true"
    ></div>
</section>