@extends('layouts.admin')

@section('title', 'Kelola Dokumentasi Fasilitas')

@section('content')

@php
    /*
    |--------------------------------------------------------------------------
    | DATA KATEGORI
    |--------------------------------------------------------------------------
    */

    $facilityTitle = trim(
        (string) $facility->title
    );

    $facilityDescription = trim(
        (string) $facility->description
    );

    $facilityCategoryLabel = $facility->category_label;

    $photos = collect(
        $facility->photos ?? []
    );

    $totalPhotos = $photos->count();

    $activePhotos = $photos
        ->filter(fn ($photo): bool => (bool) $photo->is_active)
        ->count();

    /*
    |--------------------------------------------------------------------------
    | KONTEKS FORM YANG GAGAL
    |--------------------------------------------------------------------------
    |
    | Digunakan agar nilai lama dan pesan error tidak tertukar antara:
    |
    | - form informasi kategori;
    | - form tambah foto;
    | - form edit masing-masing foto.
    |
    */

    $formContext = (string) old('form_context', '');

    $facilityFormHasErrors = $formContext === 'facility-update';

    $createPhotoFormHasErrors = $formContext === 'photo-create';

    $selectedFacilityActive = $facilityFormHasErrors
        ? old('is_active') === '1'
        : (bool) $facility->is_active;

    $selectedCreatePhotoActive = $createPhotoFormHasErrors
        ? old('is_active') === '1'
        : true;
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
            <a
                href="{{ route('admin.facilities.index') }}"
                class="mb-4 inline-flex items-center
                       text-sm font-bold text-blue-700
                       transition hover:underline"
            >
                ← Kembali ke Dokumentasi Fasilitas
            </a>

            <h1
                class="text-3xl font-black
                       text-slate-800 md:text-4xl"
            >
                Kelola {{ $facilityTitle }}
            </h1>

            <p
                class="mt-3 max-w-4xl
                       leading-7 text-slate-500"
            >
                Perbarui informasi kategori dan kelola dokumentasi
                foto untuk {{ $facilityTitle }}.
            </p>
        </div>

        <a
            href="{{ url('/facilities') }}"
            target="_blank"
            rel="noopener noreferrer"
            class="inline-flex items-center
                   justify-center gap-2 rounded-2xl
                   bg-blue-700 px-5 py-3
                   font-bold text-white
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
                    d="M14 3h7m0 0v7m0-7L10 14M5 5h5M5 5a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5"
                />
            </svg>

            Lihat Halaman Publik
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

    @if ($errors->any())
        <div
            class="rounded-2xl border
                   border-red-200 bg-red-50
                   px-6 py-4 text-red-700"
            role="alert"
        >
            <p class="font-bold">
                Data belum dapat disimpan.
            </p>

            <ul class="mt-3 list-disc space-y-1 pl-5 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {{-- ========================================================= --}}
    {{-- RINGKASAN --}}
    {{-- ========================================================= --}}

    <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">

        <div
            class="rounded-3xl border
                   border-slate-100 bg-white
                   p-6 shadow-lg"
        >
            <p
                class="text-xs font-bold uppercase
                       tracking-wider text-slate-500"
            >
                Kategori
            </p>

            <p
                class="mt-3 text-lg font-black
                       text-slate-800"
            >
                {{ $facilityCategoryLabel }}
            </p>
        </div>


        <div
            class="rounded-3xl border
                   border-slate-100 bg-white
                   p-6 shadow-lg"
        >
            <p
                class="text-xs font-bold uppercase
                       tracking-wider text-slate-500"
            >
                Total Foto
            </p>

            <p
                class="mt-3 text-4xl font-black
                       text-blue-700"
            >
                {{ $totalPhotos }}
            </p>
        </div>


        <div
            class="rounded-3xl border
                   border-slate-100 bg-white
                   p-6 shadow-lg"
        >
            <p
                class="text-xs font-bold uppercase
                       tracking-wider text-slate-500"
            >
                Foto Aktif
            </p>

            <p
                class="mt-3 text-4xl font-black
                       text-green-600"
            >
                {{ $activePhotos }}
            </p>
        </div>


        <div
            class="rounded-3xl border
                   border-slate-100 bg-white
                   p-6 shadow-lg"
        >
            <p
                class="text-xs font-bold uppercase
                       tracking-wider text-slate-500"
            >
                Status Kategori
            </p>

            <span
                @class([
                    'mt-4 inline-flex rounded-full',
                    'px-4 py-2 text-sm font-bold',
                    'bg-green-50 text-green-700' =>
                        $facility->is_active,
                    'bg-red-50 text-red-700' =>
                        !$facility->is_active,
                ])
            >
                {{ $facility->is_active
                    ? 'Aktif'
                    : 'Nonaktif' }}
            </span>
        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- INFORMASI KATEGORI --}}
    {{-- ========================================================= --}}

    <section
        class="overflow-hidden rounded-3xl
               border border-slate-100
               bg-white shadow-lg"
    >
        <div
            class="h-2 bg-gradient-to-r
                   from-blue-700 via-yellow-400
                   to-blue-700"
        ></div>

        <form
            action="{{ route(
                'admin.facilities.update',
                $facility
            ) }}"
            method="POST"
            class="space-y-7 p-6 sm:p-7 md:p-8"
            data-disable-submit-form
        >
            @csrf
            @method('PUT')

            <input
                type="hidden"
                name="form_context"
                value="facility-update"
            >

            <div>
                <h2
                    class="text-2xl font-black
                           text-slate-800"
                >
                    Informasi Kategori
                </h2>

                <p
                    class="mt-2 max-w-3xl
                           leading-7 text-slate-500"
                >
                    Judul dan deskripsi berikut akan digunakan pada
                    halaman fasilitas. Deskripsi dapat dikosongkan
                    sampai materi resmi tersedia.
                </p>
            </div>


            <div class="grid gap-6 lg:grid-cols-12">

                {{-- Kategori Tetap --}}
                <div class="lg:col-span-3">
                    <label
                        class="mb-2 block text-sm
                               font-bold text-slate-700"
                    >
                        Kategori Sistem
                    </label>

                    <div
                        class="rounded-2xl border
                               border-slate-200 bg-slate-100
                               px-5 py-4 font-semibold
                               text-slate-600"
                    >
                        {{ $facilityCategoryLabel }}
                    </div>

                    <p class="mt-2 text-sm text-slate-500">
                        Nilai kategori tidak dapat diubah.
                    </p>
                </div>


                {{-- Judul --}}
                <div class="lg:col-span-5">
                    <label
                        for="facilityTitle"
                        class="mb-2 block text-sm
                               font-bold text-slate-700"
                    >
                        Judul Fasilitas
                        <span class="text-red-600">*</span>
                    </label>

                    <input
                        type="text"
                        id="facilityTitle"
                        name="title"
                        value="{{ $facilityFormHasErrors
                            ? old('title')
                            : $facility->title }}"
                        maxlength="255"
                        required
                        @class([
                            'w-full rounded-2xl border bg-slate-50',
                            'px-5 py-4 transition',
                            'focus:bg-white focus:outline-none',
                            'focus:ring-2 focus:ring-blue-500',
                            'border-red-300' =>
                                $facilityFormHasErrors
                                && $errors->has('title'),
                            'border-slate-200' =>
                                !$facilityFormHasErrors
                                || !$errors->has('title'),
                        ])
                    >

                    @if ($facilityFormHasErrors)
                        @error('title')
                            <p
                                class="mt-2 text-sm
                                       font-semibold text-red-600"
                            >
                                {{ $message }}
                            </p>
                        @enderror
                    @endif
                </div>


                {{-- Urutan --}}
                <div class="lg:col-span-2">
                    <label
                        for="facilitySortOrder"
                        class="mb-2 block text-sm
                               font-bold text-slate-700"
                    >
                        Urutan
                    </label>

                    <input
                        type="number"
                        id="facilitySortOrder"
                        name="sort_order"
                        value="{{ $facilityFormHasErrors
                            ? old('sort_order', 0)
                            : $facility->sort_order }}"
                        min="0"
                        step="1"
                        inputmode="numeric"
                        class="w-full rounded-2xl
                               border border-slate-200
                               bg-slate-50 px-5 py-4
                               transition focus:bg-white
                               focus:outline-none
                               focus:ring-2
                               focus:ring-blue-500"
                    >

                    @if ($facilityFormHasErrors)
                        @error('sort_order')
                            <p
                                class="mt-2 text-sm
                                       font-semibold text-red-600"
                            >
                                {{ $message }}
                            </p>
                        @enderror
                    @endif
                </div>


                {{-- Status --}}
                <div class="lg:col-span-2">
                    <p
                        class="mb-2 text-sm font-bold
                               text-slate-700"
                    >
                        Status
                    </p>

                    <label
                        class="flex min-h-[58px]
                               cursor-pointer items-center
                               gap-3 rounded-2xl border
                               border-slate-200 bg-slate-50
                               px-5 py-4"
                    >
                        <input
                            type="checkbox"
                            name="is_active"
                            value="1"
                            @checked($selectedFacilityActive)
                            class="h-5 w-5 rounded
                                   border-slate-300
                                   text-blue-700
                                   focus:ring-blue-500"
                        >

                        <span
                            class="text-sm font-semibold
                                   text-slate-700"
                        >
                            Aktif
                        </span>
                    </label>
                </div>


                {{-- Deskripsi --}}
                <div class="lg:col-span-12">
                    <label
                        for="facilityDescription"
                        class="mb-2 block text-sm
                               font-bold text-slate-700"
                    >
                        Deskripsi
                    </label>

                    <textarea
                        id="facilityDescription"
                        name="description"
                        rows="5"
                        placeholder="Isi setelah tersedia uraian resmi fasilitas..."
                        class="w-full rounded-2xl
                               border border-slate-200
                               bg-slate-50 px-5 py-4
                               leading-7 transition
                               focus:bg-white
                               focus:outline-none
                               focus:ring-2
                               focus:ring-blue-500"
                    >{{ $facilityFormHasErrors
                        ? old('description')
                        : $facilityDescription }}</textarea>

                    <p class="mt-2 text-sm text-slate-500">
                        Kosongkan jika belum tersedia deskripsi resmi.
                    </p>

                    @if ($facilityFormHasErrors)
                        @error('description')
                            <p
                                class="mt-2 text-sm
                                       font-semibold text-red-600"
                            >
                                {{ $message }}
                            </p>
                        @enderror
                    @endif
                </div>

            </div>


            <div
                class="flex flex-col gap-4
                       border-t border-slate-100
                       pt-6 sm:flex-row
                       sm:items-center
                       sm:justify-between"
            >
                <p class="text-sm leading-6 text-slate-500">
                    Kategori nonaktif tidak akan tampil pada halaman
                    publik beserta dokumentasinya.
                </p>

                <button
                    type="submit"
                    data-submit-button
                    class="inline-flex items-center
                           justify-center rounded-2xl
                           bg-blue-700 px-7 py-4
                           font-bold text-white
                           transition hover:bg-blue-800
                           disabled:cursor-not-allowed
                           disabled:opacity-60"
                >
                    Simpan Informasi
                </button>
            </div>
        </form>
    </section>


    {{-- ========================================================= --}}
    {{-- FORM TAMBAH FOTO --}}
    {{-- ========================================================= --}}

    <section
        class="overflow-hidden rounded-3xl
               border border-slate-100
               bg-white shadow-lg"
    >
        <div
            class="h-2 bg-gradient-to-r
                   from-blue-700 via-yellow-400
                   to-blue-700"
        ></div>

        <form
            action="{{ route(
                'admin.facilities.photos.store',
                $facility
            ) }}"
            method="POST"
            enctype="multipart/form-data"
            class="space-y-7 p-6 sm:p-7 md:p-8"
            data-photo-form
            data-original-photo=""
        >
            @csrf

            <input
                type="hidden"
                name="form_context"
                value="photo-create"
            >

            <div>
                <h2
                    class="text-2xl font-black
                           text-slate-800"
                >
                    Tambah Foto Dokumentasi
                </h2>

                <p
                    class="mt-2 max-w-3xl
                           leading-7 text-slate-500"
                >
                    Tambahkan foto resmi untuk kategori
                    {{ $facilityTitle }}. Foto aktif akan tampil pada
                    galeri halaman publik.
                </p>
            </div>


            <div class="grid gap-6 lg:grid-cols-12">

                {{-- Judul --}}
                <div class="lg:col-span-4">
                    <label
                        for="newPhotoTitle"
                        class="mb-2 block text-sm
                               font-bold text-slate-700"
                    >
                        Judul Foto
                    </label>

                    <input
                        type="text"
                        id="newPhotoTitle"
                        name="title"
                        value="{{ $createPhotoFormHasErrors
                            ? old('title')
                            : '' }}"
                        maxlength="255"
                        placeholder="Masukkan judul apabila tersedia"
                        class="w-full rounded-2xl
                               border border-slate-200
                               bg-slate-50 px-5 py-4
                               transition focus:bg-white
                               focus:outline-none
                               focus:ring-2
                               focus:ring-blue-500"
                    >

                    <p class="mt-2 text-sm text-slate-500">
                        Judul foto dapat dikosongkan.
                    </p>

                    @if ($createPhotoFormHasErrors)
                        @error('title')
                            <p
                                class="mt-2 text-sm
                                       font-semibold text-red-600"
                            >
                                {{ $message }}
                            </p>
                        @enderror
                    @endif
                </div>


                {{-- File --}}
                <div class="lg:col-span-5">
                    <label
                        for="newFacilityPhoto"
                        class="mb-2 block text-sm
                               font-bold text-slate-700"
                    >
                        Foto Dokumentasi
                        <span class="text-red-600">*</span>
                    </label>

                    <input
                        type="file"
                        id="newFacilityPhoto"
                        name="photo"
                        accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                        required
                        data-photo-input
                        class="block w-full rounded-2xl
                               border border-slate-200
                               bg-slate-50 px-4 py-3
                               text-sm text-slate-600
                               file:mr-4 file:rounded-xl
                               file:border-0
                               file:bg-blue-700
                               file:px-4 file:py-2
                               file:font-bold file:text-white
                               hover:file:bg-blue-800"
                    >

                    <p
                        class="mt-2 text-sm
                               leading-6 text-slate-500"
                    >
                        Format JPG, JPEG, PNG, atau WEBP.
                        Ukuran maksimal 20 MB.
                    </p>

                    <p
                        data-photo-client-error
                        class="mt-2 hidden text-sm
                               font-semibold text-red-600"
                        aria-live="assertive"
                    ></p>

                    @if ($createPhotoFormHasErrors)
                        @error('photo')
                            <p
                                class="mt-2 text-sm
                                       font-semibold text-red-600"
                            >
                                {{ $message }}
                            </p>
                        @enderror
                    @endif
                </div>


                {{-- Urutan --}}
                <div class="lg:col-span-3">
                    <label
                        for="newPhotoSortOrder"
                        class="mb-2 block text-sm
                               font-bold text-slate-700"
                    >
                        Urutan
                    </label>

                    <input
                        type="number"
                        id="newPhotoSortOrder"
                        name="sort_order"
                        value="{{ $createPhotoFormHasErrors
                            ? old('sort_order', 0)
                            : 0 }}"
                        min="0"
                        step="1"
                        inputmode="numeric"
                        class="w-full rounded-2xl
                               border border-slate-200
                               bg-slate-50 px-5 py-4
                               transition focus:bg-white
                               focus:outline-none
                               focus:ring-2
                               focus:ring-blue-500"
                    >

                    @if ($createPhotoFormHasErrors)
                        @error('sort_order')
                            <p
                                class="mt-2 text-sm
                                       font-semibold text-red-600"
                            >
                                {{ $message }}
                            </p>
                        @enderror
                    @endif
                </div>

            </div>


            {{-- Preview Foto Baru --}}
            <div
                data-photo-preview-container
                class="hidden rounded-3xl border
                       border-slate-100 bg-slate-50
                       p-5"
            >
                <div
                    class="flex flex-col gap-5
                           sm:flex-row sm:items-center"
                >
                    <div
                        class="relative h-40 w-full
                               overflow-hidden rounded-2xl
                               bg-white sm:w-56"
                    >
                        <img
                            src=""
                            alt="Pratinjau foto baru"
                            data-photo-preview
                            class="h-full w-full
                                   object-cover object-center"
                        >

                        <div
                            data-photo-placeholder
                            class="absolute inset-0 hidden
                                   items-center justify-center
                                   text-sm font-semibold
                                   text-slate-500"
                        >
                            Tidak ada pratinjau
                        </div>
                    </div>

                    <div class="min-w-0">
                        <p
                            class="text-xs font-bold uppercase
                                   tracking-wider text-slate-500"
                        >
                            Foto Dipilih
                        </p>

                        <p
                            data-photo-information
                            class="mt-2 break-all font-bold
                                   text-slate-800"
                        ></p>
                    </div>
                </div>
            </div>


            <div
                class="flex flex-col gap-4
                       border-t border-slate-100
                       pt-6 sm:flex-row
                       sm:items-center
                       sm:justify-between"
            >
                <label
                    class="inline-flex cursor-pointer
                           items-center gap-3"
                >
                    <input
                        type="checkbox"
                        name="is_active"
                        value="1"
                        @checked($selectedCreatePhotoActive)
                        class="h-5 w-5 rounded
                               border-slate-300
                               text-blue-700
                               focus:ring-blue-500"
                    >

                    <span
                        class="text-sm font-semibold
                               text-slate-700"
                    >
                        Tampilkan foto pada halaman publik
                    </span>
                </label>

                <button
                    type="submit"
                    data-submit-button
                    class="inline-flex items-center
                           justify-center rounded-2xl
                           bg-blue-700 px-7 py-4
                           font-bold text-white
                           transition hover:bg-blue-800
                           disabled:cursor-not-allowed
                           disabled:opacity-60"
                >
                    Tambah Foto
                </button>
            </div>
        </form>
    </section>


    {{-- ========================================================= --}}
    {{-- DAFTAR FOTO --}}
    {{-- ========================================================= --}}

    <section
        class="overflow-hidden rounded-3xl
               border border-slate-100
               bg-white shadow-lg"
    >
        <div
            class="border-b border-slate-100
                   p-6 sm:p-7 md:p-8"
        >
            <h2
                class="text-2xl font-black
                       text-slate-800"
            >
                Foto Dokumentasi
            </h2>

            <p
                class="mt-2 max-w-3xl
                       leading-7 text-slate-500"
            >
                Kelola judul, foto, urutan, dan status publikasi
                dokumentasi {{ $facilityTitle }}.
            </p>
        </div>


        @if ($photos->isNotEmpty())

            <div
                class="grid gap-6 p-6
                       md:grid-cols-2 md:p-8
                       xl:grid-cols-3"
            >
                @foreach ($photos as $photo)

                    @php
                        $photoPath = trim(
                            (string) $photo->photo
                        );

                        $photoExists = $photoPath !== ''
                            && \Illuminate\Support\Facades\Storage::disk(
                                'public'
                            )->exists($photoPath);

                        $photoUrl = $photoExists
                            ? asset('storage/' . $photoPath)
                            : null;

                        $isThisPhotoForm =
                            $formContext === 'photo-update'
                            && (string) old('photo_id')
                                === (string) $photo->id;

                        $selectedPhotoTitle = $isThisPhotoForm
                            ? old('title')
                            : $photo->title;

                        $selectedPhotoOrder = $isThisPhotoForm
                            ? old('sort_order', 0)
                            : $photo->sort_order;

                        $selectedPhotoActive = $isThisPhotoForm
                            ? old('is_active') === '1'
                            : (bool) $photo->is_active;

                        $displayPhotoTitle = trim(
                            (string) $photo->title
                        );

                        if ($displayPhotoTitle === '') {
                            $displayPhotoTitle = $facilityTitle;
                        }
                    @endphp


                    <article
                        class="overflow-hidden rounded-3xl
                               border border-slate-100
                               bg-white shadow-lg"
                    >
                        {{-- Preview --}}
                        <div
                            class="relative h-60
                                   overflow-hidden bg-slate-100"
                        >
                            @if ($photoUrl)
                                <img
                                    src="{{ $photoUrl }}"
                                    alt="Dokumentasi {{ $displayPhotoTitle }}"
                                    class="h-full w-full
                                           object-cover object-center"
                                    loading="lazy"
                                >
                            @else
                                <div
                                    class="flex h-full w-full
                                           flex-col items-center
                                           justify-center px-6
                                           text-center"
                                >
                                    <div
                                        class="flex h-16 w-16
                                               items-center justify-center
                                               rounded-2xl bg-red-100
                                               text-red-700"
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
                                                d="M12 9v2m0 4h.01M5.07 19h13.86a2 2 0 001.73-3L13.73 4a2 2 0 00-3.46 0L3.34 16a2 2 0 001.73 3z"
                                            />
                                        </svg>
                                    </div>

                                    <p
                                        class="mt-4 font-bold
                                               text-red-700"
                                    >
                                        File Foto Tidak Ditemukan
                                    </p>

                                    <p
                                        class="mt-2 break-all
                                               text-sm text-slate-500"
                                    >
                                        {{ $photoPath }}
                                    </p>
                                </div>
                            @endif


                            <div class="absolute left-4 top-4">
                                <span
                                    @class([
                                        'inline-flex rounded-full',
                                        'px-3 py-1 text-xs font-bold',
                                        'bg-green-50 text-green-700' =>
                                            $photo->is_active,
                                        'bg-red-50 text-red-700' =>
                                            !$photo->is_active,
                                    ])
                                >
                                    {{ $photo->is_active
                                        ? 'Aktif'
                                        : 'Nonaktif' }}
                                </span>
                            </div>


                            <div
                                class="absolute bottom-4 right-4
                                       rounded-full bg-slate-950/70
                                       px-3 py-1 text-xs
                                       font-bold text-white
                                       backdrop-blur"
                            >
                                Urutan {{ $photo->sort_order }}
                            </div>
                        </div>


                        {{-- Form Edit --}}
                        <form
                            action="{{ route(
                                'admin.facilities.photos.update',
                                $photo
                            ) }}"
                            method="POST"
                            enctype="multipart/form-data"
                            class="space-y-5 p-5"
                            data-photo-form
                            data-original-photo="{{ $photoUrl ?? '' }}"
                        >
                            @csrf
                            @method('PUT')

                            <input
                                type="hidden"
                                name="form_context"
                                value="photo-update"
                            >

                            <input
                                type="hidden"
                                name="photo_id"
                                value="{{ $photo->id }}"
                            >


                            {{-- Judul --}}
                            <div>
                                <label
                                    for="photoTitle{{ $photo->id }}"
                                    class="mb-2 block text-sm
                                           font-bold text-slate-700"
                                >
                                    Judul Foto
                                </label>

                                <input
                                    type="text"
                                    id="photoTitle{{ $photo->id }}"
                                    name="title"
                                    value="{{ $selectedPhotoTitle }}"
                                    maxlength="255"
                                    placeholder="Judul dapat dikosongkan"
                                    class="w-full rounded-xl
                                           border border-slate-200
                                           bg-slate-50 px-4 py-3
                                           transition focus:bg-white
                                           focus:outline-none
                                           focus:ring-2
                                           focus:ring-blue-500"
                                >

                                @if ($isThisPhotoForm)
                                    @error('title')
                                        <p
                                            class="mt-2 text-sm
                                                   font-semibold
                                                   text-red-600"
                                        >
                                            {{ $message }}
                                        </p>
                                    @enderror
                                @endif
                            </div>


                            {{-- Foto Baru --}}
                            <div>
                                <label
                                    for="photoFile{{ $photo->id }}"
                                    class="mb-2 block text-sm
                                           font-bold text-slate-700"
                                >
                                    Ganti Foto
                                </label>

                                <input
                                    type="file"
                                    id="photoFile{{ $photo->id }}"
                                    name="photo"
                                    accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                                    data-photo-input
                                    class="block w-full rounded-xl
                                           border border-slate-200
                                           bg-slate-50 px-3 py-3
                                           text-sm text-slate-600
                                           file:mr-3 file:rounded-lg
                                           file:border-0
                                           file:bg-blue-700
                                           file:px-3 file:py-2
                                           file:text-xs file:font-bold
                                           file:text-white"
                                >

                                <p
                                    class="mt-2 text-xs
                                           leading-5 text-slate-500"
                                >
                                    Kosongkan untuk mempertahankan foto
                                    lama. Maksimal 20 MB.
                                </p>

                                <p
                                    data-photo-client-error
                                    class="mt-2 hidden text-sm
                                           font-semibold text-red-600"
                                    aria-live="assertive"
                                ></p>

                                @if ($isThisPhotoForm)
                                    @error('photo')
                                        <p
                                            class="mt-2 text-sm
                                                   font-semibold
                                                   text-red-600"
                                        >
                                            {{ $message }}
                                        </p>
                                    @enderror
                                @endif
                            </div>


                            {{-- Preview Pengganti --}}
                            <div
                                data-photo-preview-container
                                class="hidden rounded-2xl
                                       border border-slate-100
                                       bg-slate-50 p-4"
                            >
                                <img
                                    src=""
                                    alt="Pratinjau foto pengganti"
                                    data-photo-preview
                                    class="h-40 w-full rounded-xl
                                           object-cover"
                                >

                                <div
                                    data-photo-placeholder
                                    class="hidden h-40 items-center
                                           justify-center text-sm
                                           text-slate-500"
                                >
                                    Tidak ada pratinjau
                                </div>

                                <p
                                    data-photo-information
                                    class="mt-3 break-all text-sm
                                           font-semibold
                                           text-slate-700"
                                ></p>
                            </div>


                            {{-- Urutan --}}
                            <div>
                                <label
                                    for="photoOrder{{ $photo->id }}"
                                    class="mb-2 block text-sm
                                           font-bold text-slate-700"
                                >
                                    Urutan
                                </label>

                                <input
                                    type="number"
                                    id="photoOrder{{ $photo->id }}"
                                    name="sort_order"
                                    value="{{ $selectedPhotoOrder }}"
                                    min="0"
                                    step="1"
                                    inputmode="numeric"
                                    class="w-full rounded-xl
                                           border border-slate-200
                                           bg-slate-50 px-4 py-3
                                           transition focus:bg-white
                                           focus:outline-none
                                           focus:ring-2
                                           focus:ring-blue-500"
                                >

                                @if ($isThisPhotoForm)
                                    @error('sort_order')
                                        <p
                                            class="mt-2 text-sm
                                                   font-semibold
                                                   text-red-600"
                                        >
                                            {{ $message }}
                                        </p>
                                    @enderror
                                @endif
                            </div>


                            {{-- Status --}}
                            <label
                                class="inline-flex cursor-pointer
                                       items-center gap-3"
                            >
                                <input
                                    type="checkbox"
                                    name="is_active"
                                    value="1"
                                    @checked($selectedPhotoActive)
                                    class="h-5 w-5 rounded
                                           border-slate-300
                                           text-blue-700
                                           focus:ring-blue-500"
                                >

                                <span
                                    class="text-sm font-semibold
                                           text-slate-700"
                                >
                                    Tampilkan pada halaman publik
                                </span>
                            </label>


                            <button
                                type="submit"
                                data-submit-button
                                class="w-full rounded-xl
                                       bg-blue-700 px-4 py-3
                                       font-bold text-white
                                       transition hover:bg-blue-800
                                       disabled:cursor-not-allowed
                                       disabled:opacity-60"
                            >
                                Simpan Perubahan
                            </button>
                        </form>


                        {{-- Hapus --}}
                        <form
                            action="{{ route(
                                'admin.facilities.photos.destroy',
                                $photo
                            ) }}"
                            method="POST"
                            class="border-t border-slate-100
                                   p-5 pt-4"
                            onsubmit="return confirm(
                                'Yakin ingin menghapus foto dokumentasi ini? File foto juga akan dihapus dari penyimpanan.'
                            )"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="w-full rounded-xl
                                       bg-red-50 px-4 py-3
                                       font-bold text-red-700
                                       transition hover:bg-red-600
                                       hover:text-white"
                            >
                                Hapus Foto
                            </button>
                        </form>
                    </article>

                @endforeach
            </div>

        @else

            <div class="p-8 text-center sm:p-10">

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
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M4 20h16a2 2 0 002-2V6a2 2 0 00-2-2H4a2 2 0 00-2 2v12a2 2 0 002 2z"
                        />
                    </svg>
                </div>

                <h3
                    class="mt-5 text-2xl font-bold
                           text-slate-800"
                >
                    Belum Ada Foto
                </h3>

                <p
                    class="mx-auto mt-3 max-w-xl
                           leading-7 text-slate-500"
                >
                    Tambahkan foto dokumentasi resmi untuk kategori
                    {{ $facilityTitle }} melalui formulir di atas.
                </p>
            </div>

        @endif
    </section>

</div>


@once
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const maximumFileSize = 20 * 1024 * 1024;

            const allowedMimeTypes = [
                'image/jpeg',
                'image/png',
                'image/webp',
            ];

            const allowedExtensions = [
                'jpg',
                'jpeg',
                'png',
                'webp',
            ];


            function formatFileSize(bytes) {
                if (bytes < 1024 * 1024) {
                    return (bytes / 1024).toFixed(1) + ' KB';
                }

                return (
                    bytes / (1024 * 1024)
                ).toFixed(2) + ' MB';
            }


            function getExtension(fileName) {
                const parts = fileName
                    .toLowerCase()
                    .split('.');

                return parts.length > 1
                    ? parts.pop()
                    : '';
            }


            document
                .querySelectorAll('[data-photo-form]')
                .forEach(function (form) {
                    const input = form.querySelector(
                        '[data-photo-input]'
                    );

                    const previewContainer = form.querySelector(
                        '[data-photo-preview-container]'
                    );

                    const previewImage = form.querySelector(
                        '[data-photo-preview]'
                    );

                    const placeholder = form.querySelector(
                        '[data-photo-placeholder]'
                    );

                    const information = form.querySelector(
                        '[data-photo-information]'
                    );

                    const errorElement = form.querySelector(
                        '[data-photo-client-error]'
                    );

                    const submitButton = form.querySelector(
                        '[data-submit-button]'
                    );

                    let photoIsValid = true;
                    let previewUrl = null;


                    function clearPreviewUrl() {
                        if (previewUrl) {
                            URL.revokeObjectURL(previewUrl);
                            previewUrl = null;
                        }
                    }


                    function resetMessages() {
                        photoIsValid = true;

                        if (errorElement) {
                            errorElement.textContent = '';
                            errorElement.classList.add('hidden');
                        }

                        if (information) {
                            information.textContent = '';
                        }
                    }


                    function hidePreview() {
                        clearPreviewUrl();

                        if (previewContainer) {
                            previewContainer.classList.add('hidden');
                        }

                        if (previewImage) {
                            previewImage.src = '';
                        }

                        if (placeholder) {
                            placeholder.classList.add('hidden');
                        }
                    }


                    function showError(message) {
                        photoIsValid = false;

                        if (errorElement) {
                            errorElement.textContent = message;
                            errorElement.classList.remove('hidden');
                        }
                    }


                    if (input) {
                        input.addEventListener('change', function () {
                            resetMessages();
                            hidePreview();

                            const file = this.files
                                ? this.files[0]
                                : null;

                            if (!file) {
                                return;
                            }

                            const extension = getExtension(file.name);

                            const validMime =
                                file.type === ''
                                || allowedMimeTypes.includes(file.type);

                            const validExtension =
                                allowedExtensions.includes(extension);

                            if (!validMime || !validExtension) {
                                showError(
                                    'Format foto harus JPG, JPEG, PNG, atau WEBP.'
                                );

                                this.value = '';

                                return;
                            }

                            if (file.size > maximumFileSize) {
                                showError(
                                    'Ukuran foto '
                                    + formatFileSize(file.size)
                                    + '. Maksimal ukuran foto adalah 20 MB.'
                                );

                                this.value = '';

                                return;
                            }

                            previewUrl = URL.createObjectURL(file);

                            if (previewImage) {
                                previewImage.src = previewUrl;
                            }

                            if (previewContainer) {
                                previewContainer.classList.remove(
                                    'hidden'
                                );
                            }

                            if (information) {
                                information.textContent =
                                    file.name
                                    + ' • '
                                    + formatFileSize(file.size);
                            }
                        });
                    }


                    form.addEventListener('submit', function (event) {
                        if (!photoIsValid) {
                            event.preventDefault();

                            return;
                        }

                        if (submitButton) {
                            submitButton.disabled = true;
                            submitButton.textContent = 'Menyimpan...';
                        }
                    });


                    window.addEventListener(
                        'beforeunload',
                        clearPreviewUrl
                    );
                });


            document
                .querySelectorAll('[data-disable-submit-form]')
                .forEach(function (form) {
                    form.addEventListener('submit', function () {
                        const submitButton = form.querySelector(
                            '[data-submit-button]'
                        );

                        if (submitButton) {
                            submitButton.disabled = true;
                            submitButton.textContent = 'Menyimpan...';
                        }
                    });
                });
        });
    </script>
@endonce

@endsection