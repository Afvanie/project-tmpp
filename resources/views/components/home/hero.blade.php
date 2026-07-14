<section
    id="beranda"
    class="relative flex min-h-screen items-center justify-center overflow-hidden"
>
    {{-- BACKGROUND VIDEO --}}
    <div class="absolute inset-0">
        <video
            class="h-full w-full object-cover"
            autoplay
            muted
            loop
            playsinline
            preload="metadata"
            aria-hidden="true"
        >
            <source
                src="{{ asset('assets/videos/hero.mp4') }}"
                type="video/mp4"
            >
        </video>

        {{-- OVERLAY --}}
        <div class="absolute inset-0 bg-black/55"></div>

        <div
            class="absolute inset-0 bg-gradient-to-r
                   from-black/80 via-black/45 to-black/70"
        ></div>

        <div
            class="absolute inset-0 bg-gradient-to-t
                   from-black/70 via-transparent to-black/25"
        ></div>
    </div>

    {{-- CONTENT --}}
    <div
        class="relative z-10 mx-auto w-full max-w-5xl
               px-6 pt-24 text-center text-white
               sm:px-8 lg:px-10"
    >
        {{-- BADGE --}}
        <div class="mb-5 flex justify-center">
            <span
                class="inline-flex items-center rounded-full
                       border border-white/25 bg-white/10
                       px-4 py-2 text-xs font-semibold
                       uppercase tracking-[0.18em]
                       text-white backdrop-blur-sm
                       sm:text-sm"
            >
                Program Studi Sarjana Terapan
            </span>
        </div>

        {{-- TITLE --}}
        <h1
            class="text-4xl font-bold leading-tight
                   sm:text-5xl md:text-6xl lg:text-7xl"
        >
            D-IV Teknik Mesin
            <span class="block text-[#D4AF37]">
                Produksi dan Perawatan
            </span>
        </h1>

        {{-- VISION TAGLINE --}}
        <p
            class="mx-auto mt-6 max-w-3xl
                   text-base font-semibold leading-relaxed
                   text-[#F1D77A]
                   sm:text-lg md:text-xl"
        >
            Unggul dalam Autonomous Maintenance pada Persaingan Global Tahun 2030
        </p>

        {{-- DESCRIPTION --}}
        <p
            class="mx-auto mt-5 max-w-4xl
                   text-sm leading-7 text-white/85
                   sm:text-base sm:leading-8
                   md:text-lg"
        >
            Program Studi D-IV Teknik Mesin Produksi dan Perawatan
            merupakan program pendidikan vokasi di Jurusan Teknik Mesin
            Politeknik Negeri Malang yang mempersiapkan lulusan
            Sarjana Terapan dengan kompetensi dalam bidang produksi,
            manufaktur, perawatan mesin, otomasi industri, dan
            pengembangan teknologi sesuai kebutuhan dunia industri.
        </p>

        {{-- CTA --}}
        <div
            class="mt-9 flex flex-col justify-center gap-4
                   sm:flex-row"
        >
            <a
                href="{{ route('profile') }}"
                class="inline-flex items-center justify-center
                       rounded-lg bg-[#D4AF37]
                       px-7 py-3.5 font-semibold text-black
                       shadow-lg shadow-black/20
                       transition duration-300
                       hover:-translate-y-0.5
                       hover:bg-[#E7C95F]"
            >
                Tentang TMPP
            </a>

            <a
                href="{{ route('academic') }}"
                class="inline-flex items-center justify-center
                       rounded-lg border border-white/70
                       bg-white/5 px-7 py-3.5
                       font-semibold text-white
                       backdrop-blur-sm
                       transition duration-300
                       hover:-translate-y-0.5
                       hover:bg-white hover:text-black"
            >
                Lihat Akademik
            </a>
        </div>
    </div>

    {{-- SCROLL INDICATOR --}}
    <a
        href="#program-description"
        aria-label="Lihat bagian berikutnya"
        class="absolute bottom-7 left-1/2 z-10
               -translate-x-1/2 text-center
               text-xs font-medium tracking-wider
               text-white/75 transition
               hover:text-white"
    >
        <span class="block">Scroll</span>

        <span
            class="mt-1 block animate-bounce
                   text-xl leading-none"
        >
            ↓
        </span>
    </a>
</section>