@extends('layouts.admin')

@section('content')
<div class="p-6">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">
            Konten Profil
        </h1>

        <p class="mt-2 text-gray-500">
            Kelola konten Visi Misi, Tujuan Prodi, PPM, dan CPL.
        </p>
    </div>

    @if (session('success'))
        <div class="mb-6 rounded-xl bg-green-50 border border-green-200 px-5 py-4 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid md:grid-cols-2 xl:grid-cols-4 gap-6">

        @foreach ($sections as $section)
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 hover:-translate-y-1 hover:shadow-xl transition">

                <div class="flex items-start justify-between gap-4">

                    <div>
                        <h2 class="text-xl font-bold text-gray-800">
                            {{ $section->title }}
                        </h2>

                        <p class="mt-2 text-sm text-gray-500 leading-6">
                            {{ $section->subtitle ?? 'Konten profil program studi' }}
                        </p>
                    </div>

                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                        {{ $section->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                        {{ $section->is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>

                </div>

                <div class="mt-6 flex items-center justify-between text-sm text-gray-500">
                    <span>
                        {{ $section->items_count }} Item
                    </span>

                    <span>
                        Urutan {{ $section->sort_order }}
                    </span>
                </div>

                <a href="{{ route('admin.profile-contents.edit', $section) }}"
                    class="mt-6 inline-flex w-full items-center justify-center rounded-xl bg-blue-700 px-5 py-3 text-white font-semibold hover:bg-blue-800 transition">

                    Edit Konten

                </a>

            </div>
        @endforeach

    </div>

</div>
@endsection