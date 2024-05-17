<x-app-layout>
    <x-slot name="header">
        <h2 class="text-gray-800 text-xl font-semibold leading-tight">
            @lang('admin.albums')
        </h2>
        <div>
            <a
                class="flex items-center justify-end"
                href="{{ route('admin.albums.create') }}"
                ><x-heroicon-o-plus-circle class="size-4" />
                @lang('admin.add')
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto">
                    <div class="px-6 py-4">
                        <form
                            action="{{ route('admin.albums.index') }}"
                            method="GET"
                        >
                            <div class="flex items-center">
                                <input
                                    type="text"
                                    name="search"
                                    placeholder="Search by title"
                                    class="text-gray-800 border-gray-200 mr-0 rounded-l-lg border-b border-l border-t bg-white p-2"
                                />
                                <button
                                    type="submit"
                                    class="bg-gray-200 text-gray-800 rounded-r-lg border-b border-r border-t p-2 px-4 font-semibold"
                                >
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
                                <th>@lang('admin.albums.name')</th>
                                <th>@lang('admin.albums.created_at')</th>
                                <th>@lang('admin.albums.updated_at')</th>
                                <th>@lang('admin.funtion')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($albums as $album)
                                <tr>
                                    <th>{{ $startIndex++ }}</th>
                                    <td>{{ $album->name }}</td>
                                    <td>{{ $album->createddAtVi }}</td>
                                    <td>{{ $album->updatedAtVi }}</td>

                                    <td class="flex gap-3">
                                        <a href="{{ route('admin.albums.edit', $album->id) }}"
                                            ><x-heroicon-s-pencil-square class="size-4 text-green-600"
                                        /></a>
                                        <form
                                            id="delete-form-{{ $album->id }}"
                                            action="{{ route('admin.albums.destroy', ['album' => $album->id]) }}"
                                            method="POST"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                type="button"
                                                onclick="confirmDelete({{ $album->id }})"
                                            >
                                                <x-heroicon-o-trash class="size-4 text-red-500" />
                                            </button>
                                        </form>

                                        <script>
                                            function confirmDelete(albumId) {
                                                if (confirm('Are you sure you want to delete this album?')) {
                                                    document.getElementById('delete-form-' + albumId).submit()
                                                }
                                            }
                                        </script>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $albums->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
