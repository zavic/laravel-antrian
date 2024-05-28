<?php

namespace App\Livewire;

use App\Models\Queue;
use App\Models\QueueLoket;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class QueueNowGuestLivewire extends Component
{
    public $lokets;
    public $loket_name;
    public $queue_length;
    public $queue_date;
    public $queue_date_display;

    public function mount()
    {
        $this->queue_date = Carbon::now()->toDateString();
        $this->queue_date_display = Carbon::now()->isoFormat('dddd, D MMMM Y');

        $getLokets = QueueLoket::get();

        foreach ($getLokets as $index => $value) {
            $loket_number = $value->loket_number;

            $queue[$index] = Queue::where('queue_date', $this->queue_date)
                ->where('is_called', 1)
                ->where('loket', $loket_number)
                ->orderByDesc('called_at')
                ->first();

            $loket_name[$index] = QueueLoket::where('loket_number', $loket_number)->first()->name;

            $queue_length[$index] = Queue::where('queue_date', $this->queue_date)
                ->where('loket', $loket_number)->count();

        }

        $this->lokets = $queue;
        $this->loket_name = $loket_name;
        $this->queue_length = $queue_length;
    }

    public function update()
    {
        $this->queue_date = Carbon::now()->toDateString();
        $this->queue_date_display = Carbon::now()->isoFormat('dddd, D MMMM Y');

        $getLokets = QueueLoket::get();

        foreach ($getLokets as $index => $value) {
            $loket_number = $value->loket_number;

            $queue[$index] = Queue::where('queue_date', $this->queue_date)
                ->where('is_called', 1)
                ->where('loket', $loket_number)
                ->orderByDesc('called_at')
                ->first();

            $loket_name[$index] = QueueLoket::where('loket_number', $loket_number)->first()->name;

            $queue_length[$index] = Queue::where('queue_date', $this->queue_date)
                ->where('loket', $loket_number)->count();

        }

        $this->lokets = $queue;
        $this->loket_name = $loket_name;
        $this->queue_length = $queue_length;
    }

    public function render()
    {
        // dd($this->loket_name);
        return view('livewire.queue-now-guest-livewire');
    }
}
