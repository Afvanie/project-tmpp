@php
    /*
    |--------------------------------------------------------------------------
    | BANNER DOSEN DAN STAF
    |--------------------------------------------------------------------------
    */

    $bannerRelativePath = 'assets/images/lecturers-banner.jpg';

    $bannerAvailable = file_exists(
        public_path($bannerRelativePath)
    );
@endphp


<section
    class="relative flex min-h-[520px] items-center
           overflow-hidden bg-blue-950 py-24
           md:min-h-[600px] md:py-28"
>
    {{-- ========================================================= --}}
    {{-- BACKGROUND --}}
    {{-- ========================================================= --}}

    <div class="absolute inset-0">

        @if ($bannerAvailable)
            <img
                src="{{ asset($bannerRelativePath) }}"
                alt="Dosen dan staf Program Studi D-IV Teknik Mesin Produksi dan Perawatan"
                class="h-full w-full object-cover"
            >
        @else
            <div
                class="h-full w-full
                       bg-gradient-to-br
                       from-blue-900 via-blue-800
                       to-slate-950"
            ></div>
        @endif


        {{-- Overlay Horizontal --}}
        <div
            class="absolute inset-0"
            style="
                background: linear-gradient(
                    90deg,
                    rgba(0, 35, 75, 0.88) 0%,
                    rgba(0, 75, 145, 0.72) 45%,
                    rgba(0, 35, 75, 0.94) 100%
                );
            "
        ></div>


        {{-- Overlay Vertikal --}}
        <div
            class="absolute inset-0"
            style="
                background: linear-gradient(
                    180deg,
                    rgba(0, 25, 55, 0.10) 0%,
                    rgba(0, 25, 55, 0.45) 100%
                );
            "
        ></div>
    </div>


    {{-- ========================================================= --}}
    {{-- ORNAMEN BACKGROUND --}}
    {{-- ========================================================= --}}

    <div
        class="pointer-events-none absolute inset-0"
        aria-hidden="true"
    >
        {{-- Grid --}}
        <div
            class="absolute inset-0
                   bg-[linear-gradient(to_right,rgba(255,255,255,.08)_1px,transparent_1px),linear-gradient(to_bottom,rgba(255,255,255,.08)_1px,transparent_1px)]
                   bg-[size:70px_70px]"
        ></div>

        {{-- Blur Kuning --}}
        <div
            class="absolute -bottom-28 -left-32
                   h-96 w-96 rounded-full
                   bg-yellow-400/20 blur-[120px]"
        ></div>

        {{-- Blur Biru --}}
        <div
            class="absolute -right-40 top-0
                   h-[430px] w-[430px]
                   rounded-full bg-blue-400/20
                   blur-[130px]"
        ></div>

        {{-- Watermark --}}
        <div
            class="absolute bottom-6 right-6
                   select-none text-right
                   text-[64px] font-black leading-none
                   text-white/[0.035]
                   md:bottom-10 md:right-10
                   md:text-[120px]"
        >
            SDM
        </div>

        {{-- Logo Polinema --}}
        <img
            src="{{ asset('assets/images/logo.png') }}"
            alt=""
            class="absolute -bottom-20 -right-12
                   hidden w-[350px] select-none
                   grayscale opacity-[0.05]
                   lg:block"
        >
    </div>


    {{-- ========================================================= --}}
    {{-- CONTENT --}}
    {{-- ========================================================= --}}

    <div
        class="relative z-10 mx-auto
               w-full max-w-7xl px-6"
    >
        {{-- Breadcrumb --}}
        <nav
            aria-label="Breadcrumb"
            class="mb-6"
        >
            <ol
                class="flex flex-wrap items-center
                       gap-x-2 gap-y-2 text-sm
                       text-white/80"
            >
                <li>
                    <a
                        href="{{ route('home') }}"
                        class="transition
                               hover:text-yellow-300"
                    >
                        Beranda
                    </a>
                </li>

                <li aria-hidden="true">/</li>

                <li
                    class="font-semibold
                           text-yellow-300"
                    aria-current="page"
                >
                    Dosen dan Staf
                </li>
            </ol>
        </nav>


        {{-- Label --}}
        <span
            class="inline-flex items-center
                   rounded-full border
                   border-yellow-300/40
                   bg-yellow-400/15
                   px-4 py-2 text-xs
                   font-bold uppercase
                   tracking-[0.16em]
                   text-yellow-300
                   backdrop-blur-sm
                   sm:px-5 sm:text-sm"
        >
            Sumber Daya Manusia
        </span>


        {{-- Judul --}}
        <h1
            class="mt-6 max-w-4xl
                   text-4xl font-extrabold
                   leading-tight text-white
                   drop-shadow-lg
                   sm:text-5xl md:text-6xl"
        >
            Dosen dan Staf
        </h1>


        {{-- Deskripsi --}}
        <p
            class="mt-6 max-w-3xl
                   text-base leading-8
                   text-white/90 drop-shadow
                   md:text-lg"
        >
            Tenaga pendidik dan tenaga kependidikan Program Studi
            D-IV Teknik Mesin Produksi dan Perawatan Politeknik
            Negeri Malang yang mendukung penyelenggaraan pendidikan
            vokasi secara profesional.
        </p>


        {{-- Informasi Ringkas --}}
        <div class="mt-8 flex flex-wrap gap-3">

            <span
                class="rounded-xl border
                       border-white/15 bg-white/10
                       px-4 py-2 text-sm
                       font-semibold text-white
                       backdrop-blur-sm"
            >
                Dosen
            </span>

            <span
                class="rounded-xl border
                       border-white/15 bg-white/10
                       px-4 py-2 text-sm
                       font-semibold text-white
                       backdrop-blur-sm"
            >
                Tenaga Kependidikan
            </span>

            <span
                class="rounded-xl border
                       border-white/15 bg-white/10
                       px-4 py-2 text-sm
                       font-semibold text-white
                       backdrop-blur-sm"
            >
                D-IV TMPP
            </span>
        </div>
    </div>
</section>