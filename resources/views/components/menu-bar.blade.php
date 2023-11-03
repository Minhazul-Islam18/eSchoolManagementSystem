{{-- This Component is for showing Parent elements for dropdown in Top nav/Sidebar --}}
<ul class="menu" data-fc-type="accordion" id="parent-accordion">
    @can('app.dashboard', auth()->user())
        @foreach ($menudata as $item)
            <li class="menu-item">
                <a href="{{ $item->url }}"
                    class="menu-link {{ !$item->childs->isEmpty() ? ' flex justify-between items-center' : null }}">
                    <span class="menu-icon"><i data-lucide="{{ $item->icon }}"></i></span>
                    <span class="menu-text"> {{ $item->title }} </span>
                    @if (!$item->childs->isEmpty())
                        <i class="mdi mdi-chevron-down"></i>
                    @endif
                </a>
                <ul class="sub-menu hidden">
                    @foreach ($item->childs()->orderBy('order', 'ASC')->get() as $item)
                        <li class="menu-item">
                            <a href="{{ $item->url }}" data-fc-type="collapse"
                                class="menu-link {{ !$item->childs->isEmpty() ? ' flex justify-between items-center' : null }}"
                                data-fc-parent="child-accordion">
                                <span class="menu-text"> {{ $item->title }} </span>
                                @if (!$item->childs->isEmpty())
                                    <i class="mdi mdi-chevron-down"></i>
                                @endif
                            </a>
                            @if (!$item->childs->isEmpty())
                                <x-MenuBarDropdown :items="$item
                                    ->childs()
                                    ->orderBy('order', 'ASC')
                                    ->get()" />
                            @endif
                        </li>
                    @endforeach
                </ul>

            </li>
        @endforeach
    @endcan
</ul>
