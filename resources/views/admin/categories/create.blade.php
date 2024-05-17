<x-app-layout>
    <x-slot name="header">
        <h2 class="text-gray-800 text-xl font-semibold leading-tight">
            @lang('admin.categories')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                    <div class="max-w-xl">
                        <form
                            action="{{ route('admin.categories.store') }}"
                            method="POST"
                            class="needs-validation"
                            novalidate
                        >
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div>
                                        <x-input-label
                                            for="title"
                                            :value="__('Title')"
                                        />
                                        <input
                                            type="text"
                                            name="title"
                                            placeholder="Type here"
                                            @class([
                                                'input',
                                                'input-bordered',
                                                'input-error' => $errors->has('title'),
                                                'w-full',
                                                'max-w-xs',
                                            ])
                                        />
                                    </div>
                                </div>
                            </div>
                            <div>
                                <a
                                    href="{{ route('admin.categories.index') }}"
                                    class="btn-light btn"
                                    >@lang('admin.btn.cancel')
                                     </a>
                                <button
                                    type="submit"
                                    class="btn btn-success ml-2"
                                >
                                    @lang('admin.btn.submit')
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
