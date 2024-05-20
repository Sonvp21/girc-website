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
        <div class="mt-6">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                    <div class="max-w-xl">
                        <form action="{{ route('admin.categories.update', ['category' => $category->id]) }}"
                            method="POST" class="needs-validation" novalidate>
                            @csrf
                            @method('patch')

                            <div class="row mb-3">
                                <div class="label">
                                    <span class="label-text">Title</span>
                                </div>
                                <input type="text" name="title" placeholder="Type here"
                                    value="{{ old('title', $category->title) }}" @class([
                                        'input',
                                        'input-bordered',
                                        'input-error' => $errors->has('title'),
                                        'w-full',
                                        'max-w-xs',
                                    ]) />
                            </div>
                            <div>
                                <a href="{{ route('admin.categories.index') }}" class="btn-light btn">@lang('admin.btn.cancel')
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
