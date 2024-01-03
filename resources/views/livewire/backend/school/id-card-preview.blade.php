<div>
    {{-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> --}}
    <div class="rounded-md flex bg-cover py-5 px-3 bg-no-repeat back print:rounded-md print:flex print:bg-cover print:py-5 print:px-3 print:bg-no-repeat"
        style="border-radius: .5rem; display:flex; background-size: cover; padding: 1.2rem .7rem; background-repeat: no-repeat;"
        id="profile-card" wire:loading.class="opacity-50">
        <div class="print:w-1/3 w-1/3 print:flex flex print:flex-col flex-col print:items-center items-center">
            <img class=" print:rounded-full print:mb-2 rounded-full mb-2" src="{{ 'https://placehold.co/80x80/png' }}"
                alt="">
            <img class="print:relative print:block print:px-3 relative block px-3"
                src="{{ isset($card['student']->student_image) ? $path . '/storage/' . $card['student']->student_image : 'https://placehold.co/100x100/png' }}"
                alt="">
        </div>
        <div class="print:w-2/3 w-2/3">
            <h2
                class=" print:font-bold print:text-2xl print:uppercase print:text-center print:mb-0 print:text-blue-600 text-blue-600 mb-0 text-center uppercase text-2xl font-bold">
                {{ school()->institute_name }}
            </h2>
            <p class="print:text-center print:text-black print:text-xs print:mb-2 mb-2 text-xs text-black text-center">
                {{ school()->institute_address }}
            </p>
            <div
                class="print:text-black text-black print:flex flex print:flex-wrap flex-wrap print:gap-2 gap-2 print:justify-center justify-center print:mb-1 mb-1 print:border-b border-b print:border-blue-600 border-blue-600">
                <span class=" print:font-medium font-medium">Phone: {{ school()->mobile_no }}</span>
                <span class=" print:font-medium font-medium">Web: {{ school()->web_address }}</span>
            </div>
            <div class="print:py-2 py-2 print:flex-col flex-col print:text-slate-900 text-slate-900 print:gap-2 gap-2">
                <div class="print:flex flex print:gap-1 gap-1">
                    <span class=" print:font-medium font-medium">Name:</span>
                    <span>{{ $card['student']->name_en ?? 'xxxxxxxxxxx' }}</span>
                </div>
                <div class="print:flex flex print:gap-1 gap-1">
                    <span class=" print:font-medium font-medium">Class:</span>
                    <span>{{ $card['student']->school_class->class_name ?? 'xxxxxx' }}</span>
                </div>
                <div class="print:flex flex print:gap-1 gap-1">
                    <span class=" print:font-medium font-medium">DOB:</span>
                    <span>{{ isset($card['student']->dob) ? \carbon\carbon::parse($card['student']->dob)->toDateString() : 'xx-xx-xxxx' }}</span>
                </div>
                <div class="print:flex flex print:gap-1 gap-1">
                    <span class=" print:font-medium font-medium">Address:</span>
                    <span>
                        {{ !empty($card['student'])
                            ? $card['student']->village . ', ' . $card['student']['upazila'] . ', ' . $card['student']['district']
                            : 'xxx,xxxxxxx,xxxx,xxxxxxxxx' }}</span>
                </div>
                <div class="print:flex flex print:gap-1 gap-1">
                    <span class=" print:font-medium font-medium">Phone:</span>
                    <span>{{ $card['student']->mobile_number ?? '0123456789' }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
