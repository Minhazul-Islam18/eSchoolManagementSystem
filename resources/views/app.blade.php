<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @inertiaHead
</head>

<body class="">
    {{-- <header>
        <img src="/storage/{{ setting('logo') }}" alt="">
        <nav>
            <Link href="/">Home</Link>
        </nav>
    </header> --}}
    @inertia
</body>

</html>
