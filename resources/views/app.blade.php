<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @inertiaHead

    <!-- Font Solaimanlipi-->
    <link href="https://fonts.maateen.me/solaiman-lipi/font.css" rel="stylesheet">
    <style>
        body {
            font-family: 'SolaimanLipi', Arial, sans-serif !important;
        }
    </style>
</head>

<body class="">
    @inertia
</body>

</html>
