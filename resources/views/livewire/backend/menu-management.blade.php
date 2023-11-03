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
<div x-data="{ OpenEditModal: @entangle('OpenEditModal'), OpenViewModal: false }">
    <main>
        <div class="container px-3 py-4" wire:ignore>
            @if (Auth::user()->hasPermission('app.menus.create'))
                <div class="flex flex-col md:flex-row sm:flex-row my-4">
                    <div class="w-0/4 sm:w-2/4"></div>
                    <div class="w-4/4 sm:w-2/4 flex justify-end align-center">
                        <button type="button" @click="OpenEditModal = true"
                            class="shadow-md bg-green-500 flex items-center backdrop-blur-sm text-black duration-200 hover:shadow-md hover:border-slate-400 ease-in hover:bg-lime-500 ease rounded border-2 px-5 py-2">
                            <i data-lucide="plus-circle" class="w-4 me-1"></i>Create</button>
                    </div>
                </div>
            @endif
            <table id="TableOfData" class="display" style="width: 100%">
                <thead class="bg-blue-500 border-none">
                    <tr>
                        <th class="text-white">ID</th>
                        <th class="text-white">Name</th>
                        <th class="text-white">Description</th>
                        <th class="text-white">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($menus as $key => $item)
                        <tr>
                            <td>
                                {{ $key + 1 }}
                            </td>
                            <td>{{ $item->name }}</td>

                            <td>{{ $item->description }}</td>
                            <td class="flex items-center justify-end">
                                <a href="{{ route('app.menu.builder', ['id' => $item->id]) }}"
                                    class="mr-2 px-2 ease-in duration-300 hover:shadow-md py-2 flex justify-start items-center rounded-md bg-green-500 hover:bg-green-600 active:bg-green-700 focus:outline-none focus:ring focus:ring-green-200">
                                    <i data-lucide="list-tree" class="mr-2 w-4"></i>Builder
                                </a>
                                <button @click="OpenEditModal = true" wire:click='edit({{ $item->id }})'
                                    class="mr-2 px-2 ease-in duration-300 hover:shadow-md py-2 flex justify-start items-center rounded-md bg-blue-500 hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-300">
                                    <i data-lucide="file-edit" class="mr-2 w-4"></i>Edit
                                </button>
                                @if ($item->is_deletable)
                                    <button wire:click="destroy({{ $item->id }})"
                                        class="mr-2 px-2 ease-in duration-300 hover:shadow-md py-2 flex justify-start items-center rounded-md bg-red-500 hover:bg-red-600 active:bg-red-700 focus:outline-none focus:ring focus:ring-red-300">
                                        <i data-lucide="trash-2" class="mr-2 w-4"></i>Delete
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                </tbody>
                <tfoot class="bg-blue-500">
                    <tr>
                        <th class="text-white">ID</th>
                        <th class="text-white">Name</th>
                        <th class="text-white">Description</th>
                        <th class="text-white">Actions</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </main>

    {{-- Create & Edit Modal --}}
    <div class="relative flex justify-center items-center">
        <div x-show="OpenEditModal" class="modal w-full h-screen bg-gray-900 bg-opacity-80 top-0 fixed sticky-0">
            <div class="2xl:container h-full  2xl:mx-auto flex justify-center items-center">
                <div style="height: 50vh; min-width: 50vw; max-width:90vw"
                    class="px-12 overflow-y-scroll py-5 w-100 md:w-100 mx-0 my-auto dark:bg-gray-800 relative p-3">
                    <span class="text-center block text-xl pb-2 border-b mb-2">
                        @if ($this->editable_menu)
                            {{ __('Edit menu') }}
                        @else
                            {{ __('Create menu') }}
                        @endif
                    </span>
                    {{-- @dd($this->user) --}}
                    <form action="" wire:submit='{{ $this->editable_menu ? 'update' : 'store' }}'>
                        <div class="flex flex-row flex-wrap">
                            <div class="w-full">
                                <label for="name"
                                    class="form-label after:content-['*'] after:ml-0.5 after:text-red-500 ">
                                    {{ __('Name') }}
                                </label>
                                <input type="text" wire:model.blur="name" id="name" class="form-input rounded">
                                @error('name')
                                    <span class="text-red-500 block font-medium mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="w-full">
                                <label for="description"
                                    class="form-label after:content-['*'] after:ml-0.5 after:text-red-500 ">
                                    {{ __('Description') }}
                                </label>
                                <textarea id="description" wire:model.blur="description" class="form-textarea" cols="30" rows="10"></textarea>
                                @error('description')
                                    <span class="text-red-500 block font-medium mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="w-full">
                                <div class="block text-left mt-3">
                                    <button type="submit"
                                        class="bg-green-500 text-black-500 py-2 px-5 rounded">{{ $this->editable_menu ? 'Update' : 'Create' }}</button>
                                    @if ($this->editable_menu)
                                        <button type="button" wire:click='ResetFields' @click="OpenEditModal = false"
                                            class="bg-red-500 text-black-500 py-2 ml-2 px-5 rounded">{{ 'Cancel' }}</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                    <button @click="OpenEditModal = false" wire:click='ResetFields'
                        class="text-gray-800 dark:text-gray-400 absolute top-3 right-3 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800"
                        aria-label="close">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M18 6L6 18" stroke="currentColor" stroke-width="1.66667" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M6 6L18 18" stroke="currentColor" stroke-width="1.66667" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
