@extends('layouts.admin')

@section('title', 'Edit Konten Profil')

@section('content')

@php
    $isOverviewSection = $profileSection->slug === 'overview';
    $isHistorySection = $profileSection->slug === 'history';

    /*
    |--------------------------------------------------------------------------
    | Overview / Profil Singkat
    |--------------------------------------------------------------------------
    */

    $overviewLabelItem = $profileSection->items
        ->where('item_group', 'label')
        ->sortBy('sort_order')
        ->first();

    $overviewParagraphItems = $profileSection->items
        ->where('item_group', 'paragraph')
        ->sortBy('sort_order');

    $overviewInfoCards = $profileSection->items
        ->where('item_group', 'info_card')
        ->sortBy('sort_order');


    /*
    |--------------------------------------------------------------------------
    | History / Perjalanan Program Studi
    |--------------------------------------------------------------------------
    */

    $paragraphItems = $profileSection->items
        ->where('item_group', 'paragraph')
        ->sortBy('sort_order');

    $timelineItems = $profileSection->items
        ->where('item_group', 'timeline')
        ->sortBy('sort_order');
@endphp

<div class="space-y-8">

    {{-- Header --}}
    <div class="relative overflow-hidden rounded-[2rem] bg-gradient-to-r from-[#071B3A] via-[#0B3B75] to-[#071B3A] p-7 md:p-8 text-white shadow-xl">

        <div class="absolute -top-24 -right-24 w-72 h-72 rounded-full bg-yellow-300/20 blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 w-72 h-72 rounded-full bg-blue-300/20 blur-3xl"></div>

        <div class="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

            <div>

                <a href="{{ route('admin.profile-contents.index') }}"
                   class="inline-flex items-center text-sm font-bold text-yellow-300 hover:text-yellow-200 mb-4">
                    ← Kembali ke Konten Profil
                </a>

                <span class="inline-flex px-4 py-1 rounded-full bg-yellow-400 text-slate-900 text-sm font-bold">
                    Konten Profil
                </span>

                <h1 class="mt-5 text-3xl md:text-4xl font-black leading-tight">
                    Edit {{ $profileSection->title }}
                </h1>

                <p class="mt-3 text-blue-100 leading-7 max-w-4xl">
                    Kelola konten halaman profil Program Studi D-IV Teknik Mesin Produksi dan Perawatan Polinema.

                    @if ($isOverviewSection)
                        Section ini mengatur bagian Profil Singkat yang tampil di awal halaman profil.
                    @elseif ($isHistorySection)
                        Section ini mengatur bagian Perjalanan Program Studi, yaitu paragraf kiri dan kartu timeline kanan.
                    @else
                        Kelola judul section, deskripsi, status tampil, serta item konten yang muncul pada halaman profil.
                    @endif
                </p>

            </div>

            <a href="{{ route('profile') }}"
               target="_blank"
               class="inline-flex items-center justify-center gap-3 px-6 py-4 rounded-2xl bg-white text-blue-800 font-bold hover:bg-yellow-300 hover:text-slate-900 transition shadow-lg">

                Lihat Halaman Profil
                <span>→</span>

            </a>

        </div>

    </div>


    {{-- Alert Success --}}
    @if (session('success'))
        <div class="rounded-2xl bg-green-50 border border-green-200 text-green-700 px-6 py-4 font-semibold">
            {{ session('success') }}
        </div>
    @endif


    {{-- Error --}}
    @if ($errors->any())
        <div class="rounded-2xl bg-red-50 border border-red-200 text-red-700 px-6 py-4">

            <strong class="font-black">
                Terjadi kesalahan:
            </strong>

            <ul class="mt-2 list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>
                        {{ $error }}
                    </li>
                @endforeach
            </ul>

        </div>
    @endif


    {{-- ===================================================== --}}
    {{-- INFORMASI SECTION --}}
    {{-- ===================================================== --}}

    <div class="rounded-[2rem] bg-white border border-slate-100 shadow-xl overflow-hidden">

        <div class="h-2 bg-gradient-to-r from-blue-700 via-yellow-400 to-blue-700"></div>

        <form action="{{ route('admin.profile-contents.update', $profileSection) }}"
              method="POST"
              class="p-7 md:p-8 space-y-7">

            @csrf
            @method('PUT')

            <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-6">

                <div>

                    <h2 class="text-2xl font-black text-slate-800">
                        Informasi Utama Section
                    </h2>

                    <p class="mt-2 text-slate-500 leading-7">

                        @if ($isOverviewSection)
                            Bagian ini mengatur label kecil, judul utama, dan judul konten kanan
                            pada section Profil Singkat.
                        @elseif ($isHistorySection)
                            Bagian ini mengatur label kecil, judul utama, dan deskripsi pendek
                            yang tampil di atas section Perjalanan Program Studi.
                        @else
                            Bagian ini digunakan untuk mengatur judul, subjudul, deskripsi,
                            urutan, dan status tampil section profil.
                        @endif

                    </p>

                </div>

                <div>

                    @if ($profileSection->is_active)
                        <span class="inline-flex px-4 py-2 rounded-full bg-green-50 text-green-700 text-sm font-bold">
                            Aktif
                        </span>
                    @else
                        <span class="inline-flex px-4 py-2 rounded-full bg-red-50 text-red-700 text-sm font-bold">
                            Nonaktif
                        </span>
                    @endif

                </div>

            </div>

            <div class="grid md:grid-cols-2 gap-6">

                <div>

                    <label class="block text-sm font-bold text-slate-700 mb-2">
                        @if ($isOverviewSection)
                            Judul Utama Section
                        @elseif ($isHistorySection)
                            Judul Utama Section
                        @else
                            Judul Section
                        @endif
                    </label>

                    <input type="text"
                           name="title"
                           value="{{ old('title', $profileSection->title) }}"
                           class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>

                    @if ($isOverviewSection)
                        <p class="mt-2 text-xs text-slate-500">
                            Contoh: Mengenal Program Studi D-IV Teknik Mesin Produksi dan Perawatan
                        </p>
                    @endif

                </div>

                <div>

                    <label class="block text-sm font-bold text-slate-700 mb-2">
                        @if ($isOverviewSection)
                            Label Kecil Atas
                        @elseif ($isHistorySection)
                            Label Kecil Atas
                        @else
                            Subjudul
                        @endif
                    </label>

                    <input type="text"
                           name="subtitle"
                           value="{{ old('subtitle', $profileSection->subtitle) }}"
                           class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">

                    @if ($isOverviewSection)
                        <p class="mt-2 text-xs text-slate-500">
                            Contoh: TENTANG KAMI
                        </p>
                    @endif

                </div>

            </div>

            <div class="grid md:grid-cols-2 gap-6">

                <div>

                    <label class="block text-sm font-bold text-slate-700 mb-2">
                        Urutan Section
                    </label>

                    <input type="number"
                           name="sort_order"
                           value="{{ old('sort_order', $profileSection->sort_order) }}"
                           class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">

                </div>

                <div class="rounded-3xl bg-blue-50 border border-blue-100 p-5">

                    <label class="flex items-start gap-4 cursor-pointer">

                        <input type="checkbox"
                               name="is_active"
                               value="1"
                               class="mt-1 w-5 h-5 rounded border-slate-300 text-blue-700 focus:ring-blue-500"
                               {{ old('is_active', $profileSection->is_active) ? 'checked' : '' }}>

                        <div>

                            <h3 class="font-black text-slate-800">
                                Tampilkan section ini
                            </h3>

                            <p class="mt-1 text-sm text-slate-500 leading-6">
                                Jika aktif, section ini akan tampil pada halaman profil website.
                            </p>

                        </div>

                    </label>

                </div>

            </div>

            <div>

                <label class="block text-sm font-bold text-slate-700 mb-2">
                    @if ($isOverviewSection)
                        Judul Konten Kanan
                    @elseif ($isHistorySection)
                        Deskripsi Pendek di Bawah Judul
                    @else
                        Deskripsi Section
                    @endif
                </label>

                <textarea name="description"
                          rows="5"
                          class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 leading-8 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description', $profileSection->description) }}</textarea>

                @if ($isOverviewSection)
                    <p class="mt-2 text-xs text-slate-500">
                        Contoh: Pendidikan Vokasi Teknik Mesin yang Berorientasi pada Kebutuhan Industri
                    </p>
                @endif

            </div>

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 pt-6 border-t border-slate-100">

                <p class="text-sm text-slate-500">
                    Simpan bagian ini jika mengubah judul, label, deskripsi, urutan, atau status tampil.
                </p>

                <button type="submit"
                        class="inline-flex items-center justify-center px-7 py-4 rounded-2xl bg-blue-700 text-white font-bold hover:bg-blue-800 transition shadow-lg shadow-blue-700/20">
                    Simpan Informasi Section
                </button>

            </div>

        </form>

    </div>


    {{-- ===================================================== --}}
    {{-- OVERVIEW / PROFIL SINGKAT --}}
    {{-- ===================================================== --}}

    @if ($isOverviewSection)

        {{-- Panduan Overview --}}
        <div class="rounded-[2rem] bg-yellow-50 border border-yellow-100 p-6">

            <h2 class="text-xl font-black text-slate-800">
                Panduan Pengisian Profil Singkat
            </h2>

            <p class="mt-3 text-slate-600 leading-7">
                Section ini mengatur bagian pertama pada halaman profil. Admin cukup mengisi
                label konten, paragraf profil, dan kartu informasi. Tidak perlu mengisi kode teknis.
            </p>

        </div>


        {{-- Label Konten Kanan --}}
        <div class="rounded-[2rem] bg-white border border-slate-100 shadow-xl overflow-hidden">

            <div class="h-2 bg-gradient-to-r from-blue-700 to-yellow-400"></div>

            <div class="p-6 md:p-8 border-b border-slate-100">

                <h2 class="text-2xl font-black text-slate-800">
                    Label Konten Profil
                </h2>

                <p class="mt-2 text-slate-500 leading-7">
                    Label kecil yang tampil di atas judul konten kanan, misalnya “PROFIL SINGKAT”.
                </p>

            </div>

            <div class="p-6 md:p-8">

                @if ($overviewLabelItem)

                    <form action="{{ route('admin.profile-contents.items.update', $overviewLabelItem) }}"
                          method="POST"
                          class="space-y-5">

                        @csrf
                        @method('PUT')

                        <input type="hidden" name="item_group" value="label">
                        <input type="hidden" name="title" value="Label Konten">
                        <input type="hidden" name="sort_order" value="{{ $overviewLabelItem->sort_order }}">
                        <input type="hidden" name="is_active" value="1">

                        <div>

                            <label class="block text-sm font-bold text-slate-700 mb-2">
                                Label Konten
                            </label>

                            <input type="text"
                                   name="content"
                                   value="{{ old('content', $overviewLabelItem->content) }}"
                                   placeholder="Contoh: PROFIL SINGKAT"
                                   class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   required>

                        </div>

                        <button type="submit"
                                class="inline-flex items-center justify-center px-6 py-3 rounded-xl bg-blue-700 text-white font-bold hover:bg-blue-800 transition">
                            Simpan Label
                        </button>

                    </form>

                @else

                    <form action="{{ route('admin.profile-contents.items.store', $profileSection) }}"
                          method="POST"
                          class="space-y-5">

                        @csrf

                        <input type="hidden" name="item_group" value="label">
                        <input type="hidden" name="title" value="Label Konten">
                        <input type="hidden" name="sort_order" value="1">
                        <input type="hidden" name="is_active" value="1">

                        <div>

                            <label class="block text-sm font-bold text-slate-700 mb-2">
                                Label Konten
                            </label>

                            <input type="text"
                                   name="content"
                                   value="PROFIL SINGKAT"
                                   class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   required>

                        </div>

                        <button type="submit"
                                class="inline-flex items-center justify-center px-6 py-3 rounded-xl bg-green-600 text-white font-bold hover:bg-green-700 transition">
                            Buat Label
                        </button>

                    </form>

                @endif

            </div>

        </div>


        {{-- Paragraf Profil Singkat --}}
        <div class="rounded-[2rem] bg-white border border-slate-100 shadow-xl overflow-hidden">

            <div class="h-2 bg-gradient-to-r from-blue-700 to-blue-500"></div>

            <div class="p-6 md:p-8 border-b border-slate-100">

                <h2 class="text-2xl font-black text-slate-800">
                    Paragraf Profil Singkat
                </h2>

                <p class="mt-2 text-slate-500 leading-7">
                    Isi teks penjelasan yang tampil di sebelah kanan gambar pada halaman profil.
                </p>

            </div>

            <div class="p-6 md:p-8 space-y-6">

                @forelse ($overviewParagraphItems as $item)

                    <div class="rounded-[2rem] bg-slate-50 border border-slate-100 p-6">

                        <form action="{{ route('admin.profile-contents.items.update', $item) }}"
                              method="POST"
                              class="space-y-5">

                            @csrf
                            @method('PUT')

                            <input type="hidden" name="item_group" value="paragraph">
                            <input type="hidden" name="title" value="{{ $item->title }}">
                            <input type="hidden" name="is_active" value="0">

                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                                <div class="flex items-center gap-4">

                                    <div class="w-12 h-12 rounded-2xl bg-blue-700 text-white flex items-center justify-center font-black shadow-lg">
                                        {{ $loop->iteration }}
                                    </div>

                                    <div>

                                        <h3 class="text-lg font-black text-slate-800">
                                            Paragraf {{ $loop->iteration }}
                                        </h3>

                                        <p class="text-sm text-slate-500">
                                            Tampil sebagai teks profil singkat.
                                        </p>

                                    </div>

                                </div>

                                <div class="flex items-center gap-3">

                                    <label class="flex items-center gap-2 text-sm font-bold text-slate-600 cursor-pointer">

                                        <input type="checkbox"
                                               name="is_active"
                                               value="1"
                                               class="w-5 h-5 rounded border-slate-300 text-blue-700 focus:ring-blue-500"
                                               {{ old('is_active', $item->is_active) ? 'checked' : '' }}>

                                        Tampilkan

                                    </label>

                                    <input type="number"
                                           name="sort_order"
                                           value="{{ old('sort_order', $item->sort_order) }}"
                                           class="w-24 rounded-xl border border-slate-200 bg-white px-3 py-2 text-center focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           title="Urutan">

                                </div>

                            </div>

                            <div>

                                <label class="block text-sm font-bold text-slate-700 mb-2">
                                    Isi Paragraf
                                </label>

                                <textarea name="content"
                                          rows="6"
                                          class="w-full rounded-2xl border border-slate-200 bg-white px-5 py-4 leading-8 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                          required>{{ old('content', $item->content) }}</textarea>

                            </div>

                            <div class="pt-4 border-t border-slate-200">

                                <button type="submit"
                                        class="inline-flex items-center justify-center px-6 py-3 rounded-xl bg-blue-700 text-white font-bold hover:bg-blue-800 transition">
                                    Simpan Paragraf
                                </button>

                            </div>

                        </form>

                        <form action="{{ route('admin.profile-contents.items.destroy', $item) }}"
                              method="POST"
                              class="mt-4"
                              onsubmit="return confirm('Yakin ingin menghapus paragraf ini?')">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="inline-flex items-center justify-center px-6 py-3 rounded-xl bg-red-50 text-red-700 font-bold hover:bg-red-600 hover:text-white transition">
                                Hapus Paragraf
                            </button>

                        </form>

                    </div>

                @empty

                    <div class="rounded-3xl bg-slate-50 border border-slate-100 p-8 text-center">

                        <h3 class="text-xl font-bold text-slate-800">
                            Belum ada paragraf
                        </h3>

                        <p class="mt-2 text-slate-500">
                            Tambahkan paragraf melalui form di bawah.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>


        {{-- Tambah Paragraf Overview --}}
        <div class="rounded-[2rem] bg-white border border-slate-100 shadow-xl overflow-hidden">

            <div class="h-2 bg-gradient-to-r from-green-600 to-blue-700"></div>

            <form action="{{ route('admin.profile-contents.items.store', $profileSection) }}"
                  method="POST"
                  class="p-7 md:p-8 space-y-5">

                @csrf

                <input type="hidden" name="item_group" value="paragraph">
                <input type="hidden" name="title" value="">
                <input type="hidden" name="is_active" value="1">

                <div>

                    <h2 class="text-2xl font-black text-slate-800">
                        Tambah Paragraf Profil
                    </h2>

                    <p class="mt-2 text-slate-500">
                        Paragraf baru akan tampil di bagian teks profil singkat.
                    </p>

                </div>

                <div>

                    <label class="block text-sm font-bold text-slate-700 mb-2">
                        Urutan
                    </label>

                    <input type="number"
                           name="sort_order"
                           value="{{ $overviewParagraphItems->count() + 1 }}"
                           class="w-full md:w-48 rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">

                </div>

                <div>

                    <label class="block text-sm font-bold text-slate-700 mb-2">
                        Isi Paragraf
                    </label>

                    <textarea name="content"
                              rows="6"
                              class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 leading-8 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                              required></textarea>

                </div>

                <button type="submit"
                        class="inline-flex items-center justify-center px-7 py-4 rounded-2xl bg-green-600 text-white font-bold hover:bg-green-700 transition shadow-lg shadow-green-600/20">
                    Tambah Paragraf
                </button>

            </form>

        </div>


        {{-- Kartu Informasi --}}
        <div class="rounded-[2rem] bg-white border border-slate-100 shadow-xl overflow-hidden">

            <div class="h-2 bg-gradient-to-r from-yellow-400 to-blue-700"></div>

            <div class="p-6 md:p-8 border-b border-slate-100">

                <h2 class="text-2xl font-black text-slate-800">
                    Kartu Informasi
                </h2>

                <p class="mt-2 text-slate-500 leading-7">
                    Kartu informasi yang tampil di bawah gambar, seperti Jenjang Pendidikan, Akreditasi, Gelar Lulusan, dan Masa Studi.
                </p>

            </div>

            <div class="p-6 md:p-8 space-y-6">

                @forelse ($overviewInfoCards as $item)

                    @php
                        $parts = explode('|', $item->content);
                        $cardValue = trim($parts[0] ?? '');
                        $cardDescription = trim($parts[1] ?? '');
                    @endphp

                    <div class="rounded-[2rem] bg-slate-50 border border-slate-100 p-6">

                        <form action="{{ route('admin.profile-contents.items.update', $item) }}"
                              method="POST"
                              class="space-y-5 js-info-card-form">

                            @csrf
                            @method('PUT')

                            <input type="hidden" name="item_group" value="info_card">
                            <input type="hidden" name="is_active" value="0">
                            <input type="hidden" name="content" class="js-info-card-content" value="{{ $item->content }}">

                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                                <div class="flex items-center gap-4">

                                    <div class="w-12 h-12 rounded-2xl
                                        {{ $loop->iteration % 2 === 0 ? 'bg-yellow-400' : 'bg-blue-700' }}
                                        text-white flex items-center justify-center font-black shadow-lg">
                                        {{ $loop->iteration }}
                                    </div>

                                    <div>

                                        <h3 class="text-lg font-black text-slate-800">
                                            Kartu Informasi {{ $loop->iteration }}
                                        </h3>

                                        <p class="text-sm text-slate-500">
                                            Tampil di bawah gambar profil.
                                        </p>

                                    </div>

                                </div>

                                <div class="flex items-center gap-3">

                                    <label class="flex items-center gap-2 text-sm font-bold text-slate-600 cursor-pointer">

                                        <input type="checkbox"
                                               name="is_active"
                                               value="1"
                                               class="w-5 h-5 rounded border-slate-300 text-blue-700 focus:ring-blue-500"
                                               {{ old('is_active', $item->is_active) ? 'checked' : '' }}>

                                        Tampilkan

                                    </label>

                                    <input type="number"
                                           name="sort_order"
                                           value="{{ old('sort_order', $item->sort_order) }}"
                                           class="w-24 rounded-xl border border-slate-200 bg-white px-3 py-2 text-center focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           title="Urutan">

                                </div>

                            </div>

                            <div class="grid md:grid-cols-3 gap-5">

                                <div>

                                    <label class="block text-sm font-bold text-slate-700 mb-2">
                                        Angka / Nilai Besar
                                    </label>

                                    <input type="text"
                                           data-card-value
                                           value="{{ $cardValue }}"
                                           placeholder="Contoh: D-III"
                                           class="w-full rounded-2xl border border-slate-200 bg-white px-5 py-4 focus:outline-none focus:ring-2 focus:ring-blue-500">

                                </div>

                                <div>

                                    <label class="block text-sm font-bold text-slate-700 mb-2">
                                        Label Kartu
                                    </label>

                                    <input type="text"
                                           name="title"
                                           value="{{ old('title', $item->title) }}"
                                           placeholder="Contoh: Jenjang Pendidikan"
                                           class="w-full rounded-2xl border border-slate-200 bg-white px-5 py-4 focus:outline-none focus:ring-2 focus:ring-blue-500">

                                </div>

                                <div>

                                    <label class="block text-sm font-bold text-slate-700 mb-2">
                                        Deskripsi Kecil
                                    </label>

                                    <input type="text"
                                           data-card-description
                                           value="{{ $cardDescription }}"
                                           placeholder="Contoh: Diploma Empat"
                                           class="w-full rounded-2xl border border-slate-200 bg-white px-5 py-4 focus:outline-none focus:ring-2 focus:ring-blue-500">

                                </div>

                            </div>

                            <div class="pt-4 border-t border-slate-200">

                                <button type="submit"
                                        class="inline-flex items-center justify-center px-6 py-3 rounded-xl bg-blue-700 text-white font-bold hover:bg-blue-800 transition">
                                    Simpan Kartu
                                </button>

                            </div>

                        </form>

                        <form action="{{ route('admin.profile-contents.items.destroy', $item) }}"
                              method="POST"
                              class="mt-4"
                              onsubmit="return confirm('Yakin ingin menghapus kartu informasi ini?')">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="inline-flex items-center justify-center px-6 py-3 rounded-xl bg-red-50 text-red-700 font-bold hover:bg-red-600 hover:text-white transition">
                                Hapus Kartu
                            </button>

                        </form>

                    </div>

                @empty

                    <div class="rounded-3xl bg-slate-50 border border-slate-100 p-8 text-center">

                        <h3 class="text-xl font-bold text-slate-800">
                            Belum ada kartu informasi
                        </h3>

                        <p class="mt-2 text-slate-500">
                            Tambahkan kartu informasi melalui form di bawah.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>


        {{-- Tambah Kartu Informasi --}}
        <div class="rounded-[2rem] bg-white border border-slate-100 shadow-xl overflow-hidden">

            <div class="h-2 bg-gradient-to-r from-green-600 to-yellow-400"></div>

            <form action="{{ route('admin.profile-contents.items.store', $profileSection) }}"
                  method="POST"
                  class="p-7 md:p-8 space-y-5 js-info-card-form">

                @csrf

                <input type="hidden" name="item_group" value="info_card">
                <input type="hidden" name="is_active" value="1">
                <input type="hidden" name="content" class="js-info-card-content">

                <div>

                    <h2 class="text-2xl font-black text-slate-800">
                        Tambah Kartu Informasi Baru
                    </h2>

                    <p class="mt-2 text-slate-500">
                        Kartu baru akan tampil di bawah gambar profil.
                    </p>

                </div>

                <div class="grid md:grid-cols-4 gap-5">

                    <div>

                        <label class="block text-sm font-bold text-slate-700 mb-2">
                            Angka / Nilai Besar
                        </label>

                        <input type="text"
                               data-card-value
                               placeholder="Contoh: D-III"
                               class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">

                    </div>

                    <div>

                        <label class="block text-sm font-bold text-slate-700 mb-2">
                            Label Kartu
                        </label>

                        <input type="text"
                               name="title"
                               placeholder="Contoh: Jenjang Pendidikan"
                               class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">

                    </div>

                    <div>

                        <label class="block text-sm font-bold text-slate-700 mb-2">
                            Deskripsi Kecil
                        </label>

                        <input type="text"
                               data-card-description
                               placeholder="Contoh: Diploma Empat"
                               class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">

                    </div>

                    <div>

                        <label class="block text-sm font-bold text-slate-700 mb-2">
                            Urutan
                        </label>

                        <input type="number"
                               name="sort_order"
                               value="{{ $overviewInfoCards->count() + 1 }}"
                               class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">

                    </div>

                </div>

                <button type="submit"
                        class="inline-flex items-center justify-center px-7 py-4 rounded-2xl bg-green-600 text-white font-bold hover:bg-green-700 transition shadow-lg shadow-green-600/20">
                    Tambah Kartu Informasi
                </button>

            </form>

        </div>


    {{-- ===================================================== --}}
    {{-- HISTORY / PERJALANAN PROGRAM STUDI --}}
    {{-- ===================================================== --}}

    @elseif ($isHistorySection)

        {{-- Panduan History --}}
        <div class="rounded-[2rem] bg-yellow-50 border border-yellow-100 p-6">

            <h2 class="text-xl font-black text-slate-800">
                Panduan Pengisian Perjalanan Program Studi
            </h2>

            <p class="mt-3 text-slate-600 leading-7">
                Section ini terbagi menjadi dua bagian. <strong>Paragraf Kiri</strong> tampil sebagai teks narasi
                di sebelah kiri. <strong>Kartu Timeline Kanan</strong> tampil sebagai kartu bernomor di sebelah kanan.
                Admin tidak perlu mengisi kode teknis seperti group atau slug.
            </p>

        </div>


        {{-- Paragraf Kiri --}}
        <div class="rounded-[2rem] bg-white border border-slate-100 shadow-xl overflow-hidden">

            <div class="h-2 bg-gradient-to-r from-blue-700 to-blue-500"></div>

            <div class="p-6 md:p-8 border-b border-slate-100">

                <h2 class="text-2xl font-black text-slate-800">
                    Paragraf Kiri
                </h2>

                <p class="mt-2 text-slate-500 leading-7">
                    Isi bagian narasi panjang yang tampil di sisi kiri section Perjalanan Program Studi.
                </p>

            </div>

            <div class="p-6 md:p-8 space-y-6">

                @forelse ($paragraphItems as $item)

                    <div class="rounded-[2rem] bg-slate-50 border border-slate-100 p-6">

                        <form action="{{ route('admin.profile-contents.items.update', $item) }}"
                              method="POST"
                              class="space-y-5">

                            @csrf
                            @method('PUT')

                            <input type="hidden" name="item_group" value="paragraph">
                            <input type="hidden" name="title" value="{{ $item->title }}">
                            <input type="hidden" name="is_active" value="0">

                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                                <div class="flex items-center gap-4">

                                    <div class="w-12 h-12 rounded-2xl bg-blue-700 text-white flex items-center justify-center font-black shadow-lg">
                                        {{ $loop->iteration }}
                                    </div>

                                    <div>

                                        <h3 class="text-lg font-black text-slate-800">
                                            Paragraf {{ $loop->iteration }}
                                        </h3>

                                        <p class="text-sm text-slate-500">
                                            Tampil di sisi kiri halaman profil.
                                        </p>

                                    </div>

                                </div>

                                <div class="flex items-center gap-3">

                                    <label class="flex items-center gap-2 text-sm font-bold text-slate-600 cursor-pointer">

                                        <input type="checkbox"
                                               name="is_active"
                                               value="1"
                                               class="w-5 h-5 rounded border-slate-300 text-blue-700 focus:ring-blue-500"
                                               {{ old('is_active', $item->is_active) ? 'checked' : '' }}>

                                        Tampilkan

                                    </label>

                                    <input type="number"
                                           name="sort_order"
                                           value="{{ old('sort_order', $item->sort_order) }}"
                                           class="w-24 rounded-xl border border-slate-200 bg-white px-3 py-2 text-center focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           title="Urutan">

                                </div>

                            </div>

                            <div>

                                <label class="block text-sm font-bold text-slate-700 mb-2">
                                    Isi Paragraf
                                </label>

                                <textarea name="content"
                                          rows="6"
                                          class="w-full rounded-2xl border border-slate-200 bg-white px-5 py-4 leading-8 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                          required>{{ old('content', $item->content) }}</textarea>

                            </div>

                            <div class="pt-4 border-t border-slate-200">

                                <button type="submit"
                                        class="inline-flex items-center justify-center px-6 py-3 rounded-xl bg-blue-700 text-white font-bold hover:bg-blue-800 transition">
                                    Simpan Paragraf
                                </button>

                            </div>

                        </form>

                        <form action="{{ route('admin.profile-contents.items.destroy', $item) }}"
                              method="POST"
                              class="mt-4"
                              onsubmit="return confirm('Yakin ingin menghapus paragraf ini?')">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="inline-flex items-center justify-center px-6 py-3 rounded-xl bg-red-50 text-red-700 font-bold hover:bg-red-600 hover:text-white transition">
                                Hapus Paragraf
                            </button>

                        </form>

                    </div>

                @empty

                    <div class="rounded-3xl bg-slate-50 border border-slate-100 p-8 text-center">

                        <h3 class="text-xl font-bold text-slate-800">
                            Belum ada paragraf
                        </h3>

                        <p class="mt-2 text-slate-500">
                            Tambahkan paragraf melalui form di bawah.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>


        {{-- Tambah Paragraf --}}
        <div class="rounded-[2rem] bg-white border border-slate-100 shadow-xl overflow-hidden">

            <div class="h-2 bg-gradient-to-r from-green-600 to-blue-700"></div>

            <form action="{{ route('admin.profile-contents.items.store', $profileSection) }}"
                  method="POST"
                  class="p-7 md:p-8 space-y-5">

                @csrf

                <input type="hidden" name="item_group" value="paragraph">
                <input type="hidden" name="title" value="">
                <input type="hidden" name="is_active" value="1">

                <div>

                    <h2 class="text-2xl font-black text-slate-800">
                        Tambah Paragraf Baru
                    </h2>

                    <p class="mt-2 text-slate-500">
                        Paragraf baru akan tampil di bagian kiri section Perjalanan Program Studi.
                    </p>

                </div>

                <div>

                    <label class="block text-sm font-bold text-slate-700 mb-2">
                        Urutan
                    </label>

                    <input type="number"
                           name="sort_order"
                           value="{{ $paragraphItems->count() + 1 }}"
                           class="w-full md:w-48 rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">

                </div>

                <div>

                    <label class="block text-sm font-bold text-slate-700 mb-2">
                        Isi Paragraf
                    </label>

                    <textarea name="content"
                              rows="6"
                              class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 leading-8 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                              required></textarea>

                </div>

                <button type="submit"
                        class="inline-flex items-center justify-center px-7 py-4 rounded-2xl bg-green-600 text-white font-bold hover:bg-green-700 transition shadow-lg shadow-green-600/20">
                    Tambah Paragraf
                </button>

            </form>

        </div>


        {{-- Timeline Kanan --}}
        <div class="rounded-[2rem] bg-white border border-slate-100 shadow-xl overflow-hidden">

            <div class="h-2 bg-gradient-to-r from-yellow-400 to-blue-700"></div>

            <div class="p-6 md:p-8 border-b border-slate-100">

                <h2 class="text-2xl font-black text-slate-800">
                    Kartu Timeline Kanan
                </h2>

                <p class="mt-2 text-slate-500 leading-7">
                    Isi kartu bernomor yang tampil di sisi kanan section Perjalanan Program Studi.
                </p>

            </div>

            <div class="p-6 md:p-8 space-y-6">

                @forelse ($timelineItems as $item)

                    <div class="rounded-[2rem] bg-slate-50 border border-slate-100 p-6">

                        <form action="{{ route('admin.profile-contents.items.update', $item) }}"
                              method="POST"
                              class="space-y-5">

                            @csrf
                            @method('PUT')

                            <input type="hidden" name="item_group" value="timeline">
                            <input type="hidden" name="is_active" value="0">

                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                                <div class="flex items-center gap-4">

                                    <div class="w-12 h-12 rounded-2xl
                                        {{ $loop->iteration % 2 === 0 ? 'bg-yellow-400' : 'bg-blue-700' }}
                                        text-white flex items-center justify-center font-black shadow-lg">
                                        {{ $loop->iteration }}
                                    </div>

                                    <div>

                                        <h3 class="text-lg font-black text-slate-800">
                                            Kartu Timeline {{ $loop->iteration }}
                                        </h3>

                                        <p class="text-sm text-slate-500">
                                            Tampil di sisi kanan halaman profil.
                                        </p>

                                    </div>

                                </div>

                                <div class="flex items-center gap-3">

                                    <label class="flex items-center gap-2 text-sm font-bold text-slate-600 cursor-pointer">

                                        <input type="checkbox"
                                               name="is_active"
                                               value="1"
                                               class="w-5 h-5 rounded border-slate-300 text-blue-700 focus:ring-blue-500"
                                               {{ old('is_active', $item->is_active) ? 'checked' : '' }}>

                                        Tampilkan

                                    </label>

                                    <input type="number"
                                           name="sort_order"
                                           value="{{ old('sort_order', $item->sort_order) }}"
                                           class="w-24 rounded-xl border border-slate-200 bg-white px-3 py-2 text-center focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           title="Urutan">

                                </div>

                            </div>

                            <div>

                                <label class="block text-sm font-bold text-slate-700 mb-2">
                                    Judul Kartu
                                </label>

                                <input type="text"
                                       name="title"
                                       value="{{ old('title', $item->title) }}"
                                       class="w-full rounded-2xl border border-slate-200 bg-white px-5 py-4 focus:outline-none focus:ring-2 focus:ring-blue-500">

                            </div>

                            <div>

                                <label class="block text-sm font-bold text-slate-700 mb-2">
                                    Deskripsi Kartu
                                </label>

                                <textarea name="content"
                                          rows="5"
                                          class="w-full rounded-2xl border border-slate-200 bg-white px-5 py-4 leading-8 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                          required>{{ old('content', $item->content) }}</textarea>

                            </div>

                            <div class="pt-4 border-t border-slate-200">

                                <button type="submit"
                                        class="inline-flex items-center justify-center px-6 py-3 rounded-xl bg-blue-700 text-white font-bold hover:bg-blue-800 transition">
                                    Simpan Kartu
                                </button>

                            </div>

                        </form>

                        <form action="{{ route('admin.profile-contents.items.destroy', $item) }}"
                              method="POST"
                              class="mt-4"
                              onsubmit="return confirm('Yakin ingin menghapus kartu timeline ini?')">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="inline-flex items-center justify-center px-6 py-3 rounded-xl bg-red-50 text-red-700 font-bold hover:bg-red-600 hover:text-white transition">
                                Hapus Kartu
                            </button>

                        </form>

                    </div>

                @empty

                    <div class="rounded-3xl bg-slate-50 border border-slate-100 p-8 text-center">

                        <h3 class="text-xl font-bold text-slate-800">
                            Belum ada kartu timeline
                        </h3>

                        <p class="mt-2 text-slate-500">
                            Tambahkan kartu melalui form di bawah.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>


        {{-- Tambah Timeline --}}
        <div class="rounded-[2rem] bg-white border border-slate-100 shadow-xl overflow-hidden">

            <div class="h-2 bg-gradient-to-r from-green-600 to-yellow-400"></div>

            <form action="{{ route('admin.profile-contents.items.store', $profileSection) }}"
                  method="POST"
                  class="p-7 md:p-8 space-y-5">

                @csrf

                <input type="hidden" name="item_group" value="timeline">
                <input type="hidden" name="is_active" value="1">

                <div>

                    <h2 class="text-2xl font-black text-slate-800">
                        Tambah Kartu Timeline Baru
                    </h2>

                    <p class="mt-2 text-slate-500">
                        Kartu baru akan tampil di bagian kanan section Perjalanan Program Studi.
                    </p>

                </div>

                <div class="grid md:grid-cols-2 gap-5">

                    <div>

                        <label class="block text-sm font-bold text-slate-700 mb-2">
                            Judul Kartu
                        </label>

                        <input type="text"
                               name="title"
                               placeholder="Contoh: Penguatan Kompetensi Vokasi"
                               class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">

                    </div>

                    <div>

                        <label class="block text-sm font-bold text-slate-700 mb-2">
                            Urutan
                        </label>

                        <input type="number"
                               name="sort_order"
                               value="{{ $timelineItems->count() + 1 }}"
                               class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">

                    </div>

                </div>

                <div>

                    <label class="block text-sm font-bold text-slate-700 mb-2">
                        Deskripsi Kartu
                    </label>

                    <textarea name="content"
                              rows="5"
                              class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 leading-8 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                              required></textarea>

                </div>

                <button type="submit"
                        class="inline-flex items-center justify-center px-7 py-4 rounded-2xl bg-green-600 text-white font-bold hover:bg-green-700 transition shadow-lg shadow-green-600/20">
                    Tambah Kartu Timeline
                </button>

            </form>

        </div>


    {{-- ===================================================== --}}
    {{-- DEFAULT SECTION --}}
    {{-- ===================================================== --}}

    @else

        {{-- Item Content --}}
        <div class="rounded-[2rem] bg-white border border-slate-100 shadow-xl overflow-hidden">

            <div class="h-2 bg-gradient-to-r from-blue-700 via-yellow-400 to-blue-700"></div>

            <div class="p-6 md:p-8 border-b border-slate-100">

                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

                    <div>

                        <h2 class="text-2xl font-black text-slate-800">
                            Daftar Item Konten
                        </h2>

                        <p class="mt-2 text-slate-500">
                            Kelola item yang berada di dalam section {{ $profileSection->title }}.
                        </p>

                    </div>

                    <div class="relative w-full lg:w-96">

                        <input type="text"
                               id="profileItemSearch"
                               placeholder="Cari item konten..."
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


            <div class="p-6 md:p-8 space-y-6">

                @forelse ($profileSection->items as $item)

                    <div class="rounded-[2rem] bg-slate-50 border border-slate-100 p-6"
                         data-profile-item-card
                         data-title="{{ strtolower($item->title ?? '') }}"
                         data-group="{{ strtolower($item->item_group ?? '') }}"
                         data-content="{{ strtolower($item->content ?? '') }}">

                        <form action="{{ route('admin.profile-contents.items.update', $item) }}"
                              method="POST"
                              class="space-y-6">

                            @csrf
                            @method('PUT')

                            <input type="hidden" name="is_active" value="0">

                            <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-5">

                                <div class="flex items-start gap-4">

                                    <div class="w-14 h-14 rounded-2xl bg-blue-700 text-white flex items-center justify-center font-black shadow-lg shrink-0">
                                        {{ $loop->iteration }}
                                    </div>

                                    <div>

                                        <h3 class="text-xl font-black text-slate-800">
                                            {{ $item->title ?: 'Item Konten' }}
                                        </h3>

                                        <p class="mt-1 text-sm text-slate-500">
                                            Group: {{ $item->item_group ?: '-' }} • Urutan {{ $item->sort_order }}
                                        </p>

                                    </div>

                                </div>

                                @if ($item->is_active)
                                    <span class="inline-flex px-3 py-1 rounded-full bg-green-50 text-green-700 text-xs font-bold">
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-flex px-3 py-1 rounded-full bg-red-50 text-red-700 text-xs font-bold">
                                        Nonaktif
                                    </span>
                                @endif

                            </div>

                            <div class="grid md:grid-cols-3 gap-5">

                                <div>

                                    <label class="block text-sm font-bold text-slate-700 mb-2">
                                        Group
                                    </label>

                                    <input type="text"
                                           name="item_group"
                                           value="{{ old('item_group', $item->item_group) }}"
                                           placeholder="visi / misi / tujuan / ppm / cpl"
                                           class="w-full rounded-2xl border border-slate-200 bg-white px-5 py-4 focus:outline-none focus:ring-2 focus:ring-blue-500">

                                </div>

                                <div>

                                    <label class="block text-sm font-bold text-slate-700 mb-2">
                                        Judul Item
                                    </label>

                                    <input type="text"
                                           name="title"
                                           value="{{ old('title', $item->title) }}"
                                           placeholder="Contoh: Misi 1"
                                           class="w-full rounded-2xl border border-slate-200 bg-white px-5 py-4 focus:outline-none focus:ring-2 focus:ring-blue-500">

                                </div>

                                <div>

                                    <label class="block text-sm font-bold text-slate-700 mb-2">
                                        Urutan
                                    </label>

                                    <input type="number"
                                           name="sort_order"
                                           value="{{ old('sort_order', $item->sort_order) }}"
                                           class="w-full rounded-2xl border border-slate-200 bg-white px-5 py-4 focus:outline-none focus:ring-2 focus:ring-blue-500">

                                </div>

                            </div>

                            <div>

                                <label class="block text-sm font-bold text-slate-700 mb-2">
                                    Isi Konten
                                </label>

                                <textarea name="content"
                                          rows="6"
                                          class="w-full rounded-2xl border border-slate-200 bg-white px-5 py-4 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                          required>{{ old('content', $item->content) }}</textarea>

                            </div>

                            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 pt-4 border-t border-slate-200">

                                <label class="flex items-center gap-3 cursor-pointer">

                                    <input type="checkbox"
                                           name="is_active"
                                           value="1"
                                           class="w-5 h-5 rounded border-slate-300 text-blue-700 focus:ring-blue-500"
                                           {{ old('is_active', $item->is_active) ? 'checked' : '' }}>

                                    <span class="text-sm font-bold text-slate-700">
                                        Tampilkan item ini
                                    </span>

                                </label>

                                <button type="submit"
                                        class="inline-flex items-center justify-center px-6 py-3 rounded-xl bg-blue-700 text-white font-bold hover:bg-blue-800 transition">
                                    Simpan Item
                                </button>

                            </div>

                        </form>

                        <form action="{{ route('admin.profile-contents.items.destroy', $item) }}"
                              method="POST"
                              class="mt-4"
                              onsubmit="return confirm('Yakin ingin menghapus item ini?')">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="inline-flex items-center justify-center px-6 py-3 rounded-xl bg-red-50 text-red-700 font-bold hover:bg-red-600 hover:text-white transition">
                                Hapus Item
                            </button>

                        </form>

                    </div>

                @empty

                    <div class="rounded-3xl bg-slate-50 border border-slate-100 p-10 text-center">

                        <h3 class="text-xl font-bold text-slate-800">
                            Belum ada item konten
                        </h3>

                        <p class="mt-2 text-slate-500">
                            Tambahkan item baru melalui form di bawah.
                        </p>

                    </div>

                @endforelse


                <div id="profileItemEmptySearch" class="hidden rounded-3xl bg-slate-50 border border-slate-100 p-10 text-center">

                    <h3 class="text-xl font-bold text-slate-800">
                        Item tidak ditemukan
                    </h3>

                    <p class="mt-2 text-slate-500">
                        Coba gunakan kata kunci pencarian lain.
                    </p>

                </div>

            </div>

        </div>


        {{-- Add New Item Default --}}
        <div class="rounded-[2rem] bg-white border border-slate-100 shadow-xl overflow-hidden">

            <div class="h-2 bg-gradient-to-r from-green-600 via-yellow-400 to-blue-700"></div>

            <form action="{{ route('admin.profile-contents.items.store', $profileSection) }}"
                  method="POST"
                  class="p-7 md:p-8 space-y-6">

                @csrf

                <input type="hidden" name="is_active" value="1">

                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

                    <div>

                        <h2 class="text-2xl font-black text-slate-800">
                            Tambah Item Baru
                        </h2>

                        <p class="mt-2 text-slate-500">
                            Tambahkan item baru untuk section {{ $profileSection->title }}.
                        </p>

                    </div>

                    <button type="submit"
                            class="inline-flex items-center justify-center gap-3 px-7 py-4 rounded-2xl bg-green-600 text-white font-bold hover:bg-green-700 transition shadow-lg shadow-green-600/20">
                        Tambah Item
                    </button>

                </div>

                <div class="grid md:grid-cols-3 gap-5">

                    <div>

                        <label class="block text-sm font-bold text-slate-700 mb-2">
                            Group
                        </label>

                        <input type="text"
                               name="item_group"
                               placeholder="visi / misi / tujuan / ppm / cpl"
                               class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">

                    </div>

                    <div>

                        <label class="block text-sm font-bold text-slate-700 mb-2">
                            Judul Item
                        </label>

                        <input type="text"
                               name="title"
                               placeholder="Contoh: Misi 1"
                               class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">

                    </div>

                    <div>

                        <label class="block text-sm font-bold text-slate-700 mb-2">
                            Urutan
                        </label>

                        <input type="number"
                               name="sort_order"
                               value="0"
                               class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">

                    </div>

                </div>

                <div>

                    <label class="block text-sm font-bold text-slate-700 mb-2">
                        Isi Konten
                    </label>

                    <textarea name="content"
                              rows="6"
                              class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                              required></textarea>

                </div>

            </form>

        </div>

    @endif

</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {

        /*
        |--------------------------------------------------------------------------
        | Search Item Default
        |--------------------------------------------------------------------------
        */

        const searchInput = document.getElementById('profileItemSearch');
        const cards = document.querySelectorAll('[data-profile-item-card]');
        const emptySearch = document.getElementById('profileItemEmptySearch');

        if (searchInput) {
            searchInput.addEventListener('input', function () {
                const keyword = this.value.toLowerCase().trim();
                let visibleCount = 0;

                cards.forEach(function (card) {
                    const title = card.dataset.title || '';
                    const group = card.dataset.group || '';
                    const content = card.dataset.content || '';

                    const isMatch =
                        title.includes(keyword) ||
                        group.includes(keyword) ||
                        content.includes(keyword);

                    card.style.display = isMatch ? '' : 'none';

                    if (isMatch) {
                        visibleCount++;
                    }
                });

                if (emptySearch) {
                    emptySearch.classList.toggle('hidden', visibleCount > 0);
                }
            });
        }


        /*
        |--------------------------------------------------------------------------
        | Info Card Content Builder
        |--------------------------------------------------------------------------
        | Admin melihat field yang mudah:
        | - Angka / Nilai Besar
        | - Deskripsi Kecil
        |
        | Tetapi database tetap menyimpan format:
        | D-III|Diploma Empat
        |--------------------------------------------------------------------------
        */

        document.querySelectorAll('.js-info-card-form').forEach(function (form) {
            form.addEventListener('submit', function () {
                const valueInput = form.querySelector('[data-card-value]');
                const descriptionInput = form.querySelector('[data-card-description]');
                const hiddenContent = form.querySelector('.js-info-card-content');

                if (!hiddenContent) {
                    return;
                }

                const value = valueInput ? valueInput.value.trim() : '';
                const description = descriptionInput ? descriptionInput.value.trim() : '';

                hiddenContent.value = value + '|' + description;
            });
        });

    });
</script>

@endsection