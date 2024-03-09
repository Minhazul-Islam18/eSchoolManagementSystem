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
            <div class="mb-3 sm:mb-4">
                <h4 class="text-2xl mt-4 mb-2">Filter</h4>
                <form wire:submit='getStudentSummary' class="flex gap-4 justify-start items-end">
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

                    @if ((isset($class_id) && isset($section_id)) || isset($group_id))
                        <div class="">
                            <x-select label="Search a Student" wire:model.defer="student_id" :async-data="[
                                'api' => route('api.students-by-class-section', [
                                    'class_id' => $class_id,
                                    'section_id' => $section_id,
                                    'group_id' => $group_id,
                                ]),
                            ]"
                                option-label="name_en" option-value="id" />
                            @error('student_id')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    @endif

                    <button type="submit" class="px-12 py-2 bg-emerald-500/90 hover:bg-emerald-500 rounded-full"
                        wire:click="">Search</button>
                </form>
            </div>
            {{-- Student summary --}}
            @php
                $school = school();
            @endphp
            <button id="print" class="px-6 py-3 rounded-sm bg-sky-500 uppercase font-semibold mb-3">Print</button>
            <section class=" bg-white" id="summary">
                <div class="px-10 py-12">
                    <div class="sp-header w-full flex flex-col sm:flex-row">
                        <div class="w-6/12 flex flex-row">
                            <img class="w-48" src="/storage/{{ $school->institute_logo }}" alt="">
                            <div class="w-52 pl-4">
                                <h2 class=" text-3xl uppercase font-extfrabold font-black">
                                    {{ $school->institute_name }}</h2>
                                <p class=" text-xs text-slate-400/80">{{ $school->institute_address }}</p>
                            </div>
                        </div>
                        <div class="w-2/12"></div>
                        <div class="flex justify-end items-start w-4/12">
                            <ul class="flex flex-col gap-x-2">
                                <li> <span class=" font-semibold text-md">Student Name:</span>
                                    {{ $student?->name_en ?? 'N/A' }}</li>
                                <li><span class=" font-semibold text-md">Student ID:</span>
                                    {{ $student?->student_id ?? 'N/A' }}</li>
                                <li><span class=" font-semibold text-md">Class:</span>
                                    {{ $class?->class_name ?? 'N/A' }}</li>
                                <li><span class=" font-semibold text-md">Section/ Group:</span>
                                    {{ $section?->section_name ?? ($group?->group_name ?? 'N/A') }}</li>
                                <li><span class=" font-semibold text-md">Roll no:</span>
                                    {{ $student?->roll_no ?? 'N/A' }}</li>
                            </ul>
                        </div>
                    </div>

                    <div class="sp-body">
                        <div class="relative overflow-x-auto mt-8">
                            <table
                                class="border-separate print:border-collapse w-full text-sm text-left rtl:text-right print:border print:border-slate-600/70 py-4 print:my-4">
                                <thead
                                    class="text-xs text-white uppercase bg-blue-500 print:bg-blue-500 dark:bg-blue-700 dark:text-white gap-2">
                                    <tr class="print:border-b print:border-slate-600/70">
                                        <th scope="col"
                                            class="px-6 py-3 w-[60%] print:border-r print:border-slate-600/70">
                                            Payment type
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 w-[20%] print:border-r print:border-slate-600/70">
                                            Paid amount
                                        </th>
                                        <th scope="col" class="px-6 py-3 w-[20%]">
                                            Due amount
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="bg-sky-200/20 print:border-b print:border-slate-600/70">
                                        @php
                                            $total_monthly_due_amount = 0;
                                            $total_monthly_paid_amount = 0;
                                            if (isset($this->student)) {
                                                foreach ($this->student?->monthlyFees as $item) {
                                                    $total_monthly_due_amount += $item->pivot->due_amount;
                                                }
                                                foreach ($this->student?->monthlyFees as $item) {
                                                    $total_monthly_due_amount += $item->pivot->paid_amount;
                                                }
                                            }
                                        @endphp
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap print:border-r print:border-slate-600/70">
                                            {{ __('Monthly fees') }}
                                        </th>
                                        <td class="px-6 py-4 print:border-r print:border-slate-600/70">
                                            {{ $total_monthly_due_amount ?? 0 }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $total_monthly_paid_amount ?? 0 }}
                                        </td>
                                    </tr>

                                    <tr class="bg-sky-200/20 print:border-b print:border-slate-600/70">
                                        @php
                                            $total_admission_fee_due_amount = 0;
                                            $total_admission_fee_paid_amount = 0;
                                            if (isset($this->student)) {
                                                foreach ($this->student?->admissionFees as $item) {
                                                    $total_admission_fee_due_amount += $item->pivot->due_amount;
                                                }
                                                foreach ($this->student?->admissionFees as $item) {
                                                    $total_admission_fee_due_amount += $item->pivot->paid_amount;
                                                }
                                            }
                                        @endphp
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap print:border-r print:border-slate-600/70">
                                            {{ __('Admission fees') }}
                                        </th>
                                        <td class="px-6 py-4 print:border-r print:border-slate-600/70">
                                            {{ $total_admission_fee_due_amount ?? 0 }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $total_admission_fee_paid_amount ?? 0 }}
                                        </td>
                                    </tr>

                                    <tr
                                        class="bg-sky-200/20 border-b dark:border-gray-700 print:border-b print:border-slate-600/70">
                                        @php
                                            $total_additional_fee_due_amount = 0;
                                            $total_additional_fee_paid_amount = 0;
                                            if (isset($this->student)) {
                                                foreach ($this->student?->fees as $item) {
                                                    $total_additional_fee_due_amount += $item->pivot->due_amount;
                                                }
                                                foreach ($this->student?->fees as $item) {
                                                    $total_additional_fee_due_amount += $item->pivot->paid_amount;
                                                }
                                            }
                                        @endphp
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap print:border-r print:border-slate-600/70">
                                            {{ __('Additional fees') }}
                                        </th>
                                        <td class="px-6 py-4 print:border-r print:border-slate-600/70">
                                            {{ $total_additional_fee_due_amount ?? 0 }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $total_additional_fee_paid_amount ?? 0 }}
                                        </td>
                                    </tr>
                                    <!-- Summary -->
                                    <tr
                                        class="bg-white border-b dark:border-gray-700 print:border-b print:border-slate-600/70">
                                        <th colspan="" scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap print:border-r print:border-slate-600/70">
                                        </th>
                                        <td
                                            class="px-6 py-4 bg-blue-700 text-white print:border-r print:border-slate-600/70">
                                            {{ __('Due amount') }}
                                        </td>
                                        <td class="px-6 py-4 text-right bg-blue-700 text-white">
                                            @php
                                                $total_due =
                                                    $total_additional_fee_due_amount +
                                                    $total_admission_fee_due_amount +
                                                    $total_monthly_due_amount;
                                            @endphp
                                            {{ $total_due ?? 0 }}
                                        </td>
                                    </tr>
                                    <tr
                                        class="bg-white border-b dark:border-gray-700 print:border-b print:border-slate-600/70">
                                        <th colspan="" scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap print:border-r print:border-slate-600/70">
                                        </th>
                                        <td
                                            class="px-6 py-4 bg-blue-700 text-white print:border-r print:border-slate-600/70">
                                            {{ __('Paid amount') }}
                                        </td>
                                        <td class="px-6 py-4 text-right bg-blue-700 text-white">
                                            @php
                                                $total_paid =
                                                    $total_additional_fee_paid_amount +
                                                    $total_admission_fee_paid_amount +
                                                    $total_monthly_paid_amount;
                                            @endphp
                                            {{ $total_paid ?? 0 }}
                                        </td>
                                    </tr>
                                    <tr
                                        class="bg-white border-b dark:border-gray-700 print:border-b print:border-slate-600/70">
                                        <th colspan="" scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap print:border-r print:border-slate-600/70">
                                        </th>
                                        <td
                                            class="px-6 py-4 bg-blue-700 text-white print:border-r print:border-slate-600/70">
                                            Total amount
                                        </td>
                                        <td class="px-6 py-4 text-right bg-blue-700 text-white">
                                            {{ $total_due + $total_paid ?? 0 }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </section>
        </div>
    </main>
</div>
@push('page-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.2/jQuery.print.min.js"
        integrity="sha512-t3XNbzH2GEXeT9juLjifw/5ejswnjWWMMDxsdCg4+MmvrM+MwqGhxlWeFJ53xN/SBHPDnW0gXYvBx/afZZfGMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('#print').on('click', function() {
            $.print("#summary");
        });
    </script>
@endpush
