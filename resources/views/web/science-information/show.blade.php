<x-website-layout>
    <section>
        <div class="mx-auto max-w-7xl px-3 sm:px-6 md:items-center lg:px-8">
            <div class="grid grid-cols-8 gap-4">
                <div class="col-span-8 space-y-3 md:col-span-6 lg:col-span-6">
                    <div class="border-b-2 border-blue-700">
                        <h2 class="inline-block bg-blue-700 px-6 py-3 text-xl font-bold text-white">@lang('web.scienceinfors_lists')</h2>
                    </div>
                    <article class="group">
                        <div class="tooltip tooltip-top flex items-center gap-2 text-green-700" data-tip="{{ $scienceInformation->publishedAtVi }}">
                            <x-heroicon-m-calendar class="size-4" />
                            <span class="text-xs">{{ $scienceInformation->publishedAtVi }}</span>
                        </div>
                        <h2 class="text-xl font-bold">{{ $scienceInformation->title }}</h2>
                        <div class="">
                            {!! $scienceInformation->content !!}
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
