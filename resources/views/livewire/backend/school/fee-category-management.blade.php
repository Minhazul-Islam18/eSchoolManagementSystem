<div x-data="{ openCEmodal: @entangle('openCEmodal') }">
    <main>
        <div class="container px-10 py-5">
            <header class="flex items-center flex-wrap mb-4" wire:ignore>
                <div class="w-1/2 flex justify-start items-center flex-wrap">
                    <span class="shadow-md px-2 py-2 bg-emerald-500 rounded mr-2">
                        <i data-lucide="book-open-check" class="w-10"></i>
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

            <div x-show="openCEmodal" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title"
                role="dialog" aria-modal="true">
                <div
                    class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
                    <div x-cloak @click="openCEmodal = false" x-show="openCEmodal"
                        x-transition:enter="transition ease-out duration-300 transform"
                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                        x-transition:leave="transition ease-in duration-200 transform"
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
                        class="max-h-[90vh] overflow-y-scroll inline-block w-full max-w-[80vw] p-8 overflow-hidden text-left transition-all transform bg-white dark:bg-slate-800 rounded-lg shadow-xl 2xl:max-w-2xl">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between space-x-4">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                {{ $this->editable_item ? 'Edit' : 'Create' }} Fee category
                            </h3>
                            <button @click="openCEmodal = false" wire:click='resetFields'
                                class="text-gray-600 focus:outline-none hover:text-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
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
                                    <form class="h-full flex flex-col justify-between" action=""
                                        wire:submit='{{ $this->editable_item ? 'update' : 'store' }}'>
                                        <!-- Modal body -->
                                        <div class="p-6 space-y-6 h-full">
                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                                <div class="">
                                                    <label for="" class="form-label">Category name</label>
                                                    <input type="text" wire:model.blur="category_name"
                                                        class="form-input rounded">
                                                    @error('category_name')
                                                        <span class="text-sm text-red-500">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="">
                                                    <label for="" class="form-label">Category slug</label>
                                                    <input type="text" wire:model.blur="category_slug"
                                                        class="form-input rounded">
                                                    @error('category_slug')
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
                                <!-- / Step Content -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div wire:ignore>
                <table id="example" class="display" style="width: 100%">
                    <thead class="bg-blue-500 border-none">
                        <tr>
                            <th class="text-white">ID</th>
                            <th class="text-white">Category</th>
                            <th class="text-white text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $key => $item)
                            <tr wire:key='{{ $item->id }}' class="border-b">
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    {{ $item->category_name }}
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
                            <th class="text-white">Category</th>
                            <th class="text-white text-right">Actions</th>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </div>
    </main>
</div>
@push('page-style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css">
@endpush
@push('page-script')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.tailwindcss.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script>
        document.addEventListener('mounted', function() {
            console.log('mounted');
            $('#select2').select2();

            $('#select2').on('change', function(e) {
                @this.set('student_id', e.target.value);
            });
        });
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
            if (value === false) {
                window.Alpine.data('openCEmodal', false);
            }
        });
        Livewire.on('reload', (value) => {
            location.reload();
        });
    </script>
@endpush
