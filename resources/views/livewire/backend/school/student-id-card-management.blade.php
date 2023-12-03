<div>
    <main>
        <div class="container px-10 py-5">
            <header class="mb-4" wire:ignore>
                <div class="flex justify-center sm:justify-start items-center">
                    <span class="shadow-md px-2 py-2 bg-emerald-500 rounded mr-2">
                        <svg class="w-6 dark:fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <title>id-card</title>
                            <path
                                d="M4 4C2.89 4 2 4.89 2 6V18C2 19.11 2.89 20 4 20H20C21.11 20 22 19.11 22 18V6C22 4.89 21.11 4 20 4H4M4 6H20V10H4V6M4 12H8V14H4V12M10 12H20V14H10V12M4 16H14V18H4V16M16 16H20V18H16V16Z" />
                        </svg>
                    </span>
                </div>
            </header>

            <div class="flex flex-wrap items-start">
                <div class="w-full sm:w-5/12 bg-gray-300 dark:bg-slate-800 py-5 px-3 rounded-md">
                    <form wire:submit='generate' class="flex flex-col gap-3">
                        <h2 class="text-center border-b border-gray-400 dark:border-slate-900 pb-3 pt-2 text-lg">
                            Generate Student ID Card</h2>
                        <div>
                            <label for="" class="form-label">Class</label>
                            <select name="" wire:model.blur='class_id' class="form-select rounded" id=""
                                wire:change='getSection'>
                                <option value="">Select class</option>
                                @foreach ($classes as $item)
                                    <option value="{{ $item->id }}">{{ $item->class_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @if ($this->groups != null)
                            <div class="">
                                <label for="group_id" class="form-label">Groups</label>
                                <select wire:model.blur='group_id' class="form-select rounded" wire:change='getStudents'
                                    wire:loading.class='opacity-50 blur-sm' wire:target='getSection' id="group_id">
                                    <option value="">Select group</option>
                                    @forelse ($this->groups as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $item->id == $this->group_id ? 'selected' : '' }}>
                                            {{ $item->group_name }}</option>
                                    @empty
                                        <option value="" disabled>No group found</option>
                                    @endforelse
                                </select>
                                @error('group_id')
                                    <span class="text-sm text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        @else
                            <div class="">
                                <label for="section_id" class="form-label">Section</label>
                                <select wire:model.blur='section_id' class="form-select rounded"
                                    wire:change='getStudents' wire:loading.class='opacity-50 blur-sm'
                                    wire:target='getSection' id="section_id">
                                    <option value="">Select section</option>
                                    @forelse ($sections as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $item->id == $this->section_id ? 'selected' : '' }}>
                                            {{ $item->section_name }}</option>
                                    @empty
                                        <option value="" disabled>No section found
                                        </option>
                                    @endforelse
                                </select>
                                @error('section_id')
                                    <span class="text-sm text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif
                        <div>
                            <label for="" class="form-label">Students</label>
                            <select name="" wire:model.blur='student_id' class="form-select rounded"
                                id="" wire:change='setIDcard'>
                                <option value="">Select student</option>
                                @forelse ($students as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $item->id == $this->section_id ? 'selected' : '' }}>
                                        {{ $item->name_en . ' ID- ' . $item->student_id }}</option>
                                @empty
                                    <option value="" disabled>No student found
                                    </option>
                                @endforelse
                            </select>
                        </div>
                        <div>
                            <div x-data="{ uploading: false, progress: 0 }" x-on:livewire-upload-start="uploading = true"
                                x-on:livewire-upload-finish="uploading = false"
                                x-on:livewire-upload-error="uploading = false"
                                x-on:livewire-upload-progress="progress = $event.detail.progress">
                                <!-- File Input -->
                                <div class="flex items-center justify-center w-full">
                                    <label for="dropzone-file"
                                        class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400"
                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 20 16">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                            </svg>
                                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                                    class="font-semibold">Click to upload</span> or drag and drop</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF
                                                (MAX.
                                                800x400px)</p>
                                        </div>
                                        <input id="dropzone-file" wire:model.blur='photo' type="file"
                                            class="hidden" />
                                    </label>
                                </div>

                                <!-- Progress Bar -->
                                <div x-show="uploading">
                                    <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full"
                                        :style="{ width: progress + '%' }">
                                        <span x-text="progress"></span>%
                                    </div>

                                </div>
                                @if ($photo)
                                    <img src="{{ $photo->temporaryUrl() }}" width="150px" class="rounded-md mt-3">
                                @endif
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="px-3 py-2 rounded-md bg-emerald-500 mt-3">Generate</button>
                        </div>
                    </form>
                </div>
                <div class="w-2/12"></div>
                <div class="w-5/12 bg-gray-300 dark:bg-slate-800 py-5 px-3 rounded-md">
                    <h2 class="mb-2 pb-2 pt-1 text-2xl text-center border-b border-gray-400 dark:border-slate-900">
                        Preview</h2>
                    <div class="rounded-md flex bg-cover py-5 px-3 bg-no-repeat back"
                        style="background-image: url('{{ isset($photo) ? $photo->temporaryUrl() : 'https://img.freepik.com/free-photo/background_53876-32170.jpg?size=626&ext=jpg&ga=GA1.1.2116175301.1700870400&semt=ais' }}')"
                        id="profile-card" wire:loading.class="opacity-50" wire:target='setIDcard'>
                        <div class="w-1/3 flex flex-col items-center">
                            <img class=" rounded-full mb-2" src="{{ 'https://placehold.co/80x80/png' }}"
                                alt="">
                            <img class="relative block px-3"
                                src="{{ isset($card['student']->student_image) ? config('app.url') . '/storage/' . $card['student']->student_image : 'https://placehold.co/100x100/png' }}"
                                alt="">
                        </div>
                        <div class="w-2/3">
                            <h2 class=" font-bold text-2xl uppercase text-center mb-0 text-blue-600">
                                {{ school()->institute_name }}
                            </h2>
                            <p class="text-center text-black text-xs mb-2">
                                {{ school()->institute_address }}
                            </p>
                            <div class="text-black flex flex-wrap gap-2 justify-center mb-1 border-b border-blue-600">
                                <span class=" font-medium">Phone: {{ school()->mobile_no }}</span>
                                <span class=" font-medium">Web: {{ school()->web_address }}</span>
                            </div>
                            <div class="py-2 flex-col text-slate-900 gap-2">
                                <div class="flex gap-1">
                                    <span class=" font-medium">Name:</span>
                                    <span>{{ $card['student']->name_en ?? 'xxxxxxxxxxx' }}</span>
                                </div>
                                <div class="flex gap-1">
                                    <span class=" font-medium">Class:</span>
                                    <span>{{ $card['student']->school_class->class_name ?? 'xxxxxx' }}</span>
                                </div>
                                <div class="flex gap-1">
                                    <span class=" font-medium">DOB:</span>
                                    <span>{{ isset($card['student']->dob) ? \carbon\carbon::parse($card['student']->dob)->toDateString() : 'xx-xx-xxxx' }}</span>
                                </div>
                                <div class="flex gap-1">
                                    <span class=" font-medium">Address:</span>
                                    <span>
                                        {{ !empty($card['student'])
                                            ? $card['student']->village . ', ' . $card['student']['upazila'] . ', ' . $card['student']['district']
                                            : 'xxx,xxxxxxx,xxxx,xxxxxxxxx' }}</span>
                                </div>
                                <div class="flex gap-1">
                                    <span class=" font-medium">Phone:</span>
                                    <span>{{ $card['student']->mobile_number ?? '0123456789' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="justify-end gap-3 flex flex-wrap">
                        <button
                            class="bg-emerald-500 transition-all duration-300 mt-3 hover:bg-emerald-700 rounded-md py-2 px-4">
                            Save
                        </button>
                        <button wire:click='loadPdf'
                            class="bg-yellow-400 transition-all duration-300 mt-3 hover:bg-yellow-500/90 rounded-md py-2 px-4">
                            Download
                        </button>
                    </div>
                </div>
            </div>
            {{-- <div wire:ignore>
                <table id="example" class="display" style="width: 100%">
                    <thead class="bg-blue-500 border-none">
                        <tr>
                            <th class="text-white">ID</th>
                            <th class="text-white">Class</th>
                            <th class="text-white">Section/Group</th>
                            <th class="text-white">Category</th>
                            <th class="text-white">Fee name</th>
                            <th class="text-white">Amount</th>
                            <th class="text-white text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($fees as $key => $item)
                            <tr wire:key='{{ $item->id }}' class="border-b">
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    {{ $item->class->class_name }}
                                </td>
                                <td>
                                    {{ $item->group?->group_name ?? $item->section?->section_name }}
                                </td>
                                <td>
                                    {{ $item->category->category_name }}
                                </td>
                                <td>
                                    {{ $item->fee_name }}
                                </td>
                                <td>
                                    {{ $item->amount }}
                                </td>
                                <td class="p-3 al flex justify-end items-center gap-1.5 flex-wrap">
                                    <span
                                        class="px-2 py-1 rounded-sm bg-yellow-300 cursor-pointer flex w-max align-center justify-center"
                                        wire:click='edit({{ $item->id }})' @click="openCEmodal = true"
                                        data-modal-target="CEmodal" data-modal-toggle="CEmodal">
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
                            <th class="text-white">Class</th>
                            <th class="text-white">Section/Group</th>
                            <th class="text-white">Category</th>
                            <th class="text-white">Fee name</th>
                            <th class="text-white">Amount</th>
                            <th class="text-white text-right">Actions</th>
                        </tr>
                    </tfoot>
                </table>
            </div> --}}

        </div>
    </main>
</div>

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
