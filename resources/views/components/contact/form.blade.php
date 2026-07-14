<section class="relative py-24 bg-white overflow-hidden">

    {{-- Background Decoration --}}
    <div class="absolute inset-0 pointer-events-none">

        <div class="absolute -left-40 top-20 w-[500px] h-[500px] rounded-full bg-blue-200/20 blur-[140px]"></div>

        <div class="absolute -right-40 bottom-20 w-[500px] h-[500px] rounded-full bg-yellow-200/20 blur-[140px]"></div>

        <div class="absolute inset-0 opacity-[0.03]"
            style="background-image: linear-gradient(#0f172a 1px, transparent 1px),
            linear-gradient(to right,#0f172a 1px,transparent 1px);
            background-size:70px 70px;">
        </div>

    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-6">

        <div class="grid lg:grid-cols-12 gap-12 items-start">

            {{-- Left Content --}}
            <div class="lg:col-span-5" data-aos="fade-right">

                <span class="uppercase tracking-[5px] text-blue-700 font-semibold">
                    Kirim Pesan
                </span>

                <h2 class="mt-4 text-4xl md:text-5xl font-bold text-slate-800 leading-tight">
                    Ada pertanyaan terkait Program Studi?
                </h2>

                <div class="w-24 h-1 bg-yellow-400 rounded-full mt-6 mb-8"></div>

                <p class="text-slate-600 leading-8 text-justify">
                    Silakan hubungi Program Studi D-IV Teknik Mesin Produksi dan Perawatan untuk informasi
                    mengenai akademik, administrasi, kerja sama, kegiatan mahasiswa,
                    maupun kebutuhan komunikasi lainnya.
                </p>

                <div class="mt-8 space-y-4">

                    <div class="flex items-start gap-4 rounded-2xl bg-slate-50 border border-slate-100 p-5">

                        <div class="w-11 h-11 rounded-xl bg-blue-700 text-white flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-6 h-6"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">

                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M12 22a10 10 0 100-20 10 10 0 000 20z" />
                            </svg>
                        </div>

                        <div>
                            <h3 class="font-bold text-slate-800">
                                Catatan
                            </h3>

                            <p class="mt-1 text-slate-600 leading-7">
                                Form ini untuk sementara masih tampilan statis.
                                Nanti bisa dihubungkan ke email, database, atau dashboard admin.
                            </p>
                        </div>

                    </div>

                    <div class="flex items-start gap-4 rounded-2xl bg-yellow-50 border border-yellow-100 p-5">

                        <div class="w-11 h-11 rounded-xl bg-yellow-400 text-slate-900 flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-6 h-6"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">

                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 8v4l3 3M12 22a10 10 0 100-20 10 10 0 000 20z" />
                            </svg>
                        </div>

                        <div>
                            <h3 class="font-bold text-slate-800">
                                Waktu Respon
                            </h3>

                            <p class="mt-1 text-slate-600 leading-7">
                                Pesan akan ditindaklanjuti pada jam layanan akademik.
                            </p>
                        </div>

                    </div>

                </div>

            </div>

            {{-- Right Form --}}
            <div class="lg:col-span-7" data-aos="fade-left">

                <div class="rounded-[2rem] bg-white border border-slate-100 shadow-xl overflow-hidden">

                    <div class="h-2 bg-gradient-to-r from-blue-700 via-yellow-400 to-blue-700"></div>

                    <div class="p-7 md:p-10">

                        <h3 class="text-3xl font-bold text-slate-800">
                            Form Kontak
                        </h3>

                        <p class="mt-3 text-slate-500 leading-7">
                            Isi data berikut untuk mengirim pesan kepada Program Studi D-IV Teknik Mesin Produksi dan Perawatan.
                        </p>

                        <form id="contactForm" class="mt-8 space-y-6">

                            <div class="grid md:grid-cols-2 gap-6">

                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                                        Nama Lengkap
                                    </label>

                                    <input
                                        type="text"
                                        name="name"
                                        placeholder="Masukkan nama lengkap"
                                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                                        Email
                                    </label>

                                    <input
                                        type="email"
                                        name="email"
                                        placeholder="Masukkan email"
                                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>

                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">
                                    Subjek
                                </label>

                                <input
                                    type="text"
                                    name="subject"
                                    placeholder="Masukkan subjek pesan"
                                    class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">
                                    Pesan
                                </label>

                                <textarea
                                    name="message"
                                    rows="6"
                                    placeholder="Tulis pesan Anda"
                                    class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                            </div>

                            <button
                                type="submit"
                                class="inline-flex items-center justify-center gap-3 rounded-2xl bg-blue-700 px-7 py-4 text-white font-bold shadow-lg hover:bg-blue-800 hover:-translate-y-1 transition-all duration-300">

                                Kirim Pesan

                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>

                            </button>

                        </form>

                        <div
                            id="contactAlert"
                            class="hidden mt-6 rounded-2xl bg-blue-50 border border-blue-100 p-5 text-blue-700 leading-7">

                            Form kontak saat ini masih berupa tampilan statis. Fitur pengiriman pesan dapat dihubungkan ke backend pada tahap berikutnya.

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('contactForm');
        const alertBox = document.getElementById('contactAlert');

        if (!form || !alertBox) {
            return;
        }

        form.addEventListener('submit', function (event) {
            event.preventDefault();

            alertBox.classList.remove('hidden');

            alertBox.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
        });
    });
</script>