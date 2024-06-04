<x-website-layout>
    <section>
        <div class="mx-auto max-w-7xl px-3 sm:px-6 md:items-center lg:px-8">
            <div class="grid grid-cols-8 gap-4">
                <div class="col-span-8 space-y-3 md:col-span-6 lg:col-span-6">
                    <div>
                        <div class="flex">
                            <div class="text-sm breadcrumbs py-4 text-blue-800 flex">
                                <ul>
                                    @php
                                        $route =
                                            $category->posts->count() > 1
                                                ? route('categories.posts.index', $category)
                                                : '#';
                                    @endphp
                                    <x-website.breadcrumbs :route="$route" :name="$category" />

                                </ul>

                            </div>
                            <ul class="self-center text-sm breadcrumbs py-4 text-blue-800 flex">
                                @if ($siblingCategories->count() > 0)
                                    <span class="mx-2">|</span>
                                    @foreach ($siblingCategories as $siblingCategory)
                                        <li class="inline">
                                            @php
                                                $firstPostSlug = $siblingCategory->posts->first()->slug ?? 'no-data';
                                                $route =
                                                    $firstPostSlug === 'no-data'
                                                        ? route('categories.posts.no_data', [
                                                            'category' => $siblingCategory->slug,
                                                        ])
                                                        : route('categories.posts.show', [
                                                            'category' => $siblingCategory->slug,
                                                            'post' => $firstPostSlug,
                                                        ]);
                                            @endphp
                                            <a href="{{ $route }}">
                                                {{ app()->getLocale() === 'en' ? $siblingCategory->title_en : $siblingCategory->title }}
                                            </a>
                                        </li>
                                        @if (!$loop->last)
                                            <span class="mx-2">|</span>
                                        @endif
                                    @endforeach
                                @endif
                            </ul>
                        </div>

                        <div class="bg-gradient-to-r from-blue-400 via-blue-500 via-70% to-red-500 h-0.5"></div>
                    </div>
                    @if ($posts->count() > 0)
                        <ul class="space-y-4">
                            @foreach ($posts as $post)
                                <li>
                                    <article class="group">
                                        <div class="flex gap-3">
                                            <a href="{{ route('categories.posts.show', ['category' => $category->slug, 'post' => $post->slug]) }}"
                                                class="h-32 w-48 flex-none overflow-hidden">
                                                <img class="h-auto w-full transition-all group-hover:scale-110"
                                                    src="{{ $post->getFirstMedia('featured_image')->getUrl('thumb') }}"
                                                    alt="" />
                                            </a>
                                            <div class="flex flex-col items-start justify-between">
                                                <div>
                                                    <a href="{{ route('categories.posts.show', ['category' => $category->slug, 'post' => $post->slug]) }}"
                                                        class="group-hover:underline">
                                                        <h3
                                                            class="line-clamp-2 text-lg font-semibold leading-5 text-blue-950">
                                                            {{ app()->getLocale() === 'en' && !empty($post->title_en) ? $post->title_en : $post->title }}</h3>
                                                    </a>
                                                    <p class="mt-2 line-clamp-3 text-sm text-slate-500">
                                                        {!! Str::limit(html_entity_decode(strip_tags( app()->getLocale() === 'en' && !empty($post->content_en) ? $post->content_en : $post->content )), 500) !!}
                                                    </p>
                                                </div>
                                                <div class="tooltip tooltip-top flex items-center gap-2 text-green-700"
                                                    data-tip="{{ $post->published_post_date }}">
                                                    <x-heroicon-m-calendar class="size-4" />
                                                    <span class="text-xs">{{ $post->published_post_date_thumb }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                </li>
                            @endforeach
                        </ul>
                        {{ $posts->links('pagination.web-tailwind') }}
                    @else
                        <p>@lang('web.no_data')</p>
                    @endif
                </div>
                <div class="col-span-8 hidden space-y-3 md:col-span-2 lg:block">
                    <x-website.announcement />
                </div>
            </div>
        </div>
    </section>
</x-website-layout>
