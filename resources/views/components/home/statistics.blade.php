@php
    /*
    |--------------------------------------------------------------------------
    | STATISTIK PROGRAM STUDI
    |--------------------------------------------------------------------------
    |
    | Statistik mahasiswa dan dosen tidak ditampilkan pada frontend.
    | Data aslinya tetap aman di database dan halaman admin.
    |
    */

    $stats = collect($homeStats ?? [])
        ->filter(function ($stat) {
            if (
                !$stat
                || $stat->value === null
                || trim((string) $stat->value) === ''
            ) {
                return false;
            }

            $label = mb_strtolower(
                trim((string) $stat->label)
            );

            /*
            |--------------------------------------------------------------------------
            | SEMBUNYIKAN JUMLAH MAHASISWA DAN DOSEN
            |--------------------------------------------------------------------------
            */

            if (
                str_contains($label, 'mahasiswa')
                || str_contains($label, 'dosen')
            ) {
                return false;
            }

            return true;
        })
        ->sortBy('sort_order')
        ->values();

    $statCount = $stats->count();
@endphp


<section
    id="statistics"
    class="relative overflow-hidden
           bg-white py-14 md:py-16"
>
    {{-- Dekorasi ringan --}}
    <div
        class="pointer-events-none absolute inset-0"
        aria-hidden="true"
    >
        <div
            class="absolute -left-24 top-0
                   h-64 w-64 rounded-full
                   bg-blue-100/40 blur-3xl"
        ></div>

        <div
            class="absolute -right-24 bottom-0
                   h-64 w-64 rounded-full
                   bg-yellow-100/40 blur-3xl"
        ></div>
    </div>


    <div class="relative mx-auto max-w-6xl px-6">

        {{-- ===================================================== --}}
        {{-- HEADING --}}
        {{-- ===================================================== --}}

        <div
            class="mx-auto max-w-2xl text-center"
            data-aos="fade-up"
        >
            <div
                class="flex items-center
                       justify-center gap-3"
            >
                <span
                    class="h-px w-8 bg-[#D7B33E]"
                    aria-hidden="true"
                ></span>

                <p
                    class="text-[11px] font-bold
                           uppercase tracking-[0.2em]
                           text-[#075F9B]"
                >
                    TMPP dalam Angka
                </p>

                <span
                    class="h-px w-8 bg-[#D7B33E]"
                    aria-hidden="true"
                ></span>
            </div>


            <h2
                class="mt-4 text-2xl font-extrabold
                       tracking-tight text-slate-900
                       sm:text-3xl"
            >
                Statistik Program Studi
            </h2>


            <p
                class="mx-auto mt-3 max-w-xl
                       text-sm leading-6
                       text-slate-500"
            >
                Informasi singkat Program Studi D-IV Teknik Mesin
                Produksi dan Perawatan.
            </p>
        </div>


        {{-- ===================================================== --}}
        {{-- DAFTAR STATISTIK --}}
        {{-- ===================================================== --}}

        @if ($stats->isNotEmpty())
            <div
                @class([
                    'mx-auto mt-9 grid gap-3 sm:gap-4',

                    'max-w-sm grid-cols-1' =>
                        $statCount === 1,

                    'max-w-2xl grid-cols-1 sm:grid-cols-2' =>
                        $statCount === 2,

                    'max-w-4xl grid-cols-1 sm:grid-cols-3' =>
                        $statCount === 3,

                    'max-w-6xl grid-cols-2 lg:grid-cols-4' =>
                        $statCount >= 4,
                ])
            >
                @foreach ($stats as $stat)
                    <article
                        class="group relative
                               overflow-hidden rounded-xl
                               border border-slate-200
                               bg-white px-4 py-5
                               text-center shadow-sm
                               transition duration-300
                               hover:-translate-y-1
                               hover:border-blue-200
                               hover:shadow-md
                               sm:px-5 sm:py-6"
                        data-aos="fade-up"
                        data-aos-delay="{{ min(
                            $loop->index * 80,
                            240
                        ) }}"
                    >
                        <div
                            class="mx-auto flex h-9 w-9
                                   items-center justify-center
                                   rounded-lg bg-blue-50
                                   text-sm text-[#075F9B]
                                   transition duration-300
                                   group-hover:bg-[#075F9B]
                                   group-hover:text-white"
                        >
                            <i
                                class="fa-solid fa-chart-simple"
                                aria-hidden="true"
                            ></i>
                        </div>


                        <h3
                            class="mt-4 text-2xl
                                   font-extrabold leading-none
                                   text-[#075F9B]
                                   sm:text-3xl"
                        >
                            {{ $stat->value }}
                        </h3>


                        <p
                            class="mt-2 text-xs font-semibold
                                   leading-5 text-slate-500
                                   sm:text-sm"
                        >
                            {{ $stat->label }}
                        </p>


                        <div
                            class="absolute inset-x-0 bottom-0
                                   h-0.5 origin-left
                                   scale-x-0 bg-[#D7B33E]
                                   transition-transform
                                   duration-300
                                   group-hover:scale-x-100"
                            aria-hidden="true"
                        ></div>
                    </article>
                @endforeach
            </div>
        @else
            <div
                class="mx-auto mt-9 max-w-xl
                       rounded-xl border
                       border-dashed border-slate-300
                       bg-slate-50 px-6 py-7
                       text-center"
                data-aos="fade-up"
            >
                <div
                    class="mx-auto flex h-10 w-10
                           items-center justify-center
                           rounded-lg bg-blue-100
                           text-[#075F9B]"
                >
                    <i
                        class="fa-solid fa-chart-column"
                        aria-hidden="true"
                    ></i>
                </div>


                <h3
                    class="mt-3 font-bold text-slate-800"
                >
                    Data Statistik Belum Tersedia
                </h3>


                <p
                    class="mt-2 text-sm leading-6
                           text-slate-500"
                >
                    Statistik akan ditampilkan setelah dilengkapi
                    melalui halaman admin.
                </p>
            </div>
        @endif
    </div>
</section>