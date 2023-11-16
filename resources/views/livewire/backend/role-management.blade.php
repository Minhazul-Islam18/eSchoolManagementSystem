<div x-data="{ OpenEditModal: false, OpenDeleteModal: false }">
    <main>
        <div class="container px-3 py-4" wire:ignore>
            @if (Auth::user()->hasPermission('app.roles.create'))
                <div class="flex flex-col md:flex-row sm:flex-row my-4">
                    <div class="w-0/4 sm:w-3/4"></div>
                    <div class="w-4/4 sm:w-1/4 flex justify-end align-center">
                        <button
                            class=" border-x-red-500 border-y-purple-500 flex hover:shadow-md hover:border-slate-400 hover:bg-purple-500 ease rounded border-2 px-5 py-2"
                            wire:click='CreateRole' @click="OpenEditModal = true">
                            <i data-lucide="plus-circle" class="w-4 me-1"></i>Add</button>
                    </div>
                </div>
            @endif
            <table id="example" class="display" style="width: 100%">
                <thead>
                    <tr>
                        <th class="text-white">ID</th>
                        <th class="text-white">Role</th>
                        <th class="text-white">Permissions</th>
                        <th class="text-white">Last Modified</th>
                        <th class="text-white">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $key => $item)
                        <tr wire:key='{{ $item->id }}' class="border-b">
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->name }}</td>
                            <td class="flex flex-wrap gap-2">
                                @if (count($item->permissions) > 0)
                                    @foreach ($item->permissions as $perm)
                                        <span wire:key='{{ $perm->id }}'
                                            class="inline-block bg-green-600 dark:bg-indigo-500 rounded-md p-1 text-sm">{{ $perm->name }}</span>
                                    @endforeach
                                @else
                                    <span
                                        class="inline-block bg-yellow-500 rounded-md p-1 text-sm">{{ 'No Permissions Found for this Role :(' }}</span>
                                @endif
                            </td>
                            <td>
                                {{ $item->updated_at->diffForHumans() }}
                            </td>
                            <td>
                                <span
                                    class="px-2 py-1 rounded-sm bg-yellow-500 cursor-pointer flex w-max align-center justify-center"
                                    wire:click='EditRole({{ $item->id }})' @click="OpenEditModal = true">
                                    <i data-lucide="pen-square" class="w-4 me-1"></i> Edit
                                </span>
                                @if ($item->is_deletable)
                                    <span
                                        class="p-2 rounded-sm bg-red-500 cursor-pointer flex w-max align-center justify-center"
                                        wire:click='DeleteConfirmation({{ $item->id }})'
                                        @click="OpenDeleteModal = true">
                                        <i data-lucide="trash-2" class="w-4 me-1"></i>Delete
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th class="text-white">ID</th>
                        <th class="text-white">Role</th>
                        <th class="text-white">Permissions</th>
                        <th class="text-white">Last Modified</th>
                        <th class="text-white">Actions</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </main>
    {{-- Edit Modal --}}
    <div class="relative flex justify-center items-center">
        <div x-show="OpenEditModal" class="modal w-full h-screen bg-gray-900 bg-opacity-80 top-0 fixed sticky-0">
            <div class="2xl:container h-full  2xl:mx-auto flex justify-center items-center">
                <div style="height: 50vh; min-width: 50vw; max-width:90vw"
                    class="px-12 overflow-y-scroll py-5 w-100 md:w-100 mx-0 my-auto bg-white dark:bg-gray-800 relative p-3">
                    <span class="text-center block text-xl pb-2 border-b mb-2">
                        @if (!empty($this->editable_role))
                            {{ __('Edit Role') }}
                        @else
                            {{ __('Create Role') }}
                        @endif
                    </span>
                    <form action=""
                        wire:submit.prevent='{{ !empty($this->editable_role) ? 'UpdateRole' : 'StoreRole' }}'>
                        <div class="flex flex-col">
                            <div class="w-100 sm:w-100 md:w-100">
                                <label for="role_name" class="block text-sm font-medium leading-6 text-gray-900">
                                    {{ __('Role Name') }}
                                </label>
                                <div class="mt-2">
                                    <input type="text" wire:model="role_name" id="role_name"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                                @error('role_name')
                                    <span class="text-red-500 block font-medium mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                            @empty(!$AllModules)
                                <span
                                    class="w-100 text-center text-xl pb-2 pt-3 font-medium">{{ __('Permissions for this role') }}</span>
                                @error('permissions')
                                    <span class="text-red-500 block font-medium mt-1">{{ $message }}</span>
                                @enderror
                                @forelse ($AllModules->chunk(2) as $key=>$chunk)
                                    @foreach ($chunk as $module)
                                        <div class="w-100 py-2 border-t flex flex-row border-gray-600"
                                            wire:key='{{ $module->id }}'>
                                            <div class="w-2/2 sm:w-1/2 md:w-1/2">
                                                <span class="block text-start text-xl"> {{ __($module->name) }}</span>
                                            </div>
                                            <div class="w-2/2 sm:w-1/2 md:w-1/2 flex flex-col gap-1.5">
                                                @foreach ($module->permissions as $key => $perms)
                                                    <label class="inline-flex items-center" wire:key='{{ $perms->id }}'>
                                                        <input type="checkbox" wire:model='permissions.{{ $perms->id }}'
                                                            value="{{ $perms->id }}"
                                                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-offset-0 focus:ring-indigo-200 focus:ring-opacity-50"
                                                            id="perms{{ $perms->id }}">
                                                        <span class="ml-2">{{ $perms->name }}</span>
                                                    </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                @empty
                                    <span class="text-md text-red-500 center">{{ __('No Module Found!') }}</span>
                                @endforelse
                            @endempty

                            <div class="block text-center mt-3">
                                <button type="submit" @click="OpenEditModal = false"
                                    class="bg-green-500 text-black-500 py-2 px-5 rounded">{{ !empty($this->editable_role) ? 'Update' : 'Create' }}</button>
                            </div>
                        </div>
                    </form>
                    <img wire:loading wire:target='EditRole'
                        src="https://media.tenor.com/K2UGDd4acJUAAAAC/load-loading.gif" width="75px" alt="">
                    <button @click="OpenEditModal = false" onclick="showModal(true)"
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
    {{-- Delete Modal --}}
    <div class="relative flex justify-center items-center">
        <div x-show="OpenDeleteModal" class="modal w-full h-screen bg-gray-900 bg-opacity-80 top-0 fixed sticky-0">
            <div class="2xl:container h-full  2xl:mx-auto flex justify-center">
                <div style="height: 50vh; min-width: 50vw; max-width:90vw"
                    class="px-12 overflow-y-scroll py-5 w-100 md:w-100 mx-0 my-auto bg-white dark:bg-gray-800 relative p-3">
                    <div class=" flex flex-col items-center justify-center gap-3 h-full">
                        <span class="inline-block text-2xl font-medium">
                            Are You want to delete this? This action will be irreverseable!
                        </span>
                        <div class="flex w-full justify-between items-center">
                            <button wire:click='DeleteRole' @click="OpenDeleteModal = false"
                                class="bg-red-500 rounded border border-yellow-500 py-2 px-10 font-medium text-xl">Delete</button>
                            <button @click="OpenDeleteModal = false"
                                class="bg-green-500 rounded py-2 px-10 font-medium text-xl">Cancel</button>
                        </div>
                    </div>
                    <button @click="OpenDeleteModal = false" onclick="showModal(true)"
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
