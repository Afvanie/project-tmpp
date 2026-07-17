@extends('layouts.admin')

@section('title', 'Pengelola Admin')

@section('content')

@php
    $adminItems = collect($admins ?? []);

    $adminCount = $adminItems->count();

    $currentAdminId = (int) session(
        'admin_id',
        0
    );
@endphp


<div class="mx-auto max-w-7xl space-y-6">

    {{-- HEADER --}}
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
                    Hak Akses Website
                </p>
            </div>

            <h1
                class="mt-3 text-2xl font-extrabold
                       tracking-tight text-slate-900
                       sm:text-3xl"
            >
                Pengelola Admin
            </h1>

            <p
                class="mt-2 max-w-3xl
                       text-sm leading-7
                       text-slate-500"
            >
                Kelola akun yang dapat masuk dan mengubah
                isi website Program Studi D-IV TMPP.
            </p>
        </div>


        <a
            href="{{ route(
                'admin.admin-users.create'
            ) }}"
            class="inline-flex w-full items-center
                   justify-center gap-2 rounded-xl
                   bg-[#075F9B] px-5 py-3
                   text-sm font-bold text-white
                   transition hover:bg-[#064B7B]
                   sm:w-auto"
        >
            <span aria-hidden="true">+</span>
            Tambah Pengelola
        </a>
    </header>


    {{-- ALERT --}}
    @if (session('success'))
        <div
            class="rounded-xl border
                   border-emerald-200
                   bg-emerald-50 px-4 py-3
                   text-sm font-semibold
                   text-emerald-800"
            role="status"
        >
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div
            class="rounded-xl border
                   border-red-200 bg-red-50
                   px-4 py-3 text-sm
                   font-semibold text-red-700"
            role="alert"
        >
            {{ session('error') }}
        </div>
    @endif


    {{-- RINGKASAN --}}
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
                Ringkasan Akses
            </h2>

            <p
                class="mt-1 text-xs
                       leading-5 text-slate-500"
            >
                Minimal satu akun pengelola harus tetap tersedia.
            </p>
        </div>

        <div class="text-left sm:text-right">
            <p
                class="text-2xl font-extrabold
                       text-[#075F9B]"
            >
                {{ $adminCount }}
            </p>

            <p class="mt-1 text-xs text-slate-500">
                akun pengelola
            </p>
        </div>
    </section>


    {{-- DAFTAR --}}
    <section
        class="overflow-hidden rounded-2xl
               border border-slate-200
               bg-white"
        aria-labelledby="adminListTitle"
    >
        <div
            class="flex flex-col gap-4
                   border-b border-slate-200
                   px-5 py-5 sm:px-6
                   lg:flex-row lg:items-end
                   lg:justify-between"
        >
            <div>
                <h2
                    id="adminListTitle"
                    class="text-lg font-extrabold
                           text-slate-900"
                >
                    Daftar Pengelola
                </h2>

                <p
                    class="mt-1 text-sm
                           text-slate-500"
                >
                    Cari berdasarkan nama atau email.
                </p>
            </div>


            <div class="w-full lg:w-80">
                <label
                    for="adminSearch"
                    class="sr-only"
                >
                    Cari akun pengelola
                </label>

                <input
                    id="adminSearch"
                    type="search"
                    autocomplete="off"
                    placeholder="Cari nama atau email..."
                    class="w-full rounded-xl
                           border border-slate-200
                           bg-slate-50
                           px-4 py-2.5 text-sm
                           text-slate-700 outline-none
                           transition
                           focus:border-[#075F9B]
                           focus:bg-white"
                >
            </div>
        </div>


        {{-- DESKTOP --}}
        <div class="hidden overflow-x-auto md:block">
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
                            Pengelola
                        </th>

                        <th
                            class="px-6 py-4 text-left
                                   text-[11px] font-bold
                                   uppercase tracking-[0.12em]
                                   text-slate-500"
                        >
                            Email
                        </th>

                        <th
                            class="px-6 py-4 text-left
                                   text-[11px] font-bold
                                   uppercase tracking-[0.12em]
                                   text-slate-500"
                        >
                            Keterangan
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
                    @forelse ($adminItems as $admin)
                        @php
                            $adminName = trim(
                                (string) $admin->name
                            );

                            $adminEmail = trim(
                                (string) $admin->email
                            );

                            $adminInitial =
                                $adminName !== ''
                                    ? mb_strtoupper(
                                        mb_substr(
                                            $adminName,
                                            0,
                                            1
                                        )
                                    )
                                    : 'A';

                            $isCurrentAdmin =
                                $currentAdminId
                                === (int) $admin->id;

                            $isLastAdmin =
                                $adminCount <= 1;

                            $cannotDelete =
                                $isCurrentAdmin
                                || $isLastAdmin;

                            $searchText =
                                \Illuminate\Support\Str::lower(
                                    $adminName
                                    . ' '
                                    . $adminEmail
                                );
                        @endphp


                        <tr
                            class="hover:bg-slate-50/70"
                            data-admin-card
                            data-search="{{ $searchText }}"
                        >
                            <td class="px-6 py-4">
                                <div
                                    class="flex items-center
                                           gap-3"
                                >
                                    <div
                                        @class([
                                            'flex h-11 w-11 shrink-0',
                                            'items-center justify-center',
                                            'rounded-xl font-extrabold',
                                            'bg-amber-50 text-amber-700' =>
                                                $isCurrentAdmin,
                                            'bg-blue-50 text-[#075F9B]' =>
                                                !$isCurrentAdmin,
                                        ])
                                    >
                                        {{ $adminInitial }}
                                    </div>

                                    <div class="min-w-0">
                                        <p
                                            class="font-bold
                                                   text-slate-800"
                                        >
                                            {{ $adminName !== ''
                                                ? $adminName
                                                : 'Administrator' }}
                                        </p>

                                        <p
                                            class="mt-1 text-xs
                                                   text-slate-500"
                                        >
                                            Pengelola website
                                        </p>
                                    </div>
                                </div>
                            </td>

                            <td
                                class="px-6 py-4
                                       text-sm text-slate-600"
                            >
                                <span class="break-all">
                                    {{ $adminEmail }}
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                <span
                                    @class([
                                        'inline-flex rounded-full',
                                        'px-2.5 py-1 text-xs',
                                        'font-bold',
                                        'bg-amber-50 text-amber-700' =>
                                            $isCurrentAdmin,
                                        'bg-slate-100 text-slate-600' =>
                                            !$isCurrentAdmin,
                                    ])
                                >
                                    {{ $isCurrentAdmin
                                        ? 'Sedang digunakan'
                                        : 'Akun pengelola' }}
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                <div
                                    class="flex justify-end gap-2"
                                >
                                    <a
                                        href="{{ route(
                                            'admin.admin-users.edit',
                                            $admin
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
                                            'admin.admin-users.destroy',
                                            $admin
                                        ) }}"
                                        method="POST"
                                        onsubmit="return confirm(
                                            'Hapus akun pengelola ini? Tindakan ini tidak dapat dibatalkan.'
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
                                                    ? 'Akun terakhir tidak dapat dihapus.'
                                                    : 'Hapus akun') }}"
                                            class="inline-flex items-center
                                                   justify-center rounded-lg
                                                   bg-red-50 px-3 py-2
                                                   text-xs font-bold
                                                   text-red-600
                                                   hover:bg-red-100
                                                   disabled:cursor-not-allowed
                                                   disabled:opacity-40"
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
                                <p
                                    class="text-sm font-bold
                                           text-slate-700"
                                >
                                    Belum ada akun pengelola
                                </p>

                                <p
                                    class="mt-2 text-sm
                                           text-slate-500"
                                >
                                    Tambahkan akun pengelola
                                    terlebih dahulu.
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
                   md:hidden"
        >
            @forelse ($adminItems as $admin)
                @php
                    $adminName = trim(
                        (string) $admin->name
                    );

                    $adminEmail = trim(
                        (string) $admin->email
                    );

                    $adminInitial =
                        $adminName !== ''
                            ? mb_strtoupper(
                                mb_substr(
                                    $adminName,
                                    0,
                                    1
                                )
                            )
                            : 'A';

                    $isCurrentAdmin =
                        $currentAdminId
                        === (int) $admin->id;

                    $isLastAdmin =
                        $adminCount <= 1;

                    $cannotDelete =
                        $isCurrentAdmin
                        || $isLastAdmin;

                    $searchText =
                        \Illuminate\Support\Str::lower(
                            $adminName
                            . ' '
                            . $adminEmail
                        );
                @endphp


                <article
                    class="px-5 py-5 sm:px-6"
                    data-admin-card
                    data-search="{{ $searchText }}"
                >
                    <div class="flex items-start gap-3">
                        <div
                            @class([
                                'flex h-12 w-12 shrink-0',
                                'items-center justify-center',
                                'rounded-xl font-extrabold',
                                'bg-amber-50 text-amber-700' =>
                                    $isCurrentAdmin,
                                'bg-blue-50 text-[#075F9B]' =>
                                    !$isCurrentAdmin,
                            ])
                        >
                            {{ $adminInitial }}
                        </div>

                        <div class="min-w-0 flex-1">
                            <div
                                class="flex items-start
                                       justify-between gap-3"
                            >
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
                                        class="mt-1 break-all
                                               text-sm text-slate-500"
                                    >
                                        {{ $adminEmail }}
                                    </p>
                                </div>

                                @if ($isCurrentAdmin)
                                    <span
                                        class="inline-flex shrink-0
                                               rounded-full
                                               bg-amber-50
                                               px-2.5 py-1
                                               text-[10px] font-bold
                                               text-amber-700"
                                    >
                                        Digunakan
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>


                    <div
                        class="mt-4 grid
                               grid-cols-2 gap-2"
                    >
                        <a
                            href="{{ route(
                                'admin.admin-users.edit',
                                $admin
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
                                'admin.admin-users.destroy',
                                $admin
                            ) }}"
                            method="POST"
                            onsubmit="return confirm(
                                'Hapus akun pengelola ini? Tindakan ini tidak dapat dibatalkan.'
                            )"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                @disabled($cannotDelete)
                                class="inline-flex w-full
                                       items-center justify-center
                                       rounded-xl bg-red-50
                                       px-4 py-2.5
                                       text-sm font-bold
                                       text-red-600
                                       hover:bg-red-100
                                       disabled:cursor-not-allowed
                                       disabled:opacity-40"
                            >
                                Hapus
                            </button>
                        </form>
                    </div>

                    @if ($cannotDelete)
                        <p
                            class="mt-3 text-center
                                   text-xs text-slate-500"
                        >
                            {{ $isCurrentAdmin
                                ? 'Akun yang sedang digunakan tidak dapat dihapus.'
                                : 'Minimal satu akun pengelola harus tersedia.' }}
                        </p>
                    @endif
                </article>
            @empty
                <div class="px-6 py-12 text-center">
                    <p
                        class="text-sm font-bold
                               text-slate-700"
                    >
                        Belum ada akun pengelola
                    </p>
                </div>
            @endforelse
        </div>


        <div
            id="adminEmptySearch"
            class="hidden px-6 py-12 text-center"
        >
            <p
                class="text-sm font-bold
                       text-slate-700"
            >
                Akun tidak ditemukan
            </p>

            <p
                class="mt-2 text-sm
                       text-slate-500"
            >
                Coba gunakan kata pencarian lain.
            </p>
        </div>
    </section>
</div>


<script>
    document.addEventListener(
        'DOMContentLoaded',
        function () {
            const searchInput =
                document.getElementById(
                    'adminSearch'
                );

            const cards =
                Array.from(
                    document.querySelectorAll(
                        '[data-admin-card]'
                    )
                );

            const emptySearch =
                document.getElementById(
                    'adminEmptySearch'
                );

            if (!searchInput) {
                return;
            }

            function filterAdmins() {
                const keyword =
                    searchInput.value
                        .toLocaleLowerCase('id-ID')
                        .trim();

                let matches = 0;

                cards.forEach(
                    function (card) {
                        const searchText =
                            (
                                card.dataset.search
                                || ''
                            ).toLocaleLowerCase(
                                'id-ID'
                            );

                        const isMatch =
                            keyword === ''
                            || searchText.includes(
                                keyword
                            );

                        card.classList.toggle(
                            'hidden',
                            !isMatch
                        );

                        if (isMatch) {
                            matches++;
                        }
                    }
                );

                emptySearch?.classList.toggle(
                    'hidden',
                    cards.length === 0
                    || matches > 0
                );
            }

            searchInput.addEventListener(
                'input',
                filterAdmins
            );
        }
    );
</script>

@endsection
