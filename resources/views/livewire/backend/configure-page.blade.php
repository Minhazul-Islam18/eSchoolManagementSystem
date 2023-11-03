<div>
    <main>
        <div class="container px-8 py-5">
            <span class="text-center block text-xl pb-2 border-b mb-2">
                @if ($this->editable_page)
                    {{ __('Edit Page') }}
                @else
                    {{ __('Create Page') }}
                @endif
            </span>
            <form wire:submit="{{ $this->editable_page ? 'update' : 'store' }}">
                <div class="flex flex-row row-wrap gap-x-2">
                    <div class="w-full sm:w-2/3 md:w-2/3">
                        <div
                            class="flex flex-row flex-wrap p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                            <div class="w-full">
                                <label for="title"
                                    class="form-label after:content-['*'] after:ml-0.5 after:text-red-500 ">
                                    {{ __('Title') }}
                                </label>
                                <input type="text" wire:model.blur="page.title" id="title"
                                    class="form-input rounded">
                                @error('page.title')
                                    <span class="text-red-500 block font-medium mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="w-full">
                                <label for="" class="form-label">Short Description</label>
                                <textarea name="" id="" wire:model.blur='page.excerpt' cols="30" rows="5"
                                    class="form-textarea"></textarea>
                            </div>
                            <div class="w-full" wire:ignore>
                                <label for=""
                                    class="form-label after:content-['*'] after:ml-0.5 after:text-red-500 ">Content</label>
                                <textarea class="form-textarea" name="" wire:model.blur='page.content' id="body" cols="30"
                                    rows="10">{!! $this->page['content'] !!}</textarea>
                            </div>

                        </div>
                    </div>
                    <div class="w-full sm:w-1/3 md:w-1/3">
                        <div
                            class="flex flex-col row-wrap p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                            <div class="w-full">
                                <label for="" class="form-label flex">Published <div class="text-red-500">*
                                    </div>
                                </label>
                                <input type="checkbox" wire:model.blur='page.status' name=""
                                    class="form-checkbox rounded" />
                            </div>
                            <div class="w-full">
                                <label for="" class="form-label">Meta description</label>
                                <textarea wire:model.blur='page.meta_description' name="" class="form-textarea" id="" cols="30"
                                    rows="3"></textarea>
                            </div>
                            <div class="w-full">
                                <label for="" class="form-label">Meta Keywords</label>
                                <textarea wire:model.blur='page.meta_keywords' name="" class="form-textarea" id="" cols="30"
                                    rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-1/2">
                    <div class="block text-left mt-3">
                        <button type="submit"
                            class="bg-green-500 text-black-500 py-2 px-5 rounded">{{ $this->editable_page ? 'Update' : 'Create' }}</button>
                        @if ($this->editable_page)
                            <button type="button" wire:click='ResetFields' @click="OpenEditModal = false"
                                class="bg-red-500 text-black-500 py-2 ml-2 px-5 rounded">{{ 'Cancel' }}</button>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </main>
</div>
@push('page-script')
    <script src="https://cdn.ckeditor.com/ckeditor5/12.0.0/classic/ckeditor.js"></script>
    <script>
        //HTML Editor
        ClassicEditor
            .create(document.querySelector('#body'), {
                ckfinder: {
                    uploadUrl: '{{ route('app.page-image') . '?_token=' . csrf_token() }}',
                    options: {
                        resourceType: 'Images'
                    },
                    openerMethod: 'popup'
                }
            })

            .then(editor => {
                editor.model.document.on('change:data', () => {
                    @this.set('page.content', editor.getData());
                })
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
