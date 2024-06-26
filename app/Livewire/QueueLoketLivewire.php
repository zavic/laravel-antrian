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
        $text = $this->add_name;
        $fileName = $this->latest_loket_number;
        $outputPath = storage_path('app/public/audio/loket/' . $fileName . '.mp3');
        $outputDir = dirname($outputPath);

        // Buat direktori jika belum ada
        if (!file_exists($outputDir)) {
            mkdir($outputDir, 0755, true);
        }

        // Deteksi sistem operasi dan path Python
        if (PHP_OS_FAMILY === 'Windows') {
            $pythonPath = 'C:\\Users\\msayy\\AppData\\Local\\Programs\\Python\\Python312\\python.exe';
        } else {
            $pythonPath = '/usr/bin/python3.12';
        }

        $scriptPath = base_path('python/convert_tts.py');

        $command = escapeshellcmd("$pythonPath $scriptPath \"$text\" \"$outputPath\"");

        // Jalankan perintah dan tangkap output serta kode keluaran
        $output = shell_exec($command);
        if (file_exists($outputPath)) {
            QueueLoket::create([
                'loket_number' => $this->latest_loket_number,
                'name' => $this->add_name,
            ]);

            $this->reset();

            return redirect()->route('queue-loket')->with('success', 'Loket berhasil dibuat');
        } else {
            return redirect()->route('queue-loket')->with('error', 'Gagal membuat file audio. Output: ' . $output);
        }
    }

    // public function store2()
    // {
    //     $text = $this->add_name;
    //     $fileName = $this->latest_loket_number;
    //     $outputPath = escapeshellarg(storage_path('app/public/audio/loket/' . $fileName . '.mp3'));

    //     // Deteksi sistem operasi dan path Python
    //     if (PHP_OS === 'WINNT') {
    //         // Jika OS adalah Windows
    //         $pythonPath = 'C:\Users\msayy\AppData\Local\Programs\Python\Python312\python';
    //     } elseif (PHP_OS === 'Linux') {
    //         $pythonPath = '/usr/bin/python3.12';
    //     }

    //     $scriptPath = base_path('python/convert_tts.py');

    //     $command = "$pythonPath $scriptPath $text $outputPath";

    //     // Tambahkan pengecekan kesalahan
    //     $output = shell_exec($command);
    //     if (file_exists($outputPath)) {
    //         QueueLoket::create([
    //             'loket_number' => $this->latest_loket_number,
    //             'name' => $this->add_name,
    //         ]);

    //         $this->reset();

    //         redirect()->route('queue-loket')->with('success', 'Loket berhasil Dibuat');
    //         session()->flash('success', 'Loket berhasil di simpan.');
    //     } else {
    //         session()->flash('error', 'Gagal membuat file audio. Output: ' . $output);
    //     }
    // }

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
