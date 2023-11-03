@push('page-script')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.tailwindcss.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script>
        document.addEventListener('livewire:init', function() {
            //initialize datatable
            new DataTable('#TableOfData', {
                responsive: true,
                retrieve: true,
                paging: true
            });
            //close modal on save data
            Livewire.on('closeModal', (value) => {
                console.log(value);
                if (value === false) {
                    window.Alpine.data('OpenEditModal', false);
                }
            });
        });
    </script>
@endpush
@push('page-style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.tailwindcss.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <style>
        div.container {
            max-width: 1200px
        }
    </style>
@endpush
<div>
    <main>
        <div class="container px-3 py-4" wire:ignore>
            @if (Auth::user()->hasPermission('app.pages.create'))
                <div class="flex flex-col md:flex-row sm:flex-row my-4">
                    <div class="w-0/4 sm:w-2/4"></div>
                    <div class="w-4/4 sm:w-2/4 flex justify-end align-center">
                        <a href='{{ route('app.page.create') }}'
                            class="shadow-md bg-green-500 flex items-center backdrop-blur-sm text-black duration-200 hover:shadow-md hover:border-slate-400 ease-in hover:bg-lime-500 ease rounded border-2 px-5 py-2">
                            <i data-lucide="plus-circle" class="w-4 me-1"></i>Create new</a>
                    </div>
                </div>
            @endif
            <table id="TableOfData" class="display" style="width: 100%">
                <thead class="bg-blue-500 border-none">
                    <tr>
                        <th class="text-white">ID</th>
                        <th class="text-white">Title</th>
                        <th class="text-white">Status</th>
                        <th class="text-white">Last Modified</th>
                        <th class="text-white">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pages as $key => $item)
                        <tr>
                            <td>
                                {{ $key + 1 }}
                            </td>
                            <td>{{ $item->title }}</td>
                            <td>
                                <span
                                    class="{{ $item->status ? 'bg-green-100 text-green-800 text-sm dark:bg-green-500 dark:text-white' : 'bg-red-100 text-red-800 text-sm dark:bg-red-500 dark:text-white' }} font-medium mr-2 px-2.5 py-0.5 rounded ">{{ $item->status ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>{{ \carbon\Carbon::parse($item->updated_at)->toDayDateTimeString() }}</td>
                            <td class="flex items-center justify-end">
                                <a href="{{ route('app.page.edit', ['id' => $item->id]) }}"
                                    class="mr-2 px-2 ease-in duration-300 hover:shadow-md py-2 flex justify-start items-center rounded-md bg-blue-500 hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-300">
                                    <i data-lucide="file-edit" class="mr-2 w-4"></i>Edit
                                </a>
                                <button wire:click="delete({{ $item->id }})"
                                    class="mr-2 px-2 ease-in duration-300 hover:shadow-md py-2 flex justify-start items-center rounded-md bg-red-500 hover:bg-red-600 active:bg-red-700 focus:outline-none focus:ring focus:ring-red-300">
                                    <i data-lucide="trash-2" class="mr-2 w-4"></i>Delete
                                </button>
                                <a href="{{ route('frontend-pages', ['slug' => $item->slug]) }}"
                                    class="px-2 ease-in duration-300 hover:shadow-md py-2 flex justify-start items-center rounded-md bg-violet-500 hover:bg-violet-600 active:bg-violet-700 focus:outline-none focus:ring focus:ring-violet-300">
                                    <i data-lucide="eye" class="mr-2 w-4"></i>View
                                </a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
                <tfoot class="bg-blue-500">
                    <tr>
                        <th class="text-white">ID</th>
                        <th class="text-white">Title</th>
                        <th class="text-white">Status</th>
                        <th class="text-white">Last Modified</th>
                        <th class="text-white">Actions</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </main>
</div>
