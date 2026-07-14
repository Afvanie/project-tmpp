@php
    /*
    |--------------------------------------------------------------------------
    | IDENTITAS HALAMAN LOGIN
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
        href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800,900"
        rel="stylesheet"
    >

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body
    class="min-h-screen bg-slate-950
           text-slate-800 antialiased"
>
    <main
        class="relative flex min-h-screen
               items-center justify-center
               overflow-hidden px-5 py-10
               sm:px-6"
    >
        {{-- ===================================================== --}}
        {{-- BACKGROUND --}}
        {{-- ===================================================== --}}

        <div
            class="pointer-events-none absolute inset-0"
            aria-hidden="true"
        >
            <div
                class="absolute inset-0
                       bg-gradient-to-br
                       from-[#002D59]
                       via-[#005BAC]
                       to-[#06172E]"
            ></div>

            <div
                class="absolute -left-32 top-1/4
                       h-[420px] w-[420px]
                       rounded-full bg-yellow-400/20
                       blur-[130px]"
            ></div>

            <div
                class="absolute -right-32 bottom-1/4
                       h-[480px] w-[480px]
                       rounded-full bg-blue-300/20
                       blur-[150px]"
            ></div>

            <div
                class="absolute inset-0 opacity-[0.08]"
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
                    background-size: 70px 70px;
                "
            ></div>

            <div
                class="absolute bottom-6 right-6
                       select-none text-right
                       text-[58px] font-black
                       leading-none text-white/[0.04]
                       sm:text-[80px]
                       lg:text-[110px]"
            >
                TMPP
            </div>
        </div>


        {{-- ===================================================== --}}
        {{-- LOGIN CONTAINER --}}
        {{-- ===================================================== --}}

        <div
            class="relative z-10 grid w-full
                   max-w-5xl overflow-hidden
                   rounded-[2rem] bg-white
                   shadow-2xl
                   lg:grid-cols-2
                   lg:rounded-[2.5rem]"
        >
            {{-- ================================================= --}}
            {{-- INFORMASI PROGRAM STUDI --}}
            {{-- ================================================= --}}

            <section
                class="relative hidden overflow-hidden
                       bg-[#06172E] p-10
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
                               h-72 w-72 rounded-full
                               bg-blue-500/25 blur-3xl"
                    ></div>

                    <div
                        class="absolute -bottom-24 -left-24
                               h-72 w-72 rounded-full
                               bg-yellow-400/20 blur-3xl"
                    ></div>

                    <div
                        class="absolute inset-0 opacity-[0.07]"
                        style="
                            background-image:
                                linear-gradient(
                                    #ffffff 1px,
                                    transparent 1px
                                ),
                                linear-gradient(
                                    to right,
                                    #ffffff 1px,
                                    transparent 1px
                                );
                            background-size: 55px 55px;
                        "
                    ></div>
                </div>


                <div class="relative">

                    <div
                        class="flex h-20 w-20
                               items-center justify-center
                               rounded-3xl bg-white
                               shadow-xl"
                    >
                        @if ($logoAvailable)
                            <img
                                src="{{ asset(
                                    $logoRelativePath
                                ) }}"
                                alt="Logo Politeknik Negeri Malang"
                                class="h-14 w-14 object-contain"
                            >
                        @else
                            <span
                                class="text-xl font-black
                                       text-blue-800"
                            >
                                TM
                            </span>
                        @endif
                    </div>

                    <span
                        class="mt-10 inline-flex
                               rounded-full border
                               border-yellow-400/40
                               bg-yellow-400/15
                               px-4 py-2 text-xs
                               font-bold uppercase
                               tracking-[0.18em]
                               text-yellow-300"
                    >
                        Admin Website
                    </span>

                    <h1
                        class="mt-6 text-4xl
                               font-black leading-tight"
                    >
                        D-IV Teknik Mesin Produksi dan Perawatan
                    </h1>

                    <p
                        class="mt-5 max-w-md
                               leading-8 text-white/70"
                    >
                        Sistem pengelolaan konten website Program
                        Studi D-IV Teknik Mesin Produksi dan
                        Perawatan Politeknik Negeri Malang.
                    </p>
                </div>


                <div
                    class="relative mt-10
                           border-t border-white/10
                           pt-6"
                >
                    <p class="text-sm font-bold text-white">
                        Politeknik Negeri Malang
                    </p>

                    <p class="mt-1 text-sm text-white/55">
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
                       sm:px-10 sm:py-10
                       lg:px-12 lg:py-14"
            >
                <div class="w-full">

                    {{-- Logo Mobile --}}
                    <div class="mb-8 text-center lg:hidden">

                        <div
                            class="mx-auto flex h-20 w-20
                                   items-center justify-center
                                   rounded-3xl bg-white
                                   shadow-xl ring-1
                                   ring-slate-100"
                        >
                            @if ($logoAvailable)
                                <img
                                    src="{{ asset(
                                        $logoRelativePath
                                    ) }}"
                                    alt="Logo Politeknik Negeri Malang"
                                    class="h-14 w-14 object-contain"
                                >
                            @else
                                <span
                                    class="text-xl font-black
                                           text-blue-800"
                                >
                                    TM
                                </span>
                            @endif
                        </div>

                        <p
                            class="mt-4 text-sm font-bold
                                   text-blue-700"
                        >
                            D-IV TMPP POLINEMA
                        </p>
                    </div>


                    <div>
                        <span
                            class="text-sm font-bold uppercase
                                   tracking-[0.18em]
                                   text-blue-700"
                        >
                            Area Pengelola
                        </span>

                        <h2
                            class="mt-3 text-3xl font-black
                                   text-slate-800 sm:text-4xl"
                        >
                            Login Admin
                        </h2>

                        <p
                            class="mt-3 leading-7
                                   text-slate-500"
                        >
                            Masukkan akun admin untuk mengelola
                            konten website D-IV TMPP.
                        </p>
                    </div>


                    {{-- ========================================= --}}
                    {{-- ALERT --}}
                    {{-- ========================================= --}}

                    @if (session('error'))
                        <div
                            class="mt-6 rounded-2xl border
                                   border-red-200 bg-red-50
                                   px-5 py-4 text-sm
                                   font-semibold text-red-700"
                            role="alert"
                        >
                            {{ session('error') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div
                            class="mt-6 rounded-2xl border
                                   border-red-200 bg-red-50
                                   px-5 py-4 text-red-700"
                            role="alert"
                        >
                            <p class="font-bold">
                                Login belum dapat diproses.
                            </p>

                            <ul
                                class="mt-2 list-disc
                                       space-y-1 pl-5 text-sm"
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
                                class="mb-2 block text-sm
                                       font-bold text-slate-700"
                            >
                                Email
                            </label>

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
                                placeholder="Masukkan email admin"
                                @class([
                                    'w-full rounded-2xl border',
                                    'bg-slate-50 px-5 py-4',
                                    'transition focus:bg-white',
                                    'focus:outline-none',
                                    'focus:ring-2',
                                    'focus:ring-blue-500',
                                    'border-red-300' =>
                                        $errors->has('email'),
                                    'border-slate-200' =>
                                        !$errors->has('email'),
                                ])
                            >

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
                                class="mb-2 block text-sm
                                       font-bold text-slate-700"
                            >
                                Kata Sandi
                            </label>

                            <div class="relative">

                                <input
                                    type="password"
                                    id="adminPassword"
                                    name="password"
                                    autocomplete="current-password"
                                    required
                                    placeholder="Masukkan kata sandi"
                                    @class([
                                        'w-full rounded-2xl border',
                                        'bg-slate-50 py-4',
                                        'pl-5 pr-16 transition',
                                        'focus:bg-white',
                                        'focus:outline-none',
                                        'focus:ring-2',
                                        'focus:ring-blue-500',
                                        'border-red-300' =>
                                            $errors->has('password'),
                                        'border-slate-200' =>
                                            !$errors->has('password'),
                                    ])
                                >

                                <button
                                    type="button"
                                    id="toggleAdminPassword"
                                    class="absolute right-3 top-1/2
                                           flex h-10 w-10
                                           -translate-y-1/2
                                           items-center justify-center
                                           rounded-xl text-slate-500
                                           transition
                                           hover:bg-slate-200
                                           hover:text-blue-700"
                                    aria-label="Tampilkan kata sandi"
                                    aria-pressed="false"
                                >
                                    {{-- Ikon Lihat --}}
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

                                    {{-- Ikon Sembunyikan --}}
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
                            class="inline-flex w-full
                                   items-center justify-center
                                   rounded-2xl bg-blue-700
                                   px-6 py-4 font-bold
                                   text-white shadow-lg
                                   shadow-blue-700/20
                                   transition hover:bg-blue-800
                                   disabled:cursor-not-allowed
                                   disabled:opacity-60"
                        >
                            Masuk
                        </button>
                    </form>


                    <div
                        class="mt-7 border-t
                               border-slate-100 pt-6
                               text-center"
                    >
                        <a
                            href="{{ route('home') }}"
                            class="inline-flex items-center
                                   gap-2 text-sm font-bold
                                   text-slate-500 transition
                                   hover:text-blue-700"
                        >
                            <span aria-hidden="true">←</span>

                            Kembali ke Website
                        </a>
                    </div>
                </div>
            </section>
        </div>
    </main>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById(
                'adminLoginForm'
            );

            const submitButton = document.getElementById(
                'adminLoginSubmit'
            );

            const passwordInput = document.getElementById(
                'adminPassword'
            );

            const togglePasswordButton = document.getElementById(
                'toggleAdminPassword'
            );

            const visibleIcon = document.getElementById(
                'passwordVisibleIcon'
            );

            const hiddenIcon = document.getElementById(
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

                        passwordInput.type = passwordIsVisible
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
                form.addEventListener('submit', function () {
                    submitButton.disabled = true;
                    submitButton.textContent = 'Memproses...';
                });
            }
        });
    </script>
</body>

</html>