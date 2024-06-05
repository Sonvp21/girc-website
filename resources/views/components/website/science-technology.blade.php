<div class="col-span-8 space-y-3 md:col-span-6 lg:col-span-6">
    <x-website.partials.header main="true" title="{{ __('web.science_technology') }}" textAlign="left" />

    @if ($youtubeVideos->isEmpty() && $googleDriveVideos->isEmpty())
        <li class="flex w-full items-start gap-2 py-2">
            <p class="text-xs italic hover:text-red-600">@lang('web.no_data')</p>
        </li>
    @else
        <div class="main-carousel h-36 overflow-hidden p-5 pt-0" data-flickity='{ 
                "autoPlay": true, 
                "pageDots": false, 
                "wrapAround": true, 
                "contain": true, 
                "cellAlign": "left",
                "index": 0
            }'>
            @forelse ($youtubeVideos as $video)
                <div class="carousel-cell">
                    <a title="{{ $video->name }}" onclick="event.preventDefault(); openVideoModal('https://www.youtube.com/embed/{{ $video->video_id }}', '{{ $video->name }}')" class="mx-2 flex h-36 w-52 items-center justify-center overflow-hidden rounded-lg border border-gray-300 bg-white">
                        <img class="h-full w-full" src="{{ $video->getFirstMedia('album_video')->getUrl('photo') }}" alt="{{ $video->name }}">
                    </a>
                </div>
            @empty
            @endforelse
            @forelse ($googleDriveVideos as $video)
                <div class="carousel-cell">
                    <a title="{{ $video->name }}" onclick="event.preventDefault(); openVideoModal('https://drive.google.com/file/d/{{ $video->video_id }}/preview', '{{ $video->name }}')" class="mx-2 flex h-36 w-52 items-center justify-center overflow-hidden rounded-lg border border-gray-300 bg-white">
                        <img class="h-full w-full" src="{{ $video->getFirstMedia('album_video')->getUrl('photo') }}" alt="{{ $video->name }}">
                    </a>
                </div>
            @empty
            @endforelse
        </div>

    @endif

    <dialog id="my_modal_1" class="modal">
        <div class="modal-box relative sm:min-h-fit md:h-[inherit] p-2 min-w-[60%] md:min-h-[80%]">
            @include('components.website.show-video-science-technology')
            <div class="modal-action absolute right-0 top-0">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-[-1rem] focus:border-none focus:outline-none" onclick="closeModal()">X</button>
            </div>
        </div>
    </dialog>

</div>
<script>
    function openVideoModal(videoUrl, videoTitle) {
        const iframe = document.getElementById('videoIframe');
        const titleElement = document.getElementById('videoTitle');
        iframe.src = videoUrl;
        titleElement.textContent = videoTitle;
        document.getElementById('my_modal_1').showModal();
    }


    function closeModal() {
        const iframe = document.getElementById('videoIframe');
        iframe.src = '';
        document.getElementById('my_modal_1').close();
    }
</script>
