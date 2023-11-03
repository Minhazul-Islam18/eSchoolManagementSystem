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
                            x-on:click="tab = 'appearance'"
                            :class="{ 'bg-emerald-500': tab === 'appearance' }">Appearance</button>
                        <button type="button"
                            class="inline-block w-auto sm:w-full md:w-full lg:w-full focus:outline-none border-y px-3 py-2 text-black transition-all ease-in-out  dark:text-white  text-sm tracking-wide font-medium border-sky-500/80 border"
                            x-on:click="tab = 'mail'" :class="{ 'bg-emerald-500': tab === 'mail' }">Mail</button>
                        <button type="button"
                            class="inline-block w-auto sm:w-full md:w-full lg:w-full focus:outline-none border-y px-3 py-2 text-black transition-all ease-in-out  dark:text-white  text-sm tracking-wide font-medium border-sky-500/80 border"
                            x-on:click="tab = 'social'" :class="{ 'bg-emerald-500': tab === 'social' }">Social
                            Login</button>
                    </div>
                    <div class="w-full md:w-3/4 lg:w-3/4 overflow-y-scroll">
                        <div class="mb-3 shadow-md bg-slate-500 bg-opacity-10 rounded px-3 py-2">
                            <h4 class="text-xl uppercase">Usage</h4>
                            <p class="inline-block">You can use this by calling
                            </p>
                            <code
                                class="inline-block bg-slate-300/20 px-2 py-1 border border-pink-500 border-opacity-70 rounded">settings('key')</code>
                        </div>
                        <div x-show="tab === 'general'" x-transition:enter.duration.500ms
                            x-transition:leave.duration.200ms>
                            <div class="shadow-md dark:bg-slate-500 dark:bg-opacity-10 rounded px-3 py-2">
                                <form action="" wire:submit='SaveGeneralSettings'>
                                    <div class="mb-2">
                                        <label for="" class="form-label">Site title</label>
                                        <input type="text" wire:model.blur='site_title' class="form-input rounded">
                                    </div>
                                    <div class="mb-2">
                                        <label for="" class="form-label">Site description</label>
                                        <textarea wire:model.blur='site_description' class="form-textarea rounded" name="" id="" cols="30"
                                            rows="5"></textarea>
                                    </div>
                                    <div class="mb-2">
                                        <label for="" class="form-label">Address</label>
                                        <textarea wire:model.blur='address' class="form-textarea rounded" name="" id="" cols="30"
                                            rows="5"></textarea>
                                    </div>
                                    <button type="submit"
                                        class=" bg-emerald-500 rounded shadow-sm text-white px-3 py-2 transition-all duration-200 ease-in-out hover:bg-emerald-400">Save</button>
                                </form>
                            </div>
                        </div>
                        <div x-show="tab === 'mail'" x-transition:enter.duration.500ms
                            x-transition:leave.duration.200ms>
                            <div class="shadow-md dark:bg-slate-500 dark:bg-opacity-10 rounded px-3 py-2">
                                <form action="" wire:submit='SaveMailSettings'>
                                    <div class="mb-2">
                                        <label for="" class="form-label">Mail mailer</label>
                                        <input type="text" wire:model.blur='mail_mailer' class="form-input rounded">
                                    </div>
                                    <div class="mb-2">
                                        <label for="" class="form-label">Mail host</label>
                                        <input type="text" wire:model.blur='mail_host' class="form-input rounded">
                                    </div>
                                    <div class="mb-2">
                                        <label for="" class="form-label">Mail port</label>
                                        <input type="text" wire:model.blur='mail_port' class="form-input rounded">
                                    </div>
                                    <div class="mb-2">
                                        <label for="" class="form-label">Mail username</label>
                                        <input type="text" wire:model.blur='mail_username'
                                            class="form-input rounded">
                                    </div>
                                    <div class="mb-2">
                                        <label for="" class="form-label">Mail password</label>
                                        <input type="password" wire:model.blur='mail_password'
                                            class="form-input rounded">
                                    </div>
                                    <div class="mb-2">
                                        <label for="" class="form-label">Mail encryption</label>
                                        <input type="text" wire:model.blur='mail_encryption'
                                            class="form-input rounded">
                                    </div>
                                    <div class="mb-2">
                                        <label for="" class="form-label">Mail from address</label>
                                        <input type="email" wire:model.blur='mail_from_address'
                                            class="form-input rounded">
                                    </div>
                                    <div class="mb-2">
                                        <label for="" class="form-label">Mail from name</label>
                                        <input type="text" wire:model.blur='mail_from_name'
                                            class="form-input rounded">
                                    </div>
                                    <button type="submit"
                                        class=" bg-emerald-500 rounded shadow-sm text-white px-3 py-2 transition-all duration-200 ease-in-out hover:bg-emerald-400">Save</button>
                                </form>
                            </div>
                        </div>

                        <div x-show="tab === 'appearance'" x-transition:enter.duration.500ms
                            x-transition:leave.duration.200ms>
                            <div class="shadow-md dark:bg-slate-500 dark:bg-opacity-10 rounded px-3 py-2">
                                <form action="" wire:submit='SaveAppearanceSettings'>
                                    <div class="flex flex-col sm:flex-row flex-wrap mb-3 gap-y-3 sm:gap-y-0">
                                        <div class="flex gap-2 flex-row w-full sm:w-1/2">
                                            <div class=" {{ isset($this->logo) || setting('logo') ? 'w-1/3' : 'w-0' }} bg-contain bg-no-repeat bg-center"
                                                style="background-image: url({{ isset($this->logo) ? $this->logo->temporaryUrl() : '/storage/' . setting('logo') }})">

                                            </div>
                                            <div class="{{ isset($this->logo) ? 'w-2/3' : 'w-full' }}">
                                                <label for="" class="form-label">Logo</label>
                                                <input type="file" wire:model.blur='logo'
                                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                                                @error('logo')
                                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="flex gap-2 flex-row w-full sm:w-1/2">
                                            <div class=" {{ isset($this->favicon) || setting('favicon') ? 'w-1/3' : 'w-0' }} bg-contain bg-no-repeat bg-center"
                                                style="background-image: url({{ isset($this->favicon) ? $this->favicon->temporaryUrl() : '/storage/' . setting('favicon') }})">

                                            </div>
                                            <div class="{{ isset($this->favicon) ? 'w-2/3' : 'w-full' }}">
                                                <label for="" class="form-label">Favicon</label>
                                                <input type="file" wire:model.blur='favicon'
                                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                                                @error('favicon')
                                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex flex-row flex-wrap mb-3">
                                        <div class="w-1/2">
                                            <label for="" class="form-label">Primary color</label>
                                            <input type="color" wire:model.blur='primary_color' class=""
                                                name="" id="">
                                        </div>
                                        <div class="w-1/2">
                                            <label for="" wire:model.blur='secondary_color'
                                                class="form-label">Secondary color</label>
                                            <input type="color" wire:model.blur='secondary_color' class=""
                                                name="" id="">
                                        </div>
                                    </div>
                                    <button type="submit"
                                        class=" bg-emerald-500 rounded shadow-sm text-white px-3 py-2 transition-all duration-200 ease-in-out hover:bg-emerald-400">Save</button>
                                </form>
                            </div>
                        </div>
                        <div x-show="tab === 'social'" x-transition:enter.duration.500ms
                            x-transition:leave.duration.200ms>
                            <div class="shadow-md dark:bg-slate-500 dark:bg-opacity-10 rounded px-3 py-2">
                                <form action="" wire:submit='SaveSocialiteSettings'>
                                    <h4 class="text-xl bold w-full py-2 border-b border-emerald-500 mb-2 uppercase">
                                        Google
                                        Credentials</h4>
                                    <div class="flex flex-col sm:flex-row flex-wrap mb-3 gap-y-3 sm:gap-y-0">
                                        <div class="flex gap-2 flex-col w-full sm:w-5/12 order-1">
                                            <label for="" class="form-label">Google Client ID</label>
                                            <input type="text" wire:model.blur='google_client_id'
                                                class="form-input rounded">
                                            @error('google_client_id')
                                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="w-2/12 order-3 sm:order-2"></div>
                                        <div class="flex gap-2 flex-col w-full sm:w-5/12 order-2 sm:order-3">
                                            <label for="" class="form-label">Google Client Secret</label>
                                            <input type="text" wire:model.blur='google_client_secret'
                                                class="form-input rounded">
                                            @error('google_client_secret')
                                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                            @enderror
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
        </div>
    </main>
</div>
@push('page-script')
@endpush
