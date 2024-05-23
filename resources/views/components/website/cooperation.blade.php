<div class="col-span-8 space-y-3 md:col-span-6 lg:col-span-6">
    <x-website.partials.header main="true" title="{{ __('web.cooperation') }}" textAlign="left" />
    <ul class="flex gap-2 bg-gray-200 border-b-4 border-blue-500 px-6 overflow-x-auto">
        @for($i = 0; $i < 10; $i++)
            <li class="rounded-lg w-full flex items-center justify-center">
                <x-heroicon-o-photo class="size-18 text-white"/>
            </li>
        @endfor
    </ul>
</div>
