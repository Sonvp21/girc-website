<x-app-layout>
    <x-slot name="header">
        
        <h2 class="text-gray-800 text-xl font-semibold leading-tight">
            @lang('admin.contact_details') {{-- Assuming you have a language key for this --}}
        </h2>
    </x-slot>

    <div class="py-12">
        
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <a href="{{ route('admin.contacts.index') }}"
            class="inline-flex items-center px-4 py-2 bg-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 active:bg-gray-500 focus:outline-none focus:border-gray-500 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
            <x-heroicon-o-arrow-left class="size-4 mr-2" />
            @lang('admin.back')
        </a>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="col-span-1">
                            <h3 class="text-lg font-medium leading-6 text-gray-900">@lang('admin.contacts.name')</h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">{{ $contact->name }}</p>
                        </div>
                        <div class="col-span-1">
                            <h3 class="text-lg font-medium leading-6 text-gray-900">@lang('admin.contacts.email')</h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">{{ $contact->email }}</p>
                        </div>
                        <div class="col-span-1">
                            <h3 class="text-lg font-medium leading-6 text-gray-900">@lang('admin.contacts.phone')</h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">{{ $contact->phone }}</p>
                        </div>
                        <div class="col-span-1">
                            <h3 class="text-lg font-medium leading-6 text-gray-900">@lang('admin.contacts.read_at')</h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                {{ $contact->read_at ? $contact->read_at : 'Not read yet' }}</p>
                        </div>
                        <div class="col-span-1">
                            <h3 class="text-lg font-medium leading-6 text-gray-900">@lang('admin.contacts.created_at')</h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">{{ $contact->createdAtVi }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
