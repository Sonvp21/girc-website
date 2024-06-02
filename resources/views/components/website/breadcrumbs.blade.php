@props([
    'route' => '/',
    'name' => null,
    ])

<li>
    <a href="{{ $route }}" class="text-red-900">
        @if(is_string($name))
            {{ $name }}
        @elseif($name)
            {{ app()->getLocale() === 'en' ? $name->title_en : $name->title }}
        @else
            @lang('web.home')
        @endif
    </a>
</li>