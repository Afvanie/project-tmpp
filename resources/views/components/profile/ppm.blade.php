@if(isset($section) && $section)

<section class="relative py-24 bg-white overflow-hidden">

    <div class="max-w-7xl mx-auto px-6">

        <div class="text-center mb-16" data-aos="fade-up">

            <span class="uppercase tracking-[5px] text-blue-700 font-semibold">
                {{ $section->subtitle ?? 'Profil Lulusan Program Studi' }}
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

        <div class="grid md:grid-cols-3 gap-6">

            @foreach($section->items as $item)
                <div
                    class="group bg-white rounded-3xl p-7 shadow-lg border border-slate-100 hover:-translate-y-2 hover:shadow-2xl transition-all duration-500"
                    data-aos="fade-up"
                    data-aos-delay="{{ $loop->iteration * 100 }}">

                    <div class="w-14 h-14 rounded-2xl bg-blue-50 text-blue-700 flex items-center justify-center font-bold text-xl mb-6 group-hover:bg-blue-700 group-hover:text-white transition">
                        {{ $loop->iteration }}
                    </div>

                    <h3 class="text-xl font-bold text-slate-800 mb-4">
                        {{ $item->title }}
                    </h3>

                    <p class="text-slate-600 leading-8 text-justify">
                        {{ $item->content }}
                    </p>

                </div>
            @endforeach

        </div>

    </div>

</section>
@endif