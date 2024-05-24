<x-website-layout>
    <section>
        <div class="mx-auto max-w-7xl px-3 sm:px-6 md:items-center lg:px-8">
            <div class="grid grid-cols-8 gap-4">
                <div class="col-span-8 space-y-3 md:col-span-6 lg:col-span-6">
                    <div class="border-b-2 border-blue-700">
                        <h2 class="inline-block bg-blue-700 px-6 py-3 text-xl font-bold text-white">@lang('web.scienceinfors_lists')</h2>
                    </div>
                    <ul class="space-y-4">
                        @foreach ($scienceInformation as $scienceInformation)
                            <li>
                                <article class="group">
                                    <div class="flex gap-3">
                                        <a href="{{ route('science-information.show', $scienceInformation) }}" class="h-28 w-44 flex-none overflow-hidden">
                                            <img class="h-auto w-full transition-all group-hover:scale-110" src="{{ $scienceInformation->getFirstMedia('science_information_photo')->getUrl('thumb') }}" alt="" />
                                        </a>
                                        <div class="flex flex-col items-start justify-between">
                                            <div>
                                                <a href="{{ route('science-information.show', $scienceInformation) }}">
                                                    <h3 class="line-clamp-2 h-12 text-justify font-normal leading-4 tracking-normal text-blue-950 hover:text-red-500">{{ $scienceInformation->title }}</h3>
                                                </a>
                                                <p class="line-clamp-2 text-sm text-slate-500">
                                                    {{ Str::limit(html_entity_decode(strip_tags($scienceInformation->content)), 500) }}
                                                </p>
                                            </div>
                                            <div class="tooltip tooltip-top flex items-center gap-2 text-green-700" data-tip="{{ $scienceInformation->publishedAtVi }}">
                                                <x-heroicon-m-calendar class="size-4" />
                                                <span class="text-xs">{{ $scienceInformation->publishedAtVi }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </li>
                        @endforeach
                    </ul>
                    {{ $scienceInformation->links('pagination.web-tailwind') }}
                </div>
                <div class="col-span-8 hidden space-y-3 md:col-span-2 lg:block">
                    <x-website.announcement />
                </div>
            </div>
        </div>
    </section>
</x-website-layout>
