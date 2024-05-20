<x-app-layout>
    <div class="p-6">
        <div class="text-gray-800 text-normal font-semibold leading-tight">
            <span class="text-gray-800 text-normal flex items-center gap-2 font-semibold leading-tight">
                @lang('admin.posts')
                <x-heroicon-m-arrow-small-right class="size-4" />
                @lang('admin.edit')
            </span>
        </div>
        <div class="mt-6">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                    <div class="max-w-2xl">
                        <form action="{{ route('admin.posts.update', ['post' => $post->id]) }}" method="POST"
                            class="needs-validation" novalidate enctype="multipart/form-data">
                            @csrf
                            @method('patch')

                            <div class="row mb-3 flex">
                                <div class="w-80">
                                    <label class="form-control w-full max-w-xs">
                                        <div class="label">
                                            <span class="label-text">@lang('admin.categories')</span>
                                        </div>
                                        <select name="category_id" id="category_id" @class([
                                            'input',
                                            'input-bordered',
                                            'input-error' => $errors->has('category_id'),
                                            'w-full',
                                        ])
                                            class="select select-bordered w-full max-w-xs">
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ $post->category_id == $category->id ? 'selected' : '' }}>
                                                    {{ $category->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </label>
                                </div>

                                <div class="row mb-3">
                                    <x-admin.forms.calendar :publish_at="$post->published_at" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="form-control w-full max-w-xs">
                                    <div class="label">
                                        <span class="label-text">@lang('admin.post.title')</span>
                                    </div>
                                    <input type="text" name="title" placeholder="Type here"
                                        value="{{ $post->title }}" @class([
                                            'input',
                                            'input-bordered',
                                            'input-error' => $errors->has('title'),
                                            'w-full',
                                            'max-w-xs',
                                        ]) />
                                </label>

                            </div>
                            <div class="row mb-3">
                                <label for="content">@lang('admin.content')</label>
                                <x-admin.forms.rich-text id="content" name="content" model="post"
                                    :value="$post->content" />
                            </div>

                            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" />
                            <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.min.js"></script>
                            <div class="row mb-3">
                                <label class="form-control w-full max-w-xs">
                                    <div class="label" for="tags">
                                        <span class="label-text">@lang('admin.post.tag')</span>
                                    </div>
                                    <input type="text" name="tags" id="tags" @class([
                                        'input',
                                        'input-bordered',
                                        'input-error' => $errors->has('tags'),
                                        'w-full',
                                        'h-fit',
                                    ])
                                        value="{{ implode(' ', $tags) }}" />
                                </label>
                            </div>
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
                            <div class="flex items-center space-x-6">
                                <div class="shrink-0">
                                    <img id="preview_img" class="h-16 w-16 rounded-full object-cover"
                                        src="{{ $post->getFirstMedia('featured_image')->getUrl('thumb') }}"
                                        alt="{{ $post->getFirstMedia('featured_image')->name }}" />
                                </div>
                                <label class="block">
                                    <span class="sr-only">Choose photo</span>
                                    <div class="input input-bordered flex items-center gap-2 border px-3 py-2">
                                        File:
                                        <span
                                            id="selected_file_name">{{ $post->getFirstMedia('featured_image')->name }}</span>
                                    </div>

                                    <input class="hidden" type="file" name="image" onchange="loadFile(event)"
                                        class="file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100 block w-full text-sm text-slate-500 file:mr-4 file:rounded-full file:border-0 file:px-4 file:py-2 file:text-sm file:font-semibold" />
                                </label>
                            </div>
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
                            <div>
                                <a href="{{ route('admin.posts.index') }}" class="btn-light btn">@lang('admin.btn.cancel')
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
