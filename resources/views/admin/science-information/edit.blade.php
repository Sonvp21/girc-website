<x-app-layout>
    <div class="p-6">
        <div class="text-normal font-semibold leading-tight text-gray-800">
            <span class="text-normal flex items-center gap-2 font-semibold leading-tight text-gray-800">
                @lang('admin.scienceInformation')
                <x-heroicon-m-arrow-small-right class="size-4" />
                @lang('admin.edit')
            </span>
        </div>
        <x-admin.alerts.error />
        <div class="mt-6">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="bg-white px-8 pb-8 pt-0 shadow sm:rounded-lg">
                    <form action="{{ route('admin.science-information.update', $scienceInformation) }}" method="POST" class="needs-validation space-y-4" novalidate enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                        <div class="flex gap-4">
                            <label class="form-control">
                                <div class="label">
                                    <span class="label-text">@lang('admin.post.published_at')</span>
                                </div>
                                <x-admin.forms.calendar name="published_at" value="{{ $scienceInformation->published_at }}" />
                            </label>
                        </div>
                        <div class="flex gap-4">
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text">@lang('admin.science_information.title')</span>
                                </div>
                                <input type="text" name="title" placeholder="Type here" value="{{ $scienceInformation->title }}" @class([
                                    'input',
                                    'input-bordered',
                                    'input-error' => $errors->has('title'),
                                    'w-full',
                                ]) />
                            </label>
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text">@lang('admin.scienceInformation.title_en')</span>
                                </div>
                                <input type="text" name="title_en" value="{{ $scienceInformation->title_en }}" placeholder="Title english(if have)" @class([
                                    'input',
                                    'input-bordered',
                                    'input-error' => $errors->has('title_en'),
                                    'w-full',
                                ]) />
                            </label>
                        </div>
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">@lang('admin.content')</span>
                            </div>
                            <textarea name="content" id="content" class="hidden">
                                {!! $scienceInformation->content !!}
                            </textarea>
                        </label>
                        <div class="flex items-center space-x-6">
                            <div class="shrink-0">
                                <img id="preview_img" class="h-16 w-16 rounded-full object-cover" src="{{ $scienceInformation->getFirstMedia('science_information_photo')->getUrl('thumb') }}" alt="{{ $scienceInformation->getFirstMedia('science_information_photo')->name }}" />
                            </div>
                            <label class="block">
                                <span class="sr-only">Choose photo</span>
                                <div class="input input-bordered flex items-center gap-2 border px-3 py-2">
                                    File:
                                    <span id="selected_file_name">{{ $scienceInformation->getFirstMedia('science_information_photo')->name }}</span>
                                </div>

                                <input class="hidden" type="file" name="image" onchange="loadFile(event)" class="file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100 block w-full text-sm text-slate-500 file:mr-4 file:rounded-full file:border-0 file:px-4 file:py-2 file:text-sm file:font-semibold" />
                            </label>
                        </div>
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">@lang('admin.science_information.keep_on_top')</span>
                            </div>
                            <select name="keep_on_top" @class(['input', 'input-bordered', 'w-full'])>
                                <option value="0" {{ $scienceInformation->keep_on_top ? '' : 'selected' }}>@lang('admin.false')
                                </option>
                                <option value="1" {{ $scienceInformation->keep_on_top ? 'selected' : '' }}>@lang('admin.true')
                                </option>
                            </select>
                        </label>
                        <div class="flex justify-end gap-4">
                            <a href="{{ route('admin.science-information.index') }}" class="btn-light btn">@lang('admin.btn.cancel')
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
        <x-admin.forms.tinymce-config column="content" model="ScienceInformation" />
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
