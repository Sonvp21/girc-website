<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            @lang('admin.announcements')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                    <div class="max-w-4xl">
                        <form action="{{ route('admin.announcements.store') }}" method="POST" class="needs-validation"
                            novalidate enctype="multipart/form-data">
                            @csrf

                            <div class="max-w-xs mb-3 ">
                                <x-input-label for="title" :value="__('Title')" />
                                <input type="text" name="title" placeholder="Type here"
                                    @class([
                                        'input',
                                        'input-bordered',
                                        'input-error' => $errors->has('title'),
                                        'w-full',
                                        'max-w-xs',
                                    ]) />
                            </div>
                            <div class="row mb-3 ">
                                <div class="col-md-6">
                                    <div>
                                        <label for="content">@lang('admin.content')</label>
                                        <x-trix-input name="content" id="content" />
                                        <x-rich-text::styles />
                                        <style>
                                            trix-editor {
                                                min-height: 240px;
                                            }
                                        </style>
                                    </div>
                                </div>
                            </div>
                            
                            <div>
                                <a href="{{ route('admin.announcements.index') }}" class="btn btn-light">@lang('app.btn.cancel')</a>
                                <button type="submit" class="btn btn-success ml-2">@lang('app.btn.submit')</button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

</x-app-layout>
