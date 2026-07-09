<section class="relative h-[60vh] flex items-center overflow-hidden">

    {{-- Background --}}
    <div class="absolute inset-0">

        <img
            src="{{ asset('assets/images/profile-banner.jpg') }}"
            class="w-full h-full object-cover"
            alt="Profil Program Studi D-III Teknik Mesin">

        {{-- Overlay --}}
        <div class="absolute inset-0 bg-gradient-to-r from-[#003B73]/95 via-[#005BAC]/75 to-[#003B73]/90"></div>

        {{-- Dark layer agar teks tetap terbaca --}}
        <div class="absolute inset-0 bg-slate-950/20"></div>

    </div>

    {{-- Decoration --}}
    <div class="absolute inset-0 bg-[linear-gradient(to_right,rgba(255,255,255,.08)_1px,transparent_1px),linear-gradient(to_bottom,rgba(255,255,255,.08)_1px,transparent_1px)] bg-[size:70px_70px]"></div>

    {{-- Content --}}
    <div class="relative max-w-7xl mx-auto px-6 w-full">

        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-white/80 text-sm mb-6">

            <a href="{{ route('home') }}" class="hover:text-yellow-400 transition">
                Beranda
            </a>

            <span>/</span>

            <span class="text-yellow-400">
                Profil D-III Teknik Mesin
            </span>

        </nav>

        <span
            class="inline-block px-5 py-2 rounded-full bg-yellow-400/20 border border-yellow-400/30 text-yellow-300 text-sm font-semibold">

            PROGRAM STUDI

        </span>

        <h1
            class="mt-6 text-4xl sm:text-5xl md:text-6xl font-extrabold text-white leading-tight">

            D-III Teknik Mesin

        </h1>

        <p
            class="mt-6 max-w-2xl text-lg text-white/90 leading-8">

            Mengenal lebih dekat Program Studi D-III Teknik Mesin
            Politeknik Negeri Malang sebagai penyelenggara pendidikan vokasi
            di bidang teknik mesin yang berorientasi pada kompetensi industri.

        </p>

    </div>

</section>