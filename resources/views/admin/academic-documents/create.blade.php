@extends('layouts.admin')

@section('title', 'Tambah Dokumen Akademik')

@section('content')

@php
    $isActiveChecked =
        (string) old(
            'is_active',
            '1'
        ) === '1';

    $preservedOrder = old(
        'sort_order',
        0
    );
@endphp


<div class="mx-auto max-w-5xl space-y-6">

    <header>
        <a
            href="{{ route(
                'admin.academic-documents.index'
            ) }}"
            class="inline-flex items-center
                   gap-2 text-sm font-bold
                   text-[#075F9B]
                   hover:underline"
        >
            <span aria-hidden="true">←</span>
            <span>Kembali ke Dokumen Akademik</span>
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
                Tambah Dokumen
            </p>
        </div>

        <h1
            class="mt-3 text-2xl font-extrabold
                   tracking-tight text-slate-900
                   sm:text-3xl"
        >
            Tambah Dokumen Akademik
        </h1>

        <p
            class="mt-2 max-w-3xl
                   text-sm leading-7
                   text-slate-500"
        >
            Tambahkan satu dokumen akademik ke website.
        </p>
    </header>


    @if ($errors->any())
        <div
            class="rounded-xl border
                   border-red-200 bg-red-50
                   px-4 py-4 text-red-800"
            role="alert"
        >
            <p class="text-sm font-bold">
                Dokumen belum dapat disimpan:
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


    <form
        id="academicDocumentCreateForm"
        action="{{ route(
            'admin.academic-documents.store'
        ) }}"
        method="POST"
        enctype="multipart/form-data"
        class="overflow-hidden rounded-2xl
               border border-slate-200
               bg-white"
    >
        @csrf
        

        <input
            type="hidden"
            name="sort_order"
            value="{{ $preservedOrder }}"
        >

        <input
            type="hidden"
            name="is_active"
            value="0"
        >


        <div class="px-5 py-7 sm:px-6 lg:px-8">
            <div
                class="border-b border-slate-200
                       pb-6"
            >
                <h2
                    class="text-lg font-extrabold
                           text-slate-900"
                >
                    Informasi Dokumen
                </h2>

                <p
                    class="mt-1 text-sm
                           leading-7 text-slate-500"
                >
                    Lengkapi informasi yang akan tampil
                    pada halaman akademik.
                </p>
            </div>


            <div class="mt-6 space-y-6">

                <div>
                    <label
                        for="title"
                        class="block text-sm
                               font-bold text-slate-800"
                    >
                        Judul dokumen
                    </label>

                    <input
                        id="title"
                        type="text"
                        name="title"
                        value="{{ old('title') }}"
                        maxlength="255"
                        required
                        autofocus
                        placeholder="Contoh: Kurikulum Tahun Akademik 2025/2026"
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


                <div
                    class="grid gap-5
                           md:grid-cols-2"
                >
                    <div>
                        <label
                            for="category"
                            class="block text-sm
                                   font-bold text-slate-800"
                        >
                            Kategori
                        </label>

                        <select
                            id="category"
                            name="category"
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
                                $categories
                                as $key => $label
                            )
                                <option
                                    value="{{ $key }}"
                                    @selected(
                                        old('category') === $key
                                    )
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


                    <div>
                        <label
                            for="academic_year"
                            class="block text-sm
                                   font-bold text-slate-800"
                        >
                            Tahun akademik
                        </label>

                        <input
                            id="academic_year"
                            type="text"
                            name="academic_year"
                            value="{{ old('academic_year') }}"
                            maxlength="50"
                            placeholder="Contoh: 2025/2026"
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

                        @error('academic_year')
                            <p
                                class="mt-2 text-sm
                                       font-semibold text-red-600"
                            >
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>


                <div>
                    <label
                        for="description"
                        class="block text-sm
                               font-bold text-slate-800"
                    >
                        Deskripsi
                    </label>

                    <p
                        class="mt-1 text-xs
                               leading-6 text-slate-500"
                    >
                        Jelaskan isi atau kegunaan dokumen
                        secara singkat.
                    </p>

                    <textarea
                        id="description"
                        name="description"
                        rows="6"
                        placeholder="Tuliskan penjelasan mengenai dokumen..."
                        class="mt-2 w-full
                               rounded-xl border
                               border-slate-200
                               px-4 py-3 text-sm
                               leading-7 text-slate-800
                               outline-none transition
                               focus:border-[#075F9B]
                               focus:ring-4
                               focus:ring-blue-100"
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


                


                <div
                    class="border-t border-slate-200
                           pt-6"
                >
                    <label
                        for="academicFileInput"
                        class="block text-sm
                               font-bold text-slate-800"
                    >
                        File dokumen
                    </label>

                    <p
                        class="mt-1 text-xs
                               leading-6 text-slate-500"
                    >
                        Format PDF, JPG, JPEG, PNG, atau WebP
                    maksimal 20 MB.
                    </p>

                    <input
                        id="academicFileInput"
                        type="file"
                        name="file_path"
                        accept=".pdf,.jpg,.jpeg,.png,.webp,application/pdf,image/jpeg,image/png,image/webp"
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
                        id="academicFileName"
                        class="mt-3 hidden text-sm
                               font-semibold text-[#075F9B]"
                        aria-live="polite"
                    ></p>

                    <p
                        id="academicFileError"
                        class="mt-3 hidden text-sm
                               font-semibold text-red-600"
                        aria-live="assertive"
                    ></p>

                    @error('file_path')
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
                        for="external_link"
                        class="block text-sm
                               font-bold text-slate-800"
                    >
                        Tautan alternatif
                    </label>

                    <p
                        class="mt-1 text-xs
                               leading-6 text-slate-500"
                    >
                        Gunakan apabila dokumen juga tersedia
                        melalui Google Drive atau website lain.
                    </p>

                    <input
                        id="external_link"
                        type="url"
                        name="external_link"
                        value="{{ old('external_link') }}"
                        maxlength="2048"
                        inputmode="url"
                        placeholder="https://..."
                        pattern="https?://.*"
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

                    @error('external_link')
                        <p
                            class="mt-2 text-sm
                                   font-semibold text-red-600"
                        >
                            {{ $message }}
                        </p>
                    @enderror
                </div>


                <label
                    class="flex cursor-pointer
                           items-start gap-3
                           border-t border-slate-200
                           pt-6"
                >
                    <input
                        id="is_active"
                        type="checkbox"
                        name="is_active"
                        value="1"
                        class="mt-1 h-4 w-4
                               rounded border-slate-300
                               text-[#075F9B]
                               focus:ring-blue-200"
                        {{ $isActiveChecked
                            ? 'checked'
                            : '' }}
                    >

                    <span>
                        <span
                            class="block text-sm
                                   font-bold text-slate-800"
                        >
                            Tampilkan dokumen ini di website
                        </span>

                        <span
                            class="mt-1 block text-xs
                                   leading-6 text-slate-500"
                        >
                            Hilangkan centang untuk menyimpan
                            tanpa menampilkannya kepada pengunjung.
                        </span>
                    </span>
                </label>
            </div>
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
                Periksa kembali judul, kategori,
                sumber dokumen, dan status tampil.
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
                           justify-center rounded-xl
                           border border-slate-200
                           bg-white px-5 py-3
                           text-sm font-bold
                           text-slate-700
                           hover:bg-slate-100"
                >
                    Batal
                </a>

                <button
                    id="academicDocumentSubmit"
                    type="submit"
                    class="inline-flex items-center
                           justify-center rounded-xl
                           bg-[#075F9B] px-6 py-3
                           text-sm font-bold text-white
                           transition hover:bg-[#064B7B]
                           disabled:cursor-not-allowed
                           disabled:opacity-70"
                >
                    <span data-submit-label>
                        Simpan Dokumen
                    </span>
                </button>
            </div>
        </footer>
    </form>
</div>


<script>
    document.addEventListener(
        'DOMContentLoaded',
        function () {
            const form =
                document.getElementById(
                    'academicDocumentCreateForm'
                );

            const fileInput =
                document.getElementById(
                    'academicFileInput'
                );

            const fileNameBox =
                document.getElementById(
                    'academicFileName'
                );

            const fileError =
                document.getElementById(
                    'academicFileError'
                );

            const submitButton =
                document.getElementById(
                    'academicDocumentSubmit'
                );

            const submitLabel =
                submitButton?.querySelector(
                    '[data-submit-label]'
                );

            const maximumFileSize =
                20 * 1024 * 1024;

            const allowedExtensions = [
                'pdf',
                'jpg',
                'jpeg',
                'png',
                'webp',
            ];

            let fileIsValid = true;


            function extensionOf(fileName) {
                const parts = fileName
                    .toLowerCase()
                    .split('.');

                return parts.length > 1
                    ? parts.pop()
                    : '';
            }


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


            function resetMessages() {
                fileIsValid = true;

                if (fileNameBox) {
                    fileNameBox.textContent = '';
                    fileNameBox.classList.add(
                        'hidden'
                    );
                }

                if (fileError) {
                    fileError.textContent = '';
                    fileError.classList.add(
                        'hidden'
                    );
                }
            }


            function showError(message) {
                fileIsValid = false;

                if (!fileError) {
                    return;
                }

                fileError.textContent = message;
                fileError.classList.remove(
                    'hidden'
                );
            }


            fileInput?.addEventListener(
                'change',
                function () {
                    resetMessages();

                    const file =
                        fileInput.files?.[0];

                    if (!file) {
                        return;
                    }

                    const extension =
                        extensionOf(file.name);

                    if (
                        !allowedExtensions.includes(
                            extension
                        )
                    ) {
                        showError(
                            'Format file harus PDF, JPG, JPEG, PNG, atau WebP.'
                        );

                        fileInput.value = '';

                        return;
                    }

                    if (
                        file.size
                        > maximumFileSize
                    ) {
                        showError(
                            'Ukuran file '
                            + formatFileSize(file.size)
                            + '. Maksimal 20 MB.'
                        );

                        fileInput.value = '';

                        return;
                    }

                    if (fileNameBox) {
                        fileNameBox.textContent =
                            'File dipilih: '
                            + file.name
                            + ' ('
                            + formatFileSize(
                                file.size
                            )
                            + ')';

                        fileNameBox.classList.remove(
                            'hidden'
                        );
                    }
                }
            );


            form?.addEventListener(
                'submit',
                function (event) {
                    if (!fileIsValid) {
                        event.preventDefault();

                        return;
                    }

                    if (!submitButton) {
                        return;
                    }

                    submitButton.disabled = true;

                    if (submitLabel) {
                        submitLabel.textContent =
                            'Menyimpan...';
                    }
                }
            );
        }
    );
</script>

@endsection
