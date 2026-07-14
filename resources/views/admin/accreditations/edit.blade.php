@extends('layouts.admin')

@section('title', 'Edit Akreditasi')

@section('content')

@php
    $accreditationTitle = trim(
        (string) $accreditation->title
    );
@endphp


<div class="space-y-8">

    {{-- ========================================================= --}}
    {{-- HEADER --}}
    {{-- ========================================================= --}}

    <section
        class="relative overflow-hidden
               rounded-[2rem]
               bg-gradient-to-br
               from-blue-700 via-blue-800
               to-slate-950
               p-7 shadow-xl sm:p-8"
    >
        <div
            class="pointer-events-none absolute
                   -right-24 -top-24
                   h-72 w-72 rounded-full
                   bg-yellow-300/20 blur-3xl"
            aria-hidden="true"
        ></div>

        <div
            class="pointer-events-none absolute
                   -bottom-24 -left-24
                   h-72 w-72 rounded-full
                   bg-white/10 blur-3xl"
            aria-hidden="true"
        ></div>

        <div
            class="relative z-10 flex
                   flex-col gap-6
                   lg:flex-row lg:items-center
                   lg:justify-between"
        >
            <div>
                <span
                    class="inline-flex rounded-full
                           border border-white/20
                           bg-white/10 px-4 py-2
                           text-xs font-bold uppercase
                           tracking-widest text-white/90"
                >
                    Edit Data
                </span>

                <h1
                    class="mt-5 text-3xl
                           font-black text-white
                           md:text-4xl"
                >
                    Edit Akreditasi
                </h1>

                <p
                    class="mt-3 max-w-3xl
                           leading-7 text-white/75"
                >
                    Perbarui informasi akreditasi Program Studi
                    D-IV Teknik Mesin Produksi dan Perawatan
                    berdasarkan data serta dokumen resmi.
                </p>

                @if ($accreditationTitle !== '')
                    <p
                        class="mt-4 inline-flex
                               rounded-xl bg-white/10
                               px-4 py-2 text-sm
                               font-bold text-white"
                    >
                        {{ $accreditationTitle }}
                    </p>
                @endif
            </div>

            <a
                href="{{ route(
                    'admin.accreditations.index'
                ) }}"
                class="inline-flex items-center
                       justify-center rounded-2xl
                       bg-yellow-400 px-6 py-4
                       font-black text-slate-900
                       shadow-lg shadow-yellow-400/20
                       transition hover:bg-yellow-300"
            >
                ← Kembali
            </a>
        </div>
    </section>


    {{-- ========================================================= --}}
    {{-- INFORMASI PENGISIAN --}}
    {{-- ========================================================= --}}

    <div
        class="rounded-2xl border
               border-blue-200 bg-blue-50
               px-6 py-5 text-blue-800"
    >
        <p class="font-bold">
            Pastikan perubahan sesuai dokumen resmi.
        </p>

        <p class="mt-2 text-sm leading-6">
            Nomor sertifikat, masa berlaku, peringkat, lembaga,
            dan uraian yang belum dapat diverifikasi sebaiknya
            tetap dikosongkan.
        </p>
    </div>


    {{-- ========================================================= --}}
    {{-- ALERT ERROR PROSES --}}
    {{-- ========================================================= --}}

    @if (session('error'))
        <div
            class="rounded-2xl border
                   border-red-200 bg-red-50
                   px-6 py-4 font-semibold
                   text-red-700"
            role="alert"
        >
            {{ session('error') }}
        </div>
    @endif


    {{-- ========================================================= --}}
    {{-- ERROR VALIDASI --}}
    {{-- ========================================================= --}}

    @if ($errors->any())
        <div
            class="rounded-2xl border
                   border-red-200 bg-red-50
                   px-6 py-5 text-red-700"
            role="alert"
        >
            <h2 class="font-black">
                Data akreditasi belum dapat diperbarui.
            </h2>

            <p class="mt-1 text-sm">
                Periksa kembali bagian berikut:
            </p>

            <ul
                class="mt-3 list-disc
                       space-y-1 pl-5 text-sm"
            >
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {{-- ========================================================= --}}
    {{-- FORM --}}
    {{-- ========================================================= --}}

    <form
        id="accreditationEditForm"
        action="{{ route(
            'admin.accreditations.update',
            $accreditation
        ) }}"
        method="POST"
        enctype="multipart/form-data"
    >
        @csrf
        @method('PUT')

        @include('admin.accreditations._form')
    </form>

</div>

@endsection


@push('scripts')
    <script>
        document.addEventListener(
            'DOMContentLoaded',
            function () {
                const form = document.getElementById(
                    'accreditationEditForm'
                );

                if (!form) {
                    return;
                }

                form.addEventListener(
                    'submit',
                    function () {
                        const submitButton =
                            form.querySelector(
                                'button[type="submit"]'
                            );

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
@endpush