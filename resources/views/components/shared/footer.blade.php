<footer class="relative overflow-hidden bg-slate-900 text-white">

    {{-- ================= Background ================= --}}
    <div class="absolute inset-0 -z-10">

        {{-- Blur --}}
        <div class="absolute -top-32 left-0 w-96 h-96 rounded-full bg-blue-600/20 blur-[120px]"></div>

        <div class="absolute bottom-0 right-0 w-96 h-96 rounded-full bg-yellow-400/10 blur-[120px]"></div>

        {{-- Grid --}}
        <div
            class="absolute inset-0 opacity-[0.04]
            bg-[linear-gradient(to_right,#ffffff_1px,transparent_1px),linear-gradient(to_bottom,#ffffff_1px,transparent_1px)]
            bg-[size:60px_60px]">
        </div>

    </div>

    <div class="max-w-7xl mx-auto px-6 py-20">

        <div class="grid lg:grid-cols-4 gap-12">

            {{-- ================= LOGO ================= --}}

            <div>

                <img
                    src="{{ asset('assets/images/logo.png') }}"
                    class="h-20 mb-6"
                    alt="Logo">

                <h3 class="text-2xl font-bold">

                PROGRAM STUDI    
                <br>

                D-III Teknik Mesin

                </h3>

                <p class="mt-5 text-slate-300 leading-8">

                    Program Diploma Teknik
                    Mesin

                    <br><br>

                    Jurusan Teknik Mesin

                    <br>

                    Politeknik Negeri Malang

                </p>

            </div>

            {{-- ================= MENU ================= --}}

            <div>

                <h4
                    class="text-lg font-semibold mb-6 text-yellow-400">

                    Navigasi

                </h4>

                <ul class="space-y-4">

                    <li>

                        <a href="/"
                        class="text-slate-300 hover:text-yellow-400 transition">

                            Beranda

                        </a>

                    </li>

                    <li>

                        <a href="/profile"
                        class="text-slate-300 hover:text-yellow-400 transition">

                            Profile

                        </a>

                    </li>

                    <li>

                        <a href="/lecturers"
                        class="text-slate-300 hover:text-yellow-400 transition">

                            Dosen & Staff

                        </a>

                    </li>

                    <li>

                        <a href="/academic"
                        class="text-slate-300 hover:text-yellow-400 transition">

                            Akademik

                        </a>

                    </li>

                    <li>

                        <a href="/facilities"
                        class="text-slate-300 hover:text-yellow-400 transition">

                            Fasilitas

                        </a>

                    </li>

                </ul>

            </div>

            {{-- ================= KONTAK ================= --}}

            <div>

                <h4
                    class="text-lg font-semibold mb-6 text-yellow-400">

                    Kontak

                </h4>

                <div class="space-y-5 text-slate-300">

                    <p>

                        📍

                        Program Studi D-III Teknik Mesin

                        <br>

                        Politeknik Negeri Malang

                        <br>

                        Jl. Soekarno Hatta No.9

                        Malang

                    </p>

                    <p>

                        ☎ (0341) 404424

                    </p>

                    <p>

                        ✉ Teknikmesin@polinema.ac.id

                    </p>

                </div>

            </div>

            {{-- ================= SOCIAL ================= --}}

            <div>

                <h4
                    class="text-lg font-semibold mb-6 text-yellow-400">

                    Ikuti Kami

                </h4>

                <div class="flex gap-4">

                    <a href="#"
                    class="w-12 h-12 rounded-full bg-white/10 flex items-center justify-center hover:bg-blue-600 transition duration-300">

                        <i class="fab fa-instagram"></i>

                    </a>

                    <a href="#"
                    class="w-12 h-12 rounded-full bg-white/10 flex items-center justify-center hover:bg-red-600 transition duration-300">

                        <i class="fab fa-youtube"></i>

                    </a>

                    <a href="#"
                    class="w-12 h-12 rounded-full bg-white/10 flex items-center justify-center hover:bg-blue-500 transition duration-300">

                        <i class="fab fa-facebook-f"></i>

                    </a>

                    <a href="#"
                    class="w-12 h-12 rounded-full bg-white/10 flex items-center justify-center hover:bg-sky-500 transition duration-300">

                        <i class="fab fa-linkedin-in"></i>

                    </a>

                </div>

                <div
                    class="mt-10 rounded-2xl bg-white/5 p-6 border border-white/10">

                    <h5 class="font-semibold mb-3">

                        Jam Operasional

                    </h5>

                    <p class="text-slate-300">

                        Senin - Jumat

                        <br>

                        07.30 - 16.00 WIB

                    </p>

                </div>

            </div>

        </div>

        {{-- ================= Bottom ================= --}}

        <div
            class="border-t border-white/10 mt-16 pt-8 flex flex-col md:flex-row justify-between items-center">

            <p class="text-slate-400 text-sm">

                © {{ date('Y') }}

                Program Studi D-III Teknik Mesin

                Politeknik Negeri Malang.

                All Rights Reserved.

            </p>

            <p class="text-slate-400 text-sm mt-4 md:mt-0">

                Made with by Teknik Mesin Polinema

            </p>

        </div>

    </div>

</footer>