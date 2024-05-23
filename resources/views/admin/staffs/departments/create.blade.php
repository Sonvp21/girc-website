<x-app-layout>
    <div class="p-6">
        <div class="text-gray-800 text-normal font-semibold leading-tight">
            <span class="text-gray-800 text-normal flex items-center gap-2 font-semibold leading-tight">
                @lang('admin.departments.list')
                <x-heroicon-m-arrow-small-right class="size-4" />
                @lang('admin.add')
            </span>
        </div>
        <x-admin.alerts.error />
        <div class="mt-6">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="bg-white px-8 pb-8 pt-0 shadow sm:rounded-lg">
                    <form action="{{ route('admin.departments.store') }}" method="POST" class="space-y-4 needs-validation" novalidate>
                        @csrf
                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">@lang('admin.departments.name')</span>
                            </div>
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="name..." @class([
                                'input',
                                'input-bordered',
                                'input-error' => $errors->has('name'),
                                'w-full',
                            ]) />
                        </label>
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">@lang('admin.departments.description')</span>
                            </div>
                            <textarea name="description" id="description" value="{{ old('description') }}" cols="30" rows="10" @class([
                                'input',
                                'input-bordered',
                                'input-error' => $errors->has('description'),
                                'w-full',
                            ])> {{ old('description') }}</textarea>
                            
                        </label>

                        <div class="flex justify-end gap-4">
                            <a href="{{ route('admin.departments.index') }}" class="btn-light btn">
                                @lang('admin.btn.cancel')
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
</x-app-layout>
