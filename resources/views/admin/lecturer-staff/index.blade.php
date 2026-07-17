@extends('layouts.admin')

@section('title', 'Data Dosen dan Staf')

@section('content')

@php
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

    $getPersonMeta = static function ($person): array {
        $name = trim((string) $person->name);
        $nip = trim((string) $person->nip);
        $photoPath = trim((string) $person->photo);

        $photoExists = $photoPath !== ''
            && \Illuminate\Support\Facades\Storage::disk(
                'public'
            )->exists($photoPath);

        return [
            'name' => $name,
            'nip' => $nip,
            'photo_path' => $photoPath,
            'photo_exists' => $photoExists,
            'photo_url' => $photoExists
                ? asset(
                    'storage/'
                    . ltrim($photoPath, '/')
                )
                : null,
            'initial' => $name !== ''
                ? mb_strtoupper(
                    mb_substr($name, 0, 1)
                )
                : 'T',
            'is_dosen' =>
                $person->type
                === \App\Models\LecturerStaff::TYPE_DOSEN,
            'type_label' => $person->type_label,
        ];
    };
@endphp


<div class="mx-auto max-w-7xl space-y-6">

    {{-- ========================================================= --}}
    {{-- HEADER --}}
    {{-- ========================================================= --}}

    <header
        class="flex flex-col gap-4
               lg:flex-row lg:items-end
               lg:justify-between"
    >
        <div>
            <div class="flex items-center gap-3">
                <span
                    class="h-px w-8 bg-[#D7B33E]"
                    aria-hidden="true"
                ></span>

                <p
                    class="text-[11px] font-bold
                           uppercase tracking-[0.16em]
                           text-[#075F9B]"
                >
                    Pengelolaan Personel
                </p>
            </div>

            <h1
                class="mt-3 text-2xl font-extrabold
                       tracking-tight text-slate-900
                       sm:text-3xl"
            >
                Data Dosen dan Staf
            </h1>

            <p
                class="mt-2 max-w-3xl
                       text-sm leading-7
                       text-slate-500"
            >
                Kelola nama, NIP, kategori, dan foto
                personel Program Studi D-IV TMPP.
            </p>
        </div>


        <a
            href="{{ route(
                'admin.lecturer-staff.create'
            ) }}"
            class="inline-flex w-full items-center
                   justify-center gap-2 rounded-xl
                   bg-[#075F9B] px-5 py-3
                   text-sm font-bold text-white
                   transition hover:bg-[#064B7B]
                   sm:w-auto"
        >
            <span aria-hidden="true">+</span>
            Tambah Dosen atau Staf
        </a>
    </header>


    {{-- ========================================================= --}}
    {{-- ALERT --}}
    {{-- ========================================================= --}}

    @foreach ([
        'success' => [
            'border-emerald-200',
            'bg-emerald-50',
            'text-emerald-800',
        ],
        'warning' => [
            'border-amber-200',
            'bg-amber-50',
            'text-amber-800',
        ],
        'error' => [
            'border-red-200',
            'bg-red-50',
            'text-red-700',
        ],
    ] as $messageType => $classes)
        @if (session($messageType))
            <div
                class="rounded-xl border
                       {{ implode(' ', $classes) }}
                       px-4 py-3 text-sm font-semibold"
                role="status"
            >
                {{ session($messageType) }}
            </div>
        @endif
    @endforeach

    @if ($errors->any())
        <div
            class="rounded-xl border
                   border-red-200 bg-red-50
                   px-4 py-4 text-red-800"
            role="alert"
        >
            <p class="text-sm font-bold">
                Data belum dapat diproses:
            </p>

            <ul
                class="mt-2 list-inside list-disc
                       space-y-1 text-sm"
            >
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {{-- ========================================================= --}}
    {{-- RINGKASAN --}}
    {{-- ========================================================= --}}

    <section
        class="flex flex-col gap-4
               rounded-2xl border
               border-slate-200 bg-white
               px-5 py-4
               sm:flex-row sm:items-center
               sm:justify-between sm:px-6"
    >
        <div>
            <h2
                class="text-sm font-extrabold
                       text-slate-900"
            >
                Ringkasan Personel
            </h2>

            <p
                class="mt-1 text-xs
                       leading-5 text-slate-500"
            >
                Seluruh data yang tersimpan tampil
                pada halaman publik.
            </p>
        </div>

        <div
            class="grid grid-cols-3
                   divide-x divide-slate-200
                   text-center"
        >
            <div class="px-4">
                <p
                    class="text-xl font-extrabold
                           text-slate-900"
                >
                    {{ $totalAll }}
                </p>

                <p class="mt-1 text-[10px] text-slate-500">
                    Total
                </p>
            </div>

            <div class="px-4">
                <p
                    class="text-xl font-extrabold
                           text-[#075F9B]"
                >
                    {{ $totalDosen }}
                </p>

                <p class="mt-1 text-[10px] text-slate-500">
                    Dosen
                </p>
            </div>

            <div class="px-4">
                <p
                    class="text-xl font-extrabold
                           text-[#D7A900]"
                >
                    {{ $totalStaff }}
                </p>

                <p class="mt-1 text-[10px] text-slate-500">
                    Staf
                </p>
            </div>
        </div>
    </section>


    {{-- ========================================================= --}}
    {{-- IMPORT DATA --}}
    {{-- ========================================================= --}}

    <section
        class="overflow-hidden rounded-2xl
               border border-slate-200
               bg-white"
    >
        <details class="group">
            <summary
                class="flex cursor-pointer
                       list-none items-center
                       justify-between gap-4
                       px-5 py-4 sm:px-6"
            >
                <div>
                    <h2
                        class="text-sm font-extrabold
                               text-slate-900"
                    >
                        Import dari Excel atau CSV
                    </h2>

                    <p
                        class="mt-1 text-xs
                               leading-5 text-slate-500"
                    >
                        Gunakan untuk memasukkan banyak nama
                        dan NIP sekaligus.
                    </p>
                </div>

                <span
                    class="flex h-9 w-9 shrink-0
                           items-center justify-center
                           rounded-xl bg-slate-100
                           text-slate-500 transition
                           group-open:rotate-180"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        aria-hidden="true"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M19 9l-7 7-7-7"
                        />
                    </svg>
                </span>
            </summary>


            <div
                class="border-t border-slate-200
                       px-5 py-5 sm:px-6"
            >
                <div
                    class="flex flex-col gap-4
                           sm:flex-row sm:items-center
                           sm:justify-between"
                >
                    <p
                        class="max-w-2xl text-sm
                               leading-6 text-slate-500"
                    >
                        Unduh template terlebih dahulu.
                        Kolom yang diproses adalah nama dan NIP.
                    </p>

                    <a
                        href="{{ route(
                            'admin.lecturer-staff.template'
                        ) }}"
                        class="inline-flex items-center
                               justify-center rounded-xl
                               border border-slate-200
                               bg-white px-4 py-2.5
                               text-sm font-bold
                               text-slate-700
                               transition hover:bg-slate-100"
                    >
                        Unduh Template
                    </a>
                </div>


                <div
                    class="mt-5 grid gap-4
                           lg:grid-cols-2"
                >
                    @foreach ([
                        [
                            'type' =>
                                \App\Models\LecturerStaff::TYPE_DOSEN,
                            'label' => 'Import Dosen',
                            'id' => 'dosenImportFile',
                        ],
                        [
                            'type' =>
                                \App\Models\LecturerStaff::TYPE_STAFF,
                            'label' => 'Import Staf',
                            'id' => 'staffImportFile',
                        ],
                    ] as $import)
                        <form
                            action="{{ route(
                                'admin.lecturer-staff.import',
                                $import['type']
                            ) }}"
                            method="POST"
                            enctype="multipart/form-data"
                            class="rounded-xl border
                                   border-slate-200 p-4"
                        >
                            @csrf

                            <label
                                for="{{ $import['id'] }}"
                                class="block text-sm
                                       font-bold text-slate-800"
                            >
                                {{ $import['label'] }}
                            </label>

                            <input
                                id="{{ $import['id'] }}"
                                type="file"
                                name="file"
                                required
                                accept=".xlsx,.xls,.csv,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel,text/csv"
                                class="mt-3 block w-full
                                       rounded-xl border
                                       border-slate-200
                                       bg-white px-3 py-2.5
                                       text-sm text-slate-600
                                       file:mr-3
                                       file:rounded-lg
                                       file:border-0
                                       file:bg-slate-100
                                       file:px-3 file:py-2
                                       file:text-xs
                                       file:font-bold
                                       file:text-slate-700"
                            >

                            <button
                                type="submit"
                                class="mt-3 inline-flex
                                       w-full items-center
                                       justify-center rounded-xl
                                       bg-[#075F9B]
                                       px-4 py-2.5
                                       text-sm font-bold
                                       text-white transition
                                       hover:bg-[#064B7B]"
                            >
                                {{ $import['label'] }}
                            </button>
                        </form>
                    @endforeach
                </div>
            </div>
        </details>
    </section>


    {{-- ========================================================= --}}
    {{-- DAFTAR PERSONEL --}}
    {{-- ========================================================= --}}

    <section
        class="overflow-hidden rounded-2xl
               border border-slate-200
               bg-white"
        aria-labelledby="personListTitle"
    >
        <div
            class="border-b border-slate-200
                   px-5 py-5 sm:px-6"
        >
            <div
                class="flex flex-col gap-4
                       lg:flex-row lg:items-end
                       lg:justify-between"
            >
                <div>
                    <h2
                        id="personListTitle"
                        class="text-lg font-extrabold
                               text-slate-900"
                    >
                        Daftar Dosen dan Staf
                    </h2>

                    <p
                        class="mt-1 text-sm
                               text-slate-500"
                    >
                        Cari berdasarkan nama atau NIP.
                    </p>
                </div>


                <form
                    action="{{ route(
                        'admin.lecturer-staff.index'
                    ) }}"
                    method="GET"
                    class="grid gap-3
                           sm:grid-cols-[minmax(0,1fr)_160px_auto_auto]
                           lg:w-[720px]"
                >
                    <label class="sr-only" for="personSearch">
                        Cari nama atau NIP
                    </label>

                    <input
                        id="personSearch"
                        type="search"
                        name="search"
                        value="{{ $currentSearch }}"
                        maxlength="100"
                        placeholder="Cari nama atau NIP..."
                        class="w-full rounded-xl
                               border border-slate-200
                               bg-slate-50
                               px-4 py-2.5 text-sm
                               text-slate-700 outline-none
                               transition focus:border-[#075F9B]
                               focus:bg-white"
                    >

                    <label class="sr-only" for="personType">
                        Kategori personel
                    </label>

                    <select
                        id="personType"
                        name="type"
                        class="w-full rounded-xl
                               border border-slate-200
                               bg-slate-50
                               px-4 py-2.5 text-sm
                               text-slate-700 outline-none
                               transition focus:border-[#075F9B]
                               focus:bg-white"
                    >
                        <option
                            value="all"
                            @selected(
                                $currentType === 'all'
                            )
                        >
                            Semua
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

                    <button
                        type="submit"
                        class="inline-flex items-center
                               justify-center rounded-xl
                               bg-[#075F9B]
                               px-4 py-2.5
                               text-sm font-bold text-white
                               hover:bg-[#064B7B]"
                    >
                        Cari
                    </button>

                    <a
                        href="{{ route(
                            'admin.lecturer-staff.index'
                        ) }}"
                        class="inline-flex items-center
                               justify-center rounded-xl
                               border border-slate-200
                               bg-white px-4 py-2.5
                               text-sm font-bold
                               text-slate-700
                               hover:bg-slate-100"
                    >
                        Reset
                    </a>
                </form>
            </div>
        </div>


        {{-- DESKTOP --}}
        <div class="hidden overflow-x-auto lg:block">
            <table class="w-full">
                <thead
                    class="border-b border-slate-200
                           bg-slate-50"
                >
                    <tr>
                        <th
                            class="px-6 py-4 text-left
                                   text-[11px] font-bold
                                   uppercase tracking-[0.12em]
                                   text-slate-500"
                        >
                            Personel
                        </th>

                        <th
                            class="px-6 py-4 text-left
                                   text-[11px] font-bold
                                   uppercase tracking-[0.12em]
                                   text-slate-500"
                        >
                            NIP
                        </th>

                        <th
                            class="px-6 py-4 text-left
                                   text-[11px] font-bold
                                   uppercase tracking-[0.12em]
                                   text-slate-500"
                        >
                            Kategori
                        </th>

                        <th
                            class="px-6 py-4 text-right
                                   text-[11px] font-bold
                                   uppercase tracking-[0.12em]
                                   text-slate-500"
                        >
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-200">
                    @forelse ($lecturerStaff as $item)
                        @php
                            $meta = $getPersonMeta($item);
                        @endphp

                        <tr class="hover:bg-slate-50/70">
                            <td class="px-6 py-4">
                                <div
                                    class="flex items-center
                                           gap-3"
                                >
                                    @if ($meta['photo_url'])
                                        <img
                                            src="{{ $meta['photo_url'] }}"
                                            alt="Foto {{ $meta['name'] }}"
                                            class="h-12 w-12 shrink-0
                                                   rounded-xl
                                                   object-cover object-top"
                                            loading="lazy"
                                        >
                                    @else
                                        <div
                                            @class([
                                                'flex h-12 w-12 shrink-0',
                                                'items-center justify-center',
                                                'rounded-xl font-extrabold',
                                                'bg-blue-50 text-[#075F9B]' =>
                                                    $meta['is_dosen'],
                                                'bg-amber-50 text-amber-700' =>
                                                    !$meta['is_dosen'],
                                            ])
                                        >
                                            {{ $meta['initial'] }}
                                        </div>
                                    @endif

                                    <div class="min-w-0">
                                        <p
                                            class="font-bold
                                                   text-slate-800"
                                        >
                                            {{ $meta['name'] }}
                                        </p>

                                        @if (
                                            $meta['photo_path'] !== ''
                                            && !$meta['photo_exists']
                                        )
                                            <p
                                                class="mt-1 text-xs
                                                       font-semibold
                                                       text-red-600"
                                            >
                                                Foto tidak ditemukan
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            <td
                                class="px-6 py-4
                                       text-sm text-slate-600"
                            >
                                {{ $meta['nip'] !== ''
                                    ? $meta['nip']
                                    : '-' }}
                            </td>

                            <td class="px-6 py-4">
                                <span
                                    @class([
                                        'inline-flex rounded-full',
                                        'px-2.5 py-1 text-xs',
                                        'font-bold',
                                        'bg-blue-50 text-[#075F9B]' =>
                                            $meta['is_dosen'],
                                        'bg-amber-50 text-amber-700' =>
                                            !$meta['is_dosen'],
                                    ])
                                >
                                    {{ $meta['type_label'] }}
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                <div
                                    class="flex justify-end gap-2"
                                >
                                    <a
                                        href="{{ route(
                                            'admin.lecturer-staff.edit',
                                            $item
                                        ) }}"
                                        class="inline-flex items-center
                                               justify-center rounded-lg
                                               bg-blue-50 px-3 py-2
                                               text-xs font-bold
                                               text-[#075F9B]
                                               hover:bg-blue-100"
                                    >
                                        Ubah
                                    </a>

                                    <form
                                        action="{{ route(
                                            'admin.lecturer-staff.destroy',
                                            $item
                                        ) }}"
                                        method="POST"
                                        onsubmit="return confirm(
                                            'Hapus data {{ addslashes($meta['name']) }}? Foto yang tersimpan juga akan dihapus.'
                                        )"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="inline-flex
                                                   items-center
                                                   justify-center
                                                   rounded-lg bg-red-50
                                                   px-3 py-2
                                                   text-xs font-bold
                                                   text-red-600
                                                   hover:bg-red-100"
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
                                <p
                                    class="text-sm font-bold
                                           text-slate-700"
                                >
                                    {{ $hasFilter
                                        ? 'Data tidak ditemukan'
                                        : 'Belum ada data' }}
                                </p>

                                <p
                                    class="mt-2 text-sm
                                           text-slate-500"
                                >
                                    {{ $hasFilter
                                        ? 'Coba ubah kata pencarian atau kategori.'
                                        : 'Tambahkan data dosen atau staf terlebih dahulu.' }}
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>


        {{-- MOBILE --}}
        <div
            class="divide-y divide-slate-200
                   lg:hidden"
        >
            @forelse ($lecturerStaff as $item)
                @php
                    $meta = $getPersonMeta($item);
                @endphp

                <article class="px-5 py-5 sm:px-6">
                    <div class="flex items-start gap-3">
                        @if ($meta['photo_url'])
                            <img
                                src="{{ $meta['photo_url'] }}"
                                alt="Foto {{ $meta['name'] }}"
                                class="h-14 w-14 shrink-0
                                       rounded-xl
                                       object-cover object-top"
                                loading="lazy"
                            >
                        @else
                            <div
                                @class([
                                    'flex h-14 w-14 shrink-0',
                                    'items-center justify-center',
                                    'rounded-xl font-extrabold',
                                    'bg-blue-50 text-[#075F9B]' =>
                                        $meta['is_dosen'],
                                    'bg-amber-50 text-amber-700' =>
                                        !$meta['is_dosen'],
                                ])
                            >
                                {{ $meta['initial'] }}
                            </div>
                        @endif

                        <div class="min-w-0 flex-1">
                            <div
                                class="flex items-start
                                       justify-between gap-3"
                            >
                                <div class="min-w-0">
                                    <h3
                                        class="font-bold
                                               leading-6
                                               text-slate-800"
                                    >
                                        {{ $meta['name'] }}
                                    </h3>

                                    <p
                                        class="mt-1 break-all
                                               text-xs text-slate-500"
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
                                        'rounded-full px-2.5 py-1',
                                        'text-[10px] font-bold',
                                        'bg-blue-50 text-[#075F9B]' =>
                                            $meta['is_dosen'],
                                        'bg-amber-50 text-amber-700' =>
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
                                    class="mt-2 text-xs
                                           font-semibold text-red-600"
                                >
                                    Foto tidak ditemukan
                                </p>
                            @endif
                        </div>
                    </div>


                    <div
                        class="mt-4 grid
                               grid-cols-2 gap-2"
                    >
                        <a
                            href="{{ route(
                                'admin.lecturer-staff.edit',
                                $item
                            ) }}"
                            class="inline-flex items-center
                                   justify-center rounded-xl
                                   bg-[#075F9B]
                                   px-4 py-2.5
                                   text-sm font-bold text-white
                                   hover:bg-[#064B7B]"
                        >
                            Ubah
                        </a>

                        <form
                            action="{{ route(
                                'admin.lecturer-staff.destroy',
                                $item
                            ) }}"
                            method="POST"
                            onsubmit="return confirm(
                                'Hapus data {{ addslashes($meta['name']) }}? Foto yang tersimpan juga akan dihapus.'
                            )"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="inline-flex w-full
                                       items-center justify-center
                                       rounded-xl bg-red-50
                                       px-4 py-2.5
                                       text-sm font-bold
                                       text-red-600
                                       hover:bg-red-100"
                            >
                                Hapus
                            </button>
                        </form>
                    </div>
                </article>
            @empty
                <div class="px-6 py-12 text-center">
                    <p
                        class="text-sm font-bold
                               text-slate-700"
                    >
                        {{ $hasFilter
                            ? 'Data tidak ditemukan'
                            : 'Belum ada data' }}
                    </p>

                    <p
                        class="mt-2 text-sm
                               text-slate-500"
                    >
                        {{ $hasFilter
                            ? 'Coba ubah kata pencarian atau kategori.'
                            : 'Tambahkan data dosen atau staf terlebih dahulu.' }}
                    </p>
                </div>
            @endforelse
        </div>


        @if ($lecturerStaff->hasPages())
            <div
                class="border-t border-slate-200
                       px-5 py-4 sm:px-6"
            >
                {{ $lecturerStaff->links() }}
            </div>
        @endif
    </section>
</div>

@endsection
