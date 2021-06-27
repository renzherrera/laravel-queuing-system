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
        $counters = Counter::all(['id', 'counter_name']);
        $calls = Call::join('queues','calls.queue_id','=','queues.queue_id')
        ->join('services', 'queues.service_id', '=', 'services.id')
        ->select('queues.queue_id', 'calls.counter_id','calls.user_id','services.prefix','services.name', 'queues.ticket_number', 'queues.service_id')
        ->where('calls.created_at','>=', Carbon::today())

        ->orderBy('counter_id','asc')

        ->orderBy('calls.created_at','desc')
        ->get()->groupBy('counter_id');

        $settings = Settings::first();
        

        return view('livewire.display-queue',compact('counters','calls','settings'));
    }
}
