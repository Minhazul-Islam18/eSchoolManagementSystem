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
            <span class="flex gap-1 mt-3">
                <i data-lucide="clipboard-signature"></i>
                Accounts
                <i class="mdi mdi-chevron-down"></i>
            </span>
            <ul class="sub-menu hidden">
                <li class="menu-item">
                    <a href="{{ route('school.staffs-attendance') }}" data-fc-type="collapse" class="menu-link"
                        data-fc-parent="child-accordion">
                        <span class="menu-text"> {{ __('Collection') }} </span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('school.students-attendance') }}" data-fc-type="collapse" class="menu-link"
                        data-fc-parent="child-accordion">
                        <span class="menu-text"> {{ __('Collection Report') }} </span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('school.students-attendance') }}" data-fc-type="collapse" class="menu-link"
                        data-fc-parent="child-accordion">
                        <span class="menu-text"> {{ __('Collection Update') }} </span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('school.students-attendance') }}" data-fc-type="collapse" class="menu-link"
                        data-fc-parent="child-accordion">
                        <span class="menu-text"> {{ __('Receipt Print') }} </span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('school.students-attendance') }}" data-fc-type="collapse" class="menu-link"
                        data-fc-parent="child-accordion">
                        <span class="menu-text"> {{ __('Student Summary') }} </span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="{{ route('school.staffs') }}" class="menu-link">
                <i data-lucide="users"></i>
                Staffs
            </a>
        </li>
        <li class="menu-item">
            <span class="flex gap-1 mt-3">
                <i data-lucide="contact-2"></i>
                Students
                <i class="mdi mdi-chevron-down"></i>
            </span>

            <ul class="sub-menu hidden">
                <li class="menu-item">
                    <a class="menu-link " href="{{ route('school.admissions') }}" class="menu-link ">
                        <span class="menu-text"> {{ __('Admissions') }} </span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('school.classes') }}" data-fc-type="collapse" class="menu-link"
                        data-fc-parent="child-accordion">
                        <span class="menu-text"> {{ __('Class Wise Students List') }} </span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('school.monthly-fees') }}" data-fc-type="collapse" class="menu-link"
                        data-fc-parent="child-accordion">
                        <span class="menu-text"> {{ __('Sections Wise Students List') }} </span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('school.sections') }}" data-fc-type="collapse" class="menu-link"
                        data-fc-parent="child-accordion">
                        <span class="menu-text"> {{ __('Gender Wise Students List') }} </span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('school.groups') }}" data-fc-type="collapse" class="menu-link"
                        data-fc-parent="child-accordion">
                        <span class="menu-text"> {{ __('Group Wise Students List') }} </span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('school.generate-student-id-card') }}" data-fc-type="collapse" class="menu-link"
                        data-fc-parent="child-accordion">
                        <span class="menu-text"> {{ __('Student ID card generate - (Working)') }} </span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <span class="flex gap-1 mt-3">
                <i data-lucide="booeck"></i>
                Attendances
                <i class="mdi mdi-chevron-down"></i>
            </span>

            <ul class="sub-menu hidden">
                <li class="menu-item">
                    <a href="{{ route('school.staffs-attendance') }}" data-fc-type="collapse" class="menu-link"
                        data-fc-parent="child-accordion">
                        <span class="menu-text"> {{ __('Staffs attendance') }} </span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('school.students-attendance') }}" data-fc-type="collapse" class="menu-link"
                        data-fc-parent="child-accordion">
                        <span class="menu-text"> {{ __('Students attendance') }} </span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('under-development') }}" data-fc-type="collapse" class="menu-link"
                        data-fc-parent="child-accordion">
                        <span class="menu-text"> {{ __('Staff Attendance Report') }} </span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('under-development') }}" data-fc-type="collapse" class="menu-link"
                        data-fc-parent="child-accordion">
                        <span class="menu-text"> {{ __('Students Attendance Report') }} </span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <span class="flex gap-1 mt-3">
                <i data-lucide="booeck"></i>
                Results
                <i class="mdi mdi-chevron-down"></i>
            </span>

            <ul class="sub-menu hidden">
                <li class="menu-item">
                    <a class="menu-link " href="{{ route('school.grading') }}" class="menu-link ">
                        <span class="menu-text"> {{ __('Gradings Setup') }} </span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('under-development') }}" data-fc-type="collapse" class="menu-link"
                        data-fc-parent="child-accordion">
                        <span class="menu-text"> {{ __('Mark Entry') }} </span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('under-development') }}" data-fc-type="collapse" class="menu-link"
                        data-fc-parent="child-accordion">
                        <span class="menu-text"> {{ __('Tabulation Sheet') }} </span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('under-development') }}" data-fc-type="collapse" class="menu-link"
                        data-fc-parent="child-accordion">
                        <span class="menu-text"> {{ __('Transcript') }} </span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('under-development') }}" data-fc-type="collapse" class="menu-link"
                        data-fc-parent="child-accordion">
                        <span class="menu-text"> {{ __('Progress Report') }} </span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <span class="flex gap-1 mt-3">
                <i data-lucide="book-open-check"></i>
                Exams
                <i class="mdi mdi-chevron-down"></i>
            </span>

            <ul class="sub-menu hidden">
                <li class="menu-item">
                    <a class="menu-link " href="{{ route('school.exams') }}" class="menu-link ">
                        <span class="menu-text"> {{ __('All Exams') }} </span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('under-development') }}" data-fc-type="collapse" class="menu-link"
                        data-fc-parent="child-accordion">
                        <span class="menu-text"> {{ __('Seat Plan') }} </span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('under-development') }}" data-fc-type="collapse" class="menu-link"
                        data-fc-parent="child-accordion">
                        <span class="menu-text"> {{ __('Admit Card') }} </span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('under-development') }}" data-fc-type="collapse" class="menu-link"
                        data-fc-parent="child-accordion">
                        <span class="menu-text"> {{ __('Registration Card') }} </span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <span class="flex gap-1 mt-3">
                <i data-lucide="mail"></i>
                SMS
                <i class="mdi mdi-chevron-down"></i>
            </span>

            <ul class="sub-menu hidden">
                <li class="menu-item">
                    <a class="menu-link " href="{{ route('under-development') }}" class="menu-link ">
                        <span class="menu-text"> {{ __('SMS Balance') }} </span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('under-development') }}" data-fc-type="collapse" class="menu-link"
                        data-fc-parent="child-accordion">
                        <span class="menu-text"> {{ __('Send SMS') }} </span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('under-development') }}" data-fc-type="collapse" class="menu-link"
                        data-fc-parent="child-accordion">
                        <span class="menu-text"> {{ __('Class Wise Guardian SMS') }} </span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('under-development') }}" data-fc-type="collapse" class="menu-link"
                        data-fc-parent="child-accordion">
                        <span class="menu-text"> {{ __('SMS Template') }} </span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="{{ route('school.notices') }}" class="menu-link ">
                <i data-lucide="mailbox"></i>
                Notices
            </a>
        </li>
        <li class="menu-item">
            <span class=" flex gap-x-2 items-center mt-3">
                <i data-lucide="cog"></i>
                Settings
                <i class="mdi mdi-chevron-down"></i>
            </span>
            <ul class="sub-menu hidden">
                <li class="menu-item">
                    <a class="menu-link " href="{{ route('school.general-information') }}" class="menu-link ">
                        <span class="menu-text"> {{ __('General Settings') }} </span>
                    </a>
                </li>
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
                <li class="menu-item">
                    <span class="menu-link justify-between" data-fc-parent="child-accordion">
                        <span class="menu-text"> {{ __('Fees') }} </span>
                        <i class="mdi mdi-chevron-right"></i>
                    </span>
                    <ul class="sub-menu hidden" style="left: -150%;">
                        <li class="menu-item">
                            <a href="{{ route('school.monthly-fees') }}" class="menu-link">
                                <span class="menu-text"> {{ __('Monthly fees') }} </span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('school.all-fees') }}">
                                <span class="menu-text"> {{ __('All Fees') }} </span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('under-development') }}" class="menu-link"
                                data-fc-parent="child-accordion">
                                <span class="menu-text"> {{ __('Class Wise Admission Fees') }} </span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('under-development') }}" class="menu-link"
                                data-fc-parent="child-accordion">
                                <span class="menu-text"> {{ __('Class Wise Monthly Fees') }} </span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('under-development') }}" class="menu-link"
                                data-fc-parent="child-accordion">
                                <span class="menu-text"> {{ __('All Additional Fees') }} </span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
    @endif
</ul>
