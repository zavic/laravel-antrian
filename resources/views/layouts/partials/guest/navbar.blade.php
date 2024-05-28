<nav class="navbar navbar-expand-lg bg-white mb-4 shadow-sm sticky-top  " aria-label="Eighth navbar example">
    <div class="container px-4">
        <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name', 'Laravel') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample07"
            aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample07">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link @if (request()->routeIs('user-create-queue')) active @endif" href="{{ route('user-create-queue') }}">Ambil Antrian</a>
                </li>
                @auth
                    <li class="nav-item">
                        <a class="nav-link @if (request()->routeIs('user-my-queue')) active @endif" href="{{ route('user-my-queue') }}">Antrian Saya</a>
                    </li>
                @endauth
                <li class="nav-item">
                    <a class="nav-link @if (request()->routeIs('queue-now')) active @endif" href="{{ route('queue-now') }}">Cek Antrian Sekarang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if (request()->routeIs('about')) active @endif" href="{{ route('about') }}">Tentang</a>
                </li>
            </ul>
            @auth
                <ul class="navbar-nav ms-auto">
                    <li class="dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end">
                            @admin
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a></li>
                            @endadmin
                            <li><a class="dropdown-item" href="{{ route('user-profile') }}">Profil Saya</a></li>
                            <li><a class="dropdown-item" href="{{ route('user-my-queue') }}">Antrian Saya</a></li>
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
            @endauth
            @guest

                <hr>
                <ul class="navbar-nav">
                    <li class="nav-item me-2">
                        <a class="btn" href="{{ route('login') }}">Masuk</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-primary" href="{{ route('register') }}">Daftar</a>
                    </li>
                </ul>
            @endguest

        </div>
    </div>
</nav>
