@if (
    isset($latestNews)
    && $latestNews->isNotEmpty()
)
    <section
        id="berita"
        class="bg-white py-16
               md:py-20 lg:py-24"
    >
        <div
            class="mx-auto max-w-7xl
                   px-6"
        >
            <div
                class="flex flex-col gap-5
                       lg:flex-row
                       lg:items-end
                       lg:justify-between"
            >
                <div>
                    <div
                        class="flex items-center
                               gap-3"
                    >
                        <span
                            class="h-px w-10
                                   bg-[#D7B33E]"
                        ></span>

                        <p
                            class="text-xs font-bold
                                   uppercase
                                   tracking-[0.22em]
                                   text-[#075F9B]"
                        >
                            Informasi Terkini
                        </p>
                    </div>

                    <h2
                        class="mt-4 text-3xl
                               font-extrabold
                               tracking-tight
                               text-slate-900
                               sm:text-4xl"
                    >
                        Berita Terbaru
                    </h2>

                    <p
                        class="mt-4 max-w-2xl
                               text-base
                               leading-8
                               text-slate-600"
                    >
                        Informasi terbaru seputar kegiatan,
                        akademik, prestasi, dan aktivitas
                        Program Studi D-IV Teknik Mesin
                        Produksi dan Perawatan.
                    </p>
                </div>
            </div>


            <div
                class="mt-10 grid gap-7
                       md:grid-cols-2
                       lg:grid-cols-3"
            >
                @foreach ($latestNews as $item)
                    <article
                        class="group overflow-hidden
                               rounded-2xl border
                               border-slate-200
                               bg-white
                               transition
                               duration-300
                               hover:-translate-y-1
                               hover:shadow-xl"
                    >
                        <a
                            href="{{ route(
                                'news.show',
                                $item
                            ) }}"
                            class="block"
                        >
                            <div
                                class="aspect-[16/10]
                                       overflow-hidden
                                       bg-slate-100"
                            >
                                @if ($item->image)
                                    <img
                                        src="{{ asset(
                                            'storage/'
                                            . $item->image
                                        ) }}"
                                        alt="{{ $item->title }}"
                                        class="h-full w-full
                                               object-cover
                                               transition
                                               duration-500
                                               group-hover:scale-105"
                                    >
                                @else
                                    <div
                                        class="flex h-full
                                               items-center
                                               justify-center
                                               bg-[#071A2F]"
                                    >
                                        <i
                                            class="fa-regular
                                                   fa-newspaper
                                                   text-4xl
                                                   text-white/40"
                                        ></i>
                                    </div>
                                @endif
                            </div>
                        </a>

                        <div class="p-6">
                            @if ($item->published_at)
                                <div
                                    class="flex items-center
                                           gap-2 text-xs
                                           font-semibold
                                           text-slate-500"
                                >
                                    <i
                                        class="fa-regular
                                               fa-calendar"
                                    ></i>

                                    <span>
                                        {{
                                            $item
                                                ->published_at
                                                ->translatedFormat(
                                                    'd F Y'
                                                )
                                        }}
                                    </span>
                                </div>
                            @endif

                            <h3
                                class="mt-4
                                       text-lg
                                       font-extrabold
                                       leading-7
                                       text-slate-900"
                            >
                                <a
                                    href="{{ route(
                                        'news.show',
                                        $item
                                    ) }}"
                                    class="transition
                                           hover:text-[#075F9B]"
                                >
                                    {{ $item->title }}
                                </a>
                            </h3>

                            @if ($item->excerpt)
                                <p
                                    class="mt-3
                                           line-clamp-3
                                           text-sm
                                           leading-7
                                           text-slate-600"
                                >
                                    {{ $item->excerpt }}
                                </p>
                            @endif

                            <a
                                href="{{ route(
                                    'news.show',
                                    $item
                                ) }}"
                                class="mt-5
                                       inline-flex
                                       items-center
                                       gap-2
                                       text-sm
                                       font-bold
                                       text-[#075F9B]
                                       transition
                                       hover:text-[#064B7B]"
                            >
                                Baca Selengkapnya

                                <i
                                    class="fa-solid
                                           fa-arrow-right
                                           text-xs"
                                ></i>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endif