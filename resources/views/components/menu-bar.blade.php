{{-- This Component is for showing Parent elements for dropdown in Top nav/Sidebar --}}
@php
    $user = auth()->user();
@endphp
<ul class="menu" data-fc-type="accordion" id="parent-accordion">
    @can('app.dashboard', $user)
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
    @if (($user->role->slug === 'school') | ($user->role->slug === 'demo_school'))
        <li class="menu-item">
            <a href="{{ route('school.index') }}" class="menu-link ">
                <i data-lucide="layout-dashboard"></i>
                Dashboard
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('school.staffs') }}" class="menu-link ">
                <i data-lucide="user-square"></i>
                Staffs
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('school.all-fees') }}" class="menu-link ">
                <i data-lucide="banknote"></i>
                Fees
            </a>
        </li>
        <li class="menu-item">
            <a class="menu-link " href="{{ route('school.admissions') }}" class="menu-link ">
                <i data-lucide="contact-2"></i>
                Admissions
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('school.general-information') }}" class="menu-link ">
                <i data-lucide="cog"></i>
                Settings
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('school.notices') }}" class="menu-link ">
                <i data-lucide="mailbox"></i>
                Notices
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('school.grading') }}" class="menu-link">
                <i data-lucide="candlestick-chart"></i>
                Gradings
            </a>
        </li>
        <li class="menu-item">
            <span class="flex gap-1 mt-3">
                <i data-lucide="graduation-cap"></i>
                Academic
                <i class="mdi mdi-chevron-down"></i>
            </span>

            <ul class="sub-menu hidden">
                <li class="menu-item">
                    <a href="{{ route('school.classes') }}" data-fc-type="collapse" class="menu-link"
                        data-fc-parent="child-accordion">
                        <span class="menu-text"> {{ __('Classes') }} </span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('school.sections') }}" data-fc-type="collapse" class="menu-link"
                        data-fc-parent="child-accordion">
                        <span class="menu-text"> {{ __('Sections') }} </span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('school.groups') }}" data-fc-type="collapse" class="menu-link"
                        data-fc-parent="child-accordion">
                        <span class="menu-text"> {{ __('Groups') }} </span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('school.subjects') }}" data-fc-type="collapse" class="menu-link"
                        data-fc-parent="child-accordion">
                        <span class="menu-text"> {{ __('Subjects') }} </span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('school.routines') }}" data-fc-type="collapse" class="menu-link"
                        data-fc-parent="child-accordion">
                        <span class="menu-text"> {{ __('Routines') }} </span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('school.syllabuses') }}" data-fc-type="collapse" class="menu-link"
                        data-fc-parent="child-accordion">
                        <span class="menu-text"> {{ __('Syllabi') }} </span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <span class="flex gap-1 mt-3">
                <i data-lucide="book-open-check"></i>
                Exam
                <i class="mdi mdi-chevron-down"></i>
            </span>
            <ul class="sub-menu hidden">
                <li class="menu-item">
                    <a href="{{ route('school.exams') }}" data-fc-type="collapse" class="menu-link"
                        data-fc-parent="child-accordion">
                        <span class="menu-text"> {{ __('All exams') }} </span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('school.exam-results') }}" data-fc-type="collapse" class="menu-link"
                        data-fc-parent="child-accordion">
                        <span class="menu-text"> {{ __('Results') }} </span>
                    </a>
                </li>
            </ul>
        </li>
    @endif
</ul>
