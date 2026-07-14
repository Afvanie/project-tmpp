@php
    /*
    |--------------------------------------------------------------------------
    | DOKUMENTASI FASILITAS
    |--------------------------------------------------------------------------
    |
    | Hanya kategori yang mempunyai foto aktif dan file yang benar-benar
    | tersedia di storage yang ditampilkan pada galeri.
    |
    | Tidak ada foto placeholder atau dokumentasi buatan.
    |
    */

    $facilityCollection = collect(
        $facilities ?? []
    );

    $categoryLabels = [
        \App\Models\Facility::CATEGORY_LABORATORY =>
            'Laboratorium',

        \App\Models\Facility::CATEGORY_WORKSHOP =>
            'Workshop',

        \App\Models\Facility::CATEGORY_CLASSROOM =>
            'Ruang Kelas',

        \App\Models\Facility::CATEGORY_GALLERY =>
            'Aktivitas Mahasiswa',
    ];

    $galleryFacilities = $facilityCollection
        ->map(function ($facility) {
            $validPhotos = collect($facility->photos ?? [])
                ->filter(function ($photo): bool {
                    $photoPath = trim(
                        (string) $photo->photo
                    );

                    return $photoPath !== ''
                        && \Illuminate\Support\Facades\Storage::disk(
                            'public'
                        )->exists($photoPath);
                })
                ->values();

            $facility->setRelation(
                'photos',
                $validPhotos
            );

            return $facility;
        })
        ->filter(function ($facility): bool {
            return $facility->photos->isNotEmpty();
        })
        ->values();
@endphp


<section
    id="dokumentasi-fasilitas"
    class="relative overflow-hidden
           bg-slate-50 py-20 md:py-24"
>
    {{-- ========================================================= --}}
    {{-- BACKGROUND DECORATION --}}
    {{-- ========================================================= --}}

    <div
        class="pointer-events-none absolute inset-0"
        aria-hidden="true"
    >
        <div
            class="absolute -left-40 top-20
                   h-[520px] w-[520px]
                   rounded-full bg-blue-200/30
                   blur-[150px]"
        ></div>

        <div
            class="absolute -right-40 bottom-20
                   h-[520px] w-[520px]
                   rounded-full bg-yellow-200/30
                   blur-[150px]"
        ></div>

        <div
            class="absolute inset-0 opacity-[0.035]"
            style="
                background-image:
                    linear-gradient(
                        #0f172a 1px,
                        transparent 1px
                    ),
                    linear-gradient(
                        to right,
                        #0f172a 1px,
                        transparent 1px
                    );
                background-size: 70px 70px;
            "
        ></div>

        <img
            src="{{ asset('assets/images/logo.png') }}"
            alt=""
            class="absolute -bottom-24 -right-20
                   hidden w-[440px] select-none
                   grayscale opacity-[0.025]
                   lg:block"
        >
    </div>


    <div
        class="relative z-10 mx-auto
               max-w-7xl px-6"
    >
        {{-- ===================================================== --}}
        {{-- HEADING --}}
        {{-- ===================================================== --}}

        <div
            class="mx-auto mb-14 max-w-3xl
                   text-center md:mb-16"
            data-aos="fade-up"
        >
            <span
                class="text-sm font-semibold uppercase
                       tracking-[5px] text-blue-700"
            >
                Dokumentasi Fasilitas
            </span>

            <h2
                class="mt-4 text-3xl font-bold
                       leading-tight text-slate-800
                       sm:text-4xl md:text-5xl"
            >
                Fasilitas dan Aktivitas Mahasiswa
            </h2>

            <div
                class="mx-auto mt-6 h-1 w-24
                       rounded-full bg-yellow-400"
            ></div>

            <p
                class="mt-7 leading-8 text-slate-600"
            >
                Dokumentasi fasilitas dan aktivitas mahasiswa
                Program Studi D-IV Teknik Mesin Produksi dan
                Perawatan yang telah dipublikasikan oleh pengelola.
            </p>
        </div>


        {{-- ===================================================== --}}
        {{-- DAFTAR GALERI --}}
        {{-- ===================================================== --}}

        @if ($galleryFacilities->isNotEmpty())

            <div class="space-y-12 md:space-y-14">

                @foreach ($galleryFacilities as $facility)

                    @php
                        $facilityTitle = trim(
                            (string) $facility->title
                        );

                        $facilityDescription = trim(
                            (string) $facility->description
                        );

                        $facilityLabel = $categoryLabels[
                            $facility->category
                        ] ?? $facility->category_label;

                        $sliderId = 'facility-slider-'
                            . $facility->id;

                        $photos = $facility->photos;

                        $photoTotal = $photos->count();

                        $hasMultiplePhotos = $photoTotal > 1;
                    @endphp


                    <article
                        id="{{ $sliderId }}"
                        class="relative overflow-hidden
                               rounded-[2rem] border
                               border-slate-100 bg-white/95
                               shadow-2xl backdrop-blur
                               md:rounded-[2.5rem]"
                        data-aos="fade-up"
                        data-facility-slider
                        tabindex="0"
                        role="region"
                        aria-roledescription="carousel"
                        aria-label="Dokumentasi {{ $facilityTitle }}"
                    >
                        {{-- Accent --}}
                        <div
                            class="h-2 bg-gradient-to-r
                                   from-blue-700
                                   via-yellow-400
                                   to-blue-700"
                        ></div>


                        <div class="grid lg:grid-cols-12">

                            {{-- ================================= --}}
                            {{-- INFORMASI KATEGORI --}}
                            {{-- ================================= --}}

                            <div
                                class="flex flex-col justify-between
                                       bg-white p-7 sm:p-8
                                       lg:col-span-4 lg:p-10"
                            >
                                <div>
                                    <div
                                        class="mb-6 flex flex-wrap
                                               items-center gap-4"
                                    >
                                        <span
                                            class="inline-flex h-14 w-14
                                                   items-center justify-center
                                                   rounded-2xl bg-blue-700
                                                   text-xl font-black
                                                   text-white shadow-lg"
                                        >
                                            {{ str_pad(
                                                (string) $loop->iteration,
                                                2,
                                                '0',
                                                STR_PAD_LEFT
                                            ) }}
                                        </span>

                                        <span
                                            class="inline-flex rounded-full
                                                   border border-yellow-400/40
                                                   bg-yellow-400/20
                                                   px-4 py-2 text-xs
                                                   font-bold uppercase
                                                   tracking-wider
                                                   text-yellow-700"
                                        >
                                            {{ $facilityLabel }}
                                        </span>
                                    </div>


                                    <h3
                                        class="text-3xl font-bold
                                               leading-tight text-slate-800
                                               md:text-4xl"
                                    >
                                        {{ $facilityTitle !== ''
                                            ? $facilityTitle
                                            : $facility->category_label }}
                                    </h3>


                                    @if ($facilityDescription !== '')
                                        <p
                                            class="mt-5 leading-8
                                                   text-slate-600"
                                        >
                                            {{ $facilityDescription }}
                                        </p>
                                    @endif
                                </div>


                                <div class="mt-8">
                                    <div
                                        class="inline-flex items-center
                                               gap-3 rounded-2xl
                                               border border-slate-100
                                               bg-slate-50 px-5 py-3"
                                    >
                                        <span
                                            class="text-3xl font-black
                                                   text-blue-700"
                                        >
                                            {{ $photoTotal }}
                                        </span>

                                        <span
                                            class="text-sm font-semibold
                                                   text-slate-500"
                                        >
                                            {{ $photoTotal === 1
                                                ? 'Foto Tersedia'
                                                : 'Foto Tersedia' }}
                                        </span>
                                    </div>
                                </div>
                            </div>


                            {{-- ================================= --}}
                            {{-- SLIDER --}}
                            {{-- ================================= --}}

                            <div
                                class="relative bg-slate-100
                                       lg:col-span-8"
                            >
                                <div
                                    class="relative h-[340px]
                                           overflow-hidden
                                           sm:h-[420px]
                                           md:h-[500px]"
                                >
                                    <div
                                        class="facility-track
                                               flex h-full
                                               transition-transform
                                               duration-500 ease-out"
                                    >
                                        @foreach ($photos as $photo)

                                            @php
                                                $photoTitle = trim(
                                                    (string) $photo->title
                                                );

                                                if ($photoTitle === '') {
                                                    $photoTitle =
                                                        $facilityTitle !== ''
                                                            ? $facilityTitle
                                                            : $facility->category_label;
                                                }

                                                $photoUrl = asset(
                                                    'storage/'
                                                    . $photo->photo
                                                );
                                            @endphp


                                            <figure
                                                class="facility-slide
                                                       relative h-full
                                                       min-w-full"
                                                data-slide-index="{{ $loop->index }}"
                                                aria-hidden="{{ $loop->first
                                                    ? 'false'
                                                    : 'true' }}"
                                            >
                                                {{-- Background Blur --}}
                                                <img
                                                    src="{{ $photoUrl }}"
                                                    alt=""
                                                    class="absolute inset-0
                                                           h-full w-full
                                                           scale-110
                                                           object-cover
                                                           opacity-45
                                                           blur-xl"
                                                    loading="lazy"
                                                >


                                                {{-- Overlay --}}
                                                <div
                                                    class="absolute inset-0
                                                           bg-gradient-to-br
                                                           from-[#003B73]/55
                                                           via-white/10
                                                           to-[#003B73]/75"
                                                ></div>


                                                {{-- Gambar Utama --}}
                                                <div
                                                    class="absolute inset-0
                                                           flex items-center
                                                           justify-center
                                                           p-5 sm:p-7
                                                           md:p-10"
                                                >
                                                    <img
                                                        src="{{ $photoUrl }}"
                                                        alt="Dokumentasi {{ $photoTitle }}"
                                                        class="max-h-full max-w-full
                                                               rounded-2xl
                                                               bg-white/20
                                                               object-contain
                                                               shadow-2xl
                                                               ring-4
                                                               ring-white/80
                                                               backdrop-blur"
                                                        loading="lazy"
                                                    >
                                                </div>


                                                {{-- Gradient Bawah --}}
                                                <div
                                                    class="pointer-events-none
                                                           absolute inset-0
                                                           bg-gradient-to-t
                                                           from-slate-950/60
                                                           via-slate-950/5
                                                           to-transparent"
                                                ></div>


                                                {{-- Caption --}}
                                                <figcaption
                                                    class="absolute bottom-5
                                                           left-5 right-5
                                                           sm:bottom-6
                                                           sm:left-6
                                                           sm:right-6"
                                                >
                                                    <span
                                                        class="inline-flex
                                                               max-w-full
                                                               items-center
                                                               gap-2 rounded-full
                                                               bg-white/90
                                                               px-4 py-2
                                                               text-sm font-bold
                                                               text-slate-800
                                                               shadow
                                                               backdrop-blur"
                                                    >
                                                        <span
                                                            class="h-2 w-2
                                                                   shrink-0
                                                                   rounded-full
                                                                   bg-yellow-400"
                                                        ></span>

                                                        <span
                                                            class="truncate"
                                                        >
                                                            {{ $photoTitle }}
                                                        </span>
                                                    </span>
                                                </figcaption>
                                            </figure>

                                        @endforeach
                                    </div>


                                    {{-- Navigasi --}}
                                    @if ($hasMultiplePhotos)

                                        <button
                                            type="button"
                                            class="facility-prev
                                                   absolute left-3
                                                   top-1/2 flex h-11 w-11
                                                   -translate-y-1/2
                                                   items-center justify-center
                                                   rounded-full bg-white/90
                                                   text-slate-800 shadow-lg
                                                   backdrop-blur transition
                                                   hover:bg-yellow-400
                                                   sm:left-5"
                                            aria-label="Tampilkan foto sebelumnya"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-6 w-6"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                                aria-hidden="true"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M15 19l-7-7 7-7"
                                                />
                                            </svg>
                                        </button>


                                        <button
                                            type="button"
                                            class="facility-next
                                                   absolute right-3
                                                   top-1/2 flex h-11 w-11
                                                   -translate-y-1/2
                                                   items-center justify-center
                                                   rounded-full bg-white/90
                                                   text-slate-800 shadow-lg
                                                   backdrop-blur transition
                                                   hover:bg-yellow-400
                                                   sm:right-5"
                                            aria-label="Tampilkan foto berikutnya"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-6 w-6"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                                aria-hidden="true"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M9 5l7 7-7 7"
                                                />
                                            </svg>
                                        </button>

                                    @endif
                                </div>


                                {{-- Dots --}}
                                @if ($hasMultiplePhotos)

                                    <div
                                        class="facility-dots
                                               flex items-center
                                               justify-center gap-2
                                               bg-white px-5 py-5"
                                        aria-label="Navigasi dokumentasi"
                                    >
                                        @foreach ($photos as $photo)

                                            <button
                                                type="button"
                                                @class([
                                                    'facility-dot h-3',
                                                    'rounded-full transition-all',
                                                    'w-8 bg-blue-700' =>
                                                        $loop->first,
                                                    'w-3 bg-slate-300' =>
                                                        !$loop->first,
                                                ])
                                                aria-label="Tampilkan foto {{ $loop->iteration }}"
                                                aria-current="{{ $loop->first
                                                    ? 'true'
                                                    : 'false' }}"
                                            ></button>

                                        @endforeach
                                    </div>

                                @endif
                            </div>
                        </div>
                    </article>

                @endforeach
            </div>

        @else

            {{-- ================================================= --}}
            {{-- EMPTY STATE --}}
            {{-- ================================================= --}}

            <div
                class="mx-auto max-w-3xl
                       rounded-[2rem] border
                       border-slate-100 bg-white
                       p-8 text-center shadow-lg
                       sm:p-10"
                data-aos="fade-up"
            >
                <div
                    class="mx-auto flex h-20 w-20
                           items-center justify-center
                           rounded-3xl bg-blue-100
                           text-blue-700"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-10 w-10"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        aria-hidden="true"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M4 20h16a2 2 0 002-2V6a2 2 0 00-2-2H4a2 2 0 00-2 2v12a2 2 0 002 2z"
                        />
                    </svg>
                </div>

                <h3
                    class="mt-5 text-2xl font-bold
                           text-slate-800"
                >
                    Dokumentasi Belum Tersedia
                </h3>

                <p
                    class="mx-auto mt-3 max-w-xl
                           leading-7 text-slate-500"
                >
                    Foto fasilitas dan aktivitas mahasiswa belum
                    dipublikasikan oleh pengelola program studi.
                </p>
            </div>

        @endif
    </div>
</section>


@once
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sliders = document.querySelectorAll(
                '[data-facility-slider]'
            );

            sliders.forEach(function (slider) {
                const track = slider.querySelector(
                    '.facility-track'
                );

                const slides = Array.from(
                    slider.querySelectorAll(
                        '.facility-slide'
                    )
                );

                const previousButton = slider.querySelector(
                    '.facility-prev'
                );

                const nextButton = slider.querySelector(
                    '.facility-next'
                );

                const dots = Array.from(
                    slider.querySelectorAll(
                        '.facility-dot'
                    )
                );

                if (!track || slides.length <= 1) {
                    return;
                }

                let currentIndex = 0;
                let touchStartX = null;


                function normalizeIndex(index) {
                    if (index < 0) {
                        return slides.length - 1;
                    }

                    if (index >= slides.length) {
                        return 0;
                    }

                    return index;
                }


                function updateSlider(nextIndex) {
                    currentIndex = normalizeIndex(nextIndex);

                    track.style.transform =
                        'translateX(-'
                        + (currentIndex * 100)
                        + '%)';

                    slides.forEach(function (slide, index) {
                        slide.setAttribute(
                            'aria-hidden',
                            index === currentIndex
                                ? 'false'
                                : 'true'
                        );
                    });

                    dots.forEach(function (dot, index) {
                        const isActive =
                            index === currentIndex;

                        dot.classList.toggle(
                            'w-8',
                            isActive
                        );

                        dot.classList.toggle(
                            'bg-blue-700',
                            isActive
                        );

                        dot.classList.toggle(
                            'w-3',
                            !isActive
                        );

                        dot.classList.toggle(
                            'bg-slate-300',
                            !isActive
                        );

                        dot.setAttribute(
                            'aria-current',
                            isActive
                                ? 'true'
                                : 'false'
                        );
                    });
                }


                function showNextSlide() {
                    updateSlider(currentIndex + 1);
                }


                function showPreviousSlide() {
                    updateSlider(currentIndex - 1);
                }


                if (nextButton) {
                    nextButton.addEventListener(
                        'click',
                        showNextSlide
                    );
                }


                if (previousButton) {
                    previousButton.addEventListener(
                        'click',
                        showPreviousSlide
                    );
                }


                dots.forEach(function (dot, index) {
                    dot.addEventListener(
                        'click',
                        function () {
                            updateSlider(index);
                        }
                    );
                });


                slider.addEventListener(
                    'keydown',
                    function (event) {
                        if (event.key === 'ArrowRight') {
                            event.preventDefault();
                            showNextSlide();
                        }

                        if (event.key === 'ArrowLeft') {
                            event.preventDefault();
                            showPreviousSlide();
                        }
                    }
                );


                slider.addEventListener(
                    'touchstart',
                    function (event) {
                        touchStartX =
                            event.touches[0].clientX;
                    },
                    {
                        passive: true,
                    }
                );


                slider.addEventListener(
                    'touchend',
                    function (event) {
                        if (touchStartX === null) {
                            return;
                        }

                        const touchEndX =
                            event.changedTouches[0].clientX;

                        const distance =
                            touchEndX - touchStartX;

                        touchStartX = null;

                        if (Math.abs(distance) < 50) {
                            return;
                        }

                        if (distance < 0) {
                            showNextSlide();
                        } else {
                            showPreviousSlide();
                        }
                    },
                    {
                        passive: true,
                    }
                );


                updateSlider(0);
            });
        });
    </script>
@endonce