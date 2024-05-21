<x-app-layout>
    <div class="p-6">
        <div class="text-gray-800 text-normal font-semibold leading-tight">
            <span class="text-gray-800 text-normal flex items-center gap-2 font-semibold leading-tight">
                @lang('admin.categories.list')
                <x-heroicon-m-arrow-small-right class="size-4" />
                @lang('admin.edit')
            </span>
        </div>
        @if (session('icon') && session('heading') && session('message'))
            <div class="alert alert-{{ session('icon') === 'success' ? 'success' : 'danger' }}" role="alert">
                <strong>{{ session('heading') }}:</strong>
                {{ session('message') }}
            </div>
        @endif
        <div class="mt-6">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST"
                        class="space-y-4 needs-validation" novalidate>
                        @csrf
                        @method('PUT')

                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">@lang('admin.categories.order')</span>
                            </div>
                            <input type="number" min="0" max="99" name="order"
                                value="{{ $category->order }}" @class([
                                    'input',
                                    'input-bordered',
                                    'input-error' => $errors->has('order'),
                                    'w-full',
                                ]) />
                        </label>

                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">@lang('admin.categories.title')</span>
                            </div>
                            <input type="text" name="title" value="{{ $category->title }}"
                                @class([
                                    'input',
                                    'input-bordered',
                                    'input-error' => $errors->has('title'),
                                    'w-full',
                                ]) />
                        </label>

                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">@lang('admin.categories.title_en')</span>
                            </div>
                            <input type="text" name="title_en" value="{{ $category->title_en }}"
                                @class([
                                    'input',
                                    'input-bordered',
                                    'input-error' => $errors->has('title_en'),
                                    'w-full',
                                ]) />
                        </label>

                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">@lang('admin.categories.parent')</span>
                            </div>
                            <select name="parent_id" @class(['input', 'input-bordered', 'w-full'])>
                                <option value="">@lang('admin.categories.select_parent')</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}"
                                        {{ isset($category) && $category->parent_id == $cat->id ? 'selected' : '' }}>
                                        {{ app()->getLocale() === 'en' ? $cat->title_en : $cat->title }}
                                    </option>
                                @endforeach
                            </select>
                        </label>

                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">@lang('admin.categories.in_menu')</span>
                            </div>
                            <select name="in_menu" @class(['input', 'input-bordered', 'w-full'])>
                                <option value="0" {{ $category->in_menu ? '' : 'selected' }}>@lang('admin.false')
                                </option>
                                <option value="1" {{ $category->in_menu ? 'selected' : '' }}>@lang('admin.true')
                                </option>
                            </select>
                        </label>

                        <div class="flex justify-end gap-4">
                            <a href="{{ route('admin.categories.index') }}"
                                class="btn-light btn">@lang('admin.btn.cancel')</a>
                            <button type="submit" class="btn btn-success ml-2">@lang('admin.btn.submit')</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
