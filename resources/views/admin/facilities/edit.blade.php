@extends('layouts.admin')

@section('title', 'Kelola Dokumentasi Fasilitas')

@section('content')

@php
    $facilityTitle = trim(
        (string) $facility->title
    );

    $facilityDescription = trim(
        (string) $facility->description
    );

    $facilityCategoryLabel =
        $facility->category_label;

    $photos = collect(
        $facility->photos ?? []
    );

    $totalPhotos = $photos->count();

    $shownPhotos = $photos
        ->filter(
            fn ($photo): bool =>
                (bool) $photo->is_active
        )
        ->count();

    $hiddenPhotos =
        $totalPhotos - $shownPhotos;

    $formContext =
        (string) old(
            'form_context',
            ''
        );

    $facilityFormHasErrors =
        $formContext === 'facility-update';

    $createPhotoFormHasErrors =
        $formContext === 'photo-create';

    $selectedFacilityActive =
        $facilityFormHasErrors
            ? old('is_active') === '1'
            : (bool) $facility->is_active;

    $selectedCreatePhotoActive =
        $createPhotoFormHasErrors
            ? old('is_active') === '1'
            : true;

    $facilitySortOrder =
        $facilityFormHasErrors
            ? old(
                'sort_order',
                $facility->sort_order ?? 0
            )
            : ($facility->sort_order ?? 0);

    $newPhotoSortOrder =
        $createPhotoFormHasErrors
            ? old('sort_order', 0)
            : 0;
@endphp


<div class="mx-auto max-w-7xl space-y-6">

    {{-- HEADER --}}
    <header
        class="flex flex-col gap-4
               lg:flex-row lg:items-end
               lg:justify-between"
    >
        <div>
            <a
                href="{{ route(
                    'admin.facilities.index'
                ) }}"
                class="inline-flex items-center
                       gap-2 text-sm font-bold
                       text-[#075F9B]
                       hover:underline"
            >
                <span aria-hidden="true">←</span>
                <span>Kembali ke Dokumentasi Fasilitas</span>
            </a>

            <div class="mt-5 flex items-center gap-3">
                <span
                    class="h-px w-8 bg-[#D7B33E]"
                    aria-hidden="true"
                ></span>

                <p
                    class="text-[11px] font-bold
                           uppercase tracking-[0.16em]
                           text-[#075F9B]"
                >
                    {{ $facilityCategoryLabel }}
                </p>
            </div>

            <h1
                class="mt-3 text-2xl font-extrabold
                       tracking-tight text-slate-900
                       sm:text-3xl"
            >
                {{ $facilityTitle }}
            </h1>

            <p
                class="mt-2 max-w-3xl
                       text-sm leading-7
                       text-slate-500"
            >
                Kelola informasi kategori dan seluruh
                foto dokumentasinya.
            </p>
        </div>


        <a
            href="{{ url('/facilities') }}"
            target="_blank"
            rel="noopener noreferrer"
            class="inline-flex w-full items-center
                   justify-center rounded-xl
                   border border-slate-200
                   bg-white px-5 py-3
                   text-sm font-bold
                   text-slate-700 transition
                   hover:border-blue-200
                   hover:text-[#075F9B]
                   sm:w-auto"
        >
            Lihat Halaman Publik
        </a>
    </header>


    {{-- ALERT --}}
    @foreach ([
        'success' => [
            'border-emerald-200',
            'bg-emerald-50',
            'text-emerald-800',
        ],
        'error' => [
            'border-red-200',
            'bg-red-50',
            'text-red-700',
        ],
    ] as $messageType => $classes)
        @if (session($messageType))
            <div
                class="rounded-xl border
                       {{ implode(' ', $classes) }}
                       px-4 py-3 text-sm font-semibold"
                role="status"
            >
                {{ session($messageType) }}
            </div>
        @endif
    @endforeach

    @if ($errors->any())
        <div
            class="rounded-xl border
                   border-red-200 bg-red-50
                   px-4 py-4 text-red-800"
            role="alert"
        >
            <p class="text-sm font-bold">
                Data belum dapat disimpan:
            </p>

            <ul
                class="mt-2 list-inside list-disc
                       space-y-1 text-sm"
            >
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
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
                Ringkasan Dokumentasi
            </h2>

            <p
                class="mt-1 text-xs
                       leading-5 text-slate-500"
            >
                Foto yang disembunyikan tetap tersimpan
                tetapi tidak tampil kepada pengunjung.
            </p>
        </div>

        <div
            class="grid grid-cols-3
                   divide-x divide-slate-200
                   text-center"
        >
            <div class="px-4">
                <p
                    class="text-xl font-extrabold
                           text-slate-900"
                >
                    {{ $totalPhotos }}
                </p>

                <p class="mt-1 text-[10px] text-slate-500">
                    Total
                </p>
            </div>

            <div class="px-4">
                <p
                    class="text-xl font-extrabold
                           text-emerald-600"
                >
                    {{ $shownPhotos }}
                </p>

                <p class="mt-1 text-[10px] text-slate-500">
                    Ditampilkan
                </p>
            </div>

            <div class="px-4">
                <p
                    class="text-xl font-extrabold
                           text-slate-500"
                >
                    {{ $hiddenPhotos }}
                </p>

                <p class="mt-1 text-[10px] text-slate-500">
                    Disembunyikan
                </p>
            </div>
        </div>
    </section>


    {{-- INFORMASI KATEGORI --}}
    <section
        class="overflow-hidden rounded-2xl
               border border-slate-200
               bg-white"
    >
        <form
            action="{{ route(
                'admin.facilities.update',
                $facility
            ) }}"
            method="POST"
            data-disable-submit-form
        >
            @csrf
            @method('PUT')

            <input
                type="hidden"
                name="form_context"
                value="facility-update"
            >

            <input
                type="hidden"
                name="sort_order"
                value="{{ $facilitySortOrder }}"
            >

            <input
                type="hidden"
                name="is_active"
                value="0"
            >


            <div class="px-5 py-6 sm:px-6 lg:px-8">
                <div
                    class="border-b border-slate-200
                           pb-5"
                >
                    <h2
                        class="text-lg font-extrabold
                               text-slate-900"
                    >
                        Informasi Kategori
                    </h2>

                    <p
                        class="mt-1 text-sm
                               leading-6 text-slate-500"
                    >
                        Judul dan deskripsi digunakan pada
                        halaman fasilitas.
                    </p>
                </div>


                <div
                    class="mt-6 grid gap-5
                           lg:grid-cols-2"
                >
                    <div>
                        <label
                            for="facilityTitle"
                            class="block text-sm
                                   font-bold text-slate-800"
                        >
                            Judul fasilitas
                        </label>

                        <input
                            id="facilityTitle"
                            type="text"
                            name="title"
                            value="{{ $facilityFormHasErrors
                                ? old('title')
                                : $facility->title }}"
                            maxlength="255"
                            required
                            class="mt-2 w-full
                                   rounded-xl border
                                   border-slate-200
                                   px-4 py-3 text-sm
                                   text-slate-800 outline-none
                                   transition
                                   focus:border-[#075F9B]
                                   focus:ring-4
                                   focus:ring-blue-100"
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


                    <div>
                        <p
                            class="block text-sm
                                   font-bold text-slate-800"
                        >
                            Kategori
                        </p>

                        <div
                            class="mt-2 rounded-xl
                                   border border-slate-200
                                   bg-slate-50
                                   px-4 py-3 text-sm
                                   font-semibold text-slate-600"
                        >
                            {{ $facilityCategoryLabel }}
                        </div>
                    </div>
                </div>


                <div class="mt-5">
                    <label
                        for="facilityDescription"
                        class="block text-sm
                               font-bold text-slate-800"
                    >
                        Deskripsi
                    </label>

                    <p
                        class="mt-1 text-xs
                               leading-6 text-slate-500"
                    >
                        Boleh dikosongkan apabila materi
                        resmi belum tersedia.
                    </p>

                    <textarea
                        id="facilityDescription"
                        name="description"
                        rows="6"
                        placeholder="Tuliskan uraian fasilitas..."
                        class="mt-2 w-full
                               rounded-xl border
                               border-slate-200
                               px-4 py-3 text-sm
                               leading-7 text-slate-800
                               outline-none transition
                               focus:border-[#075F9B]
                               focus:ring-4
                               focus:ring-blue-100"
                    >{{ $facilityFormHasErrors
                        ? old('description')
                        : $facilityDescription }}</textarea>

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


                <label
                    class="mt-5 flex cursor-pointer
                           items-start gap-3
                           border-t border-slate-200
                           pt-5"
                >
                    <input
                        type="checkbox"
                        name="is_active"
                        value="1"
                        class="mt-1 h-4 w-4
                               rounded border-slate-300
                               text-[#075F9B]
                               focus:ring-blue-200"
                        {{ $selectedFacilityActive
                            ? 'checked'
                            : '' }}
                    >

                    <span>
                        <span
                            class="block text-sm
                                   font-bold text-slate-800"
                        >
                            Tampilkan kategori ini di website
                        </span>

                        <span
                            class="mt-1 block text-xs
                                   leading-6 text-slate-500"
                        >
                            Ketika disembunyikan, seluruh foto
                            pada kategori ini juga tidak tampil.
                        </span>
                    </span>
                </label>
            </div>


            <footer
                class="flex flex-col gap-4
                       border-t border-slate-200
                       bg-slate-50 px-5 py-5
                       sm:flex-row sm:items-center
                       sm:justify-between
                       sm:px-6 lg:px-8"
            >
                <p
                    class="text-sm leading-6
                           text-slate-500"
                >
                    Simpan setelah informasi kategori diperbarui.
                </p>

                <button
                    type="submit"
                    data-submit-button
                    class="inline-flex items-center
                           justify-center rounded-xl
                           bg-[#075F9B] px-6 py-3
                           text-sm font-bold text-white
                           transition hover:bg-[#064B7B]
                           disabled:cursor-not-allowed
                           disabled:opacity-70"
                >
                    Simpan Informasi
                </button>
            </footer>
        </form>
    </section>


    {{-- TAMBAH FOTO --}}
    <section
        class="overflow-hidden rounded-2xl
               border border-slate-200
               bg-white"
    >
        <form
            action="{{ route(
                'admin.facilities.photos.store',
                $facility
            ) }}"
            method="POST"
            enctype="multipart/form-data"
            data-photo-form
        >
            @csrf

            <input
                type="hidden"
                name="form_context"
                value="photo-create"
            >

            <input
                type="hidden"
                name="sort_order"
                value="{{ $newPhotoSortOrder }}"
            >

            <input
                type="hidden"
                name="is_active"
                value="0"
            >


            <div class="px-5 py-6 sm:px-6 lg:px-8">
                <div
                    class="border-b border-slate-200
                           pb-5"
                >
                    <h2
                        class="text-lg font-extrabold
                               text-slate-900"
                    >
                        Tambah Foto
                    </h2>

                    <p
                        class="mt-1 text-sm
                               leading-6 text-slate-500"
                    >
                        Tambahkan foto dokumentasi untuk
                        {{ $facilityTitle }}.
                    </p>
                </div>


                <div
                    class="mt-6 grid gap-5
                           lg:grid-cols-2"
                >
                    <div>
                        <label
                            for="newPhotoTitle"
                            class="block text-sm
                                   font-bold text-slate-800"
                        >
                            Judul foto
                        </label>

                        <input
                            id="newPhotoTitle"
                            type="text"
                            name="title"
                            value="{{ $createPhotoFormHasErrors
                                ? old('title')
                                : '' }}"
                            maxlength="255"
                            placeholder="Boleh dikosongkan"
                            class="mt-2 w-full
                                   rounded-xl border
                                   border-slate-200
                                   px-4 py-3 text-sm
                                   text-slate-800 outline-none
                                   transition
                                   focus:border-[#075F9B]
                                   focus:ring-4
                                   focus:ring-blue-100"
                        >

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


                    <div>
                        <label
                            for="newFacilityPhoto"
                            class="block text-sm
                                   font-bold text-slate-800"
                        >
                            Foto dokumentasi
                        </label>

                        <p
                            class="mt-1 text-xs
                                   leading-6 text-slate-500"
                        >
                            JPG, JPEG, PNG, atau WebP maksimal
                            20 MB.
                        </p>

                        <input
                            id="newFacilityPhoto"
                            type="file"
                            name="photo"
                            required
                            accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                            data-photo-input
                            class="mt-3 block w-full
                                   rounded-xl border
                                   border-slate-200
                                   bg-white px-3 py-2.5
                                   text-sm text-slate-600
                                   file:mr-3
                                   file:rounded-lg
                                   file:border-0
                                   file:bg-[#075F9B]
                                   file:px-4 file:py-2
                                   file:text-sm file:font-bold
                                   file:text-white
                                   hover:file:bg-[#064B7B]"
                        >

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
                </div>


                <div
                    data-photo-preview-container
                    class="mt-5 hidden rounded-xl
                           border border-blue-200
                           bg-blue-50 p-4"
                >
                    <div
                        class="flex flex-col gap-4
                               sm:flex-row sm:items-center"
                    >
                        <img
                            src=""
                            alt="Pratinjau foto baru"
                            data-photo-preview
                            class="h-32 w-full rounded-xl
                                   object-cover sm:w-48"
                        >

                        <p
                            data-photo-information
                            class="break-all text-sm
                                   font-bold text-slate-800"
                        ></p>
                    </div>
                </div>


                <label
                    class="mt-5 flex cursor-pointer
                           items-start gap-3
                           border-t border-slate-200
                           pt-5"
                >
                    <input
                        type="checkbox"
                        name="is_active"
                        value="1"
                        class="mt-1 h-4 w-4
                               rounded border-slate-300
                               text-[#075F9B]
                               focus:ring-blue-200"
                        {{ $selectedCreatePhotoActive
                            ? 'checked'
                            : '' }}
                    >

                    <span>
                        <span
                            class="block text-sm
                                   font-bold text-slate-800"
                        >
                            Tampilkan foto ini di website
                        </span>

                        <span
                            class="mt-1 block text-xs
                                   leading-6 text-slate-500"
                        >
                            Foto dapat disembunyikan kembali
                            melalui daftar dokumentasi.
                        </span>
                    </span>
                </label>
            </div>


            <footer
                class="flex flex-col gap-4
                       border-t border-slate-200
                       bg-slate-50 px-5 py-5
                       sm:flex-row sm:items-center
                       sm:justify-between
                       sm:px-6 lg:px-8"
            >
                <p
                    class="text-sm leading-6
                           text-slate-500"
                >
                    Pastikan foto sesuai dengan kategori ini.
                </p>

                <button
                    type="submit"
                    data-submit-button
                    class="inline-flex items-center
                           justify-center rounded-xl
                           bg-[#075F9B] px-6 py-3
                           text-sm font-bold text-white
                           transition hover:bg-[#064B7B]
                           disabled:cursor-not-allowed
                           disabled:opacity-70"
                >
                    Tambah Foto
                </button>
            </footer>
        </form>
    </section>


    {{-- DAFTAR FOTO --}}
    <section
        class="overflow-hidden rounded-2xl
               border border-slate-200
               bg-white"
        aria-labelledby="facilityPhotoListTitle"
    >
        <div
            class="border-b border-slate-200
                   px-5 py-5 sm:px-6"
        >
            <h2
                id="facilityPhotoListTitle"
                class="text-lg font-extrabold
                       text-slate-900"
            >
                Foto Dokumentasi
            </h2>

            <p
                class="mt-1 text-sm text-slate-500"
            >
                Tekan Ubah Foto untuk memperbarui judul,
                gambar, atau status tampil.
            </p>
        </div>


        @if ($photos->isNotEmpty())
            <div
                class="grid gap-5 p-5
                       md:grid-cols-2 md:p-6
                       xl:grid-cols-3"
            >
                @foreach ($photos as $photo)
                    @php
                        $photoPath = trim(
                            (string) $photo->photo
                        );

                        $photoExists =
                            $photoPath !== ''
                            && \Illuminate\Support\Facades\Storage::disk(
                                'public'
                            )->exists($photoPath);

                        $photoUrl = $photoExists
                            ? asset(
                                'storage/'
                                . ltrim($photoPath, '/')
                            )
                            : null;

                        $isThisPhotoForm =
                            $formContext === 'photo-update'
                            && (string) old('photo_id')
                                === (string) $photo->id;

                        $selectedPhotoTitle =
                            $isThisPhotoForm
                                ? old('title')
                                : $photo->title;

                        $selectedPhotoOrder =
                            $isThisPhotoForm
                                ? old(
                                    'sort_order',
                                    $photo->sort_order ?? 0
                                )
                                : ($photo->sort_order ?? 0);

                        $selectedPhotoActive =
                            $isThisPhotoForm
                                ? old('is_active') === '1'
                                : (bool) $photo->is_active;

                        $displayPhotoTitle = trim(
                            (string) $photo->title
                        );

                        if ($displayPhotoTitle === '') {
                            $displayPhotoTitle =
                                $facilityTitle;
                        }
                    @endphp


                    <article
                        class="overflow-hidden rounded-2xl
                               border border-slate-200
                               bg-white"
                    >
                        <div
                            class="relative h-52
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
                                           justify-center px-5
                                           text-center"
                                >
                                    <p
                                        class="text-sm font-bold
                                               text-red-600"
                                    >
                                        File foto tidak ditemukan
                                    </p>

                                    <p
                                        class="mt-2 break-all
                                               text-xs text-slate-500"
                                    >
                                        {{ $photoPath }}
                                    </p>
                                </div>
                            @endif

                            <span
                                @class([
                                    'absolute left-3 top-3',
                                    'inline-flex rounded-full',
                                    'px-2.5 py-1 text-[10px]',
                                    'font-bold',
                                    'bg-emerald-50 text-emerald-700' =>
                                        $photo->is_active,
                                    'bg-slate-100 text-slate-500' =>
                                        !$photo->is_active,
                                ])
                            >
                                {{ $photo->is_active
                                    ? 'Ditampilkan'
                                    : 'Disembunyikan' }}
                            </span>
                        </div>


                        <div class="p-4">
                            <h3
                                class="font-extrabold
                                       leading-6 text-slate-800"
                            >
                                {{ $displayPhotoTitle }}
                            </h3>
                        </div>


                        <details
                            class="group border-t
                                   border-slate-200"
                            @if (
                                $isThisPhotoForm
                                && $errors->any()
                            )
                                open
                            @endif
                        >
                            <summary
                                class="flex cursor-pointer
                                       list-none items-center
                                       justify-between
                                       px-4 py-3 text-sm
                                       font-bold text-[#075F9B]"
                            >
                                <span>Ubah Foto</span>

                                <span
                                    class="transition
                                           group-open:rotate-180"
                                    aria-hidden="true"
                                >
                                    ↓
                                </span>
                            </summary>


                            <form
                                action="{{ route(
                                    'admin.facilities.photos.update',
                                    $photo
                                ) }}"
                                method="POST"
                                enctype="multipart/form-data"
                                class="space-y-4
                                       border-t border-slate-200
                                       p-4"
                                data-photo-form
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

                                <input
                                    type="hidden"
                                    name="sort_order"
                                    value="{{ $selectedPhotoOrder }}"
                                >

                                <input
                                    type="hidden"
                                    name="is_active"
                                    value="0"
                                >


                                <div>
                                    <label
                                        for="photoTitle{{ $photo->id }}"
                                        class="block text-sm
                                               font-bold text-slate-800"
                                    >
                                        Judul foto
                                    </label>

                                    <input
                                        id="photoTitle{{ $photo->id }}"
                                        type="text"
                                        name="title"
                                        value="{{ $selectedPhotoTitle }}"
                                        maxlength="255"
                                        placeholder="Boleh dikosongkan"
                                        class="mt-2 w-full
                                               rounded-xl border
                                               border-slate-200
                                               px-4 py-2.5
                                               text-sm text-slate-800
                                               outline-none transition
                                               focus:border-[#075F9B]"
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


                                <div>
                                    <label
                                        for="photoFile{{ $photo->id }}"
                                        class="block text-sm
                                               font-bold text-slate-800"
                                    >
                                        Ganti foto
                                    </label>

                                    <p
                                        class="mt-1 text-xs
                                               leading-5 text-slate-500"
                                    >
                                        Kosongkan untuk mempertahankan
                                        foto lama. Maksimal 20 MB.
                                    </p>

                                    <input
                                        id="photoFile{{ $photo->id }}"
                                        type="file"
                                        name="photo"
                                        accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                                        data-photo-input
                                        class="mt-3 block w-full
                                               rounded-xl border
                                               border-slate-200
                                               bg-white px-3 py-2
                                               text-sm text-slate-600
                                               file:mr-2
                                               file:rounded-lg
                                               file:border-0
                                               file:bg-[#075F9B]
                                               file:px-3 file:py-2
                                               file:text-xs file:font-bold
                                               file:text-white"
                                    >

                                    <p
                                        data-photo-client-error
                                        class="mt-2 hidden text-xs
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


                                <div
                                    data-photo-preview-container
                                    class="hidden rounded-xl
                                           border border-blue-200
                                           bg-blue-50 p-3"
                                >
                                    <img
                                        src=""
                                        alt="Pratinjau foto pengganti"
                                        data-photo-preview
                                        class="h-36 w-full
                                               rounded-lg object-cover"
                                    >

                                    <p
                                        data-photo-information
                                        class="mt-2 break-all text-xs
                                               font-semibold text-slate-700"
                                    ></p>
                                </div>


                                <label
                                    class="flex cursor-pointer
                                           items-start gap-3"
                                >
                                    <input
                                        type="checkbox"
                                        name="is_active"
                                        value="1"
                                        class="mt-1 h-4 w-4
                                               rounded border-slate-300
                                               text-[#075F9B]"
                                        {{ $selectedPhotoActive
                                            ? 'checked'
                                            : '' }}
                                    >

                                    <span
                                        class="text-sm font-semibold
                                               text-slate-700"
                                    >
                                        Tampilkan foto ini di website
                                    </span>
                                </label>


                                <button
                                    type="submit"
                                    data-submit-button
                                    class="inline-flex w-full
                                           items-center justify-center
                                           rounded-xl bg-[#075F9B]
                                           px-4 py-2.5
                                           text-sm font-bold text-white
                                           transition hover:bg-[#064B7B]
                                           disabled:cursor-not-allowed
                                           disabled:opacity-70"
                                >
                                    Simpan Perubahan
                                </button>
                            </form>
                        </details>


                        <form
                            action="{{ route(
                                'admin.facilities.photos.destroy',
                                $photo
                            ) }}"
                            method="POST"
                            class="border-t border-slate-200
                                   p-4"
                            onsubmit="return confirm(
                                'Hapus foto dokumentasi ini? File foto juga akan dihapus.'
                            )"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="inline-flex w-full
                                       items-center justify-center
                                       rounded-xl bg-red-50
                                       px-4 py-2.5
                                       text-sm font-bold
                                       text-red-600
                                       transition hover:bg-red-100"
                            >
                                Hapus Foto
                            </button>
                        </form>
                    </article>
                @endforeach
            </div>
        @else
            <div class="px-6 py-14 text-center">
                <p
                    class="text-sm font-bold
                           text-slate-700"
                >
                    Belum ada foto dokumentasi
                </p>

                <p
                    class="mt-2 text-sm
                           text-slate-500"
                >
                    Tambahkan foto melalui formulir di atas.
                </p>
            </div>
        @endif
    </section>
</div>


@once
    <script>
        document.addEventListener(
            'DOMContentLoaded',
            function () {
                const maximumFileSize =
                    20 * 1024 * 1024;

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
                        return (
                            bytes / 1024
                        ).toFixed(1) + ' KB';
                    }

                    return (
                        bytes / (1024 * 1024)
                    ).toFixed(2) + ' MB';
                }


                function extensionOf(fileName) {
                    const parts = fileName
                        .toLowerCase()
                        .split('.');

                    return parts.length > 1
                        ? parts.pop()
                        : '';
                }


                document
                    .querySelectorAll(
                        '[data-photo-form]'
                    )
                    .forEach(
                        function (form) {
                            const input =
                                form.querySelector(
                                    '[data-photo-input]'
                                );

                            const previewContainer =
                                form.querySelector(
                                    '[data-photo-preview-container]'
                                );

                            const previewImage =
                                form.querySelector(
                                    '[data-photo-preview]'
                                );

                            const information =
                                form.querySelector(
                                    '[data-photo-information]'
                                );

                            const errorElement =
                                form.querySelector(
                                    '[data-photo-client-error]'
                                );

                            const submitButton =
                                form.querySelector(
                                    '[data-submit-button]'
                                );

                            let photoIsValid = true;
                            let previewUrl = null;


                            function clearPreviewUrl() {
                                if (!previewUrl) {
                                    return;
                                }

                                URL.revokeObjectURL(
                                    previewUrl
                                );

                                previewUrl = null;
                            }


                            function resetPreview() {
                                clearPreviewUrl();

                                photoIsValid = true;

                                previewContainer
                                    ?.classList
                                    .add('hidden');

                                if (previewImage) {
                                    previewImage.src = '';
                                }

                                if (information) {
                                    information.textContent = '';
                                }

                                if (errorElement) {
                                    errorElement.textContent = '';
                                    errorElement.classList.add(
                                        'hidden'
                                    );
                                }
                            }


                            function showError(message) {
                                photoIsValid = false;

                                if (!errorElement) {
                                    return;
                                }

                                errorElement.textContent =
                                    message;

                                errorElement.classList.remove(
                                    'hidden'
                                );
                            }


                            input?.addEventListener(
                                'change',
                                function () {
                                    resetPreview();

                                    const file =
                                        input.files?.[0];

                                    if (!file) {
                                        return;
                                    }

                                    const extension =
                                        extensionOf(
                                            file.name
                                        );

                                    const validMime =
                                        file.type === ''
                                        || allowedMimeTypes.includes(
                                            file.type
                                        );

                                    const validExtension =
                                        allowedExtensions.includes(
                                            extension
                                        );

                                    if (
                                        !validMime
                                        || !validExtension
                                    ) {
                                        showError(
                                            'Format foto harus JPG, JPEG, PNG, atau WebP.'
                                        );

                                        input.value = '';

                                        return;
                                    }

                                    if (
                                        file.size
                                        > maximumFileSize
                                    ) {
                                        showError(
                                            'Ukuran foto '
                                            + formatFileSize(
                                                file.size
                                            )
                                            + '. Maksimal 20 MB.'
                                        );

                                        input.value = '';

                                        return;
                                    }

                                    previewUrl =
                                        URL.createObjectURL(
                                            file
                                        );

                                    if (previewImage) {
                                        previewImage.src =
                                            previewUrl;
                                    }

                                    if (information) {
                                        information.textContent =
                                            file.name
                                            + ' • '
                                            + formatFileSize(
                                                file.size
                                            );
                                    }

                                    previewContainer
                                        ?.classList
                                        .remove('hidden');
                                }
                            );


                            form.addEventListener(
                                'submit',
                                function (event) {
                                    if (!photoIsValid) {
                                        event.preventDefault();

                                        return;
                                    }

                                    if (!submitButton) {
                                        return;
                                    }

                                    submitButton.disabled = true;
                                    submitButton.textContent =
                                        'Menyimpan...';
                                }
                            );


                            window.addEventListener(
                                'beforeunload',
                                clearPreviewUrl
                            );
                        }
                    );


                document
                    .querySelectorAll(
                        '[data-disable-submit-form]'
                    )
                    .forEach(
                        function (form) {
                            form.addEventListener(
                                'submit',
                                function () {
                                    const submitButton =
                                        form.querySelector(
                                            '[data-submit-button]'
                                        );

                                    if (!submitButton) {
                                        return;
                                    }

                                    submitButton.disabled = true;
                                    submitButton.textContent =
                                        'Menyimpan...';
                                }
                            );
                        }
                    );
            }
        );
    </script>
@endonce

@endsection
