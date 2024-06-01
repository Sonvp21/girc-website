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
            <div x-data="searchComponent()" x-cloak>
                <x-heroicon-o-magnifying-glass class="size-5 text-white cursor-pointer" @click="open = true" />
                <style>
                    [x-cloak] {
                    display: none;
                }
                </style>
                <div x-show="open" class="fixed inset-0 flex items-center justify-center z-50" x-cloak>
                    <div class="bg-black bg-opacity-50 absolute inset-0" @click="open = false"></div>
                    <div class="bg-white p-8 rounded shadow-lg relative z-10 w-1/2">
                        <button class="absolute top-2 right-2" @click="open = false">&times;</button>
                        <h2 class="text-lg font-bold mb-4">@lang('web.website_search')</h2>
                        <form @submit.prevent="performSearch">
                            <input type="text" name="query" x-model="query" placeholder="Search..." required
                                class="w-full p-2 border rounded mb-4" @input.debounce.500ms="performSearch">
                        </form>
                        <!-- Kết quả tìm kiếm sẽ được hiển thị tại đây -->
                        <div class="mt-4 h-64 overflow-y-auto">
                            <h3 class="text-lg font-bold">@lang('web.website_search_result')</h3>
                            <template x-if="results.length > 0">
                                <ul>
                                    <template x-for="result in results" :key="result.id">
                                        <li class="my-2 flex items-start">
                                            <x-heroicon-o-chevron-double-right class="size-3 mr-2 mt-1" />
                                            <div class="flex flex-col">
                                                <a :href="result.url" x-text="result.title"
                                                    class="text-blue-500 text-sm line-clamp-2 overflow-hidden text-ellipsis"></a>
                                                <small x-text="result.type"></small>
                                            </div>
                                        </li>
                                    </template>
                                </ul>
                            </template>
                            <template x-if="results.length === 0">
                                <p class="text-gray-500">@lang('web.no_results_found')</p>
                            </template>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                function searchComponent() {
                    return {
                        open: false,
                        query: '',
                        results: [],
                        performSearch() {
                            if (this.query.trim() === '') {
                                this.results = [];
                                return;
                            }

                            fetch('{{ route('search.index') }}?query=' + this.query)
                                .then(response => response.json())
                                .then(data => {
                                    this.results = data.map(result => {
                                        result.type = result.searchable_type.includes('Post') ? '(post)' :
                                            '(announcement)';
                                        return result;
                                    });
                                })
                                .catch(error => {
                                    console.error('Error fetching search results:', error);
                                });
                        }
                    };
                }
            </script>
        </div>



    </div>
</nav>
