<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url(https://fonts.bunny.net/css?family=alata:400);

        body {
            background-color: #f3f4f6;
            font-family: "Alata", sans-serif;
        }

        @media print {
            #invoice {
                position: relative;
            }

            #invoice::before {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-image: url('https://www.freepnglogos.com/uploads/wave-png/abstract-blue-top-wave-png-transparent-20.png');
                background-size: contain;
                background-repeat: no-repeat;
                background-position: top center;
                pointer-events: none;
                /* Ensure the overlay doesn't interfere with mouse events */
            }
        }
    </style>
</head>

<body>
    @php
        use App\Models\School;
        $school = School::where('user_id', auth()->user()->id)->firstOrFail();
    @endphp
    {{-- @dd($school, $upd) --}}

    <div class="max-w-3xl mx-auto p-6 bg-white rounded shadow-sm my-6" id="invoice" {{-- style="background-image: url('https://www.freepnglogos.com/uploads/wave-png/abstract-blue-top-wave-png-transparent-20.png');
            background-size: contain;
            background-repeat: no-repeat;
            background-position: top center;" --}}>

        <div class="grid grid-cols-2 items-center">
            <div>
                <!--  Company logo  -->
                <img src="/storage/{{ setting('logo') }}" alt="company-logo" height="100" width="100">
            </div>

            <div class="text-right">
                <p class=" capitalize">
                    {{ setting('site_title', config('app.name')) }}
                </p>
                <p class="text-gray-500 text-sm">
                    {{ setting('site_mail', 'sales@easyems.com') }}
                </p>
                <p class="text-gray-500 text-sm mt-1">
                    {{ setting('site_phone', '+8801714088522') }}
                </p>
                <p class="text-gray-500 text-sm mt-1">
                    {{ setting('address', '') }}
                </p>
            </div>
        </div>

        <!-- Client info -->
        <div class="grid grid-cols-2 items-center mt-8">
            <div>
                <p class="font-bold text-gray-800">
                    Bill to :
                </p>
                <p class="text-gray-500">
                    {{ $school->institute_name }}
                    <br />
                    {{ $school->institute_address }}
                </p>
                <p class="text-gray-500">
                    Mobile: {{ $school->mobile_no }}
                </p>
            </div>

            <div class="text-right">
                <p class="">
                    Invoice number:
                    <span class="text-gray-500">{{ $upd->merchant_invoice_number }}</span>
                </p>
                <p class="">
                    Transaction ID:
                    <span class="text-gray-500">{{ $upd->trx_id }}</span>
                </p>
                <p>
                    Invoice date: <span
                        class="text-gray-500">{{ Carbon\Carbon::parse($upd->created_at)->format('m-d-Y') }}</span>
                    <br />
                    Payment method:<span class="text-gray-500">Bkash</span>
                </p>
            </div>
        </div>

        <!-- Invoice Items -->
        <div class="-mx-4 mt-8 flow-root sm:mx-0 mb-3">
            <table class="min-w-full">
                <colgroup>
                    <col class="w-full sm:w-1/2">
                    <col class="sm:w-1/6">
                    <col class="sm:w-1/6">
                    <col class="sm:w-1/6">
                </colgroup>
                <thead class="border-b print:border-b border-gray-300 print:border-gray-300 text-gray-900">
                    <tr>
                        <th scope="col"
                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">SL No.</th>
                        <th scope="col"
                            class="hidden px-3 py-3.5 text-right text-sm font-semibold text-gray-900 sm:table-cell">
                            Description</th>
                        <th scope="col"
                            class="py-3.5 pl-3 pr-4 text-right text-sm font-semibold text-gray-900 sm:pr-0">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-y border-gray-200">
                        <td class="max-w-0 py-5 pl-4 pr-3 text-sm sm:pl-0">
                            <div class="font-medium text-gray-900">1</div>
                        </td>
                        <td class="hidden px-3 py-5 text-right text-sm text-gray-500 sm:table-cell">
                            {{ $upd->package->name }}
                        </td>
                        <td class="py-5 pl-3 pr-4 text-right text-sm text-gray-500 sm:pr-0">
                            {{ session()->get('invoice_amount_subtotal') }}
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th scope="row" colspan="3"
                            class="hidden pl-4 pr-3 pt-6 text-right text-sm font-normal text-gray-500 sm:table-cell sm:pl-0">
                            Subtotal</th>
                        <th scope="row" class="pl-6 pr-3 pt-6 text-left text-sm font-normal text-gray-500 sm:hidden">
                            Subtotal</th>
                        <td class="pl-3 pr-6 pt-6 text-right text-sm text-gray-500 sm:pr-0">
                            {{ session()->get('invoice_amount_subtotal') }}</td>
                    </tr>
                    <tr>
                        <th scope="row" colspan="3"
                            class="hidden pl-4 pr-3 pt-4 text-right text-sm font-normal text-gray-500 sm:table-cell sm:pl-0">
                            Fee</th>
                        <th scope="row" class="pl-6 pr-3 pt-4 text-left text-sm font-normal text-gray-500 sm:hidden">
                            Fee</th>
                        <td class="pl-3 pr-6 pt-4 text-right text-sm text-gray-500 sm:pr-0">
                            {{ session()->get('processing_fee') }}</td>
                    </tr>
                    {{-- <tr>
                        <th scope="row" colspan="3"
                            class="hidden pl-4 pr-3 pt-4 text-right text-sm font-normal text-gray-500 sm:table-cell sm:pl-0">
                            Discount</th>
                        <th scope="row" class="pl-6 pr-3 pt-4 text-left text-sm font-normal text-gray-500 sm:hidden">
                            Discount</th>
                        <td class="pl-3 pr-6 pt-4 text-right text-sm text-gray-500 sm:pr-0">- 10%</td>
                    </tr> --}}
                    <tr>
                        <th scope="row" colspan="3"
                            class="hidden pl-4 pr-3 pt-4 text-right text-sm font-semibold text-gray-900 sm:table-cell sm:pl-0">
                            Total</th>
                        <th scope="row"
                            class="pl-6 pr-3 pt-4 text-left text-sm font-semibold text-gray-900 sm:hidden">Total</th>
                        <td class="pl-3 pr-4 pt-4 text-right text-sm font-semibold text-gray-900 sm:pr-0">
                            {{ session()->get('invoice_amount_total') }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!--  Footer  -->
        {{-- <div class="border-t-2 pt-4 text-xs text-gray-500 text-center mt-16">
            Please pay the invoice before the due date. You can pay the invoice by logging in to your account from our
            client portal.
        </div> --}}

    </div>
    <div class="flex justify-center items-center mt-5 mb-2">
        <button class="my-4 px-6 py-4 rounded bg-sky-500 flex gap-2" onclick="printDiv('invoice')">
            Print Now
            <span>
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" height="auto"
                    width="20px">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M16 6H8C5.17157 6 3.75736 6 2.87868 6.87868C2 7.75736 2 9.17157 2 12C2 14.8284 2 16.2426 2.87868 17.1213C3.37323 17.6159 4.03743 17.8321 5.02795 17.9266C4.99998 17.2038 4.99999 15.3522 5 14.5C4.72386 14.5 4.5 14.2761 4.5 14C4.5 13.7239 4.72386 13.5 5 13.5H19C19.2761 13.5 19.5 13.7239 19.5 14C19.5 14.2761 19.2761 14.5003 19 14.5003C19 15.3525 19 17.2039 18.9721 17.9266C19.9626 17.8321 20.6268 17.6159 21.1213 17.1213C22 16.2426 22 14.8284 22 12C22 9.17157 22 7.75736 21.1213 6.87868C20.2426 6 18.8284 6 16 6ZM9 10.75C9.41421 10.75 9.75 10.4142 9.75 10C9.75 9.58579 9.41421 9.25 9 9.25H6C5.58579 9.25 5.25 9.58579 5.25 10C5.25 10.4142 5.58579 10.75 6 10.75H9ZM17 11C17.5523 11 18 10.5523 18 10C18 9.44772 17.5523 9 17 9C16.4477 9 16 9.44772 16 10C16 10.5523 16.4477 11 17 11Z"
                        fill="#1C274C" />
                    <path
                        d="M17.1211 2.87868C16.2424 2 14.8282 2 11.9998 2C9.17134 2 7.75712 2 6.87844 2.87868C6.38608 3.37105 6.16961 4.03157 6.07444 5.01484C6.63368 4.99996 7.25183 4.99998 7.92943 5H16.0706C16.748 4.99998 17.366 4.99996 17.9251 5.01483C17.8299 4.03156 17.6135 3.37105 17.1211 2.87868Z"
                        fill="#1C274C" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M18 14.5C18 17.3284 18 20.2426 17.1213 21.1213C16.2426 22 14.8284 22 12 22C9.17158 22 7.75736 22 6.87868 21.1213C6 20.2426 6 17.3284 6 14.5H18ZM15.75 16.75C15.75 17.1642 15.4142 17.5 15 17.5H9C8.58579 17.5 8.25 17.1642 8.25 16.75C8.25 16.3358 8.58579 16 9 16H15C15.4142 16 15.75 16.3358 15.75 16.75ZM13.75 19.75C13.75 20.1642 13.4142 20.5 13 20.5H9C8.58579 20.5 8.25 20.1642 8.25 19.75C8.25 19.3358 8.58579 19 9 19H13C13.4142 19 13.75 19.3358 13.75 19.75Z"
                        fill="#1C274C" />
                </svg>
            </span>
        </button>
    </div>
    <script>
        function onclick(event) {
            printDiv('invoice');
        }

        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            // Create a style tag and set the CSS for landscape orientation
            var style = document.createElement('style');
            style.innerHTML = '@page { size: landscape; }';

            // Append the style tag to the document head
            document.head.appendChild(style);

            document.body.innerHTML = printContents;

            // Trigger the print dialog
            window.print();

            // Remove the added style tag and restore the original contents
            document.head.removeChild(style);
            document.body.innerHTML = originalContents;
        }
    </script>
</body>

</html>
