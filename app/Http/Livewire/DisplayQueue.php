<?php

namespace App\Http\Livewire;

use App\Models\Call;
use App\Models\Counter;
use App\Models\Settings;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DisplayQueue extends Component
{
    public function render()
    {
        // $counters = Counter::all(['id', 'counter_name']);
        // $calls = Call::leftJoin('queues','calls.queue_id','=','queues.queue_id')
        // ->leftJoin('services', 'queues.service_id', '=', 'services.id')
        // ->select('queues.queue_id', 'calls.counter_id','calls.user_id','services.prefix','services.name', 'queues.ticket_number', 'queues.service_id')
        // ->where('calls.created_at','>=', Carbon::today())

        // ->orderBy('counter_id','asc')

        // ->orderBy('calls.created_at','desc')
        // ->get()->groupBy('counters.counter_id');
        $couunter = Call::has('queues')->get();
        $counters = Call::has('queues')->join('queues','calls.queue_id','=','queues.queue_id')
        ->selectRaw('calls.counter_id ,max(queues.ticket_number)  as ticketNumber ')
        // ->where(function ($query) {
        //     $query->where('queues.missed', '=', null);
        //     $query->where('queues.served', '=', null);
        // })
        ->where('calls.created_at','>=', Carbon::today())
        ->groupBy('calls.counter_id')->get();
        $settings = Settings::first();

    


        




        return view('livewire.display-queue',compact('counters','settings','couunter'));
    }
}
