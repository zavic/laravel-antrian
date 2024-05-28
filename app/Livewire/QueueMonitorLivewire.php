<?php

namespace App\Livewire;

use App\Models\QueueLoket;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class QueueMonitorLivewire extends Component
{
    public $lokets;
    public $queue_date;
    public $queue_date_display;

    public function mount()
    {
        $this->queue_date = Carbon::now()->toDateString();
        $this->queue_date_display = Carbon::now()->isoFormat('dddd, D MMMM Y');


        $lokets = QueueLoket::all();

        foreach ($lokets as $index => $value) {
            $loket_number = $value->loket_number;

            $queue[$index] = DB::table('queues')
            ->where('queue_date', $this->queue_date)
            ->where('is_called', 1)
            ->where('loket', $loket_number)
            ->orderByDesc('called_at')
            ->first();
        }

        $this->lokets = $queue;

    }

    public function update()
    {
        $this->queue_date = Carbon::now()->toDateString();
        $this->queue_date_display = Carbon::now()->isoFormat('dddd, D MMMM Y');


        $lokets = QueueLoket::all();

        foreach ($lokets as $index => $value) {
            $loket_number = $value->loket_number;

            $queue[$index] = DB::table('queues')
            ->where('queue_date', $this->queue_date)
            ->where('is_called', 1)
            ->where('loket', $loket_number)
            ->orderByDesc('called_at')
            ->first();
        }

        $this->lokets = $queue;

        // $this->queue_date = Carbon::now()->toDateString();
        // $this->queue_date_display = Carbon::now()->isoFormat('dddd, D MMMM Y');

        // $this->queues = DB::table('queues')
        //     // ->where('queue_date', $this->queue_date)
        //     ->where('is_called', 1)
        //     ->orderByDesc('called_at')
        //     ->first();
    }

    public function render()
    {
        return view('livewire.queue-monitor-livewire');
    }
}
