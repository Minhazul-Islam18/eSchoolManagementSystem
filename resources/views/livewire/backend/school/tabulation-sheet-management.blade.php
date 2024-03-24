<div>
    <main>
        <div class="container px-10 py-5">
            <header class="flex items-center flex-wrap mb-4" wire:ignore>
                <div class="w-full flex justify-start items-center flex-wrap">
                    <span class="shadow-md px-2 py-2 bg-emerald-500 rounded mr-2">
                        <i data-lucide="calendar-check" class="w-10"></i>
                    </span>
                </div>
            </header>
            <div class="mb-3 sm:mb-4">
                <h4 class="text-2xl mt-4 mb-2">Filter</h4>
                <form wire:submit='getTabulationSheet' class="flex gap-4 justify-start items-center">
                    <div class="">
                        <label for="" class="form-label">Class</label>
                        <select wire:model.blur='class_id' class="form-select rounded" wire:change='getSection'
                            id="">
                            <option value="">Select class</option>
                            @foreach ($this->classes as $item)
                                <option value="{{ $item->id }}"
                                    {{ $item->id == $this->class_id ? 'selected' : '' }}>
                                    {{ $item->class_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('class_id')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    @if ($this->groups != null)
                        <div class="">
                            <label for="group_id" class="form-label">Groups</label>
                            <select wire:model.blur='group_id' class="form-select rounded" wire:change='getExams'
                                wire:loading.class='opacity-50 blur-sm' wire:target='getSection' id="group_id">
                                <option value="">Select group</option>
                                @forelse ($this->groups as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $item->id == $this->group_id ? 'selected' : '' }}>
                                        {{ $item->group_name }}</option>
                                @empty
                                    <option value="" disabled>No group found</option>
                                @endforelse
                            </select>
                            @error('group_id')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    @else
                        <div class="">
                            <label for="section_id" class="form-label">Section</label>
                            <select wire:model.blur='section_id' class="form-select rounded" wire:change='getExams'
                                wire:loading.class='opacity-50 blur-sm' wire:target='getSection' id="section_id">
                                <option value="">Select section</option>
                                @forelse ($sections as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $item->id == $this->section_id ? 'selected' : '' }}>
                                        {{ $item->section_name }}</option>
                                @empty
                                    <option value="" disabled>No section found
                                    </option>
                                @endforelse
                            </select>
                            @error('section_id')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    @endif

                    <div class="">
                        <label for="" class="form-label">Exams</label>
                        <select wire:model.blur='exam_id' class="form-select rounded" wire:change=''
                            wire:loading.class='opacity-50 blur-sm' wire:target='getExams' id="">
                            <option value="">Select exam</option>
                            @forelse ($this->exams as $item)
                                <option value="{{ $item->id }}"
                                    {{ $item->id == $this->exam_id ? 'selected' : '' }}>
                                    {{ $item->exam_name }}</option>
                            @empty
                                <option value="" disabled>No section found</option>
                            @endforelse
                        </select>
                        @error('exam_id')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="px-12 py-2 bg-emerald-500/90 hover:bg-emerald-500 rounded-full"
                        wire:click="">Search</button>
                </form>
            </div>
            <button id="print" class="px-6 py-3 rounded-sm bg-sky-500 uppercase font-semibold mb-3">Print</button>
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 border"
                id="table">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            SL. No.
                        </th>
                        <th scope="col" class="px-6 py-3">
                            STD. Id
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Student Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Roll No.
                        </th>
                        @foreach ($this->subjects as $item)
                            <th scope="col" class="px-6 py-3">
                                {{ $item->subject_name }}
                            </th>
                        @endforeach
                        <th scope="col" class="px-6 py-3">
                            Total
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Point
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Grade
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($student as $i => $item)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $i + 1 }}
                            </th>
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $item->student_id }}
                            </th>
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $item->name_en }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $item->roll ?? 'N/A' }}
                            </td>
                            @php
                                $total = [];
                            @endphp
                            @foreach ($this->subjects as $i => $subject)
                                @php
                                    $r = '';
                                    $r = isset($item->school_exam_results)
                                        ? $item->school_exam_results
                                            ->where('school_class_subject_id', $subject->id)
                                            ->first()
                                        : '';

                                    $total[$i] = $r?->total ?? 0;
                                @endphp
                                <td class="px-6 py-4">{{ $r?->total }}</td>
                            @endforeach
                            <td class="px-6 py-4">
                                <?php
                                $sum = 0;
                                
                                foreach ($total as $value) {
                                    $sum += $value;
                                }
                                
                                echo $sum;
                                ?>
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $gradesAndPoints = $item->school_exam_results->map(function ($result) {
                                        return [
                                            'grade' => $result->grade,
                                            'point' => $result->point,
                                        ];
                                    });
                                    $totalPoint = 0; // Initialize totalPoint

                                    foreach ($gradesAndPoints as $item) {
                                        $totalPoint += $item['point'];
                                    }
                                    $pointEach = number_format($totalPoint / count($this->subjects), 2);
                                    echo $pointEach;
                                @endphp
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $type = isset($this->group_id) ? 'group' : 'section';
                                    $result = App\Models\School::gradingRule(
                                        school(),
                                        $this->group_id ?? $this->section_id,
                                        $type,
                                    );
                                    if ($result == null) {
                                        throw new Exception(
                                            'This grade doesn\'t have any rule, Please set rule for this.',
                                            203,
                                        );
                                    }

                                    // $totalNumber = $this->theory + $this->mcq + $this->practical;
                                    // $e = $result->gradingRules->where('point', '<=', $totalNumber)->first();

                                    // Find the nearest smaller point
                                    $nearest_small = DB::table('grading_rules')
                                        ->where('point', '<=', $pointEach)
                                        ->orderBy('point', 'desc')
                                        ->first();

                                    // Find the nearest larger point
                                    $nearest_large = DB::table('grading_rules')
                                        ->where('point', '>', $pointEach)
                                        ->orderBy('point', 'asc')
                                        ->first();

                                    // echo '<span class="font-bold">' . $nearest_small?->grade ?? 'N/A' . '</span>';
                                    //     PHP_EOL;
                                    // echo '<span class="font-bold"> Nearest larger point:</span> ' .
                                    //     json_encode($nearest_large?->grade) .
                                    //     PHP_EOL;

                                @endphp
                                <span class="font-bold">{{ $nearest_small?->grade ?? 'N/A' }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class=" text-center">{{ __('No students found') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>
</div>
@push('page-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.2/jQuery.print.min.js"
        integrity="sha512-t3XNbzH2GEXeT9juLjifw/5ejswnjWWMMDxsdCg4+MmvrM+MwqGhxlWeFJ53xN/SBHPDnW0gXYvBx/afZZfGMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('#print').on('click', function() {
            $.print("#table");
        });
    </script>
@endpush
