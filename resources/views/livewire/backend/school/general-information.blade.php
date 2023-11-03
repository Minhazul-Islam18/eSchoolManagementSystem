<div>
    <main>
        <div class="container px-4 py-6">
            <div x-data="{ tab: 'general' }" x-cloak class="m-4 sm:m-6 md:m-10 antialiased">
                <div class="flex flex-col items-start justify-start md:flex-row md:items-start md:justify-start gap-2">
                    <div
                        class="w-full flex gap-1 bg-slate-500 bg-opacity-10 rounded px-2 py-2 shadow-lg flex-row flex-wrap justify-start items-start md:w-1/4 lg:1/4 md:flex-col lg:flex-col xl:flex-col">
                        <button type="button"
                            class="inline-block w-auto sm:w-full md:w-full lg:w-full focus:outline-none border-y px-3 py-2 text-black transition-all ease-in-out  dark:text-white  text-sm tracking-wide font-medium border-sky-500/80 border"
                            x-on:click="tab = 'general'"
                            :class="{ 'bg-emerald-500': tab === 'general' }">General</button>
                    </div>
                    <div class="w-full md:w-3/4 lg:w-3/4 overflow-y-scroll">
                        <div x-show="tab === 'general'" x-transition:enter.duration.500ms
                            x-transition:leave.duration.200ms
                            class=" shadow-md dark:bg-slate-500 dark:bg-opacity-10 rounded px-5 py-3 mx-5 mb-3">
                            <form action="" wire:submit='SaveGeneralSettings'>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    <div class="mb-2">
                                        <label for="" class="form-label">Institute name</label>
                                        <input type="text" wire:model.blur='institute_name'
                                            class="form-input rounded">
                                    </div>
                                    <div class="mb-2">
                                        <label for="" class="form-label">Web address</label>
                                        <input type="text" wire:model.blur='web_address' class="form-input rounded">
                                    </div>
                                    <div class="mb-2">
                                        <label for="" class="form-label">Instutite address</label>
                                        <textarea wire:model.blur='institute_address' class="form-textarea rounded" name="" id="" cols="30"
                                            rows="5"></textarea>
                                    </div>
                                    <div class="mb-2">
                                        <label for="" class="form-label">Thana/Upazilla</label>
                                        <input type="text" wire:model.blur='thana_or_upazilla'
                                            class="form-input rounded">
                                    </div>
                                    <div class="mb-2">
                                        <label for="" class="form-label">District</label>
                                        <input type="text" wire:model.blur='district' class="form-input rounded">
                                    </div>
                                    <div class="mb-2">
                                        <label for="" class="form-label">Head teacher number</label>
                                        <input type="text" wire:model.blur='headteacher_number'
                                            class="form-input rounded">
                                    </div>
                                    <div class="mb-2">
                                        <label for="" class="form-label">EIIN no.</label>
                                        <input type="text" wire:model.blur='eiin_no' class="form-input rounded">
                                    </div>
                                    <div class="mb-2">
                                        <label for="" class="form-label">Mobile no.</label>
                                        <input type="text" wire:model.blur='mobile_no' class="form-input rounded">
                                    </div>
                                    <div class="mb-2">
                                        <label for="" class="form-label">Alternative mobile no.</label>
                                        <input type="text" wire:model.blur='alt_mobile_no'
                                            class="form-input rounded">
                                    </div>
                                </div>
                                <button type="submit"
                                    class=" bg-emerald-500 rounded shadow-sm text-white px-3 py-2 transition-all duration-200 ease-in-out hover:bg-emerald-400">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@push('page-script')
@endpush
