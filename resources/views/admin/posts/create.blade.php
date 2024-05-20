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
                    <div class="max-w-4xl">
                        <form action="{{ route('admin.posts.store') }}" method="POST" class="needs-validation" novalidate
                            enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <x-admin.forms.calendar
                                />
                            </div>

                            <div class="mb-3 max-w-xs">
                                <x-input-label for="category_id" :value="__('Category')" />
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
                            </div>
                            <div class="mb-3 max-w-xs">
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
                            <div class="row mb-3">
                                <label for="content">@lang('admin.content')</label>
                                <x-admin.forms.rich-text 
                                id="content" 
                                name="content"
                                model="post"
                                :value="old('content')" />
                            </div>
                            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css">
                            <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.min.js"></script>

                            <div class="row mb-3">
                                <label for="tags">Tags:</label>
                                <input type="text" name="tags" id="tags"
                                    placeholder="Enter tags separated by spaces" @class([
                                        'input',
                                        'input-bordered',
                                        'input-error' => $errors->has('tags'),
                                        'w-full',
                                        'h-fit',
                                    ]) />
                            </div>
                            <script>
                                // Initialize Tagify on the input element
                                var input = document.querySelector('input[name=tags]');
                                var tagify = new Tagify(input, {
                                    delimiters: " ", // Sử dụng dấu cách để tách các tag
                                    pattern: /[^ ]+/ // Chỉ cho phép các ký tự không phải dấu cách
                                });

                                // Thêm các tag hiện tại vào Tagify khi trang tải lên
                                var existingTags = @json($tags);
                                tagify.addTags(existingTags);

                                // Sử dụng phím Space để thêm tag mới
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
                                        src="https://lh3.googleusercontent.com/a-/AFdZucpC_6WFBIfaAbPHBwGM9z8SxyM1oV4wB4Ngwp_UyQ=s96-c"
                                        alt="Current photo" />
                                </div>
                                <label class="block">
                                    <span class="sr-only">Choose photo</span>
                                    <input type="file" name="image" onchange="loadFile(event)"
                                        class="file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100 block w-full text-sm text-slate-500 file:mr-4 file:rounded-full file:border-0 file:px-4 file:py-2 file:text-sm file:font-semibold" />
                                </label>
                            </div>
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
