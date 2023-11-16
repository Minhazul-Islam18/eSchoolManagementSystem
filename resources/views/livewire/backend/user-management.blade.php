<div x-data="{ OpenEditModal: @entangle('OpenEditModal'), OpenViewModal: false }">
    <main>
        <div class="container px-3 py-4" wire:ignore>
            @if (Auth::user()->hasPermission('app.users.create'))
                <div class="flex flex-col md:flex-row sm:flex-row my-4">
                    <div class="w-0/4 sm:w-3/4"></div>
                    <div class="w-4/4 sm:w-1/4 flex justify-end align-center">
                        <button
                            class="shadow-md bg-green-200 backdrop-blur-sm text-black
                            hover:transition-all duration-200 flex hover:shadow-md hover:border-slate-400 hover:bg-purple-500 ease rounded border-2 px-5 py-2"
                            @click="OpenEditModal = true" wire:click='getAllRoles'>
                            <i data-lucide="plus-circle" class="w-4 me-1"></i>Add</button>
                    </div>
                </div>
            @endif
            <table id="example" class="display" style="width: 100%">
                <thead class="bg-blue-500 border-none">
                    <tr>
                        <th class="text-white">ID</th>
                        <th class="text-white">Name</th>
                        <th class="text-white">User</th>
                        <th class="text-white">Created at</th>
                        <th class="text-white">Status</th>
                        <th class="text-white">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $key => $item)
                        <tr wire:key='{{ $item->id }}' class="border-b">
                            <td>{{ $key + 1 }}</td>
                            <td>
                                <div class="flex items-center gap-2 flex-wrap">
                                    <img class="h-10 w-10 rounded-full object-cover"
                                        src="{{ $item->profile_photo_path ?? $item->profile_photo_url }}"
                                        alt="{{ $item->name }}" />
                                    {{ $item->name }}
                                </div>
                            </td>
                            <td>
                                {{ $item->role->name ?? 'User' }}
                            </td>
                            <td>
                                {{ $item->created_at->diffForHumans() }}
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
                                    wire:click='edit({{ $item->id }})' @click="OpenEditModal = true">
                                    <i data-lucide="pen-square" class="w-4 me-1"></i> Edit
                                </span>
                                <span
                                    class="px-2 py-1 rounded-sm bg-blue-500 cursor-pointer flex w-max align-center justify-center"
                                    wire:click='view({{ $item->id }})' @click="OpenViewModal = true">
                                    <i data-lucide="eye" class="w-4 me-1"></i> View
                                </span>
                                <button
                                    class="px-2 py-1 rounded-sm bg-red-500 cursor-pointer flex w-max align-center justify-center"
                                    wire:confirm="Are you sure?" wire:click="delete({{ $item->id }})"><i
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
                        <th class="text-white">User</th>
                        <th class="text-white">Created at</th>
                        <th class="text-white">Status</th>
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
                    class="px-12 overflow-y-scroll py-5 w-100 md:w-100 mx-0 my-auto bg-white dark:bg-gray-800 relative p-3">
                    <span class="text-center block text-xl pb-2 border-b mb-2">
                        @if ($this->editable_user)
                            {{ __('Edit User') }}
                        @else
                            {{ __('Create User') }}
                        @endif
                    </span>
                    <form action="" wire:submit='{{ $this->editable_user ? 'update' : 'store' }}'>
                        <div class="flex flex-row flex-wrap">
                            <div class="w-full sm:w-full md:w-1/2 md:pr-1 py-1">
                                <label for="role_name"
                                    class="form-label after:content-['*'] after:ml-0.5 after:text-red-500 ">
                                    {{ __('Name') }}
                                </label>
                                <input type="text" wire:model.blur="user.name" id="name"
                                    class="form-input rounded">
                                @error('user.name')
                                    <span class="text-red-500 block font-medium mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="w-full sm:w-full md:w-1/2 md:pl-1 py-1">
                                <label for=""
                                    class="form-label after:content-['*'] after:ml-0.5 after:text-red-500 ">Role</label>
                                <select name="" wire:model.blur='user.role' id=""
                                    class="form-select rounded">
                                    <option value="">Select Role</option>
                                    @isset($this->all_roles)
                                        @foreach ($this->all_roles as $item)
                                            <option value="{{ $item->id }}"
                                                @if ($item->id == $this->user['role']) {{ 'selected' }} @endif
                                                wire:key='{{ $item->id }}'>
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    @endisset
                                </select>
                                @error('user.role')
                                    <span class="text-red-500 block font-medium mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="w-full py-1">
                                <label class="form-label after:content-['*'] after:ml-0.5 after:text-red-500 "
                                    for="">Email</label>
                                <input wire:model.blur='user.email' class="form-input rounded" type="email"
                                    name="" id="">
                                @error('user.email')
                                    <span class="text-red-500 block font-medium mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="w-full sm:w-full md:w-1/2 md:pl-1 py-1">
                                <label for=""
                                    class="form-label after:content-['*'] after:ml-0.5 after:text-red-500 ">Password</label>
                                <input class="form-input rounded" wire:model.blur='user.password' type="password"
                                    name="" id="">
                                @error('user.password')
                                    <span class="text-red-500 block font-medium mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="w-full sm:w-full md:w-1/2 md:pl-1 py-1">
                                <label for=""
                                    class="form-label after:content-['*'] after:ml-0.5 after:text-red-500 ">Confirm
                                    password</label>
                                <input class="form-input rounded" wire:model.blur='user.password_confirmation'
                                    type="password" name="" id="">
                                @error('user.password_confirmation')
                                    <span class="text-red-500 block font-medium mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="w-1/2">
                                <div class="block text-left mt-3">
                                    <button type="submit"
                                        class="bg-green-500 text-black-500 py-2 px-5 rounded">{{ $this->editable_user ? 'Update' : 'Create' }}</button>
                                    @if ($this->editable_user)
                                        <button type="button" wire:click='ResetFields'
                                            @click="OpenEditModal = false"
                                            class="bg-red-500 text-black-500 py-2 ml-2 px-5 rounded">{{ 'Cancel' }}</button>
                                    @endif
                                </div>
                            </div>
                            <div class="w-1/2">
                                <label for=""
                                    class="form-label after:content-['*'] after:ml-0.5 after:text-red-500 ">Status
                                </label>
                                <input type="checkbox" name="" class="form-checkbox rounded"
                                    wire:model.blur='user.status'>
                                @error('user.status')
                                    <span class="text-red-500 block font-medium mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </form>
                    <img wire:loading wire:target='edit'
                        src="https://media.tenor.com/K2UGDd4acJUAAAAC/load-loading.gif" width="75px"
                        alt="">
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
    {{-- View Modal --}}
    <div class="relative flex justify-center items-center">
        <div x-show="OpenViewModal" class="modal w-full h-screen bg-gray-900 bg-opacity-80 top-0 fixed sticky-0">
            <div class="2xl:container h-full  2xl:mx-auto flex justify-center items-center">
                <div style="height: 50vh; min-width: 50vw; max-width:90vw"
                    class="px-12 overflow-y-scroll py-5 w-100 md:w-100 mx-0 my-auto bg-white dark:bg-gray-800 relative p-3">
                    <h4 class="pb-2 border-b border-slate-600 text-xl">Preview User</h4>
                    @isset($this->preview_user)
                        <div class="w-full flex flex-wrap py-2">
                            <div class="w-1/4 pr-2 flex justify-between py-2 border-b border-slate-600">
                                <span>{{ 'Name' }}</span>
                                <span>{{ ':' }}</span>
                            </div>
                            <div class="w-3/4 py-2 border-b border-slate-600">
                                <span>{{ $this->preview_user['name'] }}</span>
                            </div>
                            <div class="w-1/4 pr-2 flex justify-between py-2 border-b border-slate-600">
                                <span>{{ 'Email' }}</span>
                                <span>{{ ':' }}</span>
                            </div>
                            <div class="w-3/4 py-2 border-b border-slate-600">
                                <span>{{ $this->preview_user['email'] }}</span>
                            </div>
                            <div class="w-1/4 pr-2 flex justify-between py-2 border-b border-slate-600">
                                <span>{{ 'Role' }}</span>
                                <span>{{ ':' }}</span>
                            </div>
                            <div class="w-3/4 py-2 border-b border-slate-600">
                                <span>{{ $this->preview_user->role['name'] ?? 'User' }}</span>
                            </div>
                            <div class="w-1/4 pr-2 flex justify-between py-2 border-b border-slate-600">
                                <span>{{ 'Status' }}</span>
                                <span>{{ ':' }}</span>
                            </div>
                            <div class="w-3/4 py-2 border-b border-slate-600"> <span
                                    class="py-1 px-2 rounded-sm {{ $this->preview_user['status'] == 'Inactive' ? 'bg-emerald-500' : 'bg-slate-600' }} text-white">{{ $this->preview_user['status'] ? 'Active' : 'Inactive' }}</span>
                            </div>
                        </div>
                    @endisset

                    <img wire:loading wire:target='view'
                        src="https://media.tenor.com/K2UGDd4acJUAAAAC/load-loading.gif" width="75px"
                        alt="">
                    <button @click="OpenViewModal = false"
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
