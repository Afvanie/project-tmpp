@php
    $isEdit = isset($accreditation)
        && $accreditation !== null;

    $selectedType = old(
        'type',
        $isEdit
            ? $accreditation->type
            : \App\Models\Accreditation::TYPE_NATIONAL
    );

    $isShown = (string) old(
        'is_active',
        $isEdit
            ? (
                $accreditation->is_active
                    ? '1'
                    : '0'
            )
            : '1'
    ) === '1';

    $validFrom = old(
        'valid_from',
        $isEdit && $accreditation->valid_from
            ? $accreditation->valid_from->format(
                'Y-m-d'
            )
            : ''
    );

    $validUntil = old(
        'valid_until',
        $isEdit && $accreditation->valid_until
            ? $accreditation->valid_until->format(
                'Y-m-d'
            )
            : ''
    );

    $currentFilePath = $isEdit
        ? trim(
            (string) $accreditation->file_path
        )
        : '';

    $currentFileExists =
        $currentFilePath !== ''
        && \Illuminate\Support\Facades\Storage::disk(
            'public'
        )->exists($currentFilePath);

    $currentFileUrl = $currentFileExists
        ? asset(
            'storage/'
            . ltrim($currentFilePath, '/')
        )
        : null;

    $currentExtension = $currentFilePath !== ''
        ? strtolower(
            pathinfo(
                $currentFilePath,
                PATHINFO_EXTENSION
            )
        )
        : null;

    $currentFileIsImage =
        $currentFileExists
        && in_array(
            $currentExtension,
            ['jpg', 'jpeg', 'png', 'webp'],
            true
        );

    $preservedOrder = old(
        'sort_order',
        $isEdit
            ? $accreditation->sort_order
            : 0
    );
@endphp


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


<div
    class="overflow-hidden rounded-2xl
           border border-slate-200
           bg-white"
>
    <div class="px-5 py-7 sm:px-6 lg:px-8">

        <div
            class="flex flex-col gap-2
                   border-b border-slate-200
                   pb-6"
        >
            <h2
                class="text-lg font-extrabold
                       text-slate-900"
            >
                Informasi Akreditasi
            </h2>

            <p
                class="text-sm leading-7
                       text-slate-500"
            >
                Lengkapi data berdasarkan dokumen resmi.
                Kolom yang belum memiliki sumber resmi boleh
                dikosongkan.
            </p>
        </div>


        <div class="mt-6 space-y-6">

            {{-- JUDUL --}}
            <div>
                <label
                    for="title"
                    class="block text-sm
                           font-bold text-slate-800"
                >
                    Judul akreditasi
                </label>

                <p
                    class="mt-1 text-xs
                           leading-6 text-slate-500"
                >
                    Contoh: Akreditasi Program Studi D-IV TMPP
                </p>

                <input
                    id="title"
                    type="text"
                    name="title"
                    value="{{ old(
                        'title',
                        $isEdit
                            ? $accreditation->title
                            : ''
                    ) }}"
                    required
                    autofocus
                    class="mt-2 w-full
                           rounded-xl border
                           border-slate-200
                           px-4 py-3 text-sm
                           font-bold text-slate-800
                           outline-none transition
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


            {{-- CAKUPAN + LEMBAGA --}}
            <div
                class="grid gap-5
                       md:grid-cols-2"
            >
                <div>
                    <label
                        for="type"
                        class="block text-sm
                               font-bold text-slate-800"
                    >
                        Cakupan akreditasi
                    </label>

                    <select
                        id="type"
                        name="type"
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
                        @foreach ($types as $value => $label)
                            <option
                                value="{{ $value }}"
                                @selected(
                                    (string) $selectedType
                                    === (string) $value
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


                <div>
                    <label
                        for="institution"
                        class="block text-sm
                               font-bold text-slate-800"
                    >
                        Lembaga pemberi akreditasi
                    </label>

                    <input
                        id="institution"
                        type="text"
                        name="institution"
                        value="{{ old(
                            'institution',
                            $isEdit
                                ? $accreditation->institution
                                : ''
                        ) }}"
                        placeholder="Contoh: LAM Teknik"
                        class="mt-2 w-full
                               rounded-xl border
                               border-slate-200
                               px-4 py-3 text-sm
                               text-slate-800
                               outline-none transition
                               focus:border-[#075F9B]
                               focus:ring-4
                               focus:ring-blue-100"
                    >

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


            {{-- PERINGKAT + NOMOR --}}
            <div
                class="grid gap-5
                       md:grid-cols-2"
            >
                <div>
                    <label
                        for="rank"
                        class="block text-sm
                               font-bold text-slate-800"
                    >
                        Peringkat akreditasi
                    </label>

                    <input
                        id="rank"
                        type="text"
                        name="rank"
                        value="{{ old(
                            'rank',
                            $isEdit
                                ? $accreditation->rank
                                : ''
                        ) }}"
                        placeholder="Contoh: A"
                        class="mt-2 w-full
                               rounded-xl border
                               border-slate-200
                               px-4 py-3 text-sm
                               text-slate-800
                               outline-none transition
                               focus:border-[#075F9B]
                               focus:ring-4
                               focus:ring-blue-100"
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


                <div>
                    <label
                        for="certificate_number"
                        class="block text-sm
                               font-bold text-slate-800"
                    >
                        Nomor sertifikat atau keputusan
                    </label>

                    <input
                        id="certificate_number"
                        type="text"
                        name="certificate_number"
                        value="{{ old(
                            'certificate_number',
                            $isEdit
                                ? $accreditation
                                    ->certificate_number
                                : ''
                        ) }}"
                        placeholder="Kosongkan jika belum tersedia"
                        class="mt-2 w-full
                               rounded-xl border
                               border-slate-200
                               px-4 py-3 text-sm
                               text-slate-800
                               outline-none transition
                               focus:border-[#075F9B]
                               focus:ring-4
                               focus:ring-blue-100"
                    >

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


            {{-- MASA BERLAKU --}}
            <div
                class="grid gap-5
                       md:grid-cols-2"
            >
                <div>
                    <label
                        for="valid_from"
                        class="block text-sm
                               font-bold text-slate-800"
                    >
                        Mulai berlaku
                    </label>

                    <input
                        id="valid_from"
                        type="date"
                        name="valid_from"
                        value="{{ $validFrom }}"
                        class="mt-2 w-full
                               rounded-xl border
                               border-slate-200
                               px-4 py-3 text-sm
                               text-slate-800
                               outline-none transition
                               focus:border-[#075F9B]
                               focus:ring-4
                               focus:ring-blue-100"
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


                <div>
                    <label
                        for="valid_until"
                        class="block text-sm
                               font-bold text-slate-800"
                    >
                        Berlaku sampai
                    </label>

                    <input
                        id="valid_until"
                        type="date"
                        name="valid_until"
                        value="{{ $validUntil }}"
                        class="mt-2 w-full
                               rounded-xl border
                               border-slate-200
                               px-4 py-3 text-sm
                               text-slate-800
                               outline-none transition
                               focus:border-[#075F9B]
                               focus:ring-4
                               focus:ring-blue-100"
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


            {{-- DESKRIPSI --}}
            <div>
                <label
                    for="description"
                    class="block text-sm
                           font-bold text-slate-800"
                >
                    Penjelasan akreditasi
                </label>

                <p
                    class="mt-1 text-xs
                           leading-6 text-slate-500"
                >
                    Tulis seluruh penjelasan dalam satu kolom.
                    Pisahkan paragraf dengan menekan Enter.
                </p>

                <textarea
                    id="description"
                    name="description"
                    rows="9"
                    placeholder="Tulis penjelasan akreditasi berdasarkan sumber resmi..."
                    class="mt-2 w-full
                           rounded-xl border
                           border-slate-200
                           px-4 py-3 text-sm
                           leading-8 text-slate-800
                           outline-none transition
                           focus:border-[#075F9B]
                           focus:ring-4
                           focus:ring-blue-100"
                >{{ old(
                    'description',
                    $isEdit
                        ? $accreditation->description
                        : ''
                ) }}</textarea>

                @error('description')
                    <p
                        class="mt-2 text-sm
                               font-semibold text-red-600"
                    >
                        {{ $message }}
                    </p>
                @enderror
            </div>


            {{-- DOKUMEN --}}
            <div
                class="border-t border-slate-200
                       pt-6"
            >
                <label
                    for="file_path"
                    class="block text-sm
                           font-bold text-slate-800"
                >
                    Dokumen akreditasi
                </label>

                <p
                    class="mt-1 text-xs
                           leading-6 text-slate-500"
                >
                    Unggah PDF, JPG, JPEG, PNG, atau WebP
                    maksimal 20 MB.
                    @if ($isEdit)
                        Kosongkan jika dokumen lama tidak
                        perlu diganti.
                    @endif
                </p>


                @if ($currentFileUrl)
                    <div
                        class="mt-4 flex flex-col gap-4
                               rounded-xl border
                               border-slate-200
                               bg-slate-50 p-4
                               sm:flex-row sm:items-center"
                    >
                        @if ($currentFileIsImage)
                            <img
                                src="{{ $currentFileUrl }}"
                                alt="Dokumen akreditasi saat ini"
                                class="h-24 w-32 rounded-lg
                                       object-cover"
                            >
                        @else
                            <div
                                class="flex h-20 w-20
                                       shrink-0 items-center
                                       justify-center rounded-xl
                                       bg-red-50 text-sm
                                       font-extrabold text-red-600"
                            >
                                PDF
                            </div>
                        @endif

                        <div class="min-w-0 flex-1">
                            <p
                                class="text-sm font-bold
                                       text-slate-800"
                            >
                                Dokumen yang sedang digunakan
                            </p>

                            <p
                                class="mt-1 truncate
                                       text-xs text-slate-500"
                            >
                                {{ basename($currentFilePath) }}
                            </p>

                            <a
                                href="{{ $currentFileUrl }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="mt-2 inline-flex
                                       text-sm font-bold
                                       text-[#075F9B]
                                       hover:underline"
                            >
                                Buka Dokumen
                            </a>
                        </div>
                    </div>
                @endif


                <input
                    id="file_path"
                    type="file"
                    name="file_path"
                    accept=".pdf,.jpg,.jpeg,.png,.webp"
                    data-accreditation-file-input
                    class="mt-4 block w-full
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

                @error('file_path')
                    <p
                        class="mt-2 text-sm
                               font-semibold text-red-600"
                    >
                        {{ $message }}
                    </p>
                @enderror

                <p
                    data-accreditation-file-error
                    class="mt-2 hidden text-sm
                           font-semibold text-red-600"
                ></p>


                <div
                    data-accreditation-preview-container
                    class="mt-4 hidden rounded-xl
                           border border-blue-200
                           bg-blue-50 p-4"
                >
                    <img
                        data-accreditation-image-preview
                        alt="Pratinjau dokumen baru"
                        class="hidden max-h-64
                               rounded-lg object-contain"
                    >

                    <div
                        data-accreditation-pdf-preview
                        class="hidden h-24 w-24
                               items-center justify-center
                               rounded-xl bg-red-50
                               text-sm font-extrabold
                               text-red-600"
                    >
                        PDF
                    </div>

                    <p
                        data-accreditation-file-information
                        class="mt-3 break-all
                               text-sm font-semibold
                               text-blue-800"
                    ></p>
                </div>
            </div>


            {{-- STATUS --}}
            <label
                class="flex cursor-pointer
                       items-start gap-3
                       border-t border-slate-200
                       pt-6"
            >
                <input
                    type="checkbox"
                    name="is_active"
                    value="1"
                    class="mt-1 h-4 w-4
                           rounded border-slate-300
                           text-[#075F9B]
                           focus:ring-blue-200"
                    {{ $isShown ? 'checked' : '' }}
                >

                <span>
                    <span
                        class="block text-sm
                               font-bold text-slate-800"
                    >
                        Tampilkan data akreditasi ini di website
                    </span>

                    <span
                        class="mt-1 block text-xs
                               leading-6 text-slate-500"
                    >
                        Hilangkan centang untuk menyimpan data
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
            Periksa kembali semua data sebelum menyimpan.
        </p>

        <div
            class="flex flex-col gap-3
                   sm:flex-row"
        >
            <a
                href="{{ route(
                    'admin.accreditations.index'
                ) }}"
                class="inline-flex items-center
                       justify-center rounded-xl
                       border border-slate-200
                       bg-white px-5 py-3
                       text-sm font-bold
                       text-slate-700
                       transition hover:bg-slate-100"
            >
                Batal
            </a>

            <button
                id="saveAccreditationButton"
                type="submit"
                class="inline-flex items-center
                       justify-center rounded-xl
                       bg-[#075F9B] px-6 py-3
                       text-sm font-bold text-white
                       transition hover:bg-[#064B7B]
                       disabled:cursor-not-allowed
                       disabled:opacity-70"
            >
                <span data-save-label>
                    {{ $isEdit
                        ? 'Simpan Perubahan'
                        : 'Simpan Akreditasi' }}
                </span>
            </button>
        </div>
    </footer>
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

                    const fileInput =
                        document.querySelector(
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

                    const form =
                        fileInput?.closest('form');

                    const saveButton =
                        document.getElementById(
                            'saveAccreditationButton'
                        );

                    const saveLabel =
                        saveButton?.querySelector(
                            '[data-save-label]'
                        );

                    let previewUrl = null;


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


                    function resetPreview() {
                        clearPreviewUrl();

                        previewContainer?.classList.add(
                            'hidden'
                        );

                        imagePreview?.classList.add(
                            'hidden'
                        );

                        if (imagePreview) {
                            imagePreview.src = '';
                        }

                        pdfPreview?.classList.add(
                            'hidden'
                        );

                        pdfPreview?.classList.remove(
                            'flex'
                        );

                        if (fileInformation) {
                            fileInformation.textContent = '';
                        }
                    }


                    function showFileError(message) {
                        if (!errorElement) {
                            return;
                        }

                        errorElement.textContent = message;
                        errorElement.classList.remove(
                            'hidden'
                        );
                    }


                    fileInput?.addEventListener(
                        'change',
                        function () {
                            resetPreview();

                            if (errorElement) {
                                errorElement.textContent = '';
                                errorElement.classList.add(
                                    'hidden'
                                );
                            }

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
                                showFileError(
                                    'Format dokumen harus PDF, JPG, JPEG, PNG, atau WebP.'
                                );

                                fileInput.value = '';

                                return;
                            }

                            if (
                                file.size > maximumFileSize
                            ) {
                                showFileError(
                                    'Ukuran dokumen maksimal 20 MB.'
                                );

                                fileInput.value = '';

                                return;
                            }

                            previewContainer
                                ?.classList
                                .remove('hidden');

                            if (fileInformation) {
                                fileInformation.textContent =
                                    file.name
                                    + ' • '
                                    + formatFileSize(
                                        file.size
                                    );
                            }

                            if (extension === 'pdf') {
                                pdfPreview
                                    ?.classList
                                    .remove('hidden');

                                pdfPreview
                                    ?.classList
                                    .add('flex');

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


                    form?.addEventListener(
                        'submit',
                        function () {
                            if (!saveButton) {
                                return;
                            }

                            saveButton.disabled = true;

                            if (saveLabel) {
                                saveLabel.textContent =
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
    @endpush
@endonce
