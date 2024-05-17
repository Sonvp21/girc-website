<x-app-layout>
    <x-slot name="header">
        <h2 class="text-gray-800 text-xl font-semibold leading-tight">
            @lang('admin.photos')
        </h2>
        <div>
            <a class="flex items-center justify-end" href="{{ route('admin.photos.create') }}"><x-heroicon-o-plus-circle
                    class="size-4" />
                @lang('admin.add')
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg" >
                <div class="overflow-x-auto ">
                    <div class="px-6 py-4">
                        <form action="{{ route('admin.photos.index') }}" method="GET">
                            <div class="flex items-center">
                                <input type="text" name="search" placeholder="Search by title"
                                    class="text-gray-800 border-gray-200 mr-0 rounded-l-lg border-b border-l border-t bg-white p-2" />
                                <button type="submit"
                                    class="bg-gray-200 text-gray-800 rounded-r-lg border-b border-r border-t p-2 px-4 font-semibold">
                                    Search
                                </button>
                            </div>
                        </form>
                    </div>

                    <table class="table">
                        <!-- head -->
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('admin.photos.name')</th>
                                <th>@lang('admin.photos.album_name')</th>
                                <th>@lang('admin.photos.created_at')</th>
                                <th>@lang('admin.photos.updated_at')</th>
                                <th>@lang('admin.funtion')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($photos as $photo)
                                <tr>
                                    <th>{{ $startIndex++ }}</th>
                                    <td>{{ $photo->name }}</td>
                                    <td>{{ $photo->album->name }}</td>
                                    <td>{{ $photo->createddAtVi }}</td>
                                    <td>{{ $photo->updatedAtVi }}</td>

                                    <td class="flex gap-3">
                                        <a href="{{ route('admin.photos.edit', $photo->id) }}"><x-heroicon-s-pencil-square
                                                class="size-4 text-green-600" /></a>
                                        <form id="delete-form-{{ $photo->id }}"
                                            action="{{ route('admin.photos.destroy', ['photo' => $photo->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="confirmDelete({{ $photo->id }})">
                                                <x-heroicon-o-trash class="size-4 text-red-500" />
                                            </button>
                                        </form>

                                        <script>
                                            function confirmDelete(photoId) {
                                                if (confirm('Are you sure you want to delete this photo?')) {
                                                    document.getElementById('delete-form-' + photoId).submit()
                                                }
                                            }
                                        </script>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $photos->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
