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
                <form wire:submit='getCollectionSheet' class="flex gap-4 justify-start items-end">
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
                                wire:loading.class='opacity-50 blur-sm' wire:target='getSection' wire:change='getFees'
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
                                wire:loading.class='opacity-50 blur-sm' wire:target='getSection' wire:change='getFees'
                                id="section_id">
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
                        <label for="fee_id" class="form-label">Fees</label>
                        <select wire:model.blur='fee_id' class="form-select rounded"
                            wire:loading.class='opacity-50 blur-sm' wire:target='getFees' id="fee_id">
                            <option value="">Select fee</option>
                            @forelse ($fees as $item)
                                <option value="{{ $item->id }}"
                                    {{ $item->id == $this->fee_id ? 'selected' : '' }}>
                                    {{ $item->fee_name }}</option>
                            @empty
                                <option value="" disabled>No fee found
                                </option>
                            @endforelse
                        </select>
                        @error('fee_id')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>


                    <button type="submit" class="px-12 py-2 bg-emerald-500/90 hover:bg-emerald-500 rounded-full"
                        wire:click="$refresh">Search</button>
                </form>
            </div>

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
            <div class=" border-dashed border-4 rounded-lg py-8 px-4 mt-4 border-orange-400">
                @if ($attendanceSheat == true)
                    <div class="container mx-auto px-4 sm:px-8">
                        <div class="py-8">
                            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                                <div class="inline-block min-w-full shadow-md rounded-lg overflow-hidden">
                                    <table class="min-w-full leading-normal">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                                    ID <sub>[Student ID]</sub>
                                                </th>
                                                <th
                                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                                    Details
                                                </th>
                                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100">Status</th>
                                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($students as $item)
                                                {{-- @dd($item) --}}
                                                <tr>
                                                    <td>
                                                        {{ $item->id }}
                                                        <sub>{{ $item->student_id }}</sub>
                                                    </td>
                                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                        <div class="flex">
                                                            <div class="flex-shrink-0 w-10 h-10">
                                                                <img class="w-full h-full rounded-full"
                                                                    src="/storage/{{ $item->student_image }}"
                                                                    alt="" />
                                                            </div>
                                                            <div class="ml-3">
                                                                <p class="text-gray-900 whitespace-no-wrap">
                                                                    Name: {{ __($item->name_bn) }}
                                                                </p>
                                                                <p class="text-gray-600 whitespace-no-wrap">Roll:
                                                                    {{ __($item->roll) }}</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class=" text-center">
                                                        @foreach ($item->fees as $fee)
                                                            @if ($fee->pivot->status == 'Unpaid')
                                                                <span
                                                                    class="px-2 py-1 rounded bg-green-400/40 text-black">{{ __('Unpaid') }}</span>
                                                            @else
                                                                <span
                                                                    class="px-2 py-1 rounded bg-red-400/40 text-black">{{ __('Paid') }}</span>
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td
                                                        class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-right">
                                                        <x-button label="Edit"
                                                            wire:click="$set('student_id', {{ $item->id }})"
                                                            x-on:click="$openModal('edit-modal')" primary />
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="px-5 py-5 text-sm text-center">
                                                        {{ __('No students found') }}</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <h5 class=" text-orange-400 text-xl font-extrabold">{{ 'Please select dropdown steps!' }}</h5>
                @endif
            </div>
        </div>
        <x-modal name="edit-modal" blur>

            <x-card title="Edit">
                <form wire:submit='updateFeeStatus()' class=" flex py-2 gap-y-3 flex-col">

                    <x-input label="Name" placeholder="Enter amount" corner-hint="Ex: 250"
                        wire:model.blur='amount' />

                    <x-select label="Select Status" placeholder="Select status" :options="['Paid', 'Unpaid']"
                        wire:model.defer="status" />
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
