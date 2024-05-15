<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            @lang('admin.category')
        </h2>
        <div>
            <a class="flex items-center justify-end" href="{{ route('admin.categories.create') }}"><x-heroicon-o-plus-circle class="size-4"/>@lang('admin.add')</a>
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
                                <th>@lang('admin.category.title')</th>
                                <th>@lang('admin.category.created_at')</th>
                                <th>@lang('admin.category.updated_at')</th>
                                <th>@lang('admin.funtion')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                
                            
                            <tr>
                                <th>{{ $category->id }}</th>
                                <td>{{ $category->title }}</td>
                                <td>{{ $category->created_at }}</td>
                                <td>{{ $category->updated_at }}</td>
                            
                                <td class="flex gap-3">
                                    <a href="{{ route('admin.categories.edit', $category->id) }}"><x-heroicon-s-pencil-square class="size-4 text-green-600"/></a>
                                    <a href=""><x-heroicon-o-trash class="size-4 text-red-500"/></a>
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
