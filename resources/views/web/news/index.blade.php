<x-website-layout>
    <section>
        <div class="mx-auto max-w-7xl px-3 sm:px-6 md:items-center lg:px-8">
            <div class="grid grid-cols-8 gap-4 overflow-hidden">
                <div class="col-span-8 space-y-3 md:col-span-6 lg:col-span-6">
                    <div class="border-b-2 border-blue-700">
                        <h2 class="bg-blue-700 inline-block text-white px-6 font-bold text-xl py-3">@lang('web.news_events')</h2>
                    </div>
                    <ul class="space-y-4">
                        @foreach($posts as $post)
                            <li>
                                <article class="group">
                                    <div class="flex gap-3">
                                        <a href="{{ route('news.show', $post) }}" class="w-48 h-32 overflow-hidden flex-none">
                                            <img class="w-full h-auto group-hover:scale-110 transition-all" src="{{ $post->getFirstMedia('featured_image')->getUrl('thumb') }}" alt="">
                                        </a>
                                        <div class="flex flex-col justify-between items-start">
                                            <div>
                                                <a href="{{ route('news.show', $post) }}" class="group-hover:underline">
                                                    <h3 class="font-semibold text-lg text-blue-950 line-clamp-2 leading-5">{{ $post->title }}</h3>
                                                </a>
                                                <p class="text-sm text-slate-500 line-clamp-3 mt-2">{{ Str::limit(html_entity_decode(strip_tags($post->content)), 500) }}</p>
                                            </div>
                                            <div
                                                class="text-green-700 tooltip tooltip-top items-center gap-2 flex"
                                                data-tip="{{ $post->published_post_date }}"
                                            >
                                                <x-heroicon-m-calendar class="size-4"/>
                                                <span class="text-xs">{{ $post->published_post_date_thumb }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </li>
                        @endforeach
                    </ul>
                    {{ $posts->links('pagination.web-tailwind') }}
                </div>
                <div class="col-span-8 hidden space-y-3 md:col-span-2 lg:block">
                    <x-website.announcement />
                </div>
            </div>
        </div>
    </section>
</x-website-layout>
