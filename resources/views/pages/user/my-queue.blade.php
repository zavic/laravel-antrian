<x-guest-layout title="Antrian Saya">
    @session('success')
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endsession

    @livewire('user.my-queue-livewire')

</x-guest-layout>
