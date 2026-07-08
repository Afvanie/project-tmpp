<section class="relative h-[58vh] flex items-center overflow-hidden">

    <div class="absolute inset-0">

    <img
            src="{{ asset('assets/images/akademik-banner.jpg') }}"
            class="w-full h-full object-cover"
            alt="">

        <div class="absolute inset-0 bg-gradient-to-r from-[#003B73] via-[#005BAC] to-[#003B73]"></div>

    </div>

    <div class="absolute inset-0 bg-[linear-gradient(to_right,rgba(255,255,255,.08)_1px,transparent_1px),linear-gradient(to_bottom,rgba(255,255,255,.08)_1px,transparent_1px)] bg-[size:70px_70px]"></div>

    <div class="relative max-w-7xl mx-auto px-6 w-full">

        <nav class="flex items-center gap-2 text-white/80 text-sm mb-6">

            <a href="{{ route('home') }}" class="hover:text-yellow-400 transition">
                Beranda
            </a>

            <span>/</span>

            <span>Akademik</span>

            <span>/</span>

            <span class="text-yellow-400">
                {{ $page['title'] }}
            </span>

        </nav>

        <span class="inline-block px-5 py-2 rounded-full bg-yellow-400/20 border border-yellow-400/30 text-yellow-300 text-sm font-semibold">
            INFORMASI AKADEMIK
        </span>

        <h1 class="mt-6 text-5xl md:text-6xl font-extrabold text-white leading-tight">
            {{ $page['title'] }}
        </h1>

        <p class="mt-6 max-w-2xl text-lg text-white/90 leading-8">
            {{ $page['subtitle'] }}
        </p>

    </div>

</section>