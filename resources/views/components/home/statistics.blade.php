@php
    $stats = $homeStats ?? collect();
@endphp

<section class="py-20 bg-white">

    <div class="max-w-6xl mx-auto px-6 text-center">

        <h2 class="text-3xl font-bold text-slate-800">
            Statistik Program Studi
        </h2>

        <p class="mt-2 text-slate-500">
            Data singkat Teknik Mesin Polinema
        </p>

        <div class="mt-10 grid grid-cols-2 md:grid-cols-4 gap-5">

            @forelse ($stats as $stat)

                <div class="bg-slate-50 border border-slate-100 rounded-xl py-6 shadow-sm">
                    <h3 class="text-4xl font-extrabold text-blue-700">
                        {{ $stat->value }}
                    </h3>

                    <p class="mt-2 text-slate-500">
                        {{ $stat->label }}
                    </p>
                </div>

            @empty

                <div class="col-span-4 text-slate-500">
                    Data statistik belum tersedia.
                </div>

            @endforelse

        </div>

    </div>

</section>