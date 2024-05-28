<x-app-layout>
    <div class="p-6">
        <div class="text-normal font-semibold leading-tight text-gray-800">
            <span class="text-normal flex items-center gap-2 font-semibold leading-tight text-gray-800">
                @lang('admin.scienceinformation')
            </span>
        </div>
        <x-admin.alerts.success />
        <div class="mt-6">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto">
                    <div class="flex px-6 py-4">
                        <form action="{{ route('admin.scienceinformation.index') }}" method="GET" class="w-full">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <label class="input input-bordered flex items-center gap-2">
                                        <input name="search" type="text" class="grow" placeholder="Search by title" style="border: unset" value="{{ request()->search }}" />
                                        <button type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="h-4 w-4 opacity-70">
                                                <path fill-rule="evenodd" d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </label>
                                </div>
                                <a class="btn-ghosdt btn" href="{{ route('admin.scienceinformation.create') }}">
                                    <x-heroicon-s-plus class="size-4" />
                                    <span>@lang('admin.add')</span>
                                </a>
                            </div>
                        </form>
                    </div>
                    <table class="table">
                        <!-- head -->
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('admin.scienceinformation.title')</th>
                                <th>@lang('admin.published_at')</th>
                                <th>@lang('admin.updated_at')</th>
                                <th>@lang('admin.scienceinformation.keep_on_top')</th>
                                <th>@lang('admin.funtion')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($scienceInformations as $scienceinformation)
                                <tr>
                                    <th>{{ $scienceInformations->firstItem() + $loop->index }}</th>
                                    <td>{{ app()->getLocale() === 'en' ? $scienceinformation->title_en : $scienceinformation->title }}</td>
                                    <td>{{ $scienceinformation->publishedAtVi }}</td>
                                    <td>{{ $scienceinformation->updatedAtVi }}</td>
                                    <td style="color: {{ $scienceinformation->keep_on_top == 0 ? 'red' : 'green' }}">
                                        {{ $scienceinformation->keep_on_top == 0 ? 'Chưa phê duyệt' : 'Đã phê duyệt' }}
                                    </td>
                                    <td class="flex gap-3">
                                        <a href="{{ route('admin.scienceinformation.edit', $scienceinformation->id) }}"><x-heroicon-s-pencil-square class="size-4 text-green-600" /></a>
                                        <form id="delete-form-{{ $scienceinformation->id }}" action="{{ route('admin.scienceinformation.destroy', $scienceinformation) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="confirmDelete({{ $scienceinformation->id }})">
                                                <x-heroicon-o-trash class="size-4 text-red-500" />
                                            </button>
                                        </form>

                                        <script>
                                            function confirmDelete(scienceinforId) {
                                                if (confirm('Are you sure you want to delete this scienceinfor?')) {
                                                    document.getElementById('delete-form-' + scienceinforId).submit()
                                                }
                                            }
                                        </script>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="mt-4">
            {{ $scienceInformations->links('pagination.web-tailwind') }}
        </div>
    </div>
</x-app-layout>
