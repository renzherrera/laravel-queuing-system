<?php

namespace App\Http\Livewire;
use App\Models\Queue;
use Carbon\CarbonInterval;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class QueuesTable extends Component
{
    public function render()
    {
       
        $queues = Queue::with('getServiceRelation')
        // ->select('services.id', 'services.name', 'departments.department_name','services.prefix','services.default_number','services.is_active')
        ->orderBy('queue_id','desc')
        ->paginate(5);
     

        return view('livewire.queues-table', compact('queues'));
    }
}
