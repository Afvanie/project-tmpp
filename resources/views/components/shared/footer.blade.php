@php
    $logoPath = 'assets/images/logo.png';

    $logoExists = file_exists(
        public_path($logoPath)
    );

    $quickLinks = [
        [
            'label' => 'Beranda',
            'url' => route('home'),
        ],
        [
            'label' => 'Profil TMPP',
            'url' => route('profile'),
        ],
        [
            'label' => 'Dosen dan Staf',
            'url' => route('lecturers'),
        ],
        [
            'label' => 'Fasilitas',
            'url' => url('/facilities'),
        ],
        [
            'label' => 'Kontak',
            'url' => url('/contact'),
        ],
    ];

    $academicLinks = [
        [
            'label' => 'Pedoman Akademik',
            'slug' => 'pedoman-akademik',
        ],
        [
            'label' => 'Kalender Akademik',
            'slug' => 'kalender-akademik',
        ],
        [
            'label' => 'Kurikulum',
            'slug' => 'kurikulum',
        ],
        [
            'label' => 'Jadwal Kuliah',
            'slug' => 'jadwal-kuliah',
        ],
        [
            'label' => 'Panduan Tugas Akhir',
            'slug' => 'panduan-laporan-tugas-akhir',
        ],
        [
            'label' => 'Panduan Magang Industri',
            'slug' => 'panduan-laporan-pkl',
        ],
    ];
@endphp


<footer
    class="relative overflow-hidden
           bg-[#062844] text-white"
>
    {{-- ========================================================= --}}
    {{-- DEKORASI LATAR --}}
    {{-- ========================================================= --}}

    <div
        class="pointer-events-none absolute inset-0"
        aria-hidden="true"
    >
        <div
            class="absolute inset-0
                   bg-gradient-to-br
                   from-[#05253F]
                   via-[#073E69]
                   to-[#075F9B]"
        ></div>

        <div
            class="absolute -left-40 top-10
                   h-[480px] w-[480px]
                   rounded-full bg-blue-400/10
                   blur-[140px]"
        ></div>

        <div
            class="absolute -right-40 bottom-0
                   h-[480px] w-[480px]
                   rounded-full bg-yellow-300/10
                   blur-[140px]"
        ></div>

        <div
            class="absolute inset-0 opacity-[0.045]"
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
                background-size: 64px 64px;
            "
        ></div>

        <div
            class="absolute -right-20 top-16
                   select-none text-[150px]
                   font-black leading-none
                   text-white/[0.025]
                   md:text-[240px]"
        >
            TMPP
        </div>
    </div>


    {{-- ========================================================= --}}
    {{-- INFORMASI UTAMA --}}
    {{-- ========================================================= --}}

    <div
        class="relative mx-auto
               max-w-7xl px-6
               pb-10 pt-16 md:pt-20"
    >
        {{-- ===================================================== --}}
        {{-- HEADER FOOTER --}}
        {{-- ===================================================== --}}

        <div
            class="mb-14 grid gap-8
                   border-b border-white/10
                   pb-12 lg:grid-cols-12
                   lg:items-end"
        >
            <div class="lg:col-span-8">
                <div
                    class="flex items-center gap-4"
                >
                    <div
                        class="flex h-16 w-16
                               shrink-0 items-center
                               justify-center rounded-2xl
                               bg-white p-2
                               shadow-xl"
                    >
                        @if ($logoExists)
                            <img
                                src="{{ asset($logoPath) }}"
                                alt="Logo Politeknik Negeri Malang"
                                class="h-full w-full
                                       object-contain"
                            >
                        @else
                            <span
                                class="text-lg font-black
                                       text-[#073763]"
                            >
                                TM
                            </span>
                        @endif
                    </div>

                    <div>
                        <p
                            class="text-xs font-bold
                                   uppercase
                                   tracking-[0.22em]
                                   text-[#F4D66E]"
                        >
                            Program Sarjana Terapan
                        </p>

                        <h2
                            class="mt-2 text-2xl
                                   font-extrabold
                                   leading-tight text-white
                                   sm:text-3xl"
                        >
                            D-IV Teknik Mesin Produksi
                            dan Perawatan
                        </h2>

                        <p
                            class="mt-2 text-sm
                                   font-medium
                                   text-blue-100/80"
                        >
                            Jurusan Teknik Mesin ·
                            Politeknik Negeri Malang
                        </p>
                    </div>
                </div>

                <p
                    class="mt-7 max-w-3xl
                           leading-8 text-blue-50/75"
                >
                    Program pendidikan vokasi jenjang Sarjana
                    Terapan yang berfokus pada bidang produksi,
                    manufaktur, perawatan mesin, otomasi industri,
                    dan autonomous maintenance.
                </p>
            </div>


            <div
                class="flex flex-col gap-3
                       sm:flex-row lg:col-span-4
                       lg:justify-end"
            >
                <a
                    href="{{ route('profile') }}"
                    class="inline-flex items-center
                           justify-center gap-2
                           rounded-xl border
                           border-white/20
                           bg-white/10 px-5 py-3
                           text-sm font-bold text-white
                           backdrop-blur-sm
                           transition duration-300
                           hover:-translate-y-0.5
                           hover:bg-white
                           hover:text-[#073763]"
                >
                    Tentang TMPP

                    <span aria-hidden="true">→</span>
                </a>

                <a
                    href="{{ url('/contact') }}"
                    class="inline-flex items-center
                           justify-center gap-2
                           rounded-xl bg-[#D7B33E]
                           px-5 py-3 text-sm
                           font-bold text-slate-900
                           shadow-lg transition
                           duration-300
                           hover:-translate-y-0.5
                           hover:bg-[#F0D570]"
                >
                    <i
                        class="fa-regular fa-envelope"
                        aria-hidden="true"
                    ></i>

                    Hubungi Kami
                </a>
            </div>
        </div>


        {{-- ===================================================== --}}
        {{-- KOLOM FOOTER --}}
        {{-- ===================================================== --}}

        <div
            class="grid gap-12
                   sm:grid-cols-2
                   lg:grid-cols-12"
        >
            {{-- ================================================= --}}
            {{-- NAVIGASI --}}
            {{-- ================================================= --}}

            <div class="lg:col-span-3">
                <div
                    class="mb-6 flex items-center gap-3"
                >
                    <span
                        class="h-2 w-2
                               rounded-full bg-[#F4D66E]"
                    ></span>

                    <h3
                        class="text-base font-bold
                               text-white"
                    >
                        Navigasi
                    </h3>
                </div>

                <ul class="space-y-3">
                    @foreach ($quickLinks as $link)
                        <li>
                            <a
                                href="{{ $link['url'] }}"
                                class="group inline-flex
                                       items-center gap-3
                                       text-sm font-medium
                                       text-blue-50/70
                                       transition duration-300
                                       hover:translate-x-1
                                       hover:text-[#F4D66E]"
                            >
                                <span
                                    class="h-px w-4
                                           bg-white/25
                                           transition
                                           group-hover:w-6
                                           group-hover:bg-[#F4D66E]"
                                ></span>

                                {{ $link['label'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>


            {{-- ================================================= --}}
            {{-- AKADEMIK --}}
            {{-- ================================================= --}}

            <div class="lg:col-span-3">
                <div
                    class="mb-6 flex items-center gap-3"
                >
                    <span
                        class="h-2 w-2
                               rounded-full bg-[#F4D66E]"
                    ></span>

                    <h3
                        class="text-base font-bold
                               text-white"
                    >
                        Informasi Akademik
                    </h3>
                </div>

                <ul class="space-y-3">
                    @foreach ($academicLinks as $link)
                        <li>
                            <a
                                href="{{ route(
                                    'academic.page',
                                    $link['slug']
                                ) }}"
                                class="group inline-flex
                                       items-center gap-3
                                       text-sm font-medium
                                       text-blue-50/70
                                       transition duration-300
                                       hover:translate-x-1
                                       hover:text-[#F4D66E]"
                            >
                                <span
                                    class="h-1.5 w-1.5
                                           rounded-full
                                           bg-blue-200/40
                                           transition
                                           group-hover:bg-[#F4D66E]"
                                ></span>

                                {{ $link['label'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>


            {{-- ================================================= --}}
            {{-- ALAMAT --}}
            {{-- ================================================= --}}

            <div class="lg:col-span-3">
                <div
                    class="mb-6 flex items-center gap-3"
                >
                    <span
                        class="h-2 w-2
                               rounded-full bg-[#F4D66E]"
                    ></span>

                    <h3
                        class="text-base font-bold
                               text-white"
                    >
                        Lokasi Kampus
                    </h3>
                </div>

                <div
                    class="flex items-start gap-4"
                >
                    <span
                        class="flex h-11 w-11
                               shrink-0 items-center
                               justify-center rounded-xl
                               border border-white/10
                               bg-white/10
                               text-[#F4D66E]"
                    >
                        <i
                            class="fa-solid
                                   fa-location-dot"
                            aria-hidden="true"
                        ></i>
                    </span>

                    <address
                        class="not-italic text-sm
                               leading-7 text-blue-50/70"
                    >
                        Program Studi D-IV Teknik Mesin
                        Produksi dan Perawatan
                        <br>

                        Jurusan Teknik Mesin
                        <br>

                        Politeknik Negeri Malang
                        <br>

                        Jl. Soekarno Hatta No. 9,
                        Malang, Jawa Timur
                    </address>
                </div>

                <a
                    href="{{ url('/contact') }}"
                    class="mt-6 inline-flex
                           items-center gap-2
                           text-sm font-bold
                           text-[#F4D66E]
                           transition
                           hover:text-white"
                >
                    Informasi Kontak

                    <span aria-hidden="true">→</span>
                </a>
            </div>


            {{-- ================================================= --}}
            {{-- MEDIA SOSIAL --}}
            {{-- ================================================= --}}

            <div class="lg:col-span-3">
                <div
                    class="mb-6 flex items-center gap-3"
                >
                    <span
                        class="h-2 w-2
                               rounded-full bg-[#F4D66E]"
                    ></span>

                    <h3
                        class="text-base font-bold
                               text-white"
                    >
                        Kanal Jurusan
                    </h3>
                </div>

                <p
                    class="text-sm leading-7
                           text-blue-50/70"
                >
                    Informasi dan dokumentasi kegiatan
                    Jurusan Teknik Mesin Politeknik Negeri Malang.
                </p>

                <div class="mt-6 flex gap-3">
                    <a
                        href="https://www.instagram.com/polinema.jtm/"
                        target="_blank"
                        rel="noopener noreferrer"
                        aria-label="Instagram Jurusan Teknik Mesin Polinema"
                        class="flex h-11 w-11
                               items-center justify-center
                               rounded-xl border
                               border-white/10
                               bg-white/10
                               text-lg text-white
                               transition duration-300
                               hover:-translate-y-1
                               hover:border-pink-400/50
                               hover:bg-pink-600"
                    >
                        <i
                            class="fa-brands fa-instagram"
                            aria-hidden="true"
                        ></i>
                    </a>

                    <a
                        href="https://www.youtube.com/@jtmpolinema455"
                        target="_blank"
                        rel="noopener noreferrer"
                        aria-label="YouTube Jurusan Teknik Mesin Polinema"
                        class="flex h-11 w-11
                               items-center justify-center
                               rounded-xl border
                               border-white/10
                               bg-white/10
                               text-lg text-white
                               transition duration-300
                               hover:-translate-y-1
                               hover:border-red-400/50
                               hover:bg-red-600"
                    >
                        <i
                            class="fa-brands fa-youtube"
                            aria-hidden="true"
                        ></i>
                    </a>
                </div>

                <div
                    class="mt-7 rounded-2xl
                           border border-white/10
                           bg-white/[0.07] p-5
                           backdrop-blur-sm"
                >
                    <div
                        class="flex items-center gap-3"
                    >
                        <span
                            class="flex h-9 w-9
                                   shrink-0 items-center
                                   justify-center rounded-lg
                                   bg-[#D7B33E]
                                   text-slate-900"
                        >
                            <i
                                class="fa-solid fa-gears"
                                aria-hidden="true"
                            ></i>
                        </span>

                        <div>
                            <p
                                class="text-sm font-bold
                                       text-white"
                            >
                                D-IV TMPP
                            </p>

                            <p
                                class="mt-0.5 text-xs
                                       text-blue-100/65"
                            >
                                Produksi · Perawatan · Teknologi
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{-- ===================================================== --}}
        {{-- BAGIAN BAWAH --}}
        {{-- ===================================================== --}}

        <div
            class="mt-14 flex flex-col
                   gap-5 border-t
                   border-white/10 pt-7
                   md:flex-row
                   md:items-center
                   md:justify-between"
        >
            <p
                class="text-center text-xs
                       leading-6 text-blue-100/55
                       md:text-left"
            >
                &copy; {{ date('Y') }}
                Program Studi D-IV Teknik Mesin Produksi dan
                Perawatan, Politeknik Negeri Malang.
                Hak cipta dilindungi.
            </p>

            <div
                class="flex flex-col
                       items-center gap-3
                       sm:flex-row"
            >
                <p
                    class="text-xs
                           text-blue-100/55"
                >
                    Dikembangkan oleh Afvanie Rama Ardyansah
                </p>

                <button
                    id="backToTopButton"
                    type="button"
                    aria-label="Kembali ke bagian atas halaman"
                    class="flex h-10 w-10
                           items-center justify-center
                           rounded-xl border
                           border-white/10
                           bg-white/10 text-white
                           transition
                           hover:border-[#F4D66E]/50
                           hover:bg-[#F4D66E]
                           hover:text-slate-900"
                >
                    <i
                        class="fa-solid fa-arrow-up"
                        aria-hidden="true"
                    ></i>
                </button>
            </div>
        </div>
    </div>
</footer>


@once
    <script>
        document.addEventListener(
            'DOMContentLoaded',
            function () {
                const backToTopButton =
                    document.getElementById(
                        'backToTopButton'
                    );

                backToTopButton?.addEventListener(
                    'click',
                    function () {
                        window.scrollTo({
                            top: 0,
                            behavior: 'smooth',
                        });
                    }
                );
            }
        );
    </script>
@endonce