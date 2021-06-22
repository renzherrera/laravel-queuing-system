<?php

namespace App\Http\Livewire;

use App\Models\Call;
use App\Models\Counter;
use App\Models\Queue;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CallController extends Component
{
    public $queue_id;
    public $disableButton =false;
    public $serviceId;
    public $lastcall;
    public function mount(){

    }
    public function render()
    {


            // GET USER DETAILS AND COUNTER 
            $userCounter = User::with('counters')
            ->where('id','=', Auth::user()->id)
            ->first();
            

            $firstqueue = Queue::with('getServiceRelation')
            ->where('created_at','>=', Carbon::today())
            ->first();

            //getting the last queue to show last queue eveen after refresh
          
            $queue = Queue::with('getServiceRelation')
            ->where('missed', '=', false)
            ->where('created_at','>=', Carbon::today())
            ->orderBy('queue_id','desc')
            ->first();

            //get all queues not called
            $waitingQueues = Queue::with('getServiceRelation')
            ->where('called', '=', false)
            ->where('missed', '=', false)
            ->where('created_at','>=', Carbon::today())
            ->get();

          
            //get all served
            $queueServed = Queue::with('getServiceRelation')
            ->select('queue_id')
            ->where('called', '=', true)
            ->where('missed', '=', false)
            ->where('served', '!=', null)
            ->where('created_at','>=', Carbon::today())
            ->get();

            //gett all missed
            $missed = Queue::with('getServiceRelation')
            ->select('queue_id')
            ->where('called', '=', true)
            ->where('missed', '=', true)
            ->where('served', '=', null)
            ->where('created_at','>=', Carbon::today())
            ->count();

            
            $checkCalls = Call::count();

            if($checkCalls){
            //now serving
                $lastcall = Call::join('queues','calls.queue_id','=','queues.queue_id')
                ->join('services', 'queues.service_id', '=', 'services.id')
                ->select('queues.queue_id','calls.user_id' ,'calls.counter_id','services.prefix','services.name', 'queues.ticket_number', 'queues.service_id')
                ->where('calls.created_at','>=', Carbon::today())
                ->where('calls.user_id','=', Auth::user()->id)
                ->orderBy('counter_id','asc')
        
                ->orderBy('calls.created_at','desc')
                ->first();

         

            //updating last call queue_id after call 
            if($lastcall ){

            $this->queue_id = $lastcall->queue_id;
            
             }
          //get total attempts
            $calls = Call::where('queue_id', '=', $lastcall->queue_id)
            ->where('created_at','>=', Carbon::today())
            ->count();
            return view('livewire.call-controller',compact('queue','waitingQueues','firstqueue','calls','lastcall','userCounter','queueServed','missed'));

        } else {
            return view('livewire.call-controller',compact('queue','waitingQueues','firstqueue','userCounter','queueServed','missed'));

        }
        
            
    }

    public function call(Request $request) {
            sleep(2);
            $queue = Queue::with('getServiceRelation')
            ->where('called', '=', false)
            ->where('missed', '=', false)
            ->where('created_at','>=', Carbon::today())
            ->first();
            
    
            $queues = Queue::with('getServiceRelation')
            ->where('called', '=', false)
            ->where('missed', '=', false)
            ->where('created_at','>=', Carbon::today())
            ->get();
            
           
         

            if($queue){
                if($queues->count() > 0){
                    $queue->called = true;
                    $queue->save();
                    }
                $this->queue_id = $queue->queue_id;

                Call::create([
                    'queue_id' => $this->queue_id,
                    'counter_id' => Auth::user()->counters->id,
                    'user_id' => Auth::user()->id,
              
                ]);
                $this->disableButton = true;

            }
         
        return view('livewire.call-controller',compact('queue','queues'));

    }


    public function callAgain(Request $request){
        // $calls = Call::where('queue_id', '=', $this->queue_id)
        // ->where('created_at','>=', Carbon::today())
        // ->get();
        sleep(2);

        $queue = Queue::with('getServiceRelation')
        ->where('called', '=', true)
        ->where('missed', '=', false)
        ->where('created_at','>=', Carbon::today())
        ->first();
        
            //now serving
            $lastcall = Call::join('queues','calls.queue_id','=','queues.queue_id')
            ->join('services', 'queues.service_id', '=', 'services.id')
            ->select('queues.queue_id','calls.user_id' ,'calls.counter_id','services.prefix','services.name', 'queues.ticket_number', 'queues.service_id')
            ->where('calls.created_at','>=', Carbon::today())
            ->where('calls.user_id','=', Auth::user()->id)
            ->orderBy('counter_id','asc')
    
            ->orderBy('calls.created_at','desc')
            ->first();

          
        if($queue){
            Call::create([
                'queue_id' => $this->queue_id,
                'counter_id' => Auth::user()->counters->id,
                'user_id' => Auth::user()->id,
          
            ]);
        }

      
    }

    public function noShow(Request $request ) {
        $queue = Queue::with('getServiceRelation')
        ->where('queue_id',$this->queue_id)
        ->where('called', '=', true)
        ->where('missed', '=', false)
        ->where('created_at','>=', Carbon::today())
        ->first();
                   
      

        if($queue){
                $queue->missed = true;
                $queue->save();
                }
         $this->disableButton = "false";
         return redirect(route('admin.calls.create'));

    }


    public function served() {
        $queue = Queue::with('getServiceRelation')
        ->where('queue_id',$this->queue_id)
        ->where('called', '=', true)
        ->where('missed', '=', false)
        ->where('served', '=', null)
        ->where('created_at','>=', Carbon::today())
        ->first();
                   
     
        $this->disableButton = "false";
      

        if($queue){
                $queue->called = true;
                $queue->served = now();
                $queue->save();
                }
                return redirect(route('admin.calls.create'));

         }




}
