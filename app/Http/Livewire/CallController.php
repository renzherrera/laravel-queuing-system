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

            //get last result
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
            if($queue){
                $this->queue_id = $queue->queue_id;
            }
            $calls = Call::where('queue_id', '=', $this->queue_id)
            ->where('created_at','>=', Carbon::today())
            ->get();
    

        }
        return view('livewire.call-controller',compact('queue','queues','queueServed','calls'));
    }

    public function call(Request $request) {
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
                $this->queue_id = $queue->queue_id;

                Call::create([
                    'queue_id' => $this->queue_id,
                    'counter_id' => Auth::user()->counters->id,
                    'user_id' => Auth::user()->id,
              
                ]);
            }
         
            if($queues->count() > 0){
                $queue->called = true;
                $queue->save();
                }
        }

        return view('livewire.call-controller',compact('queue','queues','queueServed'));

    }


    public function callAgain(Request $request){
        // $calls = Call::where('queue_id', '=', $this->queue_id)
        // ->where('created_at','>=', Carbon::today())
        // ->get();

            Call::create([
                'queue_id' => $this->queue_id,
                'counter_id' => Auth::user()->counters->id,
                'user_id' => Auth::user()->id,
          
            ]);


      
    }

}
