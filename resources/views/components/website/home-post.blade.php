<div>
    <div class="grid h-auto grid-cols-5 gap-2">
        <a
            href="#"
            class="group col-span-5 flex md:col-span-3"
        >
            <article>
                <figure>
                    <div class="bg-red-500 relative">
                        <img class="w-full h-auto" src="{{ $latestPost->getFirstMedia('featured_image')->getUrl('lg') }}" alt="">
                        <div class="text-xs flex w-fit items-center gap-2 text-white p-2 bg-green-700 absolute right-0 bottom-0">
                            <x-heroicon-m-calendar class="size-4"/>
                            <span>{{ $latestPost->published_post_date }}</span>
                        </div>
                    </div>
                    <h2 class="py-2 text-justify font-roboto text-xl font-extrabold tracking-tight text-green-700 group-hover:text-blue-800 line-clamp-2 h-20">
                        {{ $latestPost->title }}
                    </h2>
                </figure>

                <p class="text-justify font-roboto font-normal leading-5 text-slate-500 line-clamp-6">
                    {{ Str::limit(html_entity_decode(strip_tags($latestPost->content)), 500) }}
                </p>
            </article>
        </a>
        <div class="col-span-5 md:col-span-2 flex flex-col justify-between">
            <div class="flex items-center gap-2 border-x-4 border-green-700 bg-white px-4 py-3 font-semibold uppercase text-green-700">
                <x-heroicon-o-newspaper class="size-5" />
                <span>@lang('web.news_events')</span>
            </div>
            <div class="mt-2 h-auto space-y-3">
                @foreach ($posts as $post)
                    <div
                        class="block"
                        href="#"
                    >
                        <article>
                            <figure class="relative flex rounded-t-xl">
                                <a
                                    href=""
                                    class="h-20 w-28 flex-none overflow-hidden"
                                >
                                    <img
                                        class="h-auto w-auto"
                                        src="{{ $post->getFirstMedia('featured_image')->getUrl('md') }}"
                                        alt=""
                                    />
                                </a>
                                <figcaption class="w-full px-3 text-sm">
                                    <div class="">
                                        <a
                                            href=""
                                            class="hover:text-rose-600 line-clamp-3 leading-5"
                                        >{{ $post->title }}</a>
                                        <div class="text-green-700 flex justify-between gap-2 pt-2 text-xs">
                                            <a
                                                href="#"
                                                class="text-xs hover:underline"
                                            >{{ $post->category->title }}</a
                                            >
                                            <div class="flex items-center gap-2 tooltip tooltip-left "  data-tip="{{ $post->published_post_date }}">
                                                <span class="text-xs">{{ $post->published_post_date_thumb }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </figcaption>
                            </figure>
                        </article>
                    </div>
                @endforeach
            </div>
            <div class="mt-4 text-center w-full">
                <a class="flex justify-center w-full border-green-800 bg-green-700 text-white py-3 text-sm font-bold hover:shadow-lg hover:bg-green-800" href="#">@lang('web.show_more_posts')</a>
            </div>
        </div>
    </div>
</div>
