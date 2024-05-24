<div class="bg-gray-100">
    <x-website.partials.header title="{{ __('web.science_information') }}" />
    <div class="">
        <ul class="divide-y divide-solid px-2">
            @foreach ($scienceinfors as $scienceinfor)
                <li class="flex items-start gap-2 w-full py-2">
                    <svg class="size-4 flex-none text-blue-700 mt-1" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="9 11 12 14 22 4"></polyline>
                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                    </svg>
                    <p class="line-clamp-3 text-xs hover:text-red-600">
                        <a href="">{{ $scienceinfor->title }}</a></p>
                </li>
            @endforeach

        </ul>
    </div>
</div>
