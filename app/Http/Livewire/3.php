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
    public $queue_id, $counter_id, $user_id;
    public function render()
    {
        if(Auth::user()->counter_id) {

            //get first result
            $queue = Queue::select('queue_id')
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
        }
        return view('livewire.call',compact('queue','queues','queueServed'));
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
    
         
            if($queues->count() > 0){
                $queue->called = true;
                $queue->save();
                }
        }

      
        return view('livewire.call',compact('queue','queues','queueServed'));

    }

    public function callUpdate(){
        
        $record = Queue::select('queue_id','ticket_number','created_at','called')
        ->where('service_id', '=', Auth::user()->counters->services->id)
        ->where('called', '=', false)
        ->where('missed', '=', false)
        ->where('created_at','>=', Carbon::today())
        ->first();

        $record->update([
            'called' => 1,
            
        ]);
    }

    public function insertCall(){
        $calls = Call::create([
            'queue_id' => $this->queue_id,
            'counter_id' => $this->counter_id,
            'user_id' => $this->user_id,
      
        ]);
   
    }

}
