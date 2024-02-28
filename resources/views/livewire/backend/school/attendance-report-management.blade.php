<div>
    <main class="container py-10">
        <header class="flex items-center flex-wrap mb-4" wire:ignore>
            <div class="w-full flex justify-start items-center flex-wrap">
                <span class="shadow-md px-2 py-2 bg-emerald-500 rounded mr-2">
                    <i data-lucide="calendar-check" class="w-10"></i>
                </span>
            </div>
        </header>
        <div class="mb-10">
            <h4 class="text-2xl mt-4 mb-2 uppercase border-b-4 border-lime-300">Filter</h4>
            {{-- <form wire:submit='getCollectionReport' class="flex gap-4 justify-start items-end"> --}}
            <div class="flex gap-4 justify-start items-end">
                <div class="">
                    <label for="" class="form-label">Class</label>
                    <select wire:model.blur='class_id' class="form-select rounded" wire:change='getSection'
                        id="">
                        <option value="">Select class</option>
                        @foreach ($this->classes as $item)
                            <option value="{{ $item->id }}" {{ $item->id == $this->class_id ? 'selected' : '' }}>
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
                        <select wire:model.blur='group_id' class="form-select rounded"
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
                        <select wire:model.blur='section_id' class="form-select rounded"
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
                <div x-data="{
                    selectedMonth: null,
                    showAlert: function() {
                        $wire.dispatch('set-month', {
                            selectedMonth: this.selectedMonth
                        });
                    }
                    {{-- alert('Start Date: ' + fromDate + '\nEnd Date: ' + endDate); --}}
                }" class="w-64">
                    <label for="months" class="block mb-2 text-sm font-medium text-gray-700">Select a month:</label>
                    <select x-model="selectedMonth" id="months" name="months" x-on:change="showAlert()"
                        class="block w-full px-4 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="" disabled selected>Select a month</option>
                        <option value="1">January</option>
                        <option value="2">February</option>
                        <option value="3">March</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="6">June</option>
                        <option value="7">July</option>
                        <option value="8">August</option>
                        <option value="9">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                </div>
                {{-- <div class="flex items-center">
                    <x-datetime-picker label="Select from date" placeholder="Form date" wire:model.defer="fromDate"
                        without-time="true" />
                    <span class="mx-4 text-gray-500">to</span>
                    <x-datetime-picker label="Select to date" placeholder="To date" wire:model.defer="toDate"
                        without-time="true" />
                </div> --}}

                <button wire:click="$refresh"
                    class="px-12 py-2 bg-emerald-500/90 hover:bg-emerald-500 rounded-full">Search</button>
            </div>
            {{-- </form> --}}
        </div>
        @php
            $school = school();
        @endphp
        <button type="button" id="print" wire:ignore
            class="px-6 py-2 text-white font-sm text-sm rounded bg-sky-600 flex gap-3 mt-3 mb-4 items-center">
            {{ 'Print' }}
            <i class="text-sm" data-lucide="printer"></i>
        </button>
        <div class="" id="reportTable">
            @if (!empty($r))
                <div class=" print:border-b print:border-slate-200"
                    style="padding-top: 2rem;
                    background-color: #0284c7;
                    margin-bottom: .4rem;
                    padding-bottom: 2rem;
                    padding-left: 1.5rem;
                    padding-right: 1.5rem">
                    <div class="flex w-100">
                        <div class=" w-3/12 flex justify-center border-r border-white">
                            <img class="w-[90px]" src="/storage/{{ $school->institute_logo }}" alt="">
                        </div>
                        <div class="w-9/12 flex flex-col items-center justify-center">
                            <h4 class=" font-semibold mb-2 text-lg">{{ $school->institute_name }}</h4>
                            <p>{{ $school->institute_address }}</p>
                        </div>
                    </div>
                </div>
                <div class="relative overflow-x-auto">
                    <div class="flex flex-row mb-3 w-full">
                        <strong class="flex gap-1 justify-end w-full">
                            <span class="text-success">Present = P</span>
                            <span class="text-danger">Absent = A</span>
                        </strong>
                        {{--  <div>
                            <x-native-select label="" placeholder="Show per page" :options="[5, 8, 10, 12, 15, 20, 50]"
                                wire:model.defer="perPage" />
                        </div> --}}
                    </div>
                    <table
                        class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 print:border pt-3 print:py-10 print:my-10"
                        style="margin-top: 1rem; margin-bottom: 1rem; padding-bottom: 1rem;">
                        <thead
                            class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 print:pt-5 print:mt-5">
                            <tr class=" print:border-b">
                                <th scope="col" class="px-6 py-3 print:border-r">
                                    Student ID
                                </th>
                                <th scope="col" class="px-6 py-3 print:border-r print:px-2 print:mx-2">Student Name
                                </th>
                                <th scope="col" class="px-6 py-3 print:border-r print:px-2 print:mx-2">Roll No.
                                </th>
                                @foreach ($attendanceDays as $item)
                                    <th scope="col" style="width: 20px;">{{ $item }}</th>
                                @endforeach
                                <th scope="col" class="purchase text-success">P</th>
                                <th scope="col" class="purchase text-danger">A</th>
                                {{-- <th scope="col" class="purchase text-primary">H</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($r as $index=>$item)
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 border-slate-200 dark:border-slate-800 print:border-slate-200">
                                    <td
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white print:border-r print:px-2 print:mx-2">
                                        {{ $item->student_id }}
                                    </td>
                                    <td
                                        class="px-6
                                        py-4 print:border-r print:px-2 print:mx-2">
                                        {{ $item->name_en }}
                                    </td>
                                    <td
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white print:border-r print:px-2 print:mx-2">
                                        {{ $item->student->roll ?? 'N/A' }}
                                    </td>
                                    @php
                                        $presentCount = $item->attendances->where('is_present', '===', 1)->count();
                                        $absentCount = $item->attendances->where('is_present', '===', 0)->count();
                                        $holidayCount = false;
                                    @endphp

                                    @foreach ($item->attendances as $i => $day)
                                        <td>
                                            <span
                                                class="text-xs {{ $day->is_present == 1 ? 'text-success' : 'text-danger' }} font-extrabold">{{ $day->is_present == 1 ? 'P' : 'A' }}</span>
                                        </td>
                                    @endforeach
                                    <td>
                                        <span class="purchase text-success font-bold">{{ $presentCount }}</span>
                                    </td>
                                    <td>
                                        <span class="purchase text-danger font-bold">{{ $absentCount }}</span>
                                    </td>
                                    {{-- <td>{{ $holidayCount === true ? 'H' : '' }}</td> --}}
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class=" text-center">{{ __('No records found') }}</td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                    {{-- <div class="mt-4">
                        {{ $paginatedData->links() }}
                    </div> --}}
                </div>
            @else
                <h5 class=" text-orange-400 text-xl font-extrabold">{{ 'Please select dropdown steps!' }}</h5>
            @endif
        </div>

    </main>
</div>
@push('page-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.2/jQuery.print.min.js"
        integrity="sha512-t3XNbzH2GEXeT9juLjifw/5ejswnjWWMMDxsdCg4+MmvrM+MwqGhxlWeFJ53xN/SBHPDnW0gXYvBx/afZZfGMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('#print').on('click', function() {
            $.print("#reportTable");
        });
    </script>
    <script>
        function getDates(selectedMonth) {
            // const year = new Date().getFullYear();
            const monthIndex = {
                January: 0,
                February: 1,
                March: 2,
                April: 3,
                May: 4,
                June: 5,
                July: 6,
                August: 7,
                September: 8,
                October: 9,
                November: 10,
                December: 11
            } [selectedMonth];


            // const startDate = new Date(year, monthIndex, 1).toLocaleDateString();
            // const endDate = new Date(year, monthIndex + 1, 0).toLocaleDateString();
            return {
                startDate,
                endDate
            };
        }
    </script>
@endpush
