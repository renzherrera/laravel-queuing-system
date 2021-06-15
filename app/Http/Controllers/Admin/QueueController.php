<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQueueRequest;
use App\Models\Department;
use App\Models\Queue;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QueueController extends Controller
{
    public $serviceId = 1,  $customerId=1;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::select('id', 'department_name','is_active')->get();
        return view('admin.queues.create',compact('departments'));

    }

    // public function showServices(Department $department)
    // {
    //     $services = Service::select('id', 'name','is_active','department_id')
    //     ->where('department_id', '=', 100)
    //     ->get();
    //     return view('admin.queues.showServices',compact('services'));

    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $queue = Queue::select('queue_id','ticket_number','created_at')
        ->where('ticket_number', '>', $request->default_number)
        ->where('service_id', '=', $request->id)
        ->where('created_at','>=', Carbon::today())
        ->get();
        if($queue->count() < 1){
        //get default number for first queues
            Queue::create([
                'service_id' => $request->id,
                'ticket_number' => $request->default_number + 1,
                'customer_id' => $this->customerId,
            
            ]);
        } elseif($queue->count() > 0){
            Queue::create([
                'service_id' => $request->id,
                'ticket_number' => $queue->max('ticket_number') + 1,
                'customer_id' => $this->customerId,
            
            ]);
        }
      
        return redirect()->route('admin.queues.create');  
      

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($department)
    {
     

        $services = Service::select('id', 'name','is_active','department_id','default_number')
        ->where('department_id', '=', $department)
        ->get();
        return view('admin.queues.show',compact('services'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
