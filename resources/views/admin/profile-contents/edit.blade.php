@extends('layouts.admin')

@section('content')
<div class="p-6">

    <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div>
            <h1 class="text-3xl font-bold text-gray-800">
                Edit {{ $profileSection->title }}
            </h1>

            <p class="mt-2 text-gray-500">
                Kelola judul section dan item konten yang tampil di halaman profil.
            </p>
        </div>

        <a href="{{ route('admin.profile-contents.index') }}"
            class="inline-flex items-center justify-center px-5 py-3 rounded-xl bg-gray-100 text-gray-700 font-semibold hover:bg-gray-200 transition">

            ← Kembali

        </a>

    </div>

    @if (session('success'))
        <div class="mb-6 rounded-xl bg-green-50 border border-green-200 px-5 py-4 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-6 rounded-xl bg-red-50 border border-red-200 px-5 py-4 text-red-700">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- ===================================================== --}}
    {{-- FORM SECTION --}}
    {{-- ===================================================== --}}
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 mb-8">

        <h2 class="text-xl font-bold text-gray-800 mb-6">
            Informasi Section
        </h2>

        <form action="{{ route('admin.profile-contents.update', $profileSection) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid md:grid-cols-2 gap-6">

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Judul
                    </label>

                    <input type="text"
                        name="title"
                        value="{{ old('title', $profileSection->title) }}"
                        class="w-full rounded-xl border-gray-300 focus:border-blue-600 focus:ring-blue-600"
                        required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Subjudul
                    </label>

                    <input type="text"
                        name="subtitle"
                        value="{{ old('subtitle', $profileSection->subtitle) }}"
                        class="w-full rounded-xl border-gray-300 focus:border-blue-600 focus:ring-blue-600">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Urutan
                    </label>

                    <input type="number"
                        name="sort_order"
                        value="{{ old('sort_order', $profileSection->sort_order) }}"
                        class="w-full rounded-xl border-gray-300 focus:border-blue-600 focus:ring-blue-600">
                </div>

                <div class="flex items-center gap-3 mt-8">
                    <input type="checkbox"
                        name="is_active"
                        value="1"
                        id="is_active"
                        class="rounded border-gray-300 text-blue-700 focus:ring-blue-600"
                        {{ old('is_active', $profileSection->is_active) ? 'checked' : '' }}>

                    <label for="is_active" class="text-sm font-semibold text-gray-700">
                        Tampilkan section ini
                    </label>
                </div>

            </div>

            <div class="mt-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Deskripsi
                </label>

                <textarea name="description"
                    rows="4"
                    class="w-full rounded-xl border-gray-300 focus:border-blue-600 focus:ring-blue-600">{{ old('description', $profileSection->description) }}</textarea>
            </div>

            <button type="submit"
                class="mt-6 px-6 py-3 rounded-xl bg-blue-700 text-white font-semibold hover:bg-blue-800 transition">

                Simpan Section

            </button>

        </form>

    </div>

    {{-- ===================================================== --}}
    {{-- LIST ITEM --}}
    {{-- ===================================================== --}}
    <div class="space-y-6">

        <h2 class="text-2xl font-bold text-gray-800">
            Daftar Item Konten
        </h2>

        @forelse ($profileSection->items as $item)
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">

                <form action="{{ route('admin.profile-contents.items.update', $item) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid md:grid-cols-3 gap-5 mb-5">

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Group
                            </label>

                            <input type="text"
                                name="item_group"
                                value="{{ old('item_group', $item->item_group) }}"
                                placeholder="visi / misi / tujuan / ppm / cpl"
                                class="w-full rounded-xl border-gray-300 focus:border-blue-600 focus:ring-blue-600">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Judul Item
                            </label>

                            <input type="text"
                                name="title"
                                value="{{ old('title', $item->title) }}"
                                class="w-full rounded-xl border-gray-300 focus:border-blue-600 focus:ring-blue-600">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Urutan
                            </label>

                            <input type="number"
                                name="sort_order"
                                value="{{ old('sort_order', $item->sort_order) }}"
                                class="w-full rounded-xl border-gray-300 focus:border-blue-600 focus:ring-blue-600">
                        </div>

                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Isi Konten
                        </label>

                        <textarea name="content"
                            rows="5"
                            class="w-full rounded-xl border-gray-300 focus:border-blue-600 focus:ring-blue-600"
                            required>{{ old('content', $item->content) }}</textarea>
                    </div>

                    <div class="mt-5 flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                        <label class="inline-flex items-center gap-3">
                            <input type="checkbox"
                                name="is_active"
                                value="1"
                                class="rounded border-gray-300 text-blue-700 focus:ring-blue-600"
                                {{ old('is_active', $item->is_active) ? 'checked' : '' }}>

                            <span class="text-sm font-semibold text-gray-700">
                                Tampilkan item ini
                            </span>
                        </label>

                        <div class="flex gap-3">

                            <button type="submit"
                                class="px-5 py-3 rounded-xl bg-blue-700 text-white font-semibold hover:bg-blue-800 transition">

                                Simpan Item

                            </button>

                        </div>

                    </div>

                </form>

                <form action="{{ route('admin.profile-contents.items.destroy', $item) }}"
                    method="POST"
                    class="mt-4"
                    onsubmit="return confirm('Yakin ingin menghapus item ini?')">

                    @csrf
                    @method('DELETE')

                    <button type="submit"
                        class="px-5 py-3 rounded-xl bg-red-50 text-red-700 font-semibold hover:bg-red-100 transition">

                        Hapus Item

                    </button>

                </form>

            </div>
        @empty
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 text-gray-500">
                Belum ada item konten.
            </div>
        @endforelse

    </div>

    {{-- ===================================================== --}}
    {{-- FORM TAMBAH ITEM --}}
    {{-- ===================================================== --}}
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 mt-10 mb-10">

        <form action="{{ route('admin.profile-contents.items.store', $profileSection) }}" method="POST">
            @csrf

            <div class="flex items-center justify-between mb-6">

                <h2 class="text-xl font-bold text-gray-800">
                    Tambah Item Baru
                </h2>

                <button type="submit"
                    style="background:#16a34a; color:white; padding:12px 24px; border-radius:12px; font-weight:700;">
                    Tambah Item
                </button>

            </div>

            <div class="grid md:grid-cols-3 gap-5 mb-5">

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Group
                    </label>

                    <input type="text"
                        name="item_group"
                        placeholder="visi / misi / tujuan / ppm / cpl"
                        class="w-full rounded-xl border-gray-300 focus:border-blue-600 focus:ring-blue-600">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Judul Item
                    </label>

                    <input type="text"
                        name="title"
                        placeholder="Contoh: Misi 1"
                        class="w-full rounded-xl border-gray-300 focus:border-blue-600 focus:ring-blue-600">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Urutan
                    </label>

                    <input type="number"
                        name="sort_order"
                        value="0"
                        class="w-full rounded-xl border-gray-300 focus:border-blue-600 focus:ring-blue-600">
                </div>

            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Isi Konten
                </label>

                <textarea name="content"
                    rows="5"
                    class="w-full rounded-xl border-gray-300 focus:border-blue-600 focus:ring-blue-600"
                    required></textarea>
            </div>

            <label class="inline-flex items-center gap-3 mt-5">
                <input type="checkbox"
                    name="is_active"
                    value="1"
                    checked
                    class="rounded border-gray-300 text-blue-700 focus:ring-blue-600">

                <span class="text-sm font-semibold text-gray-700">
                    Tampilkan item ini
                </span>
            </label>

        </form>

    </div>
</div>
@endsection