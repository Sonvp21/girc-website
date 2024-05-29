<x-app-layout>
    <div class="p-6">
        <div class="text-gray-800 text-normal font-semibold leading-tight">
            <span class="text-gray-800 text-normal flex items-center gap-2 font-semibold leading-tight">
                @lang('admin.applies')
            </span>
        </div>
        <x-admin.alerts.success />

        <div class="mt-6">

            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto">
                    <div class="flex px-6 py-4">
                        <form action="{{ route('admin.applies.index') }}" method="GET" class="w-full">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <label class="input input-bordered flex items-center gap-2">
                                        <input name="search" type="text" class="grow" placeholder="Search by name"
                                            style="border: unset" value="{{ request()->search }}" />
                                        <button type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"
                                                fill="currentColor" class="h-4 w-4 opacity-70">
                                                <path fill-rule="evenodd"
                                                    d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>

                                    </label>
                                </div>
                                <div>
                                    {{-- <a class="btn-ghosdt btn" href="{{ route('admin.applies.create') }}">
                                        <x-heroicon-s-plus class="size-4" />
                                        <span>@lang('admin.add')</span>
                                    </a> --}}
                                    <a class="btn btn-accent" href="{{ url('/export-applies') }}">
                                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M48 448V64c0-8.8 7.2-16 16-16H224v80c0 17.7 14.3 32 32 32h80V448c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16zM64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V154.5c0-17-6.7-33.3-18.7-45.3L274.7 18.7C262.7 6.7 246.5 0 229.5 0H64zm90.9 233.3c-8.1-10.5-23.2-12.3-33.7-4.2s-12.3 23.2-4.2 33.7L161.6 320l-44.5 57.3c-8.1 10.5-6.3 25.5 4.2 33.7s25.5 6.3 33.7-4.2L192 359.1l37.1 47.6c8.1 10.5 23.2 12.3 33.7 4.2s12.3-23.2 4.2-33.7L222.4 320l44.5-57.3c8.1-10.5 6.3-25.5-4.2-33.7s-25.5-6.3-33.7 4.2L192 280.9l-37.1-47.6z"/></svg>
                                        <span>@lang('admin.export_excel')</span>
                                    </a>
                                </div>

                            </div>
                        </form>
                    </div>

                    <table class="table">
                        <!-- head -->
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('admin.applies.name')</th>
                                <th>@lang('admin.applies.phone')</th>
                                <th>@lang('admin.applies.email')</th>
                                <th>@lang('admin.applies.school')</th>
                                <th>@lang('admin.applies.major')</th>
                                <th>@lang('admin.applies.question')</th>
                                <th>@lang('admin.applies.created_at')</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($applies as $apply)
                                <tr>
                                    <th>{{ $applies->firstItem() + $loop->index }}</th>
                                    <td>{{ $apply->name }}</td>
                                    <td>{{ $apply->phone }}</td>
                                    <td>{{ $apply->email }}</td>
                                    <td>{{ $apply->school }}</td>
                                    <td>@lang('admin.' . $apply->major)</td>
                                    <td class="cursor-pointer"
                                        onclick="document.getElementById('modal_{{ $apply->id }}').showModal()">
                                        {{ Str::limit($apply->question, 50) }}
                                    </td>
                                    <dialog id="modal_{{ $apply->id }}" class="modal">
                                        <div class="modal-box">
                                            <form method="dialog">
                                                <button
                                                    class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2 focus:border-none focus:outline-none"
                                                    onclick="document.getElementById('modal_{{ $apply->id }}').close()">✕</button>
                                            </form>
                                            <h3 class="font-bold text-lg">@lang('admin.applies.question')</h3>
                                            <p class="py-4">{{ $apply->question }}</p>
                                        </div>
                                    </dialog>
                                    <td>{{ $apply->createdAtVi }}</td>

                                    <td class="flex gap-3">
                                        <form id="delete-form-{{ $apply->id }}"
                                            action="{{ route('admin.applies.destroy', ['apply' => $apply->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="confirmDelete({{ $apply->id }})">
                                                <x-heroicon-o-trash class="size-4 text-red-500" />
                                            </button>
                                        </form>

                                        <script>
                                            function confirmDelete(applyId) {
                                                if (confirm('Are you sure you want to delete this apply?')) {
                                                    document.getElementById('delete-form-' + applyId).submit()
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
            {{ $applies->links('pagination.web-tailwind') }}
        </div>
    </div>
</x-app-layout>
