<div>
    <main>
        <div class="container px-3 py-4" wire:ignore>
            @if (Auth::user()->hasPermission('app.backups.create'))
                <div class="flex flex-col md:flex-row sm:flex-row my-4">
                    <div class="w-0/4 sm:w-2/4"></div>
                    <div class="w-4/4 sm:w-2/4 flex justify-end align-center">
                        <button wire:click='clean'
                            class="shadow-md bg-red-500 flex items-center backdrop-blur-sm text-white  ease-in
                         duration-200 mr-1 hover:shadow-md hover:border-slate-400 hover:bg-orange-600 ease rounded border-2 px-5 py-2">
                            <i data-lucide="trash-2" class="w-4 me-1"></i>Clean Backups</button>
                        <button wire:click='create'
                            class="shadow-md bg-green-500 flex items-center backdrop-blur-sm text-black duration-200 hover:shadow-md hover:border-slate-400 ease-in hover:bg-lime-500 ease rounded border-2 px-5 py-2">
                            <i data-lucide="plus-circle" class="w-4 me-1"></i>Create new Backup</button>
                    </div>
                </div>
            @endif
            <table id="TableOfData" class="display" style="width: 100%">
                <thead class="bg-blue-500 border-none">
                    <tr>
                        <th class="text-white">ID</th>
                        <th class="text-white">File</th>
                        <th class="text-white">Size</th>
                        <th class="text-white">Created at</th>
                        <th class="text-white">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($this->backups as $key => $item)
                        <tr>
                            <td>
                                {{ $key + 1 }}
                            </td>
                            <td>{{ $item['file_name'] }}</td>
                            <td>{{ $item['file_size'] }}</td>
                            <td>{{ $item['last_modified'] }}</td>
                            <td class="flex items-center justify-end">
                                <button wire:click="destroy('{{ $item['file_name'] }}')"
                                    class="mr-2 px-2 ease-in duration-300 hover:shadow-md py-2 flex justify-start items-center rounded-md bg-red-500 hover:bg-red-600 active:bg-red-700 focus:outline-none focus:ring focus:ring-red-300">
                                    <i data-lucide="trash-2" class="mr-2 w-4"></i>Delete
                                </button>
                                <button wire:click="download('{{ $item['file_name'] }}')"
                                    class="px-2 ease-in duration-300 hover:shadow-md py-2 flex justify-start items-center rounded-md bg-violet-500 hover:bg-violet-600 active:bg-violet-700 focus:outline-none focus:ring focus:ring-violet-300">
                                    <i data-lucide="download" class="mr-2 w-4"></i>Download
                                </button>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
                <tfoot class="bg-blue-500">
                    <tr>
                        <th class="text-white">ID</th>
                        <th class="text-white">File</th>
                        <th class="text-white">Size</th>
                        <th class="text-white">Created at</th>
                        <th class="text-white">Actions</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </main>
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
        new DataTable('#TableOfData', {
            responsive: true,
            retrieve: true,
            paging: true
        });
    </script>
    <script>
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
        Livewire.on('closeModal', (value) => {
            console.log(value);
            if (value === false) {
                window.Alpine.data('OpenEditModal', false);
            }
        });

        var showModal;
        let modal = document.querySelectorAll(".modal");
        for (let index = 0; index < modal.length; index++) {
            const element = modal[index];
            showModal = (flag) => {
                element.classList.toggle("hidden");
            };
        }
    </script>
@endpush
