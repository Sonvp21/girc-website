<aside class="w-80 flex-none overflow-y-auto bg-blue-700">
    <div class="h-auto items-end border-blue-950 text-white">
        <h1 class="sticky top-0 flex items-center divide-x bg-blue-900 p-3 shadow">
            <span class="font-roboto text-xl font-extrabold tracking-wider">GIRC</span>
            <span class="text-blue-500">Administration panel</span>
        </h1>

        <div class="p-2">
            <ul class="menu w-full rounded-box">
                <li><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
                <li>
                    <details @if (request()->routeIs('admin.categories.index', 'admin.posts.index')) open @endif
                        class="{{ request()->routeIs('admin.categories.index', 'admin.posts.index') ? 'active' : '' }}">
                        <summary>@lang('admin.posts')</summary>
                        <ul>
                            <li>
                                <a class="{{ request()->routeIs('admin.categories.index') ? 'active' : '' }}"
                                    href="{{ route('admin.categories.index') }}">@lang('admin.categories')</a>
                            </li>
                            <li>
                                <a class="{{ request()->routeIs('admin.posts.index') ? 'active' : '' }}"
                                    href="{{ route('admin.posts.index') }}">@lang('admin.posts')</a>
                            </li>
                        </ul>
                    </details>

                </li>

                <li>
                    <a href="{{ route('admin.announcements.index') }}">@lang('admin.announcements')</a>
                </li>
                <li>
                    <details @if (request()->routeIs('admin.albums.index', 'admin.photos.index', 'admin.videos.index', 'admin.cooperations.index')) open @endif
                        class="{{ request()->routeIs( 'admin.albums.index', 'admin.photos.index', 'admin.videos.index', 'admin.cooperations.index', ) ? 'open' : '' }}">
                        <summary>@lang('admin.album')</summary>
                        <ul>
                            <li>
                                <a class="{{ request()->routeIs('admin.albums.index') ? 'active' : '' }}"
                                    href="{{ route('admin.albums.index') }}"> @lang('admin.albums.all')</a>
                            </li>
                            <li>
                                <a class="{{ request()->routeIs('admin.photos.index') ? 'active' : '' }}"
                                    href="{{ route('admin.photos.index') }}"> @lang('admin.photos.all')</a>
                            </li>
                            <li>
                                <a class="{{ request()->routeIs('admin.videos.index') ? 'active' : '' }}"
                                    href="{{ route('admin.videos.index') }}"> @lang('admin.videos.all')</a>
                            </li>
                            <li>
                                <a class="{{ request()->routeIs('admin.cooperations.index') ? 'active' : '' }}"
                                    href="{{ route('admin.cooperations.index') }}"> @lang('admin.cooperations.all')</a>
                            </li>
                        </ul>
                    </details>
                </li>
                <li>
                    <a href="{{ route('admin.contacts.index') }}">@lang('admin.contacts')</a>
                </li>
                <li>
                    <a href="{{ route('admin.faqs.index') }}">@lang('admin.faqs')</a>
                </li>
            </ul>
        </div>
    </div>
</aside>
