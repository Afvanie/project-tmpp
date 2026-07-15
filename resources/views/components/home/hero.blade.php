@php
    /*
    |--------------------------------------------------------------------------
    | VIDEO HERO DINAMIS
    |--------------------------------------------------------------------------
    */

    $dynamicHeroVideoPath = trim(
        (string) ($homeContent?->hero_video ?? '')
    );

    $dynamicHeroVideoExists =
        $dynamicHeroVideoPath !== ''
        && \Illuminate\Support\Facades\Storage::disk('public')
            ->exists($dynamicHeroVideoPath);

    $fallbackHeroVideoPath =
        'assets/videos/hero.mp4';

    $fallbackHeroVideoExists =
        file_exists(
            public_path($fallbackHeroVideoPath)
        );

    $heroVideoUrl = match (true) {
        $dynamicHeroVideoExists =>
            asset(
                'storage/' . $dynamicHeroVideoPath
            ),

        $fallbackHeroVideoExists =>
            asset($fallbackHeroVideoPath),

        default => null,
    };

    $heroVideoExtension = strtolower(
        pathinfo(
            $dynamicHeroVideoExists
                ? $dynamicHeroVideoPath
                : $fallbackHeroVideoPath,
            PATHINFO_EXTENSION
        )
    );

    $heroVideoMimeType =
        $heroVideoExtension === 'webm'
            ? 'video/webm'
            : 'video/mp4';
@endphp
<section
    id="beranda"
    data-navbar-banner
    class="relative flex min-h-screen
           items-center overflow-hidden"
>
    {{-- ========================================================= --}}
    {{-- VIDEO BACKGROUND --}}
    {{-- ========================================================= --}}

    <div class="absolute inset-0">
        @if ($heroVideoUrl !== null)
            <video
                class="h-full w-full object-cover"
                autoplay
                muted
                loop
                playsinline
                preload="metadata"
                aria-hidden="true"
            >
                <source
                    src="{{ $heroVideoUrl }}"
                    type="{{ $heroVideoMimeType }}"
                >
            </video>
        @else
            <div
                class="h-full w-full
                    bg-gradient-to-br
                    from-[#031D36]
                    via-[#073763]
                    to-[#075F9B]"
            ></div>
        @endif

        {{-- Lapisan utama --}}
        <div
            class="absolute inset-0"
            style="
                background:
                    linear-gradient(
                        90deg,
                        rgba(3, 30, 56, 0.88) 0%,
                        rgba(3, 38, 69, 0.69) 45%,
                        rgba(3, 38, 69, 0.22) 75%,
                        rgba(3, 38, 69, 0.08) 100%
                    );
            "
        ></div>

        {{-- Lapisan bawah --}}
        <div
            class="absolute inset-0
                   bg-gradient-to-t
                   from-[#031D36]/85
                   via-transparent
                   to-[#031D36]/15"
        ></div>

        {{-- Efek cahaya --}}
        <div
            class="absolute -left-40 top-1/3
                   h-[520px] w-[520px]
                   rounded-full bg-blue-500/20
                   blur-[150px]"
            aria-hidden="true"
        ></div>

        <div
            class="absolute bottom-0 right-0
                   h-[420px] w-[420px]
                   rounded-full bg-yellow-300/10
                   blur-[140px]"
            aria-hidden="true"
        ></div>
    </div>


    {{-- ========================================================= --}}
    {{-- GRID DEKORATIF --}}
    {{-- ========================================================= --}}

    <div
        class="pointer-events-none absolute inset-0
               opacity-[0.06]"
        style="
            background-image:
                linear-gradient(
                    rgba(255, 255, 255, 0.8) 1px,
                    transparent 1px
                ),
                linear-gradient(
                    90deg,
                    rgba(255, 255, 255, 0.8) 1px,
                    transparent 1px
                );
            background-size: 72px 72px;
        "
        aria-hidden="true"
    ></div>


    {{-- ========================================================= --}}
    {{-- HERO CONTENT --}}
    {{-- ========================================================= --}}

    <div
        class="relative z-10 mx-auto
               w-full max-w-7xl
               px-6 pb-44 pt-36
               sm:px-8 sm:pb-40
               md:pt-44 lg:px-10"
    >
        <div class="max-w-4xl">

            {{-- Label --}}
            <div
                class="flex items-center gap-3"
                data-aos="fade-right"
            >
                <span
                    class="h-px w-10 bg-[#F1CE57]"
                    aria-hidden="true"
                ></span>

                <p
                    class="text-xs font-bold uppercase
                           tracking-[0.24em]
                           text-[#F5D875]
                           sm:text-sm"
                >
                    Program Sarjana Terapan
                </p>
            </div>


            {{-- Judul --}}
            <h1
                class="mt-6 text-4xl font-extrabold
                       leading-[1.08] tracking-tight
                       text-white drop-shadow-lg
                       sm:text-5xl md:text-6xl
                       lg:text-[4.6rem]"
                data-aos="fade-up"
                data-aos-delay="100"
            >
                Teknik Mesin

                <span
                    class="block text-[#F1CE57]"
                >
                    Produksi dan Perawatan
                </span>
            </h1>


            {{-- Identitas --}}
            <div
                class="mt-6 flex flex-wrap
                       items-center gap-3"
                data-aos="fade-up"
                data-aos-delay="180"
            >
                <span
                    class="inline-flex items-center
                           rounded-full border
                           border-white/20
                           bg-white/10 px-4 py-2
                           text-xs font-bold
                           text-white backdrop-blur-md
                           sm:text-sm"
                >
                    D-IV TMPP
                </span>

                <span
                    class="inline-flex items-center
                           rounded-full border
                           border-[#F1CE57]/35
                           bg-[#F1CE57]/15
                           px-4 py-2 text-xs
                           font-bold text-[#FFE89A]
                           backdrop-blur-md
                           sm:text-sm"
                >
                    KKNI Level 6
                </span>

                <span
                    class="inline-flex items-center
                           rounded-full border
                           border-white/20
                           bg-white/10 px-4 py-2
                           text-xs font-bold
                           text-white backdrop-blur-md
                           sm:text-sm"
                >
                    Berbasis OBE
                </span>
            </div>


            {{-- Visi --}}
            <p
                class="mt-7 max-w-3xl
                       text-lg font-semibold
                       leading-8 text-white
                       drop-shadow-md
                       sm:text-xl md:text-2xl"
                data-aos="fade-up"
                data-aos-delay="240"
            >
                Unggul dalam Autonomous Maintenance pada
                Persaingan Global Tahun 2030
            </p>


            {{-- Deskripsi --}}
            <p
                class="mt-5 max-w-3xl
                       text-sm leading-7
                       text-white/80
                       sm:text-base sm:leading-8
                       md:text-lg"
                data-aos="fade-up"
                data-aos-delay="300"
            >
                Program pendidikan vokasi Jurusan Teknik Mesin
                Politeknik Negeri Malang yang mempersiapkan
                Sarjana Terapan dalam bidang produksi,
                manufaktur, perawatan mesin, otomasi industri,
                dan pengembangan teknologi.
            </p>


            {{-- CTA --}}
            <div
                class="mt-9 flex flex-col gap-4
                       sm:flex-row"
                data-aos="fade-up"
                data-aos-delay="380"
            >
                <a
                    href="{{ route('profile') }}"
                    class="group inline-flex
                           items-center justify-center
                           gap-3 rounded-xl
                           bg-[#D7B33E]
                           px-7 py-4 font-bold
                           text-[#062844]
                           shadow-xl shadow-black/20
                           transition duration-300
                           hover:-translate-y-1
                           hover:bg-[#F0D570]
                           hover:shadow-2xl"
                >
                    Jelajahi Profil TMPP

                    <span
                        class="transition-transform
                               group-hover:translate-x-1"
                        aria-hidden="true"
                    >
                        →
                    </span>
                </a>

                <a
                    href="{{ route('academic') }}"
                    class="inline-flex items-center
                           justify-center gap-3
                           rounded-xl border
                           border-white/35
                           bg-white/10
                           px-7 py-4 font-bold
                           text-white backdrop-blur-md
                           transition duration-300
                           hover:-translate-y-1
                           hover:border-white
                           hover:bg-white
                           hover:text-[#073763]"
                >
                    Informasi Akademik

                    <i
                        class="fa-solid fa-graduation-cap"
                        aria-hidden="true"
                    ></i>
                </a>
            </div>
        </div>
    </div>


    {{-- ========================================================= --}}
    {{-- INFORMASI AKADEMIK BAWAH --}}
    {{-- ========================================================= --}}

    <div
        class="absolute inset-x-0 bottom-0
               z-20"
    >
        <div
            class="mx-auto max-w-7xl
                   px-4 sm:px-6 lg:px-10"
        >
            <div
                class="grid grid-cols-2
                       overflow-hidden rounded-t-2xl
                       border border-b-0
                       border-white/15
                       bg-[#062844]/90
                       shadow-2xl
                       backdrop-blur-xl
                       md:grid-cols-4"
                data-aos="fade-up"
                data-aos-delay="450"
            >
                
            </div>
        </div>
    </div>


    {{-- ========================================================= --}}
    {{-- SCROLL INDICATOR --}}
    {{-- ========================================================= --}}

    <a
        href="#program-description"
        aria-label="Lihat bagian berikutnya"
        class="absolute bottom-[150px]
               right-6 z-20 hidden
               items-center gap-3
               text-xs font-bold uppercase
               tracking-[0.2em]
               text-white/60
               transition hover:text-white
               lg:flex"
    >
        Scroll

        <span
            class="flex h-10 w-10
                   items-center justify-center
                   rounded-full border
                   border-white/25 bg-white/10
                   text-base backdrop-blur-sm"
            aria-hidden="true"
        >
            ↓
        </span>
    </a>
</section>