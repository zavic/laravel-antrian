<div>
    {{-- Title & button filter --}}
    <div id="top" class="d-flex mb-4 align-items-center justify-content-between">
        <div class="d-flex">
            <h2>Antrian Saya</h2>
            <div wire:loading class="spinner-border text-primary ms-3" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>

        <div class="justify-content-end">
            <button wire:click='viewFilter'
                class="btn @if ($isViewFilter) btn-primary @else btn-outline-primary @endif"><i
                    class="bi bi-funnel"></i> Filter</button>
            <button wire:click='resetFilter' class="btn btn-outline-primary"><i class="bi bi-arrow-counterclockwise"></i>
                Reset Filter</button>
        </div>
    </div>

    {{-- Filter --}}
    <div class="mb-3 p-3 rounded-3 border @if (!$isViewFilter) d-none @endif">
        <div class="row row-cols-2 row-cols-md-4">
            <div class="col mb-2">
                <label for="from_date" class="col-4 col-sm-3">Dari</label>
                <div class="col">
                    <input wire:model.live.debounce.300ms='from_date' type="date" class="form-control bg-white"
                        id="from_date" min="{{ auth()->user()->created_at->format('Y-m-d') }}">
                </div>
            </div>
            <div class="col mb-2">
                <label for="to_date" class="col-4 col-sm-3">Sampai</label>
                <div class="col">
                    <input wire:model.live.debounce.300ms='to_date' type="date" class="form-control bg-white" id="to_date"
                        min="{{ auth()->user()->created_at->format('Y-m-d') }}">
                </div>
            </div>
            @if (App\Models\AppSetting::findOrFail(1)->loket_is_enabled)
                <div class="col mb-2">
                    <label for="loket" class="col-4 col-sm-3">Loket</label>
                    <div class="col">
                        <select wire:model.live.debounce.300ms='loket' id="loket" class="form-select bg-white" required>
                            <option value="{{ false }}">Semua</option>
                            @foreach ($lokets as $item)
                                <option value="{{ $item->loket_number }}">{{ $item->loket_number }} -
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>
            @endif
            <div class="col mb-2">
                <label for="status" class="col-4 col-sm-3">Status</label>
                <div class="col">
                    <select wire:model.live.debounce.300ms='status' id="status" class="form-select bg-white" required>
                        <option value="all">Semua</option>
                        <option value="0">Belum dipanggil</option>
                        <option value="1">Sudah dipanggil</option>
                    </select>
                </div>

            </div>
        </div>
    </div>

    {{-- Edit --}}
    <div class="p-4 my-4 rounded-4 bg-white @if (!$isViewEdit) d-none @endif">
        <h4 class="fw-bold pb-2 border-bottom">Edit Antrian</h4>
        <div class="row">
            <label class="col-sm-3 col-form-label">Tanggal Antrian</label>
            <div class="col-sm-9 d-flex align-items-center p-0">
                <p class="my-0 ms-4">{{ $edit_queue_date }}</p>
            </div>
        </div>
        @if (App\Models\AppSetting::find(1)->loket_is_enabled)
            <div class="row">
                <label class="col-sm-3 col-form-label">Loket</label>
                <div class="col-sm-9 d-flex align-items-center p-0">
                    <p class="my-0 ms-4">{{ $edit_loket }}</p>
                </div>
            </div>
        @endif
        <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">No. Antrian</label>
            <div class="col-sm-9 d-flex align-items-center p-0">
                <p class="my-0 ms-4">{{ $edit_queue_number }}</p>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="name" class="col-sm-3 col-form-label">Nama</label>
            <div class="col-sm-9">
                <input wire:model='edit_name' type="name" class="form-control @error('name') is-invalid @enderror"
                    id="name" name="name" required>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="email" class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-9">
                <input wire:model='edit_email' type="email" class="form-control @error('email') is-invalid @enderror"
                    id="email" name="email" required>

            </div>
        </div>
        <div class="row mb-3">
            <label for="phone" class="col-sm-3 col-form-label">{{ __('Nomor WhatsApp') }}</label>
            <div class="col-sm-9">
                <div class="input-group">
                    <span class="input-group-text" id="phone">+62</span>
                    <input wire:model='edit_phone' id="phone" name="phone" type="number"
                        class="form-control no-spinner @error('phone') is-invalid @enderror" aria-describedby="phone"
                        required>
                </div>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="email" class="col-sm-3 col-form-label">Alamat</label>
            <div class="col-sm-9">
                <textarea wire:model='edit_address' class="form-control" rows="3"></textarea>
            </div>
        </div>

        <button wire:click='save' class="btn btn-primary">Simpan</button>
        <button wire:click='cancel' class="btn btn-danger">Batal</button>

    </div>


    <div class="table-responsive">
        <table class="table table-striped table-hover table-responsive">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>
                        <div class="d-flex">
                            <span wire:click='changeName' role="button">
                                Nama
                            </span>
                            <div class="ms-2">
                                <span wire:click='changeName' role="button">
                                    @if ($sortName)
                                        @if ($sortName === 'ASC')
                                            <i class="bi bi-chevron-up"></i>
                                        @endif
                                        @if ($sortName === 'DESC')
                                            <i class="bi bi-chevron-down"></i>
                                        @endif
                                    @endif
                                </span>
                            </div>
                        </div>
                    </th>
                    <th>
                        <div class="d-flex">
                            <span wire:click='changeQueueDate' role="button">
                                Tanggal Antrian
                            </span>
                            <div class="ms-2">
                                <span wire:click='changeQueueDate' role="button">
                                    @if ($sortQueueDate)
                                        @if ($sortQueueDate === 'ASC')
                                            <i class="bi bi-chevron-up"></i>
                                        @endif
                                        @if ($sortQueueDate === 'DESC')
                                            <i class="bi bi-chevron-down"></i>
                                        @endif
                                    @endif

                                </span>
                            </div>
                        </div>
                    </th>
                    @if (App\Models\AppSetting::find(1)->loket_is_enabled)
                        <th>Loket</th>
                    @endif
                    <th>
                        <div class="d-flex">
                            <span wire:click='changeQueueNumber' role="button">
                                No. Antrian
                            </span>
                            <div class="ms-2">
                                <span wire:click='changeQueueNumber' role="button">
                                    @if ($sortQueueNumber)
                                        @if ($sortQueueNumber === 'ASC')
                                            <i class="bi bi-chevron-up"></i>
                                        @endif
                                        @if ($sortQueueNumber === 'DESC')
                                            <i class="bi bi-chevron-down"></i>
                                        @endif
                                    @endif

                                </span>
                            </div>
                        </div>
                    </th>
                    <th>Email</th>
                    <th>No. WhatsApp</th>
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
                    <th>
                        <div class="d-flex">
                            <span wire:click='changeStatus' role="button">
                                Status Panggilan
                            </span>
                            <div class="ms-2">
                                <span wire:click='changeStatus' role="button">
                                    @if ($sortStatus)
                                        @if ($sortStatus === 'ASC')
                                            <i class="bi bi-chevron-up"></i>
                                        @endif
                                        @if ($sortStatus === 'DESC')
                                            <i class="bi bi-chevron-down"></i>
                                        @endif
                                    @endif

                                </span>
                            </div>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($queues as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->queue_date }}</td>
                        @if (App\Models\AppSetting::find(1)->loket_is_enabled)
                            <td>{{ $item->loket }}</td>
                        @endif
                        <td>{{ $item->queue_number }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->phone }}</td>
                        @if ($isViewAddress)
                            <td>{{ $item->address }}</td>
                        @else
                            <td><span class="badge text-bg-secondary">Disembunyikan</span></td>
                        @endif
                        <td>
                            @if ($item->is_called)
                                <span class="badge rounded-pill text-bg-success">Sudah dipanggil</span>
                            @else
                                <span class="badge rounded-pill text-bg-warning">Belum Dipanggil</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex">
                                <a href="#top" wire:click='editQueue({{ $item }})'
                                    class="btn btn-primary btn-sm me-1">
                                    <i class="bi bi-pen"></i>
                                </a>
                                <button wire:click='delete({{ $item->id }})'
                                    wire:confirm.prompt="Apakah kamu yakin ingin menghapus antrian ini?\n\nKetik HAPUS untuk Konfirmasi|HAPUS"
                                    class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash3"></i></button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9">Tidak Ada Antrian</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $queues->links() }}
</div>
