@props([
    'route' => '/',
    'name' => null,
    ])

<li>
    <a href="{{ $route }}">
        @if(is_string($name))
            {{ $name }}
        @elseif($name)
            {{ app()->getLocale() === 'en' ? $name->title_en : $name->title }}
        @else
            @lang('web.home')
        @endif
    </a>
</li>