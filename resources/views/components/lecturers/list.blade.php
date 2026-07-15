@php
    /*
    |--------------------------------------------------------------------------
    | STATUS FILTER
    |--------------------------------------------------------------------------
    */

    $selectedType = request(
        'type',
        'all'
    );

    $searchKeyword = trim(
        (string) request(
            'search',
            ''
        )
    );

    $hasActiveFilter = $searchKeyword !== ''
        || $selectedType !== 'all';

    /*
    |--------------------------------------------------------------------------
    | JUDUL HASIL
    |--------------------------------------------------------------------------
    */

    $listTitle = match ($selectedType) {
        'dosen' => 'Dosen Program Studi',
        'staff' => 'Staf Program Studi',
        default => 'Dosen & Staf Program Studi',
    };
@endphp


<section
    id="lecturer-staff-list"
    class="relative overflow-hidden
           bg-[#F6F8FB] py-16
           md:py-20 lg:py-24"
>
    {{-- ========================================================= --}}
    {{-- DEKORASI LATAR --}}
    {{-- ========================================================= --}}

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
                   bg-yellow-100/40
                   blur-[145px]"
        ></div>
    </div>


    <div
        class="relative mx-auto
               max-w-7xl px-6"
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
                        class="text-[11px] font-bold
                               uppercase
                               tracking-[0.22em]
                               text-[#075F9B]"
                    >
                        Tim Akademik Program Studi
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
                    Dosen &amp; Staf
                </h2>


                <p
                    class="mt-5 max-w-3xl
                           text-base leading-8
                           text-slate-600
                           sm:text-lg"
                >
                    Tenaga pendidik dan tenaga kependidikan
                    yang mendukung pembelajaran, pelayanan
                    akademik, serta pengembangan Program Studi
                    D-IV Teknik Mesin Produksi dan Perawatan.
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


            <div
                class="lg:col-span-4
                       lg:flex
                       lg:justify-end"
            >
                <div
                    class="flex items-center gap-4
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
                            (string) ($totalAll ?? 0),
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
                            Total Personel
                        </p>

                        <p
                            class="mt-1 text-sm
                                   leading-6
                                   text-slate-600"
                        >
                            Dosen dan staf aktif
                        </p>
                    </div>
                </div>
            </div>
        </header>


        {{-- ===================================================== --}}
        {{-- RINGKASAN DATA --}}
        {{-- ===================================================== --}}

        <div
            class="mt-12 grid gap-4
                   sm:grid-cols-3"
            data-aos="fade-up"
        >
            {{-- Semua --}}
            <a
                href="{{ route('lecturers') }}"
                class="group flex items-center
                       justify-between gap-4
                       rounded-2xl border
                       bg-white px-5 py-5
                       shadow-sm transition
                       hover:-translate-y-0.5
                       hover:shadow-md
                       {{ $selectedType === 'all'
                            ? 'border-[#075F9B] ring-1 ring-[#075F9B]/10'
                            : 'border-slate-200 hover:border-blue-200' }}"
            >
                <div>
                    <p
                        class="text-[10px] font-bold
                               uppercase
                               tracking-[0.17em]
                               text-slate-400"
                    >
                        Semua Personel
                    </p>

                    <p
                        class="mt-1 text-sm
                               font-bold text-slate-800"
                    >
                        Dosen &amp; Staf
                    </p>
                </div>

                <span
                    class="text-3xl font-bold
                           tracking-tight
                           text-[#075F9B]"
                >
                    {{ $totalAll ?? 0 }}
                </span>
            </a>


            {{-- Dosen --}}
            <a
                href="{{ route('lecturers', ['type' => 'dosen']) }}"
                class="group flex items-center
                       justify-between gap-4
                       rounded-2xl border
                       bg-white px-5 py-5
                       shadow-sm transition
                       hover:-translate-y-0.5
                       hover:shadow-md
                       {{ $selectedType === 'dosen'
                            ? 'border-[#075F9B] ring-1 ring-[#075F9B]/10'
                            : 'border-slate-200 hover:border-blue-200' }}"
            >
                <div>
                    <p
                        class="text-[10px] font-bold
                               uppercase
                               tracking-[0.17em]
                               text-[#075F9B]"
                    >
                        Tenaga Pendidik
                    </p>

                    <p
                        class="mt-1 text-sm
                               font-bold text-slate-800"
                    >
                        Dosen
                    </p>
                </div>

                <span
                    class="text-3xl font-bold
                           tracking-tight
                           text-[#075F9B]"
                >
                    {{ $totalDosen ?? 0 }}
                </span>
            </a>


            {{-- Staf --}}
            <a
                href="{{ route('lecturers', ['type' => 'staff']) }}"
                class="group flex items-center
                       justify-between gap-4
                       rounded-2xl border
                       bg-white px-5 py-5
                       shadow-sm transition
                       hover:-translate-y-0.5
                       hover:shadow-md
                       {{ $selectedType === 'staff'
                            ? 'border-[#D7B33E] ring-1 ring-[#D7B33E]/15'
                            : 'border-slate-200 hover:border-yellow-200' }}"
            >
                <div>
                    <p
                        class="text-[10px] font-bold
                               uppercase
                               tracking-[0.17em]
                               text-yellow-700"
                    >
                        Tenaga Kependidikan
                    </p>

                    <p
                        class="mt-1 text-sm
                               font-bold text-slate-800"
                    >
                        Staf
                    </p>
                </div>

                <span
                    class="text-3xl font-bold
                           tracking-tight
                           text-yellow-700"
                >
                    {{ $totalStaff ?? 0 }}
                </span>
            </a>
        </div>


        {{-- ===================================================== --}}
        {{-- PENCARIAN DAN FILTER --}}
        {{-- ===================================================== --}}

        <div
            class="mt-7 rounded-2xl
                   border border-slate-200
                   bg-white p-4
                   shadow-sm
                   sm:p-5"
            data-aos="fade-up"
            data-aos-delay="100"
        >
            <form
                action="{{ route('lecturers') }}"
                method="GET"
            >
                <div
                    class="grid items-end gap-4
                           lg:grid-cols-12"
                >
                    {{-- Pencarian --}}
                    <div class="lg:col-span-6">
                        <label
                            for="lecturerSearch"
                            class="mb-2 block
                                   text-xs font-bold
                                   uppercase
                                   tracking-[0.12em]
                                   text-slate-500"
                        >
                            Cari Personel
                        </label>

                        <div class="relative">
                            <span
                                class="pointer-events-none
                                       absolute inset-y-0
                                       left-0 flex
                                       items-center pl-4
                                       text-slate-400"
                            >
                                <i
                                    class="fa-solid
                                           fa-magnifying-glass"
                                    aria-hidden="true"
                                ></i>
                            </span>

                            <input
                                id="lecturerSearch"
                                type="search"
                                name="search"
                                value="{{ $searchKeyword }}"
                                placeholder="Masukkan nama dosen atau staf"
                                class="w-full rounded-xl
                                       border border-slate-200
                                       bg-slate-50
                                       py-3.5 pl-11 pr-4
                                       text-sm text-slate-800
                                       outline-none
                                       transition
                                       placeholder:text-slate-400
                                       focus:border-[#075F9B]
                                       focus:bg-white
                                       focus:ring-4
                                       focus:ring-blue-100"
                            >
                        </div>
                    </div>


                    {{-- Filter --}}
                    <div class="lg:col-span-3">
                        <label
                            for="lecturerType"
                            class="mb-2 block
                                   text-xs font-bold
                                   uppercase
                                   tracking-[0.12em]
                                   text-slate-500"
                        >
                            Kategori
                        </label>

                        <div class="relative">
                            <select
                                id="lecturerType"
                                name="type"
                                class="w-full appearance-none
                                       rounded-xl border
                                       border-slate-200
                                       bg-slate-50
                                       px-4 py-3.5
                                       pr-10 text-sm
                                       font-semibold
                                       text-slate-700
                                       outline-none
                                       transition
                                       focus:border-[#075F9B]
                                       focus:bg-white
                                       focus:ring-4
                                       focus:ring-blue-100"
                            >
                                <option
                                    value="all"
                                    {{ $selectedType === 'all'
                                        ? 'selected'
                                        : '' }}
                                >
                                    Semua Personel
                                </option>

                                <option
                                    value="dosen"
                                    {{ $selectedType === 'dosen'
                                        ? 'selected'
                                        : '' }}
                                >
                                    Dosen
                                </option>

                                <option
                                    value="staff"
                                    {{ $selectedType === 'staff'
                                        ? 'selected'
                                        : '' }}
                                >
                                    Staf
                                </option>
                            </select>

                            <span
                                class="pointer-events-none
                                       absolute inset-y-0
                                       right-0 flex
                                       items-center pr-4
                                       text-xs text-slate-400"
                            >
                                <i
                                    class="fa-solid
                                           fa-chevron-down"
                                    aria-hidden="true"
                                ></i>
                            </span>
                        </div>
                    </div>


                    {{-- Tombol --}}
                    <div
                        class="flex gap-3
                               lg:col-span-3"
                    >
                        <button
                            type="submit"
                            class="inline-flex min-h-12
                                   flex-1 items-center
                                   justify-center gap-2
                                   rounded-xl
                                   bg-[#073763]
                                   px-5 py-3
                                   text-sm font-bold
                                   text-white
                                   transition
                                   hover:bg-[#075F9B]
                                   hover:shadow-md"
                        >
                            <i
                                class="fa-solid
                                       fa-magnifying-glass"
                                aria-hidden="true"
                            ></i>

                            Cari
                        </button>

                        @if ($hasActiveFilter)
                            <a
                                href="{{ route('lecturers') }}"
                                class="inline-flex min-h-12
                                       items-center
                                       justify-center
                                       rounded-xl
                                       border border-slate-200
                                       bg-slate-50
                                       px-4 py-3
                                       text-sm font-bold
                                       text-slate-600
                                       transition
                                       hover:border-slate-300
                                       hover:bg-slate-100"
                                aria-label="Reset pencarian"
                                title="Reset"
                            >
                                <i
                                    class="fa-solid
                                           fa-rotate-left"
                                    aria-hidden="true"
                                ></i>
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>


        {{-- ===================================================== --}}
        {{-- JUDUL DAFTAR --}}
        {{-- ===================================================== --}}

        <div
            class="mt-14 flex flex-col
                   gap-4 border-b
                   border-slate-200 pb-6
                   sm:flex-row
                   sm:items-end
                   sm:justify-between"
            data-aos="fade-up"
        >
            <div>
                <p
                    class="text-[11px] font-bold
                           uppercase
                           tracking-[0.2em]
                           text-[#075F9B]"
                >
                    Daftar Personel
                </p>

                <h3
                    class="mt-2 text-2xl
                           font-semibold
                           tracking-tight
                           text-slate-900
                           sm:text-3xl"
                >
                    {{ $listTitle }}
                </h3>
            </div>

            <p
                class="text-sm font-medium
                       text-slate-500"
            >
                Menampilkan
                <span class="font-bold text-slate-800">
                    {{ $lecturerStaff->count() }}
                </span>
                data pada halaman ini
            </p>
        </div>


        {{-- ===================================================== --}}
        {{-- DAFTAR KARTU --}}
        {{-- ===================================================== --}}

        @if ($lecturerStaff->count() > 0)
            <div
                class="mt-8 grid gap-6
                       sm:grid-cols-2
                       lg:grid-cols-3
                       xl:grid-cols-4"
            >
                @foreach ($lecturerStaff as $person)
                    @php
                        $nameParts = collect(
                            preg_split(
                                '/\s+/',
                                trim(
                                    (string) $person->name
                                )
                            )
                        )
                            ->filter()
                            ->take(2);

                        $initials = $nameParts
                            ->map(function ($word) {
                                return mb_substr(
                                    $word,
                                    0,
                                    1
                                );
                            })
                            ->implode('');

                        if ($initials === '') {
                            $initials = 'TM';
                        }

                        $isDosen =
                            $person->type === 'dosen';

                        $personType = $isDosen
                            ? 'Dosen'
                            : 'Staf';

                        $personRole = $isDosen
                            ? 'Tenaga Pendidik'
                            : 'Tenaga Kependidikan';

                        $nip = trim(
                            (string) (
                                $person->nip
                                ?? ''
                            )
                        );

                        $hasPhoto = trim(
                            (string) (
                                $person->photo
                                ?? ''
                            )
                        ) !== '';
                    @endphp


                    <article
                        class="group relative
                               overflow-hidden
                               rounded-[1.5rem]
                               border border-slate-200
                               bg-white
                               shadow-[0_12px_35px_rgba(15,23,42,0.06)]
                               transition duration-300
                               hover:-translate-y-1
                               hover:border-blue-200
                               hover:shadow-[0_22px_50px_rgba(15,23,42,0.12)]"
                        data-aos="fade-up"
                        data-aos-delay="{{ min(
                            ($loop->index % 4) * 70,
                            210
                        ) }}"
                    >
                        {{-- Foto --}}
                        <div
                            class="relative aspect-[4/5]
                                   overflow-hidden
                                   bg-slate-100"
                        >
                            @if ($hasPhoto)
                                <img
                                    src="{{ asset(
                                        'storage/'
                                        . ltrim(
                                            $person->photo,
                                            '/'
                                        )
                                    ) }}"
                                    alt="{{ $person->name }}"
                                    class="h-full w-full
                                           object-cover object-top
                                           transition duration-700
                                           group-hover:scale-105"
                                    loading="lazy"
                                >
                            @else
                                <div
                                    class="flex h-full w-full
                                           flex-col items-center
                                           justify-center
                                           {{ $isDosen
                                                ? 'bg-gradient-to-br from-[#075F9B] via-[#073763] to-[#02182C]'
                                                : 'bg-gradient-to-br from-[#D7B33E] via-[#B68D19] to-[#073763]' }}"
                                >
                                    <span
                                        class="flex h-24 w-24
                                               items-center
                                               justify-center
                                               rounded-full
                                               border border-white/20
                                               bg-white/10
                                               text-4xl font-bold
                                               tracking-wide
                                               text-white
                                               shadow-xl
                                               backdrop-blur-sm"
                                    >
                                        {{ mb_strtoupper(
                                            $initials
                                        ) }}
                                    </span>

                                    <p
                                        class="mt-5 text-xs
                                               font-bold uppercase
                                               tracking-[0.18em]
                                               text-white/65"
                                    >
                                        D-IV TMPP
                                    </p>
                                </div>
                            @endif


                            {{-- Overlay --}}
                            <div
                                class="absolute inset-0
                                       bg-gradient-to-t
                                       from-[#02182C]/90
                                       via-[#02182C]/10
                                       to-transparent"
                                aria-hidden="true"
                            ></div>


                            {{-- Label kategori --}}
                            <span
                                class="absolute left-4 top-4
                                       inline-flex items-center
                                       gap-2 rounded-full
                                       px-3 py-2
                                       text-[10px] font-bold
                                       uppercase
                                       tracking-[0.13em]
                                       shadow-md
                                       backdrop-blur-sm
                                       {{ $isDosen
                                            ? 'bg-[#075F9B]/90 text-white'
                                            : 'bg-[#E2BD45]/95 text-[#031D36]' }}"
                            >
                                <span
                                    class="h-1.5 w-1.5
                                           rounded-full
                                           {{ $isDosen
                                                ? 'bg-[#F2D56F]'
                                                : 'bg-[#073763]' }}"
                                    aria-hidden="true"
                                ></span>

                                {{ $personType }}
                            </span>


                            {{-- Nama --}}
                            <div
                                class="absolute inset-x-0
                                       bottom-0 p-5"
                            >
                                <h4
                                    class="text-lg font-bold
                                           leading-7 text-white"
                                >
                                    {{ $person->name }}
                                </h4>

                                <p
                                    class="mt-1 text-xs
                                           font-medium
                                           text-white/65"
                                >
                                    {{ $personRole }}
                                </p>
                            </div>
                        </div>


                        {{-- Informasi --}}
                        <div class="p-5">
                            @if ($nip !== '')
                                <div
                                    class="flex items-start gap-3"
                                >
                                    <span
                                        class="mt-0.5 flex h-8 w-8
                                               shrink-0 items-center
                                               justify-center
                                               rounded-lg
                                               bg-blue-50
                                               text-xs
                                               text-[#075F9B]"
                                    >
                                        <i
                                            class="fa-solid
                                                   fa-id-card"
                                            aria-hidden="true"
                                        ></i>
                                    </span>

                                    <div class="min-w-0">
                                        <p
                                            class="text-[9px]
                                                   font-bold uppercase
                                                   tracking-[0.15em]
                                                   text-slate-400"
                                        >
                                            NIP
                                        </p>

                                        <p
                                            class="mt-1 break-words
                                                   text-xs font-semibold
                                                   leading-5
                                                   text-slate-700"
                                        >
                                            {{ $nip }}
                                        </p>
                                    </div>
                                </div>
                            @else
                                <div
                                    class="flex items-center gap-3"
                                >
                                    <span
                                        class="flex h-8 w-8
                                               items-center
                                               justify-center
                                               rounded-lg
                                               bg-blue-50
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
                                        class="text-xs
                                               font-semibold
                                               leading-5
                                               text-slate-600"
                                    >
                                        Program Studi D-IV TMPP
                                    </p>
                                </div>
                            @endif


                            <div
                                class="mt-5 flex items-center
                                       justify-between
                                       border-t
                                       border-slate-100 pt-4"
                            >
                                <p
                                    class="text-[9px] font-bold
                                           uppercase
                                           tracking-[0.14em]
                                           text-slate-400"
                                >
                                    Politeknik Negeri Malang
                                </p>

                                <span
                                    class="h-2 w-2
                                           rounded-full
                                           {{ $isDosen
                                                ? 'bg-[#075F9B]'
                                                : 'bg-[#D7B33E]' }}"
                                    aria-hidden="true"
                                ></span>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>


            {{-- ================================================= --}}
            {{-- PAGINATION --}}
            {{-- ================================================= --}}

            @if ($lecturerStaff->hasPages())
                <div
                    class="mt-12 border-t
                           border-slate-200 pt-8"
                >
                    {{ $lecturerStaff->withQueryString()->links() }}
                </div>
            @endif
        @else
            {{-- ================================================= --}}
            {{-- DATA KOSONG --}}
            {{-- ================================================= --}}

            <div
                class="mt-8 rounded-[1.75rem]
                       border border-dashed
                       border-slate-300
                       bg-white px-6 py-14
                       text-center"
                data-aos="fade-up"
            >
                <span
                    class="mx-auto flex h-16 w-16
                           items-center
                           justify-center
                           rounded-2xl
                           bg-blue-50
                           text-xl
                           text-[#075F9B]"
                >
                    <i
                        class="fa-solid
                               fa-user-group"
                        aria-hidden="true"
                    ></i>
                </span>

                <h4
                    class="mt-5 text-xl
                           font-bold text-slate-900"
                >
                    Data tidak ditemukan
                </h4>

                <p
                    class="mx-auto mt-2
                           max-w-md text-sm
                           leading-7
                           text-slate-500"
                >
                    Belum ada personel yang sesuai dengan
                    kata kunci atau kategori yang dipilih.
                </p>

                @if ($hasActiveFilter)
                    <a
                        href="{{ route('lecturers') }}"
                        class="mt-6 inline-flex
                               items-center
                               justify-center gap-2
                               rounded-xl
                               bg-[#073763]
                               px-5 py-3
                               text-sm font-bold
                               text-white
                               transition
                               hover:bg-[#075F9B]"
                    >
                        <i
                            class="fa-solid
                                   fa-rotate-left"
                            aria-hidden="true"
                        ></i>

                        Tampilkan Semua
                    </a>
                @endif
            </div>
        @endif
    </div>
</section>