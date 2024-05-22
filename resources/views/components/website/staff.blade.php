<div>
    <h2 class="font-semibold text-green-700">@lang('web.staffs')</h2>
    <p class="mb-4 mt-3 text-4xl font-extrabold">@lang('web.staffs_title')</p>
    <p class="mb-6 text-slate-500">@lang('web.staffs_text')</p>
    <ul class="grid grid-cols-4 gap-5 py-5 backdrop-blur">
        @foreach ($departments as $department)
            <li class="flex items-center justify-center">
                <a href="#">
                    <figure class="flex flex-col items-center">
                        <img class="size-36 rounded-full"
                            src="{{ $department && $department->hasMedia('department_image') ? $department->getFirstMedia('department_image')->getUrl('thumb') : 'default-image-path.jpg' }}"
                            alt="{{ $department && $department->hasMedia('department_image') ? $department->getFirstMedia('department_image')->name : 'Default Image' }}" />
                        <figcaption class="mt-4 text-center text-sm font-bold text-blue-700">{{ $department->name }}
                        </figcaption>
                    </figure>
                </a>
            </li>
        @endforeach
    </ul>
</div>
