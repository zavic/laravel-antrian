@props(['title'])

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Aplikasi Antrian cocok untuk tempat umum yang ramai menjadi lebih nyaman">

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">

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
