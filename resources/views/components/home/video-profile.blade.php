@php
    /*
    |--------------------------------------------------------------------------
    | VIDEO PROFIL TMPP
    |--------------------------------------------------------------------------
    |
    | Section hanya ditampilkan apabila video resmi TMPP sudah tersedia.
    |
    | Simpan video resmi nantinya di:
    | public/assets/videos/profile-tmpp.mp4
    |
    */

    $videoRelativePath = 'assets/videos/profile-tmpp.mp4';
    $videoUrl = asset($videoRelativePath);
    $videoAvailable = file_exists(public_path($videoRelativePath));
@endphp

@if ($videoAvailable)

    <section
        id="video-profile"
        class="relative overflow-hidden bg-slate-50 py-20 md:py-24"
    >
        {{-- BACKGROUND DECORATION --}}
        <div
            class="pointer-events-none absolute inset-0"
            aria-hidden="true"
        >
            <div
                class="absolute -left-40 top-20
                       h-[520px] w-[520px]
                       rounded-full bg-blue-200/30
                       blur-[150px]"
            ></div>

            <div
                class="absolute -right-40 bottom-20
                       h-[520px] w-[520px]
                       rounded-full bg-yellow-200/30
                       blur-[150px]"
            ></div>

            <div
                class="absolute inset-0 opacity-[0.035]"
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
        </div>

        <div
            class="relative z-10 mx-auto
                   max-w-7xl px-6"
        >
            <div
                class="grid items-center gap-14
                       lg:grid-cols-2"
            >
                {{-- TEXT --}}
                <div data-aos="fade-right">

                    <span
                        class="text-sm font-semibold uppercase
                               tracking-[5px] text-blue-700"
                    >
                        Video Profil
                    </span>

                    <h2
                        class="mt-4 text-3xl font-bold
                               leading-tight text-slate-800
                               sm:text-4xl md:text-5xl"
                    >
                        Mengenal Program Studi D-IV Teknik Mesin
                        Produksi dan Perawatan
                    </h2>

                    <div
                        class="mb-8 mt-6 h-1 w-24
                               rounded-full bg-yellow-400"
                    ></div>

                    <p
                        class="text-justify leading-8
                               text-slate-600"
                    >
                        Video profil ini memberikan pengenalan mengenai
                        Program Studi D-IV Teknik Mesin Produksi dan
                        Perawatan, Jurusan Teknik Mesin, Politeknik
                        Negeri Malang.
                    </p>

                    <p
                        class="mt-6 text-justify leading-8
                               text-slate-600"
                    >
                        Melalui video ini, pengunjung dapat mengenal
                        proses pembelajaran vokasi, kompetensi bidang
                        produksi dan perawatan, fasilitas pendukung,
                        kegiatan mahasiswa, serta arah pengembangan
                        program studi dalam menghadapi kebutuhan
                        dunia industri.
                    </p>

                    <div class="mt-8 flex flex-wrap gap-3">

                        <span
                            class="rounded-xl bg-blue-700
                                   px-4 py-2 text-sm
                                   font-semibold text-white
                                   shadow"
                        >
                            Program Studi
                        </span>

                        <span
                            class="rounded-xl border
                                   border-slate-200 bg-white
                                   px-4 py-2 text-sm
                                   font-semibold text-slate-700
                                   shadow-sm"
                        >
                            D-IV TMPP
                        </span>

                        <span
                            class="rounded-xl bg-yellow-400
                                   px-4 py-2 text-sm
                                   font-semibold text-slate-900
                                   shadow"
                        >
                            Polinema
                        </span>

                    </div>

                </div>

                {{-- VIDEO --}}
                <div
                    class="relative"
                    data-aos="fade-left"
                >
                    {{-- DECORATIVE BACKGROUND --}}
                    <div
                        class="absolute -right-10 -top-10
                               h-44 w-44 rounded-full
                               bg-blue-300/30 blur-3xl"
                        aria-hidden="true"
                    ></div>

                    <div
                        class="absolute -bottom-10 -left-10
                               h-44 w-44 rounded-full
                               bg-yellow-300/40 blur-3xl"
                        aria-hidden="true"
                    ></div>

                    {{-- MAIN VIDEO CARD --}}
                    <div class="relative mx-auto max-w-md">

                        {{-- FLOATING LABEL --}}
                        <div
                            class="absolute -top-5 left-6 z-20
                                   rounded-2xl border
                                   border-slate-100 bg-white
                                   px-5 py-3 shadow-xl"
                        >
                            <p
                                class="text-xs font-bold uppercase
                                       tracking-wider text-blue-700"
                            >
                                Video Profil
                            </p>

                            <p
                                class="text-sm font-semibold
                                       text-slate-700"
                            >
                                Program Studi D-IV TMPP
                            </p>
                        </div>

                        {{-- VIDEO FRAME --}}
                        <div
                            class="relative overflow-hidden
                                   rounded-[2rem] border
                                   border-white bg-white/80
                                   p-4 shadow-2xl
                                   backdrop-blur-xl"
                        >
                            {{-- TOP ACCENT --}}
                            <div
                                class="absolute left-0 right-0 top-0
                                       h-2 bg-gradient-to-r
                                       from-blue-700
                                       via-yellow-400
                                       to-blue-700"
                            ></div>

                            {{-- VIDEO PLAYER --}}
                            <div
                                class="relative mt-3 overflow-hidden
                                       rounded-[1.5rem]
                                       bg-slate-100 shadow-inner"
                            >
                                <video
                                    class="aspect-[9/16]
                                           max-h-[620px]
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

                            {{-- BOTTOM INFORMATION --}}
                            <div
                                class="mt-5 flex items-center
                                       gap-4"
                            >
                                <div
                                    class="flex h-12 w-12
                                           shrink-0 items-center
                                           justify-center rounded-2xl
                                           bg-blue-700 text-white
                                           shadow-lg"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-6 w-6"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        aria-hidden="true"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M14.752 11.168l-5.197-3.027A1 1 0 008 9.027v5.946a1 1 0 001.555.832l5.197-2.973a1 1 0 000-1.664z"
                                        />

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                        />
                                    </svg>
                                </div>

                                <div class="min-w-0">
                                    <h3
                                        class="font-bold
                                               text-slate-800"
                                    >
                                        Video Profil TMPP
                                    </h3>

                                    <p
                                        class="mt-1 text-sm
                                               leading-5 text-slate-500"
                                    >
                                        D-IV Teknik Mesin Produksi
                                        dan Perawatan
                                    </p>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </div>
    </section>

@endif