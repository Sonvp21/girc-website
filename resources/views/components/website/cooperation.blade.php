<div class="col-span-8 space-y-3 md:col-span-6 lg:col-span-6">
    <x-website.partials.header main="true" title="{{ __('web.cooperation') }}" textAlign="left" />
    <div class="main-carousel border-b-8 border-blue-500 bg-gray-200 p-5" data-flickity='{ "autoPlay": true, "wrapAround": true, "pageDots": false, "isWrapped": true }'>
        @for ($i = 0; $i < 14; $i++)
            <div class="carousel-cell">
                <div class="mx-2 flex h-24 w-36 items-center justify-center rounded-lg border border-gray-300 bg-white p-4">
                    <x-heroicon-o-photo class="size-14 text-blue-100" />
                </div>
            </div>
        @endfor
        </ul>
    </div>
</div>
