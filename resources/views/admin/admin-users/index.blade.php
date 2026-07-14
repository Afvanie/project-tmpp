@extends('layouts.admin')

@section('title', 'Pengelola Admin')

@section('content')

@php
    /*
    |--------------------------------------------------------------------------
    | DATA PENGELOLA ADMIN
    |--------------------------------------------------------------------------
    */

    $adminItems = collect($admins ?? []);

    $adminCount = $adminItems->count();

    /*
    |--------------------------------------------------------------------------
    | ADMIN YANG SEDANG LOGIN
    |--------------------------------------------------------------------------
    |
    | Autentikasi proyek menggunakan session admin_id, bukan guard
    | auth('admin').
    |
    */

    $currentAdminId = (int) session(
        'admin_id',
        0
    );
@endphp


<div class="space-y-8">

    {{-- ========================================================= --}}
    {{-- HEADER --}}
    {{-- ========================================================= --}}

    <div
        class="flex flex-col gap-5
               md:flex-row md:items-center
               md:justify-between"
    >
        <div>
            <h1
                class="text-3xl font-black
                       text-slate-800 md:text-4xl"
            >
                Pengelola Admin
            </h1>

            <p
                class="mt-3 max-w-3xl
                       leading-7 text-slate-500"
            >
                Kelola akun pengelola yang dapat mengakses panel
                administrasi website D-IV Teknik Mesin Produksi dan
                Perawatan.
            </p>
        </div>

        <a
            href="{{ route('admin.admin-users.create') }}"
            class="inline-flex items-center
                   justify-center gap-3
                   rounded-2xl bg-blue-700
                   px-6 py-4 font-bold
                   text-white shadow-lg
                   shadow-blue-700/20
                   transition hover:bg-blue-800"
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

            Tambah Admin
        </a>
    </div>


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


    {{-- ========================================================= --}}
    {{-- DAFTAR ADMIN --}}
    {{-- ========================================================= --}}

    <section
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


        {{-- Ringkasan --}}
        <div
            class="border-b border-slate-100
                   p-6 md:p-8"
        >
            <div
                class="flex flex-col gap-5
                       md:flex-row md:items-center
                       md:justify-between"
            >
                <div>
                    <h2
                        class="text-2xl font-black
                               text-slate-800"
                    >
                        Daftar Akun Admin
                    </h2>

                    <p
                        class="mt-2 leading-7
                               text-slate-500"
                    >
                        Terdapat {{ $adminCount }} akun pengelola
                        yang terdaftar.
                    </p>
                </div>

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
                        {{ $adminCount }}
                    </span>

                    <span
                        class="text-sm font-semibold
                               text-slate-500"
                    >
                        Akun Admin
                    </span>
                </div>
            </div>
        </div>


        {{-- ===================================================== --}}
        {{-- DESKTOP TABLE --}}
        {{-- ===================================================== --}}

        <div class="hidden overflow-x-auto md:block">

            <table class="w-full">

                <thead
                    class="border-b border-slate-100
                           bg-slate-50"
                >
                    <tr>
                        <th
                            scope="col"
                            class="px-6 py-4 text-left
                                   text-xs font-bold uppercase
                                   tracking-wider text-slate-500"
                        >
                            Admin
                        </th>

                        <th
                            scope="col"
                            class="px-6 py-4 text-left
                                   text-xs font-bold uppercase
                                   tracking-wider text-slate-500"
                        >
                            Email
                        </th>

                        <th
                            scope="col"
                            class="px-6 py-4 text-left
                                   text-xs font-bold uppercase
                                   tracking-wider text-slate-500"
                        >
                            Keterangan
                        </th>

                        <th
                            scope="col"
                            class="px-6 py-4 text-right
                                   text-xs font-bold uppercase
                                   tracking-wider text-slate-500"
                        >
                            Aksi
                        </th>
                    </tr>
                </thead>


                <tbody class="divide-y divide-slate-100">

                    @forelse ($adminItems as $admin)

                        @php
                            $adminName = trim(
                                (string) $admin->name
                            );

                            $adminEmail = trim(
                                (string) $admin->email
                            );

                            $adminInitial = $adminName !== ''
                                ? mb_strtoupper(
                                    mb_substr(
                                        $adminName,
                                        0,
                                        1,
                                        'UTF-8'
                                    ),
                                    'UTF-8'
                                )
                                : 'A';

                            $isCurrentAdmin =
                                $currentAdminId ===
                                (int) $admin->id;

                            $isLastAdmin =
                                $adminCount <= 1;

                            $cannotDelete =
                                $isCurrentAdmin
                                || $isLastAdmin;
                        @endphp


                        <tr
                            @class([
                                'transition',
                                'bg-yellow-50/40' =>
                                    $isCurrentAdmin,
                                'hover:bg-slate-50/70' =>
                                    !$isCurrentAdmin,
                            ])
                        >
                            {{-- Admin --}}
                            <td class="px-6 py-5">

                                <div
                                    class="flex items-center
                                           gap-4"
                                >
                                    <div
                                        @class([
                                            'flex h-12 w-12 shrink-0',
                                            'items-center justify-center',
                                            'rounded-2xl font-black',
                                            'shadow-lg',
                                            'bg-yellow-400 text-slate-900' =>
                                                $isCurrentAdmin,
                                            'bg-blue-700 text-white' =>
                                                !$isCurrentAdmin,
                                        ])
                                    >
                                        {{ $adminInitial }}
                                    </div>

                                    <div class="min-w-0">

                                        <h3
                                            class="font-bold
                                                   text-slate-800"
                                        >
                                            {{ $adminName !== ''
                                                ? $adminName
                                                : 'Administrator' }}
                                        </h3>

                                        <p
                                            class="mt-1 text-sm
                                                   text-slate-500"
                                        >
                                            Pengelola Website
                                        </p>
                                    </div>
                                </div>
                            </td>


                            {{-- Email --}}
                            <td
                                class="px-6 py-5
                                       text-slate-600"
                            >
                                <span class="break-all">
                                    {{ $adminEmail }}
                                </span>
                            </td>


                            {{-- Keterangan --}}
                            <td class="px-6 py-5">

                                @if ($isCurrentAdmin)
                                    <span
                                        class="inline-flex rounded-full
                                               bg-yellow-50 px-3 py-1
                                               text-xs font-bold
                                               text-yellow-700"
                                    >
                                        Sedang Digunakan
                                    </span>
                                @else
                                    <span
                                        class="inline-flex rounded-full
                                               bg-blue-50 px-3 py-1
                                               text-xs font-bold
                                               text-blue-700"
                                    >
                                        Akun Pengelola
                                    </span>
                                @endif
                            </td>


                            {{-- Aksi --}}
                            <td class="px-6 py-5">

                                <div
                                    class="flex items-center
                                           justify-end gap-3"
                                >
                                    <a
                                        href="{{ route(
                                            'admin.admin-users.edit',
                                            $admin
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
                                            'admin.admin-users.destroy',
                                            $admin
                                        ) }}"
                                        method="POST"
                                        onsubmit="return confirm(
                                            'Yakin ingin menghapus akun admin ini? Tindakan ini tidak dapat dibatalkan.'
                                        )"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            @disabled($cannotDelete)
                                            title="{{ $isCurrentAdmin
                                                ? 'Akun yang sedang digunakan tidak dapat dihapus.'
                                                : ($isLastAdmin
                                                    ? 'Akun admin terakhir tidak dapat dihapus.'
                                                    : 'Hapus akun admin') }}"
                                            class="rounded-xl bg-red-50
                                                   px-4 py-2 text-sm
                                                   font-bold text-red-700
                                                   transition
                                                   hover:bg-red-600
                                                   hover:text-white
                                                   disabled:cursor-not-allowed
                                                   disabled:opacity-40
                                                   disabled:hover:bg-red-50
                                                   disabled:hover:text-red-700"
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
                                class="px-6 py-14
                                       text-center"
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
                                            d="M12 11c1.657 0 3-1.343 3-3S13.657 5 12 5 9 6.343 9 8s1.343 3 3 3zM5.5 21a6.5 6.5 0 0113 0M19 8h2m-1-1v2"
                                        />
                                    </svg>
                                </div>

                                <h3
                                    class="mt-5 text-xl
                                           font-bold text-slate-800"
                                >
                                    Belum Ada Akun Admin
                                </h3>

                                <p
                                    class="mt-2 text-slate-500"
                                >
                                    Tambahkan akun pengelola website
                                    melalui tombol Tambah Admin.
                                </p>
                            </td>
                        </tr>

                    @endforelse
                </tbody>
            </table>
        </div>


        {{-- ===================================================== --}}
        {{-- MOBILE CARDS --}}
        {{-- ===================================================== --}}

        <div class="space-y-4 p-5 md:hidden">

            @forelse ($adminItems as $admin)

                @php
                    $adminName = trim(
                        (string) $admin->name
                    );

                    $adminEmail = trim(
                        (string) $admin->email
                    );

                    $adminInitial = $adminName !== ''
                        ? mb_strtoupper(
                            mb_substr(
                                $adminName,
                                0,
                                1,
                                'UTF-8'
                            ),
                            'UTF-8'
                        )
                        : 'A';

                    $isCurrentAdmin =
                        $currentAdminId ===
                        (int) $admin->id;

                    $isLastAdmin =
                        $adminCount <= 1;

                    $cannotDelete =
                        $isCurrentAdmin
                        || $isLastAdmin;
                @endphp


                <article
                    @class([
                        'rounded-3xl border p-5',
                        'border-yellow-200 bg-yellow-50/50' =>
                            $isCurrentAdmin,
                        'border-slate-100 bg-slate-50' =>
                            !$isCurrentAdmin,
                    ])
                >
                    <div class="flex items-start gap-4">

                        <div
                            @class([
                                'flex h-12 w-12 shrink-0',
                                'items-center justify-center',
                                'rounded-2xl font-black',
                                'shadow-lg',
                                'bg-yellow-400 text-slate-900' =>
                                    $isCurrentAdmin,
                                'bg-blue-700 text-white' =>
                                    !$isCurrentAdmin,
                            ])
                        >
                            {{ $adminInitial }}
                        </div>


                        <div class="min-w-0 flex-1">

                            <h3
                                class="font-bold
                                       text-slate-800"
                            >
                                {{ $adminName !== ''
                                    ? $adminName
                                    : 'Administrator' }}
                            </h3>

                            <p
                                class="mt-1 break-all
                                       text-sm text-slate-500"
                            >
                                {{ $adminEmail }}
                            </p>

                            <div class="mt-3">

                                @if ($isCurrentAdmin)
                                    <span
                                        class="inline-flex rounded-full
                                               bg-yellow-100 px-3 py-1
                                               text-xs font-bold
                                               text-yellow-700"
                                    >
                                        Sedang Digunakan
                                    </span>
                                @else
                                    <span
                                        class="inline-flex rounded-full
                                               bg-blue-50 px-3 py-1
                                               text-xs font-bold
                                               text-blue-700"
                                    >
                                        Akun Pengelola
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>


                    <div class="mt-5 grid grid-cols-2 gap-3">

                        <a
                            href="{{ route(
                                'admin.admin-users.edit',
                                $admin
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
                                'admin.admin-users.destroy',
                                $admin
                            ) }}"
                            method="POST"
                            onsubmit="return confirm(
                                'Yakin ingin menghapus akun admin ini? Tindakan ini tidak dapat dibatalkan.'
                            )"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                @disabled($cannotDelete)
                                class="w-full rounded-xl
                                       bg-red-600 px-4 py-3
                                       text-sm font-bold text-white
                                       transition hover:bg-red-700
                                       disabled:cursor-not-allowed
                                       disabled:opacity-40"
                            >
                                Hapus
                            </button>
                        </form>
                    </div>


                    @if ($cannotDelete)
                        <p
                            class="mt-3 text-center text-xs
                                   font-semibold text-slate-500"
                        >
                            {{ $isCurrentAdmin
                                ? 'Akun yang sedang digunakan tidak dapat dihapus.'
                                : 'Minimal satu akun admin harus tetap tersedia.' }}
                        </p>
                    @endif
                </article>

            @empty

                <div
                    class="rounded-3xl border
                           border-slate-100 bg-slate-50
                           p-8 text-center"
                >
                    <div
                        class="mx-auto flex h-16 w-16
                               items-center justify-center
                               rounded-2xl bg-blue-100
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
                                d="M12 11c1.657 0 3-1.343 3-3S13.657 5 12 5 9 6.343 9 8s1.343 3 3 3zM5.5 21a6.5 6.5 0 0113 0M19 8h2m-1-1v2"
                            />
                        </svg>
                    </div>

                    <h3
                        class="mt-5 text-xl font-bold
                               text-slate-800"
                    >
                        Belum Ada Akun Admin
                    </h3>

                    <p class="mt-2 text-slate-500">
                        Tambahkan akun pengelola website terlebih
                        dahulu.
                    </p>
                </div>

            @endforelse
        </div>
    </section>
</div>

@endsection