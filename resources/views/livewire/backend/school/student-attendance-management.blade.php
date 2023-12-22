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
            <div>
                <h4 class="text-2xl mt-4 mb-2">Search for attendance sheat</h4>
                <form wire:submit='getAttendanceSheet' class="flex gap-4 justify-start items-end">
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
                            <select wire:model.blur='group_id' class="form-select rounded"
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
                            <select wire:model.blur='section_id' class="form-select rounded"
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
                        <label for="" class="form-label">Date</label>
                        <input wire:model.blur='attendance_date' type="date" class="form-input rounded"
                            id="">
                        @error('attendance_date')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit"
                        class="px-12 py-2 bg-emerald-500/90 hover:bg-emerald-500 rounded-full">Search</button>
                </form>
            </div>

            <img wire:loading wire:target='getAttendanceSheet'
                src="https://miro.medium.com/v2/resize:fit:1100/format:webp/1*TBQCEJX9IO3JAOLpuR0xjg.gif"
                alt="">
            <div class=" border-dashed border-4 rounded-lg py-8 px-4 mt-4 border-orange-400">
                @if ($attendanceSheat == true)
                    <livewire:attendance-sheat-table :data="$students" />
                @else
                    <h5 class=" text-orange-400 text-xl font-extrabold">{{ 'Please select dropdown steps!' }}</h5>
                @endif
            </div>

        </div>
    </main>
</div>
@push('page-style')
@endpush
@push('page-script')
    <script>
        document.addEventListener('livewire:init', function() {
            Livewire.on('presentSelected', event => {
                console.log(event[0].ids);
                // alert(event[0].ids);
                Livewire.dispatch('present-getting-ids', {
                    ids: event[0].ids
                });
            });

            Livewire.on('showAlert', event => {
                console.log(event[0].message);
                alert(event[0].message);
            });
        });
    </script>
@endpush
