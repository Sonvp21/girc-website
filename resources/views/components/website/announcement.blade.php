<div @class(['mt-5' => !request()->routeIs('home')])>
    <x-website.partials.header title="<a href='{{ route('announcements.index') }}' class='text-red-500'>{{ __('web.announcement_home') }}</a>" paddingTop="0" textColor="text-red-500" />
    <ul class="flex h-auto flex-col divide-y divide-solid overflow-scroll overflow-y-auto overscroll-contain border border-slate-200 px-4 text-sm scrollbar-hide">
        @foreach ($announcements as $announcement)
            <li>
                <a href="{{ route('announcements.show', $announcement) }}" class="inline-block gap-2 py-4 text-xs hover:text-red-600">
                    <div class="gap float-left mr-2 divide-y divide-blue-200 overflow-hidden rounded-lg bg-[#fd9f1b] shadow-calendar">
                        <div class="flex-none whitespace-nowrap py-0.5 text-center text-[0.6rem] font-bold text-white">
                            <span class="px-2">{{ $announcement->published_at->format('n/Y') }}</span>
                            <div class="w-full border-b border-dashed border-[#f37303]"></div>
                        </div>
                        <div class="flex h-auto flex-col border-b-2 border-red-500 bg-white text-center ">
                            <span class="relative top-0.5 text-base font-bold leading-3">{{ $announcement->published_at->translatedFormat('d') }}</span>
                            <span class="h-4 text-[0.5rem] font-bold capitalize text-[#fd9f1b]">{{ $announcement->published_at->translatedFormat('l') }}</span>
                        </div>
                    </div>
                    <h3 class="line-clamp-3 h-12 text-sm text-justify font-normal leading-4 tracking-normal">
                        {{ $announcement->title }}
                    </h3>
                </a>
            </li>
        @endforeach
    </ul>
</div>
