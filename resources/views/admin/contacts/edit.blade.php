<x-app-layout>
    <div class="p-6">
        <div class="text-gray-800 text-normal font-semibold leading-tight">
            <span class="text-gray-800 text-normal flex items-center gap-2 font-semibold leading-tight">
                @lang('admin.contacts')
                <x-heroicon-m-arrow-small-right class="size-4" />
                @lang('admin.edit')
            </span>
        </div>
        <div class="mt-6">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                    <div class="max-w-2xl">
                        <form action="{{ route('admin.contacts.update', ['contact' => $contact->id]) }}" method="POST"
                            class="needs-validation" novalidate>
                            @csrf
                            @method('patch')

                            <div class="row mb-3">
                                <label class="form-control w-full max-w-xs">
                                    <div class="label">
                                        <span class="label-text">@lang('admin.contacts.name')</span>
                                    </div>
                                    <input type="text" name="name" value="{{ old('name', $contact->name) }}"
                                        placeholder="Put name" @class([
                                            'input',
                                            'input-bordered',
                                            'input-error' => $errors->has('name'),
                                            'w-full',
                                        ]) />
                                </label>
                            </div>
                            <div class="row mb-3">
                                <label class="form-control w-full max-w-xs">
                                    <div class="label">
                                        <span class="label-text">@lang('admin.contacts.email')</span>
                                    </div>
                                    <input type="text" name="email" value="{{ old('email', $contact->email) }}"
                                        placeholder="email..." @class([
                                            'input',
                                            'input-bordered',
                                            'input-error' => $errors->has('email'),
                                            'w-full',
                                        ]) />
                                </label>
                            </div>
                            <div class="row mb-3">
                                <label class="form-control w-full max-w-xs">
                                    <div class="label">
                                        <span class="label-text">@lang('admin.contacts.phone')</span>
                                    </div>
                                    <input type="text" name="phone" value="{{ old('phone', $contact->phone) }}"
                                        placeholder="0987...." @class([
                                            'input',
                                            'input-bordered',
                                            'input-error' => $errors->has('phone'),
                                            'w-full',
                                        ]) />
                                </label>
                            </div>
                            <div class="row mb-3 w-full">
                                <label class="form-control w-full max-w-xs">
                                    <div class="label min-h">
                                        <span class="label-text">@lang('admin.contacts.content')</span>
                                    </div>
                                    <textarea name="content" id="content" @class([
                                        'w-full',
                                        'input',
                                        'input-bordered',
                                        'input-error' => $errors->has('content'),
                                        'min-h-72',
                                    ])> {!! old('content', $contact->content) !!}</textarea>
                                    @error('content')
                                        <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </label>
                            </div>

                            <div>
                                <a href="{{ route('admin.contacts.index') }}" class="btn-light btn">@lang('admin.btn.cancel')
                                </a>
                                <button type="submit" class="btn btn-success ml-2">
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
