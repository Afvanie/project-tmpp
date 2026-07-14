@extends('layouts.admin')

@section('title', 'Konten Beranda')

@section('content')

<div class="space-y-8">

    {{-- Header --}}
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-[#071B3A] via-[#0B3B75] to-[#071B3A] p-8 text-white shadow-xl">

        <div class="absolute -top-24 -right-24 w-72 h-72 rounded-full bg-yellow-300/20 blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 w-72 h-72 rounded-full bg-blue-300/20 blur-3xl"></div>

        <div class="relative flex flex-col md:flex-row md:items-center md:justify-between gap-6">

            <div>

                <span class="inline-flex px-4 py-1 rounded-full bg-yellow-400 text-slate-900 text-sm font-bold">
                    Beranda Website
                </span>

                <h1 class="mt-5 text-3xl md:text-4xl font-extrabold">
                    Konten Beranda
                </h1>

                <p class="mt-3 max-w-2xl text-blue-100 leading-7">
                    Kelola statistik program studi, deskripsi program studi, tombol, dan gambar yang tampil pada halaman utama website D-IV TMPP Polinema.
                </p>

            </div>

            <a href="{{ route('home') }}"
               target="_blank"
               class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-2xl bg-white text-blue-800 font-bold hover:bg-yellow-300 hover:text-slate-900 transition shadow-lg">

                Lihat Website
                <span>→</span>

            </a>

        </div>

    </div>


    {{-- Alert --}}
    @if (session('success'))
        <div class="rounded-2xl border border-green-100 bg-green-50 px-5 py-4 text-green-700 font-semibold shadow-sm">
            {{ session('success') }}
        </div>
    @endif


    {{-- Error --}}
    @if ($errors->any())
        <div class="rounded-2xl border border-red-100 bg-red-50 px-5 py-4 text-red-700 shadow-sm">

            <h3 class="font-bold mb-2">
                Ada data yang perlu diperbaiki:
            </h3>

            <ul class="list-disc list-inside space-y-1 text-sm">
                @foreach ($errors->all() as $error)
                    <li>
                        {{ $error }}
                    </li>
                @endforeach
            </ul>

        </div>
    @endif


    <form action="{{ route('admin.home-content.update') }}"
          method="POST"
          enctype="multipart/form-data"
          class="space-y-8">

        @csrf
        @method('PUT')


        {{-- Statistik --}}
        <div class="rounded-3xl bg-white border border-slate-100 shadow-sm overflow-hidden">

            <div class="px-6 py-5 border-b border-slate-100 flex flex-col md:flex-row md:items-center md:justify-between gap-3">

                <div>
                    <h2 class="text-xl font-extrabold text-slate-800">
                        Statistik Program Studi
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Kelola angka statistik singkat yang tampil di halaman beranda.
                    </p>
                </div>

                <span class="inline-flex w-fit px-4 py-2 rounded-full bg-blue-50 text-blue-700 text-sm font-bold">
                    {{ $statistics->count() }} Data
                </span>

            </div>

            <div class="p-6">

                <div class="overflow-x-auto rounded-2xl border border-slate-100">

                    <table class="w-full text-sm">

                        <thead class="bg-slate-50 text-slate-600">
                            <tr>
                                <th class="px-4 py-3 text-left font-bold w-32">
                                    Urutan
                                </th>

                                <th class="px-4 py-3 text-left font-bold">
                                    Label
                                </th>

                                <th class="px-4 py-3 text-left font-bold w-56">
                                    Angka / Nilai
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100 bg-white">

                            @foreach ($statistics as $statistic)

                                <tr class="hover:bg-slate-50 transition">

                                    {{-- Urutan paling kiri --}}
                                    <td class="px-4 py-3">
                                        <input type="number"
                                            name="statistics[{{ $statistic->id }}][sort_order]"
                                            value="{{ old('statistics.'.$statistic->id.'.sort_order', $statistic->sort_order) }}"
                                            class="w-full rounded-xl border border-slate-200 px-3 py-2 text-slate-800 font-semibold focus:border-blue-500 focus:ring-4 focus:ring-blue-100 outline-none transition">
                                    </td>

                                    {{-- Label di tengah --}}
                                    <td class="px-4 py-3">
                                        <input type="text"
                                            name="statistics[{{ $statistic->id }}][label]"
                                            value="{{ old('statistics.'.$statistic->id.'.label', $statistic->label) }}"
                                            class="w-full rounded-xl border border-slate-200 px-3 py-2 text-slate-800 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 outline-none transition">
                                    </td>

                                    {{-- Angka di kanan --}}
                                    <td class="px-4 py-3">
                                        <input type="text"
                                            name="statistics[{{ $statistic->id }}][value]"
                                            value="{{ old('statistics.'.$statistic->id.'.value', $statistic->value) }}"
                                            class="w-full rounded-xl border border-slate-200 px-3 py-2 text-slate-800 font-bold focus:border-blue-500 focus:ring-4 focus:ring-blue-100 outline-none transition">
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>


        {{-- Deskripsi Program Studi --}}
        <div class="rounded-3xl bg-white border border-slate-100 shadow-sm overflow-hidden">

            <div class="px-6 py-5 border-b border-slate-100">

                <h2 class="text-xl font-extrabold text-slate-800">
                    Deskripsi Program Studi
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Konten ini tampil pada section deskripsi program studi di halaman beranda.
                </p>

            </div>

            <div class="p-6">

                <div class="grid xl:grid-cols-12 gap-8">

                    {{-- Left Form --}}
                    <div class="xl:col-span-7 space-y-5">

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">
                                Badge Kecil
                            </label>

                            <input type="text"
                                   name="badge"
                                   value="{{ old('badge', $content->badge) }}"
                                   placeholder="Contoh: Program Studi"
                                   class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-slate-800 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 outline-none transition">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">
                                Judul Section
                            </label>

                            <input type="text"
                                   name="title"
                                   value="{{ old('title', $content->title) }}"
                                   placeholder="Contoh: Deskripsi Program Studi"
                                   class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-slate-800 font-bold focus:border-blue-500 focus:ring-4 focus:ring-blue-100 outline-none transition">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">
                                Deskripsi
                            </label>

                            <textarea name="description"
                                      rows="12"
                                      placeholder="Tulis deskripsi program studi..."
                                      class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-slate-800 leading-8 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 outline-none transition">{{ old('description', $content->description) }}</textarea>
                        </div>

                    </div>


                    {{-- Right Preview / Upload --}}
                    <div class="xl:col-span-5">

                        <div class="sticky top-28 space-y-5">

                            <div class="rounded-3xl border border-slate-100 bg-slate-50 p-5">

                                <label class="block text-sm font-bold text-slate-700 mb-3">
                                    Gambar Deskripsi
                                </label>

                                <input type="file"
                                       name="image"
                                       accept="image/*"
                                       class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-600 file:mr-4 file:rounded-xl file:border-0 file:bg-blue-700 file:px-4 file:py-2 file:text-white file:font-bold hover:file:bg-blue-800 transition">

                                <p class="mt-3 text-xs text-slate-500 leading-6">
                                    Format disarankan: JPG, PNG, atau WEBP. Ukuran maksimal 4MB.
                                </p>

                            </div>

                            <div class="rounded-3xl overflow-hidden border border-slate-100 bg-white shadow-sm">

                                <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">

                                    <h3 class="font-extrabold text-slate-800">
                                        Preview Gambar
                                    </h3>

                                    <span class="text-xs font-bold text-slate-400 uppercase">
                                        Beranda
                                    </span>

                                </div>

                                <div class="p-5">

                                    @if ($content->image)
                                        <img src="{{ asset('storage/'.$content->image) }}"
                                             alt="Preview"
                                             class="w-full h-72 object-cover rounded-2xl shadow">
                                    @else
                                        <img src="{{ asset('assets/images/about.png') }}"
                                             alt="Preview"
                                             class="w-full h-72 object-cover rounded-2xl shadow">
                                    @endif

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Sticky Submit --}}
        <div class="sticky bottom-5 z-20">

            <div class="rounded-3xl bg-white/90 backdrop-blur-xl border border-slate-200 shadow-2xl px-5 py-4 flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                <div>
                    <h3 class="font-extrabold text-slate-800">
                        Simpan perubahan konten beranda?
                    </h3>

                    <p class="text-sm text-slate-500 mt-1">
                        Perubahan akan langsung tampil di halaman utama website.
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row gap-3">

                    <a href="{{ route('home') }}"
                       target="_blank"
                       class="inline-flex items-center justify-center px-6 py-3 rounded-2xl bg-slate-100 text-slate-700 font-bold hover:bg-slate-200 transition">
                        Preview
                    </a>

                    <button type="submit"
                            class="inline-flex items-center justify-center px-7 py-3 rounded-2xl bg-blue-700 text-white font-bold hover:bg-blue-800 transition shadow-lg shadow-blue-700/20">
                        Simpan Perubahan
                    </button>

                </div>

            </div>

        </div>

    </form>

</div>

@endsection