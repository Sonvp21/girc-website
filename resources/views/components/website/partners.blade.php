<div>
    <h2 class="font-semibold text-green-700">@lang('web.partners')</h2>
    <p class="mb-4 mt-3 text-4xl font-extrabold">@lang('web.partners_title')</p>
    <p class="mb-6 text-slate-500">@lang('web.partners_text')</p>
    <ul class="grid grid-cols-4 gap-5 py-5 backdrop-blur">
        @foreach ($cooperations as $cooperation)
            <li class="flex items-center justify-center">
            <a target="__blank" href="{{ $cooperation->link_website }}">
                <figure class="flex flex-col items-center">
                    <img class="size-36 rounded-full"
                        src="{{ $cooperation && $cooperation->hasMedia('album_cooperation') ? $cooperation->getFirstMedia('album_cooperation')->getUrl('lg') : 'default-image-path.jpg' }}"
                        alt="{{ $cooperation && $cooperation->hasMedia('album_cooperation') ? $cooperation->getFirstMedia('album_cooperation')->name : 'Default Image' }}"
                    />
                    {{-- <figcaption class="mt-4 text-center text-sm font-bold text-blue-700">
                        {{ $cooperation->name }}
                    </figcaption> --}}
                </figure>
            </a>
        </li>
        @endforeach
    </ul>
</div>
