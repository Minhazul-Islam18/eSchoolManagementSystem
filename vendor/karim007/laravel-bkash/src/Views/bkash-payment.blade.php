<meta name="csrf-token" content="{{ csrf_token() }}" />

<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@if (config('bkash.sandbox') == true)
    <script id="myScript" src="https://scripts.sandbox.bka.sh/versions/1.2.0-beta/checkout/bKash-checkout-sandbox.js">
    </script>
@else
    {{--    This Commented Script for Live Production --}}
    <script id="myScript" src="https://scripts.pay.bka.sh/versions/1.2.0-beta/checkout/bKash-checkout.js"></script>
@endif

<div class="grid h-screen place-items-center">
    <img src="/storage/{{ setting('logo') }}" width="120px" alt="">
    <button class="px-6 py-2 from-pink-600 bg-gradient-to-t to-pink-500 flex gap-2" id="bKash_button"
        onclick="BkashPayment()">
        <svg xmlns="http://www.w3.org/2000/svg" height="auto" width="30"
            viewBox="-6.6741 -11.07275 57.8422 66.4365">
            <g fill="none">
                <path fill="#DF146E"
                    d="M42.31 44.291H2.182C.981 44.291 0 43.308 0 42.107V2.186C0 .982.981 0 2.182 0H42.31c1.203 0 2.184.982 2.184 2.186v39.921c0 1.201-.981 2.184-2.184 2.184" />
                <path fill="#FFF"
                    d="M31.894 24.251l-14.107-2.246 1.909 8.329zm.572-.682L21.374 8.16l-3.623 13.106zm-15.402-2.482L5.441 6.239l15.221 1.819zm-5.639-6.154l-6.449-6.08h1.695zm24.504 1.15L33.2 23.486l-4.426-6.118zM21.417 30.232l10.71-4.3.454-1.365zm-8.933 7.821l4.589-16.102 2.326 10.479zm24.099-21.914l-1.128 3.056 4.059-.07z" />
            </g>
        </svg>
        Pay with bKash
    </button>
</div>

@include('bkash::bkash-script')
