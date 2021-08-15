<?php

namespace App\Http\Livewire\Admin\Kiosk;

use App\Models\Department;
use App\Models\Queue;
use App\Models\Service;
use Carbon\Carbon;
use Livewire\Component;
 
class KioskService extends Component
{
    public $state = [];
    public $department,$service,$editMode = false,$firstQueue,$waitingQueue;
    public $serviceName, $servicePrefix, $serviceId, $serviceDefault;
    public function mount(Department $department) {
        // $this->state = $department->toArray();
        $this->department = $department;

    }
    public function render()
    {
        $services = Service::where('department_id',$this->department->id)->get();
        return view('livewire.admin.kiosk.kiosk-service',compact('services'))->layout('layouts.kiosk');
    }
    public function getTicketDetails(Service $service) {
        // $settings = Settings::first();
    // get first ticketnumber + 1
        $this->service = $service;
        $this->state = $service->toArray();
        $this->serviceName = $service->name;
        $this->servicePrefix = $service->prefix;
        $this->serviceDefault = $service->default_number;
        $this->serviceId = $service->id;
        $this->dispatchBrowserEvent('show-kiosk-modal');

        $this->firstQueue = Queue::with('getServiceRelation')->select('queue_id','ticket_number','created_at','service_id')
        ->where('service_id','=', $service->id)
        ->where('created_at','>=', Carbon::today())
        ->orderBy('created_at','desc')
        ->first();
 

        $this->waitingQueue = Queue::with('getServiceRelation')->select('queue_id','ticket_number','created_at','service_id')
        ->where('service_id','=', $service->id)
        ->where('created_at','>=', Carbon::today())
        ->where('called', '=', null)
        ->where('missed', '=', null)
        ->get()->count();


    



   
//    return view('admin.displays.ticket-details',compact('service','waitingQueue','queue','settings'));

        
    }

    public function storeQueue(){

        $queue = Queue::select('queue_id','ticket_number','created_at')
        ->where('ticket_number', '>', $this->service->default_number)
        ->where('service_id', '=', $this->service->id)
        ->where('created_at','>=', Carbon::today())
        ->get();
        if(!$queue){
        //get default number for first queues
            Queue::create([
                'service_id' => $this->service->id,
                'ticket_number' => $this->service->default_number + 1,
                // 'customer_id' => $this->customerId,
            ]);
        } elseif($queue){
            Queue::create([
                'service_id' => $this->service->id,
                'ticket_number' => $queue->max('ticket_number') + 1,
                // 'customer_id' => $this->customerId,
            
            ]);
        }
      
        $this->dispatchBrowserEvent('kiosk-success',['message'=> 'Nice!']);
      
    }

   
}
