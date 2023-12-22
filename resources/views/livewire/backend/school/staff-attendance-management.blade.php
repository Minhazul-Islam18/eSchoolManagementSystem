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
            <div class="my-4 relative h-[250px] flex items-center justify-center transition-all duration-200 ease-in-out"
                wire:loading wire:target='getAttendanceSheet'>
                <div class="loader">
                    <div class="cell d-0"></div>
                    <div class="cell d-1"></div>
                    <div class="cell d-2"></div>

                    <div class="cell d-1"></div>
                    <div class="cell d-2"></div>


                    <div class="cell d-2"></div>
                    <div class="cell d-3"></div>


                    <div class="cell d-3"></div>
                    <div class="cell d-4"></div>


                </div>
            </div>

            <div class=" border-dashed border-4 rounded-lg py-8 px-4 mt-4 border-orange-400">
                @if ($attendanceSheat == true)
                    <livewire:staff-attendance-sheat-table :data="$this->staffs" />
                @else
                    <h5 class=" text-orange-400 text-xl font-extrabold">{{ 'Please select dropdown steps!' }}</h5>
                @endif
            </div>

        </div>
    </main>
</div>
@push('page-style')
    <style>
        .loader {
            --cell-size: 52px;
            --cell-spacing: 1px;
            --cells: 3;
            --total-size: calc(var(--cells) * (var(--cell-size) + 2 * var(--cell-spacing)));
            display: flex;
            flex-wrap: wrap;
            width: var(--total-size);
            height: var(--total-size);
        }

        .cell {
            flex: 0 0 var(--cell-size);
            margin: var(--cell-spacing);
            background-color: transparent;
            box-sizing: border-box;
            border-radius: 4px;
            animation: 1.5s ripple ease infinite;
        }

        .cell.d-1 {
            animation-delay: 100ms;
        }

        .cell.d-2 {
            animation-delay: 200ms;
        }

        .cell.d-3 {
            animation-delay: 300ms;
        }

        .cell.d-4 {
            animation-delay: 400ms;
        }

        .cell:nth-child(1) {
            --cell-color: #00FF87;
        }

        .cell:nth-child(2) {
            --cell-color: #0CFD95;
        }

        .cell:nth-child(3) {
            --cell-color: #17FBA2;
        }

        .cell:nth-child(4) {
            --cell-color: #23F9B2;
        }

        .cell:nth-child(5) {
            --cell-color: #30F7C3;
        }

        .cell:nth-child(6) {
            --cell-color: #3DF5D4;
        }

        .cell:nth-child(7) {
            --cell-color: #45F4DE;
        }

        .cell:nth-child(8) {
            --cell-color: #53F1F0;
        }

        .cell:nth-child(9) {
            --cell-color: #60EFFF;
        }

        /*Animation*/
        @keyframes ripple {
            0% {
                background-color: transparent;
            }

            30% {
                background-color: var(--cell-color);
            }

            60% {
                background-color: transparent;
            }

            100% {
                background-color: transparent;
            }
        }
    </style>
@endpush
@push('page-script')
    <script>
        document.addEventListener('livewire:init', function() {
            Livewire.on('presentSelected', event => {
                console.log(event[0].ids);
                // alert(event[0].ids);
                Livewire.dispatch('present-getting-ids', {
                    ids: event[0].ids
                })
            });
        });
    </script>
@endpush
