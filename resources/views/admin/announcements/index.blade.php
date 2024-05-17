<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            @lang('admin.announcements')
        </h2>
        <div>
            <a
                class="flex items-center justify-end"
                href="{{ route('admin.announcements.create') }}"
                ><x-heroicon-o-plus-circle class="size-4" />
                @lang('admin.add')
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto">
                    <div class="py-4 px-6">
                        <form action="{{ route('admin.announcements.index') }}" method="GET">
                            <div class="flex items-center">
                                <input type="text" name="search" placeholder="Search by title" class="rounded-l-lg p-2 border-t mr-0 border-b border-l text-gray-800 border-gray-200 bg-white" />
                                <button type="submit" class="px-4 rounded-r-lg bg-gray-200 text-gray-800 font-semibold p-2 border-t border-b border-r">Search</button>
                            </div>
                        </form>
                    </div>
                    <table class="table">
                        <!-- head -->
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('admin.announcement.title')</th>
                                <th>@lang('admin.announcement.created_at')</th>
                                {{-- ngày đăng --}}
                                <th>@lang('admin.announcement.updated_at')</th>
                                {{-- ngày cập nhật --}}
                                <th>@lang('admin.funtion')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($announcements as $announcement)
                                <tr>
                                    <th>{{ $startIndex++ }}</th>
                                    <td>{{ $announcement->title }}</td>
                                    <td>{{ $announcement->publishedAtVi }}</td>
                                    <td>{{ $announcement->updatedAtVi }}</td>

                                    <td class="flex gap-3">
                                        <a href="{{ route('admin.announcements.edit', $announcement->id) }}"
                                            ><x-heroicon-s-pencil-square class="size-4 text-green-600"
                                        /></a>
                                        <form
                                            id="delete-form-{{ $announcement->id }}"
                                            action="{{ route('admin.announcements.destroy', ['announcement' => $announcement->id]) }}"
                                            method="POST"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                type="button"
                                                onclick="confirmDelete({{ $announcement->id }})"
                                            >
                                                <x-heroicon-o-trash class="size-4 text-red-500" />
                                            </button>
                                        </form>

                                        <script>
                                            function confirmDelete(announcementId) {
                                                if (confirm('Are you sure you want to delete this announcement?')) {
                                                    document.getElementById('delete-form-' + announcementId).submit()
                                                }
                                            }
                                        </script>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $announcements->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
