<x-app-layout>
    <div class="p-6">
        <div class="text-gray-800 text-normal font-semibold leading-tight">
            <span class="text-gray-800 text-normal flex items-center gap-2 font-semibold leading-tight">
                @lang('admin.posts')
                <x-heroicon-m-arrow-small-right class="size-4" />
                @lang('admin.add')
            </span>
        </div>
        <div class="mt-6">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                    <div class="space-y-4">
                        <form action="{{ route('admin.posts.store') }}" method="POST" class="needs-validation" novalidate
                            enctype="multipart/form-data">
                            @csrf

                            <div class="space-y-4">
                                <div class="flex gap-4">
                                    <label class="form-control w-full">
                                        <span class="label">
                                            <span class="label-text">@lang('admin.categories')</span>
                                        </span>

                                        <select name="category_id" id="category_id" @class([
                                            'input',
                                            'input-bordered',
                                            'input-error' => $errors->has('category_id'),
                                            'w-full',
                                        ])
                                        class="select select-bordered w-full max-w-xs">
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                                            @endforeach
                                        </select>
                                    </label>
                                    <x-admin.forms.calendar />
                                </div>
                                <label class="form-control w-full">
                                        <div class="label">
                                            <span class="label-text">@lang('admin.post.title')</span>
                                        </div>
                                        <input type="text" name="title" placeholder="Type here"
                                        @class([
                                            'input',
                                            'input-bordered',
                                            'input-error' => $errors->has('title'),
                                            'w-full',
                                        ]) />
                                    </label>
                                <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text">@lang('admin.content')</span>
                                </div>
                                <textarea name="content" id="content" class="hidden" column="content">
                                        {{ old('content') }}
                                </textarea>
                            </label>
                                <label class="form-control w-full max-w-xs">
                                        <div class="label" for="tags">
                                            <span class="label-text">@lang('admin.post.tag')</span>
                                        </div>
                                        <input type="text" name="tags" id="tags"
                                        placeholder="Enter tags separated by spaces" @class([
                                            'input',
                                            'input-bordered',
                                            'input-error' => $errors->has('tags'),
                                            'w-full',
                                            'h-fit',
                                        ]) />
                                    </label>
                                <div class="flex items-center space-x-6">
                                    <div class="shrink-0">
                                        <img id="preview_img" class="h-16 w-16 rounded-full object-cover"
                                            src="https://lh3.googleusercontent.com/a-/AFdZucpC_6WFBIfaAbPHBwGM9z8SxyM1oV4wB4Ngwp_UyQ=s96-c"
                                            alt="Current photo" />
                                    </div>
                                    <label class="block">
                                        <span class="sr-only">Choose photo</span>
                                        <input type="file" name="image" onchange="loadFile(event)"
                                            class="file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100 block w-full text-sm text-slate-500 file:mr-4 file:rounded-full file:border-0 file:px-4 file:py-2 file:text-sm file:font-semibold" />
                                    </label>
                                </div>
                                <div class="flex justify-end gap-4">
                                    <a href="{{ route('admin.posts.index') }}" class="btn-light btn">@lang('admin.btn.cancel')
                                    </a>
                                    <button type="submit" class="btn btn-success ml-2">
                                        @lang('admin.btn.submit')
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @pushonce('bottom_scripts')
        <x-admin.forms.tiny-mce-config column="content"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" />
        <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.min.js"></script>
        <script>
            var input = document.querySelector('input[name=tags]');
            var tagify = new Tagify(input, {
                delimiters: " ",
                pattern: /[^ ]+/,
            });
            var existingTags = @json($tags);
            tagify.addTags(existingTags);
            tagify.on('add', function(e) {
                if (e.detail.data.value.indexOf(' ') > -1) {
                    var splitTags = e.detail.data.value.split(' ');
                    splitTags.forEach(function(tag) {
                        tagify.addTags(tag.trim());
                    });
                    tagify.removeTag(e.detail.data.value);
                }
            });
        </script>
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
