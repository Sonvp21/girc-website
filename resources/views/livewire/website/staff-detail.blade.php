<div>
    <x-website.partials.header main="true" title="{{ __('web.teaching_staff') }}" textAlign="left" />
    <div class="grid grid-cols-2 gap-6 md:grid-cols-4">
        @foreach ($categories as $index => $category)
            <div class="cursor-pointer" wire:click="showStaffDetail('{{ $category->value }}')">
                <img src="{{ asset('files/images/staff_' . ($index + 1) . '.png') }}" alt="{{ $category->name }}" />
            </div>
        @endforeach
    </div>

    <div
        class="modal {{ $isModalOpen ? 'modal-open' : '' }} w-full max-w-4xl mx-auto rounded-2xl max-h-[90%] self-center ml-[11%] mt-[1%]">
        <div class="modal-box min-w-full w-full min-h-full h-full p-3">
            <div class="bg-blue-800 inline-block relative py-2 px-4">
                <svg fill="currentColor"
                    class="absolute -right-[3rem] top-0 z-0 h-10 text-blue-700 transform scale-y-[-1]"
                    xmlns="http://www.w3.org/2000/svg" shape-rendering="geometricPrecision"
                    text-rendering="geometricPrecision" viewBox="0 0 120 36">
                    <path
                        d="M77.103718 36C98.551859 36 98.551859 0 120 0H42.896282C21.448141 0 21.448141 36 0 36h77.103718Z">
                    </path>
                </svg>

                <h3 class="relative z-20 text-white uppercase whitespace-nowrap">@lang('admin.' . $selectedCategory)</h3>
            </div>
            <div class="border border-black rounded-lg rounded-l-none p-4 h-[90%]">
                <h3
                    class="font-bold text-lg text-center font-times tracking-wide relative flex items-center justify-center">
                    <div class="flex-grow mx-2 bg-gradient-to-r from-blue-400 via-blue-500 via-50% to-red-500 h-0.5">
                    </div>
                    <span class="px-2 font-serif italic">@lang('web.info_teaching')</span>
                    <div class="flex-grow mx-2 bg-gradient-to-r from-red-500 via-blue-500 via-50% to-blue-400 h-0.5">
                    </div>
                </h3>
                <div style="text-align: -webkit-center;">
                    <div class="flex-grow mx-2 bg-gradient-to-r bg-gray-500 h-0.5 w-[18%]"></div>
                    <div class="mt-2 flex-grow mx-2 bg-gradient-to-r bg-gray-500 via-50% h-0.5 w-[8%]"></div>
                </div>

                <div class="py-4 h-[100%]">
                    @if ($staffs && $staffs->count() > 0)
                        {{-- latestStaff --}}
                        <div class="h-[55%]">
                            @php
                                $latestStaff = $staffs[$currentIndex];
                            @endphp
                            <div class="prose h-auto max-h-full overflow-y-auto w-full">
                                {!! $latestStaff->content !!}
                            </div>
                        </div>

                        <h3
                            class="font-bold text-lg text-center font-times tracking-wide relative flex items-center justify-center">
                            <div
                                class="flex-grow mx-2 bg-gradient-to-r from-blue-400 via-blue-500 via-50% to-red-500 h-0.5">
                            </div>
                            <span class="px-2 font-serif italic">@lang('admin.' . $selectedCategory) {{ __('web.teaching') }} </span>
                            <div
                                class="flex-grow mx-2 bg-gradient-to-r from-red-500 via-blue-500 via-50% to-blue-400 h-0.5">
                            </div>
                        </h3>

                        {{-- list staff --}}
                        <div class="mx-auto mt-2 max-w-7xl px-4 sm:px-2" wire:ignore>
                            <div class="carousel w-full h-36"
                                data-flickity='{ "autoPlay": true, "pageDots": false, "wrapAround": true, "contain": true, "cellAlign": "left", "prevNextButtons": true, "draggable": true }'>
                                @foreach ($staffs as $index => $staff)
                                    <div
                                        class="carousel-cell w-52 h-full mx-2 {{ $index === $currentIndex ? 'selected' : '' }}">
                                        <a title="{{ $staff->name }}"
                                            class="flex h-full w-full items-center justify-center overflow-hidden rounded-lg border border-gray-300 bg-white">
                                            <img class="h-full w-full object-cover"
                                                src="{{ $staff->getFirstMedia('staff_image')->getUrl() }}"
                                                alt="{{ $staff->name }}">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <p>@lang('web.no_data')</p>
                    @endif
                </div>
                <div class="modal-action">
                    <div class="modal-action absolute right-0 top-0">
                        <button wire:click="closeModal"
                            class="btn btn-sm btn-circle btn-ghost absolute right-2 top-[-0.5rem] focus:border-none focus:outline-none">✕</button>
                    </div>
                    <div class="absolute right-4 top-[38%] transform -translate-y-1/2">
                        <button wire:click="showNextStaff" class="btn btn-circle">➡️</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('livewire:load', function() {
            function initializeFlickity() {
                var carousel = document.querySelector('.carousel');
                if (carousel) {
                    new Flickity(carousel, {
                        autoPlay: true,
                        pageDots: false,
                        wrapAround: true,
                        contain: true,
                        cellAlign: 'left',
                        prevNextButtons: true,
                        draggable: true
                    });
                }
            }

            initializeFlickity();

            Livewire.hook('message.processed', (message, component) => {
                initializeFlickity();
            });
        });
    </script>
</div>
