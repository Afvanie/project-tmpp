<section class="relative py-24 overflow-hidden bg-gradient-to-br from-slate-50 via-white to-blue-50">

    {{-- Background Decoration --}}
    <div class="absolute inset-0 -z-10">

        <div class="absolute -top-40 -right-40 w-[520px] h-[520px] rounded-full bg-blue-200/30 blur-[140px]"></div>

        <div class="absolute -bottom-40 -left-40 w-[520px] h-[520px] rounded-full bg-yellow-200/30 blur-[140px]"></div>

        <div
            class="absolute inset-0 opacity-[0.03]"
            style="background-image: linear-gradient(#0f172a 1px, transparent 1px),
            linear-gradient(to right,#0f172a 1px,transparent 1px);
            background-size:70px 70px;">
        </div>

    </div>

    <div class="max-w-7xl mx-auto px-6">

        <div class="grid lg:grid-cols-2 gap-14 items-center">

            {{-- Left Content --}}
            <div data-aos="fade-right">

                <span class="uppercase tracking-[5px] text-blue-700 font-semibold">
                    Media Sosial
                </span>

                <h2 class="mt-4 text-4xl md:text-5xl font-bold text-slate-800 leading-tight">
                    Ikuti Instagram Kami
                </h2>

                <div class="w-24 h-1 bg-yellow-400 rounded-full mt-6 mb-8"></div>

                <p class="text-slate-600 leading-8 text-justify">
                    Dapatkan informasi terbaru seputar kegiatan akademik, praktikum,
                    fasilitas, dokumentasi mahasiswa, serta berbagai aktivitas di
                    lingkungan Jurusan Teknik Mesin Politeknik Negeri Malang melalui
                    akun Instagram resmi kami.
                </p>

                <a href="https://www.instagram.com/polinema.jtm"
                   target="_blank"
                   class="inline-flex items-center gap-3 mt-9 px-7 py-4 rounded-2xl bg-gradient-to-r from-blue-700 to-blue-600 text-white font-bold shadow-lg hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">

                    <i class="fa-brands fa-instagram text-2xl"></i>

                    Kunjungi Instagram

                </a>

            </div>

            {{-- Right Instagram Card --}}
            <div data-aos="fade-left">

                <div class="relative">

                    <div class="absolute -top-8 -right-8 w-52 h-52 rounded-full bg-yellow-200/50 blur-3xl"></div>

                    <div class="absolute -bottom-8 -left-8 w-56 h-56 rounded-full bg-blue-200/50 blur-3xl"></div>

                    <div class="relative rounded-[2rem] bg-white border border-slate-100 shadow-2xl overflow-hidden">

                        {{-- Card Header --}}
                        <div class="bg-gradient-to-r from-[#003B73] via-[#005BAC] to-[#003B73] p-6">

                            <div class="flex items-center gap-4">

                                <div class="w-16 h-16 rounded-2xl bg-white p-2 shadow-lg">

                                    <img src="{{ asset('assets/images/logo.png') }}"
                                         alt="Logo Polinema"
                                         class="w-full h-full object-contain">

                                </div>

                                <div>

                                    <h3 class="text-white text-xl font-bold">
                                        Jurusan Teknik Mesin
                                    </h3>

                                    <p class="text-yellow-300 font-semibold">
                                        Politeknik Negeri Malang
                                    </p>

                                </div>

                            </div>

                        </div>

                        {{-- Instagram Preview --}}
                        <div class="p-7">

                            <div class="flex items-center gap-4 mb-7">

                                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-pink-500 via-red-500 to-yellow-400 text-white flex items-center justify-center shadow-lg">

                                    <i class="fa-brands fa-instagram text-2xl"></i>

                                </div>

                                <div>

                                    <h4 class="text-xl font-bold text-slate-800">
                                        @polinema.jtm
                                    </h4>

                                    <p class="text-slate-500">
                                        Official Instagram
                                    </p>

                                </div>

                            </div>

                            <div class="grid grid-cols-3 gap-3">

                                <div class="aspect-square rounded-2xl bg-blue-100 overflow-hidden">
                                    <img src="{{ asset('assets/images/instagram-1.webp') }}"
                                         alt="Instagram 1"
                                         class="w-full h-full object-cover">
                                </div>

                                <div class="aspect-square rounded-2xl bg-yellow-100 overflow-hidden">
                                    <img src="{{ asset('assets/images/instagram-2.webp') }}"
                                         alt="Instagram 2"
                                         class="w-full h-full object-cover">
                                </div>

                                <div class="aspect-square rounded-2xl bg-blue-100 overflow-hidden">
                                    <img src="{{ asset('assets/images/instagram-3.webp') }}"
                                         alt="Instagram 3"
                                         class="w-full h-full object-cover">
                                </div>

                            </div>

                            <p class="mt-6 text-slate-600 leading-7">
                                Ikuti kami untuk melihat dokumentasi kegiatan, informasi akademik,
                                dan aktivitas mahasiswa Jurusan Teknik Mesin Polinema.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>