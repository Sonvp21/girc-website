@php
    if (!function_exists('isCategorySelected')) {
        function isCategorySelected($category, $slug): bool
        {
            if ($category->slug == $slug) {
                return true;
            }

            foreach ($category->children as $child) {
                if (isCategorySelected($child, $slug)) {
                    return true;
                }
            }

            return false;
        }
    }
@endphp

@if ($category->children->isNotEmpty())
    <li class="relative flex-row whitespace-nowrap" x-data="{ dropdownOpen: false }" @mouseover.away="dropdownOpen = false">
        <div class="flex hover:bg-blue-800 hover:text-white" :class="{ 'bg-black bg-opacity-20': dropdownOpen }">
            <button class="flex h-full w-full flex-row items-center justify-between gap-2 py-4 text-center font-semibold uppercase tracking-wider text-white focus:outline-none" @mouseover="dropdownOpen = true">
                <span class="lg:border-r flex w-full justify-between gap-2 border-white px-2 lg:w-auto lg:justify-start">
                   {{ $category->title }}
                    <x-heroicon-c-chevron-down class="size-4" />
                </span>
            </button>
        </div>
        <div class="hidden w-full origin-top-left bg-white shadow-md md:w-auto lg:absolute" :class="{ 'block': dropdownOpen, 'hidden': !dropdownOpen }">
            <ul class="text-denim-600 divide-denim-400 w-full origin-top-left divide-y divide-dashed whitespace-nowrap bg-white">
                @foreach ($category->children as $child)
                    <x-website.dynamic-menu :category="$child" isChild="true" />
                @endforeach
            </ul>
        </div>
    </li>
@else
    @if($isChild)
        <li class="hover:bg-black hover:bg-opacity-5">
            <a href="" class="flex items-center justify-start space-x-2 px-2 py-4 text-slate-800" >
                {{ $category->title }}
            </a>
        </li>
    @else
        <li>
            <a href="#" class="flex h-full items-center justify-start py-4 font-semibold uppercase tracking-wider text-white hover:bg-blue-800 hover:text-white">
                <span class="lg:border-r border-white px-2">{{ $category->title }}</span>
            </a>
        </li>
    @endif
@endif
