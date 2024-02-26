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

            <div class="">
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
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Payment ID
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Fee
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Total amount
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Transected amount
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Student
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($collections as $item)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        #{{ $item->payment_id }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $item->fee->fee_name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $item->fee->amount }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $item->amount }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $item->student->name_en }} </br>
                                        {{ $item->student->school_class->class_name }} </br>
                                        {{ isset($item->student->school_class_section) ? $item->student->school_class_section->section_name : '' }}
                                        </br>
                                        {{ isset($item->student->class_group) ? $item->student->class_group->group_name : '' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <x-dropdown>
                                            <x-dropdown.header label="Actions">
                                                <x-dropdown.item icon="pencil-alt" label="Edit"
                                                    onclick="$openModal('feeModal')"
                                                    wire:click='editTransection({{ $item->id }})' />
                                            </x-dropdown.header>
                                        </x-dropdown>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class=" text-center">{{ __('No records found') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ !empty($collections) ? $collections->links() : null }}
                </div>
            </div>

            <!-- Modal --->
            <x-modal name="feeModal" blur>

                <x-card title="Update fee collection" wire:loading.class=' blur-sm' wire:target='updateTransection'>
                    <form wire:submit='updateTransection()' class=" flex py-2 gap-y-3 flex-col">
                        <x-errors title="We found {errors} validation error(s)" />
                        <span>{{ 'Fee: ' . $editable_item?->fee?->fee_name }}</span>
                        <div class="border px-3 border-black relative mt-3 pb-3 pt-5">
                            <x-inputs.number class="mb-2" label="Fee amount" placeholder="Enter amount"
                                corner-hint="Due: {{ $relation?->due_amount }}" wire:model.defer="amount" />

                            <x-native-select label="Select Status" :options="[
                                ['name' => 'Select status', 'id' => null],
                                ['name' => 'Paid', 'id' => 1],
                                ['name' => 'Unpaid', 'id' => 0],
                            ]" option-label="name"
                                option-value="id" wire:model="status" />
                        </div>
                        <x-button positive label="Save" type="submit" wire:loading.attribute='disabled'
                            wire:target='updateFeeStatus' />
                    </form>
                </x-card>

            </x-modal>
        </div>
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
            });

            Livewire.on('close-modal', event => {
                // Alpine.store('showModal', false);
                $wireui.closeModal('edit-modal');
            });
        });
    </script>
@endpush
