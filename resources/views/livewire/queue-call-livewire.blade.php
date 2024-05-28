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

    @if ($loket_selected)
        <h3 class="mt-4 fw-bold">Loket {{ $loket_selected }}</h3>
    @endif
    
    @if ($queue_next)
        <p class="m-0">Jumlah antrian {{ $queue_next_length }}</p>
        @if ($queue_calling)
            <p class="m-0">Progress {{ round(($queue_calling->queue_number / $queue_next_length) * 100) }}%</p>
        @else
            <p class="m-0">Progress 0%</p>
        @endif
    @endif

    <h4 class="mt-4">Antrian Selanjutnya</h4>
    <div class="table-responsive">

        <table class="table table-hover">
            <thead>
                <tr>
                    <th colspan="2"></th>
                    <th>Nomor Antrian</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No. Telp</th>
                </tr>
            </thead>
            <tbody>

                @if ($queue_next)
                    <tr>
                        <td>Loket {{ $queue_next->loket }}</td>
                        <td>:</td>
                        <td>{{ $queue_next->queue_number }}</td>
                        <td>{{ $queue_next->name }}</td>
                        <td>{{ $queue_next->address }}</td>
                        <td>{{ $queue_next->phone }}%</td>
                    </tr>
                @else
                    <tr>
                        <td colspan="6">
                            Kosong
                        </td>
                    </tr>
                @endif



            </tbody>
        </table>
    </div>


    @if ($queue_next)
        <button class="btn btn-primary mt-2" wire:click="queueCall({{ $queue_next->id }})">Panggil
            Antrian
        </button>
    @else
        <button class="btn btn-primary mt-2" disabled>Panggil
            Antrian
        </button>
    @endif

    <h4 class="mt-5">Antrian Sedang Dipanggil</h4>
    <div class="table-responsive">

        <table class="table table-hover">
            <thead>
                <tr>
                    <th colspan="2"></th>
                    <th>Nomor Antrian</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No. Telp</th>
                </tr>
            </thead>
            <tbody>

                @if ($queue_calling)
                    <tr>
                        <td>Loket {{ $queue_calling->loket }}</td>
                        <td>:</td>
                        <td>{{ $queue_calling->queue_number }}</td>
                        <td>{{ $queue_calling->name }}</td>
                        <td>{{ $queue_calling->address }}</td>
                        <td>{{ $queue_calling->phone }}%</td>
                    </tr>
                @else
                    <tr>

                        <td colspan="6">
                            Belum ada antrian yang dipanggil
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
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
