<x-app-layout>
    <x-slot name="header">
        <h2 class="text-gray-800 text-xl font-semibold leading-tight">
            @lang('admin.faqs')
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto">
                    <div class="px-6 py-4 flex">
                        <form action="{{ route('admin.faqs.index') }}" method="GET">
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
                                href="{{ route('admin.faqs.create') }}"><x-heroicon-o-plus-circle class="size-4" />
                                @lang('admin.add')
                            </a>
                        </div>
                    </div>

                    <table class="table">
                        <!-- head -->
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('admin.faqs.name')</th>
                                <th>@lang('admin.faqs.email')</th>
                                <th>@lang('admin.faqs.question')</th>
                                <th>@lang('admin.faqs.read_at')</th>
                                <th>@lang('admin.faqs.answer_at')</th>
                                {{-- ngày xem --}}
                                <th>@lang('admin.faqs.created_at')</th>
                                {{-- ngày gửi --}}
                                <th>@lang('admin.funtion')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($faqs as $faq)
                                <tr>
                                    <th>{{ $startIndex++ }}</th>
                                    <td>{{ $faq->name }}</td>
                                    <td>{{ $faq->email }}</td>
                                    <td>{!! Str::limit($faq->question, 50) !!}</td>
                                    <td>{{ $faq->read_at }}</td>
                                    <td>{{ $faq->answer_at }}</td>
                                    <td>{{ $faq->createdAtVi }}</td>

                                    <td class="flex gap-3">
                                        <a href="{{ route('admin.faqs.show', $faq->id) }}"><x-heroicon-o-eye
                                                class="size-4 text-green-600" /></a>
                                        <form id="delete-form-{{ $faq->id }}"
                                            action="{{ route('admin.faqs.destroy', ['faq' => $faq->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="confirmDelete({{ $faq->id }})">
                                                <x-heroicon-o-trash class="size-4 text-red-500" />
                                            </button>
                                        </form>

                                        <script>
                                            function confirmDelete(faqId) {
                                                if (confirm('Are you sure you want to delete this faq?')) {
                                                    document.getElementById('delete-form-' + faqId).submit()
                                                }
                                            }
                                        </script>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $faqs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
