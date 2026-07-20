@extends('layouts.admin')

@section('title', 'Berita')

@section('content')

<div
    class="mx-auto
           max-w-7xl
           space-y-6"
>
    <header
        class="flex flex-col
               gap-4
               sm:flex-row
               sm:items-end
               sm:justify-between"
    >
        <div>
            <p
                class="text-xs
                       font-bold
                       uppercase
                       tracking-[0.16em]
                       text-[#075F9B]"
            >
                Konten Website
            </p>

            <h1
                class="mt-2
                       text-2xl
                       font-extrabold
                       text-slate-900
                       sm:text-3xl"
            >
                Berita
            </h1>

            <p
                class="mt-2
                       text-sm
                       leading-7
                       text-slate-500"
            >
                Kelola berita yang tampil pada
                halaman beranda website.
            </p>
        </div>


        <a
            href="{{ route(
                'admin.news.create'
            ) }}"
            class="inline-flex
                   items-center
                   justify-center
                   gap-2
                   rounded-xl
                   bg-[#075F9B]
                   px-5 py-3
                   text-sm
                   font-bold
                   text-white
                   transition
                   hover:bg-[#064B7B]"
        >
            <span>+</span>
            Tambah Berita
        </a>
    </header>


    @if (session('success'))
        <div
            class="rounded-xl
                   border
                   border-emerald-200
                   bg-emerald-50
                   px-4 py-3
                   text-sm
                   font-semibold
                   text-emerald-800"
        >
            {{ session('success') }}
        </div>
    @endif


    @if (session('error'))
        <div
            class="rounded-xl
                   border
                   border-red-200
                   bg-red-50
                   px-4 py-3
                   text-sm
                   font-semibold
                   text-red-700"
        >
            {{ session('error') }}
        </div>
    @endif


    <section
        class="overflow-hidden
               rounded-2xl
               border
               border-slate-200
               bg-white"
    >
        <div
            class="hidden
                   overflow-x-auto
                   md:block"
        >
            <table class="w-full">
                <thead
                    class="border-b
                           border-slate-200
                           bg-slate-50"
                >
                    <tr>
                        <th
                            class="px-6 py-4
                                   text-left
                                   text-xs
                                   font-bold
                                   text-slate-500"
                        >
                            Berita
                        </th>

                        <th
                            class="px-6 py-4
                                   text-left
                                   text-xs
                                   font-bold
                                   text-slate-500"
                        >
                            Publikasi
                        </th>

                        <th
                            class="px-6 py-4
                                   text-left
                                   text-xs
                                   font-bold
                                   text-slate-500"
                        >
                            Status
                        </th>

                        <th
                            class="px-6 py-4
                                   text-right
                                   text-xs
                                   font-bold
                                   text-slate-500"
                        >
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody
                    class="divide-y
                           divide-slate-200"
                >
                    @forelse ($news as $item)
                        <tr>
                            <td
                                class="px-6 py-4"
                            >
                                <div
                                    class="flex
                                           items-center
                                           gap-4"
                                >
                                    @if ($item->image)
                                        <img
                                            src="{{ asset(
                                                'storage/'
                                                . $item->image
                                            ) }}"
                                            alt=""
                                            class="h-14
                                                   w-20
                                                   rounded-lg
                                                   object-cover"
                                        >
                                    @endif

                                    <div>
                                        <p
                                            class="font-bold
                                                   text-slate-900"
                                        >
                                            {{ $item->title }}
                                        </p>

                                        @if ($item->excerpt)
                                            <p
                                                class="mt-1
                                                       max-w-md
                                                       truncate
                                                       text-xs
                                                       text-slate-500"
                                            >
                                                {{ $item->excerpt }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            <td
                                class="px-6 py-4
                                       text-sm
                                       text-slate-600"
                            >
                                {{
                                    $item->published_at
                                        ?->format(
                                            'd/m/Y H:i'
                                        )
                                    ?? '-'
                                }}
                            </td>

                            <td
                                class="px-6 py-4"
                            >
                                @if ($item->is_active)
                                    <span
                                        class="rounded-full
                                               bg-emerald-50
                                               px-3 py-1
                                               text-xs
                                               font-bold
                                               text-emerald-700"
                                    >
                                        Aktif
                                    </span>
                                @else
                                    <span
                                        class="rounded-full
                                               bg-slate-100
                                               px-3 py-1
                                               text-xs
                                               font-bold
                                               text-slate-500"
                                    >
                                        Tidak Aktif
                                    </span>
                                @endif
                            </td>

                            <td
                                class="px-6 py-4
                                       text-right"
                            >
                                <div
                                    class="flex
                                           justify-end
                                           gap-2"
                                >
                                    <a
                                        href="{{ route(
                                            'admin.news.edit',
                                            $item
                                        ) }}"
                                        class="rounded-lg
                                               border
                                               border-slate-200
                                               px-3 py-2
                                               text-xs
                                               font-bold
                                               text-slate-700"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route(
                                            'admin.news.destroy',
                                            $item
                                        ) }}"
                                        method="POST"
                                        onsubmit="return confirm('Hapus berita ini?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="rounded-lg
                                                   border
                                                   border-red-200
                                                   px-3 py-2
                                                   text-xs
                                                   font-bold
                                                   text-red-600"
                                        >
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td
                                colspan="4"
                                class="px-6
                                       py-12
                                       text-center
                                       text-sm
                                       text-slate-500"
                            >
                                Belum ada berita.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>


        {{-- MOBILE --}}
        <div
            class="divide-y
                   divide-slate-200
                   md:hidden"
        >
            @forelse ($news as $item)
                <div class="p-5">
                    @if ($item->image)
                        <img
                            src="{{ asset(
                                'storage/'
                                . $item->image
                            ) }}"
                            alt=""
                            class="mb-4
                                   aspect-[16/9]
                                   w-full
                                   rounded-xl
                                   object-cover"
                        >
                    @endif

                    <h2
                        class="font-extrabold
                               text-slate-900"
                    >
                        {{ $item->title }}
                    </h2>

                    <p
                        class="mt-2
                               text-xs
                               text-slate-500"
                    >
                        {{
                            $item->published_at
                                ?->format(
                                    'd/m/Y H:i'
                                )
                            ?? '-'
                        }}
                    </p>

                    <div
                        class="mt-4
                               flex gap-2"
                    >
                        <a
                            href="{{ route(
                                'admin.news.edit',
                                $item
                            ) }}"
                            class="flex-1
                                   rounded-lg
                                   border
                                   border-slate-200
                                   px-3 py-2
                                   text-center
                                   text-xs
                                   font-bold
                                   text-slate-700"
                        >
                            Edit
                        </a>

                        <form
                            action="{{ route(
                                'admin.news.destroy',
                                $item
                            ) }}"
                            method="POST"
                            class="flex-1"
                            onsubmit="return confirm('Hapus berita ini?')"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="w-full
                                       rounded-lg
                                       border
                                       border-red-200
                                       px-3 py-2
                                       text-xs
                                       font-bold
                                       text-red-600"
                            >
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div
                    class="p-10
                           text-center
                           text-sm
                           text-slate-500"
                >
                    Belum ada berita.
                </div>
            @endforelse
        </div>
    </section>


    @if ($news->hasPages())
        <div>
            {{ $news->links() }}
        </div>
    @endif
</div>

@endsection