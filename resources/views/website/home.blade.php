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
                    <div class="grid h-auto grid-cols-5 gap-2">
                        <a
                            href="#"
                            class="group col-span-5 flex md:col-span-3"
                        >
                            <article>
                                <figure class="">
                                    <div class="h-60 bg-red-50"></div>
                                    <h2 class="text-bold py-2 text-justify font-anton text-xl text-green-700 group-hover:text-blue-800">
                                        Nghiệm thu gói thầu: Xây dựng hệ thống công bố công khai quy hoạch xây dựng đô thị tỉnh Bắc Kạn
                                    </h2>
                                </figure>
                                <p class="text-justify font-roboto font-normal leading-5 text-slate-500">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci aliquid consequatur culpa delectus deserunt
                                    dolore ducimus, error impedit magni minima numquam obcaecati officia perspiciatis quidem quis recusandae repellat
                                    sit tempora?
                                </p>
                            </article>
                        </a>
                        <div class="col-span-5 md:col-span-2">
                            <div class="flex items-center gap-2 border-x-4 border-green-700 bg-white px-4 py-3 font-semibold uppercase text-green-700">
                                <x-heroicon-o-newspaper class="size-5" />
                                <span>Tin mới</span>
                            </div>
                            <div class="mt-2 h-[400px] overflow-y-auto">
                                @for ($i=1; $i<=10; $i++)
                                    <div
                                        class="block"
                                        href="#"
                                    >
                                        <article
                                            :class="{ 'text-rose-600 transition': activeTab === 4 }"
                                            @click="activeTab = index"
                                            class=""
                                        >
                                            <figure class="relative flex rounded-t-xl">
                                                <a
                                                    href=""
                                                    class="h-20 w-28 flex-none bg-cover"
                                                >
                                                    <img
                                                        class="h-auto w-auto"
                                                        src="https://khuyennongvanho.tuaf.edu.vn/storage/103/conversions/download-thumb.jpg"
                                                        alt=""
                                                    />
                                                </a>
                                                <span
                                                    x-show="activeTab === 4"
                                                    class="absolute -left-4 top-[calc(50%-1rem)] hidden rounded-full bg-white lg:block"
                                                    x-transition:enter="duration-5000 transition ease-out"
                                                    x-transition:enter-start="transform opacity-0"
                                                    x-transition:enter-end="transform opacity-100"
                                                    x-transition:leave="duration-5000 transition ease-in"
                                                    x-transition:leave-start="transform opacity-100"
                                                    x-transition:leave-end="transform opacity-0"
                                                    style="display: none"
                                                >
                                                    <svg
                                                        class="text-aqua-forest-700 h-8 w-8"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 24 24"
                                                        fill="currentColor"
                                                    >
                                                        <path d="M2,12c0,5.52,4.48,10,10,10s10-4.48,10-10c0-5.52-4.48-10-10-10C6.48,2,2,6.48,2,12z M12,11l4,0v2l-4,0l0,3l-4-4l4-4L12,11 z"></path>
                                                    </svg>
                                                </span>
                                                <figcaption class="w-full px-3 text-sm">
                                                    <div class="">
                                                        <a
                                                            href=""
                                                            class="hover:text-rose-600 line-clamp-3 leading-5"
                                                            >Trung tâm Địa tin học thảo luận hợp tác Nghiên cứu với Tiến sĩ Aaron Kingsbury, Đại học
                                                            Mayville, Hoa Kỳ
                                                        </a>
                                                        <div class="text-aqua-forest-700 flex justify-between gap-2 pt-4 text-xs">
                                                            <a
                                                                href="#"
                                                                class="text-xs hover:underline"
                                                                >Tin tức hoạt động</a
                                                            >
                                                            <div class="flex items-center gap-2">
                                                                <span class="text-xs">19/04/2024 </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </figcaption>
                                            </figure>
                                        </article>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-8 hidden space-y-3 md:col-span-2 lg:block">
                    <div>
                        <div class="flex items-center gap-2 bg-blue-700 px-4 py-3 font-semibold uppercase text-white">
                            <x-heroicon-o-megaphone class="size-5" />
                            <span>Thông báo</span>
                        </div>
                        <ul
                            id="scroll-container-document"
                            class="flex h-[400px] flex-col divide-y divide-dashed divide-blue-500 overflow-scroll overflow-y-auto overscroll-contain border text-sm text-blue-500 scrollbar-hide"
                        >
                            @for ($i=1;$i<10;$i++)
                                <li class="p-3 text-sm">
                                    Thông báo số 467/TB-BGDĐT của Bộ Giáo dục avf Đào tạo V/v Tuyển sinh đi học tại Ma-rốc năm 2024
                                </li>
                            @endfor
                        </ul>
                    </div>
                </div>
                <div class="col-span-8 space-y-3 md:col-span-6 lg:col-span-6">
                    <div class="relative flex items-center">
                        <img
                            src="{{ asset('files/images/banner_m.jpeg') }}"
                            alt=""
                        />
                        <div class="absolute inset-0 flex items-end justify-center">
                            <a
                                class="mb-4 flex items-center rounded-full border-4 border-blue-950 px-3 py-2 text-sm font-bold hover:bg-blue-950 hover:text-white"
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
    @pushOnce('scripts_bottom')
    <script>
        const scrollContainerDocument = document.getElementById('scroll-container-document')
        let isScrollingDown = true
        let isMouseOver = false

        scrollContainerDocument.addEventListener('mouseenter', function () {
            isMouseOver = true
        })

        scrollContainerDocument.addEventListener('mouseleave', function () {
            isMouseOver = false
        })

        function scroll() {
            if (!isMouseOver) {
                if (scrollContainerDocument.scrollTop === scrollContainerDocument.scrollHeight - scrollContainerDocument.offsetHeight) {
                    isScrollingDown = false
                } else if (scrollContainerDocument.scrollTop === 0) {
                    isScrollingDown = true
                }

                if (isScrollingDown) {
                    scrollContainerDocument.scrollTop += 1
                } else {
                    scrollContainerDocument.scrollTop -= 1
                }
            }

            setTimeout(scroll, 50)
        }

        scroll()
    </script>
    @endPushOnce
</x-website-layout>
