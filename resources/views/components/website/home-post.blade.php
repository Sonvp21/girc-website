<div>
    <div class="grid h-auto grid-cols-5 gap-2">
        @if ($posts->isNotEmpty())
            <a href="{{ route('news.show', $latestPost) }}" class="group col-span-5 flex md:col-span-3">
                <article>
                    <figure>
                        <div class="relative overflow-hidden bg-white h-[347px]">
                            <img class="h-auto w-full transition-all group-hover:scale-105"
                                src="{{ $latestPost->getFirstMedia('featured_image')->getUrl('lg') }}" alt="" />
                            <h2
                                class="w-full absolute bottom-0 right-0 flex items-center justify-center gap-2 bg-white/70 text-normal uppercase text-black px-6 py-4 text-center">
                                {{ $latestPost->title }}
                            </h2>
                        </div>
                    </figure>
                </article>
            </a>
        @endif
        <div class="col-span-5 flex flex-col justify-between md:col-span-2">
            <div>
                <x-website.partials.header title="{{ __('web.news_events') }}" textAlign="left" paddingTop="0"
                    textColor="text-red-500" />
                <div class="h-auto divide-y divide-solid divide-gray-300">
                    @foreach ($posts as $post)
                        @unless ($loop->first)
                            <a class="py-2 inline-block" href="{{ route('news.show', $post) }}">
                                <article class="h-16 flex items-center">
                                    <figure class="group relative flex rounded-t-xl">
                                        <div href="{{ route('news.show', $post) }}"
                                            class="h-auto w-20 flex-none overflow-hidden">
                                            <img class="h-auto w-auto transition-all group-hover:scale-105"
                                                src="{{ $post->getFirstMedia('featured_image')->getUrl('thumb') }}"
                                                alt="{{ $post->title }}" />
                                        </div>
                                        <figcaption class="w-full px-3 text-sm">
                                            <div
                                                class="text-blue-700 hover:text-red-600 line-clamp-3 leading-5 text-xs text-justify">
                                                {{ $post->title }}
                                                @if (strlen($post->title) < 150)
                                                    <p>
                                                        :{{ Str::limit(html_entity_decode(strip_tags($post->content)), 200) }}
                                                    </p>
                                                @endif
                                            </div>

                                        </figcaption>
                                    </figure>
                                </article>
                            </a>
                        @endunless
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
