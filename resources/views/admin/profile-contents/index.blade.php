@extends('layouts.admin')

@section('title', 'Konten Profil')

@section('content')

@php
    $totalSections = $sections->count();
    $activeSections = $sections->where('is_active', true)->count();
    $totalItems = $sections->sum('items_count');
@endphp

<div class="space-y-8">

    {{-- Header --}}
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

        <div>
            <h1 class="text-3xl md:text-4xl font-black text-slate-800">
                Konten Profil
            </h1>

            <p class="mt-3 text-slate-500 leading-7 max-w-4xl">
                Kelola konten profil Program Studi D-IV Teknik Mesin Produksi dan Perawatan, meliputi Visi Misi,
                Tujuan Prodi, Profil Profesional Mandiri, dan Capaian Pembelajaran Lulusan.
            </p>
        </div>

        <a href="{{ url('/profil') }}"
            target="_blank"
            class="inline-flex items-center justify-center gap-3 px-6 py-4 rounded-2xl bg-blue-700 text-white font-bold hover:bg-blue-800 transition shadow-lg shadow-blue-700/20">

            <svg xmlns="http://www.w3.org/2000/svg"
                class="w-5 h-5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">

                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />

                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>

            Lihat Halaman Profil
        </a>

    </div>


    {{-- Alert --}}
    @if (session('success'))
        <div class="rounded-2xl bg-green-50 border border-green-200 text-green-700 px-6 py-4 font-semibold">
            {{ session('success') }}
        </div>
    @endif


    {{-- Statistik --}}
    <div class="grid md:grid-cols-3 gap-6">

        <div class="rounded-[2rem] bg-white/95 backdrop-blur border border-slate-100 shadow-xl p-6">

            <div class="flex items-center justify-between gap-4">

                <div>
                    <p class="text-sm font-bold text-slate-500">
                        Total Bagian
                    </p>

                    <h2 class="mt-3 text-4xl font-black text-slate-800">
                        {{ $totalSections }}
                    </h2>
                </div>

                <div class="w-14 h-14 rounded-2xl bg-blue-700 text-white flex items-center justify-center shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-7 h-7"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h7" />
                    </svg>
                </div>

            </div>

        </div>

        <div class="rounded-[2rem] bg-white/95 backdrop-blur border border-slate-100 shadow-xl p-6">

            <div class="flex items-center justify-between gap-4">

                <div>
                    <p class="text-sm font-bold text-slate-500">
                        Konten Aktif
                    </p>

                    <h2 class="mt-3 text-4xl font-black text-slate-800">
                        {{ $activeSections }}
                    </h2>
                </div>

                <div class="w-14 h-14 rounded-2xl bg-green-600 text-white flex items-center justify-center shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-7 h-7"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M5 13l4 4L19 7" />
                    </svg>
                </div>

            </div>

        </div>

        <div class="rounded-[2rem] bg-white/95 backdrop-blur border border-slate-100 shadow-xl p-6">

            <div class="flex items-center justify-between gap-4">

                <div>
                    <p class="text-sm font-bold text-slate-500">
                        Total Item
                    </p>

                    <h2 class="mt-3 text-4xl font-black text-slate-800">
                        {{ $totalItems }}
                    </h2>
                </div>

                <div class="w-14 h-14 rounded-2xl bg-yellow-400 text-slate-900 flex items-center justify-center shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-7 h-7"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 12h6m-6 4h6M5 4h14a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V6a2 2 0 012-2z" />
                    </svg>
                </div>

            </div>

        </div>

    </div>


    {{-- Main Card --}}
    <div class="rounded-[2rem] bg-white/95 backdrop-blur border border-slate-100 shadow-xl overflow-hidden">

        <div class="h-2 bg-gradient-to-r from-blue-700 via-yellow-400 to-blue-700"></div>

        <div class="p-6 md:p-8 border-b border-slate-100">

            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

                <div>
                    <h2 class="text-2xl font-black text-slate-800">
                        Daftar Konten Profil
                    </h2>

                    <p class="mt-2 text-slate-500">
                        Pilih bagian konten yang ingin diperbarui.
                    </p>
                </div>

                <div class="relative w-full lg:w-96">

                    <input
                        type="text"
                        id="profileContentSearch"
                        placeholder="Cari konten profil..."
                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 pl-12 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z" />
                    </svg>

                </div>

            </div>

        </div>


        {{-- Cards --}}
        <div class="p-6 md:p-8">

            <div class="grid md:grid-cols-2 xl:grid-cols-4 gap-6">

                @forelse ($sections as $section)

                    <div
                        class="group relative rounded-[2rem] bg-slate-50 border border-slate-100 p-6 hover:-translate-y-1 hover:shadow-2xl transition-all duration-300 overflow-hidden"
                        data-profile-card
                        data-title="{{ strtolower($section->title) }}"
                        data-subtitle="{{ strtolower($section->subtitle ?? '') }}">

                        {{-- Ornament --}}
                        <div class="absolute -right-14 -top-14 w-32 h-32 rounded-full bg-blue-200/40 blur-2xl group-hover:bg-blue-300/60 transition"></div>
                        <div class="absolute -left-14 -bottom-14 w-32 h-32 rounded-full bg-yellow-200/40 blur-2xl group-hover:bg-yellow-300/60 transition"></div>

                        <div class="relative z-10">

                            <div class="flex items-start justify-between gap-4">

                                <div class="w-14 h-14 rounded-2xl bg-blue-700 text-white flex items-center justify-center shadow-lg">

                                    @if ($section->slug === 'visi-misi')
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="w-7 h-7"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor">

                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />

                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    @elseif ($section->slug === 'tujuan-prodi')
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="w-7 h-7"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor">

                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M12 8v4l3 3M12 3a9 9 0 100 18 9 9 0 000-18z" />
                                        </svg>
                                    @elseif ($section->slug === 'ppm')
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="w-7 h-7"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor">

                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M12 14l9-5-9-5-9 5 9 5z" />

                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M12 14l6.16-3.422A12.083 12.083 0 0112 21.5a12.083 12.083 0 01-6.16-10.922L12 14z" />
                                        </svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="w-7 h-7"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor">

                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M9 12h6m-6 4h6M5 4h14a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V6a2 2 0 012-2z" />
                                        </svg>
                                    @endif

                                </div>

                                @if ($section->is_active)
                                    <span class="inline-flex px-3 py-1 rounded-full bg-green-50 text-green-700 text-xs font-bold">
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-flex px-3 py-1 rounded-full bg-red-50 text-red-700 text-xs font-bold">
                                        Nonaktif
                                    </span>
                                @endif

                            </div>

                            <h3 class="mt-6 text-xl font-black text-slate-800">
                                {{ $section->title }}
                            </h3>

                            <p class="mt-3 text-sm text-slate-500 leading-6 min-h-[72px]">
                                {{ $section->subtitle ?? 'Konten profil program studi' }}
                            </p>

                            <div class="mt-6 grid grid-cols-2 gap-3">

                                <div class="rounded-2xl bg-white border border-slate-100 p-4">
                                    <p class="text-2xl font-black text-blue-700">
                                        {{ $section->items_count }}
                                    </p>

                                    <p class="mt-1 text-xs font-semibold text-slate-500">
                                        Item
                                    </p>
                                </div>

                                <div class="rounded-2xl bg-white border border-slate-100 p-4">
                                    <p class="text-2xl font-black text-yellow-500">
                                        {{ $section->sort_order }}
                                    </p>

                                    <p class="mt-1 text-xs font-semibold text-slate-500">
                                        Urutan
                                    </p>
                                </div>

                            </div>

                            <a href="{{ route('admin.profile-contents.edit', $section) }}"
                                class="mt-6 inline-flex w-full items-center justify-center rounded-2xl bg-blue-700 px-5 py-4 text-white font-bold hover:bg-blue-800 transition shadow-lg shadow-blue-700/20">

                                Edit Konten

                            </a>

                        </div>

                    </div>

                @empty

                    <div class="md:col-span-2 xl:col-span-4 rounded-3xl bg-slate-50 border border-slate-100 p-10 text-center">

                        <h3 class="text-xl font-bold text-slate-800">
                            Belum ada konten profil
                        </h3>

                        <p class="mt-2 text-slate-500">
                            Data konten profil belum tersedia.
                        </p>

                    </div>

                @endforelse

            </div>

            {{-- Empty Search --}}
            <div id="profileContentEmptySearch" class="hidden mt-6 rounded-3xl bg-slate-50 border border-slate-100 p-10 text-center">

                <h3 class="text-xl font-bold text-slate-800">
                    Konten tidak ditemukan
                </h3>

                <p class="mt-2 text-slate-500">
                    Coba gunakan kata kunci pencarian lain.
                </p>

            </div>

        </div>

    </div>

</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('profileContentSearch');
        const cards = document.querySelectorAll('[data-profile-card]');
        const emptySearch = document.getElementById('profileContentEmptySearch');

        if (!searchInput) {
            return;
        }

        searchInput.addEventListener('input', function () {
            const keyword = this.value.toLowerCase().trim();
            let visibleCount = 0;

            cards.forEach(function (card) {
                const title = card.dataset.title || '';
                const subtitle = card.dataset.subtitle || '';

                const isMatch =
                    title.includes(keyword) ||
                    subtitle.includes(keyword);

                card.style.display = isMatch ? '' : 'none';

                if (isMatch) {
                    visibleCount++;
                }
            });

            if (emptySearch) {
                emptySearch.classList.toggle('hidden', visibleCount > 0);
            }
        });
    });
</script>

@endsection