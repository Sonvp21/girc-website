<div class="col-span-8 space-y-3 md:col-span-6 lg:col-span-6">
    <x-website.partials.header main="true" title="{{ __('web.science_technology') }}" textAlign="left" />

    @if ($youtubeVideos->isEmpty() && $googleDriveVideos->isEmpty())
        <li class="flex w-full items-start gap-2 py-2">
            <p class="text-xs italic hover:text-red-600">@lang('web.no_data')</p>
        </li>
    @else
        <ul class="video-list">
            @forelse ($youtubeVideos as $video)
                <li class="video-item">
                    <iframe src="https://www.youtube.com/embed/{{ $video->video_id }}"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </li>
            @empty
            @endforelse

            @forelse ($googleDriveVideos as $video)
                <li class="video-item">
                    <iframe src="https://drive.google.com/file/d/{{ $video->video_id }}/preview"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </li>
            @empty
            @endforelse
        </ul>
    @endif
</div>
