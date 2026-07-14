@php
    /*
    |--------------------------------------------------------------------------
    | KONTEKS FORM
    |--------------------------------------------------------------------------
    */

    $isEdit = isset($accreditation)
        && $accreditation !== null;

    /*
    |--------------------------------------------------------------------------
    | NILAI FORM
    |--------------------------------------------------------------------------
    */

    $selectedType = old(
        'type',
        $isEdit
            ? $accreditation->type
            : \App\Models\Accreditation::TYPE_NATIONAL
    );

    $selectedIsActive = (string) old(
        'is_active',
        $isEdit
            ? ((bool) $accreditation->is_active ? '1' : '0')
            : '1'
    ) === '1';

    $validFromValue = old(
        'valid_from',
        $isEdit && $accreditation->valid_from
            ? $accreditation->valid_from->format('Y-m-d')
            : ''
    );

    $validUntilValue = old(
        'valid_until',
        $isEdit && $accreditation->valid_until
            ? $accreditation->valid_until->format('Y-m-d')
            : ''
    );

    /*
    |--------------------------------------------------------------------------
    | FILE SAAT INI
    |--------------------------------------------------------------------------
    */

    $currentFilePath = $isEdit
        ? trim((string) $accreditation->file_path)
        : '';

    $currentFileExists = $currentFilePath !== ''
        && \Illuminate\Support\Facades\Storage::disk(
            'public'
        )->exists($currentFilePath);

    $currentFileUrl = $currentFileExists
        ? asset('storage/' . $currentFilePath)
        : null;

    $currentExtension = $currentFilePath !== ''
        ? strtolower(
            pathinfo(
                $currentFilePath,
                PATHINFO_EXTENSION
            )
        )
        : null;

    $currentIsImage = $currentFileExists
        && in_array(
            $currentExtension,
            [
                'jpg',
                'jpeg',
                'png',
                'webp',
            ],
            true
        );

    $currentIsPdf = $currentFileExists
        && $currentExtension === 'pdf';
@endphp


<div class="grid gap-8 xl:grid-cols-12">

    {{-- ========================================================= --}}
    {{-- KOLOM INFORMASI UTAMA --}}
    {{-- ========================================================= --}}

    <div class="space-y-6 xl:col-span-8">

        <section
            class="overflow-hidden rounded-[2rem]
                   border border-slate-100
                   bg-white shadow-sm"
        >
            <div
                class="border-b border-slate-100
                       bg-slate-50/70 px-6 py-5"
            >
                <h2
                    class="text-xl font-black
                           text-slate-800"
                >
                    Informasi Akreditasi
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Isi hanya berdasarkan informasi dan dokumen resmi
                    Program Studi D-IV Teknik Mesin Produksi dan
                    Perawatan.
                </p>
            </div>


            <div class="space-y-6 p-6">

                {{-- ================================================= --}}
                {{-- JUDUL --}}
                {{-- ================================================= --}}

                <div>
                    <label
                        for="accreditationTitle"
                        class="mb-2 block text-sm
                               font-bold text-slate-700"
                    >
                        Judul Akreditasi
                        <span class="text-red-600">*</span>
                    </label>

                    <input
                        type="text"
                        id="accreditationTitle"
                        name="title"
                        value="{{ old(
                            'title',
                            $isEdit
                                ? $accreditation->title
                                : ''
                        ) }}"
                        maxlength="255"
                        placeholder="Contoh: Akreditasi Program Studi D-IV TMPP"
                        required
                        autofocus
                        @class([
                            'w-full rounded-2xl border',
                            'bg-white px-4 py-3',
                            'text-slate-700 transition',
                            'focus:border-blue-500',
                            'focus:outline-none',
                            'focus:ring-2 focus:ring-blue-500/20',
                            'border-red-300' =>
                                $errors->has('title'),
                            'border-slate-200' =>
                                !$errors->has('title'),
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


                <div class="grid gap-5 md:grid-cols-2">

                    {{-- ============================================= --}}
                    {{-- JENIS --}}
                    {{-- ============================================= --}}

                    <div>
                        <label
                            for="accreditationType"
                            class="mb-2 block text-sm
                                   font-bold text-slate-700"
                        >
                            Jenis Akreditasi
                            <span class="text-red-600">*</span>
                        </label>

                        <select
                            id="accreditationType"
                            name="type"
                            required
                            @class([
                                'w-full rounded-2xl border',
                                'bg-white px-4 py-3',
                                'text-slate-700 transition',
                                'focus:border-blue-500',
                                'focus:outline-none',
                                'focus:ring-2 focus:ring-blue-500/20',
                                'border-red-300' =>
                                    $errors->has('type'),
                                'border-slate-200' =>
                                    !$errors->has('type'),
                            ])
                        >
                            @foreach ($types as $key => $label)
                                <option
                                    value="{{ $key }}"
                                    @selected(
                                        (string) $selectedType
                                        === (string) $key
                                    )
                                >
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>

                        @error('type')
                            <p
                                class="mt-2 text-sm
                                       font-semibold text-red-600"
                            >
                                {{ $message }}
                            </p>
                        @enderror
                    </div>


                    {{-- ============================================= --}}
                    {{-- LEMBAGA --}}
                    {{-- ============================================= --}}

                    <div>
                        <label
                            for="accreditationInstitution"
                            class="mb-2 block text-sm
                                   font-bold text-slate-700"
                        >
                            Lembaga Akreditasi
                        </label>

                        <input
                            type="text"
                            id="accreditationInstitution"
                            name="institution"
                            value="{{ old(
                                'institution',
                                $isEdit
                                    ? $accreditation->institution
                                    : ''
                            ) }}"
                            maxlength="255"
                            placeholder="Masukkan nama lembaga resmi"
                            @class([
                                'w-full rounded-2xl border',
                                'bg-white px-4 py-3',
                                'text-slate-700 transition',
                                'focus:border-blue-500',
                                'focus:outline-none',
                                'focus:ring-2 focus:ring-blue-500/20',
                                'border-red-300' =>
                                    $errors->has('institution'),
                                'border-slate-200' =>
                                    !$errors->has('institution'),
                            ])
                        >

                        <p class="mt-2 text-xs leading-5 text-slate-500">
                            Kosongkan apabila nama lembaga belum
                            terverifikasi.
                        </p>

                        @error('institution')
                            <p
                                class="mt-2 text-sm
                                       font-semibold text-red-600"
                            >
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>


                <div class="grid gap-5 md:grid-cols-2">

                    {{-- ============================================= --}}
                    {{-- PERINGKAT --}}
                    {{-- ============================================= --}}

                    <div>
                        <label
                            for="accreditationRank"
                            class="mb-2 block text-sm
                                   font-bold text-slate-700"
                        >
                            Peringkat atau Status
                        </label>

                        <input
                            type="text"
                            id="accreditationRank"
                            name="rank"
                            value="{{ old(
                                'rank',
                                $isEdit
                                    ? $accreditation->rank
                                    : ''
                            ) }}"
                            maxlength="255"
                            placeholder="Masukkan sesuai dokumen resmi"
                            @class([
                                'w-full rounded-2xl border',
                                'bg-white px-4 py-3',
                                'text-slate-700 transition',
                                'focus:border-blue-500',
                                'focus:outline-none',
                                'focus:ring-2 focus:ring-blue-500/20',
                                'border-red-300' =>
                                    $errors->has('rank'),
                                'border-slate-200' =>
                                    !$errors->has('rank'),
                            ])
                        >

                        @error('rank')
                            <p
                                class="mt-2 text-sm
                                       font-semibold text-red-600"
                            >
                                {{ $message }}
                            </p>
                        @enderror
                    </div>


                    {{-- ============================================= --}}
                    {{-- NOMOR SERTIFIKAT --}}
                    {{-- ============================================= --}}

                    <div>
                        <label
                            for="accreditationCertificateNumber"
                            class="mb-2 block text-sm
                                   font-bold text-slate-700"
                        >
                            Nomor Sertifikat atau SK
                        </label>

                        <input
                            type="text"
                            id="accreditationCertificateNumber"
                            name="certificate_number"
                            value="{{ old(
                                'certificate_number',
                                $isEdit
                                    ? $accreditation
                                        ->certificate_number
                                    : ''
                            ) }}"
                            maxlength="255"
                            placeholder="Masukkan apabila tersedia"
                            @class([
                                'w-full rounded-2xl border',
                                'bg-white px-4 py-3',
                                'text-slate-700 transition',
                                'focus:border-blue-500',
                                'focus:outline-none',
                                'focus:ring-2 focus:ring-blue-500/20',
                                'border-red-300' =>
                                    $errors->has(
                                        'certificate_number'
                                    ),
                                'border-slate-200' =>
                                    !$errors->has(
                                        'certificate_number'
                                    ),
                            ])
                        >

                        <p class="mt-2 text-xs leading-5 text-slate-500">
                            Jangan mengisi nomor keputusan program
                            studi lain.
                        </p>

                        @error('certificate_number')
                            <p
                                class="mt-2 text-sm
                                       font-semibold text-red-600"
                            >
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>


                <div class="grid gap-5 md:grid-cols-2">

                    {{-- ============================================= --}}
                    {{-- BERLAKU MULAI --}}
                    {{-- ============================================= --}}

                    <div>
                        <label
                            for="accreditationValidFrom"
                            class="mb-2 block text-sm
                                   font-bold text-slate-700"
                        >
                            Berlaku Mulai
                        </label>

                        <input
                            type="date"
                            id="accreditationValidFrom"
                            name="valid_from"
                            value="{{ $validFromValue }}"
                            @class([
                                'w-full rounded-2xl border',
                                'bg-white px-4 py-3',
                                'text-slate-700 transition',
                                'focus:border-blue-500',
                                'focus:outline-none',
                                'focus:ring-2 focus:ring-blue-500/20',
                                'border-red-300' =>
                                    $errors->has('valid_from'),
                                'border-slate-200' =>
                                    !$errors->has('valid_from'),
                            ])
                        >

                        @error('valid_from')
                            <p
                                class="mt-2 text-sm
                                       font-semibold text-red-600"
                            >
                                {{ $message }}
                            </p>
                        @enderror
                    </div>


                    {{-- ============================================= --}}
                    {{-- BERLAKU SAMPAI --}}
                    {{-- ============================================= --}}

                    <div>
                        <label
                            for="accreditationValidUntil"
                            class="mb-2 block text-sm
                                   font-bold text-slate-700"
                        >
                            Berlaku Sampai
                        </label>

                        <input
                            type="date"
                            id="accreditationValidUntil"
                            name="valid_until"
                            value="{{ $validUntilValue }}"
                            @class([
                                'w-full rounded-2xl border',
                                'bg-white px-4 py-3',
                                'text-slate-700 transition',
                                'focus:border-blue-500',
                                'focus:outline-none',
                                'focus:ring-2 focus:ring-blue-500/20',
                                'border-red-300' =>
                                    $errors->has('valid_until'),
                                'border-slate-200' =>
                                    !$errors->has('valid_until'),
                            ])
                        >

                        @error('valid_until')
                            <p
                                class="mt-2 text-sm
                                       font-semibold text-red-600"
                            >
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>


                {{-- ================================================= --}}
                {{-- DESKRIPSI --}}
                {{-- ================================================= --}}

                <div>
                    <label
                        for="accreditationDescription"
                        class="mb-2 block text-sm
                               font-bold text-slate-700"
                    >
                        Deskripsi
                    </label>

                    <textarea
                        id="accreditationDescription"
                        name="description"
                        rows="6"
                        placeholder="Masukkan uraian resmi apabila tersedia"
                        @class([
                            'w-full rounded-2xl border',
                            'bg-white px-4 py-3',
                            'leading-7 text-slate-700',
                            'transition focus:border-blue-500',
                            'focus:outline-none',
                            'focus:ring-2 focus:ring-blue-500/20',
                            'border-red-300' =>
                                $errors->has('description'),
                            'border-slate-200' =>
                                !$errors->has('description'),
                        ])
                    >{{ old(
                        'description',
                        $isEdit
                            ? $accreditation->description
                            : ''
                    ) }}</textarea>

                    <p class="mt-2 text-xs leading-5 text-slate-500">
                        Deskripsi boleh dikosongkan sampai tersedia
                        materi resmi.
                    </p>

                    @error('description')
                        <p
                            class="mt-2 text-sm
                                   font-semibold text-red-600"
                        >
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>
        </section>
    </div>


    {{-- ========================================================= --}}
    {{-- KOLOM PENGATURAN --}}
    {{-- ========================================================= --}}

    <div class="space-y-6 xl:col-span-4">

        {{-- ===================================================== --}}
        {{-- PENGATURAN --}}
        {{-- ===================================================== --}}

        <section
            class="overflow-hidden rounded-[2rem]
                   border border-slate-100
                   bg-white shadow-sm"
        >
            <div
                class="border-b border-slate-100
                       bg-slate-50/70 px-6 py-5"
            >
                <h2
                    class="text-xl font-black
                           text-slate-800"
                >
                    Pengaturan
                </h2>
            </div>

            <div class="space-y-5 p-6">

                {{-- Urutan --}}
                <div>
                    <label
                        for="accreditationSortOrder"
                        class="mb-2 block text-sm
                               font-bold text-slate-700"
                    >
                        Urutan Tampil
                    </label>

                    <input
                        type="number"
                        id="accreditationSortOrder"
                        name="sort_order"
                        value="{{ old(
                            'sort_order',
                            $isEdit
                                ? $accreditation->sort_order
                                : 0
                        ) }}"
                        min="0"
                        step="1"
                        inputmode="numeric"
                        @class([
                            'w-full rounded-2xl border',
                            'bg-white px-4 py-3',
                            'text-slate-700 transition',
                            'focus:border-blue-500',
                            'focus:outline-none',
                            'focus:ring-2 focus:ring-blue-500/20',
                            'border-red-300' =>
                                $errors->has('sort_order'),
                            'border-slate-200' =>
                                !$errors->has('sort_order'),
                        ])
                    >

                    <p class="mt-2 text-xs leading-5 text-slate-500">
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


                {{-- Status --}}
                <div>
                    <input
                        type="hidden"
                        name="is_active"
                        value="0"
                    >

                    <label
                        class="flex cursor-pointer
                               items-start gap-4 rounded-2xl
                               border border-slate-200
                               bg-slate-50 p-4
                               transition hover:border-blue-200
                               hover:bg-blue-50"
                    >
                        <input
                            type="checkbox"
                            name="is_active"
                            value="1"
                            @checked($selectedIsActive)
                            class="mt-1 h-5 w-5 rounded
                                   border-slate-300
                                   text-blue-700
                                   focus:ring-blue-500"
                        >

                        <span>
                            <span
                                class="block text-sm
                                       font-black text-slate-800"
                            >
                                Siap Dipublikasikan
                            </span>

                            <span
                                class="mt-1 block text-xs
                                       leading-5 text-slate-500"
                            >
                                Status ini menentukan apakah data
                                boleh digunakan pada halaman publik
                                yang terhubung dengan modul
                                akreditasi.
                            </span>
                        </span>
                    </label>

                    @error('is_active')
                        <p
                            class="mt-2 text-sm
                                   font-semibold text-red-600"
                        >
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>
        </section>


        {{-- ===================================================== --}}
        {{-- DOKUMEN --}}
        {{-- ===================================================== --}}

        <section
            class="overflow-hidden rounded-[2rem]
                   border border-slate-100
                   bg-white shadow-sm"
        >
            <div
                class="border-b border-slate-100
                       bg-slate-50/70 px-6 py-5"
            >
                <h2
                    class="text-xl font-black
                           text-slate-800"
                >
                    Dokumen Akreditasi
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Unggah sertifikat atau dokumen keputusan resmi.
                </p>
            </div>


            <div class="space-y-5 p-6">

                {{-- ============================================= --}}
                {{-- FILE SAAT INI --}}
                {{-- ============================================= --}}

                @if ($currentFileUrl !== null)

                    <div
                        class="overflow-hidden rounded-2xl
                               border border-slate-100
                               bg-slate-50"
                    >
                        @if ($currentIsImage)
                            <a
                                href="{{ $currentFileUrl }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="block"
                            >
                                <img
                                    src="{{ $currentFileUrl }}"
                                    alt="Dokumen akreditasi saat ini"
                                    class="h-56 w-full
                                           bg-white p-3
                                           object-contain"
                                >
                            </a>

                        @elseif ($currentIsPdf)
                            <div
                                class="flex h-56 flex-col
                                       items-center justify-center
                                       bg-white p-6 text-center"
                            >
                                <div
                                    class="flex h-16 w-16
                                           items-center justify-center
                                           rounded-2xl bg-red-100
                                           text-xl font-black
                                           text-red-600"
                                >
                                    PDF
                                </div>

                                <p
                                    class="mt-4 text-sm
                                           font-black text-slate-800"
                                >
                                    Dokumen PDF Saat Ini
                                </p>

                                <a
                                    href="{{ $currentFileUrl }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="mt-2 text-xs
                                           font-black text-blue-700
                                           hover:underline"
                                >
                                    Buka Dokumen
                                </a>
                            </div>
                        @endif
                    </div>

                @elseif ($currentFilePath !== '')

                    <div
                        class="rounded-2xl border
                               border-red-200 bg-red-50
                               p-5 text-red-700"
                    >
                        <p class="font-bold">
                            File lama tidak ditemukan.
                        </p>

                        <p
                            class="mt-2 break-all
                                   text-xs leading-5"
                        >
                            {{ $currentFilePath }}
                        </p>

                        <p class="mt-2 text-xs leading-5">
                            Unggah dokumen baru untuk mengganti
                            referensi file yang hilang.
                        </p>
                    </div>

                @endif


                {{-- ============================================= --}}
                {{-- INPUT FILE --}}
                {{-- ============================================= --}}

                <div>
                    <label
                        for="accreditationFile"
                        class="mb-2 block text-sm
                               font-bold text-slate-700"
                    >
                        {{ $isEdit
                            ? 'Ganti Dokumen'
                            : 'Unggah Dokumen' }}
                    </label>

                    <input
                        type="file"
                        id="accreditationFile"
                        name="file_path"
                        accept=".pdf,.jpg,.jpeg,.png,.webp,application/pdf,image/jpeg,image/png,image/webp"
                        data-accreditation-file-input
                        @class([
                            'block w-full rounded-2xl border',
                            'bg-white p-3 text-sm',
                            'text-slate-600',
                            'file:mr-3 file:rounded-xl',
                            'file:border-0 file:bg-blue-700',
                            'file:px-4 file:py-2',
                            'file:font-bold file:text-white',
                            'hover:file:bg-blue-800',
                            'border-red-300' =>
                                $errors->has('file_path'),
                            'border-slate-200' =>
                                !$errors->has('file_path'),
                        ])
                    >

                    <p class="mt-2 text-xs leading-5 text-slate-500">
                        Format PDF, JPG, JPEG, PNG, atau WEBP.
                        Ukuran maksimal 20 MB.

                        @if ($isEdit)
                            Kosongkan untuk mempertahankan dokumen
                            lama.
                        @endif
                    </p>

                    <p
                        data-accreditation-file-error
                        class="mt-2 hidden text-sm
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


                {{-- ============================================= --}}
                {{-- PREVIEW FILE BARU --}}
                {{-- ============================================= --}}

                <div
                    data-accreditation-preview-container
                    class="hidden overflow-hidden
                           rounded-2xl border
                           border-blue-100 bg-blue-50 p-4"
                >
                    <p
                        class="text-xs font-bold uppercase
                               tracking-wider text-blue-700"
                    >
                        Dokumen Baru Dipilih
                    </p>

                    <div
                        class="mt-4 overflow-hidden
                               rounded-xl bg-white"
                    >
                        <img
                            src=""
                            alt="Pratinjau dokumen baru"
                            data-accreditation-image-preview
                            class="hidden h-48 w-full
                                   object-contain p-3"
                        >

                        <div
                            data-accreditation-pdf-preview
                            class="hidden h-48 flex-col
                                   items-center justify-center"
                        >
                            <div
                                class="flex h-16 w-16
                                       items-center justify-center
                                       rounded-2xl bg-red-100
                                       font-black text-red-600"
                            >
                                PDF
                            </div>

                            <p
                                class="mt-3 text-sm
                                       font-bold text-slate-700"
                            >
                                Dokumen PDF
                            </p>
                        </div>
                    </div>

                    <p
                        data-accreditation-file-information
                        class="mt-3 break-all text-sm
                               font-semibold text-slate-700"
                    ></p>
                </div>
            </div>
        </section>


        {{-- ===================================================== --}}
        {{-- AKSI --}}
        {{-- ===================================================== --}}

        <section
            class="rounded-[2rem] border
                   border-slate-100 bg-white
                   p-5 shadow-sm"
        >
            <div class="grid grid-cols-2 gap-3">

                <a
                    href="{{ route(
                        'admin.accreditations.index'
                    ) }}"
                    class="inline-flex items-center
                           justify-center rounded-2xl
                           bg-slate-100 px-5 py-3
                           font-black text-slate-700
                           transition hover:bg-slate-200"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="inline-flex items-center
                           justify-center rounded-2xl
                           bg-blue-700 px-5 py-3
                           font-black text-white
                           shadow-lg shadow-blue-700/20
                           transition hover:bg-blue-800
                           disabled:cursor-not-allowed
                           disabled:opacity-60"
                >
                    {{ $isEdit
                        ? 'Simpan Perubahan'
                        : 'Simpan' }}
                </button>
            </div>
        </section>
    </div>
</div>


@once
    @push('scripts')
        <script>
            document.addEventListener(
                'DOMContentLoaded',
                function () {
                    const maximumFileSize =
                        20 * 1024 * 1024;

                    const allowedExtensions = [
                        'pdf',
                        'jpg',
                        'jpeg',
                        'png',
                        'webp',
                    ];

                    const input = document.querySelector(
                        '[data-accreditation-file-input]'
                    );

                    const errorElement =
                        document.querySelector(
                            '[data-accreditation-file-error]'
                        );

                    const previewContainer =
                        document.querySelector(
                            '[data-accreditation-preview-container]'
                        );

                    const imagePreview =
                        document.querySelector(
                            '[data-accreditation-image-preview]'
                        );

                    const pdfPreview =
                        document.querySelector(
                            '[data-accreditation-pdf-preview]'
                        );

                    const fileInformation =
                        document.querySelector(
                            '[data-accreditation-file-information]'
                        );

                    let previewUrl = null;


                    function getExtension(fileName) {
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


                    function revokePreviewUrl() {
                        if (!previewUrl) {
                            return;
                        }

                        URL.revokeObjectURL(
                            previewUrl
                        );

                        previewUrl = null;
                    }


                    function resetPreview() {
                        revokePreviewUrl();

                        if (previewContainer) {
                            previewContainer.classList.add(
                                'hidden'
                            );
                        }

                        if (imagePreview) {
                            imagePreview.src = '';

                            imagePreview.classList.add(
                                'hidden'
                            );
                        }

                        if (pdfPreview) {
                            pdfPreview.classList.add(
                                'hidden'
                            );

                            pdfPreview.classList.remove(
                                'flex'
                            );
                        }

                        if (fileInformation) {
                            fileInformation.textContent = '';
                        }
                    }


                    function clearError() {
                        if (!errorElement) {
                            return;
                        }

                        errorElement.textContent = '';

                        errorElement.classList.add(
                            'hidden'
                        );
                    }


                    function showError(message) {
                        if (!errorElement) {
                            return;
                        }

                        errorElement.textContent = message;

                        errorElement.classList.remove(
                            'hidden'
                        );
                    }


                    if (input) {
                        input.addEventListener(
                            'change',
                            function () {
                                clearError();
                                resetPreview();

                                const file = this.files
                                    ? this.files[0]
                                    : null;

                                if (!file) {
                                    return;
                                }

                                const extension =
                                    getExtension(file.name);

                                if (
                                    !allowedExtensions.includes(
                                        extension
                                    )
                                ) {
                                    showError(
                                        'Format dokumen harus PDF, JPG, JPEG, PNG, atau WEBP.'
                                    );

                                    this.value = '';

                                    return;
                                }

                                if (
                                    file.size >
                                    maximumFileSize
                                ) {
                                    showError(
                                        'Ukuran dokumen '
                                        + formatFileSize(
                                            file.size
                                        )
                                        + '. Ukuran maksimal adalah 20 MB.'
                                    );

                                    this.value = '';

                                    return;
                                }

                                if (previewContainer) {
                                    previewContainer
                                        .classList
                                        .remove('hidden');
                                }

                                if (fileInformation) {
                                    fileInformation.textContent =
                                        file.name
                                        + ' • '
                                        + formatFileSize(
                                            file.size
                                        );
                                }

                                if (extension === 'pdf') {
                                    if (pdfPreview) {
                                        pdfPreview.classList.remove(
                                            'hidden'
                                        );

                                        pdfPreview.classList.add(
                                            'flex'
                                        );
                                    }

                                    return;
                                }

                                previewUrl =
                                    URL.createObjectURL(file);

                                if (imagePreview) {
                                    imagePreview.src =
                                        previewUrl;

                                    imagePreview.classList.remove(
                                        'hidden'
                                    );
                                }
                            }
                        );
                    }


                    window.addEventListener(
                        'beforeunload',
                        revokePreviewUrl
                    );
                }
            );
        </script>
    @endpush
@endonce