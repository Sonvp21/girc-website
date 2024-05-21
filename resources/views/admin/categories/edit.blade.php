<x-app-layout>
    <div class="p-6">
        <div class="text-gray-800 text-normal font-semibold leading-tight">
            <span class="text-gray-800 text-normal flex items-center gap-2 font-semibold leading-tight">
                @lang('admin.posts')
                <x-heroicon-m-arrow-small-right class="size-4" />
                @lang('admin.categories')
                <x-heroicon-m-arrow-small-right class="size-4" />
                @lang('admin.edit')
            </span>
        </div>
        @if (session('icon') && session('heading') && session('message'))
            <div class="alert alert-{{ session('icon') === 'success' ? 'success' : 'danger' }}" role="alert">
                <strong>{{ session('heading') }}:</strong>
                {{ session('message') }}
            </div>
        @endif
        <div class="mt-6">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                        <form action="{{ route('admin.categories.update', ['category' => $category->id]) }}"
                            method="POST" class="space-y-4 needs-validation" novalidate>
                            @csrf
                            @method('patch')

                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text">@lang('admin.post.title')</span>
                                </div>
                                <input type="text" name="title" placeholder="Type here"
                                    value="{{ old('title', $category->title) }}" @class([
                                        'input',
                                        'input-bordered',
                                        'input-error' => $errors->has('title'),
                                        'w-full',
                                    ]) />
                            </label>
                            <div class="flex justify-end gap-4">
                                <a href="{{ route('admin.categories.index') }}" class="btn-light btn">
                                    @lang('admin.btn.cancel')
                                </a>
                                <button type="submit" class="btn btn-success ml-2">
                                    @lang('admin.btn.submit')
                                </button>
                            </div>
                            <script>
                                ;
                                (function() {
                                    'use strict'
                                    window.addEventListener(
                                        'load',
                                        function() {
                                            let inputName = document.getElementById('title')
                                            inputName.addEventListener('keyup', () => {
                                                inputName.value = inputName.value.replace(/^\w/, (c) => c.toUpperCase())
                                            })

                                            var forms = document.getElementsByClassName('needs-validation')
                                            var validation = Array.prototype.filter.call(forms, function(form) {
                                                form.addEventListener(
                                                    'submit',
                                                    function(event) {
                                                        if (form.checkValidity() === false) {
                                                            event.preventDefault()
                                                            event.stopPropagation()
                                                        }
                                                        form.classList.add('was-validated')
                                                    },
                                                    false,
                                                )
                                            })
                                        },
                                        false,
                                    )
                                })()
                            </script>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
