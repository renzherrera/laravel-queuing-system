<?php

namespace App\Http\Livewire\Home;

use App\Models\Department;
use App\Models\Service;
use Carbon\Carbon;
use Livewire\Component;

class AvgWaiting extends Component
{
    public $departmentId;
    public function render()
    {
        $departments = Department::select('id','department_name')->get();

        $services =  Service::join('departments','services.department_id','=','departments.id')
        ->join('queues','queues.service_id','=','services.id')
         ->selectRaw('services.name,services.id,avg(TIMESTAMPDIFF(minute, queues.created_at,queues.called)) as averageWaiting,
         avg(TIMESTAMPDIFF(minute, queues.called,IFNULL(queues.served,queues.missed))) as averageProcessing')
         ->groupBy('queues.service_id')
        //  ->where('queues.created_at','>=', Carbon::today())
         ->when($this->departmentId, function($query,$departmentId){
                   return $query->where('services.department_id',$departmentId);
               })
         ->get();

        return view('livewire.home.avg-waiting',compact('departments','services'));
    }
}
