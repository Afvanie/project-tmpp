@extends('layouts.admin')

@section('title', 'Tambah Admin')

@section('content')

<div class="space-y-8">

    {{-- ========================================================= --}}
    {{-- HEADER --}}
    {{-- ========================================================= --}}

    <div>
        <a
            href="{{ route('admin.admin-users.index') }}"
            class="mb-4 inline-flex items-center
                   text-sm font-bold text-blue-700
                   transition hover:underline"
        >
            ← Kembali ke Pengelola Admin
        </a>

        <h1
            class="text-3xl font-black
                   text-slate-800 md:text-4xl"
        >
            Tambah Admin
        </h1>

        <p
            class="mt-3 max-w-3xl
                   leading-7 text-slate-500"
        >
            Tambahkan akun pengelola baru untuk mengakses panel
            administrasi website Program Studi D-IV Teknik Mesin
            Produksi dan Perawatan.
        </p>
    </div>


    {{-- ========================================================= --}}
    {{-- ERROR SUMMARY --}}
    {{-- ========================================================= --}}

    @if ($errors->any())
        <div
            class="rounded-2xl border
                   border-red-200 bg-red-50
                   px-6 py-4 text-red-700"
            role="alert"
        >
            <p class="font-bold">
                Akun admin belum dapat disimpan.
            </p>

            <ul class="mt-3 list-disc space-y-1 pl-5 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {{-- ========================================================= --}}
    {{-- FORM --}}
    {{-- ========================================================= --}}

    <section
        class="overflow-hidden rounded-[2rem]
               border border-slate-100
               bg-white/95 shadow-xl
               backdrop-blur"
    >
        <div
            class="h-2 bg-gradient-to-r
                   from-blue-700 via-yellow-400
                   to-blue-700"
        ></div>

        <form
            id="adminCreateForm"
            action="{{ route('admin.admin-users.store') }}"
            method="POST"
            class="space-y-7 p-6 sm:p-7 md:p-8"
        >
            @csrf

            <div>
                <h2
                    class="text-2xl font-black
                           text-slate-800"
                >
                    Informasi Akun Admin
                </h2>

                <p
                    class="mt-2 max-w-3xl
                           leading-7 text-slate-500"
                >
                    Email dan kata sandi berikut akan digunakan
                    untuk masuk ke halaman admin.
                </p>
            </div>


            <div class="grid gap-6 md:grid-cols-2">

                {{-- ================================================= --}}
                {{-- NAMA --}}
                {{-- ================================================= --}}

                <div>
                    <label
                        for="adminName"
                        class="mb-2 block text-sm
                               font-bold text-slate-700"
                    >
                        Nama Admin
                        <span class="text-red-600">*</span>
                    </label>

                    <input
                        type="text"
                        id="adminName"
                        name="name"
                        value="{{ old('name') }}"
                        maxlength="255"
                        autocomplete="name"
                        placeholder="Contoh: Administrator"
                        required
                        autofocus
                        @class([
                            'w-full rounded-2xl border',
                            'bg-slate-50 px-5 py-4',
                            'transition focus:bg-white',
                            'focus:outline-none focus:ring-2',
                            'focus:ring-blue-500',
                            'border-red-300' =>
                                $errors->has('name'),
                            'border-slate-200' =>
                                !$errors->has('name'),
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


                {{-- ================================================= --}}
                {{-- EMAIL --}}
                {{-- ================================================= --}}

                <div>
                    <label
                        for="adminEmail"
                        class="mb-2 block text-sm
                               font-bold text-slate-700"
                    >
                        Email
                        <span class="text-red-600">*</span>
                    </label>

                    <input
                        type="email"
                        id="adminEmail"
                        name="email"
                        value="{{ old('email') }}"
                        maxlength="255"
                        autocomplete="email"
                        inputmode="email"
                        placeholder="contoh@email.com"
                        required
                        @class([
                            'w-full rounded-2xl border',
                            'bg-slate-50 px-5 py-4',
                            'transition focus:bg-white',
                            'focus:outline-none focus:ring-2',
                            'focus:ring-blue-500',
                            'border-red-300' =>
                                $errors->has('email'),
                            'border-slate-200' =>
                                !$errors->has('email'),
                        ])
                    >

                    <p class="mt-2 text-sm text-slate-500">
                        Gunakan email yang belum terdaftar.
                    </p>

                    @error('email')
                        <p
                            class="mt-2 text-sm
                                   font-semibold text-red-600"
                        >
                            {{ $message }}
                        </p>
                    @enderror
                </div>


                {{-- ================================================= --}}
                {{-- KATA SANDI --}}
                {{-- ================================================= --}}

                <div>
                    <label
                        for="adminPassword"
                        class="mb-2 block text-sm
                               font-bold text-slate-700"
                    >
                        Kata Sandi
                        <span class="text-red-600">*</span>
                    </label>

                    <div class="relative">
                        <input
                            type="password"
                            id="adminPassword"
                            name="password"
                            minlength="8"
                            maxlength="255"
                            autocomplete="new-password"
                            placeholder="Minimal 8 karakter"
                            required
                            data-password-input
                            @class([
                                'w-full rounded-2xl border',
                                'bg-slate-50 py-4 pl-5 pr-16',
                                'transition focus:bg-white',
                                'focus:outline-none focus:ring-2',
                                'focus:ring-blue-500',
                                'border-red-300' =>
                                    $errors->has('password'),
                                'border-slate-200' =>
                                    !$errors->has('password'),
                            ])
                        >

                        <button
                            type="button"
                            class="absolute right-3 top-1/2
                                   flex h-10 w-10
                                   -translate-y-1/2
                                   items-center justify-center
                                   rounded-xl text-slate-500
                                   transition hover:bg-slate-200
                                   hover:text-blue-700"
                            data-password-toggle
                            aria-label="Tampilkan kata sandi"
                            aria-pressed="false"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                aria-hidden="true"
                                data-show-icon
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                />
                            </svg>

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="hidden h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                aria-hidden="true"
                                data-hide-icon
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M3 3l18 18M10.58 10.58A2 2 0 0012 14a2 2 0 001.42-.58M9.88 5.09A9.85 9.85 0 0112 5c4.477 0 8.268 2.943 9.542 7a11.05 11.05 0 01-2.06 3.64M6.61 6.61A11.13 11.13 0 002.458 12C3.732 16.057 7.523 19 12 19a9.83 9.83 0 004.13-.9"
                                />
                            </svg>
                        </button>
                    </div>

                    <p class="mt-2 text-sm text-slate-500">
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


                {{-- ================================================= --}}
                {{-- KONFIRMASI KATA SANDI --}}
                {{-- ================================================= --}}

                <div>
                    <label
                        for="adminPasswordConfirmation"
                        class="mb-2 block text-sm
                               font-bold text-slate-700"
                    >
                        Konfirmasi Kata Sandi
                        <span class="text-red-600">*</span>
                    </label>

                    <div class="relative">
                        <input
                            type="password"
                            id="adminPasswordConfirmation"
                            name="password_confirmation"
                            minlength="8"
                            maxlength="255"
                            autocomplete="new-password"
                            placeholder="Masukkan kembali kata sandi"
                            required
                            data-password-input
                            class="w-full rounded-2xl
                                   border border-slate-200
                                   bg-slate-50 py-4 pl-5 pr-16
                                   transition focus:bg-white
                                   focus:outline-none
                                   focus:ring-2
                                   focus:ring-blue-500"
                        >

                        <button
                            type="button"
                            class="absolute right-3 top-1/2
                                   flex h-10 w-10
                                   -translate-y-1/2
                                   items-center justify-center
                                   rounded-xl text-slate-500
                                   transition hover:bg-slate-200
                                   hover:text-blue-700"
                            data-password-toggle
                            aria-label="Tampilkan konfirmasi kata sandi"
                            aria-pressed="false"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                aria-hidden="true"
                                data-show-icon
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                />
                            </svg>

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="hidden h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                aria-hidden="true"
                                data-hide-icon
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M3 3l18 18M10.58 10.58A2 2 0 0012 14a2 2 0 001.42-.58M9.88 5.09A9.85 9.85 0 0112 5c4.477 0 8.268 2.943 9.542 7a11.05 11.05 0 01-2.06 3.64M6.61 6.61A11.13 11.13 0 002.458 12C3.732 16.057 7.523 19 12 19a9.83 9.83 0 004.13-.9"
                                />
                            </svg>
                        </button>
                    </div>

                    <p
                        id="passwordMatchMessage"
                        class="mt-2 hidden text-sm font-semibold"
                        aria-live="polite"
                    ></p>
                </div>
            </div>


            <div
                class="flex flex-col gap-4
                       border-t border-slate-100
                       pt-6 md:flex-row
                       md:items-center
                       md:justify-between"
            >
                <p
                    class="max-w-xl text-sm
                           leading-6 text-slate-500"
                >
                    Berikan akses admin hanya kepada pengelola
                    website yang berwenang.
                </p>

                <button
                    type="submit"
                    id="adminCreateSubmit"
                    class="inline-flex items-center
                           justify-center rounded-2xl
                           bg-blue-700 px-7 py-4
                           font-bold text-white
                           shadow-lg shadow-blue-700/20
                           transition hover:bg-blue-800
                           disabled:cursor-not-allowed
                           disabled:opacity-60"
                >
                    Simpan Admin
                </button>
            </div>
        </form>
    </section>
</div>


@once
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById(
                'adminCreateForm'
            );

            const submitButton = document.getElementById(
                'adminCreateSubmit'
            );

            const passwordInput = document.getElementById(
                'adminPassword'
            );

            const confirmationInput = document.getElementById(
                'adminPasswordConfirmation'
            );

            const matchMessage = document.getElementById(
                'passwordMatchMessage'
            );


            document
                .querySelectorAll('[data-password-toggle]')
                .forEach(function (button) {
                    const container = button.parentElement;

                    const input = container
                        ? container.querySelector(
                            '[data-password-input]'
                        )
                        : null;

                    const showIcon = button.querySelector(
                        '[data-show-icon]'
                    );

                    const hideIcon = button.querySelector(
                        '[data-hide-icon]'
                    );

                    if (!input) {
                        return;
                    }

                    button.addEventListener(
                        'click',
                        function () {
                            const isVisible =
                                input.type === 'text';

                            input.type = isVisible
                                ? 'password'
                                : 'text';

                            button.setAttribute(
                                'aria-pressed',
                                isVisible
                                    ? 'false'
                                    : 'true'
                            );

                            button.setAttribute(
                                'aria-label',
                                isVisible
                                    ? 'Tampilkan kata sandi'
                                    : 'Sembunyikan kata sandi'
                            );

                            if (showIcon) {
                                showIcon.classList.toggle(
                                    'hidden',
                                    !isVisible
                                );
                            }

                            if (hideIcon) {
                                hideIcon.classList.toggle(
                                    'hidden',
                                    isVisible
                                );
                            }

                            input.focus();
                        }
                    );
                });


            function validatePasswordMatch() {
                if (
                    !passwordInput
                    || !confirmationInput
                    || !matchMessage
                ) {
                    return true;
                }

                if (confirmationInput.value === '') {
                    matchMessage.textContent = '';
                    matchMessage.classList.add('hidden');

                    return true;
                }

                const passwordsMatch =
                    passwordInput.value ===
                    confirmationInput.value;

                matchMessage.classList.remove(
                    'hidden',
                    'text-green-600',
                    'text-red-600'
                );

                if (passwordsMatch) {
                    matchMessage.textContent =
                        'Konfirmasi kata sandi sesuai.';

                    matchMessage.classList.add(
                        'text-green-600'
                    );
                } else {
                    matchMessage.textContent =
                        'Konfirmasi kata sandi belum sesuai.';

                    matchMessage.classList.add(
                        'text-red-600'
                    );
                }

                return passwordsMatch;
            }


            if (passwordInput) {
                passwordInput.addEventListener(
                    'input',
                    validatePasswordMatch
                );
            }

            if (confirmationInput) {
                confirmationInput.addEventListener(
                    'input',
                    validatePasswordMatch
                );
            }


            if (form && submitButton) {
                form.addEventListener('submit', function (event) {
                    if (!validatePasswordMatch()) {
                        event.preventDefault();

                        confirmationInput.focus();

                        return;
                    }

                    submitButton.disabled = true;
                    submitButton.textContent = 'Menyimpan...';
                });
            }
        });
    </script>
@endonce

@endsection