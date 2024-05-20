<x-app-layout>
    <div class="p-6">
        <div class="text-gray-800 text-normal font-semibold leading-tight">
            <span class="text-gray-800 text-normal flex items-center gap-2 font-semibold leading-tight">
                @lang('admin.announcements')
                <x-heroicon-m-arrow-small-right class="size-4" />
                @lang('admin.edit')
            </span>
        </div>
        <div class="mt-6">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                    <div class="max-w-2xl">
                        <form action="{{ route('admin.announcements.update', ['announcement' => $announcement->id]) }}"
                            method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
                            @csrf
                            @method('patch')

                            <div class="row mb-3">
                                <x-admin.forms.calendar
                                    :publish_at="$announcement->published_at"
                                />
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div>
                                        <x-input-label for="title" :value="__('Title')" />
                                        <input type="text" name="title" placeholder="Type here"
                                            value="{{ $announcement->title }}" @class([
                                                'input',
                                                'input-bordered',
                                                'input-error' => $errors->has('title'),
                                                'w-full',
                                                'max-w-xs',
                                            ]) />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="content">@lang('admin.content')</label>
                                <x-admin.forms.rich-text id="content" name="content" model="announcement"
                                    :value="$announcement->content" />
                            </div>
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
    </div>

</x-app-layout>
