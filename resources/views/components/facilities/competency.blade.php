@php
    /*
    |--------------------------------------------------------------------------
    | KOMPETENSI PENDUKUNG
    |--------------------------------------------------------------------------
    |
    | Bagian ini merupakan informasi pendukung statis.
    | Data fasilitas dan dokumentasi tetap dikelola melalui admin.
    |
    */

    $competencies = [
        [
            'title' => 'Praktik Teknis',
            'description' =>
                'Mendukung kegiatan produksi, perakitan, penggunaan peralatan, dan perawatan mesin.',
            'icon' => 'fa-screwdriver-wrench',
            'theme' => 'blue',
        ],

        [
            'title' => 'Pengujian',
            'description' =>
                'Mendukung proses pengukuran, pengujian, analisis data, dan pemecahan masalah teknik.',
            'icon' => 'fa-flask-vial',
            'theme' => 'gold',
        ],

        [
            'title' => 'Pembelajaran Teori',
            'description' =>
                'Mendukung pembelajaran konsep dasar dan terapan melalui diskusi, presentasi, dan penguatan materi.',
            'icon' => 'fa-chalkboard-user',
            'theme' => 'blue',
        ],

        [
            'title' => 'Aktivitas Mahasiswa',
            'description' =>
                'Mendukung praktikum, proyek mahasiswa, serta kegiatan pengembangan kompetensi.',
            'icon' => 'fa-people-group',
            'theme' => 'gold',
        ],
    ];
@endphp


<section
    id="kompetensi-pendukung"
    class="relative overflow-hidden
           border-b border-slate-200
           bg-[#F8FAFC] py-14
           md:py-16 lg:py-20"
>
    {{-- ========================================================= --}}
    {{-- BACKGROUND DECORATION --}}
    {{-- ========================================================= --}}

    <div
        class="pointer-events-none absolute inset-0"
        aria-hidden="true"
    >
        <div
            class="absolute -left-40 top-0
                   h-80 w-80 rounded-full
                   bg-blue-100/40
                   blur-[120px]"
        ></div>

        <div
            class="absolute -right-40 bottom-0
                   h-80 w-80 rounded-full
                   bg-yellow-100/40
                   blur-[120px]"
        ></div>
    </div>


    <div
        class="relative mx-auto
               max-w-7xl px-6"
    >
        <div
            class="grid items-start gap-10
                   lg:grid-cols-12
                   lg:gap-14"
        >
            {{-- ================================================= --}}
            {{-- INFORMASI UTAMA --}}
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
                               bg-[#D7B33E]"
                        aria-hidden="true"
                    ></span>

                    <p
                        class="text-[10px] font-bold
                               uppercase
                               tracking-[0.22em]
                               text-[#075F9B]"
                    >
                        Pembelajaran Berbasis Praktik
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
                    Fasilitas Pendukung Kompetensi Lulusan
                </h2>


                <p
                    class="mt-5 max-w-xl
                           text-sm leading-7
                           text-slate-600
                           sm:text-base
                           sm:leading-8"
                >
                    Laboratorium, workshop, ruang kelas, dan
                    fasilitas pendukung digunakan untuk memperkuat
                    keterampilan teknis, kemampuan analitis, serta
                    kesiapan mahasiswa menghadapi kebutuhan industri.
                </p>


                <div
                    class="mt-7 flex items-center gap-3"
                    aria-hidden="true"
                >
                    <span
                        class="h-1 w-12 rounded-full
                               bg-[#075F9B]"
                    ></span>

                    <span
                        class="h-1 w-6 rounded-full
                               bg-[#D7B33E]"
                    ></span>
                </div>
            </div>


            {{-- ================================================= --}}
            {{-- DAFTAR KOMPETENSI --}}
            {{-- ================================================= --}}

            <div
                class="grid gap-x-8
                       sm:grid-cols-2
                       lg:col-span-7"
                data-aos="fade-left"
            >
                @foreach ($competencies as $competency)
                    @php
                        $isGold =
                            $competency['theme'] === 'gold';
                    @endphp

                    <article
                        class="group relative
                               border-t border-slate-200
                               py-6
                               first:border-t-0
                               sm:[&:nth-child(2)]:border-t-0"
                        data-aos="fade-up"
                        data-aos-delay="{{ min(
                            $loop->index * 70,
                            210
                        ) }}"
                    >
                        <div
                            class="flex items-start gap-4"
                        >
                            {{-- Ikon --}}
                            <span
                                class="flex h-11 w-11
                                       shrink-0 items-center
                                       justify-center
                                       rounded-xl
                                       transition duration-300

                                       {{ $isGold
                                            ? 'bg-yellow-50 text-yellow-700 group-hover:bg-[#D7B33E] group-hover:text-[#031D36]'
                                            : 'bg-blue-50 text-[#075F9B] group-hover:bg-[#075F9B] group-hover:text-white' }}"
                            >
                                <i
                                    class="fa-solid
                                           {{ $competency['icon'] }}"
                                    aria-hidden="true"
                                ></i>
                            </span>


                            {{-- Isi --}}
                            <div class="min-w-0">
                                <div
                                    class="flex items-center gap-3"
                                >
                                    <span
                                        class="text-[10px]
                                               font-bold
                                               text-slate-300"
                                    >
                                        {{ str_pad(
                                            (string) $loop->iteration,
                                            2,
                                            '0',
                                            STR_PAD_LEFT
                                        ) }}
                                    </span>

                                    <span
                                        class="h-px w-6
                                               {{ $isGold
                                                    ? 'bg-[#D7B33E]'
                                                    : 'bg-[#075F9B]' }}"
                                        aria-hidden="true"
                                    ></span>
                                </div>


                                <h3
                                    class="mt-2 text-base
                                           font-bold leading-6
                                           text-slate-900
                                           sm:text-lg"
                                >
                                    {{ $competency['title'] }}
                                </h3>


                                <p
                                    class="mt-2 text-sm
                                           leading-7
                                           text-slate-500"
                                >
                                    {{ $competency['description'] }}
                                </p>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </div>
</section>