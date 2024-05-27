<div class="bg-gray-100">
    <x-website.partials.header title="{{ __('web.extra_curricular_activities') }}" />
    <div class="">
        <div class="h-44">
            <div class="h-full" style="text-align: -webkit-center;">
                @if ($latestVideo)
                    <a href="" target="_blank"
                        class="mx-2 h-full flex items-center justify-center overflow-hidden rounded-lg border border-gray-300 bg-white">
                        <img class="w-full h-full" src="{{ $latestVideo->getFirstMedia('album_video')->getUrl() }}"
                            alt="{{ $latestVideo->name }}">
                    </a>
                @else
                    <p class="text-xs italic hover:text-red-600">@lang('web.no_data')</p>
                @endif
            </div>
        </div>
    </div>
</div>
