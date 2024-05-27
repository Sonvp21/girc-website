<div>
    <x-website.partials.header title="{{ __('web.digital_transformation') }}" />
    <div class="">
        <div class="h-40 bg-white" style="text-align: -webkit-center;">
            @if ($latestVideo)
                <a href="" target="_blank"
                    class="mx-2 flex items-center justify-center overflow-hidden rounded-lg border border-gray-300 bg-white">
                    <img class="w-full h-full" src="{{ $latestVideo->getFirstMedia('album_video')->getUrl() }}"
                        alt="{{ $latestVideo->name }}">
                </a>
            @else
                <p class="text-xs italic hover:text-red-600">@lang('web.no_data')</p>
            @endif
        </div>
        
        <ul class="divide-y divide-solid px-2">
            @if ($youtubeVideos->isEmpty() && $googleDriveVideos->isEmpty())
                <li class="flex w-full items-start gap-2 py-2">
                    <p class="text-xs italic hover:text-red-600">@lang('web.no_data')</p>
                </li>
            @else
                @forelse ($youtubeVideos as $video)
                    <li class="flex items-center gap-2 w-full py-2">
                        <x-heroicon-o-play-circle class="size-5 flex-none" />
                        <p class="line-clamp-1 text-xs">{{ $video->name }}</p>
                    </li>
                @empty
                @endforelse
                @forelse ($googleDriveVideos as $video)
                    <li class="flex items-center gap-2 w-full py-2">
                        <x-heroicon-o-play-circle class="size-5 flex-none" />
                        <p class="line-clamp-1 text-xs">{{ $video->name }}</p>
                    </li>
                @empty
                @endforelse
            @endif
        </ul>
    </div>
</div>
