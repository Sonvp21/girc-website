<div class="col-span-8 space-y-3 md:col-span-6 lg:col-span-6">
    <x-website.partials.header main="true" title="{{ __('web.science_technology') }}" textAlign="left" />

    @if ($youtubeVideos->isEmpty() && $googleDriveVideos->isEmpty())
        <li class="flex w-full items-start gap-2 py-2">
            <p class="text-xs italic hover:text-red-600">@lang('web.no_data')</p>
        </li>
    @else
        <div class="main-carousel h-36 overflow-hidden p-5 pt-0"
            data-flickity='{ 
                "autoPlay": true, 
                "pageDots": false, 
                "wrapAround": true, 
                "contain": true, 
                "cellAlign": "left",
                "index": 0
            }'>
            @forelse ($youtubeVideos as $video)
                <div class="carousel-cell">
                    <a href="" target="_blank"
                        class="mx-2 flex h-36 w-52 items-center justify-center overflow-hidden rounded-lg border border-gray-300 bg-white">
                        <img class="w-full h-full" src="{{ $video->getFirstMedia('album_video')->getUrl() }}" alt="{{ $video->name }}">
                    </a>
                </div>
            @empty
            @endforelse
            @forelse ($googleDriveVideos as $video)
                <div class="carousel-cell">
                    <a href="" target="_blank"
                        class="mx-2 flex h-36 w-52 items-center justify-center overflow-hidden rounded-lg border border-gray-300 bg-white">
                        <img class="w-full h-full" src="{{ $video->getFirstMedia('album_video')->getUrl() }}" alt="{{ $video->name }}">
                    </a>
                </div>
            @empty
            @endforelse
        </div>
    @endif
</div>
