@php
    $bannerPath = 'assets/images/contact-banner.jpg';

    $bannerAvailable = file_exists(
        public_path($bannerPath)
    );
@endphp

<section
    class="relative flex min-h-[520px]
           items-center overflow-hidden
           py-24 md:min-h-[60vh]"
>
    <div class="absolute inset-0">

        @if ($bannerAvailable)
            <img
                src="{{ asset($bannerPath) }}"
                alt="Kontak Program Studi D-IV Teknik Mesin Produksi dan Perawatan"
                class="h-full w-full object-cover"
            >
        @else
            <div
                class="h-full w-full
                       bg-gradient-to-br
                       from-blue-900 via-blue-700
                       to-slate-900"
            ></div>
        @endif

        <div
            class="absolute inset-0"
            style="
                background: linear-gradient(
                    90deg,
                    rgba(0, 59, 115, 0.38) 0%,
                    rgba(0, 91, 172, 0.68) 42%,
                    rgba(0, 43, 85, 0.94) 100%
                );
            "
        ></div>

        <div
            class="absolute inset-0"
            style="
                background: linear-gradient(
                    180deg,
                    rgba(0, 43, 85, 0.08) 0%,
                    rgba(0, 43, 85, 0.28) 100%
                );
            "
        ></div>
    </div>

    <div
        class="absolute inset-0
               bg-[linear-gradient(to_right,rgba(255,255,255,.08)_1px,transparent_1px),linear-gradient(to_bottom,rgba(255,255,255,.08)_1px,transparent_1px)]
               bg-[size:70px_70px]"
        aria-hidden="true"
    ></div>

    <div
        class="absolute -left-32 bottom-0
               h-96 w-96 rounded-full
               bg-yellow-400/20 blur-[120px]"
        aria-hidden="true"
    ></div>

    <div
        class="relative z-10 mx-auto
               w-full max-w-7xl px-6"
    >
        <nav
            class="mb-6 flex items-center gap-2
                   text-sm text-white/80"
            aria-label="Breadcrumb"
        >
            <a
                href="{{ route('home') }}"
                class="transition hover:text-yellow-300"
            >
                Beranda
            </a>

            <span aria-hidden="true">/</span>

            <span class="font-semibold text-yellow-300">
                Kontak
            </span>
        </nav>

        <span
            class="inline-flex rounded-full
                   border border-yellow-400/40
                   bg-yellow-400/20 px-5 py-2
                   text-sm font-semibold
                   text-yellow-300"
        >
            HUBUNGI KAMI
        </span>

        <h1
            class="mt-6 max-w-4xl text-4xl
                   font-extrabold leading-tight
                   text-white drop-shadow-lg
                   sm:text-5xl md:text-6xl"
        >
            Kontak Program Studi
        </h1>

        <p
            class="mt-6 max-w-3xl text-base
                   leading-8 text-white/90
                   drop-shadow md:text-lg"
        >
            Informasi komunikasi Program Studi D-IV Teknik Mesin
            Produksi dan Perawatan, Jurusan Teknik Mesin,
            Politeknik Negeri Malang.
        </p>
    </div>
</section>