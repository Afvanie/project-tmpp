@extends('layouts.admin')

@section('title', 'Tambah Admin')

@section('content')

<div class="space-y-8">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div>
            <a href="{{ route('admin.admin-users.index') }}"
                class="inline-block text-sm text-blue-700 font-semibold hover:underline mb-3">
                ← Kembali ke Pengelola Admin
            </a>

            <h1 class="text-3xl font-black text-slate-800">
                Tambah Admin
            </h1>

            <p class="mt-2 text-slate-500">
                Tambahkan akun admin baru untuk mengelola website Program Studi D-III Teknik Mesin.
            </p>
        </div>

    </div>

    {{-- Error --}}
    @if ($errors->any())
        <div class="rounded-2xl bg-red-50 border border-red-200 text-red-700 px-6 py-4">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form --}}
    <div class="rounded-[2rem] bg-white/95 backdrop-blur border border-slate-100 shadow-xl overflow-hidden">

        <div class="h-2 bg-gradient-to-r from-blue-700 via-yellow-400 to-blue-700"></div>

        <form action="{{ route('admin.admin-users.store') }}" method="POST" class="p-7 md:p-8 space-y-6">
            @csrf

            <div>
                <h2 class="text-2xl font-bold text-slate-800">
                    Informasi Akun Admin
                </h2>

                <p class="mt-2 text-slate-500">
                    Email dan password ini akan digunakan untuk login ke halaman admin.
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-6">

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Nama Admin
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Contoh: Administrator"
                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="contoh@email.com"
                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                </div>

            </div>

            <div class="grid md:grid-cols-2 gap-6">

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        placeholder="Minimal 6 karakter"
                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Konfirmasi Password
                    </label>

                    <input
                        type="password"
                        name="password_confirmation"
                        placeholder="Ulangi password"
                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                </div>

            </div>

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 pt-4">

                <p class="text-sm text-slate-500">
                    Pastikan email belum digunakan oleh admin lain.
                </p>

                <button
                    type="submit"
                    class="inline-flex items-center justify-center px-7 py-4 rounded-2xl bg-blue-700 text-white font-bold hover:bg-blue-800 transition shadow-lg shadow-blue-700/20">
                    Simpan Admin
                </button>

            </div>

        </form>

    </div>

</div>

@endsection