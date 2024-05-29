<div class="col-span-8 space-y-3 md:col-span-6 lg:col-span-6 relative">
    <x-website.partials.header main="true" title="{{ __('web.education_program') }}" textAlign="left" />
    <img src="{{ asset('files/images/banner_2.png') }}" alt="" class="w-full" />
    <button class="btn btn-primary absolute top-[75%] left-[44%] cursor-pointer"
        onclick="document.getElementById('modal_regiser').showModal()">
        {{ __('web.register_now') }}
    </button>
    <dialog id="modal_regiser" class="modal">
        @include('components.website.partials.form-apply')
    </dialog>
</div>

