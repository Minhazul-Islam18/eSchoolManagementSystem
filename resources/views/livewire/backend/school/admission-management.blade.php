<div x-data="{ openCEmodal: @entangle('openCEmodal'), openViewModal: false }">
    <main x-data="app()" x-cloak>
        {{-- modal --}}
        <div x-show="openCEmodal" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog"
            aria-modal="true">
            <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
                <div x-cloak @click="openCEmodal = false" x-show="openCEmodal"
                    x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200 transform"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                    class="fixed inset-0 transition-opacity bg-slate-950 bg-opacity-40" aria-hidden="true">
                </div>

                <div x-cloak x-show="openCEmodal" x-transition:enter="transition ease-out duration-300 transform"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="transition ease-in duration-200 transform"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="h-[100vh] overflow-y-scroll inline-block w-full max-w-[80vw] p-8 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between space-x-4">
                        <div class="border-b-2 py-4 w-full">
                            <div class="uppercase tracking-wide text-xs font-bold text-gray-500 mb-1 leading-tight"
                                x-text="`Step: ${step} of 3`"></div>
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                                <div class="flex-1">
                                    <div x-show="step === 1">
                                        <div class="text-lg font-bold text-gray-700 leading-tight">ছাত্র-ছাত্রীর তথ্য
                                        </div>
                                    </div>

                                    <div x-show="step === 2">
                                        <div class="text-lg font-bold text-gray-700 leading-tight">অভিভাবকের তথ্য
                                        </div>
                                    </div>

                                    <div x-show="step === 3">
                                        <div class="text-lg font-bold text-gray-700 leading-tight">তথ্য যাচাই</div>
                                    </div>
                                </div>

                                <div class="flex items-center md:w-64">
                                    <div class="w-full bg-white rounded-full mr-2">
                                        <div class="rounded-full bg-green-500 text-xs leading-none h-2 text-center text-white"
                                            :style="'width: ' + parseInt(step / 3 * 100) + '%'"></div>
                                    </div>
                                    <div class="text-xs w-10 text-gray-600" x-text="parseInt(step / 3 * 100) +'%'">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button @click="openCEmodal = false"
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
                        <div x-show.transition="step === 'complete'">
                            <div class="bg-white rounded-lg p-10 flex items-center shadow justify-center">
                                <div>
                                    <svg class="mb-4 h-20 w-20 text-green-500 mx-auto" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>

                                    <h2 class="text-2xl mb-4 text-gray-800 text-center font-bold">Registration
                                        Success</h2>

                                    <button @click="openCEmodal = false"
                                        class="w-40 block mx-auto focus:outline-none py-2 px-5 rounded-lg shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100 font-medium border">Close</button>
                                </div>
                            </div>
                        </div>

                        <div x-show.transition="step != 'complete'" x-data="{ freedomFighter: 0, isSiblingStudying: false }">
                            <!-- Step Content -->
                            <div class="py-0">
                                <div x-show.transition.in="step === 1">
                                    <div class="mb-5 text-center w-48 mx-auto" x-data="{ imageDimensionsValid: @entangle('checkImageDimension') }">
                                        <div
                                            class="mx-auto w-32 h-32 mb-2 border rounded-full relative bg-gray-100 shadow-inset">
                                            <img id="image" class="object-cover w-full h-32 rounded-full"
                                                :src="image" />
                                        </div>

                                        <label for="fileInput" type="button"
                                            class="cursor-pointer inine-flex justify-between items-center focus:outline-none border py-2 px-4 rounded-lg shadow-sm text-left text-gray-600 bg-white hover:bg-gray-100 font-medium">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="inline-flex flex-shrink-0 w-6 h-6 -mt-1 mr-1" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                                                <path
                                                    d="M5 7h1a2 2 0 0 0 2 -2a1 1 0 0 1 1 -1h6a1 1 0 0 1 1 1a2 2 0 0 0 2 2h1a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2" />
                                                <circle cx="12" cy="13" r="3" />
                                            </svg>
                                            Browse Photo
                                        </label>

                                        <div class="mx-auto w-48 text-gray-500 text-xs text-center mt-1">Click
                                            to add Picture</div>
                                        <p x-show="!imageDimensionsValid" class="text-red-500">Image
                                            dimensions
                                            must be 300x300 pixels.</p>
                                        <input name="photo" id="fileInput" accept="image/*" class="hidden"
                                            wire:model.blur='student_image' type="file"
                                            x-on:change="checkImageDimensions"
                                            @change="let file = document.getElementById('fileInput').files[0];
                                                var reader = new FileReader();
                                                reader.onload = (e) => image = e.target.result;
                                                reader.readAsDataURL(file);
                                                ">
                                        @error('student_image')
                                            <span class="text-sm text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div class="">
                                            <label for="" class="form-label">নাম (বাংলা)</label>
                                            <input type="text" name="" id="" wire:model='name_bn'
                                                placeholder="নাম (বাংলা) " class="form-input rounded">
                                            @error('name_bn')
                                                <span class="text-sm text-red-500">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="">
                                            <label for="" class="form-label">নাম (English)</label>
                                            <input type="text" name="" id="" wire:model='name_en'
                                                placeholder="নাম (English)" class="form-input rounded">
                                            @error('name_en')
                                                <span class="text-sm text-red-500">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="">
                                            <label for="" class="form-label">যে শ্রেণিতে ভর্তি হতে
                                                ইচ্ছুক</label>
                                            <select wire:model.blur='school_class_id' wire:click.change='getSection'
                                                class="form-select rounded" id="">
                                                <option value="">শ্রেণি নির্বাচন করুন</option>
                                                @foreach ($classes as $item)
                                                    <option value="{{ $item->id }}">{{ $item->class_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('school_class_id')
                                                <span class="text-sm text-red-500">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="">
                                            <label for="" class="form-label">Section</label>
                                            <select wire:model.blur='section_id' class="form-select rounded"
                                                id="">
                                                <option value="">নির্বাচন করুন</option>
                                                @forelse ($sections as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $item->id == $this->section_id ? 'selected' : '' }}>
                                                        {{ $item->section_name }}</option>
                                                @empty
                                                    <option value="" disabled>No section found</option>
                                                @endforelse
                                            </select>
                                            @error('section_id')
                                                <span class="text-sm text-red-500">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="">
                                            <label for="" class="form-label">লিঙ্গ</label>
                                            <select wire:model.blur='gender' class="form-select rounded"
                                                id="">
                                                <option value="">নির্বাচন করুন</option>
                                                <option value="Male">ছেলে</option>
                                                <option value="Female">মেয়ে</option>
                                            </select>
                                            @error('gender')
                                                <span class="text-sm text-red-500">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="">
                                            <label for="" class="form-label">ধর্ম</label>
                                            <select wire:model.blur='religion' class="form-select rounded"
                                                id="">
                                                <option value="">নির্বাচন করুন</option>
                                                <option value="Islam">ইসলাম</option>
                                                <option value="Hindu">হিন্দু</option>
                                                <option value="Others">অন্যান্য</option>
                                            </select>
                                            @error('religion')
                                                <span class="text-sm text-red-500">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="">
                                            <label for="" class="form-label">জন্ম নিবন্ধন নং</label>
                                            <input type="text" wire:model.blur="birth_certificate_no"
                                                id="" placeholder="জন্ম নিবন্ধন নং"
                                                class="form-input rounded">
                                            @error('birth_certificate_no')
                                                <span class="text-sm text-red-500">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="">
                                            <label for="" class="form-label">জন্ম তারিখ</label>
                                            <input type="date" wire:model.blur="dob" id=""
                                                class="form-input rounded">
                                            @error('dob')
                                                <span class="text-sm text-red-500">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="">
                                            <label for="" class="form-label">শিক্ষার্থীর ধরন</label>
                                            <select wire:model.blur='student_category_id' class="form-select rounded"
                                                id="">
                                                <option value="">নির্বাচন করুন</option>
                                                @forelse ($sc as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $item->id == $this->student_category_id ? 'selected' : '' }}>
                                                        {{ $item->name }}</option>
                                                @empty
                                                    <option value="" disabled>Nothing found</option>
                                                @endforelse
                                            </select>
                                            @error('student_category_id')
                                                <span class="text-sm text-red-500">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="">
                                            <label for="" class="form-label">কোটা</label>
                                            <select wire:model.blur='student_quota_id' x-model="freedomFighter"
                                                class="form-select rounded" id="">
                                                <option value="">নির্বাচন করুন</option>
                                                @forelse ($sq as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $item->id == $this->student_quota_id ? 'selected' : '' }}>
                                                        {{ $item->name }}</option>
                                                @empty
                                                    <option value="" disabled>Nothing found</option>
                                                @endforelse
                                            </select>
                                            @error('student_quota_id')
                                                <span class="text-sm text-red-500">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="" x-show="freedomFighter == 1">
                                            <label for="" class="form-label">মুক্তিযোদ্ধার সনদ নং</label>
                                            <input type="text" wire:model.blur="freedom_fighter_id" id=""
                                                placeholder="মুক্তিযোদ্ধার সনদ নং" class="form-input rounded">
                                            @error('freedom_fighter_id')
                                                <span class="text-sm text-red-500">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="">
                                            <label for="" class="form-label">পূর্বে অধ্যয়নরত স্কুলের
                                                নাম </label>
                                            <input type="text" wire:model.blur="previous_institute" id=""
                                                placeholder="পূর্বে অধ্যয়নরত স্কুলের নাম "
                                                class="form-input rounded">
                                            @error('previous_institute')
                                                <span class="text-sm text-red-500">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="">
                                            <label for="" class="form-label">পূর্বে অধ্যয়নরত
                                                শ্রেণি</label>
                                            <select wire:model.blur='previous_study_class' class="form-select rounded"
                                                id="">
                                                <option value="">নির্বাচন করুন</option>
                                                @foreach ($classes as $item)
                                                    <option value="{{ $item->class_name }}">
                                                        {{ $item->class_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('previous_study_class')
                                                <span class="text-sm text-red-500">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="">
                                            <label for="" class="form-label">কোন ভাই/বোন অত্র
                                                প্রতিষ্ঠানে
                                                অধ্যয়নরত কি
                                                না </label>
                                            <select wire:model.blur='have_siblings_studying'
                                                x-model="isSiblingStudying" class="form-select rounded"
                                                id="">
                                                <option value="">নির্বাচন করুন</option>
                                                <option value="{{ false }}">না</option>
                                                <option value="{{ true }}">হ্যাঁ</option>
                                            </select>
                                            @error('have_siblings_studying')
                                                <span class="text-sm text-red-500">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div x-show="isSiblingStudying">
                                            <label for="" class="form-label">অধ্যয়নরত ভাই/বোনের নাম</label>
                                            <input type="text" wire:model.blur="name_of_studying_siblings"
                                                id="" placeholder="অধ্যয়নরত ভাই/বোনের নাম"
                                                class="form-input rounded">
                                            @error('name_of_studying_siblings')
                                                <span class="text-sm text-red-500">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div x-show="isSiblingStudying">
                                            <label for="" class="form-label">অধ্যয়নরত ভাই/বোনের
                                                শ্রেণি</label>
                                            <select wire:model.blur='class_id_of_studying_siblings'
                                                class="form-select rounded" id="">
                                                <option value="">শ্রেণি নির্বাচন করুন</option>
                                                @foreach ($classes as $item)
                                                    <option value="{{ $item->id }}">{{ $item->class_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('class_id_of_studying_siblings')
                                                <span class="text-sm text-red-500">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div x-show="isSiblingStudying">
                                            <label for="" class="form-label">অধ্যয়নরত ভাই/বোনের রোল</label>
                                            <input type="text" wire:model.blur="roll_of_studying_siblings"
                                                id="" placeholder="অধ্যয়নরত ভাই/বোনের রোল"
                                                class="form-input rounded">
                                            @error('roll_of_studying_siblings')
                                                <span class="text-sm text-red-500">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="">
                                            <label for="" class="form-label">বিভাগ</label>
                                            <select wire:model.blur='division_id' class="form-select rounded"
                                                wire:change='checkDivision' id="">
                                                <option value="">নির্বাচন করুন</option>
                                                @foreach ($divisions as $item)
                                                    <option value="{{ $item->id }}">{{ $item->bn_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('division_id')
                                                <span class="text-sm text-red-500">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="">
                                            <label for="" class="form-label">জেলা</label>
                                            <select wire:model.blur='district_id' class="form-select rounded"
                                                wire:change='checkUpazilla' id="">
                                                <option value="">নির্বাচন করুন</option>
                                                @foreach ($districts as $item)
                                                    <option value="{{ $item->id }}">{{ $item->bn_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('district_id')
                                                <span class="text-sm text-red-500">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="">
                                            <label for="" class="form-label">উপজেলা/থানা</label>
                                            <select wire:model.blur='upazila_id' class="form-select rounded"
                                                wire:change='checkUnion' id="">
                                                <option value="">নির্বাচন করুন</option>
                                                @foreach ($upazilas as $item)
                                                    <option value="{{ $item->id }}">{{ $item->bn_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('upazila_id')
                                                <span class="text-sm text-red-500">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="">
                                            <label for="" class="form-label">ইউনিয়ন</label>
                                            <select wire:model.blur='union_id' class="form-select rounded"
                                                id="">
                                                <option value="">নির্বাচন করুন</option>
                                                @foreach ($unions as $item)
                                                    <option value="{{ $item->id }}">{{ $item->bn_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('union_id')
                                                <span class="text-sm text-red-500">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="" class="form-label">পোষ্ট অফিস</label>
                                            <input type="text" class="form-input rounded"
                                                wire:model.blur='postoffice' placeholder="পোষ্ট অফিস" name=""
                                                id="">
                                            @error('postoffice')
                                                <span class="text-sm text-red-500">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="" class="form-label">পোষ্ট কোড</label>
                                            <input type="text" class="form-input rounded"
                                                wire:model.blur='post_code' placeholder="পোষ্ট কোড" name=""
                                                id="">
                                            @error('post_code')
                                                <span class="text-sm text-red-500">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="" class="form-label">গ্রাম</label>
                                            <input type="text" class="form-input rounded"
                                                wire:model.blur='village' placeholder="গ্রাম" name=""
                                                id="">
                                            @error('village')
                                                <span class="text-sm text-red-500">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="" class="form-label">মোবাইল নাম্বার</label>
                                            <input type="text" class="form-input rounded"
                                                wire:model.blur='mobile_number' placeholder="মোবাইল নাম্বার"
                                                name="" id="">
                                            @error('mobile_number')
                                                <span class="text-sm text-red-500">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        {{-- modal contents end --}}
                                    </div>
                                </div>
                                <div x-show.transition.in="step === 2">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 sm:gap-4">
                                        <div class="">
                                            <label for="" class="form-label">পিতার নাম (বাংলা) </label>
                                            <input type="text" name="" id=""
                                                wire:model.blur='fathers_name_bn' placeholder="পিতার নাম (বাংলা)"
                                                class="form-input rounded">
                                            @error('fathers_name_bn')
                                                <span class="text-red-500 font-bold text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="">
                                            <label for="" class="form-label">পিতার নাম (English)</label>
                                            <input type="text" name="" id=""
                                                wire:model.blur='fathers_name_en' placeholder="পিতার নাম (English)"
                                                class="form-input rounded">
                                            @error('fathers_name_en')
                                                <span class="text-red-500 font-bold text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="">
                                            <label for="" class="form-label">পিতার জাতীয় পরিচয় পত্র নং</label>
                                            <input type="text" name="" id=""
                                                wire:model.blur='fathers_nid_no'
                                                placeholder="পিতার জাতীয় পরিচয় পত্র নং" class="form-input rounded">
                                            @error('fathers_nid_no')
                                                <span class="text-red-500 font-bold text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="">
                                            <label for="" class="form-label">মাতার নাম (বাংলা) </label>
                                            <input type="text" name="" id=""
                                                wire:model.blur='mothers_name_bn' placeholder="মাতার নাম (বাংলা)"
                                                class="form-input rounded">
                                            @error('mothers_name_bn')
                                                <span class="text-red-500 font-bold text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="">
                                            <label for="" class="form-label">মাতার নাম (English)</label>
                                            <input type="text" name="" id=""
                                                wire:model.blur='mothers_name_en' placeholder="মাতার নাম (English)"
                                                class="form-input rounded">
                                            @error('mothers_name_en')
                                                <span class="text-red-500 font-bold text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="">
                                            <label for="" class="form-label">মাতার জাতীয় পরিচয় পত্র নং</label>
                                            <input type="text" name="" id=""
                                                wire:model.blur='mothers_nid_no'
                                                placeholder="মাতার জাতীয় পরিচয় পত্র নং" class="form-input rounded">
                                            @error('mothers_nid_no')
                                                <span class="text-red-500 font-bold text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="">
                                            <label for="" class="form-label">পিতার জন্ম নিবন্ধন নং</label>
                                            <input type="text" name="" id=""
                                                wire:model.blur='fathers_bc_no' placeholder="পিতার জন্ম নিবন্ধন নং"
                                                class="form-input rounded">
                                            @error('fathers_bc_no')
                                                <span class="text-red-500 font-bold text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="">
                                            <label for="" class="form-label">মাতার জন্ম নিবন্ধন নং</label>
                                            <input type="text" name="" id=""
                                                wire:model.blur='mothers_bc_no' placeholder="মাতার জন্ম নিবন্ধন নং"
                                                class="form-input rounded">
                                            @error('mothers_bc_no')
                                                <span class="text-red-500 font-bold text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="">
                                            <label for="" class="form-label">পিতা/মাতা না থাকলে অভিভাবকের নাম
                                                (বাংলা)</label>
                                            <input type="text" name="" id=""
                                                wire:model.blur='gurdian_in_absence_of_parent_bn'
                                                placeholder="পিতা/মাতা না থাকলে অভিভাবকের নাম (বাংলা)"
                                                class="form-input rounded">
                                        </div>
                                        <div class="">
                                            <label for="" class="form-label">পিতা/মাতা না থাকলে অভিভাবকের নাম
                                                (English)</label>
                                            <input type="text" name="" id=""
                                                wire:model.blur='gurdian_in_absence_of_parent_en'
                                                placeholder="পিতা/মাতা না থাকলে অভিভাবকের নাম (English)"
                                                class="form-input rounded">
                                        </div>
                                        <div class="">
                                            <label for="" class="form-label">অভিভাবকের জাতীয় পরিচয় পত্র
                                                নং</label>
                                            <input type="text" name="" id=""
                                                wire:model.blur='gurdian_nid_no'
                                                placeholder="পিতা/মাতা না থাকলে অভিভাবকের জাতীয় পরিচয় পত্র নং"
                                                class="form-input rounded">
                                        </div>
                                        <div class="">
                                            <label for="" class="form-label">অভিভাবকের সাথে শিক্ষার্থীর
                                                সম্পর্ক</label>
                                            <input type="text" name="" id=""
                                                wire:model.blur='relation_with_gurdian'
                                                placeholder="পিতা/মাতা না থাকলে অভিভাবকের সাথে শিক্ষার্থীর সম্পর্ক"
                                                class="form-input rounded">
                                        </div>
                                        <div class="">
                                            <label for="" class="form-label">অভিভাবকের মাসিক আয়</label>
                                            <input type="text" name="" id=""
                                                wire:model.blur='gurdians_monthly_income'
                                                placeholder="পিতা/মাতা না থাকলে অভিভাবকের মাসিক আয়"
                                                class="form-input rounded">
                                            @error('gurdians_monthly_income')
                                                <span class="text-red-500 font-bold text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="">
                                            <label for="" class="form-label">অভিভাবকের পেশা </label>
                                            <select name="" class="form-input rounded" id=""
                                                wire:model.blur='gurdians_occupation'>
                                                <option value="">নির্বাচন করুন</option>
                                                @foreach ($GurdianOccupation as $item)
                                                    <option wire:key='{{ $item->id }}'
                                                        value="{{ $item->name }}">
                                                        {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('gurdians_occupation')
                                                <span class="text-red-500 font-bold text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div x-show.transition.in="step === 3">
                                    <div class="border rounded px-4 py-7">
                                        <div class="flex flex-col sm:flex-row">
                                            <div class=" w-2/3 text-center">
                                                <h3 class="text-2xl font-bold">{{ school()->institute_name }}</h3>
                                                <h6>{{ school()->institute_address }}</h6>
                                            </div>
                                            <div class=" w-1/3 flex justify-end">
                                                <img class="border-3 rounded border-emerald-200/60 w-[100px]"
                                                    :src="image" alt="">
                                            </div>
                                        </div>
                                        <table class="table-auto w-full border rounded my-4">
                                            <tbody>
                                                <tr class="border-b hover:bg-gray-50">
                                                    <td class="p-4">
                                                        শ্রেণিঃ
                                                        {{ $this->class->class_name ?? '' }}
                                                    </td>
                                                    <td class="p-4">
                                                        গ্রুপঃ {{ $this->section->section_name ?? '' }}
                                                    </td>
                                                    <td class="p-4">
                                                        ধর্মঃ {{ $this->religion ?? '' }}
                                                    </td>
                                                    <td class="p-4">
                                                        লিঙ্গঃ {{ $this->gender ?? '' }}
                                                    </td>
                                                </tr>
                                                <tr class="border-b hover:bg-gray-50">
                                                    <td class="p-4">
                                                        শিক্ষার্থীর নাম (বাংলা)
                                                    </td>
                                                    <td class="p-4">
                                                        শিক্ষার্থীর নাম (English)
                                                    </td>
                                                    <td class="p-4">
                                                        শিক্ষার্থীর জন্ম তারিখ
                                                    </td>
                                                    <td class="p-4">
                                                        শিক্ষার্থীর জন্ম নিবন্ধন নং
                                                    </td>
                                                </tr>
                                                <tr class="border-b hover:bg-gray-50">
                                                    <td class="p-4">
                                                        {{ $this->name_bn }}
                                                    </td>
                                                    <td class="p-4">
                                                        {{ $this->name_en }}
                                                    </td>
                                                    <td class="p-4">
                                                        {{ $this->dob }}
                                                    </td>
                                                    <td class="p-4">
                                                        {{ $this->birth_certificate_no }}
                                                    </td>
                                                </tr>
                                                <tr class="border-b hover:bg-gray-50">
                                                    <td class="p-4">
                                                        {{ 'পিতার নাম (বাংলা)' }}
                                                    </td>
                                                    <td class="p-4">
                                                        {{ 'পিতার নাম (English)' }}
                                                    </td>
                                                    <td class="p-4">
                                                        {{ 'পিতার জাতীয় পরিচয়পত্র নং' }}
                                                    </td>
                                                    <td class="p-4">
                                                        {{ 'পিতার জন্ম নিবন্ধন নং' }}
                                                    </td>
                                                </tr>
                                                <tr class="border-b hover:bg-gray-50">
                                                    <td class="p-4">
                                                        {{ $this->fathers_name_bn }}
                                                    </td>
                                                    <td class="p-4">
                                                        {{ $this->fathers_name_en }}
                                                    </td>
                                                    <td class="p-4">
                                                        {{ $this->fathers_nid_no }}
                                                    </td>
                                                    <td class="p-4">
                                                        {{ $this->fathers_bc_no }}
                                                    </td>
                                                </tr>
                                                <tr class="border-b hover:bg-gray-50">
                                                    <td class="p-4">
                                                        {{ 'মাতার নাম (বাংলা)' }}
                                                    </td>
                                                    <td class="p-4">
                                                        {{ 'মাতার নাম (English)' }}
                                                    </td>
                                                    <td class="p-4">
                                                        {{ 'মাতার জাতীয় পরিচয়পত্র নং' }}
                                                    </td>
                                                    <td class="p-4">
                                                        {{ 'মাতার জন্ম নিবন্ধন নং' }}
                                                    </td>
                                                </tr>
                                                <tr class="border-b hover:bg-gray-50">
                                                    <td class="p-4">
                                                        {{ $this->mothers_name_bn }}
                                                    </td>
                                                    <td class="p-4">
                                                        {{ $this->mothers_name_en }}
                                                    </td>
                                                    <td class="p-4">
                                                        {{ $this->mothers_nid_no }}
                                                    </td>
                                                    <td class="p-4">
                                                        {{ $this->mothers_bc_no }}
                                                    </td>
                                                </tr>
                                                <tr class="border-b hover:bg-gray-50">
                                                    <td class="p-4">
                                                        পিতা/মাতা জীবিত না থাকলে অভিভাবকের নাম (বাংলা)
                                                    </td>
                                                    <td class="p-4">
                                                        অভিভাবকের নাম (English)
                                                    </td>
                                                    <td class="p-4">
                                                        অভিভাবকের জাতীয় পরিচয়পত্র নং
                                                    </td>
                                                    <td class="p-4">
                                                        অভিভাবকের সাথে শিক্ষার্থীর সম্পর্ক
                                                    </td>
                                                </tr>
                                                <tr class="border-b hover:bg-gray-50">
                                                    <td class="p-4">
                                                        {{ $this->gurdian_in_absence_of_parent_bn }}
                                                    </td>
                                                    <td class="p-4">
                                                        {{ $this->gurdian_in_absence_of_parent_en }}
                                                    </td>
                                                    <td class="p-4">
                                                        {{ $this->gurdian_nid_no }}
                                                    </td>
                                                    <td class="p-4">
                                                        {{ $this->relation_with_gurdian }}
                                                    </td>
                                                </tr>
                                                <tr class="border-b hover:bg-gray-50">
                                                    <td class="p-4">
                                                        অভিভাবকের পেশা
                                                    </td>
                                                    <td class="p-4" colspan="3">
                                                        {{ $this->gurdians_occupation }}
                                                    </td>
                                                </tr>
                                                <tr class="border-b hover:bg-gray-50">
                                                    <td class="p-4">
                                                        অভিভাবকের মাসিক আয়
                                                    </td>
                                                    <td class="p-4" colspan="3">
                                                        {{ $this->gurdians_monthly_income }}
                                                    </td>
                                                </tr>
                                                <tr class="border-b hover:bg-gray-50">
                                                    <td class="p-4">
                                                        মোবাইল নাম্বার
                                                    </td>
                                                    <td class="p-4" colspan="3">
                                                        {{ $this->mobile_number }}
                                                    </td>
                                                </tr>
                                                <tr class="border-b hover:bg-gray-50">
                                                    <td class="p-4" colspan="2">
                                                        শিক্ষার্থীর ধরন
                                                    </td>
                                                    <td class="p-4" colspan="2">
                                                        শিক্ষার্থীর কোটা
                                                    </td>
                                                </tr>
                                                <tr class="border-b hover:bg-gray-50">
                                                    <td class="p-4" colspan="2">
                                                        {{ $this->student_category->name ?? '' }}
                                                    </td>
                                                    <td class="p-4" colspan="2">
                                                        {{ $this->student_quota->name ?? '' }}
                                                </tr>
                                                <tr class="border-b hover:bg-gray-50">
                                                    <td class="p-4" colspan="2">
                                                        পূর্বে অধ্যায়নরত স্কুল এর নাম
                                                    </td>
                                                    <td class="p-4" colspan="2">
                                                        পূর্বে অধ্যায়নরত শ্রেণি
                                                    </td>
                                                </tr>
                                                <tr class="border-b hover:bg-gray-50">
                                                    <td class="p-4" colspan="2">
                                                        {{ $this->previous_institute }}
                                                    </td>
                                                    <td class="p-4" colspan="2">
                                                        {{ $this->previous_study_class }}
                                                    </td>
                                                </tr>
                                                <tr class="border-b hover:bg-gray-50">
                                                    <td class="p-4">
                                                        কোন ভাই/বোন অত্র প্রতিষ্ঠানে অধ্যয়নরত কি না
                                                    </td>
                                                    <td class="p-4">
                                                        অধ্যয়নরত ভাই/বোনের নাম
                                                    </td>
                                                    <td class="p-4">
                                                        অধ্যয়নরত ভাই/বোনের শ্রেণি
                                                    </td>
                                                    <td class="p-4">
                                                        অধ্যয়নরত ভাই/বোনের রোল
                                                    </td>
                                                </tr>
                                                <tr class="border-b hover:bg-gray-50">
                                                    <td class="p-4">
                                                        {{ $this->have_siblings_studying ? 'হ্যাঁ' : 'না' }}
                                                    </td>
                                                    <td class="p-4">
                                                        {{ $this->name_of_studying_siblings }}
                                                    </td>
                                                    <td class="p-4">
                                                        {{ $this->class_of_studying_siblings }}
                                                    </td>
                                                    <td class="p-4">
                                                        {{ $this->roll_of_studying_siblings }}
                                                    </td>
                                                </tr>
                                                <tr class="border-b hover:bg-gray-50">
                                                    <td class="p-4">
                                                        ঠিকানা
                                                    </td>
                                                    <td class="p-4" colspan="3">
                                                        বিভাগঃ- {{ $this->division }},
                                                        জেলাঃ- {{ $this->district }},
                                                        উপজেলাঃ- {{ $this->upazila }},
                                                        ইউনিয়নঃ- {{ $this->union }},
                                                        পোস্ট অফিসঃ- {{ $this->postoffice }},
                                                        গ্রামঃ- {{ $this->village }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- / Step Content -->
                        </div>
                    </div>

                    <!-- Bottom Navigation -->
                    <div class="sticky bottom-0 left-0 right-0 py-5 bg-white shadow-md" x-show="step != 'complete'">
                        <div class="max-w-3xl mx-auto px-4">
                            <div class="flex justify-between">
                                <div class="w-1/2">
                                    <button x-show="step > 1" @click="step--"
                                        class="w-32 focus:outline-none py-2 px-5 rounded-lg shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100 font-medium border">Previous</button>
                                </div>

                                <div class="w-1/2 text-right">
                                    <button x-show="step < 3"
                                        x-on:click="step === 1 ?  $wire.$call('formPreview') : $wire.$call('checkPD')"
                                        id="next-button" @click="step++"
                                        class="w-32 focus:outline-none border border-transparent py-2 px-5 rounded-lg shadow-sm text-center text-white bg-blue-500 hover:bg-blue-600 font-medium">
                                        Next
                                    </button>
                                    {{-- @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif --}}
                                    @if (!$errors->any())
                                        <button @click="step = 'complete'" wire:click="store" x-show="step === 3"
                                            class="w-32 focus:outline-none border border-transparent py-2 px-5 rounded-lg shadow-sm text-center text-white bg-blue-500 hover:bg-blue-600 font-medium">Complete</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container px-10 py-5">
            <header class="flex items-center flex-wrap mb-4" wire:ignore>
                <div class="w-1/2 flex justify-start items-center flex-wrap">
                    <span class="shadow-md px-2 py-2 bg-emerald-500 rounded mr-2">
                        <i data-lucide="contact" class="w-10"></i>
                    </span>
                </div>
                <div class="w-1/2 flex justify-end items-center gap-3">
                    <button @click="openCEmodal =!openCEmodal"
                        class="bg-green-500 bg-opacity-25 border border-green-500 rounded flex items-center px-4 py-2 shahow-md hover:bg-opacity-100 transition fade gap-2">
                        <i data-lucide="plus-circle" class="w-4"></i>
                        New form
                    </button>
                </div>
            </header>
            <!-- component -->


            <div wire:ignore>
                <table id="example" class="display" style="width: 100%">
                    <thead class="bg-blue-500 border-none">
                        <tr>
                            <th class="text-white">Admission ID</th>
                            <th class="text-white">Class</th>
                            <th class="text-white">Information</th>
                            <th class="text-white text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($applications as $key => $item)
                            <tr wire:key='{{ $item->id }}' class="border-b">
                                <td>#{{ $item->addmission_id }}</td>
                                <td>
                                    <div class="flex items-center gap-2 flex-wrap">
                                        <img src="" alt="">
                                        <div class="flex flex-col gap-2">
                                            {{ 'শ্রেণী: ' . $item->school_class->class_name }},<br />
                                            {{ 'শাখা: ' . $item->school_class_section->section_name }}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="flex items-center gap-2 flex-wrap">
                                        {{ 'নাম: ' . $item->name_bn }}</br>
                                        {{ 'বাবার নাম: ' . $item->fathers_name_bn }}</br>
                                        {{ 'মায়ের নাম: ' . $item->mothers_name_bn }}
                                    </div>
                                </td>
                                <td class="p-3 al flex justify-end items-center gap-1.5 flex-wrap">
                                    <span
                                        class="px-2 py-1 rounded-sm bg-emerald-500 cursor-pointer flex w-max align-center justify-center"
                                        wire:click='show({{ $item->id }})'>
                                        <i data-lucide="eye" class="w-4 me-1"></i> Edit
                                    </span>
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
                            <th class="text-white">Admission ID</th>
                            <th class="text-white">Class</th>
                            <th class="text-white">Information</th>
                            <th class="text-white text-right">Actions</th>
                        </tr>
                    </tfoot>
                </table>
            </div>

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
        // Livewire.on('closeModal', (value) => {
        //     console.log(value);
        //     var modalBackdrop = document.querySelector('[modal-backdrop]');
        //     document.querySelector('body').style.overflow = 'auto';
        //     modalBackdrop.style.display = 'none';
        //     if (value === false) {
        //         window.Alpine.data('openCEmodal', false);
        //     }
        // });

        Livewire.on('reload', (value) => {
            location.reload();
        });
    </script>
    <script>
        function app() {
            return {
                step: 1,
                // passwordStrengthText: '',
                // togglePassword: false,
                image: 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEAAAAAAAD/4QBCRXhpZgAATU0AKgAAAAgAAYdpAAQAAAABAAAAGgAAAAAAAkAAAAMAAAABAAAAAEABAAEAAAABAAAAAAAAAAAAAP/bAEMACwkJBwkJBwkJCQkLCQkJCQkJCwkLCwwLCwsMDRAMEQ4NDgwSGRIlGh0lHRkfHCkpFiU3NTYaKjI+LSkwGTshE//bAEMBBwgICwkLFQsLFSwdGR0sLCwsLCwsLCwsLCwsLCwsLCwsLCwsLCwsLCwsLCwsLCwsLCwsLCwsLCwsLCwsLCwsLP/AABEIAdoB2gMBIgACEQEDEQH/xAAfAAABBQEBAQEBAQAAAAAAAAAAAQIDBAUGBwgJCgv/xAC1EAACAQMDAgQDBQUEBAAAAX0BAgMABBEFEiExQQYTUWEHInEUMoGRoQgjQrHBFVLR8CQzYnKCCQoWFxgZGiUmJygpKjQ1Njc4OTpDREVGR0hJSlNUVVZXWFlaY2RlZmdoaWpzdHV2d3h5eoOEhYaHiImKkpOUlZaXmJmaoqOkpaanqKmqsrO0tba3uLm6wsPExcbHyMnK0tPU1dbX2Nna4eLj5OXm5+jp6vHy8/T19vf4+fr/xAAfAQADAQEBAQEBAQEBAAAAAAAAAQIDBAUGBwgJCgv/xAC1EQACAQIEBAMEBwUEBAABAncAAQIDEQQFITEGEkFRB2FxEyIygQgUQpGhscEJIzNS8BVictEKFiQ04SXxFxgZGiYnKCkqNTY3ODk6Q0RFRkdISUpTVFVWV1hZWmNkZWZnaGlqc3R1dnd4eXqCg4SFhoeIiYqSk5SVlpeYmZqio6Slpqeoqaqys7S1tre4ubrCw8TFxsfIycrS09TV1tfY2dri4+Tl5ufo6ery8/T19vf4+fr/2gAMAwEAAhEDEQA/APTmZsnmk3N60N1NJTELub1o3N60lFAC7m9aNzetJRQAu5vWjc3rSUUALub1o3N60lFAC7m9aNzetJRQAu5vWjc3rSUUALub1o3N60lFAC7m9aNzetJRQAu5vWjc3rSUUALub1o3N60lFAC7m9aNzetJRQAu5vWjc3rSUUALub1o3N60lFAC7m9aNzetJRQAu5vWjc3rSUUALub1o3N60lFAC7m9aNzetJRQAu5vWjc3rSUUALub1o3N60lFAC7m9aNzetJRQAu5vWjc3rSUUALub1o3N60lJQA7c3rSbm9aSigBdzetG4+tJRQAZPrRuPrSUUALub1/lRub1pKSgBdzUbm9aSigBdzetG5vX+VJSUALub1/lUu5qhqXj1oAG6mkpW6mkoAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooASiiigAooooAKSiigAooo+lACUZoooAKKKSgAo/rRSUALUlRVJz60AObqaSlbqaSgAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACkoooAKKKKACiikoAKSlooASiiigA+lHpRQaACkoooATmilpPegBP/ANdS5HrUdSfL7UAObqaSlbqaSgAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKSiigAooooAKKKKAEooooASij60UAFFFHpQAUmaKPxoAKSlpPWgA/wAmk/pS/Sk47dqADpUvPvUXrUn4H8qAHt1NJSt1NJQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFISFBJIAHUk4FAC0VTlv4EyEBc+3C/nVSS9uX6MEHonX8zQBrEqvLEAe5A/nUTXVqvWVfwyf5VjFmY5Ykn3JP86SmBrG/tB3c/RTTf7QtvST8hWXRQBqi/te+8f8AAc09by0b/loB/vAiseigDeV43+66t9CDTq5/p04+lTJdXMfSQkej/MP1oA2qKoR6gpwJUK/7Scj8utXEkjkG5GDD2P8AMUgH0UUUAFFFJQAUUUUAFFFJQAtJRRQAUlFFABR2oo+lAB1pKKP60AFFFFACUHjNH/66KAEpaSj/APVQAc0/I9KZUufpQA5uppKVuppKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACimsyopZiAo5JNZlxePLlI8rH0J/ib60AWp72KLKph3/wDHR9TWdLNNMcuxPoOij6Co6KYBRRRQAUUUUAFFFFABRRRQAUUUUAFKruhDIxUjuDikooA0IL/os4/4Gv8AUVfBVgCpBB6Ecg1gVLBcSwH5eUP3lPQ/SgDaoqOKaOZdyH/eB6qfepKQBRRRQAlFFFABSUUUAFFFFABRRSf5NABxR6e1FJQAcUUUnP6UALSf5/GjvRz+FAB06d6KT6UGgA96kyf8mo//ANdP59P1oAlbqaSlbqaSgAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACmu6RqzucKvJNKSACScADJJ7Csi6uDO2BkRqflHr7mgBLi5edu4QH5V/qagoopgFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFACUUUUAPjkkiYOhwR+RHoa14J0nTI4YffX0NYtPileJ1dDyOoPQj0NAG7SUyKVJkDr36juD6U+kAUhoooAKKKKACij/JpKACj/PNFFABScUelFACUdqP8mj+dABn9KMjij60d+tACf5FH5Uf59qOOlACfhUn40zmn4oAlbqaSlbqaSgAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKhuJhDEz/xfdQerGgCpfXGT5CHgf6w+/8AdqhQSSSScknJPqTRTAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACkoooAKKKKACiiigCe2nMEnP+rbhx6e9bHoQevT3zXP1p2M+9DE33k5X/AHf/AK1AF2koNFIAoopKAFpKKPSgApPX0pf8mkoAKKTPP1paAE+lFFIT/ntQAelHAoz0oz/hQAd6T155oooAKk2+wqLPt/8AWqTj1P5GgCZuppKVuppKACiiigAooooAKKKKACiiigAooooAKKKKACiiigArJvpd8uwH5Y+P+BHrWnK4jjkc/wAKkj69qwiSSSepJJ+ppgFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABSUUUAFFFFABRRSUAFFFFABT4pDFIkg/hPPuO4plFAG8CGAYchgCD7HmlqpYy74dp6xnH4HkVapALSUUUAH+NFFJQAc0f5+tHFJQAUUUepoAP/r0nP/1sUH1ozQAUnOaPwo9OlAAcd6T60tJQAHn+lSZPotR/55qTJ/yKAJm6mkpW6mkoAKKKKACiiigAooooAKKKKACiiigAooooAKKKKAKWoPiNE/vtk/RazKt6g2Zgv9xB+Z5qpTAKKKKACiiigAooooAKKKKA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',
                // password: '',
                // gender: 'Male',
                // checkPasswordStrength() {
                //     var strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
                //     var mediumRegex = new RegExp(
                //         "^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(?=.{6,})");
                //     let value = this.password;
                //     if (strongRegex.test(value)) {
                //         this.passwordStrengthText = "Strong password";
                //     } else if (mediumRegex.test(value)) {
                //         this.passwordStrengthText = "Could be stronger";
                //     } else {
                //         this.passwordStrengthText = "Too weak";
                //     }
                // }
            }
        }
    </script>
    <script>
        function checkImageDimensions(event) {
            const input = event.target;
            const file = input.files[0];
            const image = new Image();

            image.src = URL.createObjectURL(file);

            image.onload = function() {
                if (image.width !== 300 || image.height !== 300) {
                    input.value = ""; // Clear the input field
                    @this.dispatch('image-dimensions-valid');
                } else {
                    @this.dispatch('image-dimensions-ok');
                }
            };
        }
    </script>
@endpush
