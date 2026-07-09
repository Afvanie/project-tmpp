<section class="relative h-[60vh] flex items-center overflow-hidden">

    {{-- Background Image --}}
    <div class="absolute inset-0">

        <img
            src="{{ asset('assets/images/akademik-banner.jpg') }}"
            class="w-full h-full object-cover"
            alt="">

        {{-- Overlay --}}
        <div class="absolute inset-0 bg-gradient-to-r from-[#003B73]/95 via-[#005BAC]/75 to-[#003B73]/90"></div>

        {{-- Dark layer agar teks tetap terbaca --}}
        <div class="absolute inset-0 bg-slate-950/20"></div>

    </div>

    {{-- Grid Decoration --}}
    <div class="absolute inset-0 bg-[linear-gradient(to_right,rgba(255,255,255,.08)_1px,transparent_1px),linear-gradient(to_bottom,rgba(255,255,255,.08)_1px,transparent_1px)] bg-[size:70px_70px]"></div>

    {{-- Soft Blur --}}
    <div class="absolute -left-32 bottom-0 w-96 h-96 rounded-full bg-yellow-400/20 blur-[120px]"></div>

    {{-- Content --}}
    <div class="relative z-10 max-w-7xl mx-auto px-6 w-full">

        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-white/80 text-sm mb-6">

            <a href="{{ route('home') }}" class="hover:text-yellow-300 transition">
                Beranda
            </a>

            <span>/</span>

            <span>Akademik</span>

            <span>/</span>

            <span class="text-yellow-300 font-semibold">
                {{ $page['title'] }}
            </span>

        </nav>

        <span class="inline-block px-5 py-2 rounded-full bg-yellow-400/20 border border-yellow-400/40 text-yellow-300 text-sm font-semibold">
            INFORMASI AKADEMIK
        </span>

        <h1 class="mt-6 text-4xl sm:text-5xl md:text-6xl font-extrabold text-white leading-tight drop-shadow-lg">
            {{ $page['title'] }}
        </h1>

        <p class="mt-6 max-w-2xl text-base md:text-lg text-white/90 leading-8 drop-shadow">
            {{ $page['subtitle'] }}
        </p>

    </div>

</section>