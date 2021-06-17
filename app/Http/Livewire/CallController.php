<?php

namespace App\Http\Livewire;

use App\Models\Call;
use App\Models\Queue;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CallController extends Component
{
    public $queue_id;
    public function render()
    {
        if(Auth::user()->counter_id) {

            //for the voice speaker // calling previous number fixed
            $firstqueue = Queue::select('queue_id','ticket_number','created_at')
            ->where('service_id', '=', Auth::user()->counters->services->id)
            ->where('called', '=', false)
            ->where('missed', '=', false)
            ->where('created_at','>=', Carbon::today())
            ->first();
            //get last queue result
            $queue = Queue::select('queue_id','ticket_number')
            ->where('service_id', '=', Auth::user()->counters->services->id)
            ->where('called', '=', 1)
            ->where('missed', '=', false)
            ->where('created_at','>=', Carbon::today())
            ->orderBy('queue_id','desc')
            ->first();
       
            //get all queues not called
            $queues = Queue::where('service_id', '=', Auth::user()->counters->services->id)
            ->where('called', '=', false)
            ->where('missed', '=', false)
            ->where('created_at','>=', Carbon::today())
            ->get();

            //get all served/called queue
            $queueServed = Queue::where('service_id', '=', Auth::user()->counters->services->id)
            ->where('called', '=', true)
            ->where('missed', '=', false)
            ->where('created_at','>=', Carbon::today())
            ->get();
         
            //get total served
            $calls = Call::where('queue_id', '=', $this->queue_id)
            ->where('created_at','>=', Carbon::today())
            ->get();
    

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
            //updating last call queue_id after call 
            $this->queue_id = $lastcall->queue_id;
        }
            

        }
        return view('livewire.call-controller',compact('queue','queues','queueServed','calls','firstqueue','lastcall'));
    }

    public function call(Request $request) {
        sleep(2);

        if(Auth::user()->counter_id) {
            $queue = Queue::select('queue_id','ticket_number','created_at')
            ->where('service_id', '=', Auth::user()->counters->services->id)
            ->where('called', '=', false)
            ->where('missed', '=', false)
            ->where('created_at','>=', Carbon::today())
            ->first();
    
            $queues = Queue::where('service_id', '=', Auth::user()->counters->services->id)
            ->where('called', '=', false)
            ->where('missed', '=', false)
            ->where('created_at','>=', Carbon::today())
            ->get();
    
            $queueServed = Queue::where('service_id', '=', Auth::user()->counters->services->id)
            ->where('called', '=', true)
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
            }
         
         
        }

        return view('livewire.call-controller',compact('queue','queues','queueServed'));

    }


    public function callAgain(Request $request){
        // $calls = Call::where('queue_id', '=', $this->queue_id)
        // ->where('created_at','>=', Carbon::today())
        // ->get();
        sleep(2);
            Call::create([
                'queue_id' => $this->queue_id,
                'counter_id' => Auth::user()->counters->id,
                'user_id' => Auth::user()->id,
          
            ]);


      
    }

}
