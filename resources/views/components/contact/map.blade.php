@php
    /*
    |--------------------------------------------------------------------------
    | INFORMASI LOKASI
    |--------------------------------------------------------------------------
    */

    $campusName =
        'Jurusan Teknik Mesin Politeknik Negeri Malang';

    $campusAddress =
        'Jl. Soekarno Hatta No. 9, Malang, Jawa Timur';

    $mapEmbedUrl =
        'https://maps.google.com/maps'
        . '?q=Politeknik%20Negeri%20Malang'
        . '&t=&z=16&ie=UTF8&iwloc=&output=embed';

    $mapDirectionUrl =
        'https://www.google.com/maps/search/'
        . '?api=1&query='
        . urlencode(
            'Politeknik Negeri Malang, '
            . $campusAddress
        );
@endphp


<section
    id="lokasi-kampus"
    class="relative overflow-hidden
           bg-[#F8FAFC] py-16
           md:py-20 lg:py-24"
>
    {{-- ========================================================= --}}
    {{-- BACKGROUND DECORATION --}}
    {{-- ========================================================= --}}

    <div
        class="pointer-events-none absolute inset-0"
        aria-hidden="true"
    >
        <div
            class="absolute -left-48 top-10
                   h-96 w-96 rounded-full
                   bg-yellow-100/35
                   blur-[140px]"
        ></div>

        <div
            class="absolute -right-48 bottom-10
                   h-96 w-96 rounded-full
                   bg-blue-100/40
                   blur-[140px]"
        ></div>
    </div>


    <div
        class="relative mx-auto
               max-w-7xl px-6"
    >
        {{-- ===================================================== --}}
        {{-- HEADING --}}
        {{-- ===================================================== --}}

        <header
            class="mx-auto max-w-3xl
                   text-center"
            data-aos="fade-up"
        >
            <div
                class="flex items-center
                       justify-center gap-3"
            >
                <span
                    class="h-px w-9
                           bg-[#D7B33E]"
                    aria-hidden="true"
                ></span>

                <p
                    class="text-[10px] font-bold
                           uppercase
                           tracking-[0.22em]
                           text-[#075F9B]"
                >
                    Lokasi Kampus
                </p>

                <span
                    class="h-px w-9
                           bg-[#D7B33E]"
                    aria-hidden="true"
                ></span>
            </div>


            <h2
                class="mt-4 text-3xl
                       font-semibold leading-tight
                       tracking-[-0.025em]
                       text-slate-900
                       sm:text-4xl lg:text-5xl"
                style="
                    font-family:
                        'Space Grotesk',
                        'Plus Jakarta Sans',
                        sans-serif;
                "
            >
                Kunjungi Program Studi D-IV TMPP
            </h2>


            <p
                class="mx-auto mt-5 max-w-2xl
                       text-sm leading-7
                       text-slate-600
                       sm:text-base sm:leading-8"
            >
                Program Studi D-IV Teknik Mesin Produksi dan
                Perawatan berada di lingkungan Jurusan Teknik Mesin
                Politeknik Negeri Malang.
            </p>


            <div
                class="mt-6 flex items-center
                       justify-center gap-3"
                aria-hidden="true"
            >
                <span
                    class="h-1 w-14 rounded-full
                           bg-[#075F9B]"
                ></span>

                <span
                    class="h-1 w-7 rounded-full
                           bg-[#D7B33E]"
                ></span>
            </div>
        </header>


        {{-- ===================================================== --}}
        {{-- MAP CARD --}}
        {{-- ===================================================== --}}

        <div
            class="mx-auto mt-12
                   max-w-6xl overflow-hidden
                   rounded-[2rem]
                   border border-slate-200
                   bg-white
                   shadow-[0_20px_55px_rgba(15,23,42,0.10)]
                   lg:mt-14"
            data-aos="fade-up"
        >
            <div
                class="grid lg:grid-cols-12"
            >
                {{-- ================================================= --}}
                {{-- INFORMASI LOKASI --}}
                {{-- ================================================= --}}

                <div
                    class="relative overflow-hidden
                           bg-[#031D36]
                           px-6 py-9
                           text-white
                           sm:px-8 sm:py-10
                           lg:col-span-4
                           lg:flex lg:flex-col
                           lg:justify-between
                           lg:px-9 lg:py-11"
                >
                    {{-- Dekorasi --}}
                    <div
                        class="pointer-events-none
                               absolute -right-24 -top-24
                               h-64 w-64 rounded-full
                               bg-blue-400/15
                               blur-[90px]"
                        aria-hidden="true"
                    ></div>

                    <div
                        class="pointer-events-none
                               absolute -bottom-24 -left-24
                               h-64 w-64 rounded-full
                               bg-yellow-400/15
                               blur-[90px]"
                        aria-hidden="true"
                    ></div>


                    <div class="relative">
                        <span
                            class="inline-flex items-center
                                   gap-2 rounded-full
                                   border border-white/15
                                   bg-white/[0.07]
                                   px-4 py-2
                                   text-[9px] font-bold
                                   uppercase
                                   tracking-[0.16em]
                                   text-[#F2D56F]"
                        >
                            <i
                                class="fa-solid
                                       fa-location-dot"
                                aria-hidden="true"
                            ></i>

                            Alamat Kampus
                        </span>


                        <h3
                            class="mt-6 text-2xl
                                   font-bold leading-tight
                                   tracking-[-0.02em]
                                   text-white
                                   sm:text-3xl"
                        >
                            {{ $campusName }}
                        </h3>


                        <p
                            class="mt-5 text-sm
                                   leading-7
                                   text-white/65"
                        >
                            {{ $campusAddress }}
                        </p>


                        <div
                            class="mt-7 flex items-start
                                   gap-4 border-t
                                   border-white/10 pt-6"
                        >
                            <span
                                class="flex h-10 w-10
                                       shrink-0 items-center
                                       justify-center
                                       rounded-xl
                                       bg-white/[0.08]
                                       text-[#F2D56F]"
                            >
                                <i
                                    class="fa-solid
                                           fa-building-columns"
                                    aria-hidden="true"
                                ></i>
                            </span>

                            <p
                                class="text-sm leading-7
                                       text-white/60"
                            >
                                Lokasi program studi berada di
                                kawasan kampus utama Politeknik
                                Negeri Malang.
                            </p>
                        </div>
                    </div>


                    <div class="relative mt-8">
                        <a
                            href="{{ $mapDirectionUrl }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="inline-flex w-full
                                   items-center
                                   justify-center gap-3
                                   rounded-xl
                                   bg-[#E2BD45]
                                   px-5 py-3.5
                                   text-sm font-bold
                                   text-[#031D36]
                                   transition
                                   hover:bg-[#F2D56F]"
                        >
                            <i
                                class="fa-solid
                                       fa-diamond-turn-right"
                                aria-hidden="true"
                            ></i>

                            Buka Petunjuk Arah
                        </a>
                    </div>
                </div>


                {{-- ================================================= --}}
                {{-- GOOGLE MAP --}}
                {{-- ================================================= --}}

                <div
                    class="relative min-h-[380px]
                           bg-slate-200
                           sm:min-h-[440px]
                           lg:col-span-8
                           lg:min-h-[500px]"
                >
                    <iframe
                        src="{{ $mapEmbedUrl }}"
                        class="absolute inset-0
                               h-full w-full
                               border-0"
                        title="Lokasi Jurusan Teknik Mesin Politeknik Negeri Malang"
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        allowfullscreen
                    ></iframe>


                    {{-- Label kecil --}}
                    <div
                        class="pointer-events-none
                               absolute bottom-5
                               left-1/2
                               -translate-x-1/2
                               rounded-full
                               border border-white/70
                               bg-white/90
                               px-4 py-2
                               text-center
                               text-[10px] font-bold
                               uppercase
                               tracking-[0.12em]
                               text-[#075F9B]
                               shadow-lg
                               backdrop-blur
                               sm:bottom-6"
                    >
                        Politeknik Negeri Malang
                    </div>
                </div>
            </div>
        </div>


        {{-- ===================================================== --}}
        {{-- CATATAN LOKASI --}}
        {{-- ===================================================== --}}

        <div
            class="mx-auto mt-6 flex
                   max-w-6xl items-start
                   justify-center gap-3
                   text-center text-xs
                   leading-6 text-slate-400"
            data-aos="fade-up"
        >
            <i
                class="fa-solid
                       fa-circle-info
                       mt-1 text-[#075F9B]"
                aria-hidden="true"
            ></i>

            <p>
                Gunakan tombol petunjuk arah untuk membuka lokasi
                melalui aplikasi Google Maps.
            </p>
        </div>
    </div>
</section>