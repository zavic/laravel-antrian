@props(['title'])

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Aplikasi Antrian cocok untuk tempat umum yang ramai menjadi lebih nyaman">

    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">

    <title>{{ isset($title) ? $title . ' | ' : '' }} {{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>

<body>

    @include('layouts.partials.guest.navbar')

    <main>

        <div class="container px-4">

            {{ $slot }}

        </div>
    </main>

    @include('layouts.partials.guest.footer')

</body>

</html>
