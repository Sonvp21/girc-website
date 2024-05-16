<x-app-layout>
    <x-slot name="header">
        <h2 class="text-gray-800 text-xl font-semibold leading-tight">
            @lang('admin.categories')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                    <div class="max-w-xl">
                        <form
                            action="{{ route('admin.categories.update', ['category' => $category->id]) }}"
                            method="POST"
                            class="needs-validation"
                            novalidate
                        >
                            @csrf
                            @method('patch')

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div>
                                                <x-input-label
                                                    for="title"
                                                    :value="__('Title')"
                                                />
                                                <input
                                                    type="text"
                                                    name="title"
                                                    placeholder="Type here"
                                                    value="{{ old('title', $category->title) }}"
                                                    @class([
                                                        'input',
                                                        'input-bordered',
                                                        'input-error' => $errors->has('title'),
                                                        'w-full',
                                                        'max-w-xs',
                                                    ])
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    {{--
                                        <div>
                                        <x-input-label for="title" :value="__('Title')" />
                                        <x-text-input id="title" name="title" type="text"
                                        class="mt-1 block w-full" :value="old('title', $category->title)" required autofocus
                                        autocomplete="title" />
                                        </div>
                                    --}}
                                </div>
                            </div>
                            <div>
                                <a
                                    href="{{ route('admin.categories.index') }}"
                                    class="btn-light btn"
                                    >@lang('app.btn.cancel')
                                     </a>
                                <button
                                    type="submit"
                                    class="btn btn-success ml-2"
                                >
                                    @lang('app.btn.submit')
                                </button>
                            </div>
                            <script>
                                ;(function () {
                                    'use strict'
                                    window.addEventListener(
                                        'load',
                                        function () {
                                            let inputName = document.getElementById('title')
                                            inputName.addEventListener('keyup', () => {
                                                inputName.value = inputName.value.replace(/^\w/, (c) => c.toUpperCase())
                                            })

                                            var forms = document.getElementsByClassName('needs-validation')
                                            var validation = Array.prototype.filter.call(forms, function (form) {
                                                form.addEventListener(
                                                    'submit',
                                                    function (event) {
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
