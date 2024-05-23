<x-app-layout>
    <div class="p-6">
        <div class="text-gray-800 text-normal font-semibold leading-tight">
            <span class="text-gray-800 text-normal flex items-center gap-2 font-semibold leading-tight">
                @lang('admin.cooperations.all')
                <x-heroicon-m-arrow-small-right class="size-4" />
                @lang('admin.edit')
            </span>
        </div>
        <x-admin.alerts.error />

        <div class="mt-6">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="bg-white px-8 pb-8 pt-0 shadow sm:rounded-lg">
                    <form action="{{ route('admin.cooperations.update', ['cooperation' => $cooperation->id]) }}"
                        method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                        <div class="space-y-4">
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text">@lang('admin.post.title')</span>
                                </div>
                                <input type="text" name="name" value="{{ old('name', $cooperation->name) }}"
                                    placeholder="title cooperation..." @class([
                                        'input',
                                        'input-bordered',
                                        'input-error' => $errors->has('name'),
                                        'w-full',
                                    ]) />
                            </label>
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text">@lang('admin.cooperations.link')</span>
                                </div>
                                <input type="text" name="link_website"
                                    value="{{ old('link_website', $cooperation->link_website) }}"
                                    placeholder="link website..." @class([
                                        'input',
                                        'input-bordered',
                                        'input-error' => $errors->has('link_website'),
                                        'w-full',
                                    ]) />
                            </label>
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text">@lang('admin.description')</span>
                                </div>
                                <textarea name="description" id="description" class="hidden" column="description">
                                    {!! $cooperation->description !!}
                                </textarea>
                            </label>

                            <div class="flex items-center space-x-6">
                                <div class="shrink-0">
                                    <img id="preview_img" class="h-16 w-16 rounded-full object-cover"
                                        src="{{ $cooperation->getFirstMedia('album_cooperation')->getUrl('thumb') }}"
                                        alt="{{ $cooperation->getFirstMedia('album_cooperation')->name }}" />
                                </div>
                                <label class="block">
                                    <span class="sr-only">Choose cooperation</span>
                                    <div class="input input-bordered flex items-center gap-2 border px-3 py-2">
                                        File:
                                        <span
                                            id="selected_file_name">{{ $cooperation->getFirstMedia('album_cooperation')->name }}</span>
                                    </div>

                                    <input class="hidden" type="file" name="image" onchange="loadFile(event)"
                                        value="{{ $cooperation->getFirstMedia('album_cooperation')->getUrl('thumb') }}" />
                                </label>
                            </div>
                            
                        </div>
                        <div class="flex justify-end gap-4">
                            <a href="{{ route('admin.cooperations.index') }}" class="btn-light btn">@lang('admin.btn.cancel')
                            </a>
                            <button type="submit" class="btn btn-success">
                                @lang('admin.btn.submit')
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @pushonce('bottom_scripts')
        <x-admin.forms.tinymce-config column="description" />
        <script>
            var loadFile = function(event) {
                var input = event.target
                var file = input.files[0]
                var type = file.type

                var output = document.getElementById('preview_img')
                var fileNameSpan = document.getElementById('selected_file_name')

                output.src = URL.createObjectURL(event.target.files[0])
                output.onload = function() {
                    URL.revokeObjectURL(output.src) // free memory
                }

                fileNameSpan.innerText = file.name
            }
        </script>
    @endpushonce
</x-app-layout>
