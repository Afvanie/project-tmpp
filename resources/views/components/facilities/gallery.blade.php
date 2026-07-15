@php
    /*
    |--------------------------------------------------------------------------
    | GALERI FASILITAS
    |--------------------------------------------------------------------------
    |
    | Hanya fasilitas yang mempunyai foto aktif dan file yang tersedia
    | pada storage publik yang akan ditampilkan.
    |
    */

    $facilityCollection = collect(
        $facilities ?? []
    );

    $galleryFacilities = $facilityCollection
        ->map(function ($facility) {
            $validPhotos = collect(
                $facility->photos ?? []
            )
                ->filter(function ($photo): bool {
                    $photoPath = ltrim(
                        trim(
                            (string) (
                                $photo->photo
                                ?? ''
                            )
                        ),
                        '/'
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

    $totalGalleryPhotos = $galleryFacilities
        ->sum(function ($facility): int {
            return $facility->photos->count();
        });
@endphp


<section
    id="dokumentasi-fasilitas"
    class="relative overflow-hidden
           bg-white py-16
           md:py-20 lg:py-24"
>
    {{-- ========================================================= --}}
    {{-- DEKORASI BACKGROUND --}}
    {{-- ========================================================= --}}

    <div
        class="pointer-events-none absolute inset-0"
        aria-hidden="true"
    >
        <div
            class="absolute -right-56 top-0
                   h-[460px] w-[460px]
                   rounded-full bg-blue-100/35
                   blur-[150px]"
        ></div>

        <div
            class="absolute -left-56 bottom-0
                   h-[460px] w-[460px]
                   rounded-full bg-yellow-100/35
                   blur-[150px]"
        ></div>
    </div>


    <div
        class="relative"
        style="
            display: grid;
            width: 100%;
            justify-items: center;
            padding-left: 24px;
            padding-right: 24px;
        "
    >
        {{-- CENTER FIX FINAL --}}
        <div
            style="
                width: 100%;
                max-width: 1024px;
            "
        >
        {{-- ===================================================== --}}
        {{-- HEADING --}}
        {{-- ===================================================== --}}

        <header
            class="grid items-end gap-8
                   lg:grid-cols-12"
            data-aos="fade-up"
        >
            <div class="lg:col-span-8">
                <div
                    class="flex items-center gap-3"
                >
                    <span
                        class="h-px w-9
                               bg-[#D7B33E]"
                        aria-hidden="true"
                    ></span>

                    <p
                        class="text-[10px] font-bold
                               uppercase
                               tracking-[0.22em]
                               text-[#075F9B]"
                    >
                        Dokumentasi Fasilitas
                    </p>
                </div>


                <h2
                    class="mt-4 max-w-4xl
                           text-3xl font-semibold
                           leading-tight
                           tracking-[-0.025em]
                           text-slate-900
                           sm:text-4xl lg:text-5xl"
                    style="
                        font-family:
                            'Space Grotesk',
                            'Plus Jakarta Sans',
                            sans-serif;
                    "
                >
                    Jelajahi Fasilitas dan Aktivitas Mahasiswa
                </h2>


                <p
                    class="mt-5 max-w-2xl
                           text-sm leading-7
                           text-slate-600
                           sm:text-base sm:leading-8"
                >
                    Dokumentasi ruang pembelajaran, kegiatan praktik,
                    fasilitas pendukung, dan aktivitas mahasiswa
                    Program Studi D-IV Teknik Mesin Produksi dan
                    Perawatan.
                </p>


                <div
                    class="mt-6 flex items-center gap-3"
                    aria-hidden="true"
                >
                    <span
                        class="h-1 w-14 rounded-full
                               bg-[#075F9B]"
                    ></span>

                    <span
                        class="h-1 w-7 rounded-full
                               bg-[#D7B33E]"
                    ></span>
                </div>
            </div>


            @if ($galleryFacilities->isNotEmpty())
                <div
                    class="flex items-center gap-6
                           lg:col-span-4
                           lg:justify-end"
                >
                    <div
                        class="border-l-2
                               border-[#075F9B]
                               pl-4"
                    >
                        <p
                            class="text-3xl font-bold
                                   text-[#075F9B]"
                        >
                            {{ str_pad(
                                (string) $galleryFacilities->count(),
                                2,
                                '0',
                                STR_PAD_LEFT
                            ) }}
                        </p>

                        <p
                            class="mt-1 text-[9px]
                                   font-bold uppercase
                                   tracking-[0.15em]
                                   text-slate-400"
                        >
                            Kategori
                        </p>
                    </div>


                    <div
                        class="border-l-2
                               border-[#D7B33E]
                               pl-4"
                    >
                        <p
                            class="text-3xl font-bold
                                   text-yellow-700"
                        >
                            {{ str_pad(
                                (string) $totalGalleryPhotos,
                                2,
                                '0',
                                STR_PAD_LEFT
                            ) }}
                        </p>

                        <p
                            class="mt-1 text-[9px]
                                   font-bold uppercase
                                   tracking-[0.15em]
                                   text-slate-400"
                        >
                            Dokumentasi
                        </p>
                    </div>
                </div>
            @endif
        </header>


        {{-- ===================================================== --}}
        {{-- DAFTAR GALERI --}}
        {{-- ===================================================== --}}

        @if ($galleryFacilities->isNotEmpty())
            <div
                class="mt-12 space-y-10
                       lg:mt-16 lg:space-y-14"
            >
                @foreach ($galleryFacilities as $facility)
                    @php
                        $facilityTitle = trim(
                            (string) (
                                $facility->title
                                ?? ''
                            )
                        );

                        $facilityLabel = trim(
                            (string) (
                                $facility->category_label
                                ?? 'Fasilitas'
                            )
                        );

                        $facilityDescription = trim(
                            (string) (
                                $facility->description
                                ?? ''
                            )
                        );

                        $photos = $facility->photos;

                        $photoTotal = $photos->count();

                        $hasMultiplePhotos =
                            $photoTotal > 1;

                        $sliderId =
                            'facility-slider-'
                            . $facility->id;

                        $displayTitle =
                            $facilityTitle !== ''
                                ? $facilityTitle
                                : $facilityLabel;

                        $firstPhoto = $photos->first();

                        $firstPhotoPath = ltrim(
                            trim(
                                (string) $firstPhoto->photo
                            ),
                            '/'
                        );

                        $firstPhotoUrl = asset(
                            'storage/'
                            . $firstPhotoPath
                        );

                        $firstPhotoTitle = trim(
                            (string) (
                                $firstPhoto->title
                                ?? ''
                            )
                        );

                        $firstPhotoCaption =
                            $firstPhotoTitle !== ''
                                ? $firstPhotoTitle
                                : $displayTitle;

                        $imageOnRight =
                            $loop->iteration % 2 === 0;
                    @endphp


                    <article
                        id="{{ $sliderId }}"
                        class="w-full scroll-mt-28
                               overflow-hidden rounded-[2rem]
                               border border-slate-200
                               bg-white
                               shadow-[0_20px_55px_rgba(15,23,42,0.10)]"
                        data-facility-slider
                        data-aos="fade-up"
                        tabindex="0"
                        role="region"
                        aria-roledescription="carousel"
                        aria-label="Dokumentasi {{ $displayTitle }}"
                    >
                        <div
                            class="grid lg:h-[510px]
                                    lg:grid-cols-12"
                        >
                            {{-- ================================= --}}
                            {{-- FOTO UTAMA --}}
                            {{-- ================================= --}}

                            <div
                                @class([
                                    'relative min-w-0 bg-slate-900',
                                    'lg:col-span-8',
                                    'lg:order-2' => $imageOnRight,
                                    'lg:order-1' => !$imageOnRight,
                                ])
                            >
                                <div
                                    class="relative h-[320px]
                                           overflow-hidden
                                           sm:h-[430px]
                                           lg:h-[510px]"
                                >
                                    <div
                                        class="facility-track
                                               flex h-full
                                               transition-transform
                                               duration-500
                                               ease-out"
                                    >
                                        @foreach ($photos as $photo)
                                            @php
                                                $photoPath = ltrim(
                                                    trim(
                                                        (string) $photo->photo
                                                    ),
                                                    '/'
                                                );

                                                $photoUrl = asset(
                                                    'storage/'
                                                    . $photoPath
                                                );

                                                $photoTitle = trim(
                                                    (string) (
                                                        $photo->title
                                                        ?? ''
                                                    )
                                                );

                                                $photoCaption =
                                                    $photoTitle !== ''
                                                        ? $photoTitle
                                                        : $displayTitle;
                                            @endphp


                                            <figure
                                                class="facility-slide
                                                       relative h-full
                                                       min-w-full"
                                                data-slide-index="{{ $loop->index }}"
                                                data-photo-url="{{ $photoUrl }}"
                                                data-photo-title="{{ $photoCaption }}"
                                                aria-hidden="{{ $loop->first
                                                    ? 'false'
                                                    : 'true' }}"
                                            >
                                                {{-- Background blur --}}
                                                <img
                                                    src="{{ $photoUrl }}"
                                                    alt=""
                                                    class="absolute inset-0
                                                           h-full w-full
                                                           scale-110
                                                           object-cover
                                                           opacity-40
                                                           blur-2xl"
                                                    loading="lazy"
                                                >


                                                {{-- Gambar utama --}}
                                                <img
                                                    src="{{ $photoUrl }}"
                                                    alt="Dokumentasi {{ $photoCaption }}"
                                                    class="relative h-full
                                                           w-full object-cover"
                                                    loading="lazy"
                                                >


                                                {{-- Overlay --}}
                                                <div
                                                    class="pointer-events-none
                                                           absolute inset-0
                                                           bg-gradient-to-t
                                                           from-slate-950/90
                                                           via-slate-950/10
                                                           to-slate-950/10"
                                                    aria-hidden="true"
                                                ></div>


                                                {{-- Caption --}}
                                                <figcaption
                                                    class="absolute bottom-6
                                                           left-6 right-24
                                                           sm:bottom-8
                                                           sm:left-8
                                                           sm:right-28"
                                                >
                                                    <p
                                                        class="text-[9px]
                                                               font-bold uppercase
                                                               tracking-[0.18em]
                                                               text-[#F2D56F]"
                                                    >
                                                        Dokumentasi
                                                    </p>

                                                    <p
                                                        class="mt-2 line-clamp-2
                                                               text-lg font-bold
                                                               leading-7 text-white
                                                               drop-shadow
                                                               sm:text-xl"
                                                    >
                                                        {{ $photoCaption }}
                                                    </p>
                                                </figcaption>
                                            </figure>
                                        @endforeach
                                    </div>


                                    {{-- Counter --}}
                                    <div
                                        class="absolute right-5 top-5
                                               flex items-center gap-1
                                               rounded-full
                                               border border-white/20
                                               bg-slate-950/45
                                               px-4 py-2
                                               text-xs font-bold
                                               text-white
                                               backdrop-blur-md
                                               sm:right-6 sm:top-6"
                                    >
                                        <span data-current-index>
                                            01
                                        </span>

                                        <span class="text-white/40">
                                            /
                                        </span>

                                        <span>
                                            {{ str_pad(
                                                (string) $photoTotal,
                                                2,
                                                '0',
                                                STR_PAD_LEFT
                                            ) }}
                                        </span>
                                    </div>


                                    {{-- Navigasi --}}
                                    @if ($hasMultiplePhotos)
                                        <div
                                            class="absolute bottom-6
                                                   right-5 flex gap-2
                                                   sm:bottom-8
                                                   sm:right-7"
                                        >
                                            <button
                                                type="button"
                                                class="facility-prev
                                                       flex h-11 w-11
                                                       items-center
                                                       justify-center
                                                       rounded-full
                                                       border border-white/20
                                                       bg-white/10
                                                       text-white
                                                       backdrop-blur-md
                                                       transition
                                                       hover:border-white
                                                       hover:bg-white
                                                       hover:text-slate-900"
                                                aria-label="Foto sebelumnya"
                                            >
                                                <i
                                                    class="fa-solid
                                                           fa-chevron-left
                                                           text-xs"
                                                    aria-hidden="true"
                                                ></i>
                                            </button>


                                            <button
                                                type="button"
                                                class="facility-next
                                                       flex h-11 w-11
                                                       items-center
                                                       justify-center
                                                       rounded-full
                                                       border border-white/20
                                                       bg-white/10
                                                       text-white
                                                       backdrop-blur-md
                                                       transition
                                                       hover:border-white
                                                       hover:bg-white
                                                       hover:text-slate-900"
                                                aria-label="Foto berikutnya"
                                            >
                                                <i
                                                    class="fa-solid
                                                           fa-chevron-right
                                                           text-xs"
                                                    aria-hidden="true"
                                                ></i>
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>


                            {{-- ================================= --}}
                            {{-- INFORMASI FASILITAS --}}
                            {{-- ================================= --}}

                            <div
                                @class([
                                    'relative flex flex-col',
                                    'justify-between bg-[#F8FAFC]',
                                    'p-6 sm:p-8 lg:p-10',
                                    'lg:col-span-4',
                                    'lg:order-1' => $imageOnRight,
                                    'lg:order-2' => !$imageOnRight,
                                ])
                            >
                                {{-- Aksen --}}
                                <div
                                    @class([
                                        'absolute top-0 h-1',
                                        'w-24 bg-[#D7B33E]',
                                        'left-0' => $imageOnRight,
                                        'right-0' => !$imageOnRight,
                                    ])
                                    aria-hidden="true"
                                ></div>


                                <div>
                                    <div
                                        class="flex items-center
                                               justify-between gap-4"
                                    >
                                        <span
                                            class="inline-flex items-center
                                                   gap-2 rounded-full
                                                   border border-blue-100
                                                   bg-white px-3 py-1.5
                                                   text-[9px] font-bold
                                                   uppercase
                                                   tracking-[0.15em]
                                                   text-[#075F9B]
                                                   shadow-sm"
                                        >
                                            <span
                                                class="h-1.5 w-1.5
                                                       rounded-full
                                                       bg-[#D7B33E]"
                                                aria-hidden="true"
                                            ></span>

                                            {{ $facilityLabel }}
                                        </span>


                                        <span
                                            class="text-xs font-bold
                                                   text-slate-300"
                                        >
                                            {{ str_pad(
                                                (string) $loop->iteration,
                                                2,
                                                '0',
                                                STR_PAD_LEFT
                                            ) }}
                                        </span>
                                    </div>


                                    <h3
                                        class="mt-6 text-2xl
                                               font-bold leading-tight
                                               tracking-[-0.025em]
                                               text-slate-900
                                               sm:text-3xl"
                                    >
                                        {{ $displayTitle }}
                                    </h3>


                                    @if ($facilityDescription !== '')
                                        <p
                                            class="mt-4 text-sm
                                                   leading-7
                                                   text-slate-600"
                                        >
                                            {{ $facilityDescription }}
                                        </p>
                                    @else
                                        <p
                                            class="mt-4 text-sm
                                                   leading-7
                                                   text-slate-500"
                                        >
                                            Dokumentasi fasilitas
                                            {{ strtolower($facilityLabel) }}
                                            yang telah dipublikasikan
                                            oleh pengelola program studi.
                                        </p>
                                    @endif


                                    <div
                                        class="mt-6 flex items-center
                                               gap-3 text-xs
                                               font-medium
                                               text-slate-500"
                                    >
                                        <span
                                            class="flex h-9 w-9
                                                   items-center
                                                   justify-center
                                                   rounded-xl
                                                   bg-blue-50
                                                   text-[#075F9B]"
                                        >
                                            <i
                                                class="fa-regular fa-images"
                                                aria-hidden="true"
                                            ></i>
                                        </span>

                                        <span>
                                            {{ $photoTotal }}
                                            dokumentasi foto
                                        </span>
                                    </div>
                                </div>


                                {{-- Thumbnail --}}
                                <div class="mt-8">
                                


                                    <div
                                        class="mt-6 border-t
                                               border-slate-200 pt-6"
                                    >
                                        <p
                                            class="text-[9px] font-bold
                                                   uppercase
                                                   tracking-[0.16em]
                                                   text-slate-400"
                                        >
                                            Foto Aktif
                                        </p>

                                        <p
                                            class="mt-2 line-clamp-2
                                                   text-sm font-semibold
                                                   leading-6
                                                   text-slate-700"
                                            data-current-title
                                        >
                                            {{ $firstPhotoCaption }}
                                        </p>


                                        <a
                                            href="{{ $firstPhotoUrl }}"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            data-open-photo
                                            class="mt-5 inline-flex
                                                   items-center gap-3
                                                   text-xs font-bold
                                                   uppercase
                                                   tracking-[0.12em]
                                                   text-[#075F9B]
                                                   transition
                                                   hover:text-[#073763]"
                                        >
                                            Buka Foto Penuh

                                            <span
                                                class="flex h-9 w-9
                                                       items-center
                                                       justify-center
                                                       rounded-full
                                                       bg-[#075F9B]
                                                       text-white
                                                       transition
                                                       hover:bg-[#073763]"
                                            >
                                                <i
                                                    class="fa-solid
                                                           fa-up-right-from-square
                                                           text-[10px]"
                                                    aria-hidden="true"
                                                ></i>
                                            </span>
                                        </a>
                                    </div>
                                </div>
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
                class="mt-12 rounded-[2rem]
                       border border-dashed
                       border-slate-300
                       bg-[#F8FAFC]
                       px-6 py-14
                       text-center"
                data-aos="fade-up"
            >
                <span
                    class="mx-auto flex h-16 w-16
                           items-center justify-center
                           rounded-2xl bg-blue-50
                           text-2xl text-[#075F9B]"
                >
                    <i
                        class="fa-regular fa-images"
                        aria-hidden="true"
                    ></i>
                </span>

                <h3
                    class="mt-5 text-xl font-bold
                           text-slate-900"
                >
                    Dokumentasi Belum Tersedia
                </h3>

                <p
                    class="mx-auto mt-3 max-w-xl
                           text-sm leading-7
                           text-slate-500"
                >
                    Foto fasilitas dan aktivitas mahasiswa belum
                    dipublikasikan oleh pengelola program studi.
                </p>
            </div>
        @endif
        </div>
    </div>
</section>


@once
    <script>
        function initializeFacilitySliders() {
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

                const thumbnails = Array.from(
                    slider.querySelectorAll(
                        '.facility-thumb'
                    )
                );

                const currentIndexElement =
                    slider.querySelector(
                        '[data-current-index]'
                    );

                const currentTitleElement =
                    slider.querySelector(
                        '[data-current-title]'
                    );

                const openPhotoLink =
                    slider.querySelector(
                        '[data-open-photo]'
                    );

                if (!track || slides.length === 0) {
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
                    currentIndex = normalizeIndex(
                        nextIndex
                    );

                    track.style.transform =
                        'translateX(-'
                        + (currentIndex * 100)
                        + '%)';

                    slides.forEach(
                        function (slide, index) {
                            slide.setAttribute(
                                'aria-hidden',
                                index === currentIndex
                                    ? 'false'
                                    : 'true'
                            );
                        }
                    );


                    thumbnails.forEach(
                        function (thumbnail, index) {
                            const isActive =
                                index === currentIndex;

                            thumbnail.classList.toggle(
                                'border-[#D7B33E]',
                                isActive
                            );

                            thumbnail.classList.toggle(
                                'opacity-100',
                                isActive
                            );

                            thumbnail.classList.toggle(
                                'ring-2',
                                isActive
                            );

                            thumbnail.classList.toggle(
                                'ring-yellow-200',
                                isActive
                            );

                            thumbnail.classList.toggle(
                                'border-transparent',
                                !isActive
                            );

                            thumbnail.classList.toggle(
                                'opacity-60',
                                !isActive
                            );

                            thumbnail.setAttribute(
                                'aria-current',
                                isActive
                                    ? 'true'
                                    : 'false'
                            );

                        }
                    );


                    const activeSlide =
                        slides[currentIndex];

                    const photoUrl =
                        activeSlide.dataset.photoUrl;

                    const photoTitle =
                        activeSlide.dataset.photoTitle;


                    if (currentIndexElement) {
                        currentIndexElement.textContent =
                            String(currentIndex + 1)
                                .padStart(2, '0');
                    }


                    if (currentTitleElement) {
                        currentTitleElement.textContent =
                            photoTitle;
                    }


                    if (openPhotoLink && photoUrl) {
                        openPhotoLink.href = photoUrl;

                        openPhotoLink.setAttribute(
                            'aria-label',
                            'Buka foto '
                            + photoTitle
                        );
                    }
                }


                function showNextSlide() {
                    updateSlider(
                        currentIndex + 1
                    );
                }


                function showPreviousSlide() {
                    updateSlider(
                        currentIndex - 1
                    );
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


                thumbnails.forEach(
                    function (thumbnail, index) {
                        thumbnail.addEventListener(
                            'click',
                            function () {
                                updateSlider(index);
                            }
                        );
                    }
                );


                slider.addEventListener(
                    'keydown',
                    function (event) {
                        if (
                            event.key ===
                            'ArrowRight'
                        ) {
                            event.preventDefault();
                            showNextSlide();
                        }

                        if (
                            event.key ===
                            'ArrowLeft'
                        ) {
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
                            event.changedTouches[0]
                                .clientX;

                        const distance =
                            touchEndX - touchStartX;

                        touchStartX = null;

                        if (
                            Math.abs(distance) < 50
                        ) {
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
        }


        if (
            document.readyState === 'loading'
        ) {
            document.addEventListener(
                'DOMContentLoaded',
                initializeFacilitySliders
            );
        } else {
            initializeFacilitySliders();
        }
    </script>
@endonce