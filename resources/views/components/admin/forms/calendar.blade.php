@props([
    'publish_at' => now(),
])
<div>
    <!-- No surplus words or unnecessary actions. - Marcus Aurelius -->
    <div class="float-right max-w-xs" x-data="app()" x-init="[initDate(), getNoOfDays()]" x-cloak>
        <div class="mx-auto px-4 py-2">
            <div class="mb-5 w-64">
                <label for="datepicker" class="text-gray-700 mb-1 block font-bold">
                </label>
                <div class="relative">
                    <input type="hidden" name="published_at" x-ref="date" />
                    <input type="text" id="published_at" name="published_at" readonly
                        x-model="datepickerValue" @click="showDatepicker = !showDatepicker"
                        @keydown.escape="showDatepicker = false"
                        class="focus:shadow-outline text-gray-600 w-full rounded-lg py-3 pl-4 pr-10 font-medium leading-none shadow-sm focus:outline-none"
                        placeholder="Select date" />

                    <div class="absolute right-0 top-0 px-3 py-2">
                        <svg class="text-gray-400 h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="absolute left-0 top-0 mt-12 rounded-lg bg-white p-4 shadow"
                        style="width: 17rem; z-index: 1" x-show.transition="showDatepicker"
                        @click.away="showDatepicker = false">
                        <div class="mb-2 flex items-center justify-between">
                            <div>
                                <span x-text="MONTH_NAMES[month]"
                                    class="text-gray-800 text-lg font-bold"></span>
                                <span x-text="year"
                                    class="text-gray-600 ml-1 text-lg font-normal"></span>
                            </div>
                            <div>
                                <button type="button"
                                    class="hover:bg-gray-200 inline-flex cursor-pointer rounded-full p-1 transition duration-100 ease-in-out"
                                    :class="{ 'cursor-not-allowed opacity-25': month == 0 }"
                                    :disabled="month == 0 ? true : false"
                                    @click="month--; getNoOfDays()">
                                    <svg class="text-gray-500 inline-flex h-6 w-6"
                                        fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M15 19l-7-7 7-7" />
                                    </svg>
                                </button>
                                <button type="button"
                                    class="hover:bg-gray-200 inline-flex cursor-pointer rounded-full p-1 transition duration-100 ease-in-out"
                                    :class="{ 'cursor-not-allowed opacity-25': month == 11 }"
                                    :disabled="month == 11 ? true : false"
                                    @click="month++; getNoOfDays()">
                                    <svg class="text-gray-500 inline-flex h-6 w-6"
                                        fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="-mx-1 mb-3 flex flex-wrap">
                            <template x-for="(day, index) in DAYS" :key="index">
                                <div style="width: 14.26%" class="px-1">
                                    <div x-text="day"
                                        class="text-gray-800 text-center text-xs font-medium">
                                    </div>
                                </div>
                            </template>
                        </div>

                        <div class="-mx-1 flex flex-wrap">
                            <template x-for="blankday in blankdays">
                                <div style="width: 14.28%"
                                    class="border border-transparent p-1 text-center text-sm">
                                </div>
                            </template>
                            <template x-for="(date, dateIndex) in no_of_days"
                                :key="dateIndex">
                                <div style="width: 14.28%" class="mb-1 px-1">
                                    <div @click="getDateValue(date)" x-text="date"
                                        class="cursor-pointer rounded-full text-center text-sm transition duration-100 ease-in-out"
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
</div>
<style>
    [x-cloak] {
        display: none;
    }
</style>
<script>
    const MONTH_NAMES = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
        'October', 'November', 'December'
    ]
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
                let today = new Date('{{ $publish_at }}')
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
                    selectedDate.getFullYear() + '-' + ('0' + selectedDate.getMonth()).slice(-2) + '-' + ('0' +
                        selectedDate.getDate()).slice(-2)

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