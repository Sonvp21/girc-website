<div>
    <x-website.partials.header title="{{ __('web.digital_transformation') }}" />
    <div class="mt-2.5">
        <div class="h-40 bg-white">
            @if ($latestVideo)
                <a title="{{ $latestVideo->name }}" onclick="event.preventDefault(); openVideoModalDigital('https://drive.google.com/file/d/{{ $latestVideo->video_id }}/preview', '{{ $latestVideo->name }}')" class="flex items-center justify-center overflow-hidden bg-white">
                    <img class="h-full w-full" src="{{ $latestVideo->getFirstMedia('album_video')->getUrl() }}" alt="{{ $latestVideo->name }}">
                </a>
            @else
                <p class="text-xs italic hover:text-red-600">@lang('web.no_data')</p>
            @endif
        </div>

        <ul class="divide-y divide-solid px-2 mt-3">
            @if ($youtubeVideos->isEmpty() && $googleDriveVideos->isEmpty())
                <li class="flex w-full items-start gap-2 py-2">
                    <p class="text-xs italic hover:text-red-600">@lang('web.no_data')</p>
                </li>
            @else
                @forelse ($youtubeVideos as $video)
                    <li class="flex w-full items-center gap-2 py-2">
                        <a class="flex items-center" title="{{ $video->name }}" onclick="event.preventDefault(); openVideoModalDigital('https://www.youtube.com/embed/{{ $video->video_id }}', '{{ $video->name }}')"><x-heroicon-o-play-circle class="size-5 flex-none" />
                            <p class="ml-1 line-clamp-1 text-xs">{{ $video->name }}</p>
                        </a>

                    </li>
                @empty
                @endforelse
                @forelse ($googleDriveVideos as $video)
                    <li class="flex w-full items-center gap-2 py-2">
                        <a class="flex items-center" title="{{ $video->name }}" onclick="event.preventDefault(); openVideoModalDigital('https://drive.google.com/file/d/{{ $video->video_id }}/preview', '{{ $video->name }}')">
                            <x-heroicon-o-play-circle class="size-5 flex-none" />
                            <p class="ml-1 line-clamp-1 text-xs">{{ $video->name }}</p>
                        </a>

                    </li>
                @empty
                @endforelse
            @endif

            <dialog id="my_modal_3" class="modal">
                <div class="modal-box relative min-w-[60%] p-2 sm:min-h-fit md:h-[inherit] md:min-h-[80%]">
                    @include('components.website.show-video-digital')
                    <div class="modal-action absolute right-0 top-0">
                        <button class="btn btn-outline btn-error mr-3 mt-[-14px] h-fit min-h-fit rounded-full p-2" onclick="closeModalDigital()">X</button>
                    </div>
                </div>
            </dialog>
        </ul>
    </div>
</div>
<script>
    function openVideoModalDigital(videoUrlIframeDigital, videoTitleDigital) {
        const iframe = document.getElementById('videoIframeDigital');
        const titleElement = document.getElementById('videoTitleDigital');
        iframe.src = videoUrlIframeDigital;
        titleElement.textContent = videoTitleDigital;
        document.getElementById('my_modal_3').showModal();
    }

    function closeModalDigital() {
        const iframe = document.getElementById('videoIframeDigital');
        iframe.src = '';
        document.getElementById('my_modal_3').close();
    }
</script>
