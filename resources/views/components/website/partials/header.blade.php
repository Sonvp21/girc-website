@props([
    'title',
    'main'  => false,
    'paddingTop'  => 'pt-2',
    'textColor' => 'text-blue-700',
    'textAlign' => 'center',
    ])
<div>
    <div class="gap-2 px-0 font-semibold uppercase {{ $textColor }} text-{{ $textAlign }}">
        @if ($main)
            <div class="bg-blue-800 inline-block relative py-2 px-4">
                <svg fill="currentColor" class="absolute -right-[3rem] top-0 z-0 h-10 text-blue-700 transform scale-y-[-1]" xmlns="http://www.w3.org/2000/svg" shape-rendering="geometricPrecision" text-rendering="geometricPrecision" viewBox="0 0 120 36">
                    <path d="M77.103718 36C98.551859 36 98.551859 0 120 0H42.896282C21.448141 0 21.448141 36 0 36h77.103718Z"></path>
                </svg>
                <h3 class="relative z-20 text-white uppercase whitespace-nowrap">{!! $title !!}</h3>
            </div>
        @else
            <h3 class="{{ $paddingTop }} pb-2">{!! $title !!}</h3>
        @endif
    </div>
    <div class="bg-gradient-to-r from-blue-400 via-blue-500 via-70% to-red-500 h-0.5"></div>
</div>
