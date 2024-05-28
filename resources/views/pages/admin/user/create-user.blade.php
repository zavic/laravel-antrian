<x-app-layout title="Tambah Pengguna">
    <form action="{{ route('user-store') }}" method="post">
        @csrf
        <div class="mb-3 row">
            <label for="role" class="col-sm-2 col-form-label">Role</label>
            <div class="col-sm-10">
                <select class="form-control" name="role" id="role">
                    <option>Pilih role</option>
                    <option value="USER">User</option>
                    <option value="STAFF">Staff</option>
                    <option value="ADMIN">Admin</option>
                </select>
                @error('role')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label">Nama Lengkap</label>
            <div class="col-sm-10">
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                    name='name' required>
                @error('name')
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
                        class="form-control no-spinner @error('phone') is-invalid @enderror" aria-describedby="phone"
                        value="{{ old('phone') }}" required>
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
                <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" required></textarea>
                @error('address')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <hr>
        <div class="mb-3 row">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                    name="email" required>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="password" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                    name="password" required>
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        {{-- <div class="mb-3 row">
            <label for="password-confirm" class="col-sm-2 col-form-label">Konfirmasi Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="password-confirm" name="password-confirmation" required>
            </div>
        </div> --}}


        <button class="btn btn-primary" type="submit">Tambah Antrian</button>
    </form>
</x-app-layout>
