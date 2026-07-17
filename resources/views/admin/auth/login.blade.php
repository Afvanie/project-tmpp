@php
    /*
    |--------------------------------------------------------------------------
    | IDENTITAS HALAMAN LOGIN ADMIN
    |--------------------------------------------------------------------------
    */

    $logoRelativePath = 'assets/images/logo.png';

    $logoAvailable = file_exists(
        public_path($logoRelativePath)
    );
@endphp

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <meta
        name="theme-color"
        content="#071A2F"
    >

    <title>
        Login Admin - D-IV TMPP Polinema
    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
    ])

    <link
        rel="preconnect"
        href="https://fonts.bunny.net"
    >

    <link
        href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800"
        rel="stylesheet"
    >

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .login-focus:focus-visible,
        button:focus-visible,
        a:focus-visible,
        input:focus-visible {
            outline: 3px solid rgba(215, 179, 62, 0.55);
            outline-offset: 2px;
        }
    </style>
</head>

<body
    class="min-h-screen bg-[#071A2F]
           text-slate-800 antialiased"
>
    <main
        class="relative flex min-h-screen
               items-center justify-center
               overflow-hidden px-4 py-8
               sm:px-6"
    >
        {{-- ===================================================== --}}
        {{-- LATAR BELAKANG --}}
        {{-- ===================================================== --}}

        <div
            class="pointer-events-none absolute inset-0"
            aria-hidden="true"
        >
            <div
                class="absolute inset-0
                       bg-gradient-to-br
                       from-[#071A2F]
                       via-[#0A3154]
                       to-[#075F9B]"
            ></div>

            <div
                class="absolute -left-28 top-16
                       h-80 w-80 rounded-full
                       bg-yellow-400/15
                       blur-[110px]"
            ></div>

            <div
                class="absolute -right-28 bottom-10
                       h-96 w-96 rounded-full
                       bg-blue-300/15
                       blur-[130px]"
            ></div>

            <div
                class="absolute inset-0 opacity-[0.045]"
                style="
                    background-image:
                        linear-gradient(
                            rgba(255, 255, 255, 0.8) 1px,
                            transparent 1px
                        ),
                        linear-gradient(
                            to right,
                            rgba(255, 255, 255, 0.8) 1px,
                            transparent 1px
                        );
                    background-size: 58px 58px;
                "
            ></div>
        </div>


        {{-- ===================================================== --}}
        {{-- KARTU LOGIN --}}
        {{-- ===================================================== --}}

        <div
            class="relative z-10 grid w-full
                   max-w-4xl overflow-hidden
                   rounded-[1.75rem]
                   border border-white/10
                   bg-white shadow-2xl
                   lg:grid-cols-[0.88fr_1.12fr]"
        >
            {{-- ================================================= --}}
            {{-- PANEL INFORMASI --}}
            {{-- ================================================= --}}

            <section
                class="relative hidden overflow-hidden
                       bg-[#071A2F] px-9 py-10
                       text-white lg:flex
                       lg:flex-col
                       lg:justify-between"
            >
                <div
                    class="pointer-events-none absolute inset-0"
                    aria-hidden="true"
                >
                    <div
                        class="absolute -right-24 -top-24
                               h-64 w-64 rounded-full
                               bg-blue-500/20 blur-3xl"
                    ></div>

                    <div
                        class="absolute -bottom-24 -left-24
                               h-64 w-64 rounded-full
                               bg-yellow-400/15 blur-3xl"
                    ></div>
                </div>


                <div class="relative">
                    <div
                        class="flex h-14 w-14
                               items-center justify-center
                               rounded-2xl bg-white
                               shadow-xl"
                    >
                        @if ($logoAvailable)
                            <img
                                src="{{ asset($logoRelativePath) }}"
                                alt="Logo Politeknik Negeri Malang"
                                class="h-10 w-10 object-contain"
                            >
                        @else
                            <span
                                class="text-sm font-extrabold
                                       text-[#075F9B]"
                            >
                                TM
                            </span>
                        @endif
                    </div>


                    <div
                        class="mt-8 flex items-center gap-3"
                    >
                        <span
                            class="h-px w-8 bg-[#D7B33E]"
                            aria-hidden="true"
                        ></span>

                        <p
                            class="text-[10px] font-extrabold
                                   uppercase tracking-[0.18em]
                                   text-[#F2D56F]"
                        >
                            Admin Website
                        </p>
                    </div>


                    <h1
                        class="mt-4 text-3xl font-extrabold
                               leading-tight tracking-[-0.025em]"
                    >
                        D-IV Teknik Mesin Produksi dan Perawatan
                    </h1>


                    <p
                        class="mt-4 text-sm leading-7
                               text-slate-300"
                    >
                        Kelola konten website program studi melalui
                        satu panel administrasi yang terintegrasi.
                    </p>
                </div>


                <div
                    class="relative mt-10
                           border-t border-white/10 pt-5"
                >
                    <p
                        class="text-xs font-bold
                               text-white"
                    >
                        Politeknik Negeri Malang
                    </p>

                    <p
                        class="mt-1 text-[11px]
                               text-slate-400"
                    >
                        Jurusan Teknik Mesin
                    </p>
                </div>
            </section>


            {{-- ================================================= --}}
            {{-- FORM LOGIN --}}
            {{-- ================================================= --}}

            <section
                class="flex items-center
                       px-6 py-8
                       sm:px-9 sm:py-10
                       lg:px-12 lg:py-12"
            >
                <div class="w-full">

                    {{-- Identitas mobile --}}
                    <div
                        class="mb-7 flex items-center
                               gap-3 lg:hidden"
                    >
                        <span
                            class="flex h-12 w-12
                                   shrink-0 items-center
                                   justify-center rounded-xl
                                   bg-white shadow-md
                                   ring-1 ring-slate-100"
                        >
                            @if ($logoAvailable)
                                <img
                                    src="{{ asset($logoRelativePath) }}"
                                    alt="Logo Politeknik Negeri Malang"
                                    class="h-9 w-9 object-contain"
                                >
                            @else
                                <span
                                    class="text-sm font-extrabold
                                           text-[#075F9B]"
                                >
                                    TM
                                </span>
                            @endif
                        </span>

                        <div class="min-w-0">
                            <p
                                class="truncate text-sm
                                       font-extrabold
                                       text-slate-900"
                            >
                                Admin TMPP
                            </p>

                            <p
                                class="mt-0.5 truncate
                                       text-[10px] font-semibold
                                       uppercase tracking-[0.1em]
                                       text-slate-400"
                            >
                                Politeknik Negeri Malang
                            </p>
                        </div>
                    </div>


                    <div
                        class="flex items-center gap-3"
                    >
                        <span
                            class="h-px w-8 bg-[#D7B33E]"
                            aria-hidden="true"
                        ></span>

                        <p
                            class="text-[10px] font-extrabold
                                   uppercase tracking-[0.18em]
                                   text-[#075F9B]"
                        >
                            Area Pengelola
                        </p>
                    </div>


                    <h2
                        class="mt-4 text-3xl font-extrabold
                               tracking-[-0.025em]
                               text-slate-900
                               sm:text-4xl"
                    >
                        Masuk ke Admin
                    </h2>


                    <p
                        class="mt-3 text-sm leading-7
                               text-slate-500"
                    >
                        Gunakan akun administrator yang terdaftar
                        untuk mengakses pengelolaan website.
                    </p>


                    {{-- ========================================= --}}
                    {{-- ALERT --}}
                    {{-- ========================================= --}}

                    @if (session('error'))
                        <div
                            class="mt-6 flex items-start gap-3
                                   rounded-xl border
                                   border-red-200 bg-red-50
                                   px-4 py-3.5
                                   text-sm text-red-700"
                            role="alert"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="mt-0.5 h-5 w-5 shrink-0"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 9v2m0 4h.01M5.07 19h13.86c1.54 0 2.5-1.67 1.73-3L13.73 4c-.77-1.33-2.69-1.33-3.46 0L3.34 16c-.77 1.33.19 3 1.73 3z"
                                />
                            </svg>

                            <p class="leading-6">
                                {{ session('error') }}
                            </p>
                        </div>
                    @endif


                    @if ($errors->any())
                        <div
                            class="mt-6 rounded-xl
                                   border border-red-200
                                   bg-red-50 px-4 py-3.5
                                   text-red-700"
                            role="alert"
                        >
                            <p
                                class="text-sm font-bold"
                            >
                                Login belum dapat diproses.
                            </p>

                            <ul
                                class="mt-2 list-disc space-y-1
                                       pl-5 text-sm leading-6"
                            >
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    {{-- ========================================= --}}
                    {{-- FORM --}}
                    {{-- ========================================= --}}

                    <form
                        id="adminLoginForm"
                        action="{{ route('admin.login.post') }}"
                        method="POST"
                        class="mt-7 space-y-5"
                    >
                        @csrf

                        {{-- Email --}}
                        <div>
                            <label
                                for="adminEmail"
                                class="mb-2 block
                                       text-sm font-bold
                                       text-slate-700"
                            >
                                Email
                            </label>

                            <div class="relative">
                                <span
                                    class="pointer-events-none
                                           absolute left-4 top-1/2
                                           -translate-y-1/2
                                           text-slate-400"
                                    aria-hidden="true"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M3 8l9 6 9-6M5 6h14a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2z"
                                        />
                                    </svg>
                                </span>

                                <input
                                    type="email"
                                    id="adminEmail"
                                    name="email"
                                    value="{{ old('email') }}"
                                    maxlength="255"
                                    autocomplete="username"
                                    inputmode="email"
                                    required
                                    autofocus
                                    placeholder="admin@polinema.com"
                                    @class([
                                        'login-focus w-full rounded-xl',
                                        'border bg-slate-50',
                                        'py-3.5 pl-12 pr-4',
                                        'text-sm text-slate-900',
                                        'outline-none transition',
                                        'placeholder:text-slate-400',
                                        'focus:bg-white',
                                        'focus:ring-4',
                                        'focus:ring-blue-100',
                                        'border-red-300 focus:border-red-400' =>
                                            $errors->has('email'),
                                        'border-slate-200 focus:border-[#075F9B]' =>
                                            !$errors->has('email'),
                                    ])
                                >
                            </div>

                            @error('email')
                                <p
                                    class="mt-2 text-sm
                                           font-semibold
                                           text-red-600"
                                >
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        {{-- Password --}}
                        <div>
                            <label
                                for="adminPassword"
                                class="mb-2 block
                                       text-sm font-bold
                                       text-slate-700"
                            >
                                Kata Sandi
                            </label>

                            <div class="relative">
                                <span
                                    class="pointer-events-none
                                           absolute left-4 top-1/2
                                           -translate-y-1/2
                                           text-slate-400"
                                    aria-hidden="true"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M7 11V8a5 5 0 0110 0v3M6 11h12a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6a2 2 0 012-2z"
                                        />
                                    </svg>
                                </span>

                                <input
                                    type="password"
                                    id="adminPassword"
                                    name="password"
                                    autocomplete="current-password"
                                    required
                                    placeholder="Masukkan kata sandi"
                                    @class([
                                        'login-focus w-full rounded-xl',
                                        'border bg-slate-50',
                                        'py-3.5 pl-12 pr-14',
                                        'text-sm text-slate-900',
                                        'outline-none transition',
                                        'placeholder:text-slate-400',
                                        'focus:bg-white',
                                        'focus:ring-4',
                                        'focus:ring-blue-100',
                                        'border-red-300 focus:border-red-400' =>
                                            $errors->has('password'),
                                        'border-slate-200 focus:border-[#075F9B]' =>
                                            !$errors->has('password'),
                                    ])
                                >

                                <button
                                    type="button"
                                    id="toggleAdminPassword"
                                    class="login-focus absolute
                                           right-2.5 top-1/2
                                           flex h-9 w-9
                                           -translate-y-1/2
                                           items-center justify-center
                                           rounded-lg
                                           text-slate-400
                                           transition
                                           hover:bg-slate-200
                                           hover:text-[#075F9B]"
                                    aria-label="Tampilkan kata sandi"
                                    aria-pressed="false"
                                >
                                    <svg
                                        id="passwordVisibleIcon"
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
                                        id="passwordHiddenIcon"
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="hidden h-5 w-5"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        aria-hidden="true"
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

                            @error('password')
                                <p
                                    class="mt-2 text-sm
                                           font-semibold
                                           text-red-600"
                                >
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        <button
                            type="submit"
                            id="adminLoginSubmit"
                            class="login-focus inline-flex
                                   w-full items-center
                                   justify-center gap-3
                                   rounded-xl bg-[#075F9B]
                                   px-6 py-3.5
                                   text-sm font-bold
                                   text-white shadow-lg
                                   shadow-blue-900/15
                                   transition
                                   hover:bg-[#064B7B]
                                   disabled:cursor-not-allowed
                                   disabled:opacity-60"
                        >
                            <span id="adminLoginButtonText">
                                Masuk
                            </span>

                            <svg
                                id="adminLoginButtonIcon"
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3"
                                />
                            </svg>

                            <svg
                                id="adminLoginSpinner"
                                xmlns="http://www.w3.org/2000/svg"
                                class="hidden h-4 w-4 animate-spin"
                                fill="none"
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >
                                <circle
                                    class="opacity-25"
                                    cx="12"
                                    cy="12"
                                    r="10"
                                    stroke="currentColor"
                                    stroke-width="4"
                                ></circle>

                                <path
                                    class="opacity-75"
                                    fill="currentColor"
                                    d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"
                                ></path>
                            </svg>
                        </button>
                    </form>


                    <div
                        class="mt-7 border-t
                               border-slate-100 pt-5"
                    >
                        <a
                            href="{{ route('home') }}"
                            class="login-focus inline-flex
                                   items-center gap-2
                                   text-xs font-bold
                                   text-slate-500
                                   transition
                                   hover:text-[#075F9B]"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M15 19l-7-7 7-7"
                                />
                            </svg>

                            Kembali ke Website
                        </a>
                    </div>
                </div>
            </section>
        </div>
    </main>


    <script>
        document.addEventListener(
            'DOMContentLoaded',
            function () {
                const form =
                    document.getElementById(
                        'adminLoginForm'
                    );

                const submitButton =
                    document.getElementById(
                        'adminLoginSubmit'
                    );

                const submitButtonText =
                    document.getElementById(
                        'adminLoginButtonText'
                    );

                const submitButtonIcon =
                    document.getElementById(
                        'adminLoginButtonIcon'
                    );

                const submitSpinner =
                    document.getElementById(
                        'adminLoginSpinner'
                    );

                const passwordInput =
                    document.getElementById(
                        'adminPassword'
                    );

                const togglePasswordButton =
                    document.getElementById(
                        'toggleAdminPassword'
                    );

                const visibleIcon =
                    document.getElementById(
                        'passwordVisibleIcon'
                    );

                const hiddenIcon =
                    document.getElementById(
                        'passwordHiddenIcon'
                    );


                if (
                    passwordInput
                    && togglePasswordButton
                ) {
                    togglePasswordButton.addEventListener(
                        'click',
                        function () {
                            const passwordIsVisible =
                                passwordInput.type === 'text';

                            passwordInput.type =
                                passwordIsVisible
                                    ? 'password'
                                    : 'text';

                            togglePasswordButton.setAttribute(
                                'aria-pressed',
                                passwordIsVisible
                                    ? 'false'
                                    : 'true'
                            );

                            togglePasswordButton.setAttribute(
                                'aria-label',
                                passwordIsVisible
                                    ? 'Tampilkan kata sandi'
                                    : 'Sembunyikan kata sandi'
                            );

                            if (visibleIcon) {
                                visibleIcon.classList.toggle(
                                    'hidden',
                                    !passwordIsVisible
                                );
                            }

                            if (hiddenIcon) {
                                hiddenIcon.classList.toggle(
                                    'hidden',
                                    passwordIsVisible
                                );
                            }

                            passwordInput.focus();
                        }
                    );
                }


                if (form && submitButton) {
                    form.addEventListener(
                        'submit',
                        function () {
                            if (!form.checkValidity()) {
                                return;
                            }

                            submitButton.disabled = true;

                            if (submitButtonText) {
                                submitButtonText.textContent =
                                    'Memproses...';
                            }

                            if (submitButtonIcon) {
                                submitButtonIcon.classList.add(
                                    'hidden'
                                );
                            }

                            if (submitSpinner) {
                                submitSpinner.classList.remove(
                                    'hidden'
                                );
                            }
                        }
                    );
                }
            }
        );
    </script>
</body>

</html>
