<div class="sticky top-12 z-30 bg-gray-200/60 backdrop-blur">
    <div class="items-left mx-auto flex h-10 max-w-7xl flex-row justify-between px-3 sm:px-6 lg:px-8">
        <div class="hidden items-center gap-4 text-blue-800 sm:flex">
            <svg class="h-5 w-auto" fill="currentColor" xmlns="http://www.w3.org/2000/svg" width="800" height="712" viewBox="0 0 600 534">
                <path d="M231.8 14.7C214.7 39.2 194 70 194 70.9c0 .6 29.3 44 65.2 96.3 35.8 52.4 65.3 96.2 65.5 97.4.3 1.5-17.9 28.9-64.7 97.4-35.8 52.4-64.9 95.8-64.7 96.4.8 2 42.8 63.1 43.5 63.3.6.2 172.6-250.7 174.5-254.6.6-1.3-20.5-33-86.9-130.2C278.2 66.3 238.4 8.1 238 7.7c-.4-.5-3.2 2.7-6.2 7z" />
                <path d="M27 43.7C15.2 61.1 5.6 75.7 5.7 76.1c.2.5 29.6 43.7 65.5 96.1 43 62.8 65.2 96.2 65.3 97.8 0 1.7-21.1 33.4-64.9 97.3-50.9 74.5-64.7 95.2-64 96.6.5 1 10.3 15.6 21.9 32.5 20.7 30.3 21 30.7 22.7 28.5C54.7 522 226 271.2 226 270.6c0-.8-176.1-258.1-176.8-258.3-.4-.1-10.4 14-22.2 31.4zM396.3 42.8c-11.5 16.9-21.3 31.3-21.7 32-.4.7 24.1 37.5 64.9 97.2 36 52.8 65.8 96.6 66.1 97.3.2.7-28.4 43.6-63.7 95.3-35.3 51.6-64.8 94.8-65.5 96-1.3 1.9.3 4.5 20.4 34 12 17.5 22.3 31.7 22.8 31.5.9-.4 174.3-253.7 174.7-255.2.2-.7-175.1-257.6-176.3-258.4-.4-.3-10.2 13.4-21.7 30.3z" />
            </svg>
            <div class="flex items-center whitespace-nowrap pr-5 text-sm capitalize">
                {{ now()->translatedFormat('l d/m/Y') }}
            </div>
        </div>
        <div class="flex w-full items-center gap-6 whitespace-nowrap pl-4 text-sm sm:w-auto">
            <a class="flex w-full items-center gap-2 text-slate-700 hover:text-blue-700" href="{{ route('contacts.index') }}">
                <div class="rounded bg-yellow-500 p-1 text-white">
                    <x-heroicon-s-phone class="size-4" />
                </div>
                <span>@lang('web.contact')</span>
            </a>
            <a class="flex w-full items-center gap-2 text-slate-700 hover:text-blue-700 sm:w-auto" href="{{ route('faqs.index') }}">
                <div class="rounded bg-yellow-500 p-1 text-white">
                    <x-heroicon-m-question-mark-circle class="size-4" />
                </div>
                <span>@lang('web.faqs')</span>
            </a>
            <a class="flex w-full items-center gap-2 text-slate-700 hover:text-blue-700 sm:w-auto" href="{{ route('login') }}">
                <div class="rounded bg-yellow-500 p-1 text-white">
                    <x-heroicon-s-arrow-left-end-on-rectangle class="size-4 rotate-180" />
                </div>
                <span>@lang('web.login')</span>
            </a>
        </div>
    </div>
</div>
