<div class="col-span-8 space-y-3 md:col-span-6 lg:col-span-6">
    <x-website.partials.header main="true" title="{{ __('web.cooperation') }}" textAlign="left" />
    @unless ($cooperations->isEmpty())
        <div class="main-carousel h-36 overflow-hidden border-b-8 border-blue-500 bg-gray-200 p-5" data-flickity='{ 
                "autoPlay": true, 
                "pageDots": false, 
                "wrapAround": true, 
                "contain": true, 
                "cellAlign": "left",
                "index": 0
            }'>
            @foreach ($cooperations as $cooperation)
                <div class="carousel-cell">
                    <a href="{{ $cooperation->link_website }}" target="_blank" class="mx-2 flex h-24 w-36 items-center justify-center overflow-hidden rounded-lg border border-gray-300 bg-white">
                        <img src="{{ $cooperation->getFirstMedia('album_cooperation')->getUrl('lg') }}" alt="{{ $cooperation->name }}">
                    </a>
                </div>
            @endforeach
        </div>
    @endunless

</div>
