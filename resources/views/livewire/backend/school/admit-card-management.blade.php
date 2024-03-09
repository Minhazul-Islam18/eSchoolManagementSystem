<div>
    <main>
        <div class="container px-10 py-5">
            <header class="flex items-center flex-wrap mb-4" wire:ignore>
                <div class="w-full flex justify-start items-center flex-wrap">
                    <span class="shadow-md px-2 py-2 bg-emerald-500 rounded mr-2">
                        <i data-lucide="calendar-check" class="w-10"></i>
                    </span>
                </div>
            </header>
            <div>
                <h4 class="text-2xl mt-4 mb-2">Filter</h4>
                <form wire:submit='getAdmitCardSheet' class="flex gap-4 justify-start items-end">
                    <div class="">
                        <label for="" class="form-label">Class</label>
                        <select wire:model.blur='class_id' class="form-select rounded" wire:change='getSection'
                            id="">
                            <option value="">Select class</option>
                            @foreach ($this->classes as $item)
                                <option value="{{ $item->id }}"
                                    {{ $item->id == $this->class_id ? 'selected' : '' }}>
                                    {{ $item->class_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('class_id')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    @if ($this->groups != null)
                        <div class="">
                            <label for="group_id" class="form-label">Groups</label>
                            <select wire:model.blur='group_id' class="form-select rounded" wire:change='getExams'
                                wire:loading.class='opacity-50 blur-sm' wire:target='getSection' id="group_id">
                                <option value="">Select group</option>
                                @forelse ($this->groups as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $item->id == $this->group_id ? 'selected' : '' }}>
                                        {{ $item->group_name }}</option>
                                @empty
                                    <option value="" disabled>No group found</option>
                                @endforelse
                            </select>
                            @error('group_id')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    @else
                        <div class="">
                            <label for="section_id" class="form-label">Section</label>
                            <select wire:model.blur='section_id' class="form-select rounded" wire:change='getExams'
                                wire:loading.class='opacity-50 blur-sm' wire:target='getSection' id="section_id">
                                <option value="">Select section</option>
                                @forelse ($sections as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $item->id == $this->section_id ? 'selected' : '' }}>
                                        {{ $item->section_name }}</option>
                                @empty
                                    <option value="" disabled>No section found
                                    </option>
                                @endforelse
                            </select>
                            @error('section_id')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    @endif
                    <div class="">
                        <label for="exam_id" class="form-label">Exams</label>
                        <select wire:model.blur='exam_id' class="form-select rounded"
                            wire:loading.class='opacity-50 blur-sm' wire:target='getExams' id="exam_id">
                            <option value="">Select exam</option>
                            @forelse ($exams as $item)
                                <option value="{{ $item->id }}"
                                    {{ $item->id == $this->exam_id ? 'selected' : '' }}>
                                    {{ $item->exam_name }}</option>
                            @empty
                                <option value="" disabled>No exam found
                                </option>
                            @endforelse
                        </select>
                        @error('exam_id')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="px-12 py-2 bg-emerald-500/90 hover:bg-emerald-500 rounded-full"
                        wire:click="$refresh">Search</button>
                </form>
            </div>
            @php
                $school = school();
            @endphp
            <div class="my-4 relative h-[250px] flex items-center justify-center transition-all duration-200 ease-in-out"
                wire:loading wire:target='getCollectionSheet'>
                <div class="loader">
                    <div class="cell d-0"></div>
                    <div class="cell d-1"></div>
                    <div class="cell d-2"></div>

                    <div class="cell d-1"></div>
                    <div class="cell d-2"></div>


                    <div class="cell d-2"></div>
                    <div class="cell d-3"></div>


                    <div class="cell d-3"></div>
                    <div class="cell d-4"></div>


                </div>
            </div>
            <div class="flex flex-col sm:flex-row gap-x-2 items-center justify-between mt-3 mb-2 sm:mt-5 sm:mb-3"
                x-data="{ showEl: @entangle('showAdmitSheat') }">
                <div>
                    <button type="button" id="print" wire:ignore x-show="showEl"
                        class="px-6 py-2 text-white font-sm text-sm rounded bg-sky-600 flex gap-3 mt-3 mb-4 items-center">
                        {{ 'Print' }}
                        <i class="text-sm" data-lucide="printer" wire:ignore></i>
                    </button>
                </div>

                <div class="border-l-4 border-red-500 bg-red-500/25 py-4 pl-2 pr-4 rounded-sm">
                    <span
                        class=" font-bold">{{ __('Note: Please set scale to 70 and orientation to portrait in print window.') }}</span>
                </div>
            </div>
            <div class=" grid columns-2 grid-cols-1 sm:grid-cols-2 gap-3" id="printPage">
                <div class="px-5 pt-4 pb-5 border-2 border-slate-800 rounded-sm mb-3">
                    <h3 class=" font-semibold uppercase text-center text-amber-500 text-[1.05rem]">
                        {{ $school?->institute_name }}</h3>
                    <p class="text-center text-[.65rem]">{{ $school?->institute_address }}</p>
                    <h6 class="text-[.95rem] font-semibold text-center text-sky-500">Admit card</h6>
                    <h6 class="text-[.90rem] font-semibold text-center text-emerald-700">{{ $exam?->exam_name }}</h6>
                    <ul class=" flex flex-col gap-y-2 mt-3">
                        <li class=" flex flex-row">
                            <span class="font-semibold w-[25%] flex flex-end">Student name:</span>
                            <span class=" border-b border-slate-400 w-[75%]"></span>
                        </li>
                        <li class=" flex flex-row">
                            <span class="font-semibold w-[10%] flex flex-end">Class:</span>
                            <span class=" border-b border-slate-400 w-[90%]"></span>
                        </li>
                        <li class=" flex flex-row">
                            <span class="font-semibold w-[12%] flex items-end">Section:</span>
                            <span class=" border-b border-slate-400 w-[88%]"></span>
                        </li>
                        <li class=" flex flex-row">
                            <div class="w-[60%] flex">
                                <span class="font-semibold w-[20%] flex items-end">Roll No:</span>
                                <span class=" border-b border-slate-400 w-[80%]"></span>
                            </div>
                            <div class="w-[40%] flex items-end">
                            </div>
                        </li>
                        <li class=" flex flex-row">
                            <div class="w-[60%] flex">
                            </div>
                            <div class="w-[40%] flex items-end">
                                <span
                                    class=" pt-[.2rem] border-b border-slate-400 w-full text-center">{{ __('Principle') }}</span>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="px-5 pt-4 pb-5 border-2 border-slate-800 rounded-sm mb-3">
                    <h3 class=" font-semibold uppercase text-center text-amber-500 text-[1.05rem]">
                        {{ $school?->institute_name }}</h3>
                    <p class="text-center text-[.65rem]">{{ $school?->institute_address }}</p>
                    <h6 class="text-[.95rem] font-semibold text-center text-sky-500">Admit card</h6>
                    <h6 class="text-[.90rem] font-semibold text-center text-emerald-700">{{ $exam?->exam_name }}</h6>
                    <ul class=" flex flex-col gap-y-2 mt-3">
                        <li class=" flex flex-row">
                            <span class="font-semibold w-[25%] flex flex-end">Student name:</span>
                            <span class=" border-b border-slate-400 w-[75%]"></span>
                        </li>
                        <li class=" flex flex-row">
                            <span class="font-semibold w-[10%] flex flex-end">Class:</span>
                            <span class=" border-b border-slate-400 w-[90%]"></span>
                        </li>
                        <li class=" flex flex-row">
                            <span class="font-semibold w-[12%] flex items-end">Section:</span>
                            <span class=" border-b border-slate-400 w-[88%]"></span>
                        </li>
                        <li class=" flex flex-row">
                            <div class="w-[60%] flex">
                                <span class="font-semibold w-[20%] flex items-end">Roll No:</span>
                                <span class=" border-b border-slate-400 w-[80%]"></span>
                            </div>
                            <div class="w-[40%] flex items-end">
                            </div>
                        </li>
                        <li class=" flex flex-row">
                            <div class="w-[60%] flex">
                            </div>
                            <div class="w-[40%] flex items-end">
                                <span
                                    class=" pt-[.2rem] border-b border-slate-400 w-full text-center">{{ __('Principle') }}</span>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="px-5 pt-4 pb-5 border-2 border-slate-800 rounded-sm mb-3">
                    <h3 class=" font-semibold uppercase text-center text-amber-500 text-[1.05rem]">
                        {{ $school?->institute_name }}</h3>
                    <p class="text-center text-[.65rem]">{{ $school?->institute_address }}</p>
                    <h6 class="text-[.95rem] font-semibold text-center text-sky-500">Admit card</h6>
                    <h6 class="text-[.90rem] font-semibold text-center text-emerald-700">{{ $exam?->exam_name }}</h6>
                    <ul class=" flex flex-col gap-y-2 mt-3">
                        <li class=" flex flex-row">
                            <span class="font-semibold w-[25%] flex flex-end">Student name:</span>
                            <span class=" border-b border-slate-400 w-[75%]"></span>
                        </li>
                        <li class=" flex flex-row">
                            <span class="font-semibold w-[10%] flex flex-end">Class:</span>
                            <span class=" border-b border-slate-400 w-[90%]"></span>
                        </li>
                        <li class=" flex flex-row">
                            <span class="font-semibold w-[12%] flex items-end">Section:</span>
                            <span class=" border-b border-slate-400 w-[88%]"></span>
                        </li>
                        <li class=" flex flex-row">
                            <div class="w-[60%] flex">
                                <span class="font-semibold w-[20%] flex items-end">Roll No:</span>
                                <span class=" border-b border-slate-400 w-[80%]"></span>
                            </div>
                            <div class="w-[40%] flex items-end">
                            </div>
                        </li>
                        <li class=" flex flex-row">
                            <div class="w-[60%] flex">
                            </div>
                            <div class="w-[40%] flex items-end">
                                <span
                                    class=" pt-[.2rem] border-b border-slate-400 w-full text-center">{{ __('Principle') }}</span>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="px-5 pt-4 pb-5 border-2 border-slate-800 rounded-sm mb-3">
                    <h3 class=" font-semibold uppercase text-center text-amber-500 text-[1.05rem]">
                        {{ $school?->institute_name }}</h3>
                    <p class="text-center text-[.65rem]">{{ $school?->institute_address }}</p>
                    <h6 class="text-[.95rem] font-semibold text-center text-sky-500">Admit card</h6>
                    <h6 class="text-[.90rem] font-semibold text-center text-emerald-700">{{ $exam?->exam_name }}</h6>
                    <ul class=" flex flex-col gap-y-2 mt-3">
                        <li class=" flex flex-row">
                            <span class="font-semibold w-[25%] flex flex-end">Student name:</span>
                            <span class=" border-b border-slate-400 w-[75%]"></span>
                        </li>
                        <li class=" flex flex-row">
                            <span class="font-semibold w-[10%] flex flex-end">Class:</span>
                            <span class=" border-b border-slate-400 w-[90%]"></span>
                        </li>
                        <li class=" flex flex-row">
                            <span class="font-semibold w-[12%] flex items-end">Section:</span>
                            <span class=" border-b border-slate-400 w-[88%]"></span>
                        </li>
                        <li class=" flex flex-row">
                            <div class="w-[60%] flex">
                                <span class="font-semibold w-[20%] flex items-end">Roll No:</span>
                                <span class=" border-b border-slate-400 w-[80%]"></span>
                            </div>
                            <div class="w-[40%] flex items-end">
                            </div>
                        </li>
                        <li class=" flex flex-row">
                            <div class="w-[60%] flex">
                            </div>
                            <div class="w-[40%] flex items-end">
                                <span
                                    class=" pt-[.2rem] border-b border-slate-400 w-full text-center">{{ __('Principle') }}</span>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="px-5 pt-4 pb-5 border-2 border-slate-800 rounded-sm mb-3">
                    <h3 class=" font-semibold uppercase text-center text-amber-500 text-[1.05rem]">
                        {{ $school?->institute_name }}</h3>
                    <p class="text-center text-[.65rem]">{{ $school?->institute_address }}</p>
                    <h6 class="text-[.95rem] font-semibold text-center text-sky-500">Admit card</h6>
                    <h6 class="text-[.90rem] font-semibold text-center text-emerald-700">{{ $exam?->exam_name }}</h6>
                    <ul class=" flex flex-col gap-y-2 mt-3">
                        <li class=" flex flex-row">
                            <span class="font-semibold w-[25%] flex flex-end">Student name:</span>
                            <span class=" border-b border-slate-400 w-[75%]"></span>
                        </li>
                        <li class=" flex flex-row">
                            <span class="font-semibold w-[10%] flex flex-end">Class:</span>
                            <span class=" border-b border-slate-400 w-[90%]"></span>
                        </li>
                        <li class=" flex flex-row">
                            <span class="font-semibold w-[12%] flex items-end">Section:</span>
                            <span class=" border-b border-slate-400 w-[88%]"></span>
                        </li>
                        <li class=" flex flex-row">
                            <div class="w-[60%] flex">
                                <span class="font-semibold w-[20%] flex items-end">Roll No:</span>
                                <span class=" border-b border-slate-400 w-[80%]"></span>
                            </div>
                            <div class="w-[40%] flex items-end">
                            </div>
                        </li>
                        <li class=" flex flex-row">
                            <div class="w-[60%] flex">
                            </div>
                            <div class="w-[40%] flex items-end">
                                <span
                                    class=" pt-[.2rem] border-b border-slate-400 w-full text-center">{{ __('Principle') }}</span>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="px-5 pt-4 pb-5 border-2 border-slate-800 rounded-sm mb-3">
                    <h3 class=" font-semibold uppercase text-center text-amber-500 text-[1.05rem]">
                        {{ $school?->institute_name }}</h3>
                    <p class="text-center text-[.65rem]">{{ $school?->institute_address }}</p>
                    <h6 class="text-[.95rem] font-semibold text-center text-sky-500">Admit card</h6>
                    <h6 class="text-[.90rem] font-semibold text-center text-emerald-700">{{ $exam?->exam_name }}</h6>
                    <ul class=" flex flex-col gap-y-2 mt-3">
                        <li class=" flex flex-row">
                            <span class="font-semibold w-[25%] flex flex-end">Student name:</span>
                            <span class=" border-b border-slate-400 w-[75%]"></span>
                        </li>
                        <li class=" flex flex-row">
                            <span class="font-semibold w-[10%] flex flex-end">Class:</span>
                            <span class=" border-b border-slate-400 w-[90%]"></span>
                        </li>
                        <li class=" flex flex-row">
                            <span class="font-semibold w-[12%] flex items-end">Section:</span>
                            <span class=" border-b border-slate-400 w-[88%]"></span>
                        </li>
                        <li class=" flex flex-row">
                            <div class="w-[60%] flex">
                                <span class="font-semibold w-[20%] flex items-end">Roll No:</span>
                                <span class=" border-b border-slate-400 w-[80%]"></span>
                            </div>
                            <div class="w-[40%] flex items-end">
                            </div>
                        </li>
                        <li class=" flex flex-row">
                            <div class="w-[60%] flex">
                            </div>
                            <div class="w-[40%] flex items-end">
                                <span
                                    class=" pt-[.2rem] border-b border-slate-400 w-full text-center">{{ __('Principle') }}</span>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="px-5 pt-4 pb-5 border-2 border-slate-800 rounded-sm mb-3">
                    <h3 class=" font-semibold uppercase text-center text-amber-500 text-[1.05rem]">
                        {{ $school?->institute_name }}</h3>
                    <p class="text-center text-[.65rem]">{{ $school?->institute_address }}</p>
                    <h6 class="text-[.95rem] font-semibold text-center text-sky-500">Admit card</h6>
                    <h6 class="text-[.90rem] font-semibold text-center text-emerald-700">{{ $exam?->exam_name }}</h6>
                    <ul class=" flex flex-col gap-y-2 mt-3">
                        <li class=" flex flex-row">
                            <span class="font-semibold w-[25%] flex flex-end">Student name:</span>
                            <span class=" border-b border-slate-400 w-[75%]"></span>
                        </li>
                        <li class=" flex flex-row">
                            <span class="font-semibold w-[10%] flex flex-end">Class:</span>
                            <span class=" border-b border-slate-400 w-[90%]"></span>
                        </li>
                        <li class=" flex flex-row">
                            <span class="font-semibold w-[12%] flex items-end">Section:</span>
                            <span class=" border-b border-slate-400 w-[88%]"></span>
                        </li>
                        <li class=" flex flex-row">
                            <div class="w-[60%] flex">
                                <span class="font-semibold w-[20%] flex items-end">Roll No:</span>
                                <span class=" border-b border-slate-400 w-[80%]"></span>
                            </div>
                            <div class="w-[40%] flex items-end">
                            </div>
                        </li>
                        <li class=" flex flex-row">
                            <div class="w-[60%] flex">
                            </div>
                            <div class="w-[40%] flex items-end">
                                <span
                                    class=" pt-[.2rem] border-b border-slate-400 w-full text-center">{{ __('Principle') }}</span>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="px-5 pt-4 pb-5 border-2 border-slate-800 rounded-sm mb-3">
                    <h3 class=" font-semibold uppercase text-center text-amber-500 text-[1.05rem]">
                        {{ $school?->institute_name }}</h3>
                    <p class="text-center text-[.65rem]">{{ $school?->institute_address }}</p>
                    <h6 class="text-[.95rem] font-semibold text-center text-sky-500">Admit card</h6>
                    <h6 class="text-[.90rem] font-semibold text-center text-emerald-700">{{ $exam?->exam_name }}</h6>
                    <ul class=" flex flex-col gap-y-2 mt-3">
                        <li class=" flex flex-row">
                            <span class="font-semibold w-[25%] flex flex-end">Student name:</span>
                            <span class=" border-b border-slate-400 w-[75%]"></span>
                        </li>
                        <li class=" flex flex-row">
                            <span class="font-semibold w-[10%] flex flex-end">Class:</span>
                            <span class=" border-b border-slate-400 w-[90%]"></span>
                        </li>
                        <li class=" flex flex-row">
                            <span class="font-semibold w-[12%] flex items-end">Section:</span>
                            <span class=" border-b border-slate-400 w-[88%]"></span>
                        </li>
                        <li class=" flex flex-row">
                            <div class="w-[60%] flex">
                                <span class="font-semibold w-[20%] flex items-end">Roll No:</span>
                                <span class=" border-b border-slate-400 w-[80%]"></span>
                            </div>
                            <div class="w-[40%] flex items-end">
                            </div>
                        </li>
                        <li class=" flex flex-row">
                            <div class="w-[60%] flex">
                            </div>
                            <div class="w-[40%] flex items-end">
                                <span
                                    class=" pt-[.2rem] border-b border-slate-400 w-full text-center">{{ __('Principle') }}</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </main>

</div>
@push('page-style')
    <style>
        @media print {
            @page {
                size: portrait;
            }
        }
    </style>
@endpush
@push('page-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.2/jQuery.print.min.js"
        integrity="sha512-t3XNbzH2GEXeT9juLjifw/5ejswnjWWMMDxsdCg4+MmvrM+MwqGhxlWeFJ53xN/SBHPDnW0gXYvBx/afZZfGMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('#print').on('click', function() {
            $("#printPage").print();
        });
    </script>
@endpush
