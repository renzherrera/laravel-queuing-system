<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Queue;
use App\Models\Service;
use Carbon\Carbon;
use ErrorException;
use Illuminate\Http\Request;

class ClientDisplayController extends Controller
{
    //temporary
    public $customerId = 1;
    public $ticketNumber;
    public function showDepartments() {
        $departments = Department::select('id', 'department_name','is_active')->get();
        return view('admin.displays.departments',compact('departments'));

    }

    public function showServices($department) {
    //     $queue = Queue::select('queue_id','ticket_number','created_at')
    //     ->where('created_at','>=', Carbon::today())
    //     ->get();

    //    $ticketNumber = $queue->max('ticket_number');
            
      

        $services = Service::select('id', 'name','is_active','department_id','default_number','prefix')
        ->where('department_id', '=', $department)
        ->get();
        return view('admin.displays.services',compact('services'));


    }
    public function getTicketDetails(Service $service) {
        // get first ticketnumber + 1
       
            $queue = Queue::select('queue_id','ticket_number','created_at','service_id')
            ->where('service_id','=', $service->id)
            ->where('created_at','>=', Carbon::today())
            ->orderBy('created_at','desc')
            ->first();
     


        $waitingQueue = Queue::select('queue_id','ticket_number','created_at','service_id')
        ->where('service_id','=', $service->id)
        ->where('created_at','>=', Carbon::today())
        ->where('called', '=', false)
        ->where('missed', '=', false)
        ->get();


       
       return view('admin.displays.ticket-details',compact('service','waitingQueue','queue'));

            
    }

    public function storeQueue(Request $request){
        sleep(5);

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
                // 'customer_id' => $this->customerId,
            
            ]);
        } elseif($queue->count() > 0){
            Queue::create([
                'service_id' => $request->id,
                'ticket_number' => $queue->max('ticket_number') + 1,
                // 'customer_id' => $this->customerId,
            
            ]);
        }
      
        return redirect()->route('admin.displays.departments');  
      
    }
}
