<div>
    <main class="container">
        <header class="flex justify-end flex-wrap mt-24 mb-4" wire:ignore>

            <a href="{{ route('school.notices') }}"
                class="bg-green-500 bg-opacity-25 border border-green-500 rounded flex items-center px-4 py-2 shahow-md hover:bg-opacity-100 transition fade gap-2">
                <i data-lucide="arrow-left-circle" class="w-4"></i>
                Back
            </a>
        </header>
        <form class="my-6" wire:submit='update'>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div wire:ignore>
                    <label for="" class="form-label mb-3">Select class</label>
                    <select class="form-control" id="classes" wire:model.blur='class' multiple="multiple"
                        style="width: 100%">
                        <option rel="select-all" value="0">Select All</option>
                        @foreach ($allClass as $class)
                            <option value="{{ $class->id }}" @if (in_array($class->id, $this->class)) selected @endif>
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
                    <input wire:model.blur='title' type="text" class="form-input rounded placeholder:text-gray-300"
                        placeholder="Notice title" id="">
                    @error('title')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload
                        file</label>
                    <input
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        aria-describedby="file_input_help" id="file_input" type="file" wire:model.blur='files'>

                    @error('files')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="mt-4" wire:ignore>
                <label for="" class="form-label mb-3">Description</label>
                <textarea id="desc" class="form" wire:model.blur="description" id="" cols="30" rows="10">{!! $this->description !!}</textarea>
                @error('description')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <button class="bg-green-500 border border-green-500 rounded flex items-center px-4 py-2 shahow-md mt-6"
                type="submit">Update</button>
        </form>
    </main>
</div>
@push('page-style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@push('page-script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/v7tu257eo4k9fppduhlvl0hjsh9rsoe103qgovgm65t899e7/tinymce/6/tinymce.min.js">
    </script>
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


        document.addEventListener('livewire:init', function() {
            // Access the Livewire property using @this
            var selectedOptions = @json($this->class);

            $('#classes').select2({
                placeholder: "Select class",
                data: selectedOptions
            }).on('change', function(e) {
                @this.set('class', $(this).val());
            });

            // Manually set the initial selected options
            $('#classes').val(selectedOptions).trigger('change');

            $('select[id^=classes]').change(function() {
                let val = $(this).val();
                @this.set('class', val);
                if (val == null) return false;
                if (val.indexOf("0") == 0) {
                    $(this).find('option[rel=select-all]').prop('selected', false).change();
                    $(this).find('option:not(:selected,[rel=select-all])').not(this).prop('selected', true)
                        .change();
                }
            });
        });
    </script>
@endpush
