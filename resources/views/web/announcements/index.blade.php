<x-website-layout>
    <section>
        <div class="mx-auto max-w-7xl px-3 sm:px-6 md:items-center lg:px-8">
            <div class="grid grid-cols-8 gap-4">
                <div class="col-span-8 md:col-span-6 lg:col-span-6">
                    <div class="text-sm breadcrumbs py-4 text-blue-800">
                        <ul>
                            <x-website.breadcrumbs/>
                            <x-website.breadcrumbs :route="route('announcements.index')" :name="__('web.announcements')" />
                        </ul>
                    </div>
                    <div class="bg-gradient-to-r from-blue-400 via-blue-500 via-70% to-red-500 h-0.5"></div>
                    <ul class="mt-5">
                        @foreach ($announcements as $announcement)
                            <li class="flex border-b border-dashed border-yellow-500 py-4">
                                <article class="group w-full">
                                    <div class="flex gap-3">
                                        <div class="gap float-left mr-2 divide-y divide-blue-200 rounded-lg bg-[#fd9f1b] shadow-calendar">
                                            <div class="flex-none whitespace-nowrap py-0.5 text-center text-[0.6rem] font-bold text-white">
                                                <span class="px-2">{{ $announcement->published_at->format('n/Y') }}</span>
                                                <div class="w-full border-b border-dashed border-[#f37303]"></div>
                                            </div>
                                            <div class="flex h-auto flex-col border-b-2 border-red-500 bg-white text-center text-slate-700">
                                                <span class="relative top-0.5 text-base font-bold leading-3">{{ $announcement->published_at->translatedFormat('d') }}</span>
                                                <span class="h-4 text-[0.5rem] font-bold capitalize text-[#fd9f1b]">{{ $announcement->published_at->translatedFormat('l') }}</span>
                                            </div>
                                        </div>
                                        <h3 class="line-clamp-3 h-12 text-justify font-normal leading-4 tracking-normal text-blue-950 hover:text-red-500">
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
