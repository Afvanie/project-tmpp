@php
    $newsItem = $news ?? null;

    $publishedValue = old(
        'published_at',
        $newsItem?->published_at
            ?->format(
                'Y-m-d\TH:i'
            )
        ?? now()->format(
            'Y-m-d\TH:i'
        )
    );
@endphp


<div class="space-y-6">

    <div>
        <label
            for="title"
            class="mb-2 block
                   text-sm font-bold
                   text-slate-700"
        >
            Judul Berita
        </label>

        <input
            id="title"
            type="text"
            name="title"
            value="{{ old(
                'title',
                $newsItem?->title
            ) }}"
            required
            class="w-full rounded-xl
                   border border-slate-200
                   px-4 py-3
                   text-sm
                   outline-none
                   transition
                   focus:border-[#075F9B]"
            placeholder="Masukkan judul berita"
        >

        @error('title')
            <p
                class="mt-2
                       text-xs
                       text-red-600"
            >
                {{ $message }}
            </p>
        @enderror
    </div>


    <div>
        <label
            for="image"
            class="mb-2 block
                   text-sm font-bold
                   text-slate-700"
        >
            Gambar Utama
        </label>

        @if ($newsItem?->image)
            <img
                src="{{ asset(
                    'storage/'
                    . $newsItem->image
                ) }}"
                alt="{{ $newsItem->title }}"
                class="mb-4
                       h-40 w-64
                       rounded-xl
                       object-cover"
            >
        @endif

        <input
            id="image"
            type="file"
            name="image"
            accept=".jpg,.jpeg,.png,.webp"
            class="block w-full
                   rounded-xl
                   border border-slate-200
                   bg-white px-4 py-3
                   text-sm"
        >

        <p
            class="mt-2
                   text-xs
                   text-slate-500"
        >
            Format JPG, JPEG, PNG, atau WEBP.
            Maksimal 5 MB.
        </p>

        @error('image')
            <p
                class="mt-2
                       text-xs
                       text-red-600"
            >
                {{ $message }}
            </p>
        @enderror
    </div>


    <div>
        <label
            for="excerpt"
            class="mb-2 block
                   text-sm font-bold
                   text-slate-700"
        >
            Ringkasan
        </label>

        <textarea
            id="excerpt"
            name="excerpt"
            rows="3"
            maxlength="500"
            class="w-full rounded-xl
                   border border-slate-200
                   px-4 py-3
                   text-sm leading-7
                   outline-none
                   transition
                   focus:border-[#075F9B]"
            placeholder="Ringkasan singkat berita"
        >{{ old(
            'excerpt',
            $newsItem?->excerpt
        ) }}</textarea>

        @error('excerpt')
            <p
                class="mt-2
                       text-xs
                       text-red-600"
            >
                {{ $message }}
            </p>
        @enderror
    </div>


    <div>
        <label
            for="content"
            class="mb-2 block
                   text-sm font-bold
                   text-slate-700"
        >
            Isi Berita
        </label>

        <textarea
            id="content"
            name="content"
            rows="14"
            required
            class="w-full rounded-xl
                   border border-slate-200
                   px-4 py-3
                   text-sm leading-7
                   outline-none
                   transition
                   focus:border-[#075F9B]"
            placeholder="Tulis isi berita..."
        >{{ old(
            'content',
            $newsItem?->content
        ) }}</textarea>

        @error('content')
            <p
                class="mt-2
                       text-xs
                       text-red-600"
            >
                {{ $message }}
            </p>
        @enderror
    </div>


    <div
        class="grid gap-5
               md:grid-cols-2"
    >
        <div>
            <label
                for="published_at"
                class="mb-2 block
                       text-sm font-bold
                       text-slate-700"
            >
                Tanggal Publikasi
            </label>

            <input
                id="published_at"
                type="datetime-local"
                name="published_at"
                value="{{ $publishedValue }}"
                class="w-full rounded-xl
                       border border-slate-200
                       px-4 py-3
                       text-sm
                       outline-none
                       transition
                       focus:border-[#075F9B]"
            >

            @error('published_at')
                <p
                    class="mt-2
                           text-xs
                           text-red-600"
                >
                    {{ $message }}
                </p>
            @enderror
        </div>


        <div>
            <p
                class="mb-2 block
                       text-sm font-bold
                       text-slate-700"
            >
                Status
            </p>

            <label
                class="flex min-h-[48px]
                       cursor-pointer
                       items-center gap-3
                       rounded-xl
                       border border-slate-200
                       px-4"
            >
                <input
                    type="hidden"
                    name="is_active"
                    value="0"
                >

                <input
                    type="checkbox"
                    name="is_active"
                    value="1"
                    @checked(
                        old(
                            'is_active',
                            $newsItem?->is_active
                            ?? true
                        )
                    )
                    class="h-4 w-4"
                >

                <span
                    class="text-sm
                           font-semibold
                           text-slate-700"
                >
                    Publikasikan berita
                </span>
            </label>
        </div>
    </div>

</div>