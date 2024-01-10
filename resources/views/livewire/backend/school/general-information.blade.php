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

                        <button type="button"
                            class="inline-block w-auto sm:w-full md:w-full lg:w-full focus:outline-none border-y px-3 py-2 text-black transition-all ease-in-out  dark:text-white  text-sm tracking-wide font-medium border-sky-500/80 border"
                            x-on:click="tab = 'subscription'"
                            :class="{ 'bg-emerald-500': tab === 'subscription' }">Subcription</button>
                    </div>
                    <div class="w-full md:w-3/4 lg:w-3/4 overflow-y-scroll">
                        <div x-show="tab === 'general'" x-transition:enter.duration.500ms
                            x-transition:leave.duration.200ms>
                            <div class=" shadow-md dark:bg-slate-500 dark:bg-opacity-10 rounded px-5 py-3 mx-5 mb-3">
                                <form action="" wire:submit='SaveGeneralSettings'>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                        <div class="mb-2">
                                            @if ($institute_logo)
                                                <img src="{{ $institute_logo->temporaryUrl() }}" width="140px"
                                                    alt="">
                                            @else
                                                <img src="/storage/{{ $preview_logo }}" class="rounded" alt=""
                                                    width="140px">
                                            @endif
                                            <x-input wire:model="institute_logo" label="Institute logo"
                                                accept="image/png,image/jpg,image/webp,image/jpeg" type="file" />
                                        </div>

                                        <div class="mb-2">
                                            <label for="" class="form-label">Institute name</label>
                                            <input type="text" wire:model.blur='institute_name'
                                                class="form-input rounded">
                                        </div>
                                        <div class="mb-2">
                                            <label for="" class="form-label">Web address</label>
                                            <input type="text" wire:model.blur='web_address'
                                                class="form-input rounded">
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
                                            <input type="text" wire:model.blur='mobile_no'
                                                class="form-input rounded">
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

                        <div x-show="tab === 'subscription'" x-transition:enter.duration.500ms
                            x-transition:leave.duration.200ms>
                            <div class=" shadow-md dark:bg-slate-500 dark:bg-opacity-10 rounded px-5 py-3 mx-5 mb-3">
                                <form action="" wire:submit=''>
                                    <div class="grid grid-cols-1 gap-3">
                                        <h3 class="text-xl font-bold pt-4 pb-2 border-b border-gray-300 text-center">
                                            Subscription details
                                        </h3>
                                        @if ($package)
                                            <div>
                                                <ul class="pb-4 pt-3 text-lg">
                                                    <li>
                                                        Current plan: <span
                                                            class="text-md font-extrabold">{{ $package->name }}</span>
                                                    </li>
                                                    <li>
                                                        Will be end at: <span
                                                            class="text-md font-extrabold">{{ \carbon\Carbon::parse($subscription->will_expire)->toDayDateTimeString() }}</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        @else
                                            <div>
                                                <h3 class=" text-emerald-500 font-semibold text-2xl text-center">
                                                    {{ 'There\'s no currently active plan. please upgrade your plan' }}
                                                </h3>
                                            </div>
                                        @endif

                                        <h6
                                            class="text-center text-lg text-red-500 font-bold bg-red-500/20 backdrop-blur-lg pt-2 pb-2">
                                            Cancel
                                            this subscription?</h6>
                                        <div class="">
                                            <button type="button"
                                                wire:confirm="Are you sure? This action is irreverseable!"
                                                wire:click='cancelSubscription'
                                                class=" bg-red-500/50 backdrop-blur-lg rounded shadow-sm text-white px-3 py-2 transition-all duration-200 ease-in-out hover:bg-red-500">Yes,
                                                Cancel now!</button>
                                            <button
                                                class=" bg-emerald-500/50 backdrop-blur-lg rounded shadow-sm text-white px-3 py-2 transition-all duration-200 ease-in-out hover:bg-emerald-500">
                                                <a href="{{ route('pricings') }}">Update subscription</a>
                                            </button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>
</div>
@push('page-script')
@endpush
