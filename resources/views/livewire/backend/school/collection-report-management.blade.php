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

                <div class="flex items-center">
                    <x-datetime-picker label="Select from date" placeholder="Form date" wire:model.defer="fromDate"
                        without-time="true" />
                    <span class="mx-4 text-gray-500">to</span>
                    <x-datetime-picker label="Select to date" placeholder="To date" wire:model.defer="toDate"
                        without-time="true" />
                </div>

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
            <i class="text-sm" data-lucide="printer" wire:ignore></i>
        </button>
        <div class="py-8 px-4 mt-4" id="reportTable">
            @if (!empty($paginatedData))
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
                    {{-- <div class="flex sm:justify-between flex-col sm:flex-row mb-3">
                        <div>
                            <x-native-select label="" placeholder="Show per page" :options="[5, 8, 10, 12, 15, 20, 50]"
                                wire:model.defer="perPage" />
                        </div>
                    </div> --}}
                    <table
                        class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 print:border pt-3 print:py-10 print:my-10"
                        style="margin-top: 1rem; margin-bottom: 1rem; padding-bottom: 1rem;">
                        <thead
                            class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 print:pt-5 print:mt-5">
                            <tr class=" print:border-b">
                                <th scope="col" class="px-6 py-3 print:border-r">
                                    #
                                </th>
                                <th scope="col" class="px-6 py-3 print:border-r print:px-2 print:mx-2">Student ID
                                </th>
                                <th scope="col" class="px-6 py-3 print:border-r print:px-2 print:mx-2">Student Name
                                </th>
                                <th scope="col" class="px-6 py-3 print:border-r print:px-2 print:mx-2">Class</th>
                                <th scope="col" class="px-6 py-3 print:border-r print:px-2 print:mx-2">Section/Group
                                </th>
                                <th scope="col" class="px-6 py-3 print:border-r print:px-2 print:mx-2">Payment Date
                                </th>
                                <th scope="col" class="px-6 py-3 print:px-2 print:mx-2">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($paginatedData as $index=>$item)
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 border-slate-200 dark:border-slate-800 print:border-slate-200">
                                    <td class="px-6 py-4 print:border-r">
                                        {{ $index + 1 }}
                                    </td>
                                    <td class="px-6 py-4 print:border-r print:px-2 print:mx-2">
                                        {{ $item->student->student_id }}
                                    </td>
                                    <td
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white print:border-r print:px-2 print:mx-2">
                                        {{ $item->student->name_en }}
                                    </td>
                                    <td class="px-6 py-4 print:border-r">
                                        {{ $item->studentClass->class_name }}
                                    </td>
                                    <td
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white print:border-r">
                                        {{ $item->studentClassSection->section_name ?? ($item->studentClassGroup->group_name ?? null) }}
                                    </td>
                                    <td class="px-6 py-4 print:border-r">
                                        <span
                                            class="">{{ carbon\Carbon::parse($item->updated_at)->format('g:i a l jS F Y') }}</span>
                                    </td>
                                    <td class="px-6 py-4 print:border-r">
                                        {{ $item->amount }}
                                    </td>
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
@endpush
