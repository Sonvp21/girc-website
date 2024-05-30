<div class="h-full">
    <div class="grid h-auto grid-cols-5 gap-2">
        <div class="group col-span-5 flex md:col-span-3">
            <a href="" id="featured-route" class="w-full">
                <article id="featured-post" class="w-full">
                    <figure class="w-full">
                        <div class="relative overflow-hidden bg-white h-[362px] w-full">
                            <img id="featured-image"
                                class="h-full w-full transition-all group-hover:scale-105 object-cover" src=""
                                alt="" />
                            <h2 id="featured-title"
                                class="w-full absolute bottom-0 right-0 flex items-center justify-center gap-2 bg-white/70 text-normal uppercase text-black px-6 py-4 text-center">
                            </h2>
                        </div>
                    </figure>
                </article>
            </a>
        </div>

        <div class="col-span-5 flex flex-col justify-between md:col-span-2">
            <div>
                <x-website.partials.header :link="route('categories.posts.index', $latestPost->category)" title="{{ __('web.news_events') }}" textAlign="left"
                    paddingTop="0" textColor="text-red-500" />
                <div class="divide-y divide-solid divide-gray-300 h-full">
                    @foreach ($posts as $post)
                        <a class="py-[0.55rem] pl-[0.55rem] inline-block hover-post"
                            href="{{ route('categories.posts.show', [
                                'category' => $post->category,
                                'post' => $post,
                            ]) }}"
                            data-href="{{ route('categories.posts.show', [
                                'category' => $post->category,
                                'post' => $post,
                            ]) }}"
                            data-title="{{ $post->title }}"
                            data-image="{{ $post->getFirstMedia('featured_image')->getUrl('lg') }}">
                            <article class="h-16 flex items-center">
                                <figure class="group relative flex rounded-t-xl">
                                    <div class="h-auto w-20 flex-none overflow-hidden">
                                        <img class="h-full w-full transition-all object-cover"
                                            src="{{ $post->getFirstMedia('featured_image')->getUrl('thumb') }}"
                                            alt="{{ $post->title }}" />
                                    </div>

                                    <figcaption class="w-full px-3 text-sm">
                                        <div
                                            class="text-blue-700 hover:text-red-600 line-clamp-3 leading-5 text-sm text-justify">
                                            {{ $post->title }}
                                            @if (strlen($post->title) < 100)
                                                <p class="contents">
                                                    :{{ Str::limit(html_entity_decode(strip_tags($post->content)), 200) }}
                                                </p>
                                            @endif
                                        </div>
                                    </figcaption>
                                </figure>
                            </article>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .current-post {
        background-color: #dbeafe;
        position: relative;
    }

    .current-post::before {
        content: '';
        position: absolute;
        left: -18px;
        top: 50%;
        transform: translateY(-50%);
        width: 0;
        height: 0;
        border-left: 10px solid transparent;
        border-right: 10px solid #0d50a7;
        border-top: 10px solid transparent;
        border-bottom: 10px solid transparent;
        margin-right: 10px;
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const hoverPosts = document.querySelectorAll('.hover-post');
        const featuredImage = document.getElementById('featured-image');
        const featuredTitle = document.getElementById('featured-title');
        const featuredRoute = document.getElementById('featured-route');
        let currentIndex = 0;

        function updateFeaturedPost(index) {
            const post = hoverPosts[index];
            const newTitle = post.getAttribute('data-title');
            const newImage = post.getAttribute('data-image');
            const newRoute = post.getAttribute('data-href');

            featuredImage.src = newImage;
            featuredTitle.textContent = newTitle;
            featuredRoute.href = newRoute;

            hoverPosts.forEach(p => p.classList.remove('current-post'));

            post.classList.add('current-post');
        }

        if (hoverPosts.length > 0) {
            updateFeaturedPost(currentIndex);

            setInterval(() => {
                currentIndex = (currentIndex + 1) % hoverPosts.length;
                updateFeaturedPost(currentIndex);
            }, 3000);
        }
    });
</script>
