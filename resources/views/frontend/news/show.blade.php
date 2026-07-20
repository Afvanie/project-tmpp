@extends('layouts.app')

@section('title', $news->title)

@section('content')

{{-- ============================================================= --}}
{{-- HERO / BANNER BERITA --}}
{{-- ============================================================= --}}

<section
    id="news-hero"
    data-navbar-banner
    class="relative flex min-h-[500px]
           items-center overflow-hidden
           sm:min-h-[540px]
           lg:min-h-[580px]"
>
    {{-- ========================================================= --}}
    {{-- BACKGROUND --}}
    {{-- ========================================================= --}}

    <div class="absolute inset-0">
        <img
            src="{{ asset('assets/images/profile-banner.jpg') }}"
            alt="{{ $news->title }}"
            class="h-full w-full
                   object-cover object-center"
        >

        {{-- Overlay utama --}}
        <div
            class="absolute inset-0"
            style="
                background:
                    linear-gradient(
                        90deg,
                        rgba(2, 22, 41, 0.92) 0%,
                        rgba(3, 37, 67, 0.78) 48%,
                        rgba(3, 37, 67, 0.32) 78%,
                        rgba(3, 37, 67, 0.16) 100%
                    );
            "
        ></div>

        {{-- Overlay bagian bawah --}}
        <div
            class="absolute inset-0
                   bg-gradient-to-t
                   from-[#02182C]/75
                   via-transparent
                   to-[#02182C]/15"
        ></div>
    </div>


    {{-- Cahaya lembut --}}
    <div
        class="pointer-events-none
               absolute -left-40
               top-1/2
               h-[420px] w-[420px]
               -translate-y-1/2
               rounded-full
               bg-blue-500/15
               blur-[140px]"
        aria-hidden="true"
    ></div>


    {{-- ========================================================= --}}
    {{-- CONTENT --}}
    {{-- ========================================================= --}}

    <div
        class="relative z-10
               mx-auto w-full
               max-w-7xl
               px-6 pb-16 pt-32
               sm:px-8 sm:pt-36
               lg:px-10"
    >
        <div class="max-w-4xl">

            {{-- Breadcrumb --}}
            <nav
                aria-label="Breadcrumb"
                data-aos="fade-right"
            >
                <ol
                    class="flex flex-wrap
                           items-center gap-2
                           text-xs font-medium
                           text-white/60
                           sm:text-sm"
                >
                    <li>
                        <a
                            href="{{ route('home') }}"
                            class="transition
                                   hover:text-white"
                        >
                            Beranda
                        </a>
                    </li>

                    <li
                        class="text-white/30"
                        aria-hidden="true"
                    >
                        /
                    </li>

                    <li>
                        <a
                            href="{{ route('home') }}#berita"
                            class="transition
                                   hover:text-white"
                        >
                            Berita
                        </a>
                    </li>

                    <li
                        class="text-white/30"
                        aria-hidden="true"
                    >
                        /
                    </li>

                    <li
                        class="max-w-[220px]
                               truncate
                               text-white/85
                               sm:max-w-md"
                        aria-current="page"
                    >
                        {{ $news->title }}
                    </li>
                </ol>
            </nav>


            {{-- Label --}}
            <div
                class="mt-8 flex
                       items-center gap-3"
                data-aos="fade-up"
                data-aos-delay="80"
            >
                <span
                    class="h-px w-8
                           bg-[#E2BD45]"
                    aria-hidden="true"
                ></span>

                <p
                    class="text-[11px]
                           font-bold uppercase
                           tracking-[0.24em]
                           text-[#F2D56F]
                           sm:text-xs"
                >
                    Berita & Informasi
                </p>
            </div>


            {{-- Judul --}}
            <h1
                class="mt-5 max-w-4xl
                       text-4xl font-semibold
                       leading-[1.12]
                       tracking-[-0.03em]
                       text-white
                       drop-shadow-md
                       sm:text-5xl
                       lg:text-6xl"
                style="
                    font-family:
                        'Space Grotesk',
                        'Plus Jakarta Sans',
                        sans-serif;
                "
                data-aos="fade-up"
                data-aos-delay="140"
            >
                {{ $news->title }}
            </h1>


            {{-- Ringkasan --}}
            @if ($news->excerpt)
                <p
                    class="mt-6 max-w-3xl
                           text-sm leading-7
                           text-white/75
                           sm:text-base
                           sm:leading-8"
                    data-aos="fade-up"
                    data-aos-delay="210"
                >
                    {{ $news->excerpt }}
                </p>
            @endif


            {{-- Informasi --}}
            <div
                class="mt-8 flex
                       flex-wrap items-center
                       gap-x-4 gap-y-3
                       text-xs font-semibold
                       text-white/70
                       sm:text-sm"
                data-aos="fade-up"
                data-aos-delay="270"
            >
                @if ($news->published_at)
                    <span
                        class="inline-flex
                               items-center gap-2"
                    >
                        <i
                            class="fa-regular
                                   fa-calendar"
                            aria-hidden="true"
                        ></i>

                        {{
                            $news
                                ->published_at
                                ->translatedFormat(
                                    'd F Y'
                                )
                        }}
                    </span>

                    <span
                        class="h-1 w-1
                               rounded-full
                               bg-[#E2BD45]"
                        aria-hidden="true"
                    ></span>
                @endif

                <span>
                    Program Studi D-IV TMPP
                </span>

                <span
                    class="h-1 w-1
                           rounded-full
                           bg-[#E2BD45]"
                    aria-hidden="true"
                ></span>

                <span>
                    Politeknik Negeri Malang
                </span>
            </div>

        </div>
    </div>


    {{-- ========================================================= --}}
    {{-- AKSEN BAWAH --}}
    {{-- ========================================================= --}}

    <div
        class="absolute inset-x-0
               bottom-0 z-10
               h-1
               bg-gradient-to-r
               from-[#073763]
               via-[#E2BD45]
               to-[#0B67A5]"
        aria-hidden="true"
    ></div>
</section>


{{-- ============================================================= --}}
{{-- ISI BERITA --}}
{{-- ============================================================= --}}

<article
    class="bg-white py-14
           md:py-20"
>
    <div
        class="mx-auto max-w-4xl
               px-6"
    >

        {{-- Gambar Utama --}}
        @if ($news->image)
            <figure class="mb-10">
                <img
                    src="{{ asset(
                        'storage/'
                        . $news->image
                    ) }}"
                    alt="{{ $news->title }}"
                    class="aspect-[16/9]
                           w-full
                           rounded-2xl
                           object-cover
                           shadow-sm"
                >
            </figure>
        @endif


        {{-- Konten --}}
        <div
            class="text-justify
                   text-base leading-8
                   text-slate-700
                   sm:text-lg
                   sm:leading-9"
        >
            {!! nl2br(
                e($news->content)
            ) !!}
        </div>


        {{-- Kembali --}}
        <div
            class="mt-12
                   border-t
                   border-slate-200
                   pt-8"
        >
            <a
                href="{{ route('home') }}#berita"
                class="inline-flex
                       items-center gap-2
                       text-sm font-bold
                       text-[#075F9B]
                       transition
                       hover:text-[#064B7B]"
            >
                <i
                    class="fa-solid
                           fa-arrow-left"
                    aria-hidden="true"
                ></i>

                Kembali ke Berita
            </a>
        </div>

    </div>
</article>

@endsection