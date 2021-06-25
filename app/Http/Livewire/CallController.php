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
    public $disableButton;
    public $serviceId;
    public function mount(){

    }
    public function render()
    {
        $calls = 0;
        $nowServing=null;

            // GET USER DETAILS AND COUNTER 
            $userCounter = User::with('counters')
            ->where('id','=', Auth::user()->id)
            ->first();
            $service_id = $userCounter->counters->services->id;
            
              //Waiting ON QUEUES
            $waitingQueues = Queue::with('getServiceRelation')
            ->where('service_id', '=', $service_id)

            ->where('called', '=', false)
            ->where('missed', '=', false)
            ->where('created_at','>=', Carbon::today())
            ->count();


            //SERVED TODAY
            $queueServed = Queue::with('getServiceRelation')
            ->select('queue_id')
            ->where('service_id', '=', $service_id)

            ->where('called', '=', true)
            ->where('missed', '=', false)
            ->where('served', '!=', null)
            ->where('created_at','>=', Carbon::today())
            ->count();

             //get all missed today
             $missed = Queue::with('getServiceRelation')
             ->select('queue_id')
            ->where('service_id', '=', $service_id)
             ->where('called', '=', true)
             ->where('missed', '=', true)
             ->where('served', '=', null)
             ->where('created_at','>=', Carbon::today())
             ->count();


             //check call count
             $checkCallCount = Call::select('call_id')->count();
             // GET FIRST QUEUE WHO HAS NOT CALLED AND NOT MISSED
            $firstqueue = Queue::with('getServiceRelation')
            ->where('service_id', '=', $service_id)

            ->where('called', '=', false)
            ->where('missed', '=', false)
            ->where('created_at','>=', Carbon::today())
            ->first();
        //    CHECK QUEUE WHO ARE ALREADY CALLED BUT NOT YET MISSED OR SERVED
            $calledqueue = Queue::with('getServiceRelation')
            ->where('service_id', '=', $service_id)

            ->where('called', '=', true)
            ->where('missed', '=', false)
            ->where('created_at','>=', Carbon::today())
            ->orderBy('queue_id','desc')
            ->first();
        
        if($calledqueue){
                try{
                    $nowServing = Call::with('queues')
                    ->where('created_at','>=', Carbon::today())
                    ->orderBy('call_id','desc')
                    ->first();

                    if(!$nowServing->queues->missed && !$nowServing->queues->served){
                        $this->disableButton = true;
                    }
                    $calls = Call::where('queue_id', '=', $nowServing->queue_id)
                    ->where('created_at','>=', Carbon::today())
                    ->count();
                    if($nowServing){
        
                        $this->queue_id = $nowServing->queue_id;
                        
                         }
                }catch(Exception $ex){
                  $nowServing=null;
         
        }
       
       

    }
    
        return view('livewire.call-controller',compact('userCounter','waitingQueues','queueServed','missed','firstqueue','nowServing','calls','calledqueue'));


        

            
    }

    public function call(Request $request) {
            $this->disableButton = true;

            // GET USER DETAILS AND COUNTER 
            $userCounter = User::with('counters')
            ->where('id','=', Auth::user()->id)
            ->first();
            $service_id = $userCounter->counters->services->id;
            $queue = Queue::with('getServiceRelation')
            ->where('service_id', '=', $service_id)
            ->where('called', '=', false)
            ->where('missed', '=', false)
            ->where('created_at','>=', Carbon::today())
            ->first();
            
    
            $queues = Queue::where('called', '=', false)
            ->where('service_id', '=', $service_id)

            ->where('missed', '=', false)
            ->where('created_at','>=', Carbon::today())
            ->get();

               // check if there are no skipped queue
               $checkQueue = Queue::where('missed','=', false)
            ->where('service_id', '=', $service_id)

              ->where('called', '=', true)
               ->where('served','=', null)
               ->where('created_at','>=', Carbon::today())
               ->orderBy('queue_id','desc')
               ->first();
            
            //check call count
            $checkCallCount = Call::select('call_id')->count();     
// dd(!$checkQueue);
            if(!$checkQueue){

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

            }
        return view('livewire.call-controller');

        }      
        return view('livewire.call-controller');


        
        
        // if($checkCallCount < 1){

        //     if($queue){
        //         if($queues->count() > 0){
        //             $queue->called = true; 
        //             $queue->save();
        //             }
        //         $this->queue_id = $queue->queue_id;

        //         Call::create([
        //             'queue_id' => $this->queue_id,
        //             'counter_id' => Auth::user()->counters->id,
        //             'user_id' => Auth::user()->id,
              
        //         ]);
        //         $this->disableButton = true;

        //     }
        // return view('livewire.call-controller',compact('queue','queues'));

        // }     

         

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
        
    
          
        if($queue){
            Call::create([
                'queue_id' => $this->queue_id,
                'counter_id' => Auth::user()->counters->id,
                'user_id' => Auth::user()->id,
          
            ]);
        }

      
    }

    public function noShow(Request $request ) {
        $queue = Queue::where('queue_id',$this->queue_id)
        ->where('called', '=', true)
        ->where('missed', '=', false)
        ->where('created_at','>=', Carbon::today())
        ->first();
                   
      
        $this->disableButton = "false";

        if($queue){
                $queue->missed = true;
                $queue->save();
                }

         return redirect(route('admin.calls.create'));

    }


    public function served() {
        $queue = Queue::where('queue_id',$this->queue_id)
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
