<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            @lang('admin.post')
        </h2>
        <div>
            <a class="flex items-center justify-end" href="{{ route('admin.posts.create') }}"><x-heroicon-o-plus-circle
                    class="size-4" />@lang('admin.add')</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="table">
                        <!-- head -->
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('admin.post.title')</th>
                                <th>@lang('admin.post.category_of')</th>
                                <th>@lang('admin.post.published_at')</th> {{-- ngày đăng --}}
                                <th>@lang('admin.post.updated_at')</th> {{-- ngày cập nhật --}}
                                <th>@lang('admin.funtion')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <th>{{ $post->id }}</th>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->category->title }}</td>
                                    <td>{{ $post->published_at }}</td>
                                    <td>{{ $post->updated_at }}</td>

                                    <td class="flex gap-3">
                                        <a href="{{ route('admin.posts.edit', $post->id) }}"><x-heroicon-s-pencil-square
                                                class="size-4 text-green-600" /></a>
                                        <a href=""><x-heroicon-o-trash class="size-4 text-red-500" /></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
