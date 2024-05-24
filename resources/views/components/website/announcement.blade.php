<div @class(['mt-5' => !request()->routeIs('home')])>
    <x-website.partials.header title="<a href='{{ route('announcements.index') }}' class='text-red-500'>{{ __('web.announcement_home') }}</a>" paddingTop="0" textColor="text-red-500" />
    <ul class="flex h-auto flex-col divide-y divide-solid divide-gray-300 overflow-scroll overflow-y-auto overscroll-contain border border-slate-200 bg-gray-100 px-4 text-sm scrollbar-hide">
        @foreach ($announcements as $announcement)
            <li class="gap-2 py-4 text-xs">
                <div class="gap float-left mr-2 divide-y divide-blue-200 bg-yellow-400 text-red-500">
                    <div class="h-4 w-12 whitespace-nowrap text-center text-[10px]">
                        @lang('web.month')
                        {{ $announcement->published_at->translatedFormat('m') }}
                    </div>
                    <div class="text h-8 w-12 text-center text-xl font-extrabold">{{ $announcement->published_at->translatedFormat('d') }}</div>
                </div>
                <h3 class="line-clamp-3 h-12 text-justify font-normal leading-4 tracking-normal text-gray-500">
                    {{ $announcement->title }}
                </h3>
            </li>
        @endforeach
    </ul>
</div>
