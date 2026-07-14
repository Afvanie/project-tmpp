@extends('layouts.admin')

@section('title', 'Dokumentasi Fasilitas')

@section('content')

@php
    /*
    |--------------------------------------------------------------------------
    | DATA FASILITAS
    |--------------------------------------------------------------------------
    */

    $facilityItems = collect($facilities ?? []);

    /*
    |--------------------------------------------------------------------------
    | TAMPILAN VISUAL KATEGORI
    |--------------------------------------------------------------------------
    |
    | Data kategori tetap berasal dari database.
    | Pengaturan ini hanya menentukan ikon dan warna kartu admin.
    |
    */

    $categoryVisuals = [
        \App\Models\Facility::CATEGORY_LABORATORY => [
            'icon' => 'laboratory',
            'background' => 'bg-blue-700',
            'text' => 'text-white',
        ],

        \App\Models\Facility::CATEGORY_WORKSHOP => [
            'icon' => 'workshop',
            'background' => 'bg-yellow-400',
            'text' => 'text-slate-900',
        ],

        \App\Models\Facility::CATEGORY_CLASSROOM => [
            'icon' => 'classroom',
            'background' => 'bg-blue-700',
            'text' => 'text-white',
        ],

        \App\Models\Facility::CATEGORY_GALLERY => [
            'icon' => 'gallery',
            'background' => 'bg-yellow-400',
            'text' => 'text-slate-900',
        ],
    ];
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
            <h1
                class="text-3xl font-black
                       text-slate-800 md:text-4xl"
            >
                Dokumentasi Fasilitas
            </h1>

            <p
                class="mt-3 max-w-4xl
                       leading-7 text-slate-500"
            >
                Kelola foto dokumentasi fasilitas dan aktivitas
                mahasiswa Program Studi D-IV Teknik Mesin Produksi
                dan Perawatan.
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

            Lihat Halaman Fasilitas
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

    @if (session('warning'))
        <div
            class="rounded-2xl border
                   border-yellow-200 bg-yellow-50
                   px-6 py-4 font-semibold
                   text-yellow-700"
            role="alert"
        >
            {{ session('warning') }}
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
                Foto belum dapat ditambahkan.
            </p>

            <ul class="mt-3 list-disc space-y-1 pl-5 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {{-- ========================================================= --}}
    {{-- FORM TAMBAH FOTO --}}
    {{-- ========================================================= --}}

    @if ($facilityItems->isNotEmpty())

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
                id="facilityPhotoCreateForm"
                action="{{ route(
                    'admin.facilities.photos.store-general'
                ) }}"
                method="POST"
                enctype="multipart/form-data"
                class="space-y-7 p-6 sm:p-7 md:p-8"
            >
                @csrf

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
                        Pilih kategori fasilitas agar foto tampil
                        pada bagian dokumentasi yang sesuai.
                    </p>
                </div>


                <div class="grid gap-6 lg:grid-cols-12">

                    {{-- ========================================= --}}
                    {{-- KATEGORI --}}
                    {{-- ========================================= --}}

                    <div class="lg:col-span-3">
                        <label
                            for="facilityId"
                            class="mb-2 block text-sm
                                   font-bold text-slate-700"
                        >
                            Kategori Dokumentasi
                            <span class="text-red-600">*</span>
                        </label>

                        <select
                            id="facilityId"
                            name="facility_id"
                            required
                            @class([
                                'w-full rounded-2xl border bg-slate-50',
                                'px-5 py-4 transition',
                                'focus:bg-white focus:outline-none',
                                'focus:ring-2 focus:ring-blue-500',
                                'border-red-300' =>
                                    $errors->has('facility_id'),
                                'border-slate-200' =>
                                    !$errors->has('facility_id'),
                            ])
                        >
                            <option value="">
                                Pilih kategori
                            </option>

                            @foreach ($facilityItems as $facility)
                                <option
                                    value="{{ $facility->id }}"
                                    @selected(
                                        (string) old('facility_id')
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


                    {{-- ========================================= --}}
                    {{-- JUDUL --}}
                    {{-- ========================================= --}}

                    <div class="lg:col-span-3">
                        <label
                            for="photoTitle"
                            class="mb-2 block text-sm
                                   font-bold text-slate-700"
                        >
                            Judul Foto
                        </label>

                        <input
                            type="text"
                            id="photoTitle"
                            name="title"
                            value="{{ old('title') }}"
                            maxlength="255"
                            placeholder="Masukkan judul apabila tersedia"
                            @class([
                                'w-full rounded-2xl border bg-slate-50',
                                'px-5 py-4 transition',
                                'focus:bg-white focus:outline-none',
                                'focus:ring-2 focus:ring-blue-500',
                                'border-red-300' =>
                                    $errors->has('title'),
                                'border-slate-200' =>
                                    !$errors->has('title'),
                            ])
                        >

                        <p class="mt-2 text-sm text-slate-500">
                            Judul dapat dikosongkan.
                        </p>

                        @error('title')
                            <p
                                class="mt-2 text-sm
                                       font-semibold text-red-600"
                            >
                                {{ $message }}
                            </p>
                        @enderror
                    </div>


                    {{-- ========================================= --}}
                    {{-- FOTO --}}
                    {{-- ========================================= --}}

                    <div class="lg:col-span-4">
                        <label
                            for="facilityPhotoInput"
                            class="mb-2 block text-sm
                                   font-bold text-slate-700"
                        >
                            Foto Dokumentasi
                            <span class="text-red-600">*</span>
                        </label>

                        <input
                            type="file"
                            id="facilityPhotoInput"
                            name="photo"
                            accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                            required
                            aria-describedby="facilityPhotoHelp facilityPhotoError"
                            @class([
                                'block w-full rounded-2xl border',
                                'bg-slate-50 px-4 py-3',
                                'text-sm text-slate-600',
                                'file:mr-4 file:rounded-xl',
                                'file:border-0 file:bg-blue-700',
                                'file:px-4 file:py-2',
                                'file:font-bold file:text-white',
                                'hover:file:bg-blue-800',
                                'border-red-300' =>
                                    $errors->has('photo'),
                                'border-slate-200' =>
                                    !$errors->has('photo'),
                            ])
                        >

                        <p
                            id="facilityPhotoHelp"
                            class="mt-2 text-sm
                                   leading-6 text-slate-500"
                        >
                            Format JPG, JPEG, PNG, atau WEBP.
                            Ukuran maksimal 20 MB.
                        </p>

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


                    {{-- ========================================= --}}
                    {{-- URUTAN --}}
                    {{-- ========================================= --}}

                    <div class="lg:col-span-2">
                        <label
                            for="photoSortOrder"
                            class="mb-2 block text-sm
                                   font-bold text-slate-700"
                        >
                            Urutan
                        </label>

                        <input
                            type="number"
                            id="photoSortOrder"
                            name="sort_order"
                            value="{{ old('sort_order', 0) }}"
                            min="0"
                            step="1"
                            inputmode="numeric"
                            @class([
                                'w-full rounded-2xl border bg-slate-50',
                                'px-5 py-4 transition',
                                'focus:bg-white focus:outline-none',
                                'focus:ring-2 focus:ring-blue-500',
                                'border-red-300' =>
                                    $errors->has('sort_order'),
                                'border-slate-200' =>
                                    !$errors->has('sort_order'),
                            ])
                        >

                        @error('sort_order')
                            <p
                                class="mt-2 text-sm
                                       font-semibold text-red-600"
                            >
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                </div>


                {{-- Preview Foto --}}
                <div
                    id="facilityPhotoPreviewContainer"
                    class="hidden rounded-3xl border
                           border-slate-100 bg-slate-50
                           p-5"
                >
                    <div
                        class="flex flex-col gap-5
                               sm:flex-row sm:items-center"
                    >
                        <img
                            id="facilityPhotoPreview"
                            src=""
                            alt="Pratinjau foto dokumentasi"
                            class="h-32 w-full rounded-2xl
                                   object-cover sm:w-48"
                        >

                        <div class="min-w-0">
                            <p
                                class="text-xs font-bold uppercase
                                       tracking-wider text-slate-500"
                            >
                                Foto Dipilih
                            </p>

                            <p
                                id="facilityPhotoFileName"
                                class="mt-2 break-all font-bold
                                       text-slate-800"
                            ></p>

                            <p
                                id="facilityPhotoFileSize"
                                class="mt-1 text-sm text-slate-500"
                            ></p>
                        </div>
                    </div>
                </div>


                <div
                    class="flex flex-col gap-5
                           border-t border-slate-100 pt-6
                           md:flex-row md:items-center
                           md:justify-between"
                >
                    <label
                        class="inline-flex cursor-pointer
                               items-center gap-3"
                    >
                        <input
                            type="checkbox"
                            name="is_active"
                            value="1"
                            @checked(old('is_active', '1') === '1')
                            class="h-5 w-5 rounded
                                   border-slate-300 text-blue-700
                                   focus:ring-blue-500"
                        >

                        <span
                            class="text-sm font-semibold
                                   text-slate-700"
                        >
                            Tampilkan foto ini pada halaman publik
                        </span>
                    </label>

                    <button
                        type="submit"
                        id="facilityPhotoSubmit"
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

    @endif


    {{-- ========================================================= --}}
    {{-- DAFTAR KATEGORI --}}
    {{-- ========================================================= --}}

    @if ($facilityItems->isNotEmpty())

        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-4">

            @foreach ($facilityItems as $facility)

                @php
                    $visual = $categoryVisuals[
                        $facility->category
                    ] ?? [
                        'icon' => 'gallery',
                        'background' => 'bg-blue-700',
                        'text' => 'text-white',
                    ];

                    $description = trim(
                        (string) $facility->description
                    );

                    $photoCount = (int) (
                        $facility->photos_count ?? 0
                    );
                @endphp

                <article
                    class="group overflow-hidden
                           rounded-3xl border
                           border-slate-100 bg-white
                           shadow-lg transition-all
                           duration-300
                           hover:-translate-y-1
                           hover:shadow-2xl"
                >
                    <div
                        class="h-2 bg-gradient-to-r
                               from-blue-700 via-yellow-400
                               to-blue-700"
                    ></div>

                    <div class="p-6">

                        <div
                            class="flex items-start
                                   justify-between gap-4"
                        >
                            <div
                                class="flex h-14 w-14
                                       items-center justify-center
                                       rounded-2xl shadow-lg
                                       transition
                                       {{ $visual['background'] }}
                                       {{ $visual['text'] }}"
                            >
                                @if ($visual['icon'] === 'laboratory')

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-7 w-7"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        aria-hidden="true"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M9 3v6l-5 8a3 3 0 002.6 4.5h10.8A3 3 0 0020 17l-5-8V3M9 3h6M9 9h6"
                                        />
                                    </svg>

                                @elseif ($visual['icon'] === 'workshop')

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-7 w-7"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        aria-hidden="true"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.83-5.83M11.42 15.17l2.12-2.12M11.42 15.17l-4.95 4.95a2.652 2.652 0 01-3.75-3.75l4.95-4.95m5.87 1.63l-2.12-2.12"
                                        />
                                    </svg>

                                @elseif ($visual['icon'] === 'classroom')

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-7 w-7"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        aria-hidden="true"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 6.253v13M12 6.253C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253"
                                        />
                                    </svg>

                                @else

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-7 w-7"
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

                                @endif
                            </div>


                            <span
                                @class([
                                    'inline-flex rounded-full',
                                    'px-3 py-1 text-xs font-bold',
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


                        <p
                            class="mt-5 text-xs font-bold uppercase
                                   tracking-wider text-blue-700"
                        >
                            {{ $facility->category_label }}
                        </p>

                        <h2
                            class="mt-2 text-xl font-bold
                                   leading-snug text-slate-800"
                        >
                            {{ $facility->title }}
                        </h2>


                        @if ($description !== '')
                            <p
                                class="mt-3 line-clamp-3
                                       text-sm leading-7
                                       text-slate-500"
                            >
                                {{ $description }}
                            </p>
                        @else
                            <p
                                class="mt-3 text-sm italic
                                       leading-7 text-slate-400"
                            >
                                Deskripsi kategori belum diisi.
                            </p>
                        @endif


                        <div class="mt-6 grid grid-cols-2 gap-4">

                            <div
                                class="rounded-2xl border
                                       border-slate-100
                                       bg-slate-50 p-4"
                            >
                                <p
                                    class="text-2xl font-black
                                           text-blue-700"
                                >
                                    {{ $photoCount }}
                                </p>

                                <p
                                    class="mt-1 text-xs font-semibold
                                           text-slate-500"
                                >
                                    Foto
                                </p>
                            </div>

                            <div
                                class="rounded-2xl border
                                       border-slate-100
                                       bg-slate-50 p-4"
                            >
                                <p
                                    class="text-2xl font-black
                                           text-yellow-500"
                                >
                                    {{ $facility->sort_order }}
                                </p>

                                <p
                                    class="mt-1 text-xs font-semibold
                                           text-slate-500"
                                >
                                    Urutan
                                </p>
                            </div>
                        </div>


                        <a
                            href="{{ route(
                                'admin.facilities.edit',
                                $facility
                            ) }}"
                            class="mt-6 inline-flex w-full
                                   items-center justify-center
                                   rounded-xl bg-blue-700
                                   px-5 py-3 font-bold
                                   text-white transition
                                   hover:bg-blue-800"
                        >
                            Kelola Dokumentasi
                        </a>
                    </div>
                </article>

            @endforeach
        </div>

    @else

        {{-- ===================================================== --}}
        {{-- EMPTY STATE --}}
        {{-- ===================================================== --}}

        <div
            class="rounded-3xl border
                   border-slate-100 bg-white
                   p-8 text-center shadow-lg
                   sm:p-10"
        >
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

            <h2
                class="mt-5 text-2xl font-bold
                       text-slate-800"
            >
                Kategori Fasilitas Belum Tersedia
            </h2>

            <p
                class="mx-auto mt-3 max-w-2xl
                       leading-7 text-slate-500"
            >
                Struktur awal kategori fasilitas belum tersedia
                pada database. Inisialisasi data fasilitas perlu
                diselesaikan sebelum dokumentasi dapat ditambahkan.
            </p>
        </div>

    @endif

</div>


@once
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById(
                'facilityPhotoCreateForm'
            );

            const photoInput = document.getElementById(
                'facilityPhotoInput'
            );

            const previewContainer = document.getElementById(
                'facilityPhotoPreviewContainer'
            );

            const previewImage = document.getElementById(
                'facilityPhotoPreview'
            );

            const fileNameElement = document.getElementById(
                'facilityPhotoFileName'
            );

            const fileSizeElement = document.getElementById(
                'facilityPhotoFileSize'
            );

            const errorElement = document.getElementById(
                'facilityPhotoError'
            );

            const submitButton = document.getElementById(
                'facilityPhotoSubmit'
            );

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

            let photoIsValid = true;
            let previewUrl = null;


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


            function clearPreviewUrl() {
                if (previewUrl) {
                    URL.revokeObjectURL(previewUrl);
                    previewUrl = null;
                }
            }


            function resetPreview() {
                clearPreviewUrl();

                photoIsValid = true;

                if (previewImage) {
                    previewImage.src = '';
                }

                if (previewContainer) {
                    previewContainer.classList.add('hidden');
                }

                if (fileNameElement) {
                    fileNameElement.textContent = '';
                }

                if (fileSizeElement) {
                    fileSizeElement.textContent = '';
                }

                if (errorElement) {
                    errorElement.textContent = '';
                    errorElement.classList.add('hidden');
                }
            }


            function showError(message) {
                photoIsValid = false;

                if (errorElement) {
                    errorElement.textContent = message;
                    errorElement.classList.remove('hidden');
                }
            }


            if (photoInput) {
                photoInput.addEventListener('change', function () {
                    resetPreview();

                    const file = this.files
                        ? this.files[0]
                        : null;

                    if (!file) {
                        return;
                    }

                    const extension = getExtension(file.name);

                    const mimeValid =
                        file.type === ''
                        || allowedMimeTypes.includes(file.type);

                    const extensionValid =
                        allowedExtensions.includes(extension);

                    if (!mimeValid || !extensionValid) {
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

                    if (fileNameElement) {
                        fileNameElement.textContent = file.name;
                    }

                    if (fileSizeElement) {
                        fileSizeElement.textContent =
                            formatFileSize(file.size);
                    }

                    if (previewContainer) {
                        previewContainer.classList.remove('hidden');
                    }
                });
            }


            if (form && submitButton) {
                form.addEventListener('submit', function (event) {
                    if (!photoIsValid) {
                        event.preventDefault();

                        return;
                    }

                    submitButton.disabled = true;
                    submitButton.textContent = 'Mengunggah...';
                });
            }


            window.addEventListener('beforeunload', function () {
                clearPreviewUrl();
            });
        });
    </script>
@endonce

@endsection