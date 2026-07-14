@extends('layouts.admin')

@section('title', 'Edit Dosen dan Staf')

@section('content')

@php
    /*
    |--------------------------------------------------------------------------
    | DATA PERSONEL
    |--------------------------------------------------------------------------
    */

    $personTypes = $types
        ?? \App\Models\LecturerStaff::types();

    $selectedType = (string) old(
        'type',
        $lecturerStaff->type
    );

    $personName = trim(
        (string) $lecturerStaff->name
    );

    $personInitial = $personName !== ''
        ? mb_strtoupper(
            mb_substr($personName, 0, 1)
        )
        : 'T';

    $currentTypeLabel = $lecturerStaff->type_label;

    /*
    |--------------------------------------------------------------------------
    | FOTO SAAT INI
    |--------------------------------------------------------------------------
    */

    $currentPhotoPath = trim(
        (string) $lecturerStaff->photo
    );

    $currentPhotoExists = $currentPhotoPath !== ''
        && \Illuminate\Support\Facades\Storage::disk('public')
            ->exists($currentPhotoPath);

    $currentPhotoUrl = $currentPhotoExists
        ? asset('storage/' . $currentPhotoPath)
        : null;

    $currentPhotoName = $currentPhotoPath !== ''
        ? basename($currentPhotoPath)
        : null;
@endphp


<div class="space-y-8">

    {{-- ========================================================= --}}
    {{-- HEADER --}}
    {{-- ========================================================= --}}

    <div>
        <a
            href="{{ route('admin.lecturer-staff.index') }}"
            class="mb-4 inline-flex items-center
                   text-sm font-bold text-blue-700
                   transition hover:underline"
        >
            ← Kembali ke Data Dosen dan Staf
        </a>

        <h1
            class="text-3xl font-black text-slate-800
                   md:text-4xl"
        >
            Edit Data Dosen dan Staf
        </h1>

        <p
            class="mt-3 max-w-4xl
                   leading-7 text-slate-500"
        >
            Perbarui informasi dosen atau tenaga kependidikan
            Program Studi D-IV Teknik Mesin Produksi dan Perawatan
            Politeknik Negeri Malang.
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
                Perubahan belum dapat disimpan.
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
            id="lecturerStaffEditForm"
            action="{{ route(
                'admin.lecturer-staff.update',
                $lecturerStaff
            ) }}"
            method="POST"
            enctype="multipart/form-data"
            class="space-y-8 p-6 sm:p-7 md:p-8"
        >
            @csrf
            @method('PUT')


            <div class="grid gap-8 lg:grid-cols-12">

                {{-- ================================================= --}}
                {{-- FOTO PROFIL --}}
                {{-- ================================================= --}}

                <div class="lg:col-span-4">

                    <div
                        class="rounded-[2rem] border
                               border-slate-100 bg-slate-50
                               p-5 sm:p-6"
                    >
                        <h2
                            class="text-xl font-black
                                   text-slate-800"
                        >
                            Foto Profil
                        </h2>

                        <p
                            class="mt-2 text-sm leading-6
                                   text-slate-500"
                        >
                            Pilih foto baru hanya apabila ingin
                            mengganti foto yang saat ini tersimpan.
                        </p>


                        <div class="mt-6">

                            {{-- Preview --}}
                            <div
                                class="relative flex aspect-[4/5]
                                       w-full items-center
                                       justify-center overflow-hidden
                                       rounded-[2rem] border-2
                                       border-dashed border-slate-200
                                       bg-white"
                            >
                                <img
                                    id="photoPreview"
                                    src="{{ $currentPhotoUrl ?? '' }}"
                                    alt="Foto {{ $personName }}"
                                    @class([
                                        'h-full w-full object-cover object-top',
                                        'hidden' => !$currentPhotoUrl,
                                    ])
                                >

                                <div
                                    id="photoPlaceholder"
                                    @class([
                                        'px-6 text-center',
                                        'hidden' => (bool) $currentPhotoUrl,
                                    ])
                                >
                                    <div
                                        class="mx-auto flex h-16 w-16
                                               items-center justify-center
                                               rounded-2xl bg-blue-100
                                               text-blue-700"
                                    >
                                        <span class="text-2xl font-black">
                                            {{ $personInitial }}
                                        </span>
                                    </div>

                                    <p
                                        class="mt-4 text-sm
                                               font-bold text-slate-700"
                                    >
                                        Belum Ada Foto
                                    </p>

                                    <p
                                        class="mt-1 text-xs
                                               leading-5 text-slate-400"
                                    >
                                        Pratinjau foto baru akan
                                        tampil setelah file dipilih.
                                    </p>
                                </div>
                            </div>


                            {{-- Informasi Foto Lama --}}
                            @if ($currentPhotoPath !== '')
                                <div
                                    class="mt-4 rounded-2xl
                                           border border-slate-100
                                           bg-white p-4"
                                >
                                    <p
                                        class="text-xs font-bold uppercase
                                               tracking-wider text-slate-500"
                                    >
                                        Foto Saat Ini
                                    </p>

                                    <p
                                        class="mt-2 break-all text-sm
                                               font-semibold text-slate-700"
                                    >
                                        {{ $currentPhotoName }}
                                    </p>

                                    @if ($currentPhotoUrl)
                                        <a
                                            href="{{ $currentPhotoUrl }}"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="mt-4 inline-flex
                                                   items-center justify-center
                                                   rounded-xl bg-blue-50
                                                   px-4 py-2 text-sm
                                                   font-bold text-blue-700
                                                   transition
                                                   hover:bg-blue-700
                                                   hover:text-white"
                                        >
                                            Lihat Foto
                                        </a>
                                    @else
                                        <p
                                            class="mt-3 rounded-xl
                                                   border border-red-200
                                                   bg-red-50 px-4 py-3
                                                   text-sm font-semibold
                                                   text-red-700"
                                        >
                                            Foto tercatat di database,
                                            tetapi tidak ditemukan pada
                                            penyimpanan.
                                        </p>
                                    @endif
                                </div>
                            @endif


                            {{-- Input Foto --}}
                            <label
                                for="photoInput"
                                class="sr-only"
                            >
                                Unggah foto baru
                            </label>

                            <input
                                type="file"
                                id="photoInput"
                                name="photo"
                                accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                                aria-describedby="photoHelp photoClientError"
                                class="mt-5 block w-full
                                       text-sm text-slate-600
                                       file:mr-4 file:rounded-xl
                                       file:border-0
                                       file:bg-blue-700
                                       file:px-5 file:py-3
                                       file:font-bold file:text-white
                                       hover:file:bg-blue-800"
                            >

                            <p
                                id="photoHelp"
                                class="mt-3 text-sm
                                       leading-6 text-slate-500"
                            >
                                Kosongkan jika tidak ingin mengganti
                                foto. Format: JPG, JPEG, PNG, atau
                                WEBP. Ukuran maksimal 2 MB.
                            </p>

                            <div
                                id="photoInformation"
                                class="mt-4 hidden rounded-2xl
                                       border border-slate-100
                                       bg-white px-5 py-4
                                       text-sm font-semibold
                                       text-slate-700"
                                aria-live="polite"
                            ></div>

                            <p
                                id="photoClientError"
                                class="mt-3 hidden text-sm
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
                    </div>
                </div>


                {{-- ================================================= --}}
                {{-- DATA UTAMA --}}
                {{-- ================================================= --}}

                <div class="lg:col-span-8">

                    <div class="space-y-6">

                        {{-- Ringkasan --}}
                        <div
                            class="flex items-center gap-4
                                   rounded-3xl border
                                   border-slate-100 bg-slate-50
                                   p-5"
                        >
                            <div
                                class="flex h-14 w-14 shrink-0
                                       items-center justify-center
                                       rounded-2xl bg-blue-700
                                       font-black text-white
                                       shadow-lg"
                            >
                                {{ $personInitial }}
                            </div>

                            <div class="min-w-0">
                                <h2
                                    class="break-words text-xl
                                           font-black text-slate-800
                                           sm:text-2xl"
                                >
                                    {{ $personName }}
                                </h2>

                                <p class="mt-1 text-slate-500">
                                    {{ $currentTypeLabel }}
                                </p>
                            </div>
                        </div>


                        {{-- ========================================= --}}
                        {{-- NAMA --}}
                        {{-- ========================================= --}}

                        <div>
                            <label
                                for="name"
                                class="mb-2 block text-sm
                                       font-bold text-slate-700"
                            >
                                Nama Lengkap
                                <span class="text-red-600">*</span>
                            </label>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old(
                                    'name',
                                    $lecturerStaff->name
                                ) }}"
                                maxlength="255"
                                autocomplete="name"
                                placeholder="Contoh: Dr. Nama Dosen, S.T., M.T."
                                required
                                @class([
                                    'w-full rounded-2xl border bg-slate-50',
                                    'px-5 py-4 transition',
                                    'focus:bg-white focus:outline-none',
                                    'focus:ring-2 focus:ring-blue-500',
                                    'border-red-300' => $errors->has('name'),
                                    'border-slate-200' => !$errors->has('name'),
                                ])
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


                        {{-- ========================================= --}}
                        {{-- NIP --}}
                        {{-- ========================================= --}}

                        <div>
                            <label
                                for="nip"
                                class="mb-2 block text-sm
                                       font-bold text-slate-700"
                            >
                                NIP
                            </label>

                            <input
                                type="text"
                                id="nip"
                                name="nip"
                                value="{{ old(
                                    'nip',
                                    $lecturerStaff->nip
                                ) }}"
                                maxlength="100"
                                autocomplete="off"
                                inputmode="numeric"
                                placeholder="Masukkan NIP apabila tersedia"
                                @class([
                                    'w-full rounded-2xl border bg-slate-50',
                                    'px-5 py-4 transition',
                                    'focus:bg-white focus:outline-none',
                                    'focus:ring-2 focus:ring-blue-500',
                                    'border-red-300' => $errors->has('nip'),
                                    'border-slate-200' => !$errors->has('nip'),
                                ])
                            >

                            <p class="mt-2 text-sm text-slate-500">
                                Kosongkan apabila NIP belum tersedia.
                            </p>

                            @error('nip')
                                <p
                                    class="mt-2 text-sm
                                           font-semibold text-red-600"
                                >
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        {{-- ========================================= --}}
                        {{-- JENIS PERSONEL --}}
                        {{-- ========================================= --}}

                        <fieldset>
                            <legend
                                class="mb-3 block text-sm
                                       font-bold text-slate-700"
                            >
                                Jenis Personel
                                <span class="text-red-600">*</span>
                            </legend>

                            <div class="grid gap-4 sm:grid-cols-2">

                                @foreach ($personTypes as $typeValue => $typeLabel)

                                    @php
                                        $isDosen = $typeValue
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
                                                $selectedType === $typeValue
                                            )
                                        >

                                        <span
                                            @class([
                                                'block rounded-2xl border',
                                                'border-slate-200 bg-slate-50',
                                                'px-5 py-4 transition',
                                                'hover:border-blue-300',
                                                'peer-focus-visible:ring-2',
                                                'peer-focus-visible:ring-blue-500',
                                                'peer-focus-visible:ring-offset-2',
                                                'peer-checked:border-blue-700',
                                                'peer-checked:bg-blue-700',
                                                'peer-checked:text-white' =>
                                                    $isDosen,
                                                'peer-checked:border-yellow-400',
                                                'peer-checked:bg-yellow-400',
                                                'peer-checked:text-slate-900' =>
                                                    !$isDosen,
                                            ])
                                        >
                                            <span class="block font-black">
                                                {{ $typeLabel }}
                                            </span>

                                            <span
                                                class="mt-1 block text-sm
                                                       leading-6 opacity-75"
                                            >
                                                {{ $isDosen
                                                    ? 'Tenaga pendidik dan pengajar program studi.'
                                                    : 'Tenaga kependidikan dan pendukung pelayanan akademik.' }}
                                            </span>
                                        </span>

                                    </label>

                                @endforeach
                            </div>

                            @error('type')
                                <p
                                    class="mt-3 text-sm
                                           font-semibold text-red-600"
                                >
                                    {{ $message }}
                                </p>
                            @enderror
                        </fieldset>


                        {{-- ========================================= --}}
                        {{-- INFORMASI PUBLIKASI --}}
                        {{-- ========================================= --}}

                        <div
                            class="rounded-3xl border
                                   border-blue-100 bg-blue-50
                                   p-5"
                        >
                            <div class="flex items-start gap-4">

                                <div
                                    class="flex h-11 w-11 shrink-0
                                           items-center justify-center
                                           rounded-2xl bg-blue-700
                                           text-white"
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
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12A9 9 0 113 12a9 9 0 0118 0z"
                                        />
                                    </svg>
                                </div>

                                <div>
                                    <h3
                                        class="font-black
                                               text-slate-800"
                                    >
                                        Informasi Publikasi
                                    </h3>

                                    <p
                                        class="mt-1 text-sm
                                               leading-6 text-slate-500"
                                    >
                                        Perubahan yang disimpan akan
                                        langsung digunakan pada halaman
                                        publik karena tabel saat ini belum
                                        memiliki status aktif atau nonaktif.
                                    </p>
                                </div>
                            </div>
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
                    Perubahan nama, NIP, jenis personel, dan foto
                    akan tampil pada halaman publik setelah disimpan.
                </p>

                <div class="flex flex-col gap-3 sm:flex-row">

                    <a
                        href="{{ route(
                            'admin.lecturer-staff.index'
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
                        id="lecturerStaffSubmit"
                        class="inline-flex items-center
                               justify-center rounded-2xl
                               bg-blue-700 px-7 py-4
                               font-bold text-white shadow-lg
                               shadow-blue-700/20 transition
                               hover:bg-blue-800
                               disabled:cursor-not-allowed
                               disabled:opacity-60"
                    >
                        Simpan Perubahan
                    </button>

                </div>
            </div>

        </form>
    </div>

</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById(
            'lecturerStaffEditForm'
        );

        const photoInput = document.getElementById(
            'photoInput'
        );

        const photoPreview = document.getElementById(
            'photoPreview'
        );

        const photoPlaceholder = document.getElementById(
            'photoPlaceholder'
        );

        const photoInformation = document.getElementById(
            'photoInformation'
        );

        const photoClientError = document.getElementById(
            'photoClientError'
        );

        const submitButton = document.getElementById(
            'lecturerStaffSubmit'
        );

        const currentPhotoUrl = @json($currentPhotoUrl);

        const maximumFileSize = 2 * 1024 * 1024;

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


        function getFileExtension(fileName) {
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


        function restoreCurrentPhoto() {
            clearPreviewUrl();

            if (!photoPreview || !photoPlaceholder) {
                return;
            }

            if (currentPhotoUrl) {
                photoPreview.src = currentPhotoUrl;
                photoPreview.classList.remove('hidden');
                photoPlaceholder.classList.add('hidden');
            } else {
                photoPreview.src = '';
                photoPreview.classList.add('hidden');
                photoPlaceholder.classList.remove('hidden');
            }
        }


        function resetPhotoMessages() {
            photoIsValid = true;

            if (photoInformation) {
                photoInformation.textContent = '';
                photoInformation.classList.add('hidden');
            }

            if (photoClientError) {
                photoClientError.textContent = '';
                photoClientError.classList.add('hidden');
            }
        }


        function showPhotoError(message) {
            photoIsValid = false;

            if (photoClientError) {
                photoClientError.textContent = message;
                photoClientError.classList.remove('hidden');
            }
        }


        if (photoInput) {
            photoInput.addEventListener('change', function () {
                resetPhotoMessages();
                restoreCurrentPhoto();

                const file = this.files
                    ? this.files[0]
                    : null;

                if (!file) {
                    return;
                }

                const extension = getFileExtension(file.name);

                const mimeTypeValid =
                    file.type === ''
                    || allowedMimeTypes.includes(file.type);

                const extensionValid =
                    allowedExtensions.includes(extension);

                if (!mimeTypeValid || !extensionValid) {
                    showPhotoError(
                        'Format foto harus JPG, JPEG, PNG, atau WEBP.'
                    );

                    this.value = '';

                    return;
                }

                if (file.size > maximumFileSize) {
                    showPhotoError(
                        'Ukuran foto '
                        + formatFileSize(file.size)
                        + '. Maksimal ukuran foto adalah 2 MB.'
                    );

                    this.value = '';

                    return;
                }

                clearPreviewUrl();

                previewUrl = URL.createObjectURL(file);

                if (photoPreview) {
                    photoPreview.src = previewUrl;
                    photoPreview.classList.remove('hidden');
                }

                if (photoPlaceholder) {
                    photoPlaceholder.classList.add('hidden');
                }

                if (photoInformation) {
                    photoInformation.textContent =
                        'Foto baru dipilih: '
                        + file.name
                        + ' ('
                        + formatFileSize(file.size)
                        + ')';

                    photoInformation.classList.remove('hidden');
                }
            });
        }


        if (form && submitButton) {
            form.addEventListener('submit', function (event) {
                if (!photoIsValid) {
                    event.preventDefault();

                    if (photoClientError) {
                        photoClientError.classList.remove('hidden');
                    }

                    return;
                }

                submitButton.disabled = true;
                submitButton.textContent = 'Menyimpan...';
            });
        }


        window.addEventListener('beforeunload', function () {
            clearPreviewUrl();
        });
    });
</script>

@endsection