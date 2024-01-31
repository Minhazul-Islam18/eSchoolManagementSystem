        <div>
            <main class="container py-6">
                <div class="flex items-center justify-between space-x-4">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        {{ $this->editable_card ? 'Edit' : 'Create' }} ID Card Template
                    </h3>
                    <div class="w-1/2 flex justify-end items-center gap-3">
                        <a href="{{ route('school.student-id-cards') }}"
                            class="bg-green-500 bg-opacity-25 border border-green-500 rounded flex items-center px-4 py-2 shahow-md hover:bg-opacity-100 transition fade gap-2">
                            <i data-lucide="plus-circle" class="w-4"></i>
                            All templates
                        </a>
                    </div>
                </div>
                <div class="py-2">
                    <div class="py-0">
                        <x-errors title="We found {errors} validation error(s)" />
                        <form class="h-full flex flex-col justify-between" action=""
                            wire:submit='{{ $this->editable_card ? 'update' : 'create' }}'>
                            <div class=" space-y-6 h-full">
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div class="">
                                        <x-input label="Template name" wire:model.blur='id_card_title' type="text"
                                            value="{{ $this->editable_card?->title }}" />
                                    </div>

                                    <div class="">
                                        <x-datetime-picker label="Enter Expire" placeholder="Expire at"
                                            value="{{ $this->editable_card?->expire_date }}" without-time="true"
                                            wire:model.defer="id_card_expire_date" />
                                    </div>
                                    <div class="">
                                        <label for="" class="form-label">Frontside background image</label>
                                        <input wire:model.blur='id_card_frontside_background_image' type="file"
                                            class="form-input rounded">
                                        <span
                                            class=" font-black text-emerald-500 mt-1">{{ __('Image width must be 250px') }}</span>
                                    </div>
                                    <div class="">
                                        <label for="" class="form-label">Backside background image</label>
                                        <input wire:model.blur='id_card_backside_background_image' type="file"
                                            class="form-input rounded">
                                        <span
                                            class=" font-black text-emerald-500 mt-1">{{ __('Image width must be 250px') }}</span>
                                    </div>

                                    <div class="">
                                        <label for="" class="form-label">Head teacher signature</label>
                                        <input wire:model.blur='id_card_signature' type="file"
                                            class="form-input rounded">
                                        <span
                                            class=" font-black text-emerald-500 mt-1">{{ __('Image width must be 70px') }}</span>
                                    </div>

                                    <div class="">
                                        <label for="" class="form-label">QR code</label>
                                        <input wire:model.blur='id_card_qr_code' type="file"
                                            class="form-input rounded">
                                        <span
                                            class=" font-black text-emerald-500 mt-1">{{ __('Image dimention must be 60x60') }}</span>
                                    </div>
                                </div>
                                <div class="" wire:ignore>
                                    <label for="" class="form-label">Background description</label>
                                    <input id="{{ $trixId }}" type="hidden" name="content"
                                        value="{{ $this->editable_card?->backside_description }}">
                                    <trix-editor input="{{ $trixId }}"></trix-editor>
                                </div>
                            </div>
                            <div
                                class="flex items-center pt-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                <button type="submit"
                                    class="text-white bg-green-500 hover:bg-green-400 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-success-600 dark:hover:bg-green-400 dark:focus:ring-green-200/50">
                                    {{ $this->editable_card ? 'Update' : 'Save' }}</button>
                                @if ($this->editable_card)
                                    <button type="button" wire:click='resetFields'
                                        class="text-white bg-red-500 hover:bg-red-400 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-success-600 dark:hover:bg-red-400 dark:focus:ring-red-200/50">
                                        {{ 'Cancel' }}</button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>

        @push('page-style')
            <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
            <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
        @endpush

        @push('page-script')
            <script>
                var trixEditor = document.getElementById("{{ $trixId }}")

                addEventListener("trix-blur", function(event) {
                    @this.set('id_card_backside_description', trixEditor.getAttribute('value'))
                })
            </script>
        @endpush
