<aside class="w-80 flex-none overflow-y-auto bg-blue-700">
    <div class="h-auto items-end border-blue-950 text-white">
        <h1 class="sticky top-0 flex items-center divide-x bg-blue-900 p-3 shadow">
            <span class="font-roboto text-xl font-extrabold tracking-wider">GIRC</span>
            <span class="text-blue-500">Administration panel</span>
        </h1>

        <div class="p-2">
            <ul class="menu w-full rounded-box">
                <li><a href="{{ route('dashboard') }}">@lang('admin.dashboard')</a></li>
                <li>
                    <a @class([
                        'active' => request()->routeIs('admin.announcements.*'),
                    ]) href="{{ route('admin.announcements.index') }}">
                        @lang('admin.announcements')
                    </a>
                </li>
                <li>
                    <a @class([
                        'active' => request()->routeIs('admin.science-information.*'),
                    ]) href="{{ route('admin.science-information.index') }}">
                        @lang('admin.science-information')
                    </a>
                </li>
                <li>
                    <details @if (request()->routeIs('admin.categories.*', 'admin.posts.*')) open @endif class="{{ request()->routeIs('admin.categories.*', 'admin.posts.*') ? 'active' : '' }}">
                        <summary>@lang('admin.categories')</summary>
                        <ul class="menu">
                            <li>
                                <a class="{{ request()->routeIs('admin.categories.index') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">
                                    @lang('admin.categories.list')
                                </a>
                            </li>
                            @foreach ($categories as $category)
                                <x-admin.sidebar.category :category="$category" />
                            @endforeach
                        </ul>
                    </details>
                </li>

                <li>
                    <details @if (request()->routeIs('admin.albums.*', 'admin.photos.*', 'admin.videos.*')) open @endif class="{{ request()->routeIs('admin.albums.*', 'admin.photos.*', 'admin.videos.*') ? 'open' : '' }}">
                        <summary>@lang('admin.album')</summary>
                        <ul>
                            <li>
                                <a class="{{ request()->routeIs('admin.albums.*') ? 'active' : '' }}" href="{{ route('admin.albums.index') }}">
                                    @lang('admin.albums.all')
                                </a>
                            </li>
                            <li>
                                <a class="{{ request()->routeIs('admin.photos.*') ? 'active' : '' }}" href="{{ route('admin.photos.index') }}">
                                    @lang('admin.photos.all')
                                </a>
                            </li>
                            <li>
                                <a class="{{ request()->routeIs('admin.videos.*') ? 'active' : '' }}" href="{{ route('admin.videos.index') }}">
                                    @lang('admin.videos.all')
                                </a>
                            </li>

                        </ul>
                    </details>
                </li>
                <li>
                    <a class="{{ request()->routeIs('admin.staffs.*') ? 'active' : '' }}" href="{{ route('admin.staffs.index') }}">
                        @lang('admin.staffs.list')
                    </a>
                </li>
                <li>
                    <a class="{{ request()->routeIs('admin.cooperations.*') ? 'active' : '' }}" href="{{ route('admin.cooperations.index') }}">
                        @lang('admin.cooperations.all')
                    </a>
                </li>
                <li>
                    <a @class([
                        'active' => request()->routeIs('admin.contacts.*'),
                    ]) href="{{ route('admin.contacts.index') }}">
                        @lang('admin.contacts')
                    </a>
                </li>
                <li>
                    <a @class([
                        'active' => request()->routeIs('admin.faqs.*'),
                    ]) href="{{ route('admin.faqs.index') }}">
                        @lang('admin.faqs')
                    </a>
                </li>
            </ul>
        </div>
    </div>
</aside>
