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
                <h4 class="text-2xl mt-4 mb-2">Search for students</h4>
                <div class="flex gap-4 justify-start items-end">
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
                            <select wire:model.blur='group_id' class="form-select rounded"
                                wire:loading.class='opacity-50 blur-sm' wire:target='getSection' {{-- wire:change='getStudents' --}}
                                id="group_id">
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

                    <button type="button" class="px-12 py-2 bg-emerald-500/90 hover:bg-emerald-500 rounded-full"
                        wire:click="$wire.$refresh()">Search</button>
                </div>
            </div>

            <div class="my-4 relative h-[250px] flex items-center justify-center transition-all duration-200 ease-in-out"
                wire:loading>
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


            <div class=" border-dashed border-4 rounded-lg py-8 px-4 mt-4 border-orange-400">
                @if (!empty($stds))
                    <div class="relative overflow-x-auto">
                        <div class="flex sm:justify-between flex-col sm:flex-row mb-3">
                            <div>
                                <x-input type="text" wire:model.live.debounce.300ms="search" icon="search"
                                    placeholder="Search" hint="Search using Name or Roll"></x-input>
                            </div>

                            <div>
                                <x-native-select label="" placeholder="Show per page" :options="[5, 8, 10, 12, 15, 20, 50]"
                                    wire:model.defer="perPage" />
                            </div>
                        </div>
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Roll
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Gender
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($stds as $item)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $item->name_en }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $item->roll }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="capitalize">{{ $item->gender }}</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <x-dropdown>
                                                <x-dropdown.header label="Aections">
                                                    <x-dropdown.item icon="plus-circle" label="Collect"
                                                        onclick="$openModal('feeModal')"
                                                        wire:click='collectFees({{ $item->id }})' />
                                                </x-dropdown.header>
                                            </x-dropdown>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class=" text-center">{{ __('No students found') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ !empty($stds) ? $stds->links() : null }}
                    </div>
                @else
                    <h5 class=" text-orange-400 text-xl font-extrabold">{{ 'Please select dropdown steps!' }}</h5>
                @endif

            </div>
        </div>

        <!-- Modal --->
        <x-modal name="feeModal" blur>

            <x-card title="Fee collection" wire:loading.class=' blur-sm' wire:target='updateFeeStatus'>
                <form wire:submit='updateFeeStatus()' class=" flex py-2 gap-y-3 flex-col">
                    <x-errors title="We found {errors} validation error(s)" />
                    @php
                        $admissionFeeDue = [];
                    @endphp
                    @if (!empty($editable_student->admission_fees)) @php
                        $admissionFeeDue = collect($editable_student->admission_fees)->filter(function ($fee) {
                            return $fee->pivot->status === 0;
                        });
                    @endphp
                        @if ($admissionFeeDue->isNotEmpty())
                            @dd($admissionFeeDue)
                            <span
                                class="font-sm font-black text-sky-500 pb-1 border-b block">{{ __('Admission Fees') }}</span>
                            @foreach ($admissionFeeDue as $index => $item)
                                <div class="border px-3 border-black relative mt-3 pb-3 pt-5"
                                    wire:key='{{ $index }}'>

                                    <x-inputs.number class="mb-2" label="Fee amount" placeholder="Enter amount"
                                        corner-hint="Due: {{ $item->pivot->due_amount }}"
                                        wire:model.defer="admission_fees.{{ $item->pivot->id }}.amount" />

                                    <x-native-select label="Select Status" :options="[
                                        ['name' => 'Select status', 'id' => null],
                                        ['name' => 'Paid', 'id' => 1],
                                        ['name' => 'Unpaid', 'id' => 0],
                                    ]" option-label="name"
                                        option-value="id"
                                        wire:model="admission_fees.{{ $item->pivot->id }}.status" />
                                </div>
                            @endforeach
                        @else
                            {{ __('No Admission fee due') }}
                        @endif
                    @endif



                    @php
                        $monthlyFeeDue = [];
                    @endphp
                    @if (!empty($editable_student)) @php
                        $monthlyFeeDue = collect($editable_student->monthly_fees)->filter(function ($fee) {
                            return $fee->pivot->status === 0;
                        });
                    @endphp
                        @if ($monthlyFeeDue->isNotEmpty())
                            <span
                                class="font-sm font-black text-sky-500 pb-1 border-b block">{{ __('Monthly Fees') }}</span>
                            @foreach ($monthlyFeeDue as $index => $item)
                                <div class="border px-3 border-black relative mt-3 pb-3 pt-5"
                                    wire:key='{{ $index }}'>
                                    <span class="absolute top-[-12px] left-2 bg-white text-black"
                                        style="top: -12px; padding: 0 14px; border: 1px solid #000;">
                                        {{ $item->pivot->month }}
                                    </span>

                                    <x-inputs.number class="mb-2" label="Name" placeholder="Enter amount"
                                        corner-hint="Due: {{ $item->pivot->due_amount }}"
                                        wire:model.defer="monthly_fees.{{ $item->pivot->id }}.amount" />

                                    <x-native-select label="Select Status" :options="[
                                        ['name' => 'Select status', 'id' => null],
                                        ['name' => 'Paid', 'id' => 1],
                                        ['name' => 'Unpaid', 'id' => 0],
                                    ]" option-label="name"
                                        option-value="id" wire:model="monthly_fees.{{ $item->pivot->id }}.status" />
                                </div>
                            @endforeach
                        @else
                            {{ __('No Monthly fee due') }}
                        @endif
                    @endif





                    {{-- @dd($editable_student->fees) --}}

                    @php
                    $additionalDueFees = []; @endphp
                    @if (!empty($editable_student)) @php
                        $additionalDueFees = collect($editable_student->fees)->filter(function ($fee) {
                            return $fee->pivot->status == 'Unpaid';
                        });
                    @endphp

                        @if ($additionalDueFees->isNotEmpty())
                            <span
                                class="font-sm font-black text-sky-500 pb-1 border-b block">{{ __('Additional Fees') }}</span>
                            @foreach ($additionalDueFees as $index => $item)
                                <div class="border px-3 border-black relative mt-3 pb-3 pt-5"
                                    wire:key='{{ $index }}'>
                                    {{-- <span class="absolute top-[-12px] left-2 bg-white text-black"
                                        style="top: -12px; padding: 0 14px; border: 1px solid #000;">
                                        {{ $item->pivot->month }}
                                    </span> --}}

                                    <x-inputs.number class="mb-2" label="Name" placeholder="Enter amount"
                                        corner-hint="Due: {{ $item->pivot->due_amount }}"
                                        wire:model.defer="additional_fees.{{ $item->pivot->id }}.amount" />

                                    <x-native-select label="Select Status" :options="[
                                        ['name' => 'Select status', 'id' => null],
                                        ['name' => 'Paid', 'id' => 'Paid'],
                                        ['name' => 'Unpaid', 'id' => 'Unpaid'],
                                    ]" option-label="name"
                                        option-value="id"
                                        wire:model="additional_fees.{{ $item->pivot->id }}.status" />
                                </div>
                            @endforeach
                        @else
                            {{ __('No Additional fee due') }}
                        @endif
                    @endif

                    {{-- @if (!empty($editable_student->fees))
                        <span
                            class="font-sm font-black text-sky-500 pb-1 border-b block">{{ __('Additional Fees') }}</span>
                        @foreach ($editable_student->fees as $index => $item)
                            <div class="border px-3 border-black relative mt-3 pb-3 pt-5">
                                <span class="absolute top-[-12px] left-2 bg-white text-black"
                                    style="top: -12px;padding: 0 14px;border: 1px solid #000;">
                                    {{ $item->name }}
                                </span>
                                <x-input class="" label="Name" placeholder="Enter amount"
                                    corner-hint="Ex: 250"
                                    wire:model.defer="additional_fees.{{ $index }}.amount" />

                                <x-select label="Select Status" placeholder="Select status" :options="['Paid', 'Unpaid']"
                                    wire:model.defer="additional_fees.{{ $index }}.status" />
                            </div>
                        @endforeach
                    @endif --}}

                    <x-button positive label="Save" type="submit" />
                </form>
            </x-card>

        </x-modal>
    </main>

</div>

@push('page-style')
    <style>
        .loader {
            --cell-size: 52px;
            --cell-spacing: 1px;
            --cells: 3;
            --total-size: calc(var(--cells) * (var(--cell-size) + 2 * var(--cell-spacing)));
            display: flex;
            flex-wrap: wrap;
            width: var(--total-size);
            height: var(--total-size);
        }

        .cell {
            flex: 0 0 var(--cell-size);
            margin: var(--cell-spacing);
            background-color: transparent;
            box-sizing: border-box;
            border-radius: 4px;
            animation: 1.5s ripple ease infinite;
        }

        .cell.d-1 {
            animation-delay: 100ms;
        }

        .cell.d-2 {
            animation-delay: 200ms;
        }

        .cell.d-3 {
            animation-delay: 300ms;
        }

        .cell.d-4 {
            animation-delay: 400ms;
        }

        .cell:nth-child(1) {
            --cell-color: #00FF87;
        }

        .cell:nth-child(2) {
            --cell-color: #0CFD95;
        }

        .cell:nth-child(3) {
            --cell-color: #17FBA2;
        }

        .cell:nth-child(4) {
            --cell-color: #23F9B2;
        }

        .cell:nth-child(5) {
            --cell-color: #30F7C3;
        }

        .cell:nth-child(6) {
            --cell-color: #3DF5D4;
        }

        .cell:nth-child(7) {
            --cell-color: #45F4DE;
        }

        .cell:nth-child(8) {
            --cell-color: #53F1F0;
        }

        .cell:nth-child(9) {
            --cell-color: #60EFFF;
        }

        /*Animation*/
        @keyframes ripple {
            0% {
                background-color: transparent;
            }

            30% {
                background-color: var(--cell-color);
            }

            60% {
                background-color: transparent;
            }

            100% {
                background-color: transparent;
            }
        }
    </style>
@endpush
@push('page-script')
    <script>
        document.addEventListener('livewire:init', function() {
            Livewire.on('student', event => {
                console.log(event);
                // alert(event[0].ids);
                // Livewire.dispatch('present-getting-ids', {
                //     ids: event[0].ids
                // })
            });

            Livewire.on('close-modal', event => {
                // Alpine.store('showModal', false);
                $wireui.closeModal('edit-modal');
            });
        });
    </script>
@endpush
