<x-app-layout>
    <link
        rel="stylesheet"
        href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css"
    />
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
                        <form
                            action="{{ route('admin.posts.update', ['post' => $post->id]) }}"
                            method="POST"
                            class="needs-validation"
                            novalidate
                            enctype="multipart/form-data"
                        >
                            @csrf
                            @method('patch')

                            <div class="row mb-3 flex">
                                <div class="w-80">
                                    <x-input-label
                                        for="category_id"
                                        :value="__('Category')"
                                    />
                                    <select
                                        name="category_id"
                                        id="category_id"
                                        @class([
                                            'input',
                                            'input-bordered',
                                            'input-error' => $errors->has('category_id'),
                                            'w-full',
                                        ])
                                        class="select select-bordered w-full max-w-xs"
                                    >
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option
                                                value="{{ $category->id }}"
                                                {{ $post->category_id == $category->id ? 'selected' : '' }}
                                            >
                                                {{ $category->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div
                                    class="ml-auto"
                                    x-data="app()"
                                    x-init="[initDate(), getNoOfDays()]"
                                    x-cloak
                                >
                                    <div class="mx-auto px-4 py-2">
                                        <div class="w-64">
                                            <label
                                                for="datepicker"
                                                class="text-gray-700 mb-1 block font-bold"
                                            >
                                            </label>
                                            <div class="relative">
                                                <input
                                                    type="hidden"
                                                    name="published_at"
                                                    x-ref="date"
                                                />
                                                <input
                                                    type="text"
                                                    id="published_at"
                                                    name="published_at"
                                                    readonly
                                                    x-model="datepickerValue"
                                                    @click="showDatepicker = !showDatepicker"
                                                    @keydown.escape="showDatepicker = false"
                                                    class="focus:shadow-outline text-gray-600 w-full rounded-lg py-3 pl-4 pr-10 font-medium leading-none shadow-sm focus:outline-none"
                                                    placeholder="Select date"
                                                />

                                                <div class="absolute right-0 top-0 px-3 py-2">
                                                    <svg
                                                        class="text-gray-400 h-6 w-6"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke="currentColor"
                                                    >
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                                <div
                                                    class="absolute left-0 top-0 mt-12 rounded-lg bg-white p-4 shadow"
                                                    style="width: 17rem; z-index: 1"
                                                    x-show.transition="showDatepicker"
                                                    @click.away="showDatepicker = false"
                                                >
                                                    <div class="mb-2 flex items-center justify-between">
                                                        <div>
                                                            <span
                                                                x-text="MONTH_NAMES[month]"
                                                                class="text-gray-800 text-lg font-bold"
                                                            ></span>
                                                            <span
                                                                x-text="year"
                                                                class="text-gray-600 ml-1 text-lg font-normal"
                                                            ></span>
                                                        </div>
                                                        <div>
                                                            <button
                                                                type="button"
                                                                class="hover:bg-gray-200 inline-flex cursor-pointer rounded-full p-1 transition duration-100 ease-in-out"
                                                                :class="{ 'cursor-not-allowed opacity-25': month == 0 }"
                                                                :disabled="month == 0 ? true : false"
                                                                @click="month--; getNoOfDays()"
                                                            >
                                                                <svg
                                                                    class="text-gray-500 inline-flex h-6 w-6"
                                                                    fill="none"
                                                                    viewBox="0 0 24 24"
                                                                    stroke="currentColor"
                                                                >
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                                                </svg>
                                                            </button>
                                                            <button
                                                                type="button"
                                                                class="hover:bg-gray-200 inline-flex cursor-pointer rounded-full p-1 transition duration-100 ease-in-out"
                                                                :class="{ 'cursor-not-allowed opacity-25': month == 11 }"
                                                                :disabled="month == 11 ? true : false"
                                                                @click="month++; getNoOfDays()"
                                                            >
                                                                <svg
                                                                    class="text-gray-500 inline-flex h-6 w-6"
                                                                    fill="none"
                                                                    viewBox="0 0 24 24"
                                                                    stroke="currentColor"
                                                                >
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <div class="-mx-1 mb-3 flex flex-wrap">
                                                        <template
                                                            x-for="(day, index) in DAYS"
                                                            :key="index"
                                                        >
                                                            <div
                                                                style="width: 14.26%"
                                                                class="px-1"
                                                            >
                                                                <div
                                                                    x-text="day"
                                                                    class="text-gray-800 text-center text-xs font-medium"
                                                                ></div>
                                                            </div>
                                                        </template>
                                                    </div>

                                                    <div class="-mx-1 flex flex-wrap">
                                                        <template x-for="blankday in blankdays">
                                                            <div
                                                                style="width: 14.28%"
                                                                class="border border-transparent p-1 text-center text-sm"
                                                            ></div>
                                                        </template>
                                                        <template
                                                            x-for="(date, dateIndex) in no_of_days"
                                                            :key="dateIndex"
                                                        >
                                                            <div
                                                                style="width: 14.28%"
                                                                class="mb-1 px-1"
                                                            >
                                                                <div
                                                                    @click="getDateValue(date)"
                                                                    x-text="date"
                                                                    class="cursor-pointer rounded-full text-center text-sm transition duration-100 ease-in-out"
                                                                    :class="{
                                                                        'bg-blue-500 text-white': isToday(date) ==
                                                                            true,
                                                                        'text-gray-700 hover:bg-blue-200': isToday(
                                                                            date) == false
                                                                    }"
                                                                ></div>
                                                            </div>
                                                        </template>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <x-input-label
                                    for="title"
                                    :value="__('Title')"
                                />
                                <input
                                    type="text"
                                    name="title"
                                    placeholder="Type here"
                                    value="{{ $post->title }}"
                                    @class([
                                        'input',
                                        'input-bordered',
                                        'input-error' => $errors->has('title'),
                                        'w-full',
                                        'max-w-xs',
                                    ])
                                />
                            </div>
                            <div class="row mb-3">
                                <label for="content">@lang('admin.content')</label>
                                <x-trix-input
                                    name="content"
                                    id="content"
                                    value="{!! old('content', $post->content) !!}"
                                />
                                <x-rich-text::styles />
                                <style>
                                    trix-editor {
                                        min-height: 240px;
                                    }
                                </style>
                            </div>

                            <link
                                rel="stylesheet"
                                href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css"
                            />
                            <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.min.js"></script>
                            <div class="row mb-3">
                                <label for="tags">Tags:</label>
                                <input
                                    type="text"
                                    name="tags"
                                    id="tags"
                                    @class([
                                        'input',
                                        'input-bordered',
                                        'input-error' => $errors->has('tags'),
                                        'w-full',
                                        'h-fit',
                                    ])
                                    value="{{ implode(' ', $tags) }}"
                                />
                            </div>
                            <script>
                                // Initialize Tagify on the input element
                                var input = document.querySelector('input[name=tags]')
                                var tagify = new Tagify(input, {
                                    delimiters: ' ', // Sử dụng dấu cách để tách các tag
                                    pattern: /[^ ]+/, // Chỉ cho phép các ký tự không phải dấu cách
                                })

                                // Thêm các tag hiện tại vào Tagify khi trang tải lên
                                var existingTags = @json($tags)
                                tagify.addTags(existingTags)

                                // Sử dụng phím Space để thêm tag mới
                                tagify.on('add', function (e) {
                                    if (e.detail.data.value.indexOf(' ') > -1) {
                                        var splitTags = e.detail.data.value.split(' ')
                                        splitTags.forEach(function (tag) {
                                            tagify.addTags(tag.trim())
                                        })
                                        tagify.removeTag(e.detail.data.value)
                                    }
                                })
                            </script>
                            <div class="flex items-center space-x-6">
                                <div class="shrink-0">
                                    <img
                                        id="preview_img"
                                        class="h-16 w-16 rounded-full object-cover"
                                        src="{{ $post->getFirstMedia('featured_image')->getUrl('thumb') }}"
                                        alt="{{ $post->getFirstMedia('featured_image')->name }}"
                                    />
                                </div>
                                <label class="block">
                                    <span class="sr-only">Choose photo</span>
                                    <div class="input input-bordered flex items-center gap-2 border px-3 py-2">
                                        File:
                                        <span id="selected_file_name">{{ $post->getFirstMedia('featured_image')->name }}</span>
                                    </div>

                                    <input
                                        class="hidden"
                                        type="file"
                                        name="image"
                                        onchange="loadFile(event)"
                                        class="file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100 block w-full text-sm text-slate-500 file:mr-4 file:rounded-full file:border-0 file:px-4 file:py-2 file:text-sm file:font-semibold"
                                    />
                                </label>
                            </div>
                            <script>
                                var loadFile = function (event) {
                                    var input = event.target
                                    var file = input.files[0]
                                    var type = file.type

                                    var output = document.getElementById('preview_img')
                                    var fileNameSpan = document.getElementById('selected_file_name')

                                    output.src = URL.createObjectURL(event.target.files[0])
                                    output.onload = function () {
                                        URL.revokeObjectURL(output.src) // free memory
                                    }

                                    fileNameSpan.innerText = file.name
                                }
                            </script>
                            <div>
                                <a
                                    href="{{ route('admin.posts.index') }}"
                                    class="btn-light btn"
                                    >@lang('admin.btn.cancel')
                                </a>
                                <button
                                    type="submit"
                                    class="btn btn-success ml-2"
                                >
                                    @lang('admin.btn.submit')
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        [x-cloak] {
            display: none;
        }
    </style>
    <script>
        const MONTH_NAMES = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']
        const DAYS = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']

        function app() {
            return {
                showDatepicker: false,
                datepickerValue: '',

                month: '',
                year: '',
                no_of_days: [],
                blankdays: [],
                days: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],

                initDate() {
                    let today = new Date('{{ $post->published_at }}')
                    this.month = today.getMonth()
                    this.year = today.getFullYear()
                    this.datepickerValue = new Date(this.year, this.month, today.getDate()).toDateString()
                },

                isToday(date) {
                    const today = new Date()
                    const d = new Date(this.year, this.month, date)

                    return today.toDateString() === d.toDateString() ? true : false
                },

                getDateValue(date) {
                    let selectedDate = new Date(this.year, this.month, date)
                    this.datepickerValue = selectedDate.toDateString()

                    this.$refs.date.value =
                        selectedDate.getFullYear() + '-' + ('0' + selectedDate.getMonth()).slice(-2) + '-' + ('0' + selectedDate.getDate()).slice(-2)

                    console.log(this.$refs.date.value)

                    this.showDatepicker = false
                },

                getNoOfDays() {
                    let daysInMonth = new Date(this.year, this.month + 1, 0).getDate()

                    // find where to start calendar day of week
                    let dayOfWeek = new Date(this.year, this.month).getDay()
                    let blankdaysArray = []
                    for (var i = 1; i <= dayOfWeek; i++) {
                        blankdaysArray.push(i)
                    }

                    let daysArray = []
                    for (var i = 1; i <= daysInMonth; i++) {
                        daysArray.push(i)
                    }

                    this.blankdays = blankdaysArray
                    this.no_of_days = daysArray
                },
            }
        }
    </script>
</x-app-layout>
