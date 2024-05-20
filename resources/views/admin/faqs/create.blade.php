<x-app-layout>
    <div class="p-6">
        <div class="text-gray-800 text-normal font-semibold leading-tight">
            <span class="text-gray-800 text-normal flex items-center gap-2 font-semibold leading-tight">
                @lang('admin.faqs')
                <x-heroicon-m-arrow-small-right class="size-4" />
                @lang('admin.add')
            </span>
        </div>
        <div class="mt-6">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                    <div class="max-w-2xl">
                        <form
                            action="{{ route('admin.faqs.store') }}"
                            method="POST"
                            class="needs-validation"
                            novalidate
                        >
                            @csrf
                            <div class="flex">
                                <div class="row mb-3 w-52">
                                    <x-input-label
                                        for="name"
                                        :value="__('Name')"
                                    />
                                    <input
                                        type="text"
                                        name="name"
                                        placeholder="Put name"
                                        @class([
                                            'input',
                                            'input-bordered',
                                            'input-error' => $errors->has('name'),
                                            'w-full',
                                        ])
                                    />
                                </div>
                                <div class="row mb-3 w-52">
                                    <x-input-label
                                        for="email"
                                        :value="__('Email')"
                                    />
                                    <input
                                        type="text"
                                        name="email"
                                        placeholder="email..."
                                        @class([
                                            'input',
                                            'input-bordered',
                                            'input-error' => $errors->has('email'),
                                            'w-full',
                                        ])
                                    />
                                </div>
                                <div class="row mb-3 w-52">
                                    <x-input-label
                                        for="phone"
                                        :value="__('Phone')"
                                    />
                                    <input
                                        type="text"
                                        name="phone"
                                        placeholder="0987...."
                                        @class([
                                            'input',
                                            'input-bordered',
                                            'input-error' => $errors->has('phone'),
                                            'w-full',
                                        ])
                                    />
                                </div>
                                <div class="row mb-3 w-52">
                                    <x-input-label
                                        for="address"
                                        :value="__('Address')"
                                    />
                                    <input
                                        type="text"
                                        name="address"
                                        placeholder="address.."
                                        @class([
                                            'input',
                                            'input-bordered',
                                            'input-error' => $errors->has('address'),
                                            'w-full',
                                        ])
                                    />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div>
                                        <label for="content">@lang('admin.faqs.question')</label>
                                        <x-admin.forms.rich-text
                                            id="content"
                                            name="question"
                                            model="faq"
                                            :value="old('question')"
                                        />
                                    </div>
                                </div>
                            </div>

                            <div>
                                <a
                                    href="{{ route('admin.faqs.index') }}"
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
