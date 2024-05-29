@if ($category->children->isNotEmpty())
    <li class="relative flex-row whitespace-nowrap {{ request()->is('categories/' . $category->slug) || request()->is('categories/' . $category->slug . '/*') ? 'active' : '' }}"
        x-data="{ dropdownOpen: false }" @mouseover.away="dropdownOpen = false">
        <div class="flex {{ request()->is('categories/' . $category->slug) || request()->is('categories/' . $category->slug . '/*') ? 'bg-blue-600 text-white' : 'hover:bg-blue-600 hover:text-white' }}" :class="{ 'bg-black bg-opacity-20': dropdownOpen }">
            <button
                class="flex h-full w-full flex-row items-center justify-between gap-2 py-4 text-center font-semibold uppercase tracking-wider text-white focus:outline-none"
                @mouseover="dropdownOpen = true">
                <span class="flex w-full justify-between gap-2 border-white px-2 lg:w-auto lg:justify-start {{ $isChild ? '' : 'lg:border-r' }}">
                    {{ $category->title }}
                    <x-heroicon-c-chevron-down class="size-4" />
                </span>
            </button>
        </div>
        <div class="hidden origin-top-left bg-gray-200 shadow-md md:w-auto lg:absolute"
            :class="{ 'block': dropdownOpen, 'hidden': !dropdownOpen }">
            <ul
                class="text-black divide-gray-200 origin-top-left divide-y divide-dashed whitespace-nowrap bg-white w-auto">
                @foreach ($category->children as $child)
                    <x-website.dynamic-menu :category="$child" isChild="true" />
                @endforeach
            </ul>
        </div>
    </li>
@else
    <li class="{{ request()->is('categories/' . $category->slug) || request()->is('categories/' . $category->slug . '/*') ? ($isChild ? 'active bg-gray-100 text-black' : 'active bg-blue-600 text-white') : ($isChild ? 'hover:bg-gray-200 hover:text-black' : 'hover:bg-blue-600 hover:text-white') }}">
        <a href="{{ $link }}"
            class="flex h-full items-center justify-start py-4 font-semibold uppercase tracking-wider {{ $isChild ? 'text-black' : 'text-white' }}" style="background-color: inherit;">
            <span class="{{ $isChild ? 'text-black normal-case font-sans' : 'lg:border-r text-white font-roboto' }} border-white px-2">{{ $category->title }}</span>
        </a>
    </li>
@endif

