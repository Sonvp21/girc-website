<x-app-layout>
    <div class="p-6">
        <div class="text-gray-800 text-normal font-semibold leading-tight">
            <span class="text-gray-800 text-normal flex items-center gap-2 font-semibold leading-tight">
                @lang('admin.announcements')
                <x-heroicon-m-arrow-small-right class="size-4" />
                @lang('admin.edit')
            </span>
        </div>
        <x-admin.alerts.error />
        <div class="mt-6">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="bg-white px-8 pb-8 pt-0 shadow sm:rounded-lg">
                    <form action="{{ route('admin.announcements.update', ['announcement' => $announcement->id]) }}"
                        method="POST" class="space-y-4 needs-validation" novalidate enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <input type="hidden" name="user_id" value="{{ auth()->id() }}"><label
                            class="form-control w-full">
                            <div class="label">
                                <span class="label-text">@lang('admin.post.published_at')</span>
                            </div>
                            <x-admin.forms.calendar name="published_at" value="{{ $announcement->published_at }}" />
                        </label>
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">@lang('admin.post.title')</span>
                            </div>
                            <input type="text" name="title" placeholder="Type here"
                                value="{{ $announcement->title }}" @class([
                                    'input',
                                    'input-bordered',
                                    'input-error' => $errors->has('title'),
                                    'w-full',
                                ]) />
                        </label>
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">@lang('admin.post.title_en')</span>
                            </div>
                            <input type="text" name="title_en" placeholder="Type here"
                                value="{{ $announcement->title_en }}" @class([
                                    'input',
                                    'input-bordered',
                                    'input-error' => $errors->has('title_en'),
                                    'w-full',
                                ]) />
                        </label>
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">@lang('admin.content')</span>
                            </div>
                            <textarea name="content" id="content" class="hidden">
                                {!! $announcement->content !!}
                            </textarea>
                        </label>
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">@lang('admin.content_en')</span>
                            </div>
                            <textarea name="content_en" id="content_en" class="hidden">
                                {!! $announcement->content_en !!}
                            </textarea>
                        </label>
                        <div class="flex justify-end gap-4">
                            <a href="{{ route('admin.announcements.index') }}" class="btn-light btn">@lang('admin.btn.cancel')
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
        <x-admin.forms.tinymce-config-en-vi column="content" columnen="content_en" model="Announcement" />
    @endpushonce
</x-app-layout>
