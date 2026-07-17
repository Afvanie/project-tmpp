@extends('layouts.admin')

@section('title', 'Ubah Akreditasi')

@section('content')

<div class="mx-auto max-w-6xl space-y-6">

    <header>
        <a
            href="{{ route(
                'admin.accreditations.index'
            ) }}"
            class="inline-flex items-center
                   gap-2 text-sm font-bold
                   text-[#075F9B]
                   hover:underline"
        >
            <span aria-hidden="true">←</span>
            <span>Kembali ke Akreditasi</span>
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
                Perbarui Data
            </p>
        </div>

        <h1
            class="mt-3 text-2xl font-extrabold
                   tracking-tight text-slate-900
                   sm:text-3xl"
        >
            Ubah Akreditasi
        </h1>

        <p
            class="mt-2 max-w-3xl
                   text-sm leading-7
                   text-slate-500"
        >
            Perbarui informasi berdasarkan dokumen resmi.
            Dokumen lama tetap digunakan apabila tidak memilih
            dokumen baru.
        </p>
    </header>


    @if (session('error'))
        <div
            class="rounded-xl border
                   border-red-200 bg-red-50
                   px-4 py-3 text-sm
                   font-semibold text-red-700"
            role="alert"
        >
            {{ session('error') }}
        </div>
    @endif


    @if ($errors->any())
        <div
            class="rounded-xl border
                   border-red-200 bg-red-50
                   px-4 py-4 text-red-800"
            role="alert"
        >
            <p class="text-sm font-bold">
                Beberapa bagian belum dapat disimpan:
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
