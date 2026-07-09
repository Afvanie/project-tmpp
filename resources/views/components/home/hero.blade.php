<section class="relative h-screen flex items-center justify-center">

    {{-- BACKGROUND --}}
    <!-- <div class="absolute inset-0">
        <img src="{{ asset('assets/images/hero.jpg') }}"
             class="w-full h-full object-cover"
             alt="">

        {{-- OVERLAY --}}
        <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/50 to-black/70"></div>
    </div> -->
    <div class="absolute inset-0">
        {{-- VIDEO BACKGROUND --}}
        <video class="w-full h-full object-cover" autoplay muted loop playsinline>
            <source src="{{ asset('assets/videos/hero.mp4') }}" type="video/mp4">
        </video>

        {{-- OVERLAY --}}
        <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/50 to-black/70"></div>
    </div>
    

    {{-- CONTENT --}}
    <div class="relative z-10 text-center text-white px-6 max-w-4xl">

        <h1 class="text-4xl md:text-6xl font-bold leading-tight">
            D-III Teknik Mesin
        </h1>

        <p class="mt-5 text-lg md:text-xl text-white/80">
            Program studi D-III Teknik Mesin merupakan salah satu dari program studi di Jurusan Teknik Mesin dirancang secara khusus guna menghasilkan tenaga sarjana sains terapan yang memiliki kemampuan dalam berbagai bidang mengenai Mesin. 
        </p>

        {{-- CTA --}}
        <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center">

            <a href="{{ route('profile') }}"
               class="bg-[#D4AF37] hover:bg-yellow-500 text-black font-semibold px-6 py-3 rounded-lg transition">
                Tentang Kami
            </a>

            <a href="{{ route('academic') }}"
               class="border border-white px-6 py-3 rounded-lg hover:bg-white hover:text-black transition">
                Lihat Akademik
            </a>

        </div>

    </div>

    {{-- SCROLL INDICATOR --}}
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 text-white/70 animate-bounce">
        ↓ Scroll
    </div>

</section>