@extends('layouts.admin')

@section('title', 'Tambah Pengelola')

@section('content')




<div class="mx-auto max-w-5xl space-y-6">

    <header>
        <a
            href="{{ route(
                'admin.admin-users.index'
            ) }}"
            class="inline-flex items-center
                   gap-2 text-sm font-bold
                   text-[#075F9B]
                   hover:underline"
        >
            <span aria-hidden="true">←</span>
            <span>Kembali ke Pengelola Admin</span>
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
                Tambah Akun
            </p>
        </div>

        <h1
            class="mt-3 text-2xl font-extrabold
                   tracking-tight text-slate-900
                   sm:text-3xl"
        >
            Tambah Pengelola
        </h1>

        <p
            class="mt-2 max-w-3xl
                   text-sm leading-7
                   text-slate-500"
        >
            Tambahkan akun baru untuk mengelola isi website.
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
                Akun belum dapat disimpan:
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
        id="adminCreateForm"
        action="{{ route(
            'admin.admin-users.store'
        ) }}"
        method="POST"
        class="overflow-hidden rounded-2xl
               border border-slate-200
               bg-white"
    >
        @csrf
        


        <div class="px-5 py-7 sm:px-6 lg:px-8">
            <div
                class="border-b border-slate-200
                       pb-6"
            >
                <h2
                    class="text-lg font-extrabold
                           text-slate-900"
                >
                    Informasi Akun
                </h2>

                <p
                    class="mt-1 text-sm
                           leading-7 text-slate-500"
                >
                    Email dan kata sandi digunakan
                    untuk masuk ke panel admin.
                </p>
            </div>


            <div class="mt-6 space-y-6">
                <div
                    class="grid gap-5
                           md:grid-cols-2"
                >
                    <div>
                        <label
                            for="adminName"
                            class="block text-sm
                                   font-bold text-slate-800"
                        >
                            Nama pengelola
                        </label>

                        <input
                            id="adminName"
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            maxlength="255"
                            autocomplete="name"
                            placeholder="Contoh: Administrator"
                            required
                            autofocus
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
                            for="adminEmail"
                            class="block text-sm
                                   font-bold text-slate-800"
                        >
                            Email
                        </label>

                        <input
                            id="adminEmail"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            maxlength="255"
                            autocomplete="email"
                            inputmode="email"
                            placeholder="nama@email.com"
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

                        @error('email')
                            <p
                                class="mt-2 text-sm
                                       font-semibold text-red-600"
                            >
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>


                <div
                    class="grid gap-5
                           border-t border-slate-200
                           pt-6 md:grid-cols-2"
                >
                    <div>
                        <label
                            for="adminPassword"
                            class="block text-sm
                                   font-bold text-slate-800"
                        >
                            Kata sandi
                        </label>

                        <div class="relative mt-2">
                            <input
                                id="adminPassword"
                                type="password"
                                name="password"
                                minlength="8"
                                maxlength="255"
                                autocomplete="new-password"
                                placeholder="Minimal 8 karakter"
                                required
                                data-password-input
                                class="w-full rounded-xl
                                       border border-slate-200
                                       py-3 pl-4 pr-20
                                       text-sm text-slate-800
                                       outline-none transition
                                       focus:border-[#075F9B]
                                       focus:ring-4
                                       focus:ring-blue-100"
                            >

                            <button
                                type="button"
                                data-password-toggle
                                class="absolute right-2
                                       top-1/2 -translate-y-1/2
                                       rounded-lg px-3 py-2
                                       text-xs font-bold
                                       text-[#075F9B]
                                       hover:bg-blue-50"
                            >
                                Lihat
                            </button>
                        </div>

                        <p
                            class="mt-2 text-xs
                                   leading-6 text-slate-500"
                        >
                            Gunakan minimal 8 karakter.
                        </p>

                        @error('password')
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
                            for="adminPasswordConfirmation"
                            class="block text-sm
                                   font-bold text-slate-800"
                        >
                            Konfirmasi kata sandi
                        </label>

                        <div class="relative mt-2">
                            <input
                                id="adminPasswordConfirmation"
                                type="password"
                                name="password_confirmation"
                                minlength="8"
                                maxlength="255"
                                autocomplete="new-password"
                                placeholder="Masukkan kembali kata sandi"
                                required
                                data-password-input
                                class="w-full rounded-xl
                                       border border-slate-200
                                       py-3 pl-4 pr-20
                                       text-sm text-slate-800
                                       outline-none transition
                                       focus:border-[#075F9B]
                                       focus:ring-4
                                       focus:ring-blue-100"
                            >

                            <button
                                type="button"
                                data-password-toggle
                                class="absolute right-2
                                       top-1/2 -translate-y-1/2
                                       rounded-lg px-3 py-2
                                       text-xs font-bold
                                       text-[#075F9B]
                                       hover:bg-blue-50"
                            >
                                Lihat
                            </button>
                        </div>

                        <p
                            id="passwordMatchMessage"
                            class="mt-2 hidden
                                   text-xs font-semibold"
                            aria-live="polite"
                        ></p>
                    </div>
                </div>
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
                Berikan akses hanya kepada pengelola website yang berwenang.
            </p>

            <div
                class="flex flex-col gap-3
                       sm:flex-row"
            >
                <a
                    href="{{ route(
                        'admin.admin-users.index'
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
                    id="adminSubmit"
                    type="submit"
                    class="inline-flex items-center
                           justify-center rounded-xl
                           bg-[#075F9B] px-6 py-3
                           text-sm font-bold text-white
                           transition hover:bg-[#064B7B]
                           disabled:cursor-not-allowed
                           disabled:opacity-70"
                >
                    Simpan Pengelola
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
                    'adminCreateForm'
                );

            const submitButton =
                document.getElementById(
                    'adminSubmit'
                );

            const passwordInput =
                document.getElementById(
                    'adminPassword'
                );

            const confirmationInput =
                document.getElementById(
                    'adminPasswordConfirmation'
                );

            const matchMessage =
                document.getElementById(
                    'passwordMatchMessage'
                );


            document
                .querySelectorAll(
                    '[data-password-toggle]'
                )
                .forEach(
                    function (button) {
                        const input =
                            button.parentElement
                                ?.querySelector(
                                    '[data-password-input]'
                                );

                        if (!input) {
                            return;
                        }

                        button.addEventListener(
                            'click',
                            function () {
                                const isVisible =
                                    input.type === 'text';

                                input.type =
                                    isVisible
                                        ? 'password'
                                        : 'text';

                                button.textContent =
                                    isVisible
                                        ? 'Lihat'
                                        : 'Sembunyikan';

                                input.focus();
                            }
                        );
                    }
                );


            function validatePasswordMatch() {
                if (
                    !passwordInput
                    || !confirmationInput
                    || !matchMessage
                ) {
                    return true;
                }

                const password =
                    passwordInput.value;

                const confirmation =
                    confirmationInput.value;

                if (
                    password === ''
                    && confirmation === ''
                ) {
                    matchMessage.textContent = '';
                    matchMessage.classList.add(
                        'hidden'
                    );

                    confirmationInput.setCustomValidity(
                        ''
                    );

                    return true;
                }

                const matches =
                    password !== ''
                    && password === confirmation;

                matchMessage.classList.remove(
                    'hidden',
                    'text-emerald-600',
                    'text-red-600'
                );

                if (matches) {
                    matchMessage.textContent =
                        'Konfirmasi kata sandi sesuai.';

                    matchMessage.classList.add(
                        'text-emerald-600'
                    );

                    confirmationInput.setCustomValidity(
                        ''
                    );

                    return true;
                }

                matchMessage.textContent =
                    'Konfirmasi kata sandi belum sesuai.';

                matchMessage.classList.add(
                    'text-red-600'
                );

                confirmationInput.setCustomValidity(
                    'Konfirmasi kata sandi belum sesuai.'
                );

                return false;
            }


            passwordInput?.addEventListener(
                'input',
                validatePasswordMatch
            );

            confirmationInput?.addEventListener(
                'input',
                validatePasswordMatch
            );


            form?.addEventListener(
                'submit',
                function (event) {
                    if (!validatePasswordMatch()) {
                        event.preventDefault();

                        confirmationInput
                            ?.reportValidity();

                        confirmationInput
                            ?.focus();

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
        }
    );
</script>

@endsection
