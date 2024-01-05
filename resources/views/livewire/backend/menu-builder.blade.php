<div x-data="{ openCEmodal: @entangle('openCEmodal') }">
    <main>
        <div class="container px-6 py-3">
            <header class="flex items-center flex-wrap" wire:ignore>
                <div class="w-1/2 flex justify-start items-center flex-wrap">
                    <span class="shadow-md px-2 py-2 bg-pink-200/25 rounded mr-2">
                        <i data-lucide="list-tree" class="w-10"></i>
                    </span>
                    <span class="flex justify-start items-center flex-wrap gap-2">
                        <h2 class="text-xl m-0">Menu Builder</h2>
                        <code class="bg-green-100/10 p-2 border border-pink-500 rounded">
                            {{ $this->menu['name'] }}
                        </code>
                    </span>
                </div>
                <div class="w-1/2 flex justify-end items-center gap-3">
                    <a href="{{ route('app.menus') }}"
                        class="bg-red-500 bg-opacity-25 border border-red-500 rounded flex items-center px-2 py-1 shahow-md hover:bg-opacity-100 transition fade gap-2">
                        <i data-lucide="arrow-left-circle" class="w-4"></i>
                        Back
                    </a>
                    <button @click="openCEmodal = true" data-modal-target="CEmodal" data-modal-toggle="CEmodal"
                        class="bg-green-500 bg-opacity-25 border border-green-500 rounded flex items-center px-2 py-1 shahow-md hover:bg-opacity-100 transition fade gap-2">
                        <i data-lucide="plus-circle" class="w-4"></i>
                        Create Item
                    </button>
                </div>
            </header>
            <div wire:ignore
                class="flex items-center flex-wrap py-4 px-3 rounded bg-white dark:bg-gray-800 shadow-lg mt-3 sm:mt-2 md:mt-2">
                <div class="w-full">
                    <h6 class="text-xl dark:text-white uppercase">Usage:</h6>
                    <div class="flex gap-2 items-center justify-start">
                        <h6 class="text-md dark:text-white">You can call this menu by using </h6>
                        <code class="bg-green-100 bg-opacity-10 p-2 border border-pink-500 rounded">
                            menu({{ $this->menu['name'] }}) </code>
                    </div>
                </div>
            </div>

            {{-- Menu Items --}}

            <!-- Modal toggle -->
            {{-- <button data-modal-target="CEmodal" data-modal-toggle="CEmodal"
                class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                type="button">
                Toggle modal
            </button> --}}

            <!-- Main modal -->
            <div id="CEmodal" tabindex="-1" aria-hidden="true" x-show="openCEmodal"
                class="fixed top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full justify-center items-center flex">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 w-2/3">
                    <form action="" wire:submit='{{ $this->editable_menu_item ? 'updateItem' : 'storeItem' }}'>
                        <!-- Modal header -->
                        <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                {{ $this->editable_menu_item ? 'Edit' : 'Create' }} menu item
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
                        <div class="p-6 space-y-6" x-data="{ selectedType: @entangle('selectedType') }">
                            <div class="mb-3">
                                <label for="" class="form-label">Type</label>
                                <select wire:model.blur='menu_item_type' class="form-select rounded" name=""
                                    id="" x-model="selectedType">
                                    <option value="" selected>Select type</option>
                                    <option value="item">Item</option>
                                    <option value="divider">Divider</option>
                                </select>
                                @error('menu_item_type')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- Menu item option --}}
                            <div x-show="selectedType === 'item'" class="flex flex-wrap">
                                <div class="mb-3 w-full">
                                    <label for="" class="form-label">Title</label>
                                    <input type="text" wire:model.blur='menu_item_name' class="form-input rounded"
                                        name="" id="" placeholder="">
                                </div>
                                <div class="mb-3 w-full sm:w-1/2 md:w-1/2">
                                    <label for=""class="form-label">URL</label>
                                    <input type="text" wire:model.blur='menu_item_url' class="form-input rounded"
                                        name="" id="" placeholder="">
                                </div>
                                <div class="mb-3 w-full sm:w-1/2 md:w-1/2">
                                    <label for="" class="form-label">Icon
                                        <small class="underline text-purple-600">Use <a href="https://lucide.dev/"
                                                target="_blank" rel="noopener noreferrer">Lucide Icon</a></small>
                                    </label>
                                    <input type="text" wire:model.blur='menu_item_icon' class="form-input rounded"
                                        name="" id="" placeholder="">
                                </div>
                                <div class="mb-2 w-1/2">
                                    <label class="form-label flex items-center gap-1" for="tab-check">
                                        <input wire:model.blur='where_to_open'
                                            class="form-checkbox rounded border-gray-300 text-purple-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-offset-0 focus:ring-indigo-200 focus:ring-opacity-50"
                                            type="checkbox" value="" id="tab-check">
                                        Open in new tab
                                    </label>
                                </div>
                            </div>
                            {{-- Divider options --}}
                            <div x-show="selectedType === 'divider'">
                                <div class="mb-3">
                                    <label for="" class="form-label">Name</label>
                                    <input wire:model.blur='divider_title' type="text" class="form-input rounded"
                                        name="" id="" placeholder="">
                                </div>
                            </div>
                        </div>
                        <!-- Modal footer -->
                        <div
                            class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                            <button type="submit"
                                class="text-white bg-green-500 hover:bg-green-400 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-success-600 dark:hover:bg-green-400 dark:focus:ring-green-200/50">
                                {{ $this->editable_menu_item ? 'Update' : 'Save' }}</button>
                            @if ($this->editable_menu_item)
                                <button type="button" wire:click='resetFields'
                                    class="text-white bg-red-500 hover:bg-red-400 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-success-600 dark:hover:bg-red-400 dark:focus:ring-red-200/50">
                                    {{ 'Cancel' }}</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
            <div class="flex flex-wrap md:flex-row flex-col sm:flex-row items-center justify-around my-3">
                <div class="w-1/6"></div>
                <div class="w-4/6">
                    <div class="dd min-w-full">
                        <x-menu-builder-component :menuItems="$this->menu
                            ->menuItems()
                            ->orderBy('order', 'ASC')
                            ->get()" />

                        {{-- @livewire('backend.menu-dd-component', [
                            'menuItems' => $this->menu->menuItems()->orderBy('order', 'ASC')->get(),
                        ]) --}}
                    </div>
                </div>
                <div class="w-1/6"></div>
            </div>
        </div>
    </main>
</div>
@push('page-style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.css">
@endpush
@push('page-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.js"></script>
    {{-- <script src="https://unpkg.com/@nextapps-be/livewire-sortablejs@0.3.5/dist/livewire-sortable.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
    <script>
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
    <script>
        $(function() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });
            $('.dd').nestable({
                // maxDepth: 2
            });
            $('.dd').on('change', function(e) {
                console.log($('.dd').nestable('serialize'));
                $.post('{{ route('app.menu.reorder-menu', ['id' => $this->menu->id]) }}', {
                    order: JSON.stringify($('.dd').nestable('serialize')),
                    _token: '{{ csrf_token() }}'
                }, function(data) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Menu Re-ordered!'
                    })
                });
            });
        });
    </script>
@endpush
