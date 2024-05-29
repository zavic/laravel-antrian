<?php

namespace App\Livewire\User;

use App\Models\Queue;
use App\Models\QueueLoket;
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

    public $isViewFilter = true;
    public $isViewAddress;
    public $isViewEdit;

    public $sortQueueNumber;
    public $sortName;
    public $sortQueueDate;
    public $sortStatus;

    public $edit_id;
    public $edit_queue_date;
    public $edit_queue_number;
    public $edit_loket;
    public $edit_name;
    public $edit_email;
    public $edit_phone;
    public $edit_address;

    public function viewFilter()
    {
        $this->isViewFilter = !$this->isViewFilter;
    }

    public function viewAddress()
    {
        $this->isViewAddress = !$this->isViewAddress;
    }

    public function changeName()
    {
        $this->reset('sortQueueDate', 'sortQueueNumber', 'sortStatus');
        $this->sortName = $this->sortName === 'ASC' ? 'DESC' : 'ASC';
    }

    public function changeQueueDate()
    {
        $this->reset('sortName', 'sortQueueNumber', 'sortStatus');
        $this->sortQueueDate = $this->sortQueueDate === 'ASC' ? 'DESC' : 'ASC';
    }

    public function changeQueueNumber()
    {
        $this->reset('sortName', 'sortQueueDate', 'sortStatus');
        $this->sortQueueNumber = $this->sortQueueNumber === 'ASC' ? 'DESC' : 'ASC';
    }

    public function changeStatus()
    {
        $this->reset('sortName', 'sortQueueDate', 'sortQueueNumber');
        $this->sortStatus = $this->sortStatus === 'ASC' ? 'DESC' : 'ASC';
    }

    public function resetFilter()
    {
        $this->reset([
            'isViewAddress',
            'isViewEdit',
            'sortQueueDate',
            'sortName',
            'sortQueueNumber',
            'sortStatus'
        ]);
    }

    public function editQueue($item)
    {
        $this->edit_id = $item['id'];
        $this->edit_queue_date = $item['queue_date'];
        $this->edit_queue_number = $item['queue_number'];
        $this->edit_name = $item['name'];
        $this->edit_email = $item['email'];
        $this->edit_phone = $item['phone'];
        $this->edit_address = $item['address'];

        $this->isViewEdit = true;
    }

    public function delete($id)
    {
        $queue = Queue::findOrFail($id);
        $queue->delete();

        return redirect()->route('user-my-queue')->with('success', 'Antrian Berhasil Dihapus');
    }

    public function save()
    {
        $queue = Queue::findOrFail($this->edit_id);

        $queue->update([
            'name' => $this->edit_name,
            'email' => $this->edit_email,
            'phone' => $this->edit_phone,
            'address' => $this->edit_address,
        ]);

        return redirect()->route('user-my-queue')->with('success', 'Antrian Berhasil Diperbaharui');
    }

    public function cancel()
    {
        $this->reset([
            'edit_queue_date',
            'edit_queue_number',
            'edit_name',
            'edit_email',
            'edit_phone',
            'edit_address',
            'isViewEdit'
        ]);
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

        $this->sortName === 'ASC' && $query->orderBy('name', 'ASC');
        $this->sortName === 'DESC' && $query->orderBy('name', 'DESC');

        $this->sortQueueDate === 'ASC' && $query->orderBy('queue_date', 'ASC');
        $this->sortQueueDate === 'DESC' && $query->orderBy('queue_date', 'DESC');

        $this->sortQueueNumber === 'ASC' && $query->orderBy('queue_number', 'ASC');
        $this->sortQueueNumber === 'DESC' && $query->orderBy('queue_number', 'DESC');

        $this->sortStatus === 'ASC' && $query->orderBy('is_called', 'ASC');
        $this->sortStatus === 'DESC' && $query->orderBy('is_called', 'DESC');


        $queues = $query->paginate(10);

        return view('livewire.user.my-queue-livewire', compact('queues', 'lokets'));
    }
}
