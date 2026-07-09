@if(isset($section) && $section)

<section class="relative py-24 bg-white overflow-hidden">

    {{-- ===================================================== --}}
    {{-- ORNAMENT BACKGROUND --}}
    {{-- ===================================================== --}}
    <div class="absolute inset-0 pointer-events-none">

        {{-- Blur Biru --}}
        <div class="absolute -left-40 top-20 w-[520px] h-[520px] rounded-full bg-blue-300/20 blur-[150px]"></div>

        {{-- Blur Kuning --}}
        <div class="absolute -right-40 bottom-20 w-[520px] h-[520px] rounded-full bg-yellow-300/20 blur-[150px]"></div>

        {{-- Grid Halus --}}
        <div class="absolute inset-0 opacity-[0.035]"
            style="background-image: linear-gradient(#0f172a 1px, transparent 1px),
            linear-gradient(to right,#0f172a 1px,transparent 1px);
            background-size:70px 70px;">
        </div>

        {{-- Logo Polinema Watermark --}}
        <img
            src="{{ asset('assets/images/logo.png') }}"
            alt=""
            class="absolute -left-28 top-1/2 -translate-y-1/2 w-[360px] md:w-[520px] opacity-[0.04] grayscale select-none">

        {{-- Watermark Text --}}
        <div class="absolute bottom-10 right-8 text-[72px] md:text-[130px] font-black text-blue-900/[0.035] leading-none select-none text-right">
            D-III<br>TEKNIK MESIN
        </div>

        {{-- Abstract Circle --}}
        <div class="absolute top-20 right-20 w-44 h-44 rounded-full border-[18px] border-yellow-500/[0.08]"></div>
        <div class="absolute bottom-24 left-1/3 w-64 h-64 rounded-full border-[24px] border-blue-700/[0.04]"></div>

    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-6">

        {{-- ===================================================== --}}
        {{-- HEADING --}}
        {{-- ===================================================== --}}
        <div class="text-center mb-16" data-aos="fade-up">

            <span class="uppercase tracking-[5px] text-blue-700 font-semibold">
                {{ $section->subtitle ?? 'Sasaran Penyelenggaraan Pendidikan' }}
            </span>

            <h2 class="mt-3 text-4xl md:text-5xl font-bold text-slate-800 leading-tight">
                {{ $section->title }}
            </h2>

            <div class="w-24 h-1 bg-yellow-400 rounded-full mx-auto mt-6"></div>

            @if($section->description)
                <p class="mt-6 max-w-3xl mx-auto text-slate-600 leading-8">
                    {{ $section->description }}
                </p>
            @endif

        </div>

        {{-- ===================================================== --}}
        {{-- CONTENT --}}
        {{-- ===================================================== --}}
        <div class="grid md:grid-cols-2 gap-6">

            @foreach($section->items as $item)
                <div
                    class="group relative bg-white/90 backdrop-blur rounded-3xl p-7 shadow-lg border border-slate-100 overflow-hidden hover:-translate-y-2 hover:shadow-2xl transition-all duration-500"
                    data-aos="fade-up"
                    data-aos-delay="{{ $loop->iteration * 100 }}">

                    {{-- Card Ornament --}}
                    <div class="absolute top-0 right-0 w-24 h-24 bg-blue-100/60 rounded-bl-full group-hover:bg-yellow-100 transition"></div>

                    <div class="relative flex gap-5">

                        {{-- Number --}}
                        <div
                            class="shrink-0 w-12 h-12 rounded-2xl bg-blue-700 text-white flex items-center justify-center font-bold text-lg group-hover:bg-yellow-400 transition">

                            {{ $loop->iteration }}

                        </div>

                        {{-- Text --}}
                        <div>

                            <h3 class="text-lg font-bold text-slate-800 mb-3">
                                {{ $item->title }}
                            </h3>

                            <p class="text-slate-600 leading-8 text-justify">
                                {{ $item->content }}
                            </p>

                        </div>

                    </div>

                </div>
            @endforeach

        </div>

    </div>

</section>
@endif