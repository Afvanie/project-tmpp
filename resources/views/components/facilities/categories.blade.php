@php
    /*
    |--------------------------------------------------------------------------
    | DATA FASILITAS
    |--------------------------------------------------------------------------
    */

    $facilityItems = collect(
        $facilities ?? []
    );


    /*
    |--------------------------------------------------------------------------
    | IDENTITAS VISUAL KATEGORI
    |--------------------------------------------------------------------------
    |
    | Judul dan deskripsi tetap berasal dari database.
    | Konfigurasi berikut hanya mengatur ikon dan label publik.
    |
    */

    $categoryStyles = [
        \App\Models\Facility::CATEGORY_LABORATORY => [
            'icon' => 'fa-flask-vial',
            'label' => 'Ruang Laboratorium',
            'icon_class' => 'bg-blue-50 text-[#075F9B]',
            'dot_class' => 'bg-[#075F9B]',
        ],

        \App\Models\Facility::CATEGORY_WORKSHOP => [
            'icon' => 'fa-screwdriver-wrench',
            'label' => 'Ruang Workshop',
            'icon_class' => 'bg-yellow-50 text-yellow-700',
            'dot_class' => 'bg-[#D7B33E]',
        ],

        \App\Models\Facility::CATEGORY_CLASSROOM => [
            'icon' => 'fa-chalkboard-user',
            'label' => 'Ruang Kelas',
            'icon_class' => 'bg-blue-50 text-[#075F9B]',
            'dot_class' => 'bg-[#075F9B]',
        ],

        \App\Models\Facility::CATEGORY_GALLERY => [
            'icon' => 'fa-images',
            'label' => 'Galeri Aktivitas',
            'icon_class' => 'bg-yellow-50 text-yellow-700',
            'dot_class' => 'bg-[#D7B33E]',
        ],
    ];


    /*
    |--------------------------------------------------------------------------
    | RINGKASAN DATA
    |--------------------------------------------------------------------------
    */

    $totalPublishedPhotos = $facilityItems
        ->sum(function ($facility) {
            return collect(
                $facility->photos ?? []
            )
                ->filter(function ($photo) {
                    $photoPath = trim(
                        (string) (
                            $photo->photo
                            ?? ''
                        )
                    );

                    return $photoPath !== ''
                        && \Illuminate\Support\Facades\Storage::disk(
                            'public'
                        )->exists($photoPath);
                })
                ->count();
        });
@endphp


<section
    id="kategori-fasilitas"
    class="border-b border-slate-200
           bg-white py-12
           md:py-14"
>
    <div
        class="mx-auto max-w-7xl px-6"
    >
        {{-- ===================================================== --}}
        {{-- HEADING RINGKAS --}}
        {{-- ===================================================== --}}

        <div
            class="flex flex-col gap-6
                   lg:flex-row
                   lg:items-end
                   lg:justify-between"
            data-aos="fade-up"
        >
            <div class="max-w-2xl">
                <div
                    class="flex items-center gap-3"
                >
                    <span
                        class="h-px w-8
                               bg-[#D7B33E]"
                        aria-hidden="true"
                    ></span>

                    <p
                        class="text-[10px] font-bold
                               uppercase
                               tracking-[0.2em]
                               text-[#075F9B]"
                    >
                        Kategori Fasilitas
                    </p>
                </div>

                <h2
                    class="mt-3 text-2xl
                           font-semibold
                           tracking-[-0.02em]
                           text-slate-900
                           sm:text-3xl"
                    style="
                        font-family:
                            'Space Grotesk',
                            'Plus Jakarta Sans',
                            sans-serif;
                    "
                >
                    Sarana Pendukung Pembelajaran
                </h2>

                <p
                    class="mt-3 text-sm
                           leading-7 text-slate-500"
                >
                    Ringkasan kategori fasilitas yang tersedia
                    pada Program Studi D-IV Teknik Mesin Produksi
                    dan Perawatan.
                </p>
            </div>


            @if ($facilityItems->isNotEmpty())
                <div
                    class="flex items-center gap-5
                           text-sm text-slate-500"
                >
                    <div>
                        <span
                            class="font-bold
                                   text-[#075F9B]"
                        >
                            {{ $facilityItems->count() }}
                        </span>

                        kategori
                    </div>

                    <span
                        class="h-4 w-px
                               bg-slate-300"
                        aria-hidden="true"
                    ></span>

                    <div>
                        <span
                            class="font-bold
                                   text-yellow-700"
                        >
                            {{ $totalPublishedPhotos }}
                        </span>

                        dokumentasi
                    </div>
                </div>
            @endif
        </div>


        {{-- ===================================================== --}}
        {{-- KATEGORI MINIMALIS --}}
        {{-- ===================================================== --}}

        @if ($facilityItems->isNotEmpty())
            <div
                class="mt-8 grid gap-4
                       sm:grid-cols-2
                       xl:grid-cols-4"
            >
                @foreach ($facilityItems as $facility)
                    @php
                        $style = $categoryStyles[
                            $facility->category
                        ] ?? [
                            'icon' => 'fa-building',
                            'label' => trim(
                                (string) (
                                    $facility->category_label
                                    ?? 'Fasilitas'
                                )
                            ),
                            'icon_class' => 'bg-blue-50 text-[#075F9B]',
                            'dot_class' => 'bg-[#075F9B]',
                        ];

                        $facilityTitle = trim(
                            (string) (
                                $facility->title
                                ?? ''
                            )
                        );

                        $facilityDescription = trim(
                            (string) (
                                $facility->description
                                ?? ''
                            )
                        );

                        $validPhotos = collect(
                            $facility->photos ?? []
                        )
                            ->filter(function ($photo) {
                                $photoPath = trim(
                                    (string) (
                                        $photo->photo
                                        ?? ''
                                    )
                                );

                                return $photoPath !== ''
                                    && \Illuminate\Support\Facades\Storage::disk(
                                        'public'
                                    )->exists($photoPath);
                            })
                            ->values();

                        $photoCount = $validPhotos->count();

                        $targetId = 'facility-slider-'
                            . $facility->id;
                    @endphp


                    <article
                        class="group relative
                               rounded-2xl border
                               border-slate-200
                               bg-white p-5
                               transition duration-300
                               hover:-translate-y-0.5
                               hover:border-blue-200
                               hover:shadow-md"
                        data-aos="fade-up"
                        data-aos-delay="{{ min(
                            ($loop->index % 4) * 70,
                            210
                        ) }}"
                    >
                        <div
                            class="flex items-start gap-4"
                        >
                            {{-- Ikon --}}
                            <span
                                class="flex h-11 w-11
                                       shrink-0 items-center
                                       justify-center
                                       rounded-xl
                                       {{ $style['icon_class'] }}"
                            >
                                <i
                                    class="fa-solid
                                           {{ $style['icon'] }}"
                                    aria-hidden="true"
                                ></i>
                            </span>


                            {{-- Informasi --}}
                            <div class="min-w-0 flex-1">
                                <div
                                    class="flex items-center gap-2"
                                >
                                    <span
                                        class="h-1.5 w-1.5
                                               shrink-0 rounded-full
                                               {{ $style['dot_class'] }}"
                                        aria-hidden="true"
                                    ></span>

                                    <p
                                        class="text-[9px]
                                               font-bold uppercase
                                               tracking-[0.15em]
                                               text-slate-400"
                                    >
                                        {{ $style['label'] }}
                                    </p>
                                </div>


                                <h3
                                    class="mt-2 text-base
                                           font-bold leading-6
                                           text-slate-900"
                                >
                                    {{ $facilityTitle !== ''
                                        ? $facilityTitle
                                        : $style['label'] }}
                                </h3>


                                @if ($facilityDescription !== '')
                                    <p
                                        class="mt-2 text-xs
                                               leading-6
                                               text-slate-500"
                                    >
                                        {{ \Illuminate\Support\Str::limit(
                                            $facilityDescription,
                                            85
                                        ) }}
                                    </p>
                                @endif
                            </div>
                        </div>


                        <div
                            class="mt-5 flex items-center
                                   justify-between
                                   border-t
                                   border-slate-100 pt-4"
                        >
                            <div
                                class="flex items-center gap-2
                                       text-xs text-slate-500"
                            >
                                <i
                                    class="fa-regular
                                           fa-images"
                                    aria-hidden="true"
                                ></i>

                                <span>
                                    {{ $photoCount }}
                                    foto
                                </span>
                            </div>


                            @if ($photoCount > 0)
                                <a
                                    href="#{{ $targetId }}"
                                    class="inline-flex
                                           items-center gap-2
                                           text-xs font-bold
                                           text-[#075F9B]
                                           transition
                                           hover:text-[#073763]"
                                >
                                    Lihat

                                    <i
                                        class="fa-solid
                                               fa-arrow-down
                                               text-[10px]"
                                        aria-hidden="true"
                                    ></i>
                                </a>
                            @else
                                <span
                                    class="text-[10px]
                                           font-semibold
                                           text-slate-400"
                                >
                                    Belum tersedia
                                </span>
                            @endif
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            {{-- ================================================= --}}
            {{-- EMPTY STATE --}}
            {{-- ================================================= --}}

            <div
                class="mt-8 rounded-2xl
                       border border-dashed
                       border-slate-300
                       bg-slate-50
                       px-6 py-9
                       text-center"
                data-aos="fade-up"
            >
                <span
                    class="mx-auto flex h-12 w-12
                           items-center justify-center
                           rounded-xl bg-blue-50
                           text-[#075F9B]"
                >
                    <i
                        class="fa-solid fa-building"
                        aria-hidden="true"
                    ></i>
                </span>

                <h3
                    class="mt-4 font-bold
                           text-slate-900"
                >
                    Informasi Fasilitas Belum Tersedia
                </h3>

                <p
                    class="mt-2 text-sm
                           leading-7 text-slate-500"
                >
                    Kategori fasilitas belum dipublikasikan
                    oleh pengelola program studi.
                </p>
            </div>
        @endif
    </div>
</section>