@php
    $contactItems = [
        [
            'title' => 'Alamat Program Studi',
            'value' => 'Gedung Jurusan Teknik Mesin, Politeknik Negeri Malang',
            'description' => 'Jl. Soekarno Hatta No. 9, Malang, Jawa Timur',
            'icon' => 'location',
        ],
        [
            'title' => 'Email',
            'value' => 'tmpp@polinema.ac.id',
            'description' => 'Silakan sesuaikan dengan email resmi program studi.',
            'icon' => 'email',
        ],
        [
            'title' => 'Telepon',
            'value' => '(0341) 404424',
            'description' => 'Layanan informasi akademik dan administrasi.',
            'icon' => 'phone',
        ],
        [
            'title' => 'Jam Layanan',
            'value' => 'Senin - Jumat',
            'description' => '08.00 - 16.00 WIB',
            'icon' => 'clock',
        ],
    ];
@endphp

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
                Informasi Kontak
            </span>

            <h2 class="mt-4 text-4xl md:text-5xl font-bold text-slate-800 leading-tight">
                Terhubung dengan Program Studi
            </h2>

            <div class="w-24 h-1 bg-yellow-400 rounded-full mx-auto mt-6"></div>

            <p class="mt-7 text-slate-600 leading-8">
                Program Studi D-IV Teknik Mesin Produksi dan Perawatan Politeknik Negeri Malang terbuka untuk
                informasi akademik, layanan administrasi, kerja sama, dan kebutuhan komunikasi lainnya.
            </p>

        </div>

        {{-- Contact Cards --}}
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-7">

            @foreach ($contactItems as $item)

                <div
                    class="group relative rounded-3xl bg-white border border-slate-100 shadow-lg p-7 overflow-hidden hover:-translate-y-2 hover:shadow-2xl transition-all duration-500"
                    data-aos="fade-up"
                    data-aos-delay="{{ $loop->index * 100 }}">

                    <div class="absolute -right-12 -top-12 w-36 h-36 rounded-full bg-blue-100 group-hover:bg-yellow-100 transition"></div>

                    <div class="relative">

                        <div class="w-16 h-16 rounded-2xl bg-blue-700 text-white flex items-center justify-center mb-6 shadow-lg group-hover:bg-yellow-400 group-hover:text-slate-900 transition">

                            @if ($item['icon'] === 'location')
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21s7-4.438 7-11a7 7 0 10-14 0c0 6.562 7 11 7 11z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10a2 2 0 100-4 2 2 0 000 4z" />
                                </svg>
                            @elseif ($item['icon'] === 'email')
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l9 6 9-6M5 6h14a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2z" />
                                </svg>
                            @elseif ($item['icon'] === 'phone')
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.3a1 1 0 01.95.68l1.1 3.3a1 1 0 01-.27 1.04l-2 2a16 16 0 006.9 6.9l2-2a1 1 0 011.04-.27l3.3 1.1a1 1 0 01.68.95V19a2 2 0 01-2 2h-1C10.82 21 3 13.18 3 6V5z" />
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v5l3 3M12 22a10 10 0 100-20 10 10 0 000 20z" />
                                </svg>
                            @endif

                        </div>

                        <span class="inline-block px-3 py-1 rounded-full bg-blue-50 text-blue-700 text-xs font-semibold mb-4">
                            {{ $item['title'] }}
                        </span>

                        <h3 class="text-xl font-bold text-slate-800 leading-snug">
                            {{ $item['value'] }}
                        </h3>

                        <p class="mt-4 text-slate-600 leading-7">
                            {{ $item['description'] }}
                        </p>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</section>