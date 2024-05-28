<?php

namespace App\Livewire;

use App\Models\Queue;
use Carbon\Carbon;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class QueueListLivewire extends Component
{
    use WithPagination;

    #[Url()]
    public $from_date;

    #[Url()]
    public $to_date;

    public $date_now;

    #[Url()]
    public $loket;

    public function mount()
    {
        $this->date_now = Carbon::now()->format('Y-m-d');
        // $this->from_date = $this->date_now;
        // $this->to_date = $this->date_now;

        $this->loket = 1;
    }

    public function delete($id)
    {
        $queue = Queue::findOrFail($id);
        $queue->delete();

        return redirect()->route('queue-list')->with('success', 'Antrian ' . $queue->name . ' Berhasil Dihapus');
    }


    public function render()
    {
        $queues = Queue::whereBetween('queue_date', [$this->from_date, $this->to_date])->where('loket', $this->loket)->paginate(10);
        return view('livewire.queue-list-livewire', compact('queues'));
    }
}
