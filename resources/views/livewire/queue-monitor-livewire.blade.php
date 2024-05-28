<div id="fullscreenElement" class="p-4 bg-white rounded-4 mb-5 shadow-sm">
    <div class="d-flex justify-content-end">
        <button id="toggleFullscreen" class="btn align-items-end">
            <i id="fullscreenIcon" class="bi bi-fullscreen"></i>
        </button>
    </div>
    <div class="container">
        <p class="h2 text-center fw-bold mt-3">{{ config('app.name', 'Laravel') }}</p>

        <p class="h5 text-center mt-5">{{ $queue_date_display }}</p>

        {{-- Waktu --}}
        <livewire:time>

            <div class="row row-cols-4 justify-content-around pt-4" wire:poll.4s='update'>



                @foreach ($lokets as $index => $item)
                    @if ($item)
                        <div class="col">
                            <div class="bg-light rounded-4 ">
                                <p class="fs-4 text-center pt-3">Loket {{ $item->loket }}</p>
                                <p class="fs-1 text-center fw-bold">{{ $item->queue_number }}</p>
                                <p class="fs-5 text-center pb-3">{{ $item->name }}</p>
                            </div>
                        </div>
                    @else
                        @if (App\Models\AppSetting::find(1)->loket_is_enabled)
                            <p class="mt-5 text-center">Belum ada antrian di loket {{ $index + 1 }} yang dipanggil
                            </p>
                        @else
                            <p class="mt-5 text-center">Belum ada antrian yang dipanggil</p>
                        @endif
                    @endif
                @endforeach
            </div>
    </div>
</div>

<script>
    const toggleFullscreenButton = document.getElementById('toggleFullscreen');
    const fullscreenIcon = document.getElementById('fullscreenIcon');
    const fullscreenElement = document.getElementById('fullscreenElement');
    const appName = document.getElementById('appName');

    toggleFullscreenButton.addEventListener('click', function() {
        if (document.fullscreenElement) {
            document.exitFullscreen();
        } else {
            fullscreenElement.requestFullscreen();
        }
    });

    document.addEventListener('fullscreenchange', updateFullscreenIcon);

    function updateFullscreenIcon() {
        if (document.fullscreenElement) {
            fullscreenIcon.classList.remove('bi-fullscreen');
            fullscreenIcon.classList.add('bi-fullscreen-exit');
        } else {
            appName.innerHTML = '';
            fullscreenIcon.classList.remove('bi-fullscreen-exit');
            fullscreenIcon.classList.add('bi-fullscreen');
        }
    }
</script>
