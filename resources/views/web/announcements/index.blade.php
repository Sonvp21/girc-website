<x-website-layout>
    <section>
        <div class="mx-auto max-w-7xl px-3 sm:px-6 md:items-center lg:px-8">
            <div class="grid grid-cols-8 gap-4">
                <div class="col-span-8 md:col-span-6 lg:col-span-6">
                    <div class="text-sm breadcrumbs p-4 text-blue-800">
                        <ul>
                            <li>
                                <a class="flex gap-2 items-center" href="{{ route('home') }}">
                                    <x-heroicon-o-home class="size-4" />
                                    Home
                                </a>
                            </li>
                            <li>
                                <a class="flex gap-2 items-center" href="/thong-bao"><svg class="mr-1" xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-megaphone" viewBox="0 0 16 16">
                                    <path d="M13 2.5a1.5 1.5 0 0 1 3 0v11a1.5 1.5 0 0 1-3 0v-.214c-2.162-1.241-4.49-1.843-6.912-2.083l.405 2.712A1 1 0 0 1 5.51 15.1h-.548a1 1 0 0 1-.916-.599l-1.85-3.49-.202-.003A2.014 2.014 0 0 1 0 9V7a2.02 2.02 0 0 1 1.992-2.013 75 75 0 0 0 2.483-.075c3.043-.154 6.148-.849 8.525-2.199zm1 0v11a.5.5 0 0 0 1 0v-11a.5.5 0 0 0-1 0m-1 1.35c-2.344 1.205-5.209 1.842-8 2.033v4.233q.27.015.537.036c2.568.189 5.093.744 7.463 1.993zm-9 6.215v-4.13a95 95 0 0 1-1.992.052A1.02 1.02 0 0 0 1 7v2c0 .55.448 1.002 1.006 1.009A61 61 0 0 1 4 10.065m-.657.975 1.609 3.037.01.024h.548l-.002-.014-.443-2.966a68 68 0 0 0-1.722-.082z"/>
                                  </svg>
                                    @lang('web.announcements')
                                </a>
                            </li>
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
