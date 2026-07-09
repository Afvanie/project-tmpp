@if(isset($section) && $section)

<section class="relative py-24 bg-slate-50 overflow-hidden">

    <div class="max-w-7xl mx-auto px-6">

        <div class="text-center mb-16" data-aos="fade-up">

            <span class="uppercase tracking-[5px] text-blue-700 font-semibold">
                {{ $section->subtitle ?? 'Kompetensi Lulusan' }}
            </span>

            <h2 class="mt-3 text-4xl md:text-5xl font-bold text-slate-800">
                {{ $section->title }}
            </h2>

            <div class="w-24 h-1 bg-yellow-400 rounded-full mx-auto mt-6"></div>

            @if($section->description)
                <p class="mt-6 max-w-3xl mx-auto text-slate-600 leading-8">
                    {{ $section->description }}
                </p>
            @endif

        </div>

        <div class="space-y-5">

            @foreach($section->items as $item)
                <div
                    class="bg-white rounded-2xl p-6 shadow-lg border border-slate-100 hover:-translate-y-1 hover:shadow-xl transition"
                    data-aos="fade-up"
                    data-aos-delay="{{ $loop->iteration * 80 }}">

                    <div class="flex gap-5">

                        <div class="shrink-0 w-12 h-12 rounded-xl bg-blue-700 text-white flex items-center justify-center font-bold">
                            {{ $loop->iteration }}
                        </div>

                        <div>
                            <h3 class="text-lg font-bold text-slate-800 mb-2">
                                {{ $item->title }}
                            </h3>

                            <p class="text-slate-600 leading-8 text-justify">
                                {{ $item->content }}
                            </p>
                        </div>

                    </div>

                </div>
            @endforeach

        </div>

    </div>

</section>
@endif