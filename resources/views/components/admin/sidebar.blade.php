<aside class="bg-blue-700 w-80 flex-none overflow-y-auto">
        <div class="h-auto items-end  border-blue-950 text-white">
            <h1 class="sticky top-0 shadow flex divide-x items-center  bg-blue-900 p-3">
                <span class="font-extrabold font-roboto tracking-wider text-xl">GIRC</span>
                <span class="text-blue-500">Administration panel</span>
            </h1>
            <div class="p-2">
                <ul class="menu  w-full rounded-box">
                    <li><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
                    <li><a href="{{ route('admin.categories.index') }}">@lang('admin.categories')</a></li>
                    <li><a href="{{ route('admin.posts.index') }}">@lang('admin.posts')</a></li>
                    <li><a href="{{ route('admin.announcements.index') }}">@lang('admin.announcements')</a></li>
                    <li>
                        <details>
                            <summary>@lang('admin.albums')</summary>
                            <ul>
                                <li><a href="{{ route('admin.albums.index') }}"> @lang('admin.albums.all')</a></li>
                                <li><a href="{{ route('admin.photos.index') }}"> @lang('admin.photos.all')</a></li>
                                <li><a href="{{ route('admin.videos.index') }}"> @lang('admin.videos.all')</a></li>
                            </ul>
                        </details>
                    </li>
                    <li><a href="{{ route('admin.contacts.index') }}">@lang('admin.contacts')</a></li>
                </ul>
            </div>
        </div>
    </aside>
