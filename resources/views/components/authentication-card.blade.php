<div class="min-h-screen flex flex-col sm:justify-center items-center py-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Pacifico&display=swap');
    </style>
    <img src="{{ asset('/backend/assets/images/App.png') }}" class="mw-[200px] w-auto h-[60px] mx-auto mb-3 mt-6"
        alt="">
    <h4 class=" text-center text-lg font-medium mt-1 mb-4" style="font-family: 'Pacifico', cursive;">
        {{ 'RCT\'S Education Management Software' }}</h4>
    <div class="w-full sm:max-w-md px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
