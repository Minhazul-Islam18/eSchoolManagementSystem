<div x-data="{ openCEmodal: @entangle('openCEmodal'), openViewModal: false }">
    <main>
        <div class="container px-10 py-5">
            <header class="flex items-center flex-wrap mb-4" wire:ignore>
                <div class="w-1/2 flex justify-start items-center flex-wrap">
                    <span class="shadow-md px-2 py-2 bg-emerald-500 rounded mr-2">
                        <i data-lucide="book-a" class="w-10"></i>
                    </span>
                </div>
                <div class="w-1/2 flex justify-end items-center gap-3">
                    <button @click="openCEmodal = true" data-modal-target="CEmodal" data-modal-toggle="CEmodal"
                        class="bg-green-500 bg-opacity-25 border border-green-500 rounded flex items-center px-4 py-2 shahow-md hover:bg-opacity-100 transition fade gap-2">
                        <i data-lucide="plus-circle" class="w-4"></i>
                        Add
                    </button>
                </div>
            </header>

            <div id="CEmodal" tabindex="-1" aria-hidden="true" x-show="openCEmodal"
                class="fixed top-0 left-0 right-0 z-50 w-full p-4 md:inset-0 h- max-h-full justify-center items-center flex">
                <!-- Modal content -->
                <div
                    class="relative overflow-y-scroll bg-white rounded-lg shadow dark:bg-gray-700 w-2/3 h-[calc(100%-2vh)]">
                    <form class="flex flex-col justify-between h-full" action=""
                        wire:submit='{{ $this->editable_item ? 'update' : 'store' }}'>
                        <!-- Modal header -->
                        <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                {{ $this->editable_item ? 'Edit' : 'Create' }} class
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
                        <div class="p-6 space-y-6 h-full">
                            <div class="grid grid-cols-1">
                                <label for="" class="form-label">Class name</label>
                                <input wire:model.blur='class_name' type="text" class="form-input rounded"
                                    id="">
                                @error('class_name')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
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

            <div wire:ignore>
                <table id="example" class="display" style="width: 100%">
                    <thead class="bg-blue-500 border-none">
                        <tr>
                            <th class="text-white">ID</th>
                            <th class="text-white">Name</th>
                            <th class="text-white text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($classes as $key => $item)
                            <tr wire:key='{{ $item->id }}' class="border-b">
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <div class="flex items-center gap-2 flex-wrap">
                                        {{ $item->class_name }}
                                    </div>
                                </td>
                                <td class="p-3 al flex justify-end items-center gap-1.5 flex-wrap">
                                    <span
                                        class="px-2 py-1 rounded-sm bg-yellow-300 cursor-pointer flex w-max align-center justify-center"
                                        wire:click='edit({{ $item->id }})' @click="openCEmodal = true">
                                        <i data-lucide="pen-square" class="w-4 me-1"></i> Edit
                                    </span>
                                    <button
                                        class="px-2 py-1 rounded-sm bg-red-500 cursor-pointer flex w-max align-center justify-center"
                                        wire:confirm="Are you sure?" wire:click="destroy({{ $item->id }})"><i
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
                            <th class="text-white">Actions</th>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div x-data="{ currentTab: '' }">
                <h4 class="text-xl border-b pb-2 mb-2 mt-12 border-b-gray-400">At a glance</h4>
                <select class="form-select rounded" wire:model.blur="classSelectedForShowData" wire:change='showInTab'
                    id="">
                    <option value="">Select class</option>
                    @foreach ($classes as $item)
                        <option value="{{ $item->id }}">{{ $item->class_name }}</option>
                    @endforeach
                </select>
                <nav class="flex gap-2 flex-col sm:flex-row flex-wrap my-3">
                    <button class=" px-4 py-2 rounded bg-gradient-to-r from-cyan-500 to-blue-500"
                        @click="currentTab = 'sections'">Sections</button>
                    <button class=" px-4 py-2 rounded bg-gradient-to-r from-cyan-500 to-blue-500"
                        @click="currentTab = 'groups'">Groups</button>
                    <button class=" px-4 py-2 rounded bg-gradient-to-r from-cyan-500 to-blue-500"
                        @click="currentTab = 'syllabus'">Syllabus</button>
                </nav>

                <div
                    class="tab-body px-4 py-8 border border-gray-400 dark:border-gray-600 rounded bg-gray-300 dark:bg-gray-800">
                    <div x-show="currentTab == ''">
                        <span>{{ __('Please a select a class first!') }}</span>
                    </div>

                    <div x-show="currentTab == 'sections'">
                        <ul>
                            @forelse ($this->glance['sections'] as $item)
                                <li class="border-b pb-2">{{ $item->section_name }}</li>
                            @empty
                                <li>{{ __('Nothing found (-_-)') }}</li>
                            @endforelse
                        </ul>
                    </div>

                    <div x-show="currentTab == 'groups'">
                        <ul>
                            @forelse ($this->glance['groups'] as $item)
                                <li class="border-b pb-2">{{ $item->group_name }}</li>
                            @empty
                                <li>{{ __('Nothing found (-_-)') }}</li>
                            @endforelse
                        </ul>
                    </div>

                    <div x-show="currentTab == 'syllabus'">
                        <ul>
                            @forelse ($this->glance['syllabi'] as $item)
                                <li class="flex justify-between border-b pb-2">
                                    <span>{{ $item->syllabus_name }}</span>
                                    @if (null != $item->files)
                                        @foreach (json_decode($item->files) as $file)
                                            <button class="px-2 py-1 rounded bg-yellow-400"
                                                wire:click="downloadFile('{{ $file }}')">Download</button>
                                        @endforeach
                                    @endif
                                </li>
                            @empty
                                <li>{{ __('Nothing found (-_-)') }}</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
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
