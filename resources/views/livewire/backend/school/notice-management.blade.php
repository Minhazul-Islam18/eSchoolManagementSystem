<div x-data="{ openCEmodal: @entangle('openCEmodal') }">
    <main class="container">
        <header class="flex items-center flex-wrap mt-24 mb-4" wire:ignore>
            <div class="w-1/2 flex justify-start items-center flex-wrap">
                <span class="shadow-md px-2 py-2 bg-emerald-500 rounded mr-2">
                    <i data-lucide="candlestick-chart" class="w-10"></i>
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
                    class="max-h-[90vh] overflow-y-scroll inline-block w-full max-w-[80vw] p-8 overflow-hidden text-left transition-all transform bg-white dark:bg-slate-800 rounded-lg shadow-xl 2xl:max-w-2xl">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between space-x-4">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            {{ $this->editable_item ? 'Edit' : 'Create' }} Notice
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
                                <form class="h-full flex flex-col justify-between" action=""
                                    wire:submit='{{ $this->editable_item ? 'update' : 'store' }}'>
                                    <!-- Modal body -->
                                    <div class="p-6 space-y-6 h-full">
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            <div wire:ignore>
                                                <select class="form-control" id="classes" wire:model.blur='class'
                                                    multiple="multiple" style="width: 100%">
                                                    <option rel="select-all" value="0">Select All</option>
                                                    @foreach ($allClass as $class)
                                                        <option value="{{ $class->id }}"
                                                            @if (in_array($class->id, $this->class)) selected @endif>
                                                            {{ $class->class_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('class')
                                                    <span class="text-sm text-red-500">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="">
                                                <label for="" class="form-label">Title</label>
                                                <input wire:model.blur='title' type="text"
                                                    class="form-input rounded placeholder:text-gray-300"
                                                    placeholder="Notice title" id="">
                                                @error('title')
                                                    <span class="text-sm text-red-500">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="">
                                                <label
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                                    for="file_input">Upload file</label>
                                                <input
                                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                                    aria-describedby="file_input_help" id="file_input" type="file"
                                                    wire:model.blur='files'>

                                                @error('files')
                                                    <span class="text-sm text-red-500">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="" wire:ignore>
                                            <label for="" class="form-label">Description</label>
                                            <textarea id="desc" class="form" wire:model.blur="description" id="" cols="30" rows="10">{!! $this->description !!}</textarea>
                                            @error('description')
                                                <span class="text-sm text-red-500">{{ $message }}</span>
                                            @enderror
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
                        <th class="text-white">Title</th>
                        <th class="text-white text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($notices as $key => $item)
                        <tr wire:key='{{ $item->id }}' class="border-b">
                            <td>{{ $key + 1 }}</td>
                            <td>
                                {{ $item->title }}
                            </td>
                            <td class="p-3 al flex justify-end items-center gap-1.5 flex-wrap">
                                <a href="{{ route('school.notice.slug', ['slug' => $item->slug]) }}"
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
                        <th class="text-white text-right">Actions</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </main>
</div>
@push('page-style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@push('page-script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/v7tu257eo4k9fppduhlvl0hjsh9rsoe103qgovgm65t899e7/tinymce/6/tinymce.min.js">
    </script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.tailwindcss.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script>
        tinymce.init({
            selector: 'textarea#desc',
            height: 300,
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'media', 'table', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | blocks | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }',
            forced_root_block: false,
            setup: function(editor) {
                editor.on('init change', function() {
                    editor.save();
                });
                editor.on('change', function(e) {
                    @this.set('description', editor.getContent());
                });
            }
        });
        // Livewire.on('changed', (params) => {

        // })
        document.addEventListener('livewire:init', function() {
            // Access the Livewire property using @this
            $('#classes').select2({
                placeholder: "Select class",
            }).on('change', function(e) {
                @this.set('class', $(this).val());
                let val = $(this).val();
                if (val == null) return false;

                if (val.indexOf("0") == 0) {
                    $(this).find('option[rel=select-all]').prop('selected', false).change();
                    $(this).find('option:not(:selected,[rel=select-all])').not(this).prop('selected', true)
                        .change();
                }
                // if (val.indexOf("0") == 0) {
                // $(this).find('option[rel=select-all]').prop('selected', false).change();
                // $(this).find('option:not(:selected,[rel=select-all])').not(this).prop('selected', true)
                //     .change();
                // }
            });

            // $('select[id^=classes]').change(function() {
            //     let val = $(this).val();
            //     @this.set('class', val);
            //     if (val == null) return false;
            //     if (val.indexOf("0") == 0) {
            //         $(this).find('option[rel=select-all]').prop('selected', false).change();
            //         $(this).find('option:not(:selected,[rel=select-all])').not(this).prop('selected', true)
            //             .change();
            //     }
            // });
        });
        new DataTable('#example', {
            responsive: true,
            retrieve: true,
            paging: true
        });
        $('#example_filter label').addClass('flex justify-end items-center');
        $('#example_paginate div').addClass('flex justify-end items-center');
        $('.dtr-data').addClass('flex flex-wrap gap-2');
        // Livewire.directive('confirm', ({
        //     el,
        //     directive,
        //     component,
        //     cleanup
        // }) => {
        //     let content = directive.expression

        //     let onClick = e => {
        //         if (!confirm(content)) {
        //             e.preventDefault()
        //             e.stopImmediatePropagation()
        //         }
        //     }

        //     el.addEventListener('click', onClick, {
        //         capture: true
        //     })

        //     cleanup(() => {
        //         el.removeEventListener('click', onClick)
        //     })
        // })
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
