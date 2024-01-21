<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex items-center justify-center h-screen">
    <div class="w-[400px] rounded bg-slate-100 dark:bg-[#86d2f4] flex flex-col">
        <h3 class="text-2xl text-center font-bold border-b py-3 px-2 dark:text-white">{{ config('app.name') }}</h3>
        <ul class="content py-6 px-5">
            <li class=" text-lg dark:text-white flex items-center justify-between">
                <span>Transection amount:</span> {{ session()->get('invoice_amount_subtotal') }}
            </li>

            <li class=" text-lg dark:text-white flex items-center justify-between">
                <span>Processing fee:</span> {{ session()->get('processing_fee') }}
            </li>

            <li class=" text-lg dark:text-white flex items-center justify-between">
                <span>Total:</span> {{ session()->get('invoice_amount_total') }}
            </li>
        </ul>
        <div class=" flex justify-center items-center pt-2 border-t pb-5 gap-2">
            <span class="dark:text-white">Pay with:</span>
            <button class="px-8 py-1 border border-pink-500 rounded bg-white">
                <a href="{{ route('bkash-create-payment') }}" class=" flex items-center">
                    <span><span class="text-[#e2136e]">b</span>Kash</span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="-18.0015 -28.3525 156.013 170.115" height="30"
                        width="30">
                        <g fill="none">
                            <path fill="#D12053" d="M96.58 62.45l-53.03-8.31 7.03 31.6z" />
                            <path fill="#E2136E" d="M96.58 62.45L56.62 6.93 43.56 54.15z" />
                            <path fill="#D12053" d="M42.32 53.51L.45 0l54.83 6.55z" />
                            <path fill="#9E1638" d="M23.25 31.15L0 9.24h6.12z" />
                            <path fill="#D12053" d="M107.89 35.46l-9.84 26.69L82.1 40.09z" />
                            <path fill="#E2136E" d="M56.77 84.14l38.61-15.51L97 63.7z" />
                            <path fill="#9E1638" d="M25.89 113.41l16.54-58.02 8.39 37.75z" />
                            <path fill="#E2136E" d="M109.43 35.67l-4.06 11.02 14.64-.24z" />
                        </g>
                    </svg>
                </a>
            </button>
        </div>
    </div>
</body>

</html>
