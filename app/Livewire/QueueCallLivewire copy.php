<?php

namespace App\Livewire;

use App\Models\AppSetting;
use App\Models\Queue;
use App\Models\QueueLoket;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class QueueCallLivewire extends Component
{
    use WithPagination;

    public $date_selected;
    public $loket_selected;

    public function mount()
    {
        $this->date_selected = Carbon::now()->format('Y-m-d');
    }

    public function queueCall($id)
    {

        $loket_is_enabled = AppSetting::findOrFail(1);
        $now = Carbon::now();

        $queue = Queue::findOrFail($id);

        $queue->update([
            'is_called' => '1',
            'called_at' => $now
        ]);


        $this->dispatch('queue-called', $queue->queue_number, $loket_is_enabled->loket_is_enabled, $queue->loket)->self();
    }

    public function render()
    {
        $lokets = QueueLoket::all();
        $queues = Queue::where('queue_date', $this->date_selected)->where('loket', $this->loket_selected)->paginate(10);
        return view('livewire.queue-call-livewire', compact('queues', 'lokets'));
    }
}
