<div>
    <main>
        <div class="container px-3 py-4" wire:ignore>
            <div class="flex flex-row justify-center sm:justify-start my-4">
                <span class="shadow-md px-2 py-3 bg-emerald-500 rounded">
                    <i data-lucide="arrow-right-left" class="w-10"></i>
                </span>
            </div>
            <table id="TableOfData" class="display" style="width: 100%">
                <thead class="bg-blue-500 border-none">
                    <tr>
                        <th class="text-white">ID</th>
                        <th class="text-white"></th>
                        <th class="text-white"></th>
                        <th class="text-white">Amount</th>
                        <th class="text-white">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transections as $key => $item)
                        <tr>
                            <td>
                                {{ $key + 1 }}
                            </td>
                            <td class=" flex gap-2 items-center">
                                <img src="{{ $item->logo }}" width="40px" alt="">
                                <div>
                                    <span class="block text-md font-semibold">Marchant: {{ $item->name }}</span>
                                    <span class="block text-sm font-medium">Payment ID:
                                        {{ $item->payment_id }}</span>
                                </div>
                            </td>
                            <td>
                                <span class="block text-md font-semibold">MSISDN:
                                    {{ $item->customer_msisdn }}</span>
                                <span class="block text-sm font-medium">Trx ID: {{ $item->trx_id }}</span>
                            </td>
                            <td>{{ $item->amount }}</td>
                            <td>
                                <span
                                    class="py-2 px-4 text-sm rounded {{ $item->transaction_status == 'Completed' ? 'bg-emerald-500 dark:text-white' : 'bg-slate-800 dark:text-white text-white' }}">
                                    {{ $item->transaction_status }}
                                </span>

                            </td>
                        </tr>
                    @endforeach

                </tbody>
                <tfoot class="bg-blue-500">
                    <tr>
                        <th class="text-white">ID</th>
                        <th class="text-white"></th>
                        <th class="text-white"></th>
                        <th class="text-white">Amount</th>
                        <th class="text-white">Status</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </main>
</div>
@push('page-style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.tailwindcss.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
@endpush
@push('page-script')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.tailwindcss.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script>
        new DataTable('#TableOfData', {
            responsive: true,
            retrieve: true,
            paging: true
        });
    </script>
@endpush
