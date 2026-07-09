@if(isset($section) && $section)

@php
    $visi = $section->items->where('item_group', 'visi')->first();
    $misi = $section->items->where('item_group', 'misi');
@endphp

<section class="relative py-24 bg-slate-50 overflow-hidden">

        {{-- ===================================================== --}}
        {{-- ORNAMENT BACKGROUND --}}
        {{-- ===================================================== --}}
        <div class="absolute inset-0 pointer-events-none">

            {{-- Blur Biru --}}
            <div class="absolute -left-40 top-20 w-[520px] h-[520px] rounded-full bg-blue-300/25 blur-[150px]"></div>

            {{-- Blur Kuning --}}
            <div class="absolute -right-40 bottom-20 w-[520px] h-[520px] rounded-full bg-yellow-300/25 blur-[150px]"></div>

            {{-- Grid Halus --}}
            <div class="absolute inset-0 opacity-[0.04]"
                style="background-image: linear-gradient(#0f172a 1px, transparent 1px),
                linear-gradient(to right,#0f172a 1px,transparent 1px);
                background-size:70px 70px;">
            </div>

            {{-- Watermark Text --}}
            <div class="absolute top-20 right-10 text-[120px] md:text-[180px] font-black text-blue-900/[0.035] leading-none select-none">
                POLINEMA
            </div>

            {{-- Logo Polinema Besar --}}
            <img
                src="{{ asset('assets/images/logo.png') }}"
                alt=""
                class="absolute -right-24 top-1/2 -translate-y-1/2 w-[360px] md:w-[520px] opacity-[0.045] grayscale select-none">

            {{-- Logo Polinema Kecil --}}
            <img
                src="{{ asset('assets/images/logo.png') }}"
                alt=""
                class="absolute left-10 bottom-14 w-28 md:w-36 opacity-[0.06] grayscale select-none">

            {{-- Abstract Circle --}}
            <div class="absolute bottom-16 left-10 w-72 h-72 rounded-full border-[30px] border-blue-700/[0.04]"></div>

            

        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-6">

        {{-- ===================================================== --}}
        {{-- HEADING --}}
        {{-- ===================================================== --}}
        <div class="text-center mb-16" data-aos="fade-up">

            <span class="uppercase tracking-[5px] text-blue-700 font-semibold">
                {{ $section->subtitle ?? 'Arah Pengembangan Program Studi' }}
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
        <div class="grid lg:grid-cols-2 gap-10 items-start">

            {{-- VISI --}}
            @if($visi)
                <div
                    class="relative overflow-hidden rounded-[2rem] bg-gradient-to-br from-blue-800 via-blue-700 to-blue-900 p-8 md:p-10 text-white shadow-2xl"
                    data-aos="fade-right">

                    {{-- Card Ornament --}}
                    <div class="absolute -top-20 -right-20 w-64 h-64 rounded-full bg-white/10 blur-2xl"></div>
                    <div class="absolute -bottom-24 -left-24 w-72 h-72 rounded-full bg-yellow-400/20 blur-3xl"></div>

                    <div class="relative">

                        <span class="inline-flex items-center px-4 py-1 rounded-full bg-white/15 border border-white/20 text-yellow-300 text-sm font-semibold mb-6">
                            Visi Program Studi
                        </span>

                        <h3 class="text-2xl md:text-3xl font-bold mb-6">
                            {{ $visi->title }}
                        </h3>

                        <p class="leading-9 text-blue-50 text-justify text-lg">
                            “{{ $visi->content }}”
                        </p>

                    </div>

                </div>
            @endif

            {{-- MISI --}}
            <div
                class="relative bg-white/90 backdrop-blur rounded-[2rem] p-8 md:p-10 shadow-2xl border border-slate-100 overflow-hidden"
                data-aos="fade-left">

                {{-- Card Ornament --}}
                <div class="absolute top-0 right-0 w-32 h-32 bg-yellow-300/20 rounded-bl-full"></div>
                <div class="absolute bottom-0 left-0 w-32 h-32 bg-blue-300/10 rounded-tr-full"></div>

                <div class="relative">

                    <span class="inline-flex items-center px-4 py-1 rounded-full bg-yellow-100 text-yellow-700 text-sm font-semibold mb-6">
                        Misi Program Studi
                    </span>

                    <h3 class="text-2xl md:text-3xl font-bold text-slate-800 mb-8">
                        Komitmen dalam Penyelenggaraan Pendidikan
                    </h3>

                    <div class="space-y-6">

                        @foreach($misi as $item)
                            <div class="flex gap-4 group">

                                <div class="shrink-0 w-11 h-11 rounded-2xl bg-blue-700 text-white flex items-center justify-center font-bold group-hover:bg-yellow-400 transition">
                                    {{ $loop->iteration }}
                                </div>

                                <div>
                                    <h4 class="font-bold text-slate-800 mb-2">
                                        {{ $item->title }}
                                    </h4>

                                    <p class="text-slate-600 leading-8 text-justify">
                                        {{ $item->content }}
                                    </p>
                                </div>

                            </div>
                        @endforeach

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>
@endif