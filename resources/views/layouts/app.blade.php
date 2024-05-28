@props(['title'])
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme='light'>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="/logo.svg" />
    <title>{{ isset($title) ? $title . ' | ' : '' }}{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>

    </style>

</head>

<body>


    <header class="navbar sticky-top bg-dark px-3 py-2 shadow">

        <ul class="nav p-0 m-0">
            <li class="nav-item">
                <button class="nav-link text-white me-2 d-md-none" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <i class="bi bi-list"></i>
                </button>
            </li>

            <a class="navbar-brand text-white fs-5 m-0" href="#">{{ config('app.name', 'Laravel') }}
            </a>




        </ul>

        <ul class="nav">
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link text-white dropdown-toggle" href="#" role="button"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                </a>

                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{ route('user-profile') }}">Profil Saya</a></li>
                    <li>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                Keluar
                            </button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>


    </header>

    <div class="container-fluid">
        <div class="row">
            @include('layouts.partials.app.sidebar')

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">{{ isset($title) ? $title : 'Dashboard' }}</h1>
                </div>
                {{ $slot }}
            </main>
        </div>
    </div>


</body>

</html>
