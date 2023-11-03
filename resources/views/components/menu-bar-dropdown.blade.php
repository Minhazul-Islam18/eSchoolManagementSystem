{{-- This Component is for showing child elements in Top nav/Sidebar --}}
@foreach ($dropdown as $item)
    <ul class="sub-menu hidden">
        <li class="menu-item">
            <a href="{{ $item->url }}" data-fc-type="collapse"
                class="menu-link {{ !$item->childs->isEmpty() ? ' flex justify-between items-center' : null }}"
                data-fc-parent="child-accordion">
                <span class="menu-text"> {{ $item->title }} </span>
                @if (!$item->childs->isEmpty())
                    <i data-lucide="{{ $item->icon }}"></i>
                @endif
            </a>
            @if (!$item->childs->isEmpty())
                <x-MenuBarDropdown :items="$item
                    ->childs()
                    ->orderBy('order', 'ASC')
                    ->get()" />
            @endif
        </li>
    </ul>
@endforeach
