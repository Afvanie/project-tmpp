@php
    /*
    |--------------------------------------------------------------------------
    | DATA HALAMAN
    |--------------------------------------------------------------------------
    */

    $currentSearch = trim(
        (string) ($search ?? request('search', ''))
    );

    $currentType = (string) (
        $type ?? request('type', 'all')
    );

    $totalAll = (int) ($totalAll ?? 0);
    $totalDosen = (int) ($totalDosen ?? 0);
    $totalStaff = (int) ($totalStaff ?? 0);

    $hasFilter = $currentSearch !== ''
        || $currentType !== 'all';
@endphp


<section
    id="lecturer-staff-list"
    class="relative overflow-hidden
           bg-gradient-to-br
           from-slate-50 via-white to-blue-50
           py-20 md:py-24"
>
    {{-- ========================================================= --}}
    {{-- BACKGROUND DECORATION --}}
    {{-- ========================================================= --}}

    <div
        class="pointer-events-none absolute inset-0"
        aria-hidden="true"
    >
        <div
            class="absolute -left-40 -top-40
                   h-[500px] w-[500px]
                   rounded-full bg-blue-200/30
                   blur-[140px]"
        ></div>

        <div
            class="absolute -right-40 bottom-0
                   h-[500px] w-[500px]
                   rounded-full bg-yellow-200/30
                   blur-[140px]"
        ></div>

        <div
            class="absolute inset-0 opacity-[0.03]"
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
            class="absolute -right-20 top-24
                   w-[360px] select-none
                   grayscale opacity-[0.035]
                   md:w-[520px]"
        >

        <div
            class="absolute bottom-10 left-6
                   select-none text-[70px]
                   font-black leading-none
                   text-blue-900/[0.025]
                   md:left-10 md:text-[130px]"
        >
            TMPP
        </div>
    </div>


    <div
        class="relative z-10 mx-auto
               max-w-7xl px-6"
    >
        {{-- ===================================================== --}}
        {{-- HEADING --}}
        {{-- ===================================================== --}}

        <div
            class="mx-auto mb-14 max-w-3xl text-center"
            data-aos="fade-up"
        >
            <span
                class="text-sm font-semibold uppercase
                       tracking-[5px] text-blue-700"
            >
                Tim Pengajar dan Kependidikan
            </span>

            <h2
                class="mt-4 text-3xl font-bold
                       leading-tight text-slate-800
                       sm:text-4xl md:text-5xl"
            >
                Dosen dan Staf Program Studi
            </h2>

            <div
                class="mx-auto mt-6 h-1 w-24
                       rounded-full bg-yellow-400"
            ></div>

            <p
                class="mt-6 leading-8 text-slate-600"
            >
                Tenaga pendidik dan tenaga kependidikan yang
                mendukung proses pembelajaran, pelayanan akademik,
                serta pengembangan Program Studi D-IV Teknik Mesin
                Produksi dan Perawatan.
            </p>
        </div>


        {{-- ===================================================== --}}
        {{-- STATISTIK --}}
        {{-- ===================================================== --}}

        <div
            class="mb-10 grid gap-6 md:grid-cols-3"
        >
            {{-- Total --}}
            <div
                class="rounded-3xl border
                       border-slate-100 bg-white/90
                       p-6 shadow-lg backdrop-blur
                       sm:p-7"
                data-aos="fade-up"
            >
                <p
                    class="text-sm font-semibold uppercase
                           tracking-[4px] text-slate-500"
                >
                    Total Data
                </p>

                <div
                    class="mt-4 flex items-end
                           justify-between gap-4"
                >
                    <div>
                        <h3
                            class="text-3xl font-bold
                                   text-slate-800"
                        >
                            Semua
                        </h3>

                        <p class="mt-2 text-slate-500">
                            Dosen dan staf yang terdata.
                        </p>
                    </div>

                    <span
                        class="text-5xl font-black
                               text-slate-100"
                    >
                        {{ $totalAll }}
                    </span>
                </div>
            </div>


            {{-- Dosen --}}
            <div
                class="rounded-3xl border
                       border-slate-100 bg-white/90
                       p-6 shadow-lg backdrop-blur
                       sm:p-7"
                data-aos="fade-up"
                data-aos-delay="100"
            >
                <p
                    class="text-sm font-semibold uppercase
                           tracking-[4px] text-blue-700"
                >
                    Tenaga Pendidik
                </p>

                <div
                    class="mt-4 flex items-end
                           justify-between gap-4"
                >
                    <div>
                        <h3
                            class="text-3xl font-bold
                                   text-slate-800"
                        >
                            Dosen
                        </h3>

                        <p class="mt-2 text-slate-500">
                            Pengajar dan pembimbing akademik.
                        </p>
                    </div>

                    <span
                        class="text-5xl font-black
                               text-blue-100"
                    >
                        {{ $totalDosen }}
                    </span>
                </div>
            </div>


            {{-- Staf --}}
            <div
                class="rounded-3xl border
                       border-slate-100 bg-white/90
                       p-6 shadow-lg backdrop-blur
                       sm:p-7"
                data-aos="fade-up"
                data-aos-delay="200"
            >
                <p
                    class="text-sm font-semibold uppercase
                           tracking-[4px] text-yellow-600"
                >
                    Tenaga Kependidikan
                </p>

                <div
                    class="mt-4 flex items-end
                           justify-between gap-4"
                >
                    <div>
                        <h3
                            class="text-3xl font-bold
                                   text-slate-800"
                        >
                            Staf
                        </h3>

                        <p class="mt-2 text-slate-500">
                            Pendukung pelayanan akademik.
                        </p>
                    </div>

                    <span
                        class="text-5xl font-black
                               text-yellow-100"
                    >
                        {{ $totalStaff }}
                    </span>
                </div>
            </div>
        </div>


        {{-- ===================================================== --}}
        {{-- SEARCH DAN FILTER --}}
        {{-- ===================================================== --}}

        <div
            class="mb-14 rounded-3xl
                   border border-slate-100
                   bg-white/90 p-5
                   shadow-lg backdrop-blur
                   md:p-6"
            data-aos="fade-up"
            data-aos-delay="150"
        >
            <form
                action="{{ route('lecturers') }}"
                method="GET"
            >
                <div
                    class="grid items-end gap-4
                           lg:grid-cols-12"
                >
                    {{-- Cari --}}
                    <div class="lg:col-span-6">
                        <label
                            for="lecturerSearch"
                            class="mb-2 block text-sm
                                   font-bold text-slate-700"
                        >
                            Cari Nama atau NIP
                        </label>

                        <input
                            type="search"
                            id="lecturerSearch"
                            name="search"
                            value="{{ $currentSearch }}"
                            maxlength="100"
                            autocomplete="off"
                            placeholder="Masukkan nama dosen atau staf..."
                            class="w-full rounded-2xl
                                   border border-slate-200
                                   bg-slate-50 px-5 py-4
                                   transition focus:bg-white
                                   focus:outline-none
                                   focus:ring-2
                                   focus:ring-blue-500"
                        >
                    </div>


                    {{-- Filter --}}
                    <div class="lg:col-span-3">
                        <label
                            for="lecturerType"
                            class="mb-2 block text-sm
                                   font-bold text-slate-700"
                        >
                            Filter Kategori
                        </label>

                        <select
                            id="lecturerType"
                            name="type"
                            class="w-full rounded-2xl
                                   border border-slate-200
                                   bg-slate-50 px-5 py-4
                                   transition focus:bg-white
                                   focus:outline-none
                                   focus:ring-2
                                   focus:ring-blue-500"
                        >
                            <option
                                value="all"
                                @selected($currentType === 'all')
                            >
                                Semua
                            </option>

                            <option
                                value="dosen"
                                @selected($currentType === 'dosen')
                            >
                                Dosen
                            </option>

                            <option
                                value="staff"
                                @selected($currentType === 'staff')
                            >
                                Staf
                            </option>
                        </select>
                    </div>


                    {{-- Tombol --}}
                    <div
                        class="flex gap-3 lg:col-span-3"
                    >
                        <button
                            type="submit"
                            class="inline-flex flex-1
                                   items-center justify-center
                                   rounded-2xl bg-blue-700
                                   px-5 py-4 font-bold
                                   text-white transition
                                   hover:bg-blue-800"
                        >
                            Cari
                        </button>

                        <a
                            href="{{ route('lecturers') }}"
                            class="inline-flex items-center
                                   justify-center rounded-2xl
                                   bg-slate-100 px-5 py-4
                                   font-bold text-slate-700
                                   transition hover:bg-slate-200"
                        >
                            Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>


        {{-- ===================================================== --}}
        {{-- JUDUL DAFTAR --}}
        {{-- ===================================================== --}}

        <div
            class="mb-8"
            data-aos="fade-up"
        >
            <span
                class="text-sm font-semibold uppercase
                       tracking-[4px] text-blue-700"
            >
                Daftar Personel
            </span>

            <h3
                class="mt-3 text-3xl font-bold
                       text-slate-800 md:text-4xl"
            >
                @if ($currentType === 'dosen')
                    Dosen Program Studi
                @elseif ($currentType === 'staff')
                    Staf Program Studi
                @else
                    Dosen dan Staf Program Studi
                @endif
            </h3>

            <div
                class="mt-5 h-1 w-20
                       rounded-full bg-yellow-400"
            ></div>

            @if ($currentSearch !== '')
                <p class="mt-4 text-slate-500">
                    Hasil pencarian untuk
                    <span class="font-bold text-slate-700">
                        “{{ $currentSearch }}”
                    </span>
                </p>
            @endif
        </div>


        {{-- ===================================================== --}}
        {{-- DAFTAR KARTU --}}
        {{-- ===================================================== --}}

        @if ($lecturerStaff->count() > 0)

            <div
                class="grid gap-7
                       sm:grid-cols-2
                       lg:grid-cols-3
                       xl:grid-cols-4"
            >
                @foreach ($lecturerStaff as $person)

                    @php
                        /*
                        |--------------------------------------------------------------------------
                        | INISIAL
                        |--------------------------------------------------------------------------
                        */

                        $personName = trim(
                            (string) $person->name
                        );

                        $nameParts = collect(
                            preg_split(
                                '/\s+/',
                                $personName
                            )
                        )
                            ->filter()
                            ->take(2);

                        $initials = $nameParts
                            ->map(function ($word) {
                                return mb_substr(
                                    (string) $word,
                                    0,
                                    1
                                );
                            })
                            ->implode('');

                        if ($initials === '') {
                            $initials = 'TM';
                        }

                        /*
                        |--------------------------------------------------------------------------
                        | JENIS
                        |--------------------------------------------------------------------------
                        */

                        $isDosen = $person->type
                            === \App\Models\LecturerStaff::TYPE_DOSEN;

                        $typeLabel = $person->type_label;

                        /*
                        |--------------------------------------------------------------------------
                        | FOTO
                        |--------------------------------------------------------------------------
                        */

                        $photoPath = trim(
                            (string) $person->photo
                        );

                        $photoExists = $photoPath !== ''
                            && \Illuminate\Support\Facades\Storage::disk(
                                'public'
                            )->exists($photoPath);

                        $photoUrl = $photoExists
                            ? asset('storage/' . $photoPath)
                            : null;

                        $nip = trim(
                            (string) $person->nip
                        );
                    @endphp

                    <article
                        class="group overflow-hidden
                               rounded-3xl border
                               border-slate-100 bg-white
                               shadow-lg transition-all
                               duration-500
                               hover:-translate-y-2
                               hover:shadow-2xl"
                        data-aos="fade-up"
                        data-aos-delay="{{ min(
                            ($loop->index % 4) * 70,
                            210
                        ) }}"
                    >
                        {{-- Foto --}}
                        <div
                            class="relative h-80
                                   overflow-hidden bg-slate-100"
                        >
                            @if ($photoUrl)

                                <img
                                    src="{{ $photoUrl }}"
                                    alt="Foto {{ $personName }}"
                                    class="h-full w-full
                                           object-cover
                                           object-top
                                           transition duration-700
                                           group-hover:scale-105"
                                    loading="lazy"
                                >

                            @else

                                <div
                                    @class([
                                        'flex h-full w-full flex-col',
                                        'items-center justify-center',
                                        'bg-gradient-to-br',
                                        'from-blue-700 via-blue-800 to-slate-900' =>
                                            $isDosen,
                                        'from-yellow-400 via-yellow-500 to-blue-800' =>
                                            !$isDosen,
                                    ])
                                >
                                    <div
                                        class="flex h-28 w-28
                                               items-center justify-center
                                               rounded-full border
                                               border-white/25
                                               bg-white/15
                                               shadow-2xl backdrop-blur"
                                    >
                                        <span
                                            class="text-5xl font-black
                                                   uppercase tracking-wider
                                                   text-white"
                                        >
                                            {{ $initials }}
                                        </span>
                                    </div>

                                    <div
                                        class="mt-5 rounded-full
                                               border border-white/15
                                               bg-white/10
                                               px-5 py-2
                                               backdrop-blur"
                                    >
                                        <p
                                            class="text-sm font-semibold
                                                   text-white/85"
                                        >
                                            D-IV TMPP
                                        </p>
                                    </div>
                                </div>

                            @endif


                            {{-- Overlay --}}
                            <div
                                class="absolute inset-0
                                       bg-gradient-to-t
                                       from-slate-950/85
                                       via-slate-950/10
                                       to-transparent"
                            ></div>


                            {{-- Jenis --}}
                            <div
                                class="absolute left-4 top-4"
                            >
                                <span
                                    @class([
                                        'inline-flex rounded-full',
                                        'px-4 py-2 text-sm',
                                        'font-semibold shadow-lg',
                                        'bg-blue-700 text-white' =>
                                            $isDosen,
                                        'bg-yellow-400 text-slate-900' =>
                                            !$isDosen,
                                    ])
                                >
                                    {{ $typeLabel }}
                                </span>
                            </div>


                            {{-- Nama --}}
                            <div
                                class="absolute bottom-5
                                       left-5 right-5"
                            >
                                <h3
                                    class="text-xl font-bold
                                           leading-snug text-white"
                                >
                                    {{ $personName }}
                                </h3>
                            </div>
                        </div>


                        {{-- Informasi --}}
                        <div class="p-6">

                            <p class="text-sm text-slate-500">
                                {{ $isDosen
                                    ? 'Tenaga Pendidik'
                                    : 'Tenaga Kependidikan' }}
                            </p>

                            @if ($nip !== '')
                                <p
                                    class="mt-3 break-words
                                           text-sm font-semibold
                                           text-blue-700"
                                >
                                    NIP {{ $nip }}
                                </p>
                            @endif

                            <p
                                class="mt-3 font-semibold
                                       leading-7 text-slate-800"
                            >
                                Program Studi D-IV Teknik Mesin
                                Produksi dan Perawatan
                            </p>
                        </div>
                    </article>

                @endforeach
            </div>


            {{-- ================================================= --}}
            {{-- PAGINATION --}}
            {{-- ================================================= --}}

            @if ($lecturerStaff->hasPages())
                <div class="mt-12">
                    {{ $lecturerStaff->links() }}
                </div>
            @endif

        @else

            {{-- ================================================= --}}
            {{-- EMPTY STATE --}}
            {{-- ================================================= --}}

            <div
                class="rounded-3xl border
                       border-slate-100 bg-white/90
                       p-8 text-center shadow-lg
                       backdrop-blur sm:p-10"
                data-aos="fade-up"
            >
                <div
                    class="mx-auto flex h-16 w-16
                           items-center justify-center
                           rounded-2xl bg-blue-50
                           text-blue-700"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-8 w-8"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        aria-hidden="true"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m4-4a4 4 0 100-8 4 4 0 000 8zm6 2a3 3 0 100-6"
                        />
                    </svg>
                </div>

                <h4
                    class="mt-5 text-2xl font-bold
                           text-slate-800"
                >
                    @if ($hasFilter)
                        Data Tidak Ditemukan
                    @else
                        Data Dosen dan Staf Belum Tersedia
                    @endif
                </h4>

                <p
                    class="mx-auto mt-3 max-w-xl
                           leading-7 text-slate-500"
                >
                    @if ($hasFilter)
                        Tidak ada data yang cocok dengan kata kunci
                        atau kategori yang dipilih.
                    @else
                        Data dosen dan staf belum ditambahkan oleh
                        pengelola melalui halaman admin.
                    @endif
                </p>

                @if ($hasFilter)
                    <a
                        href="{{ route('lecturers') }}"
                        class="mt-6 inline-flex items-center
                               justify-center rounded-xl
                               bg-blue-700 px-6 py-3
                               font-semibold text-white
                               transition hover:bg-blue-800"
                    >
                        Tampilkan Semua
                    </a>
                @endif
            </div>

        @endif
    </div>
</section>