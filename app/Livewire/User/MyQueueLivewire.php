<?php

namespace App\Livewire\User;

use App\Models\Queue;
use App\Models\QueueLoket;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class MyQueueLivewire extends Component
{

    #[Url(except: '')]
    public $from_date;

    #[Url(except: '')]
    public $to_date;

    #[Url(except: '')]
    public $loket;

    #[Url(except: '')]
    public $status = 0;

    public $isViewAddress = false;

    public $queueNumber;
    public $name;

    public function changeQueueNumber()
    {
        $this->name = null;
        if ($this->queueNumber === 'asc') {
            $this->queueNumber = 'desc';
        } else {
            $this->queueNumber = 'asc';
        }
    }

    public function changeName()
    {
        $this->queueNumber = null;
        if ($this->name === 'asc') {
            $this->name = 'desc';
        } else {
            $this->name = 'asc';
        }
    }

    public function resetAll()
    {
        $this->from_date = null;
        $this->to_date = null;
        $this->loket = null;
        $this->status = 0;
        $this->queueNumber = null;
    }

    public function viewAddress()
    {
        $this->isViewAddress = !$this->isViewAddress;
    }

    public function render()
    {
        $lokets = QueueLoket::all();

        $user_id = auth()->user()->id;

        $query = Queue::where('user_id', $user_id);

        if ($this->from_date && $this->to_date) {
            $query->whereBetween('queue_date', [$this->from_date, $this->from_date]);
        }

        if ($this->loket) {
            $query->where('loket', $this->loket);
        }

        if ($this->status !== 'all') {
            $query->where('is_called', $this->status);
        }

        if ($this->queueNumber === 'asc') {
            $query->orderBy('queue_number', 'ASC');
        }

        if ($this->queueNumber === 'desc') {
            $query->orderBy('queue_number', 'DESC');
        }

        if ($this->name === 'asc') {
            $query->orderBy('name', 'ASC');
        }

        if ($this->name === 'desc') {
            $query->orderBy('name', 'DESC');
        }

        $queues = $query->paginate(10);

        return view('livewire.user.my-queue-livewire', compact('queues', 'lokets'));
    }
}
