@extends('layouts.admin')

@section('title', 'Tambah Berita')

@section('content')

<div
    class="mx-auto
           max-w-5xl
           space-y-6"
>
    <header>
        <p
            class="text-xs
                   font-bold
                   uppercase
                   tracking-[0.16em]
                   text-[#075F9B]"
        >
            Berita Website
        </p>

        <h1
            class="mt-2
                   text-2xl
                   font-extrabold
                   text-slate-900
                   sm:text-3xl"
        >
            Tambah Berita
        </h1>

        <p
            class="mt-2
                   text-sm
                   leading-7
                   text-slate-500"
        >
            Tambahkan informasi atau kegiatan terbaru
            Program Studi D-IV TMPP.
        </p>
    </header>


    <form
        action="{{ route(
            'admin.news.store'
        ) }}"
        method="POST"
        enctype="multipart/form-data"
        class="rounded-2xl
               border border-slate-200
               bg-white p-5
               sm:p-7"
    >
        @csrf

        @include(
            'admin.news._form'
        )

        <div
            class="mt-8 flex
                   flex-col-reverse
                   gap-3
                   border-t
                   border-slate-200
                   pt-6
                   sm:flex-row
                   sm:justify-end"
        >
            <a
                href="{{ route(
                    'admin.news.index'
                ) }}"
                class="inline-flex
                       items-center
                       justify-center
                       rounded-xl
                       border
                       border-slate-200
                       px-5 py-3
                       text-sm
                       font-bold
                       text-slate-700"
            >
                Batal
            </a>

            <button
                type="submit"
                class="inline-flex
                       items-center
                       justify-center
                       rounded-xl
                       bg-[#075F9B]
                       px-5 py-3
                       text-sm
                       font-bold
                       text-white
                       transition
                       hover:bg-[#064B7B]"
            >
                Simpan Berita
            </button>
        </div>
    </form>
</div>

@endsection