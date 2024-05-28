<div>

    <div class="d-flex">
        <div>
            <input wire:model.live.debounce.300ms='search' class="form-control" type="text" id="search"
                placeholder="Cari...">
        </div>


    </div>
    <div class="table-responsive">
        <table class="table table-striped table-hover table-responsive" id="user-list">
            <thead>
                <tr>
                    <th scope="col">
                        <div class="d-flex">

                            No

                            <div class="ms-2">
                                <i class="bi bi-chevron-down"></i>
                            </div>

                        </div>
                    </th>
                    <th>
                        <div class="d-flex">

                            Nama

                            {{-- <div class="ms-2">
                                <i class="bi bi-chevron-up"></i>
                            </div> --}}

                        </div>
                    </th>
                    <th scope="col">Role</th>
                    <th scope="col">
                        <div class="d-flex">
                            <a class="text-decoration-none nav-link" href="#">Alamat</a>
                            <div class="ms-3">
                                <span wire:click='viewAddress' role="button">
                                    @if ($isViewAddress)
                                        <i class="bi bi-eye-slash"></i>
                                        @else
                                        <i class="bi bi-eye"></i>
                                    @endif
                                </span>
                            </div>
                        </div>
                    </th>
                    <th scope="col">Email</th>
                    <th scope="col">No. WhatsApp</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $index => $item)
                    @if ($edit_user_id == $item->id)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><input type="text" wire:model='edit_name' class="form-control"></td>
                            <td><input type="text" wire:model='edit_role' class="form-control"></td>
                            <td><input type="text" wire:model='edit_address' class="form-control"></td>
                            <td><input type="text" wire:model='edit_email' class="form-control"></td>
                            <td><input type="text" wire:model='edit_phone' class="form-control"></td>
                            <td>
                                <div class="d-flex">
                                    <button wire:click='update' class="btn btn-sm btn-primary me-1">
                                        <i class="bi bi-floppy"></i></button>
                                    <button wire:click='cancel' class="btn btn-sm btn-danger">
                                        <i class="bi bi-x-lg"></i></button>
                                </div>
                            </td>
                        </tr>
                    @else
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->role }}</td>
                            @if ($isViewAddress)
                                <td>{{ $item->address }}</td>
                            @else
                                <td><span class="badge text-bg-secondary">Disembunyikan</span></td>
                            @endif
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>
                                <div class="d-flex">
                                    <button wire:click='editUser({{ $item }})'
                                        class="btn btn-primary btn-sm me-1">
                                        <i class="bi bi-pen"></i></button>
                                    <button wire:click='delete({{ $item->id }})'
                                        wire:confirm.prompt="Are you sure?\n\nType DELETE to confirm|DELETE"
                                        class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash3"></i></button>

                                </div>
                            </td>
                        </tr>
                    @endif

                @empty
                    <p>Tidak ada antrian</p>
                @endforelse
            </tbody>
        </table>

    </div>

</div>
