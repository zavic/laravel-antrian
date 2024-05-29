<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Queue;
use App\Models\QueueLoket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class UserQueueController extends Controller
{
    use WithPagination;

    public function create()
    {
        $lokets = QueueLoket::all();

        return view('pages.user.create-queue', compact('lokets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required | min:1 | max:255',
            'email' => 'required | min:1 | max:255',
            'phone' => 'required | numeric | digits_between:9,15',
            'address' => 'required | min:1 | max:255',
            'queue_date' => 'required | date',
        ]);

        $queue_number = 1;
        $phone = $request->phone;
        $queue_date = $request->queue_date;

        $loket = $request->loket;
        if (!$request->loket) {
            $loket = 1;
        }

        $last_queue_number = Queue::where('queue_date', $queue_date)->where('loket', $loket)->latest()->first();

        if ($last_queue_number) {
            $queue_number = $last_queue_number->queue_number + 1;
        }

        if (substr($request->phone, 0, 1) != 0) {
            $phone = 0 . $request->phone;
        }

        $new_queue = [
            'user_id' => auth()->user()->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $phone,
            'address' => $request->address,
            'queue_date' => $request->queue_date,
            'loket' => $loket,
            'queue_number' => $queue_number
        ];

        Queue::create($new_queue);

        return redirect()->route('user-my-queue')->with('success', 'Antrian Berhasil Ditambahkan');
    }

    public function myQueue()
    {
        return view('pages.user.my-queue');
    }
}
