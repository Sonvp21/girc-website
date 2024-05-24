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
                    <ul class="mt-10">
                        @foreach ($announcements as $announcement)
                            <li class="flex border-b border-red-500 border-dashed">
                                <span class="pt-1"><x-heroicon-c-chevron-double-right class="h-4 w-4"/> </span>
                                <article class="group">
                                    <div class="flex gap-3">
                                        <div class="flex flex-col items-start justify-between">
                                            <div>
                                                <a href="{{ route('announcements.show', $announcement) }}" class="group-hover:underline">
                                                    <h3 class="line-clamp-2 text-lg font-semibold leading-relaxed text-blue-950 ">
                                                        {{ $announcement->title }}
                                                    </h3>
                                                </a>
                                            </div>
                                            <span class="text-xs ml-auto">{{ $announcement->published_at }}</span>
                                        </div>
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
