@extends('layouts.admin')

@section('title', 'Tambah Dosen atau Staf')

@section('content')

@php
    $personTypes = $types
        ?? \App\Models\LecturerStaff::types();

    $selectedType = (string) old(
        'type',
        \App\Models\LecturerStaff::TYPE_DOSEN
    );

    
@endphp


<div class="mx-auto max-w-6xl space-y-6">

    <header>
        <a
            href="{{ route(
                'admin.lecturer-staff.index'
            ) }}"
            class="inline-flex items-center
                   gap-2 text-sm font-bold
                   text-[#075F9B]
                   hover:underline"
        >
            <span aria-hidden="true">←</span>
            <span>Kembali ke Dosen dan Staf</span>
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
                Tambah Data
            </p>
        </div>

        <h1
            class="mt-3 text-2xl font-extrabold
                   tracking-tight text-slate-900
                   sm:text-3xl"
        >
            Tambah Dosen atau Staf
        </h1>

        <p
            class="mt-2 max-w-3xl
                   text-sm leading-7
                   text-slate-500"
        >
            Tambahkan satu data dosen atau staf ke website.
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


    <form
        id="lecturerStaffCreateForm"
        action="{{ route(
            'admin.lecturer-staff.store'
        ) }}"
        method="POST"
        enctype="multipart/form-data"
        class="overflow-hidden rounded-2xl
               border border-slate-200
               bg-white"
    >
        @csrf
        

        <div
            class="grid gap-7 px-5 py-7
                   sm:px-6
                   lg:grid-cols-[240px_1fr]
                   lg:px-8 lg:py-8"
        >
            {{-- FOTO --}}
            <div>
                <label
                    for="photoInput"
                    class="block text-sm
                           font-bold text-slate-800"
                >
                    Foto personel
                </label>

                <p
                    class="mt-1 text-xs
                           leading-6 text-slate-500"
                >
                    Format JPG, JPEG, PNG, atau WebP maksimal 2 MB.
                </p>

                <div
                    class="mt-4 overflow-hidden
                           rounded-xl border
                           border-slate-200
                           bg-slate-100"
                >
                    <div
                        class="relative flex aspect-[4/5]
                               items-center justify-center"
                    >
                        <img
                            id="photoPreview"
                            src=""
                            alt="Pratinjau foto personel"
                            class="hidden h-full w-full object-cover object-top"
                        >

                        <div
                            id="photoPlaceholder"
                            class="px-5 text-center"
                        >
                            <div
                                class="mx-auto flex h-14 w-14
                                       items-center justify-center
                                       rounded-xl bg-blue-50
                                       text-xl font-extrabold
                                       text-[#075F9B]"
                            >
                                ?
                            </div>

                            <p
                                class="mt-3 text-xs
                                       font-semibold
                                       text-slate-500"
                            >
                                Belum ada foto
                            </p>
                        </div>
                    </div>
                </div>

                

                <input
                    id="photoInput"
                    type="file"
                    name="photo"
                    accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                    class="mt-4 block w-full
                           rounded-xl border
                           border-slate-200
                           bg-white px-3 py-2.5
                           text-sm text-slate-600
                           file:mr-3
                           file:rounded-lg
                           file:border-0
                           file:bg-[#075F9B]
                           file:px-3 file:py-2
                           file:text-xs file:font-bold
                           file:text-white
                           hover:file:bg-[#064B7B]"
                >

                <p
                    id="photoInformation"
                    class="mt-3 hidden text-xs
                           font-semibold text-[#075F9B]"
                    aria-live="polite"
                ></p>

                <p
                    id="photoClientError"
                    class="mt-3 hidden text-xs
                           font-semibold text-red-600"
                    aria-live="assertive"
                ></p>

                @error('photo')
                    <p
                        class="mt-3 text-sm
                               font-semibold text-red-600"
                    >
                        {{ $message }}
                    </p>
                @enderror
            </div>


            {{-- DATA UTAMA --}}
            <div class="space-y-6">
                <div>
                    <h2
                        class="text-lg font-extrabold
                               text-slate-900"
                    >
                        Informasi Personel
                    </h2>

                    <p
                        class="mt-1 text-sm
                               leading-6 text-slate-500"
                    >
                        Data yang disimpan langsung tersedia
                        pada halaman publik.
                    </p>
                </div>


                <div>
                    <label
                        for="name"
                        class="block text-sm
                               font-bold text-slate-800"
                    >
                        Nama lengkap
                    </label>

                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        maxlength="255"
                        required
                        autofocus
                        placeholder="Contoh: Dr. Nama Dosen, S.T., M.T."
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

                    @error('name')
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
                        for="nip"
                        class="block text-sm
                               font-bold text-slate-800"
                    >
                        NIP
                    </label>

                    <input
                        id="nip"
                        type="text"
                        name="nip"
                        value="{{ old('nip') }}"
                        maxlength="100"
                        inputmode="numeric"
                        placeholder="Kosongkan apabila belum tersedia"
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

                    @error('nip')
                        <p
                            class="mt-2 text-sm
                                   font-semibold text-red-600"
                        >
                            {{ $message }}
                        </p>
                    @enderror
                </div>


                <fieldset>
                    <legend
                        class="block text-sm
                               font-bold text-slate-800"
                    >
                        Kategori personel
                    </legend>

                    <div
                        class="mt-3 grid gap-3
                               sm:grid-cols-2"
                    >
                        @foreach (
                            $personTypes
                            as $typeValue => $typeLabel
                        )
                            @php
                                $isDosen =
                                    $typeValue
                                    === \App\Models\LecturerStaff::TYPE_DOSEN;
                            @endphp

                            <label class="cursor-pointer">
                                <input
                                    type="radio"
                                    name="type"
                                    value="{{ $typeValue }}"
                                    class="peer sr-only"
                                    required
                                    @checked(
                                        $selectedType
                                        === $typeValue
                                    )
                                >

                                <span
                                    class="block rounded-xl
                                           border border-slate-200
                                           bg-slate-50
                                           px-4 py-3
                                           text-sm font-bold
                                           text-slate-700
                                           transition
                                           peer-checked:border-[#075F9B]
                                           peer-checked:bg-blue-50
                                           peer-checked:text-[#075F9B]"
                                >
                                    {{ $typeLabel }}

                                    <span
                                        class="mt-1 block
                                               text-xs font-normal
                                               leading-5 opacity-70"
                                    >
                                        {{ $isDosen
                                            ? 'Tenaga pendidik dan pengajar.'
                                            : 'Tenaga kependidikan dan pelayanan.' }}
                                    </span>
                                </span>
                            </label>
                        @endforeach
                    </div>

                    @error('type')
                        <p
                            class="mt-2 text-sm
                                   font-semibold text-red-600"
                        >
                            {{ $message }}
                        </p>
                    @enderror
                </fieldset>
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
                Periksa nama, NIP, kategori, dan foto
                sebelum menyimpan.
            </p>

            <div
                class="flex flex-col gap-3
                       sm:flex-row"
            >
                <a
                    href="{{ route(
                        'admin.lecturer-staff.index'
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
                    id="lecturerStaffSubmit"
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
                        Simpan Data
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
                    'lecturerStaffCreateForm'
                );

            const photoInput =
                document.getElementById(
                    'photoInput'
                );

            const photoPreview =
                document.getElementById(
                    'photoPreview'
                );

            const photoPlaceholder =
                document.getElementById(
                    'photoPlaceholder'
                );

            const photoInformation =
                document.getElementById(
                    'photoInformation'
                );

            const photoClientError =
                document.getElementById(
                    'photoClientError'
                );

            const submitButton =
                document.getElementById(
                    'lecturerStaffSubmit'
                );

            const submitLabel =
                submitButton?.querySelector(
                    '[data-submit-label]'
                );

            const currentPhotoUrl =
                null;

            const maximumFileSize =
                2 * 1024 * 1024;

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

            let previewUrl = null;
            let photoIsValid = true;


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


            function clearPreviewUrl() {
                if (!previewUrl) {
                    return;
                }

                URL.revokeObjectURL(
                    previewUrl
                );

                previewUrl = null;
            }


            function restoreCurrentPhoto() {
                clearPreviewUrl();

                if (
                    !photoPreview
                    || !photoPlaceholder
                ) {
                    return;
                }

                if (currentPhotoUrl) {
                    photoPreview.src =
                        currentPhotoUrl;

                    photoPreview.classList
                        .remove('hidden');

                    photoPlaceholder.classList
                        .add('hidden');

                    return;
                }

                photoPreview.src = '';

                photoPreview.classList
                    .add('hidden');

                photoPlaceholder.classList
                    .remove('hidden');
            }


            function resetMessages() {
                photoIsValid = true;

                if (photoInformation) {
                    photoInformation.textContent = '';
                    photoInformation.classList.add(
                        'hidden'
                    );
                }

                if (photoClientError) {
                    photoClientError.textContent = '';
                    photoClientError.classList.add(
                        'hidden'
                    );
                }
            }


            function showError(message) {
                photoIsValid = false;

                if (!photoClientError) {
                    return;
                }

                photoClientError.textContent =
                    message;

                photoClientError.classList.remove(
                    'hidden'
                );
            }


            photoInput?.addEventListener(
                'change',
                function () {
                    resetMessages();
                    restoreCurrentPhoto();

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
                            + '. Maksimal 2 MB.'
                        );

                        photoInput.value = '';

                        return;
                    }

                    previewUrl =
                        URL.createObjectURL(file);

                    if (photoPreview) {
                        photoPreview.src =
                            previewUrl;

                        photoPreview.classList
                            .remove('hidden');
                    }

                    photoPlaceholder?.classList
                        .add('hidden');

                    if (photoInformation) {
                        photoInformation.textContent =
                            'Foto dipilih: '
                            + file.name
                            + ' ('
                            + formatFileSize(
                                file.size
                            )
                            + ')';

                        photoInformation.classList
                            .remove('hidden');
                    }
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

                    if (submitLabel) {
                        submitLabel.textContent =
                            'Menyimpan...';
                    }
                }
            );


            window.addEventListener(
                'beforeunload',
                clearPreviewUrl
            );
        }
    );
</script>

@endsection
