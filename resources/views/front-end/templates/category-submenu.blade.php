@foreach($children as $child)

    <li>
        <a href="{{ route('shop.category.show', $child->slug) }}">
            {{ $child->name }}
        </a>
        @if ($child->children->isNotEmpty())
            <ul>
                @include('front-end.templates.category-submenu', ['children' => $child->children])
            </ul>
        @endif
    </li>
@endforeach


