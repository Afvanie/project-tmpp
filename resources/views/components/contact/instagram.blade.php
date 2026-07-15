@php
    /*
    |--------------------------------------------------------------------------
    | MEDIA SOSIAL
    |--------------------------------------------------------------------------
    |
    | Alamat akun masih mengikuti data pada project lama.
    | Pastikan akun telah dikonfirmasi sebelum website dipublikasikan.
    |
    */

    $instagramUsername = 'polinema.jtm';

    $instagramUrl =
        'https://www.instagram.com/'
        . $instagramUsername;

    $instagramCandidates = [
        'assets/images/instagram-1.webp',
        'assets/images/instagram-2.webp',
        'assets/images/instagram-3.webp',
    ];

    $instagramImages = collect(
        $instagramCandidates
    )
        ->filter(function (string $path): bool {
            return file_exists(
                public_path($path)
            );
        })
        ->values();

    $logoPath = 'assets/images/logo.png';

    $logoAvailable = file_exists(
        public_path($logoPath)
    );
@endphp


<section
    id="media-sosial"
    class="relative overflow-hidden
           bg-[#F8FAFC] py-16
           md:py-20 lg:py-24"
>
    {{-- ========================================================= --}}
    {{-- DEKORASI RINGAN --}}
    {{-- ========================================================= --}}

    <div
        class="pointer-events-none absolute inset-0"
        aria-hidden="true"
    >
        <div
            class="absolute -left-48 bottom-0
                   h-96 w-96 rounded-full
                   bg-yellow-100/35
                   blur-[140px]"
        ></div>

        <div
            class="absolute -right-48 top-0
                   h-96 w-96 rounded-full
                   bg-blue-100/35
                   blur-[140px]"
        ></div>
    </div>


    <div
        class="relative mx-auto
               max-w-6xl px-6"
    >
        <div
            class="overflow-hidden
                   rounded-[2rem]
                   border border-slate-200
                   bg-white
                   shadow-[0_20px_55px_rgba(15,23,42,0.09)]"
            data-aos="fade-up"
        >
            <div
                class="grid items-stretch
                       lg:grid-cols-12"
            >
                {{-- ================================================= --}}
                {{-- INFORMASI --}}
                {{-- ================================================= --}}

                <div
                    class="flex flex-col
                           justify-center
                           px-6 py-10
                           sm:px-9
                           lg:col-span-6
                           lg:px-12 lg:py-14"
                >
                    <div
                        class="flex items-center gap-3"
                    >
                        <span
                            class="h-px w-8
                                   bg-[#D7B33E]"
                            aria-hidden="true"
                        ></span>

                        <p
                            class="text-[10px] font-bold
                                   uppercase
                                   tracking-[0.22em]
                                   text-[#075F9B]"
                        >
                            Media Sosial
                        </p>
                    </div>


                    <h2
                        class="mt-4 max-w-xl
                               text-3xl font-semibold
                               leading-tight
                               tracking-[-0.025em]
                               text-slate-900
                               sm:text-4xl"
                        style="
                            font-family:
                                'Space Grotesk',
                                'Plus Jakarta Sans',
                                sans-serif;
                        "
                    >
                        Ikuti Informasi Terbaru melalui Instagram
                    </h2>


                    <p
                        class="mt-5 max-w-xl
                               text-sm leading-7
                               text-slate-600
                               sm:text-base
                               sm:leading-8"
                    >
                        Temukan dokumentasi kegiatan akademik,
                        praktikum, aktivitas mahasiswa, dan informasi
                        terbaru dari lingkungan Jurusan Teknik Mesin
                        Politeknik Negeri Malang.
                    </p>


                    <div
                        class="mt-7 flex items-center
                               gap-4"
                    >
                        <span
                            class="flex h-12 w-12
                                   shrink-0 items-center
                                   justify-center
                                   rounded-2xl
                                   bg-gradient-to-br
                                   from-purple-600
                                   via-pink-500
                                   to-orange-400
                                   text-xl text-white
                                   shadow-lg"
                        >
                            <i
                                class="fa-brands
                                       fa-instagram"
                                aria-hidden="true"
                            ></i>
                        </span>

                        <div>
                            <p
                                class="text-[9px] font-bold
                                       uppercase
                                       tracking-[0.15em]
                                       text-slate-400"
                            >
                                Instagram
                            </p>

                            <p
                                class="mt-1 font-bold
                                       text-slate-900"
                            >
                                {{ '@' . $instagramUsername }}
                            </p>
                        </div>
                    </div>


                    <a
                        href="{{ $instagramUrl }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="mt-8 inline-flex
                               w-fit items-center
                               justify-center gap-3
                               rounded-xl
                               bg-[#075F9B]
                               px-6 py-3.5
                               text-sm font-bold
                               text-white
                               shadow-lg
                               shadow-blue-900/10
                               transition
                               hover:bg-[#073763]"
                    >
                        <i
                            class="fa-brands
                                   fa-instagram"
                            aria-hidden="true"
                        ></i>

                        Kunjungi Instagram

                        <i
                            class="fa-solid
                                   fa-arrow-up-right-from-square
                                   text-[10px]"
                            aria-hidden="true"
                        ></i>
                    </a>
                </div>


                {{-- ================================================= --}}
                {{-- PREVIEW AKUN --}}
                {{-- ================================================= --}}

                <div
                    class="relative overflow-hidden
                           bg-[#031D36]
                           p-6 sm:p-8
                           lg:col-span-6
                           lg:flex lg:items-center
                           lg:p-10"
                >
                    {{-- Dekorasi --}}
                    <div
                        class="pointer-events-none
                               absolute -right-28 -top-28
                               h-72 w-72 rounded-full
                               bg-blue-400/15
                               blur-[100px]"
                        aria-hidden="true"
                    ></div>

                    <div
                        class="pointer-events-none
                               absolute -bottom-28 -left-28
                               h-72 w-72 rounded-full
                               bg-yellow-400/15
                               blur-[100px]"
                        aria-hidden="true"
                    ></div>


                    <div
                        class="relative w-full
                               overflow-hidden
                               rounded-3xl
                               border border-white/15
                               bg-white/[0.08]
                               p-5
                               backdrop-blur-sm
                               sm:p-6"
                    >
                        {{-- Identitas akun --}}
                        <div
                            class="flex items-center gap-4"
                        >
                            <div
                                class="flex h-14 w-14
                                       shrink-0 items-center
                                       justify-center
                                       rounded-2xl bg-white
                                       p-2 shadow-lg"
                            >
                                @if ($logoAvailable)
                                    <img
                                        src="{{ asset($logoPath) }}"
                                        alt="Logo Politeknik Negeri Malang"
                                        class="h-full w-full
                                               object-contain"
                                    >
                                @else
                                    <span
                                        class="text-lg font-black
                                               text-[#075F9B]"
                                    >
                                        TM
                                    </span>
                                @endif
                            </div>


                            <div class="min-w-0">
                                <p
                                    class="truncate text-lg
                                           font-bold text-white"
                                >
                                    {{ '@' . $instagramUsername }}
                                </p>

                                <p
                                    class="mt-1 text-xs
                                           text-white/55"
                                >
                                    Jurusan Teknik Mesin Polinema
                                </p>
                            </div>


                            <span
                                class="ml-auto flex h-9 w-9
                                       shrink-0 items-center
                                       justify-center
                                       rounded-xl
                                       bg-gradient-to-br
                                       from-purple-600
                                       via-pink-500
                                       to-orange-400
                                       text-white"
                            >
                                <i
                                    class="fa-brands
                                           fa-instagram"
                                    aria-hidden="true"
                                ></i>
                            </span>
                        </div>


                        {{-- Preview gambar --}}
                        @if ($instagramImages->isNotEmpty())
                            <div
                                class="mt-6 grid
                                       grid-cols-3 gap-2
                                       sm:gap-3"
                            >
                                @foreach ($instagramImages as $image)
                                    <a
                                        href="{{ $instagramUrl }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="group relative
                                               aspect-square
                                               overflow-hidden
                                               rounded-xl
                                               bg-white/10"
                                        aria-label="Buka Instagram {{ '@' . $instagramUsername }}"
                                    >
                                        <img
                                            src="{{ asset($image) }}"
                                            alt="Dokumentasi Instagram Jurusan Teknik Mesin Polinema"
                                            class="h-full w-full
                                                   object-cover
                                                   transition
                                                   duration-500
                                                   group-hover:scale-105"
                                            loading="lazy"
                                        >

                                        <div
                                            class="absolute inset-0
                                                   flex items-center
                                                   justify-center
                                                   bg-slate-950/0
                                                   text-white opacity-0
                                                   transition
                                                   group-hover:bg-slate-950/35
                                                   group-hover:opacity-100"
                                        >
                                            <i
                                                class="fa-brands
                                                       fa-instagram"
                                                aria-hidden="true"
                                            ></i>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        @else
                            <div
                                class="mt-6 flex min-h-40
                                       items-center
                                       justify-center
                                       rounded-2xl
                                       border border-dashed
                                       border-white/15
                                       bg-white/[0.04]
                                       px-6 text-center"
                            >
                                <div>
                                    <i
                                        class="fa-regular
                                               fa-images
                                               text-2xl
                                               text-white/40"
                                        aria-hidden="true"
                                    ></i>

                                    <p
                                        class="mt-3 text-sm
                                               leading-7
                                               text-white/50"
                                    >
                                        Pratinjau dokumentasi
                                        Instagram belum tersedia.
                                    </p>
                                </div>
                            </div>
                        @endif


                        <div
                            class="mt-5 flex items-center
                                   justify-between gap-4
                                   border-t
                                   border-white/10 pt-5"
                        >
                            <p
                                class="text-xs
                                       text-white/45"
                            >
                                Official Instagram
                            </p>

                            <a
                                href="{{ $instagramUrl }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="inline-flex
                                       items-center gap-2
                                       text-xs font-bold
                                       text-[#F2D56F]
                                       transition
                                       hover:text-white"
                            >
                                Lihat Profil

                                <i
                                    class="fa-solid
                                           fa-arrow-right
                                           text-[9px]"
                                    aria-hidden="true"
                                ></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <p
            class="mt-5 text-center
                   text-xs leading-6
                   text-slate-400"
            data-aos="fade-up"
        >
            Pastikan akun media sosial telah dikonfirmasi sebagai
            akun resmi sebelum website dipublikasikan.
        </p>
    </div>
</section>