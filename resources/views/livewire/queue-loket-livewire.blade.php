<div>
    <div class="table-responsive">
        <table class="table table-striped table-hover table-responsive">
            <thead>
                <tr>
                    <th>No. Loket</th>
                    <th>Nama Loket</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lokets as $item)
                    @if ($edit_loket_id == $item->id)
                        <tr>
                            <td>{{ $item->loket_number }}</td>
                            <td>
                                <input wire:model='edit_name' type="text" class="form-control">
                            </td>

                            <td>
                                <button wire:click='update' class="btn btn-primary">
                                    <i class="bi bi-floppy me-1"></i>Simpan</button>
                                <button wire:click='cancel' class="btn btn-danger">
                                    <i class="bi bi-x-lg me-1"></i>Batal</button>
                            </td>
                        </tr>
                    @else
                        <tr>
                            <td>{{ $item->loket_number }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                <button wire:click='editLoket({{ $item }})' class="btn btn-primary">
                                    <i class="bi bi-pen me-1"></i>Edit</button>
                                @if ($loop->last)
                                    <button wire:click='delete({{ $item->id }})'
                                        wire:confirm.prompt="Are you sure?\n\nType DELETE to confirm|DELETE"
                                        class="btn btn-danger">
                                        <i class="bi bi-trash3 me-1"></i>Hapus</button>
                                @endif
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Tambah Loket
    </button>

    <!-- Modal Tambah Loket -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Loket</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit='store' method="post">
                    <div class="modal-body">
                        <div class="mb-3 row">
                            <label for="name" class="col-sm-3 col-form-label">Nomor Loket</label>
                            <div class="col-sm-9">
                                <input class="form-control" id="loket_number" value="{{ $latest_loket_number }}"
                                    disabled>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="name" class="col-sm-3 col-form-label">Nama Loket</label>
                            <div class="col-sm-9">
                                <input wire:model='add_name' type="text"
                                    class="form-control @error('name') is-invalid @enderror" id="name" required>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Tambah Loket</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
