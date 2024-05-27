<x-website-layout>
    <section>
        <div class="mx-auto max-w-7xl px-3 sm:px-6 md:items-center lg:px-8">
            <div class="grid grid-cols-8 gap-4">
                <div class="col-span-8 space-y-3 md:col-span-6 lg:col-span-6">
                    <div>
                        <div class="text-sm breadcrumbs py-4 text-blue-800">
                            <ul>
                                <x-website.breadcrumbs/>
                                <x-website.breadcrumbs :route="route('scienceinformation.index')" :name="__('web.scienceinfors_lists')" />
                            </ul>
                        </div>
                        <div class="bg-gradient-to-r from-blue-400 via-blue-500 via-70% to-red-500 h-0.5"></div>
                    </div>
                    <article class="group">
                        <div class="tooltip tooltip-top flex items-center gap-2 text-green-700"
                            data-tip="{{ $scienceinformation->publishedAtVi }}">
                            <x-heroicon-m-calendar class="size-4" />
                            <span class="text-xs">{{ $scienceinformation->publishedAtVi }}</span>
                        </div>
                        <h2 class="text-xl font-bold">{{ $scienceinformation->title }}</h2>
                        <div class="">
                            {!! $scienceinformation->content !!}
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
