<?php

namespace App\Http\Controllers;

use App\Models\Queue;
use App\Models\QueueLoket;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class QueueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $date_now = Carbon::now()->format('Y-m-d');
        $queues = DB::table('queues')->where('queue_date', $date_now)->get();

        return view('pages.admin.queue.list-queue', ['queues' => $queues]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lokets = QueueLoket::all();
        return view('pages.admin.queue.add-queue', compact('lokets'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required | min:1 | max:255',
            'email' => 'required | min:1 | max:255',
            'phone' => 'required | numeric | digits_between:9,15 | unique:users,phone',
            'address' => 'required | min:1 | max:255',
            'queue_date' => 'required | date',
        ]);

        $loket = $request->loket;
        if (!$request->loket) {
            $loket = 1;
        }

        $queue_number = 1;
        $queue_date = $request->queue_date;
        $last_queue_number = Queue::where('queue_date', $queue_date)->where('loket', $loket)->latest()->first();

        if ($last_queue_number) {
            $queue_number = $last_queue_number->queue_number + 1;
        }

        $phone = $request->phone;
        if (substr($request->phone, 0, 1) != 0) {
            $phone = 0 . $request->phone;
        }

        $user_from_email = User::where('email', $request->email)->get()->first();
        if ($user_from_email) {
            $user_id = $user_from_email->id;
        } else {
            $new_user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $phone,
                'address' => $request->address,
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
            ]);
            $user_id = $new_user->id;
        }

        $new_queue = [
            'user_id' => $user_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $phone,
            'address' => $request->address,
            'queue_date' => $request->queue_date,
            'loket' => $loket,
            'queue_number' => $queue_number
        ];

        Queue::create($new_queue);

        return redirect()->route('queue-list')->with('success', 'Antrian Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Queue $queue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $queue = Queue::findOrFail($id);

        return view('pages.admin.queue.edit-queue', compact('queue'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required | min:1 | max:255',
            'email' => 'required | min:1 | max:255',
            'phone' => 'required | numeric | digits_between:9,15',
            'address' => 'required | min:1 | max:255',
        ]);

        $queue = Queue::findOrFail($id);

        $queue->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('queue-list')->with('success', 'Antrian ' . $queue->name . ' Berhasil Diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $queue = Queue::findOrFail($id);
        $queue->delete();

        return redirect()->route('queue-list')->with('success', 'Antrian ' . $queue->name . ' Berhasil Dihapus');
    }

    /**
     * Calling the queue number from storage.
     */
    public function call()
    {
        return view('pages.admin.queue.call-queue');
    }

    /**
     * Calling the queue number from storage.
     */
    public function loket()
    {
        return view('pages.admin.queue.loket-queue');
    }

    /**
     * Calling the queue number from storage.
     */
    public function monitor()
    {
        return view('pages.admin.queue.monitor-queue');
    }
}
