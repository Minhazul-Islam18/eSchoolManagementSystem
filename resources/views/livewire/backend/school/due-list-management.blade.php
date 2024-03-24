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
                <form wire:submit='getDueList' class="flex gap-4 justify-start items-end">
                    <div class="">
                        <label for="" class="form-label">Class</label>
                        <select wire:model.blur='class_id' class="form-select rounded" id="">
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
                    <button type="submit" class="px-12 py-2 bg-emerald-500/90 hover:bg-emerald-500 rounded-full"
                        wire:click="">Search</button>
                </form>
            </div>
            <button id="print" class="px-6 py-3 rounded-sm bg-sky-500 uppercase font-semibold mb-3">Print</button>
            <table class="min-w-full leading-normal" id="table">
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
                        <th scope="col" class="px-6 py-3">
                            Dues
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Total Due
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalDues = [];
                    @endphp
                    @foreach ($students as $i => $item)
                        @php
                            $totalDues[$item->id] = 0;
                        @endphp
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700" scope="row"
                            wire:key='{{ $i }}'>
                            <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $i + 1 }}</td>
                            <td
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                {{ $item->student_id }}</td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $item->name_en }}</td>
                            <td
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                {{ $item->roll }}</td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-left">
                                @if (!empty($item->fees))
                                    @foreach ($item->fees as $nf)
                                        @php
                                            $totalDues[$item->id] = $nf->pivot->due_amount;
                                        @endphp
                                        {{ 'Additional fee: ' . $nf->pivot->due_amount }}</br>
                                    @endforeach
                                @endif

                                @if (!empty($item->monthlyFees))
                                    @foreach ($item->monthlyFees as $mf)
                                        @php
                                            $totalDues[$item->id] += $mf->pivot->due_amount;
                                        @endphp
                                        {{ 'Monthly fee: ' . $mf->pivot->due_amount }}</br>
                                    @endforeach
                                @endif

                                @if (!empty($item->monthlyFees))
                                    @foreach ($item->admissionFees as $af)
                                        @php
                                            $totalDues[$item->id] += $af->pivot->due_amount;
                                        @endphp
                                        {{ 'Admission fee: ' . $af->pivot->due_amount }}</br>
                                    @endforeach
                                @endif
                            </td>
                            <td
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                {{ $totalDues[$item->id] }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- @foreach ($students as $item)
                {{ $item->name_en }}
                @foreach ($item->fees as $nf)
                    {{ 'Due' . $nf->pivot->due_amount }}</br>
                @endforeach
                @foreach ($item->monthlyFees as $mf)
                    {{ 'Due' . $mf->pivot->due_amount }}</br>
                @endforeach
                @foreach ($item->admissionFees as $af)
                    {{ 'Due' . $af->pivot->due_amount }}</br>
                @endforeach
            @endforeach --}}
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
