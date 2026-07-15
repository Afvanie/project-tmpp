@php
    /*
    |--------------------------------------------------------------------------
    | DATA AKREDITASI
    |--------------------------------------------------------------------------
    */

    $accreditations = isset($accreditations)
        ? collect($accreditations)
            ->filter(function ($item) {
                return (bool) ($item->is_active ?? false);
            })
            ->sortBy([
                ['sort_order', 'asc'],
                ['created_at', 'desc'],
            ])
            ->values()
        : \App\Models\Accreditation::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->get();


    /*
    |--------------------------------------------------------------------------
    | NAMA BULAN INDONESIA
    |--------------------------------------------------------------------------
    */

    $bulanIndonesia = [
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember',
    ];


    /*
    |--------------------------------------------------------------------------
    | FORMAT TANGGAL
    |--------------------------------------------------------------------------
    */

    $formatTanggalIndonesia = function ($date) use (
        $bulanIndonesia
    ) {
        if (!$date) {
            return null;
        }

        try {
            $tanggal = \Illuminate\Support\Carbon::parse(
                $date
            );
        } catch (\Throwable $exception) {
            return null;
        }

        return $tanggal->day
            . ' '
            . $bulanIndonesia[$tanggal->month]
            . ' '
            . $tanggal->year;
    };


    /*
    |--------------------------------------------------------------------------
    | FORMAT MASA BERLAKU
    |--------------------------------------------------------------------------
    */

    $formatMasaBerlaku = function ($accreditation) use (
        $formatTanggalIndonesia
    ) {
        $validFrom = $formatTanggalIndonesia(
            $accreditation->valid_from
            ?? null
        );

        $validUntil = $formatTanggalIndonesia(
            $accreditation->valid_until
            ?? null
        );

        if ($validFrom && $validUntil) {
            return $validFrom . ' – ' . $validUntil;
        }

        if ($validFrom) {
            return 'Mulai ' . $validFrom;
        }

        if ($validUntil) {
            return 'Berlaku sampai ' . $validUntil;
        }

        return null;
    };


    /*
    |--------------------------------------------------------------------------
    | INFORMASI DOKUMEN
    |--------------------------------------------------------------------------
    */

    $getFileData = function ($accreditation) {
        $filePath = trim(
            (string) (
                $accreditation->file_path
                ?? ''
            )
        );

        if ($filePath === '') {
            return [
                'url' => null,
                'extension' => null,
                'is_image' => false,
                'is_pdf' => false,
            ];
        }

        $extension = strtolower(
            pathinfo(
                $filePath,
                PATHINFO_EXTENSION
            )
        );

        return [
            'url' => asset(
                'storage/' . ltrim($filePath, '/')
            ),

            'extension' => $extension,

            'is_image' => in_array(
                $extension,
                [
                    'jpg',
                    'jpeg',
                    'png',
                    'webp',
                ],
                true
            ),

            'is_pdf' => $extension === 'pdf',
        ];
    };
@endphp


@if ($accreditations->isNotEmpty())
    <section
        id="profile-accreditation"
        class="relative overflow-hidden
               bg-white py-16
               md:py-20 lg:py-24"
    >
        {{-- ===================================================== --}}
        {{-- LATAR BELAKANG --}}
        {{-- ===================================================== --}}

        <div
            class="pointer-events-none absolute inset-0"
            aria-hidden="true"
        >
            <div
                class="absolute -left-48 top-0
                       h-[430px] w-[430px]
                       rounded-full
                       bg-blue-100/45
                       blur-[145px]"
            ></div>

            <div
                class="absolute -right-48 bottom-0
                       h-[430px] w-[430px]
                       rounded-full
                       bg-yellow-100/35
                       blur-[145px]"
            ></div>
        </div>


        <div
            class="relative mx-auto
                   max-w-7xl px-6"
        >
            {{-- ================================================= --}}
            {{-- HEADING --}}
            {{-- ================================================= --}}

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
                            class="text-[11px] font-bold
                                   uppercase
                                   tracking-[0.22em]
                                   text-[#075F9B]"
                        >
                            Penjaminan Mutu Pendidikan
                        </p>
                    </div>


                    <h2
                        class="mt-5 max-w-4xl
                               text-3xl font-semibold
                               leading-tight
                               tracking-[-0.025em]
                               text-slate-900
                               sm:text-4xl
                               lg:text-5xl"
                        style="
                            font-family:
                                'Space Grotesk',
                                'Plus Jakarta Sans',
                                sans-serif;
                        "
                    >
                        Akreditasi Program Studi
                    </h2>


                    <p
                        class="mt-5 max-w-3xl
                               text-base leading-8
                               text-slate-600
                               sm:text-lg"
                    >
                        Informasi pengakuan mutu Program Studi
                        D-IV Teknik Mesin Produksi dan Perawatan
                        yang dikelola melalui halaman admin.
                    </p>


                    <div
                        class="mt-6 flex items-center gap-3"
                        aria-hidden="true"
                    >
                        <span
                            class="h-1 w-14
                                   rounded-full
                                   bg-[#075F9B]"
                        ></span>

                        <span
                            class="h-1 w-7
                                   rounded-full
                                   bg-[#D7B33E]"
                        ></span>
                    </div>
                </div>


                {{-- Jumlah data --}}
                <div
                    class="lg:col-span-4
                           lg:flex
                           lg:justify-end"
                >
                    <div
                        class="flex items-center gap-5
                               border-l-2
                               border-[#D7B33E]
                               pl-5"
                    >
                        <span
                            class="text-5xl font-bold
                                   tracking-[-0.04em]
                                   text-[#075F9B]"
                        >
                            {{ str_pad(
                                (string) $accreditations->count(),
                                2,
                                '0',
                                STR_PAD_LEFT
                            ) }}
                        </span>

                        <div>
                            <p
                                class="text-xs font-bold
                                       uppercase
                                       tracking-[0.16em]
                                       text-slate-400"
                            >
                                Data Aktif
                            </p>

                            <p
                                class="mt-1 text-sm
                                       leading-6
                                       text-slate-600"
                            >
                                Akreditasi program studi
                            </p>
                        </div>
                    </div>
                </div>
            </header>


            {{-- ================================================= --}}
            {{-- DAFTAR AKREDITASI --}}
            {{-- ================================================= --}}

            <div class="mt-12 space-y-8 lg:mt-14">
                @foreach ($accreditations as $accreditation)
                    @php
                        $fileData = $getFileData(
                            $accreditation
                        );

                        $fileUrl = $fileData['url'];
                        $isImage = $fileData['is_image'];
                        $isPdf = $fileData['is_pdf'];

                        $type = strtolower(
                            trim(
                                (string) (
                                    $accreditation->type
                                    ?? ''
                                )
                            )
                        );

                        $isInternational =
                            $type === 'internasional';

                        $typeLabel = $isInternational
                            ? 'Akreditasi Internasional'
                            : 'Akreditasi Nasional';

                        $title = trim(
                            (string) (
                                $accreditation->title
                                ?? ''
                            )
                        );

                        $rank = trim(
                            (string) (
                                $accreditation->rank
                                ?? ''
                            )
                        );

                        $institution = trim(
                            (string) (
                                $accreditation->institution
                                ?? ''
                            )
                        );

                        $description = trim(
                            (string) (
                                $accreditation->description
                                ?? ''
                            )
                        );

                        $certificateNumber = trim(
                            (string) (
                                $accreditation->certificate_number
                                ?? ''
                            )
                        );

                        $masaBerlaku = $formatMasaBerlaku(
                            $accreditation
                        );

                        $hasMetadata = $rank !== ''
                            || $institution !== ''
                            || $masaBerlaku
                            || $certificateNumber !== '';
                    @endphp


                    <article
                        class="group relative
                               overflow-hidden
                               rounded-[1.75rem]
                               border border-slate-200
                               bg-[#F8FAFC]
                               shadow-[0_18px_50px_rgba(15,23,42,0.07)]"
                        data-aos="fade-up"
                        data-aos-delay="{{ min(
                            $loop->index * 100,
                            300
                        ) }}"
                    >
                        {{-- Garis atas --}}
                        <div
                            class="absolute inset-x-0
                                   top-0 h-1
                                   {{ $isInternational
                                        ? 'bg-gradient-to-r from-[#D7B33E] via-[#075F9B] to-[#D7B33E]'
                                        : 'bg-gradient-to-r from-[#073763] via-[#D7B33E] to-[#075F9B]' }}"
                            aria-hidden="true"
                        ></div>


                        <div
                            class="grid items-stretch
                                   lg:grid-cols-12"
                        >
                            {{-- ================================= --}}
                            {{-- PREVIEW DOKUMEN --}}
                            {{-- ================================= --}}

                            <div
                                class="border-b
                                       border-slate-200
                                       p-5 sm:p-7
                                       lg:col-span-5
                                       lg:border-b-0
                                       lg:border-r"
                            >
                                <div
                                    class="relative flex
                                           min-h-[300px]
                                           overflow-hidden
                                           rounded-[1.35rem]
                                           border border-slate-200
                                           bg-white
                                           shadow-sm
                                           sm:min-h-[360px]"
                                >
                                    @if ($fileUrl && $isImage)
                                        <a
                                            href="{{ $fileUrl }}"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="flex w-full
                                                   items-center
                                                   justify-center
                                                   overflow-hidden
                                                   p-4"
                                            aria-label="Buka sertifikat {{ $title }}"
                                        >
                                            <img
                                                src="{{ $fileUrl }}"
                                                alt="{{ $title !== ''
                                                    ? $title
                                                    : $typeLabel }}"
                                                class="h-[300px]
                                                       w-full object-contain
                                                       transition duration-500
                                                       group-hover:scale-[1.02]
                                                       sm:h-[340px]"
                                                loading="lazy"
                                            >
                                        </a>
                                    @elseif ($fileUrl && $isPdf)
                                        <a
                                            href="{{ $fileUrl }}"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="flex w-full
                                                   flex-col
                                                   items-center
                                                   justify-center
                                                   p-8 text-center
                                                   transition
                                                   hover:bg-slate-50"
                                        >
                                            <span
                                                class="flex h-20 w-20
                                                       items-center
                                                       justify-center
                                                       rounded-3xl
                                                       bg-red-50
                                                       text-2xl
                                                       font-extrabold
                                                       text-red-600"
                                            >
                                                PDF
                                            </span>

                                            <h3
                                                class="mt-5 text-xl
                                                       font-bold
                                                       text-slate-900"
                                            >
                                                Dokumen Sertifikat
                                            </h3>

                                            <p
                                                class="mt-2 text-sm
                                                       leading-7
                                                       text-slate-500"
                                            >
                                                Klik untuk membuka
                                                sertifikat akreditasi.
                                            </p>
                                        </a>
                                    @else
                                        <div
                                            class="flex w-full
                                                   flex-col
                                                   items-center
                                                   justify-center
                                                   p-8 text-center"
                                        >
                                            <span
                                                class="flex h-20 w-20
                                                       items-center
                                                       justify-center
                                                       rounded-3xl
                                                       {{ $isInternational
                                                            ? 'bg-yellow-50 text-yellow-700'
                                                            : 'bg-blue-50 text-[#075F9B]' }}"
                                            >
                                                <i
                                                    class="fa-solid
                                                           fa-award
                                                           text-3xl"
                                                    aria-hidden="true"
                                                ></i>
                                            </span>

                                            <h3
                                                class="mt-5 text-xl
                                                       font-bold
                                                       text-slate-900"
                                            >
                                                Sertifikat Belum Diunggah
                                            </h3>

                                            <p
                                                class="mt-2 max-w-xs
                                                       text-sm leading-7
                                                       text-slate-500"
                                            >
                                                Dokumen dapat ditambahkan
                                                melalui menu akreditasi
                                                pada halaman admin.
                                            </p>
                                        </div>
                                    @endif


                                    {{-- Label dokumen --}}
                                    <span
                                        class="absolute left-4 top-4
                                               inline-flex items-center
                                               gap-2 rounded-full
                                               border border-white/60
                                               bg-white/90
                                               px-3 py-2
                                               text-[10px] font-bold
                                               uppercase
                                               tracking-[0.14em]
                                               text-slate-700
                                               shadow-sm
                                               backdrop-blur-sm"
                                    >
                                        <span
                                            class="h-2 w-2
                                                   rounded-full
                                                   {{ $isInternational
                                                        ? 'bg-[#D7B33E]'
                                                        : 'bg-[#075F9B]' }}"
                                            aria-hidden="true"
                                        ></span>

                                        {{ $typeLabel }}
                                    </span>
                                </div>
                            </div>


                            {{-- ================================= --}}
                            {{-- INFORMASI --}}
                            {{-- ================================= --}}

                            <div
                                class="flex flex-col
                                       justify-center
                                       p-6 sm:p-8
                                       lg:col-span-7
                                       lg:p-10"
                            >
                                <div
                                    class="flex flex-wrap
                                           items-center gap-3"
                                >
                                    <span
                                        class="inline-flex items-center
                                               rounded-full px-4 py-2
                                               text-xs font-bold
                                               {{ $isInternational
                                                    ? 'bg-yellow-100 text-yellow-700'
                                                    : 'bg-blue-100 text-[#075F9B]' }}"
                                    >
                                        {{ $typeLabel }}
                                    </span>

                                    @if ($rank !== '')
                                        <span
                                            class="inline-flex items-center
                                                   rounded-full
                                                   bg-white px-4 py-2
                                                   text-xs font-bold
                                                   text-slate-700
                                                   ring-1
                                                   ring-slate-200"
                                        >
                                            Predikat {{ $rank }}
                                        </span>
                                    @endif
                                </div>


                                <h3
                                    class="mt-6 text-2xl
                                           font-semibold
                                           leading-tight
                                           tracking-[-0.02em]
                                           text-slate-900
                                           sm:text-3xl
                                           lg:text-4xl"
                                    style="
                                        font-family:
                                            'Space Grotesk',
                                            'Plus Jakarta Sans',
                                            sans-serif;
                                    "
                                >
                                    {{ $title !== ''
                                        ? $title
                                        : $typeLabel }}
                                </h3>


                                @if ($institution !== '')
                                    <div
                                        class="mt-4 flex
                                               items-start gap-3"
                                    >
                                        <span
                                            class="mt-1 flex h-8 w-8
                                                   shrink-0 items-center
                                                   justify-center
                                                   rounded-lg bg-blue-50
                                                   text-xs
                                                   text-[#075F9B]"
                                        >
                                            <i
                                                class="fa-solid
                                                       fa-building-columns"
                                                aria-hidden="true"
                                            ></i>
                                        </span>

                                        <p
                                            class="pt-1 text-sm
                                                   font-semibold
                                                   leading-6
                                                   text-[#075F9B]
                                                   sm:text-base"
                                        >
                                            {{ $institution }}
                                        </p>
                                    </div>
                                @endif


                                @if ($description !== '')
                                    <p
                                        class="mt-6 text-justify
                                               text-sm leading-7
                                               text-slate-600
                                               sm:text-base
                                               sm:leading-8"
                                    >
                                        {!! nl2br(
                                            e($description)
                                        ) !!}
                                    </p>
                                @endif


                                {{-- Metadata --}}
                                @if ($hasMetadata)
                                    <dl
                                        class="mt-7 grid gap-4
                                               sm:grid-cols-2"
                                    >
                                        @if ($rank !== '')
                                            <div
                                                class="border-l-2
                                                       border-[#075F9B]
                                                       pl-4"
                                            >
                                                <dt
                                                    class="text-[10px]
                                                           font-bold
                                                           uppercase
                                                           tracking-[0.16em]
                                                           text-slate-400"
                                                >
                                                    Predikat
                                                </dt>

                                                <dd
                                                    class="mt-1
                                                           text-lg font-bold
                                                           text-slate-900"
                                                >
                                                    {{ $rank }}
                                                </dd>
                                            </div>
                                        @endif


                                        @if ($masaBerlaku)
                                            <div
                                                class="border-l-2
                                                       border-[#D7B33E]
                                                       pl-4"
                                            >
                                                <dt
                                                    class="text-[10px]
                                                           font-bold
                                                           uppercase
                                                           tracking-[0.16em]
                                                           text-slate-400"
                                                >
                                                    Masa Berlaku
                                                </dt>

                                                <dd
                                                    class="mt-1 text-sm
                                                           font-bold
                                                           leading-6
                                                           text-slate-900"
                                                >
                                                    {{ $masaBerlaku }}
                                                </dd>
                                            </div>
                                        @endif


                                        @if ($certificateNumber !== '')
                                            <div
                                                class="border-l-2
                                                       border-slate-300
                                                       pl-4
                                                       sm:col-span-2"
                                            >
                                                <dt
                                                    class="text-[10px]
                                                           font-bold
                                                           uppercase
                                                           tracking-[0.16em]
                                                           text-slate-400"
                                                >
                                                    Nomor Sertifikat
                                                </dt>

                                                <dd
                                                    class="mt-1 break-words
                                                           text-sm font-bold
                                                           leading-6
                                                           text-slate-900"
                                                >
                                                    {{ $certificateNumber }}
                                                </dd>
                                            </div>
                                        @endif
                                    </dl>
                                @endif


                                @if ($fileUrl)
                                    <div class="mt-8">
                                        <a
                                            href="{{ $fileUrl }}"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="inline-flex
                                                   items-center
                                                   justify-center
                                                   gap-3 rounded-xl
                                                   bg-[#073763]
                                                   px-6 py-3.5
                                                   text-sm font-bold
                                                   text-white
                                                   transition duration-300
                                                   hover:-translate-y-0.5
                                                   hover:bg-[#075F9B]
                                                   hover:shadow-lg"
                                        >
                                            <i
                                                class="fa-solid
                                                       fa-arrow-up-right-from-square"
                                                aria-hidden="true"
                                            ></i>

                                            Buka Sertifikat
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>


            {{-- ================================================= --}}
            {{-- CATATAN --}}
            {{-- ================================================= --}}

            <div
                class="mt-9 flex items-start gap-4
                       border-t border-slate-200
                       pt-7"
                data-aos="fade-up"
            >



            </div>
        </div>
    </section>
@endif