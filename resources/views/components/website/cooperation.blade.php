<div class="col-span-8 space-y-3 md:col-span-6 lg:col-span-6">
    <x-website.partials.header main="true" title="{{ __('web.cooperation') }}" textAlign="left" />
    <ul class="flex flex-nowrap gap-2 py-5 bg-gray-200 border-b-8 border-blue-500 px-6 overflow-x-auto">
        @for($i = 0; $i < 14; $i++)
            <li class="rounded-lg flex items-center justify-center">
                <div class="p-4 rounded-lg bg-white border border-gray-300 h-24 w-36 flex items-center justify-center">
                    <x-heroicon-o-photo class="size-14 text-blue-100"/>
                </div>
            </li>
        @endfor
    </ul>
</div>
