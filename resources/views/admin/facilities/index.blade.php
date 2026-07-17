@extends('layouts.admin')

@section('title', 'Dokumentasi Fasilitas')

@section('content')

@php
    $facilityItems = collect($facilities ?? []);

    $totalCategories = $facilityItems->count();

    $shownCategories = $facilityItems
        ->filter(
            fn ($facility): bool =>
                (bool) $facility->is_active
        )
        ->count();

    $totalPhotos = $facilityItems
        ->sum(
            fn ($facility): int =>
                (int) ($facility->photos_count ?? 0)
        );

    $selectedPhotoActive =
        (string) old(
            'is_active',
            '1'
        ) === '1';
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
                    Pengelolaan Fasilitas
                </p>
            </div>

            <h1
                class="mt-3 text-2xl font-extrabold
                       tracking-tight text-slate-900
                       sm:text-3xl"
            >
                Dokumentasi Fasilitas
            </h1>

            <p
                class="mt-2 max-w-3xl
                       text-sm leading-7
                       text-slate-500"
            >
                Kelola foto fasilitas dan aktivitas mahasiswa
                Program Studi D-IV TMPP.
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
            Lihat Halaman Fasilitas
        </a>
    </header>


    {{-- ALERT --}}
    @foreach ([
        'success' => [
            'border-emerald-200',
            'bg-emerald-50',
            'text-emerald-800',
        ],
        'warning' => [
            'border-amber-200',
            'bg-amber-50',
            'text-amber-800',
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
                Foto belum dapat ditambahkan:
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
                Foto dikelompokkan berdasarkan kategori
                fasilitas.
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
                    {{ $totalCategories }}
                </p>

                <p class="mt-1 text-[10px] text-slate-500">
                    Kategori
                </p>
            </div>

            <div class="px-4">
                <p
                    class="text-xl font-extrabold
                           text-emerald-600"
                >
                    {{ $shownCategories }}
                </p>

                <p class="mt-1 text-[10px] text-slate-500">
                    Ditampilkan
                </p>
            </div>

            <div class="px-4">
                <p
                    class="text-xl font-extrabold
                           text-[#075F9B]"
                >
                    {{ $totalPhotos }}
                </p>

                <p class="mt-1 text-[10px] text-slate-500">
                    Foto
                </p>
            </div>
        </div>
    </section>


    @if ($facilityItems->isNotEmpty())

        {{-- TAMBAH FOTO --}}
        <section
            class="overflow-hidden rounded-2xl
                   border border-slate-200
                   bg-white"
        >
            <form
                id="facilityPhotoCreateForm"
                action="{{ route(
                    'admin.facilities.photos.store-general'
                ) }}"
                method="POST"
                enctype="multipart/form-data"
            >
                @csrf

                <input
                    type="hidden"
                    name="sort_order"
                    value="{{ old('sort_order', 0) }}"
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
                            Tambah Foto Dokumentasi
                        </h2>

                        <p
                            class="mt-1 text-sm
                                   leading-6 text-slate-500"
                        >
                            Pilih kategori, beri judul bila perlu,
                            lalu unggah foto.
                        </p>
                    </div>


                    <div
                        class="mt-6 grid gap-5
                               lg:grid-cols-2"
                    >
                        <div>
                            <label
                                for="facilityId"
                                class="block text-sm
                                       font-bold text-slate-800"
                            >
                                Kategori fasilitas
                            </label>

                            <select
                                id="facilityId"
                                name="facility_id"
                                required
                                class="mt-2 w-full
                                       rounded-xl border
                                       border-slate-200
                                       bg-white px-4 py-3
                                       text-sm text-slate-800
                                       outline-none transition
                                       focus:border-[#075F9B]
                                       focus:ring-4
                                       focus:ring-blue-100"
                            >
                                <option value="">
                                    Pilih kategori
                                </option>

                                @foreach (
                                    $facilityItems
                                    as $facility
                                )
                                    <option
                                        value="{{ $facility->id }}"
                                        @selected(
                                            (string) old(
                                                'facility_id'
                                            )
                                            === (string) $facility->id
                                        )
                                    >
                                        {{ $facility->title }}
                                    </option>
                                @endforeach
                            </select>

                            @error('facility_id')
                                <p
                                    class="mt-2 text-sm
                                           font-semibold text-red-600"
                                >
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        <div>
                            <label
                                for="photoTitle"
                                class="block text-sm
                                       font-bold text-slate-800"
                            >
                                Judul foto
                            </label>

                            <input
                                id="photoTitle"
                                type="text"
                                name="title"
                                value="{{ old('title') }}"
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

                            @error('title')
                                <p
                                    class="mt-2 text-sm
                                           font-semibold text-red-600"
                                >
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>


                    <div class="mt-5">
                        <label
                            for="facilityPhotoInput"
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
                            id="facilityPhotoInput"
                            type="file"
                            name="photo"
                            required
                            accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
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
                            id="facilityPhotoError"
                            class="mt-2 hidden text-sm
                                   font-semibold text-red-600"
                            aria-live="assertive"
                        ></p>

                        @error('photo')
                            <p
                                class="mt-2 text-sm
                                       font-semibold text-red-600"
                            >
                                {{ $message }}
                            </p>
                        @enderror
                    </div>


                    <div
                        id="facilityPhotoPreviewContainer"
                        class="mt-5 hidden rounded-xl
                               border border-blue-200
                               bg-blue-50 p-4"
                    >
                        <div
                            class="flex flex-col gap-4
                                   sm:flex-row sm:items-center"
                        >
                            <img
                                id="facilityPhotoPreview"
                                src=""
                                alt="Pratinjau foto dokumentasi"
                                class="h-32 w-full
                                       rounded-xl object-cover
                                       sm:w-48"
                            >

                            <div class="min-w-0">
                                <p
                                    id="facilityPhotoFileName"
                                    class="break-all text-sm
                                           font-bold text-slate-800"
                                ></p>

                                <p
                                    id="facilityPhotoFileSize"
                                    class="mt-1 text-xs
                                           text-slate-500"
                                ></p>
                            </div>
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
                            {{ $selectedPhotoActive
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
                                Hilangkan centang untuk menyimpan
                                tanpa menampilkannya.
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
                        Pastikan kategori dan foto sudah benar.
                    </p>

                    <button
                        id="facilityPhotoSubmit"
                        type="submit"
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


        {{-- DAFTAR KATEGORI --}}
        <section
            class="overflow-hidden rounded-2xl
                   border border-slate-200
                   bg-white"
            aria-labelledby="facilityCategoryListTitle"
        >
            <div
                class="border-b border-slate-200
                       px-5 py-5 sm:px-6"
            >
                <h2
                    id="facilityCategoryListTitle"
                    class="text-lg font-extrabold
                           text-slate-900"
                >
                    Kategori Dokumentasi
                </h2>

                <p
                    class="mt-1 text-sm text-slate-500"
                >
                    Buka salah satu kategori untuk mengelola
                    informasi dan seluruh fotonya.
                </p>
            </div>


            <div class="divide-y divide-slate-200">
                @foreach ($facilityItems as $facility)
                    @php
                        $description = trim(
                            (string) $facility->description
                        );

                        $photoCount = (int) (
                            $facility->photos_count ?? 0
                        );
                    @endphp

                    <article
                        class="grid gap-4 px-5 py-5
                               sm:px-6
                               lg:grid-cols-[1fr_150px_150px_auto]
                               lg:items-center"
                    >
                        <div class="min-w-0">
                            <p
                                class="text-[10px] font-bold
                                       uppercase tracking-[0.12em]
                                       text-[#075F9B]"
                            >
                                {{ $facility->category_label }}
                            </p>

                            <h3
                                class="mt-1 text-base
                                       font-extrabold text-slate-900"
                            >
                                {{ $facility->title }}
                            </h3>

                            @if ($description !== '')
                                <p
                                    class="mt-1 text-sm
                                           leading-6 text-slate-500"
                                >
                                    {{ \Illuminate\Support\Str::limit(
                                        $description,
                                        110
                                    ) }}
                                </p>
                            @endif
                        </div>


                        <div>
                            <p
                                class="text-[10px] font-bold
                                       uppercase tracking-[0.12em]
                                       text-slate-400"
                            >
                                Dokumentasi
                            </p>

                            <p
                                class="mt-1 text-sm
                                       font-bold text-slate-700"
                            >
                                {{ $photoCount }} foto
                            </p>
                        </div>


                        <div>
                            <p
                                class="text-[10px] font-bold
                                       uppercase tracking-[0.12em]
                                       text-slate-400"
                            >
                                Status
                            </p>

                            <span
                                @class([
                                    'mt-1 inline-flex rounded-full',
                                    'px-2.5 py-1 text-xs font-bold',
                                    'bg-emerald-50 text-emerald-700' =>
                                        $facility->is_active,
                                    'bg-slate-100 text-slate-500' =>
                                        !$facility->is_active,
                                ])
                            >
                                {{ $facility->is_active
                                    ? 'Ditampilkan'
                                    : 'Disembunyikan' }}
                            </span>
                        </div>


                        <a
                            href="{{ route(
                                'admin.facilities.edit',
                                $facility
                            ) }}"
                            class="inline-flex items-center
                                   justify-center rounded-xl
                                   bg-[#075F9B]
                                   px-4 py-2.5
                                   text-sm font-bold text-white
                                   transition hover:bg-[#064B7B]"
                        >
                            Kelola
                        </a>
                    </article>
                @endforeach
            </div>
        </section>

    @else

        <div
            class="rounded-2xl border
                   border-slate-200 bg-white
                   px-6 py-14 text-center"
        >
            <h2
                class="text-base font-extrabold
                       text-slate-800"
            >
                Kategori fasilitas belum tersedia
            </h2>

            <p
                class="mx-auto mt-2 max-w-xl
                       text-sm leading-6
                       text-slate-500"
            >
                Data awal kategori fasilitas perlu tersedia
                sebelum foto dokumentasi dapat ditambahkan.
            </p>
        </div>

    @endif
</div>


@once
    <script>
        document.addEventListener(
            'DOMContentLoaded',
            function () {
                const form =
                    document.getElementById(
                        'facilityPhotoCreateForm'
                    );

                const photoInput =
                    document.getElementById(
                        'facilityPhotoInput'
                    );

                const previewContainer =
                    document.getElementById(
                        'facilityPhotoPreviewContainer'
                    );

                const previewImage =
                    document.getElementById(
                        'facilityPhotoPreview'
                    );

                const fileNameElement =
                    document.getElementById(
                        'facilityPhotoFileName'
                    );

                const fileSizeElement =
                    document.getElementById(
                        'facilityPhotoFileSize'
                    );

                const errorElement =
                    document.getElementById(
                        'facilityPhotoError'
                    );

                const submitButton =
                    document.getElementById(
                        'facilityPhotoSubmit'
                    );

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

                let photoIsValid = true;
                let previewUrl = null;


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

                    previewContainer?.classList.add(
                        'hidden'
                    );

                    if (previewImage) {
                        previewImage.src = '';
                    }

                    if (fileNameElement) {
                        fileNameElement.textContent = '';
                    }

                    if (fileSizeElement) {
                        fileSizeElement.textContent = '';
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

                    errorElement.textContent = message;
                    errorElement.classList.remove(
                        'hidden'
                    );
                }


                photoInput?.addEventListener(
                    'change',
                    function () {
                        resetPreview();

                        const file =
                            photoInput.files?.[0];

                        if (!file) {
                            return;
                        }

                        const extension =
                            extensionOf(file.name);

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

                            photoInput.value = '';

                            return;
                        }

                        if (
                            file.size
                            > maximumFileSize
                        ) {
                            showError(
                                'Ukuran foto '
                                + formatFileSize(file.size)
                                + '. Maksimal 20 MB.'
                            );

                            photoInput.value = '';

                            return;
                        }

                        previewUrl =
                            URL.createObjectURL(file);

                        if (previewImage) {
                            previewImage.src =
                                previewUrl;
                        }

                        if (fileNameElement) {
                            fileNameElement.textContent =
                                file.name;
                        }

                        if (fileSizeElement) {
                            fileSizeElement.textContent =
                                formatFileSize(file.size);
                        }

                        previewContainer?.classList.remove(
                            'hidden'
                        );
                    }
                );


                form?.addEventListener(
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
                            'Mengunggah...';
                    }
                );


                window.addEventListener(
                    'beforeunload',
                    clearPreviewUrl
                );
            }
        );
    </script>
@endonce

@endsection
