<x-app-layout>
    <div class="p-6">
        <div class="text-normal font-semibold leading-tight text-gray-800">
            <span class="text-normal flex items-center gap-2 font-semibold leading-tight text-gray-800">
                @lang('admin.staffs.list')
                <x-heroicon-m-arrow-small-right class="size-4" />
                @lang('admin.add')
            </span>
        </div>
        <x-admin.alerts.error />
        <div class="mt-6">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="bg-white px-8 pb-8 pt-0 shadow sm:rounded-lg">
                    <form action="{{ route('admin.staffs.store') }}" method="POST" class="needs-validation space-y-4" novalidate enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">@lang('admin.staffs.name')</span>
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
                                <span class="label-text">@lang('admin.staffs.category')</span>
                            </div>
                            <select name="category" required @class([
                                'input',
                                'input-bordered',
                                'input-error' => $errors->has('category'),
                                'w-full',
                            ])>
                                <option value="">@lang('admin.select')</option>
                                @foreach (App\Enums\StaffCategoryEnum::cases() as $category)
                                    <option @selected($category->value == old('category')) value="{{ $category->value }}">
                                        @lang('admin.' . $category->value)
                                    </option>
                                @endforeach
                            </select>
                        </label>
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">@lang('admin.content')</span>
                            </div>
                            <textarea name="content" id="content" class="form-input mt-1 block w-full rounded-md shadow-sm" rows="5">{{ old('content', $post->content ?? '') }}</textarea>

                        </label>
                        <div class="flex items-center space-x-6">
                            <div class="shrink-0">
                                <img id="preview_img" class="h-16 w-16 rounded-full object-cover" src="https://lh3.googleusercontent.com/a-/AFdZucpC_6WFBIfaAbPHBwGM9z8SxyM1oV4wB4Ngwp_UyQ=s96-c" alt="Current photo" />
                            </div>
                            <label class="block">
                                <span class="sr-only">Choose photo</span>
                                <input type="file" name="image" onchange="loadFile(event)" class="file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100 block w-full text-sm text-slate-500 file:mr-4 file:rounded-full file:border-0 file:px-4 file:py-2 file:text-sm file:font-semibold" />
                            </label>
                        </div>
                        <div class="flex justify-end gap-4">
                            <a href="{{ route('admin.staffs.index') }}" class="btn-light btn">
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
    @pushonce('bottom_scripts')
        <x-admin.forms.tinymce-config column="content" model="Staff" />
        <script>
            var loadFile = function(event) {
                var input = event.target
                var file = input.files[0]
                var type = file.type

                var output = document.getElementById('preview_img')

                output.src = URL.createObjectURL(event.target.files[0])
                output.onload = function() {
                    URL.revokeObjectURL(output.src) // free memory
                }
            }
        </script>
    @endpushonce
</x-app-layout>
