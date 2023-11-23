<div x-data="{ openCEmodal: @entangle('openCEmodal'), showRoutine: @entangle('showRoutine') }">
    <main>
        <!-- Modals -->
        <div id="CEmodal" tabindex="-1" aria-hidden="true" x-show="openCEmodal"
            class="fixed top-0 left-0 right-0 z-50 w-full p-4 md:inset-0 h- max-h-full justify-center items-center flex">
            <!-- Modal content -->
            <div class="relative overflow-y-scroll bg-white rounded-lg shadow dark:bg-gray-700 w-2/3 h-[calc(100%-2vh)]">
                <form class="h-full flex flex-col justify-between" action=""
                    wire:submit='{{ $this->editable_item ? 'update' : 'store' }}'>
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            {{ $this->editable_item ? 'Edit' : 'Create' }} Section
                        </h3>
                        <button type="button" @click="openCEmodal = false"
                            class="text-gray-400 bg-transparent hover:bg-red-500/50 hover:text-red-500 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-red-600"
                            data-modal-hide="CEmodal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 space-y-6 h-full">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="">
                                <label for="" class="form-label">Name</label>
                                <input wire:model.blur='section_name' type="text" class="form-input rounded"
                                    id="">
                                @error('section_name')
                                    <span class="text-sm text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="">
                                <label for="" class="form-label">Class</label>
                                <select wire:model.blur='class_id' class="form-select rounded" id="">
                                    <option value="">Select class</option>
                                    @foreach ($classes as $item)
                                        <option value="{{ $item->id }}">{{ $item->class_name }}</option>
                                    @endforeach
                                </select>
                                @error('class_id')
                                    <span class="text-sm text-red-500">{{ $message }}</span>
                                @enderror
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

        <div x-show="showRoutine" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title"
            role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
                <div x-cloak @click="showRoutine = false" x-show="showRoutine"
                    x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200 transform"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                    class="fixed inset-0 transition-opacity bg-slate-950 bg-opacity-60" aria-hidden="true">
                </div>

                <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);" x-cloak
                    x-show="showRoutine" x-transition:enter="transition ease-out duration-300 transform"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="transition ease-in duration-200 transform"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="max-h-[90vh] overflow-y-scroll inline-block w-full max-w-[80vw] p-8 overflow-hidden text-left transition-all transform bg-white dark:bg-slate-800 rounded-lg shadow-xl 2xl:max-w-2xl">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between space-x-4">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Class: {{ $this->routine_for['class'] ?? 'Loading...' }}</br>
                            Section: {{ $this->routine_for['section'] ?? 'Loading...' }}
                        </h3>
                        <button @click="showRoutine = false" wire:click='resetFields'
                            class="text-gray-600 focus:outline-none hover:text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </button>
                    </div>
                    <!-- Modal content-->
                    <div class="px-4 py-2">
                        <div>
                            <!-- Step Content -->
                            <div class="py-0">
                                <div class="flex flex-col">
                                    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                                        <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                                            <div class="overflow-hidden">
                                                @php
                                                    $cnt = [];
                                                @endphp
                                                <table
                                                    class="min-w-full text-left text-sm font-light border rounded border-gray-400">
                                                    <thead class="border-b font-medium dark:border-gray-400">
                                                        <tr>
                                                            <th scope="col"
                                                                class="px-6 py-4 border-r border-gray-400"></th>
                                                            <th scope="col" class="px-6 py-4 text-center"
                                                                colspan="{{ $cnt != null ? max($cnt) : null }}">
                                                                Schedules</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($this->routine_sets as $weekday => $items)
                                                            @php
                                                                $cnt[] = count($items);
                                                            @endphp
                                                            <tr class="border-b dark:border-gray-400">
                                                                <td
                                                                    class="whitespace-nowrap px-6 py-4 font-medium border-r border-gray-400">
                                                                    {{ $weekday }}</td>
                                                                @foreach ($items as $item)
                                                                    <td
                                                                        class="border-r border-gray-400 last:border-none text-center">
                                                                        {{ $item->subject->subject_name }}</br>
                                                                        {{ $item->starts_at . ' - ' . $item->ends_at }}
                                                                    </td>
                                                                @endforeach
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td>
                                                                    <span wire:loading wire:target="showFullRoutine"
                                                                        class=" block text-center py-3 text-md">Loading...</span>
                                                                </td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- @foreach ($this->routine_sets as $item)
                                        {{ $item }}
                                    @endforeach --}}
                            </div>
                            <!-- / Step Content -->
                        </div>
                    </div>
                </div>
            </div>
        </div>



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

            <div wire:ignore>
                <table id="example" class="display" style="width: 100%">
                    <thead class="bg-blue-500 border-none">
                        <tr>
                            <th class="text-white">ID</th>
                            <th class="text-white">Class</th>
                            <th class="text-white">Section</th>
                            <th class="text-white text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($allSections as $key => $item)
                            <tr wire:key='{{ $item->id }}' class="border-b">
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <div class="flex items-center gap-2 flex-wrap">
                                        {{ $item->school_class->class_name }}
                                    </div>
                                </td>
                                <td>
                                    <div class="flex items-center gap-2 flex-wrap">
                                        {{ $item->section_name }}
                                    </div>
                                </td>
                                <td class="p-3 al flex justify-end items-center gap-1.5 flex-wrap">
                                    <span
                                        class="px-2 py-1 rounded-sm bg-yellow-300 cursor-pointer flex w-max align-center justify-center"
                                        wire:click='edit({{ $item->id }})' @click="openCEmodal = true"
                                        data-modal-target="CEmodal" data-modal-toggle="CEmodal">
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
                            <th class="text-white">Class</th>
                            <th class="text-white">Section</th>
                            <th class="text-white">Actions</th>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!-- Generate routine -->
            <div class="rounded my-6 flex justify-between flex-col sm:flex-row">
                <ul
                    class=" dark:bg-slate-800 bg-gray-200 border border-gray-300 dark:border-slate-900 shadow-md rounded w-full sm:w-8/12 px-6 py-8 backdrop-blur-md">
                    <li class="text-lg text-center py-2 mt-2 border-b">Generated routines</li>
                    @if ($publishedRoutines != null)
                        @foreach ($publishedRoutines as $item)
                            <li class="py-3 border-b flex justify-between items-center">
                                {{ 'Class: ' . $item->school_class->class_name }}
                                </br>
                                {{ 'Section: ' . $item->section_name }}

                                <button @click='showRoutine = true' class="bg-emerald-600 rounded shadow-md px-4 py-2"
                                    wire:click='showFullRoutine({{ $item->id }})'>Show</button>
                            </li>
                        @endforeach
                    @else
                        <li>Currently no published routine. </br> Please select any class & section to generate routine.
                        </li>
                    @endif

                </ul>
                <div class="w-full sm:w-1/12"></div>
                <form action="" wire:submit='generateRoutine'
                    class="dark:bg-slate-800 bg-gray-200 border border-gray-300 dark:border-slate-900 shadow-md rounded w-full sm:w-3/12 px-6 py-8 backdrop-blur-md">
                    <div class="mb-4 flex gap-4 flex-wrap flex-col">
                        <div class="">
                            <label for="">Generate routine for class</label>
                            <select wire:model.blur='filter_class_id' class="form-select rounded" name=""
                                id="" wire:change='getSection'>
                                <option value="">Select class</option>
                                @foreach ($classes as $class)
                                    <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="">
                            <label for="">Section</label>
                            <select wire:model.blur='filter_section_id' class="form-select rounded" name=""
                                id="">
                                <option value="">Select section</option>
                                @foreach ($this->sections as $section)
                                    <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit"
                            class="rounded bg-emerald-500 hover:bg-emerald-600 transition ease-in-out duration-300 px-6 py-3">Generate</button>
                    </div>
                </form>
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
