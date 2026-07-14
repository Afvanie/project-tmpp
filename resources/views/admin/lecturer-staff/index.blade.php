@extends('layouts.admin')

@section('title', 'Data Dosen dan Staf')

@section('content')

@php
    /*
    |--------------------------------------------------------------------------
    | DATA FILTER
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

    /*
    |--------------------------------------------------------------------------
    | INFORMASI PERSONEL
    |--------------------------------------------------------------------------
    */

    $getPersonMeta = function ($person): array {
        $name = trim((string) $person->name);
        $nip = trim((string) $person->nip);
        $photoPath = trim((string) $person->photo);

        $photoExists = $photoPath !== ''
            && \Illuminate\Support\Facades\Storage::disk('public')
                ->exists($photoPath);

        $photoUrl = $photoExists
            ? asset('storage/' . $photoPath)
            : null;

        $initial = $name !== ''
            ? mb_strtoupper(
                mb_substr($name, 0, 1)
            )
            : 'T';

        $isDosen = $person->type
            === \App\Models\LecturerStaff::TYPE_DOSEN;

        return [
            'name' => $name,
            'nip' => $nip,
            'photo_path' => $photoPath,
            'photo_exists' => $photoExists,
            'photo_url' => $photoUrl,
            'initial' => $initial,
            'is_dosen' => $isDosen,
            'type_label' => $person->type_label,
        ];
    };
@endphp


<div class="space-y-8">

    {{-- ========================================================= --}}
    {{-- HEADER --}}
    {{-- ========================================================= --}}

    <div
        class="flex flex-col gap-5
               lg:flex-row lg:items-center
               lg:justify-between"
    >
        <div>
            <h1
                class="text-3xl font-black
                       text-slate-800 md:text-4xl"
            >
                Data Dosen dan Staf
            </h1>

            <p
                class="mt-3 max-w-4xl
                       leading-7 text-slate-500"
            >
                Kelola data dosen dan tenaga kependidikan Program
                Studi D-IV Teknik Mesin Produksi dan Perawatan
                Politeknik Negeri Malang.
            </p>
        </div>

        <a
            href="{{ route('admin.lecturer-staff.create') }}"
            class="inline-flex items-center
                   justify-center gap-3 rounded-2xl
                   bg-blue-700 px-6 py-4
                   font-bold text-white shadow-lg
                   shadow-blue-700/20 transition
                   hover:bg-blue-800"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                aria-hidden="true"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 4v16m8-8H4"
                />
            </svg>

            Tambah Data
        </a>
    </div>


    {{-- ========================================================= --}}
    {{-- IMPORT DATA --}}
    {{-- ========================================================= --}}

    <section
        class="rounded-3xl border
               border-slate-100 bg-white
               p-5 shadow-sm sm:p-6"
    >
        <div
            class="flex flex-col gap-5
                   lg:flex-row lg:items-center
                   lg:justify-between"
        >
            <div>
                <h2
                    class="text-xl font-black
                           text-slate-800"
                >
                    Import Data Dosen dan Staf
                </h2>

                <p
                    class="mt-2 max-w-3xl
                           text-sm leading-6
                           text-slate-500"
                >
                    Gunakan template yang tersedia agar format data
                    sesuai sistem. Kolom yang diproses adalah nama
                    dan NIP.
                </p>
            </div>

            <a
                href="{{ route('admin.lecturer-staff.template') }}"
                class="inline-flex items-center
                       justify-center rounded-2xl
                       bg-slate-100 px-5 py-3
                       font-bold text-slate-700
                       transition hover:bg-slate-200"
            >
                Unduh Template
            </a>
        </div>


        <div class="mt-6 grid gap-5 md:grid-cols-2">

            {{-- Import Dosen --}}
            <form
                action="{{ route(
                    'admin.lecturer-staff.import',
                    \App\Models\LecturerStaff::TYPE_DOSEN
                ) }}"
                method="POST"
                enctype="multipart/form-data"
                class="rounded-2xl border
                       border-blue-100 bg-blue-50
                       p-5"
            >
                @csrf

                <h3
                    class="text-lg font-black
                           text-blue-700"
                >
                    Import Dosen
                </h3>

                <p
                    class="mt-1 text-sm
                           leading-6 text-slate-500"
                >
                    Pilih file Excel atau CSV yang berisi data dosen.
                </p>

                <label
                    for="dosenImportFile"
                    class="sr-only"
                >
                    Pilih file data dosen
                </label>

                <input
                    type="file"
                    id="dosenImportFile"
                    name="file"
                    accept=".xlsx,.xls,.csv,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel,text/csv"
                    required
                    class="mt-4 block w-full
                           rounded-2xl border
                           border-blue-100 bg-white
                           p-3 text-sm text-slate-600"
                >

                <button
                    type="submit"
                    class="mt-4 w-full rounded-2xl
                           bg-blue-700 px-5 py-3
                           font-bold text-white
                           transition hover:bg-blue-800"
                >
                    Import Dosen
                </button>
            </form>


            {{-- Import Staf --}}
            <form
                action="{{ route(
                    'admin.lecturer-staff.import',
                    \App\Models\LecturerStaff::TYPE_STAFF
                ) }}"
                method="POST"
                enctype="multipart/form-data"
                class="rounded-2xl border
                       border-yellow-100 bg-yellow-50
                       p-5"
            >
                @csrf

                <h3
                    class="text-lg font-black
                           text-yellow-700"
                >
                    Import Staf
                </h3>

                <p
                    class="mt-1 text-sm
                           leading-6 text-slate-500"
                >
                    Pilih file Excel atau CSV yang berisi data staf.
                </p>

                <label
                    for="staffImportFile"
                    class="sr-only"
                >
                    Pilih file data staf
                </label>

                <input
                    type="file"
                    id="staffImportFile"
                    name="file"
                    accept=".xlsx,.xls,.csv,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel,text/csv"
                    required
                    class="mt-4 block w-full
                           rounded-2xl border
                           border-yellow-100 bg-white
                           p-3 text-sm text-slate-600"
                >

                <button
                    type="submit"
                    class="mt-4 w-full rounded-2xl
                           bg-yellow-500 px-5 py-3
                           font-bold text-slate-900
                           transition hover:bg-yellow-600"
                >
                    Import Staf
                </button>
            </form>

        </div>
    </section>


    {{-- ========================================================= --}}
    {{-- ALERT --}}
    {{-- ========================================================= --}}

    @if (session('success'))
        <div
            class="rounded-2xl border
                   border-green-200 bg-green-50
                   px-6 py-4 font-semibold
                   text-green-700"
            role="alert"
        >
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div
            class="rounded-2xl border
                   border-red-200 bg-red-50
                   px-6 py-4 font-semibold
                   text-red-700"
            role="alert"
        >
            {{ session('error') }}
        </div>
    @endif

    @if (session('warning'))
        <div
            class="rounded-2xl border
                   border-yellow-200 bg-yellow-50
                   px-6 py-4 font-semibold
                   text-yellow-700"
            role="alert"
        >
            {{ session('warning') }}
        </div>
    @endif

    @if ($errors->any())
        <div
            class="rounded-2xl border
                   border-red-200 bg-red-50
                   px-6 py-4 text-red-700"
            role="alert"
        >
            <p class="font-bold">
                Terdapat data yang perlu diperbaiki.
            </p>

            <ul class="mt-3 list-disc space-y-1 pl-5 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {{-- ========================================================= --}}
    {{-- STATISTIK --}}
    {{-- ========================================================= --}}

    <div class="grid gap-6 md:grid-cols-3">

        {{-- Total --}}
        <div
            class="rounded-[2rem] border
                   border-slate-100 bg-white/95
                   p-6 shadow-xl backdrop-blur"
        >
            <div
                class="flex items-center
                       justify-between gap-4"
            >
                <div>
                    <p
                        class="text-sm font-bold
                               text-slate-500"
                    >
                        Total Data
                    </p>

                    <h2
                        class="mt-3 text-4xl font-black
                               text-slate-800"
                    >
                        {{ $totalAll }}
                    </h2>
                </div>

                <div
                    class="flex h-14 w-14
                           items-center justify-center
                           rounded-2xl bg-blue-700
                           text-white shadow-lg"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-7 w-7"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        aria-hidden="true"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M17 20h5v-2a4 4 0 00-5-3.87M9 20H4v-2a4 4 0 015-3.87M12 12a4 4 0 100-8 4 4 0 000 8z"
                        />
                    </svg>
                </div>
            </div>
        </div>


        {{-- Dosen --}}
        <div
            class="rounded-[2rem] border
                   border-slate-100 bg-white/95
                   p-6 shadow-xl backdrop-blur"
        >
            <div
                class="flex items-center
                       justify-between gap-4"
            >
                <div>
                    <p
                        class="text-sm font-bold
                               text-slate-500"
                    >
                        Total Dosen
                    </p>

                    <h2
                        class="mt-3 text-4xl font-black
                               text-slate-800"
                    >
                        {{ $totalDosen }}
                    </h2>
                </div>

                <div
                    class="flex h-14 w-14
                           items-center justify-center
                           rounded-2xl bg-yellow-400
                           text-slate-900 shadow-lg"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-7 w-7"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        aria-hidden="true"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 14l9-5-9-5-9 5 9 5z"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 14l6.16-3.422A12.083 12.083 0 0112 21.5a12.083 12.083 0 01-6.16-10.922L12 14z"
                        />
                    </svg>
                </div>
            </div>
        </div>


        {{-- Staf --}}
        <div
            class="rounded-[2rem] border
                   border-slate-100 bg-white/95
                   p-6 shadow-xl backdrop-blur"
        >
            <div
                class="flex items-center
                       justify-between gap-4"
            >
                <div>
                    <p
                        class="text-sm font-bold
                               text-slate-500"
                    >
                        Total Staf
                    </p>

                    <h2
                        class="mt-3 text-4xl font-black
                               text-slate-800"
                    >
                        {{ $totalStaff }}
                    </h2>
                </div>

                <div
                    class="flex h-14 w-14
                           items-center justify-center
                           rounded-2xl bg-blue-700
                           text-white shadow-lg"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-7 w-7"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        aria-hidden="true"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M5.121 17.804A4 4 0 017.95 16.6h8.1a4 4 0 012.829 1.204M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                        />
                    </svg>
                </div>
            </div>
        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- MAIN CARD --}}
    {{-- ========================================================= --}}

    <div
        class="overflow-hidden rounded-[2rem]
               border border-slate-100
               bg-white/95 shadow-xl
               backdrop-blur"
    >
        <div
            class="h-2 bg-gradient-to-r
                   from-blue-700 via-yellow-400
                   to-blue-700"
        ></div>


        {{-- ===================================================== --}}
        {{-- TOOLBAR --}}
        {{-- ===================================================== --}}

        <div
            class="border-b border-slate-100
                   p-6 md:p-8"
        >
            <div class="flex flex-col gap-6">

                <div>
                    <h2
                        class="text-2xl font-black
                               text-slate-800"
                    >
                        Daftar Dosen dan Staf
                    </h2>

                    <p class="mt-2 text-slate-500">
                        Semua data yang tersimpan akan ditampilkan
                        pada halaman publik Dosen dan Staf.
                    </p>
                </div>


                <form
                    action="{{ route(
                        'admin.lecturer-staff.index'
                    ) }}"
                    method="GET"
                >
                    <div
                        class="grid items-end gap-4
                               lg:grid-cols-12"
                    >
                        {{-- Pencarian --}}
                        <div class="lg:col-span-6">
                            <label
                                for="personSearch"
                                class="mb-2 block text-sm
                                       font-bold text-slate-700"
                            >
                                Cari Nama atau NIP
                            </label>

                            <input
                                type="search"
                                id="personSearch"
                                name="search"
                                value="{{ $currentSearch }}"
                                maxlength="100"
                                autocomplete="off"
                                placeholder="Masukkan nama dosen, staf, atau NIP..."
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
                                for="personType"
                                class="mb-2 block text-sm
                                       font-bold text-slate-700"
                            >
                                Filter Kategori
                            </label>

                            <select
                                id="personType"
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
                                    Semua Data
                                </option>

                                <option
                                    value="{{ \App\Models\LecturerStaff::TYPE_DOSEN }}"
                                    @selected(
                                        $currentType
                                        === \App\Models\LecturerStaff::TYPE_DOSEN
                                    )
                                >
                                    Dosen
                                </option>

                                <option
                                    value="{{ \App\Models\LecturerStaff::TYPE_STAFF }}"
                                    @selected(
                                        $currentType
                                        === \App\Models\LecturerStaff::TYPE_STAFF
                                    )
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
                                href="{{ route(
                                    'admin.lecturer-staff.index'
                                ) }}"
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
        </div>


        {{-- ===================================================== --}}
        {{-- DESKTOP TABLE --}}
        {{-- ===================================================== --}}

        <div class="hidden overflow-x-auto lg:block">

            <table class="w-full">

                <thead
                    class="border-b border-slate-100
                           bg-slate-50"
                >
                    <tr>
                        <th
                            class="px-6 py-4 text-left
                                   text-xs font-bold uppercase
                                   tracking-wider text-slate-500"
                        >
                            Nama
                        </th>

                        <th
                            class="px-6 py-4 text-left
                                   text-xs font-bold uppercase
                                   tracking-wider text-slate-500"
                        >
                            NIP
                        </th>

                        <th
                            class="px-6 py-4 text-left
                                   text-xs font-bold uppercase
                                   tracking-wider text-slate-500"
                        >
                            Tipe
                        </th>

                        <th
                            class="px-6 py-4 text-right
                                   text-xs font-bold uppercase
                                   tracking-wider text-slate-500"
                        >
                            Aksi
                        </th>
                    </tr>
                </thead>


                <tbody class="divide-y divide-slate-100">

                    @forelse ($lecturerStaff as $item)

                        @php
                            $meta = $getPersonMeta($item);
                        @endphp

                        <tr
                            class="transition
                                   hover:bg-slate-50/70"
                        >
                            {{-- Nama --}}
                            <td class="px-6 py-5">

                                <div
                                    class="flex items-center gap-4"
                                >
                                    @if ($meta['photo_url'])

                                        <img
                                            src="{{ $meta['photo_url'] }}"
                                            alt="Foto {{ $meta['name'] }}"
                                            class="h-16 w-16 shrink-0
                                                   rounded-2xl border
                                                   border-slate-100
                                                   object-cover object-top
                                                   shadow-md"
                                            loading="lazy"
                                        >

                                    @else

                                        <div
                                            @class([
                                                'flex h-16 w-16 shrink-0',
                                                'items-center justify-center',
                                                'rounded-2xl shadow-md',
                                                'bg-blue-100' =>
                                                    $meta['is_dosen'],
                                                'bg-yellow-100' =>
                                                    !$meta['is_dosen'],
                                            ])
                                        >
                                            <span
                                                @class([
                                                    'text-xl font-black',
                                                    'text-blue-700' =>
                                                        $meta['is_dosen'],
                                                    'text-yellow-700' =>
                                                        !$meta['is_dosen'],
                                                ])
                                            >
                                                {{ $meta['initial'] }}
                                            </span>
                                        </div>

                                    @endif


                                    <div class="min-w-0">
                                        <h3
                                            class="break-words font-bold
                                                   text-slate-800"
                                        >
                                            {{ $meta['name'] }}
                                        </h3>

                                        <p
                                            class="mt-1 text-sm
                                                   leading-6 text-slate-500"
                                        >
                                            Program Studi D-IV Teknik Mesin
                                            Produksi dan Perawatan
                                        </p>

                                        @if (
                                            $meta['photo_path'] !== ''
                                            && !$meta['photo_exists']
                                        )
                                            <p
                                                class="mt-2 text-xs
                                                       font-semibold
                                                       text-red-600"
                                            >
                                                Foto tidak ditemukan
                                                di penyimpanan.
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </td>


                            {{-- NIP --}}
                            <td
                                class="px-6 py-5
                                       text-slate-600"
                            >
                                {{ $meta['nip'] !== ''
                                    ? $meta['nip']
                                    : '-' }}
                            </td>


                            {{-- Tipe --}}
                            <td class="px-6 py-5">
                                <span
                                    @class([
                                        'inline-flex rounded-full',
                                        'px-3 py-1 text-xs font-bold',
                                        'bg-blue-50 text-blue-700' =>
                                            $meta['is_dosen'],
                                        'bg-yellow-50 text-yellow-700' =>
                                            !$meta['is_dosen'],
                                    ])
                                >
                                    {{ $meta['type_label'] }}
                                </span>
                            </td>


                            {{-- Aksi --}}
                            <td class="px-6 py-5">
                                <div
                                    class="flex justify-end gap-3"
                                >
                                    <a
                                        href="{{ route(
                                            'admin.lecturer-staff.edit',
                                            $item
                                        ) }}"
                                        class="rounded-xl bg-blue-50
                                               px-4 py-2 text-sm
                                               font-bold text-blue-700
                                               transition
                                               hover:bg-blue-700
                                               hover:text-white"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route(
                                            'admin.lecturer-staff.destroy',
                                            $item
                                        ) }}"
                                        method="POST"
                                        onsubmit="return confirm(
                                            'Yakin ingin menghapus data {{ addslashes($meta['name']) }}? Foto yang tersimpan juga akan dihapus.'
                                        )"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="rounded-xl bg-red-50
                                                   px-4 py-2 text-sm
                                                   font-bold text-red-700
                                                   transition
                                                   hover:bg-red-600
                                                   hover:text-white"
                                        >
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td
                                colspan="4"
                                class="px-6 py-14 text-center"
                            >
                                <h3
                                    class="text-xl font-bold
                                           text-slate-800"
                                >
                                    @if ($hasFilter)
                                        Data Tidak Ditemukan
                                    @else
                                        Belum Ada Data
                                    @endif
                                </h3>

                                <p class="mt-2 text-slate-500">
                                    @if ($hasFilter)
                                        Tidak ada data yang cocok
                                        dengan pencarian atau filter.
                                    @else
                                        Tambahkan data dosen atau staf
                                        terlebih dahulu.
                                    @endif
                                </p>
                            </td>
                        </tr>

                    @endforelse

                </tbody>
            </table>
        </div>


        {{-- ===================================================== --}}
        {{-- MOBILE DAN TABLET --}}
        {{-- ===================================================== --}}

        <div class="space-y-4 p-5 md:p-6 lg:hidden">

            @forelse ($lecturerStaff as $item)

                @php
                    $meta = $getPersonMeta($item);
                @endphp

                <article
                    class="rounded-3xl border
                           border-slate-100 bg-slate-50
                           p-5"
                >
                    <div class="flex items-start gap-4">

                        @if ($meta['photo_url'])

                            <img
                                src="{{ $meta['photo_url'] }}"
                                alt="Foto {{ $meta['name'] }}"
                                class="h-16 w-16 shrink-0
                                       rounded-2xl border
                                       border-slate-100
                                       object-cover object-top
                                       shadow-md"
                                loading="lazy"
                            >

                        @else

                            <div
                                @class([
                                    'flex h-16 w-16 shrink-0',
                                    'items-center justify-center',
                                    'rounded-2xl shadow-md',
                                    'bg-blue-100' =>
                                        $meta['is_dosen'],
                                    'bg-yellow-100' =>
                                        !$meta['is_dosen'],
                                ])
                            >
                                <span
                                    @class([
                                        'text-xl font-black',
                                        'text-blue-700' =>
                                            $meta['is_dosen'],
                                        'text-yellow-700' =>
                                            !$meta['is_dosen'],
                                    ])
                                >
                                    {{ $meta['initial'] }}
                                </span>
                            </div>

                        @endif


                        <div class="min-w-0 flex-1">

                            <div
                                class="flex items-start
                                       justify-between gap-3"
                            >
                                <div class="min-w-0">
                                    <h3
                                        class="break-words font-bold
                                               text-slate-800"
                                    >
                                        {{ $meta['name'] }}
                                    </h3>

                                    <p
                                        class="mt-1 break-all
                                               text-sm text-slate-500"
                                    >
                                        NIP:
                                        {{ $meta['nip'] !== ''
                                            ? $meta['nip']
                                            : '-' }}
                                    </p>
                                </div>

                                <span
                                    @class([
                                        'inline-flex shrink-0',
                                        'rounded-full px-3 py-1',
                                        'text-xs font-bold',
                                        'bg-blue-50 text-blue-700' =>
                                            $meta['is_dosen'],
                                        'bg-yellow-50 text-yellow-700' =>
                                            !$meta['is_dosen'],
                                    ])
                                >
                                    {{ $meta['type_label'] }}
                                </span>
                            </div>


                            @if (
                                $meta['photo_path'] !== ''
                                && !$meta['photo_exists']
                            )
                                <p
                                    class="mt-3 text-xs
                                           font-semibold text-red-600"
                                >
                                    Foto tidak ditemukan di penyimpanan.
                                </p>
                            @endif
                        </div>
                    </div>


                    <div class="mt-5 grid grid-cols-2 gap-3">

                        <a
                            href="{{ route(
                                'admin.lecturer-staff.edit',
                                $item
                            ) }}"
                            class="rounded-xl bg-blue-700
                                   px-4 py-3 text-center
                                   text-sm font-bold text-white
                                   transition hover:bg-blue-800"
                        >
                            Edit
                        </a>

                        <form
                            action="{{ route(
                                'admin.lecturer-staff.destroy',
                                $item
                            ) }}"
                            method="POST"
                            onsubmit="return confirm(
                                'Yakin ingin menghapus data {{ addslashes($meta['name']) }}? Foto yang tersimpan juga akan dihapus.'
                            )"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="w-full rounded-xl
                                       bg-red-600 px-4 py-3
                                       text-sm font-bold text-white
                                       transition hover:bg-red-700"
                            >
                                Hapus
                            </button>
                        </form>
                    </div>
                </article>

            @empty

                <div
                    class="rounded-3xl border
                           border-slate-100 bg-slate-50
                           p-10 text-center"
                >
                    <h3
                        class="text-xl font-bold
                               text-slate-800"
                    >
                        @if ($hasFilter)
                            Data Tidak Ditemukan
                        @else
                            Belum Ada Data
                        @endif
                    </h3>

                    <p class="mt-2 text-slate-500">
                        @if ($hasFilter)
                            Tidak ada data yang cocok dengan pencarian
                            atau filter yang dipilih.
                        @else
                            Tambahkan data dosen atau staf terlebih dahulu.
                        @endif
                    </p>

                    @if ($hasFilter)
                        <a
                            href="{{ route(
                                'admin.lecturer-staff.index'
                            ) }}"
                            class="mt-6 inline-flex items-center
                                   justify-center rounded-xl
                                   bg-blue-700 px-5 py-3
                                   text-sm font-bold text-white
                                   transition hover:bg-blue-800"
                        >
                            Tampilkan Semua
                        </a>
                    @else
                        <a
                            href="{{ route(
                                'admin.lecturer-staff.create'
                            ) }}"
                            class="mt-6 inline-flex items-center
                                   justify-center rounded-xl
                                   bg-blue-700 px-5 py-3
                                   text-sm font-bold text-white
                                   transition hover:bg-blue-800"
                        >
                            Tambah Data
                        </a>
                    @endif
                </div>

            @endforelse
        </div>


        {{-- ===================================================== --}}
        {{-- PAGINATION --}}
        {{-- ===================================================== --}}

        @if ($lecturerStaff->hasPages())
            <div
                class="border-t border-slate-100
                       px-6 py-6 md:px-8"
            >
                {{ $lecturerStaff->links() }}
            </div>
        @endif

    </div>

</div>

@endsection