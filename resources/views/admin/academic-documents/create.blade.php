@extends('layouts.admin')

@section('title', 'Tambah Dokumen Akademik')

@section('content')

@php
    /*
    |--------------------------------------------------------------------------
    | NILAI AWAL FORM
    |--------------------------------------------------------------------------
    |
    | Input tersembunyi is_active bernilai 0 memastikan status nonaktif
    | tetap terbaca oleh controller dan tetap dipertahankan saat validasi gagal.
    |
    */

    $isActiveChecked = (string) old('is_active', '1') === '1';
@endphp


<div class="space-y-8">

    {{-- ========================================================= --}}
    {{-- HEADER --}}
    {{-- ========================================================= --}}

    <div>
        <a
            href="{{ route('admin.academic-documents.index') }}"
            class="mb-4 inline-flex items-center
                   text-sm font-bold text-blue-700
                   transition hover:underline"
        >
            ← Kembali ke Dokumen Akademik
        </a>

        <h1
            class="text-3xl font-black text-slate-800
                   md:text-4xl"
        >
            Tambah Dokumen Akademik
        </h1>

        <p
            class="mt-3 max-w-4xl
                   leading-7 text-slate-500"
        >
            Tambahkan Pedoman Akademik, Kalender Akademik,
            Kurikulum, Jadwal Kuliah, Laporan Ketercapaian,
            Panduan Tugas Akhir, atau Panduan Magang Industri
            Program Studi D-IV Teknik Mesin Produksi dan Perawatan.
        </p>
    </div>


    {{-- ========================================================= --}}
    {{-- VALIDATION ERROR --}}
    {{-- ========================================================= --}}

    @if ($errors->any())
        <div
            class="rounded-2xl border border-red-200
                   bg-red-50 px-6 py-4 text-red-700"
            role="alert"
        >
            <p class="font-bold">
                Dokumen belum dapat disimpan.
            </p>

            <ul class="mt-3 list-disc space-y-1 pl-5 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {{-- ========================================================= --}}
    {{-- FORM CARD --}}
    {{-- ========================================================= --}}

    <div
        class="overflow-hidden rounded-[2rem]
               border border-slate-100
               bg-white/95 shadow-xl backdrop-blur"
    >
        <div
            class="h-2 bg-gradient-to-r
                   from-blue-700 via-yellow-400
                   to-blue-700"
        ></div>

        <form
            id="academicDocumentForm"
            action="{{ route('admin.academic-documents.store') }}"
            method="POST"
            enctype="multipart/form-data"
            class="space-y-8 p-6 sm:p-7 md:p-8"
        >
            @csrf

            <div class="grid gap-8 lg:grid-cols-12">

                {{-- ================================================= --}}
                {{-- INFORMASI SAMPING --}}
                {{-- ================================================= --}}

                <aside class="lg:col-span-4">
                    <div
                        class="relative overflow-hidden
                               rounded-[2rem] bg-[#06172E]
                               p-6 text-white"
                    >
                        <div
                            class="absolute -right-20 -top-20
                                   h-52 w-52 rounded-full
                                   bg-blue-500/30 blur-3xl"
                            aria-hidden="true"
                        ></div>

                        <div
                            class="absolute -bottom-20 -left-20
                                   h-52 w-52 rounded-full
                                   bg-yellow-400/20 blur-3xl"
                            aria-hidden="true"
                        ></div>

                        <div class="relative z-10">

                            <div
                                class="flex h-16 w-16
                                       items-center justify-center
                                       rounded-3xl bg-yellow-400
                                       text-slate-900 shadow-xl"
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
                                        d="M9 12h6m-6 4h6M5 4h14a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V6a2 2 0 012-2z"
                                    />
                                </svg>
                            </div>

                            <h2 class="mt-6 text-2xl font-black">
                                Informasi Dokumen
                            </h2>

                            <p
                                class="mt-3 leading-7
                                       text-white/70"
                            >
                                Dokumen aktif akan tampil pada halaman
                                publik sesuai kategori yang dipilih.
                            </p>


                            <div class="mt-8 space-y-4">

                                <div
                                    class="rounded-2xl border
                                           border-white/15
                                           bg-white/10 p-4"
                                >
                                    <p class="text-sm text-white/60">
                                        Format File
                                    </p>

                                    <p class="mt-1 font-bold">
                                        PDF, JPG, JPEG, PNG, WEBP
                                    </p>
                                </div>


                                <div
                                    class="rounded-2xl border
                                           border-white/15
                                           bg-white/10 p-4"
                                >
                                    <p class="text-sm text-white/60">
                                        Maksimal Unggahan
                                    </p>

                                    <p class="mt-1 font-bold">
                                        20 MB
                                    </p>
                                </div>


                                <div
                                    class="rounded-2xl border
                                           border-white/15
                                           bg-white/10 p-4"
                                >
                                    <p class="text-sm text-white/60">
                                        Tautan Alternatif
                                    </p>

                                    <p class="mt-1 font-bold">
                                        Mendukung HTTP dan HTTPS
                                    </p>
                                </div>


                                <div
                                    class="rounded-2xl border
                                           border-white/15
                                           bg-white/10 p-4"
                                >
                                    <p class="text-sm text-white/60">
                                        Publikasi
                                    </p>

                                    <p class="mt-1 font-bold">
                                        Hanya dokumen aktif yang tampil
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                </aside>


                {{-- ================================================= --}}
                {{-- FORM INPUT --}}
                {{-- ================================================= --}}

                <div class="lg:col-span-8">

                    <div class="space-y-6">

                        <div>
                            <h2
                                class="text-2xl font-black
                                       text-slate-800"
                            >
                                Detail Dokumen
                            </h2>

                            <p class="mt-2 text-slate-500">
                                Lengkapi informasi dokumen akademik
                                yang akan ditampilkan.
                            </p>
                        </div>


                        {{-- ========================================= --}}
                        {{-- JUDUL --}}
                        {{-- ========================================= --}}

                        <div>
                            <label
                                for="title"
                                class="mb-2 block text-sm
                                       font-bold text-slate-700"
                            >
                                Judul Dokumen
                                <span class="text-red-600">*</span>
                            </label>

                            <input
                                type="text"
                                id="title"
                                name="title"
                                value="{{ old('title') }}"
                                maxlength="255"
                                autocomplete="off"
                                placeholder="Contoh: Buku Kurikulum Tahun Akademik 2025/2026"
                                required
                                @class([
                                    'w-full rounded-2xl border bg-slate-50',
                                    'px-5 py-4 transition',
                                    'focus:bg-white focus:outline-none',
                                    'focus:ring-2 focus:ring-blue-500',
                                    'border-red-300' => $errors->has('title'),
                                    'border-slate-200' => !$errors->has('title'),
                                ])
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


                        {{-- ========================================= --}}
                        {{-- KATEGORI --}}
                        {{-- ========================================= --}}

                        <div>
                            <label
                                for="category"
                                class="mb-2 block text-sm
                                       font-bold text-slate-700"
                            >
                                Kategori
                                <span class="text-red-600">*</span>
                            </label>

                            <select
                                id="category"
                                name="category"
                                required
                                @class([
                                    'w-full rounded-2xl border bg-slate-50',
                                    'px-5 py-4 transition',
                                    'focus:bg-white focus:outline-none',
                                    'focus:ring-2 focus:ring-blue-500',
                                    'border-red-300' => $errors->has('category'),
                                    'border-slate-200' => !$errors->has('category'),
                                ])
                            >
                                <option value="">
                                    Pilih Kategori
                                </option>

                                @foreach ($categories as $key => $label)
                                    <option
                                        value="{{ $key }}"
                                        @selected(old('category') === $key)
                                    >
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>

                            @error('category')
                                <p
                                    class="mt-2 text-sm
                                           font-semibold text-red-600"
                                >
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        {{-- ========================================= --}}
                        {{-- DESKRIPSI --}}
                        {{-- ========================================= --}}

                        <div>
                            <label
                                for="description"
                                class="mb-2 block text-sm
                                       font-bold text-slate-700"
                            >
                                Deskripsi
                            </label>

                            <textarea
                                id="description"
                                name="description"
                                rows="5"
                                placeholder="Tuliskan penjelasan singkat mengenai dokumen..."
                                @class([
                                    'w-full resize-y rounded-2xl border',
                                    'bg-slate-50 px-5 py-4 transition',
                                    'focus:bg-white focus:outline-none',
                                    'focus:ring-2 focus:ring-blue-500',
                                    'border-red-300' => $errors->has('description'),
                                    'border-slate-200' => !$errors->has('description'),
                                ])
                            >{{ old('description') }}</textarea>

                            @error('description')
                                <p
                                    class="mt-2 text-sm
                                           font-semibold text-red-600"
                                >
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        {{-- ========================================= --}}
                        {{-- TAHUN DAN URUTAN --}}
                        {{-- ========================================= --}}

                        <div class="grid gap-6 md:grid-cols-2">

                            <div>
                                <label
                                    for="academic_year"
                                    class="mb-2 block text-sm
                                           font-bold text-slate-700"
                                >
                                    Tahun Akademik
                                </label>

                                <input
                                    type="text"
                                    id="academic_year"
                                    name="academic_year"
                                    value="{{ old('academic_year') }}"
                                    maxlength="50"
                                    autocomplete="off"
                                    placeholder="Contoh: 2025/2026"
                                    @class([
                                        'w-full rounded-2xl border bg-slate-50',
                                        'px-5 py-4 transition',
                                        'focus:bg-white focus:outline-none',
                                        'focus:ring-2 focus:ring-blue-500',
                                        'border-red-300' => $errors->has('academic_year'),
                                        'border-slate-200' => !$errors->has('academic_year'),
                                    ])
                                >

                                @error('academic_year')
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
                                    for="sort_order"
                                    class="mb-2 block text-sm
                                           font-bold text-slate-700"
                                >
                                    Urutan
                                </label>

                                <input
                                    type="number"
                                    id="sort_order"
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
                                        'border-red-300' => $errors->has('sort_order'),
                                        'border-slate-200' => !$errors->has('sort_order'),
                                    ])
                                >

                                <p class="mt-2 text-sm text-slate-500">
                                    Angka lebih kecil ditampilkan lebih dahulu.
                                </p>

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


                        {{-- ========================================= --}}
                        {{-- UPLOAD FILE --}}
                        {{-- ========================================= --}}

                        <div
                            class="rounded-3xl border
                                   border-slate-100 bg-slate-50
                                   p-5 sm:p-6"
                        >
                            <label
                                for="academicFileInput"
                                class="mb-2 block text-sm
                                       font-bold text-slate-700"
                            >
                                Unggah File
                            </label>

                            <input
                                type="file"
                                id="academicFileInput"
                                name="file_path"
                                accept=".pdf,.jpg,.jpeg,.png,.webp,application/pdf,image/jpeg,image/png,image/webp"
                                aria-describedby="academicFileHelp academicFileError"
                                class="block w-full text-sm text-slate-600
                                       file:mr-4 file:rounded-xl
                                       file:border-0 file:bg-blue-700
                                       file:px-5 file:py-3
                                       file:font-bold file:text-white
                                       hover:file:bg-blue-800"
                            >

                            <p
                                id="academicFileHelp"
                                class="mt-3 text-sm
                                       leading-6 text-slate-500"
                            >
                                Format yang diperbolehkan: PDF, JPG,
                                JPEG, PNG, atau WEBP. Ukuran maksimal
                                20 MB.
                            </p>

                            <div
                                id="academicFileName"
                                class="mt-4 hidden rounded-2xl
                                       border border-slate-100
                                       bg-white px-5 py-4
                                       text-sm font-semibold
                                       text-slate-700"
                                aria-live="polite"
                            ></div>

                            <p
                                id="academicFileError"
                                class="mt-3 hidden text-sm
                                       font-semibold text-red-600"
                                aria-live="assertive"
                            ></p>

                            @error('file_path')
                                <p
                                    class="mt-3 text-sm
                                           font-semibold text-red-600"
                                >
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        {{-- ========================================= --}}
                        {{-- LINK EKSTERNAL --}}
                        {{-- ========================================= --}}

                        <div>
                            <label
                                for="external_link"
                                class="mb-2 block text-sm
                                       font-bold text-slate-700"
                            >
                                Tautan Eksternal
                            </label>

                            <input
                                type="url"
                                id="external_link"
                                name="external_link"
                                value="{{ old('external_link') }}"
                                maxlength="2048"
                                inputmode="url"
                                autocomplete="url"
                                placeholder="https://contoh.com/dokumen"
                                pattern="https?://.*"
                                @class([
                                    'w-full rounded-2xl border bg-slate-50',
                                    'px-5 py-4 transition',
                                    'focus:bg-white focus:outline-none',
                                    'focus:ring-2 focus:ring-blue-500',
                                    'border-red-300' => $errors->has('external_link'),
                                    'border-slate-200' => !$errors->has('external_link'),
                                ])
                            >

                            <p class="mt-2 text-sm text-slate-500">
                                Kosongkan apabila dokumen hanya memakai
                                file unggahan. Tautan harus diawali
                                <span class="font-semibold">http://</span>
                                atau
                                <span class="font-semibold">https://</span>.
                            </p>

                            @error('external_link')
                                <p
                                    class="mt-2 text-sm
                                           font-semibold text-red-600"
                                >
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        {{-- ========================================= --}}
                        {{-- STATUS --}}
                        {{-- ========================================= --}}

                        <div
                            class="rounded-3xl border
                                   border-blue-100 bg-blue-50
                                   p-5"
                        >
                            <input
                                type="hidden"
                                name="is_active"
                                value="0"
                            >

                            <label
                                for="is_active"
                                class="flex cursor-pointer
                                       items-start gap-4"
                            >
                                <input
                                    type="checkbox"
                                    id="is_active"
                                    name="is_active"
                                    value="1"
                                    @checked($isActiveChecked)
                                    class="mt-1 h-5 w-5 rounded
                                           border-slate-300
                                           text-blue-700
                                           focus:ring-blue-500"
                                >

                                <span>
                                    <span
                                        class="block font-black
                                               text-slate-800"
                                    >
                                        Tampilkan dokumen di website
                                    </span>

                                    <span
                                        class="mt-1 block text-sm
                                               leading-6 text-slate-500"
                                    >
                                        Dokumen aktif akan tampil pada
                                        halaman publik sesuai kategori
                                        akademiknya.
                                    </span>
                                </span>
                            </label>

                            @error('is_active')
                                <p
                                    class="mt-3 text-sm
                                           font-semibold text-red-600"
                                >
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                    </div>
                </div>

            </div>


            {{-- ================================================= --}}
            {{-- ACTION --}}
            {{-- ================================================= --}}

            <div
                class="flex flex-col gap-4
                       border-t border-slate-100
                       pt-6 md:flex-row
                       md:items-center
                       md:justify-between"
            >
                <p class="text-sm leading-6 text-slate-500">
                    Pastikan kategori, tahun akademik, dan status
                    dokumen sudah sesuai sebelum disimpan.
                </p>

                <div
                    class="flex flex-col gap-3
                           sm:flex-row"
                >
                    <a
                        href="{{ route(
                            'admin.academic-documents.index'
                        ) }}"
                        class="inline-flex items-center
                               justify-center rounded-2xl
                               bg-slate-100 px-6 py-4
                               font-bold text-slate-700
                               transition hover:bg-slate-200"
                    >
                        Batal
                    </a>

                    <button
                        type="submit"
                        id="academicDocumentSubmit"
                        class="inline-flex items-center
                               justify-center rounded-2xl
                               bg-blue-700 px-7 py-4
                               font-bold text-white shadow-lg
                               shadow-blue-700/20 transition
                               hover:bg-blue-800
                               disabled:cursor-not-allowed
                               disabled:opacity-60"
                    >
                        Simpan Dokumen
                    </button>
                </div>
            </div>

        </form>
    </div>

</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById(
            'academicDocumentForm'
        );

        const fileInput = document.getElementById(
            'academicFileInput'
        );

        const fileNameBox = document.getElementById(
            'academicFileName'
        );

        const fileError = document.getElementById(
            'academicFileError'
        );

        const submitButton = document.getElementById(
            'academicDocumentSubmit'
        );

        const maximumFileSize = 20 * 1024 * 1024;

        let fileIsValid = true;


        function formatFileSize(bytes) {
            if (bytes < 1024 * 1024) {
                return (bytes / 1024).toFixed(1) + ' KB';
            }

            return (bytes / (1024 * 1024)).toFixed(2) + ' MB';
        }


        function resetFileInformation() {
            fileIsValid = true;

            if (fileNameBox) {
                fileNameBox.classList.add('hidden');
                fileNameBox.textContent = '';
            }

            if (fileError) {
                fileError.classList.add('hidden');
                fileError.textContent = '';
            }
        }


        if (fileInput) {
            fileInput.addEventListener('change', function () {
                resetFileInformation();

                const file = this.files
                    ? this.files[0]
                    : null;

                if (!file) {
                    return;
                }

                if (file.size > maximumFileSize) {
                    fileIsValid = false;

                    if (fileError) {
                        fileError.textContent =
                            'Ukuran file '
                            + formatFileSize(file.size)
                            + '. Maksimal ukuran file adalah 20 MB.';

                        fileError.classList.remove('hidden');
                    }

                    this.value = '';

                    return;
                }

                if (fileNameBox) {
                    fileNameBox.textContent =
                        'File dipilih: '
                        + file.name
                        + ' ('
                        + formatFileSize(file.size)
                        + ')';

                    fileNameBox.classList.remove('hidden');
                }
            });
        }


        if (form && submitButton) {
            form.addEventListener('submit', function (event) {
                if (!fileIsValid) {
                    event.preventDefault();

                    if (fileError) {
                        fileError.classList.remove('hidden');
                    }

                    return;
                }

                submitButton.disabled = true;
                submitButton.textContent = 'Menyimpan...';
            });
        }
    });
</script>

@endsection