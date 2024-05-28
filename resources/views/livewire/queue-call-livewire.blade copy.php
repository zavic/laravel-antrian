<div>
    <div class="mb-3 row">
        <div class="col">
            <label for="date_selected" class="col-form-label">Loket</label>
            <div class="col">
                <select wire:model.live='loket_selected' class="form-select" name="loket">
                    <option>Pilih Loket</option>
                    @foreach ($lokets as $item)
                        <option value="{{ $item->loket_number }}">{{ $item->loket_number }} - {{ $item->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col">
            <label for="date_selected" class="col-form-label">Tanggal Antrian</label>
            <div class="col">
                <input wire:model.live='date_selected' type="date" class="form-control" id="date_selected">
            </div>
        </div>
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
                    <th scope="col">Status Panggilan</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($queues as $item)
                    <tr>
                        <td>{{ $item->queue_number }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->address }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->phone }}</td>
                        <td>{{ $item->queue_date }}</td>
                        <td>
                            @if ($item->is_called)
                                <span class="badge rounded-pill text-bg-success">Sudah dipanggil</span>
                            @else
                                <span class="badge rounded-pill text-bg-secondary">Belum Dipanggil</span>
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-primary" wire:click="queueCall({{ $item->id }})">Panggil
                                Antrian</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mb-5">
        {{ $queues->links() }}
    </div>

    <audio id='startBell' src="{{ asset('storage/audio/antrian/startBell.mp3') }}"></audio>
    <audio id='audio' src="{{ asset('storage/audio/antrian/endBell.mp3') }}"></audio>

</div>

@script
    <script>
        $wire.on('queue-called', (value) => {


            // Audio Dinamis
            const audio = document.getElementById('audio');

            // Audio startBell
            const startBell = document.getElementById('startBell');

            // Angka
            const ribuan = value[0].toString().substr(-4, 1);
            const ratusan = value[0].toString().substr(-3, 1);
            const puluhan = value[0].toString().substr(-2, 1);
            const satuan = value[0].toString().substr(-1, 1);
            const sepuluhOrSebelas = value[0].toString().substr(-2, 2);
            let delay = 4000;

            function nomorStr(a, b) {
                const number = value[0].toString().substr(a, b);
                return number;
            }

            function puluhanPlay() {
                if (sepuluhOrSebelas == '10' || sepuluhOrSebelas == '11') {
                    audioPlay(nomorStr(-2, 2), delay = delay + 1500);
                    if (value[1] == 1) {
                        audioPlay('diloket', delay = delay + 1500)
                        audioPlay(value[2], delay = delay + 1500)
                    }
                    audioPlay('endBell', delay = delay + 1500);
                } else if (puluhan == '1') {
                    audioPlay(nomorStr(-1, 1), delay = delay + 2000);
                    audioPlay('belas', delay = delay + 1500);
                    if (value[1] == 1) {
                        audioPlay('diloket', delay = delay + 1500)
                        audioPlay(value[2], delay = delay + 1500)
                    }
                    audioPlay('endBell', delay = delay + 1500);
                } else if (puluhan != '0') {
                    audioPlay(nomorStr(-2, 1), delay = delay + 2000);
                    audioPlay('puluh', delay = delay + 1500);
                    if (satuan == 0) {
                        if (value[1] == 1) {
                            audioPlay('diloket', delay = delay + 1500)
                            audioPlay(value[2], delay = delay + 1500)
                        }
                        audioPlay('endBell', delay = delay + 1000);
                    } else {
                        audioPlay(nomorStr(-1, 1), delay = delay + 2000);
                        if (value[1] == 1) {
                            audioPlay('diloket', delay = delay + 1500)
                            audioPlay(value[2], delay = delay + 1500)
                        }
                        audioPlay('endBell', delay = delay + 1500);
                    }
                } else if (puluhan == '0') {
                    if (satuan == '0') {
                        if (value[1] == 1) {
                            audioPlay('diloket', delay = delay + 1500)
                            audioPlay(value[2], delay = delay + 1500)
                        }
                        audioPlay('endBell', delay = delay + 1500);
                    } else {
                        audioPlay(nomorStr(-1, 1), delay = delay + 1500);
                        if (value[1] == 1) {
                            audioPlay('diloket', delay = delay + 1500)
                            audioPlay(value[2], delay = delay + 1500)
                        }
                        audioPlay('endBell', delay = delay + 1500);
                    }
                } else {
                    if (value[1] == 1) {
                        audioPlay('diloket', delay = delay + 1500)
                        audioPlay(value[2], delay = delay + 1500)
                    }
                    audioPlay('endBell', delay = delay + 2000);
                }
            }

            function ratusanPlay() {
                if (ratusan == '1') {
                    audioPlay('seratus', delay = delay + 2000);
                } else if (ratusan == '0') {

                } else {
                    audioPlay(nomorStr(-3, 1), delay = delay + 2000);
                    audioPlay('ratus', delay = delay + 1500);
                }
            }

            function ribuanPlay() {
                if (ribuan == '1') {
                    audioPlay('seribu', delay = delay + 2000)
                } else if (ribuan == '0') {

                } else {
                    audioPlay(ribuan, delay = delay + 1500)
                    audioPlay('ribu', delay = delay + 1500)
                }
            }

            function audioPlay(suara, delay) {
                setTimeout(() => {
                    audio.setAttribute('src', "{{ asset('storage/audio/antrian') }}" + '/' + suara +
                        '.mp3');
                    audio.play();
                }, delay);
            }

            // Suara bel awal berbunyi
            startBell.play();

            if (value[0] < 10) {
                let delay = 4000
                audioPlay('noAntrian', delay)
                audioPlay(value[0], delay = delay + 2000)
                if (value[1] == 1) {
                    audioPlay('diloket', delay = delay + 1500)
                    audioPlay(value[2], delay = delay + 1500)
                }
                audioPlay('endBell', delay + 1000)
            } else if (value[0] > 9 && value[0] < 100) {
                let delay = 4000
                audioPlay('noAntrian', delay)
                puluhanPlay()
            } else if (value[0] > 99 && value[0] < 1000) {
                let delay = 4000
                audioPlay('noAntrian', delay)
                ratusanPlay()
                puluhanPlay()
            } else if (value[0] > 999 && value[0] < 10000) {
                let delay = 4000
                audioPlay('noAntrian', delay)
                ribuanPlay()
                ratusanPlay()
                puluhanPlay()
            }
        });
    </script>
@endscript
