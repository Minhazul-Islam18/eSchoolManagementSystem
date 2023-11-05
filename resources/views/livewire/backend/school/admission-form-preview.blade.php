<div>
    <main class="px-10 py-8">
        <div class="border border-dark px-6 py-8 mt-12 rounded">
            <div class="flex flex-wrap">
                <div class="w-3/4 flex flex-col items-center">
                    <h4 class="text-2xl font-bold">{{ school()->institute_name }}</h4>
                    <h6 class="text-md font-bold">{{ school()->institute_address }}</h6>
                </div>
                <div class="w-1/4 flex justify-end items-top">
                    <img class="w-52" src="/storage/{{ $preview['student_image'] }}" alt="">
                </div>
            </div>
            <table class="table-auto w-full border border-dark rounded my-4">
                <tbody>
                    <tr class="border-b hover:bg-gray-50 border-dark border-dark">
                        <td class="p-4 border-dark border-r">
                            শ্রেণিঃ
                            {{ $preview['class_name'] ?? '' }}
                        </td>
                        <td class="p-4 border-dark border-r">
                            শাখা {{ $preview['section_name'] ?? '' }}
                        </td>
                        <td class="p-4 border-dark border-r">
                            ধর্মঃ {{ $preview['religion'] ?? '' }}
                        </td>
                        <td class="p-4">
                            লিঙ্গঃ {{ $preview['gender'] ?? '' }}
                        </td>
                    </tr>
                    <tr class="border-b border-dark hover:bg-gray-50">
                        <td class="p-4 border-dark border-r">
                            শিক্ষার্থীর নাম (বাংলা)
                        </td>
                        <td class="p-4 border-dark border-r">
                            শিক্ষার্থীর নাম (English)
                        </td>
                        <td class="p-4 border-dark border-r">
                            শিক্ষার্থীর জন্ম তারিখ
                        </td>
                        <td class="p-4">
                            শিক্ষার্থীর জন্ম নিবন্ধন নং
                        </td>
                    </tr>
                    <tr class="border-b hover:bg-gray-50 border-dark">
                        <td class="p-4 border-dark border-r">
                            {{ $preview['name_bn'] }}
                        </td>
                        <td class="p-4 border-dark border-r">
                            {{ $preview['name_en'] }}
                        </td>
                        <td class="p-4 border-dark border-r">
                            {{ \carbon\Carbon::parse($preview['dob'])->toDayDateTimeString('Y-m-d') }}
                        </td>
                        <td class="p-4">
                            {{ $preview['birth_certificate_no'] }}
                        </td>
                    </tr>
                    <tr class="border-b hover:bg-gray-50 border-dark">
                        <td class="p-4 border-dark border-r">
                            {{ 'পিতার নাম (বাংলা)' }}
                        </td>
                        <td class="p-4 border-dark border-r">
                            {{ 'পিতার নাম (English)' }}
                        </td>
                        <td class="p-4 border-dark border-r">
                            {{ 'পিতার জাতীয় পরিচয়পত্র নং' }}
                        </td>
                        <td class="p-4">
                            {{ 'পিতার জন্ম নিবন্ধন নং' }}
                        </td>
                    </tr>
                    <tr class="border-b hover:bg-gray-50 border-dark">
                        <td class="p-4 border-dark border-r">
                            {{ $preview['fathers_name_bn'] }}
                        </td>
                        <td class="p-4 border-dark border-r">
                            {{ $preview['fathers_name_en'] }}
                        </td>
                        <td class="p-4 border-dark border-r">
                            {{ $preview['fathers_nid_no'] }}
                        </td>
                        <td class="p-4">
                            {{ $preview['fathers_bc_no'] }}
                        </td>
                    </tr>
                    <tr class="border-b hover:bg-gray-50 border-dark">
                        <td class="p-4 border-dark border-r">
                            {{ 'মাতার নাম (বাংলা)' }}
                        </td>
                        <td class="p-4 border-dark border-r">
                            {{ 'মাতার নাম (English)' }}
                        </td>
                        <td class="p-4 border-dark border-r">
                            {{ 'মাতার জাতীয় পরিচয়পত্র নং' }}
                        </td>
                        <td class="p-4">
                            {{ 'মাতার জন্ম নিবন্ধন নং' }}
                        </td>
                    </tr>
                    <tr class="border-b hover:bg-gray-50 border-dark">
                        <td class="p-4 border-dark border-r">
                            {{ $preview['mothers_name_bn'] }}
                        </td>
                        <td class="p-4 border-dark border-r">
                            {{ $preview['mothers_name_en'] }}
                        </td>
                        <td class="p-4 border-dark border-r">
                            {{ $preview['mothers_nid_no'] }}
                        </td>
                        <td class="p-4">
                            {{ $preview['mothers_bc_no'] }}
                        </td>
                    </tr>
                    <tr class="border-b hover:bg-gray-50 border-dark">
                        <td class="p-4 border-dark border-r">
                            পিতা/মাতা জীবিত না থাকলে অভিভাবকের নাম (বাংলা)
                        </td>
                        <td class="p-4 border-dark border-r">
                            অভিভাবকের নাম (English)
                        </td>
                        <td class="p-4 border-dark border-r">
                            অভিভাবকের জাতীয় পরিচয়পত্র নং
                        </td>
                        <td class="p-4">
                            অভিভাবকের সাথে শিক্ষার্থীর সম্পর্ক
                        </td>
                    </tr>
                    <tr class="border-b hover:bg-gray-50 border-dark">
                        <td class="p-4 border-dark border-r">
                            {{ $preview['gurdian_in_absence_of_parent_bn'] }}
                        </td>
                        <td class="p-4 border-dark border-r">
                            {{ $preview['gurdian_in_absence_of_parent_en'] }}
                        </td>
                        <td class="p-4 border-dark border-r">
                            {{ $preview['gurdian_nid_no'] }}
                        </td>
                        <td class="p-4">
                            {{ $preview['relation_with_gurdian'] }}
                        </td>
                    </tr>
                    <tr class="border-b hover:bg-gray-50 border-dark">
                        <td class="p-4 border-dark border-r">
                            অভিভাবকের পেশা
                        </td>
                        <td class="p-4" colspan="3">
                            {{ $preview['gurdians_occupation'] }}
                        </td>
                    </tr>
                    <tr class="border-b hover:bg-gray-50 border-dark">
                        <td class="p-4 border-dark border-r">
                            অভিভাবকের মাসিক আয়
                        </td>
                        <td class="p-4" colspan="3">
                            {{ $preview['gurdians_monthly_income'] }}
                        </td>
                    </tr>
                    <tr class="border-b hover:bg-gray-50 border-dark">
                        <td class="p-4 border-dark border-r">
                            মোবাইল নাম্বার
                        </td>
                        <td class="p-4" colspan="3">
                            {{ $preview['mobile_number'] }}
                        </td>
                    </tr>
                    <tr class="border-b hover:bg-gray-50 border-dark">
                        <td class="p-4 border-dark border-r" colspan="2">
                            শিক্ষার্থীর ধরন
                        </td>
                        <td class="p-4" colspan="2">
                            শিক্ষার্থীর কোটা
                        </td>
                    </tr>
                    <tr class="border-b hover:bg-gray-50 border-dark">
                        <td class="p-4 border-dark border-r" colspan="2">
                            {{ $preview['student_category'] ?? '' }}
                        </td>
                        <td class="p-4" colspan="2">
                            {{ $preview['student_quota'] ?? '' }}
                    </tr>
                    <tr class="border-b hover:bg-gray-50 border-dark">
                        <td class="p-4 border-dark border-r" colspan="2">
                            পূর্বে অধ্যায়নরত স্কুল এর নাম
                        </td>
                        <td class="p-4" colspan="2">
                            পূর্বে অধ্যায়নরত শ্রেণি
                        </td>
                    </tr>
                    <tr class="border-b hover:bg-gray-50 border-dark">
                        <td class="p-4 border-dark border-r" colspan="2">
                            {{ $preview['previous_institute'] }}
                        </td>
                        <td class="p-4 border-dark border-r" colspan="2">
                            {{ $preview['previous_study_class'] }}
                        </td>
                    </tr>
                    <tr class="border-b hover:bg-gray-50 border-dark">
                        <td class="p-4 border-dark border-r">
                            কোন ভাই/বোন অত্র প্রতিষ্ঠানে অধ্যয়নরত কি না
                        </td>
                        <td class="p-4 border-dark border-r">
                            অধ্যয়নরত ভাই/বোনের নাম
                        </td>
                        <td class="p-4 border-dark border-r">
                            অধ্যয়নরত ভাই/বোনের শ্রেণি
                        </td>
                        <td class="p-4">
                            অধ্যয়নরত ভাই/বোনের রোল
                        </td>
                    </tr>
                    <tr class="border-b hover:bg-gray-50 border-dark">
                        <td class="p-4 border-dark border-r">
                            {{ $preview['have_siblings_studying'] ? 'হ্যাঁ' : 'না' }}
                        </td>
                        <td class="p-4 border-dark border-r">
                            {{ $preview['name_of_siblings_studying'] }}
                        </td>
                        <td class="p-4 border-dark border-r">
                            {{ $preview['class_of_siblings_studying'] }}
                        </td>
                        <td class="p-4">
                            {{ $preview['roll_of_siblings_studying'] }}
                        </td>
                    </tr>
                    <tr class="border-b hover:bg-gray-50 border-dark">
                        <td class="p-4 border-dark border-r">
                            ঠিকানা
                        </td>
                        <td class="p-4" colspan="3">
                            বিভাগঃ- {{ $preview['division'] }},
                            জেলাঃ- {{ $preview['district'] }},
                            উপজেলাঃ- {{ $preview['upazila'] }},
                            ইউনিয়নঃ- {{ $preview['union'] }},
                            পোস্ট অফিসঃ- {{ $preview['postoffice'] }},
                            গ্রামঃ- {{ $preview['village'] }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
</div>
