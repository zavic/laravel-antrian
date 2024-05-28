<?php

namespace App\Http\Controllers;

use App\Models\Queue;
use App\Models\QueueLoket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QueueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $date_now = Carbon::now()->format('Y-m-d');
        $queues = DB::table('queues')->where('queue_date', $date_now)->get();

        // return dd($queues);

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
            'phone' => 'required | numeric | digits_between:9,15',
            'address' => 'required | min:1 | max:255',
            'queue_date' => 'required | date',
            'loket' => 'required | min:1'
        ]);

        $queue_date = $request->queue_date;
        $loket = $request->loket;
        $last_queue_number = Queue::where('queue_date', $queue_date)->where('loket', $loket)->latest()->first();
        $queue_number = 1;

        if ($last_queue_number) {
            $queue_number = $last_queue_number->queue_number + 1;
        }

        if (substr($request->phone, 0, 1) != 0) {
            $request->phone = 0 . $request->phone;
        }

        Queue::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'queue_date' => $request->queue_date,
            'loket' => $request->loket,
            'queue_number' => $queue_number
        ]);



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
