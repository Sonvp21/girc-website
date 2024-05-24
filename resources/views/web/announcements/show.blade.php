<x-website-layout>
    <section>
        <div class="mx-auto max-w-7xl px-3 sm:px-6 md:items-center lg:px-8">
            <div class="grid grid-cols-8 gap-4">
                <div class="col-span-8 space-y-3 md:col-span-6 lg:col-span-6">
                    <div class="border-b-2 border-blue-700">
                        <h2 class="inline-block bg-blue-700 px-6 py-3 text-xl font-bold text-white">@lang('web.announcements')</h2>
                    </div>
                    <article class="group">
                        <div
                            class="tooltip tooltip-top flex items-center gap-2 text-green-700"
                            data-tip="{{ $announcement->publishedAtVi }}"
                        >
                            <x-heroicon-m-calendar class="size-4" />
                            <span class="text-xs">{{ $announcement->publishedAtVi }}</span>
                        </div>
                        <h2 class="text-2xl font-bold">{{ $announcement->title }}</h2>
                        <div class="">
                            {!! $announcement->content !!}
                        </div>
                    </article>
                </div>
                <div class="col-span-8 hidden space-y-3 md:col-span-2 lg:block">
                    <x-website.announcement />
                </div>
            </div>
        </div>
    </section>
</x-website-layout>
