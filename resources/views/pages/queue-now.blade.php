<x-guest-layout title="Antrian Sekarang">
    <div class="d-flex align-items-center">
        <div class="spinner-grow spinner-grow-sm text-danger" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <h2 class="fw-bold m-0 ps-2">Antrian Sekarang</h2>
    </div>

    @livewire('queue-now-guest-livewire')
</x-guest-layout>
