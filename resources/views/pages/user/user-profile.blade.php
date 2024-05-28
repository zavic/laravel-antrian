@if (auth()->user()->role === 'ADMIN' || auth()->user()->role === 'STAFF')
    <x-app-layout title="Profil Saya">
        <h2 class="border-bottom mb-4 pb-2">Profil Saya</h2>
        @session('success')
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endsession
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="m-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <h4 class="mb-3">Informasi Pribadi</h4>
        <form action="{{ route('user-profile-update') }}" method="post">
            @method('PUT')
            @csrf
            <div class="mb-3 row">
                <label for="name" class="col-sm-2 col-form-label">Nama Lengkap</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name='name' value="{{ $user->name }}" required>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" value="{{ $user->email }}" required>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="phone" class="col-sm-2 col-form-label">{{ __('Nomor WhatsApp') }}</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <span class="input-group-text" id="phone">+62</span>
                        <input id="phone" name="phone" type="number"
                            class="form-control no-spinner @error('phone') is-invalid @enderror"
                            aria-describedby="phone" value="{{ $user->phone }}" required>
                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="address" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" required>{{ $user->address }}</textarea>
                    @error('address')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
        </form>

        <hr>

        <h4 class="mt-4 mb-3">Atur Ulang Kata Sandi</h4>
        <form method="POST" action="{{ route('user-reset-password') }}">
            @csrf

            <input type="email" value="{{ $user->email }}" hidden>

            <div class="mb-3 row">
                <label for="password_old" class="col-sm-2 col-form-label">Kata Sandi Saat ini</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control @error('password_old') is-invalid @enderror"
                        id="password_old" name='password_old' required autocomplete="current-password">
                    @error('password_old')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="password" class="col-sm-2 col-form-label">Kata Sandi Baru</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        name='password' required>
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="password-confirm" class="col-sm-2 col-form-label">Konfirmasi Kata Sandi Baru</label>
                <div class="col-sm-10">
                    <input class="form-control" type="password" id="password-confirm" name="password_confirmation"
                        required autocomplete="new-password">
                </div>
            </div>

            <button class="btn btn-primary" type="submit">Atur Ulang Kata Sandi</button>
        </form>
    </x-app-layout>
@else
    <x-guest-layout title="Profil Saya">
        <h2 class="border-bottom mb-4 pb-2">Profil Saya</h2>
        @session('success')
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endsession
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="m-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <h4 class="mb-3">Informasi Pribadi</h4>
        <form action="{{ route('user-profile-update') }}" method="post">
            @method('PUT')
            @csrf
            <div class="mb-3 row">
                <label for="name" class="col-sm-2 col-form-label">Nama Lengkap</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name='name' value="{{ $user->name }}" required>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" value="{{ $user->email }}" required>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="phone" class="col-sm-2 col-form-label">{{ __('Nomor WhatsApp') }}</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <span class="input-group-text" id="phone">+62</span>
                        <input id="phone" name="phone" type="number"
                            class="form-control no-spinner @error('phone') is-invalid @enderror"
                            aria-describedby="phone" value="{{ $user->phone }}" required>
                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="address" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" required>{{ $user->address }}</textarea>
                    @error('address')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
        </form>

        <hr>
        
        <h4 class="mt-4 mb-3">Atur Ulang Kata Sandi</h4>
        <form method="POST" action="{{ route('user-reset-password') }}">
            @csrf

            <input type="email" value="{{ $user->email }}" hidden>

            <div class="mb-3 row">
                <label for="password_old" class="col-sm-2 col-form-label">Kata Sandi Saat ini</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control @error('password_old') is-invalid @enderror"
                        id="password_old" name='password_old' required autocomplete="current-password">
                    @error('password_old')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="password" class="col-sm-2 col-form-label">Kata Sandi Baru</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        name='password' required>
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="password-confirm" class="col-sm-2 col-form-label">Konfirmasi Kata Sandi Baru</label>
                <div class="col-sm-10">
                    <input class="form-control" type="password" id="password-confirm" name="password_confirmation"
                        required autocomplete="new-password">
                </div>
            </div>

            <button class="btn btn-primary" type="submit">Atur Ulang Kata Sandi</button>
        </form>
    </x-guest-layout>
@endif
