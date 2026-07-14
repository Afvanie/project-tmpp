@php
    /*
    |--------------------------------------------------------------------------
    | Statistik Program Studi
    |--------------------------------------------------------------------------
    |
    | Hanya statistik yang memiliki nilai yang akan ditampilkan.
    | Data yang masih kosong dapat dilengkapi melalui halaman admin.
    |
    */

    $stats = collect($homeStats ?? [])
        ->filter(function ($stat) {
            return $stat
                && $stat->value !== null
                && trim((string) $stat->value) !== '';
        })
        ->sortBy('sort_order')
        ->values();
@endphp

<section
    id="statistics"
    class="relative overflow-hidden bg-white py-20 md:py-24"
>
    {{-- BACKGROUND DECORATION --}}
    <div
        class="pointer-events-none absolute inset-0 overflow-hidden"
        aria-hidden="true"
    >
        <div
            class="absolute -left-24 top-10
                   h-72 w-72 rounded-full
                   bg-blue-100/40 blur-3xl"
        ></div>

        <div
            class="absolute -right-24 bottom-0
                   h-72 w-72 rounded-full
                   bg-yellow-100/40 blur-3xl"
        ></div>
    </div>

    <div class="relative mx-auto max-w-6xl px-6">

        {{-- HEADING --}}
        <div
            class="mx-auto max-w-3xl text-center"
            data-aos="fade-up"
        >
            <span
                class="inline-flex items-center rounded-full
                       bg-blue-50 px-4 py-2
                       text-sm font-semibold text-blue-700"
            >
                TMPP dalam Angka
            </span>

            <h2
                class="mt-5 text-3xl font-bold
                       leading-tight text-slate-800
                       sm:text-4xl"
            >
                Statistik Program Studi
            </h2>

            <div
                class="mx-auto mt-5 h-1 w-20
                       rounded-full bg-yellow-400"
            ></div>

            <p
                class="mx-auto mt-5 max-w-2xl
                       leading-7 text-slate-500"
            >
                Data singkat Program Studi D-IV Teknik Mesin
                Produksi dan Perawatan Politeknik Negeri Malang.
            </p>
        </div>

        {{-- STATISTIC CARDS --}}
        @if ($stats->isNotEmpty())
            <div
                class="mt-12 grid grid-cols-2 gap-4
                       md:grid-cols-4 md:gap-6"
            >
                @foreach ($stats as $stat)
                    <article
                        class="group relative overflow-hidden
                               rounded-2xl border border-slate-100
                               bg-slate-50 px-4 py-7 text-center
                               shadow-sm transition duration-300
                               hover:-translate-y-1
                               hover:border-blue-100
                               hover:bg-white
                               hover:shadow-xl
                               sm:px-6 sm:py-8"
                        data-aos="fade-up"
                        data-aos-delay="{{ min($loop->index * 100, 300) }}"
                    >
                        {{-- DECORATION --}}
                        <div
                            class="absolute -right-8 -top-8
                                   h-20 w-20 rounded-full
                                   bg-blue-100/60
                                   transition duration-300
                                   group-hover:scale-125"
                            aria-hidden="true"
                        ></div>

                        <div class="relative">
                            <h3
                                class="text-3xl font-extrabold
                                       leading-none text-blue-700
                                       sm:text-4xl"
                            >
                                {{ $stat->value }}
                            </h3>

                            <p
                                class="mt-3 text-sm font-medium
                                       leading-6 text-slate-600
                                       sm:text-base"
                            >
                                {{ $stat->label }}
                            </p>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            {{-- EMPTY STATE --}}
            <div
                class="mx-auto mt-12 max-w-2xl
                       rounded-2xl border border-dashed
                       border-slate-300 bg-slate-50
                       px-6 py-10 text-center"
                data-aos="fade-up"
            >
                <div
                    class="mx-auto flex h-14 w-14
                           items-center justify-center
                           rounded-full bg-blue-100
                           text-2xl font-bold text-blue-700"
                    aria-hidden="true"
                >
                    i
                </div>

                <h3
                    class="mt-4 text-lg font-bold
                           text-slate-800"
                >
                    Data Statistik Belum Tersedia
                </h3>

                <p
                    class="mt-2 leading-7 text-slate-500"
                >
                    Informasi jumlah mahasiswa, dosen,
                    laboratorium, dan tahun berdiri akan
                    ditampilkan setelah dilengkapi oleh
                    pengelola program studi.
                </p>
            </div>
        @endif

    </div>
</section>