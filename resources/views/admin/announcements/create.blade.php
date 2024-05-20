<x-app-layout>
    <div class="p-6">
        <div class="text-gray-800 text-normal font-semibold leading-tight">
            <span class="text-gray-800 text-normal flex items-center gap-2 font-semibold leading-tight">
                @lang('admin.announcements')
                <x-heroicon-m-arrow-small-right class="size-4" />
                @lang('admin.add')
            </span>
        </div>
        <div class="mt-6">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                    <form action="{{ route('admin.announcements.store') }}"
                          method="POST" class="space-y-4 needs-validation"
                        novalidate enctype="multipart/form-data">
                        @csrf

                        <x-admin.forms.calendar />

                        <label class="form-control w-full max-w-xs">
                            <div class="label">
                                <span class="label-text">@lang('admin.post.title')</span>
                            </div>
                            <input type="text" name="title" placeholder="title" @class([
                                'input',
                                'input-bordered',
                                'input-error' => $errors->has('title'),
                                'w-full',
                                'max-w-xs',
                            ]) />
                        </label>

                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">@lang('admin.content')</span>
                            </div>
                                <textarea name="content" id="content" class="hidden">
                                    {{ old('content') }}
                                </textarea>
                        </label>

                        <div>
                            <a href="{{ route('admin.announcements.index') }}"
                                class="btn-light btn">@lang('admin.btn.cancel')
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
        <x-admin.forms.tinymce-config column="content"/>
    @endpushonce
</x-app-layout>
