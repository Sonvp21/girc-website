<x-app-layout>
    <div class="p-6">
        <div class="text-gray-800 text-normal font-semibold leading-tight">
            <span class="text-gray-800 text-normal flex items-center gap-2 font-semibold leading-tight">
                @lang('admin.contacts')
            </span>
        </div>
        <div class="mt-6">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto">
                    <div class="px-6 py-4 flex">
                        <form action="{{ route('admin.contacts.index') }}" method="GET">
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
                                href="{{ route('admin.contacts.create') }}"><x-heroicon-o-plus-circle class="size-4" />
                                @lang('admin.add')
                            </a>
                        </div>
                    </div>

                    <table class="table">
                        <!-- head -->
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('admin.contacts.name')</th>
                                <th>@lang('admin.contacts.email')</th>
                                <th>@lang('admin.contacts.phone')</th>
                                <th>@lang('admin.contacts.read_at')</th>
                                {{-- ngày xem --}}
                                <th>@lang('admin.contacts.created_at')</th>
                                {{-- ngày gửi --}}
                                <th>@lang('admin.funtion')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contacts as $contact)
                                <tr>
                                    <th>{{ $contacts->firstItem() + $loop->index }}</th>
                                    <td>{{ $contact->name }}</td>
                                    <td>{{ $contact->email }}</td>
                                    <td>{{ $contact->phone }}</td>
                                    <td>{{ $contact->read_at }}</td>
                                    <td>{{ $contact->createdAtVi }}</td>

                                    <td class="flex gap-3">
                                        <a href="{{ route('admin.contacts.edit', $contact->id) }}"><x-heroicon-s-pencil-square
                                                class="size-4 text-green-600" /></a>
                                        <a href="{{ route('admin.contacts.show', $contact->id) }}"><x-heroicon-o-eye
                                                class="size-4 text-green-600" /></a>
                                        <form id="delete-form-{{ $contact->id }}"
                                            action="{{ route('admin.contacts.destroy', ['contact' => $contact->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="confirmDelete({{ $contact->id }})">
                                                <x-heroicon-o-trash class="size-4 text-red-500" />
                                            </button>
                                        </form>

                                        <script>
                                            function confirmDelete(contactId) {
                                                if (confirm('Are you sure you want to delete this contact?')) {
                                                    document.getElementById('delete-form-' + contactId).submit()
                                                }
                                            }
                                        </script>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $contacts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
