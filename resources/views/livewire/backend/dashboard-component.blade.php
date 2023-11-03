<div>
    <main class="p-6">
        <div class="flex flex-col gap-6">
            <h2 class="text-3xl uppercase">Welcome <mark
                    class="px-2 text-xl font-extrabold capitalize">{{ auth()->user()->role->name }}</mark>
            </h2>
            {{-- <div class="grid xl:grid-cols-4 sm:grid-cols-2 grid-cols-1 gap-6"> --}}
            {{-- <div class="card">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-11">
                            <h4 class="card-title">Total Revenue</h4>

                            <div class="z-10">
                                <button data-fc-target="dropdown-target1" data-fc-type="dropdown" type="button"
                                    data-fc-placement="bottom-end">
                                    <i class="text-xl"></i>
                                </button>

                                <div id="dropdown-target1"
                                    class="hidden bg-white shadow rounded border dark:border-slate-700 fc-dropdown-open:translate-y-0 translate-y-3 origin-center transition-all duration-300 py-2 dark:bg-gray-800">
                                    <a class="flex items-center py-1.5 px-5 text-sm transition-all duration-300 bg-transparent text-gray-800 dark:text-white hover:bg-stone-100 dark:hover:bg-slate-700 dark:hover:text-gray-200"
                                        href="javascript:void(0)">
                                        Action
                                    </a>
                                    <a class="flex items-center py-1.5 px-5 text-sm transition-all duration-300 bg-transparent text-gray-800 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                        href="javascript:void(0)">
                                        Another action
                                    </a>
                                    <a class="flex items-center py-1.5 px-5 text-sm transition-all duration-300 bg-transparent text-gray-800 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                        href="javascript:void(0)">
                                        Something else
                                    </a>
                                    <a class="flex items-center py-1.5 px-5 text-sm transition-all duration-300 bg-transparent text-gray-800 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                        href="javascript:void(0)">
                                        Separated link
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <div dir="ltr">
                                <input data-plugin="knob" data-width="70" data-height="70" data-fgColor="#f05050 "
                                    data-bgColor="#F9B9B9" value="58" data-skin="tron" data-angleOffset="180"
                                    data-readOnly="true" data-thickness=".15" />
                            </div>

                            <div class="text-end">
                                <h2 class="text-3xl font-normal text-gray-800 dark:text-white mb-1">
                                    256
                                </h2>
                                <p class="text-gray-400 font-normal">Revenue today</p>
                            </div>
                        </div>
                    </div>
                </div> --}}
            <!-- card-end -->
            {{-- </div> --}}
            <!-- grid-end -->
        </div>
        <!-- flex-end -->
    </main>
</div>
