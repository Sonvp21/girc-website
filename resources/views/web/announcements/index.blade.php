<x-website-layout>
    <section>
        <div class="mx-auto max-w-7xl px-3 sm:px-6 md:items-center lg:px-8">
            <div class="grid grid-cols-8 gap-4">
                <div class="col-span-8 md:col-span-6 lg:col-span-6">
                    <div class="border-b-2 border-blue-700">
                        <h2 class="inline-block bg-blue-700 px-6 py-3 text-xl font-bold text-white">
                            @lang('web.announcements')
                        </h2>
                    </div>
                    <ul class="mt-5 ">
                        @foreach ($announcements as $announcement)
                            <li class="flex border-b border-yellow-500 border-dashed py-4">
                                <article class="group w-full">
                                    <div class="flex gap-3 ">
                                        <div class="gap float-left mr-2 divide-y divide-blue-200 bg-yellow-400 text-red-500">
                                            <div class="h-4 w-12 whitespace-nowrap text-center text-[10px]">
                                                @lang('web.month')
                                                {{ $announcement->published_at->translatedFormat('m') }}
                                            </div>
                                            <div class="text h-8 w-12 text-center text-xl font-extrabold">{{ $announcement->published_at->translatedFormat('d') }}</div>
                                        </div>
                                        <h3 class="line-clamp-3 h-12 font-normal leading-4 tracking-normal text-blue-950 hover:text-red-500 text-justify">
                                            <a href="{{ route('announcements.show', $announcement) }}">{{ $announcement->title }}</a>
                                        </h3>
                                        
                                    </div>
                                </article>
                            </li>
                        @endforeach
                    </ul>
                    
                    {{ $announcements->links('pagination.web-tailwind') }}
                </div>
                <div class="col-span-8 hidden space-y-3 md:col-span-2 lg:block">
                    <x-website.announcement />
                </div>
            </div>
        </div>
    </section>
</x-website-layout>
