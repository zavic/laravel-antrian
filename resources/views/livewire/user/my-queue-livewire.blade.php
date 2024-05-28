<div>
    <div class="d-flex border-bottom mb-2 align-items-center justify-content-between">
        <div class="d-flex">
            <h2>Antrian Saya</h2>
            <div wire:loading class="spinner-border text-primary ms-3" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>

        <button wire:click='resetAll' class="btn btn-sm btn-primary"><i class="bi bi-arrow-clockwise"></i> Atur Ulang
            Penyaringan</button>

    </div>


    <div class="mb-3 row row-cols-2 row-cols-md-4">
        <div class="col">
            <label for="from_date" class="col-4 col-sm-3 col-form-label">Dari</label>
            <div class="col">
                <input wire:model.live.debounce.300ms='from_date' type="date" class="form-control" id="from_date"
                    min="{{ auth()->user()->created_at->format('Y-m-d') }}">
            </div>
        </div>
        <div class="col">
            <label for="to_date" class="col-4 col-sm-3 col-form-label">Sampai</label>
            <div class="col">
                <input wire:model.live.debounce.300ms='to_date' type="date" class="form-control" id="to_date"
                    min="{{ auth()->user()->created_at->format('Y-m-d') }}">
            </div>
        </div>
        @if (App\Models\AppSetting::findOrFail(1)->loket_is_enabled)
            <div class="col">
                <label for="loket" class="col-4 col-sm-3 col-form-label">Loket</label>
                <div class="col">
                    <select wire:model.live.debounce.300ms='loket' id="loket" class="form-select" required>
                        <option value="{{ false }}">Semua</option>
                        @foreach ($lokets as $item)
                            <option value="{{ $item->loket_number }}">{{ $item->loket_number }} - {{ $item->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>
        @endif
        <div class="col">
            <label for="status" class="col-4 col-sm-3 col-form-label">Status</label>
            <div class="col">
                <select wire:model.live.debounce.300ms='status' id="status" class="form-select" required>
                    <option value="all">Semua</option>
                    <option value="0">Belum dipanggil</option>
                    <option value="1">Sudah dipanggil</option>
                </select>
            </div>

        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover table-responsive">
            <thead>
                <tr>
                    <th>
                        <div class="d-flex">
                            <span wire:click='changeQueueNumber' role="button">
                                No. Antrian
                            </span>
                            <div class="ms-2">
                                <span wire:click='changeQueueNumber' role="button">
                                    @if ($queueNumber)
                                        @if ($queueNumber === 'asc')
                                            <i class="bi bi-chevron-up"></i>
                                        @endif
                                        @if ($queueNumber === 'desc')
                                            <i class="bi bi-chevron-down"></i>
                                        @endif
                                    @endif

                                </span>
                            </div>
                        </div>
                    </th>
                    <th>
                        <div class="d-flex">
                            <span wire:click='changeName' role="button">
                                Nama
                            </span>
                            <div class="ms-2">
                                <span wire:click='changeName' role="button">
                                    @if ($name)
                                        @if ($name === 'asc')
                                            <i class="bi bi-chevron-up"></i>
                                        @endif
                                        @if ($name === 'desc')
                                            <i class="bi bi-chevron-down"></i>
                                        @endif
                                    @endif

                                </span>
                            </div>
                        </div>
                    </th>
                    <th>
                        <div class="d-flex">
                            <a class="text-decoration-none nav-link" href="#">Alamat</a>
                            <div class="ms-2">
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
                    <th>Email</th>
                    <th>No. WhatsApp</th>
                    <th>Tanggal Antrian</th>
                    @if (App\Models\AppSetting::find(1)->loket_is_enabled)
                        <th>Loket</th>
                    @endif
                    <th>Status Panggilan</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($queues as $item)
                    <tr>
                        <td>{{ $item->queue_number }}</td>
                        <td>{{ $item->name }}</td>
                        @if ($isViewAddress)
                            <td>{{ $item->address }}</td>
                        @else
                            <td><span class="badge text-bg-secondary">Disembunyikan</span></td>
                        @endif
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
                                <a class="btn p-0" href="{{ route('queue-edit', $item->id) }}"><i
                                        class="bi bi-pen text-primary mx-1"></i></a>
                                {{-- <form action="{{ route('queue-destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn p-0" wire:confirm.prompt="Are you sure?\n\nType DELETE to confirm|DELETE"
                                        type="submit">
                                        <i class="bi bi-trash3 text-danger mx-1"></i></button>
                                </form> --}}
                                <button class="btn p-0" wire:click="delete({{ $item->id }})"
                                    wire:confirm.prompt="Are you sure?\n\nType DELETE to confirm|DELETE" type="submit">
                                    <i class="bi bi-trash3 text-danger mx-1"></i></button>

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
