<x-app-layout>
    <x-slot name="header">
        <h2 class="text-gray-800 text-xl font-semibold leading-tight">
            @lang('admin.albums')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div
                    class="bg-white p-4 shadow sm:rounded-lg sm:p-8"
                    style="text-align: -webkit-center"
                >
                    <div class="max-w-xl text-start">
                        <form
                            action="{{ route('admin.albums.store') }}"
                            method="POST"
                            class="needs-validation"
                            novalidate
                        >
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div>
                                        <x-input-label
                                            for="name"
                                            :value="__('Name')"
                                        />
                                        <input
                                            type="text"
                                            name="name"
                                            placeholder="Type here"
                                            @class([
                                                'input',
                                                'input-bordered',
                                                'input-error' => $errors->has('name'),
                                                'w-full',
                                                'max-w-xs',
                                            ])
                                        />
                                    </div>
                                </div>

                                <div class="mb-3 max-w-xs">
                                    <x-input-label
                                        for="type"
                                        :value="__('Type')"
                                    />
                                    <select
                                        name="type"
                                        required
                                        @class([
                                            'input',
                                            'input-bordered',
                                            'input-error' => $errors->has('type'),
                                            'w-full',
                                        ])
                                    >
                                        @foreach (App\Enums\AlbumTypeEnum::cases() as $type)
                                            <option value="{{ $type->value }}">{{ $type->value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div>
                                <a
                                    href="{{ route('admin.albums.index') }}"
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
