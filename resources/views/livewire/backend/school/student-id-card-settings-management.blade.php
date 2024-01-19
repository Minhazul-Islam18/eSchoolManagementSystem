<div>
    <main class="container">
        <header class="flex items-center flex-wrap mt-10 sm:mt-24 mb-4" wire:ignore>
            <div class="w-1/2 flex justify-start items-center flex-wrap">
                <span class="shadow-md px-2 py-2 bg-emerald-500 rounded mr-2">
                    <i data-lucide="candlestick-chart" class="w-10"></i>
                </span>
            </div>
            <div class="w-1/2 flex justify-end items-center gap-3">
                <a href="{{ route('school.student-id-card.create') }}"
                    class="bg-green-500 bg-opacity-25 border border-green-500 rounded flex items-center px-4 py-2 shahow-md hover:bg-opacity-100 transition fade gap-2">
                    <i data-lucide="plus-circle" class="w-4"></i>
                    Add
                </a>
            </div>
        </header>

        <div wire:ignore>
            <table id="example" class="display" style="width: 100%">
                <thead class="bg-blue-500 border-none">
                    <tr>
                        <th class="text-white">ID</th>
                        <th class="text-white">Title</th>
                        <th class="text-white">Expire date</th>
                        <th class="text-white text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($idCards as $key => $item)
                        <tr wire:key='{{ $item->id }}' class="border-b">
                            <td>{{ $key + 1 }}</td>
                            <td>
                                {{ $item->title }}
                            </td>
                            <td>
                                {{ $item->expire_date }}
                            </td>
                            <td class="p-3 al flex justify-end items-center gap-1.5 flex-wrap">
                                <a href="{{ route('school.student-id-card.edit', ['id' => $item->id]) }}"
                                    class="px-2 py-1 rounded-sm bg-yellow-300 cursor-pointer flex w-max align-center justify-center">
                                    <i data-lucide="pen-square" class="w-4 me-1"></i> Edit
                                </a>
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
                        <th class="text-white">Title</th>
                        <th class="text-white">Expire date</th>
                        <th class="text-white text-right">Actions</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </main>
</div>
@push('page-style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.tailwindcss.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
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
        $('#example_paginate div').addClass('flex justify-end items-center');
        $('.dtr-data').addClass('flex flex-wrap gap-2');

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
