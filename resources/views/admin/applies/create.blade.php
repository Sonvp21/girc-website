<x-app-layout>
    <div class="p-6">
        <div class="text-gray-800 text-normal font-semibold leading-tight">
            <span class="text-gray-800 text-normal flex items-center gap-2 font-semibold leading-tight">
                @lang('admin.applies')
                <x-heroicon-m-arrow-small-right class="size-4" />
                @lang('admin.add')
            </span>
        </div>
        <x-admin.alerts.error />
        <div class="mt-6">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="bg-white px-8 pb-8 pt-0 shadow sm:rounded-lg">
                    <form action="{{ route('admin.applies.store') }}" method="POST" class="space-y-4 needs-validation"
                        novalidate enctype="multipart/form-data">
                        @csrf

                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">@lang('admin.applies.name')</span>
                            </div>
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="name..."
                                @class([
                                    'input',
                                    'input-bordered',
                                    'input-error' => $errors->has('name'),
                                    'w-full',
                                ]) />
                        </label>
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">@lang('admin.applies.phone')</span>
                            </div>
                            <input type="text" name="phone" value="{{ old('phone') }}"
                                placeholder="0987654..." @class([
                                    'input',
                                    'input-bordered',
                                    'input-error' => $errors->has('phone'),
                                    'w-full',
                                ]) />
                        </label>
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">@lang('admin.applies.email')</span>
                            </div>
                            <input type="text" name="email" value="{{ old('email') }}"
                                placeholder="" @class([
                                    'input',
                                    'input-bordered',
                                    'input-error' => $errors->has('email'),
                                    'w-full',
                                ]) />
                        </label>
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">@lang('admin.applies.school')</span>
                            </div>
                            <input type="text" name="school" value="{{ old('school') }}"
                                placeholder="" @class([
                                    'input',
                                    'input-bordered',
                                    'input-error' => $errors->has('school'),
                                    'w-full',
                                ]) />
                        </label>
                        <label class="form-control w-full">
                            <div class="label" for="major">
                                <span class="label-text">@lang('admin.applies.major')</span>
                            </div>
                            <select name="major" required @class([
                                'input',
                                'input-bordered',
                                'input-error' => $errors->has('major'),
                                'w-full',
                            ])>
                                <option value=""> @lang('admin.applies.select_major') </option>
                                @foreach (App\Enums\ApplyMajorEnum::cases() as $major)
                                    <option @selected($major->value == old('major')) value="{{ $major->value }}">
                                        @lang('admin.' . $major->value)
                                    </option>
                                @endforeach
                            </select>
                        </label>
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">@lang('admin.applies.question')</span>
                            </div>
                            <textarea name="question" placeholder="{{ __('admin.applies.question') }}" @class([
                                'textarea',
                                'textarea-bordered',
                                'textarea-error' => $errors->has('question'),
                            ])>{{ old('question') }}</textarea>
                        </label>

                        <div class="flex justify-end gap-4">
                            <a href="{{ route('admin.applies.index') }}" class="btn-light btn">@lang('admin.btn.cancel')
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
    @pushonce('bottom_scripts')
    @endpushonce
</x-app-layout>
