<section class="relative py-24 overflow-hidden bg-gradient-to-br from-slate-50 via-white to-blue-50">

    {{-- Background Decoration --}}
    <div class="absolute inset-0 -z-10">

        <div class="absolute -top-40 -left-40 w-[520px] h-[520px] rounded-full bg-blue-200/30 blur-[140px]"></div>

        <div class="absolute bottom-0 -right-40 w-[520px] h-[520px] rounded-full bg-yellow-200/30 blur-[140px]"></div>

        <div
            class="absolute inset-0 opacity-[0.03]"
            style="background-image: linear-gradient(#0f172a 1px, transparent 1px),
            linear-gradient(to right,#0f172a 1px,transparent 1px);
            background-size:70px 70px;">
        </div>

    </div>

    <div class="max-w-7xl mx-auto px-6">

        {{-- Heading --}}
        <div class="text-center max-w-3xl mx-auto mb-14" data-aos="fade-up">

            <span class="uppercase tracking-[5px] text-blue-700 font-semibold">
                Dokumen & Informasi
            </span>

            <h2 class="mt-4 text-4xl md:text-5xl font-bold text-slate-800 leading-tight">
                Layanan Informasi Akademik
            </h2>

            <div class="w-24 h-1 bg-yellow-400 rounded-full mx-auto mt-6"></div>

            <p class="mt-7 text-slate-600 leading-8">
                Akses berbagai dokumen dan informasi akademik Program Studi
                D-IV TMPP secara terpusat dan terstruktur.
            </p>

        </div>

        {{-- Category Tabs --}}
        <div
            class="mb-12 rounded-3xl bg-white border border-slate-100 shadow-lg p-5"
            data-aos="fade-up">

            <div class="flex flex-wrap justify-center gap-3">

                <button
                    type="button"
                    data-filter="all"
                    class="academic-filter active px-5 py-3 rounded-xl bg-blue-700 text-white font-semibold transition">
                    Semua
                </button>

                @foreach ($categories as $key => $label)

                    <button
                        type="button"
                        data-filter="{{ $key }}"
                        class="academic-filter px-5 py-3 rounded-xl bg-slate-100 text-slate-700 font-semibold hover:bg-blue-50 hover:text-blue-700 transition">
                        {{ $label }}
                    </button>

                @endforeach

            </div>

        </div>

        @php
            $allDocuments = collect();

            foreach ($documents as $group) {
                $allDocuments = $allDocuments->merge($group);
            }
        @endphp

        {{-- Document Grid --}}
        @if ($allDocuments->count() > 0)

            <div id="academicGrid" class="grid md:grid-cols-2 lg:grid-cols-3 gap-7">

                @foreach ($allDocuments as $document)

                    <div
                        data-aos="fade-up"
                        data-aos-delay="{{ $loop->index * 70 }}"
                        data-card="academic"
                        data-category="{{ $document->category }}"
                        class="academic-card group relative overflow-hidden rounded-3xl bg-white border border-slate-100 shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-500">

                        {{-- Top Accent --}}
                        <div class="h-1 bg-gradient-to-r from-blue-700 via-yellow-400 to-blue-700"></div>

                        <div class="p-7">

                            {{-- Icon --}}
                            <div class="w-14 h-14 rounded-2xl bg-blue-100 text-blue-700 flex items-center justify-center mb-6 group-hover:bg-blue-700 group-hover:text-white transition">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="w-7 h-7"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M7 7h10M7 11h10M7 15h6M5 3h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2z" />

                                </svg>

                            </div>

                            {{-- Category --}}
                            <span class="inline-block px-4 py-2 rounded-full bg-yellow-100 text-yellow-700 text-sm font-semibold">
                                {{ $document->category_label }}
                            </span>

                            {{-- Title --}}
                            <h3 class="mt-5 text-2xl font-bold text-slate-800 leading-snug">
                                {{ $document->title }}
                            </h3>

                            {{-- Year --}}
                            @if ($document->academic_year)

                                <p class="mt-3 text-sm font-semibold text-blue-700">
                                    Tahun Akademik {{ $document->academic_year }}
                                </p>

                            @endif

                            {{-- Description --}}
                            @if ($document->description)

                                <p class="mt-5 text-slate-600 leading-7 text-sm text-justify">
                                    {{ $document->description }}
                                </p>

                            @else

                                <p class="mt-5 text-slate-500 leading-7 text-sm">
                                    Dokumen akademik tersedia untuk diakses oleh mahasiswa,
                                    dosen, dan pihak terkait.
                                </p>

                            @endif

                            {{-- Action --}}
                            <div class="mt-7 flex flex-wrap gap-3">

                                @if ($document->file_path)

                                    <a href="{{ asset('storage/' . $document->file_path) }}"
                                       target="_blank"
                                       class="inline-flex items-center justify-center px-5 py-3 rounded-xl bg-blue-700 text-white font-semibold hover:bg-blue-800 transition">
                                        Lihat Dokumen
                                    </a>

                                @endif

                                @if ($document->external_link)

                                    <a href="{{ $document->external_link }}"
                                       target="_blank"
                                       class="inline-flex items-center justify-center px-5 py-3 rounded-xl bg-yellow-400 text-slate-900 font-semibold hover:bg-yellow-500 transition">
                                        Buka Link
                                    </a>

                                @endif

                                @if (!$document->file_path && !$document->external_link)

                                    <span class="inline-flex items-center justify-center px-5 py-3 rounded-xl bg-slate-100 text-slate-500 font-semibold">
                                        Belum tersedia
                                    </span>

                                @endif

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

            {{-- Empty Filter Result --}}
            <div
                id="emptyAcademic"
                class="hidden mt-10 rounded-3xl bg-white border border-slate-100 shadow-lg p-10 text-center">

                <h3 class="text-2xl font-bold text-slate-800">
                    Data tidak ditemukan
                </h3>

                <p class="mt-3 text-slate-500">
                    Tidak ada dokumen pada kategori ini.
                </p>

            </div>

        @else

            {{-- Empty Database --}}
            <div class="rounded-3xl bg-white border border-slate-100 p-12 text-center shadow-lg">

                <h3 class="text-2xl font-bold text-slate-800">
                    Dokumen akademik belum tersedia
                </h3>

                <p class="mt-3 text-slate-500">
                    Data akademik belum ditambahkan melalui halaman admin.
                </p>

            </div>

        @endif

    </div>

</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const filterButtons = document.querySelectorAll('.academic-filter');
        const cards = document.querySelectorAll('[data-card="academic"]');
        const emptyState = document.getElementById('emptyAcademic');

        let activeFilter = 'all';

        function updateCards() {
            let visibleCount = 0;

            cards.forEach(card => {
                const category = card.dataset.category;
                const matchFilter = activeFilter === 'all' || category === activeFilter;

                if (matchFilter) {
                    card.classList.remove('hidden');
                    visibleCount++;
                } else {
                    card.classList.add('hidden');
                }
            });

            if (emptyState) {
                emptyState.classList.toggle('hidden', visibleCount !== 0);
            }
        }

        filterButtons.forEach(button => {
            button.addEventListener('click', function () {
                activeFilter = this.dataset.filter;

                filterButtons.forEach(btn => {
                    btn.classList.remove('active', 'bg-blue-700', 'text-white');
                    btn.classList.add('bg-slate-100', 'text-slate-700');
                });

                this.classList.add('active', 'bg-blue-700', 'text-white');
                this.classList.remove('bg-slate-100', 'text-slate-700');

                updateCards();
            });
        });
    });
</script>