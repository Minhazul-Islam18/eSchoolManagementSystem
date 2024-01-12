<div x-data="{ openCEmodal: @entangle('openCEmodal') }">
    <main class="container">
        <header class="flex items-center flex-wrap mt-10 sm:mt-24 mb-4" wire:ignore>
            <div class="w-1/2 flex justify-start items-center flex-wrap">
                <span class="shadow-md px-2 py-2 bg-emerald-500 rounded mr-2">
                    <i data-lucide="clipboard-signature" class="w-10"></i>
                </span>
            </div>
            <div class="w-1/2 flex justify-end items-center gap-3">
                {{-- <button @click="openCEmodal = true" data-modal-target="CEmodal" data-modal-toggle="CEmodal"
                    class="bg-green-500 bg-opacity-25 border border-green-500 rounded flex items-center px-4 py-2 shahow-md hover:bg-opacity-100 transition fade gap-2">
                    <i data-lucide="plus-circle" class="w-4"></i>
                    Add
                </button> --}}
            </div>
        </header>
        <div x-show="openCEmodal" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog"
            aria-modal="true">
            <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
                <div x-cloak @click="openCEmodal = false" x-show="openCEmodal"
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
                            Update monthly fee for class
                            {{ $this->editable_item ? $this->editable_item->class_name : '' }}
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
                        <div>
                            <!-- Step Content -->
                            <div class="py-0">
                                <form class="h-full flex flex-col justify-between" wire:submit='update'>
                                    <!-- Modal body -->
                                    <div class="p-6 space-y-6 h-full">
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            <div class="">
                                                <label for="" class="form-label">Amount</label>
                                                <input wire:model.blur='amount' type="number"
                                                    value="{{ isset($this->editable_item->monthly_fee) ? $this->editable_item->monthly_fee->amount : null }}"
                                                    class="form-input rounded placeholder:text-gray-300"
                                                    placeholder="Enter amount" id="">
                                                @error('amount')
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
                        <th class="text-white">Class</th>
                        <th class="text-white">Fee amount</th>
                        <th class="text-white">Last updated</th>
                        <th class="text-white text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($this->classes as $key => $item)
                        <tr wire:key='{{ $item->id }}' class="border-b">
                            <td>{{ $key + 1 }}</td>
                            <td>
                                {{ $item->class_name }}
                            </td>
                            <td>
                                {{ $item->monthly_fee->amount ?? 'Not set' }}
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($item->updated_at)->toFormattedDateString() }}
                            </td>
                            <td class="p-3 al flex justify-end items-center gap-1.5 flex-wrap">
                                <button wire:click='edit({{ $item->id }})' @click="openCEmodal = true"
                                    data-modal-target="CEmodal" data-modal-toggle="CEmodal"
                                    class="px-2 py-1 rounded-sm bg-yellow-300 cursor-pointer flex w-max align-center justify-center">
                                    <i data-lucide="pen-square" class="w-4 me-1"></i> Edit
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="bg-blue-500">
                    <tr>
                        <th class="text-white">ID</th>
                        <th class="text-white">Class</th>
                        <th class="text-white">Fee amount</th>
                        <th class="text-white">Last updated</th>
                        <th class="text-white text-right">Actions</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </main>
</div>
@push('page-style')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.tailwindcss.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
@endpush
@push('page-script')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.tailwindcss.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables-buttons/2.4.2/js/dataTables.buttons.min.js"
        integrity="sha512-ARfw9ACvbrDslvZAGzkJwl1iaFoGg61e7fTzoje0hovrNjnkeFWXjyhdxPz+39KaibFnqsMJqjtSal3vXra5GQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables-buttons/2.4.2/js/buttons.html5.min.js"
        integrity="sha512-RvfP4FGRLhK9ZZjvGrGibZOC1r5jBhKTZMFUKGOv6r3tUP/mTPS7gyPl9t4LB+spY14tjUeAxOsYMBvNT2ayOw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables-buttons/2.4.2/js/buttons.print.min.js"
        integrity="sha512-8ZglfBJS5iJoRtzAJHcGquQk6e99kCUENFwbTijONUtnZkE3THiq3Nr6OMfz71tmu4Gx6jw0CG5SduBQyg57vg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        new DataTable('#example', {
            responsive: true,
            retrieve: true,
            paging: true,
            dom: `<'flex items-center flex-col sm:flex-row gap-y-3 justify-between my-3'<'w-full sm:w-[20%]'B><'w-full sm:w-[80%] flex justify-end gap-x-3'lf>>
          <'flex dt-row'<'w-full'tr>>
          <'flex items-center justify-between my-3'<'w-[40%]'i><'w-[60%]'p>>`,
            buttons: {
                /**
                 * @see https://datatables.net/reference/button/
                 */
                buttons: [
                    // {
                    //     text: "Add new record",
                    //     attr: {
                    //         role: "button",
                    //         class: "btn btn-primary btn-create"
                    //     },
                    //     action: function(datatable) {
                    //         /** @todo Add action code */
                    //         alert("Add new record!");
                    //     }
                    // },
                    // {
                    //     text: "Delete selected",
                    //     attr: {
                    //         role: "button",
                    //         class: "btn btn-danger btn-delete-selected"
                    //     },
                    //     action: function(datatable) {
                    //         /** @todo Add action code */
                    //         alert("Delete selected items!");
                    //     }
                    // },
                    {
                        extend: "collection",
                        text: "Export",
                        autoClose: true,
                        buttons: ['copyHtml5',
                            'excelHtml5',
                            'csvHtml5',
                            'pdfHtml5'
                        ]
                    },
                    {
                        extend: 'print',
                        text: 'Print',
                        autoPrint: true
                    },

                ]
            },
        });
        // $('#example_filter label').addClass('flex justify-end items-center');
        // $('#example_paginate div').addClass('flex justify-end items-center');
        // $('.dtr-data').addClass('flex flex-wrap gap-2');

        //close modal on save data
        // Livewire.on('closeModal', (value) => {
        //     console.log(value);
        //     var modalBackdrop = document.querySelector('[modal-backdrop]');
        //     document.querySelector('body').style.overflow = 'auto';
        //     modalBackdrop.style.display = 'none';
        //     if (value === false) {
        //         window.Alpine.data('openCEmodal', false);
        //     }
        // });
        Livewire.on('reload', (value) => {
            location.reload();
        });
    </script>
@endpush
