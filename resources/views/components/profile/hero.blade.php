<section
    id="profile-hero"
    class="relative flex min-h-[540px] items-center overflow-hidden
           pt-20 md:min-h-[620px]"
>
    {{-- ========================================================= --}}
    {{-- BACKGROUND --}}
    {{-- ========================================================= --}}

    <div class="absolute inset-0">
        <img
            src="{{ asset('assets/images/profile-banner.jpg') }}"
            class="h-full w-full object-cover"
            alt="Profil Program Studi D-IV Teknik Mesin Produksi dan Perawatan"
        >

        {{-- Overlay Utama --}}
        <div
            class="absolute inset-0"
            style="
                background: linear-gradient(
                    90deg,
                    rgba(0, 35, 70, 0.82) 0%,
                    rgba(0, 59, 115, 0.72) 45%,
                    rgba(0, 59, 115, 0.90) 100%
                );
            "
        ></div>

        {{-- Overlay Vertikal --}}
        <div
            class="absolute inset-0"
            style="
                background: linear-gradient(
                    180deg,
                    rgba(0, 20, 45, 0.18) 0%,
                    rgba(0, 20, 45, 0.48) 100%
                );
            "
        ></div>
    </div>


    {{-- ========================================================= --}}
    {{-- DECORATION --}}
    {{-- ========================================================= --}}

    <div
        class="pointer-events-none absolute inset-0
               bg-[linear-gradient(to_right,rgba(255,255,255,.07)_1px,transparent_1px),linear-gradient(to_bottom,rgba(255,255,255,.07)_1px,transparent_1px)]
               bg-[size:70px_70px]"
        aria-hidden="true"
    ></div>

    <div
        class="pointer-events-none absolute -right-24 bottom-0
               h-72 w-72 rounded-full
               border border-white/10"
        aria-hidden="true"
    ></div>

    <div
        class="pointer-events-none absolute -right-10 bottom-16
               h-40 w-40 rounded-full
               border border-yellow-300/20"
        aria-hidden="true"
    ></div>


    {{-- ========================================================= --}}
    {{-- CONTENT --}}
    {{-- ========================================================= --}}

    <div
        class="relative z-10 mx-auto w-full
               max-w-7xl px-6 py-16"
    >
        {{-- Breadcrumb --}}
        <nav
            aria-label="Breadcrumb"
            class="mb-6"
        >
            <ol
                class="flex flex-wrap items-center gap-2
                       text-sm text-white/80"
            >
                <li>
                    <a
                        href="{{ route('home') }}"
                        class="transition hover:text-yellow-400"
                    >
                        Beranda
                    </a>
                </li>

                <li aria-hidden="true">
                    /
                </li>

                <li
                    class="font-semibold text-yellow-400"
                    aria-current="page"
                >
                    Profil TMPP
                </li>
            </ol>
        </nav>


        {{-- Badge --}}
        <span
            class="inline-flex items-center rounded-full
                   border border-yellow-300/30
                   bg-yellow-400/15 px-5 py-2
                   text-xs font-bold uppercase
                   tracking-[0.18em] text-yellow-300
                   backdrop-blur-sm sm:text-sm"
        >
            Program Studi Sarjana Terapan
        </span>


        {{-- Title --}}
        <h1
            class="mt-6 max-w-4xl
                   text-4xl font-extrabold
                   leading-tight text-white
                   sm:text-5xl md:text-6xl"
        >
            D-IV Teknik Mesin
            <span class="block text-yellow-400">
                Produksi dan Perawatan
            </span>
        </h1>


        {{-- Vision --}}
        <p
            class="mt-6 max-w-3xl
                   text-base font-semibold
                   leading-7 text-yellow-200
                   sm:text-lg"
        >
            Unggul dalam Autonomous Maintenance pada
            Persaingan Global Tahun 2030
        </p>


        {{-- Description --}}
        <p
            class="mt-5 max-w-3xl
                   text-base leading-8
                   text-white/85 sm:text-lg"
        >
            Mengenal lebih dekat Program Studi D-IV Teknik Mesin
            Produksi dan Perawatan Politeknik Negeri Malang sebagai
            penyelenggara pendidikan vokasi yang mempersiapkan
            Sarjana Terapan berkompeten dalam bidang produksi,
            manufaktur, perawatan mesin, dan teknologi industri.
        </p>


        {{-- Supporting Information --}}
        <div
            class="mt-8 flex flex-wrap gap-3"
        >
            <span
                class="inline-flex items-center rounded-xl
                       border border-white/15
                       bg-white/10 px-4 py-2
                       text-sm font-semibold text-white
                       backdrop-blur-sm"
            >
                <i
                    class="fa-solid fa-graduation-cap
                           mr-2 text-yellow-400"
                    aria-hidden="true"
                ></i>

                Sarjana Terapan
            </span>

            <span
                class="inline-flex items-center rounded-xl
                       border border-white/15
                       bg-white/10 px-4 py-2
                       text-sm font-semibold text-white
                       backdrop-blur-sm"
            >
                <i
                    class="fa-solid fa-industry
                           mr-2 text-yellow-400"
                    aria-hidden="true"
                ></i>

                Berorientasi Industri
            </span>

            <span
                class="inline-flex items-center rounded-xl
                       border border-white/15
                       bg-white/10 px-4 py-2
                       text-sm font-semibold text-white
                       backdrop-blur-sm"
            >
                <i
                    class="fa-solid fa-gears
                           mr-2 text-yellow-400"
                    aria-hidden="true"
                ></i>

                Outcome-Based Education
            </span>
        </div>
    </div>
</section>