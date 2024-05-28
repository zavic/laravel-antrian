<?php

namespace App\Livewire;

use App\Models\QueueLoket;
use Livewire\Component;

class QueueLoketLivewire extends Component
{
    public $latest_loket_number;
    public $add_name;

    public $edit_loket_id;
    public $edit_loket_number;
    public $edit_name;

    public function mount()
    {
        $this->latest_loket_number = QueueLoket::latest()->first()->loket_number + 1;
    }

    public function store()
    {
        QueueLoket::create([
            'loket_number' => $this->latest_loket_number,
            'name' => $this->add_name,
        ]);

        $this->reset('add_name');
    }

    public function editLoket($loket)
    {
        $this->edit_loket_id = $loket['id'];
        $this->edit_loket_number = $loket['loket_number'];
        $this->edit_name = $loket['name'];
    }

    public function cancel()
    {
        $this->edit_loket_id = NULL;
        $this->edit_loket_number = NULL;
        $this->edit_name = NULL;
    }

    public function update()
    {
        $loket = QueueLoket::findOrFail($this->edit_loket_id);

        $loket->update([
            'name' => $this->edit_name
        ]);

        $this->cancel();

    }

    public function delete($id)
    {
        $loket = QueueLoket::findOrFail($id);
        $loket->delete();

        return redirect()->route('queue-loket');
    }

    public function render()
    {
        $lokets = QueueLoket::all();

        return view('livewire.queue-loket-livewire', compact('lokets'));
    }
}
