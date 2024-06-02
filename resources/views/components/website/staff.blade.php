<div>
    <x-website.partials.header main="true" title="{{ __('web.teaching_staff') }}" textAlign="left" />
    <div class="grid grid-cols-2 gap-6 md:grid-cols-4">
        @foreach ($categories as $index => $category)
            <div class="cursor-pointer"
                onclick="event.preventDefault(); document.getElementById('staff-modal-{{ $index }}').showModal();">
                <img src="{{ asset('files/images/staff_' . ($index + 1) . '.png') }}" alt="{{ $category->name }}" />
            </div>
        @endforeach
    </div>

    @foreach ($categories as $index => $category)
    <dialog id="staff-modal-{{ $index }}" class="modal">
        <div class="modal-box relative sm:min-h-fit md:h-[inherit] p-2 min-w-[60%] md:min-h-[90%]">
            <div class="bg-blue-800 inline-block relative py-2 px-4">
                <svg fill="currentColor" class="absolute -right-[3rem] top-0 z-0 h-10 text-blue-700 transform scale-y-[-1]"
                    xmlns="http://www.w3.org/2000/svg" shape-rendering="geometricPrecision" text-rendering="geometricPrecision"
                    viewBox="0 0 120 36">
                    <path d="M77.103718 36C98.551859 36 98.551859 0 120 0H42.896282C21.448141 0 21.448141 36 0 36h77.103718Z">
                    </path>
                </svg>
                <h3 class="relative z-20 text-white uppercase whitespace-nowrap">@lang('web.teaching_staff')</h3>
            </div>
            <div class="border border-black rounded-lg rounded-l-none mx-auto max-w-7xl sm:px-2 h-full sm:h-[88%]">
                <div class="py-1 h-full">
                    <h3 class="font-bold text-lg text-center font-times tracking-wide relative flex items-center justify-center">
                        <div class="flex-grow mx-2 bg-gradient-to-r from-blue-400 via-blue-500 via-50% to-red-500 h-0.5"></div>
                        <span class="px-2 font-serif italic">@lang('web.info_teaching')</span>
                        <div class="flex-grow mx-2 bg-gradient-to-r from-red-500 via-blue-500 via-50% to-blue-400 h-0.5"></div>
                    </h3>
    
                    <div class="mt-3 row-span-1 h-full">
                        <div class="max-w-full overflow-auto h-[60%] content-container">
                            @php
                                $latestStaff = $staffs
                                    ->where('category', $category->value)
                                    ->sortByDesc('created_at')
                                    ->first();
                            @endphp
                            @if ($latestStaff)
                                <div class="staff-content">
                                    {!! $latestStaff->content !!}
                                </div>
                            @endif
                        </div>
                        <h3 class="font-bold text-lg text-center font-times tracking-wide relative flex items-center justify-center">
                            <div class="flex-grow mx-2 bg-gradient-to-r from-blue-400 via-blue-500 via-50% to-red-500 h-0.5"></div>
                            <span class="px-2 font-serif italic text-red-500">Giảng viên {{ __('admin.' . strtolower($category->name)) }}</span>
                            <div class="flex-grow mx-2 bg-gradient-to-r from-red-500 via-blue-500 via-50% to-blue-400 h-0.5"></div>
                        </h3>
                        <div class="main-carousel h-36 overflow-hidden mt-[1%]"
                            data-flickity='{
                                "pageDots": false,
                                "wrapAround": true,
                                "contain": true,
                                "cellAlign": "left",
                                "index": 0
                            }'>
                            @foreach ($staffs->where('category', $category->value) as $staff)
                                <div class="carousel-cell">
                                    <a title="{{ $staff->name }}"
                                        class="mx-2 flex h-36 w-52 items-center justify-center overflow-hidden rounded-lg border border-gray-300 bg-white"
                                        onclick="event.preventDefault(); updateContent(this, `{!! htmlspecialchars($staff->content, ENT_QUOTES) !!}`);">
                                        <img class="w-full h-full" src="{{ $staff->getFirstMedia('staff_image')->getUrl() }}">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
    
                </div>
            </div>
            <div class="modal-action absolute right-0 top-0">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-[-1rem] focus:border-none focus:outline-none"
                    onclick="document.getElementById('staff-modal-{{ $index }}').close();">X</button>
            </div>
        </div>
    </dialog>
    
    <script>
        function updateContent(element, content) {
            const contentContainer = element.closest('.modal-box').querySelector('.content-container');
            contentContainer.innerHTML = decodeHTML(content);
        }
    
        function decodeHTML(html) {
            var txt = document.createElement('textarea');
            txt.innerHTML = html;
            return txt.value;
        }
    </script> 
    
    @endforeach
</div>
