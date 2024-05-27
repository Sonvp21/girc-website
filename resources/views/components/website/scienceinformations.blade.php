<div class="bg-gray-100">
    <x-website.partials.header title="<a href='{{ route('scienceinformation.index') }}' class='text-red-500'>{{ __('web.science_information') }}</a>" textColor="text-red-500" />
    <div class="">
        <ul class="divide-y divide-solid px-2">
            @forelse($scienceinformations as $scienceinformation)
                <li class="flex w-full items-start gap-2 py-2">
                    <svg class="size-4 mt-1 flex-none text-blue-700" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="9 11 12 14 22 4"></polyline>
                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                    </svg>
                    <p class="line-clamp-3 text-xs hover:text-red-600">
                        <a href="{{ route('scienceinformation.show', $scienceinformation) }}">{{ $scienceinformation->title }}</a>
                    </p>
                </li>
            @empty
                <li class="flex w-full items-start gap-2 py-2">
                    <p class="text-xs italic hover:text-red-600">@lang('web.no_data')</p>
                </li>
            @endforelse
        </ul>
    </div>
</div>
