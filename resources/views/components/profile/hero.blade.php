<section
    id="profile-hero"
    data-navbar-banner
    class="relative flex min-h-[500px]
           items-center overflow-hidden
           sm:min-h-[540px]
           lg:min-h-[580px]"
>
    {{-- ========================================================= --}}
    {{-- BACKGROUND --}}
    {{-- ========================================================= --}}

    <div class="absolute inset-0">
        <img
            src="{{ asset('assets/images/profile-banner.jpg') }}"
            alt="Program Studi D-IV Teknik Mesin Produksi dan Perawatan"
            class="h-full w-full object-cover object-center"
        >

        {{-- Overlay utama --}}
        <div
            class="absolute inset-0"
            style="
                background:
                    linear-gradient(
                        90deg,
                        rgba(2, 22, 41, 0.88) 0%,
                        rgba(3, 37, 67, 0.72) 48%,
                        rgba(3, 37, 67, 0.28) 78%,
                        rgba(3, 37, 67, 0.14) 100%
                    );
            "
        ></div>

        {{-- Overlay bagian bawah --}}
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
                           text-white/60 sm:text-sm"
                >
                    <li>
                        <a
                            href="{{ route('home') }}"
                            class="transition
                                   hover:text-white"
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
                        class="text-white/85"
                        aria-current="page"
                    >
                        Profil Program Studi
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
                    Program Sarjana Terapan
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
                Profil Program Studi

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
                Pendidikan vokasi Politeknik Negeri Malang yang
                berorientasi pada bidang produksi, manufaktur,
                perawatan mesin, dan perkembangan teknologi industri.
            </p>


            {{-- Identitas --}}
            <div
                class="mt-8 flex flex-wrap
                       items-center gap-x-4
                       gap-y-2 text-xs
                       font-semibold text-white/70
                       sm:text-sm"
                data-aos="fade-up"
                data-aos-delay="270"
            >
                <span>
                    Politeknik Negeri Malang
                </span>

                <span
                    class="h-1 w-1 rounded-full
                           bg-[#E2BD45]"
                    aria-hidden="true"
                ></span>

                <span>
                    Jurusan Teknik Mesin
                </span>

                <span
                    class="h-1 w-1 rounded-full
                           bg-[#E2BD45]"
                    aria-hidden="true"
                ></span>

                <span>
                    Sarjana Terapan
                </span>
            </div>
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