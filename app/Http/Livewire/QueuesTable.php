<?php

namespace App\Http\Livewire;
use App\Models\Queue;
use App\Models\Service;
use App\Models\Settings;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use PDF;

class QueuesTable extends Component
{
    use WithPagination;
    public $service,$status,$user,$fromDate,$toDate;

    public function mount() {

    }
    public function render()
    {
        $service = $this->service;
        $fromDate = $this->fromDate;
        $toDate = $this->toDate;
        $settings = Settings::first();

        $services = Service::select('id','name')->get();

        $queues = Queue::with('getServiceRelation')
        // ->select('services.id', 'services.name', 'departments.department_name','services.prefix','services.default_number','services.is_active')
        ->orderBy('queue_id','desc');

        if($service && $service != "x"){
            $queues = $queues->where('service_id','=', $service);
        }
        if($fromDate && $toDate){
            $queues = $queues->whereDate('created_at', '>=', $fromDate)
            ->whereDate('created_at', '<=', $toDate);
        }

        $queues = $queues->orderBy('created_at','asc')->paginate(5);
     

        return view('livewire.queues-table', compact('queues','services','settings'));
    }

        public function queuesPDF(Request $request)
    {
        $service = $request->service;
        $fromDate = $request->fromDate;
        $toDate = $request->toDate;
        $settings = Settings::first();

        $queues = Queue::with('getServiceRelation');
        // ->select('services.id', 'services.name', 'departments.department_name,'services.prefix','services.default_number','services.is_active')
        if($service && $service != "x"){
            $queues = $queues->where('service_id','=', $service);
        }

        if($fromDate && $toDate){
            $queues = $queues->whereDate('created_at', '>=', $fromDate)
            ->whereDate('created_at', '<=', $toDate);
        }
            
            $queues = $queues->orderBy('created_at','asc')->get();;

       


       $results = $queues->chunk(15);
        // $projects = Project::join('project_images','projects.id','=','project_images.project_id');
        view()->share('results',$results);
        $pdf = PDF::setOptions([ 'isRemoteEnabled' => true])->loadView('admin.queues.queues-pdf', compact('results','settings'));

        return $pdf->stream();
    }
}
