<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        #profile-card {
            background-color: #e1f0ff;
            border-radius: .5rem;
            /* display: flex; */
            /* flex-direction: row; */
            background-size: cover;
            padding: 1.2rem .7rem;
            background-repeat: no-repeat;
            width: 100%
        }
    </style>
</head>

<body>
    <div>
        <table id="profile-card">
            <tbody>
                <tr style="width: 100%">
                    <td style="width:30%;display: flex; flex-direction: column; align-items: center; justify-content: space-around">
                        <img style="border-radius: 50%; width:50px; margin-bottom: 2px;"
                            src="{{ isset(school()->institute_logo) ? storage_path(school()->institute_logo) : 'https://placehold.co/80x80/png' }}"
                            alt="">
                        <img style="position: relative; display: block; padding: 0 3px; width: 80px;"
                            src="{{ isset($card['student']->student_image) ? $path . '/storage/' . $card['student']->student_image : 'https://placehold.co/100x100/png' }}"
                            alt="">
                    </td>
                    <td style="width:65%;">
                        <div style="">
                            <h2 style="font-weight: bold; text-align: center; margin-bottom: 0; color: #3182ce; text-transform: uppercase; font-size: 1.5rem;"
                                class="print:font-bold print:text-2xl print:uppercase print:text-center print:mb-0 print:text-blue-600">
                                {{ school()->institute_name }}
                            </h2>
                            <p style="text-align: center; color: #000; font-size: 0.75rem; margin-bottom: 2px;"
                                class="print:text-center print:text-black print:text-xs print:mb-2">
                                {{ school()->institute_address }}
                            </p>

                            <div style="color: #000; display: flex; flex-wrap: wrap; gap: 8px; justify-content: center; margin-bottom: 1px; border-bottom: 1px solid #3182ce;"
                                class="print:flex flex print:flex-wrap flex-wrap print:gap-2 gap-2 print:justify-center justify-center print:mb-1 mb-1 print:border-b border-b print:border-blue-600">
                                <span style="font-weight: 500;" class="print:font-medium font-medium">Phone:
                                    {{ school()->mobile_no }}</span>
                                <span style="font-weight: 500;" class="print:font-medium font-medium">Web:
                                    {{ school()->web_address }}</span>
                            </div>

                            <div style="padding: 2px 0; display: flex; flex-direction: column; color: #1a202c; gap: 2px;"
                                class="print:py-2 py-2 print:flex-col flex-col print:text-slate-900 text-slate-900 print:gap-2 gap-2">
                                <div style="display: flex; gap: .6rem;" class="print:flex flex print:gap-1 gap-1">
                                    <span style="font-weight: 500;" class="print:font-medium font-medium">Name:</span>
                                    <span>{{ $card['student']->name_en ?? 'xxxxxxxxxxx' }}</span>
                                </div>
                                <div style="display: flex; gap: .6rem;" class="print:flex flex print:gap-1 gap-1">
                                    <span style="font-weight: 500;" class="print:font-medium font-medium">Class:</span>
                                    <span>{{ $card['student']->school_class->class_name ?? 'xxxxxx' }}</span>
                                </div>
                                <div style="display: flex; gap: .6rem;" class="print:flex flex print:gap-1 gap-1">
                                    <span style="font-weight: 500;" class="print:font-medium font-medium">DOB:</span>
                                    <span>{{ isset($card['student']->dob) ? \Carbon\Carbon::parse($card['student']->dob)->toDateString() : 'xx-xx-xxxx' }}</span>
                                </div>
                                <div style="display: flex; gap: .6rem;" class="print:flex flex print:gap-1 gap-1">
                                    <span style="font-weight: 500;"
                                        class="print:font-medium font-medium">Address:</span>
                                    <span>
                                        {{ !empty($card['student'])
                                            ? $card['student']->village . ', ' . $student_upazila_name . ', ' . $student_district_name
                                            : 'xxx,xxxxxxx,xxxx,xxxxxxxxx' }}</span>
                                </div>
                                <div style="display: flex; gap: .6rem;" class="print:flex flex print:gap-1 gap-1">
                                    <span style="font-weight: 500;" class="print:font-medium font-medium">Phone:</span>
                                    <span>{{ $card['student']->mobile_number ?? '0123456789' }}</span>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        {{-- <div style="" id="profile-card" wire:loading.class="opacity-50">



            <div style="width: 66%;">
                <h2 style="font-weight: bold; text-align: center; margin-bottom: 0; color: #3182ce; text-transform: uppercase; font-size: 1.5rem;"
                    class="print:font-bold print:text-2xl print:uppercase print:text-center print:mb-0 print:text-blue-600">
                    {{ school()->institute_name }}
                </h2>
                <p style="text-align: center; color: #000; font-size: 0.75rem; margin-bottom: 2px;"
                    class="print:text-center print:text-black print:text-xs print:mb-2">
                    {{ school()->institute_address }}
                </p>

                <div style="color: #000; display: flex; flex-wrap: wrap; gap: 8px; justify-content: center; margin-bottom: 1px; border-bottom: 1px solid #3182ce;"
                    class="print:flex flex print:flex-wrap flex-wrap print:gap-2 gap-2 print:justify-center justify-center print:mb-1 mb-1 print:border-b border-b print:border-blue-600">
                    <span style="font-weight: 500;" class="print:font-medium font-medium">Phone:
                        {{ school()->mobile_no }}</span>
                    <span style="font-weight: 500;" class="print:font-medium font-medium">Web:
                        {{ school()->web_address }}</span>
                </div>

                <div style="padding: 2px 0; display: flex; flex-direction: column; color: #1a202c; gap: 2px;"
                    class="print:py-2 py-2 print:flex-col flex-col print:text-slate-900 text-slate-900 print:gap-2 gap-2">
                    <div style="display: flex; gap: .6rem;" class="print:flex flex print:gap-1 gap-1">
                        <span style="font-weight: 500;" class="print:font-medium font-medium">Name:</span>
                        <span>{{ $card['student']->name_en ?? 'xxxxxxxxxxx' }}</span>
                    </div>
                    <div style="display: flex; gap: .6rem;" class="print:flex flex print:gap-1 gap-1">
                        <span style="font-weight: 500;" class="print:font-medium font-medium">Class:</span>
                        <span>{{ $card['student']->school_class->class_name ?? 'xxxxxx' }}</span>
                    </div>
                    <div style="display: flex; gap: .6rem;" class="print:flex flex print:gap-1 gap-1">
                        <span style="font-weight: 500;" class="print:font-medium font-medium">DOB:</span>
                        <span>{{ isset($card['student']->dob) ? \Carbon\Carbon::parse($card['student']->dob)->toDateString() : 'xx-xx-xxxx' }}</span>
                    </div>
                    <div style="display: flex; gap: .6rem;" class="print:flex flex print:gap-1 gap-1">
                        <span style="font-weight: 500;" class="print:font-medium font-medium">Address:</span>
                        <span>
                            {{ !empty($card['student'])
                                ? $card['student']->village . ', ' . $student_upazila_name . ', ' . $student_district_name
                                : 'xxx,xxxxxxx,xxxx,xxxxxxxxx' }}</span>
                    </div>
                    <div style="display: flex; gap: .6rem;" class="print:flex flex print:gap-1 gap-1">
                        <span style="font-weight: 500;" class="print:font-medium font-medium">Phone:</span>
                        <span>{{ $card['student']->mobile_number ?? '0123456789' }}</span>
                    </div>
                </div>
            </div>
        </div> --}}

    </div>
</body>

</html>
