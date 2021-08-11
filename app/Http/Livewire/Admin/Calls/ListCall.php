<?php

namespace App\Http\Livewire\Admin\Calls;

use App\Models\Call;
use App\Models\Counter;
use App\Models\Queue;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ListCall extends Component
{
   
    public $queue_id;
    public $disableButton;
    public $nextDisableButton;
    public $serviceId,$standByMode ;
    public function mount(){
        $counterStatus =  auth()->user()->counters->status;
        if($counterStatus == "active"){
            $this->standByMode = false;
        }else{
            $this->standByMode = true;
            $this->nextDisableButton = true;
            $this->disableButton = true;
        }
     
    }
    public function render()
    {
        $calls = 0;

        $queueCount = Queue::count();
        $service_id =  auth()->user()->counters->services->id;
       
        
        $activeTicket = $this->getActiveTicket()->first();
        $nextTicket = $this->getNextTicket()->first();
        $lastCalled = Call::select('queue_id')->where('user_id',auth()->user()->id)
        ->where('created_at','>=', Carbon::today())
        // ->where('counter_id','=', auth()->user()->counter_id)
        ->orderBy('queue_id','desc')
        ->offset(1)->limit(1)
        ->groupBy('queue_id')
        ->first();
        if($activeTicket && !$this->standByMode){

        
            if($activeTicket->queues->served == null && $activeTicket->queues->missed == null){
                $this->disableButton = false;

            }elseif($activeTicket->queues->served != null OR $activeTicket->queues->missed != null) {
                $this->disableButton = true;

            } 
        } else {
            $this->disableButton = true;
            $this->nextDisableButton = true;
        }

        if($nextTicket && !$this->standByMode){
            $this->nextDisableButton = false;

        }else{
            $this->nextDisableButton = true;

        }
      
        $completedQueue = Call::has('queues')->select('calls.queue_id','calls.user_id','queues.called','queues.missed','queues.ticket_number','queues.served')
        ->where('calls.user_id',auth()->user()->id)
        ->where('queues.created_at','>=', Carbon::today())
        ->orderBy('calls.queue_id','desc')
        ->groupBy('queue_id','user_id')
        ->join('queues','queues.queue_id','=','calls.queue_id')->get()->count();

        $limitedCompletedQueue =Call::has('queues')->select('calls.queue_id','calls.user_id','queues.called','queues.missed','queues.ticket_number','queues.served')
        ->where('calls.user_id',auth()->user()->id)
        ->where('queues.created_at','>=', Carbon::today())
        ->orderBy('calls.queue_id','desc')
        ->groupBy('queue_id','user_id')
        ->join('queues','queues.queue_id','=','calls.queue_id')
        ->limit(5)->get();

        $queueServed = Call::has('queues')->select('calls.queue_id','calls.user_id','queues.called','queues.missed','queues.ticket_number','queues.served')
        ->where('calls.user_id',auth()->user()->id)
        ->where('queues.created_at','>=', Carbon::today())
        ->where('queues.served' ,'!=',null)
        ->where('queues.missed' ,'=',null)
        ->orderBy('calls.queue_id','desc')
        ->groupBy('queue_id','user_id')
        ->join('queues','queues.queue_id','=','calls.queue_id')
        ->get()
        ->count();


        $missed = Call::has('queues')->select('calls.queue_id','calls.user_id','queues.called','queues.missed','queues.ticket_number')
        ->where('calls.user_id',auth()->user()->id)
        ->where('queues.created_at','>=', Carbon::today())
        ->where('queues.missed','!=',null)
        ->orderBy('calls.queue_id','desc')
        ->groupBy('queue_id','user_id')
        ->join('queues','queues.queue_id','=','calls.queue_id')
        ->get()
        ->count();
        
     
          
            
            //Waiting ON QUEUES
        $waitingQueues = Queue::with('getServiceRelation')
        ->where('service_id', '=', $service_id)
        ->where('called', '=', null)
        ->where('missed', '=', null)
        ->where('served', '=', null)
        ->where('created_at','>=', Carbon::today());

        $limitWaitingQueues = $waitingQueues->limit(5);
        $waitingQueues = $waitingQueues->get();

    
        return view('livewire.admin.calls.list-call',compact('waitingQueues','limitedCompletedQueue','queueServed','missed','calls','activeTicket','lastCalled','completedQueue','queueCount','nextTicket'));

            
    }

    public function call(Request $request) {

       


            $activeTicket = $this->getActiveTicket()->first();
            $nextTicket = $this->getNextTicket()->first();

            if(!$activeTicket){

                if($nextTicket){

                    if($nextTicket->count() > 0){
                        $nextTicket->called = now(); 
                        $nextTicket->save();
                        }
                        // $this->queue_id = $queue->queue_id;
    
                    Call::create([
                        'queue_id' => $nextTicket->queue_id,
                        'counter_id' => Auth::user()->counters->id,
                        'user_id' => Auth::user()->id,
                    ]);
                    $this->dispatchBrowserEvent('alert',['message' => 'Goood']);
                     $this->dispatchBrowserEvent('replaySound');
                }
                else{
                $this->dispatchBrowserEvent('info',['message' => 'No waiting queues at the moment']);

                }

            }else{

                if($activeTicket->queues->missed != null OR $activeTicket->queues->served != null){

                    if($nextTicket){
    
                        if($nextTicket->count() > 0){
                            $nextTicket->called = now(); 
                            $nextTicket->save();
                            }
                            // $this->queue_id = $queue->queue_id;
        
                        Call::create([
                            'queue_id' => $nextTicket->queue_id,
                            'counter_id' => Auth::user()->counters->id,
                            'user_id' => Auth::user()->id,
                        ]);
                        $this->dispatchBrowserEvent('alert',['message' => 'Goood']);
                         $this->dispatchBrowserEvent('replaySound');
                    }
                    else{
                    $this->dispatchBrowserEvent('info',['message' => 'No waiting queues at the moment']);
    
                    }
                   
    
                } else {
                    $this->dispatchBrowserEvent('info',['message' => 'You have to mark as Served or No-show to proceed.']);
    
                }


            }
      
         

        }      


        
    



    public function callAgain(Request $request){
      
        $activeTicket = $this->getActiveTicket()->first();
        
        
       
        // dd($calls);
        if($activeTicket->queues->missed == null && $activeTicket->queues->served == null){
            // $activeTicket->queues->called = true; 
            // $activeTicket->queues->save();
            Call::create([
                'queue_id' => $activeTicket->queue_id,
                'counter_id' => Auth::user()->counters->id,
                'user_id' => Auth::user()->id,
          
            ]);
        $this->dispatchBrowserEvent('replaySound');

        } else {

            $this->dispatchBrowserEvent('info',['message' => 'Transaction done with the current ticket.']);

        }


      
    }

    public function noShow(Request $request ) {
        $activeTicket = $this->getActiveTicket()->first()->queues;
        
        
        if($activeTicket->served ==null && $activeTicket->missed ==null ){
            $activeTicket->missed = now(); 
            $activeTicket->save();
            $this->dispatchBrowserEvent('alert',['message' => $activeTicket->getServiceRelation->prefix.' - '.$activeTicket->ticket_number. ' marked as Missed!']);

        }


    }


    public function served() {
        $activeTicket = $this->getActiveTicket()->first()->queues;
        
        
        if($activeTicket->served ==null && $activeTicket->missed ==null){
            $activeTicket->served = now(); 
            $activeTicket->save();
        $this->dispatchBrowserEvent('alert',['message' => $activeTicket->getServiceRelation->prefix.' - '.$activeTicket->ticket_number. ' marked as Served!']);
        }


         }

    public function getActiveTicket()
    {
       return Call::with('queues')->where('user_id',auth()->user()->id)
        ->where('created_at','>=', Carbon::today())
        // ->where('counter_id','=', auth()->user()->counter_id)
        ->orderBy('call_id','desc')
        ;
    }

    
    public function getNextTicket()
    {
       return Queue::with('getServiceRelation')
        ->where('service_id', '=', auth()->user()->counters->services->id)
        ->where('called', '=', null)
        ->where('missed', '=', null)
        ->where('created_at','>=', Carbon::today())
        ->orderBy('queue_id','asc');
      
    }

    public function standBy() {
        $counterStatus = auth()->user()->counters->status;
        $counter = Counter::where('id',auth()->user()->counter_id)->first();
      
        if($counter->status == "active"){
            $counter->status = "standby"; 
            $counter->save();
            $this->dispatchBrowserEvent('alert',['message' => 'You are in Stand-By Mode!']);
            $this->standByMode = true;
            $this->nextDisableButton = true;
            $this->disableButton = true;

        }else{
            $counter->status = "active"; 
            $counter->save();
            $this->dispatchBrowserEvent('alert',['message' => 'You switched to Queuing Mode!']);
            $this->standByMode = false;

        }
    }



}
