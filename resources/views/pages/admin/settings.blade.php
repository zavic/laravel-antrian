<x-app-layout title="Pengaturan Aplikasi">
    @session('success')
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endsession

    <form action="{{ route('update-app-settings') }}" method="post">
        @method('PUT')
        @csrf
        <div class="mb-3 row">
            <label for="loket_is_enabled" class="col-sm-2 col-form-label">Loket</label>
            <div class="col-sm-10">
                <select class="form-select" id="loket_is_enabled" name="loket_is_enabled">
                    <option value="0" @if ($settings->loket_is_enabled) selected @endif>Tidak Aktif</option>
                    <option value="1" @if ($settings->loket_is_enabled) selected @endif>Aktif</option>
                </select>
                @error('loket_is_enabled')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
    
        <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
    </form>
</x-app-layout>
