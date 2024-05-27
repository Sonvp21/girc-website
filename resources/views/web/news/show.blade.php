<x-website-layout>
    <section>
        <div class="mx-auto max-w-7xl px-3 sm:px-6 md:items-center lg:px-8">
            <div class="grid grid-cols-8 gap-4">
                <div class="col-span-8 md:col-span-6 lg:col-span-6">
                    <div>
                        <div class="text-sm breadcrumbs p-4 text-blue-800">
                            <ul>
                                <li>
                                    <a href="{{ route('home') }}">
                                        <x-heroicon-o-home class="size-5" />
                                        Home
                                    </a>
                                </li>

                                <li>
                                    <a><x-heroicon-o-folder
                                            class="size-5" />
                                        {{ app()->getLocale() === 'en' ? $post->category->title_en : $post->category->title }}
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="{{ route('news.show', $post) }}">
                                        <x-heroicon-o-folder-open class="size-5" />
                                        {{ Str::limit($post->title, 100) }}
                                    </a>
                                </li>

                            </ul>
                        </div>
                        <div class="bg-gradient-to-r from-blue-400 via-blue-500 via-70% to-red-500 h-0.5"></div>
                    </div>
                    <article class="group">
                        <div class="tooltip tooltip-top flex items-center gap-2 text-green-700"
                            data-tip="{{ $post->published_post_date }}">
                            <x-heroicon-m-calendar class="size-4" />
                            <span class="text-xs">{{ $post->published_post_date_thumb }}</span>
                        </div>
                        <h2 class="text-2xl font-bold">{{ $post->title }}</h2>
                        <div class="">
                            {!! $post->content !!}
                        </div>
                    </article>
                    <div class="flex items-center gap-2">
                        <div class="flex items-center gap-1">
                            <x-heroicon-o-tag class="size-4" />
                            <span class="text-sm font-bold">@lang('web.post_tags')</span>
                        </div>
                        <ul class="flex items-center gap-2">
                            @foreach ($post->tags as $tag)
                                <li>
                                    <a href="#" class="btn btn-xs">{{ $tag->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-span-8 hidden space-y-3 md:col-span-2 lg:block">
                    <x-website.announcement />
                </div>
            </div>
        </div>
    </section>
</x-website-layout>
