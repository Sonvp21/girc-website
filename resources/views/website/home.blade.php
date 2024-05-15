<x-website-layout>
    <section class="bg-[#221339]">
        <div class="mx-auto max-w-7xl flex-col justify-between px-3 sm:px-6 md:items-center lg:flex lg:flex-row lg:px-8">
                <video
                    class="w-full"
                    autoplay
                    loop
                    controls
                    muted
                    src="{{ asset('files/videos/video.mp4') }}"
                ></video>
{{--            <img--}}
{{--                src="{{ asset('files/slider/slider_1.jpeg') }}"--}}
{{--                alt=""--}}
{{--            />--}}
        </div>
    </section>
    <section>
        <div class="mx-auto max-w-7xl flex-col justify-between px-3 sm:px-6 md:items-center lg:flex lg:flex-row lg:px-8">
{{--            <video--}}
{{--                class="w-1/2"--}}
{{--                autoplay="autoplay"--}}
{{--                src="{{ asset('files/videos/video.mp4') }}"--}}
{{--                ></video>--}}
        </div>
    </section>
</x-website-layout>
