{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            @lang('admin.posts')
        </h2>
    </x-slot>
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css">

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                    <div class="max-w-2xl">
                        <form action="{{ route('admin.posts.store') }}" method="POST" class="needs-validation"
                            novalidate>
                            @csrf

                            <div x-data="app()" x-init="[initDate(), getNoOfDays()]" x-cloak>
                                <div class=" mx-auto px-4 py-2">
                                    <div class="mb-5 w-64">

                                        <label for="datepicker" class="font-bold mb-1 text-gray-700 block">

                                        </label>
                                        <div class="relative">
                                            <input type="hidden" name="published_at" x-ref="date">
                                            <input type="text" id="published_at" name="published_at" readonly x-model="datepickerValue"
                                                @click="showDatepicker = !showDatepicker"
                                                @keydown.escape="showDatepicker = false"
                                                class="w-full pl-4 pr-10 py-3 leading-none rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium"
                                                placeholder="Select date">

                                            <div class="absolute top-0 right-0 px-3 py-2">
                                                <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                            <div class="bg-white mt-12 rounded-lg shadow p-4 absolute top-0 left-0"
                                                style="width: 17rem" x-show.transition="showDatepicker"
                                                @click.away="showDatepicker = false">

                                                <div class="flex justify-between items-center mb-2">
                                                    <div>
                                                        <span x-text="MONTH_NAMES[month]"
                                                            class="text-lg font-bold text-gray-800"></span>
                                                        <span x-text="year"
                                                            class="ml-1 text-lg text-gray-600 font-normal"></span>
                                                    </div>
                                                    <div>
                                                        <button type="button"
                                                            class="transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-200 p-1 rounded-full"
                                                            :class="{ 'cursor-not-allowed opacity-25': month == 0 }"
                                                            :disabled="month == 0 ? true : false"
                                                            @click="month--; getNoOfDays()">
                                                            <svg class="h-6 w-6 text-gray-500 inline-flex"
                                                                fill="none" viewBox="0 0 24 24"
                                                                stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M15 19l-7-7 7-7" />
                                                            </svg>
                                                        </button>
                                                        <button type="button"
                                                            class="transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-200 p-1 rounded-full"
                                                            :class="{ 'cursor-not-allowed opacity-25': month == 11 }"
                                                            :disabled="month == 11 ? true : false"
                                                            @click="month++; getNoOfDays()">
                                                            <svg class="h-6 w-6 text-gray-500 inline-flex"
                                                                fill="none" viewBox="0 0 24 24"
                                                                stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M9 5l7 7-7 7" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>

                                                <div class="flex flex-wrap mb-3 -mx-1">
                                                    <template x-for="(day, index) in DAYS" :key="index">
                                                        <div style="width: 14.26%" class="px-1">
                                                            <div x-text="day"
                                                                class="text-gray-800 font-medium text-center text-xs">
                                                            </div>
                                                        </div>
                                                    </template>
                                                </div>

                                                <div class="flex flex-wrap -mx-1">
                                                    <template x-for="blankday in blankdays">
                                                        <div style="width: 14.28%"
                                                            class="text-center border p-1 border-transparent text-sm">
                                                        </div>
                                                    </template>
                                                    <template x-for="(date, dateIndex) in no_of_days"
                                                        :key="dateIndex">
                                                        <div style="width: 14.28%" class="px-1 mb-1">
                                                            <div @click="getDateValue(date)" x-text="date"
                                                                class="cursor-pointer text-center text-sm leading-none rounded-full leading-loose transition ease-in-out duration-100"
                                                                :class="{
                                                                    'bg-blue-500 text-white': isToday(date) ==
                                                                        true,
                                                                    'text-gray-700 hover:bg-blue-200': isToday(
                                                                        date) == false
                                                                }">
                                                            </div>
                                                        </div>
                                                    </template>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="row mb-3 ">
                                <div>
                                    <x-input-label for="title" :value="__('Title')" />
                                        <input type="text" name="title" placeholder="Type here"
                                            @class([
                                                'input',
                                                'input-bordered',
                                                'input-error' => $errors->has('title'),
                                                'w-full',
                                            ]) />
                                </div>
                            </div>
                            <div class="row mb-3 ">
                                <x-input-label for="category_id" :value="__('Category')" />
                                <select name="category_id" id="category_id" @class([
                                    'input',
                                    'input-bordered',
                                    'input-error' => $errors->has('category_id'),
                                    'w-full',
                                ])
                                    class="select select-bordered w-full max-w-xs">
                                    <option value="">Select Category</option>
                                    @foreach ($posts as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="row mb-3 ">
                                <div>
                                    <label for="content">Nội dung</label>
                                    <x-trix-input  name="content" id="content"/>
                                    <x-rich-text::styles />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tags">Tags:</label>
                                <input type="text" name="tags" id="tags" class="form-control" placeholder="Enter tags separated by commas">
                            </div>
                        
                            <!-- Display selected tags -->
                            <div class="form-group">
                                <label for="selected_tags">Selected Tags:</label>
                                <ul id="selected_tags"></ul>
                            </div>
                            <div>
                                <a href="{{ route('admin.posts.index') }}" class="btn btn-light">@lang('app.btn.cancel')</a>
                                <button type="submit" class="btn btn-success ml-2">@lang('app.btn.submit')</button>
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
        const MONTH_NAMES = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
            'October', 'November', 'December'
        ];
        const DAYS = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

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
                    let today = new Date();
                    this.month = today.getMonth();
                    this.year = today.getFullYear();
                    this.datepickerValue = new Date(this.year, this.month, today.getDate()).toDateString();
                },

                isToday(date) {
                    const today = new Date();
                    const d = new Date(this.year, this.month, date);

                    return today.toDateString() === d.toDateString() ? true : false;
                },

                getDateValue(date) {
                    let selectedDate = new Date(this.year, this.month, date);
                    this.datepickerValue = selectedDate.toDateString();

                    this.$refs.date.value = selectedDate.getFullYear() + "-" + ('0' + selectedDate.getMonth()).slice(-2) +
                        "-" + ('0' + selectedDate.getDate()).slice(-2);

                    console.log(this.$refs.date.value);

                    this.showDatepicker = false;
                },

                getNoOfDays() {
                    let daysInMonth = new Date(this.year, this.month + 1, 0).getDate();

                    // find where to start calendar day of week
                    let dayOfWeek = new Date(this.year, this.month).getDay();
                    let blankdaysArray = [];
                    for (var i = 1; i <= dayOfWeek; i++) {
                        blankdaysArray.push(i);
                    }

                    let daysArray = [];
                    for (var i = 1; i <= daysInMonth; i++) {
                        daysArray.push(i);
                    }

                    this.blankdays = blankdaysArray;
                    this.no_of_days = daysArray;
                }
            }
        }
    </script>
</x-app-layout> --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            @lang('admin.posts')
        </h2>
    </x-slot>
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css">
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                    <div class="max-w-xl">
                        <form action="{{ route('admin.posts.store') }}" method="POST" class="needs-validation"
                            novalidate>
                            @csrf

                            <div x-data="app()" x-init="[initDate(), getNoOfDays()]" x-cloak>
                                <div class=" mx-auto px-4 py-2">
                                    <div class="mb-5 w-64">

                                        <label for="datepicker" class="font-bold mb-1 text-gray-700 block">

                                        </label>
                                        <div class="relative">
                                            <input type="hidden" name="published_at" x-ref="date">
                                            <input type="text" id="published_at" name="published_at" readonly x-model="datepickerValue"
                                                @click="showDatepicker = !showDatepicker"
                                                @keydown.escape="showDatepicker = false"
                                                class="w-full pl-4 pr-10 py-3 leading-none rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium"
                                                placeholder="Select date">

                                            <div class="absolute top-0 right-0 px-3 py-2">
                                                <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                            <div class="bg-white mt-12 rounded-lg shadow p-4 absolute top-0 left-0"
                                                style="width: 17rem" x-show.transition="showDatepicker"
                                                @click.away="showDatepicker = false">

                                                <div class="flex justify-between items-center mb-2">
                                                    <div>
                                                        <span x-text="MONTH_NAMES[month]"
                                                            class="text-lg font-bold text-gray-800"></span>
                                                        <span x-text="year"
                                                            class="ml-1 text-lg text-gray-600 font-normal"></span>
                                                    </div>
                                                    <div>
                                                        <button type="button"
                                                            class="transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-200 p-1 rounded-full"
                                                            :class="{ 'cursor-not-allowed opacity-25': month == 0 }"
                                                            :disabled="month == 0 ? true : false"
                                                            @click="month--; getNoOfDays()">
                                                            <svg class="h-6 w-6 text-gray-500 inline-flex"
                                                                fill="none" viewBox="0 0 24 24"
                                                                stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M15 19l-7-7 7-7" />
                                                            </svg>
                                                        </button>
                                                        <button type="button"
                                                            class="transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-200 p-1 rounded-full"
                                                            :class="{ 'cursor-not-allowed opacity-25': month == 11 }"
                                                            :disabled="month == 11 ? true : false"
                                                            @click="month++; getNoOfDays()">
                                                            <svg class="h-6 w-6 text-gray-500 inline-flex"
                                                                fill="none" viewBox="0 0 24 24"
                                                                stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M9 5l7 7-7 7" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>

                                                <div class="flex flex-wrap mb-3 -mx-1">
                                                    <template x-for="(day, index) in DAYS" :key="index">
                                                        <div style="width: 14.26%" class="px-1">
                                                            <div x-text="day"
                                                                class="text-gray-800 font-medium text-center text-xs">
                                                            </div>
                                                        </div>
                                                    </template>
                                                </div>

                                                <div class="flex flex-wrap -mx-1">
                                                    <template x-for="blankday in blankdays">
                                                        <div style="width: 14.28%"
                                                            class="text-center border p-1 border-transparent text-sm">
                                                        </div>
                                                    </template>
                                                    <template x-for="(date, dateIndex) in no_of_days"
                                                        :key="dateIndex">
                                                        <div style="width: 14.28%" class="px-1 mb-1">
                                                            <div @click="getDateValue(date)" x-text="date"
                                                                class="cursor-pointer text-center text-sm leading-none rounded-full leading-loose transition ease-in-out duration-100"
                                                                :class="{
                                                                    'bg-blue-500 text-white': isToday(date) ==
                                                                        true,
                                                                    'text-gray-700 hover:bg-blue-200': isToday(
                                                                        date) == false
                                                                }">
                                                            </div>
                                                        </div>
                                                    </template>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="row mb-3 ">
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
                            <div class="row mb-3 ">
                                <div class="col-md-6">
                                    <div>
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
                                </div>
                            </div>
                            <div class="row mb-3 ">
                                <div class="col-md-6">
                                    <div>
                                        <x-input-label for="content" :value="__('content')" />
                                        <input type="text" name="content" placeholder="Type here"
                                            @class([
                                                'input',
                                                'input-bordered',
                                                'input-error' => $errors->has('content'),
                                                'w-full',
                                                'max-w-xs',
                                            ]) />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="tags">Tags:</label>
                                <input type="text" name="tags" id="tags" class="form-control" placeholder="Enter tags separated by commas">
                            </div>
                            <div>
                                <a href="{{ route('admin.posts.index') }}"
                                    class="btn btn-light">@lang('app.btn.cancel')</a>
                                <button type="submit" class="btn btn-success ml-2">@lang('app.btn.submit')</button>
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
        const MONTH_NAMES = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
            'October', 'November', 'December'
        ];
        const DAYS = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

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
                    let today = new Date();
                    this.month = today.getMonth();
                    this.year = today.getFullYear();
                    this.datepickerValue = new Date(this.year, this.month, today.getDate()).toDateString();
                },

                isToday(date) {
                    const today = new Date();
                    const d = new Date(this.year, this.month, date);

                    return today.toDateString() === d.toDateString() ? true : false;
                },

                getDateValue(date) {
                    let selectedDate = new Date(this.year, this.month, date);
                    this.datepickerValue = selectedDate.toDateString();

                    this.$refs.date.value = selectedDate.getFullYear() + "-" + ('0' + selectedDate.getMonth()).slice(-2) +
                        "-" + ('0' + selectedDate.getDate()).slice(-2);

                    console.log(this.$refs.date.value);

                    this.showDatepicker = false;
                },

                getNoOfDays() {
                    let daysInMonth = new Date(this.year, this.month + 1, 0).getDate();

                    // find where to start calendar day of week
                    let dayOfWeek = new Date(this.year, this.month).getDay();
                    let blankdaysArray = [];
                    for (var i = 1; i <= dayOfWeek; i++) {
                        blankdaysArray.push(i);
                    }

                    let daysArray = [];
                    for (var i = 1; i <= daysInMonth; i++) {
                        daysArray.push(i);
                    }

                    this.blankdays = blankdaysArray;
                    this.no_of_days = daysArray;
                }
            }
        }
    </script>
</x-app-layout>
