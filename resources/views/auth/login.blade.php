<x-guest-layout title="Login">

    <div class="container py-5">
        <div class="row justify-content-center py-5">
            <div class="col-md-8">

                <h2 class="text-center fw-bold mb-5">{{ config('app.name', 'Laravel') }}</h2>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email"
                                class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Masuk') }}
                            </button>

                            @if (Route::has('password.request'))
                                <a class="ms-2 link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                                    href="{{ route('password.request') }}">
                                    {{ __('Lupa Password?') }}
                                </a>
                            @endif
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-md-6 offset-md-4">
                            <span>Tidak punya akun?</span>
                            <a class="ms-1 link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                                href="{{ route('register') }}">
                                {{ __('Daftar') }}
                            </a>
                        </div>
                    </div>
                </form>

            </div>
        </div>
</x-guest-layout>
