<?php

namespace App\Livewire;

use App\Models\QueueLoket;
use Livewire\Component;

class QueueLoketLivewire extends Component
{
    public $latest_loket_number = 1;
    public $add_name;

    public $edit_loket_id;
    public $edit_loket_number;
    public $edit_name;

    public function mount()
    {
        $latest_loket_number = QueueLoket::orderBy('loket_number', 'DESC')->first();
        $latest_loket_number && $this->latest_loket_number = $latest_loket_number->loket_number + 1;
    }

    public function store()
    {
        $text = escapeshellarg($this->add_name);
        $fileName = $this->latest_loket_number;
        $outputPath = storage_path('app/public/audio/loket/' . $fileName .'.mp3');

        $pythonPath = 'C:\Users\msayy\AppData\Local\Programs\Python\Python312\python'; // Pastikan path ini benar di sistem Anda
        $scriptPath = base_path('python/convert_tts.py');

        $command = "$pythonPath $scriptPath $text $outputPath";

        // Tambahkan pengecekan kesalahan
        $output = shell_exec($command . ' 2>&1');
        if (file_exists($outputPath)) {
            session()->flash('success', 'File audio berhasil disimpan.');
        } else {
            session()->flash('error', 'Gagal membuat file audio. Output: ' . $output);
        }

        QueueLoket::create([
            'loket_number' => $this->latest_loket_number,
            'name' => $this->add_name,
        ]);

        $this->reset();
        redirect()->route('queue-loket')->with('success', 'Loket berhasil Dibuat');
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
