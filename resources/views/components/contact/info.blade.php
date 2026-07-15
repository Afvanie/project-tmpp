@php
    /*
    |--------------------------------------------------------------------------
    | INFORMASI KONTAK
    |--------------------------------------------------------------------------
    |
    | Pastikan email, telepon, dan jam layanan telah dikonfirmasi
    | sebelum website dipublikasikan secara resmi.
    |
    */

    $contactItems = [
        [
            'label' => 'Alamat Program Studi',
            'value' =>
                'Gedung Jurusan Teknik Mesin, Politeknik Negeri Malang',
            'description' =>
                'Jl. Soekarno Hatta No. 9, Malang, Jawa Timur',
            'icon' => 'fa-location-dot',
            'theme' => 'blue',
            'href' => null,
        ],

        [
            'label' => 'Email',
            'value' => 'tmpp@polinema.ac.id',
            'description' =>
                'Layanan komunikasi dan informasi program studi.',
            'icon' => 'fa-envelope',
            'theme' => 'gold',
            'href' => 'mailto:tmpp@polinema.ac.id',
        ],

        [
            'label' => 'Telepon',
            'value' => '(0341) 404424',
            'description' =>
                'Layanan informasi akademik dan administrasi.',
            'icon' => 'fa-phone',
            'theme' => 'blue',
            'href' => 'tel:+62341404424',
        ],

        [
            'label' => 'Jam Layanan',
            'value' => 'Senin – Jumat',
            'description' => '08.00 – 16.00 WIB',
            'icon' => 'fa-clock',
            'theme' => 'gold',
            'href' => null,
        ],
    ];
@endphp


<section
    id="informasi-kontak"
    class="relative overflow-hidden
           border-b border-slate-200
           bg-white py-16
           md:py-20 lg:py-24"
>
    {{-- ========================================================= --}}
    {{-- DEKORASI RINGAN --}}
    {{-- ========================================================= --}}

    <div
        class="pointer-events-none absolute inset-0"
        aria-hidden="true"
    >
        <div
            class="absolute -left-48 top-0
                   h-96 w-96 rounded-full
                   bg-blue-100/35
                   blur-[140px]"
        ></div>

        <div
            class="absolute -right-48 bottom-0
                   h-96 w-96 rounded-full
                   bg-yellow-100/30
                   blur-[140px]"
        ></div>
    </div>


    <div
        class="relative mx-auto
               max-w-7xl px-6"
    >
        <div
            class="grid items-start gap-12
                   lg:grid-cols-12
                   lg:gap-16"
        >
            {{-- ================================================= --}}
            {{-- PENGANTAR --}}
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
                        Informasi Kontak
                    </p>
                </div>


                <h2
                    class="mt-4 max-w-xl
                           text-3xl font-semibold
                           leading-tight
                           tracking-[-0.025em]
                           text-slate-900
                           sm:text-4xl lg:text-5xl"
                    style="
                        font-family:
                            'Space Grotesk',
                            'Plus Jakarta Sans',
                            sans-serif;
                    "
                >
                    Terhubung dengan Program Studi
                </h2>


                <p
                    class="mt-5 max-w-xl
                           text-sm leading-7
                           text-slate-600
                           sm:text-base
                           sm:leading-8"
                >
                    Informasi komunikasi Program Studi D-IV Teknik
                    Mesin Produksi dan Perawatan untuk kebutuhan
                    akademik, administrasi, kerja sama, dan layanan
                    informasi lainnya.
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


                <div
                    class="mt-8 flex items-start gap-4
                           rounded-2xl
                           border border-blue-100
                           bg-blue-50/60 p-5"
                >
                    <span
                        class="flex h-10 w-10
                               shrink-0 items-center
                               justify-center
                               rounded-xl bg-white
                               text-[#075F9B]
                               shadow-sm"
                    >
                        <i
                            class="fa-solid
                                   fa-circle-info"
                            aria-hidden="true"
                        ></i>
                    </span>

                    <p
                        class="text-sm leading-7
                               text-slate-600"
                    >
                        Untuk kunjungan langsung, gunakan informasi
                        lokasi dan jam layanan sebelum mendatangi
                        lingkungan Jurusan Teknik Mesin.
                    </p>
                </div>
            </div>


            {{-- ================================================= --}}
            {{-- DAFTAR KONTAK --}}
            {{-- ================================================= --}}

            <div
                class="overflow-hidden rounded-3xl
                       border border-slate-200
                       bg-[#F8FAFC]
                       shadow-[0_18px_50px_rgba(15,23,42,0.07)]
                       lg:col-span-7"
                data-aos="fade-left"
            >
                @foreach ($contactItems as $item)
                    @php
                        $isGold =
                            $item['theme'] === 'gold';

                        $itemTag =
                            $item['href'] !== null
                                ? 'a'
                                : 'div';
                    @endphp

                    <{{ $itemTag }}
                        @if ($item['href'] !== null)
                            href="{{ $item['href'] }}"
                        @endif
                        class="group flex items-start
                               gap-4 border-b
                               border-slate-200
                               px-5 py-6
                               transition
                               last:border-b-0
                               hover:bg-white
                               sm:gap-5
                               sm:px-7"
                        data-aos="fade-up"
                        data-aos-delay="{{ min(
                            $loop->index * 70,
                            210
                        ) }}"
                    >
                        {{-- Ikon --}}
                        <span
                            class="flex h-12 w-12
                                   shrink-0 items-center
                                   justify-center
                                   rounded-2xl
                                   transition duration-300

                                   {{ $isGold
                                        ? 'bg-yellow-50 text-yellow-700 group-hover:bg-[#D7B33E] group-hover:text-[#031D36]'
                                        : 'bg-blue-50 text-[#075F9B] group-hover:bg-[#075F9B] group-hover:text-white' }}"
                        >
                            <i
                                class="fa-solid
                                       {{ $item['icon'] }}"
                                aria-hidden="true"
                            ></i>
                        </span>


                        {{-- Isi --}}
                        <div class="min-w-0 flex-1">
                            <p
                                class="text-[9px] font-bold
                                       uppercase
                                       tracking-[0.16em]
                                       text-slate-400"
                            >
                                {{ $item['label'] }}
                            </p>

                            <h3
                                class="mt-2 break-words
                                       text-base font-bold
                                       leading-6
                                       text-slate-900
                                       sm:text-lg"
                            >
                                {{ $item['value'] }}
                            </h3>

                            <p
                                class="mt-1 text-sm
                                       leading-6
                                       text-slate-500"
                            >
                                {{ $item['description'] }}
                            </p>
                        </div>


                        @if ($item['href'] !== null)
                            <span
                                class="mt-1 flex h-8 w-8
                                       shrink-0 items-center
                                       justify-center
                                       rounded-full
                                       border border-slate-200
                                       bg-white
                                       text-[10px]
                                       text-slate-400
                                       transition
                                       group-hover:border-blue-200
                                       group-hover:text-[#075F9B]"
                            >
                                <i
                                    class="fa-solid
                                           fa-arrow-up-right-from-square"
                                    aria-hidden="true"
                                ></i>
                            </span>
                        @endif
                    </{{ $itemTag }}>
                @endforeach
            </div>
        </div>
    </div>
</section>