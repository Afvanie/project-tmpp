@extends('layouts.admin')

@section('title', 'Edit Admin')

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
                Edit Admin
            </h1>

            <p class="mt-2 text-slate-500">
                Perbarui data akun admin pengelola website.
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

        <form action="{{ route('admin.admin-users.update', $adminUser) }}" method="POST" class="p-7 md:p-8 space-y-6">
            @csrf
            @method('PUT')

            <div class="flex items-center gap-4">

                <div class="w-16 h-16 rounded-2xl bg-blue-700 text-white flex items-center justify-center text-2xl font-black shadow-lg">
                    {{ strtoupper(substr($adminUser->name, 0, 1)) }}
                </div>

                <div>
                    <h2 class="text-2xl font-bold text-slate-800">
                        {{ $adminUser->name }}
                    </h2>

                    <p class="mt-1 text-slate-500">
                        {{ $adminUser->email }}
                    </p>
                </div>

            </div>

            <div class="grid md:grid-cols-2 gap-6">

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Nama Admin
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', $adminUser->name) }}"
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
                        value="{{ old('email', $adminUser->email) }}"
                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                </div>

            </div>

            <div class="rounded-3xl bg-slate-50 border border-slate-100 p-6">

                <h3 class="text-xl font-bold text-slate-800">
                    Ubah Password
                </h3>

                <p class="mt-2 text-slate-500">
                    Kosongkan password jika tidak ingin mengubah password lama.
                </p>

                <div class="grid md:grid-cols-2 gap-6 mt-6">

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Password Baru
                        </label>

                        <input
                            type="password"
                            name="password"
                            placeholder="Minimal 6 karakter"
                            class="w-full rounded-2xl border border-slate-200 bg-white px-5 py-4 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Konfirmasi Password Baru
                        </label>

                        <input
                            type="password"
                            name="password_confirmation"
                            placeholder="Ulangi password baru"
                            class="w-full rounded-2xl border border-slate-200 bg-white px-5 py-4 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                </div>

            </div>

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 pt-4">

                @if (auth('admin')->id() === $adminUser->id)
                    <span class="inline-flex px-4 py-2 rounded-full bg-yellow-50 text-yellow-700 text-sm font-bold">
                        Ini adalah akun yang sedang login
                    </span>
                @else
                    <span class="text-sm text-slate-500">
                        Data admin akan diperbarui setelah tombol simpan ditekan.
                    </span>
                @endif

                <button
                    type="submit"
                    class="inline-flex items-center justify-center px-7 py-4 rounded-2xl bg-blue-700 text-white font-bold hover:bg-blue-800 transition shadow-lg shadow-blue-700/20">
                    Simpan Perubahan
                </button>

            </div>

        </form>

    </div>

</div>

@endsection