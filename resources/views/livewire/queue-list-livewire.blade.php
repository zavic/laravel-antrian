<div>
    <div class="mb-3 row">
        <div class="col">
            <label for="from_date" class="col-4 col-sm-3 col-form-label">Dari</label>
            <div class="col">
                <input wire:model.live='from_date' type="date" class="form-control" id="from_date">
            </div>
        </div>
        <div class="col">
            <label for="to_date" class="col-4 col-sm-3 col-form-label">Sampai</label>
            <div class="col">
                <input wire:model.live='to_date' type="date" class="form-control" id="to_date">
            </div>
        </div>
        @if (App\Models\AppSetting::find(1)->loket_is_enabled)
            <div class="col">
                <label for="loket" class="col-4 col-sm-3 col-form-label">Loket</label>
                <div class="col">
                    <input wire:model.live='loket' type="number" class="form-control" id="loket" min="1">
                </div>
            </div>
        @endif
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover table-responsive">
            <thead>
                <tr>
                    <th scope="col">No. Antrian</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Email</th>
                    <th scope="col">No. WhatsApp</th>
                    <th scope="col">Tanggal Antrian</th>
                    @if (App\Models\AppSetting::find(1)->loket_is_enabled)
                        <th scope="col">Loket</th>
                    @endif
                    <th scope="col">Status Panggilan</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($queues as $item)
                    <tr>
                        <td>{{ $item->queue_number }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->address }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->phone }}</td>
                        <td>{{ $item->queue_date }}</td>
                        @if (App\Models\AppSetting::find(1)->loket_is_enabled)
                            <td>{{ $item->loket }}</td>
                        @endif
                        <td>
                            @if ($item->is_called)
                                <span class="badge rounded-pill text-bg-success">Sudah dipanggil</span>
                            @else
                                <span class="badge rounded-pill text-bg-secondary">Belum Dipanggil</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex">

                                <a class="btn btn-primary btn-sm me-1" href="{{ route('queue-edit', $item->id) }}"><i
                                        class="bi bi-pen"></i></a>
                                <button class="btn btn-danger btn-sm" wire:click="delete({{ $item->id }})"
                                    wire:confirm.prompt="Are you sure?\n\nType DELETE to confirm|DELETE" type="submit">
                                    <i class="bi bi-trash3"></i></button>

                            </div>
                        </td>
                    </tr>
                @empty
                    <p>Tidak ada antrian</p>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $queues->links() }}
</div>
