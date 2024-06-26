<x-app-layout title="Tambah Antrian">
    <form action="{{ route('queue-store') }}" method="post">
        @csrf
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
        <div class="mb-3 row">
            <label for="queue_date" class="col-sm-2 col-form-label">Tanggal Antrian</label>
            <div class="col-sm-10">
                <input type="date" class="form-control @error('queue_date') is-invalid @enderror" id="queue_date"
                    name="queue_date" min="2024-05-16" max="2025-12-31" required>
                @error('queue_date')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        @if (App\Models\AppSetting::findOrFail(1)->loket_is_enabled)
            <div class="mb-3 row">
                <label for="loket" class="col-sm-2 col-form-label">Loket</label>
                <div class="col-sm-10">
                    <select class="form-select" name="loket">
                        <option>Pilih Loket</option>
                        @foreach ($lokets as $item)
                            <option value="{{ $item->loket_number }}">{{ $item->loket_number }} - {{ $item->name }}</option>
                        @endforeach
                    </select>
                    @error('loket')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        @endif
        <button class="btn btn-primary" type="submit">Tambah Antrian</button>
    </form>
</x-app-layout>
