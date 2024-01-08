<div x-data="{ openCEmodal: @entangle('openCEmodal'), OpenViewModal: false }">
    <main>
        <div class="container px-3 py-4" wire:ignore>
            {{-- @if (Auth::user()->hasPermission('app.users.create')) --}}
            <div class="flex flex-col md:flex-row sm:flex-row my-4">
                <div class="w-1/2 flex justify-start items-center flex-wrap">
                    <span class="shadow-md px-2 py-2 bg-emerald-500 rounded mr-2">
                        <i data-lucide="package" class="w-10"></i>
                    </span>
                </div>
                <div class="w-1/2 flex justify-end items-center gap-3">
                    <button @click="openCEmodal = true"
                        class="bg-green-500 bg-opacity-25 border border-green-500 rounded flex items-center px-4 py-2 shahow-md hover:bg-opacity-100 transition fade gap-2">
                        <i data-lucide="plus-circle" class="w-4"></i>
                        Add
                    </button>
                </div>
            </div>
            {{-- @endif --}}
            <table id="example" class="display" style="width: 100%">
                <thead class="bg-blue-500 border-none">
                    <tr>
                        <th class="text-white">ID</th>
                        <th class="text-white">Name</th>
                        <th class="text-white">Price</th>
                        <th class="text-white">Allowed students</th>
                        <th class="text-white">Status</th>
                        <th class="text-white">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($packages as $key => $item)
                        <tr wire:key='{{ $item->id }}' class="border-b">
                            <td>{{ $key + 1 }}</td>
                            <td>
                                {{ $item->name }}
                            </td>
                            <td>
                                {{ $item->price }}
                            </td>
                            <td>
                                {{ $item->allowed_students }}
                            </td>
                            <td>
                                @if ($item->status)
                                    <span class="bg-green-500 text-white rounded px-2 py-1">{{ 'Active' }}</span>
                                @else
                                    <span class="bg-red-500 text-white rounded px-2 py-1">{{ 'Inactive' }}</span>
                                @endif

                            </td>
                            <td class="p-3 al flex justify-center items-center gap-1.5 flex-wrap">
                                <span
                                    class="px-2 py-1 rounded-sm bg-yellow-500 cursor-pointer flex w-max align-center justify-center"
                                    wire:click='edit({{ $item->id }})' @click="openCEmodal = true">
                                    <i data-lucide="pen-square" class="w-4 me-1"></i> Edit
                                </span>
                                <span
                                    class="px-2 py-1 rounded-sm bg-blue-500 cursor-pointer flex w-max align-center justify-center"
                                    wire:click='show({{ $item->id }})' @click="OpenViewModal = true">
                                    <i data-lucide="eye" class="w-4 me-1"></i> View
                                </span>
                                <button
                                    class="px-2 py-1 rounded-sm bg-red-500 cursor-pointer flex w-max align-center justify-center"
                                    wire:confirm="Are you sure?" wire:click="destroy({{ $item->id }})"><i
                                        data-lucide="trash-2" class="w-4 me-1"></i>
                                    Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="bg-blue-500">
                    <tr>
                        <th class="text-white">ID</th>
                        <th class="text-white">Name</th>
                        <th class="text-white">Price</th>
                        <th class="text-white">Allowed students</th>
                        <th class="text-white">Status</th>
                        <th class="text-white">Actions</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </main>

    <div x-show="openCEmodal" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
            <div x-cloak @click="openCEmodal = false" x-show="openCEmodal" wire:click='resetFields'
                x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200 transform"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                class="fixed inset-0 transition-opacity bg-slate-950 bg-opacity-60" aria-hidden="true">
            </div>

            <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);" x-cloak
                x-show="openCEmodal" x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="transition ease-in duration-200 transform"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="max-h-[90vh] overflow-y-scroll inline-block w-full max-w-[95vw] sm:max-w-[80vw] p-8 overflow-hidden text-left transition-all transform bg-white dark:bg-slate-800 rounded-lg shadow-xl 2xl:max-w-2xl">
                <!-- Modal header -->
                <div class="flex items-center justify-between space-x-4">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        {{ $this->editable_item ? 'Edit' : 'Create' }} Package
                    </h3>
                    <button @click="openCEmodal = false" wire:click='resetFields'
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
                    <!-- Step Content -->
                    <div class="py-0">
                        <form class="h-full flex flex-col justify-between" action=""
                            wire:submit='{{ $this->editable_item ? 'update' : 'store' }}'>
                            <!-- Modal body -->
                            <div class="p-6 space-y-6 h-full">
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    {{-- Fields --}}
                                    <div>
                                        <label for=""
                                            class="form-label after:content-['*'] after:ml-0.5 after:text-red-500">Package
                                            name</label>
                                        <input type="text" class="form-input rounded" wire:model.blur="package_name"
                                            id="">
                                        @error('package_name')
                                            <span class="text-red-500 text-sm font-medium">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="" class="form-label">Price</label>
                                        <input type="number" class="form-input rounded" wire:model.blur="price"
                                            id="">
                                        <p class="text-red-500 text-xs font-medium mt-1">
                                            {{ __('Left this field empty or set value 0 to make this package FREE') }}
                                        </p>
                                        @error('price')
                                            <span class="text-red-500 text-sm font-medium">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for=""
                                            class="form-label after:content-['*'] after:ml-0.5 after:text-red-500">Student
                                            allowed</label>
                                        <input type="number" class="form-input rounded"
                                            wire:model.blur="student_allowed" id="">
                                        @error('student_allowed')
                                            <span class="text-red-500 text-sm font-medium">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="" class="form-label">Additional features</label>
                                        <textarea wire:model.blur="additional_features" id="" cols="30" rows="5"
                                            class="form-input rounded"></textarea>
                                        @error('additional_features')
                                            <span class="text-red-500 text-sm font-medium">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="status" class="form-label gap-2 flex items-center">
                                            {{ __('Status') }}
                                            <input type="checkbox" wire:model.blur="status" id="status">
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal footer -->
                            <div
                                class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                <button type="submit"
                                    class="text-white bg-green-500 hover:bg-green-400 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-success-600 dark:hover:bg-green-400 dark:focus:ring-green-200/50 transition-all duration-200">
                                    {{ $this->editable_item ? 'Update' : 'Save' }}</button>
                                @if ($this->editable_item)
                                    <button type="button" wire:click='resetFields' @click="openCEmodal = false"
                                        class="text-white bg-red-500 hover:bg-red-400 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-400 dark:focus:ring-red-200/50">
                                        {{ 'Cancel' }}</button>
                                @endif
                            </div>
                        </form>
                    </div>
                    <!-- / Step Content -->
                </div>
            </div>
        </div>
    </div>
    <div x-show="OpenViewModal" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title"
        role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
            <div x-cloak @click="OpenViewModal = false" x-show="OpenViewModal" wire:click='resetFields'
                x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200 transform"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                class="fixed inset-0 transition-opacity bg-slate-950 bg-opacity-60" aria-hidden="true">
            </div>

            <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);" x-cloak
                x-show="OpenViewModal" x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="transition ease-in duration-200 transform"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="max-h-[90vh] overflow-y-scroll inline-block w-full max-w-[95vw] sm:max-w-[80vw] p-8 overflow-hidden text-left transition-all transform bg-white dark:bg-slate-800 rounded-lg shadow-xl 2xl:max-w-2xl">
                <!-- Modal header -->
                <div class="flex items-center justify-between space-x-4">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Preview package
                    </h3>
                    <button @click="OpenViewModal = false" wire:click='resetFields'
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
                    <!-- Step Content -->
                    <div class="py-0 flex flex-col gap-3">
                        <h2 class="text-2xl font-bold"> {{ 'Package name: ' . $this->package_name }}</h2>
                        <span
                            class=" font-medium text-lg">{{ 'Total allowed students: ' . $this->student_allowed }}</span>
                        <span class="text-sm">{{ 'Price: ' . $this->price }}</span>
                        <p>
                            {{ 'Additional features: ' . $this->additional_features }}
                        </p>
                        <p>
                            {{ 'Status: ' }}
                            @if ($this->status)
                                <span class="bg-green-500 text-white rounded px-2 py-1">{{ 'Active' }}</span>
                            @else
                                <span class="bg-red-500 text-white rounded px-2 py-1">{{ 'Inactive' }}</span>
                            @endif
                        </p>
                    </div>
                    <!-- / Step Content -->
                </div>
            </div>
        </div>
    </div>
</div>
@push('page-style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.tailwindcss.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <style>
        div.container {
            max-width: 1200px
        }
    </style>
@endpush
@push('page-script')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.tailwindcss.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script>
        new DataTable('#example', {
            responsive: true,
            retrieve: true,
            paging: true
        });

        $('#example_filter label').addClass('flex justify-end items-center');
        // $('#example_length select').addClass('w-1/2');
        $('#example_paginate div').addClass('flex justify-end items-center');
        $('.dtr-data').addClass('flex flex-wrap gap-2');
    </script>
    <script>
        Livewire.on('closeModal', (value) => {
            console.log(value);
            if (value === false) {
                window.Alpine.data('OpenCEModal', false);
            }
        });
    </script>
@endpush
