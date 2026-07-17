<section
    id="form-kontak"
    class="relative overflow-hidden
           border-y border-slate-200
           bg-white py-16
           md:py-20 lg:py-24"
>
    {{-- ========================================================= --}}
    {{-- DEKORASI RINGAN --}}
    {{-- ========================================================= --}}

    <div
        class="pointer-events-none absolute inset-0"
        aria-hidden="true"
    >
        <div
            class="absolute -left-48 top-0
                   h-96 w-96 rounded-full
                   bg-blue-100/35
                   blur-[140px]"
        ></div>

        <div
            class="absolute -right-48 bottom-0
                   h-96 w-96 rounded-full
                   bg-yellow-100/30
                   blur-[140px]"
        ></div>
    </div>


    <div
        class="relative mx-auto
               max-w-7xl px-6"
    >
        <div
            class="grid items-start gap-12
                   lg:grid-cols-12
                   lg:gap-16"
        >
            {{-- ================================================= --}}
            {{-- INFORMASI --}}
            {{-- ================================================= --}}

            <div
                class="lg:col-span-5"
                data-aos="fade-right"
            >
                <div
                    class="flex items-center gap-3"
                >
                    <span
                        class="h-px w-8
                               bg-[#D7B33E]"
                        aria-hidden="true"
                    ></span>

                    <p
                        class="text-[10px] font-bold
                               uppercase
                               tracking-[0.22em]
                               text-[#075F9B]"
                    >
                        Kirim Pesan
                    </p>
                </div>


                <h2
                    class="mt-4 max-w-xl
                           text-3xl font-semibold
                           leading-tight
                           tracking-[-0.025em]
                           text-slate-900
                           sm:text-4xl lg:text-5xl"
                    style="
                        font-family:
                            'Space Grotesk',
                            'Plus Jakarta Sans',
                            sans-serif;
                    "
                >
                    Sampaikan Pertanyaan kepada Program Studi
                </h2>


                <p
                    class="mt-5 max-w-xl
                           text-sm leading-7
                           text-slate-600
                           sm:text-base
                           sm:leading-8"
                >
                    Formulir ini dapat digunakan untuk menyampaikan
                    kebutuhan informasi mengenai akademik,
                    administrasi, kerja sama, kegiatan mahasiswa,
                    maupun komunikasi lainnya.
                </p>


                <div
                    class="mt-8 space-y-4"
                >
                   


                    
                </div>
            </div>


            {{-- ================================================= --}}
            {{-- FORM --}}
            {{-- ================================================= --}}

            <div
                class="lg:col-span-7"
                data-aos="fade-left"
            >
                <div
                    class="overflow-hidden
                           rounded-[2rem]
                           border border-slate-200
                           bg-[#F8FAFC]
                           shadow-[0_20px_55px_rgba(15,23,42,0.09)]"
                >
                    {{-- Header form --}}
                    <div
                        class="flex items-center
                               justify-between gap-5
                               border-b border-slate-200
                               bg-white px-6 py-5
                               sm:px-8"
                    >
                        <div>
                            <p
                                class="text-[9px] font-bold
                                       uppercase
                                       tracking-[0.17em]
                                       text-[#075F9B]"
                            >
                                Formulir Kontak
                            </p>

                            <h3
                                class="mt-1 text-xl font-bold
                                       text-slate-900"
                            >
                                Tulis Pesan Anda
                            </h3>
                        </div>


                        <span
                            class="flex h-11 w-11
                                   shrink-0 items-center
                                   justify-center
                                   rounded-xl
                                   bg-blue-50
                                   text-[#075F9B]"
                        >
                            <i
                                class="fa-regular
                                       fa-envelope"
                                aria-hidden="true"
                            ></i>
                        </span>
                    </div>


                    <form
                        id="contactForm"
                        class="space-y-5
                               p-6 sm:p-8"
                        novalidate
                    >
                        <div
                            class="grid gap-5
                                   sm:grid-cols-2"
                        >
                            {{-- Nama --}}
                            <div>
                                <label
                                    for="contactName"
                                    class="mb-2 block
                                           text-sm font-semibold
                                           text-slate-700"
                                >
                                    Nama Lengkap
                                    <span class="text-red-500">*</span>
                                </label>

                                <input
                                    id="contactName"
                                    type="text"
                                    name="name"
                                    autocomplete="name"
                                    required
                                    placeholder="Masukkan nama lengkap"
                                    class="w-full rounded-xl
                                           border border-slate-200
                                           bg-white px-4 py-3.5
                                           text-sm text-slate-900
                                           outline-none
                                           transition
                                           placeholder:text-slate-400
                                           focus:border-[#075F9B]
                                           focus:ring-4
                                           focus:ring-blue-100"
                                >
                            </div>


                            {{-- Email --}}
                            <div>
                                <label
                                    for="contactEmail"
                                    class="mb-2 block
                                           text-sm font-semibold
                                           text-slate-700"
                                >
                                    Email
                                    <span class="text-red-500">*</span>
                                </label>

                                <input
                                    id="contactEmail"
                                    type="email"
                                    name="email"
                                    autocomplete="email"
                                    required
                                    placeholder="nama@email.com"
                                    class="w-full rounded-xl
                                           border border-slate-200
                                           bg-white px-4 py-3.5
                                           text-sm text-slate-900
                                           outline-none
                                           transition
                                           placeholder:text-slate-400
                                           focus:border-[#075F9B]
                                           focus:ring-4
                                           focus:ring-blue-100"
                                >
                            </div>
                        </div>


                        {{-- Subjek --}}
                        <div>
                            <label
                                for="contactSubject"
                                class="mb-2 block
                                       text-sm font-semibold
                                       text-slate-700"
                            >
                                Subjek
                                <span class="text-red-500">*</span>
                            </label>

                            <input
                                id="contactSubject"
                                type="text"
                                name="subject"
                                required
                                placeholder="Tuliskan subjek pesan"
                                class="w-full rounded-xl
                                       border border-slate-200
                                       bg-white px-4 py-3.5
                                       text-sm text-slate-900
                                       outline-none
                                       transition
                                       placeholder:text-slate-400
                                       focus:border-[#075F9B]
                                       focus:ring-4
                                       focus:ring-blue-100"
                            >
                        </div>


                        {{-- Pesan --}}
                        <div>
                            <div
                                class="mb-2 flex items-center
                                       justify-between gap-4"
                            >
                                <label
                                    for="contactMessage"
                                    class="text-sm font-semibold
                                           text-slate-700"
                                >
                                    Pesan
                                    <span class="text-red-500">*</span>
                                </label>

                                <span
                                    id="contactCharacterCount"
                                    class="text-xs
                                           text-slate-400"
                                >
                                    0 / 1000
                                </span>
                            </div>

                            <textarea
                                id="contactMessage"
                                name="message"
                                rows="6"
                                maxlength="1000"
                                required
                                placeholder="Tuliskan pesan Anda secara jelas"
                                class="w-full resize-y
                                       rounded-xl
                                       border border-slate-200
                                       bg-white px-4 py-3.5
                                       text-sm leading-7
                                       text-slate-900
                                       outline-none
                                       transition
                                       placeholder:text-slate-400
                                       focus:border-[#075F9B]
                                       focus:ring-4
                                       focus:ring-blue-100"
                            ></textarea>
                        </div>


                        {{-- Alert validasi --}}
                        <div
                            id="contactValidationAlert"
                            class="hidden rounded-xl
                                   border border-red-200
                                   bg-red-50 px-4 py-3
                                   text-sm leading-6
                                   text-red-700"
                            role="alert"
                        >
                            Lengkapi seluruh kolom wajib dengan data
                            yang benar.
                        </div>


                        {{-- Alert status --}}
                        <div
                            id="contactAlert"
                            class="hidden rounded-xl
                                   border border-blue-200
                                   bg-blue-50 px-4 py-4
                                   text-sm leading-7
                                   text-blue-800"
                            role="status"
                            aria-live="polite"
                        >
                            <div class="flex items-start gap-3">
                                <i
                                    class="fa-solid fa-circle-info
                                           mt-1 text-[#075F9B]"
                                    aria-hidden="true"
                                ></i>

                                <p>
                                    Data formulir belum dikirim karena
                                    fitur ini masih berupa tampilan
                                    frontend dan belum terhubung ke
                                    sistem pengiriman pesan.
                                </p>
                            </div>
                        </div>


                        {{-- Footer form --}}
                        <div
                            class="flex flex-col gap-4
                                   border-t border-slate-200
                                   pt-6
                                   sm:flex-row
                                   sm:items-center
                                   sm:justify-between"
                        >
                            <p
                                class="text-xs leading-6
                                       text-slate-400"
                            >
                                Kolom bertanda
                                <span class="text-red-500">*</span>
                                wajib diisi.
                            </p>


                            <button
                                type="submit"
                                class="inline-flex
                                       items-center
                                       justify-center gap-3
                                       rounded-xl
                                       bg-[#075F9B]
                                       px-6 py-3.5
                                       text-sm font-bold
                                       text-white
                                       shadow-lg
                                       shadow-blue-900/10
                                       transition
                                       hover:bg-[#073763]
                                       focus:outline-none
                                       focus:ring-4
                                       focus:ring-blue-200"
                            >
                                Tinjau Pesan

                                <i
                                    class="fa-solid
                                           fa-arrow-right
                                           text-xs"
                                    aria-hidden="true"
                                ></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


@once
    <script>
        function initializeContactForm() {
            const form = document.getElementById(
                'contactForm'
            );

            const messageField = document.getElementById(
                'contactMessage'
            );

            const characterCount = document.getElementById(
                'contactCharacterCount'
            );

            const validationAlert = document.getElementById(
                'contactValidationAlert'
            );

            const contactAlert = document.getElementById(
                'contactAlert'
            );

            if (!form) {
                return;
            }


            function updateCharacterCount() {
                if (!messageField || !characterCount) {
                    return;
                }

                characterCount.textContent =
                    messageField.value.length
                    + ' / 1000';
            }


            if (messageField) {
                messageField.addEventListener(
                    'input',
                    updateCharacterCount
                );

                updateCharacterCount();
            }


            form.addEventListener(
                'submit',
                function (event) {
                    event.preventDefault();

                    if (validationAlert) {
                        validationAlert.classList.add(
                            'hidden'
                        );
                    }

                    if (contactAlert) {
                        contactAlert.classList.add(
                            'hidden'
                        );
                    }


                    if (!form.checkValidity()) {
                        form.reportValidity();

                        if (validationAlert) {
                            validationAlert.classList.remove(
                                'hidden'
                            );
                        }

                        return;
                    }


                    if (contactAlert) {
                        contactAlert.classList.remove(
                            'hidden'
                        );
                    }
                }
            );
        }


        if (document.readyState === 'loading') {
            document.addEventListener(
                'DOMContentLoaded',
                initializeContactForm
            );
        } else {
            initializeContactForm();
        }
    </script>
@endonce