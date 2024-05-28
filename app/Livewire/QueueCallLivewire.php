<?php

namespace App\Livewire;

use App\Models\AppSetting;
use App\Models\Queue;
use App\Models\QueueLoket;
use Carbon\Carbon;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class QueueCallLivewire extends Component
{
    use WithPagination;

    #[Url()]
    public $date_selected;

    #[Url()]
    public $loket_selected;

    public function mount()
    {
        // $this->date_selected = Carbon::now()->format('Y-m-d');
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
        $queue = Queue::where('queue_date', $this->date_selected)->where('loket', $this->loket_selected);
        $queue_next = $queue->where('is_called', 0)->orderBy('queue_number', 'ASC')->first();
        $queue_calling = Queue::where('queue_date', $this->date_selected)->where('loket', $this->loket_selected)->where('is_called', 1)->orderByDesc('called_at')->first();
        $queue_next_length = Queue::where('queue_date', $this->date_selected)->where('loket', $this->loket_selected)->count();
        return view('livewire.queue-call-livewire', compact('lokets', 'queue_next', 'queue_calling', 'queue_next_length'));
    }
}
