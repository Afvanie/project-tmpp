@php
    /*
    |--------------------------------------------------------------------------
    | VIDEO PROFIL TMPP
    |--------------------------------------------------------------------------
    |
    | Untuk sementara video masih menggunakan file statis.
    | Pengaturan video dinamis melalui admin dikerjakan setelah desain selesai.
    |
    */

    $videoRelativePath = 'assets/videos/profile-tmpp.mp4';

    $videoAvailable = file_exists(
        public_path($videoRelativePath)
    );

    $videoUrl = $videoAvailable
        ? asset($videoRelativePath)
        : null;
@endphp


@if ($videoAvailable)
    <section
        id="video-profile"
        class="relative overflow-hidden
               bg-[#F5F8FB] py-16
               md:py-20 lg:py-24"
    >
        {{-- ===================================================== --}}
        {{-- DEKORASI LATAR --}}
        {{-- ===================================================== --}}

        <div
            class="pointer-events-none absolute inset-0"
            aria-hidden="true"
        >
            <div
                class="absolute -left-40 top-10
                       h-96 w-96 rounded-full
                       bg-blue-200/30 blur-[130px]"
            ></div>

            <div
                class="absolute -right-32 bottom-0
                       h-96 w-96 rounded-full
                       bg-yellow-200/25 blur-[130px]"
            ></div>

            <div
                class="absolute right-0 top-0
                       hidden h-full w-[38%]
                       bg-gradient-to-l
                       from-blue-50/80
                       to-transparent
                       lg:block"
            ></div>
        </div>


        <div
            class="relative mx-auto
                   max-w-7xl px-6"
        >
            <div
                class="grid items-center gap-12
                       lg:grid-cols-12
                       lg:gap-16"
            >
                {{-- ================================================= --}}
                {{-- INFORMASI --}}
                {{-- ================================================= --}}

                <div
                    class="lg:col-span-7"
                    data-aos="fade-right"
                >
                    <div
                        class="flex items-center gap-3"
                    >
                        <span
                            class="h-px w-10
                                   bg-[#D7B33E]"
                            aria-hidden="true"
                        ></span>

                        <p
                            class="text-xs font-bold
                                   uppercase
                                   tracking-[0.22em]
                                   text-[#075F9B]"
                        >
                            Video Profil
                        </p>
                    </div>


                    <h2
                        class="mt-5 max-w-3xl
                               text-3xl font-extrabold
                               leading-tight tracking-tight
                               text-slate-900
                               sm:text-4xl
                               lg:text-5xl"
                    >
                        Mengenal Lebih Dekat
                        Program Studi D-IV TMPP
                    </h2>


                    <div
                        class="mt-6 flex items-center gap-3"
                        aria-hidden="true"
                    >
                        <span
                            class="h-1 w-16
                                   rounded-full
                                   bg-[#075F9B]"
                        ></span>

                        <span
                            class="h-1 w-8
                                   rounded-full
                                   bg-[#D7B33E]"
                        ></span>
                    </div>


                    <p
                        class="mt-7 max-w-3xl
                               text-justify
                               text-base leading-8
                               text-slate-600
                               sm:text-lg
                               sm:leading-9"
                    >
                        Video profil memperkenalkan Program Studi
                        D-IV Teknik Mesin Produksi dan Perawatan,
                        lingkungan pembelajaran vokasi, fasilitas
                        pendukung, kegiatan mahasiswa, serta
                        kompetensi yang dikembangkan sesuai
                        kebutuhan dunia industri.
                    </p>


                    {{-- Fokus Informasi --}}
                    <div
                        class="mt-8 grid gap-4
                               sm:grid-cols-3"
                    >
                        <div
                            class="flex items-center gap-3
                                   border-l-2
                                   border-[#075F9B]
                                   pl-4"
                        >
                            <span
                                class="flex h-10 w-10
                                       shrink-0 items-center
                                       justify-center
                                       rounded-xl
                                       bg-blue-50
                                       text-[#075F9B]"
                            >
                                <i
                                    class="fa-solid
                                           fa-graduation-cap"
                                    aria-hidden="true"
                                ></i>
                            </span>

                            <div>
                                <p
                                    class="text-sm font-bold
                                           text-slate-800"
                                >
                                    Pembelajaran
                                </p>

                                <p
                                    class="mt-1 text-xs
                                           text-slate-500"
                                >
                                    Pendidikan vokasi
                                </p>
                            </div>
                        </div>


                        <div
                            class="flex items-center gap-3
                                   border-l-2
                                   border-[#075F9B]
                                   pl-4"
                        >
                            <span
                                class="flex h-10 w-10
                                       shrink-0 items-center
                                       justify-center
                                       rounded-xl
                                       bg-blue-50
                                       text-[#075F9B]"
                            >
                                <i
                                    class="fa-solid
                                           fa-gears"
                                    aria-hidden="true"
                                ></i>
                            </span>

                            <div>
                                <p
                                    class="text-sm font-bold
                                           text-slate-800"
                                >
                                    Kompetensi
                                </p>

                                <p
                                    class="mt-1 text-xs
                                           text-slate-500"
                                >
                                    Produksi dan perawatan
                                </p>
                            </div>
                        </div>


                        <div
                            class="flex items-center gap-3
                                   border-l-2
                                   border-[#D7B33E]
                                   pl-4"
                        >
                            <span
                                class="flex h-10 w-10
                                       shrink-0 items-center
                                       justify-center
                                       rounded-xl
                                       bg-yellow-50
                                       text-yellow-700"
                            >
                                <i
                                    class="fa-solid
                                           fa-industry"
                                    aria-hidden="true"
                                ></i>
                            </span>

                            <div>
                                <p
                                    class="text-sm font-bold
                                           text-slate-800"
                                >
                                    Industri
                                </p>

                                <p
                                    class="mt-1 text-xs
                                           text-slate-500"
                                >
                                    Kebutuhan dunia kerja
                                </p>
                            </div>
                        </div>
                    </div>


                    <div
                        class="mt-9 inline-flex
                               items-center gap-3
                               rounded-xl border
                               border-slate-200
                               bg-white px-5 py-3
                               shadow-sm"
                    >
                        <span
                            class="flex h-9 w-9
                                   items-center justify-center
                                   rounded-lg
                                   bg-[#073763]
                                   text-[#F4D66E]"
                        >
                            <i
                                class="fa-solid fa-play"
                                aria-hidden="true"
                            ></i>
                        </span>

                        <div>
                            <p
                                class="text-sm font-bold
                                       text-slate-800"
                            >
                                Video Profil Resmi
                            </p>

                            <p
                                class="mt-0.5 text-xs
                                       text-slate-500"
                            >
                                D-IV Teknik Mesin Produksi dan Perawatan
                            </p>
                        </div>
                    </div>
                </div>


                {{-- ================================================= --}}
                {{-- VIDEO --}}
                {{-- ================================================= --}}

                <div
                    class="lg:col-span-5"
                    data-aos="fade-left"
                >
                    <div
                        class="relative mx-auto
                               max-w-[360px]"
                    >
                        {{-- Ornamen --}}
                        <div
                            class="absolute -left-5 top-12
                                   h-28 w-28
                                   rounded-3xl
                                   border-2
                                   border-[#D7B33E]/35"
                            aria-hidden="true"
                        ></div>

                        <div
                            class="absolute -right-6 bottom-10
                                   h-36 w-36
                                   rounded-full
                                   bg-blue-300/30
                                   blur-3xl"
                            aria-hidden="true"
                        ></div>


                        {{-- Label --}}
                        <div
                            class="absolute -left-4 top-8
                                   z-20 rounded-xl
                                   bg-[#073763]
                                   px-4 py-3
                                   shadow-xl
                                   sm:-left-8"
                        >
                            <p
                                class="text-[10px] font-bold
                                       uppercase
                                       tracking-[0.18em]
                                       text-[#F4D66E]"
                            >
                                D-IV TMPP
                            </p>

                            <p
                                class="mt-1 text-xs
                                       font-semibold
                                       text-white"
                            >
                                Politeknik Negeri Malang
                            </p>
                        </div>


                        {{-- Frame Video --}}
                        <div
                            class="relative overflow-hidden
                                   rounded-[2rem]
                                   border border-white
                                   bg-white p-3
                                   shadow-[0_28px_70px_rgba(15,23,42,0.20)]"
                        >
                            <div
                                class="absolute left-0
                                       right-0 top-0
                                       z-10 h-1.5
                                       bg-gradient-to-r
                                       from-[#073763]
                                       via-[#D7B33E]
                                       to-[#075F9B]"
                                aria-hidden="true"
                            ></div>

                            <div
                                class="overflow-hidden
                                       rounded-[1.5rem]
                                       bg-slate-900"
                            >
                                <video
                                    class="aspect-[9/16]
                                           max-h-[580px]
                                           w-full object-cover"
                                    controls
                                    playsinline
                                    preload="metadata"
                                    aria-label="Video profil Program Studi D-IV Teknik Mesin Produksi dan Perawatan"
                                >
                                    <source
                                        src="{{ $videoUrl }}"
                                        type="video/mp4"
                                    >

                                    Browser Anda tidak mendukung
                                    pemutar video.
                                </video>
                            </div>
                        </div>


                        {{-- Keterangan Bawah --}}
                        <div
                            class="relative mx-5
                                   -mt-5 flex
                                   items-center gap-3
                                   rounded-xl
                                   border border-slate-100
                                   bg-white px-4 py-3
                                   shadow-lg"
                        >
                            <span
                                class="flex h-9 w-9
                                       shrink-0 items-center
                                       justify-center
                                       rounded-lg
                                       bg-blue-50
                                       text-[#075F9B]"
                            >
                                <i
                                    class="fa-solid
                                           fa-circle-play"
                                    aria-hidden="true"
                                ></i>
                            </span>

                            <div class="min-w-0">
                                <p
                                    class="truncate
                                           text-sm font-bold
                                           text-slate-800"
                                >
                                    Video Profil TMPP
                                </p>

                                <p
                                    class="mt-0.5 truncate
                                           text-xs
                                           text-slate-500"
                                >
                                    Program Sarjana Terapan
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif