<footer class="container d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
    <p class="col-md-4 mb-0 ps-2 text-body-secondary">© 2024 {{ config('app.name', 'Laravel') }}</p>

    {{-- <a href="/"
        class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">

    </a> --}}

    <ul class="nav col-md-8 justify-content-end">
        <li class="nav-item"><a href="{{ route('home') }}" class="nav-link px-2 text-body-secondary">Beranda</a></li>
        <li class="nav-item">
            <a href="{{ route('user-create-queue') }}" class="nav-link px-2 text-body-secondary">
                Ambil Antrian
            </a>
        </li>
        @auth
            <li class="nav-item">
                <a href="{{ route('user-my-queue') }}" class="nav-link px-2 text-body-secondary">
                    Antrian Saya
                </a>
            </li>

        @endauth
        <li class="nav-item"><a href="{{ route('queue-now') }}" class="nav-link px-2 text-body-secondary">Cek Antrian
                Sekarang</a></li>
        <li class="nav-item"><a href="{{ route('about') }}" class="nav-link px-2 text-body-secondary">Tentang</a></li>
    </ul>
</footer>
