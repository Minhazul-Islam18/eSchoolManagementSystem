<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ '/storage/' . setting('favicon') }}" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @inertiaHead

    <!-- Font Solaimanlipi-->
    <link href="https://fonts.maateen.me/solaiman-lipi/font.css" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body {
            font-family: 'SolaimanLipi', Arial, sans-serif !important;
        }
    </style>
</head>

<body class="">
    {{-- <div id="app"> --}}
    @inertia
    {{-- </div> --}}
</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dropdownButton = document.getElementById('dropdown-button');
        const dropdownMenu = document.getElementById('dropdown-menu');

        const mobileDropdownButton = document.getElementById('mobile-dropdown-button');
        const mobileDropdownMenu = document.getElementById('mobile-dropdown-menu');

        dropdownButton.addEventListener('click', () => {
            dropdownMenu.classList.toggle('hidden');
        });
        mobileDropdownButton.addEventListener('click', () => {
            mobileDropdownMenu.classList.toggle('hidden');
        });

        // Close the dropdown when clicking outside of it
        document.addEventListener('click', (event) => {
            if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });

        // Close the dropdown when clicking outside of it
        document.addEventListener('click', (event) => {
            if (!mobileDropdownButton.contains(event.target) && !mobileDropdownMenu.contains(event
                    .target)) {
                mobileDropdownMenu.classList.add('hidden');
            }
        });
    });
</script>


</html>
