@php
    /*
    |--------------------------------------------------------------------------
    | DENAH GEDUNG
    |--------------------------------------------------------------------------
    |
    | Section hanya ditampilkan apabila dokumen PDF tersedia.
    |
    */

    $floorPlanRelativePath =
        'assets/documents/denah-gedung-teknik-mesin.pdf';

    $floorPlanAvailable = file_exists(
        public_path($floorPlanRelativePath)
    );

    $floorPlanUrl = $floorPlanAvailable
        ? asset($floorPlanRelativePath)
        : null;
@endphp


@if ($floorPlanAvailable)
    <section
        id="denah-gedung"
        class="relative overflow-hidden
               bg-[#031D36] py-16
               md:py-20 lg:py-24"
    >
        {{-- ===================================================== --}}
        {{-- BACKGROUND --}}
        {{-- ===================================================== --}}

        <div
            class="pointer-events-none absolute inset-0"
            aria-hidden="true"
        >
            <div
                class="absolute inset-0
                       bg-gradient-to-br
                       from-[#02182C]
                       via-[#073763]
                       to-[#075F9B]"
            ></div>

            <div
                class="absolute -left-48 bottom-0
                       h-[440px] w-[440px]
                       rounded-full
                       bg-blue-400/10
                       blur-[145px]"
            ></div>

            <div
                class="absolute -right-48 top-0
                       h-[440px] w-[440px]
                       rounded-full
                       bg-yellow-400/10
                       blur-[145px]"
            ></div>

            <div
                class="absolute inset-x-0 top-0
                       h-px
                       bg-gradient-to-r
                       from-transparent
                       via-white/20
                       to-transparent"
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
                    class="lg:col-span-5"
                    data-aos="fade-right"
                >
                    <div
                        class="flex items-center gap-3"
                    >
                        <span
                            class="h-px w-8
                                   bg-[#E2BD45]"
                            aria-hidden="true"
                        ></span>

                        <p
                            class="text-[10px] font-bold
                                   uppercase
                                   tracking-[0.22em]
                                   text-[#F2D56F]"
                        >
                            Informasi Lokasi
                        </p>
                    </div>


                    <h2
                        class="mt-5 max-w-xl
                               text-3xl font-semibold
                               leading-tight
                               tracking-[-0.025em]
                               text-white
                               sm:text-4xl
                               lg:text-5xl"
                        style="
                            font-family:
                                'Space Grotesk',
                                'Plus Jakarta Sans',
                                sans-serif;
                        "
                    >
                        Denah Gedung Jurusan Teknik Mesin
                    </h2>


                    <p
                        class="mt-6 max-w-xl
                               text-sm leading-7
                               text-blue-100/70
                               sm:text-base
                               sm:leading-8"
                    >
                        Dokumen denah gedung membantu mahasiswa,
                        dosen, staf, dan pengunjung mengenali lokasi
                        ruang pembelajaran serta fasilitas pendukung
                        di lingkungan Jurusan Teknik Mesin
                        Politeknik Negeri Malang.
                    </p>


                    <div
                        class="mt-8 flex flex-col gap-3
                               sm:flex-row sm:flex-wrap"
                    >
                        <a
                            href="{{ $floorPlanUrl }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="inline-flex items-center
                                   justify-center gap-3
                                   rounded-xl
                                   bg-[#E2BD45]
                                   px-6 py-3.5
                                   text-sm font-bold
                                   text-[#031D36]
                                   shadow-lg
                                   shadow-yellow-900/10
                                   transition
                                   hover:bg-[#F2D56F]"
                        >
                            <i
                                class="fa-solid
                                       fa-up-right-from-square"
                                aria-hidden="true"
                            ></i>

                            Lihat Denah
                        </a>


                        <a
                            href="{{ $floorPlanUrl }}"
                            download
                            class="inline-flex items-center
                                   justify-center gap-3
                                   rounded-xl
                                   border border-white/20
                                   bg-white/[0.07]
                                   px-6 py-3.5
                                   text-sm font-bold
                                   text-white
                                   backdrop-blur-sm
                                   transition
                                   hover:border-white/35
                                   hover:bg-white/[0.12]"
                        >
                            <i
                                class="fa-solid fa-download"
                                aria-hidden="true"
                            ></i>

                            Unduh PDF
                        </a>
                    </div>


                    <div
                        class="mt-8 flex items-center gap-3
                               text-xs font-medium
                               text-white/45"
                    >
                        <i
                            class="fa-regular fa-file-pdf"
                            aria-hidden="true"
                        ></i>

                        <span>
                            Dokumen denah dalam format PDF
                        </span>
                    </div>
                </div>


                {{-- ================================================= --}}
                {{-- PREVIEW PDF --}}
                {{-- ================================================= --}}

                <div
                    class="lg:col-span-7"
                    data-aos="fade-left"
                >
                    <div
                        class="overflow-hidden rounded-[1.75rem]
                               border border-white/15
                               bg-white/[0.08]
                               p-2 shadow-2xl
                               shadow-slate-950/30
                               backdrop-blur-sm
                               sm:p-3"
                    >
                        {{-- Header preview --}}
                        <div
                            class="flex items-center
                                   justify-between gap-4
                                   px-4 py-3
                                   sm:px-5"
                        >
                            <div class="min-w-0">
                                <p
                                    class="text-[9px] font-bold
                                           uppercase
                                           tracking-[0.18em]
                                           text-[#F2D56F]"
                                >
                                    Pratinjau Dokumen
                                </p>

                                <p
                                    class="mt-1 truncate
                                           text-sm font-semibold
                                           text-white/85"
                                >
                                    Denah Gedung Teknik Mesin
                                </p>
                            </div>


                            <span
                                class="flex h-9 w-9
                                       shrink-0 items-center
                                       justify-center
                                       rounded-lg
                                       bg-white/10
                                       text-red-300"
                            >
                                <i
                                    class="fa-regular fa-file-pdf"
                                    aria-hidden="true"
                                ></i>
                            </span>
                        </div>


                        {{-- Desktop --}}
                        <div
                            class="hidden overflow-hidden
                                   rounded-[1.25rem]
                                   bg-white
                                   md:block"
                        >
                            <iframe
                                src="{{ $floorPlanUrl }}#toolbar=1&navpanes=0&scrollbar=1"
                                class="h-[560px] w-full"
                                title="Denah Gedung Jurusan Teknik Mesin"
                                loading="lazy"
                            ></iframe>
                        </div>


                        {{-- Mobile --}}
                        <div
                            class="rounded-[1.25rem]
                                   bg-white px-6 py-10
                                   text-center md:hidden"
                        >
                            <span
                                class="mx-auto flex h-16 w-16
                                       items-center justify-center
                                       rounded-2xl bg-red-50
                                       text-2xl text-red-600"
                            >
                                <i
                                    class="fa-regular fa-file-pdf"
                                    aria-hidden="true"
                                ></i>
                            </span>

                            <h3
                                class="mt-5 text-xl font-bold
                                       text-slate-900"
                            >
                                Denah Gedung
                            </h3>

                            <p
                                class="mx-auto mt-3 max-w-sm
                                       text-sm leading-7
                                       text-slate-500"
                            >
                                Buka dokumen untuk melihat denah
                                dengan ukuran yang lebih nyaman
                                pada perangkat Anda.
                            </p>

                            <a
                                href="{{ $floorPlanUrl }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="mt-6 inline-flex
                                       items-center
                                       justify-center gap-2
                                       rounded-xl
                                       bg-[#075F9B]
                                       px-5 py-3
                                       text-sm font-bold
                                       text-white
                                       transition
                                       hover:bg-[#073763]"
                            >
                                Buka PDF

                                <i
                                    class="fa-solid
                                           fa-arrow-up-right-from-square
                                           text-xs"
                                    aria-hidden="true"
                                ></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif