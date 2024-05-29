<div class="col-span-8 space-y-3 md:col-span-6 lg:col-span-6 relative">
    <x-website.partials.header main="true" title="{{ __('web.education_program') }}" textAlign="left" />
    <div class="relative">
        <img src="{{ asset('files/images/banner_2.png') }}" alt="" class="w-full" />
        <button
            class="btn btn-primary absolute top-[75%] left-[42%] transform-center cursor-pointer
        bg-[#c82333] rounded-[14px] flex items-center border-none justify-center gap-2 hover:bg-[#a71d2a] 
        "
            onclick="document.getElementById('modal_regiser').showModal()">
            <p class="btn-primary-content bg-white p-[14px] rounded-[10px] rounded-r-none ml-[-13px] text-[#a71d2a]">
                {{ __('web.register_now') }}</p>
            <svg class="size-4 max-sm:pr-[6px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                <path fill="#ffffff"
                    d="M319.4 320.6L224 416l-95.4-95.4C57.1 323.7 0 382.2 0 454.4v9.6c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-9.6c0-72.2-57.1-130.7-128.6-133.8zM13.6 79.8l6.4 1.5v58.4c-7 4.2-12 11.5-12 20.3 0 8.4 4.6 15.4 11.1 19.7L3.5 242c-1.7 6.9 2.1 14 7.6 14h41.8c5.5 0 9.3-7.1 7.6-14l-15.6-62.3C51.4 175.4 56 168.4 56 160c0-8.8-5-16.1-12-20.3V87.1l66 15.9c-8.6 17.2-14 36.4-14 57 0 70.7 57.3 128 128 128s128-57.3 128-128c0-20.6-5.3-39.8-14-57l96.3-23.2c18.2-4.4 18.2-27.1 0-31.5l-190.4-46c-13-3.1-26.7-3.1-39.7 0L13.6 48.2c-18.1 4.4-18.1 27.2 0 31.6z" />
            </svg>
        </button>
    </div>

    <style>
        @media (max-width: 480px) {
            .btn-primary {
                top: 72%;
                left: 38.5%;
                padding: 0px 0px;
                font-size: 9px;
                min-height: 26px;
                height: 26px;
                border-radius: 14px;
            }

            .btn-primary .btn-primary-content {
                padding: 6px;
                margin-left: 3px;
                font-size: 10px;
                letter-spacing: -0.06em;
            }
        }
    </style>
    <dialog id="modal_regiser" class="modal">
        @include('components.website.partials.form-apply')
    </dialog>
</div>
