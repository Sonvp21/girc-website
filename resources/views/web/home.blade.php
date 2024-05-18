<x-website-layout>
    <section class="bg-[#2213390] bg-white">
        <div class="mx-auto max-w-7xl flex-col justify-between px-3 sm:px-6 md:items-center lg:flex lg:flex-row lg:px-8">
            <video
                class="w-full"
                autoplay
                loop
                muted
                src="{{ asset('files/videos/slider_3.mp4') }}"
            ></video>
            {{-- <img src="{{ asset('files/images/banner_2.jpeg') }}" alt=""> --}}
        </div>
    </section>
    <section>
        <div class="mx-auto mt-6 max-w-7xl px-3 sm:px-6 md:items-center lg:px-8">
            <div class="grid grid-cols-8 gap-4 overflow-hidden">
                <div class="col-span-8 space-y-3 md:col-span-6 lg:col-span-6">
                    <x-website.home-post />
                </div>
                <div class="col-span-8 hidden space-y-3 md:col-span-2 lg:block">
                    <x-website.announcement />
                </div>
                <div class="col-span-8 space-y-3 md:col-span-6 lg:col-span-6">
                    <h2 class="font-semibold text-green-700">Education Program</h2>
                    <p class="mb-4 mt-3 text-4xl font-extrabold">Nurturing Potential, Shaping Futures.</p>
                    <p class="mb-6 text-slate-500">
                        Our Education Program is designed to provide students with a comprehensive and engaging learning experience. Through a
                        combination of rigorous coursework, hands-on projects, and collaborative learning, we aim to foster critical thinking,
                        creativity, and a passion for lifelong learning. Join us on a journey of discovery and achievement.
                    </p>
                    <div class="relative flex items-center">
                        <img
                            src="{{ asset('files/images/banner_m.jpeg') }}"
                            alt=""
                        />
                        <div class="absolute inset-0 flex items-end justify-center">
                            <a
                                class="mb-4 flex items-center border-4 border-blue-950 px-3 py-2 text-sm font-bold hover:bg-blue-950 hover:text-white"
                                href=""
                            >
                                <span>Đăng ký ngay hom nay</span>
                                <x-heroicon-m-arrow-small-right class="ml-1 size-6 animate-bounceHorizontal" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mx-auto my-8 max-w-7xl flex-col justify-between px-3 sm:px-6 md:items-center lg:flex lg:flex-row lg:px-8">
        <div class="">
            <h2 class="font-semibold text-green-700">Partners</h2>
            <p class="mb-4 mt-3 text-4xl font-extrabold">Collaborating with Universities.</p>
            <p class="mb-6 text-slate-500">
                Collaborating with leading universities, we are at the forefront of advancing science and technology. These partnerships are essential
                in our pursuit of excellence and our mission to contribute to significant scientific and technological advancements.
            </p>
            <ul class="grid grid-cols-4 py-5 backdrop-blur">
                <li class="flex items-center justify-center">
                    <a
                        href="#"
                        class="w-48"
                    >
                        <figure>
                            <img
                                class="h-48 w-48 rounded-full"
                                src="{{ asset('files/images/partners/cbttng.jpeg') }}"
                                alt=""
                            />
                            <figcaption class="mt-4 text-center text-sm font-bold text-blue-700">
                                Trang thông tin quốc gia về bảo tồn thiên nhiên và đa dạng sinh học
                            </figcaption>
                        </figure>
                    </a>
                </li>
                <li class="flex items-center justify-center">
                    <a
                        href="#"
                        class="w-48"
                    >
                        <figure>
                            <img
                                class="rounded-full"
                                src="{{ asset('files/images/partners/cres.png') }}"
                                alt=""
                            />
                            <figcaption class="mt-4 text-center text-sm font-bold text-blue-700">
                                Viện Tài Nguyên và môi Trường Đại học quốc gia Hà nội(VNU-CRES)
                            </figcaption>
                        </figure>
                    </a>
                </li>
                <li class="flex items-center justify-center">
                    <a
                        href="#"
                        class="w-48"
                    >
                        <figure>
                            <img
                                class="rounded-full"
                                src="{{ asset('files/images/partners/itet.jpeg') }}"
                                alt=""
                            />
                            <figcaption class="mt-4 text-center text-sm font-bold text-blue-700">
                                Viện Kỹ Thuật và Công Nghệ Môi Trường - ITET
                            </figcaption>
                        </figure>
                    </a>
                </li>
                <li class="flex items-center justify-center">
                    <a
                        href="#"
                        class="w-48"
                    >
                        <figure>
                            <img
                                class="rounded-full"
                                src="{{ asset('files/images/partners/vtnnh.png') }}"
                                alt=""
                            />
                            <figcaption class="mt-4 text-center text-sm font-bold text-blue-700">Viện Thổ Nhưỡng Nông hóa</figcaption>
                        </figure>
                    </a>
                </li>
            </ul>
        </div>
    </section>
</x-website-layout>
