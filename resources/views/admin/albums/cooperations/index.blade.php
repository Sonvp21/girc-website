<x-app-layout>
    <x-slot name="header">
        <h2 class="text-gray-800 text-xl font-semibold leading-tight">
            @lang('admin.cooperations')
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto">
                    <div class="px-6 py-4 flex">
                        <form action="{{ route('admin.cooperations.index') }}" method="GET">
                            <div class="flex items-center">
                                <input type="text" name="search" placeholder="Search by title"
                                    class="text-gray-800 border-gray-200 mr-0 rounded-l-lg border-b border-l border-t bg-white p-2" />
                                <button type="submit"
                                    class="bg-gray-200 text-gray-800 rounded-r-lg border-b border-r border-t p-2 px-4 font-semibold">
                                    Search
                                </button>
                            </div>
                        </form>
                        <div class="ml-auto self-center">
                            <a class="flex items-center justify-end"
                                href="{{ route('admin.cooperations.create') }}"><x-heroicon-o-plus-circle
                                    class="size-4" />
                                @lang('admin.add')
                            </a>
                        </div>
                    </div>

                    <table class="table">
                        <!-- head -->
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('admin.cooperations.name')</th>
                                <th>@lang('admin.cooperations.album_name')</th>
                                <th>@lang('admin.created_at')</th>
                                <th>@lang('admin.updated_at')</th>
                                <th>@lang('admin.funtion')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cooperations as $cooperation)
                                <tr>
                                    <th>{{ $startIndex++ }}</th>
                                    <td>
                                        <a target="_blank"
                                            href="{{ Str::startsWith($cooperation->link_website, ['http://', 'https://']) ? $cooperation->link_website : 'http://' . $cooperation->link_website }}">
                                            {{ $cooperation->name }}
                                        </a>
                                    </td>
                                    <td>{{ $cooperation->album->name }}</td>
                                    <td>{{ $cooperation->createddAtVi }}</td>
                                    <td>{{ $cooperation->updatedAtVi }}</td>

                                    <td class="flex gap-3">
                                        <a href="{{ route('admin.cooperations.edit', $cooperation->id) }}"><x-heroicon-s-pencil-square
                                                class="size-4 text-green-600" /></a>
                                        <form id="delete-form-{{ $cooperation->id }}"
                                            action="{{ route('admin.cooperations.destroy', ['cooperation' => $cooperation->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="confirmDelete({{ $cooperation->id }})">
                                                <x-heroicon-o-trash class="size-4 text-red-500" />
                                            </button>
                                        </form>

                                        <script>
                                            function confirmDelete(cooperationId) {
                                                if (confirm('Are you sure you want to delete this cooperation?')) {
                                                    document.getElementById('delete-form-' + cooperationId).submit()
                                                }
                                            }
                                        </script>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $cooperations->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
