<nav class="sticky top-0 z-50 w-full bg-blue-700 shadow" x-data="{ navOpen: false }">
    <div class="lg:hidden">
        <button @click="navOpen = !navOpen"
            class="hover:bg-denim-600 border-denim-600 focus:shadow-outline flex h-full items-center px-3 py-4 text-white focus:outline-none lg:border-l">
            <x-heroicon-o-bars-3-bottom-left class="size-5" />
        </button>
    </div>
    <div :class="{ 'flex': navOpen, 'hidden': !navOpen }"
        class="mx-auto hidden max-w-7xl flex-col justify-between px-3 sm:px-6 md:items-center lg:flex lg:flex-row lg:px-8">
        <ul class="text-normal flex w-full flex-col text-xs lg:flex-row lg:divide-x-0 lg:divide-y-0 divide-dashed">
            <li class="{{ request()->routeIs('home') ? 'active' : '' }}">
                <a href="{{ route('home') }}"
                    class="flex h-full w-full flex-row items-center justify-start gap-2 py-2 text-center font-semibold uppercase tracking-wider text-white hover:bg-blue-600 focus:outline-none {{ request()->routeIs('home') ? 'bg-blue-600' : '' }}">
                    <span class="lg:border-r border-white px-2">
                        <x-heroicon-o-home class="size-5" />
                    </span>
                </a>
            </li>
            @foreach ($categories as $category)
                <li class="relative flex-row whitespace-nowrap">
                    <x-website.dynamic-menu :category="$category" />
                </li>
            @endforeach
        </ul>
        <div class="flex flex-row gap-3 py-4 lg:py-0">
            <x-heroicon-o-magnifying-glass class="size-5 text-white" />
        </div>
    </div>
</nav>
