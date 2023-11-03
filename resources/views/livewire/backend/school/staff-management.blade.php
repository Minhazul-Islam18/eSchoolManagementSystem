<div x-data="{ openCEmodal: @entangle('openCEmodal'), openViewModal: false }">
    <main>
        <div class="container px-10 py-5">
            <header class="flex items-center flex-wrap mb-4" wire:ignore>
                <div class="w-1/2 flex justify-start items-center flex-wrap">
                    <span class="shadow-md px-2 py-2 bg-emerald-500 rounded mr-2">
                        <i data-lucide="user-square" class="w-10"></i>
                    </span>
                </div>
                <div class="w-1/2 flex justify-end items-center gap-3">
                    <button @click="openCEmodal = true" data-modal-target="CEmodal" data-modal-toggle="CEmodal"
                        class="bg-green-500 bg-opacity-25 border border-green-500 rounded flex items-center px-4 py-2 shahow-md hover:bg-opacity-100 transition fade gap-2">
                        <i data-lucide="plus-circle" class="w-4"></i>
                        Create
                    </button>
                </div>
            </header>

            <div id="CEmodal" tabindex="-1" aria-hidden="true" x-show="openCEmodal"
                class="fixed top-0 left-0 right-0 z-50 w-full p-4 md:inset-0 h- max-h-full justify-center items-center flex">
                <!-- Modal content -->
                <div
                    class="relative overflow-y-scroll bg-white rounded-lg shadow dark:bg-gray-700 w-2/3 h-[calc(100%-2vh)]">
                    <form action="" wire:submit='{{ $this->editable_item ? 'update' : 'store' }}'>
                        <!-- Modal header -->
                        <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                {{ $this->editable_item ? 'Edit' : 'Create' }} Staff
                            </h3>
                            <button type="button" @click="openCEmodal = false"
                                class="text-gray-400 bg-transparent hover:bg-red-500/50 hover:text-red-500 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-red-600"
                                data-modal-hide="CEmodal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-6 space-y-6" x-data="{ selectedStatus: @entangle('selectedStatus') }">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="">
                                    <img src="{{ $this->image != null ? $this->image->temporaryUrl() : '' }}"
                                        alt="">
                                    <label for="" class="form-label">Image</label>
                                    <input wire:model.blur='image' type="file" class="rounded" id="">
                                </div>
                                <div class="">
                                    <label for="" class="form-label">Name</label>
                                    <input wire:model.blur='name' type="text" class="form-input rounded"
                                        id="">
                                </div>
                                <div class="">
                                    <label for="" class="form-label">Type</label>
                                    <select wire:model.blur='type' class="form-select rounded" id="">
                                        <option value="teacher">Teacher</option>
                                        <option value="employee">Employee</option>
                                    </select>
                                </div>
                                <div class="">
                                    <label for="" class="form-label">Gender</label>
                                    <select wire:model.blur='gender' class="form-select rounded" id="">
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="intersex">Intersex</option>
                                    </select>
                                </div>
                                <div class="">
                                    <label for="" class="form-label">Educational qualification</label>
                                    <textarea wire:model.blur='educational_qualification' class="form-textarea" id="" cols="10"
                                        rows="5"></textarea>
                                </div>
                                <div class="">
                                    <label for="" class="form-label">Address</label>
                                    <textarea wire:model.blur='address' class="form-textarea" id="" cols="10" rows="5"></textarea>
                                </div>
                                <div class="">
                                    <label for="" class="form-label">E-mail</label>
                                    <input wire:model.blur='email' type="email" class="form-input rounded"
                                        id="">
                                </div>
                                <div class="">
                                    <label for="" class="form-label">Phone</label>
                                    <input wire:model.blur='phone' type="text" class="form-input rounded"
                                        id="">
                                </div>
                                <div class="">
                                    <label for="" class="form-label">Facebook ID</label>
                                    <input wire:model.blur='facebook' type="text" class="form-input rounded"
                                        id="">
                                </div>
                                <div class="">
                                    <label for="" class="form-label">Website</label>
                                    <input wire:model.blur='website' type="text" class="form-input rounded"
                                        id="">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Status</label>
                                <select wire:model.blur='status' class="form-select rounded" name=""
                                    id="" x-model="selectedStatus">
                                    <option value="" selected>Select status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                @error('menu_item_type')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div x-show="selectedStatus == 0" class="flex flex-wrap">
                                <div class="mb-3 w-full md:w-1/2">
                                    <label for="" class="form-label">Joined at</label>
                                    <input type="date" wire:model.blur='joined_at' class="form-input rounded"
                                        name="" id="" placeholder="">
                                </div>
                                <div class="mb-3 w-full md:w-1/2">
                                    <label for=""class="form-label">Resigned at</label>
                                    <input type="date" wire:model.blur='resigned_at' class="form-input rounded"
                                        name="" id="" placeholder="">
                                </div>
                            </div>
                        </div>
                        <!-- Modal footer -->
                        <div
                            class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                            <button type="submit"
                                class="text-white bg-green-500 hover:bg-green-400 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-success-600 dark:hover:bg-green-400 dark:focus:ring-green-200/50">
                                {{ $this->editable_item ? 'Update' : 'Save' }}</button>
                            @if ($this->editable_item)
                                <button type="button" wire:click='resetFields'
                                    class="text-white bg-red-500 hover:bg-red-400 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-success-600 dark:hover:bg-red-400 dark:focus:ring-red-200/50">
                                    {{ 'Cancel' }}</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
            <div id="ViewModal" tabindex="-1" aria-hidden="true" x-show="openViewModal"
                class="fixed top-0 left-0 right-0 z-50 w-full p-4 md:inset-0 h- max-h-full justify-center items-center flex">
                <!-- Modal content -->
                <div
                    class="relative overflow-y-scroll bg-white rounded-lg shadow dark:bg-gray-700 w-2/3 h-[calc(100%-2vh)]">
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            {{ $this->type == 'teacher' ? 'Teacher' : 'Employee' }}
                        </h3>
                        <button type="button" @click="openViewModal = false"
                            class="text-gray-400 bg-transparent hover:bg-red-500/50 hover:text-red-500 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-red-600"
                            data-modal-hide="ViewModal" wire:click='resetFields'>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 space-y-6 flex flex-col sm:flex-row">
                        <div class="flex flex-col w-full gap-y-2 sm:w-2/3">
                            <div class="flex flex-wrap py-1">
                                <span
                                    class="after:content-[':'] mr- after:ml-0.5 after:mr-2 after:text-gray-100 flex justify-between w-1/3 text-sm">Name</span>
                                <h2 class="w-2/3">{{ \Str::ucfirst($this->name) }}</h2>
                            </div>
                            <div class="flex flex-wrap py-1">
                                <span
                                    class="after:content-[':'] mr- after:ml-0.5 after:mr-2 after:text-gray-100 flex justify-between w-1/3 text-sm">Educational
                                    qualification</span>
                                <h2 class="w-2/3">{{ $this->educational_qualification }}</h2>
                            </div>
                            <div class="flex flex-wrap py-1">
                                <span
                                    class="after:content-[':'] mr- after:ml-0.5 after:mr-2 after:text-gray-100 flex justify-between w-1/3 text-sm">Address</span>
                                <h2 class="w-2/3">{{ $this->address }}</h2>
                            </div>
                            <div class="flex flex-wrap py-1">
                                <span
                                    class="after:content-[':'] mr- after:ml-0.5 after:mr-2 after:text-gray-100 flex justify-between w-1/3 text-sm">Gender</span>
                                <h2 class="w-2/3">{{ \Str::ucfirst($this->gender) }}</h2>
                            </div>
                            <div class="flex flex-wrap py-1">
                                <span
                                    class="after:content-[':'] mr- after:ml-0.5 after:mr-2 after:text-gray-100 flex justify-between w-1/3 text-sm">Status</span>
                                <div class="w-2/3">
                                    <span
                                        class="px-2 py-1 rounded text-sm {{ $this->status === 1 ? 'bg-emerald-500' : 'bg-red-500' }}">{{ $this->status === 1 ? 'Active' : 'Inactive' }}</span>
                                </div>
                            </div>
                            @if ($this->status === 0)
                                <div class="flex flex-wrap py-1">
                                    <span
                                        class="after:content-[':'] mr- after:ml-0.5 after:mr-2 after:text-gray-100 flex justify-between w-1/3 text-sm">Joined</span>
                                    <div class="w-2/3">
                                        <span>
                                            @php
                                                $timestamp = \Carbon\Carbon::parse($this->joined_at);
                                                $formattedDate = $timestamp->formatLocalized('%A, %B %d, %Y');
                                                echo $formattedDate;
                                            @endphp
                                        </span>
                                    </div>
                                </div>
                                <div class="flex flex-wrap py-1">
                                    <span
                                        class="after:content-[':'] mr- after:ml-0.5 after:mr-2 after:text-gray-100 flex justify-between w-1/3 text-sm">Status</span>
                                    <div class="w-2/3">
                                        <span>
                                            @php
                                                $timestamp = \Carbon\Carbon::parse($this->resigned_at);
                                                $formattedDate = $timestamp->formatLocalized('%A, %B %d, %Y');
                                                echo $formattedDate;
                                            @endphp
                                        </span>
                                    </div>
                                </div>
                            @endif
                            {{-- Social Buttons --}}
                            <div class="flex flex-row gap-2">
                                <a href="https://facebook.com/{{ $this->facebook }}"> <button type="button"
                                        class="px-3 py-2 bg-sky-500 rounded-md cursor-pointer transition-all ease-in-out duration-300 hover:shadow-lg bg-opacity-50 hover:bg-opacity-100"
                                        wire:ignore>

                                        <i data-lucide="facebook" class="w-[18px] text-sm"></i>

                                    </button></a>
                                <a href="{{ $this->website ?? 'javascript:void(0)' }}">
                                    <button type="button"
                                        class="px-3 py-2 bg-slate-500 rounded-md cursor-pointer transition-all ease-in-out duration-300 hover:shadow-lg bg-opacity-50 hover:bg-opacity-100"
                                        wire:ignore>
                                        <i data-lucide="globe" class="w-[18px] text-sm"></i>
                                    </button>
                                </a>
                                <a href="mailto:{{ $this->email }}" mail>
                                    <button type="button"
                                        class="px-3 py-2 bg-red-500 rounded-md cursor-pointer transition-all ease-in-out duration-300 hover:shadow-lg bg-opacity-50 hover:bg-opacity-100"
                                        wire:ignore>
                                        <i data-lucide="mail" class="w-[18px] text-sm"></i>
                                    </button>
                                </a>
                                <a href="tel:{{ $this->phone }}" mail>
                                    <button type="button"
                                        class="px-3 py-2 bg-emerald-500 rounded-md cursor-pointer transition-all ease-in-out duration-300 hover:shadow-lg bg-opacity-50 hover:bg-opacity-100"
                                        wire:ignore>
                                        <i data-lucide="phone" class="w-[18px] text-sm"></i>
                                    </button>
                                </a>
                            </div>
                        </div>
                        <div class="flex flex-col w-full sm:w-1/3">
                            <img src="/storage/{{ $this->preview_image }}"
                                class="max-w-full border-4 rounded-sm border-slate-300 dark:border-slate-400"
                                alt="">
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div
                        class="flex items-center px-5 py-4 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button type="submit" wire:click='resetFields' @click="openViewModal = false"
                            data-modal-hide="ViewModal"
                            class="text-white bg-green-500 hover:bg-green-400 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-success-600 dark:hover:bg-green-400 dark:focus:ring-green-200/50">
                            Close</button>
                    </div>
                </div>
            </div>
            <div wire:ignore>
                <table id="example" class="display" style="width: 100%">
                    <thead class="bg-blue-500 border-none">
                        <tr>
                            <th class="text-white">ID</th>
                            <th class="text-white">Name</th>
                            <th class="text-white">Type</th>
                            <th class="text-white">Gender</th>
                            <th class="text-white">Created at</th>
                            <th class="text-white">Status</th>
                            <th class="text-white">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($staffs as $key => $item)
                            {{-- @dd($item) --}}
                            <tr wire:key='{{ $item->id }}' class="border-b">
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <div class="flex items-center gap-2 flex-wrap">
                                        <img class="h-10 w-10 rounded-full object-cover"
                                            src="/storage/{{ $item->image }}" alt="{{ $item->name }}" />
                                        {{ $item->name }}
                                    </div>
                                </td>
                                <td>
                                    {{ \Str::ucfirst($item->type) }}
                                </td>
                                <td>
                                    {{ \Str::ucfirst($item->gender) }}
                                </td>
                                <td>
                                    {{ $item->created_at->diffForHumans() }}
                                </td>
                                <td>
                                    @if ($item->status)
                                        <span
                                            class="bg-emerald-500 text-white rounded px-2 py-1">{{ 'Active' }}</span>
                                    @else
                                        <span
                                            class="bg-red-500 text-white rounded px-2 py-1">{{ 'Inactive' }}</span>
                                    @endif

                                </td>
                                <td class="p-3 al flex justify-center items-center gap-1.5 flex-wrap">
                                    <span
                                        class="px-2 py-1 rounded-sm bg-yellow-300 cursor-pointer flex w-max align-center justify-center"
                                        wire:click='edit({{ $item->id }})' @click="openCEmodal = true">
                                        <i data-lucide="pen-square" class="w-4 me-1"></i> Edit
                                    </span>
                                    <span
                                        class="px-2 py-1 rounded-sm bg-blue-500 cursor-pointer flex w-max align-center justify-center"
                                        @click="openViewModal = true" data-modal-target="ViewModal"
                                        data-modal-toggle="ViewModal" wire:click='view({{ $item->id }})'>
                                        <i data-lucide="eye" class="w-4 me-1"></i> View
                                    </span>
                                    <button
                                        class="px-2 py-1 rounded-sm bg-red-500 cursor-pointer flex w-max align-center justify-center"
                                        wire:confirm="Are you sure?" wire:click="delete({{ $item->id }})"><i
                                            data-lucide="trash-2" class="w-4 me-1"></i>
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-blue-500">
                        <tr>
                            <th class="text-white">ID</th>
                            <th class="text-white">Name</th>
                            <th class="text-white">Type</th>
                            <th class="text-white">Gender</th>
                            <th class="text-white">Created at</th>
                            <th class="text-white">Status</th>
                            <th class="text-white">Actions</th>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </div>
    </main>
</div>

@push('page-script')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.tailwindcss.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://unpkg.com/@nextapps-be/livewire-sortablejs@0.3.5/dist/livewire-sortable.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@1.8.1/dist/flowbite.min.js"></script>
    <script>
        new DataTable('#example', {
            responsive: true,
            retrieve: true,
            paging: true
        });
        $('#example_filter label').addClass('flex justify-end items-center');
        $('#example_paginate div').addClass('flex justify-end items-center');
        $('.dtr-data').addClass('flex flex-wrap gap-2');
        Livewire.directive('confirm', ({
            el,
            directive,
            component,
            cleanup
        }) => {
            let content = directive.expression

            let onClick = e => {
                if (!confirm(content)) {
                    e.preventDefault()
                    e.stopImmediatePropagation()
                }
            }

            el.addEventListener('click', onClick, {
                capture: true
            })

            cleanup(() => {
                el.removeEventListener('click', onClick)
            })
        })
        //close modal on save data
        Livewire.on('closeModal', (value) => {
            console.log(value);
            var modalBackdrop = document.querySelector('[modal-backdrop]');
            document.querySelector('body').style.overflow = 'auto';
            modalBackdrop.style.display = 'none';
            if (value === false) {
                window.Alpine.data('openCEmodal', false);
            }
        });
        Livewire.on('reload', (value) => {
            location.reload();
        });
    </script>
@endpush
