<div class="sidebar border col-md-3 col-lg-2 p-0 bg-body-tertiary">
    <div class="offcanvas-md offcanvas-start" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
        <div class="offcanvas-header">
            <h4 class="offcanvas-title fw-bold" id="sidebarMenuLabel">
                {{ config('app.name', 'Laravel') }}</h4>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-md-flex flex-column p-0 overflow-y-auto">
            <ul class="nav flex-column pt-lg-2">
                <li class="nav-item">
                    <a class="nav-link d-flex gap-2 @if (request()->routeIs('dashboard')) active @endif"
                        href="{{ route('dashboard') }}">
                        <i class="bi bi-house"></i>
                        Dashboard
                    </a>
                </li>
                <h6
                    class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-3 mb-1 text-body-secondary text-uppercase">
                    <span>Antrian</span>
                </h6>
                <li class="nav-item">
                    <a class="nav-link d-flex gap-2 @if (request()->routeIs('queue-list')) active @endif"
                        href="{{ route('queue-list') }}">
                        <i class="bi bi-list-ol"></i>
                        List Antrian
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex gap-2 @if (request()->routeIs('queue-add')) active @endif"
                        href="{{ route('queue-add') }}">
                        <i class="bi bi-plus-square"></i>
                        Tambah Antrian
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex gap-2 @if (request()->routeIs('queue-call')) active @endif"
                        href="{{ route('queue-call') }}">
                        <i class="bi bi-megaphone"></i>
                        Panggil Antrian
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex gap-2 @if (request()->routeIs('queue-monitor')) active @endif"
                        href="{{ route('queue-monitor') }}">
                        <i class="bi bi-window-fullscreen"></i>
                        Layar Antrian
                    </a>
                </li>
                @if (App\Models\AppSetting::find(1)->loket_is_enabled)
                    <li class="nav-item">
                        <a class="nav-link d-flex gap-2 @if (request()->routeIs('queue-loket')) active @endif"
                            href="{{ route('queue-loket') }}">
                            <i class="bi bi-columns-gap"></i>
                            Loket Antrian
                        </a>
                    </li>
                @endif
            </ul>

            @if (auth()->user()->role === 'ADMIN')
                <h6
                    class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-3 mb-1 text-body-secondary text-uppercase">
                    <span>Users</span>
                </h6>
                <ul class="nav flex-column mb-auto">
                    <li class="nav-item">
                        <a class="nav-link d-flex gap-2 @if (request()->routeIs('user-list')) active @endif"
                            href="{{ route('user-list') }}">
                            <i class="bi bi-person-lines-fill"></i>
                            List Users
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex gap-2 @if (request()->routeIs('uset-create')) active @endif"
                            href="{{ route('user-create') }}">
                            <i class="bi bi-person-fill-add"></i>
                            Tambah User
                        </a>
                    </li>
                </ul>
            @endif

            <hr class="my-3">

            <ul class="nav flex-column mb-auto">
                @if (auth()->user()->role === 'ADMIN')
                    <li class="nav-item">
                        <a class="nav-link d-flex gap-2 @if (request()->routeIs('app-settings')) active @endif"
                            href="{{ route('app-settings') }}">
                            <i class="bi bi-tools"></i>
                            Pengaturan Aplikasi
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link d-flex gap-2 @if (request()->routeIs('user-profile')) active @endif"
                        href="{{ route('user-profile') }}">
                        <i class="bi bi-person-fill"></i>
                        Profil Saya
                    </a>
                </li>
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="nav-link d-flex gap-2">
                            <i class="bi bi-door-open-fill"></i>
                            Keluar
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
