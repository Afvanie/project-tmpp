@extends('layouts.admin')

@section('title', 'Pengelola Admin')

@section('content')

<div class="space-y-8">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div>
            <h1 class="text-3xl font-black text-slate-800">
                Pengelola Admin
            </h1>

            <p class="mt-2 text-slate-500">
                Kelola akun admin yang dapat mengakses panel pengelolaan website.
            </p>
        </div>

        <a href="{{ route('admin.admin-users.create') }}"
            class="inline-flex items-center justify-center gap-3 px-6 py-4 rounded-2xl bg-blue-700 text-white font-bold hover:bg-blue-800 transition shadow-lg shadow-blue-700/20">

            <svg xmlns="http://www.w3.org/2000/svg"
                class="w-5 h-5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">

                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 4v16m8-8H4" />
            </svg>

            Tambah Admin
        </a>

    </div>

    {{-- Alert Success --}}
    @if (session('success'))
        <div class="rounded-2xl bg-green-50 border border-green-200 text-green-700 px-6 py-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Alert Error --}}
    @if (session('error'))
        <div class="rounded-2xl bg-red-50 border border-red-200 text-red-700 px-6 py-4">
            {{ session('error') }}
        </div>
    @endif


    {{-- Admin List --}}
    <div class="rounded-[2rem] bg-white/95 backdrop-blur border border-slate-100 shadow-xl overflow-hidden">

        <div class="h-2 bg-gradient-to-r from-blue-700 via-yellow-400 to-blue-700"></div>

        <div class="p-6 md:p-8 border-b border-slate-100">

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                <div>
                    <h2 class="text-2xl font-bold text-slate-800">
                        Daftar Akun Admin
                    </h2>

                    <p class="mt-2 text-slate-500">
                        Total {{ $admins->count() }} akun admin terdaftar.
                    </p>
                </div>

                <div class="inline-flex items-center gap-3 px-5 py-3 rounded-2xl bg-slate-50 border border-slate-100">

                    <span class="text-3xl font-black text-blue-700">
                        {{ $admins->count() }}
                    </span>

                    <span class="text-sm font-semibold text-slate-500">
                        Admin
                    </span>

                </div>

            </div>

        </div>

        {{-- Desktop Table --}}
        <div class="hidden md:block overflow-x-auto">

            <table class="w-full">

                <thead class="bg-slate-50 border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">
                            Admin
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">
                            Email
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">
                            Status
                        </th>

                        <th class="px-6 py-4 text-right text-xs font-bold text-slate-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">

                    @forelse ($admins as $admin)

                        <tr class="hover:bg-slate-50/70 transition">

                            <td class="px-6 py-5">

                                <div class="flex items-center gap-4">

                                    <div class="w-12 h-12 rounded-2xl bg-blue-700 text-white flex items-center justify-center font-black shadow-lg">
                                        {{ strtoupper(substr($admin->name, 0, 1)) }}
                                    </div>

                                    <div>
                                        <h3 class="font-bold text-slate-800">
                                            {{ $admin->name }}
                                        </h3>

                                        <p class="text-sm text-slate-500 mt-1">
                                            Pengelola Website
                                        </p>
                                    </div>

                                </div>

                            </td>

                            <td class="px-6 py-5 text-slate-600">
                                {{ $admin->email }}
                            </td>

                            <td class="px-6 py-5">

                                @if (auth('admin')->id() === $admin->id)
                                    <span class="inline-flex px-3 py-1 rounded-full bg-yellow-50 text-yellow-700 text-xs font-bold">
                                        Sedang Login
                                    </span>
                                @else
                                    <span class="inline-flex px-3 py-1 rounded-full bg-green-50 text-green-700 text-xs font-bold">
                                        Aktif
                                    </span>
                                @endif

                            </td>

                            <td class="px-6 py-5">

                                <div class="flex items-center justify-end gap-3">

                                    <a href="{{ route('admin.admin-users.edit', $admin) }}"
                                        class="px-4 py-2 rounded-xl bg-blue-50 text-blue-700 text-sm font-bold hover:bg-blue-700 hover:text-white transition">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.admin-users.destroy', $admin) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus admin ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="px-4 py-2 rounded-xl bg-red-50 text-red-700 text-sm font-bold hover:bg-red-600 hover:text-white transition"
                                            {{ auth('admin')->id() === $admin->id ? 'disabled' : '' }}>
                                            Hapus
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center">

                                <h3 class="text-xl font-bold text-slate-800">
                                    Belum ada admin
                                </h3>

                                <p class="mt-2 text-slate-500">
                                    Tambahkan akun admin pengelola website terlebih dahulu.
                                </p>

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Mobile Cards --}}
        <div class="md:hidden p-5 space-y-4">

            @forelse ($admins as $admin)

                <div class="rounded-3xl bg-slate-50 border border-slate-100 p-5">

                    <div class="flex items-start gap-4">

                        <div class="w-12 h-12 rounded-2xl bg-blue-700 text-white flex items-center justify-center font-black shadow-lg shrink-0">
                            {{ strtoupper(substr($admin->name, 0, 1)) }}
                        </div>

                        <div class="min-w-0 flex-1">

                            <h3 class="font-bold text-slate-800">
                                {{ $admin->name }}
                            </h3>

                            <p class="mt-1 text-sm text-slate-500 break-all">
                                {{ $admin->email }}
                            </p>

                            <div class="mt-3">

                                @if (auth('admin')->id() === $admin->id)
                                    <span class="inline-flex px-3 py-1 rounded-full bg-yellow-50 text-yellow-700 text-xs font-bold">
                                        Sedang Login
                                    </span>
                                @else
                                    <span class="inline-flex px-3 py-1 rounded-full bg-green-50 text-green-700 text-xs font-bold">
                                        Aktif
                                    </span>
                                @endif

                            </div>

                        </div>

                    </div>

                    <div class="grid grid-cols-2 gap-3 mt-5">

                        <a href="{{ route('admin.admin-users.edit', $admin) }}"
                            class="px-4 py-3 rounded-xl bg-blue-700 text-white text-center text-sm font-bold hover:bg-blue-800 transition">
                            Edit
                        </a>

                        <form action="{{ route('admin.admin-users.destroy', $admin) }}"
                            method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus admin ini?')">

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="w-full px-4 py-3 rounded-xl bg-red-600 text-white text-sm font-bold hover:bg-red-700 transition disabled:opacity-50 disabled:cursor-not-allowed"
                                {{ auth('admin')->id() === $admin->id ? 'disabled' : '' }}>
                                Hapus
                            </button>

                        </form>

                    </div>

                </div>

            @empty

                <div class="rounded-3xl bg-slate-50 border border-slate-100 p-8 text-center">

                    <h3 class="text-xl font-bold text-slate-800">
                        Belum ada admin
                    </h3>

                    <p class="mt-2 text-slate-500">
                        Tambahkan akun admin terlebih dahulu.
                    </p>

                </div>

            @endforelse

        </div>

    </div>

</div>

@endsection