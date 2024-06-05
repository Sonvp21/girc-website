<x-website-layout>
    <section>
        <div class="mx-auto max-w-7xl px-3 sm:px-6 md:items-center lg:px-8">
            <div class="grid grid-cols-8 gap-4">
                <div class="col-span-8 space-y-3 md:col-span-6 lg:col-span-6">
                    <div>
                        <div class="breadcrumbs py-4 text-sm text-blue-800">
                            <ul>
                                <x-website.breadcrumbs />
                                <x-website.breadcrumbs :route="route('science-information.index')" :name="__('web.scienceinfors_lists')" />
                            </ul>
                        </div>
                        <div class="h-0.5 bg-gradient-to-r from-blue-400 via-blue-500 via-70% to-red-500"></div>
                    </div>
                    <article class="group">
                        <div class="tooltip tooltip-top flex items-center gap-2 text-green-700" data-tip="{{ $scienceInformation->publishedAtVi }}">
                            <x-heroicon-m-calendar class="size-4" />
                            <span class="text-xs">{{ $scienceInformation->publishedAtVi }}</span>
                        </div>
                        <h2 class="text-xl font-bold">{{ app()->getLocale() === 'en' ? $scienceInformation->title_en : $scienceInformation->title }}</h2>
                        <div class="">
                            {!! app()->getLocale() === 'en' && !empty($scienceInformation->content_en) ? $scienceInformation->content_en : $scienceInformation->content !!}
                        </div>
                    </article>
                </div>
                <div class="col-span-8 hidden space-y-3 md:col-span-2 lg:block">
                    <x-website.announcement />
                    <x-website.science-information />
                    <x-website.aside.extra-curricular-activity />
                    <x-website.aside.study-space />
                </div>
            </div>
        </div>
    </section>
</x-website-layout>
