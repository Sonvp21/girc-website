<div class="mx-auto mt-2 max-w-7xl px-4 sm:px-2 h-full">
    <div class="row-span-1 w-full h-[70%]">
        <iframe id="videoIframe" class="w-full h-full"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
        </iframe>
    </div>

    <div class="mt-5">
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
                <a href="#" onclick="event.preventDefault(); updateVideoSource('https://www.youtube.com/embed/{{ $video->video_id }}')"
                    class="mx-2 flex h-36 w-52 items-center justify-center overflow-hidden rounded-lg border border-gray-300 bg-white">
                    <img class="w-full h-full" src="{{ $video->getFirstMedia('album_video')->getUrl() }}">
                </a>
            </div>
        @empty
        @endforelse
        @forelse ($googleDriveVideos as $video)
            <div class="carousel-cell">
                <a href="#" onclick="event.preventDefault(); updateVideoSource('https://drive.google.com/file/d/{{ $video->video_id }}/preview')"
                    class="mx-2 flex h-36 w-52 items-center justify-center overflow-hidden rounded-lg border border-gray-300 bg-white">
                    <img class="w-full h-full" src="{{ $video->getFirstMedia('album_video')->getUrl() }}" alt="{{ $video->name }}">
                </a>
            </div>
        @empty
        @endforelse
    </div>
    
        @endif
    </div>

</div>
<script>
    function updateVideoSource(videoUrl) {
        const iframe = document.getElementById('videoIframe');
        iframe.src = videoUrl;
    }
</script>
