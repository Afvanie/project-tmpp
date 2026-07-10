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

        {{-- Heading --}}
        <div class="text-center max-w-3xl mx-auto mb-16" data-aos="fade-up">

            <span class="uppercase tracking-[5px] text-blue-700 font-semibold">
                Fasilitas Pembelajaran
            </span>

            <h2 class="mt-4 text-4xl md:text-5xl font-bold text-slate-800 leading-tight">
                Penunjang Pendidikan Vokasi
            </h2>

            <div class="w-24 h-1 bg-yellow-400 rounded-full mx-auto mt-6"></div>

            <p class="mt-7 text-slate-600 leading-8">
                Program Studi D-III Teknik Mesin memiliki fasilitas pembelajaran dan
                pendukung yang menunjang kegiatan teori, praktik, pengujian, perawatan,
                produksi, pelayanan akademik, kesehatan, ibadah, serta pengembangan
                keterampilan teknis mahasiswa.
            </p>

        </div>


        @php
            $facilities = [
                [
                    'title' => 'Ruang Laboratorium',
                    'label' => 'Praktikum & Pengujian',
                    'description' => 'Ruang laboratorium mendukung kegiatan praktikum, pengujian, pengukuran, desain, simulasi, serta penerapan teknologi teknik mesin yang relevan dengan kebutuhan industri.',
                    'icon' => 'fa-flask',
                    'theme' => 'yellow',
                    'delay' => 0,
                ],
                [
                    'title' => 'Ruang Workshop',
                    'label' => 'Praktik Utama',
                    'description' => 'Ruang workshop digunakan sebagai area praktik utama mahasiswa dalam mengembangkan keterampilan teknis di bidang produksi, manufaktur, perawatan, perakitan, dan penggunaan peralatan kerja teknik mesin.',
                    'icon' => 'fa-screwdriver-wrench',
                    'theme' => 'blue',
                    'delay' => 100,
                ],
                [
                    'title' => 'Ruang Kelas',
                    'label' => 'Pembelajaran Teori',
                    'description' => 'Ruang kelas digunakan untuk mendukung pembelajaran teori, diskusi, presentasi, dan penguatan konsep dasar maupun terapan di bidang teknik mesin.',
                    'icon' => 'fa-book-open',
                    'theme' => 'blue',
                    'delay' => 200,
                ],
                [
                    'title' => 'Ruang Dosen',
                    'label' => 'Konsultasi Akademik',
                    'description' => 'Ruang dosen digunakan sebagai ruang kerja, koordinasi pembelajaran, konsultasi akademik, serta pendampingan mahasiswa oleh dosen Program Studi D-III Teknik Mesin.',
                    'icon' => 'fa-chalkboard-user',
                    'theme' => 'yellow',
                    'delay' => 300,
                ],
                [
                    'title' => 'Ruang Tata Usaha',
                    'label' => 'Layanan Administrasi',
                    'description' => 'Ruang tata usaha mendukung pelayanan administrasi akademik, pengelolaan dokumen, layanan informasi mahasiswa, serta kebutuhan operasional program studi.',
                    'icon' => 'fa-clipboard-list',
                    'theme' => 'blue',
                    'delay' => 0,
                ],
                [
                    'title' => 'Fasilitas Kesehatan',
                    'label' => 'Kesehatan & Keselamatan',
                    'description' => 'Fasilitas kesehatan tersedia untuk mendukung kenyamanan, keselamatan, dan layanan kesehatan dasar bagi mahasiswa, dosen, serta tenaga kependidikan di lingkungan kampus.',
                    'icon' => 'fa-kit-medical',
                    'theme' => 'yellow',
                    'delay' => 100,
                ],
                [
                    'title' => 'Masjid',
                    'label' => 'Fasilitas Ibadah',
                    'description' => 'Masjid menjadi fasilitas ibadah bagi mahasiswa, dosen, tenaga kependidikan, dan masyarakat kampus dalam menunjang kegiatan spiritual di lingkungan Polinema.',
                    'icon' => 'fa-mosque',
                    'theme' => 'blue',
                    'delay' => 200,
                ],
                [
                    'title' => 'Galeri Aktivitas Mahasiswa',
                    'label' => 'Dokumentasi Kegiatan',
                    'description' => 'Galeri menampilkan dokumentasi aktivitas mahasiswa di lingkungan kampus, kegiatan praktikum, proyek mahasiswa, kunjungan industri, organisasi, serta kegiatan akademik dan non-akademik.',
                    'icon' => 'fa-users',
                    'theme' => 'yellow',
                    'delay' => 300,
                ],
            ];
        @endphp


        {{-- Facility Cards --}}
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-7">

            @foreach ($facilities as $facility)

                <div class="group relative rounded-3xl bg-white border border-slate-100 shadow-lg p-7 overflow-hidden hover:-translate-y-2 hover:shadow-2xl transition-all duration-500"
                    data-aos="fade-up"
                    data-aos-delay="{{ $facility['delay'] }}">

                    <div class="absolute -right-12 -top-12 w-36 h-36 rounded-full transition
                        {{ $facility['theme'] === 'blue'
                            ? 'bg-blue-100 group-hover:bg-yellow-100'
                            : 'bg-yellow-100 group-hover:bg-blue-100' }}">
                    </div>

                    <div class="relative">

                        <div class="w-16 h-16 rounded-2xl flex items-center justify-center mb-6 shadow-lg transition
                            {{ $facility['theme'] === 'blue'
                                ? 'bg-blue-700 text-white group-hover:bg-yellow-400 group-hover:text-slate-900'
                                : 'bg-yellow-400 text-slate-900 group-hover:bg-blue-700 group-hover:text-white' }}">

                            <i class="fa-solid {{ $facility['icon'] }} text-3xl"></i>

                        </div>

                        <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold mb-4
                            {{ $facility['theme'] === 'blue'
                                ? 'bg-blue-50 text-blue-700'
                                : 'bg-yellow-50 text-yellow-700' }}">
                            {{ $facility['label'] }}
                        </span>

                        <h3 class="text-2xl font-bold text-slate-800">
                            {{ $facility['title'] }}
                        </h3>

                        <p class="mt-4 text-slate-600 leading-8 text-justify">
                            {{ $facility['description'] }}
                        </p>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</section>