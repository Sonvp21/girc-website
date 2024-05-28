<div class="mx-auto mt-2 max-w-7xl px-4 sm:px-2 h-[63%] sm:h-[63%]">
    <div class="bg-blue-800 inline-block relative py-2 px-4">
        <svg fill="currentColor" class="absolute -right-[3rem] top-0 z-0 h-10 text-blue-700 transform scale-y-[-1]"
            xmlns="http://www.w3.org/2000/svg" shape-rendering="geometricPrecision" text-rendering="geometricPrecision"
            viewBox="0 0 120 36">
            <path d="M77.103718 36C98.551859 36 98.551859 0 120 0H42.896282C21.448141 0 21.448141 36 0 36h77.103718Z">
            </path>
        </svg>
        <h3 class="relative z-20 text-white uppercase whitespace-nowrap">@lang('web.study_space')</h3>
    </div>
    <div class="row-span-1 h-full">
        <iframe id="videoIframeStudy" class="w-full h-full"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
        </iframe>
        <p id="videoTitleStudy" class="text-lg font-semibold text-gray-800"></p>
    </div>

    <div class="mt-10">
        @if ($youtubeVideos->isEmpty() && $googleDriveVideos->isEmpty())
            <li class="flex w-full items-start gap-2 py-2">
                <p class="text-xs italic hover:text-red-600">@lang('web.no_data')</p>
            </li>
        @else
            <div class="main-carousel h-36 overflow-hidden p-5 pt-0"
                data-flickity='{ 
            "pageDots": false, 
            "wrapAround": true, 
            "contain": true, 
            "cellAlign": "left",
            "index": 0
        }'>
                @forelse ($youtubeVideos as $video)
                    <div class="carousel-cell">
                        <a title="{{ $video->name }}"
                            onclick="event.preventDefault(); updateVideoSourceIframeStudy('https://www.youtube.com/embed/{{ $video->video_id }}', '{{ $video->name }}')"
                            class="mx-2 flex h-36 w-52 items-center justify-center overflow-hidden rounded-lg border border-gray-300 bg-white">
                            <img class="w-full h-full" src="{{ $video->getFirstMedia('album_video')->getUrl() }}">
                        </a>
                    </div>
                @empty
                @endforelse
                @forelse ($googleDriveVideos as $video)
                    <div class="carousel-cell">
                        <a title="{{ $video->name }}"
                            onclick="event.preventDefault(); updateVideoSourceIframeStudy('https://drive.google.com/file/d/{{ $video->video_id }}/preview', '{{ $video->name }}')"
                            class="mx-2 flex h-36 w-52 items-center justify-center overflow-hidden rounded-lg border border-gray-300 bg-white">
                            <img class="w-full h-full" src="{{ $video->getFirstMedia('album_video')->getUrl() }}"
                                alt="{{ $video->name }}">
                        </a>
                    </div>
                @empty
                @endforelse
            </div>

        @endif
    </div>

</div>
<script>
    function updateVideoSourceIframeStudy(videoUrlIframeStudy, videoTitleStudy) {
        const iframe = document.getElementById('videoIframeStudy');
        const titleElement = document.getElementById('videoTitleStudy');
        iframe.src = videoUrlIframeStudy;
        titleElement.textContent = videoTitleStudy;
    }
</script>
