<x-app-layout>
    <x-slot name="header">
        <h2 class="text-gray-800 text-xl font-semibold leading-tight">
            @lang('admin.contacts')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                    <div class="max-w-2xl" style="margin-left: 30%">
                        <form action="{{ route('admin.contacts.store') }}" method="POST" class="needs-validation"
                            novalidate>
                            @csrf
                            <div class="row mb-3">
                                <x-input-label for="name" :value="__('Name')" />
                                <input type="text" name="name" placeholder="Put name"
                                    @class([
                                        'input',
                                        'input-bordered',
                                        'input-error' => $errors->has('name'),
                                        'w-full',
                                    ]) />
                            </div>
                            <div class="row mb-3">
                                <x-input-label for="email" :value="__('Email')" />
                                <input type="text" name="email" placeholder="email..."
                                    @class([
                                        'input',
                                        'input-bordered',
                                        'input-error' => $errors->has('email'),
                                        'w-full',
                                    ]) />
                            </div>
                            <div class="row mb-3">
                                <x-input-label for="phone" :value="__('Phone')" />
                                <input type="text" name="phone" placeholder="0987...."
                                    @class([
                                        'input',
                                        'input-bordered',
                                        'input-error' => $errors->has('phone'),
                                        'w-full',
                                    ]) />
                            </div>
                            <div class="row mb-3 w-full">
                                <x-input-label for="content" :value="__('Content')" />
                                <textarea name="content" id="content" placeholder="Type here" @class([
                                    'w-full',
                                    'input',
                                    'input-bordered',
                                    'input-error' => $errors->has('content'),
                                    'min-h-72',
                                ])>{{ old('content') }}</textarea>
                                @error('content')
                                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>


                            <div>
                                <a href="{{ route('admin.contacts.index') }}"
                                    class="btn btn-light">@lang('admin.btn.cancel')</a>
                                <button type="submit" class="btn btn-success ml-2">@lang('admin.btn.submit')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
