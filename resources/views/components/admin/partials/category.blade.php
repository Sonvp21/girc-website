@if (!empty($category->children))
    <li>
        <details open>
            <summary>{{ app()->getLocale() === 'en' ? $category->title_en : $category->title }}</summary>
            <ul>
                @foreach ($category->children as $child)
                    @include('components.admin.partials.category', ['category' => $child])
                @endforeach
            </ul>
        </details>
    </li>
@else
    <li>
        <a href="{{ route('admin.categories.posts.index', $category->slug) }}">
            {{ app()->getLocale() === 'en' ? $category->title_en : $category->title }}
         </a>
         
    </li>
@endif
