<div>
    <p>{{ $queue_date_display }}</p>

    <div class="table-responsive">

        <table class="table table-hover" wire:poll.7s='update'>
            <thead>
                <tr>
                    <th colspan="2"></th>
                    <th>Nomor Antrian</th>
                    <th>Nama</th>
                    <th>Jumlah Antrian</th>
                    <th>Progress</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($lokets as $index => $item)
                    @if ($item)
                        <tr>
                            <td>Loket {{ $item->loket }} - {{ $loket_name[$index] }}</td>
                            <td>:</td>
                            <td>{{ $item->queue_number }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $queue_length[$index] }}</td>
                            <td>{{ $item->queue_number / $queue_length[$index] * 100 }}%</td>
                        </tr>
                        @else
                        <tr>
                            <td>Loket {{ $index + 1 }} - {{ $loket_name[$index] }}</td>
                            <td>:</td>
                            <td>(Belum ada yang dipanggil)</td>
                            <td>-</td>
                            <td>{{ $queue_length[$index] }}</td>
                            <td>-</td>
                        </tr>
                    @endif
                @endforeach

            </tbody>
        </table>
    </div>

</div>
