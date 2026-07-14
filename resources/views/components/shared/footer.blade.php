<footer class="relative overflow-hidden bg-slate-900 text-white">

    {{-- ========================================================= --}}
    {{-- BACKGROUND DECORATION --}}
    {{-- ========================================================= --}}

    <div
        class="pointer-events-none absolute inset-0"
        aria-hidden="true"
    >
        <div
            class="absolute -top-32 left-0
                   h-96 w-96 rounded-full
                   bg-blue-600/20 blur-[120px]"
        ></div>

        <div
            class="absolute bottom-0 right-0
                   h-96 w-96 rounded-full
                   bg-yellow-400/10 blur-[120px]"
        ></div>

        <div
            class="absolute inset-0 opacity-[0.04]
                   bg-[linear-gradient(to_right,#ffffff_1px,transparent_1px),linear-gradient(to_bottom,#ffffff_1px,transparent_1px)]
                   bg-[size:60px_60px]"
        ></div>
    </div>


    <div class="relative mx-auto max-w-7xl px-6 py-16 md:py-20">

        <div
            class="grid gap-12
                   md:grid-cols-2
                   lg:grid-cols-4"
        >

            {{-- ================================================= --}}
            {{-- IDENTITAS PROGRAM STUDI --}}
            {{-- ================================================= --}}

            <div>
                <a
                    href="{{ route('home') }}"
                    class="inline-flex items-center"
                    aria-label="Beranda D-IV TMPP Polinema"
                >
                    <img
                        src="{{ asset('assets/images/logo.png') }}"
                        class="mb-6 h-20 w-auto object-contain"
                        alt="Logo Politeknik Negeri Malang"
                    >
                </a>

                <h3
                    class="text-xl font-bold leading-tight
                           sm:text-2xl"
                >
                    Program Studi
                    <span class="mt-1 block text-yellow-400">
                        D-IV TMPP
                    </span>
                </h3>

                <p
                    class="mt-5 max-w-sm
                           leading-7 text-slate-300"
                >
                    Program Diploma Empat Teknik Mesin Produksi
                    dan Perawatan di lingkungan Jurusan Teknik Mesin,
                    Politeknik Negeri Malang.
                </p>

                <div
                    class="mt-6 inline-flex items-center
                           gap-2 rounded-full
                           border border-white/10
                           bg-white/5 px-4 py-2
                           text-xs font-semibold
                           uppercase tracking-wider
                           text-slate-300"
                >
                    <span
                        class="h-2 w-2 rounded-full
                               bg-yellow-400"
                    ></span>

                    Sarjana Terapan
                </div>
            </div>


            {{-- ================================================= --}}
            {{-- NAVIGASI --}}
            {{-- ================================================= --}}

            <div>
                <h4
                    class="mb-6 text-lg font-semibold
                           text-yellow-400"
                >
                    Navigasi
                </h4>

                <ul class="space-y-4">
                    <li>
                        <a
                            href="{{ route('home') }}"
                            class="text-slate-300
                                   transition
                                   hover:text-yellow-400"
                        >
                            Beranda
                        </a>
                    </li>

                    <li>
                        <a
                            href="{{ route('profile') }}"
                            class="text-slate-300
                                   transition
                                   hover:text-yellow-400"
                        >
                            Profil TMPP
                        </a>
                    </li>

                    <li>
                        <a
                            href="{{ route('lecturers') }}"
                            class="text-slate-300
                                   transition
                                   hover:text-yellow-400"
                        >
                            Dosen &amp; Staf
                        </a>
                    </li>

                    <li>
                        <a
                            href="{{ route('academic') }}"
                            class="text-slate-300
                                   transition
                                   hover:text-yellow-400"
                        >
                            Akademik
                        </a>
                    </li>

                    <li>
                        <a
                            href="{{ url('/facilities') }}"
                            class="text-slate-300
                                   transition
                                   hover:text-yellow-400"
                        >
                            Fasilitas
                        </a>
                    </li>

                    <li>
                        <a
                            href="{{ url('/contact') }}"
                            class="text-slate-300
                                   transition
                                   hover:text-yellow-400"
                        >
                            Kontak
                        </a>
                    </li>
                </ul>
            </div>


            {{-- ================================================= --}}
            {{-- KONTAK --}}
            {{-- ================================================= --}}

            <div>
                <h4
                    class="mb-6 text-lg font-semibold
                           text-yellow-400"
                >
                    Lokasi
                </h4>

                <div class="space-y-5 text-slate-300">

                    <div class="flex items-start gap-3">
                        <span
                            class="mt-1 flex h-9 w-9 shrink-0
                                   items-center justify-center
                                   rounded-xl bg-white/10
                                   text-yellow-400"
                        >
                            <i
                                class="fa-solid fa-location-dot"
                                aria-hidden="true"
                            ></i>
                        </span>

                        <p class="leading-7">
                            Program Studi D-IV Teknik Mesin
                            Produksi dan Perawatan
                            <br>

                            Jurusan Teknik Mesin
                            <br>

                            Politeknik Negeri Malang
                            <br>

                            Jl. Soekarno Hatta No. 9, Malang
                        </p>
                    </div>

                    <a
                        href="{{ url('/contact') }}"
                        class="inline-flex items-center gap-2
                               rounded-xl border
                               border-white/10
                               bg-white/5 px-4 py-3
                               font-semibold text-white
                               transition
                               hover:border-yellow-400/40
                               hover:bg-yellow-400
                               hover:text-slate-900"
                    >
                        <i
                            class="fa-solid fa-envelope"
                            aria-hidden="true"
                        ></i>

                        Lihat Informasi Kontak
                    </a>
                </div>
            </div>


            {{-- ================================================= --}}
            {{-- MEDIA SOSIAL --}}
            {{-- ================================================= --}}

            <div>
                <h4
                    class="mb-6 text-lg font-semibold
                           text-yellow-400"
                >
                    Media Sosial Jurusan
                </h4>

                <p
                    class="mb-5 leading-7
                           text-slate-300"
                >
                    Ikuti informasi dan kegiatan Jurusan Teknik Mesin
                    Politeknik Negeri Malang melalui kanal berikut.
                </p>

                <div class="flex gap-4">
                    <a
                        href="https://www.instagram.com/polinema.jtm/"
                        target="_blank"
                        rel="noopener noreferrer"
                        aria-label="Instagram Jurusan Teknik Mesin Polinema"
                        class="flex h-12 w-12
                               items-center justify-center
                               rounded-full bg-white/10
                               text-lg transition duration-300
                               hover:-translate-y-1
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
                        class="flex h-12 w-12
                               items-center justify-center
                               rounded-full bg-white/10
                               text-lg transition duration-300
                               hover:-translate-y-1
                               hover:bg-red-600"
                    >
                        <i
                            class="fa-brands fa-youtube"
                            aria-hidden="true"
                        ></i>
                    </a>
                </div>

                <div
                    class="mt-10 rounded-2xl
                           border border-white/10
                           bg-white/5 p-6"
                >
                    <h5 class="font-semibold text-white">
                        D-IV TMPP Polinema
                    </h5>

                    <p
                        class="mt-3 text-sm
                               leading-6 text-slate-300"
                    >
                        Pendidikan vokasi bidang produksi,
                        manufaktur, perawatan mesin, dan
                        autonomous maintenance.
                    </p>
                </div>
            </div>

        </div>


        {{-- ===================================================== --}}
        {{-- FOOTER BOTTOM --}}
        {{-- ===================================================== --}}

        <div
            class="mt-16 flex flex-col
                   items-center justify-between gap-4
                   border-t border-white/10 pt-8
                   text-center md:flex-row md:text-left"
        >
            <p
                class="text-sm leading-6
                       text-slate-400"
            >
                &copy; {{ date('Y') }}
                Program Studi D-IV Teknik Mesin Produksi dan Perawatan,
                Politeknik Negeri Malang.
                Hak cipta dilindungi.
            </p>

            <p class="text-sm text-slate-400">
                Dikembangkan oleh Afvanie Rama Ardyansah
            </p>
        </div>

    </div>

</footer>